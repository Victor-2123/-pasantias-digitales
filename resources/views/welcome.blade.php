<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Nexus - Conecta con profesionales y descubre tu vocación real experimentando la carrera de tus sueños.">
    <title>¡Bienvenido a Nexus!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            background-color: #7a6b63;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Decorative corner elements - Matching Login Page */
        .corner-decoration {
            position: absolute;
            pointer-events: none;
            z-index: 1;
        }

        .corner-tl { top: 0; left: 0; width: 300px; height: 300px; }
        .corner-br { bottom: 0; right: 0; width: 300px; height: 300px; }

        .geo-square {
            position: absolute;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .corner-tl .sq-1 { top: 30px; left: 30px; width: 140px; height: 140px; border-right: none; border-bottom: none; }
        .corner-tl .sq-2 { top: 55px; left: 55px; width: 110px; height: 110px; border-right: none; border-bottom: none; }
        .corner-tl .sq-3 { top: 80px; left: 80px; width: 80px; height: 80px; border-right: none; border-bottom: none; }
        
        .corner-br .sq-1 { bottom: 30px; right: 30px; width: 140px; height: 140px; border-left: none; border-top: none; }
        .corner-br .sq-2 { bottom: 55px; right: 55px; width: 110px; height: 110px; border-left: none; border-top: none; }
        .corner-br .sq-3 { bottom: 80px; right: 80px; width: 80px; height: 80px; border-left: none; border-top: none; }

        .hero-section {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            z-index: 10;
        }

        .content-container {
            display: flex;
            align-items: center;
            max-width: 1400px;
            width: 100%;
            gap: 100px;
        }

        .image-side {
            flex: 0 0 650px;
            height: 650px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 30px 70px rgba(0,0,0,0.4);
            border: 20px solid rgba(255, 255, 255, 0.1);
        }

        .image-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .text-side {
            flex: 1;
            color: #FFFFFF;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .text-side h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 24px;
            letter-spacing: -0.01em;
            color: #e8ddd5;
        }

        .text-side h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 400;
            font-style: italic;
            color: #e8ddd5;
            margin-bottom: 35px;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .text-side h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120%;
            height: 1px;
            background: rgba(232, 221, 213, 0.3);
        }

        .text-side p {
            font-size: 1.2rem;
            line-height: 1.8;
            max-width: 550px;
            color: #e8ddd5;
            margin-bottom: 45px;
            font-weight: 300;
        }

        .btn-main {
            background-color: #FFFFFF;
            color: #5B4033;
            text-decoration: none;
            padding: 22px 70px;
            font-weight: 700;
            font-size: 1.2rem;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .btn-main:hover {
            background-color: #e8ddd5;
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        @media (max-width: 1300px) {
            .content-container {
                flex-direction: column;
                gap: 50px;
            }
            .image-side {
                width: 400px;
                height: 400px;
                flex: 0 0 400px;
            }
            .text-side h1 {
                font-size: 3rem;
            }
            .hero-section {
                height: auto;
                padding: 100px 20px;
            }
            html, body { overflow: auto; }
            .corner-decoration { display: none; }
        }
    </style>
</head>
<body>
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

    <main class="hero-section">
        <div class="content-container">
            <div class="image-side">
                <img src="{{ asset('images/welcome-desk.jpg') }}" alt="Nexus Welcome">
            </div>
            <section class="text-side">
                <h1>¡BIENVENIDO A NEXUS!</h1>
                <h2>¿Aún no sabes que estudiar?</h2>
                <p>En Nexus entendemos que elegir tu futuro es una decisión difícil cuando solo conoces la teoría. Aquí no te mostramos folletos, te mostramos la realidad.</p>
                <p>Conéctate con profesionales activos, resuelve retos reales del mercado laboral y descubre tu verdadera vocación experimentando el día a día de la carrera de tus sueños.</p>
                <a href="{{ route('login') }}" class="btn-main">¡Comienza ahora!</a>
            </section>
        </div>
    </main>
</body>
</html>
