-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2022 pada 14.45
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

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
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama`, `jenis`, `harga`, `stok`) VALUES
(1, 'Ibuprofen', 'Obat Sakit Kepala', 6000, 100),
(2, 'Naproxen', 'Obat Sakit Kepala', 8000, 50),
(3, 'Meloxicam', 'Obat Sakit Kepala', 10000, 75),
(4, 'Erythromycin', 'Antibiotik', 16000, 200),
(5, 'Dextromethorphan', 'Obat Batuk', 11000, 150),
(6, 'Phenylephrine', 'Obat Batuk', 9000, 100),
(7, 'Pheniramine', 'Obat Batuk', 8000, 50),
(8, 'Chlorpheniramine', 'Obat Batuk', 7000, 75),
(9, 'Loratadine', 'Obat Batuk', 6000, 15),
(10, 'Cetirizine', 'Obat Batuk', 5000, 150);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `telepon`) VALUES
(1, 'Fanny', 'Jl. Merdeka No. 6', '081234567891'),
(2, 'Gina', 'Jl. Sudirman No. 7', '082345678902'),
(3, 'Hendy', 'Jl. Gatot Subroto No. 8', '083456789013'),
(4, 'Icha', 'Jl. MH Thamrin No. 9', '084567890124'),
(5, 'Joni', 'Jl. Jenderal Sudirman No. 10', '085678901235'),
(6, 'Kiki', 'Jl. Merdeka No. 11', '081234567892'),
(7, 'Linda', 'Jl. Sudirman No. 12', '082345678903'),
(8, 'Mika', 'Jl. Gatot Subroto No. 13', '083456789014'),
(9, 'Nina', 'Jl. MH Thamrin No. 14', '084567890125'),
(10, 'Oki', 'Jl. Jenderal Sudirman No. 15', '085678901236');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_obat`, `jumlah`, `tanggal`) VALUES
(1, 1, 29, '2022-01-01'),
(2, 2, 25, '2022-01-02'),
(3, 3, 75, '2022-01-03'),
(4, 4, 100, '2022-01-04'),
(5, 5, 150, '2022-01-05'),
(6, 6, 50, '2022-01-06'),
(7, 7, 25, '2022-01-07'),
(8, 8, 75, '2022-01-08'),
(9, 9, 100, '2022-01-09'),
(10, 10, 150, '2022-01-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_obat`, `id_pelanggan`, `jumlah`, `tanggal`) VALUES
(1, 1, 1, 10, '2022-01-06'),
(2, 2, 2, 5, '2022-01-07'),
(3, 3, 3, 15, '2022-01-08'),
(4, 4, 4, 20, '2022-01-09'),
(5, 5, 5, 25, '2022-01-10'),
(6, 6, 1, 10, '2021-12-31'),
(7, 7, 2, 5, '2021-01-13'),
(8, 8, 3, 15, '2022-01-13'),
(9, 9, 4, 20, '2021-12-20'),
(10, 10, 5, 25, '2022-01-15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`);

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
