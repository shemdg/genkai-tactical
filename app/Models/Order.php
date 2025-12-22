<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use hasFactory;

    protected $casts = [
        'payment_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper method to check if payment is verified
    public function isPaymentVerified()
    {
        return $this->payment_status === 'verified';
    }

    // Helper method to get payment status badge
    public function getPaymentStatusBadge()
    {
        return match($this->payment_status) {
            'verified' => '<span class="badge bg-success">Verified</span>',
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'failed' => '<span class="badge bg-danger">Failed</span>',
            default => '<span class="badge bg-brand-secondary">Unknown</span>',
        };
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'GK-' . strtoupper(uniqid());
        });
    }
}
