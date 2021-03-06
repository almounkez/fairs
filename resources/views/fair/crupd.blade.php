@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{ __('Fairs') }}</div>
                <div class="card-body">
                    <form action="{!! !empty($fair) ? route('fair.update', $fair) : route('fair.store') !!}"
                    method="Post" enctype="multipart/form-data">
                        @csrf
                        @if (!empty($fair))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-12 col-form-label text-md-left">
                                <label class="" for="id">{{ __('id') }} : </label>
                                @if (!empty($fair))
                                    {{ $fair->id }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="name_ar">{{ __('Arabic Name') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="text" name="name_ar"
                                value="@if(!empty($fair)) {{ $fair->name_ar }}@else{{old('name_ar')}} @endif" required>
                            </div>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="name_en">{{ __('English Name') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="text" name="name_en"
                                value="@if (!empty($fair)){{ $fair->name_en }}@else{{old('name_en')}} @endif" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="start_date">{{ __('Start Date') }}:</label>
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="date" name="start_date"
                                value="@if(!empty($fair)) {{ $fair->start_date }}@else{{old('start_date')}} @endif">
                            </div>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="end_date">{{ __('End Date') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="date" name="end_date"
                                value="@if(!empty($fair)) {{ $fair->end_date }}@else{{old('end_date')}} @endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-form-label " style="text-align:start">
                                <label for="active">{{ __('Active') }}:</label>
                            </div>
                            <div class="col-8">
                                <input type="checkbox" class="form-check" name="active"
                                value="1" @if (!empty($fair) && $fair->active) checked @else{{old('active')}} @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" @if (!empty($fair)) col-md-2 @else col-md-4 @endif col-form-label "
                            style="text-align:start">
                                <label for="logo_ar">{{ __('logo_ar') }}:</label>
                            </div>
                            @if (!empty($fair))
                                <div class="col-md-2 col-form-label " style="text-align:start">
                                    <img src="{{ asset('storage/fairs/' . $fair->logo_ar) }}"
                                        class="img-fluid img-thumbnail" >
                                </div>
                            @endif
                            <div class="col-8">
                                <input class="form-control" type="file" name="logo_ar" @if (empty($fair)) required @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" @if (!empty($fair)) col-md-2 @else col-md-4 @endif col-form-label "
                            style="text-align:start">
                                <label for="logo_en">{{ __('logo_en') }}:</label>
                            </div>

                            @if (!empty($fair))
                                <div class="col-md-2 col-form-label " style="text-align:start">
                                    <img src="{{ asset('storage/fairs/' . $fair->logo_en) }}"
                                        class="img-fluid img-thumbnail" >
                                </div>
                            @endif

                            <div class="col-8">
                                <input class="form-control" type="file" name="logo_en" @if (empty($fair))  required @endif>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 text-md-center">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                            <div class="col-6 text-md-center">
                                <a href="{{ route('fair.index') }}" type="button"
                                    class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
