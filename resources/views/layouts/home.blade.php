<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Tutor')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f5f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1rem 2rem;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e40af;
            background: linear-gradient(to right, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            font-size: 0.9rem;
            font-weight: 500;
            color: #4b5563;
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-link.active {
            color: #1e40af;
            font-weight: 600;
        }

        .nav-link:hover {
            color: #1e40af;
        }

        .login-button {
            background: linear-gradient(to right, #3b82f6, #1e40af);
            color: #ffffff;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s, transform 0.1s;
        }

        .login-button:hover {
            background: linear-gradient(to right, #2563eb, #1e3a8a);
            transform: translateY(-1px);
        }

        .hamburger {
            display: none;
            font-size: 1.5rem;
            color: #4b5563;
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding-top: 80px;
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            background: black;
            padding: 2rem 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-title {
            font-size: 4rem;
            font-weight: 700;
            color: #1e40af;
            background: linear-gradient(to right, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .footer-copyright {
            font-size: 0.9rem;
            color: white;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
                position: absolute;
                top: 80px;
                left: 0;
                right: 0;
                background: #ffffff;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .nav-menu.active {
                display: flex;
            }

            .hamburger {
                display: block;
            }

            .login-button {
                width: 100%;
                text-align: center;
                padding: 0.75rem;
            }

            .footer-title {
                font-size: 1.25rem;
            }

            .footer-copyright {
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="header-container">
            <a href="/" class="logo">Smart Tutor</a>
            <nav class="nav-menu" id="nav-menu">
                <a href="/" class="nav-link" id="home-link">Home</a>
                <a href="/login" class="login-button">Login</a>
            </nav>
            <div class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
            <h2 class="footer-title">Smart Tutor</h2>
            <p class="footer-copyright">&copy; {{ date('Y') }} Smart Tutor. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburger');
            const navMenu = document.getElementById('nav-menu');
            const homeLink = document.getElementById('home-link');

            if (window.location.pathname === '/') {
                homeLink.classList.add('active');
            }

            hamburger.addEventListener('click', () => {
                navMenu.classList.toggle('active');
                hamburger.querySelector('i').classList.toggle('fa-bars');
                hamburger.querySelector('i').classList.toggle('fa-times');
            });
        });
    </script>
</body>

</html>