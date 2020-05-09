-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 08:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinusclass`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `nim_npp` varchar(20) NOT NULL,
  `name_account` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email_account` varchar(255) NOT NULL,
  `status` varchar(9) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password_account` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `nim_npp`, `name_account`, `gender`, `dob`, `phone`, `email_account`, `status`, `image`, `password_account`) VALUES
(1, 'A11.2017.10568', 'Muhammad Ivan Haikal', 'L', '1999-12-11', '081381472144', '111201710568@mhs.dinus.ac.id', 'Mahasiswa', 'ivan.jpg', '$2y$10$ILrOD1GLE9aVZzB3sm7EE.U3EogftToKST7Psi0ufdO5KjStg.H/S'),
(2, 'A11.2017.10447', 'Muhammad Kholil Umar', 'L', '1999-05-25', '085799464185', '111201710447@mhs.dinus.ac.id', 'Mahasiswa', 'kholil.jpg', '$2y$10$Tlus9xu08dQJWk8/VBCmU.cDqtgcx7nA3Uqis/fBv1kFQ8ZKCGepG'),
(3, 'A11.2017.10106', 'Fatimah Tunnada', 'P', '1999-01-27', '087827759326', '111201710106@mhs.dinus.ac.id', 'Mahasiswa', 'nada.jpg', '$2y$10$Y1CiEYFoznVat8pXXOmG6O7i.E8M/f/UJrf6fcYDyOHEi5j.SesF2'),
(4, 'A11.2017.10108', 'Hesti Putri Winasih', 'P', '1999-12-20', '083842696390', '111201710108@mhs.dinus.ac.id', 'Mahasiswa', 'hesti.jpg', '$2y$10$ewpx9FKsQdAQW/dSd.6NwOdGzUJsu//05RBksH5id1n5TS/vXstoq'),
(5, 'A11.2017.10119', 'Nadya Ayu Fatina', 'P', '1999-08-21', '081575117287', '111201710119@mhs.dinus.ac.id', 'Mahasiswa', 'nafa.jpg', '$2y$10$y2MRPCaLx2i0e22V8W7KX.PWbuOXPc5/0btkk6OYeEhUdlg6Qp8sa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
