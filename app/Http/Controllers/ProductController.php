<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('status', true);

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->sort === 'price_asc') {
            $query->orderBy('price');
        } elseif ($request->sort === 'price_desc') {
            $query->orderByDesc('price');
        } else {
            $query->latest();
        }

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::where('status', true)->get();

        return view('frontend.shop', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product  = Product::with('category')->where('slug', $slug)->where('status', true)->firstOrFail();
        $related  = Product::where('category_id', $product->category_id)
                        ->where('id', '!=', $product->id)
                        ->where('status', true)
                        ->take(4)->get();

        return view('frontend.product', compact('product', 'related'));
    }
}
