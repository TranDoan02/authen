<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = new Review();
        $review->product_id = $validated['product_id'];
        $review->user_id = Auth::id(); // Will be null for guests
        $review->name = $validated['name'];
        $review->phone = $validated['phone'];
        $review->rating = $validated['rating'];
        $review->comment = $validated['comment'];
        $review->is_approved = false; // Requires admin approval
        $review->save();

        return response()->json([
            'success' => true,
            'message' => 'Cảm ơn bạn đã đánh giá! Đánh giá của bạn đang được chờ kiểm duyệt.'
        ]);
    }
}
