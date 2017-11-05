-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2017 at 05:48 AM
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
-- Table structure for table `list_anggota`
--

CREATE TABLE `list_anggota` (
  `id` int(11) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_anggota`
--

INSERT INTO `list_anggota` (`id`, `nama_anggota`) VALUES
(1, 'Handoko'),
(2, 'Sujatmiko'),
(3, 'Haryono'),
(4, 'Joko Sableng');

-- --------------------------------------------------------

--
-- Table structure for table `list_kas_rutin`
--

CREATE TABLE `list_kas_rutin` (
  `id` int(4) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `jml_kas` varchar(8) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_kas_rutin`
--

INSERT INTO `list_kas_rutin` (`id`, `nama_anggota`, `jml_kas`, `tgl_bayar`) VALUES
(1, 'Haryono', '5000', '2017-11-01'),
(2, 'Joko Sableng', '8000', '2017-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `list_kegiatan`
--

CREATE TABLE `list_kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` varchar(30) NOT NULL,
  `debit` varchar(8) NOT NULL,
  `kredit` varchar(8) NOT NULL,
  `jumlah` varchar(8) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_anggota`
--
ALTER TABLE `list_anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_kas_rutin`
--
ALTER TABLE `list_kas_rutin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_kegiatan`
--
ALTER TABLE `list_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_anggota`
--
ALTER TABLE `list_anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `list_kas_rutin`
--
ALTER TABLE `list_kas_rutin`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `list_kegiatan`
--
ALTER TABLE `list_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
