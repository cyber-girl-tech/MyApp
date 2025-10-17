<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Handle student registration
     */
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name'     => ['required', 'min:3', 'max:100', Rule::unique('users', 'name')],
            'email'    => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8','max:100'],
        ]);
         $incomingFields['password'] = bcrypt($incomingFields['password']);
        // All new users are students by default
        $user = User::create($incomingFields);

        auth()->guard()->login($user);

        return redirect()->route('home')->with('success', 'Welcome, you have successfully registered!');
    }

    /**
     * Handle user login (admin or student)
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            }

            return redirect()->route('home')->with('success', 'Welcome Student!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    /**
     * Handle logout for any role
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}