<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(CartDetail::class, 'cart_id');
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->details as $detail) $total += $detail->subtotal;
        return $total;
    }
}
