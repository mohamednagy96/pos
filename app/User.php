<?php

namespace App;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullName(){
        return $this->first_name.' '.$this->last_name;
    }
    
    public function cart(){
        return $this->belongsToMany(Product::class,'user_carts')->withPivot('quantity');
     }

     public function customers(){
        return $this->hasMany(Customer::class,'user_id');
     }

     public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class,'user_id');
    }

    public function getAvatar(){
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }
}
