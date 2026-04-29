<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VocationalTestResult;

class TestVocacionalController extends Controller
{
    /**
     * Las 30 preguntas del test vocacional.
     * Cada índice representa una pregunta con su bloque, texto y opciones A-D.
     */
    public static function getPreguntas(): array
    {
        return [
            // Bloque 1: Lógica, Resolución y Abstracción
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'Cuando te enfrentas a un problema complejo y desconocido, tu primer instinto es:',
                'opciones' => [
                    'A' => 'Desglosarlo en partes pequeñas y buscar un patrón lógico.',
                    'B' => 'Buscar cómo este problema afecta a las personas físicamente.',
                    'C' => 'Analizar los costos, riesgos y cómo gestionar una solución.',
                    'D' => 'Imaginar una solución creativa, visual o fuera de lo común.',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'Si te dan a elegir un libro para leer este fin de semana, escogerías:',
                'opciones' => [
                    'A' => '"Cómo funcionan las redes, la IA y los sistemas del futuro".',
                    'B' => '"Los misterios del cerebro y el cuerpo humano".',
                    'C' => '"Estrategias de negociación y liderazgo moderno".',
                    'D' => '"Historia del arte, composición visual y culturas antiguas".',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'Frente a un diagrama lleno de datos y líneas, tú:',
                'opciones' => [
                    'A' => 'Tratas de entender la arquitectura y cómo se conectan los nodos.',
                    'B' => 'Buscas indicadores vitales o estadísticas de mejora poblacional.',
                    'C' => 'Identificas inmediatamente tendencias de crecimiento y pérdidas.',
                    'D' => 'Te fijas en la paleta de colores, la tipografía y la distribución.',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => '¿Qué cualidad consideras que es tu mayor fortaleza?',
                'opciones' => [
                    'A' => 'El razonamiento estructurado y la optimización.',
                    'B' => 'La empatía, el cuidado y la vocación de servicio.',
                    'C' => 'La persuasión, el orden legal y la visión estratégica.',
                    'D' => 'La imaginación, la estética y la capacidad de transmitir emociones.',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'En un proyecto de equipo, el rol en el que más brillas es:',
                'opciones' => [
                    'A' => 'El que estructura la base de datos o el sistema técnico.',
                    'B' => 'El que se asegura de que el equipo esté trabajando en un ambiente sano.',
                    'C' => 'El que coordina las tareas, administra el tiempo y toma decisiones.',
                    'D' => 'El que diseña la presentación final y los elementos gráficos.',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'Cuando observas un edificio moderno, lo primero que piensas es:',
                'opciones' => [
                    'A' => '¿Qué materiales y cálculos estructurales usaron para que no se caiga?',
                    'B' => '¿Tendrá buena ventilación y espacios ergonómicos para la gente?',
                    'C' => '¿Cuál será el retorno de inversión y el estatus legal del terreno?',
                    'D' => '¿Qué estilo arquitectónico inspiró esa fachada tan única?',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'Al aprender un concepto nuevo, prefieres que te lo expliquen:',
                'opciones' => [
                    'A' => 'Con manuales técnicos, código o fórmulas claras.',
                    'B' => 'A través de casos de estudio sobre el impacto en organismos vivos.',
                    'C' => 'Mediante debates, análisis de mercado o leyes aplicables.',
                    'D' => 'Con mapas mentales, bocetos, música o dinámicas interactivas.',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'Tu enfoque frente a los errores es:',
                'opciones' => [
                    'A' => '"Es un bug, hay que depurar el sistema hasta encontrar la falla".',
                    'B' => '"Es un síntoma, hay que diagnosticar la causa raíz para sanar".',
                    'C' => '"Es una mala inversión, hay que cambiar la estrategia directiva".',
                    'D' => '"Es un borrador, hay que rediseñar y darle un nuevo enfoque".',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'Si pudieras inventar algo mañana, sería:',
                'opciones' => [
                    'A' => 'Un software revolucionario o una fuente de energía infinita.',
                    'B' => 'Una cura para una enfermedad silenciosa o un tejido sintético.',
                    'C' => 'Un modelo económico que erradique la pobreza y sea rentable.',
                    'D' => 'Un nuevo género musical o una técnica de animación inmersiva.',
                ],
            ],
            [
                'bloque' => 'Bloque 1: Lógica, Resolución y Abstracción',
                'texto'  => 'La tecnología para ti representa:',
                'opciones' => [
                    'A' => 'El núcleo de la evolución humana y el campo a dominar.',
                    'B' => 'Una herramienta para mejorar diagnósticos y salvar vidas.',
                    'C' => 'Un canal para optimizar ventas, leyes y recursos humanos.',
                    'D' => 'Un lienzo digital para crear mundos, ropa o contenido educativo.',
                ],
            ],
            // Bloque 2: Sociedad, Entorno y Teoría Aplicada
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => '¿Qué noticia te llamaría más la atención en el periódico?',
                'opciones' => [
                    'A' => '"Nuevo avance en computación cuántica y motores eléctricos".',
                    'B' => '"Descubren la proteína clave para la regeneración celular".',
                    'C' => '"La bolsa de valores y las nuevas reformas penales".',
                    'D' => '"Exposición internacional de vanguardia y diseño gráfico".',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => 'Ante una crisis global (ej. pandemia), tú aportarías:',
                'opciones' => [
                    'A' => 'Creando simulaciones de datos y sistemas de rastreo.',
                    'B' => 'Atendiendo en primera línea médica o investigando vacunas.',
                    'C' => 'Gestionando la distribución de recursos y apoyos económicos.',
                    'D' => 'Diseñando campañas visuales de concientización para la población.',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => 'El concepto de "Reglas y Leyes" te hace pensar en:',
                'opciones' => [
                    'A' => 'Condicionales lógicos (If/Else) en un entorno de programación.',
                    'B' => 'Protocolos de higiene y bioética en un laboratorio.',
                    'C' => 'Constituciones, contratos mercantiles y derechos humanos.',
                    'D' => 'Teoría del color, reglas de composición y armonía musical.',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => 'Si tuvieras que dar una conferencia TED, el tema sería:',
                'opciones' => [
                    'A' => '"El futuro de las bases de datos y la automatización".',
                    'B' => '"La conexión entre la nutrición, el cerebro y el comportamiento".',
                    'C' => '"Cómo liderar empresas multinacionales en tiempos de crisis".',
                    'D' => '"El poder de la pedagogía y la arquitectura en el siglo XXI".',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => 'Cuando un aparato deja de funcionar en tu casa, tú:',
                'opciones' => [
                    'A' => 'Lo abres, buscas el circuito dañado y tratas de soldarlo.',
                    'B' => 'Tienes cuidado de que nadie se lastime con él y llamas al técnico.',
                    'C' => 'Revisas la póliza de garantía y calculas si conviene comprar otro.',
                    'D' => 'Piensas en cómo reutilizar sus piezas para un proyecto decorativo.',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => '¿Qué ambiente de trabajo te parece más atractivo?',
                'opciones' => [
                    'A' => 'Un laboratorio de robótica, cuartos de servidores o plataformas marinas.',
                    'B' => 'Hospitales, consultorios, o clínicas de rehabilitación física.',
                    'C' => 'Oficinas corporativas, juzgados, o agencias aduanales.',
                    'D' => 'Estudios de grabación, despachos de arquitectura o aulas de clase.',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => 'Al ver un producto tecnológico muy popular (como un iPhone), te asombra:',
                'opciones' => [
                    'A' => 'El sistema operativo y la capacidad de procesamiento de su chip.',
                    'B' => 'Cómo la ergonomía afecta la postura y la vista del usuario.',
                    'C' => 'La brutal estrategia de marketing y su logística de importación.',
                    'D' => 'El diseño minimalista de la interfaz y la estética del empaque.',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => 'Para ti, el éxito profesional significa:',
                'opciones' => [
                    'A' => 'Construir sistemas complejos que funcionen sin fallas.',
                    'B' => 'Mejorar la calidad de vida y aliviar el dolor de otras personas.',
                    'C' => 'Alcanzar libertad financiera, ascender y dominar tu sector.',
                    'D' => 'Dejar una huella cultural, estética o educativa en las personas.',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => '¿Con qué tipo de variables prefieres trabajar?',
                'opciones' => [
                    'A' => 'Variables exactas, booleanos, código y matemáticas aplicadas.',
                    'B' => 'Signos vitales, reacciones químicas y comportamiento anatómico.',
                    'C' => 'Divisas, estadísticas sociales, leyes y perfiles psicológicos criminales.',
                    'D' => 'Formas, sonidos, luces, texturas y metodologías de aprendizaje.',
                ],
            ],
            [
                'bloque' => 'Bloque 2: Sociedad, Entorno y Teoría Aplicada',
                'texto'  => 'Si fueras a bordo de un barco mercante, tu puesto ideal sería:',
                'opciones' => [
                    'A' => 'En la sala de máquinas, asegurando que los motores y sistemas funcionen.',
                    'B' => 'En la enfermería, cuidando la salud de toda la tripulación.',
                    'C' => 'En el puente de mando, gestionando la ruta, aduanas y la carga.',
                    'D' => 'Registrando el viaje en bitácoras visuales o enseñando a los cadetes.',
                ],
            ],
            // Bloque 3: Intereses Personales y Escenarios
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => 'Cuando alguien te pide un consejo, tú sueles:',
                'opciones' => [
                    'A' => 'Darle una serie de pasos lógicos e instrucciones precisas.',
                    'B' => 'Escucharlo con paciencia y enfocarte en cómo se siente.',
                    'C' => 'Ofrecerle estrategias prácticas para que salga ganando.',
                    'D' => 'Ayudarle a ver el problema desde una perspectiva creativa y diferente.',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => '¿Qué documental de History Channel o Netflix elegirías?',
                'opciones' => [
                    'A' => '"Megaestructuras: Cómo se construyeron los puentes más largos".',
                    'B' => '"El cuerpo al límite: Sobreviviendo a condiciones extremas".',
                    'C' => '"Mentes millonarias: El origen de los monopolios modernos".',
                    'D' => '"Chef\'s Table: El arte culinario y el diseño de platillos".',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => 'Si te dejaran en una ciudad desconocida sin mapa, tú:',
                'opciones' => [
                    'A' => 'Te orientas por la posición del sol, el diseño de calles y la lógica.',
                    'B' => 'Buscas a la policía o a alguien local para pedir indicaciones seguras.',
                    'C' => 'Analizas el movimiento comercial para llegar al centro económico.',
                    'D' => 'Te dejas llevar por los monumentos y la arquitectura que te llame la atención.',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => '¿Cómo prefieres que evalúen tu aprendizaje?',
                'opciones' => [
                    'A' => 'Con exámenes prácticos en la terminal o problemas de física.',
                    'B' => 'Con prácticas de laboratorio o simulaciones clínicas.',
                    'C' => 'Mediante casos de estudio de empresas o debates legales orales.',
                    'D' => 'Entregando un portafolio de evidencias, un diseño o una presentación.',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => 'Cuando juegas un videojuego, lo que más disfrutas es:',
                'opciones' => [
                    'A' => 'Entender las mecánicas, los combos y optimizar tus recursos (min-maxing).',
                    'B' => 'Tomar el rol de "Healer" o soporte para mantener vivo a tu equipo.',
                    'C' => 'Gestionar los recursos de tu aldea, el comercio y la diplomacia.',
                    'D' => 'Explorar el mundo abierto, escuchar la banda sonora y el diseño de niveles.',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => 'La frase que mejor te describe es:',
                'opciones' => [
                    'A' => '"Todo sistema puede ser optimizado y mejorado."',
                    'B' => '"La salud y la integridad humana están por encima de todo."',
                    'C' => '"Las reglas claras y los buenos tratos construyen imperios."',
                    'D' => '"La vida sin expresión artística o creatividad es aburrida."',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => 'En una conversación sobre el universo, tu enfoque está en:',
                'opciones' => [
                    'A' => 'Las leyes de la astrofísica y las misiones satelitales.',
                    'B' => 'La posibilidad de formas biológicas en otros planetas.',
                    'C' => 'Las regulaciones internacionales sobre la explotación espacial.',
                    'D' => 'La inmensidad poética y cómo inspiraría una obra de arte.',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => 'Si organizas un evento, tu prioridad es:',
                'opciones' => [
                    'A' => 'Que el equipo de sonido, iluminación y red Wi-Fi no falle.',
                    'B' => 'Que el menú sea nutritivo, sano y haya medidas de seguridad.',
                    'C' => 'Conseguir buenos patrocinadores, rentabilidad y excelente logística.',
                    'D' => 'Que la decoración, la música y las invitaciones (en Canva) queden perfectas.',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => '¿Qué opinas del análisis de datos?',
                'opciones' => [
                    'A' => 'Es mi lenguaje; me encanta estructurar consultas en SQL o Python.',
                    'B' => 'Es útil para rastrear historiales clínicos y epidemiología.',
                    'C' => 'Es vital para entender el comportamiento del consumidor y finanzas.',
                    'D' => 'Es interesante si se puede visualizar en una infografía hermosa.',
                ],
            ],
            [
                'bloque' => 'Bloque 3: Intereses Personales y Escenarios',
                'texto'  => 'Imagina tu graduación. ¿A quién le agradeces mentalmente?',
                'opciones' => [
                    'A' => 'A las horas frente al monitor resolviendo errores lógicos e instalaciones.',
                    'B' => 'A las prácticas intensas, las guardias y el estudio del cuerpo/mente.',
                    'C' => 'A los debates, los análisis de casos y las leyes que memorizaste.',
                    'D' => 'A las noches de creatividad, maquetas, diseño y pasión por tu arte.',
                ],
            ],
        ];
    }

    /**
     * Carreras por área.
     */
    public static function getCarreras(): array
    {
        return [
            'A' => [
                'nombre' => 'Ingeniería y Tecnología',
                'icono'  => '⚙️',
                'color'  => 'blue',
                'carreras' => [
                    'Ing. en Sistemas Computacionales (UAT / ITCM)',
                    'Ing. en Desarrollo de Software (Tecmilenio)',
                    'Ing. en Tecnologías de la Información (UT Altamira)',
                    'Ing. Petrolera / Mecánica / Eléctrica (ITCM / UNE)',
                    'Ing. Civil / Industrial (UAT / IEST)',
                ],
            ],
            'B' => [
                'nombre' => 'Salud y Bienestar',
                'icono'  => '🩺',
                'color'  => 'emerald',
                'carreras' => [
                    'Médico Cirujano (UAT / UNE / IEST)',
                    'Enfermería / Odontología (UAT)',
                    'Nutrición / Terapia Física (UNE / UVM)',
                    'Psicología (UAT / IEST / UVM)',
                    'Químico Farmacéutico Biólogo (UNE)',
                ],
            ],
            'C' => [
                'nombre' => 'Negocios y Ciencias Sociales',
                'icono'  => '💼',
                'color'  => 'amber',
                'carreras' => [
                    'Administración / Contaduría (UAT / IEST)',
                    'Estrategia y Transformación de Negocios (ITESM)',
                    'Derecho (UAT / IEST / UVM)',
                    'Criminología (ICEST / UNID)',
                    'Administración de Empresas Turísticas (UNID)',
                ],
            ],
            'D' => [
                'nombre' => 'Artes, Diseño y Educación',
                'icono'  => '🎨',
                'color'  => 'violet',
                'carreras' => [
                    'Arquitectura (UAT / IEST)',
                    'Diseño Gráfico (UAT / IEST / UNE)',
                    'Gastronomía (IEST / Instituto Sugar)',
                    'Ciencias de la Comunicación (UAT / UNE)',
                    'Música / Artes Visuales (UAT)',
                ],
            ],
        ];
    }

    /**
     * Muestra la vista del test vocacional.
     */
    public function index()
    {
        $preguntas = self::getPreguntas();
        $carreras  = self::getCarreras();

        return view('vocacional.test', compact('preguntas', 'carreras'));
    }

    /**
     * Persists the test result for the authenticated user.
     * Called via fetch() from Alpine.js after calcularResultados().
     */
    public function save(Request $request)
    {
        $validated = $request->validate([
            'dominant_area'     => 'required|in:A,B,C,D',
            'dominant_name'     => 'required|string|max:100',
            'score_a'           => 'required|integer|min:0|max:30',
            'score_b'           => 'required|integer|min:0|max:30',
            'score_c'           => 'required|integer|min:0|max:30',
            'score_d'           => 'required|integer|min:0|max:30',
            'careers_suggested' => 'required|array|min:1',
            'careers_suggested.*' => 'string|max:200',
        ]);

        // updateOrCreate so re-taking the test overwrites the previous result
        VocationalTestResult::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'dominant_area'     => $validated['dominant_area'],
                'dominant_name'     => $validated['dominant_name'],
                'score_a'           => $validated['score_a'],
                'score_b'           => $validated['score_b'],
                'score_c'           => $validated['score_c'],
                'score_d'           => $validated['score_d'],
                'careers_suggested' => $validated['careers_suggested'],
            ]
        );

        return response()->json(['ok' => true]);
    }
}
