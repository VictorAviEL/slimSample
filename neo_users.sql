-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 05:06 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neolegalvictor`
--

-- --------------------------------------------------------

--
-- Table structure for table `neo_users`
--

CREATE TABLE `neo_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `type` enum('admin','supervisor','lawyer','agent','lsupervisor','customer','marketing','sales','legalintern','elawyer') DEFAULT 'customer',
  `active` int(1) DEFAULT 1,
  `created` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `guid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `neo_users`
--

INSERT INTO `neo_users` (`id`, `username`, `password`, `type`, `active`, `created`, `last_login`, `token`, `guid`) VALUES
(1, 'billy', 'billy', 'customer', 1, '2020-05-31 09:05:28', NULL, NULL, NULL),
(2, 'tony', 'tony', 'legalintern', 1, '2020-05-31 09:05:28', NULL, NULL, NULL),
(15, 'boby2', 'boby2', 'customer', 1, '2020-05-31 11:02:05', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `neo_users`
--
ALTER TABLE `neo_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `neo_users`
--
ALTER TABLE `neo_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
