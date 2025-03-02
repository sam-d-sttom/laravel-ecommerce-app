<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        "name",
        "description",
        "price",
        "stock",
        "category_id",
        "sub_category_id",
    ];


    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function cartitem()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }
}
