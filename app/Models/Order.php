<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    public const PAYMENT_METHOD_PAYPAL = 1;
    public const PAYMENT_METHOD_STRIPE = 2;

    protected $fillable = [
        'user_id',
        'invoice',
        'payment_method_code',
        'stripe_payment_id',
        'stripe_receipt_id',
        'stripe_receipt_url',
        'paid_at'
    ];

    protected $dates = [
        'paid_at'
    ];

    public function getStatusAttribute(){
        return $this->paid_at ? 'paid' : 'pending';
    }

    public function getPaymentMethodAttribute()
    {
        if ($this->payment_method_code === self::PAYMENT_METHOD_PAYPAL) {
            return 'paypal';
        } else if ($this->payment_method_code === self::PAYMENT_METHOD_STRIPE) {
            return 'stripe';
        } else {
            return 'undefined';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function getTotalAttribute()
    {
        return $this->details
            ->map(function (OrderDetail $order_detail) {
                return $order_detail->subtotal;
            })->sum();
    }

    public static function generateInvoiceID()
    {
        do {
            $invoice = "INV-" . Str::upper(Str::random(8));
        } while (Order::where('invoice', $invoice)->first());
        return $invoice;
    }

    public static function castPaymentMethod($method){
        if ($method === 'paypal') return self::PAYMENT_METHOD_PAYPAL;
        if ($method === 'stripe') return self::PAYMENT_METHOD_STRIPE;
        return null;
    }
}
