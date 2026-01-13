<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Merge guest cart to user cart
            $this->mergeGuestCart();
            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            
            // Find or create user
            $localUser = \App\Models\User::firstOrCreate(
                ['email' => $user->getEmail()],
                [
                    'name' => $user->getName(),
                    'password' => bcrypt(str()->random(16)),
                ]
            );

            Auth::login($localUser);
            
            // Merge guest cart to user cart
            $this->mergeGuestCart();
            
            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Đăng nhập Facebook thất bại.');
        }
    }
    
    /**
     * Merge guest cart items to user cart after login
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
