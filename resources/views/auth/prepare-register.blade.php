<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comenzar registro</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body{font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial; background:#f3f7f9;display:flex;align-items:center;justify-content:center;height:100vh}
        .card{background:#fff;padding:28px;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.06);width:420px}
        .btn{display:inline-block;padding:10px 14px;border-radius:8px;background:#28c3a7;color:#fff;border:none}
        .input{width:100%;padding:10px;border-radius:8px;border:1px solid #e6edf3;margin-bottom:12px}
    </style>
</head>
<body>
    <div class="card">
        <h2 style="margin-bottom:6px">Registro - Paso 1</h2>
        <p style="color:#6b7280;margin-bottom:12px">Completa tu correo y nombre de usuario para comenzar como <strong>{{ ucfirst($user_type) }}</strong>.</p>

        <form method="POST" action="{{ route('register.prepare.store') }}">
            @csrf
            <input type="hidden" name="user_type" value="{{ $user_type }}" />
            <input class="input" type="text" name="name" placeholder="Nombre de usuario" value="{{ old('name', session('reg_name')) }}" required />
            @error('name')
                <div style="color:#b91c1c;margin-bottom:8px">{{ $message }}</div>
            @enderror
            <input class="input" type="email" name="email" placeholder="Correo electrónico" value="{{ old('email', session('reg_email')) }}" required />
            @error('email')
                <div style="color:#b91c1c;margin-bottom:8px">{{ $message }}</div>
            @enderror
            <div style="display:flex;gap:8px;align-items:center">
                <button class="btn" type="submit">Continuar</button>
                <a href="{{ url('/') }}" style="margin-left:auto;color:#4b5563">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>