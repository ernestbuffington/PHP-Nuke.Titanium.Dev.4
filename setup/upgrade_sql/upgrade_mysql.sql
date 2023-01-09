-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_categories`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_categories` (
  `category_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_comments`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_comments` (
  `comment_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `comment_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comment_game` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_urls` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_favorites`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_favorites` (
  `favorite_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `favorite_game` mediumint(8) unsigned NOT NULL,
  `favorite_user` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`favorite_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_games`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_games` (
  `game_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `game_name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `game_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'no_image.gif',
  `game_directions` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `game_description` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `game_category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `game_filename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `game_plays` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `game_rating` mediumint(8) NOT NULL DEFAULT '0',
  `game_num_ratings` mediumint(8) NOT NULL DEFAULT '0',
  `game_width` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `game_height` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `game_highscore` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `game_newscore` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `game_rev_score` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `game_enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `game_keyboard` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `game_mouse` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_highscores`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_highscores` (
  `highscore_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `highscore_game` mediumint(8) unsigned NOT NULL,
  `highscore_user` mediumint(8) unsigned NOT NULL,
  `highscore` double(21,1) NOT NULL,
  PRIMARY KEY (`highscore_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_hotlinks`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_hotlinks` (
  `hotlink_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `hotlink_game` mediumint(8) unsigned NOT NULL,
  `hotlink_file` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`hotlink_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_played`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_played` (
  `played_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `played_user` mediumint(8) unsigned NOT NULL,
  `played_games` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`played_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_ratings`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_ratings` (
  `rating_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `rating_game` mediumint(8) NOT NULL DEFAULT '0',
  `rating_user` mediumint(8) NOT NULL DEFAULT '0',
  `rating_score` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rating_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_settings`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_settings` (
  `setting_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `setting_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_trophies`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_trophies` (
  `trophy_game` mediumint(8) unsigned NOT NULL,
  `trophy_user_gold` mediumint(8) unsigned NOT NULL,
  `trophy_user_silver` mediumint(8) unsigned NOT NULL,
  `trophy_user_bronze` mediumint(8) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_viewing`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_viewing` (
  `viewing_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `viewing_user` mediumint(8) unsigned NOT NULL,
  `viewing_game` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`viewing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_search_results`
--

CREATE TABLE IF NOT EXISTS `#prefix#_search_results` (
  `search_key` varbinary(32) NOT NULL DEFAULT '',
  `search_time` int(11) unsigned NOT NULL DEFAULT '0',
  `search_keywords` mediumblob NOT NULL,
  `search_authors` mediumblob NOT NULL,
  PRIMARY KEY (`search_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_search_wordlist`
--

CREATE TABLE IF NOT EXISTS `#prefix#_search_wordlist` (
  `word_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `word_text` blob NOT NULL,
  `word_common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `word_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`word_id`),
  UNIQUE KEY `wrd_txt` (`word_text`(255)),
  KEY `wrd_cnt` (`word_count`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_search_wordmatch`
--

CREATE TABLE IF NOT EXISTS `#prefix#_search_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `word_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title_match` tinyint(1) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `unq_mtch` (`word_id`,`post_id`,`title_match`),
  KEY `word_id` (`word_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_settings`
--

CREATE TABLE IF NOT EXISTS `#prefix#_settings` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_dynamic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_name`),
  KEY `is_dynamic` (`is_dynamic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_sitelist`
--

CREATE TABLE IF NOT EXISTS `#prefix#_sitelist` (
  `site_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `site_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `site_hostname` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ip_exclude` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_shout_cast`
--

CREATE TABLE IF NOT EXISTS `#prefix#_shout_cast` (
  `allow` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `ip` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `port` mediumint(8) NOT NULL DEFAULT '0',
  `admin_name` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '',
  `admin_pass` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '',
  `host_dj` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_words`
--

CREATE TABLE `#prefix#_words` (
    `word_id` mediumint(8) UNSIGNED NOT NULL auto_increment,
    `word` varchar(255) DEFAULT '' NOT NULL,
    `replacement` varchar(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`word_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;