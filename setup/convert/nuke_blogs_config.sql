-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2023 at 08:04 PM
-- Server version: 10.3.38-MariaDB
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
-- Database: `groomlakece_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_config`
--

CREATE TABLE `nuke_blogs_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_blogs_config`
--

INSERT INTO `nuke_blogs_config` (`config_name`, `config_value`) VALUES
('columns', '0'),
('readmore', '0'),
('texttype', '0'),
('notifyauth', '1'),
('homenumber', '0'),
('hometopic', '0'),
('version_number', '1.1.6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nuke_blogs_config`
--
ALTER TABLE `nuke_blogs_config`
  ADD UNIQUE KEY `config_name` (`config_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
