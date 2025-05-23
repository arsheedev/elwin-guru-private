@extends('layouts.admin')

@section('title', 'Subjects Management')

@section('content')
  <style>
    .container {
    max-width: 1000px;
    margin: 2rem auto;
    font-family: 'Poppins', sans-serif;
    }

    h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1.5rem;
    }

    .card {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    }

    .btn-primary {
    background: #3b82f6;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
    background: #2563eb;
    }

    .btn-warning {
    background: #f59e0b;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: background-color 0.3s ease;
    }

    .btn-warning:hover {
    background: #d97706;
    }

    .btn-danger {
    background: #dc2626;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
    background: #b91c1c;
    }

    .table th,
    .table td {
    vertical-align: middle;
    color: #1f2937;
    }

    .table th {
    background: #f9fafb;
    font-weight: 600;
    }

    .table tbody tr:hover {
    background: #f3f4f6;
    }

    .alert-success {
    background: #10b981;
    color: #ffffff;
    border: none;
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1.5rem;
    animation: fadeOut 5s forwards;
    }

    @keyframes fadeOut {
    0% {
      opacity: 1;
    }

    80% {
      opacity: 1;
    }

    100% {
      opacity: 0;
      display: none;
    }
    }

    @media (max-width: 576px) {
    .container {
      margin: 1rem;
    }

    h2 {
      font-size: 1.5rem;
    }

    .card {
      padding: 0.75rem;
    }

    .table th,
    .table td {
      font-size: 0.9rem;
      padding: 0.5rem;
    }

    .btn-sm {
      padding: 0.3rem 0.6rem;
      font-size: 0.8rem;
    }
    }
  </style>

  <div class="container">
    <h2 class="mb-4">Subjects</h2>
    <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary mb-3">Add Subject</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>#</th>
        <th>Subject Name</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      @forelse($subjects as $subject)
      <tr>
      <td>{{ $subject->id }}</td>
      <td>{{ $subject->name }}</td>
      <td>
      <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-sm btn-warning me-1">Edit</a>
      <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="d-inline"
        onsubmit="return confirm('Are you sure you want to delete this subject?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
      </form>
      </td>
      </tr>
    @empty
      <tr>
      <td colspan="3" class="text-center text-muted">No subjects found.</td>
      </tr>
    @endforelse
      </tbody>
    </table>
    @if($subjects instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-3">
      {{ $subjects->links() }}
    </div>
    @endif
    </div>
  </div>
@endsection