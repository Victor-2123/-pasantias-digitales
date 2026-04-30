<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Relaciones de referencia:
     *  Companies: 1=Microsoft México, 2=Clínica Salud Total, 3=Grupo Financiero Noreste, 4=Estudio Creativo Pixel
     *  Careers:   1=Ing. Software, 3=Diseño UI/UX, 5=Ing. Desarrollo SW, 6=Ing. TI,
     *             11=Médico Cirujano, 14=Nutrición, 15=Psicología, 17=Administración,
     *             18=Contaduría, 19=Negocios Internacionales, 22=Diseño Gráfico,
     *             24=Ciencias de la Comunicación
     */
    public function run(): void
    {
        // Usa el primer maestro disponible para satisfacer el NOT NULL de mentor_id
        $mentorId = \App\Models\User::where('user_type', 'maestro')->value('id') ?? 3;

        $challenges = [
            // ── Microsoft México (company_id = 1) ──────────────────────────
            [
                'title'       => 'Migración de Base de Datos a la Nube',
                'description' => 'Planifica y ejecuta la migración de una base de datos SQL Server on-premise hacia Azure SQL. Documenta el plan de contingencia, las pruebas de rendimiento y el proceso de corte.',
                'career_id'   => 6,   // Ing. en Tecnologías de la Información
                'company_id'  => 1,   // Microsoft México
                'difficulty'  => 'avanzado',
                'mentor_id'   => $mentorId,
            ],
            [
                'title'       => 'Desarrollo de API REST con Azure Functions',
                'description' => 'Crea una API serverless utilizando Azure Functions y C#. La API debe exponer al menos 4 endpoints (CRUD) con autenticación via JWT y documentación en Swagger.',
                'career_id'   => 1,   // Ing. de Software
                'company_id'  => 1,   // Microsoft México
                'difficulty'  => 'avanzado',
                'mentor_id'   => $mentorId,
            ],
            [
                'title'       => 'Dashboard de Métricas con Power BI',
                'description' => 'Conecta Power BI a una fuente de datos de ventas y construye un dashboard ejecutivo con KPIs clave: ingresos mensuales, tasa de conversión y comparativas año sobre año.',
                'career_id'   => 5,   // Ing. en Desarrollo de Software
                'company_id'  => 1,   // Microsoft México
                'difficulty'  => 'intermedio',
                'mentor_id'   => $mentorId,
            ],

            // ── Clínica Salud Total (company_id = 2) ───────────────────────
            [
                'title'       => 'Diseño de Interfaz de Expediente Médico Digital',
                'description' => 'Crea los wireframes y el prototipo interactivo en Figma de un módulo de expediente clínico. Considera accesibilidad (WCAG 2.1), flujos de médico y enfermera, y modo oscuro.',
                'career_id'   => 3,   // Diseño UI/UX
                'company_id'  => 2,   // Clínica Salud Total
                'difficulty'  => 'intermedio',
                'mentor_id'   => $mentorId,
            ],
            [
                'title'       => 'Protocolo de Triaje Digital para Urgencias',
                'description' => 'Diseña e implementa un sistema de clasificación de pacientes en urgencias basado en criterios del Modelo Español de Triaje (SET). Incluye lógica de priorización y alertas automáticas.',
                'career_id'   => 11,  // Médico Cirujano
                'company_id'  => 2,   // Clínica Salud Total
                'difficulty'  => 'avanzado',
                'mentor_id'   => $mentorId,
            ],
            [
                'title'       => 'Plan de Nutrición Hospitalaria Personalizado',
                'description' => 'Desarrolla un algoritmo para generar planes alimenticios personalizados para pacientes internados, considerando diagnóstico, alergias, restricciones culturales y valores nutricionales diarios.',
                'career_id'   => 14,  // Nutrición
                'company_id'  => 2,   // Clínica Salud Total
                'difficulty'  => 'basico',
                'mentor_id'   => $mentorId,
            ],

            // ── Grupo Financiero Noreste (company_id = 3) ──────────────────
            [
                'title'       => 'Análisis de Riesgo Crediticio con Python',
                'description' => 'Construye un modelo de scoring crediticio usando un dataset de 10,000 clientes (edad, ingresos, historial). Utiliza regresión logística y un random forest. Reporta métricas AUC-ROC.',
                'career_id'   => 18,  // Contaduría
                'company_id'  => 3,   // Grupo Financiero Noreste
                'difficulty'  => 'avanzado',
                'mentor_id'   => $mentorId,
            ],
            [
                'title'       => 'Simulador de Inversiones para App Móvil',
                'description' => 'Diseña la lógica de negocio y la UI de un simulador de portafolios de inversión para clientes millennials. Incluye perfil de riesgo, proyección a 5 años y comparativa contra el mercado.',
                'career_id'   => 19,  // Negocios Internacionales
                'company_id'  => 3,   // Grupo Financiero Noreste
                'difficulty'  => 'intermedio',
                'mentor_id'   => $mentorId,
            ],
            [
                'title'       => 'Automatización de Conciliación Bancaria',
                'description' => 'Desarrolla un script en Python o VBA que concilie automáticamente los movimientos del extracto bancario contra el libro contable, generando un reporte de diferencias en Excel.',
                'career_id'   => 18,  // Contaduría
                'company_id'  => 3,   // Grupo Financiero Noreste
                'difficulty'  => 'basico',
                'mentor_id'   => $mentorId,
            ],

            // ── Estudio Creativo Pixel (company_id = 4) ────────────────────
            [
                'title'       => 'Rediseño de Identidad Visual para Startup',
                'description' => 'Recibe un brief de una startup ficticia y entrega un Manual de Identidad Corporativa completo: logotipo en variantes, paleta de colores, tipografías y aplicaciones (tarjeta, membrete, mockup web).',
                'career_id'   => 22,  // Diseño Gráfico
                'company_id'  => 4,   // Estudio Creativo Pixel
                'difficulty'  => 'intermedio',
                'mentor_id'   => $mentorId,
            ],
            [
                'title'       => 'Campaña de Redes Sociales para Lanzamiento de Producto',
                'description' => 'Planifica y diseña una campaña de 4 semanas para redes sociales (Instagram, LinkedIn, TikTok). Incluye calendario editorial, 8 piezas gráficas y 2 videos cortos (Reels/TikTok) con guión.',
                'career_id'   => 24,  // Ciencias de la Comunicación
                'company_id'  => 4,   // Estudio Creativo Pixel
                'difficulty'  => 'basico',
                'mentor_id'   => $mentorId,
            ],
        ];

        foreach ($challenges as $data) {
            // Evita duplicados por título
            Challenge::firstOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
