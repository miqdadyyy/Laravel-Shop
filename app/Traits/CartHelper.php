<?php


namespace App\Traits;


use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

trait CartHelper
{
    private function getCartSession()
    {
        $session = Session::get('cart_session');
        if (!$session) {
            $session = Str::random(32);
            Session::put('cart_session', $session);
        }
        return $session;
    }

    protected function findCart()
    {
        if (Auth::guest()) {
            return Cart::with('details.product.category')->where('session_id', $this->getCartSession())
                ->firstOrCreate([
                    'session_id' => $this->getCartSession()
                ]);
        } else {
            $cart = Cart::with('details.product.category')
                ->where('session_id', $this->getCartSession())
                ->first();
            if ($cart) {
                $cart->update([
                    'session_id' => null,
                    'user_id' => Auth::id()
                ]);
            } else {
                $cart = Cart::with('details.product.category')
                    ->where('user_id', Auth::id())
                    ->firstOrCreate([
                        'user_id' => Auth::id()
                    ]);
            }
            return $cart;
        }
    }
}
