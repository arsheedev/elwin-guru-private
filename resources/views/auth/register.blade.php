@extends('layouts.app')

@section('content')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <div class="page-container">
    <div class="glow-effect"></div>
    <div class="card">
    <div class="card-header">
      <h1 class="card-title animate-gradient">Register</h1>
      <p class="card-subtitle">Create your account to get started</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="form">
      @csrf

      <!-- Name -->
      <div class="form-group">
      <label for="name" class="form-label">Name</label>
      <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required
        placeholder="Enter your name">
      @error('name')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Email -->
      <div class="form-group">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required
        placeholder="Enter your email">
      @error('email')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Password -->
      <div class="form-group">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" id="password" class="form-input" required
        placeholder="Enter your password">
      @error('password')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Confirm Password -->
      <div class="form-group">
      <label for="password_confirmation" class="form-label">Confirm Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" required
        placeholder="Confirm your password">
      </div>

      <!-- Role -->
      <div class="form-group">
      <label for="role" class="form-label">Register as</label>
      <select name="role" id="role" class="form-select" required>
        <option value="">-- Select Role --</option>
        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
      </select>
      @error('role')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Phone -->
      <div class="form-group">
      <label for="no_telepon" class="form-label">Phone Number</label>
      <input type="text" name="no_telepon" id="no_telepon" class="form-input" value="{{ old('no_telepon') }}" required
        placeholder="Enter your phone number">
      @error('no_telepon')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Subject (for teachers) -->
      <div class="form-group" id="subject-field" style="display: none;">
      <label for="subject_id" class="form-label">Subject</label>
      <select name="subject_id" id="subject_id" class="form-select">
        <option value="">-- Select Subject --</option>
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

      <!-- Province -->
      <div class="form-group">
      <label for="province" class="form-label">Province</label>
      <select name="province_id" id="province" class="form-select" required>
        <option value="">-- Select Province --</option>
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

      <!-- Regency -->
      <div class="form-group">
      <label for="regency" class="form-label">Regency</label>
      <select name="regency_id" id="regency" class="form-select" required></select>
      @error('regency_id')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- District -->
      <div class="form-group">
      <label for="district" class="form-label">District</label>
      <select name="district_id" id="district" class="form-select" required></select>
      @error('district_id')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <!-- Village -->
      <div class="form-group">
      <label for="village" class="form-label">Village</label>
      <select name="village_id" id="village" class="form-select" required></select>
      @error('village_id')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <div>
      <button type="submit" class="form-button animate-gradient">
        Register
      </button>
      </div>
    </form>

    <p class="card-footer">
      Already have an account?
      <a href="{{ route('login') }}" class="link">Sign in</a>
    </p>
    </div>
  </div>

  <style>
    body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
    }

    /* Page container with white gradient background */
    .page-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    position: relative;
    overflow: hidden;
    }

    /* Enhanced glow effect with vibrant blue */
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

    /* Card styling */
    .card {
    max-width: 640px;
    /* Slightly wider than login for more fields */
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

    /* Card header */
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

    .form-checkbox {
    display: flex;
    align-items: center;
    }

    .checkbox {
    width: 16px;
    height: 16px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    accent-color: #2563eb;
    transition: all 0.2s ease;
    }

    .checkbox-label {
    font-size: 0.875rem;
    color: #4b5563;
    margin-left: 8px;
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

    roleSelect.addEventListener('change', () => {
      subjectField.style.display = roleSelect.value === 'teacher' ? 'block' : 'none';
    });

    const province = document.getElementById('province');
    const regency = document.getElementById('regency');
    const district = document.getElementById('district');
    const village = document.getElementById('village');

    function fetchOptions(url, target) {
      fetch(url)
      .then(res => res.json())
      .then(data => {
        target.innerHTML = '<option value="">-- Select --</option>';
        data.forEach(item => {
        target.innerHTML += `<option value="${item.id}">${item.name}</option>`;
        });
      });
    }

    province.addEventListener('change', () => {
      fetchOptions(`/api/regencies/${province.value}`, regency);
      district.innerHTML = '<option value="">-- Select --</option>';
      village.innerHTML = '<option value="">-- Select --</option>';
    });

    regency.addEventListener('change', () => {
      fetchOptions(`/api/districts/${regency.value}`, district);
      village.innerHTML = '<option value="">-- Select --</option>';
    });

    district.addEventListener('change', () => {
      fetchOptions(`/api/villages/${district.value}`, village);
    });

    if (roleSelect.value === 'teacher') {
      subjectField.style.display = 'block';
    }
    });
  </script>
@endsection