-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2023 at 04:53 PM
-- Server version: 10.3.37-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpnuke_db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_autoblog`
--

CREATE TABLE `nuke_blogs_autoblog` (
  `anid` int(10) UNSIGNED NOT NULL,
  `catid` int(11) NOT NULL DEFAULT 0,
  `aid` varchar(30) NOT NULL,
  `title` varchar(80) NOT NULL,
  `datePublished` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hometext` text NOT NULL,
  `bodytext` text NOT NULL,
  `topic` int(11) NOT NULL DEFAULT 1,
  `informant` varchar(40) NOT NULL,
  `notes` text NOT NULL,
  `ihome` tinyint(4) NOT NULL DEFAULT 0,
  `alanguage` varchar(30) NOT NULL,
  `acomm` tinyint(4) NOT NULL DEFAULT 0,
  `associated` text NOT NULL,
  `ticon` tinyint(1) NOT NULL DEFAULT 0,
  `writes` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nuke_blogs_autoblog`
--
ALTER TABLE `nuke_blogs_autoblog`
  ADD PRIMARY KEY (`anid`),
  ADD UNIQUE KEY `anid` (`anid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nuke_blogs_autoblog`
--
ALTER TABLE `nuke_blogs_autoblog`
  MODIFY `anid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
