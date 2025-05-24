@extends('layouts.students')

@section('title', 'Teacher Profile - ' . $teacher->user->name)

@section('content')
  <style>
    body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.5rem;
    }

    .rating {
    font-size: 1rem;
    color: #4b5563;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    }

    .rating i {
    color: #f59e0b;
    /* Star color */
    margin-right: 0.5rem;
    }

    p {
    font-size: 1rem;
    color: #4b5563;
    margin-bottom: 0.75rem;
    }

    p strong {
    color: #1f2937;
    }

    hr {
    border: 0;
    border-top: 1px solid #e5e7eb;
    margin: 1.5rem 0;
    }

    h4 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1rem;
    }

    .list-group-item {
    font-size: 1rem;
    color: #4b5563;
    border-color: #e5e7eb;
    }

    .badge {
    font-size: 0.85rem;
    padding: 0.5em 0.75em;
    }

    .form-group {
    margin-bottom: 1.5rem;
    }

    .form-control {
    font-size: 1rem;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.75rem;
    width: 100%;
    }

    .btn-primary {
    background: linear-gradient(to right, #3b82f6, #1e40af);
    border: none;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: background 0.2s, transform 0.1s;
    color: #ffffff;
    /* Explicit white text */
    }

    .btn-primary:hover {
    background: linear-gradient(to right, #2563eb, #1e3a8a);
    transform: translateY(-1px);
    }

    .btn-back {
    background: #6b7280;
    color: #ffffff;
    /* Explicit white text */
    border: none;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: background 0.2s, transform 0.1s;
    text-decoration: none;
    display: inline-block;
    margin-right: 1rem;
    }

    .btn-back:hover {
    background: #4b5563;
    transform: translateY(-1px);
    }

    .button-group {
    display: flex;
    gap: 1rem;
    }

    @media (max-width: 768px) {
    .container {
      margin: 1rem;
      padding: 1.5rem;
    }

    h2 {
      font-size: 1.75rem;
    }

    h4 {
      font-size: 1.25rem;
    }

    .rating {
      font-size: 0.9rem;
    }

    .form-control,
    .btn-primary,
    .btn-back {
      font-size: 0.9rem;
    }

    .button-group {
      flex-direction: column;
      gap: 0.5rem;
    }

    .btn-back,
    .btn-primary {
      width: 100%;
      margin-right: 0;
    }
    }
  </style>

  <div class="container">
    <h2>{{ $teacher->user->name }}</h2>
    <div class="rating">
    <i class="fas fa-star"></i>
    <span>Rating:
      {{ $teacher->average_rating ? number_format($teacher->average_rating, 1) . '/5' : 'No rating yet' }}</span>
    </div>

    <p><strong>Subject:</strong> {{ $teacher->subject->name ?? '-' }}</p>
    <p><strong>Phone:</strong> {{ $teacher->no_telepon ?? '-' }}</p>

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
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <span>{{ ucfirst($schedule->day) }} at {{ $schedule->clock }}</span>
      <span class="badge bg-success">Available</span>
    </li>
    @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('student.bookings.store') }}" id="booking-form">
    @csrf
    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
    <div class="form-group">
      <label for="schedule_id">Select Schedule</label>
      <select name="schedule_id" id="schedule_id" class="form-control" required>
      <option value="">Select a schedule</option>
      @foreach($teacher->schedules as $schedule)
      <option value="{{ $schedule->id }}">
      {{ ucfirst($schedule->day) }} | {{ $schedule->clock }}
      </option>
    @endforeach
      </select>
    </div>
    <div class="button-group">
      <a href="/student" class="btn-back">Back</a>
      <button type="submit" class="btn btn-primary" id="book-now">Book Now</button>
    </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const bookNowButton = document.getElementById('book-now');
    const bookingForm = document.getElementById('booking-form');

    // Check if user is authenticated
    const isAuthenticated = @json(auth()->check());

    bookNowButton.addEventListener('click', function (event) {
      if (!isAuthenticated) {
      event.preventDefault(); // Prevent form submission
      window.location.href = '/login'; // Redirect to login
      }
      // If authenticated, form will submit normally
    });
    });
  </script>
@endsection