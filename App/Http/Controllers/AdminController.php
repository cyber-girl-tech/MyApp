<?php

namespace App\Http\Controllers;

use app\Models\User;
use App\Models\Event;
use App\Models\Timetable;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    //Display the admin dashboard
    

    public function index()
    {
        // Shows dashboard overview
        $announcementsCount = Announcement::count();
        $eventsCount = Event::count();
        $timetablesCount = Timetable::count();

        return view('admin.dashboard', compact('announcementsCount', 'eventsCount', 'timetablesCount'));
    }

    public function createAdminForm()
{
    return view('admin.create_user'); // We'll create this Blade file next
}

/**
 * Store a newly created user (defaults to admin role).
 */
public function storeAdmin(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'min:3', 'max:255'],
        'email' => ['required','email',Rule::unique('users', 'email')],
        'password' => ['required', 'min:8', 'max:100'], // 'confirmed' checks for 'password_confirmation' field
        'role' => 'required|in:admin,student', // Force selection of role
    ]);

    // Create the user with the specified role
    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'], // Use the validated role
    ]);

    return redirect()->route('admin.dashboard')->with('success', $validated['role'] . ' account created successfully.');
}
}

