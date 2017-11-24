-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2017 at 11:43 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sikati`
--

-- --------------------------------------------------------

--
-- Table structure for table `bayar_kas`
--

CREATE TABLE IF NOT EXISTS `bayar_kas` (
  `id_kas` varchar(4) NOT NULL,
  `id_pengurus` varchar(4) NOT NULL,
  `id_tahun` varchar(4) NOT NULL,
  `tgl_bayar_kas` date NOT NULL,
  `jumlah_bayar_kas` varchar(8) NOT NULL,
  `saldo_kas` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id_kegiatan` varchar(4) NOT NULL,
  `nama_kegiatan` varchar(20) NOT NULL,
  `tgl_kegiatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_admin`
--

CREATE TABLE IF NOT EXISTS `list_admin` (
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

CREATE TABLE IF NOT EXISTS `master` (
  `id_master` varchar(4) NOT NULL,
  `tgl_master` date NOT NULL,
  `debit_master` varchar(8) NOT NULL,
  `kredit_master` varchar(8) NOT NULL,
  `saldo_master` varchar(8) NOT NULL,
  `ket_master` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `panitia_kegiatan`
--

CREATE TABLE IF NOT EXISTS `panitia_kegiatan` (
  `id_panitia` varchar(4) NOT NULL,
  `id_pengurus` varchar(4) NOT NULL,
  `id_kegiatan` varchar(4) NOT NULL,
  `nama_panitia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE IF NOT EXISTS `pengurus` (
  `id_pengurus` varchar(4) NOT NULL,
  `nama_pengurus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proses_kegiatan`
--

CREATE TABLE IF NOT EXISTS `proses_kegiatan` (
  `id_proses` varchar(4) NOT NULL,
  `id_panitia` varchar(4) NOT NULL,
  `id_kegiatan` varchar(4) NOT NULL,
  `debit_proses` varchar(8) NOT NULL,
  `saldo_proses` varchar(8) NOT NULL,
  `tgl_proses` date NOT NULL,
  `kredit_proses` varchar(8) NOT NULL,
  `ket_proses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE IF NOT EXISTS `tahun` (
  `id_tahun` varchar(4) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bayar_kas`
--
ALTER TABLE `bayar_kas`
 ADD PRIMARY KEY (`id_kas`), ADD KEY `id_pengurus` (`id_pengurus`), ADD KEY `id_tahun` (`id_tahun`);

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
-- Indexes for table `panitia_kegiatan`
--
ALTER TABLE `panitia_kegiatan`
 ADD PRIMARY KEY (`id_panitia`), ADD KEY `id_pengurus` (`id_pengurus`), ADD KEY `id_kegiatan` (`id_kegiatan`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
 ADD PRIMARY KEY (`id_pengurus`);

--
-- Indexes for table `proses_kegiatan`
--
ALTER TABLE `proses_kegiatan`
 ADD PRIMARY KEY (`id_proses`), ADD KEY `id_panitia` (`id_panitia`), ADD KEY `id_kegiatan` (`id_kegiatan`);

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
-- Constraints for table `panitia_kegiatan`
--
ALTER TABLE `panitia_kegiatan`
ADD CONSTRAINT `panitia_kegiatan_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `panitia_kegiatan_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `pengurus` (`id_pengurus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proses_kegiatan`
--
ALTER TABLE `proses_kegiatan`
ADD CONSTRAINT `proses_kegiatan_ibfk_1` FOREIGN KEY (`id_panitia`) REFERENCES `panitia_kegiatan` (`id_panitia`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `proses_kegiatan_ibfk_2` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
