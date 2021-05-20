<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.cart');
    }

    public function checkout(Request $request){
        $this->validate($request, [
            'payment' => 'required|in:paypal,stripe'
        ]);

        try {
            DB::beginTransaction();
            $cart = Cart::with('details')->where('user_id', Auth::id())->first();
            $paymentMethod = $request->get('payment');

            $order = Order::create([
                'user_id' => Auth::id(),
                'invoice' => Order::generateInvoiceID(),
                'payment_method_code' => Order::castPaymentMethod($paymentMethod),
            ]);

            foreach ($cart->details as $item){
                $quantity = $item->quantity;
                if($item->product->stock < $quantity) throw new \Exception("Quantity of Product {$item->product->name} is not enough");

                $order->details()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $quantity,
                    'price' => $item->product->price
                ]);

                $item->product->stock = $item->product->stock - $quantity;
                $item->product->save();
            }

            switch ($paymentMethod){
                case 'stripe' : {
                    $charge = Auth::user()->charge($order->total * 100, $request->get('payment_id'));
                    $order->update([
                        'stripe_payment_id' => $charge->asStripePaymentIntent()->id
                    ]);
                }
            }

            $cart->delete();
            DB::commit();

            return redirect()->route('member.transaction.index');
        } catch (\Exception $exception){
            DB::rollBack();
            dd($exception);
        }
    }
}
