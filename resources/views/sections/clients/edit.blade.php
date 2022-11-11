@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.clients.index') }}">{{ __('lang.clients') }}</a>
            </li>
            <li class="breadcrumb-item  active">{{ __('lang.edit') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('lang.edit') }}</strong>
                    </div>
                    <form class="form-horizontal" action="{{ route('admin.clients.update', $client->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('sections.clients.form')
                        <div class="card-footer">
                            @can('view clients')
                                <a href="{{ route('admin.clients.index') }}" class="btn btn-sm btn-secondary">
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
