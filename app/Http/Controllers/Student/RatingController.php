<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Rating;
use App\Models\Teacher;
use Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function create(Booking $booking)
    {
        return view('ratings.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'booking_id' => 'required|exists:bookings,id',
            'quality_teaching' => 'required|integer|min:1|max:5',
            'communication' => 'required|integer|min:1|max:5',
            'discipline' => 'required|integer|min:1|max:5',
            'teaching_method' => 'required|integer|min:1|max:5',
            'teaching_result' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $booking->rating = true;
        $booking->save();

        Rating::create([
            'teacher_id' => $request->teacher_id,
            'student_id' => auth()->user()->student->id,
            'booking_id' => $request->booking_id,
            'quality_teaching' => $request->quality_teaching,
            'communication' => $request->communication,
            'discipline' => $request->discipline,
            'teaching_method' => $request->teaching_method,
            'teaching_result' => $request->teaching_result,
            'comment' => $request->comment,
        ]);

        // Recalculate average
        $ratings = Rating::where('teacher_id', $request->teacher_id)->get();

        $total = $ratings->sum(function ($r) {
            return ($r->quality_teaching + $r->communication + $r->discipline + $r->teaching_method + $r->teaching_result) / 5;
        });

        $average = $ratings->count() > 0 ? $total / $ratings->count() : 0;

        Teacher::where('id', $request->teacher_id)->update([
            'average_ratings' => round($average),
        ]);

        return redirect('/student/bookings')->with('success', 'Rating submitted successfully!');
    }

    public function myRatings()
    {
        $teacher = Auth::user()->teacher;

        $ratings = $teacher->ratings()->with('student.user')->latest()->get();

        return view('teacher.ratings.index', compact('ratings'));
    }
}
