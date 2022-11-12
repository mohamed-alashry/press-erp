@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.orders.index') }}">{{ __('lang.orders') }}</a>
            </li>
            <li class="breadcrumb-item  active">{{ __('lang.show') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('lang.show') }}
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('lang.id') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $order->id }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('lang.client') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $order->client->name }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('lang.desc') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $order->desc }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('lang.quantity') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $order->quantity }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('lang.total_price') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $order->total_price }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('lang.notes') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $order->notes }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"><strong>{{ __('lang.colors') }}</strong></div>
                                        <div class="col-12 col-md-2"><strong>{{ __('lang.quantity') }}</strong></div>
                                        <div class="col-12 col-md-2"><strong>{{ __('lang.price') }}</strong></div>
                                        <div class="col-12 col-md-6"><strong>{{ __('lang.total_price') }}</strong></div>
                                    </div>
                                    @foreach ($order->colorItems as $colorItem)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-12 col-md-2"><strong>{{ $colorItem->color->name }}</strong>
                                                </div>
                                                <div class="col-12 col-md-2">{{ $colorItem->quantity }}</div>
                                                <div class="col-12 col-md-2">{{ $colorItem->price }}</div>
                                                <div class="col-12 col-md-6">{{ $colorItem->total_price }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        @can('view orders')
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        @endcan
                        @can('update orders')
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
