<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas - Website Sekolah</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <img src="Screenshot_2026-02-22-13-16-05-58_1c337646f29875672b5a61192b9010f9.png"
                    alt="Logo SMP IBNU AQIL" class="logo-img">
                SMP IBNU AQIL
            </div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Tentang ▾</a>
                    <ul class="dropdown-content">
                        <li><a href="profile.php">Profil Sekolah</a></li>
                        <li><a href="visi-misi.php">Visi & Misi</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropbtn active">Kegiatan ▾</a>
                    <ul class="dropdown-content">
                        <li><a href="fasilitas.php">Fasilitas</a></li>
                        <li><a href="ekskul.php">Ekstrakulikuler</a></li>
                    </ul>
                </li>
                <li><a href="berita.php">Berita</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Hubungi ▾</a>
                    <ul class="dropdown-content">
                        <li><a href="lokasi.php">Lokasi</a></li>
                        <li><a href="kontak.php">Kontak</a></li>
                        <li><a href="pesan.php">Kirim Pesan</a></li>
                    </ul>
                </li>
                <li><a href="login.php" class="nav-login-btn">Login</a></li>
            </ul>
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Facilities Section -->
    <section class="section active" style="margin-top: 100px;">
        <h2 class="section-title">Fasilitas Sekolah</h2>
        <div class="cards-grid">
            <div class="card">
                <div class="card-icon">🏫</div>
                <h3>Ruang Kelas Modern</h3>
                <p>36 ruang kelas yang dilengkapi dengan AC, proyektor, dan papan tulis interaktif untuk mendukung
                    pembelajaran yang efektif.</p>
            </div>
            <div class="card">
                <div class="card-icon">🔬</div>
                <h3>Laboratorium</h3>
                <p>Laboratorium Fisika, Kimia, Biologi, dan Komputer dengan peralatan lengkap dan modern untuk praktikum
                    siswa.</p>
            </div>
            <div class="card">
                <div class="card-icon">📖</div>
                <h3>Perpustakaan Digital</h3>
                <p>Perpustakaan dengan koleksi lebih dari 10.000 buku dan akses e-library untuk referensi pembelajaran
                    siswa.</p>
            </div>
            <div class="card">
                <div class="card-icon">⚽</div>
                <h3>Lapangan Olahraga</h3>
                <p>Lapangan basket, voli, futsal, dan lintasan atletik untuk mengembangkan bakat olahraga siswa.</p>
            </div>
            <div class="card">
                <div class="card-icon">🎭</div>
                <h3>Aula Serbaguna</h3>
                <p>Aula berkapasitas 500 orang untuk kegiatan upacara, seminar, dan pertunjukan seni.</p>
            </div>
            <div class="card">
                <div class="card-icon">🍽️</div>
                <h3>Kantin Sehat</h3>
                <p>Kantin dengan menu makanan bergizi dan higienis untuk memenuhi kebutuhan nutrisi siswa.</p>
            </div>
            <div class="card">
                <div class="card-icon">🕌</div>
                <h3>Masjid</h3>
                <p>Masjid yang nyaman untuk kegiatan ibadah dan pengembangan spiritual siswa.</p>
            </div>
            <div class="card">
                <div class="card-icon">🚌</div>
                <h3>Transportasi Sekolah</h3>
                <p>Bus sekolah yang melayani berbagai rute untuk kemudahan transportasi siswa.</p>
            </div>
            <div class="card">
                <div class="card-icon">💻</div>
                <h3>Wifi Area</h3>
                <p>Akses internet gratis di seluruh area sekolah untuk mendukung pembelajaran digital.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy;2026 SMP IBNU AQIL. All Rights Reserved.</p>
        <p style="margin-top: 0.5rem; font-size: 0.9rem;">Membentuk Generasi Cerdas & Berkarakter</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>