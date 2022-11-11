<div class="card-body">
    @include('layouts.includes.messages')
    <div class="row">
        <div class="col-lg-9">
            @if (!isset($partnerPayment))
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="partner_id">{{ __('lang.partner') }}<span
                            class="text-danger">
                            *</span></label>
                    <div class="col-md-9">
                        <select name="partner_id" id="partner_id"
                            class="form-control {{ $errors->first('partner_id') ? 'is-invalid' : '' }}">
                            <option value="">{{ __('lang.partner') }}</option>
                            @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}"
                                    {{ old('partner_id', isset($partnerPayment) ? $partnerPayment->partner_id : '') == $partner->id ? 'selected' : '' }}>
                                    {{ $partner->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->first('partner_id'))
                            <div class="invalid-feedback">{{ $errors->first('partner_id') }}</div>
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
                        value="{{ old('amount', isset($partnerPayment) ? $partnerPayment->amount : '') }}">
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
                        value="{{ old('date', isset($partnerPayment) ? $partnerPayment->date : '') }}">
                    @if ($errors->first('date'))
                        <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
