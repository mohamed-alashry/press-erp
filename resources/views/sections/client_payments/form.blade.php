<div class="card-body">
    @include('layouts.includes.messages')
    <div class="row">
        <div class="col-lg-9">
            @if (!isset($clientPayment))
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="client_id">{{ __('lang.client') }}<span
                            class="text-danger">
                            *</span></label>
                    <div class="col-md-9">
                        <select name="client_id" id="client_id"
                            class="form-control {{ $errors->first('client_id') ? 'is-invalid' : '' }}">
                            <option value="">{{ __('lang.client') }}</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('client_id', isset($clientPayment) ? $clientPayment->client_id : '') == $client->id ? 'selected' : '' }}>
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
                <label class="col-md-3 col-form-label" for="amount">{{ __('lang.amount') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('amount') ? 'is-invalid' : '' }}" id="amount"
                        type="text" name="amount" placeholder="{{ __('lang.amount') }}"
                        value="{{ old('amount', isset($clientPayment) ? $clientPayment->amount : '') }}">
                    @if ($errors->first('amount'))
                        <div class="invalid-feedback">{{ $errors->first('amount') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="date">{{ __('lang.date') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control date {{ $errors->first('date') ? 'is-invalid' : '' }}" id="date"
                        type="date" name="date" placeholder="{{ __('lang.date') }}"
                        value="{{ old('date', isset($clientPayment) ? $clientPayment->date : '') }}">
                    @if ($errors->first('date'))
                        <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
