<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Invoice::query()->latest();
            return DataTables::of($q)
                ->addColumn('action', fn($row) => view('invoices.partials.actions', compact('row'))->render())
                ->make(true);
        }
        return view('invoices.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|string|max:50|unique:invoices,number',
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
        $m = Invoice::create($data);
        return response()->json(['message' => 'Invoice created', 'id' => $m->id]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'number' => 'required|string|max:50|unique:invoices,number,'.$invoice->id,
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
        $invoice->update($data);
        return response()->json(['message' => 'Invoice updated']);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json(['message' => 'Invoice deleted']);
    }

    public function print(Invoice $invoice)
    {
        return view('invoices.print', compact('invoice'));
    }
}
