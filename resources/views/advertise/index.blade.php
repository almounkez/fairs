@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('advertise') }}
                @if(!empty($fairId))
                <a href="{{ route('advertise.create',$fairId) }}">
                    <span class="iconify" data-icon="gridicons-add" data-inline="false" height="36" width="36">
                    </span>
                </a>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('fair no') }}</th>
                                <th scope="col">{{ __('location') }}</th>
                                <th scope="col">{{ __('active') }}</th>
                                <th scope="col">{{ __('start_date') }}</th>
                                <th scope="col">{{ __('end_date') }}</th>
                                <th scope="col">{{ __('hits') }}</th>
                                <th scope="col">{{ __('imgfile') }}</th>
                                <th scope="col" width="150">{{ __('Control') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $advertise)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('advertise.edit', $advertise->id) }}"><span class="iconify"
                                        data-icon="feather:edit" data-inline="false" height="36" width="36">
                                   {{ $advertise->id }}</span></a>
                                </th>
                                <td>{{ $advertise->fair_id }}</td>
                                <td>{{ $advertise->location }}</td>
                                <td>{{ $advertise->active }}</td>
                                <td>{{ $advertise->start_date }}</td>
                                <td>{{ $advertise->end_date }}</td>
                                <td>{{ $advertise->hits }}</td>
                                <td style="width:20% ; max-width:24%;"><img src="{{ asset('storage/advertise/' . $advertise->imgfile) }}"
                                        class="img-fluid img-thumbnail"></td>
                                <td>
                                    <div class="btn-group-justified">
                                        {{-- <div class="btn-group">
                                            <a class="btn btn-outline-warning rounded-circle"
                                                href="{{route('advertise.edit',$advertise->id)}}">
                                                <i class="zmdi zmdi-settings"></i>
                                            </a>
                                        </div> --}}
                                        <div class="btn-group">
                                            <form action="{{ route('advertise.destroy', $advertise->id) }}" method="POST">
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
