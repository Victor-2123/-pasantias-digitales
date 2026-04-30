<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    /**
     * Show the career catalogue grouped by category.
     */
    public function index()
    {
        $careers = Career::orderBy('category')->orderBy('name')->get();
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

    // ── Admin CRUD Methods ───────────────────────────────────────────────

    /**
     * List all careers for administration.
     */
    public function manage()
    {
        $this->authorizeAdmin();
        $careers = Career::latest()->get();
        return view('careers.manage', compact('careers'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('careers.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'tagline'     => 'required|string|max:255',
            'description' => 'required|string',
            'color'       => 'required|string',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('careers/icons', 'public');
        }

        Career::create([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'category'    => $validated['category'],
            'tagline'     => $validated['tagline'],
            'description' => $validated['description'],
            'color'       => $validated['color'],
            'icon'        => $iconPath,
        ]);

        return redirect()->route('careers.manage')->with('success', 'Carrera creada correctamente.');
    }

    public function edit(Career $career)
    {
        $this->authorizeAdmin();
        return view('careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $this->authorizeAdmin();
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'tagline'     => 'required|string|max:255',
            'description' => 'required|string',
            'color'       => 'required|string',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('icon')) {
            if ($career->icon) {
                Storage::disk('public')->delete($career->icon);
            }
            $data['icon'] = $request->file('icon')->store('careers/icons', 'public');
        }

        $career->update($data);

        return redirect()->route('careers.manage')->with('success', 'Carrera actualizada.');
    }

    public function destroy(Career $career)
    {
        $this->authorizeAdmin();
        if ($career->icon) {
            Storage::disk('public')->delete($career->icon);
        }
        $career->delete();
        return redirect()->route('careers.manage')->with('success', 'Carrera eliminada.');
    }

    /**
     * Private helper to ensure admin access.
     */
    private function authorizeAdmin()
    {
        if (auth()->user()->user_type !== 'administrador') {
            abort(403);
        }
    }
}
