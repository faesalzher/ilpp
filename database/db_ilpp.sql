-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2019 at 05:08 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ilpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `nama_akses`, `level`) VALUES
(1, 'Admin Buku Tamu', 1),
(2, 'Kedeputian I', 2),
(3, 'Kedeputian II', 2),
(4, 'Kedeputian III', 2),
(5, 'Kedeputian IV', 2),
(6, 'Kedeputian V', 2),
(7, 'Kedeputian VI', 2),
(8, 'Kedeputian VII', 2),
(9, 'PPID Informasi', 3),
(10, 'PPID Informasi Web', 4),
(11, 'PPID Kegiatan', 5),
(12, 'ULP', 6),
(13, 'Admin', 7);

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id_tamu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keperluan` varchar(1000) NOT NULL,
  `kontak` varchar(200) NOT NULL,
  `nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_informasi`
--

CREATE TABLE `laporan_informasi` (
  `id_laporan_info` int(11) NOT NULL,
  `bentuk_pelayanan` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `isi_pelayanan` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `pelaksanaan_pelayanan` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `keterangan` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_informasi_web`
--

CREATE TABLE `laporan_informasi_web` (
  `id_laporan_infoweb` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `substansi` varchar(1000) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kedeputian`
--

CREATE TABLE `laporan_kedeputian` (
  `id_laporan_deputi` int(11) NOT NULL,
  `bentuk_pelayanan` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `isi_pelayanan` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `pelaksanaan_pelayanan` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `keterangan` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pelayanan_publik`
--

CREATE TABLE `laporan_pelayanan_publik` (
  `id_laporan_pelayanan` int(11) NOT NULL,
  `pelaksana` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `kontrak` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `nilai_kontrak` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `metode` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_rapat`
--

CREATE TABLE `laporan_rapat` (
  `id_laporan_rapat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pimpinan` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_pengguna` varchar(200) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `password` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `nama_pengguna`, `id_akses`, `password`, `foto`) VALUES
(1, 'bukuTamu', 'Buku Tamu', 1, 'bbba9b4d8414fe11fdaa0a47dcc950e8', 'profil13.jpg'),
(2, 'kedeputianSatu', 'Kedeputian I', 2, 'c23a8aa246211ec74bfcadf1af764190', 'profil13.jpg'),
(3, 'kedeputianDua', 'Kedeputian II', 3, '9e2fc59950b1cf57de8c2ed08ef1a72c', 'profil13.jpg'),
(4, 'kedeputianTiga', 'Kedeputian III', 4, 'd5527052521ef13a1c85bb1579ff8c08', 'profil13.jpg'),
(5, 'kedeputianEmpat', 'Kedeputian IV', 5, 'ae6622ca07ede0ba70633379cdd9eae5', 'profil13.jpg'),
(6, 'kedeputianLima', 'Kedeputian V', 6, '165bf17a65b98845a010ea81a2281727', 'profil13.jpg'),
(7, 'kedeputianEnam', 'Kedeputian VI', 7, '7d128bcbd4be59021fcb3ba6e5fb6f35', 'profil13.jpg'),
(8, 'kedeputianTujuh', 'Kedeputian VII', 8, 'a10ee504808c6ad5a1fa3e6d54baddd2', 'profil13.jpg'),
(9, 'ppidInformasi', 'PPID Informasi', 9, '0dc91b22b7908d2f5cd80e6cc631cd79', 'profil13.jpg'),
(10, 'ppidInformasiWeb', 'PPID Informasi Web', 10, '30f488dd5f3d76cff0a26688692a2816', 'profil13.jpg'),
(11, 'ppidKegiatan', 'PPID Kegiatan', 11, '6809f9470b8baa2cc250990e9fb4560b', 'profil13.jpg'),
(12, 'unitPengadaan', 'ULP', 12, '847f55e913a1327b5519168555e22595', 'profil13.jpg'),
(13, 'adminILPP', 'Admin', 13, 'f96a77d9193fdad8a94666718a91f7e6', 'profil13.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `id_akses` (`id_akses`) USING BTREE;

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indexes for table `laporan_informasi`
--
ALTER TABLE `laporan_informasi`
  ADD PRIMARY KEY (`id_laporan_info`);

--
-- Indexes for table `laporan_informasi_web`
--
ALTER TABLE `laporan_informasi_web`
  ADD PRIMARY KEY (`id_laporan_infoweb`);

--
-- Indexes for table `laporan_kedeputian`
--
ALTER TABLE `laporan_kedeputian`
  ADD PRIMARY KEY (`id_laporan_deputi`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `laporan_pelayanan_publik`
--
ALTER TABLE `laporan_pelayanan_publik`
  ADD PRIMARY KEY (`id_laporan_pelayanan`);

--
-- Indexes for table `laporan_rapat`
--
ALTER TABLE `laporan_rapat`
  ADD PRIMARY KEY (`id_laporan_rapat`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_pengguna` (`id_pengguna`) USING BTREE,
  ADD KEY `id_akses` (`id_akses`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1381;

--
-- AUTO_INCREMENT for table `laporan_informasi`
--
ALTER TABLE `laporan_informasi`
  MODIFY `id_laporan_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `laporan_informasi_web`
--
ALTER TABLE `laporan_informasi_web`
  MODIFY `id_laporan_infoweb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `laporan_kedeputian`
--
ALTER TABLE `laporan_kedeputian`
  MODIFY `id_laporan_deputi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `laporan_pelayanan_publik`
--
ALTER TABLE `laporan_pelayanan_publik`
  MODIFY `id_laporan_pelayanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laporan_rapat`
--
ALTER TABLE `laporan_rapat`
  MODIFY `id_laporan_rapat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_kedeputian`
--
ALTER TABLE `laporan_kedeputian`
  ADD CONSTRAINT `laporan_kedeputian_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pegawai_jabatan_id_jabatan_fk` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
