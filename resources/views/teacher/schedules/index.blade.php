@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Your Schedules</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('teacher.schedules.create') }}" class="btn btn-primary mb-3">Add New Schedule</a>

    @if($schedules->isEmpty())
    <p>No schedules yet.</p>
    @else
    <table class="table">
    <thead>
      <tr>
      <th>Day</th>
      <th>Clock</th>
      <th>Available</th>
      <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($schedules as $schedule)
      <tr>
      <td>{{ ucfirst($schedule->day) }}</td>
      <td>{{ $schedule->clock }}</td>
      <td>{{ $schedule->is_available ? 'Yes' : 'No' }}</td>
      <td>
      <a href="{{ route('teacher.schedules.edit', $schedule) }}" class="btn btn-warning btn-sm">Edit</a>

      <form action="{{ route('teacher.schedules.destroy', $schedule) }}" method="POST" style="display:inline-block"
      onsubmit="return confirm('Delete this schedule?')">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm">Delete</button>
      </form>
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
    @endif
  </div>
@endsection