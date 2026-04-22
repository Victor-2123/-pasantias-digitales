@extends('layouts.guest')

@section('content')
@php
    // In register.blade.php, default to register mode
    $initialMode = 'is-register';
@endphp
<div class="login-container {{ $initialMode }}" id="auth-container">
    <!-- Corner decorations -->
    <div class="corner-decoration corner-tl">
        <div class="geo-square sq-1"></div>
        <div class="geo-square sq-2"></div>
        <div class="geo-square sq-3"></div>
    </div>
    
    <div class="corner-decoration corner-br">
        <div class="geo-square sq-1"></div>
        <div class="geo-square sq-2"></div>
        <div class="geo-square sq-3"></div>
    </div>

    <main class="content-wrapper">
        <!-- Section 1 (Beige by default) -->
        <section class="login-section">
            <!-- Login Form Content -->
            <div class="login-content">
                <h2 class="form-title">Iniciar Sesión</h2>
                <x-auth-session-status class="session-status" :status="session('status')" />
                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Nombre/Correo Electrónico</label>
                        <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                        @if ($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                        @if ($errors->has('password'))
                            <div class="error-message">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <button type="submit" class="btn-login">Iniciar Sesión</button>
                </form>
            </div>

            <!-- Register Form Content (Visible in Register Mode) -->
            <div class="register-content">
                <h2 class="form-title">Crear Cuenta</h2>
                <form method="POST" action="{{ route('register') }}" id="register-form">
                    @csrf
                    <input type="hidden" name="user_type" id="user_type_input" value="{{ request('type', 'estudiante') }}" />
                    
                    <div class="form-group">
                        <label for="reg_name" class="form-label">Nombre</label>
                        <input id="reg_name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" oninput="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '')" />
                        @if ($errors->has('name'))
                            <div class="error-message">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="reg_email" class="form-label">Correo electrónico</label>
                        <input id="reg_email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                        @if ($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="reg_password" class="form-label">Contraseña</label>
                        <input id="reg_password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                    </div>
                    <div class="form-group">
                        <label for="reg_password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input id="reg_password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                    <button type="submit" class="btn-login" style="width: 60%; margin-top: 15px;">Crear cuenta</button>
                </form>
            </div>
        </section>

        <!-- Section 2 (Brown by default) -->
        <section class="register-section">
            <!-- Register Prompt Content -->
            <div class="login-content">
                <h2 class="register-title">¿AÚN NO TIENES UNA CUENTA?</h2>
                <span class="register-subtitle">¡Regístrate aquí!</span>
                <div class="register-buttons">
                    <button type="button" onclick="toggleAuthMode('register')" class="btn-register">
                        Crear cuenta de estudiante.
                    </button>
                    <button type="button" onclick="toggleAuthMode('register')" class="btn-register">
                        Crear cuenta de mentor.
                    </button>
                </div>
            </div>

            <!-- Register Image Content (Visible in Register Mode) -->
            <div class="register-content">
                <div class="image-side-container">
                    <div class="circular-img-wrapper">
                        <img src="{{ asset('images/student-study.jpg') }}" alt="Estudiante estudiando">
                    </div>
                    <button type="button" onclick="toggleAuthMode('login')" class="btn-back" style="background: none; border: none; cursor: pointer; padding: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- Standalone Recovery Section at bottom -->
    <div class="forgot-password-container">
        <span>¿Olvidaste tu contraseña?</span>
        <a class="btn-recover" href="{{ route('password.request') }}">Recuperar contraseña.</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Handle direct landing or browser history
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('mode') === 'login' || (window.location.pathname.includes('login') && !window.location.pathname.includes('register'))) {
            toggleAuthMode('login', false);
        }
    });

    // Capture form validation errors from bridge
    @if($errors->any())
        @if(!$errors->has('name') && !old('name'))
            toggleAuthMode('login', false);
        @endif
    @endif
</script>
@endsection
