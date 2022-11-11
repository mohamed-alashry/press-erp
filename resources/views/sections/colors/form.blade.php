<div class="card-body">
    @include('layouts.includes.messages')
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="name">{{ __('lang.name') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name"
                        type="text" name="name" placeholder="{{ __('lang.name') }}"
                        value="{{ old('name', isset($color) ? $color->name : '') }}">
                    @if ($errors->first('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="price">{{ __('lang.price') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('price') ? 'is-invalid' : '' }}" id="name"
                        type="text" name="price" placeholder="{{ __('lang.price') }}"
                        value="{{ old('price', isset($color) ? $color->price : '') }}">
                    @if ($errors->first('price'))
                        <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
