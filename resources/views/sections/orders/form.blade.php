<div class="card-body">
    @include('layouts.includes.messages')
    <div class="row">
        <div class="col-lg-9">
            @if (!isset($order))
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="client_id">{{ __('lang.client') }}<span
                            class="text-danger">
                            *</span></label>
                    <div class="col-md-9">
                        <select name="client_id" id="client_id"
                            class="form-control {{ $errors->first('desc') ? 'is-invalid' : '' }}">
                            <option value="">{{ __('lang.client') }}</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('client_id', isset($order) ? $order->client_id : '') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->first('client_id'))
                            <div class="invalid-feedback">{{ $errors->first('client_id') }}</div>
                        @endif
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="desc">{{ __('lang.desc') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('desc') ? 'is-invalid' : '' }}" id="desc"
                        type="text" name="desc" placeholder="{{ __('lang.desc') }}"
                        value="{{ old('desc', isset($order) ? $order->desc : '') }}">
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
                    <input class="form-control {{ $errors->first('quantity') ? 'is-invalid' : '' }}" id="quantity"
                        type="text" name="quantity" placeholder="{{ __('lang.quantity') }}"
                        value="{{ old('quantity', isset($order) ? $order->quantity : '') }}">
                    @if ($errors->first('quantity'))
                        <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="notes">{{ __('lang.notes') }}</label>
                <div class="col-md-9">
                    <textarea class="form-control {{ $errors->first('notes') ? 'is-invalid' : '' }}" name="{{ 'notes' }}"
                        rows="3" placeholder="{{ __('lang.notes') }}">{{ old('notes', isset($order) ? $order->notes : '') }}</textarea>
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
                        {{ $color->colorItems->color->name ?? $color->name }}
                    </label>
                    <div class="col-md-2">
                        {{ __('lang.quantity') }}
                        <input
                            class="form-control {{ $errors->first('colors.' . $color->id . '.quantity') ? 'is-invalid' : '' }}"
                            id="quantity" type="text" name="{{ 'colors[' . $color->id . '][quantity]' }}"
                            placeholder="{{ __('lang.quantity') }}"
                            value="{{ old('colors.' . $color->id . '.quantity', isset($order) ? $color->quantity : 0) }}">
                    </div>
                    <div class="col-md-2">
                        {{ __('lang.price') }}
                        <input
                            class="form-control {{ $errors->first('colors.' . $color->id . '.price') ? 'is-invalid' : '' }}"
                            id="price" type="text" name="{{ 'colors[' . $color->id . '][price]' }}"
                            placeholder="{{ __('lang.price') }}"
                            value="{{ old('colors.' . $color->id . '.price', isset($order) ? $color->price : $color->price) }}">
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
