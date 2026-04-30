<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\LearningPath;
use App\Models\Challenge;
use Illuminate\Database\Seeder;

class CompanyAndPathSeeder extends Seeder
{
    public function run(): void
    {
        // ── Companies ──────────────────────────────────────────────────
        $companies = [
            [
                'name'        => 'Microsoft México',
                'slug'        => 'microsoft-mexico',
                'logo'        => '🖥️',
                'description' => 'Empresa global de tecnología que ofrece software, servicios en la nube y soluciones empresariales. Sus desafíos se enfocan en desarrollo de software y nube.',
                'sector'      => 'Tecnología',
                'website'     => 'https://microsoft.com',
                'color'       => 'blue',
            ],
            [
                'name'        => 'Clínica Salud Total',
                'slug'        => 'clinica-salud-total',
                'logo'        => '🏥',
                'description' => 'Red de clínicas privadas comprometida con la innovación en salud digital. Patrocina desafíos de tecnología aplicada al bienestar.',
                'sector'      => 'Salud',
                'website'     => null,
                'color'       => 'green',
            ],
            [
                'name'        => 'Grupo Financiero Noreste',
                'slug'        => 'grupo-financiero-noreste',
                'logo'        => '📊',
                'description' => 'Institución financiera regional enfocada en transformación digital y educación económica para jóvenes emprendedores.',
                'sector'      => 'Finanzas',
                'website'     => null,
                'color'       => 'amber',
            ],
            [
                'name'        => 'Estudio Creativo Pixel',
                'slug'        => 'estudio-creativo-pixel',
                'logo'        => '🎨',
                'description' => 'Agencia de diseño y comunicación visual que busca talento joven en UI/UX, motion design y branding.',
                'sector'      => 'Diseño & Creatividad',
                'website'     => null,
                'color'       => 'violet',
            ],
        ];

        foreach ($companies as $data) {
            Company::updateOrCreate(['slug' => $data['slug']], $data);
        }

        // ── Learning Paths ─────────────────────────────────────────────
        $paths = [
            [
                'title'       => 'Ruta de Desarrollo Web',
                'slug'        => 'desarrollo-web',
                'description' => 'Aprende fundamentos de redes, bases de datos y programación web aplicada.',
                'icon'        => '🌐',
                'color'       => 'blue',
            ],
            [
                'title'       => 'Ruta de Salud Digital',
                'slug'        => 'salud-digital',
                'description' => 'Tecnologías aplicadas al sector salud: sistemas de expedientes, telemedicina y datos.',
                'icon'        => '💊',
                'color'       => 'green',
            ],
            [
                'title'       => 'Ruta de Finanzas y Negocios',
                'slug'        => 'finanzas-negocios',
                'description' => 'Análisis financiero, Excel avanzado y herramientas de gestión empresarial.',
                'icon'        => '💹',
                'color'       => 'amber',
            ],
            [
                'title'       => 'Ruta de Diseño y Creatividad',
                'slug'        => 'diseno-creatividad',
                'description' => 'Principios de diseño UI/UX, identidad visual y herramientas creativas.',
                'icon'        => '✏️',
                'color'       => 'violet',
            ],
        ];

        foreach ($paths as $data) {
            LearningPath::updateOrCreate(['slug' => $data['slug']], $data);
        }

        // Attach existing challenge(s) to the first learning path & company
        $microsoft = Company::where('slug', 'microsoft-mexico')->first();
        $webPath   = LearningPath::where('slug', 'desarrollo-web')->first();

        Challenge::query()->each(function ($challenge) use ($microsoft, $webPath) {
            $challenge->update([
                'company_id'       => $microsoft?->id,
                'learning_path_id' => $webPath?->id,
                'order'            => $challenge->id,
            ]);
        });
    }
}
