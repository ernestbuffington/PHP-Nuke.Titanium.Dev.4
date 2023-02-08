<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 
/***********************************************************************
 *                           includes/constants.php
 *                            -------------------
 *   Last Update          : Saturday', Dec 24', 2022
 *   Started              : Saturday', Feb 13', 2001
 *   Current Copyright    : ('C) 2022 The Titanium Group
 *   Original Copyright   : ('C) 2001 The phpBB Group
 *   Current Email        : support@php-nuke-tianium.86it.us
 *   Original Email       : support@phpbb.com
 *
 *   Id: constants.php,v 1.47.2.5 2004/11/18 17:49:42 acydburn Exp
 *   Id: constants.php,v 4.0.3.0 2022/12/24 10:10 am TheGhost
 *
 ************************************************************************/

/************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License', or
 *   ('at your option) any later version.
 *
 ************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Recent Topics                            v1.2.4       06/11/2005
      Global Announcements                     v1.2.8       06/13/2005
      Quick Search                             v3.0.1       08/23/2005
      Staff Site                               v2.0.3       06/24/2005
      Forum ACP Administration Links           v1.0.0       06/26/2005
      Advanced Time Management                 v2.1.2       07/26/2005
      XData                                    v1.0.3       02/08/2007
      At a Glance Options                      v1.0.0       08/17/2005
      Initial Usergroup                        v1.0.1       08/25/2005
      Report Posts                             v1.2.3       08/30/2005
	  Member Country Flags                     v2.0.7
	  Birthdays                                v3.0.0
	  Thank You Mod                            v1.1.8
	  Users Reputations Systems                v1.0.0       05/25/2009
	  Inline Banner Ad                         v1.2.3       05/26/2009
	  Email topic to friend                    v1.0.0       05/26/2009
	  Arcade                                   v3.0.2       05/29/2009
      Who viewed a topic                       v1.0.3
 ************************************************************************/

if (!defined('IN_PHPBB') && !defined('NUKE_EVO')):
 die('Hacking attempt');
endif;

# Debug Level
# define_once('DEBUG', 1); # Debugging on
define_once('DEBUG', 1);   # Debugging off

# User Levels <- Do not change the values of USER or ADMIN
define_once('DELETED', -1);
define_once('ANONYMOUS', 1);
define_once('USER', 1);
define_once('ADMIN', 2);
define_once('MOD', 3);

# User related
define_once('USER_ACTIVATION_NONE', 0);
define_once('USER_ACTIVATION_SELF', 1);
define_once('USER_ACTIVATION_ADMIN', 2);
define_once('USER_AVATAR_NONE', 0);
define_once('USER_AVATAR_UPLOAD', 1);
define_once('USER_AVATAR_REMOTE', 2);
define_once('USER_AVATAR_GALLERY', 3);

# Group settings
define_once('GROUP_OPEN', 0);
define_once('GROUP_CLOSED', 1);
define_once('GROUP_HIDDEN', 2);

# Mod: Initial Usergroup v1.0.1 START
define_once('GROUP_INITIAL_NO', 0);
define_once('GROUP_INITIAL_YES', 1);
# Mod: Initial Usergroup v1.0.1 END

# Forum state
define_once('FORUM_UNLOCKED', 0);
define_once('FORUM_LOCKED', 1);

# Mod: Thank You Mod v1.1.8 START
define_once('FORUM_UNTHANKABLE', 0); // Forum Thanks state
define_once('FORUM_THANKABLE', 1);   // Forum Thanks state
# Mod: Thank You Mod v1.1.8 END

# Topic status
define_once('TOPIC_UNLOCKED', 0);
define_once('TOPIC_LOCKED', 1);
define_once('TOPIC_MOVED', 2);
define_once('TOPIC_WATCH_NOTIFIED', 1);
define_once('TOPIC_WATCH_UN_NOTIFIED', 0);

# Topic types
define_once('POST_NORMAL', 0);
define_once('POST_STICKY', 1);
define_once('POST_ANNOUNCE', 2);
define_once('POST_GLOBAL_ANNOUNCE', 3);

define_once('POST_BIRTHDAY', 4);
define_once('POST_CALENDAR', 5);

