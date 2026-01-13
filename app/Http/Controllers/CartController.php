<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems()->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::findOrFail($request->product_id);
            
            // Check stock
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng sản phẩm không đủ. Còn lại: ' . $product->stock,
                ], 400);
            }
            
            $price = $product->sale_price ?? $product->price;

            // Prepare cart item data
            $whereConditions = [
                'product_id' => $product->id,
            ];
            
            if (Auth::check()) {
                $whereConditions['user_id'] = Auth::id();
                $whereConditions['session_id'] = null;
            } else {
                $whereConditions['user_id'] = null;
                $whereConditions['session_id'] = session()->getId();
            }

            // Check if item already exists
            $existingItem = CartItem::where($whereConditions)->first();
            
            if ($existingItem) {
                // Update quantity
                $newQuantity = $existingItem->quantity + $request->quantity;
                if ($newQuantity > $product->stock) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Số lượng vượt quá tồn kho. Tồn kho: ' . $product->stock,
                    ], 400);
                }
                $existingItem->update([
                    'quantity' => $newQuantity,
                    'price' => $price,
                ]);
            } else {
                // Create new item
                CartItem::create([
                    'user_id' => Auth::id(),
                    'session_id' => Auth::check() ? null : session()->getId(),
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'price' => $price,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Đã thêm vào giỏ hàng',
                'cart_count' => $this->getCartCount(),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = $this->getCartItems()->where('id', $id)->firstOrFail();
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Đã cập nhật giỏ hàng',
        ]);
    }

    public function remove($id)
    {
        $cartItem = $this->getCartItems()->where('id', $id)->firstOrFail();
        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa khỏi giỏ hàng',
        ]);
    }

    public function clear()
    {
        $this->getCartItems()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa toàn bộ giỏ hàng',
        ]);
    }

    private function getCartItems()
    {
        $query = CartItem::with('product.images');
        
        if (Auth::check()) {
            return $query->where('user_id', Auth::id());
        }

        return $query->where('session_id', session()->getId());
    }

    private function getCartCount()
    {
        return $this->getCartItems()->sum('quantity') ?? 0;
    }
}
