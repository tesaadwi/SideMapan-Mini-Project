<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['umkm', 'category'])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->whereHas('umkm', function ($q) {
                $q->where('status', 'approved');
            });

        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->category_id
            );
        }

        if ($request->sort === 'termurah') {

            $query->orderBy('price', 'asc');

        } elseif ($request->sort === 'termahal') {

            $query->orderBy('price', 'desc');

        } else {

            $query->latest();

        }

        $products = $query
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'pembeli.marketplace.index',
            compact('products', 'categories')
        );
    }

    public function show($slug)
    {
        $product = Product::with(['umkm', 'category'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->whereHas('umkm', function ($q) {
                $q->where('status', 'approved');
            })
            ->firstOrFail();

        return view(
            'pembeli.marketplace.show',
            compact('product')
        );
    }
}