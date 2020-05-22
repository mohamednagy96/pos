@extends('layouts.admin')
@section('content-header','Customer List')
@section('content-actions')
<a href="{{route('customers.create')}}" class="btn btn-primary">Create Customer</a>
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
                    <th>Avatar</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    {{-- <th>User</th> --}}
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>
                        <img src="{{$customer->getImage() != null ? $customer->getImage() : asset('images/default.jpg')}} "width="50">
                    </td>
                    <td>{{$customer->first_name}}</td>
                    <td>{{$customer->last_name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->address}}</td>
                    {{-- <td>{{$customer->user_id}}</td> --}}
                    <td>{{$customer->created_at ? $customer->created_at->diffForHumans() : null }}</td>
                    <td>
                        <a href="{{route('customers.edit',$customer)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        {{-- <a href="{{route('customers.show',$customer)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a> --}}
                        <button class="btn btn-danger btn-delete" data-url="{{route('customers.destroy', $customer)}}"><i
                            class="fas fa-trash"></i></button>           
                    </td>        
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$customers->links()}}
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
                text: "Do you really want to delete this customer?",
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