# Error codes
define_once('GENERAL_MESSAGE', 200);
define_once('GENERAL_ERROR', 202);
define_once('CRITICAL_MESSAGE', 203);
define_once('CRITICAL_ERROR', 204);

# Private messaging
define_once('PRIVMSGS_READ_MAIL', 0);
define_once('PRIVMSGS_NEW_MAIL', 1);
define_once('PRIVMSGS_SENT_MAIL', 2);
define_once('PRIVMSGS_SAVED_IN_MAIL', 3);
define_once('PRIVMSGS_SAVED_OUT_MAIL', 4);
define_once('PRIVMSGS_UNREAD_MAIL', 5);

# URL PARAMETERS
define_once('POST_TOPIC_URL', 't');
define_once('POST_CAT_URL', 'c');
define_once('POST_FORUM_URL', 'f');
define_once('POST_USERS_URL', 'u');
define_once('POST_POST_URL', 'p');
define_once('POST_GROUPS_URL', 'g');

# Session parameters
define_once('SESSION_METHOD_COOKIE', 100);
define_once('SESSION_METHOD_GET', 101);

# Page numbers for session handling
define_once('PAGE_INDEX', 0);
define_once('PAGE_LOGIN', -1);
define_once('PAGE_SEARCH', -2);
define_once('PAGE_REGISTER', -3);
define_once('PAGE_PROFILE', -4);
define_once('PAGE_VIEWONLINE', -6);
define_once('PAGE_VIEWMEMBERS', -7);
define_once('PAGE_FAQ', -8);
define_once('PAGE_POSTING', -9);
define_once('PAGE_PRIVMSGS', -10);
define_once('PAGE_GROUPCP', -11);

# Base: Who viewed a topic v1.0.3 START
define_once('PAGE_TOPIC_VIEW', -1032);
# Base: Who viewed a topic v1.0.3 END

# Mod: Users Reputations Systems v1.0.0 START
define_once('PAGE_REPUTATION', -1280);
# Mod: Users Reputations Systems v1.0.0 END

# Mod: Arcade v3.0.2 START
define_once('PAGE_GAME', -50);
define_once('PAGE_ARCADES', -51);
define_once('PAGE_TOPARCADES', -52);
define_once('PAGE_STATARCADES', -53);
define_once('PAGE_SCOREBOARD', -54);
# Mod: Arcade v3.0.2 END

# Mod: Staff Site v2.0.3 START
define_once('PAGE_STAFF', -12);
# Mod: Staff Site v2.0.3 END

# Base: Recent Topics v1.2.4 START
define_once('PAGE_RECENT', -33);
# Base: Recent Topics v1.2.4 END

define_once('PAGE_TOPIC_OFFSET', 5000);

# Auth settings
define_once('AUTH_LIST_ALL', 0);
define_once('AUTH_ALL', 0);
define_once('AUTH_REG', 1);
define_once('AUTH_ACL', 2);
define_once('AUTH_MOD', 3);
define_once('AUTH_ADMIN', 5);
define_once('AUTH_VIEW', 1);
define_once('AUTH_READ', 2);
define_once('AUTH_POST', 3);
define_once('AUTH_REPLY', 4);
define_once('AUTH_EDIT', 5);
define_once('AUTH_DELETE', 6);
define_once('AUTH_ANNOUNCE', 7);
define_once('AUTH_STICKY', 8);
define_once('AUTH_POLLCREATE', 9);
define_once('AUTH_VOTE', 10);
define_once('AUTH_ATTACH', 11);

# Mod: Global Announcements v1.2.8 START
define_once('AUTH_GLOBALANNOUNCE', 12);
define_once('HIDDEN_CAT', 0); // NOTE: change this value to the forum id, of the forum, that you would like to be hidden
# Mod: Global Announcements v1.2.8 END

