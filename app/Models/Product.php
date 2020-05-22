<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
   use HasMediaTrait;
   protected $fillable=['name','description','image','barcode','price','status']; 

   public function getImage($collection='products'){
   return  $this->getFirstMedia($collection) ? $this->getFirstMedia($collection)->getUrl() : null ;
   }

}
