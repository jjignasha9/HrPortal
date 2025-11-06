<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Receipt::query()->latest();
            return DataTables::of($q)
                ->addColumn('action', fn($row) => view('receipts.partials.actions', compact('row'))->render())
                ->make(true);
        }
        return view('receipts.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|string|max:50|unique:receipts,number',
            'date' => 'required|date',
            'payer_name' => 'required|string|max:150',
            'payer_email' => 'nullable|email',
            'amount' => 'required|numeric|min:0',
            'mode' => 'nullable|string|max:50',
            'reference' => 'nullable|string|max:150',
            'notes' => 'nullable|string',
        ]);
        $m = Receipt::create($data);
        return response()->json(['message' => 'Receipt created', 'id' => $m->id]);
    }

    public function update(Request $request, Receipt $receipt)
    {
        $data = $request->validate([
            'number' => 'required|string|max:50|unique:receipts,number,'.$receipt->id,
            'date' => 'required|date',
            'payer_name' => 'required|string|max:150',
            'payer_email' => 'nullable|email',
            'amount' => 'required|numeric|min:0',
            'mode' => 'nullable|string|max:50',
            'reference' => 'nullable|string|max:150',
            'notes' => 'nullable|string',
        ]);
        $receipt->update($data);
        return response()->json(['message' => 'Receipt updated']);
    }

    public function destroy(Receipt $receipt)
    {
        $receipt->delete();
        return response()->json(['message' => 'Receipt deleted']);
    }

    public function print(Receipt $receipt)
    {
        return view('receipts.print', compact('receipt'));
    }
}
