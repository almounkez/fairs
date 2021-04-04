@extends('layouts.app')
@section('content')
<div class="card-columns">
    @if(!empty($results['categories']))
    <div class="card">
        <div class="card-header text-white bg-primary">
            {{__('Cataegories')}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    @foreach($results['categories'] as $category)
                    <a href="{{route('category.show',$category)}}"
                        class="nav- @if(!empty($catId) && $catId==$category->id)list-group-item-dark @endif">
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
        </div>
    </div>
    @endif
    @if(!empty($results['suites']))
        <div class="card">
            <div class="card-header text-white bg-primary">
                {{__('Suites')}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        @foreach($results['suites'] as $category)
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
        </div>
        @endif
</div>

@endsection
