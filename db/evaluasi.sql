-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2016 at 04:45 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

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
(4, 'bpp3802', 'bpp3802', '3e162394472f9b09c72321b192bf13816df99aff55020c70d83719c1d01c1f80a62951ad466516080479be82f28ebd1ac268d3051725cdb9f4e6260530bb7c5f', 'bpp3802@gmail.com', 2, 1, '3802');

-- --------------------------------------------------------

--
-- Table structure for table `rabfull`
--

CREATE TABLE `rabfull` (
  `id` int(20) NOT NULL,
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
  `belanja` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rabview`
--

CREATE TABLE `rabview` (
  `id` int(20) NOT NULL,
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
  `volume` int(16) NOT NULL DEFAULT '0',
  `satuan` varchar(16) DEFAULT NULL,
  `jumlah` decimal(20,3) NOT NULL DEFAULT '0.000',
  `sisa` decimal(20,3) DEFAULT NULL,
  `idtriwulan` int(16) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '0',
  `pesan` text,
  `submit_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `submit_by` int(20) NOT NULL,
  `approve_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approve_by` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rkakl_full`
--

CREATE TABLE `rkakl_full` (
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
-- Indexes for table `rabfull`
--
ALTER TABLE `rabfull`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rabfull`
--
ALTER TABLE `rabfull`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
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
