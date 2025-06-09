@extends('layouts.students')

@section('title', 'Profil Guru - ' . $teacher->user->name)

@section('content')
  <style>
    body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
    }

    .container {
    max-width: 900px;
    margin: 2rem auto;
    padding: 2.5rem;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    position: relative;
    overflow: hidden;
    }

    .container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(to right, #3b82f6, #8b5cf6);
    }

    h2 {
    font-size: 2.25rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 0.75rem;
    position: relative;
    }

    .rating {
    font-size: 1.1rem;
    color: #475569;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    }

    .rating i {
    color: #facc15;
    font-size: 1.2rem;
    }

    .student-count {
    font-size: 1.1rem;
    color: #475569;
    margin-bottom: 1rem;
    line-height: 1.6;
    }

    .student-count strong {
    color: #1e293b;
    font-weight: 600;
    }

    p {
    font-size: 1.1rem;
    color: #475569;
    margin-bottom: 1rem;
    line-height: 1.6;
    }

    p strong {
    color: #1e293b;
    font-weight: 600;
    }

    hr {
    border: 0;
    border-top: 2px solid #e2e8f0;
    margin: 2rem 0;
    }

    h4 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.25rem;
    }

    .list-group-item {
    font-size: 1.05rem;
    color: #475569;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    margin-bottom: 0.75rem;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: transform 0.2s, box-shadow 0.2s;
    }

    .list-group-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    background: #10b981;
    color: #ffffff;
    font-weight: 500;
    }

    .form-group {
    margin-bottom: 1.75rem;
    }

    .form-control {
    font-size: 1rem;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    padding: 0.75rem 1rem;
    width: 100%;
    transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .form-control-select {
    appearance: none;
    background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23475569' viewBox='0 0 16 16'%3E%3Cpath d='M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z'/%3E%3C/svg%3E") no-repeat right 1rem center;
    background-size: 12px;
    padding-right: 2.5rem;
    font-size: 1rem;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    color: #1e293b;
    transition: border-color 0.3s, box-shadow 0.3s, background-color 0.3s;
    cursor: pointer;
    }

    .form-control-select:hover {
    background-color: #f8fafc;
    border-color: #8b5cf6;
    }

    .form-control-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    background-color: #ffffff;
    }

    .form-control-select option {
    color: #1e293b;
    background: #ffffff;
    }

    .btn-primary {
    background: linear-gradient(to right, #3b82f6, #8b5cf6);
    border: none;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.75rem 1.75rem;
    border-radius: 10px;
    color: #ffffff;
    transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
    cursor: pointer;
    }

    .btn-primary:hover {
    background: linear-gradient(to right, #2563eb, #7c3aed);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-back {
    background: #6b7280;
    color: #ffffff;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.75rem 1.75rem;
    border-radius: 10px;
    transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
    text-decoration: none;
    display: inline-block;
    }

    .btn-back:hover {
    background: #4b5563;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .button-group {
    display: flex;
    gap: 1rem;
    align-items: center;
    }

    @media (max-width: 768px) {
    .container {
      margin: 1rem;
      padding: 1.5rem;
    }

    h2 {
      font-size: 1.75rem;
    }

    h4 {
      font-size: 1.5rem;
    }

    .rating,
    .student-count {
      font-size: 1rem;
    }

    .form-control,
    .form-control-select,
    .btn-primary,
    .btn-back {
      font-size: 0.95rem;
      padding: 0.65rem 1rem;
    }

    .form-control-select {
      padding-right: 2rem;
      background-size: 10px;
    }

    .button-group {
      flex-direction: column;
      gap: 0.75rem;
    }

    .btn-back,
    .btn-primary {
      width: 100%;
    }

    .list-group-item {
      font-size: 0.95rem;
      padding: 0.75rem 1rem;
    }
    }
  </style>

  <div class="container">
    <h2>{{ $teacher->user->name }}</h2>
    <div class="rating">
    <i class="fas fa-star"></i>
    <span>Penilaian:
      {{ $teacher->average_ratings ? number_format($teacher->average_ratings, 1) . '/5' : 'Belum ada penilaian' }}</span>
    </div>
    <p class="student-count"><strong>Jumlah Siswa:</strong> {{ $studentCount }} orang</p>

    <p><strong>Mata Pelajaran:</strong> {{ $teacher->subject->name ?? '-' }}</p>
    <p><strong>Telepon:</strong> {{ $teacher->no_telepon ?? '-' }}</p>

    <p>
    <strong>Lokasi:</strong>
    {{ $teacher->village->name ?? '-' }},
    {{ $teacher->district->name ?? '-' }},
    {{ $teacher->regency->name ?? '-' }},
    {{ $teacher->province->name ?? '-' }}
    </p>

    <hr>

    <h4>Jadwal Tersedia</h4>
    @if($teacher->schedules->isEmpty())
    <p>Tidak ada jadwal tersedia.</p>
    @else
    <ul class="list-group mb-3">
    @foreach($teacher->schedules as $schedule)
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <span>
      @php
      $daysInIndonesian = [
      'monday' => 'Senin',
      'tuesday' => 'Selasa',
      'wednesday' => 'Rabu',
      'thursday' => 'Kamis',
      'friday' => 'Jumat',
      'saturday' => 'Sabtu',
      'sunday' => 'Minggu'
      ];
      @endphp
      {{ $daysInIndonesian[strtolower($schedule->day)] }} pada {{ $schedule->clock }}
      </span>
      <span class="badge">Tersedia</span>
    </li>
    @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('student.bookings.store') }}" id="booking-form">
    @csrf
    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
    <div class="form-group">
      <label for="schedule_id">Pilih Jadwal</label>
      <select name="schedule_id" id="schedule_id" class="form-control form-control-select" required>
      <option value="">Pilih jadwal</option>
      @foreach($teacher->schedules as $schedule)
      <option value="{{ $schedule->id }}">
      {{ $daysInIndonesian[strtolower($schedule->day)] }} | {{ $schedule->clock }}
      </option>
    @endforeach
      </select>
    </div>
    <div class="button-group">
      <a href="/student" class="btn-back">Kembali</a>
      <button type="submit" class="btn btn-primary" id="book-now">Pesan Sekarang</button>
    </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const bookNowButton = document.getElementById('book-now');
    const bookingForm = document.getElementById('booking-form');

    // Check if user is authenticated
    const isAuthenticated = @json(auth()->check());

    bookNowButton.addEventListener('click', function (event) {
      if (!isAuthenticated) {
      event.preventDefault(); // Prevent form submission
      window.location.href = '/login'; // Redirect to login
      }
      // If authenticated, form will submit normally
    });
    });
  </script>
@endsection