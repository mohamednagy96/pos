@inject('media', 'App\Services\MediaService')
@extends('layouts.admin')
@section('content-header','Product List')
@section('content-actions')
<a href="{{route('products.create')}}" class="btn btn-primary">Create Product</a>
@endsection
{{-- css for sweet alert for delete --}}
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
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
                    <th>Quantity</th>
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
                    <td>
                    <img src= "{{ $media->getImage($product,'products')  != null ? $media->getImage($product,'products')  : asset('images/default.jpg')}} "width="100">

                    {{-- <img src="{{$product->getImage() != null ? $product->getImage() : asset('images/default.jpg')}} "width="100"> --}}
                    </td>
                    <td>{{$product->barcode}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                    <span class="badge badge-{{$product->status == 1 ? 'success' : 'dark'}}"> {{$product->status == 1 ? 'Active' : 'In-Active'}}</span>
                    </td>

                    {{-- <td>
                    @if( $product->status == 1 )
                        <span class="badge badge-success">Active</span>
                    @else
                       <span class="badge badge-dark">In-Active</span>
                    @endif
                    </td> --}}
                    <td>{{$product->created_at ? $product->created_at->diffForHumans() : null }}</td>
                    <td>{{$product->updated_at ? $product->updated_at->diffForHumans() : null }}</td>
                    <td>
                        <a href="{{route('products.edit',$product)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        {{-- <a href="{{route('products.show',$product)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a> --}}
                        <button class="btn btn-danger btn-delete" data-url="{{route('products.destroy', $product)}}"><i
                            class="fas fa-trash"></i></button>           
                    </td>        
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    </div>
</div>

@endsection
{{-- to make delete with sweet alert     --}}
@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>

    $(document).ready(function () {
        $(document).on('click', '.btn-delete', function () {
            $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this product?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                        $this.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection 