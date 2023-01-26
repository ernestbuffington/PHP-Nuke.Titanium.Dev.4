-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2023 at 05:27 PM
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
-- Table structure for table `nuke_blogs_topics`
--

CREATE TABLE `nuke_blogs_topics` (
  `topicid` int(3) NOT NULL,
  `topicname` varchar(20) DEFAULT NULL,
  `topicimage` varchar(100) DEFAULT NULL,
  `topictext` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_blogs_topics`
--

INSERT INTO `nuke_blogs_topics` (`topicid`, `topicname`, `topicimage`, `topictext`, `counter`) VALUES
(3, 'contentdeliverynet', 'black_template.png', 'CDN - Content Delivery Networks', 225),
(4, 'the86itTeam', 'black_template.png', 'Open-Source', 252),
(1, 'titanium', 'black_template.png', 'PHP-Nuke Titanium News', 533),
(5, 'modules', 'black_template.png', 'PHP-Nuke Titanium Modules', 285),
(6, 'blocks', 'black_template.png', 'PHP-Nuke Titanium Blocks', 307),
(7, 'mods', 'black_template.png', 'PHP-Nuke Titanium Mods', 197),
(8, 'themes', 'black_template.png', 'PHP-Nuke Titanium Themes', 191),
(9, 'todo', 'black_template.png', 'PHP-Nuke Titanium ToDo List', 10),
(10, 'adminpanels', 'black_template.png', 'PHP-Nuke Titanium Admin Panels', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nuke_blogs_topics`
--
ALTER TABLE `nuke_blogs_topics`
  ADD PRIMARY KEY (`topicid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nuke_blogs_topics`
--
ALTER TABLE `nuke_blogs_topics`
  MODIFY `topicid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
