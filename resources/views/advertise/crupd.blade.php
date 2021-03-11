@extends('layouts.app')

@section('content')


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('advertise') }}</div>
            <div class="card-body">
                <form action="{!!  !empty($advertise) ? route('advertise.update', $advertise) : route('advertise.store') !!}"
                    method="Post" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($advertise))
                    @method('PUT')
                    @endif

                    @if (!empty($advertise))
                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label class="" for="id">{{ __('id') }} : </label>
                        </div>
                        <div class="col-8">
                            {{ $advertise->id }}
                        </div>
                    </div>
                    @elseif(!empty($fairId))
                    <input name="fair_id" value="{{$fairId}}" hidden>
                    @endif





                    <div class="row">
                        <div class="col-md-4  col-form-label " style="text-align:start">
                            <label for="location">{{ __('location') }}:</label>
                        </div>
                        <div class="col-8"><input class="form-control" type="text" name="location"
                                value=@if(!empty($advertise) && old('location', $advertise->location))
                            {{ $advertise->location }}@else{{old('location')}} @endif>
                        </div>
                    </div>
<div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label for="active">{{ __('Active') }}:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="checkbox" class="form-check my-2" name="active" value="1" @if (!empty($advertise)
                                && old('active', $advertise->active)) checked @endif>
                        </div>
                    </div>

                     <div class="row">
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="start_date">{{ __('Start Date') }}:</label>
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="date" name="start_date"
                                value=@if (!empty($advertise) && old('start_date', $advertise->start_date)) {{ $advertise->start_date }}@else{{old('start_date')}} @endif>
                            </div>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="end_date">{{ __('End Date') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="date" name="end_date"
                                value=@if (!empty($advertise) && old('end_date', $advertise->end_date)) {{ $advertise->end_date }}@else{{old('end_date')}} @endif>
                            </div>
                        </div>



                    <div class="row">
                        <div class="@if (!empty($advertise)) col-md-2  @else col-md-4 @endif col-form-label "
                            style="text-align:start"><label for="imgfile">{{ __('imgfile') }}: </label></div>
                        @if (!empty($advertise))
                        <div class="col-md-2 col-form-label " style="text-align:start">
                            <img src="{{ asset('storage/advertises/' . $advertise->imgfile) }}" class="img-fluid img-thumbnail"
                               >
                        </div>
                        @endif

                        <div class="col-8 ">
                            <input class="form-control" type="file" name="imgfile" @if (empty($advertise)) required @endif>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-md-center">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                        <div class="col-8 text-md-center">
                            <a href="{{ route('advertise.index') }}" type="button"
                                class="btn btn-secondary">{{ __('Cancel') }}</a>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
