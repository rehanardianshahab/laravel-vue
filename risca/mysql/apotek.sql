-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2022 pada 16.22
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

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
-- Struktur dari tabel `detail_obat`
--

CREATE TABLE `detail_obat` (
  `id_detail` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `indikasi` text NOT NULL,
  `efek_samping` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_obat`
--

INSERT INTO `detail_obat` (`id_detail`, `id_obat`, `indikasi`, `efek_samping`, `keterangan`) VALUES
(1, 1, 'antibiotik untuk mengobati berbagai infeksi bakteri', 'mual, muntah, diare, mulut kering, lidah berbulu hitam, kemerahan, Stevens-Johnson syndrome, angioedema', 'sebaiknya diminum saat perut kosong (1 jam sebelum makan atau 2 jam setelah makan)'),
(2, 2, 'mengobati berbagai masalah kesehatan, seperti gejala alergi, asma, gangguan kalenjar adrenal, masalah pada darah, kulit kemerahan, dan bengkak-bengkak pada tubuh', 'wajah membulat, tumbuh rambut-rambut, peningkatan berat badan, meningkatkan nafsu makan, keringat berlebihan, berisiko terkena infeksi, tulang menjadi keropos', 'Hindari penggunaan obat secara bersamaan jika memiliki efek interaksi yang tidak baik bagi tubuh'),
(3, 3, 'mengobati decubitus atau stasis ulser, jaringan mati pada daerah kulit yang diberikan tekanan terus-menerus sebagai akibat duduk terlalu lama, koma, atau imobilitas', 'iritasi kulit yang sangat menyakitkan, termasuk rasa terbakar, muncul lepuhan, bintik-bintik merah, gatal, kemerahan parah, atau bengkak', 'untuk pengobatan decubitus atau stasis ulser ialah menggunakan losion 20%, dan dioleskan setiap 8-12 jam sekali'),
(5, 4, 'mengobati banyak kondisi, seperti sakit kepala, nyeri otot, radang sendi, sakit punggung, sakit gigi, pilek, dan demam', 'emam, mual, nyeri lambung, kehilangan nafsu makan, urine berwarna gelap, feses berwarna cokelat kemerahan, serta mata atau kulit berwarna kuning', 'Sebelum menggunakan obat ini, perlu Kamu ketahui kalau dosis yang dianjurkan oleh dokter merupakan dosis terbaik karena disesuaikan dengan kondisi kesehatan dan tingkat keparahan penyakit'),
(6, 5, 'mengobati infeksi kulit kepala, kutu, dan kudis yang disebabkan oleh tungau yang menempel di kulit atau kutu yang hidup di kulit kepala', 'ruam kulit, gatal, kulit terasa sedikit terbakar, kebas atau geli, sakit kepala, pusing, pening, demam, nyeri lambung, mual, muntah, atau diare.', 'Simpanlah obat ini pada suhu ruang, jauhkan dari lembap dan panas'),
(7, 6, 'mengobati kondisi tertentu yang terjadi ketika pasien syok, yang disebabkan oleh serangan jantung, trauma, operasi , gagal jantung, gagal ginjal, dan kondisi medis serius lainnya', 'kelainan konduksi jantung, angina (nyeri dada), palpitasi (jantung berdebar-debar), bradikardi (denyut jantung menurun), vasokonstriksi (penyempitan pembuluh darah)', 'Dopamine diberikan secara injeksi melalui intravena dan diberikan oleh tenaga medis'),
(8, 7, 'mengobati nyeri ringan sampai sedang, atau gejala peradangan pada tulang atau peradangan pada sendi.', 'sakit perut, sering sendawa, feses berwarna hitam, urin keruh, konstipasi, diare, pening, sakit kepala, gatal-gatal pada kulit', 'Diclofenac dapat menurunkan kadar obat lithium dan digoxin dalam darah'),
(9, 8, 'mengurangi gejala demam dan mengobati nyeri atau inflamasi yang disebabkan oleh berbagai kondisi seperti sakit kepala, sakit gigi, nyeri punggung, artritis (peradangan pada sendi), kram saat haid, atau luka minor', ' sakit perut, asam lambung meningkat, sendawa, perut kembung, urine berwarna keruh, penurunan volume urine, diare, kesulitan untuk buang air besar', 'jangan berikan ibuprofen pada anak dengan usia 9. Simpan ibuprofen pada suhu ruangan dan jauhkan dari tempat yang lembab dan terkena cahaya matahari langsung'),
(10, 9, 'membantu menurunkan kadar gula darah dan menjaga agar kadar gula ini tetap normal', 'hipoglikemia yaitu saat kadar gula darah sangat rendah', 'Untuk ibu hamil dan menyusui, sebaiknya konsultasikan dulu kepada dokter sebelum menggunakan insulin'),
(11, 10, 'mengobati gangguan hiperaktif (ADHD), mengobati obesitas (antiobesitas), dan mampu meningkatkan tekanan darah (antihipotensi)', 'penglihatan buram / kabur, nyeri dada, urin berwarna gelap, sulit bernapas, rasa pusing, pingsan, denyut nadi cepat, denyut jantung tak beraturan', 'konsultasikan ke dokter jika memiliki riwayat ketergantungan terhadap obat maupun alkohol');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_obat`, `jumlah_obat`, `total_harga`) VALUES
(1, 1, 1, 5, 25000),
(2, 7, 6, 2, 30000),
(3, 3, 3, 3, 42000),
(4, 6, 9, 1, 50000),
(5, 10, 5, 5, 100000),
(6, 9, 2, 5, 30000),
(7, 7, 1, 2, 35000),
(8, 5, 8, 1, 30000),
(9, 2, 10, 2, 25000),
(10, 4, 6, 2, 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `stok` int(100) NOT NULL,
  `expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama`, `jenis`, `stok`, `expired`) VALUES
