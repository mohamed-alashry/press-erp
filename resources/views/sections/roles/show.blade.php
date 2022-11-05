@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('messages.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.roles.index') }}">{{ __('messages.permissions') }}</a>
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
                                    <div class="col-12 col-md-10">{{ $role->id }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-2"><strong>{{ __('messages.name') }}</strong></div>
                                    <div class="col-12 col-md-10">{{ $role->name }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <strong class="col-md-3">{{ __('messages.permissions') }}<span
                                            class="text-danger"></span></strong>
                                    @foreach ($allActions as $action)
                                        <strong class="col-md-1 px-0">{{ __('messages.' . $action) }}</strong>
                                    @endforeach
                                </div>
                                @foreach ($allPages as $page)
                                    <div class="row">
                                        <label class="col-md-3">{{ __('messages.' . $page) }}</label>
                                        @foreach ($allActions as $action)
                                            @php
                                                $permissionName = $action . ' ' . $page;
                                            @endphp
                                            @if (in_array($permissionName, $allPermissions) && $role->hasPermissionTo($permissionName))
                                                <div class="col-md-1">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                            @else
                                                <div class="col-md-1">
                                                    <i class="fa fa-minus"></i>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        @can('view roles')
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        @endcan
                        @can('update roles')
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
