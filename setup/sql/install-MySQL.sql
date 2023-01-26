-- --------------------------------------------------------

--
-- Table structure for table `torrent_acl_groups`
--

CREATE TABLE IF NOT EXISTS `#prefix#_acl_groups` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  KEY `group_id` (`group_id`),
  KEY `auth_opt_id` (`auth_option_id`),
  KEY `auth_role_id` (`auth_role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_acl_options`
--

CREATE TABLE IF NOT EXISTS `#prefix#_acl_options` (
  `auth_option_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `auth_option` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_global` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_local` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `founder_only` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`auth_option_id`),
  UNIQUE KEY `auth_option` (`auth_option`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_acl_roles`
--

CREATE TABLE IF NOT EXISTS `#prefix#_acl_roles` (
  `role_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_description` text COLLATE utf8_bin NOT NULL,
  `role_type` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_order` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`),
  KEY `role_type` (`role_type`),
  KEY `role_order` (`role_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_acl_roles_data`
--

CREATE TABLE IF NOT EXISTS `#prefix#_acl_roles_data` (
  `role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`,`auth_option_id`),
  KEY `ath_op_id` (`auth_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_acl_users`
--

CREATE TABLE IF NOT EXISTS `#prefix#_acl_users` (
  `user_id` int(12) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `auth_option_id` (`auth_option_id`),
  KEY `auth_role_id` (`auth_role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_categories`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_categories` (
  `category_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_favorites`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_favorites` (
  `favorite_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `favorite_game` mediumint(8) unsigned NOT NULL,
  `favorite_user` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`favorite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_played`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_played` (
  `played_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `played_user` mediumint(8) unsigned NOT NULL,
  `played_games` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`played_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ar_settings`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ar_settings` (
  `setting_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `setting_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Table structure for table `torrent_attachments`
--

CREATE TABLE IF NOT EXISTS `#prefix#_attachments` (
  `attach_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `post_msg_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `in_message` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `poster_id` int(20) unsigned NOT NULL DEFAULT '0',
  `is_orphan` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `physical_filename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `real_filename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `download_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attach_comment` text COLLATE utf8_bin NOT NULL,
  `extension` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mimetype` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `filesize` int(20) unsigned NOT NULL DEFAULT '0',
  `filetime` int(11) unsigned NOT NULL DEFAULT '0',
  `thumbnail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `post_msg_id` (`post_msg_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `is_orphan` (`is_orphan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_attachments_config`
--

CREATE TABLE IF NOT EXISTS `#prefix#_attachments_config` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_dynamic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_name`),
  KEY `is_dynamic` (`is_dynamic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_avatar_config`
--

CREATE TABLE IF NOT EXISTS `#prefix#_avatar_config` (
  `enable_avatars` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `enable_gallery_avatars` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `enable_remote_avatars` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `enable_avatar_uploading` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `enable_remote_avatar_uploading` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `maximum_avatar_file_size` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `avatar_storage_path` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT 'avatar/user',
  `avatar_gallery_path` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT 'avatar',
  `minimum_avatar_dimensions_ht` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `minimum_avatar_dimensions_wt` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `maximum_avatar_dimensions_ht` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `maximum_avatar_dimensions_wt` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_avps`
--

CREATE TABLE IF NOT EXISTS `#prefix#_avps` (
  `arg` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `value_s` text COLLATE utf8_bin NOT NULL,
  `value_i` int(11) NOT NULL DEFAULT '0',
  `value_u` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`arg`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_bans`
--

CREATE TABLE IF NOT EXISTS `#prefix#_bans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ban_userid` mediumint(8) NOT NULL DEFAULT '0',
  `ban_email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ipstart` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ipend` int(10) unsigned NOT NULL DEFAULT '0',
  `ban_start` int(11) NOT NULL DEFAULT '0',
  `ban_end` int(11) NOT NULL DEFAULT '0',
  `ban_exclude` int(1) NOT NULL DEFAULT '0',
  `reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ban_give_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_bbcodes`
--

CREATE TABLE IF NOT EXISTS `#prefix#_bbcodes` (
  `bbcode_id` tinyint(3) NOT NULL DEFAULT '0',
  `bbcode_tag` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_helpline` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_match` text COLLATE utf8_bin NOT NULL,
  `bbcode_tpl` mediumtext COLLATE utf8_bin NOT NULL,
  `first_pass_match` mediumtext COLLATE utf8_bin NOT NULL,
  `first_pass_replace` mediumtext COLLATE utf8_bin NOT NULL,
  `second_pass_match` mediumtext COLLATE utf8_bin NOT NULL,
  `second_pass_replace` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`bbcode_id`),
  KEY `display_on_post` (`display_on_posting`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_bonus`
--

CREATE TABLE IF NOT EXISTS `#prefix#_bonus` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `bonusname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `points` decimal(4,1) NOT NULL DEFAULT '0.0',
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `art` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'traffic',
  `menge` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_bonus_points`
--

CREATE TABLE IF NOT EXISTS `#prefix#_bonus_points` (
  `active` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `upload` decimal(10,2) NOT NULL DEFAULT '0.00',
  `comment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `offer` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fill_request` decimal(10,2) NOT NULL DEFAULT '0.00',
  `seeding` decimal(10,2) NOT NULL DEFAULT '0.00',
  `by_torrent` int(10) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_bookmarks`
--

CREATE TABLE IF NOT EXISTS `#prefix#_bookmarks` (
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_cache_con`
--

CREATE TABLE IF NOT EXISTS `#prefix#_cache_con` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_categories`
--

CREATE TABLE IF NOT EXISTS `#prefix#_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sort_index` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `parent_id` mediumint(5) NOT NULL DEFAULT '-1',
  `tabletype` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `subcount` varchar(225) COLLATE utf8_bin NOT NULL,
  `offensive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `sort_index` (`sort_index`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_client_ban`
--

CREATE TABLE IF NOT EXISTS `#prefix#_client_ban` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `client` varchar(60) COLLATE utf8_bin NOT NULL,
  `reason` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client` (`client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_comments`
--

CREATE TABLE IF NOT EXISTS `#prefix#_blogs_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL DEFAULT '0',
  `torrent` int(10) unsigned NOT NULL DEFAULT '0',
  `added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text COLLATE utf8_bin NOT NULL,
  `ori_text` text COLLATE utf8_bin,
  `news` int(10) NOT NULL DEFAULT '0',
  `nzb` int(10) NOT NULL DEFAULT '0',
  `offer` int(11) NOT NULL DEFAULT '0',
  `reqid` int(11) NOT NULL DEFAULT '0',
  `editedat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editedby` int(10) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ori_bbcode_bitfield` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ori_bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `torrent` (`torrent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_comments_notify`
--

CREATE TABLE IF NOT EXISTS `#prefix#_comments_notify` (
  `torrent` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `status` enum('active','stopped') COLLATE utf8_bin NOT NULL DEFAULT 'active',
  PRIMARY KEY (`torrent`,`user`),
  KEY `torrent` (`torrent`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_complaints`
--

CREATE TABLE IF NOT EXISTS `#prefix#_complaints` (
  `torrent` int(15) unsigned NOT NULL DEFAULT '0',
  `user` int(11) unsigned NOT NULL DEFAULT '0',
  `host` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` smallint(1) unsigned zerofill NOT NULL DEFAULT '0',
  PRIMARY KEY (`torrent`,`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_config`
--

CREATE TABLE IF NOT EXISTS `#prefix#_config` (
  `sitename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `siteurl` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `announce_url` longtext COLLATE utf8_bin NOT NULL,
  `cookiedomain` varchar(225) COLLATE utf8_bin NOT NULL,
  `cookiepath` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sourcedir` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `admin_email` varchar(60) COLLATE utf8_bin NOT NULL,
  `on_line` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `off_line_mess` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_zone` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'America/Los_Angeles',
  `language` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '',
  `theme` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `force_passkey` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `welcome_message` longtext COLLATE utf8_bin,
  `announce_ments` longtext COLLATE utf8_bin,
  `announce_text` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `allow_html` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `allow_magnet` int(10) NOT NULL DEFAULT '1',
  `rewrite_engine` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `torrent_prefix` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `torrent_per_page` int(10) unsigned NOT NULL DEFAULT '10',
  `onlysearch` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `max_torrent_size` int(11) unsigned NOT NULL DEFAULT '0',
  `announce_interval_min` int(10) unsigned NOT NULL DEFAULT '0',
  `announce_interval` int(10) unsigned NOT NULL DEFAULT '0',
  `dead_torrent_interval` int(10) unsigned NOT NULL DEFAULT '0',
  `minvotes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `time_tracker_update` int(10) unsigned NOT NULL DEFAULT '0',
  `best_limit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `down_limit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `torrent_complaints` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `torrent_global_privacy` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `disclaimer_check` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `gfx_check` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `Public_Key` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `Private_Key` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `recap_https` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `upload_level` enum('all','user','premium') COLLATE utf8_bin NOT NULL DEFAULT 'user',
  `download_level` enum('all','user','premium') COLLATE utf8_bin NOT NULL DEFAULT 'all',
  `announce_level` enum('all','user') COLLATE utf8_bin NOT NULL DEFAULT 'all',
  `max_num_file` smallint(5) unsigned NOT NULL DEFAULT '0',
  `max_share_size` bigint(8) unsigned NOT NULL DEFAULT '0',
  `min_size_seed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `min_share_seed` bigint(8) unsigned NOT NULL DEFAULT '0',
  `global_min_ratio` float unsigned NOT NULL DEFAULT '0',
  `autoscrape` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `min_num_seed_e` smallint(5) unsigned NOT NULL DEFAULT '0',
  `min_size_seed_e` bigint(8) unsigned NOT NULL DEFAULT '0',
  `minupload_size_file` int(10) unsigned NOT NULL DEFAULT '0',
  `allow_backup_tracker` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `stealthmode` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `version` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '',
  `upload_dead` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `invites_open` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `invite_only` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `max_members` int(10) unsigned NOT NULL DEFAULT '0',
  `auto_clean` int(10) unsigned NOT NULL DEFAULT '0',
  `free_dl` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `GIGSA` int(10) NOT NULL DEFAULT '0',
  `RATIOA` decimal(10,2) NOT NULL DEFAULT '0.00',
  `WAITA` int(10) NOT NULL DEFAULT '0',
  `GIGSB` int(10) NOT NULL DEFAULT '0',
  `RATIOB` decimal(10,2) NOT NULL DEFAULT '0.00',
  `WAITB` int(10) NOT NULL DEFAULT '0',
  `GIGSC` int(10) NOT NULL DEFAULT '0',
  `RATIOC` decimal(10,2) NOT NULL DEFAULT '0.00',
  `WAITC` int(10) NOT NULL DEFAULT '0',
  `GIGSD` int(10) NOT NULL DEFAULT '0',
  `RATIOD` decimal(10,2) NOT NULL DEFAULT '0.00',
  `WAITD` int(10) NOT NULL DEFAULT '0',
  `wait_time` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `addprivate` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_external` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_multy_tracker` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `give_sign_up_credit` bigint(20) NOT NULL DEFAULT '0',
  `search_cloud_block` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `pivate_mode` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `conferm_email` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `allow_change_email` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `autodel_users` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `inactwarning_time` int(10) NOT NULL DEFAULT '0',
  `autodel_users_time` int(10) NOT NULL DEFAULT '0',
  `most_on_line` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `when_most` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_countries`
--

CREATE TABLE IF NOT EXISTS `#prefix#_countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `flagpic` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `domain` char(3) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_disallow`
--

CREATE TABLE IF NOT EXISTS `#prefix#_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL auto_increment,
  `disallow_username` varchar(255) binary NOT NULL default '',
  PRIMARY KEY (`disallow_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_download_completed`
--

CREATE TABLE IF NOT EXISTS `#prefix#_download_completed` (
  `user` int(11) unsigned NOT NULL DEFAULT '0',
  `torrent` int(15) unsigned NOT NULL DEFAULT '0',
  `completed` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user`,`torrent`),
  KEY `torrent` (`torrent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_drafts`
--

CREATE TABLE IF NOT EXISTS `#prefix#_drafts` (
  `draft_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `topic_id` mediumint(8) NOT NULL,
  `forum_id` mediumint(8) NOT NULL,
  `save_time` int(11) NOT NULL,
  `draft_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `draft_message` mediumtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `draft_type` enum('forum','pm','topic','coment') NOT NULL DEFAULT 'forum',
  `torrent` mediumint(8) DEFAULT NULL,
  `user_to` mediumint(8) DEFAULT NULL,
  PRIMARY KEY (`draft_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_extensions`
--

CREATE TABLE IF NOT EXISTS `#prefix#_extensions` (
  `extension_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extension` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_extension_groups`
--

CREATE TABLE IF NOT EXISTS `#prefix#_extension_groups` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `cat_id` tinyint(2) NOT NULL DEFAULT '0',
  `allow_group` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `download_mode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `upload_icon` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `max_filesize` int(20) unsigned NOT NULL DEFAULT '0',
  `allowed_forums` text COLLATE utf8_bin NOT NULL,
  `allow_in_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_faq`
--

CREATE TABLE IF NOT EXISTS `#prefix#_faq` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` set('categ','item') COLLATE utf8_bin NOT NULL DEFAULT 'item',
  `question` text COLLATE utf8_bin NOT NULL,
  `answer` text COLLATE utf8_bin NOT NULL,
  `flag` set('0','1','2','3') COLLATE utf8_bin NOT NULL DEFAULT '1',
  `categ` int(10) NOT NULL DEFAULT '0',
  `order` int(10) NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_files`
--

CREATE TABLE IF NOT EXISTS `#prefix#_files` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `torrent` int(15) unsigned NOT NULL DEFAULT '0',
  `filename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0',
  `md5sum` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `ed2k` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `magnet` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `torrent_2` (`torrent`,`filename`),
  KEY `torrent` (`torrent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_filter`
--

CREATE TABLE IF NOT EXISTS `#prefix#_filter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword` (`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_forums`
--

CREATE TABLE IF NOT EXISTS `#prefix#_forums` (
  `forum_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `left_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `right_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_parents` mediumtext COLLATE utf8_bin NOT NULL,
  `forum_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc` text COLLATE utf8_bin NOT NULL,
  `forum_desc_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_desc_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_password` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_style` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules` text COLLATE utf8_bin NOT NULL,
  `forum_rules_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_rules_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_topics_per_page` tinyint(4) NOT NULL DEFAULT '0',
  `forum_type` tinyint(4) NOT NULL DEFAULT '0',
  `forum_status` tinyint(4) NOT NULL DEFAULT '0',
  `forum_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_real` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_id` int(20) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_flags` tinyint(4) NOT NULL DEFAULT '32',
  `forum_options` int(20) unsigned NOT NULL DEFAULT '0',
  `display_subforum_list` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `display_on_index` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_indexing` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_icons` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_prune` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `prune_next` int(11) unsigned NOT NULL DEFAULT '0',
  `prune_days` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_viewed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_freq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `acl_read` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `acl_write` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `forum_lastpost_id` (`forum_last_post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_forums_access`
--

CREATE TABLE IF NOT EXISTS `#prefix#_forums_access` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`forum_id`,`user_id`,`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_forums_track`
--

CREATE TABLE IF NOT EXISTS `#prefix#_forums_track` (
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mark_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_forums_watch`
--

CREATE TABLE IF NOT EXISTS `#prefix#_forums_watch` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `forum_id` (`forum_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_stat` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_forum_config`
--

CREATE TABLE IF NOT EXISTS `#prefix#_forum_config` (
  `forum_open` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `board_disable_msg` text COLLATE utf8_bin NOT NULL,
  `postsper_page` int(10) NOT NULL,
  `topics_per_page` int(10) NOT NULL,
  `max_post_length` int(10) NOT NULL,
  `show_latest_topic` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `search_word_min` int(10) NOT NULL,
  `allow_bookmarks` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `shout_new_topic` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `shout_new_post` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_smilies` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_bbcode` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_signatures` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `flood_intervals` int(10) NOT NULL DEFAULT '0',
  `bump_intervals` int(10) NOT NULL DEFAULT '0',
  `set_flood_intervals` enum('s','m') COLLATE utf8_bin NOT NULL DEFAULT 's',
  `bump_type` enum('m','h','d') COLLATE utf8_bin NOT NULL DEFAULT 'm',
  `email_enable` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `jab_enable` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_topic_notify` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_forum_notify` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `load_search` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_attachments` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_post_links` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `board_hide_emails` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_birthdays` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `display_last_edited` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `load_moderators` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `edit_time` int(10) DEFAULT NULL,
  `allow_post_flash` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `enable_post_confirm` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `enable_queue_trigger` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_sig_bbcode` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `allow_sig_smilies` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `max_post_font_size` int(10) DEFAULT NULL,
  `max_poll_options` int(10) NOT NULL DEFAULT '9',
  `max_post_urls` int(10) NOT NULL DEFAULT '0',
  `max_post_smilies` int(11) DEFAULT NULL,
  `max_quote_depth` int(10) NOT NULL DEFAULT '0',
  `img_link_width` int(10) NOT NULL DEFAULT '0',
  `img_link_height` int(10) NOT NULL DEFAULT '0',
  `max_filesize` int(10) NOT NULL DEFAULT '0',
  `hot_threshold` int(10) NOT NULL DEFAULT '0',
  `min_post_chars` int(10) NOT NULL DEFAULT '0',
  `max_attachments` int(10) NOT NULL DEFAULT '0',
  `enable_urls` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `queue_trigger_posts` int(10) NOT NULL DEFAULT '0',
  `img_display_inlined` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_forum_permissions`
--

CREATE TABLE IF NOT EXISTS `#prefix#_forum_permissions` (
  `forum_id` mediumint(8) NOT NULL DEFAULT '0',
  `g_moderators` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_can_read` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_can_write` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `group_only` tinyint(1) NOT NULL DEFAULT '0',
  `group_allow` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_moderators` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_can_read` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_can_write` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_hit_n_run`
--

CREATE TABLE IF NOT EXISTS `#prefix#_hit_n_run` (
  `hnr_system` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `demote_hnr_users` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `ban_hnr_users` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `demote_time` int(10) NOT NULL DEFAULT '0',
  `after_high_hnr` int(10) NOT NULL DEFAULT '0',
  `ban_time` int(10) NOT NULL DEFAULT '0',
  `seedtime` int(10) NOT NULL DEFAULT '0',
  `time_before_warn` int(10) NOT NULL DEFAULT '0',
  `maxhitrun` int(10) NOT NULL DEFAULT '0',
  `warnlength` int(10) NOT NULL DEFAULT '0',
  `demote_hnr_users_to` varchar(225) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Config for Hit and Run System';

-- --------------------------------------------------------

--
-- Table structure for table `torrent_icons`
--

CREATE TABLE IF NOT EXISTS `#prefix#_icons` (
  `icons_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `icons_url` varchar(255) NOT NULL,
  `icons_width` tinyint(4) NOT NULL DEFAULT '0',
  `icons_height` tinyint(4) NOT NULL DEFAULT '0',
  `icons_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`icons_id`),
  KEY `display_on_posting` (`display_on_posting`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_img_bucket`
--

CREATE TABLE IF NOT EXISTS `#prefix#_img_bucket` (
  `allow` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `level` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `max_folder_size` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `max_file_size` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_levels`
--

CREATE TABLE IF NOT EXISTS `#prefix#_levels` (
  `level` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `name` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_type` tinyint(4) NOT NULL DEFAULT '1',
  `color` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_desc` text COLLATE utf8_bin,
  `m_see_admin_cp` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_upload` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_download` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_delete_own_torrents` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_delete_others_torrents` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_banusers` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_bann_torrents` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_bann_trackers` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_bann_shouts` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `a_see_ip` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_edit_own_comments` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_edit_comments` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_edit_user` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_mass_upload` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_view_nfo` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_requests` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_requests` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_offers` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_offers` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_top_torrentlist` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_comment` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_shout` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_change_theme` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_change_language` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_view_profiles` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_view_others_email` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_see_member_list` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_view_utube` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_add_uttube` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_hit_run` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_hnr_demote` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_arcade` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_can_use_bitbucket` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_black_jack` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `u_casino` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `m_can_edit_others_torrents` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_manage_faqs` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_edit_polls` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_modforum` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_del_users` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_edit_own_torrents` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_edit_others_shouts` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_masspm` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_masspm_group` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_delete` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_forward` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_edit` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_smilies` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_bbcode` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_sig` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_savedrafts` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_img` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_flash` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_ignoreflood` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_sendpm` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_attach` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_groupadd` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_groupdel` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_pm_download` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_sendim` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `group_receive_pm` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_clearlogs` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_forumadd` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_forumdel` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_fauth` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_authusers` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_authgroups` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_mauth` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_forum` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `f_list` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `f_post` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_approve` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `f_noapprove` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_warn_sys` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_prune` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_aauth` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_uauth` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_edit_level` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_override_user_pm_block` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_override_email_block` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_can_add_perm` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_poster` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_screen_shots` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_nfo` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_smiles_to_details` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_bbcode_details` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_quote_details` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_imgbbcode_details` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_links_in_details` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_flash_in_details` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_upload_notify` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_hide_torrent_owner` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_apply_ratiobuild` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_password_torrent` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_advance_upload_setting` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_add_sticky_upload` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_shout_upload` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_torrent_attach` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_can_add_magnet_links` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_view_whois` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_casin_users` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_games` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_mod_helpdesk` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_update_peers` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_delete_comments` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_delete_comments` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_mod` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `a_admin` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_over_ride_password` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_see_hidden_uploader` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_can_view_snatchlist` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_requist_reseed` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_down_load_private_torrents` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_attach` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_search` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `u_f_download` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `m_warn` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  UNIQUE KEY `level` (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_level_privlages`
--

CREATE TABLE IF NOT EXISTS `#prefix#_level_privlages` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `acc_point` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `descr` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acc_point` (`acc_point`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_level_settings`
--

CREATE TABLE IF NOT EXISTS `#prefix#_level_settings` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_type` tinyint(4) NOT NULL DEFAULT '1',
  `group_default` tinyint(1) NOT NULL DEFAULT '0',
  `group_founder_manage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_desc` text COLLATE utf8_bin NOT NULL,
  `group_desc_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_desc_options` int(11) unsigned NOT NULL DEFAULT '7',
  `group_desc_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_avatar_type` tinyint(2) NOT NULL DEFAULT '0',
  `group_avatar_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `group_avatar_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `group_rank` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_sig_chars` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_receive_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_message_limit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_max_recipients` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_legend` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `group_skip_auth` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  KEY `group_legend_name` (`group_legend`,`group_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_log`
--

CREATE TABLE IF NOT EXISTS `#prefix#_log` (
  `event` int(60) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `results` longtext COLLATE utf8_bin NOT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `host` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `userid` int(60) NOT NULL DEFAULT '0',
  `reportee_id` mediumint(8) NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) NOT NULL DEFAULT '0',
  `torrent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `log_type` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`event`),
  KEY `datetime` (`datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_massupload`
--

CREATE TABLE IF NOT EXISTS `#prefix#_massupload` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_moderator_cache`
--

CREATE TABLE IF NOT EXISTS `#prefix#_moderator_cache` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(12) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_on_index` tinyint(1) unsigned NOT NULL DEFAULT '1',
  KEY `disp_idx` (`display_on_index`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_modules`
--

CREATE TABLE IF NOT EXISTS `#prefix#_modules` (
  `module_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module_enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `module_display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `module_basename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_class` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `left_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `right_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module_langname` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_mode` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_auth` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`module_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `module_enabled` (`module_enabled`),
  KEY `class_left_id` (`module_class`,`left_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_online_users`
--

CREATE TABLE IF NOT EXISTS `#prefix#_online_users` (
  `id` int(60) unsigned NOT NULL DEFAULT '0',
  `page` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `logged_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_action` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_paypal`
--

CREATE TABLE IF NOT EXISTS `#prefix#_paypal` (
  `siteurl` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `paypal_email` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sitecost` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `reseaved_donations` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `donatepage` longtext COLLATE utf8_bin NOT NULL,
  `donation_block` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `nodonate` enum('EU','UK','US') COLLATE utf8_bin NOT NULL DEFAULT 'US'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_peers`
--

CREATE TABLE IF NOT EXISTS `#prefix#_peers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `torrent` int(10) unsigned NOT NULL DEFAULT '0',
  `peer_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `unique_id` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `port` smallint(5) unsigned NOT NULL DEFAULT '0',
  `real_ip` varchar(20) COLLATE utf8_bin NOT NULL,
  `uploaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `downloaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `download_speed` int(11) unsigned NOT NULL DEFAULT '0',
  `upload_speed` int(11) unsigned NOT NULL DEFAULT '0',
  `to_go` bigint(20) unsigned NOT NULL DEFAULT '0',
  `seeder` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `started` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_action` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `connectable` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `client` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `version` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `torrent_peer_id` (`torrent`,`peer_id`),
  UNIQUE KEY `torrent_3` (`torrent`,`unique_id`),
  KEY `torrent` (`torrent`),
  KEY `last_action` (`last_action`),
  KEY `torrent_2` (`torrent`,`seeder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_pollanswers`
--

CREATE TABLE IF NOT EXISTS `#prefix#_pollanswers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pollid` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `selection` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`),
  KEY `selection` (`selection`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_polls`
--

CREATE TABLE IF NOT EXISTS `#prefix#_polls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `question` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option0` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option1` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option2` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option3` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option4` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option5` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option6` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option7` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option8` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option9` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sort` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_poll_options`
--

CREATE TABLE IF NOT EXISTS `#prefix#_poll_options` (
  `poll_option_id` tinyint(4) NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_option_text` text COLLATE utf8_bin NOT NULL,
  `poll_option_total` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `poll_opt_id` (`poll_option_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_poll_votes`
--

CREATE TABLE IF NOT EXISTS `#prefix#_poll_votes` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_option_id` tinyint(4) NOT NULL DEFAULT '0',
  `vote_user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `vote_user_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  KEY `topic_id` (`topic_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_posts`
--

CREATE TABLE IF NOT EXISTS `#prefix#_posts` (
  `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_id` int(20) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_approved` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `post_text` mediumtext COLLATE utf8_bin NOT NULL,
  `post_checksum` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_postcount` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_edit_user` int(20) unsigned NOT NULL DEFAULT '0',
  `post_edit_count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `post_edit_locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_ip` (`poster_ip`),
  KEY `poster_id` (`poster_id`),
  KEY `post_approved` (`post_approved`),
  KEY `post_username` (`post_username`),
  KEY `tid_post_time` (`topic_id`,`post_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_privacy_backup`
--

CREATE TABLE IF NOT EXISTS `#prefix#_privacy_backup` (
  `master` int(11) unsigned NOT NULL DEFAULT '0',
  `slave` int(11) NOT NULL DEFAULT '0',
  `torrent` int(11) NOT NULL DEFAULT '0',
  `status` enum('pending','denied','granted') COLLATE utf8_bin NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`slave`,`torrent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_privacy_file`
--

CREATE TABLE IF NOT EXISTS `#prefix#_privacy_file` (
  `master` int(11) unsigned NOT NULL DEFAULT '0',
  `slave` int(11) unsigned NOT NULL DEFAULT '0',
  `torrent` int(15) unsigned NOT NULL DEFAULT '0',
  `status` enum('pending','denied','granted') COLLATE utf8_bin NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`slave`,`torrent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_privacy_global`
--

CREATE TABLE IF NOT EXISTS `#prefix#_privacy_global` (
  `master` int(11) unsigned NOT NULL DEFAULT '0',
  `torrent` int(11) NOT NULL DEFAULT '0',
  `slave` int(11) unsigned NOT NULL DEFAULT '0',
  `status` enum('blacklist','whitelist') COLLATE utf8_bin NOT NULL DEFAULT 'whitelist',
  PRIMARY KEY (`master`,`slave`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_private_messages`
--

CREATE TABLE IF NOT EXISTS `#prefix#_private_messages` (
  `id` int(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `sender` int(11) unsigned NOT NULL DEFAULT '0',
  `recipient` text COLLATE utf8_bin NOT NULL,
  `subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `text` longtext COLLATE utf8_bin NOT NULL,
  `is_read` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_del` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `recipient_del` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `save` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `bcc_address` text COLLATE utf8_bin NOT NULL,
  `root_level` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `message_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL,
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL,
  `message_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `message_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_edit_user` int(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `from` (`sender`),
  KEY `root_level` (`root_level`,`author_ip`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_private_messages_blacklist`
--

CREATE TABLE IF NOT EXISTS `#prefix#_private_messages_blacklist` (
  `master` int(11) unsigned NOT NULL DEFAULT '0',
  `slave` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`master`,`slave`),
  KEY `master` (`master`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_private_messages_bookmarks`
--

CREATE TABLE IF NOT EXISTS `#prefix#_private_messages_bookmarks` (
  `master` int(11) unsigned NOT NULL DEFAULT '0',
  `slave` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`master`,`slave`),
  KEY `master` (`master`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_private_messages_rules`
--

CREATE TABLE IF NOT EXISTS `#prefix#_private_messages_rules` (
  `rule_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `rule_check` mediumint(8) NOT NULL DEFAULT '0',
  `rule_connection` mediumint(8) NOT NULL DEFAULT '0',
  `rule_string` varchar(255) NOT NULL,
  `rule_user_id` int(20) NOT NULL DEFAULT '0',
  `rule_group_id` mediumint(8) NOT NULL DEFAULT '0',
  `rule_action` mediumint(8) NOT NULL DEFAULT '0',
  `rule_folder_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rule_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_privmsgs_folder`
--

CREATE TABLE IF NOT EXISTS `#prefix#_privmsgs_folder` (
  `folder_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `folder_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pm_count` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`folder_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_privmsgs_to`
--

CREATE TABLE IF NOT EXISTS `#prefix#_privmsgs_to` (
  `msg_id` int(20) NOT NULL DEFAULT '0',
  `user_id` int(20) NOT NULL DEFAULT '0',
  `author_id` int(20) NOT NULL DEFAULT '0',
  `pm_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `pm_new` tinyint(1) NOT NULL DEFAULT '1',
  `pm_unread` tinyint(1) NOT NULL DEFAULT '1',
  `pm_replied` tinyint(1) NOT NULL DEFAULT '0',
  `pm_marked` tinyint(1) NOT NULL DEFAULT '0',
  `pm_forwarded` tinyint(1) NOT NULL DEFAULT '0',
  `folder_id` int(11) NOT NULL DEFAULT '0',
  KEY `msg_id` (`msg_id`,`user_id`,`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ranks`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ranks` (
  `rank_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `rank_min` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rank_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ratings`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ratings` (
  `torrent` int(10) unsigned NOT NULL DEFAULT '0',
  `user` int(10) unsigned NOT NULL DEFAULT '0',
  `rating` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`torrent`,`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ratiowarn`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ratiowarn` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `warned` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `banned` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `ratiodate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `warntime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ratiowarn_config`
--

CREATE TABLE IF NOT EXISTS `#prefix#_ratiowarn_config` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_reports`
--

CREATE TABLE IF NOT EXISTS `#prefix#_reports` (
  `report_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `reason_id` smallint(4) NOT NULL DEFAULT '0',
  `post_id` mediumint(8) NOT NULL DEFAULT '0',
  `pm_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` int(20) NOT NULL DEFAULT '0',
  `user_notify` tinyint(1) NOT NULL DEFAULT '0',
  `report_closed` tinyint(1) NOT NULL DEFAULT '0',
  `report_time` int(11) NOT NULL DEFAULT '0',
  `report_text` mediumtext NOT NULL,
  PRIMARY KEY (`report_id`),
  KEY `post_id` (`post_id`,`pm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_reports_reasons`
--

CREATE TABLE IF NOT EXISTS `#prefix#_reports_reasons` (
  `reason_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `reason_title` varchar(255) NOT NULL,
  `reason_description` mediumtext NOT NULL,
  `reason_order` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`reason_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_rules`
--

CREATE TABLE IF NOT EXISTS `#prefix#_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `text` longtext COLLATE utf8_bin NOT NULL,
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL,
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL,
  `public` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `level` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_search_cloud`
--

CREATE TABLE IF NOT EXISTS `#prefix#_search_cloud` (
  `active` int(11) NOT NULL DEFAULT '0',
  `user_only` int(11) NOT NULL DEFAULT '0',
  `how_many` int(11) NOT NULL DEFAULT '10'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_search_text`
--

CREATE TABLE IF NOT EXISTS `#prefix#_search_text` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT '',
  `hit` int(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `text` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_seeder_notify`
--

CREATE TABLE IF NOT EXISTS `#prefix#_seeder_notify` (
  `torrent` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `status` enum('active','stopped') COLLATE utf8_bin NOT NULL DEFAULT 'active',
  PRIMARY KEY (`torrent`,`user`),
  KEY `contacts` (`torrent`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_sessions`
--

CREATE TABLE IF NOT EXISTS `#prefix#_sessions` (
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `session_forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `session_last_visit` int(11) unsigned NOT NULL DEFAULT '0',
  `session_start` int(11) unsigned NOT NULL DEFAULT '0',
  `session_time` int(11) unsigned NOT NULL DEFAULT '0',
  `session_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_browser` varchar(150) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_forwarded_for` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_page` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_viewonline` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `session_autologin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `session_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `session_time` (`session_time`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_fid` (`session_forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Table structure for table `torrent_shouts`
--

CREATE TABLE IF NOT EXISTS `#prefix#_shouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL DEFAULT '0',
  `text` longtext COLLATE utf8_bin NOT NULL,
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL,
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL,
  `posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_to` int(10) NOT NULL DEFAULT '0',
   `f` mediumint(11) UNSIGNED DEFAULT NULL,
 PRIMARY KEY (`id`),
  KEY `posted` (`posted`)
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
-- Table structure for table `torrent_shout_config`
--

CREATE TABLE IF NOT EXISTS `#prefix#_shout_config` (
  `announce_ment` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `shoutnewuser` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `shout_new_torrent` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `shout_new_porn` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `turn_on` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `refresh_time` int(10) NOT NULL DEFAULT '30',
  `idle_time` int(10) NOT NULL DEFAULT '3000',
  `shouts_to_show` int(10) NOT NULL DEFAULT '25',
  `bbcode_on` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `allow_url` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `autodelete_time` int(10) NOT NULL DEFAULT '30',
  `canedit_on` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `candelete_on` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `autodelet` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `can_quote` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `dateformat` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'd M Y H:i'
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
-- Table structure for table `torrent_smiles`
--

CREATE TABLE IF NOT EXISTS `#prefix#_smiles` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '',
  `file` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `alt` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sort_index` int(10) NOT NULL,
  `smiley_url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_snatched`
--

CREATE TABLE IF NOT EXISTS `#prefix#_snatched` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `torrent` int(10) unsigned NOT NULL DEFAULT '0',
  `torrentid` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` bigint(20) unsigned NOT NULL DEFAULT '0',
  `torrent_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `torrent_category` int(10) unsigned NOT NULL DEFAULT '0',
  `port` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uploaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `downloaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `to_go` bigint(20) unsigned NOT NULL DEFAULT '0',
  `speedup` bigint(20) unsigned NOT NULL DEFAULT '0',
  `speeddown` bigint(20) unsigned NOT NULL DEFAULT '0',
  `seeder` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `last_action` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `startdat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completedat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `connectable` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  `agent` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `finished` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `seeding_time` int(10) DEFAULT '0',
  `warned` enum('yes','no') COLLATE utf8_bin DEFAULT 'no',
  `hnr_warning` enum('yes','no') COLLATE utf8_bin DEFAULT 'no',
  `hitrun` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hitrunwarn` enum('yes','pending','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `torrentid_3` (`torrentid`,`userid`),
  KEY `finished` (`finished`,`torrentid`),
  KEY `torrentid` (`userid`),
  KEY `torrentid_2` (`torrentid`),
  KEY `userid` (`userid`,`torrentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_thanks`
--

CREATE TABLE IF NOT EXISTS `#prefix#_thanks` (
  `tid` bigint(10) NOT NULL AUTO_INCREMENT,
  `uid` bigint(10) NOT NULL DEFAULT '0',
  `torid` bigint(10) NOT NULL DEFAULT '0',
  `thank_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_time_offset`
--

CREATE TABLE IF NOT EXISTS `#prefix#_time_offset` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_topics`
--

CREATE TABLE IF NOT EXISTS `#prefix#_blogs_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_approved` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `topic_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic_poster` int(20) unsigned NOT NULL DEFAULT '0',
  `topic_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_time_limit` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_replies_real` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_first_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_first_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_last_view_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_bumped` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_bumper` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `poll_start` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_length` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_max_options` tinyint(4) NOT NULL DEFAULT '1',
  `poll_last_vote` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_vote_change` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_type` (`forum_id`,`topic_type`),
  KEY `last_post_time` (`topic_last_post_time`),
  KEY `topic_approved` (`topic_approved`),
  KEY `forum_appr_last` (`forum_id`,`topic_approved`,`topic_last_post_id`),
  KEY `fid_time_moved` (`forum_id`,`topic_last_post_time`,`topic_moved_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_topics_posted`
--

CREATE TABLE IF NOT EXISTS `#prefix#_topics_posted` (
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_topics_track`
--

CREATE TABLE IF NOT EXISTS `#prefix#_topics_track` (
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mark_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_topics_watch`
--

CREATE TABLE IF NOT EXISTS `#prefix#_topics_watch` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_stat` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_torrents`
--

CREATE TABLE IF NOT EXISTS `#prefix#_torrents` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `info_hash` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `md5sum` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `filename` varchar(255) COLLATE utf8_bin NOT NULL,
  `save_as` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `search_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descr` text COLLATE utf8_bin NOT NULL,
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL,
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL,
  `post_img` text COLLATE utf8_bin,
  `screan1` text COLLATE utf8_bin,
  `screan2` text COLLATE utf8_bin,
  `screan3` text COLLATE utf8_bin,
  `screan4` text COLLATE utf8_bin,
  `plen` bigint(6) DEFAULT NULL,
  `size` bigint(20) unsigned NOT NULL DEFAULT '0',
  `category` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('single','multi','link') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'single',
  `numfiles` int(10) unsigned NOT NULL DEFAULT '0',
  `added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `exeem` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `dht` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `backup_tracker` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `downloaded` int(10) unsigned NOT NULL DEFAULT '0',
  `completed` int(10) unsigned NOT NULL DEFAULT '0',
  `banned` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `private` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `min_ratio` float unsigned NOT NULL DEFAULT '0',
  `visible` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `evidence` tinyint(1) NOT NULL DEFAULT '0',
  `owner` int(10) unsigned NOT NULL DEFAULT '0',
  `ownertype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `uploader_host` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numratings` int(10) unsigned NOT NULL DEFAULT '0',
  `ratingsum` int(10) unsigned NOT NULL DEFAULT '0',
  `seeders` int(10) unsigned NOT NULL DEFAULT '0',
  `leechers` int(10) unsigned NOT NULL DEFAULT '0',
  `tot_peer` int(11) unsigned NOT NULL DEFAULT '0',
  `speed` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` int(10) unsigned NOT NULL DEFAULT '0',
  `complaints` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0,0',
  `tracker` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tracker_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tracker_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_action` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nuked` enum('yes','no','unnuked') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `ratiobuild` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `nukereason` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thanks` int(10) NOT NULL DEFAULT '0',
  `imdb` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `info_hash` (`info_hash`),
  KEY `owner` (`owner`),
  KEY `visible` (`visible`),
  KEY `added` (`added`),
  KEY `seeders` (`seeders`),
  KEY `leechers` (`leechers`),
  KEY `tot_peer` (`tot_peer`),
  KEY `banned` (`banned`),
  KEY `password` (`password`),
  KEY `tracker` (`tracker`),
  KEY `evidence` (`evidence`),
  KEY `rating` (`numratings`,`ratingsum`),
  KEY `numfiles` (`numfiles`),
  KEY `downloaded` (`downloaded`),
  KEY `category` (`category`),
  KEY `type` (`type`),
  FULLTEXT KEY `ft_search` (`search_text`),
  FULLTEXT KEY `filename` (`filename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin PACK_KEYS=1 CHECKSUM=1;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_trackers`
--

CREATE TABLE IF NOT EXISTS `#prefix#_trackers` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(120) COLLATE utf8_bin NOT NULL DEFAULT '',
  `support` enum('selective','global','single') COLLATE utf8_bin NOT NULL DEFAULT 'selective',
  `status` enum('active','dead','blacklisted') COLLATE utf8_bin NOT NULL DEFAULT 'active',
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `update` (`updated`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_userautodel`
--

CREATE TABLE IF NOT EXISTS `#prefix#_userautodel` (
  `inactwarning_time` int(10) NOT NULL DEFAULT '0',
  `autodel_users_time` int(10) NOT NULL DEFAULT '0',
  `autodel_users` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_users`
--

CREATE TABLE IF NOT EXISTS `#prefix#_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT '',
  `clean_username` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT '',
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `regdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `theme` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `language` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'blank.gif',
  `avatar_type` bigint(32) NOT NULL DEFAULT '0',
  `avatar_ht` bigint(32) NOT NULL DEFAULT '0',
  `avatar_wt` bigint(32) NOT NULL DEFAULT '0',
  `accept_mail` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `mass_mail` enum('yes','no') COLLATE utf8_bin NOT NULL,
  `pm_notify` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `pm_popup` enum('true','false') COLLATE utf8_bin NOT NULL,
  `aim` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `icq` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `jabber` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `msn` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `skype` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `yahoo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `level` enum('user','premium','moderator','admin') COLLATE utf8_bin NOT NULL DEFAULT 'user',
  `can_do` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT 'user',
  `user_rank` mediumint(9) NOT NULL DEFAULT '0',
  `user_type` tinyint(2) NOT NULL DEFAULT '0',
  `user_permissions` mediumtext COLLATE utf8_bin,
  `user_colour` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `user_perm_from` mediumint(8) unsigned DEFAULT NULL,
  `uploaded` bigint(32) unsigned NOT NULL DEFAULT '0',
  `downloaded` bigint(32) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) DEFAULT '0',
  `ban` int(1) unsigned NOT NULL DEFAULT '0',
  `act_key` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `passkey` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `newpasswd` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `newemail` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mail_key` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `banreason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastip` int(10) unsigned NOT NULL DEFAULT '0',
  `lasthost` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lastlogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rem` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `modcomment` longtext COLLATE utf8_bin,
  `warned` int(1) unsigned NOT NULL DEFAULT '0',
  `warn_kapta` int(11) NOT NULL DEFAULT '0',
  `warn_hossz` int(11) NOT NULL DEFAULT '0',
  `invited_by` int(10) NOT NULL DEFAULT '0',
  `invitees` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `country` int(10) NOT NULL DEFAULT '0',
  `seedbox` int(10) unsigned NOT NULL DEFAULT '0',
  `tzoffset` smallint(4) NOT NULL DEFAULT '0',
  `can_shout` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `Show_online` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `invites` smallint(5) NOT NULL DEFAULT '0',
  `invitedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seedbonus` decimal(10,1) NOT NULL DEFAULT '0.0',
  `donator` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `donated` decimal(10,1) unsigned NOT NULL DEFAULT '0.0',
  `dondate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `torrent_per_page` int(10) DEFAULT NULL,
  `view_dead_tor` TINYINT(1) NOT NULL DEFAULT '0',
  `donator_tell` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dongift` int(1) unsigned NOT NULL DEFAULT '0',
  `inactwarning` tinyint(1) NOT NULL DEFAULT '0',
  `inactive_warn_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_inactive_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_inactive_reason` tinyint(2) NOT NULL DEFAULT '0',
  `hitruns` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `HNR_W` int(11) NOT NULL DEFAULT '0',
  `helper` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `help_able` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '',
  `signature` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bbcode_uid` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `sig_bbcode_bitfield` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `sig_bbcode_uid` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `forumbanned` enum('yes','no') COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `parked` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `disabled` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `disabled_reason` text COLLATE utf8_bin,
  `hide_profile` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `birthday` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `client` varchar(225) COLLATE utf8_bin DEFAULT NULL,
  `lastpage` varchar(225) COLLATE utf8_bin DEFAULT NULL,
  `user_message_rules` int(1) unsigned NOT NULL DEFAULT '0',
  `user_full_folder` int(11) NOT NULL DEFAULT '6',
  `user_last_privmsg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_unread_privmsg` int(4) unsigned NOT NULL DEFAULT '0',
  `user_new_privmsg` int(4) NOT NULL DEFAULT '0',
  `user_lastpost_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastmark` int(11) unsigned NOT NULL DEFAULT '0',
  `user_allow_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewemail` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_massemail` tinyint(1) NOT NULL DEFAULT '1',
  `user_posts` int(10) NOT NULL DEFAULT '0',
  `user_notify` int(1) NOT NULL DEFAULT '0',
  `user_topic_show_days` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_topic_sortby_type` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_topic_sortby_dir` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'd',
  `user_post_show_days` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_post_sortby_type` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_post_sortby_dir` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `user_notify_pm` tinyint(1) NOT NULL DEFAULT '1',
  `user_notify_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_warnings` tinyint(4) NOT NULL DEFAULT '0',
  `user_last_warning` int(11) NOT NULL DEFAULT '0',
  `user_options` int(11) unsigned NOT NULL DEFAULT '895',
  `user_dateformat` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'd M Y H:i',
  `user_dst` tinyint(1) NOT NULL DEFAULT '0',
  `user_reminded` tinyint(4) NOT NULL DEFAULT '0',
  `user_reminded_time` int(11) unsigned NOT NULL DEFAULT '0',  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `passkey` (`passkey`),
  KEY `lastip` (`lastip`),
  KEY `lasthost` (`lasthost`),
  KEY `date` (`regdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_user_group`
--

CREATE TABLE IF NOT EXISTS `#prefix#_user_group` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `group_leader` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_pending` tinyint(1) unsigned NOT NULL DEFAULT '1',
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_leader` (`group_leader`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_warnings`
--

CREATE TABLE IF NOT EXISTS `#prefix#_warnings` (
  `warning_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `log_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `warning_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`warning_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_words`
--

CREATE TABLE IF NOT EXISTS `#prefix#_words` (
	`word_id` mediumint(8) UNSIGNED NOT NULL auto_increment,
	`word` varchar(255) DEFAULT '' NOT NULL,
	`replacement` varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_zebra`
--

CREATE TABLE IF NOT EXISTS `#prefix#_zebra` (
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `zebra_id` int(20) unsigned NOT NULL DEFAULT '0',
  `friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `foe` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`zebra_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
