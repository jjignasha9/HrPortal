<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Employee::query()->latest();
            return DataTables::of($query)
                ->addColumn('name', fn($r) => trim($r->first_name.' '.($r->last_name ?? '')))
                ->addColumn('photo', function ($r) {
                    $src = $r->photo_path ? asset('storage/'.$r->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($r->first_name).'&background=0ea5e9&color=fff';
                    return '<img src="'.$src.'" class="w-9 h-9 rounded-lg" />';
                })
                ->addColumn('action', function ($row) {
                    return view('hr.employees.partials.actions', compact('row'))->render();
                })
                ->rawColumns(['photo','action'])
                ->make(true);
        }
        return view('hr.employees.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:employees,code',
            'first_name' => 'required|string|max:120',
            'last_name' => 'nullable|string|max:120',
            'email' => 'required|email|unique:employees,email',
            'mobile' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'designation' => 'nullable|string|max:120',
            'department' => 'nullable|string|max:120',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('employees', 'public');
        }
        $employee = Employee::create($validated);
        return response()->json(['message' => 'Employee created', 'id' => $employee->id]);
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:employees,code,'.$employee->id,
            'first_name' => 'required|string|max:120',
            'last_name' => 'nullable|string|max:120',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'mobile' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'designation' => 'nullable|string|max:120',
            'department' => 'nullable|string|max:120',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($employee->photo_path) {
                Storage::disk('public')->delete($employee->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('employees', 'public');
        }
        $employee->update($validated);
        return response()->json(['message' => 'Employee updated']);
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo_path) {
            Storage::disk('public')->delete($employee->photo_path);
        }
        $employee->delete();
        return response()->json(['message' => 'Employee deleted']);
    }
}
