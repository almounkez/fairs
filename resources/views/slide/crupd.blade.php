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
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label class="" for="id">{{ __('id') }} : </label>
                        </div>
                        <div class="col-8">
                            {{ $slide->id }}
                        </div>
                    </div>
                    @elseif(!empty($fairId))
                    <input name="fair_id" value="{{$fairId}}" hidden>
                    @elseif($suiteId!=null)
                    <input name="suite_id" value="{{$suiteId}}" hidden>
                    @endif
                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label for="description">{{ __('Category') }}:</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control show-tick ms select2" name="category_id">
                                @if (!empty($slide) && !empty($slide->category_id))
                                <option value={{ $slide->category_id }}>
                                    {{ $slide->category->name }}
                                </option>
                                @else
                                <option disabled selected value>{{ __('Primary page') }}</option>
                                @endif
                                @foreach ($categories as $category)

                                <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label for="description">{{ __('Subegory') }}:</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control show-tick ms select2" name="subegory_id">
                                @if (!empty($slide) && !empty($slide->subegory_id))
                                <option value={{ $slide->subegory_id }}>
                                    {{ $slide->category_sub->name }}
                                </option>
                                @else
                                <option disabled selected value>{{ __('Primary page') }}</option>
                                @endif
                                @foreach ($categories as $category)

                                <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

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
                            style="text-align:start"><label for="imgfile">{{ __('imgfile') }}: </label></div>
                        @if (!empty($slide))
                        <div class="col-md-2 col-form-label " style="text-align:start">
                            <img src="{{ asset('storage/slides/' . $slide->imgfile) }}" class="img-fluid img-thumbnail">
                        </div>
                        @endif

                        <div class="col-8 ">
                            <input class="form-control" type="file" name="imgfile" @if (empty($slide)) required @endif>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-md-center">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                        <div class="col-8 text-md-center">
                            {{-- <a href="{{ route('slide.index') }}" type="button"
                                class="btn btn-secondary">{{ __('Cancel') }}</a> --}}
                            <a @if(!empty($fairId)) href="{{ route('slide.indexFair',$fairId) }}"
                                @elseif(!empty($suiteId)) href="{{ route('slide.indexSuite',$suiteId) }}" @endif
                                type="button" class="btn btn-secondary">{{ __('Cancel') }}</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
