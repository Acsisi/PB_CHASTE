-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2024 at 05:52 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chaste_db`
--
CREATE DATABASE IF NOT EXISTS `chaste_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chaste_db`;

-- --------------------------------------------------------

--
-- Table structure for table `d_bulan`
--

DROP TABLE IF EXISTS `d_bulan`;
CREATE TABLE `d_bulan` (
  `d_bulan_id` int(11) NOT NULL,
  `h_bulan_id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL COMMENT 'biaya karyawan, listrik, air, dst',
  `harga` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_bulan`
--

INSERT INTO `d_bulan` (`d_bulan_id`, `h_bulan_id`, `keterangan`, `harga`, `status`) VALUES
(1, 8, 'gaji', 3000000, 0),
(2, 9, 'listrik', 2000000, 0),
(3, 10, 'PDAM', 800000, 0),
(4, 11, 'restock galon', 200000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_kamar`
--

DROP TABLE IF EXISTS `d_kamar`;
CREATE TABLE `d_kamar` (
  `d_kamar_id` int(11) NOT NULL,
  `h_kamar_id` int(11) NOT NULL,
  `kamar_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_kk` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_kamar`
--

INSERT INTO `d_kamar` (`d_kamar_id`, `h_kamar_id`, `kamar_id`, `harga`, `tgl_mulai`, `foto_ktp`, `foto_kk`, `status`) VALUES
(1, 1, 1, 1200000, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `h_bulan`
--

DROP TABLE IF EXISTS `h_bulan`;
CREATE TABLE `h_bulan` (
  `h_bulan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_bulan`
--

INSERT INTO `h_bulan` (`h_bulan_id`, `user_id`, `total`, `created_at`, `updated_at`, `status`, `keterangan`) VALUES
(8, 1, 3000000, '2024-01-10 10:21:58', '2024-01-10 10:21:58', 0, 'gaji'),
(9, 1, 2000000, '2024-01-10 10:22:02', '2024-01-10 10:22:02', 4, 'listrik'),
(10, 1, 800000, '2024-01-10 11:29:54', '2024-01-10 11:29:54', 0, 'PDAM'),
(11, 1, 200000, '2024-04-23 15:05:44', '2024-04-23 15:05:44', 0, 'restock galon');

-- --------------------------------------------------------

--
-- Table structure for table `h_galon`
--

DROP TABLE IF EXISTS `h_galon`;
CREATE TABLE `h_galon` (
  `h_galon_id` int(11) NOT NULL,
  `penyewa_id` int(11) NOT NULL,
  `pcs` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_galon`
--

INSERT INTO `h_galon` (`h_galon_id`, `penyewa_id`, `pcs`, `harga`, `created_at`, `updated_at`, `status`) VALUES
(3, 12, 1, 20000, '2024-05-12 23:11:07', '2024-05-12 23:11:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `h_kamar`
--

DROP TABLE IF EXISTS `h_kamar`;
CREATE TABLE `h_kamar` (
  `h_kamar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `penyewa_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_kamar`
--

INSERT INTO `h_kamar` (`h_kamar_id`, `user_id`, `penyewa_id`, `total`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 12, 1200000, '2024-01-05 08:50:19', '2024-01-05 08:50:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

DROP TABLE IF EXISTS `kamar`;
CREATE TABLE `kamar` (
  `kamar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `penyewa_id` int(11) DEFAULT NULL COMMENT 'boleh NULL',
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `foto2` varchar(255) DEFAULT NULL,
  `foto3` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL COMMENT 'boleh NULL',
  `AC` enum('AC','Non-AC') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Not Available | 1 = Available | 2 = Disewa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`kamar_id`, `user_id`, `penyewa_id`, `nama`, `foto`, `foto2`, `foto3`, `harga`, `deskripsi`, `AC`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 12, 'A-11', 'kamar/kamar3.jpg', NULL, NULL, 1200000, 'Kamar lantai satu dengan AC. Dekat dengan pintu masuk.', 'AC', '2024-05-13 10:05:16', '2023-12-08 09:14:45', 2),
(2, 1, NULL, 'A-12', 'kamar/kos1.png', NULL, NULL, 1200000, 'Kamar lantai satu dengan AC. Dekat dengan kamar mandi.', 'AC', '2024-05-13 10:05:16', '2023-12-08 09:14:45', 1),
(3, 1, NULL, 'A-13', 'kamar/kos1.png', NULL, NULL, 1200000, 'Kamar lantai satu dengan AC. Dekat dengan tangga naik menuju lantai 2.', 'AC', '2024-05-13 10:05:16', '2023-12-08 09:14:45', 1),
(4, 1, NULL, 'A-14', 'kamar/kos1.png', NULL, NULL, 1200000, 'Kamar lantai satu dengan AC. Dekat dengan dispenser air.', 'AC', '2024-05-13 10:05:16', '2023-12-08 09:14:45', 1),
(5, 1, NULL, 'B-21', 'kamar/kos2.webp', NULL, NULL, 900000, 'Kamar lantai dua tanpa AC. Dekat dengan tangga turun menuju lantai 1.', 'Non-AC', '2024-05-13 10:05:16', '2023-12-08 09:14:45', 2),
(6, 1, NULL, 'B-22', 'kamar/kos2.webp', NULL, NULL, 900000, 'Kamar lantai dua tanpa AC. Dekat dengan kamar mandi.', 'Non-AC', '2024-05-13 10:05:17', '2023-12-08 09:14:45', 1),
(7, 1, NULL, 'B-23', 'kamar/kos2.webp', NULL, NULL, 900000, 'Kamar lantai dua tanpa AC. Dekat dengan dispenser air.', 'Non-AC', '2024-05-13 10:05:17', '2023-12-08 09:14:45', 1),
(8, 1, NULL, 'B-24', 'kamar/kos2.webp', NULL, NULL, 900000, 'Kamar lantai dua tanpa AC. Dekat dengan sudut.', 'Non-AC', '2024-05-13 10:05:17', '2023-12-08 09:14:45', 1),
(9, 1, NULL, 'B-6', 'kamar/kamar3.jpg', NULL, NULL, 800000, 'Kamar lantai dua tanpa AC. Mejanya kurang bagus.', 'Non-AC', '2024-05-13 10:05:17', '2024-04-23 14:59:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `ktp` varchar(16) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role` enum('1','3') DEFAULT '1' COMMENT '1 = admin | 3 = penyewa kamar',
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `status_galon` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= sudah balikin, 2= ga boleh beli lagi sebelum admin ubah ke 1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `nama`, `ktp`, `foto`, `role`, `no_telp`, `email`, `created_at`, `updated_at`, `status`, `status_galon`) VALUES
(1, 'admin', '$2y$12$hwySAInr8Hg/j.jEx8.PPehRfEa8tyeDEKkYa7946dGLoWpa47d/y', NULL, NULL, NULL, '1', NULL, 'admin@gmail.com', '2023-11-19 05:50:07', '2023-11-19 05:50:07', 1, 1),
(12, 'penyewa1', '$2y$12$qHUhpB1g85ivRBlApk1QZu9X.Pqq1/t6WLoKwFZgq82MSspHDgEuW', 'Fransisca', NULL, NULL, '3', NULL, 'penyewa1@gmail.com', '2023-12-08 08:35:12', '2023-12-08 08:35:12', 1, 2),
(13, 'penyewa2', '$2y$12$TdkcU0z2tdtXXeU6kmKLw.9UvjS062Kzi4Kj67uhwH7MNKeWWlYZK', 'Arensa', NULL, NULL, '3', NULL, 'penyewa2@gmail.com', '2023-12-08 08:35:42', '2023-12-08 08:35:42', 1, 1),
(26, 'penyewa3', '$2y$12$0jtvIc0SWvA5i2sut6PGke1AUMXcxU0Q5hl6BgREHFNS0lONXpoA2', 'Stenlie', '1234567890123456', NULL, '3', '12345678', 'penyewa3@gmail.com', '2024-04-01 01:13:27', '2024-04-01 01:13:27', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_bulan`
--
ALTER TABLE `d_bulan`
  ADD PRIMARY KEY (`d_bulan_id`),
  ADD KEY `h_bulan_id` (`h_bulan_id`);

--
-- Indexes for table `d_kamar`
--
ALTER TABLE `d_kamar`
  ADD PRIMARY KEY (`d_kamar_id`),
  ADD KEY `h_kamar_id` (`h_kamar_id`),
  ADD KEY `kamar_id` (`kamar_id`);

--
-- Indexes for table `h_bulan`
--
ALTER TABLE `h_bulan`
  ADD PRIMARY KEY (`h_bulan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `h_galon`
--
ALTER TABLE `h_galon`
  ADD PRIMARY KEY (`h_galon_id`),
  ADD KEY `penyewa_id` (`penyewa_id`);

--
-- Indexes for table `h_kamar`
--
ALTER TABLE `h_kamar`
  ADD PRIMARY KEY (`h_kamar_id`),
  ADD KEY `h_kamar_ibfk_1` (`user_id`),
  ADD KEY `penyewa_id` (`penyewa_id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`kamar_id`),
  ADD KEY `kamar_ibfk_1` (`penyewa_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_bulan`
--
ALTER TABLE `d_bulan`
  MODIFY `d_bulan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `d_kamar`
--
ALTER TABLE `d_kamar`
  MODIFY `d_kamar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `h_bulan`
--
ALTER TABLE `h_bulan`
  MODIFY `h_bulan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `h_galon`
--
ALTER TABLE `h_galon`
  MODIFY `h_galon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `h_kamar`
--
ALTER TABLE `h_kamar`
  MODIFY `h_kamar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `kamar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_bulan`
--
ALTER TABLE `d_bulan`
  ADD CONSTRAINT `d_bulan_ibfk_1` FOREIGN KEY (`h_bulan_id`) REFERENCES `h_bulan` (`h_bulan_id`);

--
-- Constraints for table `d_kamar`
--
ALTER TABLE `d_kamar`
  ADD CONSTRAINT `d_kamar_ibfk_1` FOREIGN KEY (`h_kamar_id`) REFERENCES `h_kamar` (`h_kamar_id`),
  ADD CONSTRAINT `d_kamar_ibfk_2` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`kamar_id`);

--
-- Constraints for table `h_bulan`
--
ALTER TABLE `h_bulan`
  ADD CONSTRAINT `h_bulan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `h_galon`
--
ALTER TABLE `h_galon`
  ADD CONSTRAINT `h_galon_ibfk_1` FOREIGN KEY (`penyewa_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `h_kamar`
--
ALTER TABLE `h_kamar`
  ADD CONSTRAINT `h_kamar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `h_kamar_ibfk_2` FOREIGN KEY (`penyewa_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`penyewa_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `kamar_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
