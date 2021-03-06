@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Subcategory') }}
                @if(!empty($fairId))
                <a href="{{ route('subcategory.create',$fairId) }}">
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
                                <th scope="col">{{ __('Arabic Name') }}</th>
                                <th scope="col">{{ __('English Name') }}</th>
                                <th scope="col">{{ __('hits') }}</th>
                             <th scope="col" width="150">{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $subcategory)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('subcategory.edit', $subcategory->id) }}"><span class="iconify"
                                        data-icon="feather:edit" data-inline="false" height="36" width="36">
                                   {{ $subcategory->id }}</span></a>
                                </th>
                                <td>{{ $subcategory->fair_id }}</td>
                                <td>{{ $subcategory->name_ar }}</td>
                                <td>{{ $subcategory->name_en }}</td>
                                 <td>{{ $subcategory->hits }}</td>
                                                  <div class="btn-group-justified">
                                        <div class="btn-group">
                                            <a class="btn btn-outline-warning rounded-circle"
                                                href="{{route('subcategory.edit',$subcategory->id)}}">
                                                <i class="zmdi zmdi-settings"></i>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <form action="{{ route('subcategory.destroy', $subcategory->id) }}" method="POST">
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
