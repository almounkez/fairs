@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            {{-- {{dd($suiteId)}} --}}
            <div class="card-header">{{ __('MailList') }}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Source_name') }}</th>
                                <th scope="col">{{ __('Source_type') }}</th>
                                <th scope="col">{{ __('Full_name') }}</th>
                                <th scope="col">{{ __('Country') }}</th>
                                <th scope="col">{{ __('City') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Mobile') }}</th>
                                <th scope="col">{{ __('Created_at') }}</th>
                                <th scope="col">{{ __('Control') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mailLists as $mailList)
                            <tr>
                                <th scope="row">
                                    {{$mailList->id}}
                                </th>
                                <td>
                                    @if ($mailList->source_id!=null && !empty($mailList->source_id))
                                    @if (config('app.locale') == 'ar')
                                    {{ $mailList->source->name_ar}}
                                    @else
                                    {{ $mailList->source->name_en}}
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mailList->source_type))
                                    {{ $mailList->source_type }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mailList->full_name))
                                    {{ $mailList->full_name }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mailList->country))
                                    {{ $mailList->country }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mailList->city))
                                    {{ $mailList->city }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mailList->email))
                                    {{ $mailList->email }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mailList->mobile))
                                    {{ $mailList->mobile }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mailList->created_at))
                                    {{ $mailList->created_at }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group-justified">
                                        <div class="btn-group">
                                            <form action="{{ route('mailList.destroy', $mailList->id) }}" method="POST">
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
