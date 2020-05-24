<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderStoreRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request){
        $order=  Order::create([
            'customer_id'=>$request->customer_id,
            'user_id'=>auth()->user()->id,
            ]);
            $cart=auth()->user()->cart()->get();
            foreach($cart as $item){
                $order->items()->create([
                    'price' => $item->price,
                    'quantity' => $item->pivot->quantity,
                    'product_id' => $item->id,
                ]);
                $item->quantity = $item->quantity - $item->pivot->quantity;
                $item->save();
            }
            auth()->user()->cart()->detach();
            $order->payments()->create([
                'amount' => $request->amount,
                'user_id'=>auth()->user()->id
            ]);
            return 'success';
    }
}
