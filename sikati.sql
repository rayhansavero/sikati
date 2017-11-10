-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2017 at 04:50 AM
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
  `ID_ADMIN` varchar(9) NOT NULL,
  `NAMA_ADMIN` varchar(30) DEFAULT NULL,
  `LEVEL` varchar(10) DEFAULT NULL,
  `PASSWORD` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_admin`
--

INSERT INTO `list_admin` (`ID_ADMIN`, `NAMA_ADMIN`, `LEVEL`, `PASSWORD`) VALUES
('e41150559', 'Rayhan Savero', 'Bendahara', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `list_data_kegiatan`
--

CREATE TABLE `list_data_kegiatan` (
  `ID_DATA` varchar(3) NOT NULL,
  `ID_JUDUL` varchar(3) DEFAULT NULL,
  `ID_MASTER` varchar(3) DEFAULT NULL,
  `URAIAN` varchar(30) DEFAULT NULL,
  `DEBIT_KGT` float(8,0) DEFAULT NULL,
  `KREDIT_KGT` float(8,0) DEFAULT NULL,
  `JUMLAH` float(8,0) DEFAULT NULL,
  `TANGGAL` date DEFAULT NULL,
  `KETERANGAN` varchar(30) DEFAULT NULL
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
  `ID_KAS` varchar(3) NOT NULL,
  `ID_PENGURUS` varchar(9) DEFAULT NULL,
  `ID_MASTER` varchar(3) DEFAULT NULL,
  `TGL` date DEFAULT NULL,
  `JUMLAH` float(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_pengurus`
--

CREATE TABLE `list_pengurus` (
  `ID_PENGURUS` varchar(9) NOT NULL,
  `NAMA_PENGURUS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_pengurus`
--

INSERT INTO `list_pengurus` (`ID_PENGURUS`, `NAMA_PENGURUS`) VALUES
('E41150001', 'Handoko Sujat'),
('E41152345', 'Joko Sableng');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `ID_MASTER` varchar(3) NOT NULL,
  `TGL` date DEFAULT NULL,
  `DEBET_MS` float(8,0) DEFAULT NULL,
  `KREDIT_MS` float(8,0) DEFAULT NULL,
  `KET_MS` varchar(30) DEFAULT NULL,
  `SALDO_MS` float(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD KEY `FK_DEBET` (`ID_MASTER`),
  ADD KEY `FK_MEMBAYAR` (`ID_PENGURUS`);

--
-- Indexes for table `list_pengurus`
--
ALTER TABLE `list_pengurus`
  ADD PRIMARY KEY (`ID_PENGURUS`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`ID_MASTER`);

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
  ADD CONSTRAINT `FK_DEBET` FOREIGN KEY (`ID_MASTER`) REFERENCES `master` (`ID_MASTER`),
  ADD CONSTRAINT `FK_MEMBAYAR` FOREIGN KEY (`ID_PENGURUS`) REFERENCES `list_pengurus` (`ID_PENGURUS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
