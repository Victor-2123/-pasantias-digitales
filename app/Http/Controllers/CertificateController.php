<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /** Download vocational test result as PDF */
    public function vocacional()
    {
        $user   = Auth::user();
        $result = $user->vocationalTestResult;

        abort_unless($result, 404, 'No tienes resultados del test vocacional guardados.');

        // Obtener los desafíos aprobados por el usuario
        $submissions = $user->taskSubmissions()->with('challenge.career')->where('status', 'approved')->get();

        $pdf = Pdf::loadView('certificates.vocacional', compact('user', 'result', 'submissions'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download("Reporte_Vocacional_{$user->name}.pdf");
    }

    /** Download approved challenge certificate as PDF */
    public function pasantia()
    {
        $user        = Auth::user();
        $submissions = $user->taskSubmissions()->with('challenge')->where('status', 'approved')->get();

        abort_if($submissions->isEmpty(), 404, 'Aún no tienes desafíos aprobados.');

        $pdf = Pdf::loadView('certificates.pasantia', compact('user', 'submissions'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download("Constancia_Pasantia_{$user->name}.pdf");
    }
}
