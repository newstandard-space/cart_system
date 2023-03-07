<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function order_purchase_addresses()
    {
        return $this->hasOne(OrderPurchaseAddress::class);
    }

    public function order_shipping_addresses()
    {
        return $this->hasOne(OrderShippingAddress::class);
    }

    protected $fillable = [
        'order_custom_id',
        'user_id',
        'payment_method_id',
        'total_price',
        'shipping_fee',
        'handling_fee',
    ];
}
