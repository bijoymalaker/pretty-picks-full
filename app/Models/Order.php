<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'amount',
        'address',
        'status',
        'transaction_id',
        'currency',
    ];

    // Accessor for formatted total
    public function getFormattedTotalAttribute()
    {
        return '৳ ' . number_format($this->total_amount ?? $this->amount, 2);
    }

    // Accessor for formatted date
    public function getFormattedDateAttribute()
    {
        return $this->created_at ? $this->created_at->format('d M Y, H:i') : now()->format('d M Y, H:i');
    }

    // Scope for pending orders
    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    // Scope for completed orders
    public function scopeCompleted($query)
    {
        return $query->where('status', 'Complete');
    }
}
