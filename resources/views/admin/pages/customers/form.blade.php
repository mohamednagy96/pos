<div class="card">
    <div class="card-body">
            <div class="form-group">
                <label for="first_name">First Name</label>
            {{ Form::text('first_name', null , ['class' => 'form-control' . ( $errors->has('first_name') ? ' is-invalid' : '' ),'id'=>'first_name']) }}
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
            {{ Form::text('last_name', null , ['class' => 'form-control' . ( $errors->has('last_name') ? ' is-invalid' : '' ),'id'=>'last_name']) }}
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
            {{ Form::email('email', null , ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ),'id'=>'email']) }}
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
            {{ Form::text('phone', null , ['class' => 'form-control' . ( $errors->has('phone') ? ' is-invalid' : '' ),'id'=>'phone']) }}
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
 
            <div class="form-group">
                <label for="address">Address</label>
            {{ Form::text('address', null , ['class' => 'form-control' . ( $errors->has('address') ? ' is-invalid' : '' ),'id'=>'address']) }}
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            @if(isset($customer))
            <div class="row">
                <div class="col-md-2" >
                    <label for="avatar">Avatar</label>
                    <div class="form-group">
                    <img src="{{$customer->getImage() != null ? $customer->getImage() : asset('images/default.jpg')}} "width="200">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group" style="margin-top:12%">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="avatar" id="avatar">
                            <label class="custom-file-label" for="avatar">Choose file</label>
                        </div>
                        @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            @else
            <div class="form-group">
                <label for="avatar">avatar</label>
                <div class="custom-file">
                <input type="file" class="custom-file-input" name="avatar" id="avatar">
                    <label class="custom-file-label" for="avatar">Choose file</label>
                </div>
                @error('avatar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            @endif
           
            <button class="btn btn-primary" type="submit">{{isset($customer) ? 'Update' : 'Create'}}</button>
    </div>
</div>

@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>

@endsection