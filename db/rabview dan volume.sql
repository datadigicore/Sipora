-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2016 at 01:27 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

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
  `idtriwulan` int(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `volume` int(16) NOT NULL DEFAULT '0',
  `satuan` varchar(16) NOT NULL,
  `jumlah` decimal(20,3) NOT NULL DEFAULT '0.000',
  `status` int(5) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(20) NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rabview_log`
--

CREATE TABLE `rabview_log` (
  `id` int(20) NOT NULL,
  `thang` varchar(20) NOT NULL DEFAULT '-',
  `kdprogram` varchar(20) NOT NULL DEFAULT '-',
  `kdgiat` varchar(20) NOT NULL DEFAULT '-',
  `kdoutput` varchar(20) NOT NULL DEFAULT '-',
  `kdsoutput` varchar(20) NOT NULL DEFAULT '-',
  `kdkmpnen` varchar(20) NOT NULL DEFAULT '-',
  `kdskmpnen` varchar(20) NOT NULL DEFAULT '-',
  `idtriwulan` int(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `volume` int(16) NOT NULL DEFAULT '0',
  `satuan` varchar(16) NOT NULL,
  `jumlah` decimal(20,3) NOT NULL DEFAULT '0.000',
  `status` int(5) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(20) NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volume`
--

CREATE TABLE `volume` (
  `id` int(20) NOT NULL,
  `thang` varchar(20) NOT NULL DEFAULT '-',
  `kdprogram` varchar(20) NOT NULL DEFAULT '-',
  `kdgiat` varchar(20) NOT NULL DEFAULT '-',
  `kdoutput` varchar(20) NOT NULL DEFAULT '-',
  `kdsoutput` varchar(20) NOT NULL DEFAULT '-',
  `kdkmpnen` varchar(20) NOT NULL DEFAULT '-',
  `kdskmpnen` varchar(20) NOT NULL DEFAULT '-',
  `vol_target` int(20) NOT NULL,
  `vol_real` int(20) NOT NULL,
  `vol_real1` int(20) NOT NULL,
  `vol_real2` int(20) NOT NULL,
  `vol_real3` int(20) NOT NULL,
  `vol_real4` int(20) NOT NULL,
  `satuan` varchar(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(20) NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rabview`
--
ALTER TABLE `rabview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rabview_log`
--
ALTER TABLE `rabview_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volume`
--
ALTER TABLE `volume`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rabview`
--
ALTER TABLE `rabview`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rabview_log`
--
ALTER TABLE `rabview_log`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `volume`
--
ALTER TABLE `volume`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
