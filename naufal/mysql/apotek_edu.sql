-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2022 at 09:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek_edu`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_obat`
--

CREATE TABLE `daftar_obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `penggunaan` text NOT NULL,
  `tahun_produksi` int(11) NOT NULL,
  `id_produsen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_obat`
--

INSERT INTO `daftar_obat` (`id`, `nama_obat`, `penggunaan`, `tahun_produksi`, `id_produsen`) VALUES
(1, 'Obat demam A', 'Demam, flu, nyeri otot', 2010, 1),
(2, 'Obat batuk A', 'Batuk, sakit kepala, sakit gigi', 2011, 2);

-- --------------------------------------------------------

--
-- Table structure for table `produsen_obat`
--

CREATE TABLE `produsen_obat` (
  `id` int(11) NOT NULL,
  `nama_produsen` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `tahun_berdiri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produsen_obat`
--

INSERT INTO `produsen_obat` (`id`, `nama_produsen`, `alamat`, `kontak`, `tahun_berdiri`) VALUES
(1, 'PT ABC', 'Jl. ABC 123', '0888999922222', 2000),
(2, 'PT EFG', 'Jl. EFG 456', '082345678900', 2005);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_obat`
--
ALTER TABLE `daftar_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produsen` (`id_produsen`);

--
-- Indexes for table `produsen_obat`
--
ALTER TABLE `produsen_obat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_obat`
--
ALTER TABLE `daftar_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produsen_obat`
--
ALTER TABLE `produsen_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_obat`
--
ALTER TABLE `daftar_obat`
  ADD CONSTRAINT `fk_produsen` FOREIGN KEY (`id_produsen`) REFERENCES `produsen_obat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
