<div class="card-body">
    @include('layouts.includes.messages')
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="desc">{{ __('lang.desc') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('desc') ? 'is-invalid' : '' }}" id="desc"
                        type="text" name="desc" placeholder="{{ __('lang.desc') }}"
                        value="{{ old('desc', isset($expense) ? $expense->desc : '') }}">
                    @if ($errors->first('desc'))
                        <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="amount">{{ __('lang.amount') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('amount') ? 'is-invalid' : '' }}" id="amount"
                        type="text" name="amount" placeholder="{{ __('lang.amount') }}"
                        value="{{ old('amount', isset($expense) ? $expense->amount : '') }}">
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
                        value="{{ old('date', isset($expense) ? $expense->date : '') }}">
                    @if ($errors->first('date'))
                        <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
