@extends('layouts.app')

@section('content')
  <div class="container mx-auto max-w-md mt-10">
    <h2 class="text-xl font-bold mb-4">Login</h2>

    <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-4">
      <label>Email</label>
      <input type="email" name="email" class="w-full border px-3 py-2" required autofocus>
    </div>

    <div class="mb-4">
      <label>Password</label>
      <input type="password" name="password" class="w-full border px-3 py-2" required>
    </div>

    <div class="mb-4">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>

    <div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2">Login</button>
    </div>
    </form>
  </div>
@endsection