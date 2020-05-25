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

    
    public function getCustomerName(){
        if($this->customer){
            return $this->customer->first_name .' ' . $this->customer->last_name ;
           }
        return 'walking Customer';
    }

    public function total(){
        return $this->items->map(function ($i){
            return $i->price;
        })->sum();
    }

    public function formattedTotal(){
        return number_format($this->total(),2);
    }

    public function receivedAmount(){
        return $this->payments->map(function ($p){
            return $p->amount;
        })->sum();
    }

    public function formattedReceiveAmount(){
        return number_format($this->receivedAmount(),2);
    }
}