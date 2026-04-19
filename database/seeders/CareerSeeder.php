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
        // 1. Crear un Mentor de prueba (Usuario con rol de experto)
        $mentor = User::create([
            'name' => 'Mentor Experto',
            'email' => 'mentor@pasantias.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Datos para el catálogo y retos basados en tu idea de proyecto [cite: 16, 17]
        $data = [
            [
                'name' => 'Ingeniería de Software',
                'description' => 'Enfoque en desarrollo backend y herramientas del mercado actual[cite: 19, 20].',
                'challenge' => [
                    'title' => 'Diseño de Base de Datos para Veterinaria',
                    'description' => 'Diseña una estructura relacional en SQL Server para gestionar expedientes médicos[cite: 16].',
                    'difficulty' => 'Intermedio'
                ]
            ],
            [
                'name' => 'Arquitectura',
                'description' => 'Simulación de trabajo real en diseño y planeación[cite: 8].',
                'challenge' => [
                    'title' => 'Presupuesto de Materiales: Recámara',
                    'description' => 'Haz un presupuesto detallado de materiales para una recámara de 4x4[cite: 17].',
                    'difficulty' => 'Básico'
                ]
            ],
            [
                'name' => 'Diseño UI/UX',
                'description' => 'Uso de herramientas como Figma para solucionar problemas visuales[cite: 20].',
                'challenge' => [
                    'title' => 'Prototipo en Figma para App de Comida',
                    'description' => 'Crea un flujo de pantallas para una app de entregas usando herramientas de la industria[cite: 20].',
                    'difficulty' => 'Avanzado'
                ]
            ],
        ];

        foreach ($data as $item) {
            // Creamos la carrera para el catálogo [cite: 13]
            $career = Career::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
            ]);

            // Creamos el reto laboral asociado [cite: 7, 11]
            Challenge::create([
                'career_id' => $career->id,
                'mentor_id' => $mentor->id,
                'title' => $item['challenge']['title'],
                'description' => $item['challenge']['description'],
                'difficulty' => $item['challenge']['difficulty'],
                'expires_at' => now()->addDays(15), // Límite de tiempo para el reto [cite: 7]
            ]);
        }
    }
}