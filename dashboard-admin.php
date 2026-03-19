<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMP IBNU AQIL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard-style.css">
</head>

<body>
    <!-- Navbar Dashboard -->
    <nav class="dashboard-navbar">
        <div class="nav-container">
            <div class="logo">
                <img src="Screenshot_2026-02-22-13-16-05-58_1c337646f29875672b5a61192b9010f9.png" alt="Logo"
                    class="logo-img">
                ADMIN PANEL
            </div>
            <div class="user-menu">
                <span class="user-name" id="userName"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <span class="user-role admin">Admin</span>
                <button onclick="window.location.href='menanyakan logout.php'" class="logout-btn">Logout</button>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-menu">
                <a href="#" class="menu-item active" onclick="showTab('overview')">
                    <span class="icon">📊</span>
                    <span>Overview</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('content')">
                    <span class="icon">📝</span>
                    <span>Kelola Konten</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('students')">
                    <span class="icon">👨‍🎓</span>
                    <span>Data Siswa</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('announcements')">
                    <span class="icon">📢</span>
                    <span>Pengumuman</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('profile')">
                    <span class="icon">👤</span>
                    <span>Profil Saya</span>
                </a>
                <hr style="margin: 1rem 0; border: none; border-top: 1px solid #e5e7eb;">
                <a href="index.php" class="menu-item">
                    <span class="icon">🌐</span>
                    <span>Lihat Website</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-content">
            <!-- Overview Tab -->
            <div id="overview" class="tab-content active">
                <div class="page-header">
                    <h1>Dashboard Overview</h1>
                    <p>Selamat datang di panel Admin</p>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card green">
                        <div class="stat-icon">👨‍🎓</div>
                        <div class="stat-info">
                            <h3>1,250</h3>
                            <p>Total Siswa</p>
                        </div>
                    </div>
                    <div class="stat-card blue">
                        <div class="stat-icon">👨‍🏫</div>
                        <div class="stat-info">
                            <h3>75</h3>
                            <p>Total Guru</p>
                        </div>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-icon">📚</div>
                        <div class="stat-info">
                            <h3>12</h3>
                            <p>Kelas Aktif</p>
                        </div>
                    </div>
                    <div class="stat-card purple">
                        <div class="stat-icon">🏆</div>
                        <div class="stat-info">
                            <h3>150</h3>
                            <p>Total Prestasi</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="section-card">
                    <h2>Quick Actions</h2>
                    <div class="action-grid">
                        <button class="action-btn" onclick="showTab('content')">
                            <span class="icon">📝</span>
                            Edit Konten Website
                        </button>
                        <button class="action-btn" onclick="showTab('students')">
                            <span class="icon">👨‍🎓</span>
                            Kelola Data Siswa
                        </button>
                        <button class="action-btn" onclick="showTab('announcements')">
                            <span class="icon">📢</span>
                            Buat Pengumuman
                        </button>
                        <button class="action-btn" onclick="showTab('profile')">
                            <span class="icon">👤</span>
                            Edit Profil
                        </button>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="section-card">
                    <h2>Aktivitas Terbaru</h2>
                    <div class="activity-list">
                        <div class="activity-item">
                            <span class="activity-icon green">✓</span>
                            <div class="activity-info">
                                <p>Anda mengedit halaman Fasilitas</p>
                                <span class="activity-time">2 jam yang lalu</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <span class="activity-icon blue">📝</span>
                            <div class="activity-info">
                                <p>Anda menambah pengumuman baru</p>
                                <span class="activity-time">5 jam yang lalu</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <span class="activity-icon orange">👨‍🎓</span>
                            <div class="activity-info">
                                <p>Anda mengupdate data siswa</p>
                                <span class="activity-time">1 hari yang lalu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Notice -->
                <div class="info-notice">
                    <strong>ℹ️ Informasi:</strong> Sebagai Admin, Anda memiliki akses untuk mengelola konten website,
                    data siswa, dan pengumuman. Untuk akses penuh ke pengaturan sistem, silakan hubungi Super Admin.
                </div>
            </div>

            <!-- Content Management Tab -->
            <div id="content" class="tab-content">
                <div class="page-header">
                    <h1>Kelola Konten</h1>
                    <p>Edit konten website sekolah</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3>📄 Profil Sekolah</h3>
                        <p>Edit informasi profil sekolah</p>
                        <button class="btn-primary">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>👁️ Visi & Misi</h3>
                        <p>Edit visi dan misi sekolah</p>
                        <button class="btn-primary">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>🏫 Fasilitas</h3>
                        <p>Kelola fasilitas sekolah</p>
                        <button class="btn-primary">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>⚽ Ekstrakulikuler</h3>
                        <p>Kelola ekstrakurikuler</p>
                        <button class="btn-primary">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>Lokasi</h3>
                        <p>Edit alamat dan peta</p>
                        <button class="btn-primary">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>Kontak</h3>
                        <p>Edit informasi kontak</p>
                        <button class="btn-primary">Edit</button>
                    </div>
                </div>
            </div>

            <!-- Students Management Tab -->
            <div id="students" class="tab-content">
                <div class="page-header">
                    <h1>Data Siswa</h1>
                    <button class="btn-primary">➕ Tambah Siswa</button>
                </div>

                <div class="section-card">
                    <h2>Daftar Siswa</h2>
                    <div class="filter-bar">
                        <select class="form-control" style="width: 200px;">
                            <option>Semua Kelas</option>
                            <option>Kelas X</option>
                            <option>Kelas XI</option>
                            <option>Kelas XII</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Cari siswa..." style="width: 300px;">
                    </div>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>Ahmad Rizki</td>
                                    <td>XII IPA 1</td>
                                    <td>Laki-laki</td>
                                    <td><span class="badge active">Aktif</span></td>
                                    <td>
                                        <button class="btn-small btn-view">Lihat</button>
                                        <button class="btn-small btn-edit">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>002</td>
                                    <td>Siti Nurhaliza</td>
                                    <td>XII IPA 1</td>
                                    <td>Perempuan</td>
                                    <td><span class="badge active">Aktif</span></td>
                                    <td>
                                        <button class="btn-small btn-view">Lihat</button>
                                        <button class="btn-small btn-edit">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>003</td>
                                    <td>Budi Santoso</td>
                                    <td>XII IPS 2</td>
                                    <td>Laki-laki</td>
                                    <td><span class="badge active">Aktif</span></td>
                                    <td>
                                        <button class="btn-small btn-view">Lihat</button>
                                        <button class="btn-small btn-edit">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Announcements Tab -->
            <div id="announcements" class="tab-content">
                <div class="page-header">
                    <h1>Pengumuman</h1>
                    <button class="btn-primary" onclick="createAnnouncement()">➕ Buat Pengumuman</button>
                </div>

                <div class="announcements-list">
                    <div class="announcement-card">
                        <div class="announcement-header">
                            <h3>Libur Semester Genap 2024</h3>
                            <span class="announcement-date">01 Feb 2024</span>
                        </div>
                        <p>Libur semester genap akan dimulai pada tanggal 15 Februari 2024 hingga 1 Maret 2024. Semua
                            siswa diharapkan menggunakan waktu libur dengan baik.</p>
                        <div class="announcement-actions">
                            <button class="btn-small btn-edit">Edit</button>
                            <button class="btn-small btn-delete">Hapus</button>
                        </div>
                    </div>

                    <div class="announcement-card">
                        <div class="announcement-header">
                            <h3>Pendaftaran Ekstrakurikuler</h3>
                            <span class="announcement-date">28 Jan 2024</span>
                        </div>
                        <p>Pendaftaran ekstrakurikuler untuk semester baru akan dibuka pada tanggal 5-10 Februari 2024.
                            Silakan mendaftar melalui portal siswa.</p>
                        <div class="announcement-actions">
                            <button class="btn-small btn-edit">Edit</button>
                            <button class="btn-small btn-delete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Tab -->
            <div id="profile" class="tab-content">
                <div class="page-header">
                    <h1>Profil Saya</h1>
                    <p>Kelola informasi akun Anda</p>
                </div>

                <div class="section-card">
                    <h2>Informasi Pribadi</h2>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" value="admin" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" value="Administrator">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="admin@sekolahkita.sch.id">
                    </div>
                    <button class="btn-primary">Simpan Perubahan</button>
                </div>

                <div class="section-card" style="margin-top: 2rem;">
                    <h2>Ubah Password</h2>
                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" class="form-control" placeholder="Masukkan password lama">
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" placeholder="Masukkan password baru">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" placeholder="Konfirmasi password baru">
                    </div>
                    <button class="btn-primary">Ubah Password</button>
                </div>
            </div>
        </main>
    </div>

    <!-- <script src="auth.js"></script> -->
    <script src="dashboard.js"></script>
    <script>
        // Require admin access
        // requireRole('admin');

        // const user = getCurrentUser();
        // if (user) {
        //     document.getElementById('userName').textContent = user.name;
        // }
    </script>
</body>

</html>