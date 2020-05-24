<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'barcode'=>$this->barcode,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
            'image'=>$this->getImage() != null ? $this->getImage() : asset('images/default.jpg'),
        ];
        // return parent::toArray($request);
    }
}
