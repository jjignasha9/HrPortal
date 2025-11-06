<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Company::query()->latest();
            return DataTables::of($q)
                ->addColumn('logo', function ($r) {
                    $src = $r->logo_path ? asset('storage/'.$r->logo_path) : 'https://placehold.co/80x80?text=Logo';
                    return '<img src="'.$src.'" class="w-9 h-9 rounded-lg" />';
                })
                ->addColumn('action', fn($row) => view('companies.partials.actions', compact('row'))->render())
                ->rawColumns(['logo','action'])
                ->make(true);
        }
        return view('companies.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:companies,code',
            'name' => 'required|string|max:150',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|string|max:150',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:120',
            'country' => 'nullable|string|max:120',
            'logo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('companies', 'public');
        }
        $m = Company::create($data);
        return response()->json(['message' => 'Company created', 'id' => $m->id]);
    }

    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:companies,code,'.$company->id,
            'name' => 'required|string|max:150',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|string|max:150',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:120',
            'country' => 'nullable|string|max:120',
            'logo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            if ($company->logo_path) Storage::disk('public')->delete($company->logo_path);
            $data['logo_path'] = $request->file('logo')->store('companies', 'public');
        }
        $company->update($data);
        return response()->json(['message' => 'Company updated']);
    }

    public function destroy(Company $company)
    {
        if ($company->logo_path) Storage::disk('public')->delete($company->logo_path);
        $company->delete();
        return response()->json(['message' => 'Company deleted']);
    }
}
