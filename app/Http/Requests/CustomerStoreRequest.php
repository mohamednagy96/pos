<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
        $customer=Request()->customer;
        $id='';
        if($customer){
            $id=$customer->id;
        }
        return [
            'first_name'=>'required|string|max:20',
            'last_name'=>'required|string|max:20',
            'email'=>"nullable|email|unique:customers,email,{$id}",
            'phone'=>"nullable|unique:customers,phone,{$id}",
            'address'=>'required|string',
            'image'=>'nullable|image',
        ];
    }
}
