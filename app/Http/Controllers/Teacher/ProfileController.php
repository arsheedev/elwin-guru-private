<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        $provinces = Province::all();
        $regencies = $teacher ? Regency::where('province_id', $teacher->province_id)->get() : [];
        $districts = $teacher ? District::where('regency_id', $teacher->regency_id)->get() : [];
        $villages = $teacher ? Village::where('district_id', $teacher->district_id)->get() : [];

        $subjects = Subject::all();

        return view('teacher.profile.edit', compact('user', 'teacher', 'provinces', 'regencies', 'districts', 'villages', 'subjects'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'subject_id' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Unauthorized. Teacher profile not found.');
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($teacher->profile_image && Storage::disk('public')->exists($teacher->profile_image)) {
                Storage::disk('public')->delete($teacher->profile_image);
            }

            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $teacher->profile_image = $imagePath;
        }

        $teacher->no_telepon = $request->no_telepon;
        $teacher->province_id = $request->province_id;
        $teacher->regency_id = $request->regency_id;
        $teacher->district_id = $request->district_id;
        $teacher->village_id = $request->village_id;
        $teacher->subject_id = $request->subject_id;

        $teacher->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
