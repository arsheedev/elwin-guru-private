@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>{{ $teacher->user->name }}</h2>

    <p><strong>Subject:</strong> {{ $teacher->subject->name ?? '-' }}</p>
    <p><strong>Phone:</strong> {{ $teacher->no_telepon }}</p>

    <p>
    <strong>Location:</strong>
    {{ $teacher->village->name ?? '-' }},
    {{ $teacher->district->name ?? '-' }},
    {{ $teacher->regency->name ?? '-' }},
    {{ $teacher->province->name ?? '-' }}
    </p>

    <hr>

    <h4>Available Schedules</h4>
    @if($teacher->schedules->isEmpty())
    <p>No available schedules.</p>
    @else
    <ul class="list-group mb-3">
    @foreach($teacher->schedules as $schedule)
    <li class="list-group-item d-flex justify-content-between">
      <span>{{ ucfirst($schedule->day) }} at {{ $schedule->clock }}</span>
      @if($schedule->is_available)
      <span class="badge bg-success">Available</span>
    @else
      <span class="badge bg-secondary">Booked</span>
    @endif
    </li>
    @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('student.bookings.store') }}">
    @csrf
    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
    <div class="form-group">
      <label for="schedule_id">Select Schedule</label>
      <select name="schedule_id" id="schedule_id" class="form-control" required>
      @foreach($teacher->schedules()->where('is_available', true)->get() as $schedule)
      <option value="{{ $schedule->id }}">
      {{ ucfirst($schedule->day) }} | {{ $schedule->clock }}
      </option>
    @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Book Now</button>
    </form>

  </div>
@endsection