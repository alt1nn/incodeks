<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::with('venue')->orderBy('date', 'asc')->get();
        return response()->json($events);
    }

    public function show(Event $event)
    {
        $event->load('venue');
        return response()->json($event);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Event::class);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date|after:today',
            'price' => 'required|numeric',
            'venue_id' => 'required|exists:venues,id',
        ]);

        $event = Event::create(array_merge(
            $validated,
            ['user_id' => Auth::id()]
        ));

        return response()->json($event, 201);
    }

    public function update(Request $request, Event $event)
    {
        Gate::authorize('update', $event);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date|after:today',
            'price' => 'nullable|numeric',
            'venue_id' => 'required|exists:venues,id',
        ]);

        $event->update(array_merge(
            $validated,
            ['user_id' => Auth::id()]
        ));

        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        Gate::authorize('delete', $event);

        $event->delete();

        return response()->json(null, 204);
    }
}
