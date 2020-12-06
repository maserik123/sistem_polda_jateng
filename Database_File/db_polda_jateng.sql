-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2020 at 09:55 AM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.1.33-24+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_polda_jateng`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(1) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'Ali Gaga', 'admin', '$2y$10$ujMKMV18M5mYoRratkJ4Neg3zebsSN2XwL3dYWRlHYzC4/rB0cH2e');

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar_ranmor`
--

CREATE TABLE `tb_daftar_ranmor` (
  `id_laporan` int(3) NOT NULL,
  `id_kesatuan` varchar(50) NOT NULL,
  `no_laporan` varchar(50) NOT NULL,
  `tgl_laporan` date NOT NULL,
  `jenis_kejadian` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `tgl_kejadian` date NOT NULL,
  `modus` varchar(30) NOT NULL,
  `no_polisi` varchar(15) NOT NULL,
  `jenis_kendaraan` varchar(10) NOT NULL,
  `merk_type` varchar(30) NOT NULL,
  `tahun_pembuatan` int(4) DEFAULT NULL,
  `warna` varchar(20) NOT NULL,
  `no_rangka` varchar(50) NOT NULL,
  `no_mesin` varchar(50) NOT NULL,
  `nama_pelapor` varchar(50) DEFAULT NULL,
  `alamat_pelapor` text,
  `nama_pemilik` varchar(50) DEFAULT NULL,
  `alamat_pemilik` text,
  `create_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_daftar_ranmor`
--

INSERT INTO `tb_daftar_ranmor` (`id_laporan`, `id_kesatuan`, `no_laporan`, `tgl_laporan`, `jenis_kejadian`, `lokasi`, `tgl_kejadian`, `modus`, `no_polisi`, `jenis_kendaraan`, `merk_type`, `tahun_pembuatan`, `warna`, `no_rangka`, `no_mesin`, `nama_pelapor`, `alamat_pelapor`, `nama_pemilik`, `alamat_pemilik`, `create_date`) VALUES
(1, '2', '23', '2020-12-09', 'sdff', 'sdf', '2020-12-04', 'sdf', 'sdfsdf', 'sdfsdf', 'dsfdsf', 432, 'sdf', 'dsfdsf', 'sdfsdf', 'sdfs', 'dfsd', 'fsdf', 'fsdfs', '2020-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kesatuan`
--

CREATE TABLE `tb_kesatuan` (
  `id` int(11) NOT NULL,
  `nama_kesatuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kesatuan`
--

INSERT INTO `tb_kesatuan` (`id`, `nama_kesatuan`) VALUES
(2, 'POLRES CILACAP'),
(3, 'POLRES SEMARANG');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ranmor_jml_roda`
--

CREATE TABLE `tb_ranmor_jml_roda` (
  `id` int(11) NOT NULL,
  `id_kesatuan` text NOT NULL,
  `roda_4` text NOT NULL,
  `roda_2` text NOT NULL,
  `jumlah` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ranmor_jml_roda`
--

INSERT INTO `tb_ranmor_jml_roda` (`id`, `id_kesatuan`, `roda_4`, `roda_2`, `jumlah`, `create_date`) VALUES
(2, '3', '2', '3', '5', '2020-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ranmor_lokasi`
--

CREATE TABLE `tb_ranmor_lokasi` (
  `id` int(11) NOT NULL,
  `id_kesatuan` text NOT NULL,
  `jalan` text NOT NULL,
  `rumah` text NOT NULL,
  `tempat_parkir` text NOT NULL,
  `tempat_ibadah` text NOT NULL,
  `halaman_kantor` text NOT NULL,
  `lain_lain` text NOT NULL,
  `jumlah` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ranmor_modus_operandi`
--

CREATE TABLE `tb_ranmor_modus_operandi` (
  `id` int(11) NOT NULL,
  `id_kesatuan` text NOT NULL,
  `gelap` text NOT NULL,
  `kupal` text NOT NULL,
  `rampas` text NOT NULL,
  `tipu` text NOT NULL,
  `curras` text NOT NULL,
  `currat` text NOT NULL,
  `lain_lain` text NOT NULL,
  `jumlah` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ranmor_modus_operandi`
--

INSERT INTO `tb_ranmor_modus_operandi` (`id`, `id_kesatuan`, `gelap`, `kupal`, `rampas`, `tipu`, `curras`, `currat`, `lain_lain`, `jumlah`, `create_date`) VALUES
(1, '3', '7', '8', '8', '8', '8', '8', '8', '55', '2020-12-01'),
(2, '2', '5', '4', '3', '3', '2', '2', '3', '22', '2020-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ranmor_rekap`
--

CREATE TABLE `tb_ranmor_rekap` (
  `id` int(11) NOT NULL,
  `id_kesatuan` text NOT NULL,
  `hilang` text NOT NULL,
  `temu` text NOT NULL,
  `jumlah` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ranmor_rekap`
--

INSERT INTO `tb_ranmor_rekap` (`id`, `id_kesatuan`, `hilang`, `temu`, `jumlah`, `create_date`) VALUES
(2, '3', '30', '12', '42', '2020-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ranmor_waktu`
--

CREATE TABLE `tb_ranmor_waktu` (
  `id` int(11) NOT NULL,
  `id_kesatuan` text NOT NULL,
  `w_24_06` text NOT NULL,
  `w_06_12` text NOT NULL,
  `w_12_18` text NOT NULL,
  `w_18_24` text NOT NULL,
  `jumlah` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','manajer','unit','ka_gudang','office') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `block_status` int(3) NOT NULL,
  `online_status` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `time_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_offline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_unit` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `username`, `password`, `email`, `phone_number`, `address`, `gender`, `locale`, `picture`, `link`, `role`, `created`, `modified`, `block_status`, `online_status`, `time_online`, `time_offline`, `id_unit`) VALUES
(42, '', '', 'First', 'Administrator', 'admin_okura', '0192023a7bbd73250516f069df18b500', '', '081562442811', 'Jalan Dr. Setia Budhi No. 57, Rintis, Lima Puluh, Kota Pekanbaru, Riau (28141)', NULL, NULL, NULL, '', 'administrator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'offline', '2020-12-06 02:50:55', '2020-12-06 02:50:55', ''),
(49, '', '', 'Admin', 'Office', 'office123', '34abc02a6df39facbf57b09fc68bb256', '', '081199223344', 'Jalan Dr. Setia Budhi No. 57, Rintis, Lima Puluh, Kota Pekanbaru, Riau (28141)', NULL, NULL, NULL, '', 'office', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'online', '2020-08-02 03:51:33', '2020-08-02 03:51:33', 'U-001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_daftar_ranmor`
--
ALTER TABLE `tb_daftar_ranmor`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tb_kesatuan`
--
ALTER TABLE `tb_kesatuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ranmor_jml_roda`
--
ALTER TABLE `tb_ranmor_jml_roda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ranmor_lokasi`
--
ALTER TABLE `tb_ranmor_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ranmor_modus_operandi`
--
ALTER TABLE `tb_ranmor_modus_operandi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ranmor_rekap`
--
ALTER TABLE `tb_ranmor_rekap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ranmor_waktu`
--
ALTER TABLE `tb_ranmor_waktu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_daftar_ranmor`
--
ALTER TABLE `tb_daftar_ranmor`
  MODIFY `id_laporan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kesatuan`
--
ALTER TABLE `tb_kesatuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_ranmor_jml_roda`
--
ALTER TABLE `tb_ranmor_jml_roda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_ranmor_lokasi`
--
ALTER TABLE `tb_ranmor_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_ranmor_modus_operandi`
--
ALTER TABLE `tb_ranmor_modus_operandi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_ranmor_rekap`
--
ALTER TABLE `tb_ranmor_rekap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_ranmor_waktu`
--
ALTER TABLE `tb_ranmor_waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