# PHP-Nuke Titanium/Evolution Core Tables
define_once('_AUTHOR_TABLE', $prefix.'_authors');
define_once('_AUTONEWS_TABLE', $prefix.'_blogs_autoblog');
define_once('_BLOCKS_TABLE', $prefix.'_blocks');
define_once('_COMMENTS_TABLE', $prefix.'_blogs_comments');
define_once('_COUNTER_TABLE', $prefix.'_counter');
define_once('_COUNTRY_TABLE', $prefix.'_country');
define_once('_EVOCONFIG_TABLE', $prefix.'_evolution');
define_once('_EVO_CONFIG_TABLE', $prefix.'_evolution_config');
define_once('_HEADLINES_TABLE', $prefix.'_headlines');
define_once('_MAIN_TABLE', $prefix.'_main');
define_once('_META_TABLE', $prefix.'_meta');
define_once('_MESSAGE_TABLE', $prefix.'_message');
define_once('_MODULES_TABLE', $prefix.'_modules'); #1
define_once('_MODULES_CATEGORIES_TABLE', $prefix.'_modules_cat');
define_once('_MODULES_CONFIG_TABLE', $prefix.'_modules_config');
define_once('_MODULES_EXLINKS_TABLE', $prefix.'_modules_links');
define_once('_MODULES_POPUPS_TABLE', $prefix.'_modules_popups');
define_once('_MOSTONLINE_TABLE', $prefix.'_mostonline');
define_once('_NUKE_CONFIG_TABLE', $prefix.'_config');
define_once('_QUEUE_TABLE', $prefix.'_blogs_queue');
define_once('_REFERER_TABLE', $prefix.'_referer');
define_once('_SECURITY_BOT_TABLE', $prefix.'_security_agents');
define_once('_SESSION_TABLE', $prefix.'_session');
define_once('_THEMES_TABLE', $prefix.'_themes');
define_once('_THEMES_INFO_TABLE', $prefix.'_themes_info');
define_once('_WELCOME_PM_TABLE', $prefix.'_welcome_pm');
define_once('_USERS_WHO_BEEN', $prefix.'_users_who_been');

# Admin failed login check
define_once('_FAILED_LOGIN_INFO_TABLE', $prefix.'_admin_fc');

# Error-Log
define_once('_ERROR_TABLE', $prefix.'_errors');
define_once('_ERROR_CONFIG_TABLE', $prefix.'_errors_config');

# Evo_UserBlock
define_once('_BLOCK_EVO_USERINFO_TABLE', $prefix.'_evo_userinfo');
define_once('_BLOCK_EVO_USERINFO_ADDONS_TABLE', $prefix.'_evo_userinfo_addons');

# FAQ
define_once('_FAQ_ANSWER_TABLE', $prefix.'_faqanswer');
define_once('_FAQ_CATEGORIES_TABLE', $prefix.'_faqcategories');

# Honeypot
define_once('_HONEYPOT_TABLE', $prefix.'_honeypot');
define_once('_HONEYPOT_CONFIG_TABLE', $prefix.'_honeypot_config');

# Link Us
define_once('_LINKUS_CONFIG_TABLE', $prefix.'_link_us_config');
define_once('_LINKUS_TABLE', $prefix.'_link_us');

# Blogs - These are not used yet as of 10/15/2022 TheGhost
define_once('_BLOG_CONFIG_TABLE', $prefix.'_blogs_config');

# Sommaire (not pre-installed within Evo)
define_once('_SOMMAIRE_TABLE', $prefix.'_sommaire');
define_once('_SOMMAIRE_CATEGORIES_TABLE', $prefix.'_sommaire_categories');

# Statistics
define_once('_STATS_HOUR_TABLE', $prefix.'_stats_hour');

# Stories Archive
define_once('_BLOGS_TABLE', $prefix.'_blogs');
define_once('_BLOGS_CATEGORIES_TABLE', $prefix.'_blogs_cat');

# Supporters
define_once('_NSNSP_SITES_TABLE', $prefix.'_nsnsp_sites');
define_once('_NSNSP_CONFIG_TABLE', $prefix.'_nsnsp_config');

# Surveys
define_once('_POLL_COMMENTS_TABLE', $prefix.'_pollcomments');
define_once('_POLL_DESC_TABLE', $prefix.'_poll_desc');
define_once('_POLL_DATA_TABLE', $prefix.'_poll_data');
define_once('_POLL_CHECK_TABLE', $prefix.'_poll_check');

