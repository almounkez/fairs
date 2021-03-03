@extends('layouts.app')

@section('content')
{{-- @Admin --}}

<div class="fixed-top m-2"><a class="btn btn-outline-primary rounded-circle" href="{{route('fair.create')}}" alt=@lang('Add new fair')>
    <i class="zmdi zmdi-plus"></i>
</a></div>

{{-- @endAdmin --}}
<div class="row">
    @foreach ($fairs as $fair)
    <div class="col-md-3">
        <a href="{{route('fair.show',$fair->id)}}">
            <figure class="figure">
                <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                    alt="A generic square placeholder image with rounded corners in a figure.">
                <figcaption class="figure-caption">A caption for the above image.</figcaption>
            </figure>
            {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
        </a>
    </div>
    <div class="col-md-3">
            <a href="{{route('fair.show',$fair->id)}}">
                <figure class="figure">
                    <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                        alt="A generic square placeholder image with rounded corners in a figure.">
                    <figcaption class="figure-caption">A caption for the above image.</figcaption>
                </figure>
                {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
            </a>
        </div>
        <div class="col-md-3">
                <a href="{{route('fair.show',$fair->id)}}">
                    <figure class="figure">
                        <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                            alt="A generic square placeholder image with rounded corners in a figure.">
                        <figcaption class="figure-caption">A caption for the above image.</figcaption>
                    </figure>
                    {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
                </a>
            </div>
            <div class="col-md-3">
                    <a href="{{route('fair.show',$fair->id)}}">
                        <figure class="figure">
                            <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                                alt="A generic square placeholder image with rounded corners in a figure.">
                            <figcaption class="figure-caption">A caption for the above image.</figcaption>
                        </figure>
                        {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
                    </a>
                </div>
                <div class="col-md-3">
                        <a href="{{route('fair.show',$fair->id)}}">
                            <figure class="figure">
                                <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                                    alt="A generic square placeholder image with rounded corners in a figure.">
                                <figcaption class="figure-caption">A caption for the above image.</figcaption>
                            </figure>
                            {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
                        </a>
                    </div>
                    <div class="col-md-3">
                            <a href="{{route('fair.show',$fair->id)}}">
                                <figure class="figure">
                                    <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                                        alt="A generic square placeholder image with rounded corners in a figure.">
                                    <figcaption class="figure-caption">A caption for the above image.</figcaption>
                                </figure>
                                {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
                            </a>
                        </div><div class="col-md-3">
                            <a href="{{route('fair.show',$fair->id)}}">
                                <figure class="figure">
                                    <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                                        alt="A generic square placeholder image with rounded corners in a figure.">
                                    <figcaption class="figure-caption">A caption for the above image.</figcaption>
                                </figure>
                                {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
                            </a>
                        </div><div class="col-md-3">
                            <a href="{{route('fair.show',$fair->id)}}">
                                <figure class="figure">
                                    <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                                        alt="A generic square placeholder image with rounded corners in a figure.">
                                    <figcaption class="figure-caption">A caption for the above image.</figcaption>
                                </figure>
                                {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
                            </a>
                        </div><div class="col-md-3">
                            <a href="{{route('fair.show',$fair->id)}}">
                                <figure class="figure">
                                    <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="figure-img img-fluid rounded"
                                        alt="A generic square placeholder image with rounded corners in a figure.">
                                    <figcaption class="figure-caption">A caption for the above image.</figcaption>
                                </figure>
                                {{-- <img src="{{asset('storage/fairs/'.$fair->logo_en)}}" class="img-thumbnail"> --}}
                            </a>
                        </div>
    @endforeach
</div>

@endsection
