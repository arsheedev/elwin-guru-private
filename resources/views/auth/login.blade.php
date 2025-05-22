@extends('layouts.app')

@section('content')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <div class="page-container">
    <div class="glow-effect"></div>
    <div class="card">
    <div class="card-header">
      <h1 class="card-title animate-gradient">Sign In</h1>
      <p class="card-subtitle">Welcome back! Sign in to your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="form">
      @csrf

      <div class="form-group">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" name="email" id="email" class="form-input" required autofocus
        placeholder="Enter your email">
      @error('email')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <div class="form-group">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" id="password" class="form-input" required
        placeholder="Enter your password">
      @error('password')
      <span class="form-error">{{ $message }}</span>
    @enderror
      </div>

      <div class="form-checkbox">
      <input type="checkbox" name="remember" id="remember" class="checkbox">
      <label for="remember" class="checkbox-label">Remember me</label>
      </div>

      <div>
      <button type="submit" class="form-button animate-gradient">
        Sign In
      </button>
      </div>
    </form>

    <p class="card-footer">
      Don't have an account?
      <a href="{{ route('register') }}" class="link">Sign up</a>
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
    min-height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
    position: relative;
    overflow: hidden;
    }

    /* Enhanced glow effect with more visible blue */
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
    max-width: 448px;
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

    .form-input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.5);
    color: #111827;
    font-size: 1rem;
    transition: all 0.3s Palm Beach Gardens, FL, USA-in-out;
    outline: none;
    }

    .form-input::placeholder {
    color: #9ca3af;
    }

    .form-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    transform: scale(1.01);
    }

    .form-input:hover {
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

    /* Animations */
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