(1, 'Ampicillin', 'Tablet', 100, '2022-11-16'),
(2, 'Betametason', 'Tablet', 50, '2022-11-30'),
(3, 'Benzoyl Peroxide', 'Salep', 25, '2022-11-25'),
(4, 'Paracetamol', 'Tablet', 100, '2022-11-04'),
(5, 'Permethrin', 'Salep', 25, '2022-11-22'),
(6, 'Dopamine', 'Tablet', 50, '2022-11-11'),
(7, 'Diclofenac', 'Tablet', 50, '2022-11-20'),
(8, 'Ibuprofen', 'Tablet', 100, '2022-11-23'),
(9, 'Insulin', 'Cairan', 25, '2022-11-17'),
(10, 'Metamfetamin', 'Tablet', 25, '2022-11-25'),
(11, 'Nizatidine', 'Tablet', 40, '2022-11-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `umur`, `alamat`) VALUES
(1, 'Aditya', 24, 'Bogor'),
(3, 'Rima', 21, 'Jakarta'),
(6, 'Rudi', 27, 'Bekasi'),
(7, 'Sinta', 17, 'Depok'),
(8, 'Arin', 28, 'Jakarta'),
(9, 'Indri', 26, 'Bogor'),
(10, 'Risca', 24, 'Bogor'),
(11, 'Rahma', 22, 'Depok'),
(12, 'Bayu', 21, 'Bekasi'),
(13, 'Fajar', 15, 'Depok'),
(14, 'Zaskia', 16, 'Depok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_transaksi` varchar(15) NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `jenis_transaksi`, `id_pelanggan`) VALUES
(1, '2022-05-04', 'tunai', 1),
(2, '2022-06-04', 'tunai', 8),
(3, '2022-06-04', 'nontunai', 13),
(4, '2022-10-24', 'tunai', 12),
(5, '2022-07-27', 'nontunai', 9),
(6, '2022-11-04', 'tunai', 11),
(7, '2022-11-24', 'nontunai', 3),
(8, '2022-06-25', 'tunai', 10),
(9, '2022-10-23', 'nontunai', 6),
(10, '2022-08-03', 'tunai', 7);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detailobat` (`id_obat`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_obat` (`id_obat`),
  ADD KEY `fk_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD CONSTRAINT `fk_detailobat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`),
  ADD CONSTRAINT `fk_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
