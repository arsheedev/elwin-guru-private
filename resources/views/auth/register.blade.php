@extends('layouts.app')

@section('content')
  <div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Register</h2>

    <form method="POST" action="{{ route('register') }}">
    @csrf

    {{-- Name --}}
    <div class="mb-4">
      <label>Name</label>
      <input name="name" type="text" class="w-full border p-2 rounded" value="{{ old('name') }}" required>
      @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Email --}}
    <div class="mb-4">
      <label>Email</label>
      <input name="email" type="email" class="w-full border p-2 rounded" value="{{ old('email') }}" required>
      @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Password --}}
    <div class="mb-4">
      <label>Password</label>
      <input name="password" type="password" class="w-full border p-2 rounded" required>
      @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="mb-4">
      <label>Confirm Password</label>
      <input name="password_confirmation" type="password" class="w-full border p-2 rounded" required>
    </div>

    {{-- Role --}}
    <div class="mb-4">
      <label>Register as</label>
      <select name="role" id="role" class="w-full border p-2 rounded" required>
      <option value="">-- Select Role --</option>
      <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
      <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
      </select>
      @error('role') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Phone --}}
    <div class="mb-4">
      <label>No Telepon</label>
      <input name="no_telepon" type="text" class="w-full border p-2 rounded" value="{{ old('no_telepon') }}" required>
      @error('no_telepon') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Subject (only for teacher) --}}
    <div class="mb-4" id="subject-field" style="display: none;">
      <label>Subject</label>
      <select name="subject_id" class="w-full border p-2 rounded">
      <option value="">-- Select Subject --</option>
      @foreach ($subjects as $subject)
      <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
      {{ $subject->name }}
      </option>
    @endforeach
      </select>
      @error('subject_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Province --}}
    <div class="mb-4">
      <label>Province</label>
      <select name="province_id" id="province" class="w-full border p-2 rounded" required>
      <option value="">-- Select Province --</option>
      @foreach ($provinces as $province)
      <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
      {{ $province->name }}
      </option>
    @endforeach
      </select>
      @error('province_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Regency --}}
    <div class="mb-4">
      <label>Regency</label>
      <select name="regency_id" id="regency" class="w-full border p-2 rounded" required></select>
      @error('regency_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- District --}}
    <div class="mb-4">
      <label>District</label>
      <select name="district_id" id="district" class="w-full border p-2 rounded" required></select>
      @error('district_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Village --}}
    <div class="mb-4">
      <label>Village</label>
      <select name="village_id" id="village" class="w-full border p-2 rounded" required></select>
      @error('village_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full">Register</button>
    </div>
    </form>
  </div>
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
      district.innerHTML = '';
      village.innerHTML = '';
    });

    regency.addEventListener('change', () => {
      fetchOptions(`/api/districts/${regency.value}`, district);
      village.innerHTML = '';
    });

    district.addEventListener('change', () => {
      fetchOptions(`/api/villages/${district.value}`, village);
    });
    });
  </script>
@endsection