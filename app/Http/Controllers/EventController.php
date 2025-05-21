<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date')->get();

        return Inertia::render('Events', [
            'events' => $events
        ]);
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        return Inertia::render('EventShow', [
            'event' => $event,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer_id' => 'nullable|exists:users,id',
        ]);

        Event::create($data);

        return redirect()->back()->with('success', 'Événement créé avec succès');
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer_id' => 'nullable|exists:users,id',
        ]);

        $event->update($data);

        return redirect()->back()->with('success', 'Événement modifié avec succès');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->back()->with('success', 'Événement supprimé');
    }
}
