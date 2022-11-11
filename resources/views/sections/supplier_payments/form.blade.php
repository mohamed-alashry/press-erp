<div class="card-body">
    @include('layouts.includes.messages')
    <div class="row">
        <div class="col-lg-9">
            @if (!isset($supplierPayment))
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="supplier_id">{{ __('lang.supplier') }}<span
                            class="text-danger">
                            *</span></label>
                    <div class="col-md-9">
                        <select name="supplier_id" id="supplier_id"
                            class="form-control {{ $errors->first('supplier_id') ? 'is-invalid' : '' }}">
                            <option value="">{{ __('lang.supplier') }}</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id', isset($supplierPayment) ? $supplierPayment->supplier_id : '') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->first('supplier_id'))
                            <div class="invalid-feedback">{{ $errors->first('supplier_id') }}</div>
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
                        value="{{ old('amount', isset($supplierPayment) ? $supplierPayment->amount : '') }}">
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
                        value="{{ old('date', isset($supplierPayment) ? $supplierPayment->date : '') }}">
                    @if ($errors->first('date'))
                        <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
