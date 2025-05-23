@extends('layouts.home')

@section('title', 'Smart Tutor - Find Teachers')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        /* Hero Section Styles */
        .hero-section {
            min-height: 550px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            padding: 2rem 1rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before,
        .hero-section::after,
        .hero-section .bg-circle-1,
        .hero-section .bg-circle-2,
        .hero-section .bg-circle-3 {
            content: '';
            position: absolute;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, rgba(59, 130, 246, 0) 70%);
            border-radius: 50%;
            filter: blur(60px);
            z-index: 0;
        }

        .hero-section::before {
            width: 350px;
            height: 350px;
            top: -100px;
            left: -100px;
        }

        .hero-section::after {
            width: 400px;
            height: 400px;
            bottom: -150px;
            right: -150px;
        }

        .hero-section .bg-circle-1 {
            width: 300px;
            height: 300px;
            top: 20%;
            left: 10%;
        }

        .hero-section .bg-circle-2 {
            width: 250px;
            height: 250px;
            bottom: 15%;
            right: 15%;
        }

        .hero-section .bg-circle-3 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: 20%;
        }

        .text-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .hero-section h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 4rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2rem;
        }

        .search-container {
            position: relative;
            width: 100%;
            max-width: 75rem;
            display: flex;
            align-items: center;
            background-color: #ffffff;
            border-radius: 3rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            padding: 0.75rem 1.5rem;
            z-index: 1;
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #3b82f6;
            width: 1.75rem;
            height: 1.75rem;
        }

        .search-input-wrapper {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: space-between;
            padding-left: 3rem;
            gap: 1rem;
        }

        .search-select {
            flex: 1;
            border: none;
            outline: none;
            font-size: 1.125rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            text-align: center;
            background-color: #f9fafb;
            color: #111827;
            font-family: 'Poppins', sans-serif;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
        }

        .search-select:disabled {
            background-color: #e5e7eb;
            cursor: not-allowed;
        }

        .hero-section button,
        .hero-section a.reset-button,
        .teacher-card a.profile-button {
            background-color: #3b82f6;
            color: #ffffff;
            padding: 0.75rem 2rem;
            border-radius: 2rem;
            border: none;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .hero-section a.reset-button {
            background-color: #6b7280;
        }

        .hero-section button:hover,
        .hero-section a.reset-button:hover,
        .teacher-card a.profile-button:hover {
            background-color: #2563eb;
        }

        .hero-section a.reset-button:hover {
            background-color: #4b5563;
        }

        .teacher-card a.profile-button {
            margin-top: 1rem;
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
        }

        /* CTA Section Styles */
        .cta-wrapper {
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .cta-container {
            display: flex;
            justify-content: center;
            padding: 3rem 1rem;
            margin: 0 auto;
            max-width: 1200px;
            position: relative;
        }

        .cta-container::before {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0) 70%);
            border-radius: 50%;
            filter: blur(40px);
            top: -90px;
            right: 15%;
            z-index: 0;
        }

        .image-box {
            position: relative;
            width: 100%;
            max-width: 800px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .image-box img {
            width: 100%;
            height: auto;
            display: block;
        }

        .cta-box {
            position: absolute;
            bottom: 30px;
            right: 30px;
            background: rgba(254, 215, 170, 0.9);
            padding: 1.5rem;
            border-radius: 12px;
            max-width: 250px;
            backdrop-filter: blur(4px);
        }

        .cta-text {
            font-size: 1.2rem;
            font-weight: 600;
            color: #7c2d12;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .detail-button {
            display: inline-block;
            background-color: #ea580c;
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .detail-button:hover {
            background-color: #c2410c;
            transform: translateY(-2px);
        }

        /* Testimonial Styles */
        .testimonial-wrapper {
            width: 100%;
            background: #ffffff;
        }

        .testimonial-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
            position: relative;
        }

        .section-title {
            text-align: right;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 3rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .testimonial-quote {
            font-size: 2.8rem;
            font-weight: 600;
            color: #1f2937;
            font-style: italic;
            margin-bottom: 2rem;
            min-height: 180px;
            line-height: 1.3;
            text-align: left;
            padding-right: 2rem;
            transition: opacity 0.5s ease;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .author-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 1.5rem;
            border: 3px solid #3b82f6;
        }

        .author-info {
            text-align: right;
        }

        .author-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1f2937;
        }

        .author-role {
            color: #6b7280;
            font-size: 1rem;
            margin-top: 0.3rem;
        }

        .testimonial-container {
            position: relative;
            height: 350px;
        }

        .testimonial-item {
            position: absolute;
            width: 100%;
            opacity: 0;
            transition: opacity 1s ease;
        }

        .testimonial-item.active {
            opacity: 1;
        }

        /* Teachers Section */
        .teachers-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .teachers-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 2rem;
        }

        .teacher-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .teacher-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
        }

        .teacher-card p {
            color: #6b7280;
            margin: 0.5rem 0;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section button,
            .hero-section a.reset-button,
            .teacher-card a.profile-button {
                margin-top: 1rem;
                margin-left: 0;
                width: 100%;
            }

            .search-icon {
                left: 1rem;
            }

            .hero-section::before,
            .hero-section::after,
            .hero-section .bg-circle-1,
            .hero-section .bg-circle-2,
            .hero-section .bg-circle-3 {
                width: 200px;
                height: 200px;
            }

            .cta-container::before {
                width: 120px;
                height: 120px;
                top: -60px;
                right: 10%;
            }

            .cta-box {
                max-width: 200px;
                padding: 1rem;
                bottom: 15px;
                right: 15px;
            }

            .cta-text {
                font-size: 1rem;
            }

            .testimonial-quote {
                font-size: 2rem;
                min-height: 220px;
                padding-right: 0;
            }

            .section-title h2 {
                font-size: 2.2rem;
            }

            .author-image {
                width: 60px;
                height: 60px;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="bg-circle-1"></div>
        <div class="bg-circle-2"></div>
        <div class="bg-circle-3"></div>
        <div class="text-center">
            <h1>Temukan Guru Ahli IT kalian</h1>
            <form action="{{ route('home') }}" method="GET" class="search-container">
                <span class="search-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </span>
                <div class="search-input-wrapper">
                    <select name="subject_id" id="subject_id" class="search-select">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $request->subject_id == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="province_id" id="province_id" class="search-select">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ $request->province_id == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="regency_id" id="regency_id" class="search-select" disabled>
                        <option value="">Pilih Kota</option>
                    </select>
                    <button type="submit">Cari</button>
                    <a href="/" class="reset-button">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <!-- Teachers Section -->
    <section class="teachers-section">
        <h2>Guru Terbaru</h2>
        @if ($teachers->isEmpty())
            <p>Tidak ada guru ditemukan.</p>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
                @foreach ($teachers as $teacher)
                    <div class="teacher-card">
                        <h3>{{ $teacher->user->name }}</h3>
                        <p>Mata Pelajaran: {{ $teacher->subject->name }}</p>
                        <p>Provinsi: {{ $teacher->province->name }}</p>
                        <p>Kota: {{ $teacher->regency->name }}</p>
                        <a href="{{ route('teachers.show', $teacher->id) }}" class="profile-button">Lihat Profil</a>
                    </div>
                @endforeach
            </div>
            @if (request()->has('subject_id') || request()->has('province_id') || request()->has('regency_id'))
                <div style="margin-top: 2rem;">
                    {{ $teachers->links() }}
                </div>
            @endif
        @endif
    </section>

    <!-- CTA Section -->
    <div class="cta-wrapper">
        <div class="cta-container">
            <div class="image-box">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                    alt="Guru mengajar">
                <div class="cta-box">
                    <div class="cta-text">Kamu juga bisa daftar menjadi guru</div>
                    <a href="/login" class="detail-button">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial Section -->
    <div class="testimonial-wrapper">
        <div class="testimonial-section">
            <div class="section-title">
                <h2>Apa Kata Mereka?</h2>
            </div>
            <div class="testimonial-container">
                @php
                    $testimonials = [
                        [
                            'quote' => 'Guru di sini sangat profesional, metode pengajarannya mudah dipahami dan sangat membantu perkembangan saya!',
                            'name' => 'Dewi Lestari',
                            'role' => 'Pelajar Universitas Indonesia',
                            'image' => 'https://randomuser.me/api/portraits/women/32.jpg',
                        ],
                        [
                            'quote' => 'Dalam 2 bulan saja, saya sudah bisa membuat aplikasi Android pertama saya berkat bimbingan guru di sini.',
                            'name' => 'Budi Setiawan',
                            'role' => 'Pelajar SMK Negeri 2 Jakarta',
                            'image' => 'https://randomuser.me/api/portraits/men/45.jpg',
                        ],
                        [
                            'quote' => 'Saya tidak pernah menyangka belajar pemrograman bisa semenarik ini. Guru-gurunya membuat konsep sulit menjadi mudah!',
                            'name' => 'Anita Rahayu',
                            'role' => 'Mahasiswa ITB',
                            'image' => 'https://randomuser.me/api/portraits/women/68.jpg',
                        ],
                    ];
                @endphp

                @foreach ($testimonials as $index => $testimonial)
                    <div class="testimonial-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="testimonial-quote">
                            "{{ $testimonial['quote'] }}"
                        </div>
                        <div class="testimonial-author">
                            <div class="author-info">
                                <div class="author-name">{{ $testimonial['name'] }}</div>
                                <div class="author-role">{{ $testimonial['role'] }}</div>
                            </div>
                            <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" class="author-image">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cascading dropdowns
            const province = document.getElementById('province_id');
            const regency = document.getElementById('regency_id');

            function fetchOptions(url, target, placeholder = 'Pilih') {
                fetch(url)
                    .then(res => {
                        if (!res.ok) throw new Error('Failed to fetch data');
                        return res.json();
                    })
                    .then(data => {
                        target.innerHTML = `<option value="">-- ${placeholder} --</option>`;
                        data.forEach(item => {
                            target.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                        });
                        target.disabled = false;
                    })
                    .catch(err => {
                        console.error('Error fetching data:', err);
                        target.innerHTML = `<option value="">Error loading ${placeholder}</option>`;
                        target.disabled = true;
                    });
            }

            province.addEventListener('change', () => {
                if (province.value) {
                    fetchOptions(`/api/regencies/${province.value}`, regency, 'Pilih Kota');
                } else {
                    regency.innerHTML = '<option value="">-- Pilih Kota --</option>';
                    regency.disabled = true;
                }
            });

            // Initialize regency dropdown if old input exists
            @if (request()->has('province_id'))
                fetchOptions('/api/regencies/{{ request()->province_id }}', regency, 'Pilih Kota');
                // Set selected regency if exists
                @if (request()->has('regency_id'))
                    setTimeout(() => {
                        regency.value = '{{ request()->regency_id }}';
                    }, 100);
                @endif
            @endif

                // Testimonial carousel logic
                const items = document.querySelectorAll('.testimonial-item');
            let current = 0;

            setInterval(() => {
                items[current].classList.remove('active');
                current = (current + 1) % items.length;
                items[current].classList.add('active');
            }, 5000);
        });
    </script>
@endsection