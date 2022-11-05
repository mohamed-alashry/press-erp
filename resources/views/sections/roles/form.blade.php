<div class="card-body">
    @include('layouts.includes.messages')
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="name">{{ __('messages.name') }}<span class="text-danger">
                        *</span></label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name"
                        type="text" name="name" placeholder="{{ __('messages.name') }}"
                        value="{{ old('name', isset($role) ? $role->name : '') }}">
                    @if ($errors->first('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <strong class="col-md-3">{{ __('messages.permissions') }}<span class="text-danger"> *</span>
                    @if ($errors->first('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                </strong>
                @foreach ($allActions as $action)
                    <strong class="col-md-1 px-0">{{ __('messages.' . $action) }}</strong>
                @endforeach
                <strong class="col-md-1">{{ __('messages.all') }}</strong>
            </div>
            @foreach ($allPages as $page)
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ __('messages.' . $page) }}</label>
                    @foreach ($allActions as $action)
                        @php
                            $permissionName = $action . ' ' . $page;
                        @endphp
                        @if (in_array($permissionName, $allPermissions))
                            @php
                                $permission = old('permissions.' . $permissionName, isset($role) ? $role->hasPermissionTo($permissionName) : false);
                            @endphp
                            <div class="col-md-1 col-form-label">
                                <div class="form-check form-check-inline mr-1">
                                    <input class="form-check-input {{ $page . '-permission' }}" type="checkbox"
                                        value="{{ $permissionName }}"
                                        name="{{ 'permissions[' . $permissionName . ']' }}"
                                        {{ $permission ? 'checked' : '' }}>
                                </div>
                            </div>
                        @else
                            <div class="col-md-1 col-form-label"></div>
                        @endif
                    @endforeach
                    <div class="col-md-1 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="{{ $page . '-permission' }}" type="checkbox"
                                onclick="allPermissions('{{ $page }}')">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
