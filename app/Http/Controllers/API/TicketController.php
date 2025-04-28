<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $tickets = Ticket::where('user_id', $user->id)->get();

        return response()->json($tickets);
    }

    public function store(Request $request, $eventId)
    {
        $validated = $request->validate([
            'seat_info' => 'required|string|max:255',
        ]);

        $event = Event::findOrFail($eventId);

        if ($event->tickets()->count() >= $event->venue->capacity) {
            return response()->json(['message' => 'No tickets available for this event'], 400);
        }

        $ticket = Ticket::create([
            'user_id' => Auth::user()->id,
            'event_id' => $event->id,
            'price' => $event->price,
            'seat_info' => $validated['seat_info'],
            'booking_time' => now(),
        ]);

        return response()->json($ticket, 201);
    }

    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)
            ->orderBy('booking_time', 'desc')
            ->get();

        return response()->json($tickets);
    }

    public function allTickets()
    {
        Gate::authorize('viewAny', Ticket::class);

        $tickets = Ticket::all();
        return response()->json($tickets);
    }
}
