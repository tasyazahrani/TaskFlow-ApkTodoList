@extends('layouts.app') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Dashboard') <!-- Mengatur judul halaman Dashboard -->

@section('content')
    <!-- Konten Dashboard -->
    <div class="header">
        <div class="welcome-text">
            <h1>Selamat Datang! 👋</h1>
            <p>Hari ini adalah hari yang tepat untuk menyelesaikan tugas-tugas penting Anda</p>
        </div>
        <div class="header-stats">
            <div class="stat-card">
                <div class="stat-number" id="totalTasks">12</div>
                <div class="stat-label">Total Tugas</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="completedTasks">7</div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="pendingTasks">5</div>
                <div class="stat-label">Menunggu</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2 class="section-title">
            <span class="section-title-icon">⚡</span>
            Aksi Cepat
        </h2>
        <div class="action-buttons">
            <button class="action-btn" onclick="openModal('taskModal')">
                ➕ Tambah Tugas Baru
            </button>
            <button class="action-btn" onclick="filterTasks('today')">
                📅 Tugas Hari Ini
            </button>
            <button class="action-btn" onclick="filterTasks('high')">
                🔥 Prioritas Tinggi
            </button>
            <button class="action-btn" onclick="showProgress()">
                📊 Lihat Laporan
            </button>
        </div>
    </div>

    <!-- Tasks and Progress Section -->
    <div class="tasks-section">
        <!-- Tasks Container -->
        <div class="tasks-container">
            <h2 class="section-title" style="color: #333;">
                <span class="section-title-icon">📋</span>
                Daftar Tugas
            </h2>

            <div class="task-filters">
                <button class="filter-btn active" onclick="filterTasks('all')">Semua</button>
                <button class="filter-btn" onclick="filterTasks('high')">Prioritas Tinggi</button>
                <button class="filter-btn" onclick="filterTasks('medium')">Prioritas Sedang</button>
                <button class="filter-btn" onclick="filterTasks('low')">Prioritas Rendah</button>
                <button class="filter-btn" onclick="filterTasks('today')">Deadline Hari Ini</button>
            </div>

            <div class="tasks-list" id="tasksList">
                <!-- Tasks will be populated by JavaScript -->
            </div>
        </div>

        <!-- Progress Container -->
        <div class="progress-container">
            <h2 class="section-title" style="color: #333;">
                <span class="section-title-icon">📈</span>
                Kemajuan
            </h2>

            <div class="progress-overview">
                <div class="circular-progress" id="circularProgress">
                    <div class="progress-percentage" id="progressPercentage">58%</div>
                </div>
                <div class="progress-stats">
                    <div class="progress-stat">
                        <div class="progress-stat-number" id="completedCount">7</div>
                        <div class="progress-stat-label">Selesai</div>
                    </div>
                    <div class="progress-stat">
                        <div class="progress-stat-number" id="totalCount">12</div>
                        <div class="progress-stat-label">Total</div>
                    </div>
                </div>
            </div>

            <div class="notifications">
                <h3 style="color: #333; margin-bottom: 1rem;">🔔 Pengingat</h3>
                <div class="notification-item">
                    <div class="notification-icon">⏰</div>
                    <div class="notification-content">
                        <div class="notification-title">Deadline Tugas Akhir</div>
                        <div class="notification-time">2 jam lagi</div>
                    </div>
                </div>
                <div class="notification-item">
                    <div class="notification-icon">📝</div>
                    <div class="notification-content">
                        <div class="notification-title">Review Laporan</div>
                        <div class="notification-time">Besok pagi</div>
                    </div>
                </div>
                <div class="notification-item">
                    <div class="notification-icon">📞</div>
                    <div class="notification-content">
                        <div class="notification-title">Meeting dengan Dosen</div>
                        <div class="notification-time">3 hari lagi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
