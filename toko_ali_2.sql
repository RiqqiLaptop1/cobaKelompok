-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2022 at 05:06 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_ali_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_brg` int(5) NOT NULL,
  `nm_brg` varchar(30) NOT NULL,
  `harga` int(8) NOT NULL,
  `stok` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `nm_brg`, `harga`, `stok`) VALUES
(20, 'ikan cupang', 45000, 39),
(21, 'akuarium kecil', 50000, 15),
(24, 'pakan ikan kecil', 15000, 30);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `kd_kota` int(5) NOT NULL,
  `nm_kota` varchar(20) NOT NULL,
  `provinsi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`kd_kota`, `nm_kota`, `provinsi`) VALUES
(1, 'Batang', 'Jawa Tengah'),
(2, 'Comal', 'Jawa Tengah'),
(3, 'Pekalongan', 'Jawa Tengah'),
(4, 'Pemalang', 'Jawa Tengah'),
(7, 'Tegal', 'Jawa Tengah');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nm_pegawai` varchar(30) NOT NULL,
  `almt_pegawai` varchar(30) NOT NULL,
  `kota_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nm_pegawai`, `almt_pegawai`, `kota_pegawai`) VALUES
(1, 'Andi', 'Jl. Mandalika', 1),
(2, 'Budi', 'Jl. Salak', 7),
(3, 'Doni', 'Jl. Jeruk', 3),
(4, 'Nino', 'Jl. Kemarau', 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pegawai_view`
-- (See below for the actual view)
--
CREATE TABLE `pegawai_view` (
`id_pegawai` int(11)
,`nm_pegawai` varchar(30)
,`almt_pegawai` varchar(30)
,`kota_pegawai` int(11)
,`nm_kota` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `pegawai_view`
--
DROP TABLE IF EXISTS `pegawai_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pegawai_view`  AS SELECT `pegawai`.`id_pegawai` AS `id_pegawai`, `pegawai`.`nm_pegawai` AS `nm_pegawai`, `pegawai`.`almt_pegawai` AS `almt_pegawai`, `pegawai`.`kota_pegawai` AS `kota_pegawai`, `kota`.`nm_kota` AS `nm_kota` FROM (`pegawai` join `kota`) WHERE `pegawai`.`kota_pegawai` = `kota`.`kd_kota` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`kd_kota`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `kota_pegawai` (`kota_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_brg` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `kd_kota` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kota_pegawai`) REFERENCES `kota` (`kd_kota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
