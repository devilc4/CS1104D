-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2018 at 12:55 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guest_hostel_webapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(12) NOT NULL,
  `category` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_name` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_email` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rollno` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_mobile` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relation` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(3) NOT NULL,
  `num` int(3) NOT NULL,
  `date_of_arrival` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_student` int(1) DEFAULT '0',
  `st_key` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_incharge` int(1) DEFAULT '0',
  `in_key` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_director` int(1) DEFAULT '0',
  `dir_key` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tstamp` timestamp(5) NOT NULL DEFAULT CURRENT_TIMESTAMP(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
