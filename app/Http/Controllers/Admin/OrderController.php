<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderStoreRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request){
        $orders=new Order();
        if($request->start_date){
            $orders=$orders->where('created_at','>=',$request->start_date);
        }
        if($request->end_date){
            $orders=$orders->where('created_at','<=',$request->end_date);
        }
        $orders=$orders->with(['items','payments','customer'])->latest()->paginate(10);
        $total=$orders->map(function ($o){
            return $o->total();
        })->sum();
        $receicedAmount=$orders->map(function ($o){
            return $o->receivedAmount();
        })->sum();
        return view('admin.pages.orders.index',compact('orders','total','receicedAmount'));
    }
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
