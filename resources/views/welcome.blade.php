@extends('layouts.app')

@section('style')
<style>
    .hovereffect {
        width: 100%;
        height: 100%;
        float: left;
        overflow: hidden;
        position: relative;
        text-align: center;
        cursor: default;
    }

    .hovereffect .overlay {
        width: 100%;
        height: 100%;
        position: absolute;
        overflow: hidden;
        top: 0;
        left: 0;
        opacity: 0;
        background-color: rgba(0, 0, 0, 0.5);
        -webkit-transition: all .4s ease-in-out;
        transition: all .4s ease-in-out
    }

    .hovereffect img {
        display: block;
        position: relative;
        -webkit-transition: all .4s linear;
        transition: all .4s linear;
    }

    .hovereffect h2 {
        text-transform: uppercase;
        color: #fff;
        text-align: center;
        position: relative;
        font-size: 17px;
        background: rgba(0, 0, 0, 0.6);
        -webkit-transform: translatey(-100px);
        -ms-transform: translatey(-100px);
        transform: translatey(-100px);
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
        padding: 10px;
    }

    .hovereffect a.info {
        text-decoration: none;
        display: inline-block;
        text-transform: uppercase;
        color: #fff;
        border: 1px solid #fff;
        background-color: transparent;
        opacity: 0;
        filter: alpha(opacity=0);
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
        /* margin: 50px 0 0; */
        /* padding: 7px 14px; */
    }

    .hovereffect a.info:hover {
        box-shadow: 0 0 5px #fff;
    }

    .hovereffect:hover img {
        -ms-transform: scale(1.2);
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
    }

    .hovereffect:hover .overlay {
        opacity: 1;
        filter: alpha(opacity=100);
    }

    .hovereffect:hover h2,
    .hovereffect:hover a.info {
        opacity: 1;
        filter: alpha(opacity=100);
        -ms-transform: translatey(0);
        -webkit-transform: translatey(0);
        transform: translatey(0);
    }

    .hovereffect:hover a.info {
        -webkit-transition-delay: .2s;
        transition-delay: .2s;
    }

</style>
@endsection


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
<div class="row mt-2">

    @foreach ($fairs as $fair)
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">


        <div class="hovereffect">

            <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-fluid w-100">

            <div class="overlay">
                <h2> @if (app()->getLocale() == 'ar')
                    {{ $fair->name_ar }}
                    @else
                    {{ $fair->name_en }}
                    @endif
                </h2>
                @if(!empty($fair->start_date))
                <a class="info m-2 p-2">{{__('from')}}: {{$fair->start_date->format('Y-m-d')}}</a>
                @endif
                @if(!empty($fair->end_date))
                <a class="info m-2 p-2">{{__('to')}}:{{$fair->end_date->format('Y-m-d')}}</a>
                @endif
                <br>
                @if($fair->active==1)
                 <a class="info m-2 p-2" href="{{route('fair.show',$fair->id)}}">{{__('Enter')}}</a>
                @endif
            </div>
        </div>

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
