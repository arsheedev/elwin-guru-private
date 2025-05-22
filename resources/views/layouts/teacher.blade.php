<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Elwin Guru') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/@vercel/geist-font@1.0.0/dist/fonts/geist-sans/GeistSans-700.woff2"
        rel="stylesheet" as="font" type="font/woff2" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Fade-in animation for navbar text */
        .fade-in {
            animation: fadeIn 1.5s ease-in-out forwards;
            font-family: 'Geist Sans', sans-serif;
            font-weight: 700;
            letter-spacing: -0.05em;
            /* Tighter letter spacing */
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-wide">
    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-center items-center">
            <h1 class="text-lg md:text-xl font-extrabold text-blue-500 fade-in">
                Smart Tutor Teacher
            </h1>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container mx-auto px-4 py-6">
        @yield('content')
    </div>

    @yield('scripts')
</body>

</html>