@extends('layouts.app')
{{-- @section('fair')
<a class="navbar-brand" href="{{ route('fair.show',$fairId) }}">
@lang('Current Fair')
</a>
@endsection --}}
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div id="masterSlides" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    {{-- @Admin --}}
                    @auth
                    @if(auth()->user()->role=='admin')
                    <a href="{{route('slide.createForFair',$fairId)}}">
                        <span class="btn btn-sm btn-outline-light mx-2" style="float:inline-end">
                            <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
                        </span>
                    </a>
                    @endif
                    @endauth
                    {{-- @endAdmin --}}
                    @for ($i = 0; $i < count($slides); $i++) <li data-target="#masterSlides" data-slide-to="{{ $i }}"
                        @if ($i==0) class="active" @endif>
                        </li>
                        @endfor
                </ul>
                <!-- wrapper for slides -->
                <div class="carousel-inner h-50" role="listbox" style="max-height:300px !important">
                    @foreach ($slides as $key => $slide)
                    <div class="carousel-item @if ($key==0) active @endif">
                        <img src="{{ asset('/storage/slides/' . $slide->imgfile) }}" class="img-fluid carousel-inner ">
                    </div>

                    @endforeach
                    <!-- Controlls -->
                    <a class="carousel-control-prev" href="#masterSlides" data-slide="prev"><span
                            class="carousel-control-prev-icon"></span></a>
                    <a class="carousel-control-next" href="#masterSlides" data-slide="next"><span
                            class="carousel-control-next-icon"></span></a>

                    <!-- End Controlls -->
                </div>
                <!-- end of wrapper -->
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3">
        <ul class="list-group h5 text-center">
            <i class="list-group-item list-group-item-action active">
                @lang('Categories')
                @auth @if(auth()->user()->role=='admin')
                <span class="mx-2 " style="float:right">
                    <a class="btn btn-sm btn-outline-light " href="{{route('category.create',$fairId)}}"><i
                            class="zmdi zmdi-plus zmdi-hc-lg"></i></a>
                </span>
                @endif @endauth
            </i>
            @foreach ($categories as $category)

            <a href="{{route('search.suites.cat',['fair' => $fairId,'category'=>$category])}}"
                class="list-group-item list-group-item-action @if(!empty($catId) && $catId==$category->id)list-group-item-dark  @endif">
                    @if (config('app.locale') == 'ar')
                    {{ $category->name_ar }}
                    @else
                    {{ $category->name_en }}
                    @endif
            </a>
            @endforeach
        </ul>
    </div>
    <div class="col-md-9">
        @if(!empty($subcategories))
        <div class="row mb-2">
            @foreach ($subcategories as $subcategory)
            {{-- <div class="col mb-2"> --}}
                <a class="btn btn-sm m-1 @if(!empty($subId) && $subId==$subcategory->id)btn-primary @else btn-secondary @endif"
                    href="{{route('search.suites.subcat',['fair' => $fairId,'category'=>$catId,'subcategory'=>$subcategory])}}">
                    @if (config('app.locale') == 'ar')
                    {{ $subcategory->name_ar }}
                    @else
                    {{ $subcategory->name_en }}
                    @endif
                </a>
            {{-- </div> --}}
            @endforeach
            @auth
            @if(auth()->user()->role=='admin')

                <a class="btn btn-sm btn-outline-secondary rounded-circle m-1" href="{{route('subcategory.create',$fairId)}}">
                    <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
                </a>

            @endif
            @endauth
        </div>
        @endif
        @auth
        @if(auth()->user()->role=='admin')
        <div class="float-right p-0">
            <a class="btn btn-sm btn-outline-primary rounded-circle" href="{{route('suite.create',$fairId)}}">
                <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
            </a>
        </div>
        @endif
        @endauth
        <div class="row">
            @foreach ($suites as $suite)
            <div class="col-md-4">
                <a href="{{route('suite.show',$suite->id)}}">
                    <figure class="figure">
                        <img src="{{asset('storage/suites/'.$suite->logo_en)}}" class="figure-img img-fluid rounded"
                            alt="A generic square placeholder image with rounded corners in a figure.">
                        <figcaption class="figure-caption">A caption for the above image.</figcaption>
                    </figure>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
