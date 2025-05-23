<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <a href="{{ url('/student') }}" class="brand-link animate-gradient">SmartTutor</a>
            </div>
            <div class="navbar-links">
                <a href="{{ url('/student') }}" class="nav-link {{ request()->is('/student') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span>Beranda</span>
                </a>
                <a href="/student/bookings" class="nav-link {{ request()->is('bookings') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Booking</span>
                </a>
            </div>
            <div class="navbar-menu">
                @guest
                    <a href="{{ route('login') }}" class="login-button animate-gradient">Masuk</a>
                @endguest
                @auth
                    <div class="user-display" id="userProfile">
                        <svg class="profile-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                        <div class="profile-popup" id="profilePopup">
                            <div class="profile-header">
                                <svg class="profile-icon-large" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div class="profile-info">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <p>{{ Auth::user()->role === 'student' ? 'Akun Siswa' : 'Akun Guru' }}</p>
                                </div>
                            </div>
                            <a href="{{ route('logout') }}" class="logout-button"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="content-container">
        <div class="glow-effect"></div>
        @yield('content')
    </div>

    @yield('scripts')

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
        }

        /* Navbar */
        .navbar {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 1rem 2rem;
            transform: translateY(-20px);
            opacity: 0;
            animation: fadeInUp 0.6s ease-out 0.2s forwards;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-brand .brand-link {
            color: #1f2937;
            font-size: 1.75rem;
            font-weight: 700;
            text-decoration: none;
            background: linear-gradient(to right, #2563eb, #1e40af);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: transform 0.3s ease;
        }

        .navbar-brand .brand-link:hover {
            transform: scale(1.05);
        }

        .navbar-links {
            display: flex;
            gap: 2rem;
            margin-left: 2rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link svg {
            width: 20px;
            height: 20px;
        }

        .nav-link:hover {
            color: #2563eb;
        }

        .nav-link.active {
            color: #2563eb;
            font-weight: 600;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, #3b82f6, #1d4ed8);
            border-radius: 2px;
        }

        .navbar-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .login-button {
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            background: linear-gradient(to right, #3b82f6, #1d4ed8);
            background-size: 200% 200%;
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .login-button:hover {
            background: linear-gradient(to right, #2563eb, #1e40af);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            animation: button-pulse 1.5s infinite;
        }

        .user-display {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            color: #4b5563;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }

        .user-display:hover {
            color: #2563eb;
        }

        .profile-icon {
            width: 36px;
            height: 36px;
            color: #2563eb;
            transition: color 0.3s ease;
        }

        .user-display:hover .profile-icon {
            color: #1d4ed8;
        }

        /* Popup Profil yang Ditingkatkan */
        .profile-popup {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            padding: 1.25rem;
            width: 320px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 1000;
            border: none;
            backdrop-filter: blur(12px);
        }

        .profile-popup.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-popup::before {
            content: '';
            position: absolute;
            bottom: 100%;
            right: 20px;
            border: 10px solid transparent;
            border-bottom-color: rgba(255, 255, 255, 0.95);
            filter: drop-shadow(0 -2px 2px rgba(0, 0, 0, 0.05));
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .profile-icon-large {
            width: 56px;
            height: 56px;
            color: #2563eb;
            background: rgba(59, 130, 246, 0.1);
            padding: 8px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .profile-header:hover .profile-icon-large {
            transform: scale(1.1);
        }

        .profile-info h4 {
            margin: 0;
            font-size: 1.125rem;
            color: #111827;
            font-weight: 700;
        }

        .profile-info p {
            margin: 0.25rem 0 0;
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 400;
        }

        .logout-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(to right, #ef4444, #dc2626);
            background-size: 200% 200%;
            color: #ffffff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            border: none;
            animation: gradient 4s ease infinite;
        }

        .logout-button:hover {
            background: linear-gradient(to right, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
        }

        .logout-button svg {
            width: 20px;
            height: 20px;
        }

        /* Konten */
        .content-container {
            position: relative;
            min-height: calc(100vh - 64px);
            padding: 2rem;
        }

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
            pointer-events: none;
            z-index: -1;
        }


        /* Animasi */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(-20px);
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

        @keyframes button-pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
            }
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .navbar-container {
                flex-direction: column;
                align-items: stretch;
            }

            .navbar-links {
                margin: 1rem 0;
                justify-content: center;
                gap: 1rem;
            }

            .navbar-brand .brand-link {
                font-size: 1.5rem;
                text-align: center;
                display: block;
            }

            .login-button {
                padding: 0.4rem 1.2rem;
                font-size: 0.9rem;
            }

            .navbar-menu {
                gap: 1rem;
                justify-content: center;
            }

            .profile-popup {
                width: 280px;
                right: -10px;
                padding: 1rem;
            }

            .profile-icon-large {
                width: 48px;
                height: 48px;
            }

            .content-container {
                padding: 1rem;
            }

            .booking-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userProfile = document.getElementById('userProfile');
            const profilePopup = document.getElementById('profilePopup');

            if (userProfile) {
                userProfile.addEventListener('click', function (e) {
                    e.stopPropagation();
                    profilePopup.classList.toggle('show');
                });

                document.addEventListener('click', function () {
                    profilePopup.classList.remove('show');
                });

                profilePopup.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            }

            // Highlight active nav link
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