@inject('media', 'App\Services\MediaService')
@extends('layouts.admin')
@section('title','Open POS')
@section('content-header','Open POS')
@section('content-actions')
<a href="{{route('customers.create')}}" class="btn btn-primary">Create Customer</a>
@endsection
@section('content')
<div id="cart">
    <div class="row">
        {{-- part number 1 --}}
        <div class="col-md-6 col-lg-4">
            <div class="row mb-2">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Scan Barcode.....">
                </div>
                <div class="col">
                    <select name="" id="" class="form-control">
                        <option value="">walking customer</option>
                    </select>
                </div>
            </div>
            <div class="user-cart">
                <div class="card">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th class="text-right">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Product Name</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm qty" value="1">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                {{-- <td>15</td> --}}
                                <td class="text-right">5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col">
                        Total
                    </div>
                    <div class="col text-right">
                        500
                    </div>
                </div>
                 <div class="row mb-2">
                    <div class="col ">
                        <button type="button" class="btn btn-danger btn-block">Cancel</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-success btn-block">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- part number 2 --}}
        <div class="col-md-6 col-lg-8">
            <div class="mb-2">
                <input type="text" class="input form-control" placeholder="Search Product ... ">
            </div>
            <div class="order-product">
                <div class="item">
                    <img src="http://localhost:8000/storage/1/coca.jpg" alt="..">
                    <h5>Coca</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 