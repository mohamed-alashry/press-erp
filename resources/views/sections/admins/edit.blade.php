@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('messages.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.admins.index') }}">{{ __('messages.admins') }}</a>
            </li>
            <li class="breadcrumb-item  active">{{ __('messages.edit') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('messages.edit') }}</strong>
                    </div>
                    <form class="form-horizontal" action="{{ route('admin.admins.update', $admin->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('sections.admins.form')
                        <div class="card-footer">
                            @can('view admins')
                                <a href="{{ route('admin.admins.index') }}" class="btn btn-sm btn-secondary">
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
