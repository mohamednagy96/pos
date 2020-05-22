<div class="card">
    <div class="card-body">
            {{-- <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="Name" value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}

            <div class="form-group">
                <label for="name">Name</label>
            {{ Form::text('name', null , ['class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' )]) }}
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                {{ Form::textarea('description', null , ['class' => 'form-control','style'=>'resize:none','rows'=>3]) }}
            </div>
            @if($product)
            <div class="row">
                <div class="col-md-2" >
                    <label for="image">Image</label>
                    <div class="form-group">
                    <img src="{{$product->getImage()}} "width="200">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group" style="margin-top:12%">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            @else
            <div class="form-group">
                <label for="image">Image</label>
                <div class="custom-file">
                <input type="file" class="custom-file-input" name="image" id="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            @endif
            <div class="form-group">
                <label for="barcode">BarCode</label>
                {{ Form::text('barcode', null , ['class' => 'form-control','placeholder'=>'لآarcode']) }}
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                {{ Form::text('price', null , ['class' => 'form-control','placeholder'=>'price']) }}
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                {{ Form::text('quantity', null , ['class' => 'form-control','placeholder'=>'quantity']) }}
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                    @if($product)
                    <option value="1" {{ old('status', $product->status) === 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ old('status', $product->status) === 0 ? 'selected' : ''}}>Inactive</option>
                    @else
                    <option value="1" {{ old('status') === 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ old('status') === 0 ? 'selected' : ''}}>Inactive</option>
                    @endif
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">{{isset($product) ? 'Update' : 'Create'}}</button>
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