<?php

namespace App\Http\Controllers;

use App\Models\Performa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PerformaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Performa::query()->latest();
            return DataTables::of($q)
                ->addColumn('action', fn($row) => view('performas.partials.actions', compact('row'))->render())
                ->make(true);
        }
        return view('performas.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|string|max:50|unique:performas,number',
            'date' => 'required|date',
            'client_name' => 'required|string|max:150',
            'client_email' => 'nullable|email',
            'client_phone' => 'nullable|string|max:20',
            'client_address' => 'nullable|string',
            'items' => 'required|array|min:1',
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);
        $m = Performa::create($data);
        return response()->json(['message' => 'Performa created', 'id' => $m->id]);
    }

    public function update(Request $request, Performa $performa)
    {
        $data = $request->validate([
            'number' => 'required|string|max:50|unique:performas,number,'.$performa->id,
            'date' => 'required|date',
            'client_name' => 'required|string|max:150',
            'client_email' => 'nullable|email',
            'client_phone' => 'nullable|string|max:20',
            'client_address' => 'nullable|string',
            'items' => 'required|array|min:1',
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);
        $performa->update($data);
        return response()->json(['message' => 'Performa updated']);
    }

    public function destroy(Performa $performa)
    {
        $performa->delete();
        return response()->json(['message' => 'Performa deleted']);
    }

    public function print(Performa $performa)
    {
        return view('performas.print', compact('performa'));
    }
}
