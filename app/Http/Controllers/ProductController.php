<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('products')->get();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function show(Product $product)
    {
        $product->load('category');

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function category(Category $category)
    {
        $products = $category->products()
            ->with('category')
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('products')->get();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category,
        ]);
    }
}
