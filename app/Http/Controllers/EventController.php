<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Event::query()->latest();
            return DataTables::of($q)
                ->addColumn('media', function ($r) {
                    $list = collect($r->media_paths ?? [])->take(3)->map(function($p){
                        $ext = pathinfo($p, PATHINFO_EXTENSION);
                        if (in_array(strtolower($ext), ['mp4','webm'])) {
                            return '<video class="w-12 h-12 rounded-lg" src="'.asset('storage/'.$p).'" />';
                        }
                        return '<img class="w-12 h-12 rounded-lg" src="'.asset('storage/'.$p).'" />';
                    })->implode('');
                    return '<div class="flex gap-2">'.$list.'</div>';
                })
                ->addColumn('action', fn($row) => view('events.partials.actions', compact('row'))->render())
                ->rawColumns(['media','action'])
                ->make(true);
        }
        return view('events.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'media.*' => 'nullable|file|max:10240',
        ]);
        $paths = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $paths[] = $file->store('events', 'public');
            }
        }
        $data['media_paths'] = $paths;
        $m = Event::create($data);
        return response()->json(['message' => 'Event created', 'id' => $m->id]);
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'media.*' => 'nullable|file|max:10240',
        ]);
        $paths = $event->media_paths ?? [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $paths[] = $file->store('events', 'public');
            }
        }
        $data['media_paths'] = $paths;
        $event->update($data);
        return response()->json(['message' => 'Event updated']);
    }

    public function destroy(Event $event)
    {
        foreach (($event->media_paths ?? []) as $p) {
            Storage::disk('public')->delete($p);
        }
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
