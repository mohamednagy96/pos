@extends('layouts.admin')
@section('content-header','Product List')
@section('content-actions')
<a href="{{route('products.create')}}" class="btn btn-primary">Create Product</a>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>BarCode</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td><img src="{{$product->getImage()}} "width="100"></td>
                    <td>{{$product->barcode}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                    @if( $product->status == 1 )
                        <span class="badge badge-success">Active</span>
                    @else
                       <span class="badge badge-dark">In-Active</span>
                    @endif
                    </td>
                    <td>{{$product->created_at ? $product->created_at->diffForHumans() : null }}</td>
                    <td>{{$product->updated_at ? $product->updated_at->diffForHumans() : null }}</td>
                    <td>
                    <a href="{{route('products.edit',$product)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="{{route('products.show',$product)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
        
                     <button class="btn btn-danger" ><i class="fas fa-trash"></i></button>
                    </td>        
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    </div>
</div>

@endsection