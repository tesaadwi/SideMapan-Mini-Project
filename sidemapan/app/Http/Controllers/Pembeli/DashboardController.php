<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::with(['umkm', 'category'])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->whereHas('umkm', function ($query) {
                $query->where('status', 'approved');
            })
            ->latest()
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('pembeli.dashboard', compact(
            'products',
            'categories'
        ));
    }
}
