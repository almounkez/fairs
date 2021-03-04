@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Slides') }}
                <a href="{{ route('slide.create',$fair->id) }}">
                    <span class="iconify" data-icon="gridicons-add" data-inline="false" height="36" width="36"></span>
                </a>
            </div>
            <div class="card-body">
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
                        @foreach ($fair->slides as $slide)
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
@endsection
