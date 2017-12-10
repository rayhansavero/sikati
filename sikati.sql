-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2017 at 02:22 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikati`
--

-- --------------------------------------------------------

--
-- Table structure for table `bayar_kas`
--

CREATE TABLE `bayar_kas` (
  `id_kas` varchar(6) NOT NULL,
  `id_pengurus` varchar(4) NOT NULL,
  `id_tahun` varchar(4) NOT NULL,
  `tgl_bayar_kas` date NOT NULL,
  `jumlah_bayar_kas` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayar_kas`
--

INSERT INTO `bayar_kas` (`id_kas`, `id_pengurus`, `id_tahun`, `tgl_bayar_kas`, `jumlah_bayar_kas`) VALUES
('K00001', 'E001', 'TH03', '2017-12-09', '2000'),
('K00002', 'E001', 'TH03', '2017-12-09', '2000'),
('K00003', 'E001', 'TH03', '2017-12-09', '2000'),
('K00004', 'E003', 'TH03', '2017-12-09', '2000'),
('K00005', 'E002', 'TH03', '2017-12-22', '2000'),
('K00006', 'E003', 'TH03', '2017-12-22', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` varchar(4) NOT NULL,
  `nama_kegiatan` varchar(20) NOT NULL,
  `tgl_kegiatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `tgl_kegiatan`) VALUES
('PR01', 'AOM', '2017-12-21'),
('PR02', 'DIKLATSAR', '2017-12-29'),
('PS03', 'AOM', '2017-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `list_admin`
--

CREATE TABLE `list_admin` (
  `ID_ADMIN` varchar(2) NOT NULL,
  `LEVEL` varchar(10) DEFAULT NULL,
  `PASSWORD` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_admin`
--

INSERT INTO `list_admin` (`ID_ADMIN`, `LEVEL`, `PASSWORD`) VALUES
('t1', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id_master` varchar(4) NOT NULL,
  `tgl_master` date NOT NULL,
  `debit_master` varchar(8) NOT NULL,
  `kredit_master` varchar(8) NOT NULL,
  `saldo_master` varchar(8) NOT NULL,
  `ket_master` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id_pengurus` varchar(4) NOT NULL,
  `nama_pengurus` varchar(20) NOT NULL,
  `id_tahun` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `nama_pengurus`, `id_tahun`) VALUES
('E001', 'Gus Mus', 'TH03'),
('E002', 'Cak Nun', 'TH03'),
('E003', 'Gus Dur', 'TH03');

-- --------------------------------------------------------

--
-- Table structure for table `proses_kegiatan`
--

CREATE TABLE `proses_kegiatan` (
  `id_proses` varchar(6) NOT NULL,
  `id_kegiatan` varchar(4) NOT NULL,
  `tgl_proses` date NOT NULL,
  `uraian_proses` varchar(30) NOT NULL,
  `debit_proses` varchar(8) NOT NULL,
  `kredit_proses` varchar(8) NOT NULL,
  `saldo_proses` varchar(8) NOT NULL,
  `ket_proses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proses_kegiatan`
--

INSERT INTO `proses_kegiatan` (`id_proses`, `id_kegiatan`, `tgl_proses`, `uraian_proses`, `debit_proses`, `kredit_proses`, `saldo_proses`, `ket_proses`) VALUES
('PK0001', 'PR01', '2017-12-06', 'Sumbangan dari JTI', '800000', '0', '80000', 'diterima oleh bendahara'),
('PK0002', 'PR01', '2017-12-07', 'Banner AOM', '0', '60000', '740000', ''),
('PK0003', 'PR01', '2017-12-07', 'Sewa pickup', '0', '100000', '640000', 'angkut ayam'),
('PK0004', 'PR01', '2017-12-08', 'Kas Masuk', '245000', '0', '885000', 'bulan 11');

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` varchar(4) NOT NULL,
  `pilih_tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `pilih_tahun`) VALUES
('TH03', 2017),
('TH04', 2018);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bayar_kas`
--
ALTER TABLE `bayar_kas`
  ADD PRIMARY KEY (`id_kas`),
  ADD KEY `id_pengurus` (`id_pengurus`),
  ADD KEY `id_tahun` (`id_tahun`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `list_admin`
--
ALTER TABLE `list_admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id_master`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id_pengurus`),
  ADD KEY `id_tahun` (`id_tahun`);

--
-- Indexes for table `proses_kegiatan`
--
ALTER TABLE `proses_kegiatan`
  ADD PRIMARY KEY (`id_proses`),
  ADD KEY `id_kegiatan` (`id_kegiatan`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bayar_kas`
--
ALTER TABLE `bayar_kas`
  ADD CONSTRAINT `bayar_kas_ibfk_1` FOREIGN KEY (`id_pengurus`) REFERENCES `pengurus` (`id_pengurus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bayar_kas_ibfk_2` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `pengurus_ibfk_1` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proses_kegiatan`
--
ALTER TABLE `proses_kegiatan`
  ADD CONSTRAINT `proses_kegiatan_ibfk_2` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
