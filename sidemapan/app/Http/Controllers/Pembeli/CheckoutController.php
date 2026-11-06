<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    /**
     * Halaman checkout
     */
    public function index()
    {
        $carts = Cart::with('product.umkm')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('pembeli.cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view(
            'pembeli.checkout.index',
            compact('carts', 'total')
        );
    }

    /**
     * Membuat pesanan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $order = DB::transaction(function () use ($validated) {

            /*
             * Ambil semua cart milik user
             */
            $carts = Cart::with('product.umkm')
                ->where('user_id', auth()->id())
                ->lockForUpdate()
                ->get();

            if ($carts->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'Keranjang masih kosong.',
                ]);
            }

            $subtotal = 0;

            /*
             * Validasi produk dan stok
             */
            foreach ($carts as $cart) {

                $product = $cart->product;

                if (!$product) {
                    throw ValidationException::withMessages([
                        'cart' => 'Ada produk dalam keranjang yang sudah tidak tersedia.',
                    ]);
                }

                /*
                 * Produk harus aktif
                 */
                if ($product->status !== 'active') {
                    throw ValidationException::withMessages([
                        'cart' => 'Produk "' .
                            $product->name .
                            '" sudah tidak tersedia.',
                    ]);
                }

                /*
                 * UMKM harus approved
                 */
                if (
                    !$product->umkm ||
                    $product->umkm->status !== 'approved'
                ) {
                    throw ValidationException::withMessages([
                        'cart' => 'UMKM dari produk "' .
                            $product->name .
                            '" belum terverifikasi.',
                    ]);
                }

                /*
                 * Lock produk
                 */
                $product = Product::whereKey($product->id)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw ValidationException::withMessages([
                        'cart' => 'Produk tidak ditemukan.',
                    ]);
                }

                /*
                 * Cek stok
                 */
                if ($product->stock < $cart->quantity) {
                    throw ValidationException::withMessages([
                        'cart' => 'Stok produk "' .
                            $product->name .
                            '" tidak mencukupi. Stok tersedia: ' .
                            $product->stock,
                    ]);
                }

                /*
                 * Hitung subtotal
                 */
                $subtotal += $product->price * $cart->quantity;
            }

            /*
             * Ongkir sementara 0
             */
            $shippingCost = 0;

            /*
             * Buat order
             */
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'DSH-' . strtoupper(Str::random(10)),
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $subtotal + $shippingCost,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
            ]);

            /*
             * Buat order items
             */
            foreach ($carts as $cart) {

                $product = Product::whereKey($cart->product_id)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw ValidationException::withMessages([
                        'cart' => 'Produk tidak ditemukan.',
                    ]);
                }

                $itemSubtotal =
                    $product->price * $cart->quantity;

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $cart->quantity,
                    'price' => $product->price,
                    'subtotal' => $itemSubtotal,
                ]);

                /*
                 * Kurangi stok
                 */
                $product->decrement(
                    'stock',
                    $cart->quantity
                );

                /*
                 * Tambahkan jumlah terjual
                 */
                $product->increment(
                    'sold',
                    $cart->quantity
                );
            }

            /*
             * Kosongkan cart
             */
            Cart::where('user_id', auth()->id())
                ->delete();

            return $order;
        });

        return redirect()
            ->route('pembeli.orders.show', $order)
            ->with(
                'success',
                'Pesanan berhasil dibuat.'
            );
    }
}