@extends('layouts.app') @section('content')
<form action="{!! !empty($suite) ? route('suite.update', $suite) : route('suite.store') !!}" method="Post"
    enctype="multipart/form-data">
    @csrf
    @if (!empty($suite))
    @method('PUT')
    @else <input name="fairId" value="{{$fair->id}}" hidden>
    @endif <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{ __('User') }}</div>
                <div class="card-body">

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-4">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="userName" @if (!empty($suite))value="{{$suite->user->name}}" @endif required
                                autocomplete="name" autofocus>
                            @error('uerName') <span class="invalid-feedback" role="alert">
                                {{-- <strong>{{ $message }}</strong> --}}
                            </span> @enderror </div>
                        <label for="email"
                            class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-4">

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" @if (!empty($suite))value="{{$suite->user->email}}"  @endif
                                autocomplete="email"> @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{-- <strong>{{ $message }}</strong> --}}
                            </span> @enderror </div>
                    </div>
                    <div class="form-group row">

                        <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-4">

                            <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    @if(empty($suite))required @endif autocomplete="new-password">
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
                                    name="password_confirmation" @if(empty($suite))required @endif autocomplete="new-password">
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
    <div class="row justify-content-center">
        <div class="col-md">
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
                            <input class="form-control" type="text" name="name_ar"
                                @if(!empty($suite) && old('name_ar', $suite->name_ar))
                                value="{{ $suite->name_ar }}"
                                @else value="{{old('name_ar')}}"
                            @endif>
                        </div>
                        <div class="col-md-2 col-form-label text-md-left">
                            <label for="name_ar">{{ __('English Name') }}:</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="name_en"
                               @if(!empty($suite) && old('name_en', $suite->name_en))
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
                            <img src="{{ asset('storage/suites/' . $suite->logo_ar) }}" class="img-fluid img-thumbnail"
                                width="64%">
                        </div> @endif <div class="col-8">
                            <input class="form-control" type="file" name="logo_ar" @if(empty($suite)) required @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" @if(!empty($suite)) col-md-2 @else col-md-4 @endif col-form-label "
                            style="text-align:start">
                            <label for="logo_en">{{ __('logo_en') }}:</label>
                        </div> @if (!empty($suite)) <div class="col-md-2 col-form-label " style="text-align:start">
                            <img src="{{ asset('storage/suites/' . $suite->logo_en) }}" class="img-fluid img-thumbnail"
                                width="64%">
                        </div> @endif <div class="col-8">
                            <input class="form-control" type="file" name="logo_en" @if(empty($suite)) required @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-md-center">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                        <div class="col-6 text-md-center">
                            <a href="{{ route('suite.index') }}" type="button"
                                class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> @endsection
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
