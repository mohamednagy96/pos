<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Customer extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable=[
        'first_name','last_name','email','phone','address','avatar','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orders(){
        return $this->hasMany(Order::class,'customer_id');
    }

    public function getImage($collection='customers'){
        return  $this->getFirstMedia($collection) ? $this->getFirstMedia($collection)->getUrl() : null ;
        }
}
