@extends('layouts.app')

@section('content')


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Slides') }}</div>
            <div class="card-body">
                <form action="{!!  !empty($slide) ? route('slide.update', $slide) : route('slide.store') !!}"
                    method="Post" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($slide))
                    @method('PUT')
                    @endif

                    @if (!empty($slide))
                    <div class="row">
                        @if(!empty($slide->fair_id))
                        <input name="fair_id" value="{{$slide->fair_id}}" hidden>
                        @elseif(!empty($slide->suite_id))
                        <input name="suite_id" value="{{$slide->suite_id}}" hidden>
                        @endif
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label class="" for="id">{{ __('id') }} : </label>
                        </div>
                        <div class="col-8">
                            {{ $slide->id }}
                        </div>
                    </div>
                    @elseif(!empty($fairId))
                    <input name="fair_id" value="{{$fairId}}" hidden>
                    @elseif(!empty($suiteId))
                    <input name="suite_id" value="{{$suiteId}}" hidden>
                    @endif
                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label for="description">{{ __('Category') }}:</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control show-tick ms select2" name="cat_id">
                                @if (!empty($slide) && !empty($slide->cat_id))
                                <option value={{ $slide->cat_id }}>
                                    @if (app()->getLocale() == 'ar'){{ $slide->category->name_ar}}
                                    @else{{ $slide->category->name_en}}@endif
                                </option>
                                @else
                                <option disabled selected value>{{ __('Primary page') }}</option>
                                @endif

                                @if (app()->getLocale() == 'ar')
                                @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->name_ar }}</option>
                                @endforeach
                                @else
                                @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->name_en }}</option>
                                @endforeach
                                @endif
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4  col-form-label " style="text-align:start">
                            <label for="location">{{ __('location') }}:</label>
                        </div>
                        <div class="col-8"><input class="form-control" type="text" name="location"
                                value=@if(!empty($slide) && old('location', $slide->location))
                            {{ $slide->location }}@else{{old('location')}} @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4  col-form-label " style="text-align:start">
                            <label for="group">{{ __('group') }}:</label>
                        </div>
                        <div class="col-8"><input class="form-control" type="text" name="group" value=@if(!empty($slide)
                                && old('group', $slide->group))
                            {{ $slide->group }}@else{{old('group')}} @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label for="active">{{ __('Active') }}:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="checkbox" class="form-check my-2" name="active" value="1" @if (!empty($slide)
                                && old('active', $slide->active)) checked @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="@if (!empty($slide)) col-md-2  @else col-md-4 @endif col-form-label "
                            style="text-align:start">
                            <label for="imgfile">{{ __('imgfile') }}: </label>
                        </div>
                        @if (!empty($slide))
                        <div class="col-md-2 col-form-label " style="text-align:start">
                            <img src="{{ asset('storage/slides/' . $slide->imgfile) }}" class="img-fluid img-thumbnail">
                        </div>
                        @endif
                        <div class="col-8 ">
                            <input class="form-control" type="file" name="imgfile" @if (empty($slide)) required @endif>

                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 text-md-center">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                        <div class="col-8 text-md-center">
                            {{-- <a href="{{ route('slide.index') }}" type="button"
                            class="btn btn-secondary">{{ __('Cancel') }}</a> --}}
                            @if(!empty($slide))
                            <a @if(!empty($slide->suite_id)) href="{{ route('suite.slides',$slide->suite_id) }}"
                                @elseif(!empty($slide->fair_id)) href="{{ route('fair.slides',$slide->fair_id) }}"
                                @endif
                                type="button" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            @else
                            <a @if(!empty($suiteId)) href="{{ route('suite.slides',$suiteId) }}"
                                @elseif(!empty($fairId)) href="{{ route('fair.slides',$fairId) }}" @endif
                                type="button" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
