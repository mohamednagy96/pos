<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['customer_id','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class,'order_id');
    }
}
