<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // List bookings for logged-in teacher or student
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'teacher') {
            $teacher = $user->teacher;
            $bookings = Booking::with(['student.user', 'schedule'])
                ->where('teacher_id', $teacher->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('bookings.teacher_index', compact('bookings'));
        }

        if ($user->role === 'student') {
            $student = $user->student;
            $bookings = Booking::with(['teacher.user', 'schedule'])
                ->where('student_id', $student->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('bookings.student_index', compact('bookings'));
        }

        abort(403, 'Unauthorized');
    }

    // Student creates a booking for a teacher's schedule
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        $student = Auth::user()->student;

        // Check if schedule is available
        $schedule = Schedule::where('id', $request->schedule_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('is_available', true)
            ->firstOrFail();

        // Create booking
        Booking::create([
            'teacher_id' => $request->teacher_id,
            'student_id' => $student->id,
            'schedule_id' => $schedule->id,
            'status' => 'pending',
        ]);

        $schedule->update(['is_available' => false]);

        return redirect()->back()->with('success', 'Booking requested successfully.');
    }

    // Teacher accepts a booking
    public function accept(Booking $booking)
    {
        // $this->authorize('update', $booking);

        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'Booking cannot be accepted.');
        }

        $booking->update(['status' => 'accepted']);
        $booking->schedule->update(['is_available' => false]);

        return redirect()->back()->with('success', 'Booking accepted.');
    }

    public function canceled(Booking $booking)
    {
        // $this->authorize('update', $booking);

        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'Booking cannot be canceled.');
        }

        $booking->update(['status' => 'canceled']);
        $booking->schedule->update(['is_available' => true]); // Free the schedule slot

        return redirect()->back()->with('success', 'Booking canceled.');
    }

    // Teacher marks booking as completed
    public function complete(Booking $booking)
    {
        // $this->authorize('update', $booking);

        if ($booking->status !== 'accepted') {
            return redirect()->back()->with('error', 'Booking cannot be completed.');
        }

        $booking->update(['status' => 'completed']);
        $booking->schedule->update(['is_available' => true]);

        return redirect()->back()->with('success', 'Booking marked as completed.');
    }
}
