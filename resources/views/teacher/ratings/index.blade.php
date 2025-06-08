@extends('layouts.teacher')

@section('content')
  <div class="ratings-container">
    <div class="container">
    <div class="ratings-header">
      <h2 class="ratings-title">Penilaian Saya</h2>
      <p class="ratings-subtitle">Lihat apa yang dikatakan siswa tentang pengajaran Anda</p>
    </div>

    @if($ratings->isEmpty())
    <div class="no-ratings">
      <p>Belum ada penilaian. Teruskan mengajar untuk mendapatkan umpan balik!</p>
    </div>
    @else
      <!-- Kartu Ringkasan -->
      <div class="summary-card">
      <div class="summary-header">
      <h3 class="summary-title">Penilaian Keseluruhan</h3>
      <div class="overall-rating">
        <span class="overall-score">
        {{ number_format($ratings->avg(function ($rating) {
      return ($rating->quality_teaching + $rating->communication + $rating->discipline + $rating->teaching_method + $rating->teaching_result) / 5;
      }), 2) }}
        </span>
        <div class="stars">
        @for($i = 1; $i <= 5; $i++)
        <svg class="star {{ $i <= round($ratings->avg(function ($rating) {
        return ($rating->quality_teaching + $rating->communication + $rating->discipline + $rating->teaching_method + $rating->teaching_result) / 5;
      })) ? 'filled' : '' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
        stroke-width="2">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
        </svg>
      @endfor
        </div>
        <span class="total-reviews">Berdasarkan {{ $ratings->count() }}
        {{ Str::plural('penilaian', $ratings->count()) }}</span>
      </div>
      </div>
      <div class="summary-metrics">
      <div class="metric">
        <span class="metric-label">Kualitas Pengajaran</span>
        <div class="progress-bar">
        <div class="progress" style="width: {{ ($ratings->avg('quality_teaching') / 5) * 100 }}%"></div>
        </div>
        <span class="metric-score">{{ number_format($ratings->avg('quality_teaching'), 1) }}</span>
      </div>
      <div class="metric">
        <span class="metric-label">Komunikasi</span>
        <div class="progress-bar">
        <div class="progress" style="width: {{ ($ratings->avg('communication') / 5) * 100 }}%"></div>
        </div>
        <span class="metric-score">{{ number_format($ratings->avg('communication'), 1) }}</span>
      </div>
      <div class="metric">
        <span class="metric-label">Disiplin</span>
        <div class="progress-bar">
        <div class="progress" style="width: {{ ($ratings->avg('discipline') / 5) * 100 }}%"></div>
        </div>
        <span class="metric-score">{{ number_format($ratings->avg('discipline'), 1) }}</span>
      </div>
      <div class="metric">
        <span class="metric-label">Metode Pengajaran</span>
        <div class="progress-bar">
        <div class="progress" style="width: {{ ($ratings->avg('teaching_method') / 5) * 100 }}%"></div>
        </div>
        <span class="metric-score">{{ number_format($ratings->avg('teaching_method'), 1) }}</span>
      </div>
      <div class="metric">
        <span class="metric-label">Hasil Pengajaran</span>
        <div class="progress-bar">
        <div class="progress" style="width: {{ ($ratings->avg('teaching_result') / 5) * 100 }}%"></div>
        </div>
        <span class="metric-score">{{ number_format($ratings->avg('teaching_result'), 1) }}</span>
      </div>
      </div>
      </div>

      <!-- Penilaian Individu -->
      <div class="ratings-list">
      @foreach($ratings as $rating)
      <div class="rating-card">
      <div class="rating-header">
      <div class="student-info">
      <span class="student-name">{{ $rating->student->user->name ?? 'Anonim' }}</span>
      <span class="rating-date">{{ $rating->created_at->format('d M Y') }}</span>
      </div>
      <div class="rating-average">
      <span class="average-score">
        {{ number_format(($rating->quality_teaching + $rating->communication + $rating->discipline + $rating->teaching_method + $rating->teaching_result) / 5, 1) }}
      </span>
      <div class="stars">
        @for($i = 1; $i <= 5; $i++)
      <svg
      class="star {{ $i <= round(($rating->quality_teaching + $rating->communication + $rating->discipline + $rating->teaching_method + $rating->teaching_result) / 5) ? 'filled' : '' }}"
      xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
      stroke-width="2">
      <path
      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      @endfor
      </div>
      </div>
      </div>

      <div class="rating-metrics">
      <div class="metric">
      <span class="metric-label">Kualitas Pengajaran</span>
      <div class="stars">
        @for($i = 1; $i <= 5; $i++)
      <svg class="star {{ $i <= $rating->quality_teaching ? 'filled' : '' }}" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path
      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      @endfor
      </div>
      </div>
      <div class="metric">
      <span class="metric-label">Komunikasi</span>
      <div class="stars">
        @for($i = 1; $i <= 5; $i++)
      <svg class="star {{ $i <= $rating->communication ? 'filled' : '' }}" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path
      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      @endfor
      </div>
      </div>
      <div class="metric">
      <span class="metric-label">Disiplin</span>
      <div class="stars">
        @for($i = 1; $i <= 5; $i++)
      <svg class="star {{ $i <= $rating->discipline ? 'filled' : '' }}" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path
      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      @endfor
      </div>
      </div>
      <div class="metric">
      <span class="metric-label">Metode Pengajaran</span>
      <div class="stars">
        @for($i = 1; $i <= 5; $i++)
      <svg class="star {{ $i <= $rating->teaching_method ? 'filled' : '' }}" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path
      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      @endfor
      </div>
      </div>
      <div class="metric">
      <span class="metric-label">Hasil Pengajaran</span>
      <div class="stars">
        @for($i = 1; $i <= 5; $i++)
      <svg class="star {{ $i <= $rating->teaching_result ? 'filled' : '' }}" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path
      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      @endfor
      </div>
      </div>
      </div>
      <div class="rating-comment">
      <p>{{ $rating->comment ?: 'Tidak ada komentar.' }}</p>
      </div>
      </div>
      @endforeach
      </div>
    @endif
    </div>
  </div>

  <style>
    /* Base Styles */
    body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: #f1f5f9;
    margin: 0;
    padding: 0;
    }

    .ratings-container {
    min-height: calc(100vh - 64px);
    padding: 24px;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .container {
    max-width: 900px;
    width: 100%;
    box-sizing: border-box;
    }

    /* Header */
    .ratings-header {
    text-align: center;
    margin-bottom: 32px;
    }

    .ratings-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1e40af;
    background: linear-gradient(to right, #3b82f6, #1e40af);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    }

    .ratings-subtitle {
    font-size: 1rem;
    color: #6b7280;
    margin-top: 8px;
    }

    /* No Ratings */
    .no-ratings {
    text-align: center;
    padding: 32px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    animation: fadeIn 0.5s ease-in;
    }

    .no-ratings p {
    font-size: 1rem;
    color: #4b5563;
    }

    /* Summary Card */
    .summary-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    margin-bottom: 32px;
    animation: slideUp 0.5s ease-out;
    }

    .summary-header {
    text-align: center;
    margin-bottom: 24px;
    }

    .summary-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    }

    .overall-rating {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    }

    .overall-score {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e40af;
    }

    .stars {
    display: flex;
    gap: 4px;
    }

    .star {
    width: 24px;
    height: 24px;
    color: #d1d5db;
    transition: color 0.2s;
    }

    .star.filled {
    color: #f59e0b;
    }

    .total-reviews {
    font-size: 0.875rem;
    color: #6b7280;
    }

    .summary-metrics {
    display: grid;
    gap: 16px;
    }

    .metric {
    display: flex;
    align-items: center;
    gap: 16px;
    }

    .metric-label {
    flex: 1;
    font-size: 0.875rem;
    font-weight: 500;
    color: #1e293b;
    }

    .progress-bar {
    flex: 2;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
    }

    .progress {
    height: 100%;
    background: linear-gradient(to right, #3b82f6, #1e40af);
    transition: width 0.5s ease-in-out;
    }

    .metric-score {
    font-size: 0.875rem;
    font-weight: 600;
    color: #1e40af;
    }

    /* Rating Cards */
    .ratings-list {
    display: grid;
    gap: 24px;
    }

    .rating-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    animation: slideUp 0.5s ease-out;
    transition: transform 0.2s;
    }

    .rating-card:hover {
    transform: translateY(-4px);
    }

    .rating-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    flex-wrap: wrap;
    gap: 16px;
    }

    .student-info {
    display: flex;
    flex-direction: column;
    }

    .student-name {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    }

    .rating-date {
    font-size: 0.75rem;
    color: #6b7280;
    }

    .rating-average {
    display: flex;
    align-items: center;
    gap: 8px;
    }

    .average-score {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e40af;
    }

    .rating-metrics {
    display: grid;
    gap: 12px;
    margin-bottom: 16px;
    }

    .rating-comment {
    background: #f9fafb;
    padding: 12px;
    border-radius: 8px;
    }

    .rating-comment p {
    font-size: 0.875rem;
    color: #4b5563;
    margin: 0;
    }

    /* Animations */
    @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
    }

    @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
    }

    /* Responsive */
    @media (max-width: 768px) {
    .ratings-container {
      padding: 16px;
    }

    .container {
      width: calc(100% - 16px);
    }

    .ratings-title {
      font-size: 1.5rem;
    }

    .summary-card,
    .rating-card {
      padding: 16px;
    }

    .overall-score {
      font-size: 2rem;
    }

    .metric {
      flex-direction: column;
      align-items: flex-start;
    }

    .progress-bar {
      width: 100%;
    }

    .rating-header {
      flex-direction: column;
      align-items: flex-start;
    }
    }
  </style>
@endsection