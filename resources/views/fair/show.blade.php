@extends('layouts.app')

@section('content')
<div class="row mb-2">
    <div class="col-12">
        <div class="card">

            <div id="masterSlides" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    {{-- @Admin --}}

                    <a class="btn btn-sm btn-outline-primary rounded-circle" href="{{route('slide.create',$fair->id)}}">
                        <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
                    </a>

                    {{-- @endAdmin --}}
                    @for ($i = 0; $i < count($fair->slides); $i++) <li data-target="#masterSlides"
                            data-slide-to="{{ $i }}" @if ($i==0) class="active" @endif>
                        </li>
                        @endfor
                </ul>
                <!-- wrapper for slides -->
                <div class="row"></div>
                <div class="carousel-inner h-50" role="listbox" style="max-height:300px !important">
                    @foreach ($fair->slides as $key => $slide)
                    <div class="carousel-item @if ($key==0) active @endif">
                        <img src="{{ asset('/storage/slides/' . $slide->imgfile) }}"
                            class="img-fluid carousel-inner img-thumbnail">
                    </div>

                    @endforeach
                    <!-- Controlls -->
                    <a class="carousel-control-prev" href="#masterSlides" data-slide="prev"><span
                            class="carousel-control-prev-icon"></span></a>
                    <a class="carousel-control-next" href="#masterSlides" data-slide="next"><span
                            class="carousel-control-next-icon"></span></a>

                    <!-- End Controlls -->
                </div>
                <!-- end of wrapper -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 my-2">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
                @lang('categories')
            </a>
            @foreach ($fair->categories as $category)
            <a href="#" class="list-group-item list-group-item-action">
                <h5 class="card-header d-flex align-items-center justify-content-center h-100">
                    @if (config('app.locale') == 'ar')
                    {{ $category->name }}
                    @else
                    {{ $category->name_en }}
                    @endif
                </h5>
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            @foreach ($fair->suites as $suite)

            @endforeach
        </div>
    </div>
</div>


@endsection

{{-- @section('script')
<script>
    function fbs_click() {
                                u = location.href;
                                t = document.title;
                                window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' +
                                    encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
                                return false;
                            }

</script>
@endsection --}}
