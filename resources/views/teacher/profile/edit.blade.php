@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('teacher.profile.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
      <label>No Telepon</label>
      <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $teacher->no_telepon) }}">
    </div>

    <div class="mb-3">
      <label>Province</label>
      <select id="province" name="province_id" class="form-control">
      <option value="">-- Select --</option>
      @foreach($provinces as $province)
      <option value="{{ $province->id }}" {{ $teacher->province_id == $province->id ? 'selected' : '' }}>
      {{ $province->name }}
      </option>
    @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Regency</label>
      <select id="regency" name="regency_id" class="form-control">
      @foreach($regencies as $regency)
      <option value="{{ $regency->id }}" {{ $teacher->regency_id == $regency->id ? 'selected' : '' }}>
      {{ $regency->name }}
      </option>
    @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>District</label>
      <select id="district" name="district_id" class="form-control">
      @foreach($districts as $district)
      <option value="{{ $district->id }}" {{ $teacher->district_id == $district->id ? 'selected' : '' }}>
      {{ $district->name }}
      </option>
    @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Village</label>
      <select id="village" name="village_id" class="form-control">
      @foreach($villages as $village)
      <option value="{{ $village->id }}" {{ $teacher->village_id == $village->id ? 'selected' : '' }}>
      {{ $village->name }}
      </option>
    @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Subject</label>
      <select name="subject_id" class="form-control">
      @foreach($subjects as $subject)
      <option value="{{ $subject->id }}" {{ $teacher->subject_id == $subject->id ? 'selected' : '' }}>
      {{ $subject->name }}
      </option>
    @endforeach
      </select>
    </div>

    <button class="btn btn-primary">Update</button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const provinceSelect = document.getElementById('province');
    const regencySelect = document.getElementById('regency');
    const districtSelect = document.getElementById('district');
    const villageSelect = document.getElementById('village');

    provinceSelect.addEventListener('change', function () {
      fetch(`/api/regencies/${this.value}`)
      .then(res => res.json())
      .then(data => {
        regencySelect.innerHTML = '<option value="">-- Select --</option>';
        data.forEach(r => {
        regencySelect.innerHTML += `<option value="${r.id}">${r.name}</option>`;
        });
        districtSelect.innerHTML = '<option value="">-- Select --</option>';
        villageSelect.innerHTML = '<option value="">-- Select --</option>';
      });
    });

    regencySelect.addEventListener('change', function () {
      fetch(`/api/districts/${this.value}`)
      .then(res => res.json())
      .then(data => {
        districtSelect.innerHTML = '<option value="">-- Select --</option>';
        data.forEach(d => {
        districtSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`;
        });
        villageSelect.innerHTML = '<option value="">-- Select --</option>';
      });
    });

    districtSelect.addEventListener('change', function () {
      fetch(`/api/villages/${this.value}`)
      .then(res => res.json())
      .then(data => {
        villageSelect.innerHTML = '<option value="">-- Select --</option>';
        data.forEach(v => {
        villageSelect.innerHTML += `<option value="${v.id}">${v.name}</option>`;
        });
      });
    });
    });
  </script>

@endsection