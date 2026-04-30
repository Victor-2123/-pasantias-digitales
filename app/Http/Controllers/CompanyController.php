<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('challenges')->orderBy('name')->get();
        return view('companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $company->load('challenges.career');
        return view('companies.show', compact('company'));
    }

    public function manage()
    {
        $companies = Company::withCount('challenges')->orderBy('name')->paginate(20);
        return view('companies.manage', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sector' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Company::create($validated);

        return redirect()->route('companies.manage')->with('success', 'Empresa creada exitosamente.');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sector' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $company->update($validated);

        return redirect()->route('companies.manage')->with('success', 'Empresa actualizada exitosamente.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.manage')->with('success', 'Empresa eliminada exitosamente.');
    }
}
