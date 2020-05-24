<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\MediaService;
use Illuminate\Http\Request;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers=Customer::latest()->paginate(10);
        if($request->wantsJson()){
            $customers=Customer::all();
            return $customers;
        }
        return view('admin.pages.customers.index',compact('customers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.customers.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $request=$request->all();
        $request['user_id']=auth()->user()->id;
        // $request['image']=$image_path;
        $customer=Customer::create($request);
        if(isset($request['avatar'])){
            MediaService::uploadFile($request['avatar'],$customer,'customers');
        }
        if (!$customer) {
            return redirect()->back()->with('error', 'Sorry, there a problem while creating customer.');
        }
        return redirect()->route('customers.index')->with('success', 'Success, you customer have been created.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.pages.customers.edit',compact('customer'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerStoreRequest $request, Customer $customer)
    {
        $request=$request->all();
        $customer->update($request);
        if(isset($request['avatar'])){
            MediaService::updateFile($request['avatar'],$customer,'customers');
        }
        if (!$customer) {
            return redirect()->back()->with('error', 'Sorry, there a problem while updating customer.');
        }
        return redirect()->route('customers.index')->with('success', 'Success, Your customer have been Updated.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Success, Your Customer is Deleted.');
    }
}
