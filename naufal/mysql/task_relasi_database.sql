-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 06:52 AM
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
  `harga` int(15) DEFAULT NULL,
  `penggunaan` text NOT NULL,
  `tahun_produksi` date NOT NULL,
  `id_produsen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_obat`
--

INSERT INTO `daftar_obat` (`id`, `nama_obat`, `harga`, `penggunaan`, `tahun_produksi`, `id_produsen`) VALUES
(1, 'Obat demam A', 10000, 'Demam, flu, nyeri otot', '0000-00-00', 1),
(2, 'Obat batuk A', 12000, 'Batuk, sakit kepala, sakit gigi', '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pelanggan`
--

CREATE TABLE `detail_pelanggan` (
  `id` int(11) NOT NULL,
  `riwayat_penyakit` text NOT NULL,
  `agama` varchar(15) NOT NULL,
  `nama_ibu_kandung` varchar(50) NOT NULL,
  `riwayat_alergi` text NOT NULL,
  `kontak_darurat` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pelanggan`
--

INSERT INTO `detail_pelanggan` (`id`, `riwayat_penyakit`, `agama`, `nama_ibu_kandung`, `riwayat_alergi`, `kontak_darurat`) VALUES
(1, 'Asma, Tipus', 'Islam', 'Fulanah binti Fulan', 'Telur, udang', '2147483647');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `domisili` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_detail_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `domisili`, `no_hp`, `id_detail_pelanggan`) VALUES
(1, 'Fulan', 'Bandung', '085677778888', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_obat`
--

CREATE TABLE `pembelian_obat` (
  `id` int(11) NOT NULL,
  `id_daftar_obat` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `total_harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produsen_obat`
--

CREATE TABLE `produsen_obat` (
  `id` int(11) NOT NULL,
  `nama_produsen` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(15) NOT NULL,
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
-- Indexes for table `detail_pelanggan`
--
ALTER TABLE `detail_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pelanggan_detail_pelanggan` (`id_detail_pelanggan`);

--
-- Indexes for table `pembelian_obat`
--
ALTER TABLE `pembelian_obat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_daftar_obat` (`id_daftar_obat`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`);

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
-- AUTO_INCREMENT for table `detail_pelanggan`
--
ALTER TABLE `detail_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian_obat`
--
ALTER TABLE `pembelian_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_detail_pelanggan` FOREIGN KEY (`id_detail_pelanggan`) REFERENCES `detail_pelanggan` (`id`);

--
-- Constraints for table `pembelian_obat`
--
ALTER TABLE `pembelian_obat`
  ADD CONSTRAINT `pembelian_obat_ibfk_1` FOREIGN KEY (`id_daftar_obat`) REFERENCES `daftar_obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_obat_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
