@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-4">Iniciar sesión</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Recordarme</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>

                <p class="mt-3 mb-0 text-center">
                    ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection