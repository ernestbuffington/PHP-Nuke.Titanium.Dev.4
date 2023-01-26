-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2023 at 12:42 AM
-- Server version: 10.3.37-MariaDB
-- PHP Version: 7.4.33

SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 04, 2023 at 07:23 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbarcade`;
CREATE TABLE IF NOT EXISTS `nuke_bbarcade` (
  `arcade_name` varchar(255) NOT NULL DEFAULT '',
  `arcade_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`arcade_name`)
) ;

--
-- Dumping data for table `nuke_bbarcade`
--

REPLACE INTO `nuke_bbarcade` (`arcade_name`, `arcade_value`) VALUES
('use_category_mod', '1'),
('category_preview_games', '5'),
('games_par_page', '15'),
('game_order', 'Alpha'),
('display_winner_avatar', '1'),
('stat_par_page', '10000'),
('winner_avatar_position', 'left'),
('maxsize_avatar', '200'),
('linkcat_align', '2'),
('limit_by_posts', '0'),
('posts_needed', '0'),
('days_limit', '0'),
('limit_type', 'date'),
('use_fav_category', '1'),
('arcade_announcement', 'Welcome to the Arcade!<br />Enjoy!');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_categories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 04, 2023 at 07:23 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbarcade_categories`;
CREATE TABLE IF NOT EXISTS `nuke_bbarcade_categories` (
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `arcade_cattitle` varchar(100) NOT NULL DEFAULT '',
  `arcade_nbelmt` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `arcade_catorder` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `arcade_catauth` tinyint(2) NOT NULL DEFAULT 0,
  KEY `arcade_catid` (`arcade_catid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_comments`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 11, 2023 at 01:58 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbarcade_comments`;
CREATE TABLE IF NOT EXISTS `nuke_bbarcade_comments` (
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `comments_value` varchar(255) NOT NULL DEFAULT ''
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_fav`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 04, 2023 at 07:23 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbarcade_fav`;
CREATE TABLE IF NOT EXISTS `nuke_bbarcade_fav` (
  `order` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  PRIMARY KEY (`game_id`),
  KEY `user_id` (`user_id`),
  KEY `order` (`order`)
) ;


-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbauth_arcade_access`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbauth_arcade_access`;
CREATE TABLE IF NOT EXISTS `nuke_bbauth_arcade_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  KEY `group_id` (`group_id`),
  KEY `arcade_catid` (`arcade_catid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgamehash`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 20, 2023 at 05:28 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbgamehash`;
CREATE TABLE IF NOT EXISTS `nuke_bbgamehash` (
  `gamehash_id` char(32) NOT NULL,
  `game_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `hash_date` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgames`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 20, 2023 at 05:28 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbgames`;
CREATE TABLE IF NOT EXISTS `nuke_bbgames` (
  `game_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `game_pic` varchar(50) NOT NULL DEFAULT '',
  `game_desc` varchar(255) NOT NULL DEFAULT '',
  `game_highscore` int(11) NOT NULL DEFAULT 0,
  `game_highdate` int(11) NOT NULL DEFAULT 0,
  `game_highuser` mediumint(8) NOT NULL DEFAULT 0,
  `game_name` varchar(50) NOT NULL DEFAULT '',
  `game_swf` varchar(50) NOT NULL DEFAULT '',
  `game_scorevar` varchar(50) NOT NULL DEFAULT '',
  `game_type` tinyint(4) NOT NULL DEFAULT 0,
  `game_width` mediumint(5) NOT NULL DEFAULT 550,
  `game_height` varchar(5) NOT NULL DEFAULT '380',
  `game_order` mediumint(8) NOT NULL DEFAULT 0,
  `game_set` mediumint(8) NOT NULL DEFAULT 0,
  `arcade_catid` mediumint(8) NOT NULL DEFAULT 1,
  KEY `game_id` (`game_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbhackgame`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 04, 2023 at 06:37 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbhackgame`;
CREATE TABLE IF NOT EXISTS `nuke_bbhackgame` (
  `user_id` mediumint(8) NOT NULL,
  `game_id` mediumint(8) NOT NULL,
  `date_hack` int(11) NOT NULL
) ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
