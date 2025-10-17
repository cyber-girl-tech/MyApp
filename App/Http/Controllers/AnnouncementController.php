<?php

namespace App\Http\Controllers;

// --- DEBUG FIXES ---
// 1. REMOVED: use App\Http\Controllers; <-- This line is incorrect and unnecessary.

use App\Models\Announcement;
use Illuminate\Http\Request;
// NOTE: Since this file is already in the App\Http\Controllers namespace,
// extending 'Controller' works fine without an explicit 'use' statement for it.

class AnnouncementController extends Controller
{

    // STUDENT (View Only)
    public function index()
    {
        $announcements = Announcement::latest()->get();
        // 2. SUGGESTED FIX: Use a distinct view name for the student side (e.g., 'announcements.student_index')
        // to avoid conflicts with the admin view 'announcements.index'.
        return view('student.announcements', compact('announcements'));
    }

    // ADMIN (Show all for management)
    public function adminIndex()
    {
        $announcement = Announcement::latest()->get();
        return view('admin.announcement', compact('announcement'));
    }
    
    //  ADMIN (Store new)
    public function store(Request $request)
    {
        // Added 'required|string|max:255' for better validation practice
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required'

        ]);
        
        Announcement::create([
            'title' => $validated['title'],
            'body' =>  $validated['body'],
            'user_id' => auth()->id(),

        ]);
        return redirect()->route('admin.announcement')->with('success', 'Announcement created.');
    }

    //  ADMIN (Edit form)
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.edit', compact('announcement'));
    }

    //  ADMIN (Update record)
    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        // Added 'required|string|max:255' for better validation practice
      $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);
     $announcement->update($validated);
        return redirect()->route('admin.announcement')->with('success', 'Announcement updated.');
    }

    //  ADMIN (Delete record)
    public function destroy($id)
    {
        Announcement::destroy($id);
        return back()->with('success', 'Announcement deleted.');
    }
}