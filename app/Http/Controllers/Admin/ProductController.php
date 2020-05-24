<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\MediaService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        //   $products=Product::find(5);
        // return $products->getImage();
        $products =new Product();
        if($request->search){
            $products = $products->where('name', 'LIKE', "%{$request->search}%")->get();
            return ProductResource::collection($products);
        }
        $products=Product::latest()->paginate(10);
        if($request->wantsJson()){
            return ProductResource::collection($products);
        }
        return view('admin.pages.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        /** to store image */

        // $image_path='';
        // if($request->hasFile('image')){
        //     $image_path=$request->file('image')->store('images/products');
        // }

        /**to retreive it use Storage::url  */
        // <td><img src="{{Storage::url($product->image)}} "width="100"></td> --}}

        $request=$request->all();
        // $request['image']=$image_path;
        $product=Product::create($request);
        if(isset($request['image'])){
            MediaService::uploadFile($request['image'],$product,'products');
        }
        if (!$product) {
            return redirect()->back()->with('error', 'Sorry, there a problem while creating product.');
        }
        return redirect()->route('products.index')->with('success', 'Success, you product have been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.pages.products.edit',compact('product'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $request=$request->all();
        $product->update($request);
        /**update image by storage */
        // if ($request->hasFile('image')) {
        //     // Delete old image
        //     if ($product->image) {
        //         Storage::delete($product->image);
        //     }
        //     // Store image
        //     $image_path = $request->file('image')->store('products');
        //     // Save to Database
        //     $product->image = $image_path;
        // }

        if(isset($request['image'])){
            MediaService::updateFile($request['image'],$product,'products');
        }
        if (!$product) {
            return redirect()->back()->with('error', 'Sorry, there a problem while updating product.');
        }
        return redirect()->route('products.index')->with('success', 'Success, Your Product have been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Success, Your Product is Deleted.');
    }
}
