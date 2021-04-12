@extends('layouts.app')

@section('content')
{{-- @Admin --}}
@auth
@if(auth()->user()->role=='admin')
<div class="mx-1 justify-content-center">
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
                <figcaption class="row figure-caption mx-1">
                    <p class="col"> @if (app()->getLocale() == 'ar')
                        {{ $fair->name_ar }}
                        @else
                        {{ $fair->name_en }}
                        @endif</p>
                    <p class="col">{{__('from')}}: {{$fair->start_date->format('Y-m-d')}}</p>
                    <p class="col">{{__('to')}}:{{$fair->end_date->format('Y-m-d')}}</p>
                </figcaption>
            </figure>

        </a>
    </div>
    @endforeach
</div>
@endsection
@section('footer.subscribe')
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-md-0 mb-3 border-left border-right border-dark">
    <!-- Links -->
    <h5 class="text-uppercase">{{__('subscribe')}}</h5>
    @include('mailList.crupd',['source_type'=>'global'])
</div>
@endsection
