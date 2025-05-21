@extends('layouts.app')

@section('content')
  <div class="container">
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

    <div class="mb-3">
      <label>Day</label>
      <select name="day" class="form-control" required>
      @foreach(['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'] as $day)
      <option value="{{ $day }}" {{ old('day') === $day ? 'selected' : '' }}>
      {{ ucfirst($day) }}
      </option>
    @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Clock</label>
      <input type="text" name="clock" class="form-control" value="{{ old('clock') }}" required>
    </div>

    <button class="btn btn-primary">Create</button>
    </form>
  </div>
@endsection