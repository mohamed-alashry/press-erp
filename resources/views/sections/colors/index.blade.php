@extends('layouts.master')

@section('main')
    <main class="main">
        {{-- Breadcrumb Section --}}
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item  active">{{ __('lang.colors') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('layouts.includes.messages')

                {{-- Search Section --}}
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.colors.index') }}" method="get">
                            <div class="row">
                                <div class="form-group col-12 col-md-1 text-center">
                                    @can('create colors')
                                        <a href="{{ route('admin.colors.create') }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-plus"></i></a>
                                    @endcan
                                </div>
                                <div class="form-group col-12 col-md-4 text-center">
                                    <input class="form-control" type="text" name="name"
                                        placeholder="{{ __('lang.name') }}" value="{{ old('name') }}">
                                </div>
                                <div class="form-group col-12 col-md-5 text-center">
                                </div>
                                <div class="form-group col-12 col-md-2 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="fa fa-search"></i></button>
                                    <button type="button" class="btn btn-secondary btn-sm search-reset"><i
                                            class="fa fa-ban"></i></button>
                                </div>
                            </div>
                            <!-- /.row-->
                        </form>
                    </div>
                </div>

                {{-- Header Section --}}
                <div class="card d-none d-md-block">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.id') }}</strong></div>
                            <div class="col-12 col-md-4 text-center"><strong>{{ __('lang.name') }}</strong></div>
                            <div class="col-12 col-md-5 text-center"><strong>{{ __('lang.price') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.actions') }}</strong></div>
                        </div>
                    </div>
                </div>

                {{-- Data Section --}}
                @forelse ($colors as $color)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.id') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $color->id }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.name') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $color->name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.price') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $color->price }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none">
                                            <strong>{{ __('lang.actions') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            <form method="POST" action="{{ route('admin.colors.destroy', $color->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                @can('view colors')
                                                    <a href="{{ route('admin.colors.show', $color->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('update colors')
                                                    <a href="{{ route('admin.colors.edit', $color->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                {{-- @can('delete colors')
                                                    <button type="submit" class="btn btn-danger btn-sm delete-form">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan --}}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body text-center text-danger">
                            {{ __('lang.noData') }}
                        </div>
                    </div>
                @endforelse

                {{ $colors->links() }}
            </div>
        </div>
    </main>
@endsection
