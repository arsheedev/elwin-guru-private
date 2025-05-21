@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Edit Schedule</h2>

    @if($errors->any())
    <div class="alert alert-danger">
    <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('teacher.schedules.update', $schedule) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>Day</label>
      <select name="day" class="form-control" required>
      @foreach(['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'] as $day)
      <option value="{{ $day }}" {{ $schedule->day === $day ? 'selected' : '' }}>
      {{ ucfirst($day) }}
      </option>
    @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Clock</label>
      <input type="text" name="clock" class="form-control" value="{{ $schedule->clock }}" required>
    </div>

    <div class="mb-3">
      <label>Available</label>
      <select name="is_available" class="form-control" required>
      <option value="1" {{ $schedule->is_available ? 'selected' : '' }}>Yes</option>
      <option value="0" {{ !$schedule->is_available ? 'selected' : '' }}>No</option>
      </select>
    </div>

    <button class="btn btn-primary">Update</button>
    </form>
  </div>
@endsection