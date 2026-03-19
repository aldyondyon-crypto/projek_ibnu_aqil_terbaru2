<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekstrakulikuler - Website Sekolah</title>
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

    <!-- Extracurricular Section -->
    <section class="section active" style="margin-top: 100px;">
        <h2 class="section-title">Ekstrakurikuler</h2>
        <div class="cards-grid">
            <div class="card">
                <div class="card-icon">⚽</div>
                <h3>Olahraga</h3>
                <p>Sepak Bola, Basket, Voli, Badminton, Taekwondo, Karate, Renang, dan Atletik untuk mengembangkan jiwa
                    sportif dan kesehatan.</p>
            </div>
            <div class="card">
                <div class="card-icon">🎨</div>
                <h3>Seni & Budaya</h3>
                <p>Paduan Suara, Tari Tradisional, Teater, Seni Rupa, dan Band untuk mengasah kreativitas dan apresiasi
                    seni.</p>
            </div>
            <div class="card">
                <div class="card-icon">🔬</div>
                <h3>Sains & Teknologi</h3>
                <p>Robotika, Coding Club, KIR (Karya Ilmiah Remaja), dan Komputer untuk mengembangkan inovasi dan
                    teknologi.</p>
            </div>
            <div class="card">
                <div class="card-icon">📰</div>
                <h3>Jurnalistik</h3>
                <p>Majalah Dinding, Fotografi, dan Videografi untuk melatih kemampuan komunikasi dan dokumentasi.</p>
            </div>
            <div class="card">
                <div class="card-icon">🗣️</div>
                <h3>Bahasa</h3>
                <p>English Club, Arabic Club, Japanese Club untuk meningkatkan kemampuan berbahasa asing.</p>
            </div>
            <div class="card">
                <div class="card-icon">🎪</div>
                <h3>Organisasi</h3>
                <p>OSIS, MPK, Pramuka, PMR, dan Paskibra untuk melatih jiwa kepemimpinan dan organisasi.</p>
            </div>
            <div class="card">
                <div class="card-icon">📚</div>
                <h3>Akademik</h3>
                <p>Olimpiade Sains, Debat Bahasa Inggris, Karya Tulis Ilmiah untuk mengasah kemampuan akademik.</p>
            </div>
            <div class="card">
                <div class="card-icon">♻️</div>
                <h3>Lingkungan</h3>
                <p>Pecinta Alam, Green School, dan Bank Sampah untuk menumbuhkan kepedulian terhadap lingkungan.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 SMP IBNU AQIL. All Rights Reserved.</p>
        <p style="margin-top: 0.5rem; font-size: 0.9rem;">Membentuk Generasi Cerdas & Berkarakter</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>