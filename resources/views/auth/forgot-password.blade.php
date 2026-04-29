@extends('layouts.guest')

@section('content')
<div class="login-container is-login">
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

    <!-- Flecha volver al login -->
    <a href="{{ route('login') }}" title="Volver al inicio" style="position: absolute; top: 40px; left: 40px; color: #00355f; z-index: 50; transition: transform 0.3s ease; display: flex; align-items: center; justify-content: center; background: white; width: 50px; height: 50px; border-radius: 50%; box-shadow: 0 4px 15px rgba(0, 53, 95, 0.1);" onmouseover="this.style.transform='translateX(-5px)'" onmouseout="this.style.transform='translateX(0)'">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
    </a>

    <main class="content-wrapper">
        <!-- Left Section (Form) -->
        <section class="login-section">
            <div class="login-content">
                <h2 class="form-title">Recuperar Contraseña</h2>
                
                <p style="margin-bottom: 20px; color: #42474f; font-size: 14px; line-height: 1.6; text-align: center;">
                    ¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.
                </p>

                <x-auth-session-status class="session-status" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                        @if ($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="btn-login">
                        Enviar Enlace de Recuperación
                    </button>
                </form>
            </div>
        </section>

        <!-- Right Section (Visual) -->
        <section class="register-section">
            <div class="image-side-container">
                <div class="circular-img-wrapper">
                    <img src="{{ asset('images/forgot-password.jpg') }}" alt="Recuperación de contraseña" onerror="this.src='https://images.unsplash.com/photo-1555421689-491a97ff2040?q=80&w=1470&auto=format&fit=crop'">
                </div>
                <h3 style="color: white; margin-top: 30px; font-family: 'Lexend', sans-serif; font-size: 20px;">Protege tu cuenta</h3>
                <p style="color: #8ebdf9; font-size: 14px; margin-top: 10px;">Enviaremos un correo de verificación para asegurar que eres tú.</p>
            </div>
        </section>
    </main>
</div>
@endsection
