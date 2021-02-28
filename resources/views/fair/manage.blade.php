@extends('layouts.app')

@section('content')
{{-- {{dd($fair)}} --}}
{{-- manage suites --}}
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Suites') }}
                <a class="btn btn-sm btn-primary zmdi-hc-lg" href="{{ route('suite.create',$fair) }}">
                    <i class="zmdi zmdi-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Arabic Name') }}</th>
                                <th scope="col">{{ __('English Name') }}</th>
                                <th scope="col">{{ __('Start Date') }}</th>
                                <th scope="col">{{ __('End Date') }}</th>
                                <th scope="col">{{ __('active') }}</th>
                                <th scope="col">{{ __('Arabic Logo') }}</th>
                                <th scope="col">{{ __('English Logo') }}</th>
                                <th scope="col">{{ __('hits') }}</th>
                                <th scope="col" width="150">{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suites as $suite)
                            <tr>
                                <th scope="row">
                                    {{$suite->id}}
                                    {{-- <a href="{{ route('suite.edit', $suite->id) }}"><span class="iconify"
                                        data-icon="feather:edit" data-inline="false" height="36" width="36">
                                        {{ $suite->id }}</span>
                                    </a> --}}
                                </th>
                                <td>
                                    @if (!empty($suite->name_ar))
                                    {{ $suite->name_ar }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($suite->name_en))
                                    {{ $suite->name_en }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($suite->start_date))
                                    {!! $suite->start_date !!} @endif
                                </td>
                                <td>
                                    @if (!empty($suite->end_date))
                                    {!! $suite->end_date !!} @endif
                                </td>
                                <td>{{ $suite->active }} </td>


                                <td><img src="{{ asset('storage/suites/' . $suite->logo_en) }}"
                                        class="img-fluid img-thumbnail">
                                </td>

                                <td><img src="{{ asset('storage/suites/'. $suite->logo_ar) }}"
                                        class="img-fluid img-thumbnail">
                                </td>
                                <td>{{ $suite->hits }}</td>
                                <td>

                                    <div class="btn-group-justified">
                                        <div class="btn-group">
                                            <a class="btn btn-outline-warning rounded-circle"
                                                href="{{route('suite.edit',$suite->id)}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <form action="{{ route('suite.destroy', $suite->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button Type="submit" class="btn rounded-circle btn-outline-danger"><i
                                                        class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
{{-- manage Slides --}}
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Slides') }}
                <a href="{{ route('slide.create') }}">
                    <span class="iconify" data-icon="gridicons-add" data-inline="false" height="36" width="36"></span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('id') }}</th>
                                <th scope="col">{{ __('Active') }}</th>
                                <th scope="col">{{ __('Category') }}</th>
                                <th scope="col">{{ __('Subegory') }}</th>
                                <th scope="col">{{ __('Link') }}</th>
                                <th scope="col">{{ __('imgfile') }}</th>
                                <th scope="col">{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slides as $slide)
                            <tr>
                                <th scope="row">
                                    {{-- <a href="{{ route('slide.edit', $slide->id) }}"><span class="iconify"
                                        data-icon="feather:edit" data-inline="false" height="36"
                                        width="36">{{ $slide->id }}</span></a> --}}
                                </th>
                                <td>{{ $slide->active }}</td>
                                <td>
                                    @if (!empty($slide->category))
                                    @if (config('app.locale') == 'ar')
                                    {{ $slide->category->name }}
                                    @else
                                    {{ $slide->category->name_en }}
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($slide->category))
                                    @if (config('app.locale') == 'ar')
                                    {{ $slide->category_sub->name }}
                                    @else
                                    {{ $slide->category_sub->name_en }}
                                    @endif

                                    @endif
                                </td>
                                <td>{{ $slide->link }}</td>

                                <td><img src="{{ asset('storage/slides/' . $slide->imgfile) }}" width="25%"
                                        class="img-fluid img-thumbnail">
                                </td>
                                <td>

                                    <div class="btn-group-justified">
                                        <div class="btn-group">
                                            <a class="btn btn-outline-warning rounded-circle"
                                                href="{{route('slide.edit',$slide->id)}}">
                                                <i class="zmdi zmdi-settings"></i>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <form action="{{ route('slide.destroy', $slide->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button Type="submit" class="btn rounded-circle btn-outline-danger"><i
                                                        class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<hr>
{{-- manage categories --}}
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Category') }}

                <a href="{{ route('category.create') }}">
                    <span class="iconify" data-icon="gridicons-add" data-inline="false" height="36" width="36">
                    </span>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Arabic Name') }}</th>
                                <th scope="col">{{ __('English Name') }}</th>
                                <th scope="col">{{ __('Active') }}</th>
                                <th scope="col">{{ __('Arabic Description') }}</th>
                                <th scope="col">{{ __('English Description') }}</th>
                                <th scope="col">{{ __('imgfile') }}</th>
                                <th scope="col" width="150">{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <th scope="row">
                                    {{-- <a href="{{ route('category.edit', $category->id) }}"><span class="iconify"
                                        data-icon="feather:edit" data-inline="false" height="36" width="36">
                                        {{ $category->id }}</span></a> --}}
                                </th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->name_en }}</td>
                                <td>{{ $category->active }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->description_en }}</td>
                                <td><img src="{{ asset('storage/categories/' . $category->imgfile) }}" width="25%"
                                        class="img-fluid img-thumbnail"></td>
                                <td>
                                    <div class="btn-group-justified">
                                        <div class="btn-group">
                                            <a class="btn btn-outline-warning rounded-circle"
                                                href="{{route('category.edit',$category->id)}}">
                                                <i class="zmdi zmdi-settings"></i>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button Type="submit" class="btn rounded-circle btn-outline-danger"><i
                                                        class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
