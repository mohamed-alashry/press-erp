@extends('layouts.master')

@section('main')
    <main class="main">
        {{-- Breadcrumb Section --}}
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item  active">{{ __('lang.orders') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('layouts.includes.messages')

                {{-- Search Section --}}
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.orders.index') }}" method="get">
                            <div class="row">
                                <div class="form-group col-12 col-md-1 text-center">
                                    @can('create orders')
                                        <a href="{{ route('admin.orders.create') }}" class="btn btn-success btn-sm"><i
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
                            <div class="col-12 col-md-4 text-center"><strong>{{ __('lang.desc') }}</strong></div>
                            <div class="col-12 col-md-5 text-center"><strong>{{ __('lang.total_price') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.actions') }}</strong></div>
                        </div>
                    </div>
                </div>

                {{-- Data Section --}}
                @forelse ($orders as $order)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.id') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $order->id }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.desc') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $order->desc }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.total_price') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $order->total_price }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none">
                                            <strong>{{ __('lang.actions') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                @can('view orders')
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('update orders')
                                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('delete orders')
                                                    <button type="submit" class="btn btn-danger btn-sm delete-form">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
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

                {{ $orders->links() }}
            </div>
        </div>
    </main>
@endsection
