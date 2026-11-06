<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk.
     */
    public function index(Request $request)
    {
        $query = Product::with([
            'umkm',
            'category',
        ]);

        // Pencarian produk
        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Filter kategori
        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->category_id
            );
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Ambil kategori untuk filter
        $categories = Category::orderBy('name')
            ->get();

        return view(
            'admin.products.index',
            compact(
                'products',
                'categories'
            )
        );
    }


    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        // Hanya UMKM yang sudah disetujui
        $umkms = Umkm::where(
            'status',
            'approved'
        )
            ->orderBy('name')
            ->get();

        // Ambil semua kategori
        $categories = Category::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        return view(
            'admin.products.create',
            compact(
                'categories',
                'umkms'
            )
        );
    }


    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'umkm_id' => [
                'required',
                'exists:umkms,id',
            ],

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
                'in:active,inactive',
            ],
        ]);


        // Generate slug unik
        $validated['slug'] =
            Str::slug($validated['name'])
            . '-'
            . Str::lower(Str::random(6));


        // Nilai awal produk terjual
        $validated['sold'] = 0;


        // Upload gambar
        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );
        }


        // Simpan produk
        Product::create($validated);


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail produk.
     */
    public function show(Product $product)
    {
        $product->load([
            'umkm',
            'category',
        ]);

        return view(
            'admin.products.show',
            compact('product')
        );
    }


    /**
     * Menampilkan form edit produk.
     */
    public function edit(Product $product)
    {
        // UMKM yang sudah disetujui
        $umkms = Umkm::where(
            'status',
            'approved'
        )
            ->orderBy('name')
            ->get();

        // Kategori aktif
        $categories = Category::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories',
                'umkms'
            )
        );
    }


    /**
     * Memperbarui produk.
     */
    public function update(
        Request $request,
        Product $product
    ) {
        $validated = $request->validate([
            'umkm_id' => [
                'required',
                'exists:umkms,id',
            ],

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
                'in:active,inactive',
            ],
        ]);


        // Jika upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if (
                $product->image &&
                Storage::disk('public')->exists(
                    $product->image
                )
            ) {
                Storage::disk('public')->delete(
                    $product->image
                );
            }


            // Simpan gambar baru
            $validated['image'] = $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );
        }


        // Generate slug baru
        $validated['slug'] =
            Str::slug($validated['name'])
            . '-'
            . Str::lower(Str::random(6));


        // Update produk
        $product->update($validated);


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil diperbarui.'
            );
    }


    /**
     * Menghapus produk.
     */
    public function destroy(Product $product)
    {
        // Hapus gambar produk
        if (
            $product->image &&
            Storage::disk('public')->exists(
                $product->image
            )
        ) {
            Storage::disk('public')->delete(
                $product->image
            );
        }


        // Hapus produk
        $product->delete();


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil dihapus.'
            );
    }
}