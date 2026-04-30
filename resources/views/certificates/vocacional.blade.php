<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Vocacional – {{ $user->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            background: #ffffff;
            color: #1a202c;
            padding: 40px;
        }

        /* Header band */
        .header {
            background: #1E3A5F;
            color: white;
            padding: 32px 40px;
            border-radius: 16px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }
        .header h1 { font-size: 28px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 4px; }
        .header p  { font-size: 13px; opacity: 0.75; }
        .header .logo-circle {
            position: absolute; right: 32px; top: 50%;
            transform: translateY(-50%);
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 36px;
        }

        /* Student info */
        .meta-box {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px 28px;
            margin-bottom: 28px;
            display: flex;
            gap: 40px;
        }
        .meta-box .label { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #718096; margin-bottom: 4px; }
        .meta-box .value { font-size: 15px; font-weight: 700; color: #1E3A5F; }

        /* Dominant area */
        .dominant-card {
            border-radius: 12px;
            padding: 24px 28px;
            margin-bottom: 28px;
            color: white;
        }
        .dominant-card .label { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.8; margin-bottom: 6px; }
        .dominant-card .area  { font-size: 22px; font-weight: 800; }
        .dominant-card .icon  { font-size: 40px; float: right; margin-top: -8px; }

        /* Score bars */
        .section-title { font-size: 13px; font-weight: 700; color: #1E3A5F; margin-bottom: 14px; text-transform: uppercase; letter-spacing: 0.5px; }
        .bar-row { margin-bottom: 10px; }
        .bar-label { display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 4px; }
        .bar-track { background: #e2e8f0; border-radius: 99px; height: 8px; }
        .bar-fill  { height: 8px; border-radius: 99px; }

        /* Careers */
        .careers-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; }
        .career-chip  { background: #EFF6FF; color: #1E3A5F; font-size: 11px; font-weight: 600;
                        padding: 5px 12px; border-radius: 99px; border: 1px solid #BFDBFE; }

        /* Footer */
        .footer { margin-top: 36px; text-align: center; font-size: 10px; color: #a0aec0; border-top: 1px solid #e2e8f0; padding-top: 16px; }
        .footer strong { color: #1E3A5F; }

        /* Color variants */
        .bg-blue   { background: linear-gradient(135deg, #1E3A5F 0%, #2563EB 100%); }
        .bg-green  { background: linear-gradient(135deg, #065F46 0%, #10B981 100%); }
        .bg-amber  { background: linear-gradient(135deg, #92400E 0%, #F59E0B 100%); }
        .bg-violet { background: linear-gradient(135deg, #4C1D95 0%, #8B5CF6 100%); }
        .fill-blue   { background: #2563EB; }
        .fill-green  { background: #10B981; }
        .fill-amber  { background: #F59E0B; }
        .fill-violet { background: #8B5CF6; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Reporte de Perfil Vocacional</h1>
        <p>Pasantías Digitales – Evaluación Completa</p>
        <div class="logo-circle">🎓</div>
    </div>

    <div class="meta-box">
        <div>
            <div class="label">Estudiante</div>
            <div class="value">{{ $user->name }}</div>
        </div>
        <div>
            <div class="label">Correo</div>
            <div class="value">{{ $user->email }}</div>
        </div>
        <div>
            <div class="label">Fecha del Reporte</div>
            <div class="value">{{ now()->format('d/m/Y') }}</div>
        </div>
    </div>

    <div class="dominant-card bg-{{ $result->color ?? 'blue' }}">
        <div class="icon">{{ $result->icon ?? '🎯' }}</div>
        <div class="label">Área Dominante</div>
        <div class="area">{{ $result->dominant_name }}</div>
    </div>

    <div class="section-title">Puntajes por Área (máx. 30 puntos)</div>

    @php
        $areas = [
            ['name' => 'Ingeniería y Tecnología', 'key' => 'score_a', 'fill' => 'fill-blue'],
            ['name' => 'Salud y Bienestar',        'key' => 'score_b', 'fill' => 'fill-green'],
            ['name' => 'Negocios y Ciencias Soc.', 'key' => 'score_c', 'fill' => 'fill-amber'],
            ['name' => 'Artes, Diseño y Educación','key' => 'score_d', 'fill' => 'fill-violet'],
        ];
    @endphp

    @foreach($areas as $area)
        @php $pct = round(($result->{$area['key']} / 30) * 100); @endphp
        <div class="bar-row">
            <div class="bar-label">
                <span>{{ $area['name'] }}</span>
                <span style="font-weight:700;">{{ $result->{$area['key']} }}/30</span>
            </div>
            <div class="bar-track">
                <div class="bar-fill {{ $area['fill'] }}" style="width: {{ $pct }}%;"></div>
            </div>
        </div>
    @endforeach

    @if(count($result->careers_suggested))
        <div style="margin-top: 28px;">
            <div class="section-title">Carreras Sugeridas</div>
            <div class="careers-grid">
                @foreach($result->careers_suggested as $career)
                    <span class="career-chip">{{ $career }}</span>
                @endforeach
            </div>
        </div>
    @endif

    @if(isset($submissions) && $submissions->isNotEmpty())
        <div style="margin-top: 28px;">
            <div class="section-title">Desafíos Completados y Áreas</div>
            <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 10px;">
                @foreach($submissions as $sub)
                    <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px 14px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 12px; font-weight: 700; color: #1E3A5F;">{{ $sub->challenge->title ?? 'Desafío' }}</span>
                        <span style="font-size: 10px; font-weight: 600; color: #64748B; background: #E2E8F0; padding: 3px 8px; border-radius: 99px;">
                            {{ $sub->challenge->career->name ?? $sub->challenge->career->title ?? 'Área General' }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="footer">
        Este documento fue generado automáticamente por <strong>Pasantías Digitales</strong>.
        Fecha de emisión: {{ now()->format('d \d\e F \d\e Y') }}.
    </div>

</body>
</html>
