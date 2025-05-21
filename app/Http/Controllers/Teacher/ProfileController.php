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
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Unauthorized. Teacher profile not found.');
        }

        $teacher->update([
            'no_telepon' => $request->no_telepon,
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

}

