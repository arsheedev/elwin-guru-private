@extends('layouts.students')

@section('content')

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartTutor - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <div class="page-container">
    <div class="glow-effect"></div>
    <div class="card">
    <div class="card-header">
      <h1 class="card-title animate-gradient">Cari Guru</h1>
      <p class="card-subtitle">Temukan guru berdasarkan mata pelajaran dan lokasi</p>
    </div>

    <form method="GET" action="{{ route('student.teachers.search') }}" class="form">
      <div class="form-row">
      <! Mata Pelajaran>
        <div class="form-group">
        <label for="subject_id" class="form-label">Mata Pelajaran</label>
        <select name="subject_id" id="subject_id" class="form-select">
          <option value=""> Semua Mata Pelajaran </option>
          @foreach($subjects as $subject)
        <option value="{{ $subject->id }}" {{ $request->subject_id == $subject->id ? 'selected' : '' }}>
        {{ $subject->name }}
        </option>
      @endforeach
        </select>
        </div>

        <! Provinsi>
        <div class="form-group">
          <label for="province_id" class="form-label">Provinsi</label>
          <select id="province_id" name="province_id" class="form-select">
          <option value=""> Pilih Provinsi </option>
          @foreach($provinces as $province)
        <option value="{{ $province->id }}" {{ $request->province_id == $province->id ? 'selected' : '' }}>
        {{ $province->name }}
        </option>
      @endforeach
          </select>
        </div>

        <! Kabupaten>
          <div class="form-group">
          <label for="regency_id" class="form-label">Kabupaten</label>
          <select id="regency_id" name="regency_id" class="form-select">
            <option value=""> Pilih Kabupaten </option>
          </select>
          </div>

          <! Kecamatan>
          <div class="form-group">
            <label for="district_id" class="form-label">Kecamatan</label>
            <select id="district_id" name="district_id" class="form-select">
            <option value=""> Pilih Kecamatan </option>
            </select>
          </div>

          <! Desa>
            <div class="form-group">
            <label for="village_id" class="form-label">Desa</label>
            <select id="village_id" name="village_id" class="form-select">
              <option value=""> Pilih Desa </option>
            </select>
            </div>
      </div>

      <div class="form-actions">
      <button type="submit" class="form-button animate-gradient">Cari</button>
      <a href="/student" class="reset-button">Reset</a>
      </div>
    </form>

    <hr class="divider">

    <div class="results-header">
      <h2 class="results-title">Hasil Pencarian ({{ $teachers->total() }})</h2>
    </div>

    @if($teachers->isEmpty())
    <p class="no-results">Tidak ada guru yang ditemukan.</p>
    @else
    <div class="table-container">
      <table class="results-table">
      <thead>
      <tr>
      <th>Nama</th>
      <th>Mata Pelajaran</th>
      <th>Lokasi</th>
      <th>Telepon</th>
      <th>Detail</th>
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
      <a href="{{ route('student.teachers.show', $teacher->id) }}" class="table-button">Lihat</a>
      </td>
      </tr>
      @endforeach
      </tbody>
      </table>
    </div>

    <div class="pagination">
      {{ $teachers->withQueryString()->links() }}
    </div>
    @endif
    </div>
  </div>

  <style>
    body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
    }

    /* Kontainer halaman dengan gradien putih */
    .page-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
    overflow: hidden;
    }

    /* Efek glow biru */


    /* Styling kartu */
    .card {
    max-width: 960px;
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

    /* Header kartu */
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

    /* Styling formulir */
    .form {
    display: flex;
    flex-direction: column;
    gap: 24px;
    }

    .form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
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

    .form-select:invalid {
    color: #9ca3af;
    }

    .form-select:focus,
    .form-select:hover {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    transform: scale(1.01);
    }

    .form-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    }

    .form-button {
    width: 100%;
    max-width: 200px;
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

    .reset-button {
    width: 100%;
    max-width: 200px;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(to right, #6b7280, #4b5563);
    background-size: 200% 200%;
    color: #ffffff;
    font-size: 1rem;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    animation: gradient 4s ease infinite;
    }

    .reset-button:hover {
    background: linear-gradient(to right, #4b5563, #374151);
    transform: scale(1.02);
    }

    .reset-button:focus {
    box-shadow: 0 0 0 4px rgba(107, 114, 128, 0.3);
    }

    /* Pembatas */
    .divider {
    border: 0;
    border-top: 1px solid #e5e7eb;
    margin: 24px 0;
    }

    /* Header hasil */
    .results-header {
    margin-bottom: 16px;
    }

    .results-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    }

    .no-results {
    font-size: 1rem;
    color: #6b7280;
    text-align: center;
    }

    /* Styling tabel */
    .table-container {
    overflow-x: auto;
    }

    .results-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
    color: #1f2937;
    }

    .results-table th,
    .results-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    }

    .results-table th {
    background: rgba(59, 130, 246, 0.1);
    font-weight: 600;
    color: #2563eb;
    }

    .results-table tr:hover {
    background: rgba(59, 130, 246, 0.05);
    transition: background 0.2s ease;
    }

    .table-button {
    display: inline-block;
    padding: 8px 16px;
    background: #2563eb;
    color: #ffffff;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    }

    .table-button:hover {
    background: #1e40af;
    transform: scale(1.05);
    }

    .pagination {
    margin-top: 24px;
    text-align: center;
    }

    .pagination a,
    .pagination span {
    display: inline-block;
    padding: 8px 12px;
    margin: 0 4px;
    border-radius: 6px;
    font-size: 0.875rem;
    color: #2563eb;
    text-decoration: none;
    transition: all 0.2s ease;
    }

    .pagination a:hover {
    background: rgba(59, 130, 246, 0.1);
    transform: scale(1.05);
    }

    .pagination .current {
    background: #2563eb;
    color: #ffffff;
    }

    /* Animasi */
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
  </style>
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    function fetchOptions(url, selectId, selectedId = null) {
      fetch(url)
      .then(response => response.json())
      .then(data => {
        const select = document.getElementById(selectId);
        select.innerHTML = '<option value=""> Pilih </option>';
        data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;
        if (selectedId && selectedId == item.id) option.selected = true;
        select.appendChild(option);
        });
      });
    }

    const province = document.getElementById('province_id');
    const regency = document.getElementById('regency_id');
    const district = document.getElementById('district_id');
    const village = document.getElementById('village_id');

    province.addEventListener('change', function () {
      if (this.value) {
      fetchOptions(`/api/regencies/${this.value}`, 'regency_id');
      district.innerHTML = '<option value=""> Pilih Kecamatan </option>';
      village.innerHTML = '<option value=""> Pilih Desa </option>';
      } else {
      regency.innerHTML = '<option value=""> Pilih Kabupaten </option>';
      district.innerHTML = '<option value=""> Pilih Kecamatan </option>';
      village.innerHTML = '<option value=""> Pilih Desa </option>';
      }
    });

    regency.addEventListener('change', function () {
      if (this.value) {
      fetchOptions(`/api/districts/${this.value}`, 'district_id');
      village.innerHTML = '<option value=""> Pilih Desa </option>';
      } else {
      district.innerHTML = '<option value=""> Pilih Kecamatan </option>';
      village.innerHTML = '<option value=""> Pilih Desa </option>';
      }
    });

    district.addEventListener('change', function () {
      if (this.value) {
      fetchOptions(`/api/villages/${this.value}`, 'village_id');
      } else {
      village.innerHTML = '<option value=""> Pilih Desa </option>';
      }
    });

    // Inisialisasi dropdown dengan input lama
    @if($request->province_id)
    fetchOptions('/api/regencies/{{ $request->province_id }}', 'regency_id', '{{ $request->regency_id }}');
    @endif
    @if($request->regency_id)
    fetchOptions('/api/districts/{{ $request->regency_id }}', 'district_id', '{{ $request->district_id }}');
    @endif
    @if($request->district_id)
    fetchOptions('/api/villages/{{ $request->district_id }}', 'village_id', '{{ $request->village_id }}');
    @endif
    });
  </script>
@endsection