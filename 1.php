<form method="POST" action="{{ route('bookings.store') }}">
  @csrf
  <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
  <div class="form-group">
    <label for="schedule_id">Select Schedule</label>
    <select name="schedule_id" id="schedule_id" class="form-control" required>
      @foreach($teacher->schedules()->where('is_available', true)->get() as $schedule)
      <option value="{{ $schedule->id }}">
        {{ ucfirst($schedule->day) }} | {{ $schedule->clock }}
      </option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary mt-2">Book Now</button>
</form>