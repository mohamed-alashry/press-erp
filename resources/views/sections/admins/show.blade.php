@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('messages.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.admins.index') }}">{{ __('messages.admins') }}</a>
            </li>
            <li class="breadcrumb-item  active">{{ __('messages.show') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('messages.show') }}
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('messages.id') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $admin->id }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('messages.name') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $admin->name }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('messages.email') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $admin->email }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('messages.position') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $admin->position }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('messages.status') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ __('messages.status_' . $admin->status) }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        @can('view admins')
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        @endcan
                        @can('update admins')
                            <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
