@extends('layouts.admin')
@section('title','Create Customer')
@section('content-header','Update Customer')
@section('content')
{!! Form::model($customer,['route'=>['customers.update',$customer->id],'method'=>'PUT','enctype'=>'multipart/form-data'])!!}
@include('admin.pages.customers.form')
@endsection