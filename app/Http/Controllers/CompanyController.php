<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('challenges')->get();
        return view('companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $challenges = $company->challenges()->with('career')->get();
        return view('companies.show', compact('company', 'challenges'));
    }

    // ── Admin CRUD Methods ───────────────────────────────────────────────

    public function manage()
    {
        $this->authorizeAdmin();
        $companies = Company::latest()->get();
        return view('companies.manage', compact('companies'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sector'      => 'required|string|max:255',
            'website'     => 'nullable|url',
            'description' => 'required|string',
            'color'       => 'required|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('companies/logos', 'public');
        }

        Company::create([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'sector'      => $validated['sector'],
            'website'     => $validated['website'],
            'description' => $validated['description'],
            'color'       => $validated['color'],
            'logo'        => $logoPath,
        ]);

        return redirect()->route('companies.manage')->with('success', 'Empresa creada correctamente.');
    }

    public function edit(Company $company)
    {
        $this->authorizeAdmin();
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $this->authorizeAdmin();
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sector'      => 'required|string|max:255',
            'website'     => 'nullable|url',
            'description' => 'required|string',
            'color'       => 'required|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('companies/logos', 'public');
        }

        $company->update($data);

        return redirect()->route('companies.manage')->with('success', 'Empresa actualizada.');
    }

    public function destroy(Company $company)
    {
        $this->authorizeAdmin();
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        return redirect()->route('companies.manage')->with('success', 'Empresa eliminada.');
    }

    private function authorizeAdmin()
    {
        if (auth()->user()->user_type !== 'administrador') {
            abort(403);
        }
    }
}