# Blog Topics
define_once('_BLOG_TOPICS_TABLE', $prefix.'_blogs_topics');

# Web Links
define_once('_WEBLINKS_CONFIG_TABLE', $prefix.'_links_config');
define_once('_WEBLINKS_CATEGORIES_TABLE', $prefix.'_links_categories');
define_once('_WEBLINKS_SUBCATEGORIES_TABLE', $prefix.'_links_subcategories');
define_once('_WEBLINKS_LINKS_TABLE', $prefix.'_links_links');
define_once('_WEBLINKS_NEWLINK_TABLE', $prefix.'_links_newlink');
define_once('_WEBLINKS_EDITORIALS_TABLE', $prefix.'_links_editorials');
define_once('_WEBLINKS_VOTEDATA_TABLE', $prefix.'_links_votedata');
define_once('_WEBLINKS_MODREQUEST_TABLE', $prefix.'_links_modrequest');

# Your Account (CNBYA)
define_once('_CNBYA_CONFIG_TABLE', $prefix.'_cnbya_config');
define_once('_CNBYA_VALUE_TABLE', $prefix.'_cnbya_value');
define_once('_CNBYA_FIELD_TABLE', $prefix.'_cnbya_field');
define_once('_CNBYA_VALUE_TEMP_TABLE', $prefix.'_cnbya_value_temp');

# Table names
define_once('AUC_TABLE', $prefix.'_bbadvanced_username_color');
define_once('AUTH_ACCESS_TABLE', $prefix.'_bbauth_access');
define_once('BANLIST_TABLE', $prefix.'_bbbanlist');
define_once('CATEGORIES_TABLE', $prefix.'_bbcategories');
define_once('CONFIG_TABLE', $prefix.'_bbconfig');
define_once('DISALLOW_TABLE', $prefix.'_bbdisallow');
define_once('FORUMS_TABLE', $prefix.'_bbforums');
define_once('GROUPS_TABLE', $prefix.'_bbgroups');
define_once('POSTS_TABLE', $prefix.'_bbposts');
define_once('POSTS_TEXT_TABLE', $prefix.'_bbposts_text');
define_once('PRIVMSGS_TABLE', $prefix.'_bbprivmsgs');
define_once('PRIVMSGS_TEXT_TABLE', $prefix.'_bbprivmsgs_text');
define_once('PRIVMSGS_IGNORE_TABLE', $prefix.'_bbprivmsgs_ignore');
define_once('PRUNE_TABLE', $prefix.'_bbforum_prune');
define_once('RANKS_TABLE', $prefix.'_bbranks');
define_once('SEARCH_TABLE', $prefix.'_bbsearch_results');
define_once('SEARCH_WORD_TABLE', $prefix.'_bbsearch_wordlist');
define_once('SEARCH_MATCH_TABLE', $prefix.'_bbsearch_wordmatch');
define_once('SESSIONS_TABLE', $prefix.'_bbsessions');
define_once('SESSIONS_KEYS_TABLE', $prefix.'_bbsessions_keys');
define_once('SMILIES_TABLE', $prefix.'_bbsmilies');

# Mod: Thank You Mod v1.1.8 START
define_once('THANKS_TABLE', $prefix.'_bbthanks');
# Mod: Thank You Mod v1.1.8 END

define_once('THEMES_TABLE', $prefix.'_bbthemes');
define_once('THEMES_NAME_TABLE', $prefix.'_bbthemes_name');
define_once('TOPICS_TABLE', $prefix.'_bbtopics');

# Mod: Email topic to friend v1.0.0 START
define_once('TOPICS_EMAIL_TABLE', $prefix.'_bbtopics_email');
# Mod: Email topic to friend v1.0.0 END

define_once('TOPICS_WATCH_TABLE', $prefix.'_bbtopics_watch');
define_once('USER_GROUP_TABLE', $prefix.'_bbuser_group');
define_once('USERS_TABLE', $user_prefix.'_users');
define_once('USERS_TEMP_TABLE', $user_prefix.'_users_temp');
define_once('WORDS_TABLE', $prefix.'_bbwords');
define_once('VOTE_DESC_TABLE', $prefix.'_bbvote_desc');
define_once('VOTE_RESULTS_TABLE', $prefix.'_bbvote_results');
define_once('VOTE_USERS_TABLE', $prefix.'_bbvote_voters');

