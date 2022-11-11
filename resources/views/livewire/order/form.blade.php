<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <strong>{{ $order ? __('lang.edit') : __('lang.create') }} {{ __('orders') }}</strong>
            </div>
            {!! Form::open(['wire:submit.prevent' => 'save']) !!}

            <div class="card-body">
                @include('layouts.includes.messages')
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="client_id">{{ __('lang.client') }}<span
                                    class="text-danger">
                                    *</span></label>
                            <div class="col-md-9">
                                {!! Form::select(null, $clients, null, [
                                    'wire:model' => 'client_id',
                                    'class' => 'form-control',
                                    'placeholder' => __('lang.client'),
                                ]) !!}
                                @if ($errors->first('client_id'))
                                    <div class="invalid-feedback">{{ $errors->first('client_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="desc">{{ __('lang.desc') }}<span
                                    class="text-danger">
                                    *</span></label>
                            <div class="col-md-9">
                                {!! Form::text(null, null, [
                                    'wire:model.debounce.500ms' => 'desc',
                                    'class' => 'form-control',
                                    'placeholder' => __('lang.desc'),
                                ]) !!}
                                @if ($errors->first('desc'))
                                    <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="quantity">{{ __('lang.quantity') }}<span
                                    class="text-danger">
                                    *</span></label>
                            <div class="col-md-9">
                                {!! Form::text(null, null, [
                                    'wire:model.debounce.500ms' => 'quantity',
                                    'class' => 'form-control',
                                    'placeholder' => __('lang.quantity'),
                                ]) !!}
                                @if ($errors->first('quantity'))
                                    <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="notes">{{ __('lang.notes') }}</label>
                            <div class="col-md-9">
                                {!! Form::textarea(null, null, [
                                    'wire:model.debounce.500ms' => 'notes',
                                    'class' => 'form-control',
                                    'placeholder' => __('lang.notes'),
                                ]) !!}
                                @if ($errors->first('notes'))
                                    <div class="invalid-feedback">{{ $errors->first('notes') }}</div>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <h4>{{ __('lang.colors') }}</h4>

                        @foreach ($colors as $color)
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    {{ $color->name }}
                                </label>
                                <div class="col-md-2">
                                    {{ __('lang.quantity') }}
                                    {!! Form::text(null, null, [
                                        'wire:model.debounce.500ms' => 'colors.' . $color->id . '.quantity',
                                        'class' => 'form-control',
                                        'placeholder' => __('lang.quantity'),
                                    ]) !!}
                                </div>
                                <div class="col-md-2">
                                    {{ __('lang.price') }}
                                    {!! Form::text(null, null, [
                                        'wire:model.debounce.500ms' => 'colors.' . $color->id . '.price',
                                        'class' => 'form-control',
                                        'placeholder' => __('lang.price'),
                                    ]) !!}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-footer">
                @can('view orders')
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                @endcan
                <button class="btn btn-sm btn-success" type="submit">
                    <i class="fa fa-save"></i>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
