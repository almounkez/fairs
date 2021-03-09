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
                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label class="" for="id">{{ __('id') }} : </label>
                        </div>
                        <div class="col-8">
                            {{ $marquee->id }}
                        </div>
                    </div>
                    @elseif(!empty($fairId))
                    <input name="fair_id" value="{{$fairId}}" hidden >
                    @elseif(!empty($suiteId))
                    <input name="suite_id" value="{{$suiteId}}" hidden>
                    @endif
                    <div class="row my-2">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="newstext_ar">{{ __('Arabic Text') }}:</label>
                        </div>
                        <div class="col-10">
                            <textarea required class="form-control" type="text"
                             name="newstext_ar"> @if(!empty($marquee) && old('newstext_ar', $marquee->newstext_ar)){{ $marquee->newstext_ar }}@else{{old('newstext_ar')}}@endif</textarea>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="newstext_en">{{ __('English Text') }}:</label>
                        </div>
                        <div class="col-10">
                            <textarea required class="form-control" type="text"
                            name="newstext_en">@if (!empty($marquee) && old('newstext_en', $marquee->newstext_en)){{ $marquee->newstext_en }}@else{{old('newstext_en')}}@endif</textarea>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-4 text-md-center">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                        <div class="col-8 text-md-center">
                            <a
                            @if(!empty($fairId))
                            href="{{ route('fair.marquees',$fairId) }}"
                            @elseif(!empty($suiteId))
                            href="{{ route('suite.marquees',$suiteId) }}"
                            @endif
                            type="button"
                                class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
