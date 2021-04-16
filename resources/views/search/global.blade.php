@extends('layouts.app')
@section('content')

@if(!empty($results['subcategories']))
<div class="divider"></div>
<div class="row mb-2">
    @foreach ($results['subcategories'] as $subcategory)
    {{-- <div class="col mb-2"> --}}
    <a class="btn btn-sm m-1 @if(!empty($subId) && $subId==$subcategory->id)btn-primary @else btn-secondary @endif"
        href="{{route('search.global.products.subcat',['subcategory'=>$subcategory->id])}}">
        @if (config('app.locale') == 'ar')
        {{ $subcategory->name_ar }}
        @else
        {{ $subcategory->name_en }}
        @endif
    </a>
    {{-- </div> --}}
    @endforeach
</div>
@endif
<div class="row ">
    @if(!empty($results['categories'])&& count($results['categories'])!=0)
    <div class="col-md-3 px-1 mb-2">
        <ul class="list-group h5 text-center">
            <i class="list-group-item list-group-item-action active">
                {{__('Categories')}}
            </i>
            @foreach($results['categories'] as $category)
            <a href="{{route('search.suites.cat',['fair'=>$fairId,'category'=>$category])}}"
                class="list-group-item list-group-item-action @if(!empty($catId) && $catId==$category->id)list-group-item-dark @endif">
                @if (config('app.locale') == 'ar')
                {{ $category->name_ar }}
                @else
                {{ $category->name_en }}
                @endif
            </a>
            @endforeach
        </ul>
    </div>
    @endif



    <div class="col">
        @if(!empty($results['suites'])&& count($results['suites'])!=0)
        <div class="row">
            <div class="col-12">
                <div class="card-header text-white bg-primary">
                    {{__('Suites')}}
                </div>
            </div>
            <div class="col-12">
                <div class="row mx-1">
                    @foreach($results['suites'] as $suite)
                    <div class="col-md-4 px-2 my-2">
                        <div class="card h-100">
                            @if (config('app.locale') == 'ar')
                            <img class="card-img-top" src="{{asset('storage/suites/'.$suite->logo_ar)}}" alt="">
                            <div class="card-body">
                                <h5 class="card-title mb-0"><a
                                        href="{{route('suite.show',$suite)}}">{{$suite->name_ar}}</a></h5>
                            </div>
                            @else
                            <img class="card-img-top" src="{{asset('storage/suites/'.$suite->logo_en)}}" alt="">
                            <div class="card-body">
                                <h5 class="card-title mb-0"><a
                                        href="{{route('suite.show',$suite)}}">{{$suite->name_en}}</a></h5>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if(!empty($results['products'])&& count($results['products'])!=0)
        <div class="row">
            <div class="col-12 mb-2">
                <div class="card-header text-white bg-primary" >
                    <a>{{__('Products')}}</a>
                </div>
            </div>
            <div class="col-12">
                {{-- <div class="row mx-1"> --}}
                <div class="card-columns">
                    @foreach($results['products'] as $product)
                    {{-- {{dd($product)}} --}}
                    {{-- <div class="col-md-4 my-1"> --}}
                    <div class="card h-100">
                        <a href="{{route('product.show',$product)}}" target="_blank">
                            <img src="{{asset('storage/products/'.$product->imgfile)}}" class="card-img-top"
                                @if(config('app.locale')=='ar' ) alt="{{$product->descp_ar}}" @else
                                alt="{{$product->descp_en}}" @endif>
                        </a>
                        <div class="card-body">
                            @if (config('app.locale') == 'ar')
                            <h5 class="card-title">{{$product->name_ar}}</h5>
                            <p class="card-text">{{$product->descp_ar}}</p>
                            <span class="mx-1 badge badge-primary">{{$product->suite->name_ar}}</span>
                            <span class="mx-1 badge badge-secondary">{{$product->category->name_ar}}</span>
                            <span class="mx-1 badge badge-secondary">{{$product->subcategory->name_ar}}</span>
                            @else
                            <h5 class="card-title">{{$product->name_en}}</h5>
                            <p class="card-text">{{$product->descp_en}}</p>
                            <span class="mx-1 badge badge-primary">{{$product->suite->name_en}}</span>
                            <span class="mx-1 badge badge-secondary">{{$product->category->name_en}}</span>
                            <span class="mx-1 badge badge-secondary">{{$product->subcategory->name_en}}</span>
                        </div>
                        @endif
                    </div>
                    {{-- </div> --}}
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
