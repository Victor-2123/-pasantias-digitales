@extends('layouts.guest')

@section('content')
<div class="login-container">
    <!-- Corner decorations -->
    <div class="corner-decoration corner-tl-1"></div>
    <div class="corner-decoration corner-tl-2"></div>
    <div class="corner-decoration corner-tl-3"></div>
    <div class="corner-decoration corner-br-1"></div>
    <div class="corner-decoration corner-br-2"></div>
    <div class="corner-decoration corner-br-3"></div>

    <div class="page-header">
        <h1>INICIAR SESIÓN</h1>
    </div>

    <div class="content-wrapper">

        <!-- Login Section -->
        <div class="login-section">
            <!-- Session Status -->
            <x-auth-session-status class="session-status" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Nombre/Correo Electrónico</label>
                    <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="" />
                    @if ($errors->has('email'))
                        <div class="error-message">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" class="form-input"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" placeholder="" />
                    @if ($errors->has('password'))
                        <div class="error-message">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    Iniciar Sesión
                </button>

                <div class="forgot-password">
                    <span>¿Olvidaste tu contraseña?</span>
                    @if (Route::has('password.request'))
                        <a class="forgot-password-btn" href="{{ route('password.request') }}">
                            Recuperar contraseña.
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Register Section -->
        <div class="register-section">
            <div class="register-title">¿AÚN NO TIENES UNA CUENTA?</div>
            <div class="register-buttons">
                <a href="{{ route('prepare-register', ['type' => 'estudiante']) }}" class="btn-register">
                    Crear cuenta de estudiante.
                </a>
                <a href="{{ route('prepare-register', ['type' => 'maestro']) }}" class="btn-register">
                    Crear cuenta de mentor.
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
