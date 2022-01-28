-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2022 at 06:39 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nip` varchar(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `tmp_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `img_profile` varchar(255) NOT NULL DEFAULT 'profile-default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`nip`, `nama`, `pass`, `tmp_lahir`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `status`, `img_profile`) VALUES
('10000001', 'Suyono', '123', 'Sidoarjo', '1970-01-04', 'Jl. Merpati putih', 'Laki-laki', 'admin', 'profile-default.jpg'),
('10000002', 'Indah Maysari', '123', 'Jakarta', '1990-06-06', 'Jl. Ikan paus', 'Perempuan', 'guru', 'profile-default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `kode_mapel` int(5) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`kode_mapel`, `nama_mapel`, `deskripsi`) VALUES
(10001, 'Sosiologi', 'Mata pelajaran ini membahas tentang karakteristik masyarakat pedesaan yang meliputi kelompok dan organisasi, status dan stratifikasi, kekuasaan dan wewenang, struktur dan mobilitas, kemiskinan serta pola komunikasi di pedesaan. Konsep pemberdayaan masyarakat, tahapan pemberdayaan, model-model pemberdayaan masyarakat pengembangan masyarakat sebagai proses perubahan sosial, meningkatkan partisipasi masyarakat dalam upaya pengembangan peternakan berbasis potensi wilayah pedesaan.\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mengajar`
--

CREATE TABLE `tb_mengajar` (
  `id_ajar` int(5) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam` int(125) NOT NULL,
  `nip` varchar(8) NOT NULL,
  `kode_mapel` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mengajar`
--

INSERT INTO `tb_mengajar` (`id_ajar`, `hari`, `jam`, `nip`, `kode_mapel`) VALUES
(1, 'Senin', 2, '10000001', 10001),
(2, 'Selasa', 2, '10000002', 10003),
(3, 'Selasa', 2, '10000001', 10003),
(4, 'Rabu', 2, '10000001', 10003),
(5, 'Rabu', 2, '10000001', 10003),
(6, 'Senin', 1, '10000001', 10001),
(7, 'Senin', 1, '10000001', 10001),
(8, 'Rabu', 3, '10000001', 10004),
(9, 'Kamis', 3, '10000001', 10002),
(10, 'Senin', 4, '10000001', 10005);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`kode_mapel`),
  ADD UNIQUE KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD PRIMARY KEY (`id_ajar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  MODIFY `id_ajar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
