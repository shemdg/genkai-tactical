<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use hasFactory;

    protected $casts = [
      'total' => 'decimal:2'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'GK-' . strtoupper(uniqid());
        });
    }
}
