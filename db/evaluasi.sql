-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2016 at 10:24 PM
-- Server version: 5.5.47-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

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
-- Table structure for table `direktorat`
--

CREATE TABLE IF NOT EXISTS `direktorat` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `ppk` varchar(255) DEFAULT NULL,
  `nip_ppk` varchar(30) DEFAULT NULL,
  `bpp` varchar(255) DEFAULT NULL,
  `nip_bpp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kuitansi`
--

CREATE TABLE IF NOT EXISTS `kuitansi` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `no_kuitansi` int(20) DEFAULT NULL,
  `no_kuitansi_update` int(20) DEFAULT NULL,
  `rabview_id` int(20) DEFAULT NULL,
  `thang` varchar(20) DEFAULT NULL,
  `kdprogram` varchar(20) DEFAULT NULL,
  `kdgiat` varchar(20) DEFAULT NULL,
  `kdoutput` varchar(20) DEFAULT NULL,
  `kdsoutput` varchar(20) DEFAULT NULL,
  `kdkmpnen` varchar(20) DEFAULT NULL,
  `kdskmpnen` varchar(20) DEFAULT NULL,
  `kdakun` varchar(20) DEFAULT NULL,
  `noitem` varchar(20) DEFAULT NULL,
  `deskripsi` text,
  `tanggal` date DEFAULT NULL,
  `tanggal_akhir` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `uang_muka` decimal(20,3) DEFAULT '0.000',
  `realisasi_spj` decimal(20,3) DEFAULT '0.000',
  `realisasi_pajak` decimal(20,3) DEFAULT '0.000',
  `sisa` decimal(20,3) DEFAULT '0.000',
  `status` int(5) DEFAULT '0',
  `jenis` int(5) DEFAULT NULL,
  `penerima` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `nip` varchar(255) NOT NULL,
  `pajak` varchar(255) DEFAULT NULL,
  `ppn` decimal(20,3) DEFAULT NULL,
  `pph` decimal(20,3) DEFAULT NULL,
  `golongan` varchar(200) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `value` decimal(20,3) DEFAULT '0.000',
  `belanja` decimal(20,3) DEFAULT '0.000',
  `honor_output` decimal(20,3) DEFAULT '0.000',
  `honor_profesi` decimal(20,3) DEFAULT '0.000',
  `uang_saku` decimal(20,3) DEFAULT '0.000',
  `trans_lokal` decimal(20,3) DEFAULT '0.000',
  `uang_harian` decimal(20,3) DEFAULT '0.000',
  `tiket` decimal(20,3) DEFAULT '0.000',
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `tingkat_jalan` varchar(10) DEFAULT NULL,
  `alat_trans` varchar(255) DEFAULT NULL,
  `kota_asal` varchar(255) DEFAULT NULL,
  `kota_tujuan` varchar(255) DEFAULT NULL,
  `taxi_asal` decimal(20,3) DEFAULT '0.000',
  `taxi_tujuan` decimal(20,3) DEFAULT '0.000',
  `airport_tax` decimal(20,3) DEFAULT '0.000',
  `rute1` varchar(255) DEFAULT NULL,
  `rute2` varchar(255) DEFAULT NULL,
  `rute3` varchar(255) DEFAULT NULL,
  `rute4` varchar(255) DEFAULT NULL,
  `harga_tiket` varchar(255) DEFAULT NULL,
  `lama_hari` varchar(255) DEFAULT NULL,
  `klmpk_hr` varchar(255) DEFAULT NULL,
  `pns` int(3) DEFAULT NULL,
  `malam` varchar(255) DEFAULT NULL,
  `biaya_akom` decimal(20,3) DEFAULT '0.000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `email`, `level`, `status`, `direktorat`) VALUES
(1, 'Yohanes Christomas Daimler', 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'yohanes.christomas@gmail.com', 0, 1, ''),
(2, 'Bendahara Pengeluaran 3802', 'bpp3802', '3e162394472f9b09c72321b192bf13816df99aff55020c70d83719c1d01c1f80a62951ad466516080479be82f28ebd1ac268d3051725cdb9f4e6260530bb7c5f', 'bpp3802@siluasipora.com', 2, 1, '3802');

-- --------------------------------------------------------

--
-- Table structure for table `rabfull`
--

