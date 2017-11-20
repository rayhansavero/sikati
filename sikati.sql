-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 01:35 PM
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
-- Table structure for table `list_data_kegiatan`
--

CREATE TABLE IF NOT EXISTS `list_data_kegiatan` (
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

CREATE TABLE IF NOT EXISTS `list_judul_kegiatan` (
  `ID_JUDUL` varchar(3) NOT NULL,
  `JUDUL_KEGIATAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_kas_rutin`
--

CREATE TABLE IF NOT EXISTS `list_kas_rutin` (
  `ID_KAS` varchar(4) NOT NULL,
  `ID_PENGURUS` varchar(3) DEFAULT NULL,
  `ID_MASTER` varchar(4) DEFAULT NULL,
  `TGL` date DEFAULT NULL,
  `JUMLAH` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_pengurus`
--

CREATE TABLE IF NOT EXISTS `list_pengurus` (
  `ID_PENGURUS` varchar(3) NOT NULL,
  `NAMA_PENGURUS` varchar(30) DEFAULT NULL,
  `T_ID_fk` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_pengurus`
--

INSERT INTO `list_pengurus` (`ID_PENGURUS`, `NAMA_PENGURUS`, `T_ID_fk`) VALUES
('e12', 'aaa', 'th1'),
('e45', 'bbb', 'th2'),
('e67', 'ccc', 'th2');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE IF NOT EXISTS `master` (
  `ID_MASTER` varchar(4) NOT NULL,
  `TGL` date DEFAULT NULL,
  `DEBET_MS` varchar(8) DEFAULT NULL,
  `KREDIT_MS` varchar(8) DEFAULT NULL,
  `KET_MS` varchar(50) DEFAULT NULL,
  `SALDO_MS` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `th_pengurusan`
--

CREATE TABLE IF NOT EXISTS `th_pengurusan` (
  `T_ID` varchar(3) NOT NULL,
  `TAHUN` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `th_pengurusan`
--

INSERT INTO `th_pengurusan` (`T_ID`, `TAHUN`) VALUES
('th1', 2016),
('th2', 2017),
('th3', 2018);

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
 ADD PRIMARY KEY (`ID_DATA`), ADD KEY `FK_DEBET_DAN_KREDIT` (`ID_MASTER`), ADD KEY `FK_MEMILIKI` (`ID_JUDUL`);

--
-- Indexes for table `list_judul_kegiatan`
--
ALTER TABLE `list_judul_kegiatan`
 ADD PRIMARY KEY (`ID_JUDUL`);

--
-- Indexes for table `list_kas_rutin`
--
ALTER TABLE `list_kas_rutin`
 ADD PRIMARY KEY (`ID_KAS`), ADD KEY `FK_DEBET` (`ID_MASTER`), ADD KEY `FK_MEMBAYAR` (`ID_PENGURUS`);

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
-- Indexes for table `th_pengurusan`
--
ALTER TABLE `th_pengurusan`
 ADD PRIMARY KEY (`T_ID`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
