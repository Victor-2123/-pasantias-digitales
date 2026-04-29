<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Vocacional · Pasantías Digitales</title>
    <meta name="description" content="Realiza el test vocacional de Pasantías Digitales y descubre qué área profesional se adapta mejor a tu perfil.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Lexend:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- CSRF for fetch requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        [x-cloak] { display: none !important; }

        /* Smooth transitions for question cards */
        .question-enter {
            animation: slideIn 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(24px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* Confetti burst on results */
        .result-enter {
            animation: resultPop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        @keyframes resultPop {
            from { opacity: 0; transform: scale(0.85); }
            to   { opacity: 1; transform: scale(1); }
        }

        /* Option card hover/selected states */
        .option-card {
            transition: all 0.18s ease;
        }
        .option-card:hover:not(.selected) {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(0, 53, 95, 0.08);
        }
    </style>
</head>
<body class="font-sans antialiased bg-stitch-background text-stitch-on-surface min-h-screen">

    {{-- ──────────────────────────────────────────────────────────────────────
         Alpine.js Component: x-data
    ────────────────────────────────────────────────────────────────────── --}}
    <div
        x-data="testVocacional()"
        x-init="init()"
        class="min-h-screen flex flex-col"
    >

        {{-- ── TOP NAV ── --}}
        <nav class="bg-stitch-primary shadow-md">
            <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
                <a href="{{ route('careers.index') }}" class="flex items-center gap-2 text-white/80 hover:text-white transition-colors text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Volver al Catálogo
                </a>
                <span class="font-lexend font-bold text-white text-base tracking-tight">Pasantías Digitales</span>
                <div class="w-24"></div>{{-- spacer --}}
            </div>
        </nav>

        {{-- ── MAIN CONTENT ── --}}
        <main class="flex-1 flex items-start justify-center py-10 px-4">
            <div class="w-full max-w-2xl">

                {{-- ════════════════════════════════════
                     SECTION 1: INTRO / BIENVENIDA
                ════════════════════════════════════ --}}
                <div x-show="phase === 'intro'" x-cloak
                     class="bg-white rounded-2xl shadow-sm border border-stitch-outline/10 p-8 md:p-12 text-center space-y-6 result-enter">

                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 text-4xl mb-2">🧭</div>

                    <h1 class="font-lexend text-3xl md:text-4xl font-bold text-stitch-primary leading-tight">
                        Test Vocacional
                    </h1>
                    <p class="text-stitch-on-surface-variant text-base leading-relaxed max-w-lg mx-auto">
                        Responde <strong class="text-stitch-primary">30 preguntas</strong> cortas y descubre qué área profesional se adapta mejor a tu perfil natural. No hay respuestas correctas o incorrectas.
                    </p>

                    <div class="grid grid-cols-3 gap-4 py-4">
                        <div class="bg-stitch-background rounded-xl p-4">
                            <p class="text-2xl font-bold text-stitch-primary font-lexend">30</p>
                            <p class="text-xs text-stitch-on-surface-variant mt-1">Preguntas</p>
                        </div>
                        <div class="bg-stitch-background rounded-xl p-4">
                            <p class="text-2xl font-bold text-stitch-primary font-lexend">~5</p>
                            <p class="text-xs text-stitch-on-surface-variant mt-1">Minutos</p>
                        </div>
                        <div class="bg-stitch-background rounded-xl p-4">
                            <p class="text-2xl font-bold text-stitch-primary font-lexend">4</p>
                            <p class="text-xs text-stitch-on-surface-variant mt-1">Áreas</p>
                        </div>
                    </div>

                    <button
                        id="btn-start-test"
                        @click="startTest()"
                        class="w-full md:w-auto px-10 py-4 bg-stitch-secondary text-white font-lexend font-bold text-lg rounded-xl hover:scale-105 hover:shadow-lg transition-all duration-200"
                    >
                        ¡Comenzar Test!
                    </button>
                </div>

                {{-- ════════════════════════════════════
                     SECTION 2: PREGUNTAS (QUIZ)
                ════════════════════════════════════ --}}
                <div x-show="phase === 'quiz'" x-cloak class="space-y-4">

                    {{-- ── HEADER: Bloque + Contador ── --}}
                    <div class="flex items-center justify-between px-1">
                        <span
                            x-text="preguntas[currentIndex].bloque"
                            class="text-xs font-semibold text-stitch-secondary uppercase tracking-wider"
                        ></span>
                        <span
                            x-text="(currentIndex + 1) + ' de ' + preguntas.length"
                            class="text-xs font-semibold text-stitch-on-surface-variant"
                        ></span>
                    </div>

                    {{-- ── BARRA DE PROGRESO ── --}}
                    <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                        <div
                            class="h-full bg-gradient-to-r from-stitch-secondary to-stitch-primary rounded-full transition-all duration-500 ease-out"
                            :style="'width: ' + progressPercent + '%'"
                        ></div>
                    </div>

                    {{-- ── TARJETA DE PREGUNTA ── --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-stitch-outline/10 p-6 md:p-8 question-enter" :key="currentIndex">

                        {{-- Número + Pregunta --}}
                        <h2
                            class="font-lexend text-2xl md:text-3xl font-bold text-stitch-primary leading-snug mb-6"
                            x-text="(currentIndex + 1) + '. ' + preguntas[currentIndex].texto"
                        ></h2>

                        {{-- ── OPCIONES ── --}}
                        <div class="space-y-3">
                            <template x-for="(opcion, letra) in preguntas[currentIndex].opciones" :key="letra">
                                <button
                                    :id="'opt-' + letra"
                                    @click="selectOption(letra)"
                                    class="option-card w-full text-left flex items-start gap-4 p-4 rounded-xl border-2 bg-white cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-stitch-primary"
                                    :class="{
                                        'border-stitch-primary bg-blue-50 ring-2 ring-stitch-primary selected': selectedAnswer === letra,
                                        'border-stitch-outline/20 hover:border-stitch-primary/40': selectedAnswer !== letra
                                    }"
                                >
                                    {{-- Badge de letra --}}
                                    <span
                                        class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold transition-all duration-150"
                                        :class="{
                                            'bg-stitch-primary text-white': selectedAnswer === letra,
                                            'bg-stitch-background text-stitch-on-surface-variant': selectedAnswer !== letra
                                        }"
                                        x-text="letra"
                                    ></span>

                                    {{-- Texto de la opción --}}
                                    <span
                                        class="text-sm md:text-base leading-relaxed mt-0.5"
                                        :class="{
                                            'text-stitch-primary font-semibold': selectedAnswer === letra,
                                            'text-stitch-on-surface-variant': selectedAnswer !== letra
                                        }"
                                        x-text="opcion"
                                    ></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- ── BOTONES ANTERIOR / SIGUIENTE ── --}}
                    <div class="flex items-center justify-between pt-2">
                        <button
                            id="btn-anterior"
                            @click="prevQuestion()"
                            :disabled="currentIndex === 0"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-stitch-on-surface-variant hover:text-stitch-primary hover:bg-white border border-transparent hover:border-stitch-outline/20 transition-all disabled:opacity-30 disabled:cursor-not-allowed disabled:hover:bg-transparent disabled:hover:border-transparent disabled:hover:text-stitch-on-surface-variant"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Anterior
                        </button>

                        <button
                            id="btn-siguiente"
                            @click="nextQuestion()"
                            :disabled="!selectedAnswer"
                            class="flex items-center gap-2 px-7 py-3 bg-stitch-primary text-white rounded-xl font-lexend font-bold text-sm hover:bg-stitch-primary-container hover:scale-105 hover:shadow-md transition-all duration-200 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:hover:shadow-none"
                        >
                            <span x-text="currentIndex < preguntas.length - 1 ? 'Siguiente' : '¡Ver Resultados!'"></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- ════════════════════════════════════
                     SECTION 3: RESULTADOS
                ════════════════════════════════════ --}}
                <div x-show="phase === 'results'" x-cloak class="space-y-6 result-enter">

                    {{-- ── Header de resultados ── --}}
                    <div
                        class="rounded-2xl p-8 md:p-10 text-center text-white shadow-lg relative overflow-hidden"
                        :class="{
                            'bg-gradient-to-br from-stitch-primary to-stitch-primary-container': result.color === 'blue',
                            'bg-gradient-to-br from-emerald-600 to-emerald-800':               result.color === 'emerald',
                            'bg-gradient-to-br from-amber-500 to-amber-700':                   result.color === 'amber',
                            'bg-gradient-to-br from-violet-600 to-violet-800':                 result.color === 'violet',
                        }"
                    >
                        {{-- Decorative blobs --}}
                        <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>

                        <div class="relative z-10 space-y-4">
                            <div class="text-5xl mb-2" x-text="result.icono"></div>
                            <p class="text-white/70 font-medium text-sm uppercase tracking-widest">Tu Perfil Vocacional Dominante</p>
                            <h1 class="font-lexend text-3xl md:text-4xl font-bold leading-tight" x-text="result.nombre"></h1>

                            {{-- Score badges --}}
                            <div class="flex flex-wrap justify-center gap-2 pt-2">
                                <template x-for="(pts, area) in scores" :key="area">
                                    <div
                                        class="flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-full text-xs font-semibold"
                                    >
                                        <span x-text="area + ':'"></span>
                                        <span x-text="pts + ' pts'"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- ── Carreras sugeridas ── --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-stitch-outline/10 p-6 md:p-8">
                        <h2 class="font-lexend text-xl font-bold text-stitch-primary mb-1">Carreras Recomendadas</h2>
                        <p class="text-stitch-on-surface-variant text-sm mb-6">Basado en tu perfil, estas son las carreras que mejor se adaptan a tus fortalezas naturales:</p>

                        <div class="space-y-3">
                            <template x-for="(carrera, idx) in result.carrerasMostradas" :key="idx">
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-stitch-background border border-stitch-outline/10 hover:border-stitch-primary/30 hover:shadow-sm transition-all">
                                    <div
                                        class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-lexend font-bold text-sm flex-shrink-0"
                                        :class="{
                                            'bg-stitch-primary':  result.color === 'blue',
                                            'bg-emerald-600':     result.color === 'emerald',
                                            'bg-amber-500':       result.color === 'amber',
                                            'bg-violet-600':      result.color === 'violet',
                                        }"
                                        x-text="idx + 1"
                                    ></div>
                                    <span class="text-stitch-on-surface font-medium text-sm leading-relaxed" x-text="carrera"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- ── Score detallado ── --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-stitch-outline/10 p-6 md:p-8">
                        <h2 class="font-lexend text-lg font-bold text-stitch-primary mb-5">Distribución de tu perfil</h2>
                        <div class="space-y-4">
                            <template x-for="info in scoreDisplay" :key="info.key">
                                <div>
                                    <div class="flex justify-between text-sm mb-1.5">
                                        <span class="font-medium text-stitch-on-surface" x-text="info.icono + ' ' + info.nombre"></span>
                                        <span class="font-bold" :class="info.textClass" x-text="info.pts + '/30'"></span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                                        <div
                                            class="h-full rounded-full transition-all duration-700 ease-out"
                                            :class="info.barClass"
                                            :style="'width: ' + Math.round((info.pts / 30) * 100) + '%'"
                                        ></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- ── CTA ── --}}
                    <div class="flex flex-col sm:flex-row gap-3 pb-8">
                        <button
                            id="btn-reiniciar"
                            @click="restart()"
                            class="flex-1 px-6 py-3.5 border-2 border-stitch-primary text-stitch-primary font-bold rounded-xl hover:bg-stitch-primary hover:text-white transition-all duration-200"
                        >
                            🔄 Hacer el test de nuevo
                        </button>
                        <a
                            href="{{ route('careers.index') }}"
                            class="flex-1 px-6 py-3.5 bg-stitch-secondary text-white font-bold rounded-xl text-center hover:scale-105 hover:shadow-md transition-all duration-200"
                        >
                            📚 Explorar Carreras
                        </a>
                        @auth
                        <a
                            href="{{ route('dashboard') }}"
                            id="btn-ver-dashboard"
                            class="flex-1 px-6 py-3.5 bg-stitch-primary text-white font-bold rounded-xl text-center hover:scale-105 hover:shadow-md transition-all duration-200"
                        >
                            📊 Volver a mi Dashboard
                        </a>
                        @endauth
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         Alpine.js Logic
    ══════════════════════════════════════════════════════════ --}}
    <script>
    function testVocacional() {
        return {
            // ─── Estado ───────────────────────────────────────
            phase: 'intro',          // 'intro' | 'quiz' | 'results'
            currentIndex: 0,
            selectedAnswer: null,
            answers: [],             // array de 30 letras
            scores: { A: 0, B: 0, C: 0, D: 0 },
            result: null,

            // ─── Datos desde PHP (embebidos via Blade) ────────
            preguntas: @json(\App\Http\Controllers\TestVocacionalController::getPreguntas()),
            carrerasData: @json(\App\Http\Controllers\TestVocacionalController::getCarreras()),

            // ─── Computed ─────────────────────────────────────
            get progressPercent() {
                return Math.round(((this.currentIndex + (this.selectedAnswer ? 1 : 0)) / this.preguntas.length) * 100);
            },

            get scoreDisplay() {
                const map = {
                    A: { key: 'A', nombre: 'Ingeniería y Tecnología', icono: '⚙️', barClass: 'bg-stitch-primary',   textClass: 'text-stitch-primary' },
                    B: { key: 'B', nombre: 'Salud y Bienestar',        icono: '🩺', barClass: 'bg-emerald-500',    textClass: 'text-emerald-600' },
                    C: { key: 'C', nombre: 'Negocios y Ciencias Soc.', icono: '💼', barClass: 'bg-amber-500',      textClass: 'text-amber-600' },
                    D: { key: 'D', nombre: 'Artes, Diseño y Educación',icono: '🎨', barClass: 'bg-violet-500',     textClass: 'text-violet-600' },
                };
                return Object.entries(this.scores).map(([k, pts]) => ({ ...map[k], pts }));
            },

            // ─── Methods ──────────────────────────────────────
            init() {
                // Inicializa el array de respuestas vacío
                this.answers = new Array(this.preguntas.length).fill(null);
            },

            startTest() {
                this.phase = 'quiz';
            },

            selectOption(letra) {
                this.selectedAnswer = letra;
            },

            nextQuestion() {
                if (!this.selectedAnswer) return;

                // Guardar respuesta actual
                this.answers[this.currentIndex] = this.selectedAnswer;

                if (this.currentIndex < this.preguntas.length - 1) {
                    this.currentIndex++;
                    // Restaurar respuesta previa si ya respondió
                    this.selectedAnswer = this.answers[this.currentIndex] || null;
                } else {
                    // Última pregunta → calcular resultados
                    this.calcularResultados();
                }
            },

            prevQuestion() {
                if (this.currentIndex === 0) return;
                // Guardar la respuesta actual antes de retroceder
                if (this.selectedAnswer) {
                    this.answers[this.currentIndex] = this.selectedAnswer;
                }
                this.currentIndex--;
                this.selectedAnswer = this.answers[this.currentIndex] || null;
            },

            calcularResultados() {
                // 1. Contar puntajes
                const conteo = { A: 0, B: 0, C: 0, D: 0 };
                this.answers.forEach(letra => {
                    if (letra && conteo.hasOwnProperty(letra)) {
                        conteo[letra]++;
                    }
                });
                this.scores = { ...conteo };

                // 2. Encontrar el puntaje máximo
                const maxPts = Math.max(...Object.values(conteo));

                // 3. Obtener todas las áreas con ese puntaje (manejo de empates)
                const ganadoras = Object.keys(conteo).filter(k => conteo[k] === maxPts);

                // 4. Si hay empate, elegir al azar entre los ganadores
                const areaGanadora = ganadoras[Math.floor(Math.random() * ganadoras.length)];

                // 5. Extraer aleatoriamente entre 3 y 5 carreras del área ganadora
                const catalogoCompleto = this.carrerasData[areaGanadora].carreras;
                const cantidadMostrar  = Math.floor(Math.random() * 3) + 3; // 3, 4 ó 5
                const carrerasSeleccionadas = this.shuffleArray([...catalogoCompleto]).slice(0, cantidadMostrar);

                // 6. Construir el objeto de resultado
                this.result = {
                    area: areaGanadora,
                    nombre: this.carrerasData[areaGanadora].nombre,
                    icono: this.carrerasData[areaGanadora].icono,
                    color: this.carrerasData[areaGanadora].color,
                    carrerasMostradas: carrerasSeleccionadas,
                    puntaje: maxPts,
                };

                // 7. Persistir resultado si el usuario está autenticado
                @auth
                fetch('{{ route("vocacional.save") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        dominant_area:     areaGanadora,
                        dominant_name:     this.carrerasData[areaGanadora].nombre,
                        score_a:           conteo['A'],
                        score_b:           conteo['B'],
                        score_c:           conteo['C'],
                        score_d:           conteo['D'],
                        careers_suggested: carrerasSeleccionadas,
                    }),
                }).catch(err => console.warn('No se pudo guardar el resultado:', err));
                @endauth

                this.phase = 'results';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            },

            restart() {
                this.phase = 'intro';
                this.currentIndex = 0;
                this.selectedAnswer = null;
                this.answers = new Array(this.preguntas.length).fill(null);
                this.scores = { A: 0, B: 0, C: 0, D: 0 };
                this.result = null;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            },

            // Fisher-Yates shuffle
            shuffleArray(arr) {
                for (let i = arr.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [arr[i], arr[j]] = [arr[j], arr[i]];
                }
                return arr;
            },
        };
    }
    </script>
</body>
</html>
