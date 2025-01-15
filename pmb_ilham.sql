-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 12:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmb_ilham`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) UNSIGNED NOT NULL,
  `nama_fakultas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'Fakultas Pertanian'),
(4, 'Fakultas Hukum'),
(5, 'Fakultas Ekonomi Dan Bisnis'),
(6, 'Fakultas Ilmu Teknik');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` int(11) UNSIGNED NOT NULL,
  `tgl_buka` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tgl_pengumuman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id_informasi`, `tgl_buka`, `tgl_tutup`, `tgl_pengumuman`) VALUES
(1, '2025-01-15', '2025-01-31', '2025-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-01-15-074926', 'App\\Database\\Migrations\\Users', 'default', 'App', 1736957462, 1),
(2, '2025-01-15-074932', 'App\\Database\\Migrations\\Informasi', 'default', 'App', 1736957462, 1),
(3, '2025-01-15-074941', 'App\\Database\\Migrations\\Fakultas', 'default', 'App', 1736957462, 1),
(4, '2025-01-15-074945', 'App\\Database\\Migrations\\Prodi', 'default', 'App', 1736957463, 1),
(5, '2025-01-15-074951', 'App\\Database\\Migrations\\Pendaftaran', 'default', 'App', 1736957463, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `id_fakultas` int(11) UNSIGNED DEFAULT NULL,
  `id_prodi` int(11) UNSIGNED DEFAULT NULL,
  `nomor_pendaftaran` varchar(100) NOT NULL,
  `nama_peserta` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat_peserta` text NOT NULL,
  `nama_orangtua` varchar(255) NOT NULL,
  `pekerjaan_orangtua` varchar(255) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `tahap_satu` tinyint(1) NOT NULL DEFAULT 0,
  `tahap_dua` tinyint(1) NOT NULL DEFAULT 0,
  `tahap_tiga` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_pendaftaran` datetime NOT NULL,
  `status_pendaftaran` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `status_verifikasi` enum('unverified','verified') NOT NULL DEFAULT 'unverified',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `id_users`, `id_fakultas`, `id_prodi`, `nomor_pendaftaran`, `nama_peserta`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `alamat_peserta`, `nama_orangtua`, `pekerjaan_orangtua`, `nama_sekolah`, `tahun_lulus`, `alamat_sekolah`, `foto`, `berkas`, `tahap_satu`, `tahap_dua`, `tahap_tiga`, `tanggal_pendaftaran`, `status_pendaftaran`, `status_verifikasi`, `created_at`, `updated_at`) VALUES
(7, 2, 6, 2, '20250100001', 'Eko Purnomo', 'Lubuklinggau', '2000-08-31', 'Laki-Laki', 'Islam', '082324286303', 'Jalan Mawar Tirto Pekalongan', 'Naruto', 'Ninja Konoha', 'Akademi Ninja Konoha', '2016', 'Konohagakure, di dasar Monumen Hokage', '1736970268_6c30d8c576d029ff2717.jpeg', '1736970268_cc1d6fe5cbf2eabfa231.pdf', 1, 1, 1, '2025-01-15 20:14:05', 'approved', 'verified', '2025-01-15 20:14:05', '2025-01-16 06:08:58'),
(9, 3, 1, 6, '20250100002', 'Tasya Sakinatu Rizki', 'Pekalongan', '2025-01-03', 'Laki-Laki', 'Katolik', '082324286300', 'Jalan Mawar Tirto Pekalongan', 'Naruto', 'Ninja Konoha', 'Akademi Ninja Konoha', '2000', 'Jalan Mawar Tirto Pekalongan', '1736973972_86677e51bd570b79fe9b.jpeg', '1736973972_04ec18e674c508657119.pdf', 1, 1, 1, '2025-01-15 20:46:20', 'pending', 'verified', '2025-01-15 20:46:20', '2025-01-16 06:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) UNSIGNED NOT NULL,
  `id_fakultas` int(11) UNSIGNED NOT NULL,
  `nama_prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_fakultas`, `nama_prodi`) VALUES
(1, 6, 'Sistem Informasi'),
(2, 6, 'Rekayasa Sistem Komputer'),
(3, 6, 'Informatika'),
(5, 1, 'Agroteknologi'),
(6, 1, 'Ilmu Perikanan'),
(10, 4, 'Ilmu Hukum'),
(11, 5, 'Akuntansi'),
(12, 5, 'Manajemen'),
(13, 5, 'Magister Manajemen');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','calon') NOT NULL DEFAULT 'calon',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$kjdBdyczSvNab4MYVSO9YuedMXY2RDp8skDZ2XyX5n2I/kesFbyOq', 'admin', '2025-01-15 16:11:20', '2025-01-15 16:11:20'),
(2, 'Eko Purnomo', 'ekopurnomo@gmail.com', '$2y$10$9o0btxXB8JiTjPwKeSQeLuiIJff4epbXKnxpVHRP80ud19NQZ9F.u', 'calon', '2025-01-16 00:49:03', NULL),
(3, 'iLHAM', 'websing09@gmail.com', '$2y$10$VPWkwqCBfhXXD5hBolWI3uJ2Q/xPw..JXmxiQapesY/R5m2vxVkfe', 'calon', '2025-01-16 03:33:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_id_users_foreign` (`id_users`),
  ADD KEY `pendaftaran_id_fakultas_foreign` (`id_fakultas`),
  ADD KEY `pendaftaran_id_prodi_foreign` (`id_prodi`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `prodi_id_fakultas_foreign` (`id_fakultas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_informasi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_id_fakultas_foreign` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_id_fakultas_foreign` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
