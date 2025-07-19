<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    protected $fillable = ['order_id', 'user_id', 'reason','note','image',  'status','response_note'];
public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}

public function variant()
{
    return $this->belongsTo(ProductVariant::class);
}

}
