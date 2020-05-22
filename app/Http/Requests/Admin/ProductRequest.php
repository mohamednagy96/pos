<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id=Request()->product->id;
        // dd($id);
        return [
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'image'=>'nullable|image',
            'barcode'=>"required|string|max:50|unique:products,barcode,{$id}",
            'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'status'=>'required|boolean',
        ];
    }
}
