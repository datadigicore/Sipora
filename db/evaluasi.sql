-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2016 at 08:25 AM
-- Server version: 5.5.49-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evaluasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE IF NOT EXISTS `grup` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `kode` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kdprogram` varchar(255) NOT NULL,
  `direktorat` varchar(255) NOT NULL,
  `kdoutput` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `direktorat` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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

CREATE TABLE IF NOT EXISTS `rabview` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rabview_log`
--

CREATE TABLE IF NOT EXISTS `rabview_log` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rkakl_full`
--

CREATE TABLE IF NOT EXISTS `rkakl_full` (
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
  `VERSI` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IDRKAKL`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rkakl_view`
--

CREATE TABLE IF NOT EXISTS `rkakl_view` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `no_dipa` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesave` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tahun` int(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `versi` int(12) NOT NULL DEFAULT '0',
  `pesan` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `triwulan`
--

CREATE TABLE IF NOT EXISTS `triwulan` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `thang` int(4) NOT NULL,
  `nama` varchar(16) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `prog_high` int(8) NOT NULL DEFAULT '0',
  `prog_med` int(8) NOT NULL DEFAULT '0',
  `prog_low` int(8) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `volume`
--

CREATE TABLE IF NOT EXISTS `volume` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
