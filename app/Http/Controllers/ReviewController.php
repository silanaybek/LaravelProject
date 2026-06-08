<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $slug)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        $existing = ProductReview::where('product_id', $product->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            $existing->update(['rating' => $request->rating, 'comment' => $request->comment]);
        } else {
            ProductReview::create([
                'product_id' => $product->id,
                'user_id'    => auth()->id(),
                'rating'     => $request->rating,
                'comment'    => $request->comment,
            ]);
        }

        return back()->with('success', 'Değerlendirmeniz kaydedildi.');
    }
}
