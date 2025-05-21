@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Your Bookings</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookings->isEmpty())
    <p>No bookings found.</p>
    @else
    <table class="table">
    <thead>
      <tr>
      <th>Teacher</th>
      <th>Schedule</th>
      <th>Status</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bookings as $booking)
      <tr>
      <td>{{ $booking->teacher->user->name }}</td>
      <td>{{ ucfirst($booking->schedule->day) }} | {{ $booking->schedule->clock }}</td>
      <td>{{ ucfirst($booking->status) }}</td>
      <td>
      @if($booking->status === 'completed' && !$booking->rating)
      <a href="{{ route('student.ratings.create', $booking->id) }}" class="btn btn-sm btn-primary">Give Rating</a>
      @elseif($booking->rating)
      <span class="text-success">Rated</span>
      @else
      <span class="text-muted">N/A</span>
      @endif
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
    @endif
  </div>
@endsection