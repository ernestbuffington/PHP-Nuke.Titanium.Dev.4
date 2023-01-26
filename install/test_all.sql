-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2023 at 12:21 AM
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
-- Table structure for table `nuke_admin_fc`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_admin_fc`;
CREATE TABLE IF NOT EXISTS `nuke_admin_fc` (
  `fc_datetime` varchar(25) NOT NULL DEFAULT '',
  `fc_ip` varchar(255) NOT NULL DEFAULT '',
  `fc_attempts` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fc_attempts`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_authors`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_authors`;
CREATE TABLE IF NOT EXISTS `nuke_authors` (
  `aid` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `pwd` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT 0,
  `radminsuper` tinyint(1) NOT NULL DEFAULT 1,
  `admlanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`aid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_autoblog`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_blogs_autoblog`;
CREATE TABLE IF NOT EXISTS `nuke_blogs_autoblog` (
  `anid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT 0,
  `aid` varchar(30) NOT NULL,
  `title` varchar(80) NOT NULL,
  `datePublished` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp(),
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
  `writes` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`anid`),
  UNIQUE KEY `anid` (`anid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 06:45 PM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_banner`;
CREATE TABLE IF NOT EXISTS `nuke_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT 0,
  `impmade` int(11) NOT NULL DEFAULT 0,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `alttext` varchar(255) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `dateend` datetime DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `ad_class` varchar(5) NOT NULL DEFAULT '',
  `ad_code` text NOT NULL,
  `ad_width` int(11) DEFAULT 0,
  `ad_height` int(11) DEFAULT 0,
  `type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`bid`),
  KEY `cid` (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_clients`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_banner_clients`;
CREATE TABLE IF NOT EXISTS `nuke_banner_clients` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `contact` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `login` varchar(10) NOT NULL DEFAULT '',
  `passwd` varchar(10) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  PRIMARY KEY (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_plans`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_banner_plans`;
CREATE TABLE IF NOT EXISTS `nuke_banner_plans` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `delivery` varchar(10) NOT NULL DEFAULT '',
  `delivery_type` varchar(25) NOT NULL DEFAULT '',
  `price` varchar(25) NOT NULL DEFAULT '0',
  `buy_links` text NOT NULL,
  PRIMARY KEY (`pid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_positions`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_banner_positions`;
CREATE TABLE IF NOT EXISTS `nuke_banner_positions` (
  `apid` int(10) NOT NULL AUTO_INCREMENT,
  `position_number` int(5) NOT NULL DEFAULT 0,
  `position_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`apid`),
  KEY `position_number` (`position_number`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_terms`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 03, 2023 at 11:34 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_banner_terms`;
CREATE TABLE IF NOT EXISTS `nuke_banner_terms` (
  `terms_body` text NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT ''
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbadvanced_username_color`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbadvanced_username_color`;
CREATE TABLE IF NOT EXISTS `nuke_bbadvanced_username_color` (
  `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL DEFAULT '',
  `group_color` varchar(6) NOT NULL DEFAULT '',
  `group_weight` smallint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`group_id`)
) ;

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
-- Table structure for table `nuke_bbattachments`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 10, 2023 at 10:18 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbattachments`;
CREATE TABLE IF NOT EXISTS `nuke_bbattachments` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `user_id_1` mediumint(8) NOT NULL DEFAULT 0,
  `user_id_2` mediumint(8) NOT NULL DEFAULT 0,
  KEY `attach_id_post_id` (`attach_id`,`post_id`),
  KEY `attach_id_privmsgs_id` (`attach_id`,`privmsgs_id`),
  KEY `post_id` (`post_id`),
  KEY `privmsgs_id` (`privmsgs_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattachments_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbattachments_config`;
CREATE TABLE IF NOT EXISTS `nuke_bbattachments_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattachments_desc`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 10, 2023 at 10:18 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbattachments_desc`;
CREATE TABLE IF NOT EXISTS `nuke_bbattachments_desc` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `physical_filename` varchar(255) NOT NULL DEFAULT '',
  `real_filename` varchar(255) NOT NULL DEFAULT '',
  `download_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `comment` varchar(255) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `mimetype` varchar(100) DEFAULT NULL,
  `filesize` int(20) NOT NULL DEFAULT 0,
  `filetime` int(11) NOT NULL DEFAULT 0,
  `thumbnail` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `physical_filename` (`physical_filename`(10)),
  KEY `filesize` (`filesize`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattach_quota`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbattach_quota`;
CREATE TABLE IF NOT EXISTS `nuke_bbattach_quota` (
  `user_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `quota_type` smallint(2) NOT NULL DEFAULT 0,
  `quota_limit_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  KEY `quota_type` (`quota_type`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbauth_access`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbauth_access`;
CREATE TABLE IF NOT EXISTS `nuke_bbauth_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `auth_view` tinyint(1) NOT NULL DEFAULT 0,
  `auth_read` tinyint(1) NOT NULL DEFAULT 0,
  `auth_post` tinyint(1) NOT NULL DEFAULT 0,
  `auth_reply` tinyint(1) NOT NULL DEFAULT 0,
  `auth_edit` tinyint(1) NOT NULL DEFAULT 0,
  `auth_delete` tinyint(1) NOT NULL DEFAULT 0,
  `auth_sticky` tinyint(1) NOT NULL DEFAULT 0,
  `auth_announce` tinyint(1) NOT NULL DEFAULT 0,
  `auth_globalannounce` tinyint(1) NOT NULL DEFAULT 0,
  `auth_vote` tinyint(1) NOT NULL DEFAULT 0,
  `auth_pollcreate` tinyint(1) NOT NULL DEFAULT 0,
  `auth_attachments` tinyint(1) NOT NULL DEFAULT 0,
  `auth_mod` tinyint(1) NOT NULL DEFAULT 0,
  `auth_download` tinyint(1) NOT NULL DEFAULT 0,
  KEY `group_id` (`group_id`),
  KEY `forum_id` (`forum_id`)
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
-- Table structure for table `nuke_bbbanlist`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbbanlist`;
CREATE TABLE IF NOT EXISTS `nuke_bbbanlist` (
  `ban_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ban_userid` mediumint(8) NOT NULL DEFAULT 0,
  `ban_ip` varchar(8) NOT NULL DEFAULT '',
  `ban_email` varchar(255) DEFAULT NULL,
  `ban_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`ban_id`),
  KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcategories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 06, 2023 at 07:20 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbcategories`;
CREATE TABLE IF NOT EXISTS `nuke_bbcategories` (
  `cat_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(100) DEFAULT NULL,
  `cat_order` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`cat_id`),
  KEY `cat_order` (`cat_order`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbconfig`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 06:45 PM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_bbconfig`;
CREATE TABLE IF NOT EXISTS `nuke_bbconfig` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbdisallow`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 07, 2023 at 07:32 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbdisallow`;
CREATE TABLE IF NOT EXISTS `nuke_bbdisallow` (
  `disallow_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `disallow_username` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`disallow_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbextensions`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 07, 2023 at 07:53 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbextensions`;
CREATE TABLE IF NOT EXISTS `nuke_bbextensions` (
  `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `extension` varchar(100) NOT NULL DEFAULT '',
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ext_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbextension_groups`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbextension_groups`;
CREATE TABLE IF NOT EXISTS `nuke_bbextension_groups` (
  `group_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) NOT NULL DEFAULT '',
  `cat_id` tinyint(2) NOT NULL DEFAULT 0,
  `allow_group` tinyint(1) NOT NULL DEFAULT 0,
  `download_mode` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `upload_icon` varchar(100) DEFAULT '',
  `max_filesize` int(20) NOT NULL DEFAULT 0,
  `forum_permissions` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`group_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbflags`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbflags`;
CREATE TABLE IF NOT EXISTS `nuke_bbflags` (
  `flag_id` int(10) NOT NULL,
  `flag_name` varchar(50) DEFAULT NULL,
  `flag_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`flag_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforbidden_extensions`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbforbidden_extensions`;
CREATE TABLE IF NOT EXISTS `nuke_bbforbidden_extensions` (
  `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `extension` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`ext_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforums`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 07:32 AM
-- Last check: Jan 18, 2023 at 07:37 AM
--

DROP TABLE IF EXISTS `nuke_bbforums`;
CREATE TABLE IF NOT EXISTS `nuke_bbforums` (
  `forum_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_name` varchar(150) DEFAULT NULL,
  `forum_desc` text DEFAULT NULL,
  `forum_status` tinyint(4) NOT NULL DEFAULT 0,
  `forum_order` mediumint(8) UNSIGNED NOT NULL DEFAULT 1,
  `forum_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_topics` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `prune_next` int(11) DEFAULT NULL,
  `prune_enable` tinyint(1) NOT NULL DEFAULT 1,
  `auth_view` tinyint(2) NOT NULL DEFAULT 0,
  `auth_read` tinyint(2) NOT NULL DEFAULT 0,
  `auth_post` tinyint(2) NOT NULL DEFAULT 0,
  `auth_reply` tinyint(2) NOT NULL DEFAULT 0,
  `auth_edit` tinyint(2) NOT NULL DEFAULT 0,
  `auth_delete` tinyint(2) NOT NULL DEFAULT 0,
  `auth_sticky` tinyint(2) NOT NULL DEFAULT 0,
  `auth_announce` tinyint(2) NOT NULL DEFAULT 0,
  `auth_globalannounce` tinyint(2) NOT NULL DEFAULT 3,
  `auth_vote` tinyint(2) NOT NULL DEFAULT 0,
  `auth_pollcreate` tinyint(2) NOT NULL DEFAULT 0,
  `auth_attachments` tinyint(2) NOT NULL DEFAULT 0,
  `forum_display_sort` tinyint(1) NOT NULL DEFAULT 0,
  `forum_display_order` tinyint(1) NOT NULL DEFAULT 0,
  `auth_download` tinyint(2) NOT NULL DEFAULT 0,
  `forum_parent` int(11) NOT NULL DEFAULT 0,
  `forum_color` varchar(6) NOT NULL DEFAULT '',
  `title_is_link` tinyint(1) NOT NULL DEFAULT 0,
  `weblink` varchar(200) NOT NULL,
  `forum_link_icon` varchar(200) NOT NULL,
  `forum_link_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_link_target` tinyint(1) NOT NULL DEFAULT 0,
  `forum_icon` varchar(255) DEFAULT NULL,
  `forum_thank` tinyint(1) NOT NULL DEFAULT 0,
  `forum_password` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`forum_id`),
  KEY `forums_order` (`forum_order`),
  KEY `cat_id` (`cat_id`),
  KEY `forum_last_post_id` (`forum_last_post_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforum_prune`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 07, 2023 at 04:29 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbforum_prune`;
CREATE TABLE IF NOT EXISTS `nuke_bbforum_prune` (
  `prune_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `prune_days` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `prune_freq` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`prune_id`),
  KEY `forum_id` (`forum_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgamehash`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 11, 2023 at 06:06 AM
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
-- Last update: Jan 11, 2023 at 01:58 AM
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
-- Table structure for table `nuke_bbgroups`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 06:25 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbgroups`;
CREATE TABLE IF NOT EXISTS `nuke_bbgroups` (
  `group_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `group_type` tinyint(4) NOT NULL DEFAULT 1,
  `group_name` varchar(40) NOT NULL DEFAULT '',
  `group_description` varchar(255) NOT NULL DEFAULT '',
  `group_moderator` mediumint(8) NOT NULL DEFAULT 0,
  `group_single_user` tinyint(1) NOT NULL DEFAULT 1,
  `group_allow_pm` tinyint(2) NOT NULL DEFAULT 5,
  `group_color` varchar(15) NOT NULL DEFAULT '',
  `group_rank` varchar(5) NOT NULL DEFAULT '0',
  `max_inbox` mediumint(10) NOT NULL DEFAULT 100,
  `max_sentbox` mediumint(10) NOT NULL DEFAULT 100,
  `max_savebox` mediumint(10) NOT NULL DEFAULT 100,
  `override_max_inbox` tinyint(1) NOT NULL DEFAULT 0,
  `override_max_sentbox` tinyint(1) NOT NULL DEFAULT 0,
  `override_max_savebox` tinyint(1) NOT NULL DEFAULT 0,
  `group_count` int(4) UNSIGNED DEFAULT 99999999,
  `group_count_max` int(4) UNSIGNED DEFAULT 99999999,
  `group_count_enable` smallint(2) UNSIGNED DEFAULT 0,
  PRIMARY KEY (`group_id`),
  KEY `group_single_user` (`group_single_user`)
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

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbinline_ads`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbinline_ads`;
CREATE TABLE IF NOT EXISTS `nuke_bbinline_ads` (
  `ad_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `ad_code` text NOT NULL,
  `ad_name` char(25) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bblogs`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 07:31 AM
-- Last check: Jan 18, 2023 at 07:37 AM
--

DROP TABLE IF EXISTS `nuke_bblogs`;
CREATE TABLE IF NOT EXISTS `nuke_bblogs` (
  `log_id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `mode` varchar(50) DEFAULT '',
  `topic_id` mediumint(10) DEFAULT 0,
  `user_id` mediumint(8) DEFAULT 0,
  `username` varchar(255) DEFAULT '',
  `user_ip` varchar(8) NOT NULL DEFAULT '0',
  `time` int(11) DEFAULT 0,
  `new_topic_id` mediumint(10) NOT NULL DEFAULT 0,
  `forum_id` mediumint(10) NOT NULL DEFAULT 0,
  `new_forum_id` mediumint(10) NOT NULL DEFAULT 0,
  `last_post_id` mediumint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`log_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bblogs_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 07, 2023 at 09:30 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bblogs_config`;
CREATE TABLE IF NOT EXISTS `nuke_bblogs_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbposts`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 07:32 AM
-- Last check: Jan 18, 2023 at 07:37 AM
--

DROP TABLE IF EXISTS `nuke_bbposts`;
CREATE TABLE IF NOT EXISTS `nuke_bbposts` (
  `post_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `poster_id` mediumint(8) NOT NULL DEFAULT 0,
  `post_time` int(11) NOT NULL DEFAULT 0,
  `poster_ip` varchar(8) NOT NULL DEFAULT '',
  `post_username` varchar(25) DEFAULT NULL,
  `enable_bbcode` tinyint(1) NOT NULL DEFAULT 1,
  `enable_html` tinyint(1) NOT NULL DEFAULT 0,
  `enable_smilies` tinyint(1) NOT NULL DEFAULT 1,
  `enable_sig` tinyint(1) NOT NULL DEFAULT 1,
  `post_edit_time` int(11) DEFAULT NULL,
  `post_edit_count` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `post_attachment` tinyint(1) NOT NULL DEFAULT 0,
  `post_move` tinyint(1) NOT NULL DEFAULT 0,
  `post_icon` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `post_time` (`post_time`),
  KEY `post_icon` (`post_icon`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbposts_text`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 07:32 AM
-- Last check: Jan 18, 2023 at 07:37 AM
--

DROP TABLE IF EXISTS `nuke_bbposts_text`;
CREATE TABLE IF NOT EXISTS `nuke_bbposts_text` (
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `bbcode_uid` varchar(10) NOT NULL DEFAULT '',
  `post_subject` varchar(120) DEFAULT NULL,
  `post_text` text DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbpost_reports`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbpost_reports`;
CREATE TABLE IF NOT EXISTS `nuke_bbpost_reports` (
  `report_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `post_id` mediumint(8) NOT NULL DEFAULT 0,
  `reporter_id` mediumint(8) NOT NULL DEFAULT 0,
  `report_status` tinyint(1) NOT NULL DEFAULT 0,
  `report_time` int(11) NOT NULL DEFAULT 0,
  `report_comments` text DEFAULT NULL,
  `last_action_user_id` mediumint(8) DEFAULT 0,
  `last_action_time` int(11) NOT NULL DEFAULT 0,
  `last_action_comments` text DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 11:40 AM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_bbprivmsgs`;
CREATE TABLE IF NOT EXISTS `nuke_bbprivmsgs` (
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT 0,
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_date` int(11) NOT NULL DEFAULT 0,
  `privmsgs_ip` varchar(8) NOT NULL DEFAULT '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT 0,
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_attachment` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`privmsgs_id`),
  KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  KEY `privmsgs_to_userid` (`privmsgs_to_userid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs_archive`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbprivmsgs_archive`;
CREATE TABLE IF NOT EXISTS `nuke_bbprivmsgs_archive` (
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT 0,
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_date` int(11) NOT NULL DEFAULT 0,
  `privmsgs_ip` varchar(8) NOT NULL DEFAULT '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT 0,
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`privmsgs_id`),
  KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  KEY `privmsgs_to_userid` (`privmsgs_to_userid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs_text`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 11:40 AM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_bbprivmsgs_text`;
CREATE TABLE IF NOT EXISTS `nuke_bbprivmsgs_text` (
  `privmsgs_text_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `privmsgs_bbcode_uid` varchar(10) NOT NULL DEFAULT '0',
  `privmsgs_text` text DEFAULT NULL,
  PRIMARY KEY (`privmsgs_text_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbquicksearch`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbquicksearch`;
CREATE TABLE IF NOT EXISTS `nuke_bbquicksearch` (
  `search_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `search_name` varchar(255) NOT NULL DEFAULT '',
  `search_url1` varchar(255) NOT NULL DEFAULT '',
  `search_url2` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`search_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbquota_limits`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbquota_limits`;
CREATE TABLE IF NOT EXISTS `nuke_bbquota_limits` (
  `quota_limit_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `quota_desc` varchar(20) NOT NULL DEFAULT '',
  `quota_limit` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`quota_limit_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbranks`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbranks`;
CREATE TABLE IF NOT EXISTS `nuke_bbranks` (
  `rank_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(100) NOT NULL DEFAULT '',
  `rank_min` mediumint(8) NOT NULL DEFAULT 0,
  `rank_special` tinyint(1) DEFAULT 0,
  `rank_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rank_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbreputation`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbreputation`;
CREATE TABLE IF NOT EXISTS `nuke_bbreputation` (
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id_2` mediumint(8) NOT NULL DEFAULT 0,
  `post_id` mediumint(8) NOT NULL DEFAULT 0,
  `rep_sum` float NOT NULL DEFAULT 0,
  `rep_neg` tinyint(1) NOT NULL DEFAULT 0,
  `rep_comment` varchar(200) NOT NULL DEFAULT '',
  `rep_time` int(11) NOT NULL DEFAULT 0,
  KEY `user_id` (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbreputation_config`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 03, 2023 at 11:34 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbreputation_config`;
CREATE TABLE IF NOT EXISTS `nuke_bbreputation_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbscores`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 11, 2023 at 01:58 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbscores`;
CREATE TABLE IF NOT EXISTS `nuke_bbscores` (
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `score_game` int(11) NOT NULL DEFAULT 0,
  `score_date` int(11) NOT NULL DEFAULT 0,
  `score_time` int(11) NOT NULL DEFAULT 0,
  `score_set` mediumint(8) NOT NULL DEFAULT 0,
  KEY `game_id` (`game_id`),
  KEY `user_id` (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_rebuild`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbsearch_rebuild`;
CREATE TABLE IF NOT EXISTS `nuke_bbsearch_rebuild` (
  `rebuild_session_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `end_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `start_time` int(11) NOT NULL DEFAULT 0,
  `end_time` int(11) NOT NULL DEFAULT 0,
  `last_cycle_time` int(11) NOT NULL DEFAULT 0,
  `session_time` int(11) NOT NULL DEFAULT 0,
  `session_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `session_cycles` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `search_size` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `rebuild_session_status` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rebuild_session_id`),
  KEY `end_post_id` (`end_post_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_results`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 11, 2023 at 06:06 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbsearch_results`;
CREATE TABLE IF NOT EXISTS `nuke_bbsearch_results` (
  `search_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `search_array` text NOT NULL,
  `search_time` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`search_id`),
  KEY `session_id` (`session_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_wordlist`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 07:32 AM
-- Last check: Jan 18, 2023 at 07:37 AM
--

DROP TABLE IF EXISTS `nuke_bbsearch_wordlist`;
CREATE TABLE IF NOT EXISTS `nuke_bbsearch_wordlist` (
  `word_text` varchar(255) BINARY NOT NULL DEFAULT '',
  `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `word_common` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`word_text`),
  KEY `word_id` (`word_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_wordmatch`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 07:32 AM
-- Last check: Jan 18, 2023 at 07:37 AM
--

DROP TABLE IF EXISTS `nuke_bbsearch_wordmatch`;
CREATE TABLE IF NOT EXISTS `nuke_bbsearch_wordmatch` (
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `word_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `title_match` tinyint(1) NOT NULL DEFAULT 0,
  KEY `post_id` (`post_id`),
  KEY `word_id` (`word_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsessions`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 06:45 PM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_bbsessions`;
CREATE TABLE IF NOT EXISTS `nuke_bbsessions` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `session_user_id` mediumint(8) NOT NULL DEFAULT 0,
  `session_start` int(11) NOT NULL DEFAULT 0,
  `session_time` int(11) NOT NULL DEFAULT 0,
  `session_ip` varchar(8) NOT NULL DEFAULT '0',
  `session_page` int(11) NOT NULL DEFAULT 0,
  `session_logged_in` tinyint(1) NOT NULL DEFAULT 0,
  `session_admin` tinyint(2) NOT NULL DEFAULT 0,
  `session_url_qs` varchar(255) NOT NULL DEFAULT '',
  `session_url_ps` varchar(255) NOT NULL DEFAULT '',
  `session_url_specific` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`session_id`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsessions_keys`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbsessions_keys`;
CREATE TABLE IF NOT EXISTS `nuke_bbsessions_keys` (
  `key_id` varchar(32) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `last_ip` varchar(8) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`key_id`,`user_id`),
  KEY `last_login` (`last_login`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsmilies`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbsmilies`;
CREATE TABLE IF NOT EXISTS `nuke_bbsmilies` (
  `smilies_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `smile_url` varchar(100) DEFAULT NULL,
  `emoticon` varchar(75) DEFAULT NULL,
  `smile_stat` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`smilies_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbstats_config`;
CREATE TABLE IF NOT EXISTS `nuke_bbstats_config` (
  `config_name` varchar(100) NOT NULL DEFAULT '',
  `config_value` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_modules`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbstats_modules`;
CREATE TABLE IF NOT EXISTS `nuke_bbstats_modules` (
  `module_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `short_name` varchar(100) DEFAULT NULL,
  `update_time` mediumint(8) NOT NULL DEFAULT 0,
  `module_order` mediumint(8) NOT NULL DEFAULT 0,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  `perm_all` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_reg` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_mod` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_admin` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`module_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_module_admin_panel`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbstats_module_admin_panel`;
CREATE TABLE IF NOT EXISTS `nuke_bbstats_module_admin_panel` (
  `module_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  `config_type` varchar(20) NOT NULL DEFAULT '',
  `config_title` varchar(100) NOT NULL DEFAULT '',
  `config_explain` varchar(100) DEFAULT NULL,
  `config_trigger` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`module_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_module_cache`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbstats_module_cache`;
CREATE TABLE IF NOT EXISTS `nuke_bbstats_module_cache` (
  `module_id` mediumint(8) NOT NULL DEFAULT 0,
  `module_cache_time` int(12) NOT NULL DEFAULT 0,
  `db_cache` text NOT NULL,
  `priority` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`module_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_module_group_auth`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbstats_module_group_auth`;
CREATE TABLE IF NOT EXISTS `nuke_bbstats_module_group_auth` (
  `module_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`module_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_module_info`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbstats_module_info`;
CREATE TABLE IF NOT EXISTS `nuke_bbstats_module_info` (
  `module_id` mediumint(8) NOT NULL DEFAULT 0,
  `long_name` varchar(100) NOT NULL DEFAULT '',
  `author` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `version` varchar(10) NOT NULL DEFAULT '',
  `update_site` varchar(100) DEFAULT NULL,
  `extra_info` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`module_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_smilies_index`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbstats_smilies_index`;
CREATE TABLE IF NOT EXISTS `nuke_bbstats_smilies_index` (
  `code` varchar(50) NOT NULL DEFAULT '',
  `smile_url` varchar(100) DEFAULT NULL,
  `smile_count` mediumint(8) DEFAULT 0,
  PRIMARY KEY (`code`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_smilies_info`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbstats_smilies_info`;
CREATE TABLE IF NOT EXISTS `nuke_bbstats_smilies_info` (
  `last_post_id` mediumint(8) NOT NULL DEFAULT 0,
  `last_update_time` int(12) NOT NULL DEFAULT 0,
  `update_time` mediumint(8) NOT NULL DEFAULT 10080,
  PRIMARY KEY (`last_post_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthanks`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 03, 2023 at 11:34 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbthanks`;
CREATE TABLE IF NOT EXISTS `nuke_bbthanks` (
  `topic_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `thanks_time` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthemes`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbthemes`;
CREATE TABLE IF NOT EXISTS `nuke_bbthemes` (
  `themes_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `template_name` varchar(30) NOT NULL DEFAULT '',
  `style_name` varchar(30) NOT NULL DEFAULT '',
  `head_stylesheet` varchar(100) DEFAULT NULL,
  `body_background` varchar(100) DEFAULT NULL,
  `body_bgcolor` varchar(6) DEFAULT NULL,
  `body_text` varchar(6) DEFAULT NULL,
  `body_link` varchar(6) DEFAULT NULL,
  `body_vlink` varchar(6) DEFAULT NULL,
  `body_alink` varchar(6) DEFAULT NULL,
  `body_hlink` varchar(6) DEFAULT NULL,
  `tr_color1` varchar(6) DEFAULT NULL,
  `tr_color2` varchar(6) DEFAULT NULL,
  `tr_color3` varchar(6) DEFAULT NULL,
  `tr_class1` varchar(25) DEFAULT NULL,
  `tr_class2` varchar(25) DEFAULT NULL,
  `tr_class3` varchar(25) DEFAULT NULL,
  `th_color1` varchar(6) DEFAULT NULL,
  `th_color2` varchar(6) DEFAULT NULL,
  `th_color3` varchar(6) DEFAULT NULL,
  `th_class1` varchar(25) DEFAULT NULL,
  `th_class2` varchar(25) DEFAULT NULL,
  `th_class3` varchar(25) DEFAULT NULL,
  `td_color1` varchar(6) DEFAULT NULL,
  `td_color2` varchar(6) DEFAULT NULL,
  `td_color3` varchar(6) DEFAULT NULL,
  `td_class1` varchar(25) DEFAULT NULL,
  `td_class2` varchar(25) DEFAULT NULL,
  `td_class3` varchar(25) DEFAULT NULL,
  `fontface1` varchar(50) DEFAULT NULL,
  `fontface2` varchar(50) DEFAULT NULL,
  `fontface3` varchar(50) DEFAULT NULL,
  `fontsize1` tinyint(4) DEFAULT NULL,
  `fontsize2` tinyint(4) DEFAULT NULL,
  `fontsize3` tinyint(4) DEFAULT NULL,
  `fontcolor1` varchar(6) DEFAULT NULL,
  `fontcolor2` varchar(6) DEFAULT NULL,
  `fontcolor3` varchar(6) DEFAULT NULL,
  `span_class1` varchar(25) DEFAULT NULL,
  `span_class2` varchar(25) DEFAULT NULL,
  `span_class3` varchar(25) DEFAULT NULL,
  `img_size_poll` smallint(5) UNSIGNED DEFAULT NULL,
  `img_size_privmsg` smallint(5) UNSIGNED DEFAULT NULL,
  `online_color` varchar(6) NOT NULL DEFAULT '',
  `offline_color` varchar(6) NOT NULL DEFAULT '',
  `hidden_color` varchar(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`themes_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthemes_name`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbthemes_name`;
CREATE TABLE IF NOT EXISTS `nuke_bbthemes_name` (
  `themes_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `tr_color1_name` char(50) DEFAULT NULL,
  `tr_color2_name` char(50) DEFAULT NULL,
  `tr_color3_name` char(50) DEFAULT NULL,
  `tr_class1_name` char(50) DEFAULT NULL,
  `tr_class2_name` char(50) DEFAULT NULL,
  `tr_class3_name` char(50) DEFAULT NULL,
  `th_color1_name` char(50) DEFAULT NULL,
  `th_color2_name` char(50) DEFAULT NULL,
  `th_color3_name` char(50) DEFAULT NULL,
  `th_class1_name` char(50) DEFAULT NULL,
  `th_class2_name` char(50) DEFAULT NULL,
  `th_class3_name` char(50) DEFAULT NULL,
  `td_color1_name` char(50) DEFAULT NULL,
  `td_color2_name` char(50) DEFAULT NULL,
  `td_color3_name` char(50) DEFAULT NULL,
  `td_class1_name` char(50) DEFAULT NULL,
  `td_class2_name` char(50) DEFAULT NULL,
  `td_class3_name` char(50) DEFAULT NULL,
  `fontface1_name` char(50) DEFAULT NULL,
  `fontface2_name` char(50) DEFAULT NULL,
  `fontface3_name` char(50) DEFAULT NULL,
  `fontsize1_name` char(50) DEFAULT NULL,
  `fontsize2_name` char(50) DEFAULT NULL,
  `fontsize3_name` char(50) DEFAULT NULL,
  `fontcolor1_name` char(50) DEFAULT NULL,
  `fontcolor2_name` char(50) DEFAULT NULL,
  `fontcolor3_name` char(50) DEFAULT NULL,
  `span_class1_name` char(50) DEFAULT NULL,
  `span_class2_name` char(50) DEFAULT NULL,
  `span_class3_name` char(50) DEFAULT NULL,
  PRIMARY KEY (`themes_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopics`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 01:58 PM
-- Last check: Jan 18, 2023 at 11:36 AM
--

DROP TABLE IF EXISTS `nuke_bbtopics`;
CREATE TABLE IF NOT EXISTS `nuke_bbtopics` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forum_id` smallint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_title` char(120) NOT NULL DEFAULT '',
  `topic_poster` mediumint(8) NOT NULL DEFAULT 0,
  `topic_time` int(11) NOT NULL DEFAULT 0,
  `topic_views` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_replies` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_status` tinyint(3) NOT NULL DEFAULT 0,
  `topic_vote` tinyint(1) NOT NULL DEFAULT 0,
  `topic_type` tinyint(3) NOT NULL DEFAULT 0,
  `topic_last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_first_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_moved_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_priority` smallint(6) NOT NULL DEFAULT 0,
  `topic_attachment` tinyint(1) NOT NULL DEFAULT 0,
  `topic_glance_priority` smallint(6) NOT NULL DEFAULT 0,
  `topic_icon` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_moved_id` (`topic_moved_id`),
  KEY `topic_status` (`topic_status`),
  KEY `topic_type` (`topic_type`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopics_email`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 03, 2023 at 11:34 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbtopics_email`;
CREATE TABLE IF NOT EXISTS `nuke_bbtopics_email` (
  `user_id` mediumint(8) NOT NULL,
  `friend_name` varchar(100) NOT NULL,
  `friend_email` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL DEFAULT '',
  `topic_id` mediumint(8) NOT NULL,
  `time` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopics_watch`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbtopics_watch`;
CREATE TABLE IF NOT EXISTS `nuke_bbtopics_watch` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `notify_status` tinyint(1) NOT NULL DEFAULT 0,
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopic_moved`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbtopic_moved`;
CREATE TABLE IF NOT EXISTS `nuke_bbtopic_moved` (
  `moved_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `moved_topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `moved_oldtopic_id` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_type` varchar(8) NOT NULL DEFAULT '0',
  `moved_parent` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_target` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_mod` mediumint(8) NOT NULL DEFAULT 0,
  `moved_time` int(11) NOT NULL DEFAULT 0,
  `last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`moved_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopic_view`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 19, 2023 at 01:58 PM
-- Last check: Jan 18, 2023 at 11:36 AM
--

DROP TABLE IF EXISTS `nuke_bbtopic_view`;
CREATE TABLE IF NOT EXISTS `nuke_bbtopic_view` (
  `topic_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `view_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbuser_group`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 16, 2023 at 03:07 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbuser_group`;
CREATE TABLE IF NOT EXISTS `nuke_bbuser_group` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_pending` tinyint(1) DEFAULT NULL,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_desc`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbvote_desc`;
CREATE TABLE IF NOT EXISTS `nuke_bbvote_desc` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_text` text NOT NULL,
  `vote_start` int(11) NOT NULL DEFAULT 0,
  `vote_length` int(11) NOT NULL DEFAULT 0,
  `poll_view_toggle` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`vote_id`),
  KEY `topic_id` (`topic_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_results`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbvote_results`;
CREATE TABLE IF NOT EXISTS `nuke_bbvote_results` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_option_id` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `vote_option_text` varchar(255) NOT NULL DEFAULT '',
  `vote_result` int(11) NOT NULL DEFAULT 0,
  KEY `vote_option_id` (`vote_option_id`),
  KEY `vote_id` (`vote_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_voters`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbvote_voters`;
CREATE TABLE IF NOT EXISTS `nuke_bbvote_voters` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_user_id` mediumint(8) NOT NULL DEFAULT 0,
  `vote_user_ip` char(8) NOT NULL DEFAULT '',
  `vote_cast` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  KEY `vote_id` (`vote_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`),
  KEY `vote_cast` (`vote_cast`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbwords`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbwords`;
CREATE TABLE IF NOT EXISTS `nuke_bbwords` (
  `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `word` char(100) NOT NULL DEFAULT '',
  `replacement` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`word_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbxdata_auth`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 03, 2023 at 11:34 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbxdata_auth`;
CREATE TABLE IF NOT EXISTS `nuke_bbxdata_auth` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `auth_value` tinyint(1) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbxdata_data`
--
-- Creation: Jan 03, 2023 at 11:34 PM
-- Last update: Jan 03, 2023 at 11:34 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbxdata_data`;
CREATE TABLE IF NOT EXISTS `nuke_bbxdata_data` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `xdata_value` text NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbxdata_fields`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bbxdata_fields`;
CREATE TABLE IF NOT EXISTS `nuke_bbxdata_fields` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL DEFAULT '',
  `field_desc` text NOT NULL,
  `field_type` varchar(255) NOT NULL DEFAULT '',
  `field_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `code_name` varchar(255) NOT NULL DEFAULT '',
  `field_length` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `field_values` text NOT NULL,
  `field_regexp` text NOT NULL,
  `manditory` tinyint(1) NOT NULL DEFAULT 0,
  `default_auth` tinyint(1) NOT NULL DEFAULT 1,
  `display_register` tinyint(1) NOT NULL DEFAULT 1,
  `display_viewprofile` tinyint(1) NOT NULL DEFAULT 0,
  `display_posting` tinyint(1) NOT NULL DEFAULT 0,
  `handle_input` tinyint(1) NOT NULL DEFAULT 0,
  `allow_html` tinyint(1) NOT NULL DEFAULT 0,
  `allow_bbcode` tinyint(1) NOT NULL DEFAULT 0,
  `allow_smilies` tinyint(1) NOT NULL DEFAULT 0,
  `viewtopic` tinyint(1) NOT NULL DEFAULT 0,
  `signup` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`field_id`),
  UNIQUE KEY `code_name` (`code_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blocks`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 06:10 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_blocks`;
CREATE TABLE IF NOT EXISTS `nuke_blocks` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `bkey` varchar(15) NOT NULL DEFAULT '',
  `title` varchar(60) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '',
  `bposition` char(1) NOT NULL DEFAULT '',
  `weight` int(11) NOT NULL DEFAULT 1,
  `active` int(11) NOT NULL DEFAULT 1,
  `refresh` int(11) NOT NULL DEFAULT 0,
  `time` varchar(14) NOT NULL DEFAULT '0',
  `blanguage` varchar(30) NOT NULL DEFAULT '',
  `blockfile` varchar(255) NOT NULL DEFAULT '',
  `view` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `title` (`title`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bookmarks`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 08:32 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bookmarks`;
CREATE TABLE IF NOT EXISTS `nuke_bookmarks` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `url` varchar(256) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00',
  `popup` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bookmarks_cat`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 08:31 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_bookmarks_cat`;
CREATE TABLE IF NOT EXISTS `nuke_bookmarks_cat` (
  `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cemetery`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_cemetery`;
CREATE TABLE IF NOT EXISTS `nuke_cemetery` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `url` varchar(256) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00',
  `popup` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cemetery_cat`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_cemetery_cat`;
CREATE TABLE IF NOT EXISTS `nuke_cemetery_cat` (
  `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cnbya_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 16, 2023 at 03:29 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_cnbya_config`;
CREATE TABLE IF NOT EXISTS `nuke_cnbya_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext DEFAULT NULL,
  UNIQUE KEY `config_name` (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cnbya_field`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_cnbya_field`;
CREATE TABLE IF NOT EXISTS `nuke_cnbya_field` (
  `fid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'field',
  `value` varchar(255) DEFAULT NULL,
  `size` int(3) DEFAULT NULL,
  `need` int(1) NOT NULL DEFAULT 1,
  `pos` int(3) DEFAULT NULL,
  `public` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`fid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cnbya_value`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_cnbya_value`;
CREATE TABLE IF NOT EXISTS `nuke_cnbya_value` (
  `vid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL DEFAULT 0,
  `fid` int(10) NOT NULL DEFAULT 0,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`vid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cnbya_value_temp`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_cnbya_value_temp`;
CREATE TABLE IF NOT EXISTS `nuke_cnbya_value_temp` (
  `vid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL DEFAULT 0,
  `fid` int(10) NOT NULL DEFAULT 0,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`vid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_comments`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_comments`;
CREATE TABLE IF NOT EXISTS `nuke_comments` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `datePublished` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(85) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT 0,
  `reason` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tid`),
  KEY `pid` (`pid`),
  KEY `sid` (`sid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 12:48 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_config`;
CREATE TABLE IF NOT EXISTS `nuke_config` (
  `sitename` varchar(255) NOT NULL DEFAULT '',
  `nukeurl` varchar(255) NOT NULL DEFAULT '',
  `site_logo` varchar(255) NOT NULL DEFAULT '',
  `slogan` varchar(255) NOT NULL DEFAULT '',
  `startdate` varchar(50) NOT NULL DEFAULT '',
  `datePublished` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp(),
  `adminmail` varchar(255) NOT NULL DEFAULT '',
  `anonpost` tinyint(1) NOT NULL DEFAULT 0,
  `default_Theme` varchar(255) NOT NULL DEFAULT 'Titanium_Core',
  `foot1` text DEFAULT NULL,
  `foot2` text DEFAULT NULL,
  `foot3` text DEFAULT NULL,
  `commentlimit` int(9) NOT NULL DEFAULT 4096,
  `anonymous` varchar(255) NOT NULL DEFAULT '',
  `minpass` tinyint(1) NOT NULL DEFAULT 5,
  `pollcomm` tinyint(1) NOT NULL DEFAULT 1,
  `articlecomm` tinyint(1) NOT NULL DEFAULT 1,
  `broadcast_msg` tinyint(1) NOT NULL DEFAULT 1,
  `my_headlines` tinyint(1) NOT NULL DEFAULT 1,
  `top` int(3) NOT NULL DEFAULT 10,
  `storyhome` int(2) NOT NULL DEFAULT 10,
  `user_news` tinyint(1) NOT NULL DEFAULT 1,
  `oldnum` int(2) NOT NULL DEFAULT 30,
  `ultramode` tinyint(1) NOT NULL DEFAULT 0,
  `banners` tinyint(1) NOT NULL DEFAULT 1,
  `backend_title` varchar(255) NOT NULL DEFAULT '',
  `backend_language` varchar(10) NOT NULL DEFAULT '',
  `language` varchar(100) NOT NULL DEFAULT '',
  `locale` varchar(10) NOT NULL DEFAULT '',
  `multilingual` tinyint(1) NOT NULL DEFAULT 0,
  `useflags` tinyint(1) NOT NULL DEFAULT 0,
  `notify` tinyint(1) NOT NULL DEFAULT 0,
  `notify_email` varchar(255) NOT NULL DEFAULT '',
  `notify_subject` varchar(255) NOT NULL DEFAULT '',
  `notify_message` varchar(255) NOT NULL DEFAULT '',
  `notify_from` varchar(255) NOT NULL DEFAULT '',
  `moderate` tinyint(1) NOT NULL DEFAULT 0,
  `admingraphic` tinyint(1) NOT NULL DEFAULT 1,
  `httpref` tinyint(1) NOT NULL DEFAULT 1,
  `httprefmax` int(5) NOT NULL DEFAULT 1000,
  `CensorMode` tinyint(1) NOT NULL DEFAULT 3,
  `CensorReplace` varchar(10) NOT NULL DEFAULT '',
  `copyright` text DEFAULT NULL,
  `Version_Num` varchar(10) NOT NULL DEFAULT '',
  `admin_pos` tinyint(1) NOT NULL DEFAULT 1,
  `admin_log_lines` int(11) NOT NULL DEFAULT 0,
  `error_log_lines` int(11) NOT NULL DEFAULT 0,
  `cache_data` mediumblob DEFAULT NULL,
  UNIQUE KEY `Version_Num` (`Version_Num`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_confirm`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_confirm`;
CREATE TABLE IF NOT EXISTS `nuke_confirm` (
  `confirm_id` char(32) NOT NULL DEFAULT '',
  `session_id` char(32) NOT NULL DEFAULT '',
  `code` char(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`session_id`,`confirm_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_counter`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 06:45 PM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_counter`;
CREATE TABLE IF NOT EXISTS `nuke_counter` (
  `type` varchar(80) NOT NULL DEFAULT '',
  `var` varchar(80) NOT NULL DEFAULT '',
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  KEY `var` (`var`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_donators`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_donators`;
CREATE TABLE IF NOT EXISTS `nuke_donators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT 0,
  `uname` varchar(60) NOT NULL DEFAULT '',
  `fname` varchar(25) NOT NULL DEFAULT '',
  `lname` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `donated` decimal(8,2) NOT NULL DEFAULT 0.00,
  `dondate` varchar(255) NOT NULL DEFAULT '',
  `donshow` tinyint(1) NOT NULL DEFAULT 0,
  `uip` varchar(255) NOT NULL DEFAULT '',
  `donok` tinyint(1) NOT NULL DEFAULT 0,
  `msg` text DEFAULT NULL,
  `donto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_donators_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_donators_config`;
CREATE TABLE IF NOT EXISTS `nuke_donators_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` text NOT NULL,
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ecalendar`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_ecalendar`;
CREATE TABLE IF NOT EXISTS `nuke_ecalendar` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(11) DEFAULT NULL,
  `day` varchar(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `reoccur` int(11) NOT NULL DEFAULT 0,
  `time` varchar(5) DEFAULT NULL,
  `ampm` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`eid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_evolution`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 11:36 AM
-- Last check: Jan 18, 2023 at 11:36 AM
--

DROP TABLE IF EXISTS `nuke_evolution`;
CREATE TABLE IF NOT EXISTS `nuke_evolution` (
  `evo_field` varchar(50) NOT NULL DEFAULT '',
  `evo_value` text NOT NULL,
  PRIMARY KEY (`evo_field`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_evo_userinfo`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_evo_userinfo`;
CREATE TABLE IF NOT EXISTS `nuke_evo_userinfo` (
  `name` varchar(25) NOT NULL,
  `filename` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_evo_userinfo_addons`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_evo_userinfo_addons`;
CREATE TABLE IF NOT EXISTS `nuke_evo_userinfo_addons` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_faqanswer`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_faqanswer`;
CREATE TABLE IF NOT EXISTS `nuke_faqanswer` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_cat` int(25) NOT NULL DEFAULT 0,
  `question` varchar(255) DEFAULT '',
  `answer` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_faqcategories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_faqcategories`;
CREATE TABLE IF NOT EXISTS `nuke_faqcategories` (
  `id_cat` tinyint(3) NOT NULL AUTO_INCREMENT,
  `categories` varchar(255) DEFAULT NULL,
  `flanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_cat`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_categories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_file_repository_categories`;
CREATE TABLE IF NOT EXISTS `nuke_file_repository_categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `permissions` int(11) NOT NULL DEFAULT 0,
  `isallowed` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_comments`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_file_repository_comments`;
CREATE TABLE IF NOT EXISTS `nuke_file_repository_comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `rating` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_files`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_file_repository_files`;
CREATE TABLE IF NOT EXISTS `nuke_file_repository_files` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `ftitle` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filesize` int(20) NOT NULL,
  `last_downloaded` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  PRIMARY KEY (`fid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_items`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_file_repository_items`;
CREATE TABLE IF NOT EXISTS `nuke_file_repository_items` (
  `cid` int(11) NOT NULL DEFAULT 0,
  `author` varchar(100) NOT NULL DEFAULT '',
  `author_email` varchar(100) NOT NULL DEFAULT '',
  `author_website` varchar(100) NOT NULL DEFAULT '',
  `color` varchar(7) NOT NULL DEFAULT '',
  `currency` varchar(7) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `description` text DEFAULT NULL,
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `fixes` longtext DEFAULT NULL,
  `groups` int(11) NOT NULL DEFAULT 0,
  `hits` int(11) NOT NULL DEFAULT 0,
  `isactive` int(11) NOT NULL DEFAULT 0,
  `isapproved` int(11) NOT NULL DEFAULT 0,
  `isbroken` tinyint(1) NOT NULL DEFAULT 0,
  `isfeatured` int(11) NOT NULL DEFAULT 0,
  `isnew` int(11) NOT NULL DEFAULT 0,
  `isupdated` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `lastdownloaded` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `paypal` varchar(255) NOT NULL DEFAULT '',
  `points` int(11) NOT NULL DEFAULT 0,
  `posts` int(11) NOT NULL DEFAULT 0,
  `preview` varchar(255) NOT NULL DEFAULT '',
  `price` int(11) NOT NULL DEFAULT 0,
  `semail` varchar(100) NOT NULL DEFAULT '',
  `sname` varchar(100) NOT NULL DEFAULT '',
  `suid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `version` varchar(30) NOT NULL DEFAULT '',
  `views` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`did`),
  KEY `cid` (`cid`),
  KEY `title` (`title`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_screenshots`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_file_repository_screenshots`;
CREATE TABLE IF NOT EXISTS `nuke_file_repository_screenshots` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL DEFAULT 0,
  `filename` varchar(255) NOT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `submitter` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `did` (`did`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_settings`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_file_repository_settings`;
CREATE TABLE IF NOT EXISTS `nuke_file_repository_settings` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_themes`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_file_repository_themes`;
CREATE TABLE IF NOT EXISTS `nuke_file_repository_themes` (
  `theme_name` varchar(255) NOT NULL,
  `cell` int(11) NOT NULL,
  `head` int(11) NOT NULL,
  `per_row` int(11) NOT NULL,
  `show_left` int(11) NOT NULL,
  PRIMARY KEY (`theme_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_headlines`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_headlines`;
CREATE TABLE IF NOT EXISTS `nuke_headlines` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(30) NOT NULL DEFAULT '',
  `headlinesurl` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`hid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_categories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_hnl_categories`;
CREATE TABLE IF NOT EXISTS `nuke_hnl_categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `ctitle` varchar(50) NOT NULL DEFAULT '',
  `cdescription` text NOT NULL,
  `cblocklimit` int(4) NOT NULL DEFAULT 10,
  PRIMARY KEY (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_cfg`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_hnl_cfg`;
CREATE TABLE IF NOT EXISTS `nuke_hnl_cfg` (
  `cfg_nm` varchar(255) NOT NULL DEFAULT '',
  `cfg_val` longtext NOT NULL,
  PRIMARY KEY (`cfg_nm`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_newsletters`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_hnl_newsletters`;
CREATE TABLE IF NOT EXISTS `nuke_hnl_newsletters` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT 1,
  `topic` varchar(100) NOT NULL DEFAULT '',
  `sender` varchar(20) NOT NULL DEFAULT '',
  `filename` varchar(32) NOT NULL DEFAULT '',
  `datesent` date DEFAULT NULL,
  `view` int(1) NOT NULL DEFAULT 0,
  `groups` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`nid`),
  KEY `cid` (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_honeypot`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 06:11 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_honeypot`;
CREATE TABLE IF NOT EXISTS `nuke_honeypot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) NOT NULL,
  `realname` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(60) NOT NULL DEFAULT '',
  `date` varchar(50) NOT NULL DEFAULT '',
  `potnum` varchar(1) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_honeypot_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_honeypot_config`;
CREATE TABLE IF NOT EXISTS `nuke_honeypot_config` (
  `usehp` tinyint(1) NOT NULL,
  `botlisting` tinyint(1) NOT NULL,
  `perpage` varchar(3) NOT NULL,
  `pagenumberpos` tinyint(1) NOT NULL,
  `headcolor` varchar(7) NOT NULL,
  `rowcolor1` varchar(7) NOT NULL,
  `rowcolor2` varchar(7) NOT NULL,
  `pagebgcolor` varchar(7) NOT NULL,
  `pagebordercolor` varchar(7) NOT NULL,
  `fontcolor` varchar(7) NOT NULL,
  `fontcolor2` varchar(7) NOT NULL,
  `check1` tinyint(1) NOT NULL,
  `check2` tinyint(1) NOT NULL,
  `check3` tinyint(1) NOT NULL,
  `check4` tinyint(1) NOT NULL,
  `check5` tinyint(1) NOT NULL,
  `check6` tinyint(1) NOT NULL,
  `c7opt1` tinyint(1) NOT NULL,
  `c7opt2` tinyint(1) NOT NULL,
  `c7amount` varchar(2) NOT NULL,
  `c8opt1` tinyint(1) NOT NULL,
  `c8opt2` tinyint(1) NOT NULL,
  `usebsapi` tinyint(1) NOT NULL,
  `c8apikey` varchar(255) NOT NULL,
  `fs9opt1` tinyint(1) NOT NULL,
  `fs9opt2` tinyint(1) NOT NULL,
  `fs9apikey` varchar(255) NOT NULL,
  `check3time` varchar(2) NOT NULL,
  `check4question` varchar(255) NOT NULL,
  `check4answer` varchar(255) NOT NULL,
  `usefeedback` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `version` varchar(6) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_image_repository_settings`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_image_repository_settings`;
CREATE TABLE IF NOT EXISTS `nuke_image_repository_settings` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_image_repository_uploads`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 11:43 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_image_repository_uploads`;
CREATE TABLE IF NOT EXISTS `nuke_image_repository_uploads` (
  `pid` int(20) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `submitter` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `screensize` varchar(255) DEFAULT NULL,
  `uploaded` int(11) NOT NULL DEFAULT 0,
  `bypass_thumb` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_image_repository_users`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_image_repository_users`;
CREATE TABLE IF NOT EXISTS `nuke_image_repository_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `background_color` varchar(20) DEFAULT NULL,
  `border_color` varchar(20) DEFAULT NULL,
  `border_thickness` varchar(3) DEFAULT NULL,
  `folder` int(11) NOT NULL DEFAULT 0,
  `percent_color` varchar(20) DEFAULT NULL,
  `quota` varchar(255) DEFAULT NULL,
  `quota_request` tinyint(2) NOT NULL DEFAULT 0,
  `custom_color` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_jmap`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_jmap`;
CREATE TABLE IF NOT EXISTS `nuke_jmap` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_categories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 06, 2023 at 08:49 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_links_categories`;
CREATE TABLE IF NOT EXISTS `nuke_links_categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_editorials`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_links_editorials`;
CREATE TABLE IF NOT EXISTS `nuke_links_editorials` (
  `linkid` int(11) NOT NULL DEFAULT 0,
  `adminid` varchar(60) NOT NULL DEFAULT '',
  `editorialtimestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`linkid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_links`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 06, 2023 at 05:39 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_links_links`;
CREATE TABLE IF NOT EXISTS `nuke_links_links` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT 0,
  `submitter` varchar(60) NOT NULL DEFAULT '',
  `linkratingsummary` double(6,4) NOT NULL DEFAULT 0.0000,
  `totalvotes` int(11) NOT NULL DEFAULT 0,
  `totalcomments` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_modrequest`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_links_modrequest`;
CREATE TABLE IF NOT EXISTS `nuke_links_modrequest` (
  `requestid` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL DEFAULT '',
  `brokenlink` int(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`requestid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_newlink`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_links_newlink`;
CREATE TABLE IF NOT EXISTS `nuke_links_newlink` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `submitter` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_votedata`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_links_votedata`;
CREATE TABLE IF NOT EXISTS `nuke_links_votedata` (
  `ratingdbid` int(11) NOT NULL AUTO_INCREMENT,
  `ratinglid` int(11) NOT NULL DEFAULT 0,
  `ratinguser` varchar(60) NOT NULL DEFAULT '',
  `rating` int(11) NOT NULL DEFAULT 0,
  `ratinghostname` varchar(60) NOT NULL DEFAULT '',
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  PRIMARY KEY (`ratingdbid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_link_us`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_link_us`;
CREATE TABLE IF NOT EXISTS `nuke_link_us` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(60) NOT NULL DEFAULT '',
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `site_image` varchar(255) NOT NULL DEFAULT '',
  `site_description` text NOT NULL,
  `site_hits` int(10) NOT NULL DEFAULT 0,
  `site_status` int(1) NOT NULL DEFAULT 0,
  `date_added` varchar(255) NOT NULL DEFAULT '',
  `button_type` smallint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_email` varchar(60) NOT NULL DEFAULT '',
  `user_ip` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_link_us_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_link_us_config`;
CREATE TABLE IF NOT EXISTS `nuke_link_us_config` (
  `my_image` varchar(255) NOT NULL DEFAULT '',
  `fade_effect` smallint(1) NOT NULL DEFAULT 0,
  `marquee` smallint(1) NOT NULL DEFAULT 0,
  `marquee_direction` smallint(1) NOT NULL DEFAULT 0,
  `marquee_scroll` smallint(1) NOT NULL DEFAULT 0,
  `block_height` smallint(1) NOT NULL DEFAULT 0,
  `show_clicks` smallint(1) NOT NULL DEFAULT 0,
  `button_seperate` smallint(1) NOT NULL DEFAULT 0,
  `user_submit` smallint(1) NOT NULL DEFAULT 0,
  `button_method` smallint(1) NOT NULL DEFAULT 0,
  `button_height` tinyint(4) NOT NULL DEFAULT 0,
  `button_banner_height` tinyint(4) NOT NULL DEFAULT 0,
  `button_ressource_height` tinyint(4) NOT NULL DEFAULT 0,
  `button_width` tinyint(4) NOT NULL DEFAULT 0,
  `button_banner_width` tinyint(4) NOT NULL DEFAULT 0,
  `button_ressource_width` tinyint(4) NOT NULL DEFAULT 0,
  `upload_file` varchar(255) NOT NULL DEFAULT '',
  `button_standard` smallint(1) NOT NULL DEFAULT 0,
  `button_banner` smallint(1) NOT NULL DEFAULT 0,
  `button_resource` smallint(1) NOT NULL DEFAULT 0
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_main`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_main`;
CREATE TABLE IF NOT EXISTS `nuke_main` (
  `main_module` varchar(255) NOT NULL DEFAULT '',
  KEY `main_module` (`main_module`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_menu`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_menu`;
CREATE TABLE IF NOT EXISTS `nuke_menu` (
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `image` varchar(99) DEFAULT NULL,
  `lien` text DEFAULT NULL,
  `hr` char(2) DEFAULT NULL,
  `bgcolor` tinytext DEFAULT NULL,
  `invisible` int(1) NOT NULL DEFAULT 0,
  `class` varchar(25) DEFAULT 'categories',
  `bold` char(2) DEFAULT NULL,
  `new` char(2) DEFAULT NULL,
  `days` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`groupmenu`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_menu_categories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_menu_categories`;
CREATE TABLE IF NOT EXISTS `nuke_menu_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sublevel` tinyint(3) NOT NULL DEFAULT 0,
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `module` varchar(50) NOT NULL DEFAULT '',
  `url` text NOT NULL,
  `url_text` text NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT '',
  `new` char(2) DEFAULT '3',
  `new_days` tinyint(4) NOT NULL DEFAULT -1,
  `class` varchar(20) DEFAULT 'modules',
  `bold` char(2) DEFAULT NULL,
  `days` varchar(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_message`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_message`;
CREATE TABLE IF NOT EXISTS `nuke_message` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `date` varchar(14) NOT NULL DEFAULT '',
  `expire` int(7) NOT NULL DEFAULT 0,
  `active` int(1) NOT NULL DEFAULT 1,
  `view` int(1) NOT NULL DEFAULT 1,
  `groups` text NOT NULL,
  `mlanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `mid` (`mid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_meta`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_meta`;
CREATE TABLE IF NOT EXISTS `nuke_meta` (
  `meta_name` varchar(50) NOT NULL DEFAULT '',
  `meta_content` text NOT NULL,
  PRIMARY KEY (`meta_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_modules`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_modules`;
CREATE TABLE IF NOT EXISTS `nuke_modules` (
  `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `custom_title` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `view` tinyint(4) NOT NULL DEFAULT 0,
  `inmenu` tinyint(4) NOT NULL DEFAULT 1,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `cat_id` tinyint(4) NOT NULL DEFAULT 0,
  `blocks` tinyint(4) NOT NULL DEFAULT 1,
  `admins` varchar(255) NOT NULL DEFAULT '',
  `groups` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mid`),
  UNIQUE KEY `mid` (`mid`),
  KEY `title` (`title`),
  KEY `custom_title` (`custom_title`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_modules_cat`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_modules_cat`;
CREATE TABLE IF NOT EXISTS `nuke_modules_cat` (
  `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `image` text NOT NULL,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `link_type` tinyint(4) NOT NULL DEFAULT 0,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid` (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_modules_links`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_modules_links`;
CREATE TABLE IF NOT EXISTS `nuke_modules_links` (
  `lid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `link_type` tinyint(4) NOT NULL DEFAULT 0,
  `link` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `view` tinyint(4) NOT NULL DEFAULT 0,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `cat_id` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`lid`),
  UNIQUE KEY `lid` (`lid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_mostonline`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 06, 2023 at 08:25 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_mostonline`;
CREATE TABLE IF NOT EXISTS `nuke_mostonline` (
  `total` int(10) NOT NULL DEFAULT 0,
  `members` int(10) NOT NULL DEFAULT 0,
  `nonmembers` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`total`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsncb_blocks`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsncb_blocks`;
CREATE TABLE IF NOT EXISTS `nuke_nsncb_blocks` (
  `rid` tinyint(2) NOT NULL DEFAULT 0,
  `cgid` tinyint(2) NOT NULL DEFAULT 0,
  `cbid` tinyint(2) NOT NULL DEFAULT 0,
  `title` varchar(60) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `wtype` tinyint(1) NOT NULL DEFAULT 0,
  `width` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rid`),
  UNIQUE KEY `rid` (`rid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsncb_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsncb_config`;
CREATE TABLE IF NOT EXISTS `nuke_nsncb_config` (
  `cgid` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `height` smallint(6) NOT NULL,
  `count` tinyint(1) NOT NULL,
  PRIMARY KEY (`cgid`),
  UNIQUE KEY `cfgid` (`cgid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnne_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnne_config`;
CREATE TABLE IF NOT EXISTS `nuke_nsnne_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext NOT NULL,
  UNIQUE KEY `config_name` (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnsp_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnsp_config`;
CREATE TABLE IF NOT EXISTS `nuke_nsnsp_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` text NOT NULL,
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnsp_sites`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnsp_sites`;
CREATE TABLE IF NOT EXISTS `nuke_nsnsp_sites` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(60) NOT NULL DEFAULT '',
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `site_image` varchar(255) NOT NULL DEFAULT '',
  `site_status` int(1) NOT NULL DEFAULT 0,
  `site_hits` int(10) NOT NULL DEFAULT 0,
  `site_date` date NOT NULL DEFAULT '2018-12-12',
  `site_description` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_email` varchar(60) NOT NULL DEFAULT '',
  `user_ip` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`site_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_admins`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 16, 2023 at 10:09 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_admins`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_admins` (
  `aid` varchar(25) NOT NULL DEFAULT '',
  `login` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `password_md5` varchar(60) NOT NULL DEFAULT '',
  `password_crypt` varchar(60) NOT NULL DEFAULT '',
  `protected` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`aid`),
  KEY `password_md5` (`password_md5`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blocked_ips`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 16, 2023 at 11:22 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_blocked_ips`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_blocked_ips` (
  `ip_addr` varchar(15) NOT NULL DEFAULT '',
  `ip_long` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `username` varchar(60) NOT NULL DEFAULT 'Anonymous',
  `user_agent` text NOT NULL,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `reason` tinyint(1) NOT NULL DEFAULT 0,
  `query_string` text NOT NULL,
  `get_string` text NOT NULL,
  `post_string` text NOT NULL,
  `x_forward_for` varchar(32) NOT NULL DEFAULT 'None',
  `client_ip` varchar(32) NOT NULL DEFAULT 'None',
  `remote_addr` varchar(32) NOT NULL DEFAULT '',
  `remote_port` varchar(11) NOT NULL DEFAULT 'Unknown',
  `request_method` varchar(10) NOT NULL DEFAULT '',
  `expires` int(20) NOT NULL DEFAULT 0,
  `c2c` char(2) NOT NULL DEFAULT '00',
  PRIMARY KEY (`ip_addr`),
  KEY `ip_long` (`ip_long`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blocked_ranges`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_blocked_ranges`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_blocked_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `reason` tinyint(1) NOT NULL DEFAULT 0,
  `expires` int(20) NOT NULL DEFAULT 0,
  `c2c` char(2) NOT NULL DEFAULT '00',
  KEY `code` (`ip_lo`,`ip_hi`,`c2c`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blockers`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_blockers`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_blockers` (
  `blocker` int(4) NOT NULL DEFAULT 0,
  `block_name` varchar(20) NOT NULL DEFAULT '',
  `activate` int(4) NOT NULL DEFAULT 0,
  `block_type` int(4) NOT NULL DEFAULT 0,
  `email_lookup` int(4) NOT NULL DEFAULT 0,
  `forward` varchar(255) NOT NULL DEFAULT '',
  `reason` varchar(20) NOT NULL DEFAULT '',
  `template` varchar(255) NOT NULL DEFAULT '',
  `duration` int(20) NOT NULL DEFAULT 0,
  `htaccess` int(4) NOT NULL DEFAULT 0,
  `list` longtext NOT NULL,
  PRIMARY KEY (`blocker`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_cidrs`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_cidrs`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_cidrs` (
  `cidr` int(2) NOT NULL DEFAULT 0,
  `hosts` int(10) NOT NULL DEFAULT 0,
  `mask` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`cidr`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_config`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 20, 2023 at 12:00 AM
-- Last check: Jan 19, 2023 at 08:25 AM
--

DROP TABLE IF EXISTS `nuke_nsnst_config`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext NOT NULL,
  PRIMARY KEY (`config_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_countries`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_countries`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_countries` (
  `c2c` char(2) NOT NULL DEFAULT '',
  `country` varchar(60) NOT NULL DEFAULT '',
  KEY `c2c` (`c2c`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_excluded_ranges`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_excluded_ranges`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_excluded_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `c2c` char(2) NOT NULL DEFAULT '00',
  KEY `code` (`ip_lo`,`ip_hi`,`c2c`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_harvesters`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_harvesters`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_harvesters` (
  `hid` int(2) NOT NULL AUTO_INCREMENT,
  `harvester` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`harvester`),
  KEY `hid` (`hid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_ip2country`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_ip2country`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_ip2country` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `c2c` char(2) DEFAULT NULL,
  `country` char(100) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_protected_ranges`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_protected_ranges`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_protected_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `c2c` char(2) NOT NULL DEFAULT '00',
  KEY `code` (`ip_lo`,`ip_hi`,`c2c`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_referers`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_referers`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_referers` (
  `rid` int(2) NOT NULL AUTO_INCREMENT,
  `referer` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`referer`),
  KEY `rid` (`rid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_strings`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_nsnst_strings`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_strings` (
  `string` varchar(60) NOT NULL DEFAULT ''
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_tracked_ips`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 20, 2023 at 05:21 AM
-- Last check: Jan 20, 2023 at 01:00 AM
--

DROP TABLE IF EXISTS `nuke_nsnst_tracked_ips`;
CREATE TABLE IF NOT EXISTS `nuke_nsnst_tracked_ips` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `ip_addr` varchar(15) NOT NULL DEFAULT '',
  `ip_long` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `username` varchar(60) NOT NULL DEFAULT '',
  `user_agent` text NOT NULL,
  `refered_from` text NOT NULL,
  `date` int(11) NOT NULL DEFAULT 0,
  `page` text NOT NULL,
  `x_forward_for` varchar(32) NOT NULL DEFAULT '',
  `client_ip` varchar(32) NOT NULL DEFAULT '',
  `remote_addr` varchar(32) NOT NULL DEFAULT '',
  `remote_port` varchar(11) NOT NULL DEFAULT '',
  `request_method` varchar(10) NOT NULL DEFAULT '',
  `c2c` char(2) NOT NULL DEFAULT '00',
  PRIMARY KEY (`tid`),
  KEY `maintracking` (`ip_addr`,`ip_long`),
  KEY `ip_addr` (`ip_addr`),
  KEY `ip_long` (`ip_long`),
  KEY `user_id` (`user_id`),
  KEY `username` (`username`),
  KEY `user_agent` (`user_agent`(255)),
  KEY `refered_from` (`refered_from`(255)),
  KEY `date` (`date`),
  KEY `page` (`page`(255)),
  KEY `c2c` (`c2c`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pages`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_pages`;
CREATE TABLE IF NOT EXISTS `nuke_pages` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `subtitle` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT 0,
  `page_header` text NOT NULL,
  `text` text NOT NULL,
  `page_footer` text NOT NULL,
  `signature` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `counter` int(10) NOT NULL DEFAULT 0,
  `clanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`pid`),
  KEY `cid` (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pages_categories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_pages_categories`;
CREATE TABLE IF NOT EXISTS `nuke_pages_categories` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`cid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pollcomments`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_pollcomments`;
CREATE TABLE IF NOT EXISTS `nuke_pollcomments` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT 0,
  `pollID` int(11) NOT NULL DEFAULT 0,
  `date` datetime DEFAULT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(60) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT 0,
  `reason` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tid`),
  KEY `pid` (`pid`),
  KEY `pollID` (`pollID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_check`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 07:06 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_poll_check`;
CREATE TABLE IF NOT EXISTS `nuke_poll_check` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `pollID` int(10) NOT NULL DEFAULT 0
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_data`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 07:17 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_poll_data`;
CREATE TABLE IF NOT EXISTS `nuke_poll_data` (
  `pollID` int(11) NOT NULL DEFAULT 0,
  `optionText` char(50) NOT NULL DEFAULT '',
  `optionCount` int(11) NOT NULL DEFAULT 0,
  `voteID` int(11) NOT NULL DEFAULT 0
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_desc`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 07:06 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_poll_desc`;
CREATE TABLE IF NOT EXISTS `nuke_poll_desc` (
  `pollID` int(11) NOT NULL AUTO_INCREMENT,
  `pollTitle` varchar(100) NOT NULL DEFAULT '',
  `timeStamp` int(11) NOT NULL DEFAULT 0,
  `voters` mediumint(9) NOT NULL DEFAULT 0,
  `planguage` varchar(30) NOT NULL DEFAULT '',
  `artid` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pollID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_queue`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_queue`;
CREATE TABLE IF NOT EXISTS `nuke_queue` (
  `qid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` mediumint(9) NOT NULL DEFAULT 0,
  `uname` varchar(40) NOT NULL DEFAULT '',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `story` text DEFAULT NULL,
  `storyext` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `topic` varchar(20) NOT NULL DEFAULT '',
  `alanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`qid`),
  KEY `uid` (`uid`),
  KEY `uname` (`uname`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_quotes`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_quotes`;
CREATE TABLE IF NOT EXISTS `nuke_quotes` (
  `qid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `quote` text DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_referer`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 09:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_referer`;
CREATE TABLE IF NOT EXISTS `nuke_referer` (
  `url` varchar(100) NOT NULL,
  `lasttime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `link` varchar(100) NOT NULL,
  PRIMARY KEY (`url`),
  KEY `lasttime` (`lasttime`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_related`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_related`;
CREATE TABLE IF NOT EXISTS `nuke_related` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`rid`),
  KEY `tid` (`tid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_reviews`;
CREATE TABLE IF NOT EXISTS `nuke_reviews` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '2018-12-12',
  `title` varchar(150) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `reviewer` varchar(25) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0,
  `cover` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `url_title` varchar(50) NOT NULL DEFAULT '',
  `hits` int(10) NOT NULL DEFAULT 0,
  `rlanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_add`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_reviews_add`;
CREATE TABLE IF NOT EXISTS `nuke_reviews_add` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `title` varchar(150) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `reviewer` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0,
  `url` varchar(100) NOT NULL DEFAULT '',
  `url_title` varchar(50) NOT NULL DEFAULT '',
  `rlanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_comments`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_reviews_comments`;
CREATE TABLE IF NOT EXISTS `nuke_reviews_comments` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL DEFAULT 0,
  `userid` varchar(25) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cid`),
  KEY `rid` (`rid`),
  KEY `userid` (`userid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_main`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_reviews_main`;
CREATE TABLE IF NOT EXISTS `nuke_reviews_main` (
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  KEY `title` (`title`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_security_agents`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_security_agents`;
CREATE TABLE IF NOT EXISTS `nuke_security_agents` (
  `agent_name` varchar(20) NOT NULL DEFAULT '',
  `agent_fullname` varchar(30) DEFAULT '',
  `agent_hostname` varchar(30) DEFAULT '',
  `agent_url` varchar(80) DEFAULT '',
  `agent_ban` int(1) NOT NULL DEFAULT 0,
  `agent_desc` text DEFAULT NULL,
  PRIMARY KEY (`agent_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_session`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 06:45 PM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_session`;
CREATE TABLE IF NOT EXISTS `nuke_session` (
  `uname` varchar(255) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `starttime` varchar(14) NOT NULL DEFAULT '',
  `host_addr` varchar(48) NOT NULL DEFAULT '',
  `guest` int(1) NOT NULL DEFAULT 0,
  `module` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`uname`),
  KEY `time` (`time`),
  KEY `guest` (`guest`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_censor`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_censor`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_censor` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `text` varchar(30) NOT NULL,
  `replacement` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_conf`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_conf`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_conf` (
  `id` int(9) NOT NULL DEFAULT 0,
  `color1` varchar(20) NOT NULL DEFAULT '',
  `color2` varchar(20) NOT NULL DEFAULT '',
  `date` varchar(5) NOT NULL DEFAULT '',
  `time` varchar(5) NOT NULL DEFAULT '',
  `number` varchar(5) NOT NULL DEFAULT '',
  `ipblock` varchar(5) NOT NULL DEFAULT '',
  `nameblock` varchar(5) NOT NULL DEFAULT '',
  `censor` varchar(5) NOT NULL DEFAULT '',
  `tablewidth` char(3) NOT NULL DEFAULT '',
  `urlonoff` varchar(5) NOT NULL DEFAULT '',
  `delyourlastpost` varchar(5) NOT NULL DEFAULT '',
  `anonymouspost` varchar(5) NOT NULL DEFAULT '',
  `height` varchar(5) NOT NULL DEFAULT '',
  `themecolors` varchar(5) NOT NULL DEFAULT '',
  `textWidth` varchar(4) NOT NULL DEFAULT '',
  `nameWidth` varchar(4) NOT NULL DEFAULT '',
  `smiliesPerRow` varchar(4) NOT NULL DEFAULT '',
  `reversePosts` varchar(4) NOT NULL DEFAULT '',
  `timeOffset` varchar(10) NOT NULL DEFAULT '',
  `urlanononoff` varchar(10) NOT NULL DEFAULT '',
  `pointspershout` varchar(5) NOT NULL DEFAULT '',
  `shoutsperpage` varchar(5) NOT NULL DEFAULT '',
  `serverTimezone` varchar(5) NOT NULL DEFAULT '',
  `blockxxx` varchar(5) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_date`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_date`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_date` (
  `id` int(5) NOT NULL DEFAULT 0,
  `date` varchar(10) NOT NULL DEFAULT '',
  `time` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_emoticons`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_emoticons`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_emoticons` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `text` varchar(20) NOT NULL,
  `image` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_ipblock`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_ipblock`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_ipblock` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_manage_count`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 08, 2023 at 03:56 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_manage_count`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_manage_count` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `admin` varchar(25) NOT NULL DEFAULT '',
  `aCount` varchar(5) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_nameblock`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_nameblock`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_nameblock` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_shouts`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 08, 2023 at 02:43 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_shouts`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_shouts` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `ip` varchar(39) DEFAULT NULL,
  `timestamp` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_sticky`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 08, 2023 at 02:43 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_sticky`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_sticky` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  `stickySlot` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_themes`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 14, 2023 at 05:08 AM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_themes`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_themes` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `themeName` varchar(50) DEFAULT NULL,
  `blockColor1` varchar(20) DEFAULT NULL,
  `blockColor2` varchar(20) DEFAULT NULL,
  `border` varchar(20) DEFAULT NULL,
  `menuColor1` varchar(20) DEFAULT NULL,
  `menuColor2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_theme_images`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_theme_images`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_theme_images` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `themeName` varchar(50) DEFAULT NULL,
  `blockArrowColor` varchar(50) NOT NULL,
  `blockBackgroundImage` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_version`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_shoutbox_version`;
CREATE TABLE IF NOT EXISTS `nuke_shoutbox_version` (
  `id` int(5) NOT NULL,
  `version` varchar(10) NOT NULL,
  `datechecked` varchar(2) NOT NULL,
  `versionreported` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_sommaire`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_sommaire`;
CREATE TABLE IF NOT EXISTS `nuke_sommaire` (
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `image` varchar(99) DEFAULT NULL,
  `lien` text DEFAULT NULL,
  `hr` char(2) DEFAULT NULL,
  `center` char(2) DEFAULT NULL,
  `bgcolor` tinytext DEFAULT NULL,
  `invisible` int(1) DEFAULT NULL,
  `class` tinytext DEFAULT NULL,
  `bold` char(2) DEFAULT NULL,
  `new` char(2) DEFAULT NULL,
  `listbox` char(2) DEFAULT NULL,
  `dynamic` char(2) DEFAULT NULL,
  PRIMARY KEY (`groupmenu`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_sommaire_categories`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_sommaire_categories`;
CREATE TABLE IF NOT EXISTS `nuke_sommaire_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `module` varchar(50) NOT NULL DEFAULT '',
  `url` text NOT NULL,
  `url_text` text NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT '',
  `new` char(2) DEFAULT NULL,
  `new_days` tinyint(4) NOT NULL DEFAULT -1,
  `class` varchar(20) DEFAULT NULL,
  `bold` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_stats_hour`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 06:45 PM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_stats_hour`;
CREATE TABLE IF NOT EXISTS `nuke_stats_hour` (
  `year` smallint(6) NOT NULL DEFAULT 0,
  `month` tinyint(4) NOT NULL DEFAULT 0,
  `date` tinyint(4) NOT NULL DEFAULT 0,
  `hour` tinyint(4) NOT NULL DEFAULT 0,
  `hits` int(11) NOT NULL DEFAULT 0
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 08:26 AM
-- Last check: Jan 18, 2023 at 08:47 AM
--

DROP TABLE IF EXISTS `nuke_blogs`;
CREATE TABLE IF NOT EXISTS `nuke_blogs` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT 0,
  `aid` varchar(25) NOT NULL DEFAULT '',
  `title` varchar(80) DEFAULT NULL,
  `datePublished` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NULL DEFAULT current_timestamp(),
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
  `writes` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`sid`),
  KEY `catid` (`catid`),
  KEY `counter` (`counter`),
  KEY `topic` (`topic`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_cat`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 11, 2023 at 12:09 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_blogs_cat`;
CREATE TABLE IF NOT EXISTS `nuke_blogs_cat` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `counter` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`catid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_subscriptions`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_subscriptions`;
CREATE TABLE IF NOT EXISTS `nuke_subscriptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL DEFAULT 0,
  `subscription_expire` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`,`userid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_themes`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 18, 2023 at 08:00 AM
-- Last check: Jan 18, 2023 at 08:47 AM
--

DROP TABLE IF EXISTS `nuke_themes`;
CREATE TABLE IF NOT EXISTS `nuke_themes` (
  `theme_name` varchar(100) NOT NULL DEFAULT '',
  `groups` varchar(50) NOT NULL DEFAULT '',
  `permissions` tinyint(2) NOT NULL DEFAULT 1,
  `custom_name` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `theme_info` text NOT NULL,
  PRIMARY KEY (`theme_name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_topics`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_topics`;
CREATE TABLE IF NOT EXISTS `nuke_topics` (
  `topicid` int(3) NOT NULL AUTO_INCREMENT,
  `topicname` varchar(20) DEFAULT NULL,
  `topicimage` varchar(100) DEFAULT NULL,
  `topictext` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`topicid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 11:40 AM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_users`;
CREATE TABLE IF NOT EXISTS `nuke_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `femail` varchar(255) NOT NULL DEFAULT '',
  `user_website` varchar(255) NOT NULL DEFAULT '',
  `user_avatar` varchar(255) NOT NULL DEFAULT '',
  `user_regdate` varchar(20) NOT NULL DEFAULT '',
  `user_occ` varchar(100) DEFAULT NULL,
  `user_from` varchar(100) DEFAULT NULL,
  `user_from_flag` varchar(64) DEFAULT NULL,
  `user_interests` varchar(150) NOT NULL DEFAULT '',
  `user_sig` text DEFAULT NULL,
  `user_viewemail` tinyint(2) DEFAULT NULL,
  `user_theme` int(3) DEFAULT NULL,
  `user_facebook` varchar(255) DEFAULT NULL,
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `storynum` tinyint(4) NOT NULL DEFAULT 10,
  `umode` varchar(10) NOT NULL DEFAULT '',
  `uorder` tinyint(1) NOT NULL DEFAULT 0,
  `thold` tinyint(1) NOT NULL DEFAULT 0,
  `noscore` tinyint(1) NOT NULL DEFAULT 0,
  `bio` longtext DEFAULT NULL,
  `ublockon` tinyint(1) NOT NULL DEFAULT 0,
  `ublock` tinytext DEFAULT NULL,
  `theme` varchar(255) NOT NULL DEFAULT '',
  `commentmax` int(11) NOT NULL DEFAULT 4096,
  `counter` int(11) NOT NULL DEFAULT 0,
  `newsletter` int(1) NOT NULL DEFAULT 0,
  `user_posts` int(10) NOT NULL DEFAULT 0,
  `user_attachsig` int(2) NOT NULL DEFAULT 1,
  `user_rank` int(10) NOT NULL DEFAULT 0,
  `user_level` int(10) NOT NULL DEFAULT 1,
  `broadcast` tinyint(1) NOT NULL DEFAULT 1,
  `popmeson` tinyint(1) NOT NULL DEFAULT 0,
  `user_active` tinyint(1) DEFAULT 1,
  `user_session_time` int(11) NOT NULL DEFAULT 0,
  `user_session_page` smallint(5) NOT NULL DEFAULT 0,
  `user_lastvisit` int(11) NOT NULL DEFAULT 0,
  `user_timezone` decimal(5,2) NOT NULL DEFAULT 0.00,
  `user_style` tinyint(4) DEFAULT NULL,
  `user_lang` varchar(255) NOT NULL DEFAULT 'english',
  `user_dateformat` varchar(14) NOT NULL DEFAULT 'D M d, Y g:i a',
  `user_new_privmsg` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `user_unread_privmsg` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `user_last_privmsg` int(11) NOT NULL DEFAULT 0,
  `user_emailtime` int(11) DEFAULT NULL,
  `user_allowhtml` tinyint(1) DEFAULT 1,
  `user_allowbbcode` tinyint(1) DEFAULT 1,
  `user_allowsmile` tinyint(1) DEFAULT 1,
  `user_allowavatar` tinyint(1) NOT NULL DEFAULT 1,
  `user_allow_pm` tinyint(1) NOT NULL DEFAULT 1,
  `user_allow_mass_pm` tinyint(1) DEFAULT 4,
  `user_allow_viewonline` tinyint(1) NOT NULL DEFAULT 1,
  `user_notify` tinyint(1) NOT NULL DEFAULT 0,
  `user_notify_pm` tinyint(1) NOT NULL DEFAULT 1,
  `user_popup_pm` tinyint(1) NOT NULL DEFAULT 1,
  `user_avatar_type` tinyint(4) NOT NULL DEFAULT 3,
  `user_sig_bbcode_uid` varchar(10) DEFAULT NULL,
  `user_actkey` varchar(32) DEFAULT NULL,
  `user_newpasswd` varchar(32) DEFAULT NULL,
  `points` int(10) DEFAULT 0,
  `last_ip` varchar(15) NOT NULL DEFAULT '0',
  `user_wordwrap` smallint(3) NOT NULL DEFAULT 70,
  `agreedtos` tinyint(1) NOT NULL DEFAULT 0,
  `user_allowsignature` tinyint(4) NOT NULL DEFAULT 1,
  `user_report_optout` tinyint(1) NOT NULL DEFAULT 0,
  `user_show_quickreply` tinyint(1) NOT NULL DEFAULT 1,
  `user_quickreply_mode` tinyint(1) NOT NULL DEFAULT 1,
  `user_color_gc` varchar(6) DEFAULT '',
  `user_color_gi` text DEFAULT NULL,
  `user_showavatars` tinyint(1) DEFAULT 1,
  `user_showsignatures` tinyint(1) DEFAULT 1,
  `user_time_mode` tinyint(4) NOT NULL DEFAULT 6,
  `user_dst_time_lag` tinyint(4) NOT NULL DEFAULT 60,
  `user_pc_timeOffsets` varchar(55) NOT NULL DEFAULT '0',
  `user_view_log` tinyint(4) NOT NULL DEFAULT 0,
  `user_glance_show` varchar(255) NOT NULL DEFAULT '1',
  `user_hide_images` tinyint(2) NOT NULL DEFAULT 0,
  `user_open_quickreply` tinyint(1) NOT NULL DEFAULT 1,
  `sceditor_in_source` tinyint(1) NOT NULL DEFAULT 0,
  `xdata_bbcode` varchar(10) DEFAULT NULL,
  `user_ftr` smallint(1) NOT NULL DEFAULT 0,
  `user_ftr_time` int(10) NOT NULL DEFAULT 0,
  `user_rank2` int(11) DEFAULT -1,
  `user_rank3` int(11) DEFAULT -2,
  `user_rank4` int(11) DEFAULT -2,
  `user_rank5` int(11) DEFAULT -2,
  `user_gender` tinyint(4) NOT NULL DEFAULT 0,
  `user_birthday` int(8) NOT NULL DEFAULT 0,
  `user_birthday2` int(8) DEFAULT NULL,
  `birthday_display` tinyint(1) NOT NULL DEFAULT 0,
  `birthday_greeting` tinyint(1) NOT NULL DEFAULT 0,
  `user_next_birthday` smallint(4) NOT NULL DEFAULT 0,
  `user_reputation` float NOT NULL DEFAULT 0,
  `user_rep_last_time` int(11) DEFAULT NULL,
  `user_admin_notes` text DEFAULT NULL,
  `user_allow_arcadepm` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`),
  KEY `uname` (`username`),
  KEY `user_session_time` (`user_session_time`),
  KEY `user_birthday` (`user_birthday`),
  KEY `user_birthday2` (`user_birthday2`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_countries`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_users_countries`;
CREATE TABLE IF NOT EXISTS `nuke_users_countries` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `iso_code_2` char(2) NOT NULL DEFAULT '',
  `iso_code_3` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_country`),
  KEY `IDX_NAME` (`name`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_temp`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_users_temp`;
CREATE TABLE IF NOT EXISTS `nuke_users_temp` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `user_regdate` varchar(20) NOT NULL DEFAULT '',
  `check_num` varchar(50) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `realname` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_who_been`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 19, 2023 at 11:43 AM
-- Last check: Jan 19, 2023 at 10:52 AM
--

DROP TABLE IF EXISTS `nuke_users_who_been`;
CREATE TABLE IF NOT EXISTS `nuke_users_who_been` (
  `user_ID` int(11) NOT NULL DEFAULT 0,
  `username` varchar(25) NOT NULL DEFAULT '',
  `last_visit` int(15) DEFAULT NULL,
  `resolution` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_ID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_welcome_pm`
--
-- Creation: Jan 03, 2023 at 11:35 PM
-- Last update: Jan 03, 2023 at 11:35 PM
-- Last check: Jan 17, 2023 at 12:16 PM
--

DROP TABLE IF EXISTS `nuke_welcome_pm`;
CREATE TABLE IF NOT EXISTS `nuke_welcome_pm` (
  `subject` varchar(30) NOT NULL DEFAULT '',
  `msg` text NOT NULL,
  PRIMARY KEY (`subject`)
) ;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
