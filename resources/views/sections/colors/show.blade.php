@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.colors.index') }}">{{ __('lang.colors') }}</a>
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
                                    <div class="col-12 col-md-10">{{ $color->id }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('lang.name') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $color->name }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('lang.price') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $color->price }}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        @can('view colors')
                            <a href="{{ route('admin.colors.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        @endcan
                        @can('update colors')
                            <a href="{{ route('admin.colors.edit', $color->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
