<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected $fillable = [
        'order_id',
        'item_id',
        'product_id',
        'original_quantity',
        'quantity',
        'total_price',
        'phone_number',
        'price_per_item',
        'consumption_tax_per_item',
    ];
}