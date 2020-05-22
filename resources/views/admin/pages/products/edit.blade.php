@extends('layouts.admin')
@section('title','Create Product')
@section('content-header','Update Product')
@section('content')
{!! Form::model($product,['route'=>['products.update',$product->id],'method'=>'PUT','enctype'=>'multipart/form-data'])!!}
@include('admin.pages.products.form')
@endsection