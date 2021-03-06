<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=['amount','order_id','user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
