<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\Subject;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register', [
            'provinces' => Province::all(),
            'subjects' => Subject::all(),
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:student,teacher',
            'no_telepon' => 'required|string|max:20',
            'province_id' => 'required|exists:provinces,id',
            'regency_id' => 'required|exists:regencies,id',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'subject_id' => 'required_if:role,teacher|nullable|exists:subjects,id',
            'profile_image' => 'required_if:role,teacher|nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($user->role === 'student') {
            Student::create([
                'user_id' => $user->id,
                'no_telepon' => $validated['no_telepon'],
                'province_id' => $validated['province_id'],
                'regency_id' => $validated['regency_id'],
                'district_id' => $validated['district_id'],
                'village_id' => $validated['village_id'],
            ]);
        } elseif ($user->role === 'teacher') {
            $imagePath = null;
            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            }

            Teacher::create([
                'user_id' => $user->id,
                'no_telepon' => $validated['no_telepon'],
                'province_id' => $validated['province_id'],
                'regency_id' => $validated['regency_id'],
                'district_id' => $validated['district_id'],
                'village_id' => $validated['village_id'],
                'subject_id' => $validated['subject_id'],
                'profile_image' => $imagePath,
                'average_ratings' => 0,
            ]);
        }

        auth()->login($user);

        return redirect()->route('home');
    }
}
