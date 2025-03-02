<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        "user_id",
        'name',
        "email",
        "phone",
        "address",
        "payment_method",
        "total_amount",
        "order_status",

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }
}
