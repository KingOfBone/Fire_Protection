-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2017 at 04:00 AM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apar`
--
CREATE DATABASE IF NOT EXISTS `apar` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `apar`;

-- --------------------------------------------------------

--
-- Table structure for table `apar`
--

DROP TABLE IF EXISTS `apar`;
CREATE TABLE IF NOT EXISTS `apar` (
`id_apar` int(11) NOT NULL COMMENT 'primary',
  `kode_gi` int(11) DEFAULT NULL COMMENT 'fk',
  `kode_aset` varchar(50) DEFAULT NULL COMMENT 'hidden',
  `no_apar` int(11) DEFAULT NULL COMMENT 'penting',
  `lantai` int(11) DEFAULT NULL,
  `penempatan` varchar(50) DEFAULT NULL COMMENT 'penting',
  `id_merk` varchar(100) NOT NULL COMMENT 'penting,fk',
  `tipe` varchar(50) NOT NULL COMMENT 'penting',
  `id_jenis_api` int(11) NOT NULL COMMENT 'penting,fk',
  `berat` float NOT NULL COMMENT 'penting',
  `pengisian_awal` date DEFAULT NULL COMMENT 'date',
  `foto_tacometer` varchar(50) DEFAULT NULL COMMENT 'gambar_tacometer',
  `foto_stiker` varchar(50) DEFAULT NULL COMMENT 'gambar_stiker',
  `gambar_apar` varchar(50) DEFAULT NULL COMMENT 'gambar_apar',
  `foto_lokasi` varchar(50) DEFAULT NULL COMMENT 'gambar_lokasi',
  `kondisi` enum('Kadaluarsa','Baik') DEFAULT NULL COMMENT 'penting',
  `update_by` int(11) DEFAULT NULL COMMENT 'hidden',
  `tgl_update` datetime DEFAULT NULL COMMENT 'hidden'
) ENGINE=InnoDB AUTO_INCREMENT=2439 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apar`
--

