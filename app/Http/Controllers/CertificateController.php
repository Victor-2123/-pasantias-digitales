<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VocationalTestResult;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function vocacional()
    {
        $user = auth()->user();
        $result = $user->vocationalTestResult;

        if (!$result) {
            return redirect()->route('vocacional.test')->with('error', 'Debes completar el test vocacional primero.');
        }

        // Add some helper data for the view
        $dominantKey = $result->dominant_area; // e.g. 'A'
        $meta = [
            'A' => ['dominant_name' => 'Ingeniería y Tecnología', 'color' => 'blue',   'icon' => '💻'],
            'B' => ['dominant_name' => 'Salud y Bienestar',        'color' => 'green',  'icon' => '🏥'],
            'C' => ['dominant_name' => 'Negocios y Ciencias Soc.', 'color' => 'amber',  'icon' => '💼'],
            'D' => ['dominant_name' => 'Artes, Diseño y Educación','color' => 'violet', 'icon' => '🎨'],
        ];

        $result->dominant_name = $meta[$dominantKey]['dominant_name'] ?? 'Área General';
        $result->color = $meta[$dominantKey]['color'] ?? 'blue';
        $result->icon = $meta[$dominantKey]['icon'] ?? '🎯';
        
        // Mock careers suggested if not in DB (assuming JSON field 'careers_suggested')
        $result->careers_suggested = $result->careers_suggested ?? [];

        $submissions = TaskSubmission::where('user_id', $user->id)
            ->where('status', 'approved')
            ->with('challenge.career')
            ->get();

        $pdf = Pdf::loadView('certificates.vocacional', compact('user', 'result', 'submissions'));
        return $pdf->download('Reporte_Vocacional_' . str_replace(' ', '_', $user->name) . '.pdf');
    }

    public function pasantia()
    {
        $user = auth()->user();
        $submissions = TaskSubmission::where('user_id', $user->id)
            ->where('status', 'approved')
            ->with('challenge.company')
            ->get();

        if ($submissions->isEmpty()) {
            return redirect()->back()->with('error', 'Aún no has completado ninguna pasantía/desafío.');
        }

        $pdf = Pdf::loadView('certificates.pasantia', compact('user', 'submissions'));
        return $pdf->download('Certificado_Pasantias_' . str_replace(' ', '_', $user->name) . '.pdf');
    }
}
