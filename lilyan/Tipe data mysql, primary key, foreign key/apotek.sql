-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2022 at 08:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id` int(11) NOT NULL,
  `penjual_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(32) NOT NULL,
  `no_telp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id`, `penjual_id`, `nama`, `alamat`, `kota`, `no_telp`) VALUES
(1, 1, 'Annafi', 'Pekayon', 'Bekasi', '0898937733'),
(2, 2, 'Lintang', 'Jaka setia', 'Bekasi', '08978767654'),
(3, 3, 'Indah', 'Pawidean', 'Indramayu', '08363728922'),
(4, 4, 'Abu', 'Plumbon', 'Cirebon', '089786767'),
(5, 5, 'Fauzy', 'Gunung Jati', 'Cirebon', '089878678'),
(6, 6, 'Fitriana', 'Pekandangan', 'Indramayu', '089787564657'),
(7, 7, 'Sandi', 'Jatisawit', 'Jatibarang', '089786757'),
(8, 8, 'Pranata', 'Cirebon', 'Cirebon', '0899986757'),
(9, 9, 'Azizah', 'Kertasmaya', 'Indramayu', '0898786768'),
(10, 10, 'Fani', 'Jakarta', 'Jakarta', '089878897');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_obat`
--

CREATE TABLE `jenis_obat` (
  `id` int(11) NOT NULL,
  `jenis_obat` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_obat`
--

INSERT INTO `jenis_obat` (`id`, `jenis_obat`) VALUES
(1, 'Obat Antiotik'),
(2, 'Obat Batuk'),
(3, 'Obat Tetes'),
(4, 'Obat Salep'),
(5, 'Obat Cair'),
(6, 'Obat Antivirus'),
(7, 'Obat Herbal'),
(8, 'Obat Magh'),
(9, 'Obat Anti Jamur'),
(10, 'Obat Tidur');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `stok_obat` int(20) NOT NULL,
  `id_jenisobat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `harga`, `stok_obat`, `id_jenisobat`) VALUES
(1, 'Amoxilin', 5000, 80, 1),
(2, 'OBH Combi', 60000, 90, 2),
(3, 'Insto Mata', 15000, 45, 3),
(4, 'Salep 88', 25000, 67, 4),
(5, 'Sirup', 20000, 78, 5),
(6, 'Acyclovir', 45000, 50, 6),
(7, 'Kunyit Asem', 15000, 80, 7),
(8, 'Promagh', 12000, 43, 8),
(9, 'Kalpanax', 26000, 89, 9),
(10, 'Sleepinal', 45000, 78, 10),
(11, 'Komik Herbal', 2000, 90, 2),
(12, 'Laserin', 6000, 65, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `jenis_kelamin`, `alamat`) VALUES
(1, 'Lilyy', 'Wanita', 'indramayu'),
(2, 'Arhatia', 'Pria', 'Indramayu'),
(3, 'Tia', 'Pria', 'Jatibarang'),
(4, 'Nurkom', 'Wanita', 'Pamayahan'),
(5, 'Agustin', 'Pria', 'Jakarta'),
(6, 'Aldini', 'Wanita', 'Bekasi'),
(7, 'Ayunda', 'Wanita', 'Pagirikan'),
(8, 'Fajri', 'Pria', 'Kertasmaya'),
(9, 'Wahyu Annafi', 'Pria', 'Cirebon'),
(10, 'Arip', 'Pria', 'Kedawung');

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(255) NOT NULL,
  `no_telp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`id`, `nama`, `alamat`, `kota`, `no_telp`) VALUES
(1, 'Tia', 'Pawidean', 'Indramayu', 898738367),
(2, 'Lilyan', 'Jatibarang', 'Indramayu', 875657676),
(3, 'Arha', 'Balongan', 'Indramayu', 898767755),
(4, 'Cahyanto', 'Majalengka', 'Majalengka', 897878788),
(5, 'Viki', 'Slaur', 'Indramayu', 797877556),
(6, 'Triana', 'Karanganyar', 'Indramayu', 797876756),
(7, 'Andi', 'Dukuh', 'Indramayu', 889654356),
(8, 'Faisal', 'Karanganyar', 'Indramayu', 899667687),
(9, 'Ibrahim', 'Losari', 'Cirebon', 898787878),
(10, 'Nisa', 'Pawidean', 'Indramayu', 898767578);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_pelanggan` int(255) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `pajak` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_penjual`, `id_obat`, `id_pelanggan`, `jumlah_obat`, `pajak`, `total_bayar`) VALUES
(1, 1, 1, 1, 3, 3000, 56000),
(2, 2, 2, 2, 4, 2000, 35000),
(3, 3, 3, 3, 6, 3000, 45000),
(4, 1, 4, 4, 5, 4000, 25000),
(5, 1, 5, 5, 7, 5000, 68000),
(6, 1, 6, 6, 2, 2000, 3200),
(7, 2, 7, 7, 8, 6000, 80000),
(8, 1, 8, 8, 5, 7000, 46000),
(9, 2, 9, 9, 8, 3000, 34000),
(10, 3, 10, 10, 4, 4000, 65000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penjualobat` (`penjual_id`);

--
-- Indexes for table `jenis_obat`
--
ALTER TABLE `jenis_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jenisobat` (`id_jenisobat`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pelanggan` (`id_pelanggan`),
  ADD KEY `fk_penjual` (`id_penjual`),
  ADD KEY `fk_obat` (`id_obat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis_obat`
--
ALTER TABLE `jenis_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penjual`
--
ALTER TABLE `penjual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `distributor`
--
ALTER TABLE `distributor`
  ADD CONSTRAINT `fk_penjualobat` FOREIGN KEY (`penjual_id`) REFERENCES `penjual` (`id`);

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `fk_jenisobat` FOREIGN KEY (`id_jenisobat`) REFERENCES `jenis_obat` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `fk_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `fk_penjual` FOREIGN KEY (`id_penjual`) REFERENCES `penjual` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
