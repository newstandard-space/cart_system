<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPurchaserAddress extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected $fillable = [
        'order_id',
        'name',
        'name_kana',
        'postal_code',
        'address_1',
        'address_2',
        'phone_number',
        'email_address',
    ];
}
