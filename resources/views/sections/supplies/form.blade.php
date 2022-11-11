<div class="card-body">
    @include('layouts.includes.messages')
    <div class="row">
        <div class="col-lg-9">
            @if (!isset($supply))
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
                                    {{ old('supplier_id', isset($supply) ? $supply->supplier_id : '') == $supplier->id ? 'selected' : '' }}>
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
                <label class="col-md-3 col-form-label" for="name">{{ __('lang.name') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name"
                        type="text" name="name" placeholder="{{ __('lang.name') }}"
                        value="{{ old('name', isset($supply) ? $supply->name : '') }}">
                    @if ($errors->first('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="date">{{ __('lang.date') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control date {{ $errors->first('date') ? 'is-invalid' : '' }}" id="date"
                        type="date" name="date" placeholder="{{ __('lang.date') }}"
                        value="{{ old('date', isset($supply) ? $supply->date : '') }}">
                    @if ($errors->first('date'))
                        <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="price">{{ __('lang.price') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('price') ? 'is-invalid' : '' }}" id="price"
                        type="text" name="price" placeholder="{{ __('lang.price') }}"
                        value="{{ old('price', isset($supply) ? $supply->price : '') }}">
                    @if ($errors->first('price'))
                        <div class="invalid-feedback">{{ $errors->first('price') }}</div>
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
                        value="{{ old('quantity', isset($supply) ? $supply->quantity : '') }}">
                    @if ($errors->first('quantity'))
                        <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="discount">{{ __('lang.discount') }}<span
                        class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('discount') ? 'is-invalid' : '' }}" id="discount"
                        type="text" name="discount" placeholder="{{ __('lang.discount') }}"
                        value="{{ old('discount', isset($supply) ? $supply->discount : '') }}">
                    @if ($errors->first('discount'))
                        <div class="invalid-feedback">{{ $errors->first('discount') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="notes">{{ __('lang.notes') }}</label>
                <div class="col-md-9">
                    <textarea class="form-control {{ $errors->first('notes') ? 'is-invalid' : '' }}" name="{{ 'notes' }}"
                        rows="3" placeholder="{{ __('lang.notes') }}">{{ old('notes', isset($supply) ? $supply->notes : '') }}</textarea>
                    @if ($errors->first('notes'))
                        <div class="invalid-feedback">{{ $errors->first('notes') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
