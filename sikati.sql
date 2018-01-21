-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2018 at 04:22 PM
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
('K00001', 'E001', 'TH01', '2018-01-09', '2000'),
('K00002', 'E002', 'TH01', '2018-01-09', '2000'),
('K00003', 'E003', 'TH01', '2018-01-09', '2000'),
('K00004', 'E004', 'TH01', '2018-01-09', '4000'),
('K00005', 'E001', 'TH01', '2018-01-16', '2000'),
('K00006', 'E002', 'TH01', '2018-01-16', '2000'),
('K00007', 'E003', 'TH01', '2018-01-16', '2000'),
('K00008', 'E005', 'TH01', '2018-01-16', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `buku_besar_kas`
--

CREATE TABLE `buku_besar_kas` (
  `id_bbs` varchar(6) NOT NULL,
  `tgl_bbs` date NOT NULL,
  `uraian_bbs` varchar(30) NOT NULL,
  `debit_bbs` varchar(8) NOT NULL,
  `kredit_bbs` varchar(8) NOT NULL,
  `saldo_bbs` varchar(8) NOT NULL,
  `ket_bbs` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku_besar_kas`
--

INSERT INTO `buku_besar_kas` (`id_bbs`, `tgl_bbs`, `uraian_bbs`, `debit_bbs`, `kredit_bbs`, `saldo_bbs`, `ket_bbs`) VALUES
('BB0001', '2018-01-16', 'kas masuk januari 2018', '22000', '0', '22000', 'pemasukan selama 2 minggu'),
('BB0002', '2018-01-18', 'Sumbangan dari JTI', '200000', '0', '222000', 'diterima oleh bendahara'),
('BB0003', '2018-01-18', 'beli sapu', '0', '15000', '207000', '1 buah'),
('BB0004', '2018-01-19', 'beli kertas a4 1 rim', '0', '30000', '177000', '');

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
('PR01', 'AOM', '2018-02-10'),
('PS02', 'AOM', '2018-02-10');

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
('t2', 'kahim', '1234'),
('t3', 'bendahara', '1234');

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
('E001', 'Habib Anis', 'TH01'),
('E002', 'Habib Lutfi', 'TH01'),
('E003', 'Gus Mus', 'TH01'),
('E004', 'Cak Nun', 'TH01'),
('E005', 'Gus Nuril', 'TH01');

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
('PK0001', 'PR01', '2018-01-23', 'Sumbangan Ketua Jurusan', '300000', '0', '300000', 'diterima oleh bendahara'),
('PK0002', 'PR01', '2018-01-24', 'beli air gelas', '0', '28000', '272000', '2 dus'),
('PK0003', 'PR01', '2018-01-25', 'sewa sound', '0', '100000', '172000', ''),
('PK0004', 'PR01', '2018-01-25', 'sewa panggung', '0', '100000', '72000', ''),
('PK0005', 'PS02', '2018-02-11', 'sisa dana pra kegiatan AOM', '72000', '0', '72000', '');

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
('TH01', 2018),
('TH02', 2019);

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
-- Indexes for table `buku_besar_kas`
--
ALTER TABLE `buku_besar_kas`
  ADD PRIMARY KEY (`id_bbs`);

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
