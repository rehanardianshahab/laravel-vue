-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 06:40 AM
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
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_obat`
--

CREATE TABLE `daftar_obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `bentuk` varchar(100) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `stok` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_obat`
--



-- --------------------------------------------------------

--
-- Table structure for table `detil_obat`
--

CREATE TABLE `detil_obat` (
  `id` int(11) NOT NULL,
  `nama_standar_mims` varchar(100) NOT NULL,
  `nomor_izin_edar` varchar(100) NOT NULL,
  `komposisi` varchar(100) NOT NULL,
  `kemasan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_dafar_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detil_obat`
--



-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--



-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_pembeli` varchar(100) NOT NULL,
  `id_dafar_obat` int(11) NOT NULL,
  `jumlah_penjualan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_resep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--



-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `no_resep` varchar(100) NOT NULL,
  `dokter_resep` varchar(100) NOT NULL,
  `daftar_obat` text(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_obat`
--
ALTER TABLE `daftar_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_obat`
--
ALTER TABLE `detil_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dafar_obat` (`id_dafar_obat`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dftrObat` (`id_dafar_obat`),
  ADD KEY `fk_karyawan` (`id_karyawan`),
  ADD KEY `fk_resep` (`id_resep`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_obat`
--
ALTER TABLE `daftar_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detil_obat`
--
ALTER TABLE `detil_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detil_obat`
--
ALTER TABLE `detil_obat`
  ADD CONSTRAINT `detil_obat_ibfk_1` FOREIGN KEY (`id_dafar_obat`) REFERENCES `daftar_obat` (`id`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `fk_dftrObat` FOREIGN KEY (`id_dafar_obat`) REFERENCES `daftar_obat` (`id`),
  ADD CONSTRAINT `fk_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`),
  ADD CONSTRAINT `fk_resep` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
