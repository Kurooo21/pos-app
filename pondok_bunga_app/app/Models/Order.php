<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'table_name',
        'total_price',
        'paid_amount',
        'change_amount',
        'status',
        'payment_method'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
