@extends('layouts.home')

@section('title', 'Your Bookings')

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

        .alert-danger {
            max-width: 600px;
            margin: 0 auto 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
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
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #2563eb, #1e3a8a);
            transform: translateY(-1px);
        }

        .btn-success {
            background: #22c55e;
            border: none;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: #ffffff;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-success:hover {
            background: #16a34a;
            transform: translateY(-1px);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
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

            .btn-primary,
            .btn-success {
                font-size: 0.85rem;
                padding: 0.5rem 0.75rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }

            .alert-success,
            .alert-danger {
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
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($bookings->isEmpty())
            <p class="no-bookings">Belum ada pemesanan.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->student->user->name }}</td>
                            <td>
                                @php
                                    $dayMap = [
                                        'sunday' => 'Minggu',
                                        'monday' => 'Senin',
                                        'tuesday' => 'Selasa',
                                        'wednesday' => 'Rabu',
                                        'thursday' => 'Kamis',
                                        'friday' => 'Jumat',
                                        'saturday' => 'Sabtu'
                                    ];
                                    $day = strtolower($booking->schedule->day);
                                    $indonesianDay = $dayMap[$day] ?? ucfirst($day);
                                @endphp
                                {{ $indonesianDay }} pukul {{ $booking->schedule->clock }}
                            </td>
                            <td>
                                <span class="badge badge-{{ $booking->status }}">
                                    @php
                                        $statusMap = [
                                            'pending' => 'Menunggu',
                                            'accepted' => 'Diterima',
                                            'completed' => 'Selesai'
                                        ];
                                        echo $statusMap[$booking->status] ?? ucfirst($booking->status);
                                    @endphp
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('bookings.accept', $booking) }}" method="POST"
                                            style="display:inline-block" onsubmit="return confirm('Terima pemesanan ini?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary btn-sm">Terima</button>
                                        </form>
                                    @endif
                                    @if($booking->status === 'accepted')
                                        <form action="{{ route('bookings.complete', $booking) }}" method="POST"
                                            style="display:inline-block"
                                            onsubmit="return confirm('Tandai pemesanan ini sebagai selesai?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection