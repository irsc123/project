<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // كل الأقسام
        $categories = Category::all();

        // الأقسام مع 5 منتجات لكل واحد
        $categoriesWithProducts = Category::with(['products' => function($q) {
            $q->latest()->take(5);
        }])->get();

        // الأكثر مبيعاً
        $bestSellers = Product::where('is_best_seller', 1)
                              ->latest()
                              ->take(8)
                              ->get();

        // الخصومات
        $discountProducts = Product::whereNotNull('discount_price')
                                   ->latest()
                                   ->take(8)
                                   ->get();

        return view('welcome', compact('categories', 'categoriesWithProducts', 'bestSellers', 'discountProducts'));
    }
}
