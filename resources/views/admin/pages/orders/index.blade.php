@inject('media', 'App\Services\MediaService')
@extends('layouts.admin')
@section('title','Order List')
@section('content-header','Order List')
@section('content-actions')
<a href="{{route('cart.index')}}" class="btn btn-primary">Open POS</a>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-md-7"></div>
            <div class="col-md-5">
                <form action="{{route('orders.index')}}" method="get">
                    <div class="row">
                        <div class="col-md-5">
                            <label>start date</label>
                        <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" >  
                        </div>
                        <div class="col-md-5">
                            <label>end date</label>

                        <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}">
                        </div>
                        <div>
                            <button class="btn btn-outline-primary">Submit</button>
                        </div>

                    </div> 
                </form>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th >Toal</th>
                    <th >Received Amount</th>
                    <th >status</th>
                    <th >To Pay</th>
                    <th>Created At</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>{{ config('settings.currency_symbol')}} {{$order->formattedTotal()}}</td>
                    <td>{{ config('settings.currency_symbol')}} {{$order->formattedReceiveAmount()}}</td>
                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">Not Paid</span>
                        @elseif($order->receivedAmount() < $order->Total() )
                           <span class="badge badge-warning">Partial</span>
                        @elseif($order->receivedAmount() == $order->Total() )
                            <span class="badge badge-success">Paid</span>
                        @elseif($order->receivedAmount() > $order->Total() )
                            <span class="badge badge-info">Change</span>
                            
                        @endif
                    </td>
                    <td>{{ config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount() , 2)}}</td>
                    <td>{{$order->created_at ? $order->created_at->diffForHumans() : null }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <th></th>
                <th></th>
                <th>{{ config('settings.currency_symbol')}} {{number_format($total,2)}}</th>
                <th>{{ config('settings.currency_symbol')}} {{number_format($receicedAmount,2)}}</th>
                <th ></th>
                <th ></th>
                <th></th>
            </tfoot>
        </table>
        {{$orders->links()}}
    </div>
</div>

@endsection
{{-- to make delete with sweet alert     --}}
@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection 