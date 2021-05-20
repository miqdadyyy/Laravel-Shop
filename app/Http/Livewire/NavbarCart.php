<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Traits\CartHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class NavbarCart extends Component
{
    use CartHelper;
    public $cart;

    protected $listeners = [
        'add-item-to-cart' => 'addItemToCart'
    ];

    public function mount()
    {
        $this->cart = $this->findCart();
    }

    public function clearCart(){
        $this->cart->details()->delete();
        $this->cart = $this->findCart();
        $this->emit('show-success', 'Clear cart successfully');
    }

    public function addItemToCart($product_id)
    {
        if (!Product::find($product_id)) return $this->emit('show-error', 'Product ID Not found');

        $productDetail = $this->cart->details->where('product_id', $product_id)->first();
        if ($productDetail) {
            $productDetail->update([
                'quantity' => $productDetail->quantity + 1
            ]);
        } else {
            $this->cart->details()->create([
                'product_id' => $product_id,
                'quantity' => 1
            ]);
        }

        $this->cart = $this->findCart();

        return $this->emit('show-success', 'Product added to cart success');
    }

    public function render()
    {
        return view('livewire.navbar-cart');
    }
}
