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
                        value="{{ old('name', isset($client) ? $client->name : '') }}">
                    @if ($errors->first('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="phone">{{ __('lang.phone') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" id="name"
                        type="text" name="phone" placeholder="{{ __('lang.phone') }}"
                        value="{{ old('phone', isset($client) ? $client->phone : '') }}">
                    @if ($errors->first('phone'))
                        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
            </div>

            {{-- <hr>
            <h4>{{ __('lang.colors') }}</h4>

            @foreach ($colors as $color)
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="price">
                        {{ $color->color->name ?? $color->name }}
                    </label>
                    <div class="col-md-9">
                        <input class="form-control {{ $errors->first('price') ? 'is-invalid' : '' }}" id="name"
                            type="text" name="{{ 'colors[' . $color->id . '][price]' }}"
                            placeholder="{{ __('lang.price') }}"
                            value="{{ old('colors.' . $color->id . '.price', $color->pivot ? $color->pivot->price : $color->price) }}">
                    </div>
                </div>
            @endforeach --}}
        </div>
    </div>
</div>
