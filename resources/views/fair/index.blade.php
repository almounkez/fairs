@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Fairs') }}
                    {{-- <a href="{{ route('fair.index') }}">
                        <span class="iconify" data-icon="gridicons-add" data-inline="false" height="36"
                            width="36"></span></a> --}}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Arabic Name') }}</th>
                                <th scope="col">{{ __('English Name') }}</th>
                                <th scope="col">{{ __('Arabic Logo') }}</th>
                                <th scope="col">{{ __('English Logo') }}</th>
                                <th scope="col">{{ __('Start Date') }}</th>
                                <th scope="col">{{ __('End Date') }}</th>
                                <th scope="col">{{ __('active') }}</th>
                                <th scope="col">{{ __('hits') }}</th>
                                <th scope="col" width="150">{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            if (is_array($fairs) || is_object($fairs)){


                            @foreach($fairs as $fair)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('fair.edit', $fair->id) }}"><span class="iconify"
                                                data-icon="feather:edit" data-inline="false" height="36" width="36">
                                                {{ $fair->id }}</span></a>
                                    </th>
                                    <td>
                                        @if (!empty($fair->name_ar))
                                            {{ $fair->name_ar }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($fair->name_en))
                                            {{ $fair->name_en }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($fair->start_date))
                                            {!! $fair->start_date !!} @endif
                                    </td>
                                    <td>
                                        @if (!empty($fair->end_date))
                                            {!! $fair->end_date !!} @endif
                                    </td>

                                    <td><img src="{{ asset('storage/fairs/' . $fair->logo_en) }}" width="25%"
                                            class="img-fluid img-thumbnail">
                                    </td>

                                    <td><img src="{{ asset('storage/fairs/' . $fair->logo_ar) }}" width="25%"
                                            class="img-fluid img-thumbnail">
                                    </td>
                                    <td>

                                        <form action="{{ route('fair.destroy', $fair->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button Type="submit" class="iconify" data-icon="clarity:remove-line"
                                                data-inline="false" height="36" width="36">
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            }
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
