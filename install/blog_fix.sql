-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2023 at 03:23 PM
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
-- Table structure for table `nuke_blogs`
--

CREATE TABLE `nuke_blogs` (
  `sid` int(11) NOT NULL,
  `catid` int(11) NOT NULL DEFAULT 0,
  `aid` varchar(25) NOT NULL DEFAULT '',
  `title` varchar(80) DEFAULT NULL,
  `datePublished` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hometext` text DEFAULT NULL,
  `bodytext` text NOT NULL,
  `comments` int(11) DEFAULT 0,
  `counter` mediumint(8) UNSIGNED DEFAULT NULL,
  `topic` int(11) NOT NULL DEFAULT 1,
  `informant` varchar(25) NOT NULL DEFAULT '',
  `notes` text NOT NULL,
  `ihome` int(11) NOT NULL DEFAULT 0,
  `alanguage` varchar(30) NOT NULL DEFAULT '',
  `acomm` int(11) NOT NULL DEFAULT 0,
  `haspoll` int(11) NOT NULL DEFAULT 0,
  `pollID` int(11) NOT NULL DEFAULT 0,
  `score` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `associated` text NOT NULL,
  `ticon` tinyint(1) NOT NULL DEFAULT 0,
  `writes` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_blogs`
--

INSERT INTO `nuke_blogs` (`sid`, `catid`, `aid`, `title`, `datePublished`, `dateModified`, `hometext`, `bodytext`, `comments`, `counter`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `haspoll`, `pollID`, `score`, `ratings`, `associated`, `ticon`, `writes`) VALUES
(50, 8, 'Administrator', 'I Love to Share and Work', '2023-01-03 18:33:49', '2023-01-18 08:26:55', '<p>ðŸ–Œï¸ I <strong>blog weekly</strong> about PHP and cool coding shortcuts at tomasvotruba.com</p>\n\n<p>ðŸš€ I work on Rector to help you forget about technical debt and upgrade from PHP 5.6 to PHP 8.1 in a day</p>\n\n<p>ðŸ’ª ðŸ“– I wrote a book about Rector - The Power of Automated Refactoring together with my childhood hero</p>\n\n<p>ðŸ‘ª I believe in personal sharing of knowledge, so I made friendsofphp.org to cover all World PHP meetups next month</p>\n\n<p>â¤ï¸ Do you <strong>enjoy the tasty fruits</strong> of my work? Support me at Github Sponsors</p>\n\n<p>ðŸ¦ I <strong>tweet</strong> about ideas worth learning at @votrubaT</p>\n\n<p>ðŸ”¨ Currently, I help a couple of projects ~10 hours/week to make their <strong>code productive, a joy to use, and scale in quality</strong>.</p>\n\n<p>Â </p>', '', 0, 28, 4, 'Administrator', '', 0, 'english', 0, 0, 0, 30, 6, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_cat`
--

CREATE TABLE `nuke_blogs_cat` (
  `catid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL DEFAULT '',
  `counter` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_blogs_cat`
--

INSERT INTO `nuke_blogs_cat` (`catid`, `title`, `counter`) VALUES
(5, 'Server Updates', 209),
(6, 'Module Information', 494),
(7, 'Module Updates', 458),
(8, 'The Daily Blog', 485),
(9, 'Mod Information', 478),
(10, 'Block Information', 490),
(11, 'Block Updates', 0),
(12, 'Mod Updates', 0),
(13, 'Theme Information', 0),
(14, 'Theme Updates', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nuke_blogs`
--
ALTER TABLE `nuke_blogs`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `counter` (`counter`),
  ADD KEY `topic` (`topic`);

--
-- Indexes for table `nuke_blogs_cat`
--
ALTER TABLE `nuke_blogs_cat`
  ADD PRIMARY KEY (`catid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nuke_blogs`
--
ALTER TABLE `nuke_blogs`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `nuke_blogs_cat`
--
ALTER TABLE `nuke_blogs_cat`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
