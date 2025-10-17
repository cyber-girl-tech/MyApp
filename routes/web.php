<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TimetableController;

// Base Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication & Registration
Route::post('/register', [UserController::class, 'register'])->name('register.post'); 
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// The GET route for showing the login form
Route::get('/login', function () {
   return view('home'); // Assuming 'home' view contains the login form
})->name('login');

/*
|--------------------------------------------------------------------------
| Student Routes (Authenticated Users)
|--------------------------------------------------------------------------
| Use the most specific definition for student home and remove the duplicate.
*/

Route::middleware(['auth'])->group(function () {
    // This is the correct, definitive student home, showing announcements
    Route::get('student.announcements', [AnnouncementController::class, 'index'])->name('student.announcements');
    Route::get('student.events', [EventController::class, 'index'])->name('student.events');
    Route::get('student.timetables', [TimetableController::class, 'index'])->name('student.timetables');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Full CRUD and Dashboard)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // ADMIN DASHBOARD
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/users/create', [AdminController::class, 'createAdminForm'])->name('admin.user.create');
    Route::post('/users/store', [AdminController::class, 'storeAdmin'])->name('admin.user.store');

    // ANNOUNCEMENTS CRUD (Management)
    Route::get('admin.announcement', [AnnouncementController::class, 'adminIndex'])->name('admin.announcement');
    Route::get('/announcement/edit/{id}', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::post('announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');
    Route::put('/announcement/update/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');
    Route::delete('/announcement/delete/{id}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

    // EVENTS CRUD (Management)
     Route::get('adminevent', [EventController::class, 'adminIndex'])->name('admin.event');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::put('/event/update/{id}', [EventController::class, 'update'])->name('event.update');
    // Note: The URI here should probably be consistent, removing '/admin'
    Route::delete('/event/delete/{id}', [EventController::class, 'destroy'])->name('event.destroy');

    // TIMETABLES CRUD (Management)
    Route::get('admin.timetable', [TimetableController::class, 'adminIndex'])->name('admin.timetable');
    Route::post('/timetable/store', [TimetableController::class, 'store'])->name('timetable.store');
    Route::put('/timetable/update/{id}', [TimetableController::class, 'update'])->name('timetable.update');
    Route::delete('/timetable/delete/{id}', [TimetableController::class, 'destroy'])->name('timetable.destroy');
});