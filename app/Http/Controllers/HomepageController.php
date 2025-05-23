<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        // Load filters data for dropdowns
        $subjects = Subject::all();
        $provinces = Province::all();
        $regencies = collect();

        // If province is selected, load regencies
        if ($request->filled('province_id')) {
            $regencies = Regency::where('province_id', $request->province_id)->get();
        }

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

        // Filter by regency (kota/kabupaten)
        if ($request->filled('regency_id')) {
            $query->where('regency_id', $request->regency_id);
        }



        // Get search results
        $teachers = $query->with('user', 'subject', 'province', 'regency')
            ->paginate(10);

        return view('default', compact(
            'teachers',
            'subjects',
            'provinces',
            'regencies',
            'request'
        ));
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

        return view('default.show', compact('teacher'));
    }
}