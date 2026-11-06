<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan keranjang belanja
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('pembeli.cart.index', compact('carts', 'total'));
    }

    /**
     * Menambahkan produk ke keranjang
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // Ambil produk berdasarkan product_id
        $product = Product::with('umkm')->findOrFail($validated['product_id']);

        // Cek status produk
        if ($product->status !== 'active' || $product->stock < 1) {
            return back()->with('error', 'Produk tidak tersedia.');
        }

        // Cek UMKM
        $umkm = $product->umkm;

        if (!$umkm || $umkm->status !== 'approved') {
            return back()->with('error', 'UMKM belum terverifikasi.');
        }

        // Cari keranjang user untuk produk tersebut
        $cart = Cart::firstOrNew([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        // Jika sudah ada, tambahkan quantity
        $newQuantity = $cart->exists
            ? $cart->quantity + $validated['quantity']
            : $validated['quantity'];

        // Cek stok
        if ($newQuantity > $product->stock) {
            return back()->with(
                'error',
                'Jumlah melebihi stok tersedia. Stok saat ini: ' . $product->stock
            );
        }

        $cart->quantity = $newQuantity;
        $cart->save();

        return redirect()
            ->route('pembeli.cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Memperbarui jumlah produk
     */
    public function update(Request $request, Cart $cart)
    {
        abort_unless($cart->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart->load('product');

        if (!$cart->product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($validated['quantity'] > $cart->product->stock) {
            return back()->with(
                'error',
                'Jumlah melebihi stok tersedia. Stok saat ini: ' .
                $cart->product->stock
            );
        }

        $cart->update([
            'quantity' => $validated['quantity'],
        ]);

        return back()->with(
            'success',
            'Jumlah produk berhasil diperbarui.'
        );
    }

    /**
     * Menghapus produk dari keranjang
     */
    public function destroy(Cart $cart)
    {
        abort_unless($cart->user_id === auth()->id(), 403);

        $cart->delete();

        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang.'
        );
    }
}