@extends('layouts.teacher')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil Guru</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            body {
                background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
                min-height: 100vh;
                font-family: 'Inter', sans-serif;
            }

            .profile-container {
                max-width: 1000px;
                margin: 2rem auto;
                padding: 0 1rem;
                display: flex;
                gap: 2rem;
            }

            .profile-image-container {
                flex: 0 0 300px;
            }

            .profile-image {
                width: 300px;
                height: 300px;
                object-fit: cover;
                border-radius: 50%;
                border: 4px solid white;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            }

            .profile-details {
                flex: 1;
                padding: 1rem;
            }

            .name-rating {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 0.5rem;
            }

            .star-rating {
                display: flex;
                gap: 0.25rem;
            }

            .star {
                color: #f59e0b;
                font-size: 1.25rem;
            }

            .star-empty {
                color: #d1d5db;
                font-size: 1.25rem;
            }

            .role-container {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 1.5rem;
            }

            .role {
                background-color: #10b981;
                color: white;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.875rem;
            }

            .info-grid {
                display: grid;
                grid-template-columns: 1fr 2fr;
                gap: 1rem;
                align-items: center;
                margin-bottom: 1.5rem;
            }

            .info-label {
                font-weight: 600;
                color: #4b5563;
            }

            .info-value {
                color: #1f2937;
            }

            .edit-button,
            .logout-button {
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                text-decoration: none;
                transition: background-color 0.2s;
                font-size: 0.875rem;
            }

            .edit-button {
                background-color: #2563eb;
                color: white;
            }

            .edit-button:hover {
                background-color: #1d4ed8;
            }

            .logout-button {
                background-color: #dc2626;
                color: white;
                border: none;
                cursor: pointer;
            }

            .logout-button:hover {
                background-color: #b91c1c;
            }
        </style>
    </head>

    <body>
        <div class="profile-container">
            <div class="profile-image-container">
                <img src="{{ $teacher->profile_image ? asset('storage/' . $teacher->profile_image) : 'https://via.placeholder.com/300' }}"
                    alt="Gambar Profil" class="profile-image">
            </div>
            <div class="profile-details">
                <div class="name-rating">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                    <div class="star-rating">
                        @php
                            $rating = $teacher->average_ratings ?? 0;
                            $fullStars = floor($rating);
                            $halfStar = ($rating - $fullStars) >= 0.5;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        @endphp
                        @for ($i = 0; $i < $fullStars; $i++)
                            <span class="star">★</span>
                        @endfor
                        @if ($halfStar)
                            <span class="star">★</span>
                        @endif
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <span class="star-empty">★</span>
                        @endfor
                    </div>
                </div>
                <div class="role-container">
                    <span class="role">{{ $user->role === 'teacher' ? 'Guru' : $user->role }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Keluar</button>
                    </form>
                </div>
                <div class="info-grid">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $user->email }}</span>

                    <span class="info-label">Nomor Telepon:</span>
                    <span class="info-value">{{ $teacher->no_telepon }}</span>

                    <span class="info-label">Mata Pelajaran:</span>
                    <span class="info-value">{{ $teacher->subject ? $teacher->subject->name : 'Tidak ditentukan' }}</span>

                    <span class="info-label">Harga per Sesi:</span>
                    <span
                        class="info-value">{{ $teacher->price ? 'Rp ' . number_format($teacher->price, 0, ',', '.') : 'Tidak ditentukan' }}</span>

                    <span class="info-label">Provinsi:</span>
                    <span class="info-value">{{ $teacher->province ? $teacher->province->name : 'Tidak ditentukan' }}</span>

                    <span class="info-label">Kabupaten/Kota:</span>
                    <span class="info-value">{{ $teacher->regency ? $teacher->regency->name : 'Tidak ditentukan' }}</span>

                    <span class="info-label">Kecamatan:</span>
                    <span class="info-value">{{ $teacher->district ? $teacher->district->name : 'Tidak ditentukan' }}</span>

                    <span class="info-label">Desa/Kelurahan:</span>
                    <span class="info-value">{{ $teacher->village ? $teacher->village->name : 'Tidak ditentukan' }}</span>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('teacher.profile.edit') }}" class="edit-button">Edit Profil</a>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection