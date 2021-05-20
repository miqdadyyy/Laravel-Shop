<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function stripePaymentSuccess(Request $request){
        $data = $request->get('data')['object'];
        $id = $data['payment_intent'];
        \Log::info($data);
        $order = Order::where('stripe_payment_id', $id)->first();
        if($order){
            $order->update([
                'paid_at' => Carbon::now(),
                'stripe_receipt_url' => $data['receipt_url'],
                'stripe_receipt_number' => $data['receipt_number'],
            ]);
        }
    }
}
