<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi - Website Sekolah</title>
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
                    <a href="#" class="dropbtn active">Tentang ▾</a>
                    <ul class="dropdown-content">
                        <li><a href="profile.php">Profil Sekolah</a></li>
                        <li><a href="visi-misi.php">Visi & Misi</a></li>
                    </ul>
                </li>
                <li><a href="berita.php">Berita</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Kegiatan ▾</a>
                    <ul class="dropdown-content">
                        <li><a href="fasilitas.php">Fasilitas</a></li>
                        <li><a href="ekskul.php">Ekstrakulikuler</a></li>
                    </ul>
                </li>
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

    <!-- Vision Mission Section -->
    <section class="section active" style="margin-top: 100px;">
        <h2 class="section-title">Visi Misi Sekolah</h2>
        <div class="vision-mission-container">
            <div class="vm-box">
                <h3>VISI</h3>
                <p style="color: var(--text-gray); line-height: 1.8; margin-top: 1rem;">
                    "Mewujudkan generasi yang unggul dalam IPTEK dan kokoh dalam IMTAK."
                </p>
            </div>
            <div class="vm-box">
                <h3>MISI</h3>
                <ul>
                    <li>Menyelenggarakan pendidikan berkualitas dengan kurikulum yang adaptif dan inovatif</li>
                    <li>Mengembangkan potensi akademik dan non-akademik siswa secara optimal</li>
                    <li>Membentuk karakter siswa yang berakhlak mulia dan bertanggung jawab</li>
                    <li>Menciptakan lingkungan belajar yang kondusif, aman, dan nyaman</li>
                    <li>Meningkatkan kompetensi tenaga pendidik dan kependidikan secara berkelanjutan</li>
                    <li>Membangun kerjasama dengan berbagai pihak untuk meningkatkan kualitas pendidikan</li>
                </ul>
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