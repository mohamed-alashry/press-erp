@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('messages.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.roles.index') }}">{{ __('messages.permissions') }}</a>
            </li>
            <li class="breadcrumb-item  active">{{ __('messages.create') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('messages.create') }}</strong>
                    </div>
                    <form class="form-horizontal" action="{{ route('admin.roles.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @include('sections.roles.form')
                        <div class="card-footer">
                            @can('view roles')
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            @endcan
                            <button class="btn btn-sm btn-success" type="submit">
                                <i class="fa fa-save"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
