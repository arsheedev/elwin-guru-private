<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background: #ffffff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding: 1rem 0;
        }

        .sidebar-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .user-info {
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .user-info .user-name {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar-nav {
            flex-grow: 1;
            padding: 1rem 0;
        }

        .sidebar-nav a {
            display: block;
            padding: 0.75rem 1.5rem;
            color: #4b5563;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .sidebar-nav a:hover {
            background: #f3f4f6;
            color: #1f2937;
        }

        .sidebar-nav a.active {
            background: #3b82f6;
            color: #ffffff;
        }

        .logout-form {
            padding: 1rem 1.5rem;
        }

        .logout-button {
            width: 100%;
            background: #dc2626;
            color: #ffffff;
            padding: 0.75rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background: #b91c1c;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hamburger {
            display: none;
            font-size: 1.5rem;
            background: none;
            border: none;
            color: #1f2937;
            padding: 0.5rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .hamburger {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1000;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
            }

            .main-content {
                padding: 1rem;
            }

            .sidebar-header h3 {
                font-size: 1.1rem;
            }

            .sidebar-nav a {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }

            .logout-button {
                font-size: 0.9rem;
                padding: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <button class="hamburger" onclick="toggleSidebar()">☰</button>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <div class="user-info">
            <span class="user-name">{{ auth()->user()->name }}</span>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.users.index') }}"
                class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Users</a>
            <a href="{{ route('admin.subjects.index') }}"
                class="{{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">Subjects</a>
        </nav>
        <form class="logout-form" action="{{ route('logout') }}" method="GET">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>

</html>