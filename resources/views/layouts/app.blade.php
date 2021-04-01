<!doctype html>
<html dir="{{ str_replace('_', '-', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr' }}"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}" style='height: 100%;'>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>



        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/zmdi.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sticky-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/material-design-iconic-font.min.css') }}">


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
                                    <a class="dropdown-item" href="{{ route('fair.index') }}"> @lang('Fairs List')
                                    </a>
                                    <a class="dropdown-item" href="{{ route('mailList.index') }}"> @lang('Mail List')
                                    </a>

                                    <a class="dropdown-item" href="{{ route('fair.create') }}">@lang('New Fair')
                                    </a>
                                    @if(!empty($fairId))
                                    <a class="dropdown-item" href="{{ route('fair.slides',$fairId) }}">
                                        @lang('current
                                        fair slides')</a>
                                    <a class="dropdown-item" href="{{ route('fair.categories',$fairId) }}">
                                        @lang('current fair categories') </a>
                                    <a class="dropdown-item" href="{{ route('fair.marquees',$fairId) }}">@lang('current
                                        fair marquees')</a>
                                    <a class="dropdown-item"
                                        href="{{ route('fair.advertises',$fairId) }}">@lang('current fair
                                        advertises')</a>
                                    <a class="dropdown-item"
                                        href="{{ route('fair.mailLists',$fairId) }}">@lang('current fair
                                        maiList')</a>
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
                                        @lang('Marquees')
                                    </a><a class="dropdown-item"
                                        href="{{ route('suite.mailLists',Auth::user()->suite) }}">
                                        @lang('MailList')
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

            {{-- Marquee --}}
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
            {{-- End Marquee --}}

            {{-- validation error message --}}
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            {{-- End validation meesage --}}

            {{-- advertises --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-12 p-1">
                        @if(!empty($advertises_silver))
                        <div class="card">
                            <div class="card-body p-0">
                                <div id="carousel-silver" class="carousel slide" data-ride="carousel"
                                    data-interval="5000">
                                    <div class="carousel-inner" role="listbox" style="max-height:80px !important">
                                        @foreach ($advertises_silver as $silver)
                                        <div class="carousel-item @if($loop->first) active @endif"
                                            style="text-align:center;">
                                            <a href="{{route('suite.show',$silver->suite_id)}}">
                                                <img src="{{ asset('storage/advertises/'.$silver->imgfile)}}"
                                                    class="img-fluid carousel-inner" />
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-7 col-12 p-1">
                        @if(!empty($advertises_gold))
                        <div class="card">
                            <div class="card-body p-0">
                                <div id="carousel-gold" class="carousel slide" data-ride="carousel"
                                    data-interval="7500">
                                    <div class="carousel-inner" role="listbox" style="max-height:80px !important">
                                        @foreach ($advertises_gold as $gold)
                                        <div class="carousel-item @if ($loop->first) active @endif"
                                            style="text-align:center;">
                                            <a href="{{route('suite.show',$gold->suite_id)}}">
                                                <img src="{{ asset('/storage/advertises/' . $gold->imgfile) }}"
                                                    class="img-fluid carousel-inner ">
                                            </a>
                                        </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-2 col-12 p-1">
                        @if(!empty($advertises_bronze))
                        <div class="card">
                            <div class="card-body p-0">
                                <div id="carousel-bronze" class="carousel slide" data-ride="carousel"
                                    data-interval="3500">
                                    <div class="carousel-inner" role="listbox" style="max-height:80px !important">
                                        @foreach ($advertises_bronze as $bronze)
                                        <div class="carousel-item @if ($loop->first) active @endif"
                                            style="text-align:center;">
                                            <a href="{{route('suite.show',$bronze->suite_id)}}">
                                                <img src="{{ asset('/storage/advertises/' . $bronze->imgfile) }}"
                                                    class="img-fluid carousel-inner ">
                                            </a>
                                        </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- End advertises --}}

            {{-- main content --}}
            <main class="container-fluid" style="margin-bottom: 100px">
                @yield('content')
            </main>
            {{-- end main content --}}
            {{-- start footer --}}
            <footer class="font-small purple pt-4 mt-2 bg-secondary text-white">
                {{-- <footer class="footer font-small pt-4 bg-secondary text-white"> --}}
                <!-- Footer Links -->
                <div class="container-fluid text-justify">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col mt-md-0 mt-3 border-left border-right border-dark">
                            <!-- Content -->
                            <h5 class="text-uppercase">{{__('About Us')}}</h5>
                            @yield('footer.About')
                            {{-- <p>Here you can use rows and columns to organize your footer content.</p> --}}
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        @yield('footer.connectList')

                        <!-- Grid column -->
                        <!-- Grid column -->
                        @yield('footer.subscribe')
                        {{-- </div> --}}
                        <!-- Grid column -->

                    </div>
                    <!-- Grid row -->

                </div>
                <!-- Footer Links -->

                <!-- Copyright -->
                <div class="footer-copyright text-center py-2 mt-2 bg-dark">
                    © 2021 Copyright:
                    <a class="text-warning" href="https://www.almounkez.com" target="_blank">Innovative Systems</a>
                    {{-- © 2018 Copyright:
                    <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a> --}}
                </div>
                <!-- Copyright -->

            </footer>
            {{-- End footer --}}
        </div>
        {{-- End app div --}}

        {{-- Scripts  --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
        {{-- <script src="{{ asset('js/iconify.min.js') }}"></script> --}}
        @yield('script')
        {{-- End Scripts --}}
    </body>

</html>
