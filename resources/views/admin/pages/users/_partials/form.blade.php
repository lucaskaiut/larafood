@include('admin.includes.alerts')
{{-- Name field --}}
<div class="input-group mb-3">
    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
           value="{{ $user->name ?? old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
    @if($errors->has('name'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </div>
    @endif
</div>

{{-- Email field --}}
<div class="input-group mb-3">
    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
           value="{{ $user->email ?? old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
    @if($errors->has('email'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </div>
    @endif
</div>

{{-- Password field --}}
<div class="input-group mb-3">
    <input type="password" name="password"
           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
           placeholder="{{ __('adminlte::adminlte.password') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
    @if($errors->has('password'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </div>
    @endif
</div>

<div class="form-group float-right">
    <button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i></button>
</div>
