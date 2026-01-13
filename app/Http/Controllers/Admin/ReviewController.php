<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with('product');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('comment', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_approved', $request->status == 'approved');
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $reviews = $query->latest()->paginate(20);
        $products = Product::select('id', 'name')->get();

        return view('admin.reviews.index', compact('reviews', 'products'));
    }

    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'is_approved' => 'boolean',
        ]);

        $review->update($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Đánh giá đã được cập nhật thành công');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Đánh giá đã được xóa');
    }

    public function toggleApproval(Review $review)
    {
        $review->is_approved = !$review->is_approved;
        $review->save();

        return back()->with('success', $review->is_approved ? 'Đã duyệt đánh giá' : 'Đã ẩn đánh giá');
    }

    public function bulkCreate()
    {
        $products = Product::select('id', 'name')->get();
        return view('admin.reviews.bulk-create', compact('products'));
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'reviews' => 'required|array|min:1',
            'reviews.*.name' => 'required|string|max:255',
            'reviews.*.rating' => 'required|integer|min:1|max:5',
            'reviews.*.comment' => 'required|string|max:1000',
            'reviews.*.created_at' => 'nullable|date',
        ]);

        foreach ($request->reviews as $reviewData) {
            Review::create([
                'product_id' => $request->product_id,
                'name' => $reviewData['name'],
                'rating' => $reviewData['rating'],
                'comment' => $reviewData['comment'],
                'is_approved' => true,
                'phone' => '09' . rand(10000000, 99999999), // Mock phone
                'created_at' => $reviewData['created_at'] ?? now(),
            ]);
        }

        return redirect()->route('admin.reviews.index')->with('success', 'Đã tạo hàng loạt đánh giá thành công');
    }
}
