@extends('layouts.teacher')

@section('title', 'Your Schedules')

@section('content')
  <style>
    body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .container-schedules {
    max-width: 1000px;
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

    .alert-success {
    max-width: 600px;
    margin: 0 auto 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    color: #065f46;
    background-color: #d1fae5;
    border-color: #6ee7b7;
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
    display: inline-block;
    text-decoration: none;
    }

    .btn-primary:hover {
    background: linear-gradient(to right, #2563eb, #1e3a8a);
    transform: translateY(-1px);
    }

    .table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .table th,
    .table td {
    padding: 1rem;
    font-size: 1rem;
    color: #4b5563;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    }

    .table th {
    font-weight: 600;
    color: #1f2937;
    background: #f9fafb;
    }

    .table tr:last-child td {
    border-bottom: none;
    }

    .table tr:hover {
    background: #f1f5f9;
    }

    .btn-warning {
    background: #f59e0b;
    border: none;
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    color: #ffffff;
    transition: background 0.2s, transform 0.1s;
    text-decoration: none;
    }

    .btn-warning:hover {
    background: #d97706;
    transform: translateY(-1px);
    }

    .btn-danger {
    background: #dc3545;
    border: none;
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    color: #ffffff;
    transition: background 0.2s, transform 0.1s;
    }

    .btn-danger:hover {
    background: #b91c1c;
    transform: translateY(-1px);
    }

    .action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
    }

    .no-schedules {
    font-size: 1rem;
    color: #6b7280;
    text-align: center;
    margin: 2rem 0;
    }

    @media (max-width: 768px) {
    .container {
      margin: 1rem;
      padding: 1.5rem;
    }

    h2 {
      font-size: 1.75rem;
    }

    .btn-primary {
      font-size: 0.9rem;
      padding: 0.75rem 1rem;
      width: 100%;
      text-align: center;
    }

    .table th,
    .table td {
      font-size: 0.9rem;
      padding: 0.75rem;
    }

    .btn-warning,
    .btn-danger {
      font-size: 0.85rem;
      padding: 0.5rem 0.75rem;
    }

    .action-buttons {
      flex-direction: column;
      gap: 0.5rem;
    }

    .alert-success {
      font-size: 0.9rem;
      margin: 0 1rem 1rem;
    }
    }
  </style>

  <div class="container-schedules">
    <h2>Your Schedules</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('teacher.schedules.create') }}" class="btn btn-primary mb-3">Add New Schedule</a>

    @if($schedules->isEmpty())
    <p class="no-schedules">No schedules yet.</p>
    @else
    <table class="table">
    <thead>
      <tr>
      <th>Day</th>
      <th>Time</th>
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
      <div class="action-buttons">
      <a href="{{ route('teacher.schedules.edit', $schedule) }}" class="btn btn-warning btn-sm">Edit</a>
      <form action="{{ route('teacher.schedules.destroy', $schedule) }}" method="POST"
      style="display:inline-block" onsubmit="return confirm('Are you sure you want to delete this schedule?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
      </div>
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
    @endif
  </div>
@endsection