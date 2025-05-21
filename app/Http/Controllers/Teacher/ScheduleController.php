<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    // List all schedules for logged-in teacher
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $schedules = Schedule::where('teacher_id', $teacher->id)->orderBy('day')->orderBy('clock')->get();

        return view('teacher.schedules.index', compact('schedules'));
    }

    // Show form to create new schedule
    public function create()
    {
        return view('teacher.schedules.create');
    }

    // Store new schedule
    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|in:sunday,monday,tuesday,wednesday,thursday,friday,saturday',
            'clock' => 'required|string|max:20',
        ]);

        $teacher = Auth::user()->teacher;

        Schedule::create([
            'day' => $request->day,
            'clock' => $request->clock,
            'teacher_id' => $teacher->id,
            'is_available' => true,
        ]);

        return redirect()->route('teacher.schedules.index')->with('success', 'Schedule created successfully.');
    }

    // Show form to edit schedule
    public function edit(Schedule $schedule)
    {
        // $this->authorize('update', $schedule);

        return view('teacher.schedules.edit', compact('schedule'));
    }

    // Update schedule
    public function update(Request $request, Schedule $schedule)
    {
        // $this->authorize('update', $schedule);

        $request->validate([
            'day' => 'required|in:sunday,monday,tuesday,wednesday,thursday,friday,saturday',
            'clock' => 'required|string|max:20',
            'is_available' => 'required|boolean',
        ]);

        $schedule->update([
            'day' => $request->day,
            'clock' => $request->clock,
            'is_available' => $request->is_available,
        ]);

        return redirect()->route('teacher.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    // Delete schedule
    public function destroy(Schedule $schedule)
    {
        // $this->authorize('delete', $schedule);

        $schedule->delete();

        return redirect()->route('teacher.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
