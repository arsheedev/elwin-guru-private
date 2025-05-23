@extends('layouts.teacher')

@section('title', 'Create Schedule')

@section('content')
  <style>
    body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .container-create {
    max-width: 600px;
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
    margin-bottom: 1.5rem;
    }

    .alert-danger {
    max-width: 100%;
    margin-bottom: 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    color: #842029;
    background-color: #f8d7da;
    border-color: #f5c2c7;
    }

    .alert-danger ul {
    margin-bottom: 0;
    padding-left: 1.5rem;
    }

    .form-group {
    margin-bottom: 1.5rem;
    }

    .form-label {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    }

    .form-control {
    font-size: 1rem;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.75rem;
    width: 100%;
    transition: border-color 0.2s;
    }

    .form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
    }

    .btn-primary {
    background: linear-gradient(to right, #3b82f6, #1e40af);
    border: none;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    color: #ffffff;
    transition: background 0.2s, transform 0.1s;
    }

    .btn-primary:hover {
    background: linear-gradient(to right, #2563eb, #1e3a8a);
    transform: translateY(-1px);
    }

    .btn-back {
    background: #6b7280;
    color: #ffffff;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: background 0.2s, transform 0.1s;
    text-decoration: none;
    display: inline-block;
    }

    .btn-back:hover {
    background: #4b5563;
    transform: translateY(-1px);
    }

    .button-group {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    }

    @media (max-width: 768px) {
    .container {
      margin: 1rem;
      padding: 1.5rem;
    }

    h2 {
      font-size: 1.75rem;
    }

    .form-label,
    .form-control {
      font-size: 0.9rem;
    }

    .btn-primary,
    .btn-back {
      font-size: 0.9rem;
      padding: 0.75rem 1rem;
      width: 100%;
    }

    .button-group {
      flex-direction: column;
      gap: 0.5rem;
    }

    .alert-danger {
      font-size: 0.9rem;
    }
    }
  </style>

  <div class="container-create">
    <h2>Create Schedule</h2>

    @if($errors->any())
    <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif

    <form action="{{ route('teacher.schedules.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="day" class="form-label">Day</label>
      <select name="day" id="day" class="form-control" required>
      @foreach(['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'] as $day)
      <option value="{{ $day }}" {{ old('day') === $day ? 'selected' : '' }}>
      {{ ucfirst($day) }}
      </option>
    @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="clock" class="form-label">Time</label>
      <input type="time" name="clock" id="clock" class="form-control" value="{{ old('clock') }}" required>
    </div>

    <div class="button-group">
      <a href="{{ route('teacher.schedules.index') }}" class="btn-back">Back</a>
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
    </form>
  </div>
@endsection