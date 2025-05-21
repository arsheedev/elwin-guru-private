@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Edit Subject</h2>
    <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label>Subject Name</label>
      <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>
      @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
@endsection