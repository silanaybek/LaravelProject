<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders    = Slider::where('status', true)->orderBy('order')->get();
        $categories = Category::where('status', true)->withCount('products')->get();
        $featured   = Product::where('featured', true)->where('status', true)->take(8)->get();
        $latest     = Product::where('status', true)->latest()->take(8)->get();

        return view('frontend.home', compact('sliders', 'categories', 'featured', 'latest'));
    }
}
