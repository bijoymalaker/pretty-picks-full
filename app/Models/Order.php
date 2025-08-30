<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'billing_info',
        'shipping_info',
        'payment_method',
        'order_notes',
        'total_amount',
        'items',
        'status'
    ];

    protected $casts = [
        'billing_info' => 'array',
        'shipping_info' => 'array',
        'items' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }

    public function getFormattedTotalAttribute()
    {
        return '৳ ' . number_format($this->total_amount, 2);
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('F j, Y');
    }
}
