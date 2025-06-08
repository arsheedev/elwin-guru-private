@extends('layouts.app')

@section('content')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <div class="page-container">
    <div class="glow-effect"></div>
    <div class="card">
    <div class="card-header">
      <h1 class="card-title animate-gradient">Daftar</h1>
      <p class="card-subtitle">Buat akun Anda untuk memulai</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="form" enctype="multipart/form-data">
      @csrf

      <!-- Nama -->
      <div class="form-group">
      <label for="name" class="form-label">Nama</label>
      <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required
        placeholder="Masukkan nama Anda">
      @error('name')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Email -->
      <div class="form-group">
      <label for="email" class="form-label">Alamat Email</label>
      <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required
        placeholder="Masukkan email Anda">
      @error('email')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Kata Sandi -->
      <div class="form-group">
      <label for="password" class="form-label">Kata Sandi</label>
      <input type="password" name="password" id="password" class="form-input" required
        placeholder="Masukkan kata sandi Anda">
      @error('password')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Konfirmasi Kata Sandi -->
      <div class="form-group">
      <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" required
        placeholder="Konfirmasi kata sandi Anda">
      </div>

      <!-- Peran -->
      <div class="form-group">
      <label for="role" class="form-label">Daftar sebagai</label>
      <select name="role" id="role" class="form-select" required>
        <option value="">-- Pilih Peran --</option>
        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Siswa</option>
        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Guru</option>
      </select>
      @error('role')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Nomor Telepon -->
      <div class="form-group">
      <label for="no_telepon" class="form-label">Nomor Telepon</label>
      <input type="text" name="no_telepon" id="no_telepon" class="form-input" value="{{ old('no_telepon') }}" required
        placeholder="Masukkan nomor telepon Anda">
      @error('no_telepon')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Gambar Profil (untuk guru) -->
      <div class="form-group" id="profile-image-field" style="display: none;">
      <label for="profile_image" class="form-label">Gambar Profil</label>
      <div class="profile-image-wrapper">
        <img src="{{ asset('images/default-profile.png') }}" alt="Pratinjau Profil" class="profile-image-preview"
        id="profile-image-preview">
      </div>
      <label for="profile_image" class="profile-image-label">Pilih Gambar Profil</label>
      <input type="file" name="profile_image" id="profile_image" class="profile-image-input" accept="image/*">
      @error('profile_image')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Mata Pelajaran (untuk guru) -->
      <div class="form-group" id="subject-field" style="display: none;">
      <label for="subject_id" class="form-label">Mata Pelajaran</label>
      <select name="subject_id" id="subject_id" class="form-select">
        <option value="">-- Pilih Mata Pelajaran --</option>
        @foreach ($subjects as $subject)
      <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
      {{ $subject->name }}
      </option>
      @endforeach
      </select>
      @error('subject_id')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Harga (untuk guru) -->
      <div class="form-group" id="price-field" style="display: none;">
      <label for="price" class="form-label">Harga (per sesi)</label>
      <input type="number" name="price" id="price" class="form-input" value="{{ old('price') }}"
        placeholder="Masukkan harga per sesi (Rp)" min="0" step="1000">
      @error('price')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Provinsi -->
      <div class="form-group">
      <label for="province_id" class="form-label">Provinsi</label>
      <select name="province_id" id="province_id" class="form-select" required>
        <option value="">-- Pilih Provinsi --</option>
        @foreach ($provinces as $province)
      <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
      {{ $province->name }}
      </option>
      @endforeach
      </select>
      @error('province_id')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Kabupaten/Kota -->
      <div class="form-group">
      <label for="regency_id" class="form-label">Kabupaten/Kota</label>
      <select name="regency_id" id="regency_id" class="form-select" required>
        <option value="">-- Pilih Kabupaten/Kota --</option>
      </select>
      @error('regency_id')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Kecamatan -->
      <div class="form-group">
      <label for="district_id" class="form-label">Kecamatan</label>
      <select name="district_id" id="district_id" class="form-select" required>
        <option value="">-- Pilih Kecamatan --</option>
      </select>
      @error('district_id')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Desa/Kelurahan -->
      <div class="form-group">
      <label for="village_id" class="form-label">Desa/Kelurahan</label>
      <select name="village_id" id="village_id" class="form-select" required>
        <option value="">-- Pilih Desa/Kelurahan --</option>
      </select>
      @error('village_id')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <div>
      <button type="submit" class="form-button animate-gradient">
        Daftar
      </button>
      </div>
    </form>

    <p class="card-footer">
      Sudah punya akun?
      <a href="{{ route('login') }}" class="link">Masuk</a>
    </p>
    </div>
  </div>

  <style>
    body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
    }

    .page-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    position: relative;
    overflow: hidden;
    }

    .glow-effect {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
      radial-gradient(circle 150px at 10% 10%, rgba(59, 130, 246, 0.3) 0%, transparent 100%),
      radial-gradient(circle 150px at 90% 20%, rgba(59, 130, 246, 0.25) 0%, transparent 100%),
      radial-gradient(circle 150px at 30% 80%, rgba(59, 130, 246, 0.2) 0%, transparent 100%),
      radial-gradient(circle 150px at 70% 60%, rgba(59, 130, 246, 0.15) 0%, transparent 100%);
    animation: slow-glow 20s ease-in-out infinite;
    pointer-events: none;
    }

    .card {
    max-width: 640px;
    width: 100%;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 16px;
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    padding: 32px;
    transform: translateY(20px);
    opacity: 0;
    animation: fadeInUp 0.6s ease-out forwards;
    backdrop-filter: blur(10px);
    }

    .card-header {
    margin-bottom: 32px;
    text-align: center;
    }

    .card-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: #2563eb;
    background: linear-gradient(to right, #2563eb, #1e40af);
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    }

    .card-subtitle {
    font-size: 0.875rem;
    color: #4b5563;
    margin-top: 8px;
    }

    /* Form styling */
    .form {
    display: flex;
    flex-direction: column;
    gap: 24px;
    }

    .form-group {
    display: flex;
    flex-direction: column;
    }

    .form-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 8px;
    }

    .form-input,
    .form-select {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.5);
    color: #111827;
    font-size: 1rem;
    transition: all 0.3s ease-in-out;
    outline: none;
    }

    .form-input::placeholder,
    .form-select:invalid {
    color: #9ca3af;
    }

    .form-input:focus,
    .form-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    transform: scale(1.01);
    }

    .form-input:hover,
    .form-select:hover {
    transform: scale(1.01);
    }

    .form-error {
    color: #ef4444;
    font-size: 0.75rem;
    margin-top: 4px;
    }

    /* Profile Image */
    .profile-image-wrapper {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #e5e7eb;
    background-color: #f9fafb;
    margin-bottom: 12px;
    transition: border-color 0.2s;
    }

    .profile-image-wrapper:hover {
    border-color: #3b82f6;
    }

    .profile-image-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }

    .profile-image-label {
    display: inline-block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #3b82f6;
    cursor: pointer;
    transition: color 0.2s;
    }

    .profile-image-label:hover {
    color: #1e40af;
    }

    .profile-image-input {
    display: none;
    }

    .form-button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(to right, #3b82f6, #1d4ed8);
    background-size: 200% 200%;
    color: #ffffff;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    animation: gradient 4s ease infinite;
    }

    .form-button:hover {
    background: linear-gradient(to right, #2563eb, #1e40af);
    transform: scale(1.02);
    }

    .form-button:focus {
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.3);
    }

    .card-footer {
    margin-top: 24px;
    text-align: center;
    font-size: 0.875rem;
    color: #6b7280;
    }

    .link {
    color: #2563eb;
    text-decoration: none;
    transition: all 0.2s ease;
    }

    .link:hover {
    text-decoration: underline;
    }

    @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
    }

    @keyframes gradient {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
    }

    @keyframes slow-glow {
    0% {
      transform: translate(0%, 0%) scale(1);
      opacity: 0.8;
    }

    25% {
      transform: translate(10%, 5%) scale(1.1);
      opacity: 0.85;
    }

    50% {
      transform: translate(5%, 10%) scale(1);
      opacity: 0.8;
    }

    75% {
      transform: translate(-5%, -5%) scale(1.05);
      opacity: 0.85;
    }

    100% {
      transform: translate(0%, 0%) scale(1);
      opacity: 0.8;
    }
    }
  </style>
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
    const roleSelect = document.getElementById('role');
    const subjectField = document.getElementById('subject-field');
    const profileImageField = document.getElementById('profile-image-field');
    const priceField = document.getElementById('price-field');
    const profileImageInput = document.getElementById('profile_image');
    const profileImagePreview = document.getElementById('profile-image-preview');

    // Show/hide teacher-specific fields
    function toggleTeacherFields() {
      const isTeacher = roleSelect.value === 'teacher';
      subjectField.style.display = isTeacher ? 'block' : 'none';
      profileImageField.style.display = isTeacher ? 'block' : 'none';
      priceField.style.display = isTeacher ? 'block' : 'none';
    }

    roleSelect.addEventListener('change', toggleTeacherFields);
    toggleTeacherFields(); // Run on page load

    // Profile image preview
    profileImageInput.addEventListener('change', () => {
      const file = profileImageInput.files[0];
      if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        profileImagePreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
      }
    });

    // Cascading dropdowns
    const province = document.getElementById('province_id');
    const regency = document.getElementById('regency_id');
    const district = document.getElementById('district_id');
    const village = document.getElementById('village_id');

    function fetchOptions(url, target, placeholder = 'Pilih') {
      fetch(url)
      .then(res => {
        if (!res.ok) throw new Error('Gagal mengambil data');
        return res.json();
      })
      .then(data => {
        target.innerHTML = `<option value="">-- ${placeholder} --</option>`;
        data.forEach(item => {
        target.innerHTML += `<option value="${item.id}">${item.name}</option>`;
        });
      })
      .catch(err => {
        console.error('Kesalahan saat mengambil data:', err);
        target.innerHTML = `<option value="">Kesalahan saat memuat ${placeholder}</option>`;
      });
    }

    province.addEventListener('change', () => {
      if (province.value) {
      fetchOptions(`/api/regencies/${province.value}`, regency, 'Pilih Kabupaten/Kota');
      district.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
      village.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
      } else {
      regency.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
      district.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
      village.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
      }
    });

    regency.addEventListener('change', () => {
      if (regency.value) {
      fetchOptions(`/api/districts/${regency.value}`, district, 'Pilih Kecamatan');
      village.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
      } else {
      district.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
      village.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
      }
    });

    district.addEventListener('change', () => {
      if (district.value) {
      fetchOptions(`/api/villages/${district.value}`, village, 'Pilih Desa/Kelurahan');
      } else {
      village.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
      }
    });

    // Initialize dropdowns if old input exists
    @if(old('province_id'))
    fetchOptions('/api/regencies/{{ old('province_id') }}', regency, 'Pilih Kabupaten/Kota');
    @endif
    @if(old('regency_id'))
    fetchOptions('/api/districts/{{ old('regency_id') }}', district, 'Pilih Kecamatan');
    @endif
    @if(old('district_id'))
    fetchOptions('/api/villages/{{ old('district_id') }}', village, 'Pilih Desa/Kelurahan');
    @endif
    });
  </script>
@endsection