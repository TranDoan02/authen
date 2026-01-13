<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        
        // Merge guest cart to user cart
        $this->mergeGuestCart();

        return redirect('/')->with('success', 'Đăng ký thành công!');
    }
    
    /**
     * Merge guest cart items to user cart after registration
     */
    private function mergeGuestCart()
    {
        $sessionId = session()->getId();
        $userId = Auth::id();
        
        if (!$userId) {
            return;
        }
        
        // Get guest cart items
        $guestCartItems = \App\Models\CartItem::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->get();
        
        foreach ($guestCartItems as $guestItem) {
            // Check if user already has this product in cart
            $userCartItem = \App\Models\CartItem::where('user_id', $userId)
                ->where('product_id', $guestItem->product_id)
                ->first();
            
            if ($userCartItem) {
                // Merge quantities
                $userCartItem->update([
                    'quantity' => $userCartItem->quantity + $guestItem->quantity,
                ]);
                // Delete guest item
                $guestItem->delete();
            } else {
                // Transfer guest item to user
                $guestItem->update([
                    'user_id' => $userId,
                    'session_id' => null,
                ]);
            }
        }
    }
}
