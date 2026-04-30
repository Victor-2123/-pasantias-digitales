<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

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
}
