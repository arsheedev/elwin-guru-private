<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Load filters data for dropdowns
        $subjects = Subject::all();
        $provinces = Province::all();

        // Start query builder for teachers
        $query = Teacher::query();

        // Filter by subject
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        // Filter by province
        if ($request->filled('province_id')) {
            $query->where('province_id', $request->province_id);
        }

        // Filter by regency
        if ($request->filled('regency_id')) {
            $query->where('regency_id', $request->regency_id);
        }

        // Filter by district
        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        // Filter by village
        if ($request->filled('village_id')) {
            $query->where('village_id', $request->village_id);
        }

        // Eager load relations
        $teachers = $query->with('user', 'subject', 'province', 'regency', 'district', 'village')->paginate(10);

        return view('student.index', compact('teachers', 'subjects', 'provinces', 'request'));
    }

    public function show($id)
    {
        $teacher = Teacher::with([
            'user',
            'subject',
            'province',
            'regency',
            'district',
            'village',
            'schedules' => function ($q) {
                $q->where('is_available', true);
            }
        ])->findOrFail($id);

        return view('student.teachers.show', compact('teacher'));
    }

}
