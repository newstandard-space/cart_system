<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function order_purchase_address()
    {
        return $this->hasOne(OrderPurchaseAddress::class);
    }

    public function order_shipping_address()
    {
        return $this->hasOne(OrderShippingAddress::class);
    }
}
