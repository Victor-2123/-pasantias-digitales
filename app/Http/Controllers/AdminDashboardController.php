<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TaskSubmission;
use App\Models\VocationalTestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Check if user is admin (using the standard user_type)
        if (auth()->user()->user_type !== 'administrador') {
            abort(403);
        }

        // 1. KPIs
        $stats = [
            'total_students' => User::where('user_type', 'estudiante')->count(),
            'total_mentors'  => User::where('user_type', 'maestro')->count(),
            'total_tasks'    => TaskSubmission::count(),
        ];

        // 2. Vocational Test Distribution (for the chart)
        $vocationalDistribution = VocationalTestResult::select('dominant_area', DB::raw('count(*) as total'))
            ->groupBy('dominant_area')
            ->get()
            ->mapWithKeys(function ($item) {
                $labels = [
                    'A' => 'Ingeniería y Tecnología',
                    'B' => 'Salud y Bienestar',
                    'C' => 'Negocios y Sociales',
                    'D' => 'Artes y Educación',
                ];
                return [$labels[$item->dominant_area] ?? 'Otros' => $item->total];
            });

        // 3. Recent Activity (Bonus for premium feel)
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'vocationalDistribution', 'recentUsers'));
    }
}
