@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{ __('Fairs') }}</div>
                <div class="card-body">
                    <form action="{!! !empty($fair) ? route('fair.update', $fair) : route('fair.store') !!}" method="Post" enctype="multipart/form-data">
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
                            <div class="col-4"><input class="form-control" type="text" name="name_ar" value=@if (!empty($fair) && old('name_ar', $fair->name_ar)) {{ $fair->name_ar }} @endif>
                            </div>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="name_ar">{{ __('English Name') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="text" name="name_en" value=@if (!empty($fair) && old('name_en', $fair->name_en)) {{ $fair->name_en }} @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="start_date">{{ __('Start Date') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="date" name="start_date" value=@if (!empty($fair) && old('start_date', $fair->start_date)) {{ $fair->start_date }} @endif>
                            </div>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="end_date">{{ __('End Date') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="date" name="end_date" value=@if (!empty($fair) && old('end_date', $fair->v)) {{ $fair->end_date }} @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-form-label " style="text-align:start">
                                <label for="active">{{ __('Active') }}:</label>
                            </div>
                            <div class="col-8">
                                <input type="checkbox" class="form-check" name="active" value="1" @if (!empty($fair) && old('active', $fair->active)) checked @endif>
                                {{-- @if (!empty($fair) && $fair->active) checked @endif --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class=" @if (!empty($fair)) col-md-2 @else col-md-4 @endif col-form-label " style="
                                text-align:start">
                                <label for="logo_ar">{{ __('logo_ar') }}:</label>
                            </div>

                            @if (!empty($fair))
                                <div class="col-md-2 col-form-label " style="text-align:start">
                                    <img src="{{ asset('storage/logos/' . $fair->logo_ar) }}"
                                        class="img-fluid img-thumbnail" width="64%">
                                </div>
                            @endif

                            <div class="col-8">
                                <input class="form-control" type="file" name="logo_en" @if (empty($fair)) required @endif>


                            </div>
                        </div>
                        <div class="row">
                            <div class=" @if (!empty($fair)) col-md-2 @else col-md-4 @endif col-form-label " style="
                                text-align:start">
                                <label for="logo_ar">{{ __('logo_ar') }}:</label>
                            </div>

                            @if (!empty($fair))
                                <div class="col-md-2 col-form-label " style="text-align:start">
                                    <img src="{{ asset('storage/logos/' . $fair->logo_ar) }}"
                                        class="img-fluid img-thumbnail" width="64%">
                                </div>
                            @endif

                            <div class="col-8">
                                <input class="form-control" type="file" name="logo_ar" @if (empty($fair)) required @endif>


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
