@extends('layouts.students')

@section('title', 'Pemesanan Anda')

@section('content')
  <style>
    body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 2rem;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1.5rem;
    }

    .alert-success {
    max-width: 600px;
    margin: 0 auto 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    color: #065f46;
    background-color: #d1fae5;
    border-color: #6ee7b7;
    }

    .table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .table th,
    .table td {
    padding: 1rem;
    font-size: 1rem;
    color: #4b5563;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    }

    .table th {
    font-weight: 600;
    color: #1f2937;
    background: #f9fafb;
    }

    .table tr:last-child td {
    border-bottom: none;
    }

    .table tr:hover {
    background: #f1f5f9;
    }

    .btn-primary {
    background: linear-gradient(to right, #3b82f6, #1e40af);
    border: none;
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    color: #ffffff;
    transition: background 0.2s, transform 0.1s;
    text-decoration: none;
    }

    .btn-primary:hover {
    background: linear-gradient(to right, #2563eb, #1e3a8a);
    transform: translateY(-1px);
    }

    .btn-danger {
    background: linear-gradient(to right, #ef4444, #b91c1c);
    border: none;
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    color: #ffffff;
    transition: background 0.2s, transform 0.1s;
    text-decoration: none;
    cursor: pointer;
    }

    .btn-danger:hover {
    background: linear-gradient(to right, #dc2626, #991b1b);
    transform: translateY(-1px);
    }

    .btn-danger:active {
    transform: translateY(0);
    }

    .no-bookings {
    font-size: 1rem;
    color: #6b7280;
    text-align: center;
    margin: 2rem 0;
    }

    .badge {
    font-size: 0.85rem;
    padding: 0.5em 0.75em;
    border-radius: 12px;
    }

    .badge-pending {
    background-color: #fef3c7;
    color: #d97706;
    }

    .badge-accepted {
    background-color: #d1fae5;
    color: #065f46;
    }

    .badge-completed {
    background-color: #e5e7eb;
    color: #4b5563;
    }

    .text-success {
    color: #22c55e;
    font-weight: 600;
    }

    .text-muted {
    color: #6b7280;
    font-weight: 600;
    }

    @media (max-width: 768px) {
    .container {
      margin: 1rem;
      padding: 1.5rem;
    }

    h2 {
      font-size: 1.75rem;
    }

    .table th,
    .table td {
      font-size: 0.9rem;
      padding: 0.75rem;
    }

    .btn-primary {
      font-size: 0.85rem;
      padding: 0.5rem 0.75rem;
    }

    .btn-danger {
      font-size: 0.85rem;
      padding: 0.5rem 0.75rem;
    }

    .alert-success {
      font-size: 0.9rem;
      margin: 0 1rem 1rem;
    }

    .badge {
      font-size: 0.8rem;
    }
    }
  </style>

  <div class="container">
    <h2>Pemesanan Anda</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if($bookings->isEmpty())
    <p class="no-bookings">Tidak ada pemesanan ditemukan.</p>
    @else
    <table class="table">
    <thead>
      <tr>
      <th>Guru</th>
      <th>Jadwal</th>
      <th>Status</th>
      <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
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
      @foreach($bookings as $booking)
      <tr>
      <td>{{ $booking->teacher->user->name }}</td>
      <td>{{ $daysInIndonesian[strtolower($booking->schedule->day)] }} pada {{ $booking->schedule->clock }}</td>
      <td>
      <span class="badge badge-{{ $booking->status }}">
      {{ ucfirst($booking->status == 'pending' ? 'menunggu' : ($booking->status == 'accepted' ? 'diterima' : ($booking->status == 'canceled' ? 'dibatalkan' : 'selesai'))) }}
      </span>
      </td>
      <td>
      @if($booking->status === 'completed' && !$booking->rating)
      <a href="{{ route('student.ratings.create', $booking->id) }}" class="btn btn-primary btn-sm">Beri
      Penilaian</a>
      @elseif($booking->status === 'pending' && !$booking->rating)
      @if ($booking->status === 'pending')
      <form
      action="{{ auth()->user()->role === 'student' ? route('student.bookings.cancel', $booking) : route('teacher.bookings.cancel', $booking) }}"
      method="POST">
      @csrf
      @method('POST')
      <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
      </form>
      @endif
      @elseif($booking->rating)
      <span class="text-success">Sudah Dinilai</span>
      @else
      <span class="text-muted">T/A</span>
      @endif
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
    @endif
  </div>
@endsection