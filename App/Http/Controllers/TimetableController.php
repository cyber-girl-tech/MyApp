<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;

class TimetableController extends Controller
{
    // STUDENT (View timetable)
    public function index()
    {
        $timetables = Timetable::latest()->get();
        return view('student.timetables', compact('timetables'));
    }

    // ADMIN (View all timetables)
    public function adminIndex()
    {
        $timetable = Timetable::latest()->get();
        return view('admin.timetable', compact('timetable'));
    }


    // ADMIN (Store new timetable)
    public function store(Request $request)
    {
       $validated = $request->validate([
            'course_name'     => 'required',
            'level'        => 'required',
            'description'   => 'required',
            'day'        => 'required',
            'time'       => 'required',
            
        ]);

        Timetable::create([
            'course_name' => $validated['course_name'],
            'level' =>  $validated['level'],
            'description'   => $validated['description'],
            'day'        => $validated['day'],
            'time'       => $validated['time'],
            'user_id' => auth()->id(),
    ]);     

        return redirect()->route('admin.timetable')->with('success', 'Timetable added.');
    }

    // ADMIN (Edit form)
    public function edit($id)
    {
        $timetable = Timetable::findOrFail($id);
        return view('timetable.edit', compact('timetable'));
    }

    // ADMIN (Update timetable)
    public function update(Request $request, $id)
    {
        $timetable = Timetable::findOrFail($id);
         
        $validated = $request->validate([
            'course_name'     => 'required',
            'level'        => 'required',
            'description'   => 'required',
            'day'        => 'required',
            'time'       => 'required',
            
       
        ]);

        $timetable->update($validated);
        return redirect()->route('admin.timetable')->with('success', 'Timetable updated.');
    }

    // ADMIN (Delete timetable)
    public function destroy($id)
    {
        Timetable::destroy($id);
        return back()->with('success', 'Timetable removed.');
    }
}
