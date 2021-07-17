-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2021 at 09:57 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manageFIle`
--

-- --------------------------------------------------------

--
-- Table structure for table `DoAn`
--

CREATE TABLE `DoAn` (
  `ID` int(11) NOT NULL,
  `IDGV` int(11) NOT NULL,
  `TenDA` text NOT NULL,
  `MoTA` text NOT NULL,
  `DinhKem` text NOT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `DoAn`
--

INSERT INTO `DoAn` (`ID`, `IDGV`, `TenDA`, `MoTA`, `DinhKem`, `CreateDate`) VALUES
(3, 1, 'Học PHP', 'haha', '[downloadsachmienphi.com] Đi Tìm Lẽ Sống.pdf', '2021-07-16 14:22:48'),
(5, 1, 'ABC', 'day laf oke', 'Tai lieu giao trinh Lap trinh android co ban.pdf', '2021-07-16 23:45:12'),
(6, 1, 'ABCdsdsdsd', 'day laf okesaSAs', 'Tướng Thuật Căn Bản - sách quý, 96 Trang.pdf', '2021-07-16 23:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `GiangVien`
--

CREATE TABLE `GiangVien` (
  `ID` int(11) NOT NULL,
  `TenGV` text NOT NULL,
  `DiaChi` text NOT NULL,
  `SDT` varchar(20) NOT NULL,
  `Khoa` text NOT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GiangVien`
--

INSERT INTO `GiangVien` (`ID`, `TenGV`, `DiaChi`, `SDT`, `Khoa`, `CreateDate`) VALUES
(1, 'Tào Tháo', 'Hà Nội', '0212126167271', 'CNTT', '2021-07-17 02:58:38'),
(3, 'Ngô Kinh', 'Thái Nguyên', '034234032423', 'DTVT', '2021-07-17 01:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `fullName` text NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `fullName`, `createDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Vuongdttn98', '2021-07-17 07:51:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DoAn`
--
ALTER TABLE `DoAn`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `GiangVien`
--
ALTER TABLE `GiangVien`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DoAn`
--
ALTER TABLE `DoAn`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `GiangVien`
--
ALTER TABLE `GiangVien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
