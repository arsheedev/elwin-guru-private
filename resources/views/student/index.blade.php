@extends('layouts.students')

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
    flex-direction: column;
    align-items: center;
    background-color: #ffffff;
    border-radius: 3rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    padding: 1.5rem;
    z-index: 1;
    }

    .search-row {
    display: flex;
    width: 100%;
    gap: 1rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    }

    .search-select {
    flex: 1;
    min-width: 200px;
    border: none;
    outline: none;
    font-size: 1.125rem;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
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

    .form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
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
    background: #f9fafb;
    border-radius: 16px;
    }

    .teachers-section h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 2.5rem;
    text-align: center;
    font-family: 'Poppins', sans-serif;
    }

    .teachers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 2rem;
    }

    .teacher-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    }

    .teacher-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .teacher-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #60a5fa);
    }

    .teacher-card h3 {
    font-size: 1.6rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    font-family: 'Poppins', sans-serif;
    }

    .teacher-rating {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #f59e0b;
    font-size: 1rem;
    margin-bottom: 0.75rem;
    font-family: 'Poppins', sans-serif;
    }

    .teacher-rating svg {
    width: 18px;
    height: 18px;
    fill: #f59e0b;
    }

    .teacher-card p {
    color: #4b5563;
    margin: 0.5rem 0;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    line-height: 1.5;
    }

    .teacher-price {
    font-size: 1.2rem;
    font-weight: 600;
    color: #15803d;
    background: #dcfce7;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    display: inline-block;
    margin: 0.75rem 0;
    }

    .teacher-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6b7280;
    font-size: 0.95rem;
    }

    .teacher-location svg {
    width: 18px;
    height: 18px;
    fill: #6b7280;
    }

    .teacher-card a.profile-button {
    background: #3b82f6;
    color: #ffffff;
    padding: 0.6rem 1.5rem;
    border-radius: 10px;
    font-size: 0.95rem;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease, transform 0.2s ease;
    margin-top: 1rem;
    }

    .teacher-card a.profile-button:hover {
    background: #2563eb;
    transform: translateY(-2px);
    }

    .no-results {
    font-size: 1.1rem;
    color: #6b7280;
    text-align: center;
    font-family: 'Poppins', sans-serif;
    padding: 2rem;
    }

    @media (max-width: 768px) {
    .hero-section h1 {
      font-size: 2rem;
    }

    .search-row {
      flex-direction: column;
    }

    .search-select {
      min-width: 100%;
    }

    .hero-section button,
    .hero-section a.reset-button,
    .teacher-card a.profile-button {
      margin-top: 1rem;
      width: 100%;
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

    .teachers-section {
      padding: 2rem 1rem;
    }

    .teachers-section h2 {
      font-size: 2rem;
    }

    .teachers-grid {
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    .teacher-card h3 {
      font-size: 1.4rem;
    }

    .teacher-rating {
      font-size: 0.9rem;
    }

    .teacher-rating svg {
      width: 16px;
      height: 16px;
    }

    .teacher-price {
      font-size: 1.1rem;
    }

    .teacher-card a.profile-button {
      width: 100%;
      text-align: center;
    }
    }
  </style>


  <section class="hero-section">
    <div class="bg-circle-1"></div>
    <div class="bg-circle-2"></div>
    <div class="bg-circle-3"></div>
    <div class="text-center">
    <h1>Temukan Guru Ahli IT kalian</h1>
    <form method="GET" action="{{ route('student.teachers.search') }}" class="search-container">
      <div class="search-row">
      <select name="subject_id" id="subject_id" class="search-select">
        <option value="">Semua Mata Pelajaran</option>
        @foreach($subjects as $subject)
      <option value="{{ $subject->id }}" {{ $request->subject_id == $subject->id ? 'selected' : '' }}>
      {{ $subject->name }}
      </option>
      @endforeach
      </select>
      <select id="province_id" name="province_id" class="search-select">
        <option value="">Pilih Provinsi</option>
        @foreach($provinces as $province)
      <option value="{{ $province->id }}" {{ $request->province_id == $province->id ? 'selected' : '' }}>
      {{ $province->name }}
      </option>
      @endforeach
      </select>
      <select id="regency_id" name="regency_id" class="search-select" disabled>
        <option value="">Pilih Kabupaten</option>
      </select>
      </div>
      <div class="search-row">
      <select id="district_id" name="district_id" class="search-select" disabled>
        <option value="">Pilih Kecamatan</option>
      </select>
      <select id="village_id" name="village_id" class="search-select" disabled>
        <option value="">Pilih Desa</option>
      </select>
      <select name="price_range" id="price_range" class="search-select">
        <option value="">Pilih Rentang Harga</option>
        <option value="100000-200000" {{ $request->price_range == '100000-200000' ? 'selected' : '' }}>Rp 100,000 - Rp
        200,000</option>
        <option value="200001-300000" {{ $request->price_range == '200001-300000' ? 'selected' : '' }}>Rp 200,001 - Rp
        300,000</option>
        <option value="300001-400000" {{ $request->price_range == '300001-400000' ? 'selected' : '' }}>Rp 300,001 - Rp
        400,000</option>
        <option value="400001-500000" {{ $request->price_range == '400001-500000' ? 'selected' : '' }}>Rp 400,001 - Rp
        500,000</option>
        <option value="500001-600000" {{ $request->price_range == '500001-600000' ? 'selected' : '' }}>Rp 500,001 - Rp
        600,000</option>
        <option value="600001-700000" {{ $request->price_range == '600001-700000' ? 'selected' : '' }}>Rp 600,001 - Rp
        700,000</option>
        <option value="700001-800000" {{ $request->price_range == '700001-800000' ? 'selected' : '' }}>Rp 700,001 - Rp
        800,000</option>
        <option value="800001-900000" {{ $request->price_range == '800001-900000' ? 'selected' : '' }}>Rp 800,001 - Rp
        900,000</option>
        <option value="900001-1000000" {{ $request->price_range == '900001-1000000' ? 'selected' : '' }}>Rp 900,001 - Rp
        1,000,000</option>
      </select>
      </div>
      <div class="form-actions">
      <button type="submit">Cari</button>
      <a href="{{ route('student.teachers.search') }}" class="reset-button">Reset</a>
      </div>
      <input type="hidden" name="min_price" id="min_price">
      <input type="hidden" name="max_price" id="max_price">
    </form>
    </div>
  </section>

  <!-- Teachers Section -->
  <section class="teachers-section">
    <h2>Guru Terbaru</h2>
    @if($teachers->isEmpty())
    <p class="no-results">Tidak ada guru yang ditemukan.</p>
    @else
    <div class="teachers-grid">
    @foreach($teachers as $teacher)
    <div class="teacher-card">
      <h3>{{ $teacher->user->name }}</h3>
      <div class="teacher-rating">
      @php
      $rating = $teacher->average_ratings ?? 0;
      $fullStars = floor($rating);
      $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
      $emptyStars = 5 - $fullStars - $halfStar;
      @endphp
      @if($rating > 0)
      @for ($i = 0; $i < $fullStars; $i++)
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
      </svg>
      @endfor
      @if ($halfStar)
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2v15.27z" />
      </svg>
      @endif
      @for ($i = 0; $i < $emptyStars; $i++)
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path
      d="M22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.64-7.03L22 9.24zm-10 6.73V6.73L14.81 13l6.92.59-5.46 4.73L18.18 21l-6.18-3.73z" />
      </svg>
      @endfor
      <span>{{ number_format($rating, 1) }}</span>
    @else
      <span class="no-rating">Belum ada rating</span>
    @endif
      </div>
      <p>Mata Pelajaran: {{ $teacher->subject->name ?? '-' }}</p>
      <div class="teacher-price">Rp {{ number_format($teacher->price ?? 100000, 0, ',', '.') }}/jam</div>
      <div class="teacher-location">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path
      d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
      </svg>
      <span>
      {{ $teacher->village->name ?? '-' }},
      {{ $teacher->district->name ?? '-' }},
      {{ $teacher->regency->name ?? '-' }},
      {{ $teacher->province->name ?? '-' }}
      </span>
      </div>
      <p>Telepon: {{ $teacher->no_telepon ?? '-' }}</p>
      <a href="{{ route('student.teachers.show', $teacher->id) }}" class="profile-button">Lihat Profil</a>
    </div>
    @endforeach
    </div>
    <div class="pagination" style="margin-top: 2.5rem; text-align: center;">
    {{ $teachers->withQueryString()->links() }}
    </div>
    @endif
  </section>

  <!-- CTA Section -->
  <div class="cta-wrapper">
    <div class="cta-container">
    <div class="image-box">
      <img
      src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
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

      @foreach($testimonials as $index => $testimonial)
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
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const province = document.getElementById('province_id');
    const regency = document.getElementById('regency_id');
    const district = document.getElementById('district_id');
    const village = document.getElementById('village_id');
    const priceRange = document.getElementById('price_range');
    const minPriceInput = document.getElementById('min_price');
    const maxPriceInput = document.getElementById('max_price');

    function fetchOptions(url, target, placeholder = 'Pilih') {
      target.innerHTML = `<option value="">-- Loading ${placeholder} --</option>`;
      target.disabled = true;

      fetch(url)
      .then(res => {
        if (!res.ok) throw new Error(`Failed to fetch ${placeholder}: ${res.status}`);
        return res.json();
      })
      .then(data => {
        target.innerHTML = `<option value="">${placeholder}</option>`;
        if (data.length === 0) {
        target.innerHTML = `<option value="">Tidak ada ${placeholder.toLowerCase()} tersedia</option>`;
        } else {
        data.forEach(item => {
          target.innerHTML += `<option value="${item.id}">${item.name}</option>`;
        });
        }
        target.disabled = false;
      })
      .catch(err => {
        console.error(`Error fetching ${placeholder}:`, err);
        target.innerHTML = `<option value="">Gagal memuat ${placeholder}</option>`;
        target.disabled = true;
      });
    }

    province.addEventListener('change', () => {
      if (province.value) {
      fetchOptions(`/api/regencies/${province.value}`, regency, 'Pilih Kabupaten');
      district.innerHTML = '<option value="">Pilih Kecamatan</option>';
      district.disabled = true;
      village.innerHTML = '<option value="">Pilih Desa</option>';
      village.disabled = true;
      } else {
      regency.innerHTML = '<option value="">Pilih Kabupaten</option>';
      regency.disabled = true;
      district.innerHTML = '<option value="">Pilih Kecamatan</option>';
      district.disabled = true;
      village.innerHTML = '<option value="">Pilih Desa</option>';
      village.disabled = true;
      }
    });

    regency.addEventListener('change', () => {
      if (regency.value) {
      fetchOptions(`/api/districts/${regency.value}`, district, 'Pilih Kecamatan');
      village.innerHTML = '<option value="">Pilih Desa</option>';
      village.disabled = true;
      } else {
      district.innerHTML = '<option value="">Pilih Kecamatan</option>';
      district.disabled = true;
      village.innerHTML = '<option value="">Pilih Desa</option>';
      village.disabled = true;
      }
    });

    district.addEventListener('change', () => {
      if (district.value) {
      fetchOptions(`/api/villages/${district.value}`, village, 'Pilih Desa');
      } else {
      village.innerHTML = '<option value="">Pilih Desa</option>';
      village.disabled = true;
      }
    });

    priceRange.addEventListener('change', () => {
      const [min, max] = priceRange.value ? priceRange.value.split('-') : ['', ''];
      minPriceInput.value = min;
      maxPriceInput.value = max;
    });

    @if ($request->has('price_range'))
    priceRange.value = '{{ $request->price_range }}';
    const [min, max] = priceRange.value ? priceRange.value.split('-') : ['', ''];
    minPriceInput.value = min;
    maxPriceInput.value = max;
    @endif

    @if (request()->has('province_id'))
    console.log('Initializing regency for province_id: {{ request()->province_id }}');
    fetchOptions('/api/regencies/{{ request()->province_id }}', regency, 'Pilih Kabupaten');
    setTimeout(() => {
      regency.value = '{{ request()->regency_id ?? '' }}';
      @if (request()->has('regency_id'))
      console.log('Initializing district for regency_id: {{ request()->regency_id }}');
      fetchOptions('/api/districts/{{ request()->regency_id }}', district, 'Pilih Kecamatan');
      setTimeout(() => {
      district.value = '{{ request()->district_id ?? '' }}';
      @if (request()->has('district_id'))
      console.log('Initializing village for district_id: {{ request()->district_id }}');
      fetchOptions('/api/villages/{{ request()->district_id }}', village, 'Pilih Desa');
      setTimeout(() => {
      village.value = '{{ request()->village_id ?? '' }}';
      }, 100);
    @endif
      }, 100);
    @endif
      }, 100);
    @endif

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