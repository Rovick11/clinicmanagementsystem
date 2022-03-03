-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2022 at 10:16 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18540586_cpuniversityclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `p_id` int(11) NOT NULL,
  `pres_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `findings` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `prescription` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`p_id`, `pres_id`, `date`, `findings`, `prescription`) VALUES
(1, 2, '2022-03-02 00:00:00', 'Have colds and cough\r\nhardtime breathing', 'ventolin\r\nchest xray'),
(2, 2, '2022-03-01 00:00:00', 'Fever', 'Biogesic'),
(67, 4, '2022-03-03 09:50:06', 'Colds', 'Neozep');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `weight` varchar(11) DEFAULT '0 kg',
  `height` varchar(11) NOT NULL DEFAULT '0 cm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`, `weight`, `height`) VALUES
(1, 'Juan Dela Cruz', 'juan@mail.com', 'admin', 'a94652aa97c7211ba8954dd15a3cf838', '0', '0'),
(2, 'Pedro Penduko', 'pedro@email.com', 'user', 'c6cc8094c2dc07b700ffcc36d64e2138', '55.5 kg', '160 cm'),
(3, 'Pepito Manaloto', 'pepito@email.com', 'user', '32164702f8ffd2b418d780ff02371e4c', '60 kg', '155 cm'),
(4, 'Asta Y Clover', 'asta@clover.g.ph', 'user', 'f10b0c134cc9601ba7711a9b2c9444ad', '57 kg', '146 cm'),
(5, 'Yuno Y Spades', 'yuno@g.spades', 'user', '57793f7a37ed58746aafa76a7cda86da', '50 kg', '160 cm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `pres_id` (`pres_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `pres_id` FOREIGN KEY (`pres_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
