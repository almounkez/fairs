@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Suites') }}
                <a class="btn btn-sm btn-outline-primary zmdi-hc-lg" href="{{ route('suite.create',$fair) }}">
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

                                {{-- <a href="{{ route('suite.edit', $suite->id) }}"><span class="iconify"
                                    data-icon="feather:edit" data-inline="false" height="36" width="36">
                                    {{ $suite->id }}
                                </span>
                                </a> --}}
                                {{ $suite->id }}
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

                                <input type="checkbox" @if($suite->active) checked @endif disabled>
                            </td>


                            <td><img src="{{ asset('storage/suites/' . $suite->logo_en) }}" width="25%"
                                    class="img-fluid img-thumbnail">
                            </td>

                            <td><img src="{{ asset('storage/suites/'. $suite->logo_ar) }}" width="25%"
                                    class="img-fluid img-thumbnail">
                            </td>
                            <td>
                                {{ $suite->hits }}</td>
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
@endsection
