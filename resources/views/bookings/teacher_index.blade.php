@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Your Bookings</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($bookings->isEmpty())
    <p>No bookings found.</p>
    @else
    <table class="table">
    <thead>
      <tr>
      <th>Student</th>
      <th>Schedule</th>
      <th>Status</th>
      <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bookings as $booking)
      <tr>
      <td>{{ $booking->student->user->name }}</td>
      <td>{{ ucfirst($booking->schedule->day) }} | {{ $booking->schedule->clock }}</td>
      <td>{{ ucfirst($booking->status) }}</td>
      <td>
      @if($booking->status === 'pending')
      <form method="POST" action="{{ route('teacher.bookings.accept', $booking) }}" style="display:inline">
      @csrf
      @method('PUT')
      <button class="btn btn-success btn-sm">Accept</button>
      </form>
      @elseif($booking->status === 'accepted')
      <form method="POST" action="{{ route('teacher.bookings.complete', $booking) }}" style="display:inline">
      @csrf
      @method('PUT')
      <button class="btn btn-primary btn-sm">Mark Completed</button>
      </form>
      @else
      <span class="text-success">Completed</span>
      @endif
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
    @endif
  </div>
@endsection