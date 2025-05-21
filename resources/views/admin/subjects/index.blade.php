@extends('layouts.app')

@section('content')
  <div class="container">
    <h2 class="mb-4">Subjects</h2>
    <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary mb-3">Add Subject</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
    <thead>
      <tr>
      <th>#</th>
      <th>Subject Name</th>
      <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($subjects as $subject)
      <tr>
      <td>{{ $subject->id }}</td>
      <td>{{ $subject->name }}</td>
      <td>
      <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-sm btn-warning">Edit</a>
      <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Delete this subject?')">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-danger">Delete</button>
      </form>
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>
@endsection