@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-center rounded-top-4" style="background: #1B365D;">
                    <h3 class="mb-0" style="color: #F4C95D;">{{ __('Iniciar sesión') }}</h3>
                </div>
                <div class="card-body px-4 py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label text-titulo">{{ __('Correo electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-titulo">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>

                        <div class="d-grid gap-2 mb-2">
                            <button type="submit" class="btn btn-primary" style="background: #1B365D; border: none;">
                                {{ __('Ingresar') }}
                            </button>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            @if (Route::has('password.request'))
                                <a class="small" href="{{ route('password.request') }}" style="color: #4285F4;">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                            <span class="text-muted">|</span>
                            <a class="small" href="{{ route('register') }}" style="color: #4CAF50;">
                                {{ __('¿No tienes cuenta? Regístrate') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