# Base: Who viewed a topic v1.0.3 START
define_once('TOPIC_VIEW_TABLE', $prefix.'_bbtopic_view'); 
# Base: Who viewed a topic v1.0.3 END

# Mod: Users Reputations Systems v1.0.0 START
define_once('REPUTATION_TABLE', $prefix.'_bbreputation');
define_once('REPUTATION_CONFIG_TABLE', $prefix.'_bbreputation_config');
# Mod: Users Reputations Systems v1.0.0 END
 
# Mod: Member Country Flags v2.0.7 START
define_once('FLAG_TABLE', $prefix.'_bbflags');
# Mod: Member Country Flags v2.0.7 END

# Mod: XData v1.0.3 START
define_once('XDATA_FIELDS_TABLE', $prefix.'_bbxdata_fields'); // Table
define_once('XDATA_DATA_TABLE', $prefix.'_bbxdata_data');     // Table
define_once('XDATA_AUTH_TABLE', $prefix.'_bbxdata_auth');     // Table

define_once('XD_AUTH_ALLOW', 1);                              // Auth Settings
define_once('XD_AUTH_DENY', 0);                               // Auth Settings
define_once('XD_AUTH_DEFAULT', 2);                            // Auth Settings

define_once('XD_DISPLAY_NORMAL', 1);                          // Display Settings
define_once('XD_DISPLAY_ROOT', 2);                            // Display Settings
define_once('XD_DISPLAY_NONE', 0);                            // Display Settings

define_once('XD_REGEXP_MANDITORY', "/.+/");                   // Preg Strings
define_once('XD_REGEXP_LETTERS', "/^[(A-Z)|(a-z)]{1,}$/");    // Preg Strings
define_once('XD_REGEXP_NUMBERS', "/^[0-9]{1,}$/");            // Preg Strings
# Mod: XData v1.0.3 END

# Mod: Report Posts v1.2.3 START
define_once('REPORT_POST_NEW', 1);
define_once('REPORT_POST_CLOSED', 2);
define_once('POST_REPORTS_TABLE', $prefix.'_bbpost_reports');
# Mod: Report Posts v1.2.3 END

# Mod: Quick Search v3.0.1 START
define_once('QUICKSEARCH_TABLE', $prefix.'_bbquicksearch');
# Mod: Quick Search v3.0.1 END

# Mod: Forum ACP Administration Links v1.0.0 START
define_once('ADMIN_NUKE', "../../../".$admin_file.".php");
define_once('HOME_NUKE', "../../../index.php");
# Mod: Forum ACP Administration Links v1.0.0 END

# Mod: Advanced Time Management v2.1.2 START
define_once('MANUAL', 0);
define_once('MANUAL_DST', 1);
define_once('SERVER_SWITCH', 2);
define_once('FULL_SERVER', 3);
define_once('SERVER_PC', 4);
define_once('FULL_PC', 6);
# Mod: Advanced Time Management v2.1.2 END

# Mod: Log Moderator Actions v1.1.6 START
define_once('LOGS_TABLE', $prefix.'_bblogs');
define_once('LOGS_CONFIG_TABLE', $prefix.'_bblogs_config');
define_once('LOG_ACTIONS_VERSION', '1.1.6');
# Mod: Log Moderator Actions v1.1.6 END

# Mod: At a Glance Options v1.0.0 START
define_once('GLANCE_NONE', 0);
define_once('GLANCE_ALL', 1);
define_once('GLANCE_INDEX', 2);
define_once('GLANCE_FORUMS', 3);
define_once('GLANCE_TOPICS', 4);
define_once('GLANCE_INDEX_AND_TOPICS', 5);
define_once('GLANCE_INDEX_AND_FORUMS', 6);
define_once('GLANCE_FORUMS_AND_TOPICS', 7);
# Mod: At a Glance Options v1.0.0 END
 