INSERT INTO `apar` (`id_apar`, `kode_gi`, `kode_aset`, `no_apar`, `lantai`, `penempatan`, `id_merk`, `tipe`, `id_jenis_api`, `berat`, `pengisian_awal`, `foto_tacometer`, `foto_stiker`, `gambar_apar`, `foto_lokasi`, `kondisi`, `update_by`, `tgl_update`) VALUES
(2436, 1, '', 1, 1, 'Ruang Kontrol', '2', 'New Generation', 2, 5, '2017-09-13', 'Tachometer APAR.jpg', 'P_20170829_104040.jpg', 'P_20170829_104020.jpg', 'Lokasi APAR.png', 'Baik', 0, '0000-00-00 00:00:00'),
(2438, 5, '', 1, 1, 'Ruang Kontrol', '2', 'Chihuahua', 2, 5, '2017-09-14', 'Tachometer APAR.jpg', 'P_20170829_104040.jpg', 'P_20170829_104020.jpg', 'Lokasi APAR.png', 'Baik', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

DROP TABLE IF EXISTS `hak_akses`;
CREATE TABLE IF NOT EXISTS `hak_akses` (
`id_hak_akses` int(11) NOT NULL,
  `kode_user` int(11) DEFAULT NULL,
  `hak_akses` enum('laporan','pemakaian','apar','maintenance','data_master','beranda') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_api`
--

DROP TABLE IF EXISTS `jenis_api`;
CREATE TABLE IF NOT EXISTS `jenis_api` (
`id_jenis_api` int(11) NOT NULL COMMENT 'penting,primary',
  `jenis_api` varchar(50) NOT NULL COMMENT 'penting'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_api`
--

INSERT INTO `jenis_api` (`id_jenis_api`, `jenis_api`) VALUES
(1, 'Dry Powder Extinguisher'),
(2, 'Gas Extinguisher'),
(3, 'Foam Extinguisher'),
(5, 'Carbondioxide Extinguisher');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

DROP TABLE IF EXISTS `merk`;
CREATE TABLE IF NOT EXISTS `merk` (
`id_merk` int(11) NOT NULL COMMENT 'primary',
  `merk` varchar(50) NOT NULL COMMENT 'penting'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id_merk`, `merk`) VALUES
(1, 'FIROTECT'),
(2, 'YAMATO'),
(3, 'CHUBB');

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian`
--

DROP TABLE IF EXISTS `pemakaian`;
CREATE TABLE IF NOT EXISTS `pemakaian` (
`kode_pemakaian` int(11) NOT NULL COMMENT 'hidden,primary',
  `kode_apar` int(11) NOT NULL COMMENT 'penting,fk',
  `tgl_pakai` date DEFAULT NULL COMMENT 'penting',
  `pengguna` varchar(50) DEFAULT NULL,
  `keterangan_pakai` varchar(150) NOT NULL COMMENT 'penting',
  `berat_terpakai` int(11) DEFAULT NULL COMMENT 'penting'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan`
--

DROP TABLE IF EXISTS `pemeliharaan`;
CREATE TABLE IF NOT EXISTS `pemeliharaan` (
`kode_pemeliharaan` int(11) NOT NULL COMMENT 'hidden,primary',
  `kode_pengisian` int(11) DEFAULT NULL COMMENT 'hidden,fk',
  `tgl_pemeliharaan` date DEFAULT NULL COMMENT 'penting',
  `penimbangan` int(11) DEFAULT NULL COMMENT 'penting',
  `indikator` enum('hijau','merah') DEFAULT NULL COMMENT 'penting',
  `update_by` int(11) DEFAULT NULL COMMENT 'hidden',
  `tgl_update` datetime DEFAULT NULL COMMENT 'hidden'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengisian`
--

DROP TABLE IF EXISTS `pengisian`;
CREATE TABLE IF NOT EXISTS `pengisian` (
`kode_pengisian` int(11) NOT NULL COMMENT 'primary',
  `kode_apar` int(11) DEFAULT NULL COMMENT 'penting,fk',
  `tgl_pengisian_terakhir` date DEFAULT NULL COMMENT 'penting',
  `tgl_pengisian_kembali` date DEFAULT NULL COMMENT 'penting',
  `tgl_update` datetime DEFAULT NULL COMMENT 'hidden',
  `update_by` int(11) DEFAULT NULL COMMENT 'hidden',
  `catatan` varchar(150) DEFAULT NULL COMMENT 'penting'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_users`
--

DROP TABLE IF EXISTS `tabel_users`;
CREATE TABLE IF NOT EXISTS `tabel_users` (
`kode_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `images` varchar(100) NOT NULL,
  `level` enum('adm','us','mnj') NOT NULL,
  `kantor` enum('gi','app','ki') DEFAULT NULL,
  `no_anggota` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_users`
--

INSERT INTO `tabel_users` (`kode_user`, `nama_lengkap`, `username`, `password`, `images`, `level`, `kantor`, `no_anggota`, `email`) VALUES
(5, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'no-images.png', 'adm', NULL, '', 'admin@gmail.com'),
(11, 'User', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'no-images.png', 'us', NULL, '', 'user@gmail.com'),
(12, 'Manajer', 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'no-images.png', 'mnj', NULL, '', 'manajer@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apar`
--
ALTER TABLE `apar`
 ADD PRIMARY KEY (`id_apar`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
 ADD PRIMARY KEY (`id_hak_akses`);

--
-- Indexes for table `jenis_api`
--
ALTER TABLE `jenis_api`
 ADD PRIMARY KEY (`id_jenis_api`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
 ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `pemakaian`
--
ALTER TABLE `pemakaian`
 ADD PRIMARY KEY (`kode_pemakaian`), ADD KEY `id_lks` (`kode_apar`) USING BTREE;

--
-- Indexes for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
 ADD PRIMARY KEY (`kode_pemeliharaan`);

--
-- Indexes for table `pengisian`
--
ALTER TABLE `pengisian`
 ADD PRIMARY KEY (`kode_pengisian`);

--
-- Indexes for table `tabel_users`
--
ALTER TABLE `tabel_users`
 ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apar`
--
ALTER TABLE `apar`
MODIFY `id_apar` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary',AUTO_INCREMENT=2439;
--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
MODIFY `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_api`
--
ALTER TABLE `jenis_api`
MODIFY `id_jenis_api` int(11) NOT NULL AUTO_INCREMENT COMMENT 'penting,primary',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pemakaian`
--
ALTER TABLE `pemakaian`
MODIFY `kode_pemakaian` int(11) NOT NULL AUTO_INCREMENT COMMENT 'hidden,primary';
--
-- AUTO_INCREMENT for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
MODIFY `kode_pemeliharaan` int(11) NOT NULL AUTO_INCREMENT COMMENT 'hidden,primary';
--
-- AUTO_INCREMENT for table `pengisian`
--
ALTER TABLE `pengisian`
MODIFY `kode_pengisian` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary';
--
-- AUTO_INCREMENT for table `tabel_users`
--
ALTER TABLE `tabel_users`
MODIFY `kode_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
