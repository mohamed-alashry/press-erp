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
                        value="{{ old('name', isset($admin) ? $admin->name : '') }}">
                    @if ($errors->first('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="email">{{ __('lang.email') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" id="email"
                        type="email" name="email" placeholder="{{ __('lang.email') }}"
                        value="{{ old('email', isset($admin) ? $admin->email : '') }}">
                    @if ($errors->first('email'))
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="password">{{ __('lang.password') }}<span
                        class="text-danger"> *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" id="password"
                        type="password" name="password" placeholder="{{ __('lang.password') }}">
                    @if ($errors->first('password'))
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label"
                    for="password_confirmation">{{ __('lang.confirmPassword') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}"
                        id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="{{ __('lang.confirmPassword') }}">
                    @if ($errors->first('password_confirmation'))
                        <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="position">{{ __('lang.position') }}<span
                        class="text-danger"> *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('position') ? 'is-invalid' : '' }}" id="position"
                        type="text" name="position" placeholder="{{ __('lang.position') }}"
                        value="{{ old('position', isset($admin) ? $admin->position : 1) }}">
                    @if ($errors->first('position'))
                        <div class="invalid-feedback">{{ $errors->first('position') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="roles">{{ __('lang.roles') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <select class="form-control select2 {{ $errors->first('roles') ? 'is-invalid' : '' }}"
                        id="roles" name="roles[]" placeholder="{{ __('lang.roles') }}" multiple>
                        <option value=""></option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ isset($admin) && $admin->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('roles'))
                        <div class="invalid-feedback">{{ $errors->first('roles') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">{{ __('lang.status') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9 col-form-label">
                    @php
                        $status = old('status', isset($admin) ? $admin->status : 1);
                    @endphp
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="active" type="radio" value="1" name="status"
                            {{ $status == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">{{ __('lang.active') }}</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="stopped" type="radio" value="0" name="status"
                            {{ $status == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="stopped">{{ __('lang.stopped') }}</label>
                    </div>
                    @if ($errors->first('status'))
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
