<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('products')->get();

        return view('home', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
        ]);
    }
}
