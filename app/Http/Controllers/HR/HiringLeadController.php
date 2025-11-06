<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\HiringLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class HiringLeadController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = HiringLead::query()->latest();
            
            // Apply filters
            if ($request->filled('filter_from')) {
                $query->whereDate('created_at', '>=', $request->filter_from);
            }
            if ($request->filled('filter_to')) {
                $query->whereDate('created_at', '<=', $request->filter_to);
            }
            if ($request->filled('filter_gender')) {
                $query->where('gender', $request->filter_gender);
            }
            if ($request->filled('filter_experience')) {
                $exp = $request->filter_experience;
                if ($exp === '0-2') {
                    $query->where('experience_years', '>=', 0)->where('experience_years', '<', 2);
                } elseif ($exp === '2-5') {
                    $query->where('experience_years', '>=', 2)->where('experience_years', '<', 5);
                } elseif ($exp === '5+') {
                    $query->where('experience_years', '>=', 5);
                }
            }
            
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('is_experience', function($row) {
                    return $row->has_experience === 'yes' ? 'Yes' : 'No';
                })
                ->addColumn('previous_company', function($row) {
                    return $row->previous_company ?? '—';
                })
                ->addColumn('experience_years', function($row) {
                    return $row->experience_years ? number_format($row->experience_years, 1) : '—';
                })
                ->addColumn('expected_salary', function($row) {
                    return $row->expected_salary ? '₹ '.number_format($row->expected_salary, 0) : '—';
                })
                ->addColumn('action', function ($row) {
                    return view('hr.leads.partials.actions', compact('row'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('hr.leads.index');
    }

    public function create()
    {
        return view('hr.leads.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string|max:50|unique:hiring_leads,code',
                'name' => 'required|string|max:120',
                'mobile' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'position' => 'nullable|string|max:120',
                'experience_years' => 'nullable|numeric|min:0|max:60',
                'expected_salary' => 'nullable|numeric|min:0',
                'gender' => 'nullable|in:male,female,other',
                'has_experience' => 'nullable|string|max:10',
                'previous_company' => 'nullable|string|max:255',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            ]);

            if ($request->hasFile('resume')) {
                $validated['resume_path'] = $request->file('resume')->store('resumes', 'public');
            }
            $validated['created_by'] = $request->user()?->id;

            $lead = HiringLead::create($validated);
            return response()->json(['message' => 'Lead created successfully', 'id' => $lead->id], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors(), 'message' => 'Validation failed'], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, HiringLead $hiringLead)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:hiring_leads,code,' . $hiringLead->id,
            'name' => 'required|string|max:120',
            'mobile' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:120',
            'experience_years' => 'nullable|numeric|min:0|max:60',
            'expected_salary' => 'nullable|numeric|min:0',
            'gender' => 'nullable|in:male,female,other',
            'has_experience' => 'nullable|string|max:10',
            'previous_company' => 'nullable|string|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('resume')) {
            if ($hiringLead->resume_path) {
                Storage::disk('public')->delete($hiringLead->resume_path);
            }
            $validated['resume_path'] = $request->file('resume')->store('resumes', 'public');
        }
        $hiringLead->update($validated);
        return response()->json(['message' => 'Lead updated successfully']);
    }

    public function destroy(HiringLead $hiringLead)
    {
        if ($hiringLead->resume_path) {
            Storage::disk('public')->delete($hiringLead->resume_path);
        }
        $hiringLead->delete();
        return response()->json(['message' => 'Lead deleted']);
    }
}
