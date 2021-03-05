@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            {{-- {{dd($suiteId)}} --}}
            <div class="card-header">{{ __('Marquee') }}
                <a class="btn btn-sm btn-outline-primary rounded-circle"
                @if(!empty($suiteId)) href="{{route('marquee.createForSuite',$suiteId)}}"
                @elseif(!empty($fairId)) href="{{route('marquee.createForFair',$fairId)}}"
                @endif
                >
                    <i class="zmdi zmdi-plus zmdi-hc-lg"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Arabic Text') }}</th>
                                <th scope="col">{{ __('English Text') }}</th>
                                <th scope="col" width="150">{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marquees as $marquee)
                            <tr>
                                <th scope="row">
                                    {{$marquee->id}}
                                </th>
                                <td>
                                    @if (!empty($marquee->newstext_ar))
                                    {{ $marquee->newstext_ar }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($marquee->newstext_en))
                                    {{ $marquee->newstext_en }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group-justified">
                                        <div class="btn-group">
                                            <a class="btn btn-outline-secondary rounded-circle"
                                                href="{{ route('marquee.edit', $marquee->id) }}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <form action="{{ route('marquee.destroy', $marquee->id) }}" method="POST">
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
