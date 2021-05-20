<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Traits\CartHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CartItem extends Component
{
    use CartHelper;

    public $cart;

    public function mount()
    {
        $this->cart = $this->findCart();
    }

    public function addQuantity($productId)
    {
        $item = $this->cart->details->where('product_id', $productId)->first();
        if ($item && $item->quantity < $item->product->stock) {
            $item->quantity = $item->quantity + 1;
            $item->save();
        }
    }

    public function substractQuantity($productId)
    {
        $item = $this->cart->details->where('product_id', $productId)->first();
        if ($item && $item->quantity > 0) {
            $item->quantity = $item->quantity - 1;
            $item->save();
        }
    }

    public function deleteFromCart($productId)
    {
        $this->cart->details->where('product_id', $productId)->first()->delete();
        $this->cart = $this->findCart();
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
