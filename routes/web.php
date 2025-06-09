<?php

use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Student\RatingController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\ProfileController;
use App\Http\Controllers\Teacher\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/teachers/{id}', [HomepageController::class, 'show'])->name('teachers.show');



Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('subjects', SubjectController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Teacher Routes
Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('teacher.profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/schedules', [ScheduleController::class, 'index'])->name('teacher.schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('teacher.schedules.create');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('teacher.schedules.edit');
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('teacher.schedules.destroy');
    Route::resource('schedules', ScheduleController::class)->except(['show']);

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.teacher.index');
    Route::put('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('bookings.accept');
    Route::put('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');

    Route::get('/ratings', [RatingController::class, 'myRatings'])->name('ratings');
});

// Student Routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('teachers.search');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.student.index');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'canceled'])->name('bookings.cancel');
    Route::get('/teacher-detail/{teacher}', [StudentController::class, 'show'])->name('teachers.show');
    Route::get('/ratings/create/{booking}', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/ratings/store', [RatingController::class, 'store'])->name('ratings.store');
});

// API
Route::get('/api/regencies/{provinceId}', [LocationController::class, 'getRegencies']);
Route::get('/api/districts/{regencyId}', [LocationController::class, 'getDistricts']);
Route::get('/api/villages/{districtId}', [LocationController::class, 'getVillages']);
