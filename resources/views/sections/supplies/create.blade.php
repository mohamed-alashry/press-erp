@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.supplies.index') }}">{{ __('lang.supplies') }}</a>
            </li>
            <li class="breadcrumb-item  active">{{ __('lang.create') }}</li>
        </ol>
        {{-- <livewire:supply.form /> --}}
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('lang.create') }}</strong>
                    </div>
                    <form class="form-horizontal" action="{{ route('admin.supplies.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @include('sections.supplies.form')
                        <div class="card-footer">
                            @can('view supplies')
                                <a href="{{ route('admin.supplies.index') }}" class="btn btn-sm btn-secondary">
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