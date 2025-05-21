@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Rate Teacher: {{ $booking->teacher->user->name }}</h2>

    <form action="{{ route('student.ratings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="teacher_id" value="{{ $booking->teacher_id }}">
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

    <label>Quality Teaching</label>
    <input type="number" name="quality_teaching" min="1" max="5" required>

    <label>Communication</label>
    <input type="number" name="communication" min="1" max="5" required>

    <label>Discipline</label>
    <input type="number" name="discipline" min="1" max="5" required>

    <label>Teaching Method</label>
    <input type="number" name="teaching_method" min="1" max="5" required>

    <label>Teaching Result</label>
    <input type="number" name="teaching_result" min="1" max="5" required>

    <label>Comment</label>
    <textarea name="comment"></textarea>

    <button class="btn btn-primary">Submit Rating</button>
    </form>

  </div>
@endsection