CREATE TABLE IF NOT EXISTS `rabfull` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `rabview_id` int(20) DEFAULT NULL,
  `thang` varchar(20) DEFAULT NULL,
  `kdprogram` varchar(20) DEFAULT NULL,
  `kdgiat` varchar(20) DEFAULT NULL,
  `kdoutput` varchar(20) DEFAULT NULL,
  `kdsoutput` varchar(20) DEFAULT NULL,
  `kdkmpnen` varchar(20) DEFAULT NULL,
  `kdskmpnen` varchar(20) DEFAULT NULL,
  `kdakun` varchar(20) DEFAULT NULL,
  `noitem` varchar(20) DEFAULT NULL,
  `no_kuitansi` int(20) DEFAULT NULL,
  `deskripsi` text,
  `tanggal` date DEFAULT NULL,
  `tanggal_akhir` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT '0',
  `jenis` int(5) DEFAULT NULL,
  `penerima` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `nip` varchar(255) NOT NULL,
  `pajak` int(10) DEFAULT NULL,
  `pph` decimal(20,3) DEFAULT '0.000',
  `ppn` int(10) DEFAULT NULL,
  `golongan` varchar(200) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `pns` int(3) DEFAULT '1',
  `value` decimal(20,3) DEFAULT '0.000',
  `alat_trans` varchar(255) NOT NULL,
  `rute` varchar(255) NOT NULL,
  `harga_tiket` decimal(20,2) NOT NULL,
  `kota_asal` varchar(255) NOT NULL,
  `kota_tujuan` varchar(255) NOT NULL,
  `taxi_asal` decimal(20,2) NOT NULL,
  `taxi_tujuan` decimal(20,2) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `lama_hari` int(10) NOT NULL,
  `uang_harian` decimal(20,2) NOT NULL,
  `uang_muka` decimal(20,2) NOT NULL,
  `realisasi_spj` decimal(20,2) NOT NULL,
  `realisasi_pajak` decimal(20,2) NOT NULL,
  `sisa` decimal(20,2) NOT NULL,
  `biaya_akom` decimal(20,2) NOT NULL,
  `malam` decimal(20,2) NOT NULL,
  `klmpk_hr` decimal(20,2) NOT NULL,
  `rute4` decimal(20,2) NOT NULL,
  `rute3` decimal(20,2) NOT NULL,
  `rute2` decimal(20,2) NOT NULL,
  `rute1` decimal(20,2) NOT NULL,
  `airport_tax` decimal(20,2) NOT NULL,
  `tingkat_jalan` decimal(20,2) NOT NULL,
  `tiket` decimal(20,2) NOT NULL,
  `trans_lokal` decimal(20,2) NOT NULL,
  `uang_saku` decimal(20,2) NOT NULL,
  `honor_profesi` decimal(20,2) NOT NULL,
  `honor_output` decimal(20,2) NOT NULL,
  `belanja` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rabview`
--

CREATE TABLE IF NOT EXISTS `rabview` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `thang` varchar(20) DEFAULT NULL,
  `kdprogram` varchar(20) DEFAULT NULL,
  `kdgiat` varchar(20) DEFAULT NULL,
  `kdoutput` varchar(20) DEFAULT NULL,
  `kdsoutput` varchar(20) DEFAULT NULL,
  `kdkmpnen` varchar(20) NOT NULL,
  `kdskmpnen` varchar(20) DEFAULT NULL,
  `deskripsi` text,
  `tanggal` date DEFAULT NULL,
  `tanggal_akhir` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `lokasi` varchar(200) DEFAULT NULL,
  `uang_muka` decimal(20,3) NOT NULL,
  `realisasi_spj` decimal(20,3) DEFAULT NULL,
  `realisasi_pajak` decimal(20,3) DEFAULT NULL,
  `sisa` decimal(20,3) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '0',
  `pesan` text,
  `submit_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `submit_by` int(20) NOT NULL,
  `approve_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approve_by` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rkakl_full`
--

CREATE TABLE IF NOT EXISTS `rkakl_full` (
  `IDRKAKL` varchar(255) NOT NULL,
  `THANG` varchar(20) DEFAULT NULL,
  `KDDEPT` varchar(4) DEFAULT NULL,
  `KDUNIT` varchar(2) DEFAULT NULL,
  `KDPROGRAM` varchar(4) DEFAULT NULL,
  `KDGIAT` varchar(4) DEFAULT NULL,
  `NMGIAT` varchar(255) DEFAULT NULL,
  `KDOUTPUT` varchar(4) DEFAULT NULL,
  `NMOUTPUT` varchar(255) DEFAULT NULL,
  `KDSOUTPUT` varchar(4) DEFAULT NULL,
  `NMSOUTPUT` varchar(255) DEFAULT NULL,
  `KDKMPNEN` varchar(4) DEFAULT NULL,
  `NMKMPNEN` varchar(255) DEFAULT NULL,
  `KDSKMPNEN` varchar(4) DEFAULT NULL,
  `NMSKMPNEN` varchar(255) DEFAULT NULL,
  `KDAKUN` varchar(6) DEFAULT NULL,
  `NMAKUN` varchar(255) DEFAULT NULL,
  `KDITEM` varchar(4) DEFAULT NULL,
  `NMITEM` varchar(255) DEFAULT NULL,
  `VOLKEG` int(8) DEFAULT '0',
  `SATKEG` varchar(12) DEFAULT NULL,
  `HARGASAT` decimal(20,3) NOT NULL DEFAULT '0.000',
  `JUMLAH` decimal(20,3) NOT NULL DEFAULT '0.000',
  `REALISASI` decimal(20,3) NOT NULL DEFAULT '0.000',
  `USULAN` decimal(20,3) NOT NULL DEFAULT '0.000',
  `SDANA` varchar(4) DEFAULT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT '0',
  `VERSI` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IDRKAKL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
