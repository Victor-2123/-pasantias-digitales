<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear un Mentor de prueba (si no existe)
        $mentor = User::firstOrCreate(
            ['email' => 'mentor@pasantias.com'],
            [
                'name'      => 'Mentor Experto',
                'password'  => bcrypt('password'),
                'user_type' => 'maestro',
            ]
        );

        // 2. Catálogo completo de carreras con los nuevos campos
        $careers = [
            // ── Ingeniería y Tecnología (A) ─────────────────────────────
            ['name' => 'Ing. en Sistemas Computacionales', 'category' => 'A', 'tagline' => 'Software, redes y soluciones tecnológicas avanzadas.', 'color' => 'blue', 'icon' => '💻'],
            ['name' => 'Ing. en Desarrollo de Software', 'category' => 'A', 'tagline' => 'Crea aplicaciones que transforman industrias.', 'color' => 'blue', 'icon' => '🖥️'],
            ['name' => 'Ing. en Tecnologías de la Información', 'category' => 'A', 'tagline' => 'Infraestructura y gestión de datos empresariales.', 'color' => 'blue', 'icon' => '🌐'],
            ['name' => 'Ing. Petrolera', 'category' => 'A', 'tagline' => 'Extracción y gestión de recursos energéticos.', 'color' => 'blue', 'icon' => '⛽'],
            ['name' => 'Ing. Química', 'category' => 'A', 'tagline' => 'Procesos industriales y materiales del futuro.', 'color' => 'blue', 'icon' => '⚗️'],
            ['name' => 'Ing. Civil', 'category' => 'A', 'tagline' => 'Construye la infraestructura de mañana.', 'color' => 'blue', 'icon' => '🏗️'],
            ['name' => 'Ing. Industrial', 'category' => 'A', 'tagline' => 'Optimiza procesos y cadenas de producción.', 'color' => 'blue', 'icon' => '🏭'],

            // ── Salud y Bienestar (B) ────────────────────────────────────
            ['name' => 'Médico Cirujano', 'category' => 'B', 'tagline' => 'Diagnóstico, tratamiento y cuidado integral.', 'color' => 'emerald', 'icon' => '🩺'],
            ['name' => 'Enfermería', 'category' => 'B', 'tagline' => 'Cuidado humano en primera línea de salud.', 'color' => 'emerald', 'icon' => '💉'],
            ['name' => 'Odontología', 'category' => 'B', 'tagline' => 'Salud bucodental y estética dental avanzada.', 'color' => 'emerald', 'icon' => '🦷'],
            ['name' => 'Nutrición', 'category' => 'B', 'tagline' => 'Alimentación, salud y bienestar integral.', 'color' => 'emerald', 'icon' => '🥗'],
            ['name' => 'Psicología', 'category' => 'B', 'tagline' => 'Mente, conducta y salud mental.', 'color' => 'emerald', 'icon' => '🧠'],
            ['name' => 'Terapia Física', 'category' => 'B', 'tagline' => 'Rehabilitación y movimiento humano.', 'color' => 'emerald', 'icon' => '🏃'],

            // ── Negocios y Ciencias Sociales (C) ────────────────────────
            ['name' => 'Administración', 'category' => 'C', 'tagline' => 'Liderazgo, estrategia y gestión de equipos.', 'color' => 'amber', 'icon' => '📊'],
            ['name' => 'Contaduría', 'category' => 'C', 'tagline' => 'Finanzas, auditoría y control fiscal.', 'color' => 'amber', 'icon' => '💰'],
            ['name' => 'Negocios Internacionales', 'category' => 'C', 'tagline' => 'Comercio global y relaciones internacionales.', 'color' => 'amber', 'icon' => '🌍'],
            ['name' => 'Derecho', 'category' => 'C', 'tagline' => 'Justicia, normativa y defensa de derechos.', 'color' => 'amber', 'icon' => '⚖️'],
            ['name' => 'Criminología', 'category' => 'C', 'tagline' => 'Análisis del crimen y seguridad pública.', 'color' => 'amber', 'icon' => '🔍'],

            // ── Artes, Diseño y Educación (D) ───────────────────────────
            ['name' => 'Arquitectura', 'category' => 'D', 'tagline' => 'Diseño de espacios que inspiran y perduran.', 'color' => 'violet', 'icon' => '🏛️'],
            ['name' => 'Diseño Gráfico', 'category' => 'D', 'tagline' => 'Comunicación visual y creatividad aplicada.', 'color' => 'violet', 'icon' => '🎨'],
            ['name' => 'Gastronomía', 'category' => 'D', 'tagline' => 'Arte culinario y cultura gastronómica.', 'color' => 'violet', 'icon' => '🍽️'],
            ['name' => 'Ciencias de la Comunicación', 'category' => 'D', 'tagline' => 'Medios, periodismo y comunicación digital.', 'color' => 'violet', 'icon' => '📡'],
            ['name' => 'Pedagogía', 'category' => 'D', 'tagline' => 'Educación, formación y desarrollo humano.', 'color' => 'violet', 'icon' => '📚'],
            ['name' => 'Música', 'category' => 'D', 'tagline' => 'Expresión sonora y producción musical.', 'color' => 'violet', 'icon' => '🎵'],
        ];

        foreach ($careers as $careerData) {
            Career::updateOrCreate(
                ['slug' => Str::slug($careerData['name'])],
                [
                    'name'        => $careerData['name'],
                    'category'    => $careerData['category'],
                    'tagline'     => $careerData['tagline'],
                    'color'       => $careerData['color'],
                    'icon'        => $careerData['icon'],
                    'description' => $careerData['tagline'],
                ]
            );
        }

        // 3. Reto de muestra (solo si no existe challenge con id=1)
        if (! Challenge::find(1)) {
            $softCareer = Career::where('slug', 'ing-en-sistemas-computacionales')->first();
            Challenge::create([
                'career_id'   => $softCareer?->id ?? 1,
                'mentor_id'   => $mentor->id,
                'title'       => 'Enlistar los componentes de una red y una PC',
                'description' => 'Elabora un documento donde enlistes detalladamente los componentes clave de hardware de una computadora (CPU, RAM, etc.) en conjunto con los dispositivos principales de comunicación (Routers, Switches, etc.).',
                'difficulty'  => 'Básico',
                'expires_at'  => now()->addDays(15),
            ]);
        }
    }
}