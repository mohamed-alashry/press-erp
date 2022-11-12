@extends('layouts.master')

@section('main')
    <main class="main">
        {{-- Breadcrumb Section --}}
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item  active">{{ __('lang.transactions') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('layouts.includes.messages')

                {{-- Safe Section --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-12">
                                <h3>{{ __('lang.safe_balance') }}</h3>
                                <h3>{{ $safe->balance }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Search Section --}}
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.transactions.index') }}" method="get">
                            <div class="row">
                                <div class="form-group col-12 col-md-1 text-center">
                                </div>
                                <div class="form-group col-12 col-md-3 text-center">
                                    <input class="form-control" type="text" name="desc"
                                        placeholder="{{ __('lang.desc') }}" value="{{ old('desc') }}">
                                </div>
                                <div class="form-group col-12 col-md-2 text-center">
                                </div>
                                <div class="form-group col-12 col-md-2 text-center">
                                    {!! Form::select('type', ['add' => __('lang.add'), 'deduct' => __('lang.deduct')], null, [
                                        'class' => 'form-control',
                                        'placeholder' => __('lang.type'),
                                    ]) !!}
                                </div>
                                <div class="form-group col-12 col-md-3 text-center">
                                </div>
                                <div class="form-group col-12 col-md-1 text-center">
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
                            <div class="col-12 col-md-3 text-center"><strong>{{ __('lang.desc') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.amount') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.type') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.prev_balance') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.current_balance') }}</strong>
                            </div>
                            {{-- <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.actions') }}</strong></div> --}}
                        </div>
                    </div>
                </div>

                {{-- Data Section --}}
                @forelse ($transactions as $transaction)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.id') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $transaction->id }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.desc') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            <a href="{{ getTransactionTypeUrl($transaction) }}" target="_blank">
                                                {{ $transaction->desc }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.amount') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $transaction->amount }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.type') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            {{ $transaction->type == 'add' ? __('lang.add') : __('lang.deduct') }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.prev_balance') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $transaction->prev_balance }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none">
                                            <strong>{{ __('lang.current_balance') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $transaction->current_balance }}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none">
                                            <strong>{{ __('lang.actions') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            @can('view transactions')
                                                <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            @endcan
                                        </div>
                                    </div>
                                </div> --}}
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
                            <div class="col-xs-12 col-md-4 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.total') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">{{ __('lang.total') }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.amount') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">{{ $amountSum }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.type') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">
                                        {{ __('lang.' . request('type', '-')) }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 text-md-center">
                            </div>
                            <div class="col-12 col-md-2 text-md-center">
                            </div>
                        </div>
                    </div>
                </div>

                {{ $transactions->links() }}
            </div>
        </div>
    </main>
@endsection
