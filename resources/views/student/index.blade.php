@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Search Teachers</h2>

    <form method="GET" action="{{ route('student.teachers.search') }}">
    <div class="row g-3 mb-3">

      <div class="col-md-3">
      <label for="subject_id" class="form-label">Subject</label>
      <select name="subject_id" id="subject_id" class="form-control">
        <option value="">-- All Subjects --</option>
        @foreach($subjects as $subject)
      <option value="{{ $subject->id }}" {{ $request->subject_id == $subject->id ? 'selected' : '' }}>
      {{ $subject->name }}
      </option>
      @endforeach
      </select>
      </div>

      <div class="col-md-3">
      <label for="province_id" class="form-label">Province</label>
      <select id="province_id" name="province_id" class="form-control">
        <option value="">-- Select Province --</option>
        @foreach($provinces as $province)
      <option value="{{ $province->id }}" {{ $request->province_id == $province->id ? 'selected' : '' }}>
      {{ $province->name }}
      </option>
      @endforeach
      </select>
      </div>

      <div class="col-md-3">
      <label for="regency_id" class="form-label">Regency</label>
      <select id="regency_id" name="regency_id" class="form-control">
        <option value="">-- Select Regency --</option>
        <!-- Filled dynamically by JS -->
      </select>
      </div>

      <div class="col-md-3">
      <label for="district_id" class="form-label">District</label>
      <select id="district_id" name="district_id" class="form-control">
        <option value="">-- Select District --</option>
        <!-- Filled dynamically by JS -->
      </select>
      </div>

      <div class="col-md-3 mt-3">
      <label for="village_id" class="form-label">Village</label>
      <select id="village_id" name="village_id" class="form-control">
        <option value="">-- Select Village --</option>
        <!-- Filled dynamically by JS -->
      </select>
      </div>

    </div>

    <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <hr>

    <h3>Results ({{ $teachers->total() }})</h3>

    @if($teachers->isEmpty())
    <p>No teachers found.</p>
    @else
    <table class="table table-striped">
    <thead>
      <tr>
      <th>Name</th>
      <th>Subject</th>
      <th>Location</th>
      <th>Phone</th>
      <th>detail</th>
      </tr>
    </thead>
    <tbody>
      @foreach($teachers as $teacher)
      <tr>
      <td>{{ $teacher->user->name }}</td>
      <td>{{ $teacher->subject->name ?? '-' }}</td>
      <td>
      {{ $teacher->province->name ?? '-' }},
      {{ $teacher->regency->name ?? '-' }},
      {{ $teacher->district->name ?? '-' }},
      {{ $teacher->village->name ?? '-' }}
      </td>
      <td>{{ $teacher->no_telepon }}</td>
      <td>
      <a href="{{ route('student.teachers.show', $teacher->id) }}" class="btn btn-info btn-sm">View</a>
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>

    {{ $teachers->withQueryString()->links() }}
    @endif
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Helper function to fetch and fill options
    function fetchOptions(url, selectId, selectedId = null) {
      fetch(url)
      .then(response => response.json())
      .then(data => {
        const select = document.getElementById(selectId);
        select.innerHTML = '<option value="">-- Select --</option>';
        data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;
        if (selectedId && selectedId == item.id) option.selected = true;
        select.appendChild(option);
        });
      });
    }

    // Load regencies when province changes
    document.getElementById('province_id').addEventListener('change', function () {
      const provinceId = this.value;
      if (provinceId) {
      fetchOptions('/api/regencies/' + provinceId, 'regency_id');
      } else {
      document.getElementById('regency_id').innerHTML = '<option value="">-- Select Regency --</option>';
      document.getElementById('district_id').innerHTML = '<option value="">-- Select District --</option>';
      document.getElementById('village_id').innerHTML = '<option value="">-- Select Village --</option>';
      }
    });

    // Load districts when regency changes
    document.getElementById('regency_id').addEventListener('change', function () {
      const regencyId = this.value;
      if (regencyId) {
      fetchOptions('/api/districts/' + regencyId, 'district_id');
      } else {
      document.getElementById('district_id').innerHTML = '<option value="">-- Select District --</option>';
      document.getElementById('village_id').innerHTML = '<option value="">-- Select Village --</option>';
      }
    });

    // Load villages when district changes
    document.getElementById('district_id').addEventListener('change', function () {
      const districtId = this.value;
      if (districtId) {
      fetchOptions('/api/villages/' + districtId, 'village_id');
      } else {
      document.getElementById('village_id').innerHTML = '<option value="">-- Select Village --</option>';
      }
    });

    // Optional: On page load, trigger change events if filters preset (for edit/search back)
    @if($request->province_id)
    fetchOptions('/locations/regencies/{{ $request->province_id }}', 'regency_id', '{{ $request->regency_id }}');
    @endif

    @if($request->regency_id)
    fetchOptions('/locations/districts/{{ $request->regency_id }}', 'district_id', '{{ $request->district_id }}');
    @endif

    @if($request->district_id)
    fetchOptions('/locations/villages/{{ $request->district_id }}', 'village_id', '{{ $request->village_id }}');
    @endif
    });
  </script>
@endsection