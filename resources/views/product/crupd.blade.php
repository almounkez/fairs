@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('product') }}</div>
            <div class="card-body">
                <form action="{!!  !empty($product) ? route('product.update', $product) : route('product.store') !!}"
                    method="Post" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($product))
                    @method('PUT')
                    <div class="row">
                        <input name="suite_id" value="{{$product->suite_id}}" hidden>
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label class="" for="id">{{ __('id') }} : </label>
                        </div>
                        <div class="col-8">
                            {{ $product->id }}
                        </div>
                    </div>
                    @elseif(!empty($suiteId))
                    <input name="suite_id" value="{{$suiteId}}" hidden>
                    @endif
                    <div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="cat_id">{{ __('Category') }}:</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control show-tick ms select2" name="cat_id">
                                @if (!empty($product) && !empty($product->cat_id))
                                <option value={{ $product->cat_id }}>
                                    @if (app()->getLocale() == 'ar'){{ $product->category->name_ar}}
                                    @else{{ $product->category->name_en}}@endif
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
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="sub_id">{{ __('Subcategory') }}:</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control show-tick ms select2" name="sub_id">
                                @if (!empty($product) && !empty($product->sub_id))
                                <option value={{ $product->sub_id }}>
                                    @if (app()->getLocale() == 'ar'){{ $product->subcategory->name_ar}}
                                    @else{{ $product->subcategory->name_en}}@endif
                                </option>
                                @else
                                <option disabled selected value>{{ __('Primary page') }}</option>
                                @endif

                                @if (app()->getLocale() == 'ar')
                                @foreach ($subcategories as $subcategory)
                                <option value={{ $subcategory->id }}>{{ $subcategory->name_ar }}</option>
                                @endforeach
                                @else
                                @foreach ($subcategories as $subcategory)
                                <option value={{ $subcategory->id }}>{{ $subcategory->name_en }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="name_ar">{{ __('Arabic Name') }}:</label>
                        </div>
                        <div class="col-4"><input class="form-control" type="text" name="name_ar"
                                value="@if (!empty($product) && old('name_ar', $product->name_ar)) {{ $product->name_ar }}@else{{old('name_ar')}} @endif">
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="name_en">{{ __('English Name') }}:</label>
                        </div>
                        <div class="col-4"><input class="form-control" type="text" name="name_en"
                                value="@if (!empty($product) && old('name_en', $product->name_en)) {{ $product->name_en }}@else{{old('name_en')}} @endif">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="descp_ar">{{ __('Arabic descp') }}:</label>
                        </div>
                        <div class="col-4"><input class="form-control" type="text" name="descp_ar"
                                value="@if (!empty($product) && old('descp_ar', $product->descp_ar)) {{ $product->v_ar }}@else{{old('descp_ar')}} @endif">
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="descp_en">{{ __('English descp') }}:</label>
                        </div>
                        <div class="col-4"><input class="form-control" type="text" name="descp_en"
                                value="@if (!empty($product) && old('descp_en', $product->descp_en)) {{ $product->descp_en }}@else{{old('descp_en')}} @endif">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label for="active">{{ __('Active') }}:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="checkbox" class="form-check my-2" name="active" value="1" @if (!empty($product)
                                && old('active', $product->active)) checked @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="@if (!empty($product)) col-md-2  @else col-md-4 @endif col-form-label "
                            style="text-align:start"><label for="imgfile">{{ __('imgfile') }}: </label></div>
                        @if (!empty($product))
                        <div class="col-md-2 col-form-label " style="text-align:start">
                            <img src="{{ asset('storage/products/' . $product->imgfile) }}"
                                class="img-fluid img-thumbnail">
                        </div>
                        @endif
                        <div class="col-8 ">
                            <input class="form-control" type="file" name="imgfile" @if (empty($product)) required
                                @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-md-center">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                        <div class="col-8 text-md-center">
                            <a href="{{ route('suite.products',$suiteId) }}" type="button"
                                class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
