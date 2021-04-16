@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('marquee') }}</div>
            <div class="card-body">
                <form action="{!!  !empty($marquee) ? route('marquee.update', $marquee) : route('marquee.store') !!}"
                    method="Post" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($marquee))
                    @method('PUT')
                    @endif

                    @if (!empty($marquee))
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="id">{{ __('id') }} : </label>
                        <div class="col-md-10">
                            {{ $marquee->id }}
                        </div>
                    </div>
                    @elseif(!empty($fairId))
                    <input name="fair_id" value="{{$fairId}}" hidden>
                    @elseif(!empty($suiteId))
                    <input name="suite_id" value="{{$suiteId}}" hidden>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="newstext_ar">{{ __('Arabic Text') }}:</label>
                        <div class="col-10">
                            <textarea required class="form-control" type="text"
                                name="newstext_ar"> @if(!empty($marquee) && old('newstext_ar', $marquee->newstext_ar)){{ $marquee->newstext_ar }}@else{{old('newstext_ar')}}@endif</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="newstext_en">{{ __('English Text') }}:</label>
                        <div class="col-10">
                            <textarea required class="form-control" type="text"
                                name="newstext_en">@if (!empty($marquee) && old('newstext_en', $marquee->newstext_en)){{ $marquee->newstext_en }}@else{{old('newstext_en')}}@endif</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-md-center">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                        <div class="col-md-10 text-md-center">
                            @if(!empty($marquees))
                            <a @if(!empty($marquees->suite_id)) href="{{ route('suite.marquees',$marquees->suite_id) }}"
                                @elseif(!empty($marquees->fair_id))
                                href="{{ route('fair.marquees',$marquees->fair_id) }}"
                                @endif
                              type="button" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            @else
                            <a @if(!empty($suiteId)) href="{{ route('suite.marquees',$suiteId) }}"
                                @elseif(!empty($fairId)) href="{{ route('fair.marquees',$fairId) }}" @endif
                               type="button"   class="btn btn-secondary">{{ __('Cancel') }}</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
