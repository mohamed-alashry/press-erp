@extends('layouts.master')

@section('main')
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.transactions.index') }}">{{ __('lang.transactions') }}</a>
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.orders_total') }}</h4>
                                        <h3 class="card-text">{{ $ordersSum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.client_payments_total') }}</h4>
                                        <h3 class="card-text">{{ $clientPaymentsSum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-warning mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.rest') }}</h4>
                                        <h3 class="card-text">{{ $ordersSum - $clientPaymentsSum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.supplies_total') }}</h4>
                                        <h3 class="card-text">{{ $suppliesSum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.supplier_payments_total') }}</h4>
                                        <h3 class="card-text">{{ $supplierPaymentsSum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-warning mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.rest') }}</h4>
                                        <h3 class="card-text">{{ $suppliesSum - $supplierPaymentsSum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.partner_payments_total') }}</h4>
                                        <h3 class="card-text">{{ $partnerPaymentsSum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.expenses_total') }}</h4>
                                        <h3 class="card-text">{{ $expensesSum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-warning mb-3">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ __('lang.total') }}</h4>
                                        <h3 class="card-text">{{ $partnerPaymentsSum + $expensesSum }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="card bg-light mb-3">
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ __('lang.safe_balance') }}</h4>
                                <h3 class="card-text">{{ $safeBalance }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
