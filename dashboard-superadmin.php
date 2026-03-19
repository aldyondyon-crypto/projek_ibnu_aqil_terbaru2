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

require_once 'koneksi.php';

// Handle hapus pesan
if (isset($_GET['hapus_pesan']) && is_numeric($_GET['hapus_pesan'])) {
    $id_hapus = intval($_GET['hapus_pesan']);
    $stmt = mysqli_prepare($KONEKSI, "DELETE FROM pesan WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_hapus);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: dashboard-superadmin.php?tab=messages&notif=hapus_berhasil");
    exit();
}

// Ambil semua pesan dari database
$result_pesan = mysqli_query($KONEKSI, "SELECT * FROM pesan ORDER BY id DESC");
$daftar_pesan = [];
while ($row = mysqli_fetch_assoc($result_pesan)) {
    $daftar_pesan[] = $row;
}
$total_pesan = count($daftar_pesan);

// Ambil total berita
$res_total_berita = mysqli_query($KONEKSI, "SELECT COUNT(*) as total FROM berita");
$total_berita = 0;
if ($res_total_berita) {
    $r = mysqli_fetch_assoc($res_total_berita);
    $total_berita = $r['total'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - Website Sekolah</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard-style.css">
</head>

<body>
    <!-- Navbar Dashboard -->
    <nav class="dashboard-navbar">
        <div class="nav-container">
            <div class="logo" style="display: flex; align-items: center; gap: 12px; font-weight: bold; color: white;">
                <img src="Screenshot_2026-02-22-13-16-05-58_1c337646f29875672b5a61192b9010f9.png" alt="Logo"
                    style="height: 40px; width: auto; object-fit: contain; border-radius: 4px;">
                SUPER ADMIN PANEL
            </div>
            <div class="user-menu">
                <span class="user-name" id="userName">
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </span>
                <span class="user-role super-admin">SMP IBNU AQIL</span>
                <button onclick="window.location.href='menanyakan logout.php'" class="logout-btn">Logout</button>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-menu">
                <a href="#" class="menu-item active" onclick="showTab('overview')">
                    <span class="icon"></span>
                    <span>Overview</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('users')">
                    <span class="icon"></span>
                    <span>Kelola User</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('content')">
                    <span class="icon"></span>
                    <span>Kelola Konten</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('berita')">
                    <span class="icon">📰</span>
                    <span>Kelola Berita</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('messages')">
                    <span class="icon"></span>
                    <span>Pesan Masuk</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('settings')">
                    <span class="icon"></span>
                    <span>Pengaturan</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('logs')">
                    <span class="icon"></span>
                    <span>Activity Logs</span>
                </a>
                <a href="#" class="menu-item" onclick="showTab('backup')">
                    <span class="icon"></span>
                    <span>Backup & Restore</span>
                </a>
                <hr style="margin: 1rem 0; border: none; border-top: 1px solid #e5e7eb;">
                <a href="index.php" class="menu-item">
                    <span class="icon"></span>
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
                    <p>Selamat datang di panel Super Admin</p>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card green">
                        <div class="stat-icon"></div>
                        <div class="stat-info">
                            <h3>1,250</h3>
                            <p>Total Siswa</p>
                        </div>
                    </div>
                    <div class="stat-card blue">
                        <div class="stat-icon"></div>
                        <div class="stat-info">
                            <h3>75</h3>
                            <p>Total Guru</p>
                        </div>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-icon"></div>
                        <div class="stat-info">
                            <h3>2</h3>
                            <p>Total Admin</p>
                        </div>
                    </div>
                    <div class="stat-card purple">
                        <div class="stat-icon"></div>
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
                        <button class="action-btn" onclick="showTab('users')">
                            <span class="icon"></span>
                            Tambah User Baru
                        </button>
                        <button class="action-btn" onclick="showTab('content')">
                            <span class="icon"></span>
                            Edit Konten Website
                        </button>
                        <button class="action-btn" onclick="showTab('backup')">
                            <span class="icon"></span>
                            Backup Database
                        </button>
                        <button class="action-btn" onclick="showTab('logs')">
                            <span class="icon"></span>
                            Lihat Activity Logs
                        </button>
                        <button class="action-btn" onclick="showTab('messages')">
                            <span class="icon"></span>
                            Lihat Pesan Masuk
                        </button>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="section-card">
                    <h2>Recent Activity</h2>
                    <div class="activity-list">
                        <div class="activity-item">
                            <span class="activity-icon green"></span>
                            <div class="activity-info">
                                <p><strong>Admin</strong> mengedit halaman Fasilitas</p>
                                <span class="activity-time">2 jam yang lalu</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <span class="activity-icon blue"></span>
                            <div class="activity-info">
                                <p><strong>Super Admin</strong> menambah user baru</p>
                                <span class="activity-time">5 jam yang lalu</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <span class="activity-icon orange"></span>
                            <div class="activity-info">
                                <p><strong>System</strong> backup otomatis berhasil</p>
                                <span class="activity-time">1 hari yang lalu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Management Tab -->
            <div id="users" class="tab-content">
                <div class="page-header">
                    <h1>Kelola User</h1>
                    <button class="btn-primary" onclick="openAddUserModal()">Tambah User</button>
                </div>

                <div class="section-card">
                    <h2>Daftar User</h2>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>superadmin</td>
                                    <td>Super Administrator</td>
                                    <td>superadmin@sekolahkita.sch.id</td>
                                    <td><span class="badge super-admin">Super Admin</span></td>
                                    <td><span class="badge active">Aktif</span></td>
                                    <td>
                                        <button class="btn-small btn-edit">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>admin</td>
                                    <td>Administrator</td>
                                    <td>admin@sekolahkita.sch.id</td>
                                    <td><span class="badge admin">Admin</span></td>
                                    <td><span class="badge active">Aktif</span></td>
                                    <td>
                                        <button class="btn-small btn-edit">Edit</button>
                                        <button class="btn-small btn-delete">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                        <h3>Profil Sekolah</h3>
                        <p>Edit informasi profil sekolah</p>
                        <button class="btn-primary" onclick="openProfilModal()">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>Visi & Misi</h3>
                        <p>Edit visi dan misi sekolah</p>
                        <button class="btn-primary" onclick="openVisiMisiModal()">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>Fasilitas</h3>
                        <p>Kelola fasilitas sekolah</p>
                        <button class="btn-primary" onclick="openFasilitasModal()">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>Ekstrakulikuler</h3>
                        <p>Kelola ekstrakurikuler</p>
                        <button class="btn-primary" onclick="openEkskulModal()">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>Lokasi</h3>
                        <p>Edit alamat dan peta</p>
                        <button class="btn-primary" onclick="openLokasiModal()">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>Kontak</h3>
                        <p>Edit informasi kontak</p>
                        <button class="btn-primary" onclick="openKontakModal()">Edit</button>
                    </div>
                    <div class="content-card">
                        <h3>Berita Sekolah</h3>
                        <p>Kelola berita dan update artikel</p>
                        <button class="btn-primary" onclick="openBeritaModal()">Edit Berita</button>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div id="settings" class="tab-content">
                <div class="page-header">
                    <h1>Pengaturan</h1>
                    <p>Konfigurasi sistem</p>
                </div>

                <div class="section-card">
                    <h2>Pengaturan Website</h2>
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" class="form-control" value="SMA NEGERI PRESTASI">
                    </div>
                    <div class="form-group">
                        <label>Email Sekolah</label>
                        <input type="email" class="form-control" value="info@sekolahkita.sch.id">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control" value="021-1234-5678">
                    </div>
                    <button class="btn-primary">Simpan Perubahan</button>
                </div>

                <div class="section-card" style="margin-top: 2rem;">
                    <h2>Pengaturan Keamanan</h2>
                    <div class="settings-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <div>
                            <strong>Two-Factor Authentication</strong>
                            <p>Aktifkan autentikasi dua faktor</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Activity Logs Tab -->
            <div id="logs" class="tab-content">
                <div class="page-header">
                    <h1>Activity Logs</h1>
                    <p>Riwayat aktivitas sistem</p>
                </div>

                <div class="section-card">
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>User</th>
                                    <th>Aktivitas</th>
                                    <th>IP Address</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>04/02/2024 14:30</td>
                                    <td>superadmin</td>
                                    <td>Login ke sistem</td>
                                    <td>192.168.1.1</td>
                                    <td><span class="badge success">Success</span></td>
                                </tr>
                                <tr>
                                    <td>04/02/2024 12:15</td>
                                    <td>admin</td>
                                    <td>Edit halaman Fasilitas</td>
                                    <td>192.168.1.2</td>
                                    <td><span class="badge success">Success</span></td>
                                </tr>
                                <tr>
                                    <td>04/02/2024 09:00</td>
                                    <td>system</td>
                                    <td>Backup otomatis</td>
                                    <td>127.0.0.1</td>
                                    <td><span class="badge success">Success</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Backup Tab -->
            <div id="backup" class="tab-content">
                <div class="page-header">
                    <h1>Backup & Restore</h1>
                    <button class="btn-primary" onclick="createBackup()">Buat Backup Sekarang</button>
                </div>

                <div class="section-card">
                    <h2>Riwayat Backup</h2>
                    <div class="backup-list">
                        <div class="backup-item">
                            <div class="backup-info">
                                <strong>backup-2024-02-04.sql</strong>
                                <p>Database backup - 15.2 MB</p>
                                <span class="backup-date">04 Februari 2024, 00:00</span>
                            </div>
                            <div class="backup-actions">
                                <button class="btn-small btn-download">Download</button>
                                <button class="btn-small btn-restore">Restore</button>
                            </div>
                        </div>
                        <div class="backup-item">
                            <div class="backup-info">
                                <strong>backup-2024-02-03.sql</strong>
                                <p>Database backup - 15.1 MB</p>
                                <span class="backup-date">03 Februari 2024, 00:00</span>
                            </div>
                            <div class="backup-actions">
                                <button class="btn-small btn-download">Download</button>
                                <button class="btn-small btn-restore">Restore</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-card" style="margin-top: 2rem;">
                    <h2>Pengaturan Backup Otomatis</h2>
                    <div class="settings-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <div>
                            <strong>Backup Otomatis</strong>
                            <p>Backup database setiap hari pada pukul 00:00</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===================== KELOLA BERITA TAB ===================== -->
            <div id="berita" class="tab-content">
                <div class="page-header">
                    <h1>📰 Kelola Berita</h1>
                    <button class="btn-primary" onclick="bukaFormBerita('tambah')" id="btnTambahBerita">+ Tambah Berita</button>
                </div>

                <!-- Notifikasi -->
                <div id="beritaNotif" style="display:none;padding:1rem 1.5rem;border-radius:10px;margin-bottom:1.5rem;border:1px solid;display:flex;align-items:center;gap:.75rem;"></div>

                <!-- Form Tambah/Edit Berita -->
                <div id="formBeritaWrap" style="display:none;">
                    <div class="section-card" style="border-left:4px solid #10b981;">
                        <h2 id="formBeritaTitle" style="margin-bottom:1.5rem;">Tambah Berita Baru</h2>
                        <form id="formBerita" enctype="multipart/form-data">
                            <input type="hidden" id="beritaId" value="">
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
                                <div class="form-group" style="grid-column:1/-1;">
                                    <label style="font-weight:600;display:block;margin-bottom:.5rem;">Judul Berita <span style="color:red;">*</span></label>
                                    <input type="text" id="beritaJudul" class="form-control" placeholder="Judul berita..." required style="width:100%;padding:.75rem 1rem;border:1.5px solid #d1d5db;border-radius:8px;font-size:1rem;">
                                </div>
                                <div class="form-group">
                                    <label style="font-weight:600;display:block;margin-bottom:.5rem;">Kategori <span style="color:red;">*</span></label>
                                    <select id="beritaKategori" class="form-control" required style="width:100%;padding:.75rem 1rem;border:1.5px solid #d1d5db;border-radius:8px;font-size:1rem;background:#fff;">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="pengumuman">Pengumuman</option>
                                        <option value="prestasi">Prestasi</option>
                                        <option value="pilihan utama">Pilihan Utama</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight:600;display:block;margin-bottom:.5rem;">Tanggal <span style="color:red;">*</span></label>
                                    <input type="date" id="beritaTanggal" class="form-control" required style="width:100%;padding:.75rem 1rem;border:1.5px solid #d1d5db;border-radius:8px;font-size:1rem;">
                                </div>
                                <div class="form-group" style="grid-column:1/-1;">
                                    <label style="font-weight:600;display:block;margin-bottom:.5rem;">Foto Berita</label>
                                    <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
                                        <input type="file" id="beritaFotoFile" accept="image/*" style="flex:1;padding:.6rem;border:1.5px dashed #d1d5db;border-radius:8px;" onchange="previewFoto(this)">
                                        <span style="color:#6b7280;font-size:.85rem;">atau</span>
                                        <input type="text" id="beritaFotoUrl" class="form-control" placeholder="Tempel URL gambar..." style="flex:2;padding:.75rem 1rem;border:1.5px solid #d1d5db;border-radius:8px;font-size:1rem;">
                                    </div>
                                    <div id="fotoPreviewWrap" style="margin-top:.75rem;display:none;">
                                        <img id="fotoPreview" src="" alt="Preview" style="max-height:160px;border-radius:10px;object-fit:cover;border:2px solid #e5e7eb;">
                                        <button type="button" onclick="hapusFotoPreview()" style="margin-left:.75rem;background:#ef4444;color:#fff;border:none;padding:.35rem .8rem;border-radius:6px;cursor:pointer;font-size:.85rem;">✕ Hapus</button>
                                    </div>
                                    <small style="color:#6b7280;margin-top:.4rem;display:block;">Format: JPG, PNG, WebP. Maks 3 MB. Atau tempel URL eksternal.</small>
                                </div>
                                <div class="form-group" style="grid-column:1/-1;">
                                    <label style="font-weight:600;display:block;margin-bottom:.5rem;">Deskripsi Singkat <span style="color:red;">*</span></label>
                                    <textarea id="beritaDeskripsi" class="form-control" rows="4" placeholder="Deskripsi singkat berita (maks 500 karakter)..." maxlength="500" required style="width:100%;padding:.75rem 1rem;border:1.5px solid #d1d5db;border-radius:8px;font-size:1rem;resize:vertical;"></textarea>
                                    <small id="charCount" style="color:#6b7280;">0 / 500 karakter</small>
                                </div>
                            </div>
                            <div style="display:flex;gap:1rem;margin-top:1.5rem;">
                                <button type="submit" class="btn-primary" id="btnSimpanBerita">💾 Simpan Berita</button>
                                <button type="button" class="btn-secondary" onclick="tutupFormBerita()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Berita -->
                <div class="section-card">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
                        <h2>Daftar Berita</h2>
                        <div style="display:flex;gap:.5rem;">
                            <select id="filterKategori" onchange="muatBerita()" style="padding:.5rem .75rem;border:1.5px solid #d1d5db;border-radius:8px;font-size:.9rem;">
                                <option value="">Semua Kategori</option>
                                <option value="pengumuman">Pengumuman</option>
                                <option value="prestasi">Prestasi</option>
                                <option value="pilihan utama">Pilihan Utama</option>
                            </select>
                            <button onclick="muatBerita()" style="padding:.5rem 1rem;background:#f3f4f6;border:1.5px solid #d1d5db;border-radius:8px;cursor:pointer;">🔄 Refresh</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabelBerita">
                                <tr><td colspan="7" style="text-align:center;padding:2rem;color:#9ca3af;">⏳ Memuat data...</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="beritaPagination" style="margin-top:1rem;display:flex;gap:.5rem;justify-content:flex-end;"></div>
                </div>
            </div>

            <!-- Modal Detail/Preview Berita -->
            <div id="modalDetailBerita" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100%;height:100%;overflow:auto;background:rgba(0,0,0,0.6);backdrop-filter:blur(4px);">
                <div style="background:#fff;margin:5% auto;border-radius:20px;width:90%;max-width:680px;box-shadow:0 25px 60px rgba(0,0,0,0.35);overflow:hidden;animation:fadeInModal .25s ease;">
                    <div style="position:relative;">
                        <img id="modalBeritaFoto" src="" alt="Foto Berita" style="width:100%;height:260px;object-fit:cover;display:block;">
                        <span onclick="document.getElementById('modalDetailBerita').style.display='none'" style="position:absolute;top:1rem;right:1rem;background:rgba(0,0,0,.5);color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;cursor:pointer;">&times;</span>
                        <div id="modalBeritaBadge" style="position:absolute;bottom:1rem;left:1rem;padding:.3rem .9rem;border-radius:50px;font-size:.8rem;font-weight:700;"></div>
                    </div>
                    <div style="padding:2rem;">
                        <div style="font-size:.85rem;color:#10b981;font-weight:600;margin-bottom:.5rem;">📅 <span id="modalBeritaTanggal"></span></div>
                        <h2 id="modalBeritaJudul" style="font-size:1.4rem;color:#1f2937;margin-bottom:1rem;line-height:1.4;"></h2>
                        <p id="modalBeritaDeskripsi" style="color:#4b5563;line-height:1.7;"></p>
                        <div style="margin-top:1.5rem;text-align:right;">
                            <button onclick="document.getElementById('modalDetailBerita').style.display='none'" style="background:linear-gradient(135deg,#10b981,#059669);color:#fff;border:none;padding:.7rem 1.8rem;border-radius:8px;font-size:1rem;font-weight:600;cursor:pointer;">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages Tab -->
            <div id="messages" class="tab-content">
                <div class="page-header">
                    <h1>Pesan Masuk</h1>
                    <p>Total <strong><?php echo $total_pesan; ?></strong> pesan dari pengunjung website</p>
                </div>

                <?php if (isset($_GET['notif']) && $_GET['notif'] === 'hapus_berhasil'): ?>
                <div style="background:#d1fae5;color:#065f46;padding:1rem 1.5rem;border-radius:10px;margin-bottom:1.5rem;border:1px solid #6ee7b7;display:flex;align-items:center;gap:.75rem;">
                    <span style="font-size:1.4rem;">✅</span> Pesan berhasil dihapus.
                </div>
                <?php endif; ?>

                <div class="section-card">
                    <h2>Daftar Pesan Pengunjung</h2>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengirim</th>
                                    <th>Email</th>
                                    <th>Subjek / Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($daftar_pesan)): ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;padding:2rem;color:#9ca3af;">
                                        📭 Belum ada pesan masuk.
                                    </td>
                                </tr>
                                <?php else: ?>
                                <?php $no = 1; foreach ($daftar_pesan as $pesan): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo htmlspecialchars($pesan['username']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($pesan['email']); ?></td>
                                    <td><?php echo htmlspecialchars($pesan['judul']); ?></td>
                                    <td style="display:flex;gap:6px;flex-wrap:wrap;">
                                        <button class="btn-small btn-view"
                                            onclick="lihatPesan(
                                                '<?php echo addslashes(htmlspecialchars($pesan['username'])); ?>',
                                                '<?php echo addslashes(htmlspecialchars($pesan['email'])); ?>',
                                                '<?php echo addslashes(htmlspecialchars($pesan['judul'])); ?>',
                                                '<?php echo addslashes(htmlspecialchars($pesan['deskripsi'])); ?>'
                                            )">
                                            👁️ Lihat Pesan
                                        </button>
                                        <a href="dashboard-superadmin.php?hapus_pesan=<?php echo $pesan['id']; ?>&tab=messages"
                                            onclick="return confirm('Yakin ingin menghapus pesan dari <?php echo addslashes(htmlspecialchars($pesan['username'])); ?>?')"
                                            class="btn-small btn-delete" style="text-decoration:none;display:inline-flex;align-items:center;">
                                            🗑️ Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Modal Profil Sekolah -->
    <div id="profilModal" class="modal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 5% auto; padding: 30px; border-radius: 12px; width: 80%; max-width: 700px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #1f2937;">Edit Profil Sekolah</h2>
                <span style="font-size: 28px; font-weight: bold; cursor: pointer; color: #9ca3af;"
                    onclick="closeModal('profilModal')">&times;</span>
            </div>
            <form onsubmit="event.preventDefault(); alert('Profil berhasil diperbarui!'); closeModal('profilModal');">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Nama Sekolah</label>
                        <input type="text" value="SMP IBNU AQIL"
                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">NPSN</label>
                        <input type="text" value="20231052"
                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Tahun Berdiri</label>
                        <input type="text" value="1992"
                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Akreditasi</label>
                        <input type="text" value="A (Amat Baik)"
                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Kepala Sekolah</label>
                        <input type="text" value="Ade Irawan"
                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Status Sekolah</label>
                        <input type="text" value="Swasta"
                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                    </div>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Tentang Kami</label>
                    <textarea
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; min-height: 150px; line-height: 1.6;"
                        required>Sekolah Ibnu Aqil Bogor adalah lembaga pendidikan yang mengintegrasikan pembelajaran akademik dengan nilai-nilai keislaman. Kami berkomitmen membentuk peserta didik yang berakhlak mulia, berilmu, dan berkarakter.&#10;&#10;Dengan dukungan tenaga pendidik profesional serta lingkungan belajar yang kondusif, Sekolah Ibnu Aqil menghadirkan pendidikan yang inspiratif untuk menyiapkan generasi yang siap menghadapi tantangan masa depan.</textarea>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn-primary" style="flex: 1;">Simpan Perubahan</button>
                    <button type="button" class="btn-secondary" style="flex: 1;"
                        onclick="closeModal('profilModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Visi & Misi -->
    <div id="visimisiModal" class="modal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 5% auto; padding: 30px; border-radius: 12px; width: 80%; max-width: 600px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #1f2937;">Edit Visi & Misi</h2>
                <span style="font-size: 28px; font-weight: bold; cursor: pointer; color: #9ca3af;"
                    onclick="closeModal('visimisiModal')">&times;</span>
            </div>
            <form
                onsubmit="event.preventDefault(); alert('Visi & Misi berhasil diperbarui!'); closeModal('visimisiModal');">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Visi</label>
                    <textarea
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; min-height: 80px;"
                        required>Mewujudkan generasi yang unggul dalam IPTEK dan kokoh dalam IMTAK.</textarea>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Misi</label>
                    <textarea
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; min-height: 120px;"
                        required>1. Menyelenggarakan pendidikan berkualitas...&#10;2. Membentuk karakter islami...&#10;3. Mengembangkan potensi bakat dan minat siswa...</textarea>
                </div>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Modal Fasilitas -->
    <div id="fasilitasModal" class="modal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 5% auto; padding: 30px; border-radius: 12px; width: 80%; max-width: 700px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #1f2937;">Kelola Fasilitas</h2>
                <span style="font-size: 28px; font-weight: bold; cursor: pointer; color: #9ca3af;"
                    onclick="closeModal('fasilitasModal')">&times;</span>
            </div>
            <button class="btn-primary" style="margin-bottom: 15px;" onclick="showAddFasilitasForm()">+ Tambah Fasilitas
                Baru</button>
            <div id="fasilitasForm"
                style="display: none; background: #f9fafb; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e5e7eb;">
                <h4 style="margin-bottom: 15px;">Tambah Fasilitas Baru</h4>
                <form
                    onsubmit="event.preventDefault(); alert('Fasilitas baru berhasil ditambahkan!'); hideFasilitasForm();">
                    <div style="margin-bottom: 10px;">
                        <label style="display: block; font-size: 14px; margin-bottom: 5px;">Nama Fasilitas</label>
                        <input type="text" placeholder="Contoh: Perpustakaan Modern"
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 14px; margin-bottom: 5px;">Deskripsi</label>
                        <textarea
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-height: 60px;"
                            required></textarea>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn-primary" style="padding: 8px 15px;">Simpan</button>
                        <button type="button" class="btn-secondary" style="padding: 8px 15px;"
                            onclick="hideFasilitasForm()">Batal</button>
                    </div>
                </form>
            </div>
            <div style="border-top: 1px solid #eee; padding-top: 15px;">
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 10px; background: #f9fafb; border-radius: 6px;">
                    <span>Ruang Kelas AC</span>
                    <button class="btn-small btn-edit"
                        style="background: #3b82f6; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Edit</button>
                </div>
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 10px; background: #f9fafb; border-radius: 6px;">
                    <span>Lab Komputer</span>
                    <button class="btn-small btn-edit"
                        style="background: #3b82f6; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ekstrakurikuler -->
    <div id="ekskulModal" class="modal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 5% auto; padding: 30px; border-radius: 12px; width: 80%; max-width: 700px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #1f2937;">Kelola Ekstrakurikuler</h2>
                <span style="font-size: 28px; font-weight: bold; cursor: pointer; color: #9ca3af;"
                    onclick="closeModal('ekskulModal')">&times;</span>
            </div>
            <button class="btn-primary" style="margin-bottom: 15px;" onclick="showAddEkskulForm()">+ Tambah Ekskul
                Baru</button>
            <div id="ekskulForm"
                style="display: none; background: #f9fafb; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e5e7eb;">
                <h4 style="margin-bottom: 15px;">Tambah Ekskul Baru</h4>
                <form
                    onsubmit="event.preventDefault(); alert('Ekstrakurikuler baru berhasil ditambahkan!'); hideEkskulForm();">
                    <div style="margin-bottom: 10px;">
                        <label style="display: block; font-size: 14px; margin-bottom: 5px;">Nama Ekskul</label>
                        <input type="text" placeholder="Contoh: Robotik"
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label style="display: block; font-size: 14px; margin-bottom: 5px;">Jadwal</label>
                        <input type="text" placeholder="Contoh: Sabtu, 09:00 - 11:00"
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 14px; margin-bottom: 5px;">Deskripsi</label>
                        <textarea
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-height: 60px;"
                            required></textarea>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn-primary" style="padding: 8px 15px;">Simpan</button>
                        <button type="button" class="btn-secondary" style="padding: 8px 15px;"
                            onclick="hideEkskulForm()">Batal</button>
                    </div>
                </form>
            </div>
            <div style="border-top: 1px solid #eee; padding-top: 15px;">
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 10px; background: #f9fafb; border-radius: 6px;">
                    <span>Sepak Bola</span>
                    <button class="btn-small btn-edit"
                        style="background: #3b82f6; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Edit</button>
                </div>
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 10px; background: #f9fafb; border-radius: 6px;">
                    <span>Memanah</span>
                    <button class="btn-small btn-edit"
                        style="background: #3b82f6; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lokasi -->
    <div id="lokasiModal" class="modal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 5% auto; padding: 30px; border-radius: 12px; width: 80%; max-width: 600px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #1f2937;">Edit Lokasi</h2>
                <span style="font-size: 28px; font-weight: bold; cursor: pointer; color: #9ca3af;"
                    onclick="closeModal('lokasiModal')">&times;</span>
            </div>
            <form onsubmit="event.preventDefault(); alert('Lokasi berhasil diperbarui!'); closeModal('lokasiModal');">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Alamat Lengkap</label>
                    <textarea
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; min-height: 80px;"
                        required>Jl. Pendidikan No. 45, Bogor, Jawa Barat</textarea>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Google Maps Embed URL</label>
                    <input type="text" value="https://www.google.com/maps/embed?..."
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                </div>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Modal Kontak -->
    <div id="kontakModal" class="modal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 5% auto; padding: 30px; border-radius: 12px; width: 80%; max-width: 600px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #1f2937;">Edit Kontak</h2>
                <span style="font-size: 28px; font-weight: bold; cursor: pointer; color: #9ca3af;"
                    onclick="closeModal('kontakModal')">&times;</span>
            </div>
            <form onsubmit="event.preventDefault(); alert('Kontak berhasil diperbarui!'); closeModal('kontakModal');">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Nomor Telepon</label>
                    <input type="text" value="021-1234-5678"
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Email Sekolah</label>
                    <input type="email" value="info@sekolahkita.sch.id"
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Instagram</label>
                    <input type="text" value="@smp_ibnu_aqil"
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    <!-- (Berita modal removed - now handled in full tab) -->

    <!-- Modal Lihat Pesan -->
    <div id="modalLihatPesan" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100%;height:100%;overflow:auto;background:rgba(0,0,0,0.55);backdrop-filter:blur(4px);">
        <div style="background:#fff;margin:6% auto;padding:2rem 2.5rem;border-radius:16px;width:90%;max-width:600px;box-shadow:0 20px 60px rgba(0,0,0,0.3);position:relative;animation:fadeInModal .25s ease;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;border-bottom:2px solid #f3f4f6;padding-bottom:1rem;">
                <h2 style="color:#1f2937;margin:0;font-size:1.3rem;">📩 Detail Pesan</h2>
                <span onclick="tutupModalPesan()" style="font-size:2rem;font-weight:bold;cursor:pointer;color:#9ca3af;line-height:1;">&times;</span>
            </div>
            <div style="display:grid;gap:1rem;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div style="background:#f9fafb;padding:1rem;border-radius:10px;border:1px solid #e5e7eb;">
                        <p style="font-size:0.75rem;color:#6b7280;margin:0 0 4px;">👤 Nama Pengirim</p>
                        <p id="modalNama" style="font-weight:700;color:#1f2937;margin:0;font-size:1rem;"></p>
                    </div>
                    <div style="background:#f9fafb;padding:1rem;border-radius:10px;border:1px solid #e5e7eb;">
                        <p style="font-size:0.75rem;color:#6b7280;margin:0 0 4px;">📧 Email</p>
                        <p id="modalEmail" style="font-weight:600;color:#2563eb;margin:0;font-size:0.9rem;word-break:break-all;"></p>
                    </div>
                </div>
                <div style="background:#f9fafb;padding:1rem;border-radius:10px;border:1px solid #e5e7eb;">
                    <p style="font-size:0.75rem;color:#6b7280;margin:0 0 4px;">📌 Subjek / Judul</p>
                    <p id="modalJudul" style="font-weight:700;color:#1f2937;margin:0;font-size:1rem;"></p>
                </div>
                <div style="background:#fffbeb;padding:1.25rem;border-radius:10px;border:1px solid #fcd34d;">
                    <p style="font-size:0.75rem;color:#92400e;margin:0 0 8px;font-weight:600;">💬 Isi Pesan</p>
                    <p id="modalDeskripsi" style="color:#1f2937;margin:0;line-height:1.7;white-space:pre-wrap;"></p>
                </div>
            </div>
            <div style="margin-top:1.5rem;text-align:right;">
                <button onclick="tutupModalPesan()" style="background:linear-gradient(135deg,#10b981,#059669);color:white;border:none;padding:.7rem 1.8rem;border-radius:8px;font-size:1rem;font-weight:600;cursor:pointer;">Tutup</button>
            </div>
        </div>
    </div>
    <style>
        @keyframes fadeInModal {
            from { opacity:0; transform:translateY(-20px); }
            to   { opacity:1; transform:translateY(0); }
        }
    </style>

    <script src="dashboard.js"></script>
    <script>
        // ======== MODAL HELPERS ========
        function openModal(id) { document.getElementById(id).style.display = 'block'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        function openProfilModal()    { openModal('profilModal'); }
        function openVisiMisiModal()  { openModal('visimisiModal'); }
        function openFasilitasModal() { openModal('fasilitasModal'); }
        function openEkskulModal()    { openModal('ekskulModal'); }
        function openLokasiModal()    { openModal('lokasiModal'); }
        function openKontakModal()    { openModal('kontakModal'); }
        function openBeritaModal()    { showTab('berita'); }

        function showAddFasilitasForm() { document.getElementById('fasilitasForm').style.display = 'block'; }
        function hideFasilitasForm()    { document.getElementById('fasilitasForm').style.display = 'none'; }
        function showAddEkskulForm()    { document.getElementById('ekskulForm').style.display = 'block'; }
        function hideEkskulForm()       { document.getElementById('ekskulForm').style.display = 'none'; }

        function lihatPesan(nama, email, judul, deskripsi) {
            document.getElementById('modalNama').textContent      = nama;
            document.getElementById('modalEmail').textContent     = email;
            document.getElementById('modalJudul').textContent     = judul;
            document.getElementById('modalDeskripsi').textContent  = deskripsi;
            document.getElementById('modalLihatPesan').style.display = 'block';
        }
        function tutupModalPesan() { document.getElementById('modalLihatPesan').style.display = 'none'; }

        window.onclick = function (event) {
            if (event.target.id === 'modalLihatPesan') tutupModalPesan();
            if (event.target.id === 'modalDetailBerita') event.target.style.display = 'none';
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
                if (event.target.id === 'fasilitasModal') hideFasilitasForm();
                if (event.target.id === 'ekskulModal') hideEkskulForm();
            }
        };

        // ======== BERITA CRUD ========
        let semuaBerita  = [];
        let halamanBerita = 1;
        const perHalaman  = 8;
        let uploadedFotoPath = '';

        async function muatBerita() {
            const tbody = document.getElementById('tabelBerita');
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:2rem;color:#9ca3af;">⏳ Memuat...</td></tr>';
            try {
                const res  = await fetch('berita-api.php?action=list');
                const json = await res.json();
                if (!json.success) throw new Error(json.message);
                const filter = document.getElementById('filterKategori').value;
                semuaBerita = filter ? json.data.filter(b => b.kategori === filter) : json.data;
                halamanBerita = 1;
                renderTabelBerita();
            } catch(e) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:2rem;color:#ef4444;">❌ Gagal memuat: ' + e.message + '</td></tr>';
            }
        }

        function renderTabelBerita() {
            const tbody = document.getElementById('tabelBerita');
            const start = (halamanBerita - 1) * perHalaman;
            const slice = semuaBerita.slice(start, start + perHalaman);

            if (semuaBerita.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:2rem;color:#9ca3af;">📭 Belum ada berita.</td></tr>';
                document.getElementById('beritaPagination').innerHTML = '';
                return;
            }

            const badgeColor = { pengumuman: '#3b82f6', prestasi: '#f59e0b', 'pilihan utama': '#10b981' };

            tbody.innerHTML = slice.map((b, i) => {
                const no    = start + i + 1;
                const foto  = b.foto ? `<img src="${escHtml(b.foto)}" onerror="this.src='https://via.placeholder.com/60x40?text=No+Img'" style="width:60px;height:40px;object-fit:cover;border-radius:6px;">` : '<span style="color:#d1d5db;">—</span>';
                const kat   = b.kategori;
                const bg    = badgeColor[kat] || '#6b7280';
                const badge = `<span style="background:${bg};color:#fff;padding:.2rem .6rem;border-radius:50px;font-size:.75rem;font-weight:700;">${escHtml(kat)}</span>`;
                const tgl   = b.tanggal ? new Date(b.tanggal).toLocaleDateString('id-ID', {day:'2-digit',month:'short',year:'numeric'}) : '—';
                const desk  = b.deskripsi.length > 60 ? escHtml(b.deskripsi.substring(0,60)) + '...' : escHtml(b.deskripsi);
                return `<tr>
                    <td>${no}</td>
                    <td>${foto}</td>
                    <td><strong>${escHtml(b.judul)}</strong></td>
                    <td>${badge}</td>
                    <td>${tgl}</td>
                    <td style="max-width:200px;">${desk}</td>
                    <td style="display:flex;gap:6px;flex-wrap:wrap;">
                        <button class="btn-small btn-view" onclick="previewBerita(${b.id})">👁️ Lihat</button>
                        <button class="btn-small btn-edit" onclick="editBerita(${b.id})">✏️ Edit</button>
                        <button class="btn-small btn-delete" onclick="hapusBerita(${b.id}, '${escJs(b.judul)}')">🗑️ Hapus</button>
                    </td>
                </tr>`;
            }).join('');

            // Pagination
            const totalHal = Math.ceil(semuaBerita.length / perHalaman);
            const pag = document.getElementById('beritaPagination');
            if (totalHal <= 1) { pag.innerHTML = ''; return; }
            let html = '';
            for (let p = 1; p <= totalHal; p++) {
                const active = p === halamanBerita ? 'background:#10b981;color:#fff;' : 'background:#f3f4f6;color:#374151;';
                html += `<button onclick="halamanBerita=${p};renderTabelBerita()" style="${active}border:none;padding:.4rem .8rem;border-radius:6px;cursor:pointer;font-weight:600;">${p}</button>`;
            }
            pag.innerHTML = html;
        }

        function escHtml(str) {
            return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
        }
        function escJs(str) { return String(str).replace(/'/g,"\\'"); }

        function tampilNotif(pesan, tipe) {
            const div = document.getElementById('beritaNotif');
            const isOk = tipe === 'ok';
            div.style.cssText = `display:flex;padding:1rem 1.5rem;border-radius:10px;margin-bottom:1.5rem;align-items:center;gap:.75rem;background:${isOk?'#d1fae5':'#fee2e2'};color:${isOk?'#065f46':'#991b1b'};border:1px solid ${isOk?'#6ee7b7':'#fca5a5'};`;
            div.innerHTML = `<span style="font-size:1.4rem;">${isOk?'✅':'❌'}</span> ${pesan}`;
            setTimeout(() => { div.style.display = 'none'; }, 4000);
        }

        function bukaFormBerita(mode) {
            document.getElementById('formBeritaWrap').style.display = 'block';
            document.getElementById('beritaNotif').style.display    = 'none';
            if (mode === 'tambah') {
                document.getElementById('formBeritaTitle').textContent = 'Tambah Berita Baru';
                document.getElementById('beritaId').value       = '';
                document.getElementById('beritaJudul').value    = '';
                document.getElementById('beritaKategori').value = '';
                document.getElementById('beritaTanggal').value  = new Date().toISOString().split('T')[0];
                document.getElementById('beritaDeskripsi').value= '';
                document.getElementById('beritaFotoUrl').value  = '';
                document.getElementById('beritaFotoFile').value = '';
                document.getElementById('charCount').textContent = '0 / 500 karakter';
                hapusFotoPreview();
                uploadedFotoPath = '';
            }
            document.getElementById('formBeritaWrap').scrollIntoView({behavior:'smooth', block:'start'});
        }

        function tutupFormBerita() {
            document.getElementById('formBeritaWrap').style.display = 'none';
            uploadedFotoPath = '';
        }

        function previewFoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('fotoPreview').src = e.target.result;
                    document.getElementById('fotoPreviewWrap').style.display = 'block';
                    document.getElementById('beritaFotoUrl').value = '';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function hapusFotoPreview() {
            document.getElementById('fotoPreview').src = '';
            document.getElementById('fotoPreviewWrap').style.display = 'none';
            document.getElementById('beritaFotoFile').value = '';
        }

        document.getElementById('beritaDeskripsi')?.addEventListener('input', function() {
            document.getElementById('charCount').textContent = this.value.length + ' / 500 karakter';
        });

        document.getElementById('formBerita')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            const id        = document.getElementById('beritaId').value;
            const judul     = document.getElementById('beritaJudul').value.trim();
            const kategori  = document.getElementById('beritaKategori').value;
            const tanggal   = document.getElementById('beritaTanggal').value;
            const deskripsi = document.getElementById('beritaDeskripsi').value.trim();
            const fotoFile  = document.getElementById('beritaFotoFile').files[0];
            let   fotoVal   = document.getElementById('beritaFotoUrl').value.trim();

            const btn = document.getElementById('btnSimpanBerita');
            btn.disabled   = true;
            btn.textContent = '⏳ Menyimpan...';

            try {
                // Upload file jika ada
                if (fotoFile) {
                    const fd = new FormData();
                    fd.append('foto', fotoFile);
                    const up  = await fetch('berita-api.php?action=upload', { method: 'POST', body: fd });
                    const upJ = await up.json();
                    if (!upJ.success) throw new Error('Upload gagal: ' + upJ.message);
                    fotoVal = upJ.filename;
                } else if (uploadedFotoPath) {
                    fotoVal = uploadedFotoPath;
                }

                const action  = id ? 'update' : 'create';
                const payload = { judul, foto: fotoVal, kategori, tanggal, deskripsi };
                if (id) payload.id = parseInt(id);

                const res  = await fetch('berita-api.php?action=' + action, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const json = await res.json();
                if (!json.success) throw new Error(json.message);

                tampilNotif(json.message, 'ok');
                tutupFormBerita();
                muatBerita();
            } catch(err) {
                tampilNotif('Gagal: ' + err.message, 'error');
            } finally {
                btn.disabled    = false;
                btn.textContent = '💾 Simpan Berita';
            }
        });

        async function editBerita(id) {
            try {
                const res  = await fetch('berita-api.php?action=get&id=' + id);
                const json = await res.json();
                if (!json.success) throw new Error(json.message);
                const b = json.data;
                bukaFormBerita('edit');
                document.getElementById('formBeritaTitle').textContent = 'Edit Berita';
                document.getElementById('beritaId').value        = b.id;
                document.getElementById('beritaJudul').value     = b.judul;
                document.getElementById('beritaKategori').value  = b.kategori;
                document.getElementById('beritaTanggal').value   = b.tanggal;
                document.getElementById('beritaDeskripsi').value = b.deskripsi;
                document.getElementById('charCount').textContent = b.deskripsi.length + ' / 500 karakter';
                document.getElementById('beritaFotoUrl').value   = b.foto || '';
                if (b.foto) {
                    document.getElementById('fotoPreview').src = b.foto;
                    document.getElementById('fotoPreviewWrap').style.display = 'block';
                } else {
                    hapusFotoPreview();
                }
                uploadedFotoPath = '';
            } catch(err) {
                tampilNotif('Gagal memuat data: ' + err.message, 'error');
            }
        }

        async function hapusBerita(id, judul) {
            if (!confirm('Yakin ingin menghapus berita:\n"' + judul + '"?')) return;
            try {
                const res  = await fetch('berita-api.php?action=delete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                });
                const json = await res.json();
                if (!json.success) throw new Error(json.message);
                tampilNotif(json.message, 'ok');
                muatBerita();
            } catch(err) {
                tampilNotif('Gagal menghapus: ' + err.message, 'error');
            }
        }

        function previewBerita(id) {
            const b = semuaBerita.find(x => x.id == id);
            if (!b) return;
            const badgeColor = { pengumuman: '#3b82f6', prestasi: '#f59e0b', 'pilihan utama': '#10b981' };
            const bg = badgeColor[b.kategori] || '#6b7280';
            const tgl = b.tanggal ? new Date(b.tanggal).toLocaleDateString('id-ID', {day:'2-digit',month:'long',year:'numeric'}) : '—';
            document.getElementById('modalBeritaFoto').src        = b.foto || 'https://via.placeholder.com/680x260?text=No+Image';
            document.getElementById('modalBeritaJudul').textContent = b.judul;
            document.getElementById('modalBeritaTanggal').textContent = tgl;
            document.getElementById('modalBeritaDeskripsi').textContent = b.deskripsi;
            const badge = document.getElementById('modalBeritaBadge');
            badge.textContent = b.kategori.toUpperCase();
            badge.style.cssText = `position:absolute;bottom:1rem;left:1rem;background:${bg};color:#fff;padding:.3rem .9rem;border-radius:50px;font-size:.8rem;font-weight:700;`;
            document.getElementById('modalDetailBerita').style.display = 'block';
        }

        // Muat berita saat tab berita pertama kali dibuka
        const _origShowTab = typeof showTab === 'function' ? showTab : null;
        document.addEventListener('DOMContentLoaded', function() {
            // Attach to all sidebar berita links
            document.querySelectorAll('[onclick*="showTab(\'berita\')"]').forEach(el => {
                el.addEventListener('click', () => setTimeout(muatBerita, 100));
            });
        });
    </script>
</body>

</html>