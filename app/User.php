<?php

namespace App;

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
    
    public function carts(){
        return $this->hasMany(UserCart::class,'user_id');
     }

    public function getAvatar(){
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }
}
