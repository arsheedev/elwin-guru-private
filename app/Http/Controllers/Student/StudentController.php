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
        $query = Teacher::query();

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('province_id')) {
            $query->where('province_id', $request->province_id);
        }

        if ($request->filled('regency_id')) {
            $query->where('regency_id', $request->regency_id);
        }

        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        if ($request->filled('village_id')) {
            $query->where('village_id', $request->village_id);
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = (int) $request->min_price;
            $maxPrice = (int) $request->max_price;
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        $teachers = $query->with(['user', 'subject', 'province', 'regency', 'district', 'village'])
            ->paginate(10)
            ->withQueryString();

        $subjects = Subject::all();
        $provinces = Province::all();

        \DB::enableQueryLog();
        $teachers->load(['user', 'subject', 'province', 'regency', 'district', 'village']);

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

        $studentCount = $teacher->bookings()->distinct('student_id')->count('student_id');

        $latestRating = Booking::where('teacher_id', $id)
            ->whereNotNull('rating')
            ->with('student.user')
            ->latest('updated_at')
            ->first();

        return view('student.teachers.show', compact('teacher', 'studentCount', 'latestRating'));
    }

}
