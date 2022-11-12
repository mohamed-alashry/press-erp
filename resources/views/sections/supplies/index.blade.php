@extends('layouts.master')

@section('main')
    <main class="main">
        {{-- Breadcrumb Section --}}
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('lang.home') }}</li>
            <li class="breadcrumb-item  active">{{ __('lang.supplies') }}</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('layouts.includes.messages')

                {{-- Search Section --}}
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.supplies.index') }}" method="get">
                            <div class="row">
                                <div class="form-group col-12 col-md-1 text-center">
                                    @can('create supplies')
                                        <a href="{{ route('admin.supplies.create') }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-plus"></i></a>
                                    @endcan
                                </div>
                                <div class="form-group col-12 col-md-2 text-center">
                                    {!! Form::select('supplier_id', $suppliers, null, [
                                        'class' => 'form-control',
                                        'placeholder' => __('lang.supplier'),
                                    ]) !!}
                                </div>
                                <div class="form-group col-12 col-md-2 text-center">
                                    <input class="form-control" type="text" name="name"
                                        placeholder="{{ __('lang.name') }}" value="{{ old('name') }}">
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
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.supplier') }}</strong></div>
                            <div class="col-12 col-md-2 text-center"><strong>{{ __('lang.name') }}</strong></div>
                            <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.date') }}</strong></div>
                            <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.price') }}</strong></div>
                            <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.quantity') }}</strong></div>
                            <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.base_price') }}</strong></div>
                            <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.discount') }}</strong></div>
                            <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.total_price') }}</strong></div>
                            <div class="col-12 col-md-1 text-center"><strong>{{ __('lang.actions') }}</strong></div>
                        </div>
                    </div>
                </div>

                {{-- Data Section --}}
                @forelse ($supplies as $supply)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.id') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->id }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.supplier') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->supplier->name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.name') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.date') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->date }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.price') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->price }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.quantity') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->quantity }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.base_price') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->base_price }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.discount') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->discount }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('lang.total_price') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">{{ $supply->total_price }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1 text-md-center">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none">
                                            <strong>{{ __('lang.actions') }}</strong>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            <form method="POST"
                                                action="{{ route('admin.supplies.destroy', $supply->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                @can('view supplies')
                                                    <a href="{{ route('admin.supplies.show', $supply->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('update supplies')
                                                    <a href="{{ route('admin.supplies.edit', $supply->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('delete supplies')
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
                                    <div class="col-8 col-md-12">{{ __('lang.totals') }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-1 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.price') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">{{ $priceSum }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-1 text-md-center">
                            </div>
                            <div class="col-12 col-md-1 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.base_price') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">{{ $baseSum }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-1 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.discount') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">{{ $discountSum }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-1 text-md-center">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('lang.total_price') }}</strong>
                                    </div>
                                    <div class="col-8 col-md-12">{{ $totalSum }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $supplies->links() }}
            </div>
        </div>
    </main>
@endsection
