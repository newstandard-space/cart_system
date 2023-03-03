<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function item_stock()
    {
        return $this->hasOne(ItemStock::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function item_images()
    {
        return $this->hasMany(ItemImage::class);
    }
}
