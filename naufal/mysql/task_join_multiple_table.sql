-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 08:34 AM
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
-- Database: `new_apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_obat`
--

CREATE TABLE `daftar_obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `harga` int(15) DEFAULT NULL,
  `stok` int(15) NOT NULL,
  `penggunaan` text DEFAULT NULL,
  `tahun_produksi` date NOT NULL,
  `id_produsen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_obat`
--

INSERT INTO `daftar_obat` (`id`, `nama_obat`, `harga`, `stok`, `penggunaan`, `tahun_produksi`, `id_produsen`) VALUES
(1, 'Obat demam A', 10000, 30, 'Demam, flu, nyeri otot', '2022-10-10', 1),
(2, 'Obat batuk A', 12000, 20, 'Batuk, sakit kepala, sakit gigi', '2022-10-19', 2),
(3, 'Obat nyeri otot C', 15000, 50, 'Nyeri otot, pegal linu', '2022-10-01', 1),
(4, 'Obat Asma D', 9000, 20, 'Asma, sesak nafas', '2022-09-09', 1),
(5, 'Obat Gatal F', 11000, 65, 'Gatal-gatal, iritasi kulit', '2022-08-10', 7),
(6, 'Obat Alergi H', 20000, 22, 'Alergi', '2022-09-21', 10),
(7, 'Obat Pilek E', 16500, 75, 'Pilek, flu, batuk', '2022-08-07', 1),
(8, 'Multivitamin ABC', 23500, 32, 'Pemeliharaan kesehatan', '2022-10-24', 6),
(9, 'Salep Gatal J', 19000, 47, 'Gatal-gatal, iritasi', '2022-10-23', 8),
(10, 'Minyak Kayu Putih EFG', 14000, 55, 'Menghangatkan tubuh, meredakan gatal-gatal', '2022-09-12', 9),
(11, 'Obat Sakit Kepala A', NULL, 25, NULL, '2022-10-12', 2),
(12, 'Obat Sakit Kepala C', NULL, 32, NULL, '2022-10-30', NULL),
(13, 'Obat demam C', 15000, 11, 'Demam, flu, masuk angin', '2022-09-15', NULL),
(14, 'Obat Maag G', 8000, 28, 'Maag, asam lambung, kembung', '2022-09-07', 12);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pelanggan`
--

CREATE TABLE `detail_pelanggan` (
  `id` int(11) NOT NULL,
  `nama_ibu_kandung` varchar(15) DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `riwayat_penyakit` text NOT NULL,
  `riwayat_alergi` text NOT NULL,
  `kontak_darurat` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pelanggan`
--

INSERT INTO `detail_pelanggan` (`id`, `nama_ibu_kandung`, `agama`, `riwayat_penyakit`, `riwayat_alergi`, `kontak_darurat`) VALUES
(1, 'Fulanah binti F', 'Islam', 'Asma, Tipus', 'Telur, udang', '2147483647'),
(2, 'Krista', 'Katolik', 'TBC, tekanan darah tinggi', 'Debu, polen', '088877779999'),
(3, 'Devi', 'Hindu', 'GERD, sesak nafas', 'Telur, Susu sapi', '089900001111'),
(4, 'Veronica', 'Budha', 'Kanker tulang, sinusitis', 'Daging ayam', '087788889999'),
(5, 'Septiani', 'Konghucu', 'Sinusitis, asma', 'Rambut kucing', '082133334444'),
(6, 'Nuha', 'Islam', 'Kanker tenggorokan, flek paru', 'Telur, debu', '082377778888'),
(7, 'Annisa', 'Islam', 'Stroke, rematik', 'Ikan laut, tomat', '087799993333'),
(8, 'Salma', 'Islam', 'Radang usus buntu, radang tenggorokan', 'Kacang tanah', '082366667777'),
(9, 'Jamilah', 'Islam', 'Radang lambung, kencing batu', 'Kerang, polen', '082787879898'),
(10, 'Alice', 'Katolik', 'Penyempitan pembuluh darah, tekanan darah tinggi', 'Rambut kucing', '082534345656');

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
(1, 'Fulan', 'Bandung', '085677778888', 1),
(2, 'Adit', 'Jakarta', '089789899090', 7),
(3, 'Salman', 'Jakarta', '087678782323', 6),
(4, 'Steven', 'Bandung', '085267675454', 2),
(6, 'Stephen', 'Banten', '089781817272', 10),
(7, 'Indah', 'Bandung', '0888897972323', 3),
(8, 'Rina', 'Depok', '081276764949', 5),
(9, 'Ada', 'Jakarta', '087623235656', 4),
(10, 'Radit', 'Bandung', '081347476565', 8);

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

--
-- Dumping data for table `pembelian_obat`
--

INSERT INTO `pembelian_obat` (`id`, `id_daftar_obat`, `id_pelanggan`, `jumlah_obat`, `total_harga`) VALUES
(1, 4, 1, 3, 27000),
(2, 4, 9, 2, 18000),
(3, 1, 3, 2, 20000),
(4, 13, 10, 4, 15000),
(5, 14, 4, 5, 40000),
(6, 7, 7, 1, 16500),
(7, 8, 8, 2, 47000),
(8, 6, 2, 2, 20000),
(9, 5, 6, 3, 33000),
(10, 3, 4, 2, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `produsen_obat`
--

CREATE TABLE `produsen_obat` (
  `id` int(11) NOT NULL,
  `nama_produsen` varchar(50) NOT NULL,
  `alamat` text DEFAULT NULL,
  `kontak` varchar(15) DEFAULT NULL,
  `tahun_berdiri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produsen_obat`
--

INSERT INTO `produsen_obat` (`id`, `nama_produsen`, `alamat`, `kontak`, `tahun_berdiri`) VALUES
(1, 'PT ABC', 'Jl. ABC 123, Bandung', '0888999922222', 2000),
(2, 'PT EFG', 'Jl. EFG 456, Jakarta', '082345678900', 2005),
(3, 'PT AAA', 'Jl. AAA 111, Jakarta', '082342334444', 1997),
(4, 'PT EEE', 'Jl. EEE , Karawang', '084456778766', 2001),
(5, 'PT CDA', 'JL. CDA 654, Bandung', '087678789898', 2002),
(6, 'PT KPBS', 'Jl. KPBS 3876, Bekasi', '085567678989', 1995),
(7, 'PT HIJK', 'JL. HIJK 8888, Karawang', '0899000011111', 1999),
(8, 'PT RFGH', 'Jl. RFGH 3333, Bekasi', '082233334444', 2003),
(9, 'PT YUHG', 'Jl. YUHG 4444, Karawang', '085544447777', 2004),
(10, 'PT OHMN', 'Jl. OHMN 3214, Jakarta', '0811454546767', 2009),
(11, 'PT YYG', NULL, NULL, 1999),
(12, 'PT GUI', NULL, NULL, 2001);

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
  ADD KEY `fk_daftar_obat` (`id_daftar_obat`),
  ADD KEY `fk_pelanggan` (`id_pelanggan`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_pelanggan`
--
ALTER TABLE `detail_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembelian_obat`
--
ALTER TABLE `pembelian_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produsen_obat`
--
ALTER TABLE `produsen_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
