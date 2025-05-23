@extends('layouts.students')

@section('content')
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    .rating-container {
    max-width: 600px;
    margin: 2rem auto;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    font-family: 'Poppins', sans-serif;
    }

    .rating-container h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    text-align: center;
    margin-bottom: 1.5rem;
    }

    .rating-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    }

    .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    }

    .form-group label {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    }

    .star-rating {
    display: flex;
    gap: 0.5rem;
    font-size: 1.5rem;
    cursor: pointer;
    }

    .star-svg {
    width: 1.5rem;
    height: 1.5rem;
    fill: #d1d5db;
    transition: fill 0.2s ease;
    }

    .star-rating .star-svg.filled,
    .star-rating .star-svg:hover,
    .star-rating .star-svg:hover~.star-svg {
    fill: #f59e0b;
    }

    .form-group textarea {
    width: 100%;
    min-height: 100px;
    padding: 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    color: #1f2937;
    resize: vertical;
    transition: border-color 0.2s ease;
    }

    .form-group textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .submit-button {
    background-color: #3b82f6;
    color: #ffffff;
    padding: 0.75rem 2rem;
    border-radius: 2rem;
    border: none;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    align-self: center;
    }

    .submit-button:hover {
    background-color: #2563eb;
    }

    @media (max-width: 576px) {
    .rating-container {
      margin: 1rem;
      padding: 1.5rem;
    }

    .rating-container h2 {
      font-size: 1.5rem;
    }

    .star-rating {
      font-size: 1.2rem;
    }

    .star-svg {
      width: 1.2rem;
      height: 1.2rem;
    }

    .form-group label {
      font-size: 0.9rem;
    }

    .submit-button {
      width: 100%;
    }
    }
  </style>

  <div class="rating-container">
    <h2>Rate Teacher: {{ $booking->teacher->user->name }}</h2>

    <form action="{{ route('student.ratings.store') }}" method="POST" class="rating-form">
    @csrf
    <input type="hidden" name="teacher_id" value="{{ $booking->teacher_id }}">
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

    <div class="form-group">
      <label for="quality_teaching">Quality Teaching</label>
      <div class="star-rating" data-input="quality_teaching">
      <svg class="star-svg" data-value="1" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="2" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="3" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="4" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="5" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      </div>
      <input type="hidden" name="quality_teaching" id="quality_teaching" value="0" required>
    </div>

    <div class="form-group">
      <label for="communication">Communication</label>
      <div class="star-rating" data-input="communication">
      <svg class="star-svg" data-value="1" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="2" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="3" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="4" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="5" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      </div>
      <input type="hidden" name="communication" id="communication" value="0" required>
    </div>

    <div class="form-group">
      <label for="discipline">Discipline</label>
      <div class="star-rating" data-input="discipline">
      <svg class="star-svg" data-value="1" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="2" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="3" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="4" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="5" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      </div>
      <input type="hidden" name="discipline" id="discipline" value="0" required>
    </div>

    <div class="form-group">
      <label for="teaching_method">Teaching Method</label>
      <div class="star-rating" data-input="teaching_method">
      <svg class="star-svg" data-value="1" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="2" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="3" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="4" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="5" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      </div>
      <input type="hidden" name="teaching_method" id="teaching_method" value="0" required>
    </div>

    <div class="form-group">
      <label for="teaching_result">Teaching Result</label>
      <div class="star-rating" data-input="teaching_result">
      <svg class="star-svg" data-value="1" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="2" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="3" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="4" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      <svg class="star-svg" data-value="5" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
      </div>
      <input type="hidden" name="teaching_result" id="teaching_result" value="0" required>
    </div>

    <div class="form-group">
      <label for="comment">Comment (Optional)</label>
      <textarea name="comment" id="comment" placeholder="Share your feedback about the teacher..."></textarea>
    </div>

    <button type="submit" class="submit-button">Submit Rating</button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const starRatings = document.querySelectorAll('.star-rating');

    starRatings.forEach(rating => {
      const inputId = rating.getAttribute('data-input');
      const input = document.getElementById(inputId);
      const stars = rating.querySelectorAll('.star-svg');

      stars.forEach(star => {
      star.addEventListener('click', () => {
        const value = parseInt(star.getAttribute('data-value'));
        input.value = value;

        stars.forEach(s => {
        const sValue = parseInt(s.getAttribute('data-value'));
        s.classList.toggle('filled', sValue <= value);
        });
      });

      star.addEventListener('mouseover', () => {
        const value = parseInt(star.getAttribute('data-value'));
        stars.forEach(s => {
        const sValue = parseInt(s.getAttribute('data-value'));
        s.classList.toggle('filled', sValue <= value);
        });
      });

      star.addEventListener('mouseout', () => {
        const currentValue = parseInt(input.value) || 0;
        stars.forEach(s => {
        const sValue = parseInt(s.getAttribute('data-value'));
        s.classList.toggle('filled', sValue <= currentValue);
        });
      });
      });
    });
    });
  </script>
@endsection