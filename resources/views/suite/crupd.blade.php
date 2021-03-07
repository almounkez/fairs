@extends('layouts.app')
@section('content')
<form action="{!! !empty($suite) ? route('suite.update', $suite) : route('suite.store') !!}" method="Post"
    enctype="multipart/form-data">
    @csrf
    @if (!empty($suite))
    @method('PUT')
    <input type="hidden" name='suite_id' value="{{$suite->id}}" >
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{ __('User') }}</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('User name') }}</label>
                        <div class="col-md-4">
                            <input id="userName" type="text"
                                class="form-control @error('userName') is-invalid @enderror" name="userName"
                               value="{{$suite->user->name}}"  required>
                            @error('uerName') <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span> @enderror </div>
                    </div>
                    <div class="form-group row">

                        <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-4">

                            <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <div class="input-group-append">
                                    <a class="btn btn-outline-info" onclick="showPass()">
                                        <i class="zmdi zmdi-eye"></i></a>
                                </div>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span> @enderror
                        </div>


                        <label for="password-confirm"
                            class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                                <div class="input-group-append">
                                    <a class="btn btn-outline-info" onclick="showPass1()">
                                        <i class="zmdi zmdi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @else <input name="fairId" value="{{$fairId}}" hidden>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Suits') }}</div>
                <div class="card-body">
                    @if (!empty($suite))
                    <div class="row">
                        <div class="col-md-12 col-form-label text-md-left">
                            <label class="" for="id">{{ __('id') }} : </label> {{ $suite->id }}
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="name_ar">{{ __('Arabic Name') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="name_ar" @if(!empty($suite) && old('name_ar',
                                $suite->name_ar))
                            value="{{ $suite->name_ar }}"
                            @else value="{{old('name_ar')}}"
                            @endif>
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="name_ar">{{ __('English Name') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="name_en" @if(!empty($suite) && old('name_en',
                                $suite->name_en))
                            value="{{ $suite->name_en }}"@else value="{{old('name_en')}}"
                            @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-form-label " style="text-align:start">
                            <label for="active">{{ __('Active') }}:</label>
                        </div>
                        <div class="col-8">
                            <input type="checkbox" class="form-check" name="active" value="1" @if(!empty($suite) &&
                                old('active', $suite->active)) checked @else{{old('active')}} @endif> </div>
                    </div>
                    <div class="row">
                        <div class=" @if (!empty($suite)) col-md-2 @else col-md-4 @endif col-form-label "
                            style="text-align:start">
                            <label for="logo_ar">{{ __('logo_ar') }}:</label>
                        </div> @if(!empty($suite))
                        <div class="col-md-2 col-form-label " style="text-align:start">
                            <img src="{{ asset('storage/suites/' . $suite->logo_ar) }}" class="img-fluid img-thumbnail">
                        </div> @endif <div class="col-8">
                            <input class="form-control" type="file" name="logo_ar">
                        </div>
                    </div>
                    <div class="row">
                        <div class=" @if(!empty($suite)) col-md-2 @else col-md-4 @endif col-form-label "
                            style="text-align:start">
                            <label for="logo_en">{{ __('logo_en') }}:</label>
                        </div> @if (!empty($suite)) <div class="col-md-2 col-form-label " style="text-align:start">
                            <img src="{{ asset('storage/suites/' . $suite->logo_en) }}" class="img-fluid img-thumbnail">
                        </div> @endif <div class="col-8">
                            <input class="form-control" type="file" name="logo_en">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
        <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Contact Info') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="facebook">{{ __('facebook') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="facebook" @if(!empty($suite) && old('facebook',
                                $suite->facebook))
                            value="{{ $suite->facebook }}"
                            @else value="{{old('facebook')}}"
                            @endif>
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="twitter">{{ __('twitter') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="twitter" @if(!empty($suite) && old('twitter',
                                $suite->twitter))
                            value="{{ $suite->twitter }}"@else value="{{old('twitter')}}"
                            @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="whatsapp">{{ __('whatsapp') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="whatsapp" @if(!empty($suite) && old('whatsapp',
                                $suite->whatsapp))
                            value="{{ $suite->whatsapp }}"
                            @else value="{{old('whatsapp')}}"
                            @endif>
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="linkedin">{{ __('linkedin') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="linkedin" @if(!empty($suite) && old('linkedin',
                                $suite->linkedin))
                            value="{{ $suite->linkedin }}"@else value="{{old('linkedin')}}"
                            @endif>
                        </div>
                    </div>
<div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="tel">{{ __('tel') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="tel" @if(!empty($suite) && old('tel',
                                $suite->tel))
                            value="{{ $suite->tel }}"                            @else value="{{old('tel')}}"
                            @endif>
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="mobile">{{ __('mobile') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="mobile" @if(!empty($suite) && old('mobile',
                                $suite->mobile))
                            value="{{ $suite->mobile }}"@else value="{{old('mobile')}}"
                            @endif>
                        </div>
                    </div>
<div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="email">{{ __('email') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="email" @if(!empty($suite) && old('email',
                                $suite->email))
                            value="{{ $suite->email }}"                            @else value="{{old('email')}}"
                            @endif>
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="website">{{ __('website') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="website" @if(!empty($suite) && old('website',
                                $suite->website))
                            value="{{ $suite->website }}"@else value="{{old('website')}}"
                            @endif>
                        </div>
                    </div>
<div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="instegram">{{ __('instegram') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="instegram" @if(!empty($suite) && old('instegram',
                                $suite->instegram))
                            value="{{ $suite->instegram }}" @else value="{{old('instegram')}}"
                            @endif>
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="telegram">{{ __('telegram') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="telegram" @if(!empty($suite) && old('telegram',
                                $suite->telegram))
                            value="{{ $suite->telegram }}"@else value="{{old('telegram')}}"
                            @endif>
                        </div>
                    </div>
<div class="row">
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="address_ar">{{ __('address_ar') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="address_ar" @if(!empty($suite) && old('address_ar',
                                $suite->address_ar))
                            value="{{ $suite->address_ar }}" @else value="{{old('address_ar')}}"
                            @endif>
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="address_en">{{ __('address_en') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="address_en" @if(!empty($suite) && old('address_en',
                                $suite->address_en))
                            value="{{ $suite->address_en }}"@else value="{{old('address_en')}}"
                            @endif>
                        </div>
                    </div>







                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-6 text-md-center">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
        <div class="col-6 text-md-center">
            <a @if(!empty($suite)) href="{{ route('fair.suites',$suite->fair_id) }}"
            @else href="{{ route('fair.suites',$fairId) }}"
            @endif type="button" class="btn btn-secondary">{{ __('Cancel') }}
            </a>
        </div>
    </div>
</form>

@endsection
@section('script') <script>
    function showPass() { var x = document.getElementById("password");
            if (x.type === "password"){ x.type = "text"; }
            else { x.type = "password"; }
        }
        function showPass1() { var x = document.getElementById("password-confirm");
            if (x.type === "password") { x.type = "text"; }
            else { x.type = "password"; }
        }
</script>
@endsection
