@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Products') }}
                    {{-- <a href="{{ route('product.create', $suite->id) }}"> --}}
                        <span class="iconify" data-icon="gridicons-add" data-inline="false" height="36" width="36"></span>
                    {{-- </a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('id') }}</th>
                                <th scope="col">{{ __('suite_id') }}</th>
                                <th scope="col">{{ __('Category') }}</th>
                                <th scope="col">{{ __('Subegory') }}</th>
                                <th scope="col">{{ __('name_ar') }}</th>
                                <th scope="col">{{ __('name_en') }}</th>
                                <th scope="col">{{ __('active') }}</th>
                                <th scope="col">{{ __('descp_ar') }}</th>
                                <th scope="col">{{ __('descp_en') }}</th>
                                <th scope="col">{{ __('hits') }}</th>
                                <th scope="col">{{ __('imgfile') }}</th>
                                <th scope="col">{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->suite_id }}</td>
                                    <td>
                                        @if (!empty($product->category))
                                            @if (config('app.locale') == 'ar')
                                                {{ $product->category->name }}
                                            @else
                                                {{ $product->category->name_en }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $product->sub_id }}</td>


                                    <td>{{ $product->name_ar }}</td>
                                    <td>{{ $product->name_en }}</td>

                                    <td>{{ $product->active }}</td>
                                    <td>{{ $product->descp_ar }}</td>
                                    <td>{{ $product->descp_en }}</td>
                                    <td>{{ $product->hits }}</td>
                                    <td style="width:20% ; max-width:24%;"><img src="{{ asset('storage/products/' . $product->imgfile) }}
                                            class="img-fluid img-thumbnail">
                                    </td>
                                    <td>
                                        <div class="btn-group-justified">
                                            <div class="btn-group">
                                                <a class="btn btn-outline-warning rounded-circle"
                                                    href="{{ route('product.edit', $product->id) }}">
                                                    <i class="zmdi zmdi-settings"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <form action="{{ route('product.destroy', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button Type="submit" class="btn rounded-circle btn-outline-danger"><i
                                                            class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    </td>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table></div>
                </div>
            </div>
        </div>
    </div>
@endsection
