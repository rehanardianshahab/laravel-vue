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
  `barcode` varchar(1000) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `stok` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_obat`
--

INSERT INTO `daftar_obat` (`id`, `nama_obat`, `bentuk`, `barcode`, `golongan`, `stok`) VALUES
(1, 'Captopril Indofarma 12.5mg Tablet', 'Tablet', '123456789', 'Obat Keras', 10),
(2, 'Bisoprolol Fumarate 5mg Tablet Novell', 'Tablet', '1234567898', 'Obat Keras', 10),
(3, 'Gliseril Guaiakolat Mutifa 100mg Tablet', 'Tablet', '123456788', 'Obat Keras', 10),
(4, 'Claneksi 500mg', 'Tablet', '1234567895', 'Obat Keras', 8),
(5, 'Ctm Pim Otc', 'Tablet', '1236153718', 'Obat Bebas Terbatas', 20),
(6, 'Puyer Bintang 7 No.16', 'Serbuk', '1976281357889', 'Obat Bebas Terbatas', 20),
(7, 'Pamol 500mg', 'Tablet', '1010109088973', 'Obat Bebas', 8),
(8, 'Antalgin If 500mg Tablet', 'Tablet', '0987654345678', 'Obat Keras', 10),
(9, 'Konidin Loz Herbal Mint', 'Permen', '4567977543', 'Obat Herbal', 10),
(10, 'Asam Mefenamat Hexpharm 500mg', 'Tablet', '09876234678', 'Obat Keras', 10);

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

INSERT INTO `detil_obat` (`id`, `nama_standar_mims`, `nomor_izin_edar`, `komposisi`, `kemasan`, `harga`, `id_dafar_obat`) VALUES
(1, 'CAPTOPRIL INDOFARMA 12,5MG TAB', 'GKL9720916010C1', 'captopril 12,5mg', '1 Dos isi 10 Strip x 10 Tablet', 1800, 1),
(2, 'BISOPROLOL FUMARATE 5MG TAB NOVELL', 'GKL0633516517A1', 'bisoprolol hemifumarat 5mg', '1 Dos isi 10 Blister x 10 Tablet', 10000, 2),
(3, 'GLISERIL GUAIAKOLAT MUTIFA 100 MG TAB 1000S', 'GTL2144402310A1', 'gliseril guaikolat 100mg', 'Dus, 10 strip @10 tablet', 7000, 3),
(4, 'CLANEKSI 500MG TAB', 'DKL9322214509A1', 'amoxicilin 500 mg dan asam klavulanat 125 mg', '1 Dos isi 5 Strip x 6 Tablet', 3500, 4),
(5, 'CTM PIM OTC STR 12S', 'DTL7218907010A1', 'Klorfeniramin maleat 4 mg', '1 Strip', 2500, 5),
(6, 'PUYER BINTANG 7 NO.16', 'DBL7202812223A1', 'Acidum Acetylsalicylicum 50 mg, acetaminophenum 275 mg, coffeinum 50 mg', '1 Pack isi 12 Pcs', 1500, 6),
(7, 'PAMOL 500MG TAB 10S AMPLOP 10S', 'DBL9117606810A1', 'Paracetamol/acetaminophenum', '1 Dos isi 10 Strip x 10 Tablet', 2700, 7),
(8, 'ANTALGIN IF 500MG TAB STR', 'GKL9420906010A1', 'Metampiron 500 mg', '1 Dos isi 10 Strip x 10 Tablet', 3500, 8),
(9, 'KONIDIN LOZ HERBAL MINT', 'MD 824411279011', 'Sugar, Glucose ,Herbal Extract Flavour, Herbal Flavour, Menthol', '1 Pcs', 4500, 9),
(10, 'ASAM MEFENAMAT HEXPHARM 500MG', 'GKL1308517404A1', 'asam mefenamat 500 mg', '1 Dos isi 10 Strip x 10 Tablet', 4500, 10);

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

INSERT INTO `karyawan` (`id`, `nama`, `nik`, `no_telp`, `jabatan`) VALUES
(1, 'Putu I Wayan Rukyah', '331445567789', '0851234567', 'Karyawan'),
(2, 'Pujiawan Listanto', '33145678910', '0852345345', 'Karyawan'),
(3, 'Tamarin Cigirate', '331456789001', '0812935492', 'apoteker'),
(4, 'Liliana Cyntiya', '3314567778899', '0851234500', 'Asisten Apoteker'),
(5, 'Ahmad Sidoarjo', '331445567789', '0851234509', 'Keaman'),
(6, 'Levy Lion', '33211349897', '088123245', 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL DEFAULT current_timestamp(),
  `nama_pembeli` varchar(100) NOT NULL,
  `id_dafar_obat` int(11) NOT NULL,
  `Jumlah_penjualan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_resep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal`, `waktu`, `nama_pembeli`, `id_dafar_obat`, `Jumlah_penjualan`, `id_karyawan`, `id_resep`) VALUES
(1, '2022-11-08', '10:22:39', 'Murdin', 7, 2, 4, NULL),
(2, '2022-11-24', '07:15:29', 'Suryani', 9, 5, 6, NULL),
(3, '2022-11-26', '10:47:28', 'Kasiman', 6, 3, 4, NULL),
(4, '2022-11-27', '15:18:41', 'Kasiman', 6, 2, 6, NULL),
(5, '2022-11-24', '13:19:43', 'Kartimin', 9, 5, 3, NULL),
(6, '2022-11-08', '16:37:37', 'Sumiyati', 7, 1, 4, 1),
(7, '2022-11-08', '16:37:37', 'Sumiyati', 5, 1, 4, 1),
(8, '2022-11-08', '13:37:37', 'Sumiyati', 8, 1, 4, 1),
(9, '2022-11-29', '09:10:00', 'Wagiman', 5, 2, 6, 2),
(10, '2022-11-29', '09:10:00', 'Wagiman', 7, 2, 6, 2),
(11, '2022-11-29', '09:10:00', 'Wagiman', 3, 2, 6, 2),
(12, '2022-11-24', '13:30:30', 'Andi', 8, 3, 4, 3),
(13, '2022-11-28', '14:26:00', 'Fatma', 1, 2, 3, 4),
(14, '2022-11-28', '14:26:00', 'Fatma', 2, 3, 3, 4),
(15, '2022-11-28', '10:23:16', 'Mamat', 7, 2, 6, 5),
(16, '2022-11-28', '10:23:16', 'Mamat', 8, 2, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `no_resep` varchar(100) NOT NULL,
  `dokter_resep` varchar(100) NOT NULL,
  `daftar_obat` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id`, `nama_pasien`, `no_resep`, `dokter_resep`, `daftar_obat`) VALUES
(1, 'Sumiyati', '123534256', 'Dr. Budi', 'Antalgin, paracetamol, ctm '),
(2, 'Wagiman', '19190909', 'Dr. sri Hardjo', 'Ctm, Pct, GG'),
(3, 'Andi', '34345678', 'Dr. Stacy', 'Antalgin'),
(4, 'Andito Latif', '1209109483', 'Dr. Anggi', 'Captopril, Biosprol'),
(5, 'Maryanto', '1234598765', 'Dr. Mutia', 'Acetaminophenum, Methampiron');

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
