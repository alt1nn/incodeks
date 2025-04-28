<?php

namespace App\Http\Controllers\API;

use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::all();
        return response()->json($venues);
    }
    public function store(Request $request)
    {
        Gate::authorize('create', Venue::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        $venue = Venue::create($validated);
        return response()->json($venue, 201);
    }

    public function update(Request $request, Venue $venue)
    {
        Gate::authorize('update', $venue);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:500',
            'capacity' => 'sometimes|required|integer|min:1',
        ]);

        $venue->update($validated);

        return response()->json($venue);
    }

    public function destroy(Venue $venue)
    {
        Gate::authorize('delete', $venue);
        $venue->delete();

        return response()->json(['message' => 'Venue deleted successfully']);
    }
}
