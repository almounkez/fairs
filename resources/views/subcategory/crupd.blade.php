@extends('layouts.app')

@section('content')


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('subcategory') }}</div>
            <div class="card-body">
                <form action="{!!  !empty($subcategory) ? route('subcategory.update', $subcategory) : route('subcategory.store') !!}"
                    method="Post" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($subcategory))
                    @method('PUT')
                    @endif

                    @if (!empty($subcategory))
                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label class="" for="id">{{ __('id') }} : </label>
                        </div>
                        <div class="col-8">
                            {{ $subcategory->id }}
                        </div>
                    </div>
                    @elseif(!empty($fairId))
                    <input name="fair_id" value="{{$fairId}}" hidden>
                    @endif
                    <div class="row">
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="name_ar">{{ __('Arabic Name') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="text" name="name_ar"
                                value="@if (!empty($subcategory) && old('name_ar', $subcategory->name_ar)) {{ $subcategory->name_ar }}@else{{old('name_ar')}} @endif">
                            </div>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="name_ar">{{ __('English Name') }}:</label>
                            </div>
                            <div class="col-4"><input class="form-control" type="text" name="name_en"
                                value="@if (!empty($subcategory) && old('name_en', $subcategory->name_en)) {{ $subcategory->name_en }}@else{{old('name_en')}} @endif">
                            </div>
                    </div>


                    <div class="row">
                        <div class="col-4 text-md-center">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                        <div class="col-8 text-md-center">
                            <a href="{{ route('subcategory.index') }}" type="button"
                                class="btn btn-secondary">{{ __('Cancel') }}</a>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
