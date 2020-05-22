@extends('layouts.admin')
@section('title','Create Product')
@section('content-header','Create Product')
@section('content')
{!! Form::open(['route'=>'products.store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
@include('admin.pages.products.form')
@endsection