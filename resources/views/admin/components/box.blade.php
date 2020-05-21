<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">
            @if(isset($title))
            {{$title}}
        </h3>
        <div class="box-tools">
            @if(isset($create))
                @if(isset($can))
                    @can($can)
                    <a href="{{$create}}" class="btn btn-primary"><span class="fa fa-plus"></span> Create New</a>
                    @endcan
                @else
                     <a href="{{ $create }}" class="btn btn-primary"><span class="fa fa-plus"></span> Create New</a>
                @endif
            @endif
            @if (isset($tools))
                {{ $tools }}
            @endif

            @if(isset($edit))
            <a href="{{ $edit }}" class="btn btn-primary"><span class="fa fa-plus"></span> Edit </a>
            @endif
    </div>
</div>
<!-- /.box-header -->
<div class="box-body">
    {{ $slot }}
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
