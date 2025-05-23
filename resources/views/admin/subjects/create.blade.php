@extends('layouts.admin')

@section('title', 'Add Subject')

@section('content')
  <style>
    .subject-form-container {
    max-width: 600px;
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
    padding: 1.5rem;
    }

    .form-label {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    }

    .form-control {
    border-radius: 0.5rem;
    border: 1px solid #d1d5db;
    padding: 0.75rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
    }

    .text-danger {
    font-size: 0.875rem;
    color: #dc2626;
    margin-top: 0.25rem;
    animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
    }

    .btn-primary {
    background: #3b82f6;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
    background: #2563eb;
    }

    .btn-secondary {
    background: #6b7280;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
    background: #4b5563;
    }

    .button-group {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    }

    @media (max-width: 576px) {
    .subject-form-container {
      margin: 1rem;
    }

    h2 {
      font-size: 1.5rem;
    }

    .card {
      padding: 1rem;
    }

    .form-control {
      padding: 0.5rem;
      font-size: 0.9rem;
    }

    .btn-primary,
    .btn-secondary {
      padding: 0.5rem 1rem;
      font-size: 0.9rem;
    }

    .button-group {
      flex-direction: column;
      gap: 0.5rem;
    }
    }
  </style>

  <div class="subject-form-container">
    <h2>Add Subject</h2>
    <div class="card">
    <form action="{{ route('admin.subjects.store') }}" method="POST">
      @csrf
      <div class="mb-3">
      <label for="name" class="form-label">Subject Name</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class="button-group">
      <button type="submit" class="btn btn-primary">Create</button>
      <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
    </div>
  </div>
@endsection