# Mod: Birthdays v3.0.0 START
define_once('BIRTHDAY_ALL',0);
define_once('BIRTHDAY_DATE',1);
define_once('BIRTHDAY_AGE',2);
define_once('BIRTHDAY_NONE',3);
define_once('BIRTHDAY_EMAIL',1);
define_once('BIRTHDAY_POPUP',2);
define_once('BIRTHDAY_PM',3);
# Mod: Birthdays v3.0.0 END

# Mod: Arcade v3.0.2 START
define_once('GAMES_TABLE', $prefix.'_bbgames');
define_once('SCORES_TABLE', $prefix.'_bbscores');
define_once('GAMEHASH_TABLE', $prefix.'_bbgamehash');
define_once('HACKGAME_TABLE', $prefix.'_bbhackgame');
define_once('ARCADE_CATEGORIES_TABLE', $prefix.'_bbarcade_categories');
define_once('ARCADE_TABLE', $prefix.'_bbarcade');
define_once('AUTH_ARCADE_ACCESS_TABLE', $prefix.'_bbauth_arcade_access');
define_once('COMMENTS_TABLE', $prefix.'_bbarcade_comments'); 
define_once('ARCADE_FAV_TABLE', $prefix.'_bbarcade_fav');
# Mod: Arcade v3.0.2 END

# Mod: Inline Banner Ad v1.2.3 START
define_once('ALL', 1);
define_once('ADS_TABLE', $prefix.'_bbinline_ads');
# Mod: Inline Banner Ad v1.2.3 END

# Original Downloads System
define_once('_DOWNLOADS_ACCESSES_TABLE', $prefix.'_downloads_accesses');
define_once('_DOWNLOADS_CONFIG_TABLE', $prefix.'_downloads_config');
define_once('_DOWNLOADS_GROUPS_TABLE', $prefix.'_downloads_groups');
define_once('_DOWNLOADS_USERS_TABLE', $prefix.'_downloads_users');
define_once('_DOWNLOADS_CATEGORIES_TABLE', $prefix.'_downloads_categories');
define_once('_DOWNLOADS_DOWNLOADS_TABLE', $prefix.'_downloads_downloads');
define_once('_DOWNLOADS_NEWDOWNLOADS_TABLE', $prefix.'_downloads_newdownloads');
define_once('_DOWNLOADS_EDITORIALS_TABLE', $prefix.'_downloads_editorials');
define_once('_DOWNLOADS_VOTEDATA_TABLE', $prefix.'_downloads_votedata');
define_once('_DOWNLOADS_EXTENSIONS_TABLE', $prefix.'_downloads_extensions');
define_once('_DOWNLOADS_HISTORY_TABLE', $prefix.'_downloads_history');
define_once('_DOWNLOADS_LICENSES_TABLE', $prefix.'_downloads_licenses');

# New File REpository Module
//define_once('_FILE_REPOSITORY_CATEGORIES', $prefix.'_file_repository_categories');
//define_once('_FILE_REPOSITORY_COMMENTS',   $prefix.'_file_repository_comments');
//define_once('_FILE_REPOSITORY_EXTENSIONS', $prefix.'_file_repository_extensions');
//define_once('_FILE_REPOSITORY_FILES',    $prefix.'_file_repository_files');
//define_once('_FILE_REPOSITORY_ITEMS',    $prefix.'_file_repository_items');
//define_once('_FILE_REPOSITORY_SCREENSHOTS',  $prefix.'_file_repository_screenshots');
//define_once('_FILE_REPOSITORY_SETTINGS',   $prefix.'_file_repository_settings');
//define_once('_FILE_REPOSITORY_THEMES',   $prefix.'_file_repository_themes');

define_once('AUTHORS_TABLE', $prefix.'_authors');
define_once('EVOLUTION_CONFIG_TABLE', $prefix.'_evolution');
define_once('META_TABLE', $prefix.'_meta');
define_once('EVOLUTION_SESSIONS_TABLE', $prefix.'_session');
define_once('USERS_BEEN_TABLE', $prefix.'_users_who_been');

define_once('THEMES_THEMES_TABLE', $prefix.'_themes');

define_once('HONEYPOT_TABLE', $prefix.'_honeypot');

define_once('IP_TO_COUNTRY_TABLE', $prefix.'_nsnst_ip2country');

?>
