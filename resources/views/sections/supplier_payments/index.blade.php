@extends('layouts.master')

@section('main')
    <main class="main">
        {{-- Breadcrumb Section --}}
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item  active">{{ __('lang.supplier_payments') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('layouts.includes.messages')

                {{-- Search Section --}}
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.supplierPayments.index') }}" method="get">
                            <div class="row">
                                <div class="form-group col-12 col-md-1 text-center">
                                    @can('create supplierPayments')
                                        <a href="{{ route('admin.supplierPayments.create') }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-plus"></i></a>
                                    @endcan
                                </div>
                                <div class="form-group col-12 col-md-4 text-center">
                                    {!! Form::select('supplier_id', $suppliers, null, [
                                        'class' => 'form-control',
                                        'placeholder' => __('lang.supplier'),
                                    ]) !!}
                                </div>
                                <div class="form-group col-12 col-md-2 text-center">
                                    {!! Form::date('from', null, ['class' => 'form-control', 'placeholder' => __('lang.from')]) !!}
                                </div>
                                <div class="form-group col-12 col-md-2 text-center">
                                    {!! Form::date('to', null, ['class' => 'form-control', 'placeholder' => __('lang.to')]) !!}
                                </div>
                                <div class="form-group col-12 col-md-1 text-center">
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
                            <div class="col-12 col-md-4 text-center"><strong>{{ __('lang.supplier') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.date') }}</strong></div>
                            <div class="col-12 col-md-3 text-center"><strong>{{ __('lang.amount') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.actions') }}</strong></div>
                        </div>
                    </div>
                </div>

                {{-- Data Section --}}
                @forelse ($supplierPayments as $supplierPayment)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.id') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supplierPayment->id }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.supplier') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supplierPayment->supplier->name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.date') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supplierPayment->date }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.amount') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supplierPayment->amount }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none">
                                            <strong>{{ __('lang.actions') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            <form method="POST"
                                                action="{{ route('admin.supplierPayments.destroy', $supplierPayment->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                @can('view supplierPayments')
                                                    <a href="{{ route('admin.supplierPayments.show', $supplierPayment->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('update supplierPayments')
                                                    <a href="{{ route('admin.supplierPayments.edit', $supplierPayment->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('delete supplierPayments')
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
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="row h5">
                            <div class="col-xs-12 col-md-6 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.total') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">{{ __('lang.total') }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.total') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">{{ $totalSum }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 text-md-center">
                            </div>
                        </div>
                    </div>
                </div>

                {{ $supplierPayments->links() }}
            </div>
        </div>
    </main>
@endsection
