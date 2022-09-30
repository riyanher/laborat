-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 08:16 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laborat`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `kode_barang` varchar(9) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `merek` varchar(15) NOT NULL,
  `tgl_masuk` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `dipinjam` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `image` varchar(256) DEFAULT 'book-default-cover.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `merek`, `tgl_masuk`, `stok`, `dipinjam`, `jumlah`, `image`) VALUES
('E001', 'Solder', 'Dekko', 1624362326, 8, 0, 8, 'item-img1624362326.jpg'),
('E002', 'Timah Solder', 'Dekko', 1624362382, 8, 0, 8, 'item-img1624362382.jpg'),
('E003', 'Multimeter', 'Sanwa', 1624509624, 3, 1, 0, 'item-img1624509624.jpg'),
('E004', 'Tang Jepit', 'Camel', 1624714082, 8, 0, 0, 'item-img1624714139.jpg'),
('E005', 'Tang Potong', 'Jason', 1624714313, 8, 0, 0, 'item-img1624714450.png'),
('E006', 'Penyedot Timah Solder', 'Rayden', 1624714507, 6, 0, 0, 'item-img1624714507.jpg'),
('E007', 'Obeng Set 31in1', 'Kenmaster', 1624714585, 4, 0, 0, 'item-img1624714585.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

DROP TABLE IF EXISTS `detail_pinjam`;
CREATE TABLE `detail_pinjam` (
  `no_pinjam` varchar(12) NOT NULL,
  `kode_barang` varchar(9) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`no_pinjam`, `kode_barang`, `denda`) VALUES
('P21062401', 'E001', 10000),
('P21062402', 'E003', 5000),
('P21062601', 'E001', 20000),
('P21062602', 'E002', 20000),
('P21062701', 'E007', 10000),
('P21062801', 'E006', 10000),
('P21062901', 'E005', 10000),
('P21062902', 'E004', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

DROP TABLE IF EXISTS `pinjam`;
CREATE TABLE `pinjam` (
  `no_pinjam` varchar(12) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `nama_peminjam` varchar(128) NOT NULL,
  `kode_barang` varchar(9) NOT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status` enum('Pinjam','Kembali') NOT NULL,
  `total_denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`no_pinjam`, `tgl_pinjam`, `nama_peminjam`, `kode_barang`, `jml_pinjam`, `tgl_kembali`, `tgl_pengembalian`, `status`, `total_denda`) VALUES
('P21062401', '2021-06-23', 'Loki', 'E001', 2, '2021-06-23', '2021-06-24', 'Kembali', 10000),
('P21062402', '2021-06-24', 'Thor', 'E003', 1, '2021-06-24', '0000-00-00', 'Pinjam', 0),
('P21062601', '2021-06-26', 'Batman', 'E001', 4, '2021-06-26', '2021-06-26', 'Kembali', 0),
('P21062602', '2021-06-26', 'Robin', 'E002', 4, '2021-06-26', '2021-06-26', 'Kembali', 0),
('P21062701', '2021-06-27', 'Ultron', 'E007', 2, '2021-06-27', '2021-06-27', 'Kembali', 0),
('P21062801', '2021-06-28', 'Flash', 'E006', 2, '2021-06-28', '2021-06-28', 'Kembali', 0),
('P21062901', '2021-06-29', 'Naruto', 'E005', 2, '2021-06-29', '2021-06-29', 'Kembali', 0),
('P21062902', '2021-06-29', 'Sasuke', 'E004', 2, '2021-06-29', '2021-06-29', 'Kembali', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
CREATE TABLE `temp` (
  `no_pinjam` varchar(12) NOT NULL,
  `nama_peminjam` varchar(128) NOT NULL,
  `kode_barang` varchar(9) NOT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`no_pinjam`, `nama_peminjam`, `kode_barang`, `jml_pinjam`, `tgl_pinjam`, `tgl_kembali`, `denda`) VALUES
('P21062902', 'Sasuke', 'E004', 2, '2021-06-29', '2021-06-29', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `nama`, `alamat`, `email`, `image`, `password`, `role_id`, `is_active`, `tanggal_input`) VALUES
(20, '(nikbelumdiatur)', 'Super Admin', '(alamatbelumdiatur)', 'admin@gmail.com', 'default.jpg', '$2y$10$1//CQgz1/bdK25VI5F82CeKzVbzH5dl680A.tF5HX6eBB/E.34h7G', 1, 1, 1624342144),
(21, '(nikbelumdiatur)', 'Admin02', '(alamatbelumdiatur)', 'admin02@gmail.com', 'default.jpg', '$2y$10$pjZz3tuSrzcw0ofUzjiy8eTxhFR2p3J9tKjgLaIvqgK.9XdeSbChC', 1, 1, 1624362073),
(22, '(nikbelumdiatur)', 'Admin03', '(alamatbelumdiatur)', 'admin03@gmail.com', 'default.jpg', '$2y$10$nSymqyRaFFLYMepPHjvKLu9V.j77Nf1J6kPNu7cD0Dpa6tQPXBlN.', 1, 1, 1624923020);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`no_pinjam`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
