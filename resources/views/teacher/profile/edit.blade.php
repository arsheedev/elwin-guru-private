@extends('layouts.teacher')

@section('content')
  <div class="profile-container">
    <div class="container">
    <div class="profile-header">
      <h2 class="profile-title">Edit Profil</h2>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-custom">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('teacher.profile.update') }}" enctype="multipart/form-data"
      class="profile-form" id="profile-form">
      @csrf
      @method('PUT')

      <!-- Foto Profil -->
      <div class="profile-picture-section">
      <div class="profile-picture-wrapper">
        <img
        src="{{ $teacher->profile_picture ? asset('storage/' . $teacher->profile_picture) : asset('images/default-profile.png') }}"
        alt="Foto Profil" class="profile-picture-img" id="profile-picture-preview">
      </div>
      <label for="profile_picture" class="profile-picture-label">Pilih Foto Profil</label>
      <input type="file" name="profile_picture" id="profile_picture" class="profile-picture-input" accept="image/*">
      @error('profile_picture')
      <span class="error-message">{{ $message }}</span>
    @enderror
      </div>

      <!-- Form Fields -->
      <div class="form-grid">
      <!-- Nama -->
      <div class="form-group">
        <label for="name" class="form-label">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        @error('name')
      <span class="error-message">{{ $message }}</span>
      @enderror
      </div>

      <!-- No Telepon -->
      <div class="form-group">
        <label for="no_telepon" class="form-label">No Telepon</label>
        <input type="text" name="no_telepon" id="no_telepon" class="form-control"
        value="{{ old('no_telepon', $teacher->no_telepon) }}">
        @error('no_telepon')
      <span class="error-message">{{ $message }}</span>
      @enderror
      </div>

      <div class="form-group">
        <label for="province_id" class="form-label">Provinsi (Opsional)</label>
        <select id="province_id" name="province_id" class="form-control">
        <option value="">-- Pilih --</option>
        @foreach($provinces as $province)
      <option value="{{ $province->id }}" {{ old('province_id', $teacher->province_id) == $province->id ? 'selected' : '' }}>
        {{ $province->name }}
      </option>
      @endforeach
        </select>
        @error('province_id')
      <span class="error-message">{{ $message }}</span>
      @enderror
      </div>

      <!-- Kabupaten -->
      <div class="form-group">
        <label for="regency_id" class="form-label">Kabupaten (Opsional)</label>
        <select id="regency_id" name="regency_id" class="form-control">
        <option value="">-- Pilih --</option>
        @foreach($regencies as $regency)
      <option value="{{ $regency->id }}" {{ old('regency_id', $teacher->regency_id) == $regency->id ? 'selected' : '' }}>
        {{ $regency->name }}
      </option>
      @endforeach
        </select>
        @error('regency_id')
      <span class="error-message">{{ $message }}</span>
      @enderror
      </div>

      <!-- Kecamatan -->
      <div class="form-group">
        <label for="district_id" class="form-label">Kecamatan (Opsional)</label>
        <select id="district_id" name="district_id" class="form-control">
        <option value="">-- Pilih --</option>
        @foreach($districts as $district)
      <option value="{{ $district->id }}" {{ old('district_id', $teacher->district_id) == $district->id ? 'selected' : '' }}>
        {{ $district->name }}
      </option>
      @endforeach
        </select>
        @error('district_id')
      <span class="error-message">{{ $message }}</span>
      @enderror
      </div>

      <!-- Desa -->
      <div class="form-group">
        <label for="village_id" class="form-label">Desa (Opsional)</label>
        <select id="village_id" name="village_id" class="form-control">
        <option value="">-- Pilih --</option>
        @foreach($villages as $village)
      <option value="{{ $village->id }}" {{ old('village_id', $teacher->village_id) == $village->id ? 'selected' : '' }}>
        {{ $village->name }}
      </option>
      @endforeach
        </select>
        @error('village_id')
      <span class="error-message">{{ $message }}</span>
      @enderror
      </div>

      <!-- Mata Pelajaran -->
      <div class="form-group">
        <label for="subject_id" class="form-label">Mata Pelajaran (Opsional)</label>
        <select name="subject_id" id="subject_id" class="form-control">
        <option value="">-- Pilih --</option>
        @foreach($subjects as $subject)
      <option value="{{ $subject->id }}" {{ old('subject_id', $teacher->subject_id) == $subject->id ? 'selected' : '' }}>
        {{ $subject->name }}
      </option>
      @endforeach
        </select>
        @error('subject_id')
      <span class="error-message">{{ $message }}</span>
      @enderror
      </div>
      </div>

      <div class="form-actions">
      <button type="submit" class="btn btn-primary btn-custom">Update</button>
      <a href="/teacher" class="btn btn-secondary btn-custom">Batal</a>
      </div>
    </form>
    </div>
  </div>

  <style>
    /* Reset dan Base Styles */
    html,
    body {
    margin: 0;
    padding: 0;
    width: 100%;
    overflow-x: hidden;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: #f1f5f9;
    }

    .profile-container {
    min-height: calc(100vh - 64px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    }

    .container {
    max-width: 800px;
    width: 100%;
    box-sizing: border-box;
    }

    /* Header */
    .profile-header {
    text-align: center;
    margin-bottom: 32px;
    }

    .profile-title {
    font-size: 1.875rem;
    font-weight: 600;
    color: #1e40af;
    }

    /* Alert */
    .alert-custom {
    background-color: #d1fae5;
    color: #065f46;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 24px;
    text-align: center;
    font-size: 0.875rem;
    }

    /* Form */
    .profile-form {
    background: #ffffff;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 24px;
    }

    .form-group {
    display: flex;
    flex-direction: column;
    }

    .form-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #1e293b;
    margin-bottom: 8px;
    }

    .form-control {
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.875rem;
    color: #1e293b;
    background-color: #f9fafb;
    transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Profile Picture */
    .profile-picture-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 32px;
    }

    .profile-picture-wrapper {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #d1d5db;
    background-color: #f9fafb;
    transition: border-color 0.2s;
    }

    .profile-picture-wrapper:hover {
    border-color: #3b82f6;
    }

    .profile-picture-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }

    .profile-picture-label {
    display: inline-block;
    margin: 12px 0;
    font-size: 0.875rem;
    font-weight: 500;
    color: #3b82f6;
    cursor: pointer;
    transition: color 0.2s;
    }

    .profile-picture-label:hover {
    color: #1e40af;
    }

    .profile-picture-input {
    display: none;
    }

    .error-message {
    color: #dc2626;
    font-size: 0.75rem;
    margin-top: 6px;
    display: block;
    }

    /* Form Actions */
    .form-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 32px;
    }

    .btn-custom {
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: background-color 0.2s, transform 0.1s;
    }

    .btn-primary.btn-custom {
    background: linear-gradient(to right, #3b82f6, #1e40af);
    color: #ffffff;
    border: none;
    }

    .btn-primary.btn-custom:hover {
    background: linear-gradient(to right, #2563eb, #1e3a8a);
    transform: translateY(-1px);
    }

    .btn-secondary.btn-custom {
    background: linear-gradient(to right, #6b7280, #4b5563);
    color: #ffffff;
    border: none;
    }

    .btn-secondary.btn-custom:hover {
    background: linear-gradient(to right, #4b5563, #374151);
    transform: translateY(-1px);
    }

    /* Responsivitas */
    @media (max-width: 768px) {
    .profile-container {
      padding: 16px;
    }

    .container {
      width: calc(100% - 16px);
    }

    .profile-form {
      padding: 24px;
    }

    .form-grid {
      grid-template-columns: 1fr;
    }

    .profile-picture-wrapper {
      width: 100px;
      height: 100px;
    }

    .btn-custom {
      width: 100%;
      max-width: 250px;
    }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Pratinjau Foto Profil
    const profilePictureInput = document.getElementById('profile_picture');
    const profilePicturePreview = document.getElementById('profile-picture-preview');

    profilePictureInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        profilePicturePreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
      }
    });

    // Dropdown Lokasi
    const provinceSelect = document.getElementById('province_id');
    const regencySelect = document.getElementById('regency_id');
    const districtSelect = document.getElementById('district_id');
    const villageSelect = document.getElementById('village_id');

    function fetchOptions(url, selectElement, placeholderText) {
      fetch(url)
      .then(res => res.json())
      .then(data => {
        selectElement.innerHTML = <option value="">-- ${placeholderText} --</option>;
        data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;
        selectElement.appendChild(option);
        });
      })
      .catch(err => console.error('Error fetching data:', err));
    }

    provinceSelect.addEventListener('change', function () {
      if (this.value) {
      fetchOptions(/api/regencies / ${ this.value }, regencySelect, 'Pilih');
      districtSelect.innerHTML = '<option value="">-- Pilih --</option>';
      villageSelect.innerHTML = '<option value="">-- Pilih --</option>';
      } else {
      regencySelect.innerHTML = '<option value="">-- Pilih --</option>';
      districtSelect.innerHTML = '<option value="">-- Pilih --</option>';
      villageSelect.innerHTML = '<option value="">-- Pilih --</option>';
      }
    });

    regencySelect.addEventListener('change', function () {
      if (this.value) {
      fetchOptions(/api/districts / ${ this.value }, districtSelect, 'Pilih');
      villageSelect.innerHTML = '<option value="">-- Pilih --</option>';
      } else {
      districtSelect.innerHTML = '<option value="">-- Pilih --</option>';
      villageSelect.innerHTML = '<option value="">-- Pilih --</option>';
      }
    });

    districtSelect.addEventListener('change', function () {
      if (this.value) {
      fetchOptions(/api/villages / ${ this.value }, villageSelect, 'Pilih');
      } else {
      villageSelect.innerHTML = '<option value="">-- Pilih --</option>';
      }
    });

    // Inisialisasi dropdown jika ada data sebelumnya
    @if(old('province_id', $teacher->province_id))
    fetchOptions('/api/regencies/{{ old('province_id', $teacher->province_id) }}', regencySelect, 'Pilih');
    @endif
    @if(old('regency_id', $teacher->regency_id))
    fetchOptions('/api/districts/{{ old('regency_id', $teacher->regency_id) }}', districtSelect, 'Pilih');
    @endif
    @if(old('district_id', $teacher->district_id))
    fetchOptions('/api/villages/{{ old('district_id', $teacher->district_id) }}', villageSelect, 'Pilih');
    @endif
    });
  </script>
@endsection