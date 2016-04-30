-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2016 at 12:45 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `direktorat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `email`, `level`, `status`, `direktorat`) VALUES
(1, 'Yohanes Christomas Daimler', 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'yohanes.christomas@gmail.com', 0, 1, ''),
(3, 'BPP 3802', 'bpp3802', '3e162394472f9b09c72321b192bf13816df99aff55020c70d83719c1d01c1f80a62951ad466516080479be82f28ebd1ac268d3051725cdb9f4e6260530bb7c5f', 'bpp3802@gmail.com', 2, 1, '3802'),
(4, 'prima', 'prima', '2ab4d65bbf25926a7693fcd2aef1294644fb848d09520bb8d52c16344d6505a7ee75060559d8c6cdefddba3a26491ec7d5a71b936e1bfef19df7369d03c2abfe', 'prima@kemenpora.go.id', 2, 1, '3833'),
(5, 'perlengkapan', 'perlengkapan', '66a120c72eb7180a8f37683d5b8cc7b58e0b3c47e834e01f2272b53033bd4fe1d0e4426f441caa934086a8ef739023cdc1db0d6e1d4a86ce57c77df50f64a261', 'perlengkapan@kemenpora.go.id', 2, 1, '3804');

-- --------------------------------------------------------

--
-- Table structure for table `rabview`
--

CREATE TABLE `rabview` (
  `id` int(20) NOT NULL,
  `thang` varchar(20) NOT NULL DEFAULT '-',
  `kdprogram` varchar(20) NOT NULL DEFAULT '-',
  `kdgiat` varchar(20) NOT NULL DEFAULT '-',
  `kdoutput` varchar(20) NOT NULL DEFAULT '-',
  `kdsoutput` varchar(20) NOT NULL DEFAULT '-',
  `kdkmpnen` varchar(20) NOT NULL DEFAULT '-',
  `kdskmpnen` varchar(20) NOT NULL DEFAULT '-',
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `volume` int(16) NOT NULL DEFAULT '0',
  `satuan` varchar(16) NOT NULL,
  `jumlah` decimal(20,3) NOT NULL DEFAULT '0.000',
  `status` int(5) NOT NULL DEFAULT '0',
  `pesan` text NOT NULL,
  `submit_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `submit_by` int(20) NOT NULL,
  `approve_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approve_by` int(20) NOT NULL,
  `idtriwulan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rkakl_full`
--

CREATE TABLE `rkakl_full` (
  `IDRKAKL` varchar(255) NOT NULL,
  `THANG` varchar(20) NOT NULL DEFAULT '-',
  `KDDEPT` varchar(4) NOT NULL DEFAULT '-',
  `KDUNIT` varchar(2) NOT NULL DEFAULT '-',
  `KDPROGRAM` varchar(4) NOT NULL DEFAULT '-',
  `KDGIAT` varchar(4) NOT NULL DEFAULT '-',
  `NMGIAT` varchar(255) NOT NULL DEFAULT '-',
  `KDOUTPUT` varchar(4) NOT NULL DEFAULT '-',
  `NMOUTPUT` varchar(255) NOT NULL DEFAULT '-',
  `KDSOUTPUT` varchar(4) NOT NULL DEFAULT '-',
  `NMSOUTPUT` varchar(255) NOT NULL DEFAULT '-',
  `KDKMPNEN` varchar(4) NOT NULL DEFAULT '-',
  `NMKMPNEN` varchar(255) NOT NULL DEFAULT '-',
  `KDSKMPNEN` varchar(4) NOT NULL DEFAULT '-',
  `NMSKMPNEN` varchar(255) NOT NULL DEFAULT '-',
  `KDAKUN` varchar(6) NOT NULL DEFAULT '-',
  `NMAKUN` varchar(255) NOT NULL DEFAULT '-',
  `KDITEM` varchar(4) NOT NULL DEFAULT '-',
  `NMITEM` varchar(255) NOT NULL DEFAULT '-',
  `VOLKEG` int(8) NOT NULL DEFAULT '0',
  `SATKEG` varchar(12) NOT NULL DEFAULT '-',
  `HARGASAT` decimal(20,3) NOT NULL DEFAULT '0.000',
  `JUMLAH` decimal(20,3) NOT NULL DEFAULT '0.000',
  `TRIWULAN1` decimal(20,3) NOT NULL DEFAULT '0.000',
  `TRIWULAN2` decimal(20,3) NOT NULL DEFAULT '0.000',
  `TRIWULAN3` decimal(20,3) NOT NULL DEFAULT '0.000',
  `TRIWULAN4` decimal(20,3) NOT NULL DEFAULT '0.000',
  `REALISASI` decimal(20,3) NOT NULL DEFAULT '0.000',
  `USULAN` decimal(20,3) NOT NULL DEFAULT '0.000',
  `SDANA` varchar(4) NOT NULL DEFAULT '-',
  `STATUS` tinyint(4) NOT NULL DEFAULT '0',
  `VERSI` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rkakl_view`
--

CREATE TABLE `rkakl_view` (
  `id` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `no_dipa` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesave` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tahun` int(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `versi` int(12) NOT NULL DEFAULT '0',
  `pesan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `triwulan`
--

CREATE TABLE `triwulan` (
  `id` int(32) NOT NULL,
  `thang` int(4) NOT NULL,
  `nama` varchar(16) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `prog_high` int(8) NOT NULL DEFAULT '0',
  `prog_med` int(8) NOT NULL DEFAULT '0',
  `prog_low` int(8) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rabview`
--
ALTER TABLE `rabview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rkakl_full`
--
ALTER TABLE `rkakl_full`
  ADD PRIMARY KEY (`IDRKAKL`);

--
-- Indexes for table `rkakl_view`
--
ALTER TABLE `rkakl_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `triwulan`
--
ALTER TABLE `triwulan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rabview`
--
ALTER TABLE `rabview`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rkakl_view`
--
ALTER TABLE `rkakl_view`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `triwulan`
--
ALTER TABLE `triwulan`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
