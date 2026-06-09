<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with(['product', 'user'])->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();
        return back()->with('success', 'Yorum silindi.');
    }
}
