<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Lexend:wght@600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                background-color: #f8f9ff;
                font-family: 'Inter', sans-serif;
                margin: 0;
                padding: 0;
                color: #0d1c2e;
            }

            .login-container {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                align-items: center;
                justify-content: center;
                background-color: #f8f9ff;
                position: relative;
                overflow: hidden;
                padding: 20px;
            }

            /* Decorative corner elements - Nested squares and lines */
            .corner-decoration {
                position: absolute;
                pointer-events: none;
                z-index: 1;
            }

            .corner-tl {
                top: 0;
                left: 0;
                width: 300px;
                height: 300px;
            }

            .corner-br {
                bottom: 0;
                right: 0;
                width: 300px;
                height: 300px;
            }

            /* Geometric lines */
            .geo-square {
                position: absolute;
                border: 2px solid rgba(0, 53, 95, 0.1);
            }

            .corner-tl .sq-1 { top: 30px; left: 30px; width: 140px; height: 140px; border-right: none; border-bottom: none; }
            .corner-tl .sq-2 { top: 55px; left: 55px; width: 110px; height: 110px; border-right: none; border-bottom: none; }
            .corner-tl .sq-3 { top: 80px; left: 80px; width: 80px; height: 80px; border-right: none; border-bottom: none; }
            
            .corner-br .sq-1 { bottom: 30px; right: 30px; width: 140px; height: 140px; border-left: none; border-top: none; }
            .corner-br .sq-2 { bottom: 55px; right: 55px; width: 110px; height: 110px; border-left: none; border-top: none; }
            .corner-br .sq-3 { bottom: 80px; right: 80px; width: 80px; height: 80px; border-left: none; border-top: none; }

            /* Extender lines */
            .corner-tl::before { content: ""; position: absolute; top: 120px; left: 170px; width: 151px; height: 1px; background: rgba(0, 53, 95, 0.05); }
            .corner-tl::after { content: ""; position: absolute; top: 170px; left: 120px; width: 1px; height: 151px; background: rgba(0, 53, 95, 0.05); }

            .corner-br::before { content: ""; position: absolute; bottom: 120px; right: 170px; width: 151px; height: 1px; background: rgba(0, 53, 95, 0.05); }
            .corner-br::after { content: ""; position: absolute; bottom: 170px; right: 120px; width: 1px; height: 151px; background: rgba(0, 53, 95, 0.05); }

            .form-title {
                font-family: 'Lexend', sans-serif;
                color: #00355f;
                font-size: 32px;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 25px;
                text-align: center;
                width: 100%;
            }

            .content-wrapper {
                display: flex;
                width: 100%;
                max-width: 1100px;
                min-height: 600px; /* Suficiente para el formulario más largo */
                height: 600px; /* ¡Fuerza la altura exacta siempre! */
                background: white;
                box-shadow: 0 40px 80px rgba(0, 53, 95, 0.1);
                border-radius: 20px;
                overflow: hidden;
                position: relative;
                z-index: 10;
                border: 1px solid rgba(0, 53, 95, 0.05);
            }

            .login-section {
                width: 50%;
                flex: 0 0 50%;
                background-color: #ffffff;
                padding: 25px 60px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                height: 100%;
            }

            .register-section {
                width: 50%;
                flex: 0 0 50%;
                background-color: #00355f;
                padding: 25px 60px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                height: 100%;
            }
        
            /* Asegurar que el formulario ocupe el ancho correcto al centrar */
            .login-section form {
                width: 100%;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-label {
                display: block;
                color: #42474f;
                font-size: 14px;
                font-family: 'Inter', sans-serif;
                margin-bottom: 5px;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            .form-input {
                width: 100%;
                padding: 11px 15px;
                border: 1px solid rgba(0, 53, 95, 0.1);
                border-radius: 8px;
                background-color: #f8f9ff;
                font-size: 14px;
                color: #0d1c2e;
                box-sizing: border-box;
                transition: all 0.3s ease;
            }

            .form-input:focus {
                outline: none;
                border-color: #00355f;
                box-shadow: 0 0 0 4px rgba(0, 53, 95, 0.1);
            }

            .btn-login {
                width: 75%;
                margin: 25px auto 0;
                padding: 12px;
                background-color: #00355f;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s ease;
                letter-spacing: 0.5px;
                display: block;
                text-align: center;
                text-transform: none;
                font-family: 'Lexend', sans-serif;
            }

            .btn-login:hover {
                background-color: #0f4c81;
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(0, 53, 95, 0.15);
            }

            .register-title {
                color: white;
                font-family: 'Lexend', sans-serif;
                font-size: 24px;
                font-weight: 800;
                margin-bottom: 12px;
                text-transform: uppercase;
                letter-spacing: 1px;
                position: relative;
            }

            .register-title::after {
                content: "";
                position: absolute;
                bottom: -15px;
                left: 50%;
                transform: translateX(-50%);
                width: 50px;
                height: 4px;
                background-color: #62fae3;
                border-radius: 2px;
            }

            .register-subtitle {
                display: block;
                color: #8ebdf9;
                font-family: 'Inter', sans-serif;
                font-size: 16px;
                font-weight: 500;
                margin: 30px 0 25px;
            }

            .register-buttons {
                display: flex;
                flex-direction: column;
                gap: 20px;
                width: 100%;
            }

            .btn-register {
                padding: 14px 20px;
                background-color: white;
                color: #00355f;
                border: none;
                border-radius: 8px;
                font-size: 15px;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                font-family: 'Lexend', sans-serif;
            }

            .btn-register:hover {
                background-color: #f8f9ff;
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .forgot-password-container {
                margin-top: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 20px;
                color: #0d1c2e;
                font-size: 15px;
                z-index: 10;
                font-weight: 500;
            }

            .login-container.is-register .forgot-password-container {
                visibility: hidden;
                opacity: 0;
                pointer-events: none;
            }

            .btn-recover {
                background-color: white;
                color: #00355f;
                padding: 10px 25px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 700;
                border: 1px solid rgba(0, 53, 95, 0.1);
                transition: all 0.3s ease;
                font-family: 'Lexend', sans-serif;
            }

            .btn-recover:hover {
                background-color: #f8f9ff;
                border-color: #00355f;
                transform: translateY(-2px);
            }

            .error-message {
                color: #900;
                font-size: 13px;
                margin-top: 5px;
                font-style: italic;
            }

            .session-status {
                background-color: #d4edda;
                color: #155724;
                padding: 10px;
                margin-bottom: 20px;
                font-size: 14px;
                text-align: center;
            }

            /* Registration Card Modifier - Swaps colors compared to login */
            .register-card .register-section {
                width: 50%;
                flex: 0 0 50%;
                background-color: #00355f;
                order: 1;
            }
            .register-card .login-section {
                width: 50%;
                flex: 0 0 50%;
                background-color: #ffffff;
                order: 2;
            }

            .image-side-container {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                position: relative;
                padding: 40px 0;
            }

            .image-side-container::before {
                content: "";
                position: absolute;
                top: 0;
                width: 100%;
                height: 2px;
                background-color: rgba(255, 255, 255, 0.2);
            }

            .circular-img-wrapper {
                width: 240px;
                height: 240px;
                border-radius: 50%;
                overflow: hidden;
                border: 8px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            .circular-img-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .btn-back {
                position: absolute;
                bottom: 20px;
                left: 30px;
                color: #8ebdf9;
                text-decoration: underline;
                font-family: 'Inter', sans-serif;
                font-size: 16px;
                font-weight: 500;
            }

            /* 3D Panel Swap Transitions - Unified Version */
            .content-wrapper {
                perspective: 1500px;
                transform-style: preserve-3d;
                transition: height 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .login-section, .register-section {
                transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1), 
                            opacity 0.7s ease, 
                            background-color 0.7s ease,
                            order 0.7s step-end;
            }

            /* Entry Fade */
            .transition-fade {
                opacity: 0;
                animation: fadeIn 0.6s ease forwards;
            }

            @keyframes fadeIn {
                to { opacity: 1; }
            }

            /* State Toggles (Controlled by JS on .login-container) */
            
            /* Mode: Login (Default) */
            .login-container.is-login .register-card-content { display: none; }
            .login-container.is-login .login-card-content { display: block; }
            
            /* Mode: Register */
            .login-container.is-register .content-wrapper .login-section {
                transform: translateX(100%);
                z-index: 20;
            }
            .login-container.is-register .content-wrapper .register-section {
                transform: translateX(-100%);
                z-index: 10;
            }

            /* Content Toggling */
            .login-content, .register-content {
                width: 100%;
                transition: opacity 0.4s ease;
            }

            .login-container.is-login .register-content { visibility: hidden; opacity: 0; position: absolute; pointer-events: none; }
            .login-container.is-register .login-content { visibility: hidden; opacity: 0; position: absolute; pointer-events: none; }
            
            .login-container.is-login .login-content { visibility: visible; opacity: 1; position: static; }
            .login-container.is-register .register-content { visibility: visible; opacity: 1; position: static; }



            @media (max-width: 992px) {
                .content-wrapper {
                    flex-direction: column;
                    max-width: 600px;
                    height: auto !important;
                }
                .login-section, .register-section {
                    width: 100% !important;
                    flex: 0 0 auto !important;
                }
                .login-container.is-register .content-wrapper .login-section,
                .login-container.is-register .content-wrapper .register-section {
                    transform: none !important;
                    order: unset !important;
                }
                .page-header h1 { font-size: 40px; }
                .page-header h1::before, .page-header h1::after { display: none; }
                .corner-decoration { display: none; }
            }
        </style>
    </head>
    <body class="antialiased">
        <div id="page-content" class="transition-fade">
            @yield('content')
        </div>

        <script>
            // Global toggle function
            window.toggleAuthMode = function(mode, userType = 'estudiante', pushState = true) {
                // Compatibility for older calls missing the userType arg
                if (typeof userType === "boolean") {
                    pushState = userType;
                    userType = 'estudiante';
                }

                const container = document.querySelector('.login-container');
                if (!container) return;

                if (mode === 'register') {
                    // Actualizar el valor oculto para el envío del formulario
                    const typeInput = document.getElementById('user_type_input');
                    if (typeInput) typeInput.value = userType;

                    // Mostrar u ocultar el campo de cédula dinámicamente y cambiar imagen
                    const cedulaFields = document.querySelectorAll('.cedula-field');
                    const cedulaInputs = document.querySelectorAll('.cedula-input');
                    const sideImage = document.getElementById('auth-side-image');
                    
                    if (userType === 'maestro') {
                        cedulaFields.forEach(el => el.style.display = 'block');
                        if (sideImage) sideImage.src = '{{ asset("images/mentor-teaching.png") }}';
                        // cedulaInputs.forEach(el => el.required = true); // Opcional, si deseas que sea estrictamente requerido
                    } else {
                        cedulaFields.forEach(el => el.style.display = 'none');
                        if (sideImage) sideImage.src = '{{ asset("images/student-study.jpg") }}';
                        // cedulaInputs.forEach(el => el.required = false);
                    }

                    container.classList.remove('is-login');
                    container.classList.add('is-register');
                    if (pushState) history.pushState({mode: 'register', type: userType}, '', '{{ route("register") }}');
                } else {
                    container.classList.remove('is-register');
                    container.classList.add('is-login');
                    if (pushState) history.pushState({mode: 'login'}, '', '{{ route("login") }}');
                }
            };

            // Handle back/forward browser buttons
            window.onpopstate = function(event) {
                if (event.state && event.state.mode) {
                    toggleAuthMode(event.state.mode, false);
                } else {
                    // Default to current URL or login
                    const path = window.location.pathname;
                    toggleAuthMode(path.includes('register') ? 'register' : 'login', false);
                }
            };
        </script>
    </body>
</html>
