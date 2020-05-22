@extends('layouts.admin')
@section('title','Create Customer')
@section('content-header','Create Customer')
@section('content')
{!! Form::open(['route'=>'customers.store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
@include('admin.pages.customers.form')
@endsection