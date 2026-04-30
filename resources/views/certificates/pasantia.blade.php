<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia de Pasantía – {{ $user->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; background: #ffffff; color: #1a202c; padding: 40px 50px; }

        .outer-border {
            border: 4px solid #1E3A5F;
            border-radius: 20px;
            padding: 40px;
            min-height: 520px;
        }
        .inner-border {
            border: 1.5px solid #93C5FD;
            border-radius: 14px;
            padding: 36px;
        }

        .header { text-align: center; margin-bottom: 30px; }
        .badge { font-size: 52px; margin-bottom: 10px; display: block; }
        .program { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #3B82F6; font-weight: 700; margin-bottom: 8px; }
        .title { font-size: 32px; font-weight: 900; color: #1E3A5F; margin-bottom: 4px; letter-spacing: -0.5px; }
        .subtitle { font-size: 13px; color: #64748B; }

        .body-text { text-align: center; font-size: 14px; color: #374151; line-height: 2; margin: 28px 0; }
        .student-name { font-size: 26px; font-weight: 800; color: #1E3A5F; display: block; border-bottom: 2px solid #1E3A5F; padding-bottom: 4px; margin: 6px auto; width: fit-content; }

        .challenges-box { margin-top: 24px; }
        .ch-title { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #6B7280; margin-bottom: 12px; text-align: center; }
        .ch-item { display: flex; align-items: center; gap: 10px; padding: 8px 12px; background: #F0FDF4; border-radius: 8px; margin-bottom: 6px; }
        .ch-check { color: #16A34A; font-weight: 900; font-size: 14px; }
        .ch-name  { font-size: 12px; font-weight: 600; color: #1E3A5F; }

        .footer { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 36px; }
        .sig-block { text-align: center; }
        .sig-line { border-top: 1.5px solid #94A3B8; width: 160px; margin: 0 auto 6px; }
        .sig-label { font-size: 10px; color: #94A3B8; }
        .date-badge { background: #1E3A5F; color: white; font-size: 11px; font-weight: 700; padding: 8px 18px; border-radius: 99px; }
    </style>
</head>
<body>
<div class="outer-border">
<div class="inner-border">

    <div class="header">
        <span class="badge">🏆</span>
        <div class="program">Pasantías Digitales</div>
        <div class="title">Constancia de Finalización</div>
        <div class="subtitle">Este certificado acredita la completación exitosa de desafíos prácticos</div>
    </div>

    <div class="body-text">
        Se hace constar que el(la) estudiante<br>
        <span class="student-name">{{ $user->name }}</span><br>
        ha completado y aprobado satisfactoriamente los siguientes desafíos<br>
        en la plataforma <strong>Pasantías Digitales</strong>:
    </div>

    <div class="challenges-box">
        <div class="ch-title">Desafíos Aprobados</div>
        @foreach($submissions as $sub)
            <div class="ch-item">
                <span class="ch-check">✓</span>
                <span class="ch-name">{{ $sub->challenge->title ?? 'Desafío' }}</span>
                @if($sub->score !== null)
                    <span style="margin-left:auto; font-size:11px; font-weight:700; color:#16A34A;">{{ $sub->score }}/100</span>
                @endif
            </div>
        @endforeach
    </div>

    <div class="footer">
        <div class="sig-block">
            <div class="sig-line"></div>
            <div class="sig-label">Director(a) de Pasantías Digitales</div>
        </div>
        <div class="date-badge">
            Emitido: {{ now()->format('d/m/Y') }}
        </div>
        <div class="sig-block">
            <div class="sig-line"></div>
            <div class="sig-label">Sello de la Plataforma</div>
        </div>
    </div>

</div>
</div>
</body>
</html>
