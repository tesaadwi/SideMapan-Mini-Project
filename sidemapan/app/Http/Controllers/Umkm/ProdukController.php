<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Mendapatkan UMKM milik user yang sedang login.
     */
    private function getUmkm()
    {
        $umkm = auth()->user()->umkm;

        abort_if(
            !$umkm,
            404,
            'Profil UMKM belum tersedia.'
        );

        abort_if(
            $umkm->status !== 'approved',
            403,
            'UMKM belum diverifikasi.'
        );

        return $umkm;
    }

    /**
     * Menampilkan daftar produk milik UMKM.
     */
    public function index()
    {
        $umkm = $this->getUmkm();

        $products = $umkm->products()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view(
            'umkm.products.index',
            compact('products')
        );
    }

    /**
     * Form tambah produk.
     */
    public function create()
    {
        $this->getUmkm();

        $categories = Category::orderBy('name')->get();

        return view(
            'umkm.products.create',
            compact('categories')
        );
    }

    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request)
    {
        $umkm = $this->getUmkm();

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Data otomatis
        |--------------------------------------------------------------------------
        */

        $validated['umkm_id'] = $umkm->id;

        $validated['slug'] = Str::slug($validated['name'])
            . '-' . Str::lower(Str::random(6));

        $validated['status'] = 'aktif';

        $validated['sold'] = 0;

        /*
        |--------------------------------------------------------------------------
        | Upload gambar
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan produk
        |--------------------------------------------------------------------------
        */

        Product::create($validated);

        return redirect()
            ->route('umkm.products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan.'
            );
    }

    /**
     * Detail produk.
     */
    public function show(Product $produk)
    {
        $this->authorizeProduct($produk);

        $produk->load('category');

        $product = $produk;

        return view(
            'umkm.products.show',
            compact('product')
        );
    }

    /**
     * Form edit produk.
     */
    public function edit(Product $produk)
    {
        $this->authorizeProduct($produk);

        $categories = Category::orderBy('name')->get();

        $product = $produk;

        return view(
            'umkm.products.edit',
            compact('product', 'categories')
        );
    }

    /**
     * Update produk.
     */
    public function update(
        Request $request,
        Product $produk
    ) {
        $this->getUmkm();

        $this->authorizeProduct($produk);

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'in:aktif,nonaktif',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ganti gambar
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if ($produk->image) {
                Storage::disk('public')->delete(
                    $produk->image
                );
            }

            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = Str::slug($validated['name'])
            . '-' . Str::lower(Str::random(6));

        $produk->update($validated);

        return redirect()
            ->route('umkm.products.index')
            ->with(
                'success',
                'Produk berhasil diperbarui.'
            );
    }

    /**
     * Hapus produk.
     */
    public function destroy(Product $produk)
    {
        $this->getUmkm();

        $this->authorizeProduct($produk);

        if ($produk->image) {
            Storage::disk('public')->delete(
                $produk->image
            );
        }

        $produk->delete();

        return redirect()
            ->route('umkm.products.index')
            ->with(
                'success',
                'Produk berhasil dihapus.'
            );
    }

    /**
     * Memastikan produk milik UMKM yang sedang login.
     */
    private function authorizeProduct(Product $product): void
    {
        abort_if(
            $product->umkm_id !== auth()->user()->umkm?->id,
            403,
            'Kamu tidak memiliki akses ke produk ini.'
        );
    }
}