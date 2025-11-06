<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationFollowup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Quotation::query()->latest();
            return DataTables::of($q)
                ->addColumn('action', function ($row) {
                    return view('quotations.partials.actions', compact('row'))->render();
                })
                ->make(true);
        }
        return view('quotations.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:quotations,code',
            'type' => 'required|in:standard,premium',
            'client_name' => 'nullable|string|max:120',
            'client_email' => 'nullable|email',
            'amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);
        $m = Quotation::create($data);
        return response()->json(['message' => 'Quotation created', 'id' => $m->id]);
    }

    public function update(Request $request, Quotation $quotation)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:quotations,code,'.$quotation->id,
            'type' => 'required|in:standard,premium',
            'client_name' => 'nullable|string|max:120',
            'client_email' => 'nullable|email',
            'amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);
        $quotation->update($data);
        return response()->json(['message' => 'Quotation updated']);
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();
        return response()->json(['message' => 'Quotation deleted']);
    }

    public function followups(Request $request, Quotation $quotation)
    {
        if ($request->isMethod('get')) {
            return response()->json($quotation->followups()->latest()->get());
        }
        $data = $request->validate([
            'follow_up_date' => 'nullable|date',
            'status' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);
        $data['user_id'] = $request->user()?->id;
        $quotation->followups()->create($data);
        return response()->json(['message' => 'Follow-up saved']);
    }
}
