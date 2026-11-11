-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2026 at 04:29 AM
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
-- Database: `pinjempak_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `stok_rusak` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'Tersedia',
  `deskripsi` text DEFAULT NULL,
  `gambar_barang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `nama_barang`, `kategori`, `stok`, `stok_rusak`, `status`, `deskripsi`, `gambar_barang`, `created_at`, `updated_at`) VALUES
(6, 'Laptop HP', 'Elektronik', 3, 0, 'Tersedia', 'Laptop HP siap pakai.', NULL, '2026-11-10 18:19:56', '2026-11-10 18:19:56'),
(7, 'Flashdisk', 'Alat', 10, 0, 'Tersedia', 'Flashdisk untuk file.', NULL, '2026-11-10 18:20:44', '2026-11-10 18:20:44'),
(8, 'Mouse', 'Elektronik', 20, 0, 'Tersedia', 'Mouse untuk PC/Laptop', NULL, '2026-11-10 18:21:12', '2026-11-10 18:21:12'),
(9, 'Keyboard', 'Elektronik', 10, 0, 'Tersedia', 'Keyboard untuk ngetik', NULL, '2026-11-10 18:22:51', '2026-11-10 18:22:51'),
(10, 'Proyektor', 'Elektronik', 3, 0, 'Tersedia', 'Proyektor', NULL, '2026-11-10 18:23:23', '2026-11-10 18:23:23'),
(11, 'Monitor', 'Elektronik', 3, 0, 'Tersedia', 'Monitor', NULL, '2026-11-10 18:23:56', '2026-11-10 18:23:56'),
(12, 'Obeng mini', 'Alat', 1, 0, 'Tersedia', 'Obeng 1 set', NULL, '2026-11-10 18:24:29', '2026-11-10 18:24:29'),
(13, 'Arduino uno', 'Elektronik', 30, 0, 'Tersedia', 'Arduino uno', NULL, '2026-11-10 18:26:45', '2026-11-10 18:26:45'),
(14, 'Solder', 'Alat', 1, 0, 'Tersedia', 'Solder', NULL, '2026-11-10 18:27:24', '2026-11-10 18:27:24'),
(15, 'Bor tembok', 'Alat', 1, 0, 'Tersedia', 'Bor', NULL, '2026-11-10 18:28:17', '2026-11-10 18:28:17'),
(16, 'Bor mini listrik', 'Alat', 1, 0, 'Tersedia', 'Bor', NULL, '2026-11-10 18:28:35', '2026-11-10 18:28:35'),
(17, 'Speaker', 'Elektronik', 1, 0, 'Tersedia', 'Speaker ready horeg', NULL, '2026-11-10 18:29:02', '2026-11-10 18:29:02'),
(18, 'Mic + Sound', 'Elektronik', 1, 0, 'Tersedia', 'Mic dan sound system', NULL, '2026-11-10 18:29:28', '2026-11-10 18:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `alasan` text NOT NULL,
  `tanggal_kembali_request` date DEFAULT NULL,
  `tanggal_kembali_disetujui` date DEFAULT NULL,
  `catatan_admin` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `tanggal_kembali` timestamp NULL DEFAULT NULL,
  `kondisi_kembali` varchar(255) DEFAULT NULL,
  `detail_kerusakan` text DEFAULT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2026_10_03_035648_create_inventories_table', 1),
(3, '2026_10_20_060614_create_loans_table', 1),
(4, '2026_10_20_064842_add_return_fields_to_loans_table', 1),
(5, '2026_10_23_015146_add_stok_rusak_to_inventories_table', 1),
(6, '2026_11_03_004421_add_return_dates_to_loans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'siswa',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kevin Fajar', 'petugas@pinjempak.com', '$2y$12$MW0TGm18xydJQnW6G5Pq4./KZIzkok54sIr/MkQmZw.UZKfPpCbi.', 'petugas', NULL, '2026-11-10 17:58:56', '2026-11-10 17:58:56'),
(2, 'Budiawan S.Pd.', 'guru@pinjempak.com', '$2y$12$7Wiw/AI8d.FreyIoaiLhVO4KfQ9ow7rkC4Zbtd7K.22ex5bQKnaOG', 'guru', NULL, '2026-11-10 17:58:56', '2026-11-10 17:58:56'),
(3, 'Pranaja Abi', 'siswa@pinjempak.com', '$2y$12$bp/YJIEQgpih8UXFI5oPz.jv9C7whHO.IQZyYZ/TfWEr2.DK0kosy', 'siswa', NULL, '2026-11-10 17:58:56', '2026-11-10 17:58:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`),
  ADD KEY `loans_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
