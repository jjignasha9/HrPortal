<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Project::query()->latest();
            return DataTables::of($q)
                ->addColumn('action', fn($row) => view('projects.partials.actions', compact('row'))->render())
                ->make(true);
        }
        return view('projects.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:projects,code',
            'name' => 'required|string|max:150',
            'company_id' => 'nullable|exists:companies,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'budget' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        $m = Project::create($data);
        return response()->json(['message' => 'Project created', 'id' => $m->id]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:projects,code,'.$project->id,
            'name' => 'required|string|max:150',
            'company_id' => 'nullable|exists:companies,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'budget' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        $project->update($data);
        return response()->json(['message' => 'Project updated']);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
