@extends('layouts.app')

@section('content')
{{-- @Admin --}}
@auth
    @if(auth()->user()->role=='admin')
    <div class="fixed-top mx-3 mt-5 justify-content-center" >
        <a class="align-items- btn btn-sm btn-outline-secondary" href="{{route('fair.create')}}" alt=@lang('Add new fair')>
            <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
        </a>
    </div>
    @endif
@endauth

{{-- @endAdmin --}}
<div class="row">

    @foreach ($fairs as $fair)
    <div class="col-md-4">
        <a href="{{route('fair.show',$fair->id)}}">
            <figure class="figure">
                <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                    alt="A generic square placeholder image with rounded corners in a figure.">
                <figcaption class="figure-caption">A caption for the above image.</figcaption>
            </figure>
        </a>
    </div>
    @endforeach
</div>

@stop
