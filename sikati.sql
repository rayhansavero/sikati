-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 09:47 AM
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
-- Table structure for table `list_admin`
--

CREATE TABLE `list_admin` (
  `ID_ADMIN` varchar(2) NOT NULL,
  `NAMA_ADMIN` varchar(30) NOT NULL,
  `LEVEL` varchar(10) DEFAULT NULL,
  `PASSWORD` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_admin`
--

INSERT INTO `list_admin` (`ID_ADMIN`, `NAMA_ADMIN`, `LEVEL`, `PASSWORD`) VALUES
('A1', 'Rayhan Savero', 'KAHIM', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `list_data_kegiatan`
--

CREATE TABLE `list_data_kegiatan` (
  `ID_DATA` varchar(4) NOT NULL,
  `ID_JUDUL` varchar(3) DEFAULT NULL,
  `ID_MASTER` varchar(4) DEFAULT NULL,
  `URAIAN` varchar(30) DEFAULT NULL,
  `DEBIT_KGT` varchar(8) DEFAULT NULL,
  `KREDIT_KGT` varchar(8) DEFAULT NULL,
  `JUMLAH` varchar(8) DEFAULT NULL,
  `TANGGAL` date DEFAULT NULL,
  `KETERANGAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_judul_kegiatan`
--

CREATE TABLE `list_judul_kegiatan` (
  `ID_JUDUL` varchar(3) NOT NULL,
  `JUDUL_KEGIATAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_kas_rutin`
--

CREATE TABLE `list_kas_rutin` (
  `ID_KAS` varchar(4) NOT NULL,
  `ID_PENGURUS` varchar(3) DEFAULT NULL,
  `TANGGAL` date NOT NULL,
  `JUMLAH` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_kas_rutin`
--

INSERT INTO `list_kas_rutin` (`ID_KAS`, `ID_PENGURUS`, `TANGGAL`, `JUMLAH`) VALUES
('K001', 'P01', '2017-11-14', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `list_pengurus`
--

CREATE TABLE `list_pengurus` (
  `ID_PENGURUS` varchar(3) NOT NULL,
  `NAMA_PENGURUS` varchar(30) DEFAULT NULL,
  `PERIODE` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_pengurus`
--

INSERT INTO `list_pengurus` (`ID_PENGURUS`, `NAMA_PENGURUS`, `PERIODE`) VALUES
('P01', 'HAN', '2017');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_admin`
--
ALTER TABLE `list_admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `list_data_kegiatan`
--
ALTER TABLE `list_data_kegiatan`
  ADD PRIMARY KEY (`ID_DATA`),
  ADD KEY `FK_DEBET_DAN_KREDIT` (`ID_MASTER`),
  ADD KEY `FK_MEMILIKI` (`ID_JUDUL`);

--
-- Indexes for table `list_judul_kegiatan`
--
ALTER TABLE `list_judul_kegiatan`
  ADD PRIMARY KEY (`ID_JUDUL`);

--
-- Indexes for table `list_kas_rutin`
--
ALTER TABLE `list_kas_rutin`
  ADD PRIMARY KEY (`ID_KAS`),
  ADD KEY `FK_MEMBAYAR` (`ID_PENGURUS`);

--
-- Indexes for table `list_pengurus`
--
ALTER TABLE `list_pengurus`
  ADD PRIMARY KEY (`ID_PENGURUS`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_data_kegiatan`
--
ALTER TABLE `list_data_kegiatan`
  ADD CONSTRAINT `FK_DEBET_DAN_KREDIT` FOREIGN KEY (`ID_MASTER`) REFERENCES `master` (`ID_MASTER`),
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_JUDUL`) REFERENCES `list_judul_kegiatan` (`ID_JUDUL`);

--
-- Constraints for table `list_kas_rutin`
--
ALTER TABLE `list_kas_rutin`
  ADD CONSTRAINT `FK_MEMBAYAR` FOREIGN KEY (`ID_PENGURUS`) REFERENCES `list_pengurus` (`ID_PENGURUS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
