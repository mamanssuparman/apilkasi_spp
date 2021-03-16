-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 11:58 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas`
--

CREATE TABLE `t_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) DEFAULT NULL,
  `kompetensi_keahlian` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kelas`
--

INSERT INTO `t_kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
(2, 'X RPL 1', 'Rekayasa Perangkat Lunak');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembayaran`
--

CREATE TABLE `t_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `nisn` char(10) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `bulan_dibayar` varchar(8) DEFAULT NULL,
  `tahun_dibayar` varchar(4) DEFAULT NULL,
  `id_spp` int(11) DEFAULT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0=No Invoice 1=Invoice'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pembayaran`
--

INSERT INTO `t_pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`, `status`) VALUES
(5, 3, '12345', '2021-03-15', 'Januari', '2021', 1, 200000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_petugas`
--

CREATE TABLE `t_petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pasword` varchar(100) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `level` enum('admin','petugas') DEFAULT 'petugas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_petugas`
--

INSERT INTO `t_petugas` (`id_petugas`, `username`, `pasword`, `nama_petugas`, `level`) VALUES
(1, 'admin', '$2y$10$oiSDuxq7UWC0WgEUx4PEIej.Yl3QZ/L1KuOiOWhbXW8JAgtF3CT0m', 'Maman Suparman', 'admin'),
(2, 'maman', '$2y$10$sMWmEtBKkAoOPg44At.7TePnh7kDeaeUsfoIGnX/s2CTfqr76WWWK', 'Maman Suparman', 'admin'),
(3, 'jamal', '$2y$10$P8p8gLHiEcTUsZyd8dbL4u0PqIfaIyKjsw/o2RtHI5cjijc34.eCa', 'Jamaludin', 'admin'),
(4, 'petugas', '$2y$10$yFSAqmoNynBF.1Ox6TrJM.IK7svkjlzditDwifSHyKgkXiYFoIxae', 'petugas', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `t_siswa`
--

CREATE TABLE `t_siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(8) DEFAULT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `alamat` text,
  `no_telepon` varchar(13) DEFAULT NULL,
  `id_spp` int(11) DEFAULT NULL,
  `ket` enum('0','1') DEFAULT '0' COMMENT '0=Tidak Aktif 1=Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_siswa`
--

INSERT INTO `t_siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telepon`, `id_spp`, `ket`) VALUES
('12345', '1234', 'Lukman Aditia Anggara', 2, 'Banjar', '0999988888', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `t_spp`
--

CREATE TABLE `t_spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_spp`
--

INSERT INTO `t_spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2020, 100000),
(2, 2021, 200000),
(3, 2022, 100000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_pembayaran`
-- (See below for the actual view)
--
CREATE TABLE `vw_pembayaran` (
`id_pembayaran` int(11)
,`id_petugas` int(11)
,`nama_petugas` varchar(50)
,`nisn` char(10)
,`nama` varchar(35)
,`tgl_bayar` date
,`bulan_dibayar` varchar(8)
,`tahun_dibayar` varchar(4)
,`id_spp` int(11)
,`tahun` int(11)
,`nominal` int(11)
,`jumlah_bayar` int(11)
,`status` enum('0','1')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_siswa_join_kelas_spp`
-- (See below for the actual view)
--
CREATE TABLE `vw_siswa_join_kelas_spp` (
`nisn` char(10)
,`nis` char(8)
,`nama` varchar(35)
,`id_kelas` int(11)
,`nama_kelas` varchar(10)
,`alamat` text
,`no_telepon` varchar(13)
,`id_spp` int(11)
,`tahun` int(11)
,`ket` enum('0','1')
);

-- --------------------------------------------------------

--
-- Structure for view `vw_pembayaran`
--
DROP TABLE IF EXISTS `vw_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pembayaran`  AS  select `t_pembayaran`.`id_pembayaran` AS `id_pembayaran`,`t_petugas`.`id_petugas` AS `id_petugas`,`t_petugas`.`nama_petugas` AS `nama_petugas`,`t_siswa`.`nisn` AS `nisn`,`t_siswa`.`nama` AS `nama`,`t_pembayaran`.`tgl_bayar` AS `tgl_bayar`,`t_pembayaran`.`bulan_dibayar` AS `bulan_dibayar`,`t_pembayaran`.`tahun_dibayar` AS `tahun_dibayar`,`t_spp`.`id_spp` AS `id_spp`,`t_spp`.`tahun` AS `tahun`,`t_spp`.`nominal` AS `nominal`,`t_pembayaran`.`jumlah_bayar` AS `jumlah_bayar`,`t_pembayaran`.`status` AS `status` from (((`t_pembayaran` left join `t_petugas` on((`t_pembayaran`.`id_petugas` = `t_petugas`.`id_petugas`))) join `t_siswa` on((`t_pembayaran`.`nisn` = `t_siswa`.`nisn`))) join `t_spp` on((`t_pembayaran`.`id_spp` = `t_spp`.`id_spp`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_siswa_join_kelas_spp`
--
DROP TABLE IF EXISTS `vw_siswa_join_kelas_spp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_siswa_join_kelas_spp`  AS  select `t_siswa`.`nisn` AS `nisn`,`t_siswa`.`nis` AS `nis`,`t_siswa`.`nama` AS `nama`,`t_kelas`.`id_kelas` AS `id_kelas`,`t_kelas`.`nama_kelas` AS `nama_kelas`,`t_siswa`.`alamat` AS `alamat`,`t_siswa`.`no_telepon` AS `no_telepon`,`t_spp`.`id_spp` AS `id_spp`,`t_spp`.`tahun` AS `tahun`,`t_siswa`.`ket` AS `ket` from ((`t_siswa` left join `t_kelas` on((`t_siswa`.`id_kelas` = `t_kelas`.`id_kelas`))) left join `t_spp` on((`t_siswa`.`id_spp` = `t_spp`.`id_spp`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indexes for table `t_petugas`
--
ALTER TABLE `t_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indexes for table `t_spp`
--
ALTER TABLE `t_spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_petugas`
--
ALTER TABLE `t_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_spp`
--
ALTER TABLE `t_spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD CONSTRAINT `t_pembayaran_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `t_petugas` (`id_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pembayaran_ibfk_2` FOREIGN KEY (`nisn`) REFERENCES `t_siswa` (`nisn`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pembayaran_ibfk_3` FOREIGN KEY (`id_spp`) REFERENCES `t_spp` (`id_spp`) ON UPDATE CASCADE;

--
-- Constraints for table `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD CONSTRAINT `t_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `t_kelas` (`id_kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_siswa_ibfk_2` FOREIGN KEY (`id_spp`) REFERENCES `t_spp` (`id_spp`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
