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
        .fade-in {
            animation: fadeIn 1.5s ease-in-out forwards;
            font-family: 'Geist Sans', sans-serif;
            font-weight: 700;
            letter-spacing: -0.05em;
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

        .submenu {
            display: flex;
            gap: 1.5rem;
            margin-top: 1rem;
            justify-content: center;
        }

        .submenu a {
            font-family: 'Geist Sans', sans-serif;
            font-weight: 600;
            color: #1F2937;
            background-color: #EFF6FF;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .submenu a:hover {
            background-color: #3B82F6;
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .submenu a:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .submenu a.active {
            background-color: #1D4ED8;
            color: #FFFFFF;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-wide">
    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex flex-col justify-center items-center">
            <h1 class="text-lg md:text-xl font-extrabold text-blue-500 fade-in">
                Smart Tutor Teacher
            </h1>
            <!-- Submenu -->
            <div class="submenu fade-in">
                <a href="/teacher" class="nav-link">Profil</a>
                <a href="/teacher/ratings" class="nav-link">Rating</a>
                <a href="/teacher/schedules" class="nav-link">Jadwal</a>
                <a href="/teacher/bookings" class="nav-link">Pemesanan</a>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container mx-auto px-4 py-6">
        @yield('content')
    </div>

    @yield('scripts')
    <script>
        // JavaScript to set active class based on current URL
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>