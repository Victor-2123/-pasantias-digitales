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

    <main class="content-wrapper">
        <!-- Left Section (Form) -->
        <section class="login-section">
            <div class="login-content">
                <h2 class="form-title">Nueva Contraseña</h2>
                
                <p style="margin-bottom: 20px; color: #42474f; font-size: 14px; line-height: 1.6; text-align: center;">
                    Identidad verificada. Ingresa tu nueva contraseña para actualizar tu cuenta.
                </p>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" class="form-input" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly autocomplete="username" />
                        @if ($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input id="password" class="form-input" type="password" name="password" required autofocus autocomplete="new-password" />
                        @if ($errors->has('password'))
                            <div class="error-message">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                        @if ($errors->has('password_confirmation'))
                            <div class="error-message">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="btn-login">
                        Actualizar Contraseña
                    </button>
                </form>
            </div>
        </section>

        <!-- Right Section (Visual) -->
        <section class="register-section">
            <div class="image-side-container">
                <div class="circular-img-wrapper">
                    <img src="{{ asset('images/reset-password.jpg') }}" alt="Nueva contraseña" onerror="this.src='https://images.unsplash.com/photo-1633265485768-3066373b177f?q=80&w=1470&auto=format&fit=crop'">
                </div>
                <h3 style="color: white; margin-top: 30px; font-family: 'Lexend', sans-serif; font-size: 20px;">Seguridad lista</h3>
                <p style="color: #8ebdf9; font-size: 14px; margin-top: 10px;">Asegúrate de usar una contraseña fuerte y única.</p>
            </div>
        </section>
    </main>
</div>
@endsection
