@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Add Subject</h2>
    <form action="{{ route('admin.subjects.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label>Subject Name</label>
      <input type="text" name="name" class="form-control" required>
      @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
@endsection