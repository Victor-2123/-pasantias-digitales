<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background-color: #7a6b63;
                font-family: 'figtree', sans-serif;
            }

            .login-container {
                display: flex;
                min-height: 100vh;
                align-items: center;
                justify-content: center;
                background-color: #7a6b63;
                position: relative;
                overflow: hidden;
            }

            /* Decorative corner elements */
            .corner-decoration {
                position: absolute;
                border: 3px solid rgba(0, 0, 0, 0.3);
            }

            .corner-tl-1 {
                top: 20px;
                left: 30px;
                width: 120px;
                height: 120px;
                border-right: none;
                border-bottom: none;
            }

            .corner-tl-2 {
                top: 50px;
                left: 60px;
                width: 90px;
                height: 90px;
                border-right: none;
                border-bottom: none;
            }

            .corner-tl-3 {
                top: 80px;
                left: 90px;
                width: 60px;
                height: 60px;
                border-right: none;
                border-bottom: none;
            }

            .corner-br-1 {
                bottom: 30px;
                right: 40px;
                width: 140px;
                height: 140px;
                border-left: none;
                border-top: none;
            }

            .corner-br-2 {
                bottom: 60px;
                right: 70px;
                width: 100px;
                height: 100px;
                border-left: none;
                border-top: none;
            }

            .corner-br-3 {
                bottom: 90px;
                right: 100px;
                width: 70px;
                height: 70px;
                border-left: none;
                border-top: none;
            }

            .content-wrapper {
                display: flex;
                width: 100%;
                max-width: 1100px;
                background: white;
                border-radius: 0;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
                overflow: hidden;
                position: relative;
                z-index: 10;
            }

            .login-section {
                flex: 1;
                padding: 60px 50px;
                background-color: #e8ddd5;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .register-section {
                flex: 1;
                padding: 60px 50px;
                background-color: #9b8f86;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .login-title {
                position: absolute;
                top: -60px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 32px;
                font-weight: bold;
                color: white;
                letter-spacing: 2px;
                text-transform: uppercase;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                color: #333;
                font-size: 14px;
                font-weight: 500;
                margin-bottom: 8px;
            }

            .form-input {
                width: 100%;
                padding: 12px 15px;
                border: none;
                border-radius: 4px;
                background-color: white;
                font-size: 14px;
                color: #333;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s;
            }

            .form-input:focus {
                outline: none;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .btn-login {
                width: 100%;
                padding: 12px;
                background-color: #8b7d75;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.3s;
                text-transform: capitalize;
                margin-top: 20px;
            }

            .btn-login:hover {
                background-color: #7a6d65;
            }

            .forgot-password {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 15px;
                font-size: 12px;
            }

            .forgot-password-link {
                color: #666;
                text-decoration: none;
            }

            .forgot-password-link:hover {
                text-decoration: underline;
            }

            .forgot-password-btn {
                background-color: white;
                color: #333;
                padding: 8px 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
                cursor: pointer;
                font-size: 12px;
                transition: all 0.3s;
            }

            .forgot-password-btn:hover {
                background-color: #f5f5f5;
            }

            .register-title {
                color: white;
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 30px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .register-buttons {
                display: flex;
                flex-direction: column;
                gap: 15px;
                width: 100%;
            }

            .btn-register {
                padding: 12px 25px;
                background-color: white;
                color: #333;
                border: none;
                border-radius: 4px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                text-decoration: none;
                display: inline-block;
            }

            .btn-register:hover {
                background-color: #f0f0f0;
                transform: translateY(-2px);
            }

            .error-message {
                color: #d32f2f;
                font-size: 12px;
                margin-top: 5px;
            }

            @media (max-width: 768px) {
                .content-wrapper {
                    flex-direction: column;
                    max-width: 500px;
                }

                .login-section,
                .register-section {
                    padding: 40px 30px;
                }

                .login-title {
                    top: -40px;
                    font-size: 24px;
                }

                .corner-decoration {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <!-- Corner decorations -->
            <div class="corner-decoration corner-tl-1"></div>
            <div class="corner-decoration corner-tl-2"></div>
            <div class="corner-decoration corner-tl-3"></div>
            <div class="corner-decoration corner-br-1"></div>
            <div class="corner-decoration corner-br-2"></div>
            <div class="corner-decoration corner-br-3"></div>

            <div class="content-wrapper">
                <div class="login-title">INICIAR SESIÓN</div>

                <!-- Login Section -->
                <div class="login-section">
                    {{ $slot }}
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
    </body>
</html>
