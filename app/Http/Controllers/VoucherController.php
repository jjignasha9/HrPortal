<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VoucherController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Voucher::query()->latest();
            return DataTables::of($q)
                ->addColumn('action', fn($row) => view('vouchers.partials.actions', compact('row'))->render())
                ->make(true);
        }
        return view('vouchers.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|string|max:50|unique:vouchers,number',
            'date' => 'required|date',
            'payee_name' => 'required|string|max:150',
            'amount' => 'required|numeric|min:0',
            'mode' => 'nullable|string|max:50',
            'reference' => 'nullable|string|max:150',
            'notes' => 'nullable|string',
        ]);
        $m = Voucher::create($data);
        return response()->json(['message' => 'Voucher created', 'id' => $m->id]);
    }

    public function update(Request $request, Voucher $voucher)
    {
        $data = $request->validate([
            'number' => 'required|string|max:50|unique:vouchers,number,'.$voucher->id,
            'date' => 'required|date',
            'payee_name' => 'required|string|max:150',
            'amount' => 'required|numeric|min:0',
            'mode' => 'nullable|string|max:50',
            'reference' => 'nullable|string|max:150',
            'notes' => 'nullable|string',
        ]);
        $voucher->update($data);
        return response()->json(['message' => 'Voucher updated']);
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return response()->json(['message' => 'Voucher deleted']);
    }

    public function print(Voucher $voucher)
    {
        return view('vouchers.print', compact('voucher'));
    }
}
