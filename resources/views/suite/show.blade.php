@extends('layouts.app')
{{-- @section('fair')
<a class="navbar-brand" href="{{ route('fair.show',$fairId) }}">
@lang('Current Fair')
</a>
@endsection --}}
@section('content')
<div class="row">

</div>
<div class="row">
    <div class="col-12">
        <div class="card">

            <div id="masterSlides" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    {{-- @Admin --}}
                    @auth

                    @if(!empty(auth()->user()->suite) && auth()->user()->suite->id == $suiteId)
                    <a href="{{route('slide.createForSuite',$suiteId)}}">
                        <span class="btn btn-sm btn-outline-secondary mx-2" style="float:inline-end">
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
                        <img src="{{ asset('/storage/slides/' . $slide->imgfile) }}" class="img-fluid carousel-inner">
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
        <div class="list-group h5">
            <i class="list-group-item list-group-item-action active">
                @lang('Categories')
                @auth @if(auth()->user()->role=='admin')
                <span class="mx-2" style="float:right">
                    <a class="btn btn-sm btn-outline-light" href="{{route('category.create',$fairId)}}"><i
                            class="zmdi zmdi-plus zmdi-hc-lg"></i></a>
                </span>
                @endif @endauth
            </i>
            @foreach ($categories as $category)
            <a href="{{route('search.products.cat',['suite' => $suiteId,'category'=>$category])}}"
                class="list-group-item list-group-item-action @if(!empty($catId) && $catId==$category->id)list-group-item-dark @endif">
                {{-- <h5 class="d-flex align-items-center justify-content-center"> --}}
                @if (config('app.locale') == 'ar')
                {{ $category->name_ar }}
                @else
                {{ $category->name_en }}
                @endif
                {{-- </h5> --}}
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-9">
        @if(!empty($subcategories))
        <div class="row mb-2">
            @foreach ($subcategories as $subcategory)
            {{-- <div class="col mb-2"> --}}
            <a class="btn btn-sm m-1 @if(!empty($subId) && $subId==$subcategory->id)btn-primary @else btn-secondary @endif"
                href="{{route('search.products.subcat',['suite' => $suiteId,'category'=>$catId,'subcategory'=>$subcategory->id])}}">
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

            <a class="btn btn-sm btn-outline-secondary rounded-circle m-1"
                href="{{route('subcategory.create',$fairId)}}">
                <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
            </a>

            @endif
            @endauth
        </div>
        @endif
        @auth
        @if(!empty(auth()->user()->suite) && auth()->user()->suite->id == $suiteId)
        <div class="float-right" style="float:inline-end">
            <a class="btn btn-sm btn-outline-primary rounded-circle mx-2" href="{{route('product.create',$suiteId)}}">
                <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
            </a>
        </div>
        @endif
        @endauth
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="{{asset('storage/products/'.$product->imgfile)}}">
                        <img src="{{asset('storage/products/'.$product->imgfile)}}" class="figure-img img-fluid rounded"
                            alt="A generic square placeholder image with rounded corners in a figure.">
                        <div class="row mx-2 caption">

                            @if (config('app.locale') == 'ar')
                            <div class="col-4">
                                <span class="mx-1 badge badge-secondary">{{$product->name_ar}}</span>
                            </div>
                            <div class="col">
                            <span class="mx-1 badge badge-secondary">{{$product->suite->name_ar}}</span>
                            <span class="mx-1 badge badge-secondary">{{$product->category->name_ar}}</span>
                            <span class="mx-1 badge badge-secondary">{{$product->subcategory->name_ar}}</span>
                            </div>
                            @else
                            <div class="col-4">
                            <span class="mx-1 badge badge-secondary">{{$product->name_en}}</span>
                            </div><div class="col">
                            <span class="mx-1 badge badge-secondary">{{$product->suite->name_en}}</span>
                            <span class="mx-1 badge badge-secondary">{{$product->category->name_en}}</span>
                            <span class="mx-1 badge badge-secondary">{{$product->subcategory->name_en}}</span></div>
                            @endif

                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('footer.connectList')
<div class="col mb-md-0 mb-3 border-left border-right border-dark">

    <!-- Links -->
    <h5 class="text-uppercase">{{__('Connect Us')}}</h5>

    <ul class="list-unstyled p-0">
        <li></li>
    </ul>

</div>
@endsection
@section('footer.subscribe')
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-md-0 mb-3 border-left border-right border-dark">
    <!-- Links -->
    <h5 class="text-uppercase">{{__('subscribe')}}</h5>
    @include('mailList.crupd',['source_type'=>'suite','source_id'=>$suiteId])
</div>
@endsection
