-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 10:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dok`
--

-- --------------------------------------------------------

--
-- Table structure for table `gbr_dok`
--

CREATE TABLE `gbr_dok` (
  `id` int(11) NOT NULL,
  `kode_gambar` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kode_dok` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `judul_dok`
--

CREATE TABLE `judul_dok` (
  `id` int(11) NOT NULL,
  `cover` varchar(30) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `kode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ket_dok`
--

CREATE TABLE `ket_dok` (
  `id` int(11) NOT NULL,
  `kode_ket` varchar(30) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `kode_dok` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gbr_dok`
--
ALTER TABLE `gbr_dok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judul_dok`
--
ALTER TABLE `judul_dok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ket_dok`
--
ALTER TABLE `ket_dok`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gbr_dok`
--
ALTER TABLE `gbr_dok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `judul_dok`
--
ALTER TABLE `judul_dok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ket_dok`
--
ALTER TABLE `ket_dok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
