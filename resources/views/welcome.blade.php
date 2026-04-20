<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Inicio</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        :root{--accent-start:#7C3AED;--accent-end:#FF416C;--btn-start:#FF7A7A;--btn-end:#FF3F3F;--muted:#6b7280;--card:#ffffff;--glass:rgba(255,255,255,0.7)}
        *{box-sizing:border-box}
        html,body{height:100%}
        body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Arial;background:linear-gradient(180deg,#f3f7f9 0%, #eef3f6 100%);margin:0;display:flex;align-items:center;justify-content:center;padding:28px}
        .panel{width:100%;max-width:1100px;display:flex;border-radius:14px;overflow:hidden;box-shadow:0 18px 50px rgba(16,24,40,0.12);background:linear-gradient(180deg,#ffffff,#fbfdff)}
        .left{flex:1;padding:56px 44px;background:linear-gradient(180deg,#fff,#fbfdff)}
        .right{flex:1;padding:0;color:#fff;display:flex;align-items:center;justify-content:center;position:relative;background-color:#100000;background-position:center;background-size:cover;background-repeat:no-repeat}
        .brand{font-weight:800;font-size:24px;margin-bottom:8px;color:#0f172a}
        .subtitle{color:var(--muted);margin-bottom:18px}
        .question{font-size:20px;font-weight:700;margin:20px 0;color:#0f172a}
        .cards{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:6px}
        .card{background:linear-gradient(180deg,rgba(255,255,255,0.9),rgba(250,250,250,0.95));border:1px solid rgba(15,23,42,0.04);padding:20px;border-radius:12px;cursor:pointer;transition:transform .25s cubic-bezier(.2,.9,.3,1),box-shadow .25s;backdrop-filter:blur(6px)}
        .card:hover{transform:translateY(-8px) scale(1.02);box-shadow:0 18px 40px rgba(15,23,42,0.08)}
        .card.active{border-color:var(--accent-start);box-shadow:0 20px 50px rgba(124,58,237,0.12)}
        .card-emoji{font-size:30px;margin-bottom:10px}
        .card-title{font-weight:800;margin-bottom:6px;color:#0f172a}
        .card-desc{color:#374151;font-size:14px;line-height:1.45}
        .actions{display:flex;align-items:center;gap:12px;margin-top:22px}
        .btn{padding:12px 20px;border-radius:12px;border:none;cursor:pointer;font-weight:800;letter-spacing:.2px}
        .btn-primary{background:linear-gradient(90deg,var(--accent-start),var(--accent-end));color:#fff;box-shadow:0 10px 30px rgba(124,58,237,0.12)}
        .btn-outline{background:transparent;border:2px solid rgba(15,23,42,0.06);color:#0f172a}
        .login-link{margin-left:auto;color:var(--muted);text-decoration:underline;cursor:pointer}
        /* Right panel visual */
        .hero{width:100%;height:100%;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden}
        .hero .bg-blob{position:absolute;inset:0;background-size:cover;background-position:center;background-repeat:no-repeat;filter:blur(12px) brightness(0.7) saturate(0.9);transform:scale(1.03);}
        .hero .logo{font-size:120px;font-weight:900;color:transparent;-webkit-text-stroke:2px var(--accent-end);letter-spacing:-6px;transform:translateY(6px);}
        .hero .accent{position:absolute;left:6%;bottom:8%;background:linear-gradient(90deg,#ff6b6b,#ff3f3f);padding:10px 18px;border-radius:999px;color:#fff;font-weight:700;box-shadow:0 14px 40px rgba(255,63,63,0.12)}
        .spark{position:absolute;mix-blend-mode:screen;opacity:0.9}
        /* subtle animations */
        @keyframes floaty {0%{transform:translateY(0)}50%{transform:translateY(-8px)}100%{transform:translateY(0)}}
        .card{animation:floaty 6s ease-in-out infinite both}
        .card:nth-child(2){animation-delay:0.6s}
        .hero .logo{animation:floaty 8s ease-in-out infinite both}
        /* Responsive */
        @media (max-width:900px){
            .panel{flex-direction:column}
            .right{height:280px}
            .cards{grid-template-columns:1fr}
            .hero .logo{font-size:72px}
        }
    </style>
</head>
<body>
    <div class="panel">
        <div class="left">
            <div class="brand">{{ config('app.name', 'Laravel') }}</div>
            <div class="subtitle">Plataforma de Educación Digital</div>

            <div class="question">¿Qué tipo de usuario eres?</div>

            <div class="cards">
                <div class="card" data-type="estudiante" id="card-estudiante" onclick="selectType('estudiante', this)">
                    <div class="card-emoji">👨‍🎓</div>
                    <div class="card-title">Estudiante</div>
                    <div class="card-desc">Accede a tus cursos, realiza tareas, descarga materiales y aprende a tu propio ritmo.</div>
                </div>

                <div class="card" data-type="maestro" id="card-maestro" onclick="selectType('maestro', this)">
                    <div class="card-emoji">👨‍🏫</div>
                    <div class="card-title">Maestro</div>
                    <div class="card-desc">Crea y gestiona cursos, asigna tareas, califica a tus estudiantes y supervisa el progreso.</div>
                </div>
            </div>

            <div class="actions">
                <button class="btn btn-outline" onclick="location.href='{{ route('login') }}'">Iniciar Sesión</button>
                <button id="registerBtn" class="btn btn-primary" onclick="goRegister()">Registrarse</button>
                <a class="login-link" href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión aquí</a>
            </div>
        </div>

        <div class="right" aria-hidden="true">
            <div class="hero">
                <div class="bg-blob" style="background-image: url('{{ asset('images/registro-bg.jpg') }}');"></div>
                <div class="logo">Laravel</div>
                <div class="accent">Plataforma</div>
            </div>
        </div>
    </div>

    <script>
        let selected = 'estudiante';
        document.getElementById('card-estudiante').classList.add('active');

        function selectType(type, el) {
            selected = type;
            document.querySelectorAll('.card').forEach(c=>c.classList.remove('active'));
            el.classList.add('active');
        }

        function goRegister(){
            // Open prepare route for the selected type so user enters email+name first
            window.location.href = '{{ url('/register/prepare') }}' + '/' + selected;
        }
    </script>
</body>
</html>
