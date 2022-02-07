@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        {{ csrf_field() }}

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
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

        {{-- Nacionalidade field --}}
        <div class="input-group mb-3">
            <select class="custom-select {{ $errors->has('nacionalidade') ? 'is-invalid' : '' }}" id="nacionalidade" name="nacionalidade">
                <option value="" selected>Nacionalidade</option>
                <option value="PYG">Paraguaya</option>
                <option value="BRA">Brasileira</option>
                <option value="EUA">American</option>
            </select>
            <div class="input-group-append">
                <label class="input-group-text" for="nacionalidade">
                    <span class="fas fa-flag {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </label>
            </div>
            @if($errors->has('nacionalidade'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('nacionalidade') }}</strong>
                </div>
            @endif
        </div>

        {{-- Contacto field --}}
        <div class="input-group mb-3">
            <input type="text" name="contato" class="form-control {{ $errors->has('contato') ? 'is-invalid' : '' }}"
                   value="{{ old('contato') }}" placeholder="Phone">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('contato'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('contato') }}</strong>
                </div>
            @endif
        </div>

        {{-- Numero Documento field --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <select class="custom-select  {{ $errors->has('tipo_documento') ? 'is-invalid' : '' }}" id="tipo_documento" name="tipo_documento">
                    <option value="RUC" selected>RUC</option>
                    <option value="RG">RG</option>
                    <option value="SI">SI</option>
                </select>
            </div>
            <input type="text" name="numero_documento" class="form-control {{ $errors->has('numero_documento') ? 'is-invalid' : '' }}"
                   value="{{ old('numero_documento') }}" placeholder="Numero">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('numero_documento'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('numero_documento') }}</strong>
                </div>
            @endif
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
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

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
