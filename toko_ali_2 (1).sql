-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2022 at 04:09 AM
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_cust` int(11) NOT NULL,
  `nm_cust` varchar(30) NOT NULL,
  `almt_cust` varchar(30) NOT NULL,
  `kota_cust` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_cust`, `nm_cust`, `almt_cust`, `kota_cust`) VALUES
(1, 'Bawon', 'Jl Tondano', 3),
(2, 'Sumardi', 'Jl Anggur', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_view`
-- (See below for the actual view)
--
CREATE TABLE `customer_view` (
`id_cust` int(11)
,`nm_cust` varchar(30)
,`almt_cust` varchar(30)
,`kota_cust` int(11)
,`nm_kota` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `detail_trans_jual`
--

CREATE TABLE `detail_trans_jual` (
  `nota` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_trans_jual`
--

INSERT INTO `detail_trans_jual` (`nota`, `id_brg`, `harga`, `jumlah`, `total`) VALUES
(1, 21, 50000, 1, 50000),
(1, 20, 45000, 2, 90000),
(1, 24, 15000, 1, 15000),
(3, 21, 50000, 1, 50000),
(3, 20, 45000, 1, 45000),
(3, 24, 15000, 1, 15000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_trans_jual_view`
-- (See below for the actual view)
--
CREATE TABLE `detail_trans_jual_view` (
`nota` int(11)
,`id_brg` int(11)
,`nm_brg` varchar(30)
,`harga` int(11)
,`jumlah` int(11)
,`total` int(11)
);

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
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_suppl` int(11) NOT NULL,
  `nm_suppl` varchar(30) NOT NULL,
  `almt_suppl` varchar(30) NOT NULL,
  `kota_suppl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_suppl`, `nm_suppl`, `almt_suppl`, `kota_suppl`) VALUES
(1, 'PT. TAMBAK EMAS', 'JL. SEJAHTERA', 4),
(2, 'PT. IKAN HIAS', 'JL. SULOYO', 7),
(4, 'sfagh', 'g', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `supplier_view`
-- (See below for the actual view)
--
CREATE TABLE `supplier_view` (
`id_suppl` int(11)
,`nm_suppl` varchar(30)
,`almt_suppl` varchar(30)
,`kota_suppl` int(11)
,`nm_kota` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `trans_jual`
--

CREATE TABLE `trans_jual` (
  `nota` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp(),
  `total_bayar` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trans_jual`
--

INSERT INTO `trans_jual` (`nota`, `id_cust`, `tgl`, `total_bayar`, `id_pegawai`) VALUES
(1, 1, '2022-06-24 16:23:38', 155000, 1),
(3, 1, '2022-06-24 22:52:12', 110000, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `trans_jual_view`
-- (See below for the actual view)
--
CREATE TABLE `trans_jual_view` (
`nota` int(11)
,`id_cust` int(11)
,`nm_cust` varchar(30)
,`tgl` date
,`total_bayar` int(11)
,`id_pegawai` int(11)
,`nm_pegawai` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure for view `customer_view`
--
DROP TABLE IF EXISTS `customer_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_view`  AS SELECT `customer`.`id_cust` AS `id_cust`, `customer`.`nm_cust` AS `nm_cust`, `customer`.`almt_cust` AS `almt_cust`, `customer`.`kota_cust` AS `kota_cust`, `kota`.`nm_kota` AS `nm_kota` FROM (`customer` join `kota`) WHERE `customer`.`kota_cust` = `kota`.`kd_kota` ;

-- --------------------------------------------------------

--
-- Structure for view `detail_trans_jual_view`
--
DROP TABLE IF EXISTS `detail_trans_jual_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_trans_jual_view`  AS SELECT `detail_trans_jual`.`nota` AS `nota`, `detail_trans_jual`.`id_brg` AS `id_brg`, `barang`.`nm_brg` AS `nm_brg`, `detail_trans_jual`.`harga` AS `harga`, `detail_trans_jual`.`jumlah` AS `jumlah`, `detail_trans_jual`.`total` AS `total` FROM (`detail_trans_jual` join `barang`) WHERE `detail_trans_jual`.`id_brg` = `barang`.`id_brg` ;

-- --------------------------------------------------------

--
-- Structure for view `pegawai_view`
--
DROP TABLE IF EXISTS `pegawai_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pegawai_view`  AS SELECT `pegawai`.`id_pegawai` AS `id_pegawai`, `pegawai`.`nm_pegawai` AS `nm_pegawai`, `pegawai`.`almt_pegawai` AS `almt_pegawai`, `pegawai`.`kota_pegawai` AS `kota_pegawai`, `kota`.`nm_kota` AS `nm_kota` FROM (`pegawai` join `kota`) WHERE `pegawai`.`kota_pegawai` = `kota`.`kd_kota` ;

-- --------------------------------------------------------

--
-- Structure for view `supplier_view`
--
DROP TABLE IF EXISTS `supplier_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supplier_view`  AS SELECT `supplier`.`id_suppl` AS `id_suppl`, `supplier`.`nm_suppl` AS `nm_suppl`, `supplier`.`almt_suppl` AS `almt_suppl`, `supplier`.`kota_suppl` AS `kota_suppl`, `kota`.`nm_kota` AS `nm_kota` FROM (`supplier` join `kota`) WHERE `supplier`.`kota_suppl` = `kota`.`kd_kota` ;

-- --------------------------------------------------------

--
-- Structure for view `trans_jual_view`
--
DROP TABLE IF EXISTS `trans_jual_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `trans_jual_view`  AS SELECT `trans_jual`.`nota` AS `nota`, `trans_jual`.`id_cust` AS `id_cust`, `customer`.`nm_cust` AS `nm_cust`, cast(`trans_jual`.`tgl` as date) AS `tgl`, `trans_jual`.`total_bayar` AS `total_bayar`, `trans_jual`.`id_pegawai` AS `id_pegawai`, `pegawai`.`nm_pegawai` AS `nm_pegawai` FROM ((`trans_jual` join `customer`) join `pegawai`) WHERE `trans_jual`.`id_cust` = `customer`.`id_cust` AND `trans_jual`.`id_pegawai` = `pegawai`.`id_pegawai` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_cust`),
  ADD KEY `kota_cust` (`kota_cust`);

--
-- Indexes for table `detail_trans_jual`
--
ALTER TABLE `detail_trans_jual`
  ADD KEY `nota` (`nota`),
  ADD KEY `id_brg` (`id_brg`);

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
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_suppl`),
  ADD KEY `kota_suppl` (`kota_suppl`);

--
-- Indexes for table `trans_jual`
--
ALTER TABLE `trans_jual`
  ADD PRIMARY KEY (`nota`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_cust` (`id_cust`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_brg` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_cust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_suppl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trans_jual`
--
ALTER TABLE `trans_jual`
  MODIFY `nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`kota_cust`) REFERENCES `kota` (`kd_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_trans_jual`
--
ALTER TABLE `detail_trans_jual`
  ADD CONSTRAINT `detail_trans_jual_ibfk_1` FOREIGN KEY (`nota`) REFERENCES `trans_jual` (`nota`),
  ADD CONSTRAINT `detail_trans_jual_ibfk_2` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kota_pegawai`) REFERENCES `kota` (`kd_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`kota_suppl`) REFERENCES `kota` (`kd_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trans_jual`
--
ALTER TABLE `trans_jual`
  ADD CONSTRAINT `trans_jual_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `trans_jual_ibfk_2` FOREIGN KEY (`id_cust`) REFERENCES `customer` (`id_cust`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
