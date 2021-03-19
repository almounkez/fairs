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
                                <th scope="col">{{ __('source') }}</th>
                                
                                <th scope="col">{{ __('') }}</th>
                                <th scope="col">{{ __('Control') }}</th>
                                <th scope="col">{{ __('Arabic Text') }}</th>
                                <th scope="col">{{ __('English Text') }}</th>
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
                                    @if (!empty($mailList->newstext_ar))
                                    {{ $mailList->newstext_ar }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mailList->newstext_en))
                                    {{ $mailList->newstext_en }}
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
