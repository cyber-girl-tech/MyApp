<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{

    // STUDENT (View events)
    public function index()
    {
        $events = Event::orderBy('start_time', 'asc')->get();
        return view('student.events', compact('events'));
    }

    // ADMIN (View all events)
    public function adminIndex()
    {
        $event = Event::orderBy('start_time', 'asc')->get();
        return view('admin.event', compact('event'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_time' => 'required|date_format:Y-m-d\TH:i|after:now',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
        ]);

        Event::create([
             'title' => $validated['title'],
            'description' =>  $validated['description'],
             'location' => $validated['location'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'user_id' => auth()->id(),

        ]);
        return redirect()->route('admin.event')->with('success', 'Event added successfully!');
    }

    public function update(Request $request, $id)
    {
         $event = Event::findOrFail($id);
       $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

       
        $event->update($validated);

        return redirect()->route('admin.event')->with('success', 'Event updated successfully!');
    }

    public function destroy($id)
    {
        $event = Event::destroy($id);
       

        return back()->with('success', 'Event deleted successfully!');
    }
}

