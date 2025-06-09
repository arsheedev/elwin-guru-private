<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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
            },
            'bookings'
        ])->findOrFail($id);

        // Count unique students who booked this teacher
        $studentCount = $teacher->bookings()->distinct('student_id')->count('student_id');

        // Get the latest booking with rating and student name
        $latestRating = Booking::where('teacher_id', $id)
            ->whereNotNull('rating')
            ->with('student.user')
            ->latest('updated_at')
            ->first();

        return view('student.teachers.show', compact('teacher', 'studentCount', 'latestRating'));
    }

}
