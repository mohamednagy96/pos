<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request){
        if($request->wantsJson()){
            return response(
                $request->user()->cart()->get()
            );
        }
        return view('admin.pages.carts.index');
    }

    public function store(Request $request){
        $request->validate([
            'barcode'=>'required|exists:products,barcode',
        ]);
        $barcode=$request->barcode;
       $cart = $request->user()->cart()->whereBarcode($barcode)->first();
       if($cart){
           //update only quantity
           $cart->pivot->quantity = $cart->pivot->quantity + 1;
           $cart->pivot->save();
       }else{
           $product=Product::whereBarcode($barcode)->first();
           $request->user()->cart()->attach($product->id,['quantity'=>1]);
        }
        return response('',204);
        // dd($product);
    }
}
