-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2017 at 09:45 PM
-- Server version: 10.1.23-MariaDB-1~xenial
-- PHP Version: 5.6.30-10+deb.sury.org~xenial+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_sa`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  `value` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `deskripsi`, `tanggal`, `value`, `weight`) VALUES
('160624032656_61', 'a', '2016-06-14', 70, 2000),
('160624032712_36', 'b', '2016-12-29', 40, 1000),
('160624032725_54', 'c', '2016-12-28', 35, 500),
('160624032738_30', 'd', '2016-12-29', 45, 1500),
('160624034056_24', 'e', '2016-12-28', 60, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE `daftar` (
  `id_daftar` int(11) NOT NULL,
  `no_plat` varchar(15) NOT NULL,
  `id_barang` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `no_plat` varchar(15) NOT NULL,
  `merek_kendaraan` text NOT NULL,
  `bobot_maksimal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`no_plat`, `merek_kendaraan`, `bobot_maksimal`) VALUES
('B 2756 WY', 'Truck Box dan Wings Box Engkel Hino Dutro 6 Roda', 7000),
('B 4565 Wh', 'Truck Box dan Wings Box Engkel Hino Dutro 6 Roda', 7000),
('B 4590 CA', 'Kendaraan', 1500),
('B 4712 PK', 'Truck Box Engkel Hino Dutro 4 Roda', 4000),
('N 5471 Xh', 'Truck Box Engkel Hino Dutro 4 Roda', 4000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `daftar`
--
ALTER TABLE `daftar`
  ADD UNIQUE KEY `no_plat` (`no_plat`),
  ADD UNIQUE KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`no_plat`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar`
--
ALTER TABLE `daftar`
  ADD CONSTRAINT `daftar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_ibfk_2` FOREIGN KEY (`no_plat`) REFERENCES `kendaraan` (`no_plat`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
