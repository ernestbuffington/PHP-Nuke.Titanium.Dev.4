-- phpMyAdmin SQL Dump 
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2023 at 11:13 AM
-- Server version: 10.3.37-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-05:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_admin_fc`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_admin_fc` (
  `fc_datetime` varchar(25) NOT NULL DEFAULT '',
  `fc_ip` varchar(255) NOT NULL DEFAULT '',
  `fc_attempts` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_authors`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_authors` (
  `aid` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `pwd` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT 0,
  `radminsuper` tinyint(1) NOT NULL DEFAULT 1,
  `admlanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_banner` (
  `bid` int(11) NOT NULL,
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
  `type` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_banner`
--

INSERT DELAYED INTO `nuke_banner` (`bid`, `cid`, `name`, `imptotal`, `impmade`, `clicks`, `imageurl`, `clickurl`, `alttext`, `date`, `dateend`, `position`, `active`, `ad_class`, `ad_code`, `ad_width`, `ad_height`, `type`) VALUES
(4, 1, '86it', 0, 517699, 614, 'https://php-nuke-titanium.86it.us/images/banners/10.png', 'index.php', 'PHP-Nuke Titanium Dev 4', '2019-09-17 17:36:30', '0000-00-00 00:00:00', 0, 1, 'image', '', 472, 79, ''),
(5, 1, 'Xtreme', 0, 4532, 54, 'https://dev-php-nuke-evolution-xtreme.86it.us/themes/Xtreme_Core/images/HEADER/banner_02.png', 'index.php', 'PHP-Nuke Evolution Xtreme', '2021-05-28 02:54:43', '0000-00-00 00:00:00', 0, 0, 'image', '', 484, 79, '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_clients`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_banner_clients` (
  `cid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `contact` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `login` varchar(10) NOT NULL DEFAULT '',
  `passwd` varchar(10) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_banner_clients`
--

INSERT DELAYED INTO `nuke_banner_clients` (`cid`, `name`, `contact`, `email`, `login`, `passwd`, `extrainfo`) VALUES
(1, 'TheGhost', 'Ernest Buffington', 'ernest.buffington@gmail.com', 'TheGhost', '28up4meoru', '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_plans`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_banner_plans` (
  `pid` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `delivery` varchar(10) NOT NULL DEFAULT '',
  `delivery_type` varchar(25) NOT NULL DEFAULT '',
  `price` varchar(25) NOT NULL DEFAULT '0',
  `buy_links` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_positions`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_banner_positions` (
  `apid` int(10) NOT NULL,
  `position_number` int(5) NOT NULL DEFAULT 0,
  `position_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_banner_positions`
--

INSERT DELAYED INTO `nuke_banner_positions` (`apid`, `position_number`, `position_name`) VALUES
(1, 0, 'Page Top'),
(2, 1, 'Left Block'),
(3, 2, 'Page Bottom');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_banner_terms`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_banner_terms` (
  `terms_body` text NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_banner_terms`
--

INSERT DELAYED INTO `nuke_banner_terms` (`terms_body`, `country`) VALUES
('<div align=\"justify\"><strong>Introduction:</strong> This Agreement between you and&nbsp;[sitename] consists of these Terms and Conditions. &quot;You&quot; or &quot;Advertiser&quot; means the entity identified in this enrollment form, and/or any agency acting on its behalf, which shall also be bound by the terms of this Agreement. Please read very carefully these Terms and Conditions.<br /><strong><br />Uses:</strong> You agree that your ads may be placed on (i) [sitename] web site and (ii) Any ads may be modified without your consent to comply with any policy of [sitename]. [sitename] reserves the right to, and in its sole discretion may, at any time review, reject, modify, or remove any ad. No liability of [sitename] and/or its owner(s) shall result from any such decision.<br /><br /></div><div align=\"justify\"><strong>Parties\' Responsibilities:</strong> You are responsible of your own site and/or service advertised in [sitename] web site. You are solely responsible for the advertising image creation, advertising text and for the content of your ads, including URL links. [sitename] is not responsible for anything regarding your Web site(s) including, but not limited to, maintenance of your Web site(s), order entry, customer service, payment processing, shipping, cancellations or returns.<br /><br /></div><div align=\"justify\"><strong>Impressions Count:</strong> Any hit to [sitename] web site is counted as an impression. Due to our advertising price we don\'t discriminate from users or automated robots. Even if you access to [sitename] web site and see your own banner ad it will be counted as a valid impression. Only in the case of [sitename] web site administrator, the impressions will not be counted.<br /><br /></div><div align=\"justify\"><strong>Termination, Cancellation:</strong> [sitename] may at any time, in its sole discretion, terminate the Campaign, terminate this Agreement, or cancel any ad(s) or your use of any Target. [sitename] will notify you via email of any such termination or cancellation, which shall be effective immediately. No refund will be made for any reason. Remaining impressions will be stored in a database and you\'ll be able to request another campaign to complete your inventory. You may cancel any ad and/or terminate this Agreement with or without cause at any time. Termination of your account shall be effective when [sitename] receives your notice via email. No refund will be made for any reason. Remaining impressions will be stored in a database for future uses by you and/or your company.<br /><br /></div><div align=\"justify\"><strong>Content:</strong> [sitename] web site doesn\'t accepts advertising that contains: (i) pornography, (ii) explicit adult content, (iii) moral questionable content, (iv) illegal content of any kind, (v) illegal drugs promotion, (vi) racism, (vii) politics content, (viii) religious content, and/or (ix) fraudulent suspicious content. If your advertising and/or target web site has any of this content and you purchased an advertising package, you\'ll not receive refund of any kind but your banners ads impressions will be stored for future use.<br /><br /></div><div align=\"justify\"><strong>Confidentiality:</strong> Each party agrees not to disclose Confidential Information of the other party without prior written consent except as provided herein. &quot;Confidential Information&quot; includes (i) ads, prior to publication, (ii) submissions or modifications relating to any advertising campaign, (iii) clickthrough rates or other statistics (except in an aggregated form that includes no identifiable information about you), and (iv) any other information designated in writing as &quot;Confidential.&quot; It does not include information that has become publicly known through no breach by a party, or has been (i) independently developed without access to the other party\'s Confidential Information; (ii) rightfully received from a third party; or (iii) required to be disclosed by law or by a governmental authority.<br /><br /></div><div align=\"justify\"><strong>No Guarantee:</strong> [sitename] makes no guarantee regarding the levels of clicks for any ad on its site. [sitename] may offer the same Target to more than one advertiser. You may not receive exclusivity unless special private contract between [sitename] and you.<br /><br /></div><div align=\"justify\"><strong>No Warranty:</strong> [sitename] MAKES NO WARRANTY, EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION WITH RESPECT TO ADVERTISING AND OTHER SERVICES, AND EXPRESSLY DISCLAIMS THE WARRANTIES OR CONDITIONS OF NONINFRINGEMENT, MERCHANTABILITY AND FITNESS FOR ANY PARTICULAR PURPOSE.<br /><br /></div><div align=\"justify\"><strong>Limitations of Liability:</strong> In no event shall [sitename] be liable for any act or omission, or any event directly or indirectly resulting from any act or omission of Advertiser, Partner, or any third parties (if any). EXCEPT FOR THE PARTIES\' INDEMNIFICATION AND CONFIDENTIALITY OBLIGATIONS HEREUNDER, (i) IN NO EVENT SHALL EITHER PARTY BE LIABLE UNDER THIS AGREEMENT FOR ANY CONSEQUENTIAL, SPECIAL, INDIRECT, EXEMPLARY, PUNITIVE, OR OTHER DAMAGES WHETHER IN CONTRACT, TORT OR ANY OTHER LEGAL THEORY, EVEN IF SUCH PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES AND NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY AND (ii) [sitename] AGGREGATE LIABILITY TO ADVERTISER UNDER THIS AGREEMENT FOR ANY CLAIM IS LIMITED TO THE AMOUNT PAID TO [sitename] BY ADVERTISER FOR THE AD GIVING RISE TO THE CLAIM. Each party acknowledges that the other party has entered into this Agreement relying on the limitations of liability stated herein and that those limitations are an essential basis of the bargain between the parties. Without limiting the foregoing and except for payment obligations, neither party shall have any liability for any failure or delay resulting from any condition beyond the reasonable control of such party, including but not limited to governmental action or acts of terrorism, earthquake or other acts of God, labor conditions, and power failures.<br /><br /></div><div align=\"justify\"><strong>Payment:</strong> You agree to pay in advance the cost of the advertising. [sitename] will not setup any banner ads campaign(s) unless the payment process is complete. [sitename] may change its pricing at any time without prior notice. If you have an advertising campaign running and/or impressions stored for future use for any mentioned cause and [sitename] changes its pricing, you\'ll not need to pay any difference. Your purchased banners fee will remain the same. Charges shall be calculated solely based on records maintained by [sitename]. No other measurements or statistics of any kind shall be accepted by [sitename] or have any effect under this Agreement.<br /><br /></div><div align=\"justify\"><strong>Representations and Warranties:</strong> You represent and warrant that (a) all of the information provided by you to [sitename] to enroll in the Advertising Campaign is correct and current; (b) you hold all rights to permit [sitename] and any Partner(s) to use, reproduce, display, transmit and distribute your ad(s); and (c) [sitename] and any Partner(s) Use, your Target(s), and any site(s) linked to, and products or services to which users are directed, will not, in any state or country where the ad is displayed (i) violate any criminal laws or third party rights giving rise to civil liability, including but not limited to trademark rights or rights relating to the performance of music; or (ii) encourage conduct that would violate any criminal or civil law. You further represent and warrant that any Web site linked to your ad(s) (i) complies with all laws and regulations in any state or country where the ad is displayed; (ii) does not breach and has not breached any duty toward or rights of any person or entity including, without limitation, rights of publicity or privacy, or rights or duties under consumer protection, product liability, tort, or contract theories; and (iii) is not false, misleading, defamatory, libelous, slanderous or threatening.<br /><br /></div><div align=\"justify\"><strong>Your Obligation to Indemnify:</strong> You agree to indemnify, defend and hold [sitename], its agents, affiliates, subsidiaries, directors, officers, employees, and applicable third parties (e.g., all relevant Partner(s), licensors, licensees, consultants and contractors) (&quot;Indemnified Person(s)&quot;) harmless from and against any and all third party claims, liability, loss, and expense (including damage awards, settlement amounts, and reasonable legal fees), brought against any Indemnified Person(s), arising out of, related to or which may arise from your use of the Advertising Program, your Web site, and/or your breach of any term of this Agreement. Customer understands and agrees that each Partner, as defined herein, has the right to assert and enforce its rights under this Section directly on its own behalf as a third party beneficiary.<br /><br /></div><div align=\"justify\"><strong>Information Rights:</strong> [sitename] may retain and use for its own purposes all information you provide, including but not limited to Targets, URLs, the content of ads, and contact and billing information. [sitename] may share this information about you with business partners and/or sponsors. [sitename] will not sell your information. Your name, web site\'s URL and related graphics shall be used by [sitename] in its own web site at any time as a sample to the public, even if your Advertising Campaign has been finished.<br /><br /></div><div align=\"justify\"><strong>Miscellaneous:</strong> Any decision made by [sitename] under this Agreement shall be final. [sitename] shall have no liability for any such decision. You will be responsible for all reasonable expenses (including attorneys\' fees) incurred by [sitename] in collecting unpaid amounts under this Agreement. This Agreement shall be governed by the laws of [country]. Any dispute or claim arising out of or in connection with this Agreement shall be adjudicated in [country]. This constitutes the entire agreement between the parties with respect to the subject matter hereof. Advertiser may not resell, assign, or transfer any of its rights hereunder. Any such attempt may result in termination of this Agreement, without liability to [sitename] and without any refund. The relationship(s) between [sitename] and the &quot;Partners&quot; is not one of a legal partnership relationship, but is one of independent contractors. This Agreement shall be construed as if both parties jointly wrote it.</div>', 'Canada');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbadvanced_username_color`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbadvanced_username_color` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL DEFAULT '',
  `group_color` varchar(6) NOT NULL DEFAULT '',
  `group_weight` smallint(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbadvanced_username_color`
--

INSERT DELAYED INTO `nuke_bbadvanced_username_color` (`group_id`, `group_name`, `group_color`, `group_weight`) VALUES
(1, 'Portal Admins', 'ff632a', 1),
(2, 'Portal Moderators', 'd38d01', 2),
(3, 'VIP Members', '00aa00', 3),
(4, 'Portal Members', '00b3ff', 4),
(5, 'CKEditor 4 Access', 'bf0000', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade`
--
-- Creation: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbarcade` (
  `arcade_name` varchar(255) NOT NULL DEFAULT '',
  `arcade_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbarcade`
--

INSERT DELAYED INTO `nuke_bbarcade` (`arcade_name`, `arcade_value`) VALUES
('arcade_announcement', 'Welcome to the Arcade!Enjoy!'),
('category_preview_games', '5'),
('days_limit', '0'),
('display_winner_avatar', '1'),
('games_par_page', '15'),
('game_order', 'Alpha'),
('limit_by_posts', '0'),
('limit_type', 'date'),
('linkcat_align', '1'),
('maxsize_avatar', '200'),
('posts_needed', '0'),
('stat_par_page', '10000'),
('use_category_mod', '1'),
('use_fav_category', '1'),
('winner_avatar_position', 'left');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_categories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbarcade_categories` (
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL,
  `arcade_cattitle` varchar(100) NOT NULL DEFAULT '',
  `arcade_nbelmt` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `arcade_catorder` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `arcade_catauth` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbarcade_categories`
--

INSERT DELAYED INTO `nuke_bbarcade_categories` (`arcade_catid`, `arcade_cattitle`, `arcade_nbelmt`, `arcade_catorder`, `arcade_catauth`) VALUES
(1, 'Old School', 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_comments`
--
-- Creation: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbarcade_comments` (
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `comments_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbarcade_comments`
--

INSERT DELAYED INTO `nuke_bbarcade_comments` (`game_id`, `comments_value`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbarcade_fav`
--
-- Creation: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbarcade_fav` (
  `order` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `game_id` mediumint(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbarcade_fav`
--

INSERT DELAYED INTO `nuke_bbarcade_fav` (`order`, `user_id`, `game_id`) VALUES
(0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattachments`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbattachments` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `user_id_1` mediumint(8) NOT NULL DEFAULT 0,
  `user_id_2` mediumint(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbattachments`
--

INSERT DELAYED INTO `nuke_bbattachments` (`attach_id`, `post_id`, `privmsgs_id`, `user_id_1`, `user_id_2`) VALUES
(10, 0, 37, 3, 2),
(11, 0, 73, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattachments_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbattachments_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbattachments_config`
--

INSERT DELAYED INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES
('upload_dir', 'modules/Forums/files'),
('upload_img', 'modules/Forums/images/attachment-download.png'),
('topic_icon', 'modules/Forums/images/attachment.png'),
('display_order', '0'),
('max_filesize', '104857600'),
('attachment_quota', '1048576000'),
('max_filesize_pm', '1024000'),
('max_attachments', '10'),
('max_attachments_pm', '10'),
('disable_mod', '0'),
('allow_pm_attach', '1'),
('attachment_topic_review', '1'),
('allow_ftp_upload', '0'),
('show_apcp', '0'),
('attach_version', '2.4.5'),
('default_upload_quota', '0'),
('default_pm_quota', '0'),
('ftp_server', 'ftp.yoursite.com'),
('ftp_path', '/public_html/modules/Forums/files'),
('download_path', 'http://www.yoursite.com/modules/Forums/files'),
('ftp_user', ''),
('ftp_pass', ''),
('ftp_pasv_mode', '1'),
('img_display_inlined', '1'),
('img_max_width', '0'),
('img_max_height', '0'),
('img_link_width', '0'),
('img_link_height', '0'),
('img_create_thumbnail', '1'),
('img_min_thumb_filesize', '12000'),
('img_imagick', '/usr/bin/convert'),
('use_gd2', '0'),
('wma_autoplay', '0'),
('flash_autoplay', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattachments_desc`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbattachments_desc` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL,
  `physical_filename` varchar(255) NOT NULL DEFAULT '',
  `real_filename` varchar(255) NOT NULL DEFAULT '',
  `download_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `comment` varchar(255) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `mimetype` varchar(100) DEFAULT NULL,
  `filesize` int(20) NOT NULL DEFAULT 0,
  `filetime` int(11) NOT NULL DEFAULT 0,
  `thumbnail` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbattachments_desc`
--

INSERT DELAYED INTO `nuke_bbattachments_desc` (`attach_id`, `physical_filename`, `real_filename`, `download_count`, `comment`, `extension`, `mimetype`, `filesize`, `filetime`, `thumbnail`) VALUES
(10, '388581_199236466831302_412065705_n_117.jpg', '388581_199236466831302_412065705_n.jpg', 1, '', 'jpg', 'image/jpeg', 145799, 1673117891, 0),
(11, 'fuckyou_117.png', 'fuckyou.png', 1, '', 'png', 'image/png', 16269, 1673134561, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbattach_quota`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbattach_quota` (
  `user_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `quota_type` smallint(2) NOT NULL DEFAULT 0,
  `quota_limit_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbauth_access`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbauth_access` (
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
  `auth_download` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbauth_arcade_access`
--
-- Creation: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbauth_arcade_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbbanlist`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbbanlist` (
  `ban_id` mediumint(8) UNSIGNED NOT NULL,
  `ban_userid` mediumint(8) NOT NULL DEFAULT 0,
  `ban_ip` varchar(8) NOT NULL DEFAULT '',
  `ban_email` varchar(255) DEFAULT NULL,
  `ban_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbcategories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbcategories` (
  `cat_id` mediumint(8) UNSIGNED NOT NULL,
  `cat_title` varchar(100) DEFAULT NULL,
  `cat_order` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbcategories`
--

INSERT DELAYED INTO `nuke_bbcategories` (`cat_id`, `cat_title`, `cat_order`) VALUES
(5, 'General', 10);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbconfig`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbconfig` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbconfig`
--

INSERT DELAYED INTO `nuke_bbconfig` (`config_name`, `config_value`) VALUES
('config_id', '1'),
('board_disable', '0'),
('board_disable_adminview', '1'),
('board_disable_msg', 'The board is currently disabled...'),
('sitename', 'PHP-Nuke Titanium - Coders Exchange'),
('site_desc', 'www.yoursite.com'),
('cookie_name', 'savant'),
('cookie_path', '/'),
('cookie_domain', 'yoursite.com'),
('cookie_secure', '0'),
('session_length', '3600'),
('allow_html', '1'),
('allow_html_tags', 'a,abbr,address,area,article,aside,audio,b,base,bdi,bdo,blockquote,br,button,canvas,caption,cite,code,col,colgroup,data,datalist,dd,del,em,strong,embed,fieldset,figure,footer,form,h1,h2,h3,h4,h5,h6,hgroup,hr,i,iframe,img,input,ins,kbd,keygen,label,legend,l'),
('allow_bbcode', '1'),
('allow_smilies', '1'),
('allow_sig', '1'),
('allow_namechange', '1'),
('allow_theme_create', '0'),
('allow_avatar_local', '1'),
('allow_avatar_remote', '1'),
('allow_avatar_upload', '1'),
('override_user_style', '1'),
('posts_per_page', '15'),
('topics_per_page', '50'),
('hot_threshold', '25'),
('max_poll_options', '10'),
('max_sig_chars', '255'),
('max_smilies', '15'),
('max_inbox_privmsgs', '1000'),
('max_sentbox_privmsgs', '1000'),
('max_savebox_privmsgs', '1000'),
('board_email_sig', 'Thanks, admin@yoursite.com'),
('board_email', 'admin@yoursite.com'),
('smtp_delivery', '0'),
('smtp_host', ''),
('require_activation', '0'),
('flood_interval', '15'),
('search_flood_interval', '15'),
('board_email_form', '0'),
('avatar_filesize', '980000'),
('avatar_max_width', '200'),
('avatar_max_height', '200'),
('avatar_path', 'modules/Forums/images/avatars'),
('avatar_gallery_path', 'modules/Forums/images/avatars'),
('smilies_path', 'modules/Forums/images/smiles'),
('default_style', '1'),
('default_dateformat', 'D M d, Y g:i a'),
('board_timezone', '-5'),
('prune_enable', '0'),
('privmsg_disable', '0'),
('gzip_compress', '0'),
('coppa_fax', ''),
('coppa_mail', ''),
('board_startdate', '1131089812'),
('default_lang', 'english'),
('smtp_username', 'TheGhost'),
('smtp_password', 'xwdNPADv86bm'),
('record_online_users', '4'),
('record_online_date', '1673190781'),
('server_name', 'www.yoursite.com'),
('server_port', '80'),
('script_path', '/modules/Forums/'),
('version', '.0.23'),
('enable_confirm', '0'),
('sendmail_fix', '0'),
('sig_max_lines', '5'),
('sig_wordwrap', '100'),
('sig_allow_font_sizes', '1'),
('sig_min_font_size', '7'),
('sig_max_font_size', '12'),
('sig_allow_bold', '1'),
('sig_allow_italic', '1'),
('sig_allow_underline', '1'),
('sig_allow_colors', '1'),
('sig_allow_quote', '0'),
('sig_allow_code', '0'),
('sig_allow_list', '0'),
('sig_allow_url', '1'),
('sig_allow_images', '1'),
('sig_max_images', '0'),
('sig_max_img_height', '75'),
('sig_max_img_width', '500'),
('sig_allow_on_max_img_size_fail', '0'),
('sig_max_img_files_size', '10'),
('sig_max_img_av_files_size', '0'),
('sig_exotic_bbcodes_disallowed', ''),
('sig_allow_smilies', '1'),
('report_email', '1'),
('ropm_quick_reply', '1'),
('ropm_quick_reply_bbc', '1'),
('ropm_quick_reply_smilies', '22'),
('wrap_enable', '1'),
('wrap_min', '50'),
('wrap_max', '99'),
('wrap_def', '70'),
('allow_quickreply', '1'),
('anonymous_show_sqr', '0'),
('anonymous_sqr_mode', '1'),
('quick_search_enable', '1'),
('sig_line', ''),
('default_avatar_guests_url', 'modules/Forums/images/avatars/blank.png'),
('default_avatar_users_url', 'modules/Forums/images/avatars/blank.png'),
('default_avatar_set', '2'),
('pm_allow_threshold', '0'),
('welcome_pm', '0'),
('default_time_mode', '0'),
('default_dst_time_lag', '60'),
('glance_show', '1'),
('glance_show_override', '1'),
('glance_news_id', '0'),
('glance_num_news', '0'),
('glance_num', '6'),
('glance_ignore_forums', '0'),
('glance_table_width', '100%'),
('glance_auth_read', '1'),
('glance_topic_length', '0'),
('online_time', '600'),
('display_users_today', '0'),
('locked_view_open', 'Locked:'),
('locked_view_close', ''),
('global_view_open', 'Global Announcement:'),
('global_view_close', ''),
('announce_view_open', 'Announcement:'),
('announce_view_close', ''),
('sticky_view_open', 'Sticky:'),
('sticky_view_close', ''),
('moved_view_open', 'Moved:'),
('moved_view_close', ''),
('initial_group_id', '0'),
('hide_links', '0'),
('hide_emails', '0'),
('hide_images', '0'),
('use_dhtml', '1'),
('anonymous_open_sqr', '0'),
('smilies_in_titles', '1'),
('show_edited_logs', '1'),
('show_locked_logs', '1'),
('show_unlocked_logs', '1'),
('show_splitted_logs', '1'),
('show_moved_logs', '1'),
('logs_view_level', '2'),
('aprvmArchive', '0'),
('aprvmVersion', '1.6.0'),
('aprvmView', '0'),
('aprvmRows', '25'),
('aprvmIP', '1'),
('image_resize_width', '640'),
('image_resize_height', '480'),
('use_theme_style', '1'),
('allow_autologin', '1'),
('max_autologin_time', '0'),
('max_login_attempts', '5'),
('login_reset_time', '30'),
('show_sig_once', '0'),
('show_avatar_once', '0'),
('show_rank_once', '0'),
('loginpage', '1'),
('rand_seed', '504ab0fa2b8d3990c1a1ab15dd8dd7be'),
('ftr_msg', 'Sorry *u*, you need to read our topic: \"*t*\" for new users. <br> After you read it, you can proceed to browse our posts normally. <br><br> Please click *l* to view the post.'),
('ftr_topic', '3'),
('ftr_active', '0'),
('ftr_who', '2'),
('ftr_installed', '1241642769'),
('global_title', 'www.yoursite.com'),
('global_announcement', 'PHP-Nuke Titanium brings you a 23 year old CMS revived!'),
('global_enable', '1'),
('marquee_disable', '1'),
('version_check_delay', '1241641548'),
('bday_show', '1'),
('bday_require', '0'),
('bday_year', '0'),
('bday_lock', '0'),
('bday_lookahead', '30'),
('bday_max', '150'),
('bday_min', '18'),
('bday_hide', '0'),
('bday_greeting', '3'),
('icon_per_row', '23'),
('ad_after_post', ''),
('ad_post_threshold', '1'),
('ad_every_post', '2'),
('ad_who', '1'),
('ad_no_forums', ''),
('ad_no_groups', ''),
('ad_old_style', '0'),
('xs_auto_compile', '1'),
('xs_auto_recompile', '1'),
('xs_use_cache', '1'),
('xs_php', 'php'),
('xs_def_template', 'subSilver'),
('xs_check_switches', '1'),
('xs_warn_includes', '1'),
('xs_add_comments', '0'),
('xs_ftp_host', ''),
('xs_ftp_login', ''),
('xs_ftp_path', ''),
('xs_downloads_count', '0'),
('xs_downloads_default', '0'),
('xs_shownav', '1'),
('xs_template_time', '1532797163'),
('xs_version', '8'),
('last_post_avatar', '1'),
('youtube_width', '640'),
('youtube_height', '360'),
('twitch_width', '640'),
('twitch_height', '360'),
('facebook_width', '640'),
('facebook_height', '360'),
('welcome_pm_username', '0'),
('glance_rowclass', '1'),
('smtp_encryption', 'none'),
('smtp_port', ''),
('smtp_auth', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbdisallow`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbdisallow` (
  `disallow_id` mediumint(8) UNSIGNED NOT NULL,
  `disallow_username` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbextensions`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbextensions` (
  `ext_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `extension` varchar(100) NOT NULL DEFAULT '',
  `comment` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbextensions`
--

INSERT DELAYED INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES
(1, 2, 'gif', ''),
(2, 2, 'png', ''),
(3, 2, 'jpeg', ''),
(4, 2, 'jpg', ''),
(5, 2, 'tif', ''),
(6, 2, 'tga', ''),
(7, 2, 'gtar', ''),
(8, 2, 'gz', ''),
(9, 2, 'tar', ''),
(10, 2, 'zip', ''),
(11, 2, 'rar', ''),
(12, 2, 'ace', ''),
(13, 2, 'txt', ''),
(14, 2, 'c', ''),
(15, 2, 'h', ''),
(16, 2, 'cpp', ''),
(17, 2, 'hpp', ''),
(18, 2, 'diz', ''),
(19, 2, 'xls', ''),
(20, 2, 'doc', ''),
(21, 2, 'dot', ''),
(22, 2, 'pdf', ''),
(23, 2, 'ai', ''),
(24, 2, 'ps', ''),
(25, 2, 'ppt', ''),
(26, 2, 'rm', ''),
(27, 2, 'wma', ''),
(28, 2, 'swf', ''),
(29, 2, 'iso', '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbextension_groups`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbextension_groups` (
  `group_id` mediumint(8) NOT NULL,
  `group_name` varchar(20) NOT NULL DEFAULT '',
  `cat_id` tinyint(2) NOT NULL DEFAULT 0,
  `allow_group` tinyint(1) NOT NULL DEFAULT 0,
  `download_mode` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `upload_icon` varchar(100) DEFAULT '',
  `max_filesize` int(20) NOT NULL DEFAULT 0,
  `forum_permissions` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbextension_groups`
--

INSERT DELAYED INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES
(1, 'Images', 1, 1, 2, '', 104857600, ''),
(2, 'Archives', 0, 1, 2, '', 104857600, ''),
(3, 'Plain Text', 0, 0, 2, '', 104857600, ''),
(4, 'Documents', 0, 0, 2, '', 104857600, ''),
(5, 'Real Media', 0, 0, 2, '', 104857600, ''),
(6, 'Streams', 2, 0, 2, '', 104857600, ''),
(7, 'Flash Files', 3, 0, 2, '', 104857600, '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbflags`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbflags` (
  `flag_id` int(10) NOT NULL,
  `flag_name` varchar(50) DEFAULT NULL,
  `flag_image` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbflags`
--

INSERT DELAYED INTO `nuke_bbflags` (`flag_id`, `flag_name`, `flag_image`) VALUES
(1, 'usa', 'usa.png'),
(2, 'afghanistan', 'afghanistan.png'),
(3, 'albania', 'albania.png'),
(4, 'algeria', 'algeria.png'),
(5, 'andorra', 'andorra.png'),
(6, 'antigua and barbuda', 'antigua_and_barbuda.png'),
(7, 'argentina', 'argentina.png'),
(8, 'armenia', 'armenia.png'),
(9, 'australia', 'australia.png'),
(10, 'austria', 'austria.png'),
(11, 'azerbaijan', 'azerbaijan.png'),
(12, 'bahamas', 'bahamas.png'),
(13, 'bahrain', 'bahrain.png'),
(14, 'bangladesh', 'bangladesh.png'),
(15, 'barbados', 'barbados.png'),
(16, 'belarus', 'belarus.png'),
(17, 'belgium', 'belgium.png'),
(18, 'belize', 'belize.png'),
(19, 'benin', 'benin.png'),
(20, 'bhutan', 'bhutan.png'),
(21, 'bolivia', 'bolivia.png'),
(22, 'bosnia and herzegovina', 'bosnia_and_herzegovina.png'),
(23, 'botswana', 'botswana.png'),
(24, 'brazil', 'brazil.png'),
(25, 'brunei', 'brunei.png'),
(26, 'bulgaria', 'bulgaria.png'),
(27, 'burkina faso', 'burkina_faso.png'),
(28, 'myanmar', 'myanmar.png'),
(29, 'burundi', 'burundi.png'),
(30, 'cambodia', 'cambodia.png'),
(31, 'cameroon', 'cameroon.png'),
(32, 'canada', 'canada.png'),
(33, 'chad', 'chad.png'),
(34, 'chile', 'chile.png'),
(35, 'china', 'china.png'),
(36, 'columbia', 'columbia.png'),
(37, 'comoros', 'comoros.png'),
(38, 'democratic republic of the congo', 'democratic_republic_of_the_congo.png'),
(39, 'croatia', 'croatia.png'),
(40, 'cuba', 'cuba.png'),
(41, 'cyprus', 'cyprus.png'),
(42, 'denmark', 'denmark.png'),
(43, 'djibouti', 'djibouti.png'),
(44, 'dominica', 'dominica.png'),
(45, 'dominican republic', 'dominican_republic.png'),
(46, 'ecuador', 'ecuador.png'),
(47, 'egypt', 'egypt.png'),
(48, 'el salvador', 'el_salvador.png'),
(49, 'england', 'england.png'),
(50, 'equatorial guinea', 'equatorial_guinea.png'),
(51, 'eritrea', 'eritrea.png'),
(52, 'estonia', 'estonia.png'),
(53, 'ethiopia', 'ethiopia.png'),
(54, 'fiji', 'fiji.png'),
(55, 'finland', 'finland.png'),
(56, 'france', 'france.png'),
(57, 'gabon', 'gabon.png'),
(58, 'gambia', 'gambia.png'),
(59, 'georgia', 'georgia.png'),
(60, 'germany', 'germany.png'),
(61, 'ghana', 'ghana.png'),
(62, 'greece', 'greece.png'),
(63, 'grenada', 'grenada.png'),
(64, 'saint vincent and the grenadines', 'saint_vincent_and_the_grenadines.png'),
(65, 'guatemala', 'guatemala.png'),
(66, 'guinea', 'guinea.png'),
(67, 'guyana', 'guyana.png'),
(68, 'haiti', 'haiti.png'),
(69, 'honduras', 'honduras.png'),
(70, 'hong kong', 'hong_kong.png'),
(71, 'hungary', 'hungary.png'),
(72, 'iceland', 'iceland.png'),
(73, 'india', 'india.png'),
(74, 'indonesia', 'indonesia.png'),
(75, 'iran', 'iran.png'),
(76, 'iraq', 'iraq.png'),
(77, 'ireland', 'ireland.png'),
(78, 'israel', 'israel.png'),
(79, 'italy', 'italy.png'),
(80, 'jamaica', 'jamaica.png'),
(81, 'japan', 'japan.png'),
(82, 'jordan', 'jordan.png'),
(83, 'kazakhstan', 'kazakhstan.png'),
(84, 'kenya', 'kenya.png'),
(85, 'kiribati', 'kiribati.png'),
(86, 'kuwait', 'kuwait.png'),
(87, 'kyrgyzstan', 'kyrgyzstan.png'),
(88, 'laos', 'laos.png'),
(89, 'latvia', 'latvia.png'),
(90, 'lebanon', 'lebanon.png'),
(91, 'liberia', 'liberia.png'),
(92, 'libya', 'libya.png'),
(93, 'liechtenstein', 'liechtenstein.png'),
(94, 'lithuania', 'lithuania.png'),
(95, 'luxembourg', 'luxembourg.png'),
(96, 'macau', 'macau.png'),
(97, 'madagascar', 'madagascar.png'),
(98, 'malawi', 'malawi.png'),
(99, 'malaysia', 'malaysia.png'),
(100, 'maldives', 'maldives.png'),
(101, 'mali', 'mali.png'),
(102, 'malta', 'malta.png'),
(103, 'mauritania', 'mauritania.png'),
(104, 'mauritius', 'mauritius.png'),
(105, 'mexico', 'mexico.png'),
(106, 'micronesia', 'micronesia.png'),
(107, 'moldova', 'moldova.png'),
(108, 'monaco', 'monaco.png'),
(109, 'mongolia', 'mongolia.png'),
(110, 'morocco', 'morocco.png'),
(111, 'mozambique', 'mozambique.png'),
(112, 'namibia', 'namibia.png'),
(113, 'nauru', 'nauru.png'),
(114, 'nepal', 'nepal.png'),
(115, 'netherlands', 'netherlands.png'),
(116, 'nicaragua', 'nicaragua.png'),
(117, 'niger', 'niger.png'),
(118, 'nigeria', 'nigeria.png'),
(119, 'norway', 'norway.png'),
(120, 'oman', 'oman.png'),
(121, 'pakistan', 'pakistan.png'),
(122, 'panama', 'panama.png'),
(123, 'paraguay', 'paraguay.png'),
(124, 'peru', 'peru.png'),
(125, 'philippines', 'philippines.png'),
(126, 'poland', 'poland.png'),
(127, 'portugal', 'portugal.png'),
(128, 'qatar', 'qatar.png'),
(129, 'romania', 'romania.png'),
(130, 'russia', 'russia.png'),
(131, 'sao tome and principe', 'sao_tome_and_principe.png'),
(132, 'senegal', 'senegal.png'),
(133, 'serbia', 'serbia.png'),
(134, 'seychelles', 'seychelles.png'),
(135, 'sierra leone', 'sierra_leone.png'),
(136, 'singapore', 'singapore.png'),
(137, 'slovakia', 'slovakia.png'),
(138, 'slovenia', 'slovenia.png'),
(139, 'solomon islands', 'solomon_islands.png'),
(140, 'somalia', 'somalia.png'),
(141, 'south_korea', 'south_korea.png'),
(142, 'spain', 'spain.png'),
(143, 'saint kitts and nevis', 'saint_kitts_and_nevis.png'),
(144, 'saint lucia', 'saint_lucia.png'),
(145, 'sudan', 'sudan.png'),
(146, 'suriname', 'suriname.png'),
(147, 'sweden', 'sweden.png'),
(148, 'switzerland', 'switzerland.png'),
(149, 'syria', 'syria.png'),
(150, 'taiwan', 'taiwan.png'),
(151, 'tajikistan', 'tajikistan.png'),
(152, 'tanzania', 'tanzania.png'),
(153, 'thailand', 'thailand.png'),
(154, 'togo', 'togo.png'),
(155, 'tonga', 'tonga.png'),
(156, 'tunisia', 'tunisia.png'),
(157, 'turkey', 'turkey.png'),
(158, 'turkmenistan', 'turkmenistan.png'),
(159, 'tuvalu', 'tuvalu.png'),
(160, 'uganda', 'uganda.png'),
(161, 'uk', 'uk.png'),
(162, 'ukraine', 'ukraine.png'),
(163, 'uruguay', 'uruguay.png'),
(164, 'uzbekistan', 'uzbekistan.png'),
(165, 'vanuatu', 'vanuatu.png'),
(166, 'venezuela', 'venezuela.png'),
(167, 'vietnam', 'vietnam.png'),
(168, 'western samoa', 'western_samoa.png'),
(169, 'yemen', 'yemen.png'),
(170, 'yugoslavia', 'yugoslavia.png'),
(171, 'zambia', 'zambia.png'),
(172, 'zimbabwe', 'zimbabwe.png');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforbidden_extensions`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbforbidden_extensions` (
  `ext_id` mediumint(8) UNSIGNED NOT NULL,
  `extension` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbforbidden_extensions`
--

INSERT DELAYED INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES
(1, 'php'),
(2, 'php3'),
(3, 'php4'),
(4, 'phtml'),
(5, 'pl'),
(6, 'asp'),
(7, 'cgi'),
(8, 'com'),
(9, 'bat'),
(10, 'scr');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforums`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbforums` (
  `forum_id` smallint(5) UNSIGNED NOT NULL,
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
  `forum_password` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbforums`
--

INSERT DELAYED INTO `nuke_bbforums` (`forum_id`, `cat_id`, `forum_name`, `forum_desc`, `forum_status`, `forum_order`, `forum_posts`, `forum_topics`, `forum_last_post_id`, `prune_next`, `prune_enable`, `auth_view`, `auth_read`, `auth_post`, `auth_reply`, `auth_edit`, `auth_delete`, `auth_sticky`, `auth_announce`, `auth_globalannounce`, `auth_vote`, `auth_pollcreate`, `auth_attachments`, `forum_display_sort`, `forum_display_order`, `auth_download`, `forum_parent`, `forum_color`, `title_is_link`, `weblink`, `forum_link_icon`, `forum_link_count`, `forum_link_target`, `forum_icon`, `forum_thank`, `forum_password`) VALUES
(1, 5, 'Announcements', 'Test', 0, 10, 2, 2, 56, NULL, 0, 0, 0, 1, 1, 1, 1, 3, 3, 3, 1, 1, 1, 0, 0, 1, 0, '', 0, 'http://', '', 0, 0, 'images/forum_icons/php80x80.png', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbforum_prune`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbforum_prune` (
  `prune_id` mediumint(8) UNSIGNED NOT NULL,
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `prune_days` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `prune_freq` tinyint(4) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbforum_prune`
--

INSERT DELAYED INTO `nuke_bbforum_prune` (`prune_id`, `forum_id`, `prune_days`, `prune_freq`) VALUES
(1, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgamehash`
--
-- Creation: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbgamehash` (
  `gamehash_id` char(32) NOT NULL,
  `game_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `hash_date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbgamehash`
--

INSERT DELAYED INTO `nuke_bbgamehash` (`gamehash_id`, `game_id`, `user_id`, `hash_date`) VALUES
('e87d5502fc61a80f0dcd789bb4c47b4f', 1, 2, 1674195028),
('e87d5502fc61a80f0dcd789bb4c47b4f', 1, 2, 1674195037),
('e87d5502fc61a80f0dcd789bb4c47b4f', 1, 3, 1674195243);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgames`
--
-- Creation: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbgames` (
  `game_id` mediumint(8) NOT NULL,
  `game_pic` varchar(50) NOT NULL DEFAULT '',
  `game_desc` longtext NOT NULL DEFAULT 'No Description',
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
  `arcade_catid` mediumint(8) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbgames`
--

INSERT DELAYED INTO `nuke_bbgames` (`game_id`, `game_pic`, `game_desc`, `game_highscore`, `game_highdate`, `game_highuser`, `game_name`, `game_swf`, `game_scorevar`, `game_type`, `game_width`, `game_height`, `game_order`, `game_set`, `arcade_catid`) VALUES
(1, 'asteroids.gif', 'Asteroids is a space-themed multi directional shooter arcade video game designed by Lyle Rains and Ed Logg released in November 1979 by Atari, Inc. The player controls a single spaceship in an asteroid field which is periodically traversed by flying saucers.', 7180, 1674195025, 2, 'Classic Asteroids (1979)', 'asteroids.swf', 'asteroids', 4, 550, '380', 10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbgroups`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbgroups` (
  `group_id` mediumint(8) NOT NULL,
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
  `group_count_enable` smallint(2) UNSIGNED DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbgroups`
--

INSERT DELAYED INTO `nuke_bbgroups` (`group_id`, `group_type`, `group_name`, `group_description`, `group_moderator`, `group_single_user`, `group_allow_pm`, `group_color`, `group_rank`, `max_inbox`, `max_sentbox`, `max_savebox`, `override_max_inbox`, `override_max_sentbox`, `override_max_savebox`, `group_count`, `group_count_max`, `group_count_enable`) VALUES
(1, 1, 'Anonymous', 'Personal User', 0, 1, 0, '', '', 0, 0, 0, 0, 0, 0, 99999999, 99999999, 0),
(2, 2, 'Portal Moderators', 'Portal Moderators', 2, 0, 5, '2', '2', 0, 0, 0, 0, 0, 0, 99999999, 99999999, 0),
(3, 0, 'Portal Members', 'Default Portal Usergroup', 2, 0, 5, '4', '6', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 0, 'VIP Members', 'VIP Portal Members', 2, 0, 5, '3', '7', 100000, 100000, 100000, 0, 0, 0, 99999999, 99999999, 0),
(5, 0, 'Portal Admins', 'Portal Admins', 2, 0, 5, '1', '4', 100000, 100000, 100000, 1, 1, 1, 99999999, 99999999, 0),
(25, 0, 'CKEditor 4 Access', 'CKEditor 4 Access', 2, 0, 5, '5', '0', 1000, 1000, 1000, 0, 0, 0, 99999999, 99999999, 0),
(26, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(27, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(28, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(29, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(30, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(31, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(36, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbhackgame`
--
-- Creation: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbhackgame` (
  `user_id` mediumint(8) NOT NULL,
  `game_id` mediumint(8) NOT NULL,
  `date_hack` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbinline_ads`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbinline_ads` (
  `ad_id` tinyint(5) NOT NULL,
  `ad_code` text NOT NULL,
  `ad_name` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bblogs`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bblogs` (
  `log_id` mediumint(10) NOT NULL,
  `mode` varchar(50) DEFAULT '',
  `topic_id` mediumint(10) DEFAULT 0,
  `user_id` mediumint(8) DEFAULT 0,
  `username` varchar(255) DEFAULT '',
  `user_ip` varchar(8) NOT NULL DEFAULT '0',
  `time` int(11) DEFAULT 0,
  `new_topic_id` mediumint(10) NOT NULL DEFAULT 0,
  `forum_id` mediumint(10) NOT NULL DEFAULT 0,
  `new_forum_id` mediumint(10) NOT NULL DEFAULT 0,
  `last_post_id` mediumint(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bblogs_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bblogs_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bblogs_config`
--

INSERT DELAYED INTO `nuke_bblogs_config` (`config_name`, `config_value`) VALUES
('all_admin', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbposts`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbposts` (
  `post_id` mediumint(8) UNSIGNED NOT NULL,
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
  `post_icon` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbposts`
--

INSERT DELAYED INTO `nuke_bbposts` (`post_id`, `topic_id`, `forum_id`, `poster_id`, `post_time`, `poster_ip`, `post_username`, `enable_bbcode`, `enable_html`, `enable_smilies`, `enable_sig`, `post_edit_time`, `post_edit_count`, `post_attachment`, `post_move`, `post_icon`) VALUES
(55, 22, 1, 2, 1673676019, 'adaaf428', '', 1, 1, 1, 0, NULL, 0, 0, 0, 2),
(56, 23, 1, 2, 1673676477, 'adaaf428', '', 1, 1, 1, 0, NULL, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbposts_text`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbposts_text` (
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `bbcode_uid` varchar(10) NOT NULL DEFAULT '',
  `post_subject` varchar(120) DEFAULT NULL,
  `post_text` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbposts_text`
--

INSERT DELAYED INTO `nuke_bbposts_text` (`post_id`, `bbcode_uid`, `post_subject`, `post_text`) VALUES
(55, 'b6acf81128', 'Where did the name PHP-Nuke Titanium come from?', 'It involves a nuclear waste storage concept...\n\nBecause of its corrosion resistance, containers made of titanium have been studied for the long-term storage of nuclear waste. Containers lasting more than 100,000 years are thought possible with manufacturing conditions that minimize material defects. A titanium &quot;drip shield&quot; could also be installed over containers of other types to enhance their longevity.\n\nThe original PHP-Nuke has been around for 30+ years and we have preserved it in Titanium, PHP-Nuke Titanium to be exact...\n\nBecause titanium alloys have a highÂ tensile strength-to-density ratio, highÂ corrosion resistance, fatigue resistance, high crack resistance,Â and the ability to withstand moderately high temperatures without creeping, they are used in aircraft, armor plating, naval ships, spacecraft, and missiles.\n\nTitanium wasÂ discoveredÂ in 1791 by theÂ clergymanÂ and amateur geologistÂ William GregorÂ as anÂ inclusionÂ of a mineral inÂ Cornwall, Great Britain. Gregor recognized the presence of a new element in ilmeniteÂ when he found black sand by a stream and noticed the sand was attracted by aÂ magnet. Analyzing the sand, he determined the presence of two metal oxides:Â iron oxideÂ (explaining the attraction to the magnet) and 45.25% of a white metallic oxide he could not identify. Realizing that the unidentified oxide contained a metal that did not match any known element, Gregor reported his findings to theÂ Royal Geological Society of CornwallÂ and to the German science journalÂ Crell\'s Annalen.\n\nAround the same time,Â Franz-Joseph MÃ¼ller von ReichensteinÂ produced a similar substance, but could not identify it. The oxide was independently rediscovered in 1795 byÂ PrussianÂ chemistÂ Martin Heinrich KlaprothÂ in rutile from Boinik (the German name of BajmÃ³cska), a village in Hungary (now BojniÄky in Slovakia). Klaproth found that it contained a new element and named it after theÂ TitansÂ ofÂ Greek mythology. After hearing about Gregor\'s earlier discovery, he obtained a sample of manaccanite and confirmed it to be titanium.\n\nAll of this is how we related the idea to name our Fork of PHP-Nuke, PHP-Nuke Titanium and the story relates...'),
(56, '8fa9753073', 'About PHP-Nuke Titanium', 'The US version of PHP-Nuke Titanium CMSÂ is an open-source highly modifiedÂ Fork of PHP-NukeÂ written in PHP as a programming language and development was first started in 2005. The software comes with a set of basic features like a WYSIWYG editor, an admin interface with drag-and-drop blocks, spam protection, and image processing. PHP-Nuke Titanium CMS comes with the ability to use various modules that will extend the current functionality of your portal/website. The latest version available for download is 4.0.3 and is still in beta.\n\nPHP-Nuke Titanium currently supports the following PHP versions:\n\n[list:8fa9753073]\n[*:8fa9753073]PHP 8.0\n[*:8fa9753073]PHP 8.1.13\n[*:8fa9753073]PHP 8.1.14\n[/list:u:8fa9753073]');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbpost_reports`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbpost_reports` (
  `report_id` mediumint(8) NOT NULL,
  `post_id` mediumint(8) NOT NULL DEFAULT 0,
  `reporter_id` mediumint(8) NOT NULL DEFAULT 0,
  `report_status` tinyint(1) NOT NULL DEFAULT 0,
  `report_time` int(11) NOT NULL DEFAULT 0,
  `report_comments` text DEFAULT NULL,
  `last_action_user_id` mediumint(8) DEFAULT 0,
  `last_action_time` int(11) NOT NULL DEFAULT 0,
  `last_action_comments` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbprivmsgs` (
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL,
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
  `privmsgs_attachment` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs_archive`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbprivmsgs_archive` (
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT 0,
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_date` int(11) NOT NULL DEFAULT 0,
  `privmsgs_ip` varchar(8) NOT NULL DEFAULT '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT 0,
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbprivmsgs_text`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbprivmsgs_text` (
  `privmsgs_text_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `privmsgs_bbcode_uid` varchar(10) NOT NULL DEFAULT '0',
  `privmsgs_text` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbquicksearch`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbquicksearch` (
  `search_id` mediumint(8) UNSIGNED NOT NULL,
  `search_name` varchar(255) NOT NULL DEFAULT '',
  `search_url1` varchar(255) NOT NULL DEFAULT '',
  `search_url2` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbquicksearch`
--

INSERT DELAYED INTO `nuke_bbquicksearch` (`search_id`, `search_name`, `search_url1`, `search_url2`) VALUES
(1, 'Google', 'http://www.google.com/search?hl=en&ie=UTF-8&oe=UTF-8&q=', '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbquota_limits`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbquota_limits` (
  `quota_limit_id` mediumint(8) UNSIGNED NOT NULL,
  `quota_desc` varchar(20) NOT NULL DEFAULT '',
  `quota_limit` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbquota_limits`
--

INSERT DELAYED INTO `nuke_bbquota_limits` (`quota_limit_id`, `quota_desc`, `quota_limit`) VALUES
(1, 'Low', 262144),
(2, 'Medium', 2097152),
(3, 'High', 5242880);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbranks`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbranks` (
  `rank_id` smallint(5) UNSIGNED NOT NULL,
  `rank_title` varchar(100) NOT NULL DEFAULT '',
  `rank_min` mediumint(8) NOT NULL DEFAULT 0,
  `rank_special` tinyint(1) DEFAULT 0,
  `rank_image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbranks`
--

INSERT DELAYED INTO `nuke_bbranks` (`rank_id`, `rank_title`, `rank_min`, `rank_special`, `rank_image`) VALUES
(4, 'Administrator', -1, 1, 'images/ranks/administrator.png'),
(5, 'Developer', -1, 1, 'images/ranks/developer.png'),
(6, 'Portal Member', -1, 1, 'images/ranks/regular-member.png'),
(7, 'VIP Member', -1, 1, 'images/ranks/vip.png');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbreputation`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbreputation` (
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id_2` mediumint(8) NOT NULL DEFAULT 0,
  `post_id` mediumint(8) NOT NULL DEFAULT 0,
  `rep_sum` float NOT NULL DEFAULT 0,
  `rep_neg` tinyint(1) NOT NULL DEFAULT 0,
  `rep_comment` varchar(200) NOT NULL DEFAULT '',
  `rep_time` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbreputation_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbreputation_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbreputation_config`
--

INSERT DELAYED INTO `nuke_bbreputation_config` (`config_name`, `config_value`) VALUES
('posts_to_earn', '5'),
('rep_disable', '0'),
('days_to_earn', '30'),
('flood_control_time', '30'),
('graphic_version', '0'),
('medal4_to_earn', '10'),
('medal3_to_earn', '50'),
('medal2_to_earn', '100'),
('medal1_to_earn', '200'),
('given_rep_to_earn', '20'),
('show_stats_to_mods', '0'),
('repsum_limit', '0'),
('pm_notify', '0'),
('default_amount', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbscores`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbscores` (
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `score_game` int(11) NOT NULL DEFAULT 0,
  `score_date` int(11) NOT NULL DEFAULT 0,
  `score_time` int(11) NOT NULL DEFAULT 0,
  `score_set` mediumint(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbscores`
--

INSERT DELAYED INTO `nuke_bbscores` (`game_id`, `user_id`, `score_game`, `score_date`, `score_time`, `score_set`) VALUES
(1, 3, 3080, 1674195243, 157, 2),
(1, 2, 7180, 1674195025, 76, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_rebuild`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbsearch_rebuild` (
  `rebuild_session_id` mediumint(8) UNSIGNED NOT NULL,
  `start_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `end_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `start_time` int(11) NOT NULL DEFAULT 0,
  `end_time` int(11) NOT NULL DEFAULT 0,
  `last_cycle_time` int(11) NOT NULL DEFAULT 0,
  `session_time` int(11) NOT NULL DEFAULT 0,
  `session_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `session_cycles` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `search_size` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `rebuild_session_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_results`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbsearch_results` (
  `search_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `search_array` text NOT NULL,
  `search_time` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbsearch_results`
--

INSERT DELAYED INTO `nuke_bbsearch_results` (`search_id`, `session_id`, `search_array`, `search_time`) VALUES
(929134913, '05e538b14aaa516d129e4c2618b2a0db', 'a:0:{}', 1673400278);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_wordlist`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbsearch_wordlist` (
  `word_text` varchar(255) NOT NULL DEFAULT '',
  `word_id` mediumint(8) UNSIGNED NOT NULL,
  `word_common` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbsearch_wordlist`
--

INSERT DELAYED INTO `nuke_bbsearch_wordlist` (`word_text`, `word_id`, `word_common`, `post_id`) VALUES
('forum', 1606, 0, 0),
('drip', 1708, 0, 0),
('discovery', 1707, 0, 0),
('created', 1601, 0, 0),
('determined', 1706, 0, 0),
('defects', 1705, 0, 0),
('codebuzzard', 1598, 0, 0),
('creeping', 1704, 0, 0),
('crack', 1703, 0, 0),
('corrosion', 1702, 0, 0),
('cornwallÂ and', 1701, 0, 0),
('containers', 1700, 0, 0),
('contained', 1699, 0, 0),
('confirmed', 1698, 0, 0),
('conditions', 1697, 0, 0),
('concept', 1696, 0, 0),
('britain', 1695, 0, 0),
('bojniÄky', 1694, 0, 0),
('boinik', 1693, 0, 0),
('black', 1692, 0, 0),
('bajmÃ³cska', 1691, 0, 0),
('aÂ magnet', 1690, 0, 0),
('attraction', 1689, 0, 0),
('attracted', 1688, 0, 0),
('armor', 1687, 0, 0),
('anÂ inclusionÂ of', 1686, 0, 0),
('annalen', 1685, 0, 0),
('analyzing', 1684, 0, 0),
('amateur', 1683, 0, 0),
('alloys', 1682, 0, 0),
('aircraft', 1681, 0, 0),
('ability', 1680, 0, 0),
('1795', 1679, 0, 0),
('1791', 1678, 0, 0),
('100', 1677, 0, 0),
('25', 1676, 0, 0),
('000', 1675, 0, 0),
('earlier', 1709, 0, 0),
('element', 1710, 0, 0),
('enhance', 1711, 0, 0),
('exact', 1712, 0, 0),
('explaining', 1713, 0, 0),
('fatigue', 1714, 0, 0),
('findings', 1715, 0, 0),
('fork', 1716, 0, 0),
('geological', 1717, 0, 0),
('geologistÂ william', 1718, 0, 0),
('german', 1719, 0, 0),
('great', 1720, 0, 0),
('gregor', 1721, 0, 0),
('gregors', 1722, 0, 0),
('gregorÂ as', 1723, 0, 0),
('hearing', 1724, 0, 0),
('heinrich', 1725, 0, 0),
('high', 1726, 0, 0),
('highÂ corrosion', 1727, 0, 0),
('highÂ tensile', 1728, 0, 0),
('hungary', 1729, 0, 0),
('idea', 1730, 0, 0),
('identify', 1731, 0, 0),
('ilmeniteÂ when', 1732, 0, 0),
('independently', 1733, 0, 0),
('installed', 1734, 0, 0),
('involves', 1735, 0, 0),
('inÂ cornwall', 1736, 0, 0),
('journalÂ crells', 1737, 0, 0),
('klaproth', 1738, 0, 0),
('klaprothÂ in', 1739, 0, 0),
('known', 1740, 0, 0),
('lasting', 1741, 0, 0),
('longevity', 1742, 0, 0),
('longterm', 1743, 0, 0),
('made', 1744, 0, 0),
('magnet', 1745, 0, 0),
('manaccanite', 1746, 0, 0),
('manufacturing', 1747, 0, 0),
('match', 1748, 0, 0),
('material', 1749, 0, 0),
('metal', 1750, 0, 0),
('metallic', 1751, 0, 0),
('mineral', 1752, 0, 0),
('minimize', 1753, 0, 0),
('missiles', 1754, 0, 0),
('moderately', 1755, 0, 0),
('mythology', 1756, 0, 0),
('mÃ¼ller', 1757, 0, 0),
('name', 1758, 0, 0),
('named', 1759, 0, 0),
('naval', 1760, 0, 0),
('noticed', 1761, 0, 0),
('nuclear', 1762, 0, 0),
('obtained', 1763, 0, 0),
('original', 1764, 0, 0),
('oxide', 1765, 0, 0),
('oxides', 1766, 0, 0),
('oxideÂ ', 1767, 0, 0),
('phpnuke', 1768, 0, 0),
('plating', 1769, 0, 0),
('possible', 1770, 0, 0),
('presence', 1771, 0, 0),
('preserved', 1772, 0, 0),
('quot', 1773, 0, 0),
('ratio', 1774, 0, 0),
('realizing', 1775, 0, 0),
('recognized', 1776, 0, 0),
('rediscovered', 1777, 0, 0),
('related', 1778, 0, 0),
('relates', 1779, 0, 0),
('reported', 1780, 0, 0),
('resistence', 1781, 0, 0),
('rutile', 1782, 0, 0),
('same', 1783, 0, 0),
('sample', 1784, 0, 0),
('sand', 1785, 0, 0),
('science', 1786, 0, 0),
('shield', 1787, 0, 0),
('ships', 1788, 0, 0),
('similar', 1789, 0, 0),
('slovakia', 1790, 0, 0),
('society', 1791, 0, 0),
('spacecraft', 1792, 0, 0),
('storage', 1793, 0, 0),
('story', 1794, 0, 0),
('stream', 1795, 0, 0),
('strengthtodensity', 1796, 0, 0),
('studied', 1797, 0, 0),
('substance', 1798, 0, 0),
('temperatures', 1799, 0, 0),
('theÂ clergymanÂ and', 1800, 0, 0),
('theÂ royal', 1801, 0, 0),
('thought', 1802, 0, 0),
('titanium', 1803, 0, 0),
('two', 1804, 0, 0),
('types', 1805, 0, 0),
('unidentified', 1806, 0, 0),
('used', 1807, 0, 0),
('village', 1808, 0, 0),
('von', 1809, 0, 0),
('waste', 1810, 0, 0),
('wasÂ discoveredÂ in', 1811, 0, 0),
('white', 1812, 0, 0),
('withstand', 1813, 0, 0),
('years', 1814, 0, 0),
('Â and', 1815, 0, 0),
('Â franzjoseph', 1816, 0, 0),
('Â iron', 1817, 0, 0),
('various', 1910, 0, 0),
('supports', 1909, 0, 0),
('still', 1908, 0, 0),
('started', 1907, 0, 0),
('spam', 1906, 0, 0),
('software', 1905, 0, 0),
('set', 1904, 0, 0),
('protection', 1903, 0, 0),
('programming', 1902, 0, 0),
('processing', 1901, 0, 0),
('portal', 1900, 0, 0),
('phpnukeÂ written', 1899, 0, 0),
('php', 1898, 0, 0),
('opensource', 1897, 0, 0),
('modules', 1896, 0, 0),
('modifiedÂ fork', 1895, 0, 0),
('latest', 1894, 0, 0),
('language', 1893, 0, 0),
('interface', 1892, 0, 0),
('image', 1891, 0, 0),
('highly', 1890, 0, 0),
('functionality', 1889, 0, 0),
('following', 1888, 0, 0),
('first', 1887, 0, 0),
('features', 1886, 0, 0),
('extend', 1885, 0, 0),
('editor', 1884, 0, 0),
('draganddrop', 1883, 0, 0),
('download', 1882, 0, 0),
('development', 1881, 0, 0),
('currently', 1880, 0, 0),
('current', 1879, 0, 0),
('comes', 1878, 0, 0),
('cmsÂ is', 1877, 0, 0),
('cms', 1876, 0, 0),
('blocks', 1875, 0, 0),
('beta', 1874, 0, 0),
('basic', 1873, 0, 0),
('available', 1872, 0, 0),
('admin', 1871, 0, 0),
('2005', 1870, 0, 0),
('4', 1869, 0, 0),
('3', 1868, 0, 0),
('1', 1867, 0, 0),
('0', 1866, 0, 0),
('versions', 1911, 0, 0),
('website', 1912, 0, 0),
('wysiwyg', 1913, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsearch_wordmatch`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbsearch_wordmatch` (
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `word_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `title_match` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbsearch_wordmatch`
--

INSERT DELAYED INTO `nuke_bbsearch_wordmatch` (`post_id`, `word_id`, `title_match`) VALUES
(55, 1712, 0),
(55, 1711, 0),
(55, 1710, 0),
(55, 1709, 0),
(55, 1675, 0),
(55, 1676, 0),
(55, 1677, 0),
(55, 1678, 0),
(55, 1679, 0),
(55, 1680, 0),
(55, 1681, 0),
(55, 1682, 0),
(55, 1683, 0),
(55, 1684, 0),
(55, 1685, 0),
(55, 1686, 0),
(55, 1687, 0),
(55, 1688, 0),
(55, 1689, 0),
(55, 1690, 0),
(55, 1691, 0),
(55, 1692, 0),
(55, 1693, 0),
(55, 1694, 0),
(55, 1695, 0),
(55, 1696, 0),
(55, 1697, 0),
(55, 1698, 0),
(55, 1699, 0),
(55, 1700, 0),
(55, 1701, 0),
(55, 1702, 0),
(55, 1703, 0),
(55, 1704, 0),
(55, 1705, 0),
(55, 1706, 0),
(55, 1707, 0),
(55, 1708, 0),
(55, 1713, 0),
(55, 1714, 0),
(55, 1715, 0),
(55, 1716, 0),
(55, 1717, 0),
(55, 1718, 0),
(55, 1719, 0),
(55, 1720, 0),
(55, 1721, 0),
(55, 1722, 0),
(55, 1723, 0),
(55, 1724, 0),
(55, 1725, 0),
(55, 1726, 0),
(55, 1727, 0),
(55, 1728, 0),
(55, 1729, 0),
(55, 1730, 0),
(55, 1731, 0),
(55, 1732, 0),
(55, 1733, 0),
(55, 1734, 0),
(55, 1735, 0),
(55, 1736, 0),
(55, 1737, 0),
(55, 1738, 0),
(55, 1739, 0),
(55, 1740, 0),
(55, 1741, 0),
(55, 1742, 0),
(55, 1743, 0),
(55, 1744, 0),
(55, 1745, 0),
(55, 1746, 0),
(55, 1747, 0),
(55, 1748, 0),
(55, 1749, 0),
(55, 1750, 0),
(55, 1751, 0),
(55, 1752, 0),
(55, 1753, 0),
(55, 1754, 0),
(55, 1755, 0),
(55, 1756, 0),
(55, 1757, 0),
(55, 1758, 0),
(55, 1759, 0),
(55, 1760, 0),
(55, 1761, 0),
(55, 1762, 0),
(55, 1763, 0),
(55, 1764, 0),
(55, 1765, 0),
(55, 1766, 0),
(55, 1767, 0),
(55, 1768, 0),
(55, 1769, 0),
(55, 1770, 0),
(55, 1771, 0),
(55, 1772, 0),
(55, 1773, 0),
(55, 1774, 0),
(55, 1775, 0),
(55, 1776, 0),
(55, 1777, 0),
(55, 1778, 0),
(55, 1779, 0),
(55, 1780, 0),
(55, 1781, 0),
(55, 1782, 0),
(55, 1783, 0),
(55, 1784, 0),
(55, 1785, 0),
(55, 1786, 0),
(55, 1787, 0),
(55, 1788, 0),
(55, 1789, 0),
(55, 1790, 0),
(55, 1791, 0),
(55, 1792, 0),
(55, 1793, 0),
(55, 1794, 0),
(55, 1795, 0),
(55, 1796, 0),
(55, 1797, 0),
(55, 1798, 0),
(55, 1799, 0),
(55, 1800, 0),
(55, 1801, 0),
(55, 1802, 0),
(55, 1803, 0),
(55, 1804, 0),
(55, 1805, 0),
(55, 1806, 0),
(55, 1807, 0),
(55, 1808, 0),
(55, 1809, 0),
(55, 1810, 0),
(55, 1811, 0),
(55, 1812, 0),
(55, 1813, 0),
(55, 1814, 0),
(55, 1815, 0),
(55, 1816, 0),
(55, 1817, 0),
(55, 1758, 1),
(55, 1768, 1),
(55, 1803, 1),
(56, 1803, 1),
(56, 1768, 1),
(56, 1913, 0),
(56, 1912, 0),
(56, 1911, 0),
(56, 1866, 0),
(56, 1867, 0),
(56, 1868, 0),
(56, 1869, 0),
(56, 1870, 0),
(56, 1871, 0),
(56, 1872, 0),
(56, 1873, 0),
(56, 1874, 0),
(56, 1875, 0),
(56, 1876, 0),
(56, 1877, 0),
(56, 1878, 0),
(56, 1879, 0),
(56, 1880, 0),
(56, 1881, 0),
(56, 1882, 0),
(56, 1883, 0),
(56, 1884, 0),
(56, 1885, 0),
(56, 1886, 0),
(56, 1887, 0),
(56, 1888, 0),
(56, 1889, 0),
(56, 1890, 0),
(56, 1891, 0),
(56, 1892, 0),
(56, 1893, 0),
(56, 1894, 0),
(56, 1895, 0),
(56, 1896, 0),
(56, 1897, 0),
(56, 1898, 0),
(56, 1899, 0),
(56, 1900, 0),
(56, 1901, 0),
(56, 1902, 0),
(56, 1903, 0),
(56, 1904, 0),
(56, 1905, 0),
(56, 1906, 0),
(56, 1907, 0),
(56, 1908, 0),
(56, 1909, 0),
(56, 1910, 0),
(56, 1803, 0),
(56, 1768, 0),
(56, 1680, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsessions`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbsessions` (
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
  `session_url_specific` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsessions_keys`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbsessions_keys` (
  `key_id` varchar(32) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `last_ip` varchar(8) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbsmilies`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbsmilies` (
  `smilies_id` smallint(5) UNSIGNED NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `smile_url` varchar(100) DEFAULT NULL,
  `emoticon` varchar(75) DEFAULT NULL,
  `smile_stat` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbsmilies`
--

INSERT DELAYED INTO `nuke_bbsmilies` (`smilies_id`, `code`, `smile_url`, `emoticon`, `smile_stat`) VALUES
(1, ':D', 'bigsmile.png', 'Very Happy', 0),
(2, ':-D', 'bigsmile.png', 'Very Happy', 0),
(3, ':grin:', 'bigsmile.png', 'Very Happy', 0),
(4, ':)', 'smile.png', 'Smile', 0),
(5, ':-)', 'smile.png', 'Smile', 0),
(6, ':smile:', 'smile.png', 'Smile', 0),
(7, ':(', 'sad.png', 'Sad', 0),
(8, ':-(', 'sad.png', 'Sad', 0),
(9, ':sad:', 'sad.png', 'Sad', 0),
(10, ':o', 'surprised.png', 'Surprised', 0),
(11, ':-o', 'surprised.png', 'Surprised', 0),
(12, ':eek:', 'surprised.png', 'Surprised', 0),
(13, '8O', 'eek.png', 'Shocked', 0),
(14, '8-O', 'eek.png', 'Shocked', 0),
(15, ':shock:', 'eek.png', 'Shocked', 0),
(16, ':?', 'confused.png', 'Confused', 0),
(17, ':-?', 'confused.png', 'Confused', 0),
(18, ':???:', 'confused.png', 'Confused', 0),
(19, '8)', 'cool.png', 'Cool', 0),
(20, '8-)', 'cool.png', 'Cool', 0),
(21, ':cool:', 'cool.png', 'Cool', 0),
(22, ':lol:', 'lol.png', 'Laughing', 0),
(23, ':x', 'mad.png', 'Mad', 0),
(24, ':-x', 'mad.png', 'Mad', 0),
(25, ':mad:', 'mad.png', 'Mad', 0),
(26, ':P', 'razz.png', 'Razz', 0),
(27, ':-P', 'razz.png', 'Razz', 0),
(28, ':razz:', 'razz.png', 'Razz', 0),
(29, ':oops:', 'redface.png', 'Embarassed', 0),
(30, ':cry:', 'cry.png', 'Crying or Very sad', 0),
(31, ':evil:', 'evil.png', 'Evil or Very Mad', 0),
(32, ':twisted:', 'twisted.png', 'Twisted Evil', 0),
(33, ':hearts:', 'hearts.png', 'In Love', 0),
(34, ':wink:', 'wink.png', 'Wink', 0),
(35, ';)', 'wink.png', 'Wink', 0),
(36, ';-)', 'wink.png', 'Wink', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbstats_config` (
  `config_name` varchar(100) NOT NULL DEFAULT '',
  `config_value` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbstats_config`
--

INSERT DELAYED INTO `nuke_bbstats_config` (`config_name`, `config_value`) VALUES
('install_date', '0'),
('return_limit', '10'),
('version', '3.0.0'),
('page_views', '36');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_modules`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbstats_modules` (
  `module_id` mediumint(8) UNSIGNED NOT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `update_time` mediumint(8) NOT NULL DEFAULT 0,
  `module_order` mediumint(8) NOT NULL DEFAULT 0,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  `perm_all` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_reg` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_mod` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_admin` tinyint(2) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbstats_modules`
--

INSERT DELAYED INTO `nuke_bbstats_modules` (`module_id`, `short_name`, `update_time`, `module_order`, `active`, `perm_all`, `perm_reg`, `perm_mod`, `perm_admin`) VALUES
(1, 'stats_overview', 360, 10, 1, 1, 1, 1, 1),
(2, 'top_posters', 360, 30, 1, 1, 1, 1, 1),
(3, 'admin_statistics', 360, 20, 1, 1, 1, 1, 1),
(4, 'most_viewed_topics', 360, 80, 1, 1, 1, 1, 1),
(5, 'top_posters_month', 360, 60, 1, 1, 1, 1, 1),
(6, 'topics_by_month', 360, 100, 1, 1, 1, 1, 1),
(7, 'most_interesting_topics', 360, 120, 1, 1, 1, 1, 1),
(8, 'top_words', 360, 90, 1, 1, 1, 1, 1),
(9, 'least_interesting_topics', 360, 130, 1, 1, 1, 1, 1),
(10, 'most_active_topicstarter', 360, 40, 1, 1, 1, 1, 1),
(11, 'top_smilies', 0, 110, 1, 1, 1, 1, 1),
(12, 'users_by_month', 360, 140, 1, 1, 1, 1, 1),
(13, 'posts_by_month', 360, 150, 1, 1, 1, 1, 1),
(14, 'top_posters_week', 360, 50, 1, 1, 1, 1, 1),
(15, 'top_attachments', 360, 160, 1, 1, 1, 1, 1),
(16, 'most_active_topics', 360, 70, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_module_admin_panel`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbstats_module_admin_panel` (
  `module_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  `config_type` varchar(20) NOT NULL DEFAULT '',
  `config_title` varchar(100) NOT NULL DEFAULT '',
  `config_explain` varchar(100) DEFAULT NULL,
  `config_trigger` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbstats_module_admin_panel`
--

INSERT DELAYED INTO `nuke_bbstats_module_admin_panel` (`module_id`, `config_name`, `config_value`, `config_type`, `config_title`, `config_explain`, `config_trigger`) VALUES
(1, 'num_columns', '2', 'number', 'num_columns_title', 'num_columns_explain', 'integer'),
(15, 'exclude_images', '0', 'number', 'exclude_images_title', 'exclude_images_explain', 'enum');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_module_cache`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbstats_module_cache` (
  `module_id` mediumint(8) NOT NULL DEFAULT 0,
  `module_cache_time` int(12) NOT NULL DEFAULT 0,
  `db_cache` text NOT NULL,
  `priority` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_module_group_auth`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbstats_module_group_auth` (
  `module_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_module_info`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbstats_module_info` (
  `module_id` mediumint(8) NOT NULL DEFAULT 0,
  `long_name` varchar(100) NOT NULL DEFAULT '',
  `author` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `version` varchar(10) NOT NULL DEFAULT '',
  `update_site` varchar(100) DEFAULT NULL,
  `extra_info` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbstats_module_info`
--

INSERT DELAYED INTO `nuke_bbstats_module_info` (`module_id`, `long_name`, `author`, `email`, `url`, `version`, `update_site`, `extra_info`) VALUES
(1, 'Statistics Overview Section', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will print out a link Block with Links to the current Module at the Statistics Site.\nYou are able to define the number of columns displayed for this Module within the Administration Panel -&gt; Edit Module.'),
(2, 'Top Posters', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the Top Posters from your board.\nAnonymous Poster are not counted.'),
(3, 'Administrative Statistics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays some Admin Statistics about your Board.\nIt is nearly the same you are able to see within the first Administration Panel visit.'),
(4, 'Most viewed topics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most viewed topics at your board.'),
(5, 'Top Posters this Month (Site History Mod)', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Monthly basis.'),
(6, 'New topics by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the topics created at your Board in a monthly statistic.'),
(7, 'Most Interesting Topics', 'JRSweets', 'JRSweets@gmail.com', 'http://www.jeffrusso.net', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This module will show the most intresting topics.'),
(8, 'Top Words', 'JRSweets', 'JRSweets@gmail.com', 'http://www.jeffrusso.net', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most used words on your board.'),
(9, 'Least Interesting Topics', 'JRSweets', 'JRSweets@gmail.com', 'http://www.jeffrusso.net', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This module will show the least intresting topics.'),
(10, 'Most Active Topicstarter', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most active topicstarter on your board.\nAnonymous Poster are not counted.'),
(11, 'Top Smilies', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the Top Smilies used at your board.\nThis Module uses an Smilie Index Table for caching the smilie data and to not\nrequire re-indexing of all posts.'),
(12, 'New users by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the users registered to your Board in a monthly statistic.'),
(13, 'New posts by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the posts created at your Board in a monthly statistic.'),
(14, 'Top Posters this Week (Site History Mod)', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Weekly basis.'),
(15, 'Top Downloaded Attachments', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will print out the most downloaded Files.\nThe Attachment Mod Version 2.3.x have to be installed in order to let this Module work.\nYou are able to exclude Images from the statistic too.'),
(16, 'Most active Topics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most active topics at your board.');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_smilies_index`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbstats_smilies_index` (
  `code` varchar(50) NOT NULL DEFAULT '',
  `smile_url` varchar(100) DEFAULT NULL,
  `smile_count` mediumint(8) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbstats_smilies_info`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbstats_smilies_info` (
  `last_post_id` mediumint(8) NOT NULL DEFAULT 0,
  `last_update_time` int(12) NOT NULL DEFAULT 0,
  `update_time` mediumint(8) NOT NULL DEFAULT 10080
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbstats_smilies_info`
--

INSERT DELAYED INTO `nuke_bbstats_smilies_info` (`last_post_id`, `last_update_time`, `update_time`) VALUES
(7, 1619840967, 10080);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthanks`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbthanks` (
  `topic_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `thanks_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthemes`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbthemes` (
  `themes_id` mediumint(8) UNSIGNED NOT NULL,
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
  `hidden_color` varchar(6) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbthemes`
--

INSERT DELAYED INTO `nuke_bbthemes` (`themes_id`, `template_name`, `style_name`, `head_stylesheet`, `body_background`, `body_bgcolor`, `body_text`, `body_link`, `body_vlink`, `body_alink`, `body_hlink`, `tr_color1`, `tr_color2`, `tr_color3`, `tr_class1`, `tr_class2`, `tr_class3`, `th_color1`, `th_color2`, `th_color3`, `th_class1`, `th_class2`, `th_class3`, `td_color1`, `td_color2`, `td_color3`, `td_class1`, `td_class2`, `td_class3`, `fontface1`, `fontface2`, `fontface3`, `fontsize1`, `fontsize2`, `fontsize3`, `fontcolor1`, `fontcolor2`, `fontcolor3`, `span_class1`, `span_class2`, `span_class3`, `img_size_poll`, `img_size_privmsg`, `online_color`, `offline_color`, `hidden_color`) VALUES
(1, 'subSilver', 'subSilver', 'subSilver.css', '', '0E3259', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', 10, 11, 12, '444444', '006600', 'FFA34F', '', '', '', NULL, NULL, '008500', 'DF0000', 'EBD400');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbthemes_name`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbthemes_name` (
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
  `span_class3_name` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbthemes_name`
--

INSERT DELAYED INTO `nuke_bbthemes_name` (`themes_id`, `tr_color1_name`, `tr_color2_name`, `tr_color3_name`, `tr_class1_name`, `tr_class2_name`, `tr_class3_name`, `th_color1_name`, `th_color2_name`, `th_color3_name`, `th_class1_name`, `th_class2_name`, `th_class3_name`, `td_color1_name`, `td_color2_name`, `td_color3_name`, `td_class1_name`, `td_class2_name`, `td_class3_name`, `fontface1_name`, `fontface2_name`, `fontface3_name`, `fontsize1_name`, `fontsize2_name`, `fontsize3_name`, `fontcolor1_name`, `fontcolor2_name`, `fontcolor3_name`, `span_class1_name`, `span_class2_name`, `span_class3_name`) VALUES
(1, 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopics`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbtopics` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL,
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
  `topic_icon` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbtopics`
--

INSERT DELAYED INTO `nuke_bbtopics` (`topic_id`, `forum_id`, `topic_title`, `topic_poster`, `topic_time`, `topic_views`, `topic_replies`, `topic_status`, `topic_vote`, `topic_type`, `topic_last_post_id`, `topic_first_post_id`, `topic_moved_id`, `topic_priority`, `topic_attachment`, `topic_glance_priority`, `topic_icon`) VALUES
(22, 1, 'Where did the name PHP-Nuke Titanium come from?', 2, 1673676019, 36, 0, 0, 0, 0, 55, 55, 0, 0, 0, 0, 2),
(23, 1, 'About PHP-Nuke Titanium', 2, 1673676477, 117, 0, 0, 0, 0, 56, 56, 0, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopics_email`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbtopics_email` (
  `user_id` mediumint(8) NOT NULL,
  `friend_name` varchar(100) NOT NULL,
  `friend_email` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL DEFAULT '',
  `topic_id` mediumint(8) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopics_watch`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbtopics_watch` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `notify_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopic_moved`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbtopic_moved` (
  `moved_id` mediumint(8) UNSIGNED NOT NULL,
  `moved_topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `moved_oldtopic_id` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_type` varchar(8) NOT NULL DEFAULT '0',
  `moved_parent` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_target` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_mod` mediumint(8) NOT NULL DEFAULT 0,
  `moved_time` int(11) NOT NULL DEFAULT 0,
  `last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbtopic_view`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbtopic_view` (
  `topic_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `view_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbuser_group`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbuser_group` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_pending` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbuser_group`
--

INSERT DELAYED INTO `nuke_bbuser_group` (`group_id`, `user_id`, `user_pending`) VALUES
(1, -1, 0),
(3, 2, 0),
(5, 2, 0),
(5, 4, 0),
(3, 4, 0),
(6, 5, 0),
(3, 5, 0),
(7, 2, 0),
(8, 2, 0),
(7, 4, 0),
(9, 6, 0),
(3, 6, 0),
(7, 6, 0),
(7, 3, 0),
(7, 5, 0),
(10, 7, 0),
(3, 7, 0),
(11, 8, 0),
(3, 8, 0),
(12, 9, 0),
(3, 9, 0),
(13, 10, 0),
(3, 10, 0),
(14, 11, 0),
(3, 11, 0),
(15, 12, 0),
(3, 12, 0),
(16, 13, 0),
(3, 13, 0),
(17, 14, 0),
(3, 14, 0),
(18, 15, 0),
(3, 15, 0),
(19, 16, 0),
(3, 16, 0),
(20, 17, 0),
(3, 17, 0),
(21, 18, 0),
(3, 18, 0),
(22, 19, 0),
(3, 19, 0),
(23, 20, 0),
(3, 20, 0),
(7, 20, 0),
(24, 21, 0),
(3, 21, 0),
(7, 11, 1),
(4, 2, 0),
(25, 2, 0),
(26, 3, 0),
(3, 3, 0),
(27, 1, 0),
(28, 2, 0),
(29, 4, 0),
(4, 4, 0),
(30, 3, 0),
(31, 0, 0),
(36, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_desc`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbvote_desc` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL,
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_text` text NOT NULL,
  `vote_start` int(11) NOT NULL DEFAULT 0,
  `vote_length` int(11) NOT NULL DEFAULT 0,
  `poll_view_toggle` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_results`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbvote_results` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_option_id` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `vote_option_text` varchar(255) NOT NULL DEFAULT '',
  `vote_result` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbvote_voters`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbvote_voters` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_user_id` mediumint(8) NOT NULL DEFAULT 0,
  `vote_user_ip` char(8) NOT NULL DEFAULT '',
  `vote_cast` tinyint(4) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbwords`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbwords` (
  `word_id` mediumint(8) UNSIGNED NOT NULL,
  `word` char(100) NOT NULL DEFAULT '',
  `replacement` char(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbwords`
--

INSERT DELAYED INTO `nuke_bbwords` (`word_id`, `word`, `replacement`) VALUES
(1, 'cunt', 'fargnoggle');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbxdata_auth`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbxdata_auth` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `auth_value` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbxdata_data`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbxdata_data` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `xdata_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bbxdata_fields`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bbxdata_fields` (
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
  `signup` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bbxdata_fields`
--

INSERT DELAYED INTO `nuke_bbxdata_fields` (`field_id`, `field_name`, `field_desc`, `field_type`, `field_order`, `code_name`, `field_length`, `field_values`, `field_regexp`, `manditory`, `default_auth`, `display_register`, `display_viewprofile`, `display_posting`, `handle_input`, `allow_html`, `allow_bbcode`, `allow_smilies`, `viewtopic`, `signup`) VALUES
(5, 'Website', '', 'special', 5, 'website', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'Location', '', 'special', 6, 'location', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'Occupation', '', 'special', 7, 'occupation', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'Interests', '', 'special', 8, 'interests', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'Signature', '', 'special', 9, 'signature', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blocks`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_blocks` (
  `bid` int(10) NOT NULL,
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
  `view` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_blocks`
--

INSERT DELAYED INTO `nuke_blocks` (`bid`, `bkey`, `title`, `content`, `url`, `bposition`, `weight`, `active`, `refresh`, `time`, `blanguage`, `blockfile`, `view`) VALUES
(1, '', 'Evo Main Menu', '', '', 'l', 1, 0, 1800, '0', '', 'block-Modules.php', '1'),
(2, '', 'Search', '', '', 'l', 6, 1, 3600, '', '', 'block-Search.php', '0'),
(3, '', 'Survey', '', '', 'r', 6, 0, 3600, '', '', 'block-Survey.php', '0'),
(4, '', 'Information', '<br /><center><span class=\"content\">\r\n<a href=\"http://phpnuke.org\"><img src=\"images/powered/powered8.jpg\" border=\"0\" alt=\"Powered by PHP-Nuke\" title=\"Powered by PHP-Nuke\" width=\"88\" height=\"31\" /></a>\r\n<br /><br />\r\n<a href=\"http://validator.w3.org/check/referer\"><img src=\"images/html401.gif\" width=\"88\" height=\"31\" alt=\"Valid HTML 4.01!\" title=\"Valid HTML 4.01!\" border=\"0\" /></a>\r\n<br /><br />\r\n<a href=\"http://jigsaw.w3.org/css-validator\"><img src=\"images/css.gif\" width=\"88\" height=\"31\" alt=\"Valid CSS!\" title=\"Valid CSS!\" border=\"0\" /></a></span></center><br />', '', 'r', 7, 0, 0, '', '', '', '0'),
(5, '', 'User Info', '', '', 'r', 0, 1, 0, '', '', 'block-Evo_User_Info.php', '0'),
(6, '', 'Top 10 Links', '', '', 'r', 4, 1, 3600, '0', '', 'block-Titanium_Top10_Links.php', '1'),
(7, '', 'Forums', '', '', 'c', 0, 1, 3600, '0', '', 'block-Titanium_Forums.php', '1'),
(8, '', 'Submissions', '', '', 'l', 2, 0, 0, '', '', 'block-Submissions.php', '4'),
(9, '', 'Link-us', '', '', 'l', 4, 1, 3600, '0', '', 'block-Titanium_Link_Us.php', '1'),
(10, '', 'Shout Box', '', '', 'r', 2, 1, 3600, '0', '', 'block-Titanium_Shout_Box.php', '1'),
(11, '', 'Donations', '', '', 'r', 5, 0, 3600, '0', '', 'block-Donations.php', '0'),
(12, '', 'ECalendar', '', '', 'l', 3, 0, 3600, '0', '', 'block-ECalendar.php', '1'),
(13, '', 'Sentinel Portal Security', '', '', 'd', 0, 1, 3600, '0', '', 'block-Titanium_Sentinel_Center.php', '1'),
(14, '', 'Select Network Theme', '', '', 'r', 1, 1, 3600, '0', '', 'block-Titanium_Themes.php', '1'),
(15, '', 'Honey Pot Protected', '', '', 'l', 5, 1, 3600, '0', '', 'block-Honey_Pot.php', '1'),
(16, '', 'This is exactly how I feel!', '', '', 'c', 2, 0, 3600, '0', '', 'block-Thank_You.php', '1'),
(17, '', 'Portal Menu', '', '', 'l', 0, 1, 3600, '0', '', 'block-Titanium_Portal_Menu.php', '1'),
(18, '', 'Reviews', '', '', 'r', 8, 0, 3600, '0', '', 'block-Reviews.php', '1'),
(19, '', 'Server Information', '', '', 'r', 3, 1, 3600, '0', '', 'block-Portal-Information.php', '1'),
(20, '', 'Visitor Log', '', '', 'c', 1, 1, 3600, '0', '', 'block-Titanium_Visitor_Log_Center.php', '1'),
(25, '', 'Arcade', '', '', 'd', 1, 0, 3600, '0', '', 'block-Titanium_Arcade_Center.php', '1'),
(26, '', 'Visits', '', '', 'l', 7, 1, 3600, '0', '', 'block-Titanium_Total_Hits.php', '1');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
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
(50, 8, 'Administrator', 'Why did we name the CMS PHP-Nuke Titanium?', '2023-01-03 23:33:49', '2023-01-26 20:27:21', '<p><strong>Where did the name PHP-Nuke Titanium come from?</strong></p>\n\n<p>It involves a nuclear waste storage concept...</p>\n\n<p>Because of its corrosion resistance, containers made of titanium have been studied for the long-term storage of nuclear waste. Containers lasting more than 100,000 years are thought possible with manufacturing conditions that minimize material defects. A titanium &quot;drip shield&quot; could also be installed over containers of other types to enhance their longevity.</p>\n\n<p>The original <strong>PHP-Nuke</strong> has been around for 30+ years and we have preserved it in Titanium, <strong>PHP-Nuke Titanium</strong> to be exact...</p>\n\n<p>Because titanium alloys have the high&nbsp;<a href=\"https://en.wikipedia.org/wiki/Tensile_strength\" target=\"_blank\" title=\"Tensile strength\">tensile strength</a>&nbsp;to density ratio, high&nbsp;<a href=\"https://en.wikipedia.org/wiki/Corrosion_resistance\" target=\"_blank\" title=\"Corrosion resistance\">corrosion resistance</a>, fatigue resistance, high crack resistance,&nbsp;and the ability to withstand moderately high temperatures without creeping, they are used in aircraft, armor plating, naval ships, spacecraft, and missiles.</p>\n\n<p>Titanium was&nbsp;<a href=\"https://en.wikipedia.org/wiki/Discovery_of_the_chemical_elements\" target=\"_blank\" title=\"Discovery of the chemical elements\">discovered</a>&nbsp;in 1791 by the&nbsp;<a href=\"https://en.wikipedia.org/wiki/Clergy\" target=\"_blank\" title=\"Clergy\">clergyman</a>&nbsp;and amateur geologist&nbsp;<a href=\"https://en.wikipedia.org/wiki/William_Gregor\" target=\"_blank\" title=\"William Gregor\">William Gregor</a>&nbsp;as an&nbsp;<a href=\"https://en.wikipedia.org/wiki/Inclusion_(mineral)\" target=\"_blank\" title=\"Inclusion (mineral)\">inclusion</a>&nbsp;of a mineral in&nbsp;<a href=\"https://en.wikipedia.org/wiki/Cornwall\" target=\"_blank\" title=\"Cornwall\">Cornwall</a>, Great Britain. Gregor recognized the presence of a new element in ilmenite&nbsp;when he found black sand by a stream and noticed the sand was attracted by a&nbsp;<a href=\"https://en.wikipedia.org/wiki/Magnet\" target=\"_blank\" title=\"Magnet\">magnet</a>. Analyzing the sand, he determined the presence of two metal oxides:&nbsp;<a href=\"https://en.wikipedia.org/wiki/Iron_oxide\" target=\"_blank\" title=\"Iron oxide\">iron oxide</a>&nbsp;(explaining the attraction to the magnet) and 45.25% of a white metallic oxide he could not identify. Realizing that the unidentified oxide contained a metal that did not match any known element, Gregor reported his findings to the&nbsp;<a href=\"https://en.wikipedia.org/wiki/Royal_Geological_Society_of_Cornwall\" target=\"_blank\" title=\"Royal Geological Society of Cornwall\">Royal Geological Society of Cornwall</a>&nbsp;and in the German science journal&nbsp;<a href=\"https://en.wikipedia.org/wiki/Crell%27s_Annalen\" target=\"_blank\" title=\"Crell\'s Annalen\">Crell&#39;s Annalen</a>.</p>\n\n<p>Around the same time,&nbsp;<a href=\"https://en.wikipedia.org/wiki/Franz-Joseph_M%C3%BCller_von_Reichenstein\" target=\"_blank\" title=\"Franz-Joseph MÃ¼ller von Reichenstein\">Franz-Joseph M&uuml;ller von Reichenstein</a>&nbsp;produced a similar substance, but could not identify it. The oxide was independently rediscovered in 1795 by&nbsp;<a href=\"https://en.wikipedia.org/wiki/Prussia\" target=\"_blank\" title=\"Prussia\">Prussian</a>&nbsp;chemist&nbsp;<a href=\"https://en.wikipedia.org/wiki/Martin_Heinrich_Klaproth\" target=\"_blank\" title=\"Martin Heinrich Klaproth\">Martin Heinrich Klaproth</a>&nbsp;in rutile from Boinik (the German name of Bajm&oacute;cska), a village in Hungary (now BojniÄky in Slovakia). Klaproth found that it contained a new element and named it for the&nbsp;<a href=\"https://en.wikipedia.org/wiki/Titan_(mythology)\" target=\"_blank\" title=\"Titan (mythology)\">Titans</a>&nbsp;of&nbsp;<a href=\"https://en.wikipedia.org/wiki/Greek_mythology\" target=\"_blank\" title=\"Greek mythology\">Greek mythology</a>. After hearing about Gregor&#39;s earlier discovery, he obtained a sample of manaccanite and confirmed it to be titanium.</p>\n\n<p>All of this is how we related the idea to name our Fork of <strong>PHP-Nuke</strong>, PHP-Nuke Titanium and the story relates...</p>', '', 0, 68, 4, 'Administrator', '', 0, 'english', 0, 0, 0, 35, 7, '', 0, 1),
(61, 8, 'Administrator', 'About PHP-Nuke Titanium (US Version)', '2023-01-26 20:26:43', '2023-01-26 20:26:43', '<p>The <strong>US</strong> version of<strong> PHP-Nuke Titanium CMS</strong>&nbsp;is an open-source highly modified&nbsp;<strong>Fork</strong> of <strong>PHP-Nuke&nbsp;</strong>written in PHP as a programming language and development was first started in 2005. The software comes with a set of basic features like a WYSIWYG editor, an admin interface with drag-and-drop blocks, spam protection, and image processing. PHP-Nuke Titanium CMS comes with the ability to use various modules that will extend the current functionality of your portal/website. The latest version available for download is 4.0.4 and is still in beta.</p>\n\n<p>[b]NOTE:[/b] Your admin and user accounts have already been logged in for you so please visit [url=admin.php]<u>this link</u>[/url] to get started.</p>\n\n<p>You can edit or remove this blog message by going into the Blog Admin Panel located in the Admin area, or looking below you can edit by clicking the pencil or the x to delete this blog message.</p>\n\n<p>&nbsp;</p>', '', 0, 0, 4, 'Administrator', '', 0, '', 0, 0, 0, 0, 0, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_autoblog`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_cat`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_blogs_cat` (
  `catid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL DEFAULT '',
  `counter` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_blogs_cat`
--

INSERT DELAYED INTO `nuke_blogs_cat` (`catid`, `title`, `counter`) VALUES
(5, 'Server Updates', 209),
(6, 'Module Information', 494),
(7, 'Module Updates', 458),
(8, 'The Daily Blog', 492),
(9, 'Mod Information', 478),
(10, 'Block Information', 490),
(11, 'Block Updates', 0),
(12, 'Mod Updates', 0),
(13, 'Theme Information', 0),
(14, 'Theme Updates', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_comments`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_blogs_comments` (
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `datePublished` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(85) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT 0,
  `reason` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_queue`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_blogs_queue` (
  `qid` smallint(5) UNSIGNED NOT NULL,
  `uid` mediumint(9) NOT NULL DEFAULT 0,
  `uname` varchar(40) NOT NULL DEFAULT '',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `story` text DEFAULT NULL,
  `storyext` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `topic` varchar(20) NOT NULL DEFAULT '',
  `alanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_blogs_topics`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
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

INSERT DELAYED INTO `nuke_blogs_topics` (`topicid`, `topicname`, `topicimage`, `topictext`, `counter`) VALUES
(3, 'contentdeliverynet', 'black_template.png', 'CDN - Content Delivery Networks', 225),
(4, 'the86itTeam', 'black_template.png', 'Open-Source', 262),
(1, 'titanium', 'black_template.png', 'PHP-Nuke Titanium News', 533),
(5, 'modules', 'black_template.png', 'PHP-Nuke Titanium Modules', 285),
(6, 'blocks', 'black_template.png', 'PHP-Nuke Titanium Blocks', 307),
(7, 'mods', 'black_template.png', 'PHP-Nuke Titanium Mods', 197),
(8, 'themes', 'black_template.png', 'PHP-Nuke Titanium Themes', 191),
(9, 'todo', 'black_template.png', 'PHP-Nuke Titanium ToDo List', 10),
(10, 'adminpanels', 'black_template.png', 'PHP-Nuke Titanium Admin Panels', 10);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bookmarks`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bookmarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `url` varchar(256) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00',
  `popup` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bookmarks`
--

INSERT DELAYED INTO `nuke_bookmarks` (`id`, `user_id`, `name`, `category_id`, `url`, `description`, `mod_date`, `popup`) VALUES
(1, 2, 'Foodle Project ABANDONED', 1, 'https://github.com/Uninett/Foodle', 'Dip Shit just gave up!', '2023-01-14', 1),
(2, 2, 'BRIDGE phpBB &amp; WordPress', 1, 'https://github.com/mssti/BRIDGE-phpBB---WordPress', 'phpBB 3.0.9 &lt;-&gt; WordPress 3.2.1', '2023-01-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_bookmarks_cat`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_bookmarks_cat` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_bookmarks_cat`
--

INSERT DELAYED INTO `nuke_bookmarks_cat` (`category_id`, `user_id`, `name`, `description`, `mod_date`) VALUES
(1, 2, 'Abandon Projects', 'Projects To Bring Back To Life', '2023-01-14'),
(2, 2, 'PHP Bridges', 'Online Software Bridges', '2023-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cemetery`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_cemetery` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `url` varchar(256) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00',
  `popup` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cemetery_cat`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_cemetery_cat` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cnbya_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_cnbya_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_cnbya_config`
--

INSERT DELAYED INTO `nuke_cnbya_config` (`config_name`, `config_value`) VALUES
('sendaddmail', '0'),
('senddeletemail', '0'),
('allowuserdelete', '1'),
('allowusertheme', '0'),
('allowuserreg', '0'),
('allowmailchange', '1'),
('emailvalidate', '1'),
('requireadmin', '0'),
('servermail', '0'),
('useactivate', '1'),
('autosuspend', '0'),
('perpage', '100'),
('expiring', '86400'),
('nick_min', '4'),
('nick_max', '20'),
('pass_min', '4'),
('pass_max', '20'),
('bad_mail', 'yoursite.com\nmysite.com'),
('bad_nick', 'adm\nadmin\nanonimo\nanonymous\nannimo\ngod\nlinux\nnobody\noperator\nroot\nstaff\nwebmaster'),
('coppa', '0'),
('tos', '0'),
('tosall', '1'),
('cookiecheck', '1'),
('cookiecleaner', '1'),
('cookietimelife', '2592000'),
('cookiepath', ''),
('cookieinactivity', '-'),
('autosuspendmain', '0'),
('doublecheckemail', '1'),
('version', '4.4.2'),
('tos_text', 'This is your default TOS. You may edit this through the Your Account Admin Panel.');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cnbya_field`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_cnbya_field` (
  `fid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'field',
  `value` varchar(255) DEFAULT NULL,
  `size` int(3) DEFAULT NULL,
  `need` int(1) NOT NULL DEFAULT 1,
  `pos` int(3) DEFAULT NULL,
  `public` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cnbya_value`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_cnbya_value` (
  `vid` int(10) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT 0,
  `fid` int(10) NOT NULL DEFAULT 0,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_cnbya_value_temp`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_cnbya_value_temp` (
  `vid` int(10) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT 0,
  `fid` int(10) NOT NULL DEFAULT 0,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_config` (
  `sitename` varchar(255) NOT NULL DEFAULT '',
  `nukeurl` varchar(255) NOT NULL DEFAULT '',
  `site_logo` varchar(255) NOT NULL DEFAULT '',
  `slogan` varchar(255) NOT NULL DEFAULT '',
  `startdate` varchar(50) NOT NULL DEFAULT '',
  `datePublished` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `cache_data` mediumblob DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_config`
--

INSERT DELAYED INTO `nuke_config` (`sitename`, `nukeurl`, `site_logo`, `slogan`, `startdate`, `datePublished`, `dateModified`, `adminmail`, `anonpost`, `default_Theme`, `foot1`, `foot2`, `foot3`, `commentlimit`, `anonymous`, `minpass`, `pollcomm`, `articlecomm`, `broadcast_msg`, `my_headlines`, `top`, `storyhome`, `user_news`, `oldnum`, `ultramode`, `banners`, `backend_title`, `backend_language`, `language`, `locale`, `multilingual`, `useflags`, `notify`, `notify_email`, `notify_subject`, `notify_message`, `notify_from`, `moderate`, `admingraphic`, `httpref`, `httprefmax`, `CensorMode`, `CensorReplace`, `copyright`, `Version_Num`, `admin_pos`, `admin_log_lines`, `error_log_lines`, `cache_data`) VALUES
('PHP-Nuke Titanium', 'https://www.yoursite.com', 'logo.png', 'It takes a Village or a Savant!', 'January 2023', '2023-01-03 09:05:38', '2023-01-14 12:48:59', 'admin@yoursite.com', 0, 'BlackJack', '', '', '', 4096, 'Anonymous', 5, 1, 1, 1, 1, 5, 5, 1, 30, 1, 1, 'Powered by PHP-Nuke Titanium v4.0.3 / PHP v8.1.14', 'en-us', 'english', 'en_US', 1, 0, 1, 'admin@yoursite.com', 'Blog for yoursite.com', 'Hey! You\'ve got a new blog submission for yoursite.com!', 'Administrator @ yoursite.com', 1, 1, 1, 1000, 3, '*****', '', '4.0.3', 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_confirm`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_confirm` (
  `confirm_id` char(32) NOT NULL DEFAULT '',
  `session_id` char(32) NOT NULL DEFAULT '',
  `code` char(6) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_counter`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_counter` (
  `type` varchar(80) NOT NULL DEFAULT '',
  `var` varchar(80) NOT NULL DEFAULT '',
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_counter`
--

INSERT DELAYED INTO `nuke_counter` (`type`, `var`, `count`) VALUES
('total', 'hits', 0),
('browser', 'Avant', 0),
('browser', 'Camino', 0),
('browser', 'Crazy', 0),
('browser', 'DEVONtech', 0),
('browser', 'Dillo', 0),
('browser', 'Galeon', 0),
('browser', 'ELinks', 0),
('browser', 'Epiphany', 0),
('browser', 'Firefox', 0),
('browser', 'iRider', 0),
('browser', 'K-Meleon', 0),
('browser', 'Konqueror', 0),
('browser', 'Lynx', 0),
('browser', 'Maxthon', 0),
('browser', 'Mozilla', 0),
('browser', 'MSIE', 0),
('browser', 'MultiZilla', 0),
('browser', 'NetCaptor', 0),
('browser', 'Netscape', 0),
('browser', 'OmniWeb', 0),
('browser', 'Opera', 0),
('browser', 'Safari', 0),
('browser', 'Shiira', 0),
('browser', 'Voyager', 0),
('browser', 'w3m', 0),
('browser', 'WAP', 0),
('browser', 'WebWasher', 0),
('browser', 'Bot', 0),
('browser', 'Other', 0),
('os', 'Windows', 0),
('os', 'Linspire', 0),
('os', 'Linux', 0),
('os', 'Mac', 0),
('os', 'FreeBSD', 0),
('os', 'SunOS', 0),
('os', 'IRIX', 0),
('os', 'OS/2', 0),
('os', 'AIX', 0),
('os', 'Other', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_donators`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_donators` (
  `id` int(11) NOT NULL,
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
  `donto` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_donators_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_donators_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_donators_config`
--

INSERT DELAYED INTO `nuke_donators_config` (`config_name`, `config_value`) VALUES
('values', '5,10,25,50,100'),
('block_show_amount', 'yes'),
('block_show_anon_amount', 'yes'),
('block_button_image', 'images/donations/paypal.png'),
('block_num_donations', '10'),
('block_show_dates', 'yes'),
('block_message', 'Find our site useful? Make a small donation to show your support.'),
('block_show_goal', 'no'),
('block_scroll', 'yes'),
('block_numbers', 'no'),
('page_num_donations', '25'),
('page_show_anon_amount', 'yes'),
('page_show_amount', 'yes'),
('page_show_dates', 'no'),
('page_header_image', ''),
('gen_pp_email', ''),
('gen_donation_name', 'Site Donation'),
('gen_donation_code', 'site_donation'),
('gen_button_image', 'images/donations/paypal.png'),
('gen_currency', 'USD'),
('gen_monthly_goal', '50.00'),
('gen_date_format', 'm/d/Y'),
('gen_type_private', 'no'),
('gen_type_anon', 'no'),
('gen_thank_image', ''),
('gen_thank_message', 'Thank you for your kind donation!<br /><br />Please come again!'),
('gen_cancel_image', 'images/logo.png'),
('gen_cancel_message', 'Sorry you could not donate!<br /><br />Please come again!'),
('gen_page_image', 'images/logo.png'),
('gen_message', 'yes'),
('gen_codes', ''),
('gen_cookie', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_ecalendar`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_ecalendar` (
  `eid` int(11) NOT NULL,
  `month` varchar(11) DEFAULT NULL,
  `day` varchar(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `reoccur` int(11) NOT NULL DEFAULT 0,
  `time` varchar(5) DEFAULT NULL,
  `ampm` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_evolution`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_evolution` (
  `evo_field` varchar(50) NOT NULL DEFAULT '',
  `evo_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_evolution`
--

INSERT DELAYED INTO `nuke_evolution` (`evo_field`, `evo_value`) VALUES
('sub', 'Titanium'),
('ver_check', '0'),
('ver_previous', '4.0.3'),
('lock_modules', '0'),
('queries_count', '1'),
('adminssl', '1'),
('poll_random', '0'),
('poll_days', '30'),
('censor_words', 'ass cuntface balllicker shitbag asshole arse bitch bullshit c0ck clit cock crap cum cunt fag faggot fuck fucker fucking fuk fuking motherfucker pussy shit tits twat'),
('censor', '0'),
('usrclearcache', '1'),
('cache_last_cleared', '1674041775'),
('textarea', 'ckeditor'),
('use_colors', '1'),
('usegfxcheck', '7'),
('codesize', '7'),
('iphub_use', '0'),
('useimage', '1'),
('lazy_tap', '0'),
('img_resize', '1'),
('img_width', '300'),
('img_height', '300'),
('capfile', ''),
('module_collapse', '1'),
('collapse', '0'),
('evouserinfo_ec', '1'),
('collapsetype', '1'),
('analytics', ''),
('img_viewer', 'fancybox'),
('html_auth', '1'),
('pm_alert_status', '1'),
('pm_cookie_name', 'jquery_pm_popup'),
('pm_cookie_minutes', '5'),
('pm_cookie_seconds', '1'),
('pm_overlay_color', '#000000'),
('pm_button_color', '#004594'),
('pm_button_color2', '#006de9'),
('pm_alert_sound', '1'),
('admin_fc_status', '0'),
('admin_fc_attempts', '5'),
('admin_fc_timeout', '15'),
('iphub_status', '0'),
('iphub_key', ''),
('iphub_cookietime', '5'),
('recap_color', ''),
('recap_lang', 'en'),
('recap_site_key', ''),
('recap_priv_key', ''),
('block_cachetime', '86400');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_evo_userinfo`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_evo_userinfo` (
  `name` varchar(25) NOT NULL,
  `filename` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_evo_userinfo`
--

INSERT DELAYED INTO `nuke_evo_userinfo` (`name`, `filename`, `active`, `position`, `image`) VALUES
('Good Afternoon', 'good_afternoon', 1, 1, ''),
('Username', 'username', 0, 2, ''),
('Rank', 'rank', 1, 5, ''),
('Login/logout/register', 'login', 1, 9, ''),
('Current Online', 'online', 1, 19, ''),
('PMs', 'pms', 1, 7, ''),
('Users', 'users', 1, 15, ''),
('Most Ever', 'mostever', 1, 17, ''),
('Members', 'members', 1, 11, ''),
('Avatar', 'avatar', 1, 3, ''),
('Personal Message', 'personal_message', 0, 1, ''),
('Language', 'language', 0, 3, ''),
('Posts', 'posts', 1, 13, ''),
('Break', 'Break', 1, 16, ''),
('Break', 'Break', 1, 14, ''),
('Break', 'Break', 1, 12, ''),
('Break', 'Break', 1, 10, ''),
('Break', 'Break', 1, 8, ''),
('Break', 'Break', 1, 6, ''),
('Break', 'Break', 1, 4, ''),
('Break', 'Break', 1, 2, ''),
('Break', 'Break', 1, 18, '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_evo_userinfo_addons`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_evo_userinfo_addons` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_evo_userinfo_addons`
--

INSERT DELAYED INTO `nuke_evo_userinfo_addons` (`name`, `value`) VALUES
('good_afternoon_message', 'Good morning %name%:'),
('personal_message_message', '<div style=\"text-align:center\">Hello %name%, <br />\r\nWelcome to %site%.</div>'),
('username_center', 'yes'),
('online_show_hv', 'no'),
('online_scroll', 'no'),
('online_show_members', 'yes'),
('online_tooltip', 'yes'),
('online_country_flag', 'yes'),
('online_user_level_image', 'yes'),
('rank_show_title', 'no'),
('rank_show_2nd', 'no'),
('rank_show_3rd', 'no'),
('rank_show_4th', 'no'),
('rank_show_5th', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_faqanswer`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_faqanswer` (
  `id` int(25) NOT NULL,
  `id_cat` int(25) NOT NULL DEFAULT 0,
  `question` varchar(255) DEFAULT '',
  `answer` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_faqcategories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_faqcategories` (
  `id_cat` tinyint(3) NOT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `flanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_categories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_file_repository_categories` (
  `cid` int(11) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `permissions` int(11) NOT NULL DEFAULT 0,
  `isallowed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_comments`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_file_repository_comments` (
  `cid` int(11) NOT NULL,
  `did` int(11) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `rating` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
  `user` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_files`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_file_repository_files` (
  `fid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `ftitle` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filesize` int(20) NOT NULL,
  `last_downloaded` datetime NOT NULL DEFAULT '2018-12-12 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_items`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_file_repository_items` (
  `cid` int(11) NOT NULL DEFAULT 0,
  `author` varchar(100) NOT NULL DEFAULT '',
  `author_email` varchar(100) NOT NULL DEFAULT '',
  `author_website` varchar(100) NOT NULL DEFAULT '',
  `color` varchar(7) NOT NULL DEFAULT '',
  `currency` varchar(7) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `description` text DEFAULT NULL,
  `did` int(11) NOT NULL,
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
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_screenshots`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_file_repository_screenshots` (
  `pid` int(11) NOT NULL,
  `did` int(11) NOT NULL DEFAULT 0,
  `filename` varchar(255) NOT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `submitter` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_settings`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_file_repository_settings` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_file_repository_settings`
--

INSERT DELAYED INTO `nuke_file_repository_settings` (`config_name`, `config_value`) VALUES
('uhead', '1'),
('utext', '0'),
('pophits', '250'),
('version', '1.1.0'),
('usegfxcheck', '1'),
('currency', 'GBP'),
('parse_smilies', '1'),
('date_format', 'M jS, Y g:i a'),
('viewer', 'lightboxevo'),
('developer_mode', '1'),
('overview_display', '1'),
('overview_count', '5'),
('most_popular', '50'),
('download_view', '1'),
('adminBypass', '0'),
('users_can_upload', '1'),
('users_file_upload_amount', '2'),
('users_screens_upload_amount', '3'),
('overview_display_areas', 'newdownloads,mostpopular,statistics'),
('show_legend', '0'),
('allowed_file_extensions', '7z,arj,rar,tar.gz,zip,tar,pdf'),
('allowed_image_extensions', 'jpeg,jpg,png,gif'),
('group_allowed_to_upload', '1');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_file_repository_themes`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_file_repository_themes` (
  `theme_name` varchar(255) NOT NULL,
  `cell` int(11) NOT NULL,
  `head` int(11) NOT NULL,
  `per_row` int(11) NOT NULL,
  `show_left` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_file_repository_themes`
--

INSERT DELAYED INTO `nuke_file_repository_themes` (`theme_name`, `cell`, `head`, `per_row`, `show_left`) VALUES
('Inferno', 0, 0, 2, 1),
('Titanium_Core', 0, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_headlines`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_headlines` (
  `hid` int(11) NOT NULL,
  `sitename` varchar(30) NOT NULL DEFAULT '',
  `headlinesurl` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_categories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_hnl_categories` (
  `cid` int(11) NOT NULL,
  `ctitle` varchar(50) NOT NULL DEFAULT '',
  `cdescription` text NOT NULL,
  `cblocklimit` int(4) NOT NULL DEFAULT 10
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_hnl_categories`
--

INSERT DELAYED INTO `nuke_hnl_categories` (`cid`, `ctitle`, `cdescription`, `cblocklimit`) VALUES
(1, '*Unassigned*', 'This is a catch-all category where newsletters can default to or if all other categories are removed.  Do NOT remove this category!  This category of newsletters are only shown to the Admins.  ', 5),
(2, 'Archived Newsletters', 'This category is for newsletter subscribers.', 5),
(3, 'Archived Mass Mails', 'This category is used for mass mails.', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_cfg`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_hnl_cfg` (
  `cfg_nm` varchar(255) NOT NULL DEFAULT '',
  `cfg_val` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_hnl_cfg`
--

INSERT DELAYED INTO `nuke_hnl_cfg` (`cfg_nm`, `cfg_val`) VALUES
('debug_mode', 'ERROR'),
('debug_output', 'DISPLAY'),
('show_blocks', '0'),
('dl_module', 'downloads'),
('blk_lmt', '10'),
('scroll', '0'),
('scroll_height', '180'),
('scroll_amt', '2'),
('scroll_delay', '100'),
('version', '1.3.0'),
('show_hits', '0'),
('show_dates', '0'),
('show_sender', '0'),
('show_categories', '0'),
('nsn_groups', '0'),
('latest_news', '5'),
('latest_downloads', '0'),
('latest_links', '5'),
('latest_forums', '5'),
('latest_reviews', '0'),
('wysiwyg_on', '1'),
('wysiwyg_rows', '30');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_hnl_newsletters`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_hnl_newsletters` (
  `nid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT 1,
  `topic` varchar(100) NOT NULL DEFAULT '',
  `sender` varchar(20) NOT NULL DEFAULT '',
  `filename` varchar(32) NOT NULL DEFAULT '',
  `datesent` date DEFAULT NULL,
  `view` int(1) NOT NULL DEFAULT 0,
  `groups` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_hnl_newsletters`
--

INSERT DELAYED INTO `nuke_hnl_newsletters` (`nid`, `cid`, `topic`, `sender`, `filename`, `datesent`, `view`, `groups`, `hits`) VALUES
(1, 1, 'PREVIEW Newsletter File', 'Admin', 'tmp.php', '2018-12-12', 99, '', 0),
(2, 1, 'Tested Email Temporary File', 'Admin', 'testemail.php', '2018-12-12', 99, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_honeypot`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_honeypot` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `realname` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(60) NOT NULL DEFAULT '',
  `date` varchar(50) NOT NULL DEFAULT '',
  `potnum` varchar(1) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_honeypot_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_honeypot_config` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_honeypot_config`
--

INSERT DELAYED INTO `nuke_honeypot_config` (`usehp`, `botlisting`, `perpage`, `pagenumberpos`, `headcolor`, `rowcolor1`, `rowcolor2`, `pagebgcolor`, `pagebordercolor`, `fontcolor`, `fontcolor2`, `check1`, `check2`, `check3`, `check4`, `check5`, `check6`, `c7opt1`, `c7opt2`, `c7amount`, `c8opt1`, `c8opt2`, `usebsapi`, `c8apikey`, `fs9opt1`, `fs9opt2`, `fs9apikey`, `check3time`, `check4question`, `check4answer`, `usefeedback`, `email`, `version`) VALUES
(1, 1, '30', 2, '#a92828', '#e48600', '#f8ce55', '#f8ce55', '#a92828', '#000000', '#000000', 1, 1, 1, 0, 1, 1, 1, 1, '5', 0, 0, 0, '', 0, 0, '', '30', '', '', 0, 'ernest.bufffington@gmail.com', '2.2');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_image_repository_settings`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_image_repository_settings` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_image_repository_settings`
--

INSERT DELAYED INTO `nuke_image_repository_settings` (`config_name`, `config_value`) VALUES
('alignment', 'left'),
('basedir', 'modules/Image_Repository/files'),
('spacing', '1'),
('image_view', '2'),
('perpage', '20'),
('admin_perpage', '20'),
('lytebox_color', 'black'),
('allow_colorization', '0'),
('thumb_width', '160'),
('thumb_height', '120'),
('jquery_prefix', 'nuke_jq'),
('pagination', '1'),
('max_upload', '6291456'),
('quota', '524288000');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_image_repository_uploads`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_image_repository_uploads` (
  `pid` int(20) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `submitter` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `screensize` varchar(255) DEFAULT NULL,
  `uploaded` int(11) NOT NULL DEFAULT 0,
  `bypass_thumb` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_image_repository_uploads`
--

INSERT DELAYED INTO `nuke_image_repository_uploads` (`pid`, `filename`, `submitter`, `image`, `size`, `screensize`, `uploaded`, `bypass_thumb`) VALUES
(9, 'wbjFQ3JQWv.png', '3', 'wbjFQ3JQWv.png', 46889, '484 x 79', 1674128630, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_image_repository_users`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_image_repository_users` (
  `uid` int(11) NOT NULL,
  `background_color` varchar(20) DEFAULT NULL,
  `border_color` varchar(20) DEFAULT NULL,
  `border_thickness` varchar(3) DEFAULT NULL,
  `folder` int(11) NOT NULL DEFAULT 0,
  `percent_color` varchar(20) DEFAULT NULL,
  `quota` varchar(255) DEFAULT NULL,
  `quota_request` tinyint(2) NOT NULL DEFAULT 0,
  `custom_color` varchar(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_image_repository_users`
--

INSERT DELAYED INTO `nuke_image_repository_users` (`uid`, `background_color`, `border_color`, `border_thickness`, `folder`, `percent_color`, `quota`, `quota_request`, `custom_color`) VALUES
(2, 'firebrick', 'goldenrod', NULL, 10002, 'seagreen', '52428800', 0, ''),
(4, 'white', 'black', NULL, 10004, 'darkorchid', '52428800', 0, NULL),
(6, 'white', 'black', NULL, 10006, 'darkorchid', '52428800', 0, NULL),
(5, 'white', 'black', NULL, 10005, 'darkorchid', '52428800', 0, NULL),
(3, 'white', 'black', NULL, 10003, 'darkorchid', '52428800', 0, NULL),
(11, 'white', 'black', NULL, 10011, 'darkorchid', '52428800', 0, NULL),
(20, 'white', 'black', NULL, 10020, 'darkorchid', '52428800', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_jmap`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_jmap` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_jmap`
--

INSERT DELAYED INTO `nuke_jmap` (`name`, `value`) VALUES
('xml', '1'),
('ntopics', '10000'),
('nnews', '10000'),
('ndown', '100000'),
('nrev', '100000'),
('nuser', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_categories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_links_categories` (
  `cid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_links_categories`
--

INSERT DELAYED INTO `nuke_links_categories` (`cid`, `title`, `cdescription`, `parentid`) VALUES
(13, 'PHP-Nuke Titanium', 'PHP-Nuke Titanium Web Sites', 0),
(14, 'Developer Sites', 'PHP-Nuke Titanium Developer Sites!', 13);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_editorials`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_links_editorials` (
  `linkid` int(11) NOT NULL DEFAULT 0,
  `adminid` varchar(60) NOT NULL DEFAULT '',
  `editorialtimestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_links`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_links_links` (
  `lid` int(11) NOT NULL,
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
  `totalcomments` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_links_links`
--

INSERT DELAYED INTO `nuke_links_links` (`lid`, `cid`, `sid`, `title`, `url`, `description`, `date`, `name`, `email`, `hits`, `submitter`, `linkratingsummary`, `totalvotes`, `totalcomments`) VALUES
(13, 14, 0, 'PHP-Nuke Titanium HQ', 'https://php-nuke-titanium.86it.us/', 'PHP-Nuke Titanium Developer HQ', '2023-01-06 03:50:45', 'Ernest  Buffington', 'ernest.buffington@gmail.com', 3, '', 0.0000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_modrequest`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_links_modrequest` (
  `requestid` int(11) NOT NULL,
  `lid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL DEFAULT '',
  `brokenlink` int(3) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_newlink`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_links_newlink` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `submitter` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_links_votedata`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_links_votedata` (
  `ratingdbid` int(11) NOT NULL,
  `ratinglid` int(11) NOT NULL DEFAULT 0,
  `ratinguser` varchar(60) NOT NULL DEFAULT '',
  `rating` int(11) NOT NULL DEFAULT 0,
  `ratinghostname` varchar(60) NOT NULL DEFAULT '',
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_link_us`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_link_us` (
  `id` int(255) NOT NULL,
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
  `user_ip` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_link_us`
--

INSERT DELAYED INTO `nuke_link_us` (`id`, `site_name`, `site_url`, `site_image`, `site_description`, `site_hits`, `site_status`, `date_added`, `button_type`, `user_id`, `user_name`, `user_email`, `user_ip`) VALUES
(1, 'Headshotdomain', 'https://www.headshotdomain.net', 'images/evo/headshotdomain.gif', '[HSX] is a multi gaming clan that is involved with a bunch of games and our library is always adding new games.<br />\n<br />\nWe are a bunch of people that just like to hang out and have fun playing games.\n\n<p>CoRpSE has a Twitch channel you might want to check out as well, their should be link on his website that will show you where his Twitch channel is and when he is streaming live.</p>', 33, 1, '1542823866', 1, 2, '', '', '82.5.206.228'),
(2, 'Lonestar Modules', 'https://lonestar-modules.com', 'images/evo/lonestarmodules.gif', 'Coding quality Block & Modules for Nuke Evolution Xtreme & Raven Nuke CMS.', 30, 1, '1542823990', 1, 2, 'Administrator', '', '82.5.206.228'),
(3, 'ViZual DeZinez', 'https://vizual-dezinez.86it.us', 'images/evo/vd88x31.gif', 'Web Design and Development. We design and code custom addons, themes, blocks, modules, banners and more.', 36, 1, '1542824042', 1, 2, 'Administrator', '', '82.5.206.228'),
(4, 'Mega Portal', 'http://www.megasportal.co.uk', 'images/evo/megasportal.gif', 'Custom graphic designs and more.', 28, 1, '1542824429', 1, 2, 'Administrator', '', '82.5.206.228'),
(7, 'The 86it Developers Network', 'https://www.86it.us', 'modules/Link_Us/buttons/button.png', 'A Programming Skills Sharing Network', 24, 1, '1661790540', 1, 3, '', '', '47.206.216.196'),
(9, 'PHP-Nuke Titanium Developer Website!', 'https://php-nuke-titanium.86it.us', 'modules/Link_Us/buttons/button.png', 'Developer website for&nbsp; US version of&nbsp;PHP-Nuke Titanium&nbsp;CMS&nbsp;is an open-source highly modified Fork of Nuke-Evolution wrote in PHP as a programming language and development was first started in 2005.\n\n<p>&nbsp;</p>\n\n<div>\n<p><img alt=\"The 86it Developers Network\" src=\"https://php-nuke-titanium.86it.us/images/banners/10.png\" title=\"The 86it Developers Network\" /></p>\n\n<div>&nbsp;</div>\n</div>', 34, 1, '1661797122', 1, 3, '', '', '47.206.216.196'),
(10, 'The Ghost\'s 86it Portal', 'https://theghost.86it.us', 'modules/Link_Us/buttons/button2.png', '', 23, 1, '1661809745', 1, 3, '', '', '47.206.216.196');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_link_us_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_link_us_config` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_link_us_config`
--

INSERT DELAYED INTO `nuke_link_us_config` (`my_image`, `fade_effect`, `marquee`, `marquee_direction`, `marquee_scroll`, `block_height`, `show_clicks`, `button_seperate`, `user_submit`, `button_method`, `button_height`, `button_banner_height`, `button_ressource_height`, `button_width`, `button_banner_width`, `button_ressource_width`, `upload_file`, `button_standard`, `button_banner`, `button_resource`) VALUES
('images/titanium/button.png', 1, 1, 1, 2, 3, 1, 1, 1, 0, 31, 45, 31, 88, 127, 88, 'modules/Link_Us/buttons/', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_main`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_main` (
  `main_module` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_main`
--

INSERT DELAYED INTO `nuke_main` (`main_module`) VALUES
('Blogs');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_menu`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_menu` (
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
  `days` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_menu`
--

INSERT DELAYED INTO `nuke_menu` (`groupmenu`, `name`, `image`, `lien`, `hr`, `bgcolor`, `invisible`, `class`, `bold`, `new`, `days`) VALUES
(1, 'Blogs Menu', 'flourecent_module_page_05.png', '', 'on', '', 0, 'categories', '', '', ''),
(2, 'Community', 'babyblue_module_page_05.png', '', '', '', 0, 'categories', 'on', '', ''),
(3, '86it Community', 'yellow_module_page_05.png', '', '', '', 0, 'categories', 'on', '', ''),
(4, 'Google Tool Box', 'Image1_page_05.png', '', '', '', 0, 'categories', 'on', '', ''),
(5, 'PHP Tool Box', 'babyblue_toolbox_page_05.png', '', '', '', 0, 'categories', 'on', '', ''),
(6, 'CSS Tool Box', 'purple_toolbox_page_05.png', '', '', '', 0, 'categories', 'on', '', ''),
(7, 'Java Tool Box', 'yellow_toolbox_page_05.png', '', '', '', 0, 'categories', 'on', '', ''),
(99, NULL, NULL, NULL, NULL, NULL, 0, 'categories', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_menu_categories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_menu_categories` (
  `id` int(11) NOT NULL,
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
  `days` varchar(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_menu_categories`
--

INSERT DELAYED INTO `nuke_menu_categories` (`id`, `sublevel`, `groupmenu`, `module`, `url`, `url_text`, `image`, `new`, `new_days`, `class`, `bold`, `days`) VALUES
(3584, 0, 1, 'Blogs', '', '', 'tree-greenT.png', '', 3, 'modules', 'on', ''),
(3585, 0, 1, 'Blog_Topics', '', '', 'tree-greenT.png', '', 3, 'modules', 'on', ''),
(3586, 0, 1, 'Blogs_Top', '', '', 'tree-greenT.png', '', 3, 'modules', 'on', ''),
(3587, 0, 1, 'Blog_Archives', '', '', 'tree-greenT.png', '', 3, 'modules', 'on', ''),
(3588, 0, 1, 'Blog_Submit', '', '', 'tree-green-L.png', '', 3, 'modules', 'on', ''),
(3589, 0, 2, 'Forums', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3590, 0, 2, 'Groups', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3591, 0, 2, 'Members_List', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3592, 0, 2, 'File_Repository', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3593, 0, 2, 'Shout_Box', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3594, 0, 2, 'Loan_Amortization', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3595, 0, 2, 'Link_Us', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3596, 0, 2, 'Web_Links', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3597, 0, 2, 'ECalendar', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3598, 0, 2, 'Reviews', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3599, 0, 2, 'Surveys', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3600, 0, 2, 'Statistics', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3601, 0, 2, 'FAQ', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3602, 0, 2, 'Feedback', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3603, 0, 2, 'Recommend_Us', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3604, 0, 2, 'Advertising', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3605, 0, 2, 'Google-Site-Map', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3606, 0, 2, 'Docs', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3607, 0, 2, 'Search', '', '', 'tree-lightblue-L.png', '', 3, 'modules', 'on', ''),
(3608, 0, 3, 'Network', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(3609, 0, 3, 'Network_Projects', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(3610, 0, 3, 'Network_Advertising', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(3611, 0, 3, 'Donations', '', '', 'tree-yellow-L.png', '', 3, 'modules', 'on', ''),
(3612, 0, 4, 'External Link', 'https://www.google.com/webmasters/markup-helper/', 'Markup Helper', 'tree-T.png', '', 3, 'modules', 'on', ''),
(3613, 0, 4, 'External Link', 'https://developers.google.com/youtube/iframe_api_reference', 'YouTube API', 'tree-T.png', '', 3, 'modules', 'on', ''),
(3614, 0, 4, 'External Link', 'https://github.com/googleapis/google-api-php-client', 'api-php-client', 'tree-T.png', '', 3, 'modules', 'on', ''),
(3615, 0, 4, 'External Link', 'https://www.google.com/recaptcha/admin', 'reCAPTCHA', 'tree-T.png', '', 3, 'modules', 'on', ''),
(3616, 0, 4, 'External Link', 'https://google.dev/', 'Dev Profile', 'tree-L.png', '', 3, 'modules', 'on', ''),
(3617, 0, 5, 'HTML_to_PHP', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3618, 0, 5, 'Titanium_SandBox', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(3619, 0, 5, 'External Link', 'https://codecollab.io/app', 'CodeCollab', 'tree-lightblue-L.png', '', 3, 'modules', 'on', ''),
(3620, 0, 6, 'External Link', 'https://codepen.io/ProfessorSamoff/pen/QQrPPy', 'RealTime CSS', 'tree-pinkT.png', '', 3, 'modules', 'on', ''),
(3621, 0, 6, 'CSS_Reference', '', '', 'tree-pinkT.png', '', 3, 'modules', 'on', ''),
(3622, 0, 6, 'CSS_Color_Chart', '', '', 'tree-pink-L.png', '', 3, 'modules', 'on', ''),
(3623, 0, 7, 'External Link', 'https://codecollab.io/', 'CodeCallab', 'tree-yellow-L.png', '', 3, 'modules', 'on', '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_message`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_message` (
  `mid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `date` varchar(14) NOT NULL DEFAULT '',
  `expire` int(7) NOT NULL DEFAULT 0,
  `active` int(1) NOT NULL DEFAULT 1,
  `view` int(1) NOT NULL DEFAULT 1,
  `groups` text NOT NULL,
  `mlanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_message`
--

INSERT DELAYED INTO `nuke_message` (`mid`, `title`, `content`, `date`, `expire`, `active`, `view`, `groups`, `mlanguage`) VALUES
(2, 'PHP-Nuke Titanium Distro Information', '<p align=\"center\"><strong>\r\n<font size=\"5\">PHP-Nuke Titanium CMS<br>\r\n</font>\r\n<font size=\"2\">Advanced Content Management<br>\r\n</font>&nbsp;</strong></p>\r\n<p align=\"left\">\r\nThe&nbsp;<strong>US</strong>&nbsp;version of<strong>&nbsp;PHP-Nuke Titanium&nbsp;</strong><b>CMS</b>&nbsp;is \r\nan open-source highly modified&nbsp;<strong>Fork</strong>&nbsp;of&nbsp;<strong>Nuke-Evolution</strong>&nbsp;written \r\nin&nbsp;<strong>PHP</strong>&nbsp;as a programming language and development was first \r\nstarted in 2005. The software comes with a set of basic and advanced features \r\nlike a&nbsp;<strong>WYSIWYG</strong>&nbsp;editor, an admin interface with drag and drop \r\nblocks, spam protection, and image processing.&nbsp;<strong>PHP-Nuke Titanium</strong>&nbsp;<b>CMS</b> \r\nalso \r\ncomes with the ability to use various modules that will extend the current \r\nfunctionality of your portal/website. The latest version available for download \r\nis 4.0.0b and is still in Beta.<br>\r\n<br>\r\n<strong>PHP-Nuke Titanium</strong>&nbsp;now comes with v5 of the Titanium Facebook \r\nSDK kit. It\'s already set up. All you have to do is add your app ID and \r\nsecret. You can disable Facebook anytime if you like, by default it is disabled \r\nuntil you add your app ID and secret...<br>\r\n<br>\r\nIf you need help, we would be glad to set it up for FREE. We normally setup \r\nyour FREE portal and install and configure PHP-Nuke Titanium for you at the same \r\ntime. All you have to do, is send a private message to TheGhost asking for a \r\nportal setup.<br>\r\n<br>\r\nVisit \r\nthe\r\n<a href=\"https://www.php-nuke-titanium.86it.us/index.php\" target=\"_blank\" data-cke-saved-href=\"https://www.php-nuke-titanium.86it.us/index.php\">\r\nPHP-Nuke Titanium Website</a> Today and sign up!\r\n<a href=\"https://www.php-nuke-titanium.86it.us/index.php\" target=\"_blank\" data-cke-saved-href=\"https://www.php-nuke-titanium.86it.us/index.php\">\r\nCLICK HERE</a><br>\r\n<br>\r\n<div align=\"center\">\r\n<strong><font size=\"5\">PHP-Nuke Titanium CMS Features<br>\r\n</font></strong>\r\n<a href=\"https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4\" target=\"_blank\" data-cke-saved-href=\"https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4\">\r\nDownload PHP-Nuke Titanium Today!</a> It comes with an easy to use PHP \r\ninstaller.\r\n<a href=\"https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4\" target=\"_blank\" data-cke-saved-href=\"https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4\">\r\nCLICK HERE TO DOWNLOAD</a><b><br>\r\n&nbsp;</b></p>\r\n	<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" width=\"661\" height=\"383\" bgcolor=\"#666666\" style=\"border:2px groove #C0C0C0; padding:1px; \" class=\"features\" id=\"f1\">\r\n	<!-- MSTableType=\"nolayout\" -->\r\n	<tr>\r\n		<td valign=\"top\" height=\"249\" width=\"315\">\r\n		<!-- MSCellType=\"ContentBody\" -->\r\n		<ul>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">\r\n	Forums</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Private Messages</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Adv Google Site Map</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Recommend Site</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Virtual Cemetery</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Group Ctrl For Entire Site</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Advertising</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Network Advertising</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Link Back System</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Bookmark Vault</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Image Hosting</font></strong></font></font><b><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font></b>\r\n	<font><li><font face=\"Arial Black\" size=\"4\"><strong>Donations</strong></font></font></li>\r\n		</ul>\r\n		</td>\r\n		<td valign=\"top\" height=\"249\" width=\"342\">\r\n		<!-- MSCellType=\"ContentBody\" -->\r\n		<ul>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Blogs Area</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Web Links</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Download Area</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Feedback</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Frequently \r\n	Asked Questions</font></strong></font></font><font size=\"4\" face=\"Arial Black\">\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Network Projects</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Website Disclaimer</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Network Disclaimer</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Loan Aromatization</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">User Theme Selection</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\"><strong><font size=\"4\">Nuke Sentinel Security</font></strong></font></font><font size=\"4\" face=\"Arial Black\"></li>\r\n	</font>\r\n	<font><li><font face=\"Arial Black\" size=\"4\"><strong>Statistics</strong></font></font></li>\r\n		</ul>\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td height=\"50\" width=\"657\" colspan=\"2\" align=\"center\">\r\n		<!-- MSCellType=\"ContentBody\" -->\r\n		<font face=\"Arial Black\" size=\"2\" >Ask us about </font>\r\n		<font face=\"Arial Black\" size=\"2\" color=\"#00FF00\">FREE WEB HOSTING</font><font face=\"Arial Black\" size=\"2\" > \r\n		for<br>\r\n		Beta Testers and Developers...</font></td>\r\n	</tr>\r\n</table>\r\n</div>\r\n<br />\r\n', '1661704546', 0, 1, 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_meta`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_meta` (
  `meta_name` varchar(50) NOT NULL DEFAULT '',
  `meta_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_meta`
--

INSERT DELAYED INTO `nuke_meta` (`meta_name`, `meta_content`) VALUES
('resource-type', 'document'),
('distribution', 'global'),
('author', 'Ernest Allen Buffington'),
('copyright', 'Copyright (c) Brandon Maintenance Management'),
('keywords', 'blog, php, php81, php8, cms, forum, php-fpm, phpbb2, forum-site, downloads, forum-application, mysqli-database, theme-ui, php-nuke-titanium, php-nuke, nuke-evolution, nuke-titanium, phpnuke, php-nuke-evolution-xtreme, php-nuke-evolution'),
('description', 'PHP-Nuke Titanium v4.0.3 / PHP v8.1.13'),
('robots', 'index, follow'),
('revisit-after', '1 days'),
('rating', 'general');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_modules`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_modules` (
  `mid` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `custom_title` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `view` tinyint(4) NOT NULL DEFAULT 0,
  `inmenu` tinyint(4) NOT NULL DEFAULT 1,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `cat_id` tinyint(4) NOT NULL DEFAULT 0,
  `blocks` tinyint(4) NOT NULL DEFAULT 1,
  `admins` varchar(255) NOT NULL DEFAULT '',
  `groups` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_modules`
--

INSERT DELAYED INTO `nuke_modules` (`mid`, `title`, `custom_title`, `active`, `view`, `inmenu`, `pos`, `cat_id`, `blocks`, `admins`, `groups`) VALUES
(1, 'Forums', 'Forums', 1, 1, 1, 3, 3, 0, '', 'Array'),
(2, 'File_Repository', 'File Repository', 1, 6, 1, 0, 5, 3, '', '3'),
(3, 'Your_Account', 'Your Account', 1, 0, 1, 3, 2, 3, '', 'Array'),
(4, 'Shout_Box', 'Shout Box', 1, 1, 1, 5, 3, 3, '', 'Array'),
(5, 'Advertising', 'Advertising', 1, 1, 1, 22, 7, 3, '', 'Array'),
(6, 'ECalendar', 'ECalendar', 1, 1, 1, 21, 7, 3, '', 'Array'),
(8, 'Docs', 'Disclaimer', 1, 1, 1, 23, 7, 3, '', 'Array'),
(9, 'Donations', 'Donations', 1, 1, 1, 1, 3, 3, '', 'Array'),
(10, 'Evo_UserBlock', 'Evo UserBlock', 1, 0, 1, 27, 7, 1, '', ''),
(11, 'FAQ', 'FAQ', 1, 6, 1, 26, 7, 3, '', '3'),
(12, 'Feedback', 'Feedback', 1, 6, 1, 2, 3, 3, '', '3'),
(13, 'Groups', 'Member Groups', 1, 6, 1, 4, 3, 3, '', '3'),
(14, 'HTML_Newsletter', 'HTML Newsletter', 1, 6, 1, 25, 7, 3, '', '4'),
(15, 'Link_Us', 'Link Us', 1, 1, 1, 24, 7, 3, '', 'Array'),
(16, 'Members_List', 'Members List', 1, 1, 1, 0, 2, 3, '', 'Array'),
(18, 'NukeSentinel', 'NukeSentinel', 1, 6, 1, 20, 7, 3, '', '4'),
(19, 'Private_Messages', 'Private Messages', 1, 3, 1, 2, 2, 3, '', 'Array'),
(20, 'Profile', 'Profile', 1, 0, 1, 1, 2, 3, '', 'Array'),
(21, 'Recommend_Us', 'Recommend Us', 1, 1, 1, 17, 7, 3, '', 'Array'),
(22, 'Reviews', 'Reviews', 1, 6, 1, 16, 7, 3, '', '4'),
(23, 'Search', 'Search', 1, 1, 1, 15, 7, 3, '', 'Array'),
(25, 'Spambot_Killer', 'Spambot Killer', 1, 1, 1, 14, 7, 3, '', 'Array'),
(26, 'Statistics', 'Statistics', 1, 1, 1, 18, 7, 3, '', 'Array'),
(30, 'Surveys', 'Surveys', 1, 1, 1, 19, 7, 3, '', 'Array'),
(33, 'Web_Links', 'Web Links', 1, 1, 1, 1, 5, 3, '', 'Array'),
(34, 'Image_Repository', 'Image Repository', 1, 3, 1, 0, 7, 3, '', 'Array'),
(39, 'Blog_Submit', 'Blog Submit', 1, 3, 1, 4, 7, 3, '', ''),
(41, 'Blog_Topics', 'Blog Topics', 1, 1, 1, 6, 7, 3, '', 'Array'),
(45, 'Network', 'Network Disclaimer', 1, 1, 1, 8, 7, 3, '', 'Array'),
(48, 'cPanel_Login', 'cPanel Login', 1, 6, 1, 10, 7, 3, '', '5'),
(51, 'Google-Site-Map', 'Google Site Map', 1, 1, 1, 11, 7, 3, '', 'Array'),
(52, 'Network_Advertising', 'Network Advertising', 1, 1, 1, 12, 7, 3, '', 'Array'),
(14713, 'CSS_Color_Chart', 'CSS Color Chart', 1, 6, 1, 0, 7, 3, '', '4'),
(14714, 'CSS_Reference', 'CSS Reference', 1, 6, 1, 0, 7, 3, '', '4'),
(14717, 'Proof_Of_God', 'Proof Of God', 1, 6, 1, 0, 7, 3, '', '4'),
(14718, 'Titanium_SandBox', 'Titanium SandBox', 1, 1, 1, 0, 7, 0, '', 'Array'),
(14836, 'Arcade_Tweaks', 'Arcade Tweaks', 1, 6, 1, 0, 7, 3, '', '4'),
(14838, 'HTML_to_PHP', 'HTML to PHP', 1, 6, 1, 0, 7, 3, '', '4'),
(14841, 'Bookmarks', 'Bookmarks', 1, 1, 1, 0, 7, 3, '', 'Array'),
(14842, 'Cemetery', 'Cemetery', 1, 1, 1, 0, 7, 3, '', 'Array'),
(14843, 'Loan_Amortization', 'Loan Amortization', 1, 1, 1, 0, 7, 3, '', 'Array'),
(14844, 'Network_Projects', 'Network Projects', 1, 1, 1, 0, 7, 3, '', 'Array'),
(14852, 'My_Forum_Topics', 'My Forum Topics', 1, 1, 1, 0, 7, 3, '', 'Array'),
(15501, 'Blog_Archives', 'Blog Archives', 1, 1, 1, 0, 0, 3, '', 'Array'),
(15502, 'Blogs', 'Blogs', 1, 0, 1, 0, 0, 3, '', 'Array'),
(15503, 'Blogs_Top', 'Blogs Top 10', 1, 1, 1, 0, 0, 3, '', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_modules_cat`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_modules_cat` (
  `cid` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` text NOT NULL,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `link_type` tinyint(4) NOT NULL DEFAULT 0,
  `link` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_modules_cat`
--

INSERT DELAYED INTO `nuke_modules_cat` (`cid`, `name`, `image`, `pos`, `link_type`, `link`) VALUES
(1, 'Home', 'home.png', 0, 2, 'index.php'),
(2, 'Members', 'members.png', 1, 0, ''),
(3, 'Community', 'community.png', 2, 0, ''),
(4, 'Statistics', 'poll.png', 3, 0, ''),
(5, 'Files &amp; Links', 'web.png', 4, 0, ''),
(6, 'News', 'news.png', 5, 0, ''),
(7, 'Other', 'general.png', 6, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_modules_links`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_modules_links` (
  `lid` int(10) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `link_type` tinyint(4) NOT NULL DEFAULT 0,
  `link` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `view` tinyint(4) NOT NULL DEFAULT 0,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `cat_id` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_modules_links`
--

INSERT DELAYED INTO `nuke_modules_links` (`lid`, `title`, `link_type`, `link`, `active`, `view`, `pos`, `cat_id`) VALUES
(2, 'Home', 1, 'index.php', 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_mostonline`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_mostonline` (
  `total` int(10) NOT NULL DEFAULT 0,
  `members` int(10) NOT NULL DEFAULT 0,
  `nonmembers` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_mostonline`
--

INSERT DELAYED INTO `nuke_mostonline` (`total`, `members`, `nonmembers`) VALUES
(3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsncb_blocks`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsncb_blocks` (
  `rid` tinyint(2) NOT NULL DEFAULT 0,
  `cgid` tinyint(2) NOT NULL DEFAULT 0,
  `cbid` tinyint(2) NOT NULL DEFAULT 0,
  `title` varchar(60) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `wtype` tinyint(1) NOT NULL DEFAULT 0,
  `width` smallint(6) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsncb_blocks`
--

INSERT DELAYED INTO `nuke_nsncb_blocks` (`rid`, `cgid`, `cbid`, `title`, `filename`, `content`, `wtype`, `width`) VALUES
(1, 1, 1, 'Place Holder', '', 'This is only a place holder', 1, 25),
(2, 1, 2, 'Place Holder', '', 'This is only a place holder', 1, 25),
(3, 1, 3, 'Place Holder', '', 'This is only a place holder', 1, 25),
(4, 1, 4, 'Place Holder', '', 'This is only a place holder', 1, 25),
(5, 2, 1, 'Place Holder', '', 'This is only a place holder', 1, 25),
(6, 2, 2, 'Place Holder', '', 'This is only a place holder', 1, 25),
(7, 2, 3, 'Place Holder', '', 'This is only a place holder', 1, 25),
(8, 2, 4, 'Place Holder', '', 'This is only a place holder', 1, 25),
(9, 3, 1, 'Place Holder', '', 'This is only a place holder', 1, 25),
(10, 3, 2, 'Place Holder', '', 'This is only a place holder', 1, 25),
(11, 3, 3, 'Place Holder', '', 'This is only a place holder', 1, 25),
(12, 3, 4, 'Place Holder', '', 'This is only a place holder', 1, 25),
(13, 4, 1, 'Place Holder', '', 'This is only a place holder', 1, 25),
(14, 4, 2, 'Place Holder', '', 'This is only a place holder', 1, 25),
(15, 4, 3, 'Place Holder', '', 'This is only a place holder', 1, 25),
(16, 4, 4, 'Place Holder', '', 'This is only a place holder', 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsncb_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsncb_config` (
  `cgid` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `height` smallint(6) NOT NULL,
  `count` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsncb_config`
--

INSERT DELAYED INTO `nuke_nsncb_config` (`cgid`, `enabled`, `height`, `count`) VALUES
(1, 0, 0, 0),
(2, 0, 0, 0),
(3, 0, 0, 0),
(4, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnne_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnne_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsnne_config`
--

INSERT DELAYED INTO `nuke_nsnne_config` (`config_name`, `config_value`) VALUES
('columns', '0'),
('readmore', '0'),
('texttype', '0'),
('notifyauth', '1'),
('homenumber', '0'),
('hometopic', '0'),
('version_number', '1.1.6');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnsp_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnsp_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsnsp_config`
--

INSERT DELAYED INTO `nuke_nsnsp_config` (`config_name`, `config_value`) VALUES
('require_user', '1'),
('image_type', '0'),
('max_width', '88'),
('max_height', '31'),
('version_number', '1.3.0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnsp_sites`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnsp_sites` (
  `site_id` int(11) NOT NULL,
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
  `user_ip` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_admins`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_admins` (
  `aid` varchar(25) NOT NULL DEFAULT '',
  `login` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `password_md5` varchar(60) NOT NULL DEFAULT '',
  `password_crypt` varchar(60) NOT NULL DEFAULT '',
  `protected` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blocked_ips`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_blocked_ips` (
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
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blocked_ranges`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_blocked_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `reason` tinyint(1) NOT NULL DEFAULT 0,
  `expires` int(20) NOT NULL DEFAULT 0,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_blockers`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_blockers` (
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
  `list` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsnst_blockers`
--

INSERT DELAYED INTO `nuke_nsnst_blockers` (`blocker`, `block_name`, `activate`, `block_type`, `email_lookup`, `forward`, `reason`, `template`, `duration`, `htaccess`, `list`) VALUES
(0, 'other', 0, 0, 0, '', 'Abuse-Other', 'abuse_default.tpl', 0, 0, ''),
(1, 'union', 5, 0, 2, '', 'Abuse-Union', 'abuse_union.tpl', 0, 0, ''),
(2, 'clike', 5, 0, 2, '', 'Abuse-CLike', 'abuse_clike.tpl', 0, 0, ''),
(3, 'harvester', 0, 0, 0, '', 'Abuse-Harvest', 'abuse_harvester.tpl', 0, 0, '@yahoo.com\r\nalexibot\r\nalligator\r\nanonymiz\r\nasterias\r\nbackdoorbot\r\nblack hole\r\nblackwidow\r\nblowfish\r\nbotalot\r\nbuiltbottough\r\nbullseye\r\nbunnyslippers\r\ncatch\r\ncegbfeieh\r\ncharon\r\ncheesebot\r\ncherrypicker\r\nchinaclaw\r\ncombine\r\ncopyrightcheck\r\ncosmos\r\ncrescent\r\ncurl\r\ndbrowse\r\ndisco\r\ndittospyder\r\ndlman\r\ndnloadmage\r\ndownload\r\ndreampassport\r\ndts agent\r\necatch\r\neirgrabber\r\nerocrawler\r\nexpress webpictures\r\nextractorpro\r\neyenetie\r\nfantombrowser\r\nfantomcrew browser\r\nfileheap\r\nfilehound\r\nflashget\r\nfoobot\r\nfranklin locator\r\nfreshdownload\r\nfscrawler\r\ngamespy_arcade\r\ngetbot\r\ngetright\r\ngetweb\r\ngo!zilla\r\ngo-ahead-got-it\r\ngrab\r\ngrafula\r\ngsa-crawler\r\nharvest\r\nhloader\r\nhmview\r\nhttplib\r\nhttpresume\r\nhttrack\r\nhumanlinks\r\nigetter\r\nimage stripper\r\nimage sucker\r\nindustry program\r\nindy library\r\ninfonavirobot\r\ninstallshield digitalwizard\r\nINTerget\r\niria\r\nirvine\r\niupui research bot\r\njbh agent\r\njennybot\r\njetcar\r\njobo\r\njoc\r\nkapere\r\nkenjin spider\r\nkeyword density\r\nlarbin\r\nleechftp\r\nleechget\r\nlexibot\r\nlibweb/clshttp\r\nlibwww-perl\r\nlightningdownload\r\nlincoln state web browser\r\nlinkextractorpro\r\nlinkscan/8.1a.unix\r\nlinkwalker\r\nlwp-trivial\r\nlwp::simple\r\nmac finder\r\nmata hari\r\nmediasearch\r\nmetaproducts\r\nmicrosoft url control\r\nmidown tool\r\nmiixpc\r\nmissauga locate\r\nmissouri college browse\r\nmister pix\r\nmoget\r\nmozilla.*newt\r\nmozilla/3.0 (compatible)\r\nmozilla/3.mozilla/2.01\r\nmsie 4.0 (win95)\r\nmultiblocker browser\r\nmydaemon\r\nmygetright\r\nnabot\r\nnavroad\r\nnearsite\r\nnet vampire\r\nnetants\r\nnetmechanic\r\nnetpumper\r\nnetspider\r\nnewsearchengine\r\nnicerspro\r\nninja\r\nnitro downloader\r\nnpbot\r\noctopus\r\noffline explorer\r\noffline navigator\r\nopenfind\r\npagegrabber\r\npapa foto\r\npavuk\r\npbrowse\r\npcbrowser\r\npeval\r\npompos/\r\nprogram shareware\r\npropowerbot\r\nprowebwalker\r\npsurf\r\npuf\r\npuxarapido\r\nqueryn metasearch\r\nrealdownload\r\nreget\r\nrepomonkey\r\nrsurf\r\nrumours-agent\r\nsakura\r\nscan4mail\r\nsemanticdiscovery\r\nsitesnagger\r\nslysearch\r\nspankbot\r\nspanner \r\nspiderzilla\r\nsq webscanner\r\nstamina\r\nstar downloader\r\nsteeler\r\nsteeler\r\nstrip\r\nsuperbot\r\nsuperhttp\r\nsurfbot\r\nsuzuran\r\nswbot\r\nszukacz\r\ntakeout\r\nteleport\r\ntelesoft\r\ntest spider\r\nthe INTraformant\r\nthenomad\r\ntighttwatbot\r\ntitan\r\ntocrawl/urldispatcher\r\ntrue_robot\r\ntsurf\r\nturing machine\r\nturingos\r\nurlblaze\r\nurlgetfile\r\nurly warning\r\nutilmind\r\nvci\r\nvoideye\r\nweb image collector\r\nweb sucker\r\nwebauto\r\nwebbandit\r\nwebcapture\r\nwebcollage\r\nwebcopier\r\nwebenhancer\r\nwebfetch\r\nwebgo\r\nwebleacher\r\nwebmasterworldforumbot\r\nwebql\r\nwebreaper\r\nwebsite extractor\r\nwebsite quester\r\nwebster\r\nwebstripper\r\nwebwhacker\r\nwep search\r\nwget\r\nwhizbang\r\nwidow\r\nwildsoft surfer\r\nwww-collector-e\r\nwww.netwu.com\r\nwwwoffle\r\nxaldon\r\nxenu\r\nzeus\r\nziggy\r\nzippy'),
(4, 'script', 5, 0, 2, '', 'Abuse-Script', 'abuse_script.tpl', 0, 0, ''),
(5, 'author', 5, 0, 2, '', 'Abuse-Author', 'abuse_author.tpl', 0, 0, ''),
(6, 'referer', 5, 0, 2, '', 'Abuse-Referer', 'abuse_referer.tpl', 0, 0, '121hr.com\r\n1st-call.net\r\n1stcool.com\r\n5000n.com\r\n69-xxx.com\r\n9irl.com\r\n9uy.com\r\na-day-at-the-party.com\r\naccessthepeace.com\r\nadult-model-nude-pictures.com\r\nadult-sex-toys-free-porn.com\r\nagnitum.com\r\nalfonssackpfeiffe.com\r\nalongwayfrommars.com\r\nanime-sex-1.com\r\nanorex-sf-stimulant-free.com\r\nantibot.net\r\nantique-tokiwa.com\r\napotheke-heute.com\r\narmada31.com\r\nartark.com\r\nartlilei.com\r\nascendbtg.com\r\naschalaecheck.com\r\nasian-sex-free-sex.com\r\naslowspeeker.com\r\nassasinatedfrogs.com\r\nathirst-for-tranquillity.net\r\naubonpanier.com\r\navalonumc.com\r\nayingba.com\r\nbayofnoreturn.com\r\nbbw4phonesex.com\r\nbeersarenotfree.com\r\nbierikiuetsch.com\r\nbilingualannouncements.com\r\nblack-pussy-toon-clip-anal-lover-single.com\r\nblownapart.com\r\nblueroutes.com\r\nboasex.com\r\nbooksandpages.com\r\nbootyquake.com\r\nbossyhunter.com\r\nboyz-sex.com\r\nbrokersaandpokers.com\r\nbrowserwindowcleaner.com\r\nbudobytes.com\r\nbusiness2fun.com\r\nbuymyshitz.com\r\nbyuntaesex.com\r\ncaniputsomeloveINToyou.com\r\ncartoons.net.ru\r\ncaverunsailing.com\r\ncertainhealth.com\r\nclantea.com\r\nclose-protection-services.com\r\nclubcanino.com\r\nclubstic.com\r\ncobrakai-skf.com\r\ncollegefucktour.co.uk\r\ncommanderspank.com\r\ncoolenabled.com\r\ncrusecountryart.com\r\ncrusingforsex.co.uk\r\ncunt-twat-pussy-juice-clit-licking.com\r\ncustomerhandshaker.com\r\ncyborgrama.com\r\ndarkprofits.co.uk\r\ndatingforme.co.uk\r\ndatingmind.com\r\ndegree.org.ru\r\ndelorentos.com\r\ndiggydigger.com\r\ndinkydonkyaussie.com\r\ndjpritchard.com\r\ndjtop.com\r\ndraufgeschissen.com\r\ndreamerteens.co.uk\r\nebonyarchives.co.uk\r\nebonyplaya.co.uk\r\necobuilder2000.com\r\nemailandemail.com\r\nemedici.net\r\nengine-on-fire.com\r\nerocity.co.uk\r\nesport3.com\r\neteenbabes.com\r\neurofreepages.com\r\neurotexans.com\r\nevolucionweb.com\r\nfakoli.com\r\nfe4ba.com\r\nferienschweden.com\r\nfindly.com\r\nfirsttimeteadrinker.com\r\nfishing.net.ru\r\nflatwonkers.com\r\nflowershopentertainment.com\r\nflymario.com\r\nfree-xxx-pictures-porno-gallery.com\r\nfreebestporn.com\r\nfreefuckingmovies.co.uk\r\nfreexxxstuff.co.uk\r\nfruitologist.net\r\nfruitsandbolts.com\r\nfuck-cumshots-free-midget-movie-clips.com\r\nfuck-michaelmoore.com\r\nfundacep.com\r\ngadless.com\r\ngallapagosrangers.com\r\ngalleries4free.co.uk\r\ngalofu.com\r\ngaypixpost.co.uk\r\ngeomasti.com\r\ngirltime.co.uk\r\nglassrope.com\r\ngodjustblessyouall.com\r\ngoldenageresort.com\r\ngonnabedaddies.com\r\ngranadasexi.com\r\ngranadasexi.com\r\nguardingtheangels.com\r\nguyprofiles.co.uk\r\nhappy1225.com\r\nhappychappywacky.com\r\nhealth.org.ru\r\nhexplas.com\r\nhighheelsmodels4fun.com\r\nhillsweb.com\r\nhiptuner.com\r\nhistoryINTospace.com\r\nhoa-tuoi.com\r\nhomebuyinginatlanta.com\r\nhorizonultra.com\r\nhorseminiature.net\r\nhotkiss.co.uk\r\nhotlivegirls.co.uk\r\nhotmatchup.co.uk\r\nhusler.co.uk\r\niaentertainment.com\r\niamnotsomeone.com\r\niconsofcorruption.com\r\nihavenotrustinyou.com\r\ninformat-systems.com\r\nINTeriorproshop.com\r\nINTersoftnetworks.com\r\nINThecrib.com\r\ninvestment4cashiers.com\r\niti-trailers.com\r\njackpot-hacker.com\r\njacks-world.com\r\njamesthesailorbasher.com\r\njesuislemonds.com\r\njustanotherdomainname.com\r\nkampelicka.com\r\nkanalrattenarsch.com\r\nkatzasher.com\r\nkerosinjunkie.com\r\nkillasvideo.com\r\nkoenigspisser.com\r\nkontorpara.com\r\nl8t.com\r\nlaestacion101.com\r\nlambuschlamppen.com\r\nlankasex.co.uk\r\nlaser-creations.com\r\nle-tour-du-monde.com\r\nlecraft.com\r\nledo-design.com\r\nleftregistration.com\r\nlekkikoomastas.com\r\nlepommeau.com\r\nlibr-animal.com\r\nlibraries.org.ru\r\nlikewaterlikewind.com\r\nlimbojumpers.com\r\nlink.ru\r\nlockportlinks.com\r\nloiproject.com\r\nlongtermalternatives.com\r\nlottoeco.com\r\nlucalozzi.com\r\nmaki-e-pens.com\r\nmalepayperview.co.uk\r\nmangaxoxo.com\r\nmaps.org.ru\r\nmarcofields.com\r\nmasterofcheese.com\r\nmasteroftheblasterhill.com\r\nmastheadwankers.com\r\nmegafrontier.com\r\nmeinschuppen.com\r\nmercurybar.com\r\nmetapannas.com\r\nmicelebre.com\r\nmidnightlaundries.com\r\nmikeapartment.co.uk\r\nmillenniumchorus.com\r\nmimundial2002.com\r\nminiaturegallerymm.com\r\nmixtaperadio.com\r\nmondialcoral.com\r\nmonja-wakamatsu.com\r\nmonstermonkey.net\r\nmouthfreshners.com\r\nmullensholiday.com\r\nmusilo.com\r\nmyhollowlog.com\r\nmyhomephonenumber.com\r\nmykeyboardisbroken.com\r\nmysofia.net\r\nnaked-cheaters.com\r\nnaked-old-women.com\r\nnastygirls.co.uk\r\nnationclan.net\r\nnatterratter.com\r\nnaughtyadam.com\r\nnestbeschmutzer.com\r\nnetwu.com\r\nnewrealeaseonline.com\r\nnewrealeasesonline.com\r\nnextfrontiersonline.com\r\nnikostaxi.com\r\nnotorious7.com\r\nnrecruiter.com\r\nnursingdepot.com\r\nnustramosse.com\r\nnuturalhicks.com\r\noccaz-auto49.com\r\nocean-db.net\r\noilburnerservice.net\r\nomburo.com\r\noneoz.com\r\nonepageahead.net\r\nonlinewithaline.com\r\norganizate.net\r\nourownweddingsong.com\r\nowen-music.com\r\np-partners.com\r\npaginadeautor.com\r\npakistandutyfree.com\r\npamanderson.co.uk\r\nparentsense.net\r\nparticlewave.net\r\npay-clic.com\r\npay4link.net\r\npcisp.com\r\npersist-pharma.com\r\npeteband.com\r\npetplusindia.com\r\npickabbw.co.uk\r\npicture-oral-position-lesbian.com\r\npl8again.com\r\nplaneting.net\r\npopusky.com\r\nporn-expert.com\r\npromoblitza.com\r\nproproducts-usa.com\r\nptcgzone.com\r\nptporn.com\r\npublishmybong.com\r\nputtingtogether.com\r\nqualifiedcancelations.com\r\nrahost.com\r\nrainbow21.com\r\nrakkashakka.com\r\nrandomfeeding.com\r\nrape-art.com\r\nrd-brains.com\r\nrealestateonthehill.net\r\nrebuscadobot\r\nrequested-stuff.com\r\nretrotrasher.com\r\nricopositive.com\r\nrisorseinrete.com\r\nrotatingcunts.com\r\nrunawayclicks.com\r\nrutalibre.com\r\ns-marche.com\r\nsabrosojazz.com\r\nsamuraidojo.com\r\nsanaldarbe.com\r\nsasseminars.com\r\nschlampenbruzzler.com\r\nsearchmybong.com\r\nseckur.com\r\nsex-asian-porn-INTerracial-photo.com\r\nsex-porn-fuck-hardcore-movie.com\r\nsexa3.net\r\nsexer.com\r\nsexINTention.com\r\nsexnet24.tv\r\nsexomundo.com\r\nsharks.com.ru\r\nshells.com.ru\r\nshop-ecosafe.com\r\nshop-toon-hardcore-fuck-cum-pics.com\r\nsilverfussions.com\r\nsin-city-sex.net\r\nsluisvan.com\r\nsmutshots.com\r\nsnagglersmaggler.com\r\nsomethingtoforgetit.com\r\nsophiesplace.net\r\nsoursushi.com\r\nsouthernxstables.com\r\nspeed467.com\r\nspeedpal4you.com\r\nsporty.org.ru\r\nstopdriving.net\r\nstw.org.ru\r\nsufficientlife.com\r\nsussexboats.net\r\nswinger-party-free-dating-porn-sluts.com\r\nsydneyhay.com\r\nszmjht.com\r\nteninchtrout.com\r\nthebalancedfruits.com\r\ntheendofthesummit.com\r\nthiswillbeit.com\r\nthosethosethose.com\r\nticyclesofindia.com\r\ntits-gay-fagot-black-tits-bigtits-amateur.com\r\ntonius.com\r\ntoohsoft.com\r\ntoolvalley.com\r\ntooporno.net\r\ntoosexual.com\r\ntorngat.com\r\ntour.org.ru\r\ntowneluxury.com\r\ntrafficmogger.com\r\ntriacoach.net\r\ntrottinbob.com\r\ntttframes.com\r\ntvjukebox.net\r\nundercvr.com\r\nunfinished-desires.com\r\nunicornonero.com\r\nunionvillefire.com\r\nupsandowns.com\r\nupthehillanddown.com\r\nvallartavideo.com\r\nvietnamdatingservices.com\r\nvinegarlemonshots.com\r\nvizy.net.ru\r\nvnladiesdatingservices.com\r\nvomitandbusted.com\r\nwalkingthewalking.com\r\nwell-I-am-the-type-of-boy.com\r\nwhales.com.ru\r\nwhincer.net\r\nwhitpagesrippers.com\r\nwhois.sc\r\nwipperrippers.com\r\nwordfilebooklets.com\r\nworld-sexs.com\r\nxsay.com\r\nxxxchyangel.com\r\nxxxzips.com\r\nyouarelostINTransit.com\r\nyuppieslovestocks.com\r\nyuzhouhuagong.com\r\nzhaori-food.com\r\nzwiebelbacke.com'),
(7, 'filter', 5, 0, 2, '', 'Abuse-Filter', 'abuse_filter.tpl', 0, 0, ''),
(8, 'request', 0, 0, 0, '', 'Abuse-Request', 'abuse_request.tpl', 0, 0, ''),
(9, 'string', 0, 0, 0, '', 'Abuse-String', 'abuse_string.tpl', 0, 0, ''),
(10, 'admin', 0, 0, 0, '', 'Abuse-Admin', 'abuse_admin.tpl', 0, 0, ''),
(11, 'flood', 0, 1, 2, '', 'Abuse-Flood', 'abuse_flood.tpl', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_cidrs`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_cidrs` (
  `cidr` int(2) NOT NULL DEFAULT 0,
  `hosts` int(10) NOT NULL DEFAULT 0,
  `mask` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsnst_cidrs`
--

INSERT DELAYED INTO `nuke_nsnst_cidrs` (`cidr`, `hosts`, `mask`) VALUES
(1, 2147483647, '127.255.255.255'),
(2, 1073741824, '63.255.255.255'),
(3, 536870912, '31.255.255.255'),
(4, 268435456, '15.255.255.255'),
(5, 134217728, '7.255.255.255'),
(6, 67108864, '3.255.255.255'),
(7, 33554432, '1.255.255.255'),
(8, 16777216, '0.255.255.255'),
(9, 8388608, '0.127.255.255'),
(10, 4194304, '0.63.255.255'),
(11, 2097152, '0.31.255.255'),
(12, 1048576, '0.15.255.255'),
(13, 524288, '0.7.255.255'),
(14, 262144, '0.3.255.255'),
(15, 131072, '0.1.255.255'),
(16, 65536, '0.0.255.255'),
(17, 32768, '0.0.127.255'),
(18, 16384, '0.0.63.255'),
(19, 8192, '0.0.31.255'),
(20, 4096, '0.0.15.255'),
(21, 2048, '0.0.7.255'),
(22, 1024, '0.0.3.255'),
(23, 512, '0.0.1.255'),
(24, 256, '0.0.0.255'),
(25, 128, '0.0.0.127'),
(26, 64, '0.0.0.63'),
(27, 32, '0.0.0.31'),
(28, 16, '0.0.0.15'),
(29, 8, '0.0.0.7'),
(30, 4, '0.0.0.3'),
(31, 2, '0.0.0.1'),
(32, 1, '0.0.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_config`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsnst_config`
--

INSERT DELAYED INTO `nuke_nsnst_config` (`config_name`, `config_value`) VALUES
('admin_contact', 'admin@yoursite.com'),
('block_perpage', '50'),
('block_sort_column', 'date'),
('block_sort_direction', 'desc'),
('crypt_salt', 'N$'),
('display_link', '3'),
('display_reason', '3'),
('force_nukeurl', '0'),
('help_switch', '1'),
('htaccess_path', ''),
('http_auth', '0'),
('lookup_link', 'admin.php?op=ABIpCheck&domain='),
('page_delay', '1'),
('prevent_dos', '1'),
('proxy_reason', 'abuse_admin.tpl'),
('proxy_switch', '0'),
('santy_protection', '1'),
('self_expire', '0'),
('site_reason', 'admin_site_reason.tpl'),
('site_switch', '0'),
('staccess_path', ''),
('track_active', '1'),
('track_max', '604800'),
('track_perpage', '50'),
('track_sort_column', 'ip_long'),
('track_sort_direction', 'desc'),
('ip_reason', 'admin_ip_reason.tpl'),
('ip_switch', '0'),
('ftaccess_path', ''),
('flood_delay', '2'),
('disable_switch', '0'),
('track_clear', '1674691200'),
('blocked_clear', '0'),
('version_check', '$checktime'),
('version_newest', '2.6.09'),
('version_number', '2.6.09'),
('dump_directory', 'includes/cache/'),
('show_right', '0'),
('test_switch', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_countries`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_countries` (
  `c2c` char(2) NOT NULL DEFAULT '',
  `country` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsnst_countries`
--

INSERT DELAYED INTO `nuke_nsnst_countries` (`c2c`, `country`) VALUES
('00', 'Unknown'),
('01', 'IANA Reserved'),
('ac', 'Ascension Island'),
('ad', 'Andorra'),
('ae', 'United Arab Emirates'),
('af', 'Afghanistan'),
('ag', 'Antigua And Barbuda'),
('ai', 'Anguilla'),
('al', 'Albania'),
('am', 'Armenia'),
('an', 'Netherlands Antilles'),
('ao', 'Angola'),
('aq', 'Antarctica'),
('ar', 'Argentina'),
('as', 'American Samoa'),
('at', 'Austria'),
('au', 'Australia'),
('aw', 'Aruba'),
('ax', 'Aland Islands'),
('az', 'Azerbaijan'),
('ba', 'Bosnia And Herzegovina'),
('bb', 'Barbados'),
('bd', 'Bangladesh'),
('be', 'Belgium'),
('bf', 'Burkina Faso'),
('bg', 'Bulgaria'),
('bh', 'Bahrain'),
('bi', 'Burundi'),
('bj', 'Benin'),
('bm', 'Bermuda'),
('bn', 'Brunei Darussalam'),
('bo', 'Bolivia'),
('br', 'Brazil'),
('bs', 'Bahamas'),
('bt', 'Bhutan'),
('bv', 'Bouvet Island'),
('bw', 'Botswana'),
('by', 'Belarus'),
('bz', 'Belize'),
('ca', 'Canada'),
('cc', 'Cocos Keeling Islands'),
('cd', 'Democratic Republic of the Congo'),
('cf', 'Central African Republic'),
('cg', 'Republic of the Congo'),
('ch', 'Switzerland'),
('ci', 'Cote D\'ivoire'),
('ck', 'Cook Islands'),
('cl', 'Chile'),
('cm', 'Cameroon'),
('cn', 'China'),
('co', 'Colombia'),
('cr', 'Costa Rica'),
('cs', 'Czechoslovakia'),
('cu', 'Cuba'),
('cv', 'Cape Verde'),
('cx', 'Christmas Island'),
('cy', 'Cyprus'),
('cz', 'Czech Republic'),
('de', 'Germany'),
('dj', 'Djibouti'),
('dk', 'Denmark'),
('dm', 'Dominica'),
('do', 'Dominican Republic'),
('dz', 'Algeria'),
('ec', 'Ecuador'),
('ee', 'Estonia'),
('eg', 'Egypt'),
('eh', 'Western Sahara'),
('er', 'Eritrea'),
('es', 'Spain'),
('et', 'Ethiopia'),
('eu', 'European Union'),
('fi', 'Finland'),
('fj', 'Fiji'),
('fk', 'Falkland Islands'),
('fm', 'Micronesia'),
('fo', 'Faroes'),
('fr', 'France'),
('fx', 'Metropolitan France'),
('ga', 'Gabon'),
('gb', 'United Kingdom'),
('gd', 'Grenada'),
('ge', 'Georgia'),
('gf', 'French Guiana'),
('gg', 'Guernsey'),
('gh', 'Ghana'),
('gi', 'Gibraltar'),
('gl', 'Greenland'),
('gm', 'Gambia'),
('gn', 'Guinea'),
('gp', 'Guadeloupe'),
('gq', 'Equatorial Guinea'),
('gr', 'Greece'),
('gs', 'South Georgia and The Islands'),
('gt', 'Guatemala'),
('gu', 'Guam'),
('gw', 'Guinea-Bissau'),
('gy', 'Guyana'),
('hk', 'Hong Kong'),
('hm', 'Heard and McDonald Islands'),
('hn', 'Honduras'),
('hr', 'Croatia'),
('ht', 'Haiti'),
('hu', 'Hungary'),
('id', 'Indonesia'),
('ie', 'Ireland'),
('il', 'Israel'),
('im', 'Isle Of Man'),
('in', 'India'),
('io', 'British Indian Ocean Territory'),
('iq', 'Iraq'),
('ir', 'Iran'),
('is', 'Iceland'),
('it', 'Italy'),
('je', 'Jersey'),
('jm', 'Jamaica'),
('jo', 'Jordan'),
('jp', 'Japan'),
('ke', 'Kenya'),
('kg', 'Kyrgyzstan'),
('kh', 'Cambodia'),
('ki', 'Kiribati'),
('km', 'Comoros'),
('kn', 'SaINT Kitts And Nevis'),
('kp', 'North Korea'),
('kr', 'South Korea'),
('kw', 'Kuwait'),
('ky', 'Cayman Islands'),
('kz', 'Kazakhstan'),
('la', 'Laos'),
('lb', 'Lebanon'),
('lc', 'SaINT Lucia'),
('li', 'Liechtenstein'),
('lk', 'Sri Lanka'),
('lr', 'Liberia'),
('ls', 'Lesotho'),
('lt', 'Lithuania'),
('lu', 'Luxembourg'),
('lv', 'Latvia'),
('ly', 'Libya'),
('ma', 'Morocco'),
('mc', 'Monaco'),
('md', 'Moldova'),
('me', 'Montenegro'),
('mg', 'Madagascar'),
('mh', 'Marshall Islands'),
('mk', 'Macedonia'),
('ml', 'Mali'),
('mm', 'Myanmar'),
('mn', 'Mongolia'),
('mo', 'Macau'),
('mp', 'Northern Mariana Islands'),
('mq', 'Martinique'),
('mr', 'Mauritania'),
('ms', 'Montserrat'),
('mt', 'Malta'),
('mu', 'Mauritius'),
('mv', 'Maldives'),
('mw', 'Malawi'),
('mx', 'Mexico'),
('my', 'Malaysia'),
('mz', 'Mozambique'),
('na', 'Namibia'),
('nc', 'New Caledonia'),
('ne', 'Niger'),
('nf', 'Norfolk Island'),
('ng', 'Nigeria'),
('ni', 'Nicaragua'),
('nl', 'Netherlands'),
('no', 'Norway'),
('np', 'Nepal'),
('nr', 'Nauru'),
('nu', 'Niue'),
('nz', 'New Zealand'),
('om', 'Oman'),
('pa', 'Panama'),
('pe', 'Peru'),
('pf', 'French Polynesia'),
('pg', 'Papua New Guinea'),
('ph', 'Philippines'),
('pk', 'Pakistan'),
('pl', 'Poland'),
('pm', 'SaINT Pierre and Miquelon'),
('pn', 'Pitcairn Islands'),
('pr', 'Puerto Rico'),
('ps', 'Palestine'),
('pt', 'Portugal'),
('pw', 'Palau'),
('py', 'Paraguay'),
('qa', 'Qatar'),
('re', 'Reunion'),
('rs', 'Serbia'),
('ro', 'Romania'),
('ru', 'Russia'),
('rw', 'Rwanda'),
('sa', 'Saudi Arabia'),
('sb', 'Solomon Islands'),
('sc', 'Seychelles'),
('sd', 'Sudan'),
('se', 'Sweden'),
('sg', 'Singapore'),
('sh', 'SaINT Helena'),
('si', 'Slovenia'),
('sj', 'Svalbard'),
('sk', 'Slovakia'),
('sl', 'Sierra Leone'),
('sm', 'San Marino'),
('sn', 'Senegal'),
('so', 'Somalia'),
('sr', 'Suriname'),
('st', 'Sao Tome And Principe'),
('sv', 'El Salvador'),
('sy', 'Syria'),
('sz', 'Swaziland'),
('tc', 'Turks And Caicos Islands'),
('td', 'Chad'),
('tf', 'French Southern Territories'),
('tg', 'Togo'),
('th', 'Thailand'),
('tj', 'Tajikistan'),
('tk', 'Tokelau'),
('tl', 'East Timor'),
('tm', 'Turkmenistan'),
('tn', 'Tunisia'),
('to', 'Tonga'),
('tp', 'East Timor'),
('tr', 'Turkey'),
('tt', 'Trinidad And Tobago'),
('tv', 'Tuvalu'),
('tw', 'Taiwan'),
('tz', 'Tanzania'),
('ua', 'Ukraine'),
('ug', 'Uganda'),
('um', 'United States Minor Outlying Islands'),
('un', 'United Nations'),
('us', 'United States'),
('uy', 'Uruguay'),
('uz', 'Uzbekistan'),
('va', 'Vatican City'),
('vc', 'SaINT Vincent And The Grenadines'),
('ve', 'Venezuela'),
('vg', 'British Virgin Islands'),
('vi', 'US Virgin Islands'),
('vn', 'Vietnam'),
('vu', 'Vanuatu'),
('wf', 'Wallis and Futuna Islands'),
('ws', 'Samoa'),
('xe', 'England'),
('xs', 'Scotland'),
('xw', 'Wales'),
('ye', 'Yemen'),
('yt', 'Mayotte'),
('yu', 'Yugoslavia'),
('za', 'South Africa'),
('zm', 'Zambia'),
('zw', 'Zimbabwe'),
('02', 'UnAllocated');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_excluded_ranges`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_excluded_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_harvesters`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_harvesters` (
  `hid` int(2) NOT NULL,
  `harvester` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsnst_harvesters`
--

INSERT DELAYED INTO `nuke_nsnst_harvesters` (`hid`, `harvester`) VALUES
(1, '@yahoo.com'),
(2, 'alexibot'),
(3, 'alligator'),
(4, 'anonymiz'),
(5, 'asterias'),
(6, 'backdoorbot'),
(7, 'black hole'),
(8, 'blackwidow'),
(9, 'blowfish'),
(10, 'botalot'),
(11, 'builtbottough'),
(12, 'bullseye'),
(13, 'bunnyslippers'),
(14, 'catch'),
(15, 'cegbfeieh'),
(16, 'charon'),
(17, 'cheesebot'),
(18, 'cherrypicker'),
(19, 'chinaclaw'),
(20, 'combine'),
(21, 'copyrightcheck'),
(22, 'cosmos'),
(23, 'crescent'),
(24, 'curl'),
(25, 'dbrowse'),
(26, 'disco'),
(27, 'dittospyder'),
(28, 'dlman'),
(29, 'dnloadmage'),
(30, 'download'),
(31, 'dreampassport'),
(32, 'dts agent'),
(33, 'ecatch'),
(34, 'eirgrabber'),
(35, 'erocrawler'),
(36, 'express webpictures'),
(37, 'extractorpro'),
(38, 'eyenetie'),
(39, 'fantombrowser'),
(40, 'fantomcrew browser'),
(41, 'fileheap'),
(42, 'filehound'),
(43, 'flashget'),
(44, 'foobot'),
(45, 'franklin locator'),
(46, 'freshdownload'),
(47, 'fscrawler'),
(48, 'gamespy_arcade'),
(49, 'getbot'),
(50, 'getright'),
(51, 'getweb'),
(52, 'go!zilla'),
(53, 'go-ahead-got-it'),
(54, 'grab'),
(55, 'grafula'),
(56, 'gsa-crawler'),
(57, 'harvest'),
(58, 'hloader'),
(59, 'hmview'),
(60, 'httplib'),
(61, 'httpresume'),
(62, 'httrack'),
(63, 'humanlinks'),
(64, 'igetter'),
(65, 'image stripper'),
(66, 'image sucker'),
(67, 'industry program'),
(68, 'indy library'),
(69, 'infonavirobot'),
(70, 'installshield digitalwizard'),
(71, 'interget'),
(72, 'iria'),
(73, 'irvine'),
(74, 'iupui research bot'),
(75, 'jbh agent'),
(76, 'jennybot'),
(77, 'jetcar'),
(78, 'jobo'),
(79, 'joc'),
(80, 'kapere'),
(81, 'kenjin spider'),
(82, 'keyword density'),
(83, 'larbin'),
(84, 'leechftp'),
(85, 'leechget'),
(86, 'lexibot'),
(87, 'libweb/clshttp'),
(88, 'libwww-perl'),
(89, 'lightningdownload'),
(90, 'lincoln state web browser'),
(91, 'linkextractorpro'),
(92, 'linkscan/8.1a.unix'),
(93, 'linkwalker'),
(94, 'lwp-trivial'),
(95, 'lwp::simple'),
(96, 'mac finder'),
(97, 'mata hari'),
(98, 'mediasearch'),
(99, 'metaproducts'),
(100, 'microsoft url control'),
(101, 'midown tool'),
(102, 'miixpc'),
(103, 'missauga locate'),
(104, 'missouri college browse'),
(105, 'mister pix'),
(106, 'moget'),
(107, 'mozilla.*newt'),
(108, 'mozilla/3.0 (compatible)'),
(109, 'mozilla/3.mozilla/2.01'),
(110, 'msie 4.0 (win95)'),
(111, 'multiblocker browser'),
(112, 'mydaemon'),
(113, 'mygetright'),
(114, 'nabot'),
(115, 'navroad'),
(116, 'nearsite'),
(117, 'net vampire'),
(118, 'netants'),
(119, 'netmechanic'),
(120, 'netpumper'),
(121, 'netspider'),
(122, 'newsearchengine'),
(123, 'nicerspro'),
(124, 'ninja'),
(125, 'nitro downloader'),
(126, 'npbot'),
(127, 'octopus'),
(128, 'offline explorer'),
(129, 'offline navigator'),
(130, 'openfind'),
(131, 'pagegrabber'),
(132, 'papa foto'),
(133, 'pavuk'),
(134, 'pbrowse'),
(135, 'pcbrowser'),
(136, 'peval'),
(137, 'pompos/'),
(138, 'program shareware'),
(139, 'propowerbot'),
(140, 'prowebwalker'),
(141, 'psurf'),
(142, 'puf'),
(143, 'puxarapido'),
(144, 'queryn metasearch'),
(145, 'realdownload'),
(146, 'reget'),
(147, 'repomonkey'),
(148, 'rsurf'),
(149, 'rumours-agent'),
(150, 'sakura'),
(151, 'scan4mail'),
(152, 'semanticdiscovery'),
(153, 'sitesnagger'),
(154, 'slysearch'),
(155, 'spankbot'),
(156, 'spanner '),
(157, 'spiderzilla'),
(158, 'sq webscanner'),
(159, 'stamina'),
(160, 'star downloader'),
(161, 'steeler'),
(162, 'strip'),
(163, 'superbot'),
(164, 'superhttp'),
(165, 'surfbot'),
(166, 'suzuran'),
(167, 'swbot'),
(168, 'szukacz'),
(169, 'takeout'),
(170, 'teleport'),
(171, 'telesoft'),
(172, 'test spider'),
(173, 'the intraformant'),
(174, 'thenomad'),
(175, 'tighttwatbot'),
(176, 'titan'),
(177, 'tocrawl/urldispatcher'),
(178, 'true_robot'),
(179, 'tsurf'),
(180, 'turing machine'),
(181, 'turingos'),
(182, 'urlblaze'),
(183, 'urlgetfile'),
(184, 'urly warning'),
(185, 'utilmind'),
(186, 'vci'),
(187, 'voideye'),
(188, 'web image collector'),
(189, 'web sucker'),
(190, 'webauto'),
(191, 'webbandit'),
(192, 'webcapture'),
(193, 'webcollage'),
(194, 'webcopier'),
(195, 'webenhancer'),
(196, 'webfetch'),
(197, 'webgo'),
(198, 'webleacher'),
(199, 'webmasterworldforumbot'),
(200, 'webql'),
(201, 'webreaper'),
(202, 'website extractor'),
(203, 'website quester'),
(204, 'webster'),
(205, 'webstripper'),
(206, 'webwhacker'),
(207, 'wep search'),
(208, 'wget'),
(209, 'whizbang'),
(210, 'widow'),
(211, 'wildsoft surfer'),
(212, 'www-collector-e'),
(213, 'www.netwu.com'),
(214, 'wwwoffle'),
(215, 'xaldon'),
(216, 'xenu'),
(217, 'zeus'),
(218, 'ziggy'),
(219, 'cuntmonkey'),
(220, 'zippy');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_ip2country`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_ip2country` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `c2c` char(2) DEFAULT NULL,
  `country` char(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_protected_ranges`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_protected_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_referers`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_referers` (
  `rid` int(2) NOT NULL,
  `referer` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_nsnst_referers`
--

INSERT DELAYED INTO `nuke_nsnst_referers` (`rid`, `referer`) VALUES
(1, '121hr.com'),
(2, '1st-call.net'),
(3, '1stcool.com'),
(4, '5000n.com'),
(5, '69-xxx.com'),
(6, '9irl.com'),
(7, '9uy.com'),
(8, 'a-day-at-the-party.com'),
(9, 'accessthepeace.com'),
(10, 'adult-model-nude-pictures.com'),
(11, 'adult-sex-toys-free-porn.com'),
(12, 'agnitum.com'),
(13, 'alfonssackpfeiffe.com'),
(14, 'alongwayfrommars.com'),
(15, 'anime-sex-1.com'),
(16, 'anorex-sf-stimulant-free.com'),
(17, 'antibot.net'),
(18, 'antique-tokiwa.com'),
(19, 'apotheke-heute.com'),
(20, 'armada31.com'),
(21, 'artark.com'),
(22, 'artlilei.com'),
(23, 'ascendbtg.com'),
(24, 'aschalaecheck.com'),
(25, 'asian-sex-free-sex.com'),
(26, 'aslowspeeker.com'),
(27, 'assasinatedfrogs.com'),
(28, 'athirst-for-tranquillity.net'),
(29, 'aubonpanier.com'),
(30, 'avalonumc.com'),
(31, 'ayingba.com'),
(32, 'bayofnoreturn.com'),
(33, 'bbw4phonesex.com'),
(34, 'beersarenotfree.com'),
(35, 'bierikiuetsch.com'),
(36, 'bilingualannouncements.com'),
(37, 'black-pussy-toon-clip-anal-lover-single.com'),
(38, 'blownapart.com'),
(39, 'blueroutes.com'),
(40, 'boasex.com'),
(41, 'booksandpages.com'),
(42, 'bootyquake.com'),
(43, 'bossyhunter.com'),
(44, 'boyz-sex.com'),
(45, 'brokersaandpokers.com'),
(46, 'browserwindowcleaner.com'),
(47, 'budobytes.com'),
(48, 'business2fun.com'),
(49, 'buymyshitz.com'),
(50, 'byuntaesex.com'),
(51, 'caniputsomeloveintoyou.com'),
(52, 'cartoons.net.ru'),
(53, 'caverunsailing.com'),
(54, 'certainhealth.com'),
(55, 'clantea.com'),
(56, 'close-protection-services.com'),
(57, 'clubcanino.com'),
(58, 'clubstic.com'),
(59, 'cobrakai-skf.com'),
(60, 'collegefucktour.co.uk'),
(61, 'commanderspank.com'),
(62, 'coolenabled.com'),
(63, 'crusecountryart.com'),
(64, 'crusingforsex.co.uk'),
(65, 'cunt-twat-pussy-juice-clit-licking.com'),
(66, 'customerhandshaker.com'),
(67, 'cyborgrama.com'),
(68, 'darkprofits.co.uk'),
(69, 'datingforme.co.uk'),
(70, 'datingmind.com'),
(71, 'degree.org.ru'),
(72, 'delorentos.com'),
(73, 'diggydigger.com'),
(74, 'dinkydonkyaussie.com'),
(75, 'djpritchard.com'),
(76, 'djtop.com'),
(77, 'draufgeschissen.com'),
(78, 'dreamerteens.co.uk'),
(79, 'ebonyarchives.co.uk'),
(80, 'ebonyplaya.co.uk'),
(81, 'ecobuilder2000.com'),
(82, 'emailandemail.com'),
(83, 'emedici.net'),
(84, 'engine-on-fire.com'),
(85, 'erocity.co.uk'),
(86, 'esport3.com'),
(87, 'eteenbabes.com'),
(88, 'eurofreepages.com'),
(89, 'eurotexans.com'),
(90, 'evolucionweb.com'),
(91, 'fakoli.com'),
(92, 'fe4ba.com'),
(93, 'ferienschweden.com'),
(94, 'findly.com'),
(95, 'firsttimeteadrinker.com'),
(96, 'fishing.net.ru'),
(97, 'flatwonkers.com'),
(98, 'flowershopentertainment.com'),
(99, 'flymario.com'),
(100, 'free-xxx-pictures-porno-gallery.com'),
(101, 'freebestporn.com'),
(102, 'freefuckingmovies.co.uk'),
(103, 'freexxxstuff.co.uk'),
(104, 'fruitologist.net'),
(105, 'fruitsandbolts.com'),
(106, 'fudge-cumshots-free-midget-movie-clips.com'),
(107, 'fudge-michaelmoore.com'),
(108, 'fundacep.com'),
(109, 'gadless.com'),
(110, 'gallapagosrangers.com'),
(111, 'galleries4free.co.uk'),
(112, 'galofu.com'),
(113, 'gaypixpost.co.uk'),
(114, 'geomasti.com'),
(115, 'girltime.co.uk'),
(116, 'glassrope.com'),
(117, 'godjustblessyouall.com'),
(118, 'goldenageresort.com'),
(119, 'gonnabedaddies.com'),
(120, 'granadasexi.com'),
(121, 'guardingtheangels.com'),
(122, 'guyprofiles.co.uk'),
(123, 'happy1225.com'),
(124, 'happychappywacky.com'),
(125, 'health.org.ru'),
(126, 'hexplas.com'),
(127, 'highheelsmodels4fun.com'),
(128, 'hillsweb.com'),
(129, 'hiptuner.com'),
(130, 'historyintospace.com'),
(131, 'hoa-tuoi.com'),
(132, 'homebuyinginatlanta.com'),
(133, 'horizonultra.com'),
(134, 'horseminiature.net'),
(135, 'hotkiss.co.uk'),
(136, 'hotlivegirls.co.uk'),
(137, 'hotmatchup.co.uk'),
(138, 'husler.co.uk'),
(139, 'iaentertainment.com'),
(140, 'iamnotsomeone.com'),
(141, 'iconsofcorruption.com'),
(142, 'ihavenotrustinyou.com'),
(143, 'informat-systems.com'),
(144, 'interiorproshop.com'),
(145, 'intersoftnetworks.com'),
(146, 'inthecrib.com'),
(147, 'investment4cashiers.com'),
(148, 'iti-trailers.com'),
(149, 'jackpot-hacker.com'),
(150, 'jacks-world.com'),
(151, 'jamesthesailorbasher.com'),
(152, 'jesuislemonds.com'),
(153, 'justanotherdomainname.com'),
(154, 'kampelicka.com'),
(155, 'kanalrattenarsch.com'),
(156, 'katzasher.com'),
(157, 'kerosinjunkie.com'),
(158, 'killasvideo.com'),
(159, 'koenigspisser.com'),
(160, 'kontorpara.com'),
(161, 'l8t.com'),
(162, 'laestacion101.com'),
(163, 'lambuschlamppen.com'),
(164, 'lankasex.co.uk'),
(165, 'laser-creations.com'),
(166, 'le-tour-du-monde.com'),
(167, 'lecraft.com'),
(168, 'ledo-design.com'),
(169, 'leftregistration.com'),
(170, 'lekkikoomastas.com'),
(171, 'lepommeau.com'),
(172, 'libr-animal.com'),
(173, 'libraries.org.ru'),
(174, 'likewaterlikewind.com'),
(175, 'limbojumpers.com'),
(176, 'link.ru'),
(177, 'lockportlinks.com'),
(178, 'loiproject.com'),
(179, 'longtermalternatives.com'),
(180, 'lottoeco.com'),
(181, 'lucalozzi.com'),
(182, 'maki-e-pens.com'),
(183, 'malepayperview.co.uk'),
(184, 'mangaxoxo.com'),
(185, 'maps.org.ru'),
(186, 'marcofields.com'),
(187, 'masterofcheese.com'),
(188, 'masteroftheblasterhill.com'),
(189, 'mastheadwankers.com'),
(190, 'megafrontier.com'),
(191, 'meinschuppen.com'),
(192, 'mercurybar.com'),
(193, 'metapannas.com'),
(194, 'micelebre.com'),
(195, 'midnightlaundries.com'),
(196, 'mikeapartment.co.uk'),
(197, 'millenniumchorus.com'),
(198, 'mimundial2002.com'),
(199, 'miniaturegallerymm.com'),
(200, 'mixtaperadio.com'),
(201, 'mondialcoral.com'),
(202, 'monja-wakamatsu.com'),
(203, 'monstermonkey.net'),
(204, 'mouthfreshners.com'),
(205, 'mullensholiday.com'),
(206, 'musilo.com'),
(207, 'myhollowlog.com'),
(208, 'myhomephonenumber.com'),
(209, 'mykeyboardisbroken.com'),
(210, 'mysofia.net'),
(211, 'naked-cheaters.com'),
(212, 'naked-old-women.com'),
(213, 'nastygirls.co.uk'),
(214, 'nationclan.net'),
(215, 'natterratter.com'),
(216, 'naughtyadam.com'),
(217, 'nestbeschmutzer.com'),
(218, 'netwu.com'),
(219, 'newrealeaseonline.com'),
(220, 'newrealeasesonline.com'),
(221, 'nextfrontiersonline.com'),
(222, 'nikostaxi.com'),
(223, 'notorious7.com'),
(224, 'nrecruiter.com'),
(225, 'nursingdepot.com'),
(226, 'nustramosse.com'),
(227, 'nuturalhicks.com'),
(228, 'occaz-auto49.com'),
(229, 'ocean-db.net'),
(230, 'oilburnerservice.net'),
(231, 'omburo.com'),
(232, 'oneoz.com'),
(233, 'onepageahead.net'),
(234, 'onlinewithaline.com'),
(235, 'organizate.net'),
(236, 'ourownweddingsong.com'),
(237, 'owen-music.com'),
(238, 'p-partners.com'),
(239, 'paginadeautor.com'),
(240, 'pakistandutyfree.com'),
(241, 'pamanderson.co.uk'),
(242, 'parentsense.net'),
(243, 'particlewave.net'),
(244, 'pay-clic.com'),
(245, 'pay4link.net'),
(246, 'pcisp.com'),
(247, 'persist-pharma.com'),
(248, 'peteband.com'),
(249, 'petplusindia.com'),
(250, 'pickabbw.co.uk'),
(251, 'picture-oral-position-lesbian.com'),
(252, 'pl8again.com'),
(253, 'planeting.net'),
(254, 'popusky.com'),
(255, 'porn-expert.com'),
(256, 'promoblitza.com'),
(257, 'proproducts-usa.com'),
(258, 'ptcgzone.com'),
(259, 'ptporn.com'),
(260, 'publishmybong.com'),
(261, 'puttingtogether.com'),
(262, 'qualifiedcancelations.com'),
(263, 'rahost.com'),
(264, 'rainbow21.com'),
(265, 'rakkashakka.com'),
(266, 'randomfeeding.com'),
(267, 'rape-art.com'),
(268, 'rd-brains.com'),
(269, 'realestateonthehill.net'),
(270, 'rebuscadobot'),
(271, 'requested-stuff.com'),
(272, 'retrotrasher.com'),
(273, 'ricopositive.com'),
(274, 'risorseinrete.com'),
(275, 'rotatingcunts.com'),
(276, 'runawayclicks.com'),
(277, 'rutalibre.com'),
(278, 's-marche.com'),
(279, 'sabrosojazz.com'),
(280, 'samuraidojo.com'),
(281, 'sanaldarbe.com'),
(282, 'sasseminars.com'),
(283, 'schlampenbruzzler.com'),
(284, 'searchmybong.com'),
(285, 'seckur.com'),
(286, 'sex-asian-porn-interracial-photo.com'),
(287, 'sex-porn-fudge-hardcore-movie.com'),
(288, 'sexa3.net'),
(289, 'sexer.com'),
(290, 'sexintention.com'),
(291, 'sexnet24.tv'),
(292, 'sexomundo.com'),
(293, 'sharks.com.ru'),
(294, 'shells.com.ru'),
(295, 'shop-ecosafe.com'),
(296, 'shop-toon-hardcore-fudge-cum-pics.com'),
(297, 'silverfussions.com'),
(298, 'sin-city-sex.net'),
(299, 'sluisvan.com'),
(300, 'smutshots.com'),
(301, 'snagglersmaggler.com'),
(302, 'somethingtoforgetit.com'),
(303, 'sophiesplace.net'),
(304, 'soursushi.com'),
(305, 'southernxstables.com'),
(306, 'speed467.com'),
(307, 'speedpal4you.com'),
(308, 'sporty.org.ru'),
(309, 'stopdriving.net'),
(310, 'stw.org.ru'),
(311, 'sufficientlife.com'),
(312, 'sussexboats.net'),
(313, 'swinger-party-free-dating-porn-sluts.com'),
(314, 'sydneyhay.com'),
(315, 'szmjht.com'),
(316, 'teninchtrout.com'),
(317, 'thebalancedfruits.com'),
(318, 'theendofthesummit.com'),
(319, 'thiswillbeit.com'),
(320, 'thosethosethose.com'),
(321, 'ticyclesofindia.com'),
(322, 'tits-gay-fagot-black-tits-bigtits-amateur.com'),
(323, 'tonius.com'),
(324, 'toohsoft.com'),
(325, 'toolvalley.com'),
(326, 'tooporno.net'),
(327, 'toosexual.com'),
(328, 'torngat.com'),
(329, 'tour.org.ru'),
(330, 'towneluxury.com'),
(331, 'trafficmogger.com'),
(332, 'triacoach.net'),
(333, 'trottinbob.com'),
(334, 'tttframes.com'),
(335, 'tvjukebox.net'),
(336, 'undercvr.com'),
(337, 'unfinished-desires.com'),
(338, 'unicornonero.com'),
(339, 'unionvillefire.com'),
(340, 'upsandowns.com'),
(341, 'upthehillanddown.com'),
(342, 'vallartavideo.com'),
(343, 'vietnamdatingservices.com'),
(344, 'vinegarlemonshots.com'),
(345, 'vizy.net.ru'),
(346, 'vnladiesdatingservices.com'),
(347, 'vomitandbusted.com'),
(348, 'walkingthewalking.com'),
(349, 'well-I-am-the-type-of-boy.com'),
(350, 'whales.com.ru'),
(351, 'whincer.net'),
(352, 'whitpagesrippers.com'),
(353, 'whois.sc'),
(354, 'wipperrippers.com'),
(355, 'wordfilebooklets.com'),
(356, 'world-sexs.com'),
(357, 'xsay.com'),
(358, 'xxxchyangel.com'),
(359, 'xxxx:'),
(360, 'xxxzips.com'),
(361, 'youarelostintransit.com'),
(362, 'yuppieslovestocks.com'),
(363, 'yuzhouhuagong.com'),
(364, 'zhaori-food.com'),
(365, 'traffic2money.com'),
(366, 'floating-share-buttons.com'),
(367, 'get-free-social-traffic.com'),
(368, 'site4.free-floating-buttons.com'),
(369, '4webmasters.org'),
(370, 'site10.free-floating-buttons.com'),
(371, 'free-social-buttons.com'),
(372, 'site3.free-floating-buttons.com'),
(373, 'www.event-tracking.com'),
(374, 'success-seo.com'),
(375, 'seo-platform.com'),
(376, 'site2.free-floating-buttons.com'),
(377, 'chinese-amezon.com'),
(378, 'hongfanji.com'),
(379, 'site8.free-floating-buttons.com'),
(380, 'site9.free-floating-buttons.com'),
(381, 'videoâ€“production.com'),
(382, 'www.Get-Free-Traffic-Now.com'),
(383, 'buttons-for-website.com'),
(384, 'qualitymarketzone.com'),
(385, 'site5.free-floating-buttons.co'),
(386, 'videos-for-your-business.com'),
(387, 'how-to-earn-quick-money.com'),
(388, 'forum.topic63020490.darodar.com'),
(389, '7makemoneyonline.com'),
(390, 'acads.net'),
(391, 'anal-acrobats.hol.es'),
(392, 'anticrawler.org'),
(393, 'best-seo-offer.com'),
(394, 'best-seo-solution.com'),
(395, 'bestwebsitesawards.comblackhatworth.com'),
(396, 'brakehawk.com'),
(397, 'buttons-for-your-website.com'),
(398, 'buy-cheap-online.info'),
(399, 'darodar.com'),
(400, 'econom.co'),
(401, 'event-tracking.com'),
(402, 'forum20.smailik.org'),
(403, 'forum69.info'),
(404, 'free-share-buttons.com'),
(405, 'googlsucks.com'),
(406, 'guardlink.org'),
(407, 'hulfingtonpost.com'),
(408, 'humanorightswatch.org'),
(409, 'ilovevitaly.com'),
(410, 'iminent.com'),
(411, 'kabbalah-red-bracelets.com'),
(412, 'kambasoft.com'),
(413, 'makemoneyonline.com'),
(414, 'masterseek.com'),
(415, 'o-o-6-o-o.com'),
(416, 'ok.ru'),
(417, 'pornhub-forum.ga'),
(418, 'pornhub-forum.uni.me'),
(419, 'priceg.com'),
(420, 'ranksonic.info'),
(421, 'ranksonic.org'),
(422, 'rapidgator-porn.ga'),
(423, 'savetubevideo.com'),
(424, 'semalt.com'),
(425, 'sexyteens.hol.es'),
(426, 'simple-share-buttons.com'),
(427, 'social-buttons.com'),
(428, 'theguardlan.com'),
(429, 'webmaster-traffic.com'),
(430, 'youporn-forum.ga'),
(431, 'youporn-forum.uni.me'),
(432, 'ilovevitaly.co'),
(433, 'myftpupload.com'),
(434, 'iskalko.ru'),
(435, 'ilovevitaly.ru'),
(436, 'o-o-8-o-o.ru'),
(437, 'o-o-6-o-o.ru'),
(438, 'cenoval.ru'),
(439, 'cenokos.ru'),
(440, 'seoexperimenty.ru'),
(441, 'gobongo.info'),
(442, 'vodkoved.ru'),
(443, 'adcash.com'),
(444, 'websocial.me'),
(445, 'cityadspix.com'),
(446, 'luxup.ru'),
(447, 'ykecwqlixx.ru'),
(448, 'superiends.org'),
(449, 'slftsdybbg.ru'),
(450, 'edakgfvwql.ru'),
(451, 'socialseet.ru'),
(452, 'screentoolkit.com'),
(453, 'blackhatworth.com'),
(454, 'prlog.ru'),
(455, 'bestwebsitesawards.com'),
(456, 'forum.smailik.org'),
(457, 'aliexpress.com'),
(458, 'Get-Free-Traffic-Now.com'),
(459, 'semalt.semalt.com'),
(460, 'iloveitaly.ro'),
(461, 'prodvigator.ua'),
(462, 'resellerclub.com'),
(463, 'adviceforum.info'),
(464, 'europages.com.ru'),
(465, 'lomb.co'),
(466, 'lumb.co'),
(467, '54.186.60.77'),
(468, 'srecorder.com'),
(469, 'see-your-website-here.com'),
(470, '76brighton.co.uk'),
(471, 'paparazzistudios.com.au'),
(472, 'powitania.pl'),
(473, 'sharebutton.net'),
(474, 'tasteidea.com'),
(475, 'descargar-musica-gratis.net'),
(476, 'torontoplumbinggroup.com'),
(477, '100dollars-seo.com'),
(478, 'semaltmedia.com'),
(479, 'rankings-analytics.com'),
(480, 'free-floating-buttons.com'),
(481, 'rednise.com'),
(482, 'erot.co'),
(483, 'generalporn.org'),
(484, 'trafficmonetize.org'),
(485, 'trafficmonetizer.org'),
(486, 'domination.ml'),
(487, 'torture.ml'),
(488, 'depositfiles-porn.ga'),
(489, 'pornhubforum.yk'),
(490, 'pops.foundation'),
(491, 'justprofit.xyz'),
(492, 'best-seo-software.xyz'),
(493, 'zwiebelbacke.com');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_strings`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_strings` (
  `string` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_nsnst_tracked_ips`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_nsnst_tracked_ips` (
  `tid` int(11) NOT NULL,
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
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pages`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_pages` (
  `pid` int(10) NOT NULL,
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
  `clanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pages_categories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_pages_categories` (
  `cid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_pollcomments`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_pollcomments` (
  `tid` int(11) NOT NULL,
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
  `reason` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_check`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_poll_check` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `pollID` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_poll_check`
--

INSERT DELAYED INTO `nuke_poll_check` (`ip`, `time`, `pollID`) VALUES
('173.170.244.40', '1673679968', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_data`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_poll_data` (
  `pollID` int(11) NOT NULL DEFAULT 0,
  `optionText` char(50) NOT NULL DEFAULT '',
  `optionCount` int(11) NOT NULL DEFAULT 0,
  `voteID` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_poll_data`
--

INSERT DELAYED INTO `nuke_poll_data` (`pollID`, `optionText`, `optionCount`, `voteID`) VALUES
(1, 'Ummmm, not bad', 0, 1),
(1, 'Farout', 0, 2),
(1, 'Terrific', 0, 3),
(1, 'The Shit!!', 0, 4),
(1, 'Where has this been?', 0, 5),
(1, 'Blows...', 0, 6),
(1, 'Absolutely #1!', 0, 7),
(1, '', 0, 8),
(1, '', 0, 9),
(1, '', 0, 10),
(1, '', 0, 11),
(1, '', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_poll_desc`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_poll_desc` (
  `pollID` int(11) NOT NULL,
  `pollTitle` varchar(100) NOT NULL DEFAULT '',
  `timeStamp` int(11) NOT NULL DEFAULT 0,
  `voters` mediumint(9) NOT NULL DEFAULT 0,
  `planguage` varchar(30) NOT NULL DEFAULT '',
  `artid` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_poll_desc`
--

INSERT DELAYED INTO `nuke_poll_desc` (`pollID`, `pollTitle`, `timeStamp`, `voters`, `planguage`, `artid`) VALUES
(1, 'What do you think about this website?', 961405160, 2, 'english', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_quotes`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_quotes` (
  `qid` int(10) UNSIGNED NOT NULL,
  `quote` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_quotes`
--

INSERT DELAYED INTO `nuke_quotes` (`qid`, `quote`) VALUES
(1, 'Nos morituri te salutamus - CBHS');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_referer`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_referer` (
  `url` varchar(100) NOT NULL,
  `lasttime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `link` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_referer`
--

INSERT DELAYED INTO `nuke_referer` (`url`, `lasttime`, `link`) VALUES
('http://www.yoursite.com/', 1674271029, '/');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_related`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_related` (
  `rid` int(11) NOT NULL,
  `tid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_reviews` (
  `id` int(10) NOT NULL,
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
  `rlanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_add`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_reviews_add` (
  `id` int(10) NOT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(150) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `reviewer` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0,
  `url` varchar(100) NOT NULL DEFAULT '',
  `url_title` varchar(50) NOT NULL DEFAULT '',
  `rlanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_comments`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_reviews_comments` (
  `cid` int(10) NOT NULL,
  `rid` int(10) NOT NULL DEFAULT 0,
  `userid` varchar(25) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_reviews_main`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_reviews_main` (
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_reviews_main`
--

INSERT DELAYED INTO `nuke_reviews_main` (`title`, `description`) VALUES
('Reviews Section Title', 'Reviews Section Long Description');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_security_agents`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_security_agents` (
  `agent_name` varchar(20) NOT NULL DEFAULT '',
  `agent_fullname` varchar(30) DEFAULT '',
  `agent_hostname` varchar(30) DEFAULT '',
  `agent_url` varchar(80) DEFAULT '',
  `agent_ban` int(1) NOT NULL DEFAULT 0,
  `agent_desc` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_security_agents`
--

INSERT DELAYED INTO `nuke_security_agents` (`agent_name`, `agent_fullname`, `agent_hostname`, `agent_url`, `agent_ban`, `agent_desc`) VALUES
('1Noon', '1Noonbot', NULL, '1nooncorp.com', -1, 'Doesn\'t follow robots.txt'),
('AI', 'AIBOT', NULL, '21seek.com', 0, '(China) robot (218.17.90.xxx)'),
('aip', 'aipbot/', NULL, 'nameprotect.com', 0, 'copyright search robot (24.177.134.x), s. also\r\n- np/0.1_(np;_http://www.nameprotect.com...\r\n- abot/0.1 (abot; http://www.abot.com...'),
('Alexa', 'ia_archiver', '.alexa.com', 'alexa.com', 0, 'Alexa (209.237.238.1xx)'),
('Archive', 'ia_archiver', '.archive.org', 'archive.org', 0, 'The Internet Archive (209.237.238.1xx)'),
('AltaVista', 'Scooter', NULL, 'altavista.com', 0, NULL),
('Amfibi', 'Amfibibot', NULL, 'amfibi.com', 0, NULL),
('Ansearch', 'AnsearchBot/', NULL, 'ansearch.com.au', 0, NULL),
('AnswerBus', 'AnswerBus', NULL, 'answerbus.com', 0, NULL),
('Argus', 'Argus/', NULL, 'simpy.com/bot.html', 0, NULL),
('Arachmo', 'Arachmo', NULL, NULL, -1, 'Impolite bandwidth sucker. Netblock owned by SOFTBANK BB CORP, Japan.\r\nDoesn\'t follow robots.txt'),
('Ask Jeeves', 'Ask Jeeves/Teoma', '.ask.com', 'sp.ask.com/docs/about/tech_crawling.html', 0, NULL),
('ASPseek', 'ASPseek/', NULL, 'aspseek.org', 0, 'search engine software'),
('AvantGo', 'AvantGo', 'avantgo.com', 'avantgo.com', 0, NULL),
('Axadine', 'Axadine Crawler', NULL, 'axada.de', 0, NULL),
('Baidu', 'Baiduspider', NULL, 'baidu.com/search/spider.htm', 0, NULL),
('Become', 'BecomeBot', NULL, NULL, 0, NULL),
('BigClique', 'BigCliqueBOT', NULL, 'bigclique.com', 0, NULL),
('BilderSauger', 'BilderSauger', NULL, 'google.com/search?q=BilderSauger+data+becker', -1, NULL),
('BitTorrent', 'btbot/', NULL, 'btbot.com/btbot.html', 0, NULL),
('Bruin', 'BruinBot', NULL, 'webarchive.cs.ucla.edu/bruinbot.html', 0, NULL),
('cfetch', 'cfetch/', NULL, NULL, 0, NULL),
('Cipinet', 'Cipinet', NULL, 'cipinet.com/bot.html', 0, NULL),
('Combine', 'Combine/', NULL, 'lub.lu.se/combine/', -1, 'harvesting robot'),
('Convera', 'ConveraCrawler/', NULL, 'authoritativeweb.com/crawl', -1, 'Impolite robot. Netblock owned by Convera Corp, Vienna'),
('Cydral', 'CydralSpider', NULL, 'cydral.com', 0, 'Cydral Web Image Search'),
('curl', 'curl/', NULL, 'curl.haxx.se', 0, 'file transferring tool'),
('Datapark', 'DataparkSearch/', NULL, 'dataparksearch.org', 0, NULL),
('Demo', 'Demo Bot', NULL, NULL, -1, NULL),
('DHCrawler', 'DHCrawler', NULL, NULL, 0, NULL),
('Diamond', 'DiamondBot', NULL, 'searchscout.com', -1, 'Claria (ex Gator) robot (64.152.73.xx), s. also Claria'),
('DISCo', 'DISCo Pump', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Dragonfly CMS', 'Dragonfly File Reader', NULL, NULL, 0, NULL),
('Drecom', 'Drecombot/', 'drecom.jp', 'career.drecom.jp/bot.html', -1, 'Doesn\'t follow robots.txt'),
('Dumbfind', 'Dumbot', NULL, 'dumbfind.com/dumbot.html', 0, NULL),
('e-Society', 'e-SocietyRobot', NULL, 'yama.info.waseda.ac.jp/~yamana/es/', 0, NULL),
('EmailSiphon', 'EmailSiphon', NULL, NULL, -1, NULL),
('EmeraldShield', 'EmeraldShield.com WebBot', NULL, 'emeraldshield.com/webbot.aspx', 0, NULL),
('Educate', 'Educate Search', NULL, NULL, -1, NULL),
('Envolk', 'envolk[ITS]spider/', NULL, 'envolk.com/envolkspider.html', 0, NULL),
('Eruvo', 'EruvoBot', NULL, 'eruvo.com', 0, NULL),
('Esperanza', 'EsperanzaBot', NULL, 'esperanza.to/bot/', 0, NULL),
('eStyle', 'eStyleSearch', NULL, NULL, 0, NULL),
('Eurip', 'EuripBot', NULL, 'eurip.com', 0, NULL),
('Fast', 'FAST MetaWeb Crawler', NULL, NULL, 0, NULL),
('FAST Enterprise', 'FAST Enterprise Crawler', 'fastsearch.net', NULL, 0, NULL),
('Feedster', 'Feedster Crawler', NULL, NULL, 0, NULL),
('FetchAPI', 'Fetch API Request', NULL, NULL, -1, 'Some sort of application that tries to download and store your full website.\r\nDoesn\'t follow robots.txt'),
('fg', 'fgcrawler', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Filangy', 'Filangy', NULL, 'filangy.com/filangyinfo.jsp?inc=robots.jsp', 0, NULL),
('Findexa', 'Findexa Crawler', 'gulesider.no', 'findexa.no/gulesider/article26548.ece', 0, NULL),
('FindLinks', 'findlinks', NULL, 'wortschatz.uni-leipzig.de/findlinks/', 0, NULL),
('Franklin', 'Franklin locator', NULL, NULL, -1, NULL),
('FullWeb', 'Full Web Bot', NULL, NULL, -1, NULL),
('Fyber', 'FyberSpider', NULL, 'fybersearch.com/fyberspider.php', 0, NULL),
('Gais', 'Gaisbot', NULL, 'gais.cs.ccu.edu.tw/robot.php', 0, NULL),
('Genie', 'geniebot', NULL, 'genieknows.com', 0, NULL),
('GetRight', 'GetRight/', NULL, NULL, 0, NULL),
('Giga', 'Gigabot/', NULL, 'gigablast.com/spider.html', 0, NULL),
('Girafa', 'Girafabot', NULL, 'girafa.com', 0, NULL),
('GoForIt', 'GOFORITBOT', NULL, 'goforit.com/about/', 0, NULL),
('Gonzo', 'gonzo1', '.t-ipconnect.de', 'telekom.de', 0, NULL),
('Google', 'Googlebot', 'crawl[0-9\\-]+.googlebot.com', 'google.com/bot.html', 0, NULL),
('GoogleAds', 'Mediapartners-Google', NULL, NULL, 0, NULL),
('GoogleImg', 'Googlebot-Image', NULL, NULL, 0, NULL),
('GPU', 'GPU p2p crawler', NULL, 'gpu.sourceforge.net/search_engine.php', 0, NULL),
('Grub', 'grub-client', NULL, 'grub.org', 0, NULL),
('GSA', 'gsa-crawler', NULL, 'arsenaldigital.com', 0, NULL),
('HappyFun', 'HappyFunBot/', NULL, 'happyfunsearch.com/bot.html', 0, NULL),
('Harvest', 'Harvest/', NULL, NULL, 0, NULL),
('HeadScan', 'head-scan.pl/', NULL, NULL, -1, NULL),
('Heritrix', 'heritrix/', NULL, 'crawler.xtramind.com', 0, NULL),
('HooWWWer', 'HooWWWer', NULL, 'cosco.hiit.fi/search/hoowwwer/', 0, NULL),
('htdig', 'htdig/', NULL, NULL, -1, NULL),
('HTMLParser', 'HTMLParser/', NULL, 'htmlparser.sourceforge.net', -1, 'Doesn\'t follow robots.txt'),
('HTTrack', 'HTTrack', NULL, NULL, 0, NULL),
('Ichiro', 'ichiro/', NULL, 'nttr.co.jp', 0, NULL),
('IconSurf', 'IconSurf/', NULL, 'iconsurf.com/robot.html', 0, NULL),
('Industry', 'Industry Program', NULL, NULL, -1, NULL),
('Indy', 'Indy Library', NULL, NULL, -1, 'Originally, the Indy Library is a programming library which is available at http://www.nevrona.com/Indy or http://indy.torry.net under an Open Source license. This library is included with Borland Delphi 6, 7, C++Builder 6, plus all of the Kylix versions. Unfortunately, this library is hi-jacked and abused by some Chinese spam bots. All recent user-agents with the unmodified \"Indy Library\" string were of Chinese origin.\r\nDoesn\'t follow robots.txt'),
('InetURL', 'InetURL/', NULL, NULL, 0, NULL),
('Infocious', 'InfociousBot', NULL, 'corp.infocious.com/tech_crawler.php', 0, NULL),
('Ingrid', 'INGRID', NULL, 'webmaster.ilse.nl/jsp/webmaster.jsp', 0, NULL),
('Interseek', 'InterseekWeb/', NULL, NULL, 0, NULL),
('Ipwalk', 'IpwalkBot/', NULL, NULL, 0, NULL),
('IRL', 'IRLbot', NULL, 'irl.cs.tamu.edu/crawler', 0, NULL),
('Java', 'Java/', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Jyxo', 'Jyxobot/', NULL, NULL, 0, NULL),
('KnowItAll', 'KnowItAll(', NULL, 'cs.washington.edu', 0, NULL),
('Kumm', 'KummHttp/', NULL, NULL, 0, NULL),
('Lapozz', 'LapozzBot', NULL, 'robot.lapozz.hu/', 0, NULL),
('Larbin', 'larbin', NULL, 'larbin.sourceforge.net/index-eng.html', 0, NULL),
('LeechGet', 'LeechGet', NULL, 'leechget.net', 0, NULL),
('libwww-perl', 'libwww-perl/', NULL, NULL, 0, NULL),
('lmspider', 'lmspider', NULL, 'scansoft.com', 0, NULL),
('Local', 'LocalcomBot/', NULL, 'local.com/bot.htm', 0, NULL),
('Looksmart', 'ZyBorg/', '.looksmart.com', 'WISEnutbot.com', 0, NULL),
('LoveSMS', 'LoveSMS Search Engine', NULL, 'cauta.lovesms.ro', 0, NULL),
('Lycos', 'Lycos_Spider', '.lycos.com', NULL, 0, NULL),
('Mac Finder', 'Mac Finder', NULL, NULL, 0, NULL),
('Majestic-12', 'MJ12bot', NULL, 'majestic12.co.uk/bot.php', 0, NULL),
('MapoftheInternet', 'MapoftheInternet.com', NULL, 'mapoftheinternet.com', 0, NULL),
('McBot', 'McBot/', NULL, NULL, 0, NULL),
('Medusa', 'Medusa', NULL, NULL, -1, 'Medusa is a tool for finding images, movie-clips or other kinds of files on webpages and downloading them. You start by entering a starting URL and Medusa searches for the filetypes you are interested in on this page and all pages found up to a given depth.\r\nDoesn\'t follow robots.txt'),
('Metaspinner', 'Metaspinner/', NULL, 'meta-spinner.de', 0, NULL),
('MetaTag', 'MetaTagRobot', NULL, 'widexl.com/remote/search-engines/metatag-analyzer.html', 0, NULL),
('Minuteman', 'Minuteman', NULL, NULL, 0, NULL),
('Mirago', 'HenryTheMiragoRobot', NULL, 'miragorobot.com/scripts/mrinfo.asp', 0, NULL),
('Missauga', 'Missauga Locate', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Missigua', 'Missigua Locator', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Mister PiX', 'Mister PiX', NULL, NULL, 0, NULL),
('Mojeek', 'MojeekBot', NULL, 'mojeek.com/bot.html', 0, NULL),
('MSCCDS', 'Microsoft Scheduled Cache Cont', NULL, 'google.com/search?q=Scheduled+Cache+Content+Download+Service', -1, NULL),
('MDAIPP', 'Microsoft Data Access Internet', NULL, 'google.com/search?q=Microsoft+Data+Access+Internet+Publishin', -1, 'This agent is used to exploit your system regarding the following security issue in FrontPage2000: http://lists.grok.org.uk/pipermail/full-disclosure/2004-December/030467.html'),
('MSIECrawler', 'MSIECrawler', NULL, NULL, -1, NULL),
('MSN', 'msnbot', 'msnbot.msn.com', 'search.msn.com/msnbot.htm', 0, NULL),
('MSR', 'MSRBOT/', NULL, NULL, 0, NULL),
('MUC', 'Microsoft URL Control', NULL, NULL, 0, NULL),
('Naver', 'NaverBot', NULL, NULL, 0, NULL),
('NetMechanic', 'NetMechanic', NULL, NULL, 0, NULL),
('nicebot', 'nicebot', NULL, NULL, -1, NULL),
('Ninja', 'Download Ninja', NULL, NULL, 0, NULL),
('Noxtrum', 'noxtrumbot', NULL, 'noxtrum.com', 0, NULL),
('NRS', 'NetResearchServer', NULL, 'loopimprovements.com/robot.html', 0, NULL),
('Nutch', 'Nutch', NULL, 'nutch.org/docs/en/bot.html', 0, NULL),
('NutchCVS', 'NutchCVS/', NULL, 'lucene.apache.org/nutch/bot.html', 0, NULL),
('Nutscrape', 'Nutscrape/', NULL, NULL, 0, NULL),
('oegp', 'oegp', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Offline Explorer', 'Offline Explorer/', NULL, 'metaproducts.com', 0, 'A Windows offline browser that allows you to download an unlimited number of your favorite Web and FTP sites for later offline viewing, editing or browsing.'),
('OmniExplorer', 'OmniExplorer_Bot/', NULL, 'omni-explorer.com', -1, 'Doesn\'t follow robots.txt'),
('Onet', 'OnetSzukaj/', NULL, 'szukaj.onet.pl', 0, NULL),
('Openfind', 'Openbot/', NULL, 'openfind.com.tw/robot.html', 0, NULL),
('Orbit', 'Orbiter', NULL, 'dailyorbit.com/bot.htm', 0, NULL),
('P3P Validator', 'P3P Validator', NULL, NULL, 0, NULL),
('Patsearch', 'Patwebbot', NULL, 'herz-power.de/technik.html', 0, NULL),
('PhpDig', 'PhpDig/', NULL, 'phpdig.net/robot.php', 0, NULL),
('PicSearch', 'psbot/', NULL, 'picsearch.com/bot.html', 0, NULL),
('Pipeline', 'pipeLiner', NULL, 'pipeline-search.com/webmaster.html', 0, NULL),
('Pogodak', 'Pogodak', NULL, NULL, 0, NULL),
('Poly', 'polybot', NULL, 'cis.poly.edu/polybot/', 0, NULL),
('Pompos', 'Pompos/', NULL, 'dir.com/pompos.html', 0, NULL),
('Poodle', 'Poodle predictor', NULL, NULL, 0, NULL),
('Powermarks', 'Powermarks/', NULL, 'kaylon.com/power.html', 0, NULL),
('PrivacyFinder', 'PrivacyFinder Cache Bot', NULL, NULL, 0, NULL),
('Privatizer', 'privatizer.net', NULL, 'privatizer.net/whatis.php', 0, NULL),
('Production', 'Production Bot', NULL, NULL, 0, NULL),
('PS', 'Program Shareware', NULL, NULL, 0, NULL),
('PuxaRapido', 'PuxaRapido v1.0', NULL, NULL, 0, NULL),
('Python-urllib', 'Python-urllib/', NULL, NULL, 0, NULL),
('Qweery', 'qweery', NULL, NULL, 0, NULL),
('Rambler', 'StackRambler/', NULL, 'rambler.ru', 0, NULL),
('Roffle', 'Roffle/', NULL, NULL, -1, NULL),
('RPT-HTTP', 'RPT-HTTPClient/', NULL, NULL, -1, NULL),
('rssImages', 'rssImagesBot', NULL, 'herbert.groot.jebbink.nl/?app=rssImages', 0, NULL),
('Ryan', 'Ryanbot/', NULL, NULL, 0, NULL),
('SBIder', 'SBIder/', NULL, 'sitesell.com/sbider.html', 0, NULL),
('schibstedsok', 'schibstedsokbot', NULL, 'schibstedsok.no', 0, NULL),
('Schmozilla', 'Schmozilla/', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Scrubby', 'Scrubby', NULL, 'scrubtheweb.com/abs/meta-check.html', 0, NULL),
('ScSpider', 'ScSpider/', NULL, NULL, 0, NULL),
('SearchGuild', 'SearchGuild/', NULL, NULL, 0, 'DMOZ Experiment'),
('Seekbot', 'Seekbot', NULL, 'seekbot.net', 0, NULL),
('Seznam', 'SeznamBot/', NULL, 'fulltext.seznam.cz', 0, NULL),
('Siets', 'SietsCrawler/', NULL, NULL, 0, NULL),
('SitiDi', '/SitiDiBot/', NULL, 'SitiDi.net', 0, NULL),
('Snoopy', 'Snoopy', NULL, 'sourceforge.net/projects/snoopy/', 0, 'Snoopy is a PHP class that simulates a web browser. It automates the task of retrieving web page content and posting forms, for example.'),
('Sohu', 'sohu-search', NULL, 'sogou.com', 0, 'Searchbot of sohu.com'),
('Spambot', NULL, NULL, NULL, -1, 'Global name for bots which try to fill guestbooks and other stuff with garbage\r\nThey don\'t follow robots.txt either\r\n\r\nCurrent agents in this list:\r\nMissigua Locator\r\nProduction Bot\r\nFull Web Bot\r\nDemo Bot\r\nEducate Search\r\nFranklin locator\r\nIndustry Program\r\nMac Finder\r\nProgram Shareware\r\nMissauga Locate '),
('Spip', 'SPIP-', NULL, 'spip.net', 0, NULL),
('SurveyBot', 'SurveyBot/', NULL, 'whois.sc', 0, NULL),
('Susie', '!Susie', NULL, 'sync2it.com/susie', 0, NULL),
('Thumbshots', 'thumbshots-de-Bot', NULL, 'thumbshots.de', 0, NULL),
('Turnitin', 'TurnitinBot', NULL, 'turnitin.com/robot/crawlerinfo.html', 0, NULL),
('TutorGig', 'TutorGigBot', NULL, 'tutorgig.info', 0, NULL),
('Twiceler', 'Twiceler', NULL, 'cuill.com/robots.html', 0, NULL),
('Updated', 'updated/', NULL, 'updated.com', 0, NULL),
('Versus', 'versus crawler', NULL, 'eda.baykan@epfl.ch', 0, NULL),
('Vagabondo', 'Vagabondo', NULL, NULL, 0, NULL),
('Virgo', 'Virgo/', NULL, NULL, 0, NULL),
('Voila', 'VoilaBot', NULL, 'voila.com', 0, NULL),
('vspider', 'vspider', NULL, NULL, 0, NULL),
('W3C Checklink', 'W3C-checklink', NULL, NULL, 0, NULL),
('W3C Validator', 'W3C_Validator', NULL, NULL, 0, NULL),
('Walhello', 'appie', NULL, 'walhello.com', 0, NULL),
('WebIndexer', 'WebIndexer/', NULL, NULL, 0, NULL),
('WebReaper', 'WebReaper', NULL, 'webreaper.net', 0, NULL),
('WebStripper', 'WebStripper/', NULL, NULL, 0, NULL),
('Wget', 'Wget/', NULL, NULL, 0, NULL),
('Wire', 'WIRE', NULL, NULL, 0, NULL),
('YaCy', 'yacy', NULL, 'yacy.net/yacy/', -1, 'p2p-based distributed Web Search Engine\r\nDoesn\'t follow robots.txt'),
('Yadows', 'YadowsCrawler', NULL, 'yadows.com', 0, NULL),
('Yahoo', 'Yahoo! Slurp', NULL, 'help.yahoo.com/help/us/ysearch/slurp', 0, NULL),
('YahooFS', 'YahooFeedSeeker/', '.yahoo.', 'help.yahoo.com/help/us/ysearch/slurp', 0, NULL),
('YahooMM', 'Yahoo-MMCrawler', NULL, 'help.yahoo.com/help/us/ysearch/slurp', 0, NULL),
('YANDEX', 'YANDEX', NULL, NULL, 0, NULL),
('Zeus', 'Zeus', NULL, NULL, 0, NULL),
('NextGen', 'NextGenSearchBot', NULL, 'about.zoominfo.com/PublicSite/NextGenSearchBot.asp', 0, NULL),
('PoI', 'PictureOfInternet/', NULL, 'malfunction.org/poi', -1, NULL),
('Sensis', 'Sensis Web Crawler', NULL, 'sensis.com.au', 0, NULL),
('IlTrovatore', 'IlTrovatore-Setaccio/', NULL, 'iltrovatore.it/bot.html', -1, NULL),
('Rufus', 'RufusBot', NULL, '64.124.122.252/feedback.html', -1, NULL),
('WebMiner', 'WebMiner', NULL, NULL, -1, 'See RufusBot'),
('Accoona', 'Accoona-AI-Agent/', NULL, 'accoona.com', 0, NULL),
('Xirq', 'xirq/', NULL, 'xirq.com/', 0, NULL),
('Blogpulse', 'Blogpulse', NULL, 'blogpulse.com', 0, 'IntelliSeek service'),
('KnackAttack', 'KnackAttack', NULL, NULL, -1, NULL),
('Miva', 'Miva', NULL, 'miva.com', 0, NULL),
('PictureRipper', 'PictureRipper/', NULL, 'pictureripper.com', -1, NULL),
('Teleport', 'Teleport Pro/', NULL, NULL, -1, NULL),
('NetSprint', 'NetSprint', NULL, NULL, -1, NULL),
('SVSpider', 'SVSpider/', NULL, 'bildkiste.de', -1, NULL),
('SVSearch', 'SVSearchRobot/', NULL, NULL, -1, NULL),
('Lorkyll', 'Lorkyll', NULL, '444.net', -1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_session`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_session` (
  `uname` varchar(255) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `starttime` varchar(14) NOT NULL DEFAULT '',
  `host_addr` varchar(48) NOT NULL DEFAULT '',
  `guest` int(1) NOT NULL DEFAULT 0,
  `module` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_censor`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_censor` (
  `id` int(9) NOT NULL,
  `text` varchar(30) NOT NULL,
  `replacement` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_censor`
--

INSERT DELAYED INTO `nuke_shoutbox_censor` (`id`, `text`, `replacement`) VALUES
(1, '@$$', 'butt'),
(2, 'a$$', 'butt'),
(3, 'anton', '[censored]'),
(4, 'arse', 'butt'),
(5, 'arsehole', '[censored]'),
(6, 'ass', 'butt'),
(7, 'ass muncher', '[censored]'),
(8, 'asshole', '[censored]'),
(9, 'asstooling', '[censored]'),
(10, 'asswipe', '[censored]'),
(11, 'b!tch', '[censored]'),
(12, 'b17ch', '[censored]'),
(13, 'b1tch', '[censored]'),
(14, 'bastard', '[censored]'),
(15, 'beefcurtins', '[censored]'),
(16, 'bi7ch', '[censored]'),
(17, 'bitch', '[censored]'),
(18, 'bitchy', '[censored]'),
(19, 'boiolas', '[censored]'),
(20, 'bollocks', '[censored]'),
(21, 'breasts', '[censored]'),
(22, 'brown nose', '[censored]'),
(23, 'bugger', 'damn'),
(24, 'butt pirate', '[censored]'),
(25, 'c0ck', '[censored]'),
(26, 'cawk', '[censored]'),
(27, 'chink', '[censored]'),
(28, 'clitsaq', '[censored]'),
(29, 'cock', '[censored]'),
(30, 'cockbite', '[censored]'),
(31, 'cockgobbler', '[censored]'),
(32, 'cocksucker', '[censored]'),
(33, 'cum', '[censored]'),
(34, 'cunt', '[censored]'),
(35, 'dago', '[censored]'),
(36, 'daygo', '[censored]'),
(37, 'dego', '[censored]'),
(38, 'dick', '[censored]'),
(39, 'dick wad', '[censored]'),
(40, 'dickhead', '[censored]'),
(41, 'dickweed', '[censored]'),
(42, 'douchebag', '[censored]'),
(43, 'dziwka', '[censored]'),
(44, 'ekto', '[censored]'),
(45, 'enculer', '[censored]'),
(46, 'faen', '[censored]'),
(47, 'fag', '[censored]'),
(48, 'faggot', '[censored]'),
(49, 'fart', '[censored]'),
(50, 'fatass', '[censored]'),
(51, 'feg', '[censored]'),
(52, 'felch', '[censored]'),
(53, 'ficken', '[censored]'),
(54, 'fitta', '[censored]'),
(55, 'fitte', '[censored]'),
(56, 'flikker', '[censored]'),
(57, 'fok', '$#%!'),
(58, 'fuck', '$#%!'),
(59, 'fu(k', '$#%!'),
(60, 'fucker', '[censored]'),
(61, 'fucking', '[censored]'),
(62, 'fuckwit', '[censored]'),
(63, 'fuk', '[censored]'),
(64, 'fuking', '[censored]'),
(65, 'futkretzn', '[censored]'),
(66, 'fux0r', '$#%!'),
(67, 'gook', '[censored]'),
(68, 'h0r', '[censored]'),
(69, 'handjob', '[censored]'),
(70, 'helvete', '[censored]'),
(71, 'honkey', '[censored]'),
(72, 'hore', '[censored]'),
(73, 'hump', '[censored]'),
(74, 'injun', '[censored]'),
(75, 'kawk', '[censored]'),
(76, 'kike', '[censored]'),
(77, 'knulle', '[censored]'),
(78, 'kraut', '[censored]'),
(79, 'kuk', '[censored]'),
(80, 'kuksuger', '[censored]'),
(81, 'kurac', '[censored]'),
(82, 'kurwa', '[censored]'),
(83, 'langer', '[censored]'),
(84, 'masturbation', '[censored]'),
(85, 'merd', '[censored]'),
(86, 'motherfucker', '[censored]'),
(87, 'motherfuckingcocksucker', '[censored]'),
(88, 'mutherfucker', '[censored]'),
(89, 'nepesaurio', '[censored]'),
(90, 'nigga', '[censored]'),
(91, 'nigger', '[censored]'),
(92, 'nonce', '[censored]'),
(93, 'nutsack', '[censored]'),
(94, 'one-eyed-trouser-snake', '[censored]'),
(95, 'penis', '[censored]'),
(96, 'picka', '[censored]'),
(97, 'pissant', '[censored]'),
(98, 'pizda', '[censored]'),
(99, 'politician', '[censored]'),
(100, 'prick', '[censored]'),
(101, 'puckface', '[censored]'),
(102, 'pule', '[censored]'),
(103, 'pussy', '[censored]'),
(104, 'puta', '[censored]'),
(105, 'puto', '[censored]'),
(106, 'rimjob', '[censored]'),
(107, 'rubber', '[censored]'),
(108, 'scheisse', '[censored]'),
(109, 'schlampe', '[censored]'),
(110, 'schlong', '[censored]'),
(111, 'screw', '[censored]'),
(112, 'shit', '****'),
(113, 'shiteater', '[censored]'),
(114, 'shiz', '[censored]'),
(115, 'skribz', '[censored]'),
(116, 'skurwysyn', '[censored]'),
(117, 'slut', '[censored]'),
(118, 'spermburper', '[censored]'),
(119, 'spic', '[censored]'),
(120, 'spierdalaj', '[censored]'),
(121, 'splooge', '[censored]'),
(122, 'spunk', '[censored]'),
(123, 'tatas', '[censored]'),
(124, 'tits', '[censored]'),
(125, 'toss the salad', '[censored]'),
(126, 'twat', '[censored]'),
(127, 'unclefucker', '[censored]'),
(128, 'vagina', '[censored]'),
(129, 'vittu', '[censored]'),
(130, 'votze', '[censored]'),
(131, 'wank', '[censored]'),
(132, 'wanka', '[censored]'),
(133, 'wanker', '[censored]'),
(134, 'wankers', '[censored]'),
(135, 'wankstain', '[censored]'),
(136, 'whore', '[censored]'),
(137, 'wichser', '[censored]'),
(138, 'wop', '[censored]'),
(139, 'yed', '[censored]');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_conf`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_conf` (
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
  `blockxxx` varchar(5) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_conf`
--

INSERT DELAYED INTO `nuke_shoutbox_conf` (`id`, `color1`, `color2`, `date`, `time`, `number`, `ipblock`, `nameblock`, `censor`, `tablewidth`, `urlonoff`, `delyourlastpost`, `anonymouspost`, `height`, `themecolors`, `textWidth`, `nameWidth`, `smiliesPerRow`, `reversePosts`, `timeOffset`, `urlanononoff`, `pointspershout`, `shoutsperpage`, `serverTimezone`, `blockxxx`) VALUES
(1, '#EBEBEB', '#FFFFFF', 'yes', 'yes', '10', 'yes', 'yes', 'yes', '150', 'yes', 'yes', 'yes', '150', 'no', '20', '10', '7', 'no', '0', 'no', '0', '25', '-5', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_date`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_date` (
  `id` int(5) NOT NULL DEFAULT 0,
  `date` varchar(10) NOT NULL DEFAULT '',
  `time` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_date`
--

INSERT DELAYED INTO `nuke_shoutbox_date` (`id`, `date`, `time`) VALUES
(1, 'd-m-Y', 'g:i:a');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_emoticons`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_emoticons` (
  `id` int(9) NOT NULL,
  `text` varchar(20) NOT NULL,
  `image` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_emoticons`
--

INSERT DELAYED INTO `nuke_shoutbox_emoticons` (`id`, `text`, `image`) VALUES
(1, ':D', '<img src=images/blocks/shout_box/icon_biggrin.gif>'),
(2, ':-D', '<img src=images/blocks/shout_box/icon_biggrin.gif>'),
(3, ':grin:', '<img src=images/blocks/shout_box/icon_biggrin.gif>'),
(4, ':)', '<img src=images/blocks/shout_box/icon_smile.gif>'),
(5, ':-)', '<img src=images/blocks/shout_box/icon_smile.gif>'),
(6, ':smile:', '<img src=images/blocks/shout_box/icon_smile.gif>'),
(7, ':(', '<img src=images/blocks/shout_box/icon_sad.gif>'),
(8, ':-(', '<img src=images/blocks/shout_box/icon_sad.gif>'),
(9, ':sad:', '<img src=images/blocks/shout_box/icon_sad.gif>'),
(10, ':o', '<img src=images/blocks/shout_box/icon_surprised.gif>'),
(11, ':-o', '<img src=images/blocks/shout_box/icon_surprised.gif>'),
(12, ';)', '<img src=images/blocks/shout_box/icon_wink.gif>'),
(13, ';-)', '<img src=images/blocks/shout_box/icon_wink.gif>'),
(14, ':wink:', '<img src=images/blocks/shout_box/icon_wink.gif>'),
(15, ':lol:', '<img src=images/blocks/shout_box/icon_lol.gif>'),
(16, '8O', '<img src=images/blocks/shout_box/icon_eek.gif>'),
(17, '8-O', '<img src=images/blocks/shout_box/icon_eek.gif>'),
(18, ':eek:', '<img src=images/blocks/shout_box/icon_eek.gif>'),
(19, ':shock:', '<img src=images/blocks/shout_box/icon_eek.gif>'),
(20, ':?', '<img src=images/blocks/shout_box/icon_confused.gif>'),
(21, ':-?', '<img src=images/blocks/shout_box/icon_confused.gif>'),
(22, ':S', '<img src=images/blocks/shout_box/icon_confused.gif>'),
(23, '8)', '<img src=images/blocks/shout_box/icon_cool.gif>'),
(24, '8-)', '<img src=images/blocks/shout_box/icon_cool.gif>'),
(25, ':x', '<img src=images/blocks/shout_box/icon_mad.gif>'),
(26, ':-x', '<img src=images/blocks/shout_box/icon_mad.gif>'),
(27, ':P', '<img src=images/blocks/shout_box/icon_razz.gif>'),
(28, ':-P', '<img src=images/blocks/shout_box/icon_razz.gif>'),
(29, ':razz:', '<img src=images/blocks/shout_box/icon_razz.gif>'),
(30, ':oops:', '<img src=images/blocks/shout_box/icon_redface.gif>'),
(31, ':redface:', '<img src=images/blocks/shout_box/icon_redface.gif>'),
(32, ':cry:', '<img src=images/blocks/shout_box/icon_cry.gif>'),
(33, ':evil:', '<img src=images/blocks/shout_box/icon_evil.gif>'),
(34, ':twisted:', '<img src=images/blocks/shout_box/icon_twisted.gif>'),
(35, ':roll:', '<img src=images/blocks/shout_box/icon_rolleyes.gif>'),
(36, ':!:', '<img src=images/blocks/shout_box/icon_exclaim.gif>'),
(37, ':exclaim:', '<img src=images/blocks/shout_box/icon_exclaim.gif>'),
(38, ':?:', '<img src=images/blocks/shout_box/icon_question.gif>'),
(39, ':question:', '<img src=images/blocks/shout_box/icon_question.gif>'),
(40, ':idea:', '<img src=images/blocks/shout_box/icon_idea.gif>'),
(41, ':arrow:', '<img src=images/blocks/shout_box/icon_arrow.gif>'),
(42, ':|', '<img src=images/blocks/shout_box/icon_neutral.gif>'),
(43, ':-|', '<img src=images/blocks/shout_box/icon_neutral.gif>'),
(44, ':mrgreen:', '<img src=images/blocks/shout_box/icon_mrgreen.gif>'),
(45, ':shy:', '<img src=images/blocks/shout_box/shy.gif>'),
(46, ':dead:', '<img src=images/blocks/shout_box/dead.gif>'),
(47, ':embar:', '<img src=images/blocks/shout_box/embar.gif>'),
(48, ':bigrazz:', '<img src=images/blocks/shout_box/bigrazz.gif>'),
(49, ':yes:', '<img src=images/blocks/shout_box/yes.gif>'),
(50, ':no:', '<img src=images/blocks/shout_box/no.gif>'),
(51, ':uhoh:', '<img src=images/blocks/shout_box/uhoh.gif>'),
(52, ':upset:', '<img src=images/blocks/shout_box/upset.gif>'),
(53, ':sigh:', '<img src=images/blocks/shout_box/sigh.gif>'),
(54, 'zzz', '<img src=images/blocks/shout_box/sleep.gif>'),
(55, ':sleep:', '<img src=images/blocks/shout_box/sleep.gif>'),
(56, ':confused:', '<img src=images/blocks/shout_box/confused.gif>'),
(57, ':aua:', '<img src=images/blocks/shout_box/aua.gif>');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_ipblock`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_ipblock` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_manage_count`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_manage_count` (
  `id` int(9) NOT NULL,
  `admin` varchar(25) NOT NULL DEFAULT '',
  `aCount` varchar(5) NOT NULL DEFAULT '10'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_manage_count`
--

INSERT DELAYED INTO `nuke_shoutbox_manage_count` (`id`, `admin`, `aCount`) VALUES
(1, 'a', '10'),
(2, 'V', '10'),
(3, 'Q', '10');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_nameblock`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_nameblock` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_shouts`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_shouts` (
  `id` int(9) NOT NULL,
  `name` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `ip` varchar(39) DEFAULT NULL,
  `timestamp` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_shouts`
--

INSERT DELAYED INTO `nuke_shoutbox_shouts` (`id`, `name`, `comment`, `date`, `time`, `ip`, `timestamp`) VALUES
(1, 'SuperCat', 'Thank You for trying my ShoutBox Block, I hope you enjoy using it! ', '1-1-23', '12:00', 'noip', '1672768631'),
(15, 'Administrator', 'Have A Great Day!', '05/01/2023', '15:51', '47.206.216.196', '1672933900'),
(17, 'Administrator', 'zf1 Future Rocks!!', '08/01/2023', '03:42', '173.170.244.40', '1673149336');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_sticky`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_sticky` (
  `id` int(9) NOT NULL,
  `name` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  `stickySlot` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_sticky`
--

INSERT DELAYED INTO `nuke_shoutbox_sticky` (`id`, `name`, `comment`, `timestamp`, `stickySlot`) VALUES
(10, 'Administrator', 'Sticky Shouts Have Been Fixed!', '1673187496', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_themes`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_themes` (
  `id` int(9) NOT NULL,
  `themeName` varchar(50) DEFAULT NULL,
  `blockColor1` varchar(20) DEFAULT NULL,
  `blockColor2` varchar(20) DEFAULT NULL,
  `border` varchar(20) DEFAULT NULL,
  `menuColor1` varchar(20) DEFAULT NULL,
  `menuColor2` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_themes`
--

INSERT DELAYED INTO `nuke_shoutbox_themes` (`id`, `themeName`, `blockColor1`, `blockColor2`, `border`, `menuColor1`, `menuColor2`) VALUES
(1, 'Titanium_Core', '', '', '', '', ''),
(2, 'BlackHole', '#EBEBEB', '#FFFFFF', '#BBBBBB', '#EBEBEB', '#FFFFFF'),
(3, 'BlackJack', '#151515', '#000000', '#151515', '#151515', '#000000'),
(4, 'SimpleBlackV3', '#151515', '#000000', '#151515', '#151515', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_theme_images`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_theme_images` (
  `id` int(9) NOT NULL,
  `themeName` varchar(50) DEFAULT NULL,
  `blockArrowColor` varchar(50) NOT NULL,
  `blockBackgroundImage` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_shoutbox_version`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_shoutbox_version` (
  `id` int(5) NOT NULL,
  `version` varchar(10) NOT NULL,
  `datechecked` varchar(2) NOT NULL,
  `versionreported` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_shoutbox_version`
--

INSERT DELAYED INTO `nuke_shoutbox_version` (`id`, `version`, `datechecked`, `versionreported`) VALUES
(1, '8.5', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_sommaire`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_sommaire` (
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
  `dynamic` char(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_sommaire`
--

INSERT DELAYED INTO `nuke_sommaire` (`groupmenu`, `name`, `image`, `lien`, `hr`, `center`, `bgcolor`, `invisible`, `class`, `bold`, `new`, `listbox`, `dynamic`) VALUES
(0, 'Home', 'icon_home.gif', 'index.php', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(1, 'Discussions', 'icon_community.gif', '', 'on', '', '', 2, 'storytitle', '', '', '', 'on'),
(2, 'News', 'favoritos.gif', '', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(3, 'Files & Links', 'som_downloads.gif', '', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(4, 'General', 'icon_poll.gif', '', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(5, 'Infos', 'icon_members.gif', '', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_sommaire_categories`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_sommaire_categories` (
  `id` int(11) NOT NULL,
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `module` varchar(50) NOT NULL DEFAULT '',
  `url` text NOT NULL,
  `url_text` text NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT '',
  `new` char(2) DEFAULT NULL,
  `new_days` tinyint(4) NOT NULL DEFAULT -1,
  `class` varchar(20) DEFAULT NULL,
  `bold` char(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_sommaire_categories`
--

INSERT DELAYED INTO `nuke_sommaire_categories` (`id`, `groupmenu`, `module`, `url`, `url_text`, `image`, `new`, `new_days`, `class`, `bold`) VALUES
(1, 1, 'Forums', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(2, 1, 'Private_Messages', '', '', 'tree-L.gif', '', 7, 'boxcontent', ''),
(3, 2, 'News', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(4, 2, 'Topics', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(5, 2, 'Stories_Archive', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(6, 2, 'Submit_News', '', '', 'tree-L.gif', '', 7, 'boxcontent', ''),
(7, 3, 'Downloads', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(8, 3, 'Web_Links', '', '', 'tree-L.gif', '', 7, 'boxcontent', ''),
(9, 4, 'Content', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(10, 4, 'faq', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(11, 4, 'Top', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(12, 4, 'Reviews', '', '', 'tree-L.gif', '', 7, 'boxcontent', ''),
(13, 5, 'Feedback', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(14, 5, 'Recommend_Us', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(15, 5, 'Statistics', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(16, 5, 'Search', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(17, 5, 'Your_Account', '', '', 'tree-L.gif', '', 7, 'boxcontent', '');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_stats_hour`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_stats_hour` (
  `year` smallint(6) NOT NULL DEFAULT 0,
  `month` tinyint(4) NOT NULL DEFAULT 0,
  `date` tinyint(4) NOT NULL DEFAULT 0,
  `hour` tinyint(4) NOT NULL DEFAULT 0,
  `hits` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_subscriptions`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_subscriptions` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL DEFAULT 0,
  `subscription_expire` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_themes`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_themes` (
  `theme_name` varchar(100) NOT NULL DEFAULT '',
  `groups` varchar(50) NOT NULL DEFAULT '',
  `permissions` tinyint(2) NOT NULL DEFAULT 1,
  `custom_name` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `theme_info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_themes`
--

INSERT DELAYED INTO `nuke_themes` (`theme_name`, `groups`, `permissions`, `custom_name`, `active`, `theme_info`) VALUES
('BlackJack', '', 1, 'BlackJack v1.0', 1, '93%:::#000000:::#151515:::#262626:::#262626:::#ccc:::#ccc:::Go to Theme Options to Edit Footer Message Line 1:::Go to Theme Options to Edit Footer Message Line 2:::green:::dark'),
('SimpleBlackV3', '', 1, 'SimpleBlackV3', 1, '93%:::#000000:::#151515:::#262626:::#262626:::#ccc:::#ccc:::Go to Theme Options to Edit Footer Message Line 1:::Go to Theme Options to Edit Footer Message Line 2:::green:::dark'),
('Blue_Tech', '', 1, 'Blue Tech v1.0', 1, '93%:::#454545:::#383838:::#383838:::#383838:::#ccc:::#ccc:::Go to Theme Options to Edit Footer Message Line 1:::Go to Theme Options to Edit Footer Message Line 2:::#D29A2B:::dark');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_users` (
  `user_id` int(11) NOT NULL,
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
  `user_allow_arcadepm` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_users`
--

INSERT DELAYED INTO `nuke_users` (`user_id`, `name`, `username`, `user_email`, `femail`, `user_website`, `user_avatar`, `user_regdate`, `user_occ`, `user_from`, `user_from_flag`, `user_interests`, `user_sig`, `user_viewemail`, `user_theme`, `user_facebook`, `user_password`, `storynum`, `umode`, `uorder`, `thold`, `noscore`, `bio`, `ublockon`, `ublock`, `theme`, `commentmax`, `counter`, `newsletter`, `user_posts`, `user_attachsig`, `user_rank`, `user_level`, `broadcast`, `popmeson`, `user_active`, `user_session_time`, `user_session_page`, `user_lastvisit`, `user_timezone`, `user_style`, `user_lang`, `user_dateformat`, `user_new_privmsg`, `user_unread_privmsg`, `user_last_privmsg`, `user_emailtime`, `user_allowhtml`, `user_allowbbcode`, `user_allowsmile`, `user_allowavatar`, `user_allow_pm`, `user_allow_mass_pm`, `user_allow_viewonline`, `user_notify`, `user_notify_pm`, `user_popup_pm`, `user_avatar_type`, `user_sig_bbcode_uid`, `user_actkey`, `user_newpasswd`, `points`, `last_ip`, `user_wordwrap`, `agreedtos`, `user_allowsignature`, `user_report_optout`, `user_show_quickreply`, `user_quickreply_mode`, `user_color_gc`, `user_color_gi`, `user_showavatars`, `user_showsignatures`, `user_time_mode`, `user_dst_time_lag`, `user_pc_timeOffsets`, `user_view_log`, `user_glance_show`, `user_hide_images`, `user_open_quickreply`, `sceditor_in_source`, `xdata_bbcode`, `user_ftr`, `user_ftr_time`, `user_rank2`, `user_rank3`, `user_rank4`, `user_rank5`, `user_gender`, `user_birthday`, `user_birthday2`, `birthday_display`, `birthday_greeting`, `user_next_birthday`, `user_reputation`, `user_rep_last_time`, `user_admin_notes`, `user_allow_arcadepm`) VALUES
(1, '', 'Anonymous', '', '', '', 'blank.png', 'Jan 01, 2022', '', '', NULL, '', '', 0, 0, NULL, '', 10, '', 0, 0, 0, '', 0, '', '', 4096, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, '10.00', NULL, 'english', 'D M d, Y g:i a', 0, 0, 0, NULL, 1, 1, 1, 1, 1, 0, 1, 1, 0, 0, 3, NULL, NULL, NULL, 0, '0', 70, 0, 0, 0, 0, 0, '', '', 1, 1, 6, 60, '0', 0, '1', 0, 1, 0, '', 0, 0, -1, -2, -2, -2, 0, 0, NULL, 0, 0, 0, 43.2825, 1243272322, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_countries`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_users_countries` (
  `id_country` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `iso_code_2` char(2) NOT NULL DEFAULT '',
  `iso_code_3` char(3) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nuke_users_countries`
--

INSERT DELAYED INTO `nuke_users_countries` (`id_country`, `name`, `iso_code_2`, `iso_code_3`) VALUES
(1, 'Afghanistan', 'AF', 'AFG'),
(2, 'Albania', 'AL', 'ALB'),
(3, 'Algeria', 'DZ', 'DZA'),
(4, 'American Samoa', 'AS', 'ASM'),
(5, 'Andorra', 'AD', 'AND'),
(6, 'Angola', 'AO', 'AGO'),
(7, 'Anguilla', 'AI', 'AIA'),
(8, 'Antarctica', 'AQ', 'ATA'),
(9, 'Antigua and Barbuda', 'AG', 'ATG'),
(10, 'Argentina', 'AR', 'ARG'),
(11, 'Armenia', 'AM', 'ARM'),
(12, 'Aruba', 'AW', 'ABW'),
(13, 'Australia', 'AU', 'AUS'),
(14, 'Austria', 'AT', 'AUT'),
(15, 'Azerbaijan', 'AZ', 'AZE'),
(16, 'Bahamas', 'BS', 'BHS'),
(17, 'Bahrain', 'BH', 'BHR'),
(18, 'Bangladesh', 'BD', 'BGD'),
(19, 'Barbados', 'BB', 'BRB'),
(20, 'Belarus', 'BY', 'BLR'),
(21, 'Belgium', 'BE', 'BEL'),
(22, 'Belize', 'BZ', 'BLZ'),
(23, 'Benin', 'BJ', 'BEN'),
(24, 'Bermuda', 'BM', 'BMU'),
(25, 'Bhutan', 'BT', 'BTN'),
(26, 'Bolivia', 'BO', 'BOL'),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH'),
(28, 'Botswana', 'BW', 'BWA'),
(29, 'Bouvet Island', 'BV', 'BVT'),
(30, 'Brazil', 'BR', 'BRA'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT'),
(32, 'Brunei Darussalam', 'BN', 'BRN'),
(33, 'Bulgaria', 'BG', 'BGR'),
(34, 'Burkina Faso', 'BF', 'BFA'),
(35, 'Burundi', 'BI', 'BDI'),
(36, 'Cambodia', 'KH', 'KHM'),
(37, 'Cameroon', 'CM', 'CMR'),
(38, 'Canada', 'CA', 'CAN'),
(39, 'Cape Verde', 'CV', 'CPV'),
(40, 'Cayman Islands', 'KY', 'CYM'),
(41, 'Central African Republic', 'CF', 'CAF'),
(42, 'Chad', 'TD', 'TCD'),
(43, 'Chile', 'CL', 'CHL'),
(44, 'China', 'CN', 'CHN'),
(45, 'Christmas Island', 'CX', 'CXR'),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK'),
(47, 'Colombia', 'CO', 'COL'),
(48, 'Comoros', 'KM', 'COM'),
(49, 'Congo', 'CG', 'COG'),
(50, 'Cook Islands', 'CK', 'COK'),
(51, 'Costa Rica', 'CR', 'CRI'),
(52, 'Cote D\'Ivoire', 'CI', 'CIV'),
(53, 'Croatia', 'HR', 'HRV'),
(54, 'Cuba', 'CU', 'CUB'),
(55, 'Cyprus', 'CY', 'CYP'),
(56, 'Czech Republic', 'CZ', 'CZE'),
(57, 'Denmark', 'DK', 'DNK'),
(58, 'Djibouti', 'DJ', 'DJI'),
(59, 'Dominica', 'DM', 'DMA'),
(60, 'Dominican Republic', 'DO', 'DOM'),
(61, 'East Timor', 'TP', 'TMP'),
(62, 'Ecuador', 'EC', 'ECU'),
(63, 'Egypt', 'EG', 'EGY'),
(64, 'El Salvador', 'SV', 'SLV'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ'),
(66, 'Eritrea', 'ER', 'ERI'),
(67, 'Estonia', 'EE', 'EST'),
(68, 'Ethiopia', 'ET', 'ETH'),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK'),
(70, 'Faroe Islands', 'FO', 'FRO'),
(71, 'Fiji', 'FJ', 'FJI'),
(72, 'Finland', 'FI', 'FIN'),
(73, 'France', 'FR', 'FRA'),
(74, 'France, Metropolitan', 'FX', 'FXX'),
(75, 'French Guiana', 'GF', 'GUF'),
(76, 'French Polynesia', 'PF', 'PYF'),
(77, 'French Southern Territories', 'TF', 'ATF'),
(78, 'Gabon', 'GA', 'GAB'),
(79, 'Gambia', 'GM', 'GMB'),
(80, 'Georgia', 'GE', 'GEO'),
(81, 'Germany', 'DE', 'DEU'),
(82, 'Ghana', 'GH', 'GHA'),
(83, 'Gibraltar', 'GI', 'GIB'),
(84, 'Greece', 'GR', 'GRC'),
(85, 'Greenland', 'GL', 'GRL'),
(86, 'Grenada', 'GD', 'GRD'),
(87, 'Guadeloupe', 'GP', 'GLP'),
(88, 'Guam', 'GU', 'GUM'),
(89, 'Guatemala', 'GT', 'GTM'),
(90, 'Guinea', 'GN', 'GIN'),
(91, 'Guinea-bissau', 'GW', 'GNB'),
(92, 'Guyana', 'GY', 'GUY'),
(93, 'Haiti', 'HT', 'HTI'),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD'),
(95, 'Honduras', 'HN', 'HND'),
(96, 'Hong Kong', 'HK', 'HKG'),
(97, 'Hungary', 'HU', 'HUN'),
(98, 'Iceland', 'IS', 'ISL'),
(99, 'India', 'IN', 'IND'),
(100, 'Indonesia', 'ID', 'IDN'),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN'),
(102, 'Iraq', 'IQ', 'IRQ'),
(103, 'Ireland', 'IE', 'IRL'),
(104, 'Israel', 'IL', 'ISR'),
(105, 'Italy', 'IT', 'ITA'),
(106, 'Jamaica', 'JM', 'JAM'),
(107, 'Japan', 'JP', 'JPN'),
(108, 'Jordan', 'JO', 'JOR'),
(109, 'Kazakhstan', 'KZ', 'KAZ'),
(110, 'Kenya', 'KE', 'KEN'),
(111, 'Kiribati', 'KI', 'KIR'),
(112, 'Korea, Democratic People\'s Republic of', 'KP', 'PRK'),
(113, 'Korea, Republic of', 'KR', 'KOR'),
(114, 'Kuwait', 'KW', 'KWT'),
(115, 'Kyrgyzstan', 'KG', 'KGZ'),
(116, 'Lao People\'s Democratic Republic', 'LA', 'LAO'),
(117, 'Latvia', 'LV', 'LVA'),
(118, 'Lebanon', 'LB', 'LBN'),
(119, 'Lesotho', 'LS', 'LSO'),
(120, 'Liberia', 'LR', 'LBR'),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY'),
(122, 'Liechtenstein', 'LI', 'LIE'),
(123, 'Lithuania', 'LT', 'LTU'),
(124, 'Luxembourg', 'LU', 'LUX'),
(125, 'Macau', 'MO', 'MAC'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD'),
(127, 'Madagascar', 'MG', 'MDG'),
(128, 'Malawi', 'MW', 'MWI'),
(129, 'Malaysia', 'MY', 'MYS'),
(130, 'Maldives', 'MV', 'MDV'),
(131, 'Mali', 'ML', 'MLI'),
(132, 'Malta', 'MT', 'MLT'),
(133, 'Marshall Islands', 'MH', 'MHL'),
(134, 'Martinique', 'MQ', 'MTQ'),
(135, 'Mauritania', 'MR', 'MRT'),
(136, 'Mauritius', 'MU', 'MUS'),
(137, 'Mayotte', 'YT', 'MYT'),
(138, 'Mexico', 'MX', 'MEX'),
(139, 'Micronesia, Federated States of', 'FM', 'FSM'),
(140, 'Moldova, Republic of', 'MD', 'MDA'),
(141, 'Monaco', 'MC', 'MCO'),
(142, 'Mongolia', 'MN', 'MNG'),
(143, 'Montserrat', 'MS', 'MSR'),
(144, 'Morocco', 'MA', 'MAR'),
(145, 'Mozambique', 'MZ', 'MOZ'),
(146, 'Myanmar', 'MM', 'MMR'),
(147, 'Namibia', 'NA', 'NAM'),
(148, 'Nauru', 'NR', 'NRU'),
(149, 'Nepal', 'NP', 'NPL'),
(150, 'Netherlands', 'NL', 'NLD'),
(151, 'Netherlands Antilles', 'AN', 'ANT'),
(152, 'New Caledonia', 'NC', 'NCL'),
(153, 'New Zealand', 'NZ', 'NZL'),
(154, 'Nicaragua', 'NI', 'NIC'),
(155, 'Niger', 'NE', 'NER'),
(156, 'Nigeria', 'NG', 'NGA'),
(157, 'Niue', 'NU', 'NIU'),
(158, 'Norfolk Island', 'NF', 'NFK'),
(159, 'Northern Mariana Islands', 'MP', 'MNP'),
(160, 'Norway', 'NO', 'NOR'),
(161, 'Oman', 'OM', 'OMN'),
(162, 'Pakistan', 'PK', 'PAK'),
(163, 'Palau', 'PW', 'PLW'),
(164, 'Panama', 'PA', 'PAN'),
(165, 'Papua New Guinea', 'PG', 'PNG'),
(166, 'Paraguay', 'PY', 'PRY'),
(167, 'Peru', 'PE', 'PER'),
(168, 'Philippines', 'PH', 'PHL'),
(169, 'Pitcairn', 'PN', 'PCN'),
(170, 'Poland', 'PL', 'POL'),
(171, 'Portugal', 'PT', 'PRT'),
(172, 'Puerto Rico', 'PR', 'PRI'),
(173, 'Qatar', 'QA', 'QAT'),
(174, 'Reunion', 'RE', 'REU'),
(175, 'Romania', 'RO', 'ROM'),
(176, 'Russian Federation', 'RU', 'RUS'),
(177, 'Rwanda', 'RW', 'RWA'),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA'),
(179, 'Saint Lucia', 'LC', 'LCA'),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT'),
(181, 'Samoa', 'WS', 'WSM'),
(182, 'San Marino', 'SM', 'SMR'),
(183, 'Sao Tome and Principe', 'ST', 'STP'),
(184, 'Saudi Arabia', 'SA', 'SAU'),
(185, 'Senegal', 'SN', 'SEN'),
(186, 'Serbia', 'RS', 'SER'),
(187, 'Seychelles', 'SC', 'SYC'),
(188, 'Sierra Leone', 'SL', 'SLE'),
(189, 'Singapore', 'SG', 'SGP'),
(190, 'Sudan', 'SD', 'SDN'),
(191, 'Slovenia', 'SI', 'SVN'),
(192, 'Solomon Islands', 'SB', 'SLB'),
(193, 'Somalia', 'SO', 'SOM'),
(194, 'South Africa', 'ZA', 'ZAF'),
(195, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS'),
(196, 'Spain', 'ES', 'ESP'),
(197, 'Sri Lanka', 'LK', 'LKA'),
(198, 'St. Helena', 'SH', 'SHN'),
(199, 'St. Pierre and Miquelon', 'PM', 'SPM'),
(201, 'Suriname', 'SR', 'SUR'),
(202, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM'),
(203, 'Swaziland', 'SZ', 'SWZ'),
(204, 'Sweden', 'SE', 'SWE'),
(205, 'Switzerland', 'CH', 'CHE'),
(206, 'Syrian Arab Republic', 'SY', 'SYR'),
(207, 'Taiwan', 'TW', 'TWN'),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA'),
(209, 'Thailand', 'TH', 'THA'),
(210, 'Togo', 'TG', 'TGO'),
(211, 'Tokelau', 'TK', 'TKL'),
(212, 'Tonga', 'TO', 'TON'),
(213, 'Trinidad and Tobago', 'TT', 'TTO'),
(214, 'Tunisia', 'TN', 'TUN'),
(215, 'Turkey', 'TR', 'TUR'),
(216, 'Turkmenistan', 'TM', 'TKM'),
(217, 'Turks and Caicos Islands', 'TC', 'TCA'),
(218, 'Tuvalu', 'TV', 'TUV'),
(219, 'Uganda', 'UG', 'UGA'),
(220, 'Ukraine', 'UA', 'UKR'),
(221, 'United Arab Emirates', 'AE', 'ARE'),
(222, 'United Kingdom', 'GB', 'GBR'),
(223, 'United States', 'US', 'USA'),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI'),
(225, 'Uruguay', 'UY', 'URY'),
(226, 'Uzbekistan', 'UZ', 'UZB'),
(227, 'Vanuatu', 'VU', 'VUT'),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT'),
(229, 'Venezuela', 'VE', 'VEN'),
(230, 'Viet Nam', 'VN', 'VNM'),
(231, 'Virgin Islands (British)', 'VG', 'VGB'),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR'),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF'),
(234, 'Western Sahara', 'EH', 'ESH'),
(235, 'Yemen', 'YE', 'YEM'),
(237, 'Zaire', 'ZR', 'ZAR'),
(238, 'Zambia', 'ZM', 'ZMB'),
(239, 'Zimbabwe', 'ZW', 'ZWE');

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_temp`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_users_temp` (
  `user_id` int(10) NOT NULL,
  `username` varchar(25) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `user_regdate` varchar(20) NOT NULL DEFAULT '',
  `check_num` varchar(50) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `realname` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_users_who_been`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_users_who_been` (
  `user_ID` int(11) NOT NULL DEFAULT 0,
  `username` varchar(25) NOT NULL DEFAULT '',
  `last_visit` int(15) DEFAULT NULL,
  `resolution` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nuke_welcome_pm`
--
-- Creation: Jan 26, 2023 at 04:11 PM
-- Last update: Jan 26, 2023 at 04:11 PM
-- Last check: Jan 26, 2023 at 04:11 PM
--

CREATE TABLE `nuke_welcome_pm` (
  `subject` varchar(30) NOT NULL DEFAULT '',
  `msg` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nuke_admin_fc`
--
ALTER TABLE `nuke_admin_fc`
  ADD PRIMARY KEY (`fc_attempts`);

--
-- Indexes for table `nuke_authors`
--
ALTER TABLE `nuke_authors`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `nuke_banner`
--
ALTER TABLE `nuke_banner`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_banner_clients`
--
ALTER TABLE `nuke_banner_clients`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_banner_plans`
--
ALTER TABLE `nuke_banner_plans`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `nuke_banner_positions`
--
ALTER TABLE `nuke_banner_positions`
  ADD PRIMARY KEY (`apid`),
  ADD KEY `position_number` (`position_number`);

--
-- Indexes for table `nuke_bbadvanced_username_color`
--
ALTER TABLE `nuke_bbadvanced_username_color`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `nuke_bbarcade`
--
ALTER TABLE `nuke_bbarcade`
  ADD PRIMARY KEY (`arcade_name`);

--
-- Indexes for table `nuke_bbarcade_categories`
--
ALTER TABLE `nuke_bbarcade_categories`
  ADD KEY `arcade_catid` (`arcade_catid`);

--
-- Indexes for table `nuke_bbarcade_fav`
--
ALTER TABLE `nuke_bbarcade_fav`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order` (`order`);

--
-- Indexes for table `nuke_bbattachments`
--
ALTER TABLE `nuke_bbattachments`
  ADD KEY `attach_id_post_id` (`attach_id`,`post_id`),
  ADD KEY `attach_id_privmsgs_id` (`attach_id`,`privmsgs_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `privmsgs_id` (`privmsgs_id`);

--
-- Indexes for table `nuke_bbattachments_config`
--
ALTER TABLE `nuke_bbattachments_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_bbattachments_desc`
--
ALTER TABLE `nuke_bbattachments_desc`
  ADD PRIMARY KEY (`attach_id`),
  ADD KEY `filetime` (`filetime`),
  ADD KEY `physical_filename` (`physical_filename`(10)),
  ADD KEY `filesize` (`filesize`);

--
-- Indexes for table `nuke_bbattach_quota`
--
ALTER TABLE `nuke_bbattach_quota`
  ADD KEY `quota_type` (`quota_type`);

--
-- Indexes for table `nuke_bbauth_access`
--
ALTER TABLE `nuke_bbauth_access`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `nuke_bbauth_arcade_access`
--
ALTER TABLE `nuke_bbauth_arcade_access`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `arcade_catid` (`arcade_catid`);

--
-- Indexes for table `nuke_bbbanlist`
--
ALTER TABLE `nuke_bbbanlist`
  ADD PRIMARY KEY (`ban_id`),
  ADD KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`);

--
-- Indexes for table `nuke_bbcategories`
--
ALTER TABLE `nuke_bbcategories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_order` (`cat_order`);

--
-- Indexes for table `nuke_bbconfig`
--
ALTER TABLE `nuke_bbconfig`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_bbdisallow`
--
ALTER TABLE `nuke_bbdisallow`
  ADD PRIMARY KEY (`disallow_id`);

--
-- Indexes for table `nuke_bbextensions`
--
ALTER TABLE `nuke_bbextensions`
  ADD PRIMARY KEY (`ext_id`);

--
-- Indexes for table `nuke_bbextension_groups`
--
ALTER TABLE `nuke_bbextension_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `nuke_bbflags`
--
ALTER TABLE `nuke_bbflags`
  ADD PRIMARY KEY (`flag_id`);

--
-- Indexes for table `nuke_bbforbidden_extensions`
--
ALTER TABLE `nuke_bbforbidden_extensions`
  ADD PRIMARY KEY (`ext_id`);

--
-- Indexes for table `nuke_bbforums`
--
ALTER TABLE `nuke_bbforums`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `forums_order` (`forum_order`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `forum_last_post_id` (`forum_last_post_id`);

--
-- Indexes for table `nuke_bbforum_prune`
--
ALTER TABLE `nuke_bbforum_prune`
  ADD PRIMARY KEY (`prune_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `nuke_bbgames`
--
ALTER TABLE `nuke_bbgames`
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `nuke_bbgroups`
--
ALTER TABLE `nuke_bbgroups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_single_user` (`group_single_user`);

--
-- Indexes for table `nuke_bbinline_ads`
--
ALTER TABLE `nuke_bbinline_ads`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `nuke_bblogs`
--
ALTER TABLE `nuke_bblogs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `nuke_bblogs_config`
--
ALTER TABLE `nuke_bblogs_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_bbposts`
--
ALTER TABLE `nuke_bbposts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `poster_id` (`poster_id`),
  ADD KEY `post_time` (`post_time`),
  ADD KEY `post_icon` (`post_icon`);

--
-- Indexes for table `nuke_bbposts_text`
--
ALTER TABLE `nuke_bbposts_text`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `nuke_bbpost_reports`
--
ALTER TABLE `nuke_bbpost_reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `nuke_bbprivmsgs`
--
ALTER TABLE `nuke_bbprivmsgs`
  ADD PRIMARY KEY (`privmsgs_id`),
  ADD KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  ADD KEY `privmsgs_to_userid` (`privmsgs_to_userid`);

--
-- Indexes for table `nuke_bbprivmsgs_archive`
--
ALTER TABLE `nuke_bbprivmsgs_archive`
  ADD PRIMARY KEY (`privmsgs_id`),
  ADD KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  ADD KEY `privmsgs_to_userid` (`privmsgs_to_userid`);

--
-- Indexes for table `nuke_bbprivmsgs_text`
--
ALTER TABLE `nuke_bbprivmsgs_text`
  ADD PRIMARY KEY (`privmsgs_text_id`);

--
-- Indexes for table `nuke_bbquicksearch`
--
ALTER TABLE `nuke_bbquicksearch`
  ADD PRIMARY KEY (`search_id`);

--
-- Indexes for table `nuke_bbquota_limits`
--
ALTER TABLE `nuke_bbquota_limits`
  ADD PRIMARY KEY (`quota_limit_id`);

--
-- Indexes for table `nuke_bbranks`
--
ALTER TABLE `nuke_bbranks`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `nuke_bbreputation`
--
ALTER TABLE `nuke_bbreputation`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_bbscores`
--
ALTER TABLE `nuke_bbscores`
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_bbsearch_rebuild`
--
ALTER TABLE `nuke_bbsearch_rebuild`
  ADD PRIMARY KEY (`rebuild_session_id`),
  ADD KEY `end_post_id` (`end_post_id`);

--
-- Indexes for table `nuke_bbsearch_results`
--
ALTER TABLE `nuke_bbsearch_results`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `nuke_bbsearch_wordlist`
--
ALTER TABLE `nuke_bbsearch_wordlist`
  ADD PRIMARY KEY (`word_text`),
  ADD KEY `word_id` (`word_id`);

--
-- Indexes for table `nuke_bbsearch_wordmatch`
--
ALTER TABLE `nuke_bbsearch_wordmatch`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `word_id` (`word_id`);

--
-- Indexes for table `nuke_bbsessions`
--
ALTER TABLE `nuke_bbsessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `session_user_id` (`session_user_id`),
  ADD KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`);

--
-- Indexes for table `nuke_bbsessions_keys`
--
ALTER TABLE `nuke_bbsessions_keys`
  ADD PRIMARY KEY (`key_id`,`user_id`),
  ADD KEY `last_login` (`last_login`);

--
-- Indexes for table `nuke_bbsmilies`
--
ALTER TABLE `nuke_bbsmilies`
  ADD PRIMARY KEY (`smilies_id`);

--
-- Indexes for table `nuke_bbstats_config`
--
ALTER TABLE `nuke_bbstats_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_bbstats_modules`
--
ALTER TABLE `nuke_bbstats_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `nuke_bbstats_module_admin_panel`
--
ALTER TABLE `nuke_bbstats_module_admin_panel`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `nuke_bbstats_module_cache`
--
ALTER TABLE `nuke_bbstats_module_cache`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `nuke_bbstats_module_group_auth`
--
ALTER TABLE `nuke_bbstats_module_group_auth`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `nuke_bbstats_module_info`
--
ALTER TABLE `nuke_bbstats_module_info`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `nuke_bbstats_smilies_index`
--
ALTER TABLE `nuke_bbstats_smilies_index`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `nuke_bbstats_smilies_info`
--
ALTER TABLE `nuke_bbstats_smilies_info`
  ADD PRIMARY KEY (`last_post_id`);

--
-- Indexes for table `nuke_bbthemes`
--
ALTER TABLE `nuke_bbthemes`
  ADD PRIMARY KEY (`themes_id`);

--
-- Indexes for table `nuke_bbthemes_name`
--
ALTER TABLE `nuke_bbthemes_name`
  ADD PRIMARY KEY (`themes_id`);

--
-- Indexes for table `nuke_bbtopics`
--
ALTER TABLE `nuke_bbtopics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `topic_moved_id` (`topic_moved_id`),
  ADD KEY `topic_status` (`topic_status`),
  ADD KEY `topic_type` (`topic_type`);

--
-- Indexes for table `nuke_bbtopics_watch`
--
ALTER TABLE `nuke_bbtopics_watch`
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notify_status` (`notify_status`);

--
-- Indexes for table `nuke_bbtopic_moved`
--
ALTER TABLE `nuke_bbtopic_moved`
  ADD PRIMARY KEY (`moved_id`);

--
-- Indexes for table `nuke_bbuser_group`
--
ALTER TABLE `nuke_bbuser_group`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_bbvote_desc`
--
ALTER TABLE `nuke_bbvote_desc`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `nuke_bbvote_results`
--
ALTER TABLE `nuke_bbvote_results`
  ADD KEY `vote_option_id` (`vote_option_id`),
  ADD KEY `vote_id` (`vote_id`);

--
-- Indexes for table `nuke_bbvote_voters`
--
ALTER TABLE `nuke_bbvote_voters`
  ADD KEY `vote_id` (`vote_id`),
  ADD KEY `vote_user_id` (`vote_user_id`),
  ADD KEY `vote_user_ip` (`vote_user_ip`),
  ADD KEY `vote_cast` (`vote_cast`);

--
-- Indexes for table `nuke_bbwords`
--
ALTER TABLE `nuke_bbwords`
  ADD PRIMARY KEY (`word_id`);

--
-- Indexes for table `nuke_bbxdata_fields`
--
ALTER TABLE `nuke_bbxdata_fields`
  ADD PRIMARY KEY (`field_id`),
  ADD UNIQUE KEY `code_name` (`code_name`);

--
-- Indexes for table `nuke_blocks`
--
ALTER TABLE `nuke_blocks`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_blogs`
--
ALTER TABLE `nuke_blogs`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `counter` (`counter`),
  ADD KEY `topic` (`topic`);

--
-- Indexes for table `nuke_blogs_autoblog`
--
ALTER TABLE `nuke_blogs_autoblog`
  ADD PRIMARY KEY (`anid`),
  ADD UNIQUE KEY `anid` (`anid`);

--
-- Indexes for table `nuke_blogs_cat`
--
ALTER TABLE `nuke_blogs_cat`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `nuke_blogs_comments`
--
ALTER TABLE `nuke_blogs_comments`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `nuke_blogs_queue`
--
ALTER TABLE `nuke_blogs_queue`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `nuke_blogs_topics`
--
ALTER TABLE `nuke_blogs_topics`
  ADD PRIMARY KEY (`topicid`);

--
-- Indexes for table `nuke_bookmarks`
--
ALTER TABLE `nuke_bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_bookmarks_cat`
--
ALTER TABLE `nuke_bookmarks_cat`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_cemetery`
--
ALTER TABLE `nuke_cemetery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_cemetery_cat`
--
ALTER TABLE `nuke_cemetery_cat`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nuke_cnbya_config`
--
ALTER TABLE `nuke_cnbya_config`
  ADD UNIQUE KEY `config_name` (`config_name`);

--
-- Indexes for table `nuke_cnbya_field`
--
ALTER TABLE `nuke_cnbya_field`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `nuke_cnbya_value`
--
ALTER TABLE `nuke_cnbya_value`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `nuke_cnbya_value_temp`
--
ALTER TABLE `nuke_cnbya_value_temp`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `nuke_config`
--
ALTER TABLE `nuke_config`
  ADD UNIQUE KEY `Version_Num` (`Version_Num`);

--
-- Indexes for table `nuke_confirm`
--
ALTER TABLE `nuke_confirm`
  ADD PRIMARY KEY (`session_id`,`confirm_id`);

--
-- Indexes for table `nuke_counter`
--
ALTER TABLE `nuke_counter`
  ADD KEY `var` (`var`);

--
-- Indexes for table `nuke_donators`
--
ALTER TABLE `nuke_donators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_donators_config`
--
ALTER TABLE `nuke_donators_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_ecalendar`
--
ALTER TABLE `nuke_ecalendar`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `nuke_evolution`
--
ALTER TABLE `nuke_evolution`
  ADD PRIMARY KEY (`evo_field`);

--
-- Indexes for table `nuke_evo_userinfo_addons`
--
ALTER TABLE `nuke_evo_userinfo_addons`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `nuke_faqanswer`
--
ALTER TABLE `nuke_faqanswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indexes for table `nuke_faqcategories`
--
ALTER TABLE `nuke_faqcategories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `nuke_file_repository_categories`
--
ALTER TABLE `nuke_file_repository_categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_file_repository_comments`
--
ALTER TABLE `nuke_file_repository_comments`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_file_repository_files`
--
ALTER TABLE `nuke_file_repository_files`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `nuke_file_repository_items`
--
ALTER TABLE `nuke_file_repository_items`
  ADD PRIMARY KEY (`did`),
  ADD KEY `cid` (`cid`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_file_repository_screenshots`
--
ALTER TABLE `nuke_file_repository_screenshots`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `nuke_file_repository_settings`
--
ALTER TABLE `nuke_file_repository_settings`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_file_repository_themes`
--
ALTER TABLE `nuke_file_repository_themes`
  ADD PRIMARY KEY (`theme_name`);

--
-- Indexes for table `nuke_headlines`
--
ALTER TABLE `nuke_headlines`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `nuke_hnl_categories`
--
ALTER TABLE `nuke_hnl_categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_hnl_cfg`
--
ALTER TABLE `nuke_hnl_cfg`
  ADD PRIMARY KEY (`cfg_nm`);

--
-- Indexes for table `nuke_hnl_newsletters`
--
ALTER TABLE `nuke_hnl_newsletters`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_honeypot`
--
ALTER TABLE `nuke_honeypot`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `nuke_image_repository_settings`
--
ALTER TABLE `nuke_image_repository_settings`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_image_repository_uploads`
--
ALTER TABLE `nuke_image_repository_uploads`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `nuke_image_repository_users`
--
ALTER TABLE `nuke_image_repository_users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `nuke_jmap`
--
ALTER TABLE `nuke_jmap`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `nuke_links_categories`
--
ALTER TABLE `nuke_links_categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_links_editorials`
--
ALTER TABLE `nuke_links_editorials`
  ADD PRIMARY KEY (`linkid`);

--
-- Indexes for table `nuke_links_links`
--
ALTER TABLE `nuke_links_links`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `nuke_links_modrequest`
--
ALTER TABLE `nuke_links_modrequest`
  ADD PRIMARY KEY (`requestid`);

--
-- Indexes for table `nuke_links_newlink`
--
ALTER TABLE `nuke_links_newlink`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `nuke_links_votedata`
--
ALTER TABLE `nuke_links_votedata`
  ADD PRIMARY KEY (`ratingdbid`);

--
-- Indexes for table `nuke_link_us`
--
ALTER TABLE `nuke_link_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_main`
--
ALTER TABLE `nuke_main`
  ADD KEY `main_module` (`main_module`);

--
-- Indexes for table `nuke_menu`
--
ALTER TABLE `nuke_menu`
  ADD PRIMARY KEY (`groupmenu`);

--
-- Indexes for table `nuke_menu_categories`
--
ALTER TABLE `nuke_menu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_message`
--
ALTER TABLE `nuke_message`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `mid` (`mid`);

--
-- Indexes for table `nuke_meta`
--
ALTER TABLE `nuke_meta`
  ADD PRIMARY KEY (`meta_name`);

--
-- Indexes for table `nuke_modules`
--
ALTER TABLE `nuke_modules`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `mid` (`mid`),
  ADD KEY `title` (`title`),
  ADD KEY `custom_title` (`custom_title`);

--
-- Indexes for table `nuke_modules_cat`
--
ALTER TABLE `nuke_modules_cat`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `nuke_modules_links`
--
ALTER TABLE `nuke_modules_links`
  ADD PRIMARY KEY (`lid`),
  ADD UNIQUE KEY `lid` (`lid`);

--
-- Indexes for table `nuke_mostonline`
--
ALTER TABLE `nuke_mostonline`
  ADD PRIMARY KEY (`total`);

--
-- Indexes for table `nuke_nsncb_blocks`
--
ALTER TABLE `nuke_nsncb_blocks`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `rid` (`rid`);

--
-- Indexes for table `nuke_nsncb_config`
--
ALTER TABLE `nuke_nsncb_config`
  ADD PRIMARY KEY (`cgid`),
  ADD UNIQUE KEY `cfgid` (`cgid`);

--
-- Indexes for table `nuke_nsnne_config`
--
ALTER TABLE `nuke_nsnne_config`
  ADD UNIQUE KEY `config_name` (`config_name`);

--
-- Indexes for table `nuke_nsnsp_config`
--
ALTER TABLE `nuke_nsnsp_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsnsp_sites`
--
ALTER TABLE `nuke_nsnsp_sites`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `nuke_nsnst_admins`
--
ALTER TABLE `nuke_nsnst_admins`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `password_md5` (`password_md5`);

--
-- Indexes for table `nuke_nsnst_blocked_ips`
--
ALTER TABLE `nuke_nsnst_blocked_ips`
  ADD PRIMARY KEY (`ip_addr`),
  ADD KEY `ip_long` (`ip_long`);

--
-- Indexes for table `nuke_nsnst_blocked_ranges`
--
ALTER TABLE `nuke_nsnst_blocked_ranges`
  ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`);

--
-- Indexes for table `nuke_nsnst_blockers`
--
ALTER TABLE `nuke_nsnst_blockers`
  ADD PRIMARY KEY (`blocker`);

--
-- Indexes for table `nuke_nsnst_cidrs`
--
ALTER TABLE `nuke_nsnst_cidrs`
  ADD PRIMARY KEY (`cidr`);

--
-- Indexes for table `nuke_nsnst_config`
--
ALTER TABLE `nuke_nsnst_config`
  ADD PRIMARY KEY (`config_name`);

--
-- Indexes for table `nuke_nsnst_countries`
--
ALTER TABLE `nuke_nsnst_countries`
  ADD KEY `c2c` (`c2c`);

--
-- Indexes for table `nuke_nsnst_excluded_ranges`
--
ALTER TABLE `nuke_nsnst_excluded_ranges`
  ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`);

--
-- Indexes for table `nuke_nsnst_harvesters`
--
ALTER TABLE `nuke_nsnst_harvesters`
  ADD PRIMARY KEY (`harvester`),
  ADD KEY `hid` (`hid`);

--
-- Indexes for table `nuke_nsnst_protected_ranges`
--
ALTER TABLE `nuke_nsnst_protected_ranges`
  ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`);

--
-- Indexes for table `nuke_nsnst_referers`
--
ALTER TABLE `nuke_nsnst_referers`
  ADD PRIMARY KEY (`referer`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `nuke_nsnst_tracked_ips`
--
ALTER TABLE `nuke_nsnst_tracked_ips`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `maintracking` (`ip_addr`,`ip_long`),
  ADD KEY `ip_addr` (`ip_addr`),
  ADD KEY `ip_long` (`ip_long`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `user_agent` (`user_agent`(255)),
  ADD KEY `refered_from` (`refered_from`(255)),
  ADD KEY `date` (`date`),
  ADD KEY `page` (`page`(255)),
  ADD KEY `c2c` (`c2c`);

--
-- Indexes for table `nuke_pages`
--
ALTER TABLE `nuke_pages`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `nuke_pages_categories`
--
ALTER TABLE `nuke_pages_categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `nuke_pollcomments`
--
ALTER TABLE `nuke_pollcomments`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `pollID` (`pollID`);

--
-- Indexes for table `nuke_poll_desc`
--
ALTER TABLE `nuke_poll_desc`
  ADD PRIMARY KEY (`pollID`);

--
-- Indexes for table `nuke_quotes`
--
ALTER TABLE `nuke_quotes`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `nuke_referer`
--
ALTER TABLE `nuke_referer`
  ADD PRIMARY KEY (`url`),
  ADD KEY `lasttime` (`lasttime`);

--
-- Indexes for table `nuke_related`
--
ALTER TABLE `nuke_related`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `nuke_reviews`
--
ALTER TABLE `nuke_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_reviews_add`
--
ALTER TABLE `nuke_reviews_add`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_reviews_comments`
--
ALTER TABLE `nuke_reviews_comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `rid` (`rid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `nuke_reviews_main`
--
ALTER TABLE `nuke_reviews_main`
  ADD KEY `title` (`title`);

--
-- Indexes for table `nuke_security_agents`
--
ALTER TABLE `nuke_security_agents`
  ADD PRIMARY KEY (`agent_name`);

--
-- Indexes for table `nuke_session`
--
ALTER TABLE `nuke_session`
  ADD PRIMARY KEY (`uname`),
  ADD KEY `time` (`time`),
  ADD KEY `guest` (`guest`);

--
-- Indexes for table `nuke_shoutbox_censor`
--
ALTER TABLE `nuke_shoutbox_censor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_conf`
--
ALTER TABLE `nuke_shoutbox_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_date`
--
ALTER TABLE `nuke_shoutbox_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_emoticons`
--
ALTER TABLE `nuke_shoutbox_emoticons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_ipblock`
--
ALTER TABLE `nuke_shoutbox_ipblock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_manage_count`
--
ALTER TABLE `nuke_shoutbox_manage_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_nameblock`
--
ALTER TABLE `nuke_shoutbox_nameblock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_shouts`
--
ALTER TABLE `nuke_shoutbox_shouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_sticky`
--
ALTER TABLE `nuke_shoutbox_sticky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_themes`
--
ALTER TABLE `nuke_shoutbox_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_theme_images`
--
ALTER TABLE `nuke_shoutbox_theme_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_shoutbox_version`
--
ALTER TABLE `nuke_shoutbox_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_sommaire`
--
ALTER TABLE `nuke_sommaire`
  ADD PRIMARY KEY (`groupmenu`);

--
-- Indexes for table `nuke_sommaire_categories`
--
ALTER TABLE `nuke_sommaire_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nuke_subscriptions`
--
ALTER TABLE `nuke_subscriptions`
  ADD PRIMARY KEY (`id`,`userid`);

--
-- Indexes for table `nuke_themes`
--
ALTER TABLE `nuke_themes`
  ADD PRIMARY KEY (`theme_name`);

--
-- Indexes for table `nuke_users`
--
ALTER TABLE `nuke_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `uname` (`username`),
  ADD KEY `user_session_time` (`user_session_time`),
  ADD KEY `user_birthday` (`user_birthday`),
  ADD KEY `user_birthday2` (`user_birthday2`);

--
-- Indexes for table `nuke_users_countries`
--
ALTER TABLE `nuke_users_countries`
  ADD PRIMARY KEY (`id_country`),
  ADD KEY `IDX_NAME` (`name`);

--
-- Indexes for table `nuke_users_temp`
--
ALTER TABLE `nuke_users_temp`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `nuke_users_who_been`
--
ALTER TABLE `nuke_users_who_been`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `nuke_welcome_pm`
--
ALTER TABLE `nuke_welcome_pm`
  ADD PRIMARY KEY (`subject`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nuke_banner`
--
ALTER TABLE `nuke_banner`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nuke_banner_clients`
--
ALTER TABLE `nuke_banner_clients`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_banner_plans`
--
ALTER TABLE `nuke_banner_plans`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_banner_positions`
--
ALTER TABLE `nuke_banner_positions`
  MODIFY `apid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nuke_bbadvanced_username_color`
--
ALTER TABLE `nuke_bbadvanced_username_color`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nuke_bbarcade_categories`
--
ALTER TABLE `nuke_bbarcade_categories`
  MODIFY `arcade_catid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_bbattachments_desc`
--
ALTER TABLE `nuke_bbattachments_desc`
  MODIFY `attach_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nuke_bbbanlist`
--
ALTER TABLE `nuke_bbbanlist`
  MODIFY `ban_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbcategories`
--
ALTER TABLE `nuke_bbcategories`
  MODIFY `cat_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nuke_bbdisallow`
--
ALTER TABLE `nuke_bbdisallow`
  MODIFY `disallow_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nuke_bbextensions`
--
ALTER TABLE `nuke_bbextensions`
  MODIFY `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `nuke_bbextension_groups`
--
ALTER TABLE `nuke_bbextension_groups`
  MODIFY `group_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nuke_bbforbidden_extensions`
--
ALTER TABLE `nuke_bbforbidden_extensions`
  MODIFY `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nuke_bbforums`
--
ALTER TABLE `nuke_bbforums`
  MODIFY `forum_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nuke_bbforum_prune`
--
ALTER TABLE `nuke_bbforum_prune`
  MODIFY `prune_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_bbgames`
--
ALTER TABLE `nuke_bbgames`
  MODIFY `game_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_bbgroups`
--
ALTER TABLE `nuke_bbgroups`
  MODIFY `group_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `nuke_bbinline_ads`
--
ALTER TABLE `nuke_bbinline_ads`
  MODIFY `ad_id` tinyint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bblogs`
--
ALTER TABLE `nuke_bblogs`
  MODIFY `log_id` mediumint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `nuke_bbposts`
--
ALTER TABLE `nuke_bbposts`
  MODIFY `post_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `nuke_bbpost_reports`
--
ALTER TABLE `nuke_bbpost_reports`
  MODIFY `report_id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbprivmsgs`
--
ALTER TABLE `nuke_bbprivmsgs`
  MODIFY `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `nuke_bbprivmsgs_archive`
--
ALTER TABLE `nuke_bbprivmsgs_archive`
  MODIFY `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbquicksearch`
--
ALTER TABLE `nuke_bbquicksearch`
  MODIFY `search_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_bbquota_limits`
--
ALTER TABLE `nuke_bbquota_limits`
  MODIFY `quota_limit_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nuke_bbranks`
--
ALTER TABLE `nuke_bbranks`
  MODIFY `rank_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nuke_bbsearch_rebuild`
--
ALTER TABLE `nuke_bbsearch_rebuild`
  MODIFY `rebuild_session_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbsearch_wordlist`
--
ALTER TABLE `nuke_bbsearch_wordlist`
  MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1928;

--
-- AUTO_INCREMENT for table `nuke_bbsmilies`
--
ALTER TABLE `nuke_bbsmilies`
  MODIFY `smilies_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `nuke_bbstats_modules`
--
ALTER TABLE `nuke_bbstats_modules`
  MODIFY `module_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nuke_bbthemes`
--
ALTER TABLE `nuke_bbthemes`
  MODIFY `themes_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_bbtopics`
--
ALTER TABLE `nuke_bbtopics`
  MODIFY `topic_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `nuke_bbtopic_moved`
--
ALTER TABLE `nuke_bbtopic_moved`
  MODIFY `moved_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbvote_desc`
--
ALTER TABLE `nuke_bbvote_desc`
  MODIFY `vote_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_bbwords`
--
ALTER TABLE `nuke_bbwords`
  MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_blocks`
--
ALTER TABLE `nuke_blocks`
  MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `nuke_blogs`
--
ALTER TABLE `nuke_blogs`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `nuke_blogs_autoblog`
--
ALTER TABLE `nuke_blogs_autoblog`
  MODIFY `anid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_blogs_cat`
--
ALTER TABLE `nuke_blogs_cat`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nuke_blogs_comments`
--
ALTER TABLE `nuke_blogs_comments`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `nuke_blogs_queue`
--
ALTER TABLE `nuke_blogs_queue`
  MODIFY `qid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nuke_blogs_topics`
--
ALTER TABLE `nuke_blogs_topics`
  MODIFY `topicid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nuke_bookmarks`
--
ALTER TABLE `nuke_bookmarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nuke_bookmarks_cat`
--
ALTER TABLE `nuke_bookmarks_cat`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nuke_cemetery`
--
ALTER TABLE `nuke_cemetery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nuke_cemetery_cat`
--
ALTER TABLE `nuke_cemetery_cat`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nuke_cnbya_field`
--
ALTER TABLE `nuke_cnbya_field`
  MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_cnbya_value`
--
ALTER TABLE `nuke_cnbya_value`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_cnbya_value_temp`
--
ALTER TABLE `nuke_cnbya_value_temp`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_donators`
--
ALTER TABLE `nuke_donators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_ecalendar`
--
ALTER TABLE `nuke_ecalendar`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_faqanswer`
--
ALTER TABLE `nuke_faqanswer`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_faqcategories`
--
ALTER TABLE `nuke_faqcategories`
  MODIFY `id_cat` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_file_repository_categories`
--
ALTER TABLE `nuke_file_repository_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_file_repository_comments`
--
ALTER TABLE `nuke_file_repository_comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_file_repository_files`
--
ALTER TABLE `nuke_file_repository_files`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_file_repository_items`
--
ALTER TABLE `nuke_file_repository_items`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_file_repository_screenshots`
--
ALTER TABLE `nuke_file_repository_screenshots`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_headlines`
--
ALTER TABLE `nuke_headlines`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nuke_hnl_categories`
--
ALTER TABLE `nuke_hnl_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nuke_hnl_newsletters`
--
ALTER TABLE `nuke_hnl_newsletters`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nuke_honeypot`
--
ALTER TABLE `nuke_honeypot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nuke_image_repository_uploads`
--
ALTER TABLE `nuke_image_repository_uploads`
  MODIFY `pid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nuke_image_repository_users`
--
ALTER TABLE `nuke_image_repository_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nuke_links_categories`
--
ALTER TABLE `nuke_links_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nuke_links_links`
--
ALTER TABLE `nuke_links_links`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nuke_links_modrequest`
--
ALTER TABLE `nuke_links_modrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_links_newlink`
--
ALTER TABLE `nuke_links_newlink`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nuke_links_votedata`
--
ALTER TABLE `nuke_links_votedata`
  MODIFY `ratingdbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nuke_link_us`
--
ALTER TABLE `nuke_link_us`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nuke_menu_categories`
--
ALTER TABLE `nuke_menu_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3624;

--
-- AUTO_INCREMENT for table `nuke_message`
--
ALTER TABLE `nuke_message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nuke_modules`
--
ALTER TABLE `nuke_modules`
  MODIFY `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15504;

--
-- AUTO_INCREMENT for table `nuke_modules_cat`
--
ALTER TABLE `nuke_modules_cat`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nuke_modules_links`
--
ALTER TABLE `nuke_modules_links`
  MODIFY `lid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nuke_nsnsp_sites`
--
ALTER TABLE `nuke_nsnsp_sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_nsnst_harvesters`
--
ALTER TABLE `nuke_nsnst_harvesters`
  MODIFY `hid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `nuke_nsnst_referers`
--
ALTER TABLE `nuke_nsnst_referers`
  MODIFY `rid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

--
-- AUTO_INCREMENT for table `nuke_nsnst_tracked_ips`
--
ALTER TABLE `nuke_nsnst_tracked_ips`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242462;

--
-- AUTO_INCREMENT for table `nuke_pages`
--
ALTER TABLE `nuke_pages`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_pages_categories`
--
ALTER TABLE `nuke_pages_categories`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_pollcomments`
--
ALTER TABLE `nuke_pollcomments`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_poll_desc`
--
ALTER TABLE `nuke_poll_desc`
  MODIFY `pollID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_quotes`
--
ALTER TABLE `nuke_quotes`
  MODIFY `qid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nuke_related`
--
ALTER TABLE `nuke_related`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_reviews`
--
ALTER TABLE `nuke_reviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_reviews_add`
--
ALTER TABLE `nuke_reviews_add`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_reviews_comments`
--
ALTER TABLE `nuke_reviews_comments`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_censor`
--
ALTER TABLE `nuke_shoutbox_censor`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_emoticons`
--
ALTER TABLE `nuke_shoutbox_emoticons`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_ipblock`
--
ALTER TABLE `nuke_shoutbox_ipblock`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_manage_count`
--
ALTER TABLE `nuke_shoutbox_manage_count`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_nameblock`
--
ALTER TABLE `nuke_shoutbox_nameblock`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_shouts`
--
ALTER TABLE `nuke_shoutbox_shouts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_sticky`
--
ALTER TABLE `nuke_shoutbox_sticky`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_themes`
--
ALTER TABLE `nuke_shoutbox_themes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nuke_shoutbox_theme_images`
--
ALTER TABLE `nuke_shoutbox_theme_images`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_sommaire_categories`
--
ALTER TABLE `nuke_sommaire_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nuke_subscriptions`
--
ALTER TABLE `nuke_subscriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nuke_users`
--
ALTER TABLE `nuke_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nuke_users_countries`
--
ALTER TABLE `nuke_users_countries`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `nuke_users_temp`
--
ALTER TABLE `nuke_users_temp`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
