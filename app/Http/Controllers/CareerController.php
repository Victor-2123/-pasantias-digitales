<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::orderBy('name')->get();
        $grouped = $careers->groupBy('category');

        return view('careers.index', compact('careers', 'grouped'));
    }

    public function show($slug)
    {
        $career = Career::where('slug', $slug)->firstOrFail();
        return view('careers.show', compact('career'));
    }

    public function manage()
    {
        $careers = Career::orderBy('name')->paginate(20);
        return view('careers.manage', compact('careers'));
    }

    public function create()
    {
        return view('careers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:1',
            'description' => 'nullable|string',
            'salary_range' => 'nullable|string',
            'market_demand' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Career::create($validated);

        return redirect()->route('careers.manage')->with('success', 'Carrera creada exitosamente.');
    }

    public function edit(Career $career)
    {
        return view('careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:1',
            'description' => 'nullable|string',
            'salary_range' => 'nullable|string',
            'market_demand' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $career->update($validated);

        return redirect()->route('careers.manage')->with('success', 'Carrera actualizada exitosamente.');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('careers.manage')->with('success', 'Carrera eliminada exitosamente.');
    }
}
