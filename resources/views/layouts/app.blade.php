<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TaskFlow Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo-section">
                <div class="logo">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                </div>
                <div class="app-name">TaskFlow</div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link active">
                        <span class="nav-icon">🏠</span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/tugas" class="nav-link">
                        <span class="nav-icon">📝</span>
                        Tugas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/notifikasi" class="nav-link">
                        <span class="nav-icon">⭐</span>
                        Pengingat
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/laporan" class="nav-link">
                        <span class="nav-icon">📊</span>
                        Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengaturan" class="nav-link">
                        <span class="nav-icon">⚙️</span>
                        Pengaturan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/landingpage" class="nav-link">
                        <span class="nav-icon">🚪</span>
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content') <!-- Bagian konten yang akan diisi oleh halaman lain -->
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
