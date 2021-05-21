@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Fairs') }}

                <a class="btn btn-sm btn-outline-primary rounded-circle" href="{{ route('fair.create') }}">
                    <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
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
                                <th scope="col" width="20%">{{ __('Control') }}</th>
                            </tr>
                        </thead>

                        @foreach ($fairs as $fair)

                        <th scope="row">
                            {{ $fair->id }}
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
                        <td>{{ $fair->active }} </td>


                        <td style="width:20% ; max-width:24%;"><img src="{{ asset('storage/fairs/' . $fair->logo_en) }}"
                                class="img-fluid img-thumbnail">
                        </td>

                        <td style="width:20% ; max-width:24%;"><img src="{{ asset('storage/fairs/' . $fair->logo_ar) }}"
                                class="img-fluid img-thumbnail">
                        </td>
                        <td>{{ $fair->hits }}</td>




                        <td style="width: 25%">
                            <div class="btn-group-justified mb-2">
                                <div class="btn-group">
                                    <a class="btn btn-outline-warning" href="{{route('fair.suites',$fair->id)}}">
                                        @lang('Suites')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-info" href="{{route('fair.slides',$fair->id)}}">
                                        {{-- <i class="zmdi zmdi-settings"></i> --}}
                                        @lang('Slides')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-success" href="{{route('fair.categories',$fair->id)}}">
                                        {{-- <i class="zmdi zmdi-settings"></i> --}}
                                        @lang('Categories')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-success" href="{{route('fair.subcategories',$fair->id)}}">
                                        {{-- <i class="zmdi zmdi-settings"></i> --}}
                                        @lang('SubCategories')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-success" href="{{route('fair.advertises',$fair->id)}}">
                                        {{-- <i class="zmdi zmdi-settings"></i> --}}
                                        @lang('Advertises')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-success" href="{{route('fair.marquees',$fair->id)}}">
                                        {{-- <i class="zmdi zmdi-settings"></i> --}}
                                        @lang('Marquee')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-success" href="{{route('fair.mailLists',$fair->id)}}">
                                        {{-- <i class="zmdi zmdi-settings"></i> --}}
                                        @lang('MailLists')
                                    </a>
                                </div>
                            </div>
                            <div class="btn-group-justified">
                                <div class="btn-group">
                                    <a class="btn btn-outline-secondary rounded-circle"
                                        href="{{ route('fair.edit', $fair->id) }}">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <form action="{{ route('fair.destroy', $fair->id) }}" method="POST">
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
