<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Show the career catalogue grouped by category.
     */
    public function index()
    {
        $careers = Career::orderBy('category')->orderBy('name')->get();

        // Group by category for the view
        $grouped = $careers->groupBy('category');

        return view('careers.index', compact('careers', 'grouped'));
    }

    /**
     * Show a single career profile page.
     */
    public function show(string $slug)
    {
        $career = Career::where('slug', $slug)->firstOrFail();

        return view('careers.show', compact('career'));
    }
}
