<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>{{ config('app.name', 'Elwin Guru') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- if using Laravel Vite --}}
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-wide">
  <div class="container mx-auto px-4 py-6">
    @yield('content')
  </div>

  @yield('scripts')
</body>

</html>