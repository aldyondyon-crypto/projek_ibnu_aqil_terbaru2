-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2026 at 08:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibnu_aqil`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Username`, `Password`) VALUES
(1, 'Admin', 'Admin12345#');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `kategori` enum('pengumuman','prestasi','pilihan utama') NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `foto`, `kategori`, `tanggal`, `deskripsi`) VALUES
(1, 'SMP IBNU AQIL Meresmikan Laboratorium Komputer Generasi Terbaru', 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=2069&auto=format&fit=crop', 'pilihan utama', '2026-02-22', 'Dalam upaya meningkatkan literasi digital siswa, SMP IBNU AQIL resmi membuka fasilitas laboratorium komputer tercanggih yang dilengkapi dengan 40 unit PC terbaru. Laboratorium ini diharapkan menjadi pusat inovasi dan kreativitas bagi seluruh peserta didik.'),
(3, 'Kegiatan Field Trip: Mengenal Ekosistem Hutan Mangrove', 'https://images.unsplash.com/photo-1523050335456-cbb6e0b20152?q=80&w=2070&auto=format&fit=crop', 'pengumuman', '2026-02-15', 'Siswa kelas VIII melakukan kunjungan edukatif ke kawasan konservasi mangrove. Kegiatan ini bertujuan untuk menanamkan kepedulian terhadap lingkungan sejak dini.'),
(4, 'Siswa SMP IBNU AQIL Juara 1 Olimpiade Matematika Nasional', 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=2071&auto=format&fit=crop', 'prestasi', '2026-02-20', 'Prestasi membanggakan kembali diraih oleh salah satu siswa didik kami, Ahmad Rizki, yang berhasil menyabet medali emas dalam ajang Olimpiade Matematika tingkat Nasional.'),
(5, 'dedo mirip prabowo', 'uploads/berita/berita_1772639896_6979.jpg', 'prestasi', '2026-03-04', 'dedo pas disuru maju malah galer');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `username`, `email`, `judul`, `deskripsi`) VALUES
(3, 'tes', 'dedoiblis@gmail.com', 'testing', 'yongs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
