@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
  <style>
    .users-container {
    max-width: 1000px;
    margin: 2rem auto;
    font-family: 'Poppins', sans-serif;
    }

    .users-container h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1.5rem;
    }

    .card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    }

    .table {
    margin-bottom: 0;
    }

    .table th,
    .table td {
    vertical-align: middle;
    padding: 1rem;
    color: #1f2937;
    }

    .table th {
    background: #f9fafb;
    font-weight: 600;
    }

    .table tbody tr:hover {
    background: #f3f4f6;
    }

    .btn-danger {
    background: #dc2626;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    padding: 0.5rem 1rem;
    transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
    background: #b91c1c;
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
    .users-container {
      margin: 1rem;
    }

    .users-container h1 {
      font-size: 1.5rem;
    }

    .card {
      padding: 1rem;
    }

    .table th,
    .table td {
      padding: 0.75rem;
      font-size: 0.9rem;
    }

    .btn-danger {
      padding: 0.4rem 0.8rem;
      font-size: 0.8rem;
    }
    }
  </style>

  <div class="users-container">
    <h1>User Management</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      @forelse($users as $user)
      <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->role ?? 'N/A' }}</td>
      <td>
      <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this user?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
      </td>
      </tr>
    @empty
      <tr>
      <td colspan="4" class="text-center text-muted">No users found.</td>
      </tr>
    @endforelse
      </tbody>
    </table>
    </div>
  </div>
@endsection