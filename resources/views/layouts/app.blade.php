<!doctype html>
<html dir="{{ str_replace('_', '-', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr' }}"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        </ <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/zmdi.css') }}">
        <link rel="stylesheet" href="{{ asset('css/material-design-iconic-font.min.css') }}">
        <script src="{{ asset('js/iconify.min.js') }}"></script>
    </head>

    <body>
        <div id="app">
            {{-- top navbar --}}


            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                      @if (app()->getLocale() == 'ar')
                            <a class="btn btn-secondary" href="{{ url('locale/en') }}">E</a>
                      @else
                      <a class="btn btn-primary" href="{{ url('locale/ar') }}">ع</a>
                        @endif
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    {{-- @yield('fair')
                    @yield('suite') --}}
                    <?php $fid= $fairId?? $fair->id??$suite->fair_id??null ?>
                    {{-- {{dd($fid)}} --}}

                    @if(!empty($fid))
                    <a class="navbar-brand" href="{{ route('fair.show',$fid) }}">
                        @lang('Current Fair')
                    </a>
                    {{-- @endsection --}}
                    @endif
                    <?php $sid= $suiteId?? $suite->id ?? $product->suite_id ??null ?>
                    {{-- {{dd($sid)}} --}}
                    @if(!empty($sid))
                    <a class="navbar-brand" href="{{ route('suite.show',$sid) }}">
                        @lang('Current Suite')
                    </a>
                    @endif
                    {{-- @yield('fair')
                    @yield('suite')
                    @yield('category') --}}
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Authentication Links -->

                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            @if(Auth::user()->role=='admin')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>@lang('Manage Fair')<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('fair.index') }}"> @lang('Fairs List') </a>
                                    <a class="dropdown-item" href="{{ route('fair.create') }}">@lang('New Fair') </a>
                                    @if(!empty($fairId))
                                    <a class="dropdown-item" href="{{ route('fair.slides',$fairId) }}"> @lang('current
                                        fair slides')</a>
                                    <a class="dropdown-item" href="{{ route('fair.categories',$fairId) }}">
                                        @lang('current fair categories') </a>
                                    <a class="dropdown-item" href="{{ route('fair.marquees',$fairId) }}">@lang('current
                                        fair marquees')</a>
                                    <a class="dropdown-item"
                                        href="{{ route('fair.advertises',$fairId) }}">@lang('current fair
                                        advertises')</a>
                                    @endif
                                </div>

                            </li>
                            @endif
                            @if(Auth::user()->suite!=null)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @lang('Suite')<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('suite.show',Auth::user()->suite) }}">
                                        @lang('Show my suite')
                                    </a>
                                    <a class="dropdown-item" href="{{ route('suite.edit',Auth::user()->suite) }}">
                                        @lang('Edit suite info')
                                    </a>
                                    <a class="dropdown-item" href="{{ route('suite.products',Auth::user()->suite) }}">
                                        @lang('Products')
                                    </a>
                                    <a class="dropdown-item" href="{{ route('suite.slides',Auth::user()->suite) }}">
                                        @lang('Slides')
                                    </a>
                                    <a class="dropdown-item" href="{{ route('suite.articles',Auth::user()->suite) }}">
                                        @lang('Article')
                                    </a>
                                    <a class="dropdown-item" href="{{ route('suite.marquees',Auth::user()->suite) }}">
                                        @lang('marquees')
                                    </a>
                                </div>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- end top navebar --}}
            @if(!empty($marquees))
            <div>
                <marquee class="bg-primary text-white" behavior="scroll" direction=@if (app()->getLocale()
                    =='ar')"right" @else "left" @endif>
                    @foreach ($marquees as $marquee)
                    <span> :: </span>
                    @if (app()->getLocale() == 'ar')
                    {{ $marquee->newstext }}
                    @else
                    {{ $marquee->newstext_en }}
                    @endif
                    @endforeach
                </marquee>
            </div>
            @endif
            {{-- validation error message --}}
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            {{-- end validation meesage --}}
<div class="row mx-2 ">
    <div class="col-lg-3 col-12 p-1">
        @if(!empty($advertises_silver))
        <div class="card" >
          <div class="card-body">
            <div id="carousel-silver" class="carousel slide" data-ride="carousel" data-interval="5000">
              <div class="carousel-inner h-50" role="listbox" style="max-height:100px !important">
                @foreach ($advertises_silver as $silver)
                <div class="carousel-item @if($loop->first) active @endif" style="text-align:center;">
                    <a href="{{route('suite.show',$silver->suite_id)}}">
                        <img src="{{ asset('storage/advertises/'.$silver->imgfile)}}" class="img-fluid carousel-inner"/>
                    </a>
                </div>
                @endforeach
            </div>
            </div>
        </div></div>
        @endif
    </div>
    <div class="col-lg-7 col-12 p-1">
        @if(!empty($advertises_gold))
        <div class="card" >
          <div class="card-body">
            <div id="carousel-gold" class="carousel slide" data-ride="carousel" data-interval="7500">
                <div class="carousel-inner h-50" role="listbox" style="max-height:100px !important">
                    @foreach ($advertises_gold as $gold)
                    <div class="carousel-item @if ($loop->first) active @endif" style="text-align:center;">
                        <a href="{{route('suite.show',$gold->suite_id)}}">
                        <img src="{{ asset('/storage/advertises/' . $gold->imgfile) }}" class="img-fluid carousel-inner ">
                        </a>
                    </div>

                    @endforeach
        </div>
                </div>
            </div></div>
        @endif
    </div>
      <div class="col-lg-2 col-12 p-1">
        @if(!empty($advertises_bronze))
        <div class="card" >
          <div class="card-body">
            <div id="carousel-bronze" class="carousel slide" data-ride="carousel" data-interval="3500">
                <div class="carousel-inner h-50" role="listbox" style="max-height:100px !important">
                    @foreach ($advertises_bronze as $bronze)
                    <div class="carousel-item @if ($loop->first) active @endif" style="text-align:center;">
                        <a href="{{route('suite.show',$bronze->suite_id)}}">
                        <img src="{{ asset('/storage/advertises/' . $bronze->imgfile) }}" class="img-fluid carousel-inner ">
                        </a>
                    </div>

                    @endforeach
        </div>
                </div>
            </div></div>
        @endif
    </div>
</div>
            {{-- main content --}}
            <main class="p-1 m-1">
                @yield('content')
            </main>
            {{-- end main content --}}
<footer class="bg-light text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h6 class="text-uppercase">
                    Footer title 1
                </h6>
                <p>
                            Footer text
                </p>
            </div>
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h6 class="text-uppercase">
                    Footer title 1
                </h6>
                <p>
                            Footer text
                </p>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color:rgb(0,0,0,0.2)">
        @2021 copyright <a class="text-dark" href="https://www.almounkez.com" target="_blank">innovative systems</a>

    </div>
</footer>
        </div>
        @yield('script')
    </body>

</html>
