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
        $stats = [
            'total_students' => User::where('user_type', 'estudiante')->count(),
            'total_mentors' => User::where('user_type', 'maestro')->count(),
            'total_tasks' => TaskSubmission::where('status', 'approved')->count(),
        ];

        // Distribution mapping
        $distributionMap = [
            'A' => 'Ingeniería y Tecnología',
            'B' => 'Salud y Bienestar',
            'C' => 'Negocios y Sociales',
            'D' => 'Artes y Educación',
        ];

        $results = VocationalTestResult::select('dominant_area', DB::raw('count(*) as total'))
            ->groupBy('dominant_area')
            ->get();

        $vocationalDistribution = collect($distributionMap)->mapWithKeys(function($label, $key) use ($results) {
            $found = $results->where('dominant_area', $key)->first();
            return [$label => $found ? $found->total : 0];
        });

        $recentUsers = User::orderBy('created_at', 'desc')->take(10)->get();

        return view('admin.dashboard', compact('stats', 'vocationalDistribution', 'recentUsers'));
    }
}
