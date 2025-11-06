<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\InquiryFollowup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Inquiry::query()->latest();
            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return view('inquiries.partials.actions', compact('row'))->render();
                })
                ->make(true);
        }
        return view('inquiries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:inquiries,code',
            'name' => 'nullable|string|max:120',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'source' => 'nullable|string|max:120',
            'message' => 'nullable|string',
            'status' => 'nullable|string|max:50',
        ]);
        $inquiry = Inquiry::create($validated);
        return response()->json(['message' => 'Inquiry created', 'id' => $inquiry->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inquiry $inquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inquiry $inquiry)
    {
        //
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:inquiries,code,'.$inquiry->id,
            'name' => 'nullable|string|max:120',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'source' => 'nullable|string|max:120',
            'message' => 'nullable|string',
            'status' => 'nullable|string|max:50',
        ]);
        $inquiry->update($validated);
        return response()->json(['message' => 'Inquiry updated']);
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return response()->json(['message' => 'Inquiry deleted']);
    }

    public function followups(Request $request, Inquiry $inquiry)
    {
        if ($request->isMethod('get')) {
            return response()->json($inquiry->followups()->latest()->get());
        }

        $data = $request->validate([
            'follow_up_date' => 'nullable|date',
            'status' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);
        $data['user_id'] = $request->user()?->id;
        $inquiry->followups()->create($data);
        return response()->json(['message' => 'Follow-up saved']);
    }
}
