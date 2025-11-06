<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Ticket::query()->latest();
            return DataTables::of($q)
                ->addColumn('action', fn($row) => view('tickets.partials.actions', compact('row'))->render())
                ->make(true);
        }
        return view('tickets.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:tickets,code',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'priority' => 'nullable|string|max:20',
        ]);
        $data['created_by'] = $request->user()?->id;
        $m = Ticket::create($data);
        return response()->json(['message' => 'Ticket created', 'id' => $m->id]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:tickets,code,'.$ticket->id,
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'priority' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:20',
            'assigned_to' => 'nullable|exists:users,id'
        ]);
        $ticket->update($data);
        return response()->json(['message' => 'Ticket updated']);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted']);
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $data = $request->validate(['assigned_to' => 'required|exists:users,id']);
        $ticket->update($data);
        return response()->json(['message' => 'Assigned']);
    }

    public function resolve(Ticket $ticket)
    {
        $ticket->update(['status' => 'resolved']);
        return response()->json(['message' => 'Resolved']);
    }
}
