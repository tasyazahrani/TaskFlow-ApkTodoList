<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Aplikasi Web Todolist Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="container">
            <div class="logo">TaskFlow</div>
            <ul class="nav-links">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#features">Fitur</a></li>
                <li><a href="#tech">Teknologi</a></li>
                <li><a href="#developer">Developer</a></li>
                <li><a href="#demo">Demo</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>TaskFlow</h1>
                <p>Aplikasi web todolist modern yang dibangun dengan Laravel Framework</p>
                <div>
                    <span class="tech-badge">🔥 Laravel 10</span>
                    <span class="tech-badge">🎨 Bootstrap 5</span>
                    <span class="tech-badge">🗄️ MySQL</span>
                </div>
                <a href="#features" class="cta-button">Jelajahi Fitur</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <h2 class="section-title">Fitur Unggulan</h2>
            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon">📋</div>
                    <h3>CRUD Task Management</h3>
                    <p>Sistem manajemen tugas lengkap dengan fitur Create, Read, Update, Delete yang dibangun menggunakan Laravel Eloquent ORM untuk performa database yang optimal.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">🔐</div>
                    <h3>Authentication & Authorization</h3>
                    <p>Sistem keamanan terintegrasi menggunakan Laravel Auth dengan fitur login, register, dan middleware protection untuk mengamankan data pengguna.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">📊</div>
                    <h3>Real-time Dashboard</h3>
                    <p>Dashboard interaktif dengan grafik dan statistik produktivitas menggunakan Chart.js yang terintegrasi dengan backend Laravel melalui API endpoints.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">📱</div>
                    <h3>Responsive Design</h3>
                    <p>Interface yang responsif dan mobile-friendly menggunakan Bootstrap 5 dan Blade templating engine untuk tampilan yang konsisten di semua perangkat.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">🔄</div>
                    <h3>Database Migration</h3>
                    <p>Struktur database yang terorganisir dengan Laravel Migration dan Seeder untuk memudahkan deployment dan maintenance aplikasi.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">⚡</div>
                    <h3>Optimized Performance</h3>
                    <p>Performa tinggi dengan implementasi caching, lazy loading, dan query optimization menggunakan Laravel best practices.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack Section -->
    <section id="tech" class="tech-stack">
        <div class="container">
            <h2 class="section-title">Teknologi yang Digunakan</h2>
            <div class="tech-grid">
                <div class="tech-item">
                    <h4>🔥 Laravel 10</h4>
                    <p>Framework PHP modern dengan arsitektur MVC, Eloquent ORM, dan Artisan CLI untuk pengembangan yang efisien</p>
                </div>
                <div class="tech-item">
                    <h4>🗄️ MySQL Database</h4>
                    <p>Database relasional yang robust dengan optimasi query dan indexing untuk performa aplikasi yang maksimal</p>
                </div>
                <div class="tech-item">
                    <h4>🎨 Bootstrap 5</h4>
                    <p>CSS framework untuk desain responsif dengan komponen UI yang modern dan konsisten</p>
                </div>
                <div class="tech-item">
                    <h4>🚀 Composer & NPM</h4>
                    <p>Package management untuk dependency PHP dan JavaScript dengan auto-loading optimization</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Developer Section -->
    <section id="developer" class="developer">
        <div class="container">
            <h2 class="section-title">Tentang Developer</h2>
            <div class="developer-content">
                <div class="developer-image">
                    <div class="profile-photo">
                        <img src="/images/image.png" alt="Foto Tasya Zahrani">
                    </div>
                </div>
                <div class="developer-info">
                    <h2>Tasya Zahrani</h2>
                    <h3>Full-Stack Laravel Developer & Web Designer</h3>
                    <p>Seorang web developer yang berspesialisasi dalam pengembangan aplikasi web menggunakan Laravel framework. Berpengalaman dalam membangun aplikasi full-stack dengan arsitektur MVC yang scalable dan maintainable.</p>
                    <p>Menguasai teknologi modern seperti Laravel, Vue.js, MySQL, dan best practices dalam web development. Berkomitmen untuk menghasilkan kode yang clean, documented, dan mengikuti standar industri.</p>
                    <p><strong>Keahlian:</strong> Laravel • PHP • MySQL • JavaScript • Bootstrap • Git • RESTful API • Database Design</p>
                    <div class="social-links">
                        <a href="#" class="social-link">📧</a>
                        <a href="#" class="social-link">💼</a>
                        <a href="#" class="social-link">🐙</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="demo" class="cta-section">
        <div class="container">
            <h2>Siap Mencoba TaskFlow?</h2>
            <p>Akses demo aplikasi web TaskFlow yang dibangun dengan Laravel dan rasakan pengalaman produktivitas terdepan!</p>
            <div class="download-buttons">
                <a href="{{ route('register') }}" class="download-btn">🌐 Live Demo</a>
                <a href="#" class="download-btn">📂 Source Code</a>
                <a href="#" class="download-btn">📖 Documentation</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 TaskFlow Laravel Web Application by Tasya Zahrani. Built with ❤️ using Laravel Framework.</p>
        </div>
    </footer>

    <script src="{{ asset('js/landingpage.js') }}"></script>
</body>
</html>
