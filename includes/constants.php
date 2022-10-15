<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
/***************************************************************************
 *                               constants.php
 *                            -------------------
 *   begin                : Saturday', Feb 13', 2001
 *   copyright            : ('C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: constants.php,v 1.47.2.5 2004/11/18 17:49:42 acydburn Exp
 *
 ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License', or
 *   ('at your option) any later version.
 *
 ***************************************************************************/
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

if (!defined('IN_PHPBB') && !defined('NUKE_EVO'))
{
    die('Hacking attempt');
}

# Network Support
#character set define XHTML1.0
define("_CHARSET","utf-8");
define("_LANG_DIRECTION","ltr");
define("_LANGCODE","en");
define("_MIME", "text/html"); 

// Debug Level
//define('DEBUG', 1); // Debugging on
define('DEBUG', 1); // Debugging off
// User Levels <- Do not change the values of USER or ADMIN
define('DELETED', -1);
define('ANONYMOUS', 1);
define('USER', 1);
define('ADMIN', 2);
define('MOD', 3);
// User related
define('USER_ACTIVATION_NONE', 0);
define('USER_ACTIVATION_SELF', 1);
define('USER_ACTIVATION_ADMIN', 2);
define('USER_AVATAR_NONE', 0);
define('USER_AVATAR_UPLOAD', 1);
define('USER_AVATAR_REMOTE', 2);
define('USER_AVATAR_GALLERY', 3);
// Group settings
define('GROUP_OPEN', 0);
define('GROUP_CLOSED', 1);
define('GROUP_HIDDEN', 2);
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
define('GROUP_INITIAL_NO', 0);
define('GROUP_INITIAL_YES', 1);
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
// Forum state
define('FORUM_UNLOCKED', 0);
define('FORUM_LOCKED', 1);
/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
// Forum Thanks state
define('FORUM_UNTHANKABLE', 0);
define('FORUM_THANKABLE', 1);
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
// Topic status
define('TOPIC_UNLOCKED', 0);
define('TOPIC_LOCKED', 1);
define('TOPIC_MOVED', 2);
define('TOPIC_WATCH_NOTIFIED', 1);
define('TOPIC_WATCH_UN_NOTIFIED', 0);
// Topic types
define('POST_NORMAL', 0);
define('POST_STICKY', 1);
define('POST_ANNOUNCE', 2);
define('POST_GLOBAL_ANNOUNCE', 3);
// Error codes
define('GENERAL_MESSAGE', 200);
define('GENERAL_ERROR', 202);
define('CRITICAL_MESSAGE', 203);
define('CRITICAL_ERROR', 204);
// Private messaging
define('PRIVMSGS_READ_MAIL', 0);
define('PRIVMSGS_NEW_MAIL', 1);
define('PRIVMSGS_SENT_MAIL', 2);
define('PRIVMSGS_SAVED_IN_MAIL', 3);
define('PRIVMSGS_SAVED_OUT_MAIL', 4);
define('PRIVMSGS_UNREAD_MAIL', 5);
// URL PARAMETERS
define('POST_TOPIC_URL', 't');
define('POST_CAT_URL', 'c');
define('POST_FORUM_URL', 'f');
define('POST_USERS_URL', 'u');
define('POST_POST_URL', 'p');
define('POST_GROUPS_URL', 'g');
// Session parameters
define('SESSION_METHOD_COOKIE', 100);
define('SESSION_METHOD_GET', 101);
// Page numbers for session handling
define('PAGE_INDEX', 0);
define('PAGE_LOGIN', -1);
define('PAGE_SEARCH', -2);
define('PAGE_REGISTER', -3);
define('PAGE_PROFILE', -4);
define('PAGE_VIEWONLINE', -6);
define('PAGE_VIEWMEMBERS', -7);
define('PAGE_FAQ', -8);
define('PAGE_POSTING', -9);
define('PAGE_PRIVMSGS', -10);
define('PAGE_GROUPCP', -11);
/*****[START]******************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/
define('PAGE_TOPIC_VIEW', -1032);
/*****[END]********************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
define('PAGE_REPUTATION', -1280);
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
define('PAGE_GAME', -50);
define('PAGE_ARCADES', -51);
define('PAGE_TOPARCADES', -52);
define('PAGE_STATARCADES', -53);
define('PAGE_SCOREBOARD', -54);
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/
define('PAGE_STAFF', -12);
/*****[END]********************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
define('PAGE_RECENT', -33);
/*****[END]********************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/

define('PAGE_TOPIC_OFFSET', 5000);
// Auth settings
define('AUTH_LIST_ALL', 0);
define('AUTH_ALL', 0);
define('AUTH_REG', 1);
define('AUTH_ACL', 2);
define('AUTH_MOD', 3);
define('AUTH_ADMIN', 5);
define('AUTH_VIEW', 1);
define('AUTH_READ', 2);
define('AUTH_POST', 3);
define('AUTH_REPLY', 4);
define('AUTH_EDIT', 5);
define('AUTH_DELETE', 6);
define('AUTH_ANNOUNCE', 7);
define('AUTH_STICKY', 8);
define('AUTH_POLLCREATE', 9);
define('AUTH_VOTE', 10);
define('AUTH_ATTACH', 11);
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
define('AUTH_GLOBALANNOUNCE', 12);
define('HIDDEN_CAT', 0); // NOTE: change this value to the forum id, of the forum, witch you would like to be hidden
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

// Nuke-Evolution Core Tables
define('_AUTHOR_TABLE', $prefix.'_authors');
define('_AUTONEWS_TABLE', $prefix.'_autonews');
define('_BLOCKS_TABLE', $prefix.'_blocks');
define('_COMMENTS_TABLE', $prefix.'_comments');
define('_COUNTER_TABLE', $prefix.'_counter');
define('_COUNTRY_TABLE', $prefix.'_country');
define('_EVOCONFIG_TABLE', $prefix.'_evolution');
define('_EVO_CONFIG_TABLE', $prefix.'_evolution_config');
define('_HEADLINES_TABLE', $prefix.'_headlines');
define('_MAIN_TABLE', $prefix.'_main');
define('_META_TABLE', $prefix.'_meta');
define('_MESSAGE_TABLE', $prefix.'_message');
define('_MODULES_TABLE', $prefix.'_modules');
define('_MODULES_CATEGORIES_TABLE', $prefix.'_modules_cat');
define('_MODULES_CONFIG_TABLE', $prefix.'_modules_config');
define('_MODULES_EXLINKS_TABLE', $prefix.'_modules_links');
define('_MODULES_POPUPS_TABLE', $prefix.'_modules_popups');
define('_MOSTONLINE_TABLE', $prefix.'_mostonline');
define('_NUKE_CONFIG_TABLE', $prefix.'_config');
define('_QUEUE_TABLE', $prefix.'_queue');
define('_REFERER_TABLE', $prefix.'_referer');
define('_SECURITY_BOT_TABLE', $prefix.'_security_agents');
define('_SESSION_TABLE', $prefix.'_session');
define('_THEMES_TABLE', $prefix.'_themes');
define('_THEMES_INFO_TABLE', $prefix.'_themes_info');
define('_WELCOME_PM_TABLE', $prefix.'_welcome_pm');
define('_USERS_WHO_BEEN', $prefix.'_users_who_been');

// Admin failed login check
define('_FAILED_LOGIN_INFO_TABLE', $prefix.'_admin_fc');

// Error-Log
define('_ERROR_TABLE', $prefix.'_errors');
define('_ERROR_CONFIG_TABLE', $prefix.'_errors_config');

// Evo_UserBlock
define('_BLOCK_EVO_USERINFO_TABLE', $prefix.'_evo_userinfo');
define('_BLOCK_EVO_USERINFO_ADDONS_TABLE', $prefix.'_evo_userinfo_addons');

// FAQ
define('_FAQ_ANSWER_TABLE', $prefix.'_faqanswer');
define('_FAQ_CATEGORIES_TABLE', $prefix.'_faqcategories');

// Honeypot
define('_HONEYPOT_TABLE', $prefix.'_honeypot');
define('_HONEYPOT_CONFIG_TABLE', $prefix.'_honeypot_config');

// Link Us
define('_LINKUS_CONFIG_TABLE', $prefix.'_link_us_config');
define('_LINKUS_TABLE', $prefix.'_link_us');

// Blogs - These are not used yet as of 10/15/2022 TheGhost
define('_BLOGS_FUNC_TABLE', $prefix.'_nsnne_func');
define('_BLOG_CONFIG_TABLE', $prefix.'_nsnne_config');

// Sommaire (not pre-installed within Evo)
define('_SOMMAIRE_TABLE', $prefix.'_sommaire');
define('_SOMMAIRE_CATEGORIES_TABLE', $prefix.'_sommaire_categories');

// Statistics
define('_STATS_HOUR_TABLE', $prefix.'_stats_hour');

// Stories Archive
define('_STORIES_TABLE', $prefix.'_stories');
define('_STORIES_CATEGORIES_TABLE', $prefix.'_stories_cat');

// Supporters
define('_NSNSP_SITES_TABLE', $prefix.'_nsnsp_sites');
define('_NSNSP_CONFIG_TABLE', $prefix.'_nsnsp_config');

// Surveys
define('_POLL_COMMENTS_TABLE', $prefix.'_pollcomments');
define('_POLL_DESC_TABLE', $prefix.'_poll_desc');
define('_POLL_DATA_TABLE', $prefix.'_poll_data');
define('_POLL_CHECK_TABLE', $prefix.'_poll_check');

// Topics
define('_TOPICS_TABLE', $prefix.'_topics');

// Web Links
define('_WEBLINKS_CONFIG_TABLE', $prefix.'_links_config');
define('_WEBLINKS_CATEGORIES_TABLE', $prefix.'_links_categories');
define('_WEBLINKS_SUBCATEGORIES_TABLE', $prefix.'_links_subcategories');
define('_WEBLINKS_LINKS_TABLE', $prefix.'_links_links');
define('_WEBLINKS_NEWLINK_TABLE', $prefix.'_links_newlink');
define('_WEBLINKS_EDITORIALS_TABLE', $prefix.'_links_editorials');
define('_WEBLINKS_VOTEDATA_TABLE', $prefix.'_links_votedata');
define('_WEBLINKS_MODREQUEST_TABLE', $prefix.'_links_modrequest');

// Your Account (CNBYA)
define('_CNBYA_CONFIG_TABLE', $prefix.'_cnbya_config');
define('_CNBYA_VALUE_TABLE', $prefix.'_cnbya_value');
define('_CNBYA_FIELD_TABLE', $prefix.'_cnbya_field');
define('_CNBYA_VALUE_TEMP_TABLE', $prefix.'_cnbya_value_temp');



// Table names
//define('CONFIRM_TABLE', $prefix.'_bbconfirm');
define('AUC_TABLE', $prefix.'_bbadvanced_username_color');
define('AUTH_ACCESS_TABLE', $prefix.'_bbauth_access');
define('BANLIST_TABLE', $prefix.'_bbbanlist');
define('CATEGORIES_TABLE', $prefix.'_bbcategories');
define('CONFIG_TABLE', $prefix.'_bbconfig');
define('DISALLOW_TABLE', $prefix.'_bbdisallow');
define('FORUMS_TABLE', $prefix.'_bbforums');
define('GROUPS_TABLE', $prefix.'_bbgroups');
define('POSTS_TABLE', $prefix.'_bbposts');
/*--FNA--*/
define('POSTS_TEXT_TABLE', $prefix.'_bbposts_text');
define('PRIVMSGS_TABLE', $prefix.'_bbprivmsgs');
define('PRIVMSGS_TEXT_TABLE', $prefix.'_bbprivmsgs_text');
define('PRIVMSGS_IGNORE_TABLE', $prefix.'_bbprivmsgs_ignore');
define('PRUNE_TABLE', $prefix.'_bbforum_prune');
define('RANKS_TABLE', $prefix.'_bbranks');
define('SEARCH_TABLE', $prefix.'_bbsearch_results');
define('SEARCH_WORD_TABLE', $prefix.'_bbsearch_wordlist');
define('SEARCH_MATCH_TABLE', $prefix.'_bbsearch_wordmatch');
define('SESSIONS_TABLE', $prefix.'_bbsessions');
define('SESSIONS_KEYS_TABLE', $prefix.'_bbsessions_keys');
define('SMILIES_TABLE', $prefix.'_bbsmilies');
/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
define('THANKS_TABLE', $prefix.'_bbthanks');
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
define('THEMES_TABLE', $prefix.'_bbthemes');
define('THEMES_NAME_TABLE', $prefix.'_bbthemes_name');
define('TOPICS_TABLE', $prefix.'_bbtopics');
/*****[BEGIN]******************************************
 [ Mod:     Email topic to friend              v1.0.0 ]
 ******************************************************/
define('TOPICS_EMAIL_TABLE', $prefix.'_bbtopics_email');
/*****[END]********************************************
 [ Mod:     Email topic to friend              v1.0.0 ]
 ******************************************************/
define('TOPICS_WATCH_TABLE', $prefix.'_bbtopics_watch');
define('USER_GROUP_TABLE', $prefix.'_bbuser_group');
define('USERS_TABLE', $user_prefix.'_users');
define('USERS_TEMP_TABLE', $user_prefix.'_users_temp');
define('WORDS_TABLE', $prefix.'_bbwords');
define('VOTE_DESC_TABLE', $prefix.'_bbvote_desc');
define('VOTE_RESULTS_TABLE', $prefix.'_bbvote_results');
define('VOTE_USERS_TABLE', $prefix.'_bbvote_voters');
/*****[START]******************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/
define('TOPIC_VIEW_TABLE', $prefix.'_bbtopic_view'); 
/*****[END]********************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
define('REPUTATION_TABLE', $prefix.'_bbreputation');
define('REPUTATION_CONFIG_TABLE', $prefix.'_bbreputation_config');
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
define('FLAG_TABLE', $prefix.'_bbflags');
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
define('XDATA_FIELDS_TABLE', $prefix.'_bbxdata_fields');
define('XDATA_DATA_TABLE', $prefix.'_bbxdata_data');
define('XDATA_AUTH_TABLE', $prefix.'_bbxdata_auth');

define('XD_AUTH_ALLOW', 1);
define('XD_AUTH_DENY', 0);
define('XD_AUTH_DEFAULT', 2);

define('XD_DISPLAY_NORMAL', 1);
define('XD_DISPLAY_ROOT', 2);
define('XD_DISPLAY_NONE', 0);

define('XD_REGEXP_MANDITORY', "/.+/");
define('XD_REGEXP_LETTERS', "/^[(A-Z)|(a-z)]{1,}$/");
define('XD_REGEXP_NUMBERS', "/^[0-9]{1,}$/");
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
define('REPORT_POST_NEW', 1);
define('REPORT_POST_CLOSED', 2);

define('POST_REPORTS_TABLE', $prefix.'_bbpost_reports');
/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
define('QUICKSEARCH_TABLE', $prefix.'_bbquicksearch');
/*****[END]********************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/
define('ADMIN_NUKE', "../../../".$admin_file.".php");
define('HOME_NUKE', "../../../index.php");
/*****[END]********************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.1.2 ]
 ******************************************************/
define('MANUAL', 0);
define('MANUAL_DST', 1);
define('SERVER_SWITCH', 2);
define('FULL_SERVER', 3);
define('SERVER_PC', 4);
define('FULL_PC', 6);
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.1.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
define('LOGS_TABLE', $prefix.'_bblogs');
define('LOGS_CONFIG_TABLE', $prefix.'_bblogs_config');
define('LOG_ACTIONS_VERSION', '1.1.6');
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
define('GLANCE_NONE', 0);
define('GLANCE_ALL', 1);
define('GLANCE_INDEX', 2);
define('GLANCE_FORUMS', 3);
define('GLANCE_TOPICS', 4);
define('GLANCE_INDEX_AND_TOPICS', 5);
define('GLANCE_INDEX_AND_FORUMS', 6);
define('GLANCE_FORUMS_AND_TOPICS', 7);
/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
define('BIRTHDAY_ALL',0);
define('BIRTHDAY_DATE',1);
define('BIRTHDAY_AGE',2);
define('BIRTHDAY_NONE',3);
define('BIRTHDAY_EMAIL',1);
define('BIRTHDAY_POPUP',2);
define('BIRTHDAY_PM',3);
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
define('GAMES_TABLE', $prefix.'_bbgames');
define('SCORES_TABLE', $prefix.'_bbscores');
define('GAMEHASH_TABLE', $prefix.'_bbgamehash');
define('HACKGAME_TABLE', $prefix.'_bbhackgame');
define('ARCADE_CATEGORIES_TABLE', $prefix.'_bbarcade_categories');
define('ARCADE_TABLE', $prefix.'_bbarcade');
define('AUTH_ARCADE_ACCESS_TABLE', $prefix.'_bbauth_arcade_access');
define('COMMENTS_TABLE', $prefix.'_bbarcade_comments'); 
define('ARCADE_FAV_TABLE', $prefix.'_bbarcade_fav');
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

/*****[BEGIN]*****************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/
define('ALL', 1);
define('ADS_TABLE', $prefix.'_bbinline_ads');
/*****[END]*******************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/

// define('evolution_config_table', $prefix.'_evolution');

// Downloads
define('_DOWNLOADS_ACCESSES_TABLE', $prefix.'_downloads_accesses');
define('_DOWNLOADS_CONFIG_TABLE', $prefix.'_downloads_config');
define('_DOWNLOADS_GROUPS_TABLE', $prefix.'_downloads_groups');
define('_DOWNLOADS_USERS_TABLE', $prefix.'_downloads_users');
define('_DOWNLOADS_CATEGORIES_TABLE', $prefix.'_downloads_categories');
define('_DOWNLOADS_DOWNLOADS_TABLE', $prefix.'_downloads_downloads');
define('_DOWNLOADS_NEWDOWNLOADS_TABLE', $prefix.'_downloads_newdownloads');
define('_DOWNLOADS_EDITORIALS_TABLE', $prefix.'_downloads_editorials');
define('_DOWNLOADS_VOTEDATA_TABLE', $prefix.'_downloads_votedata');
define('_DOWNLOADS_EXTENSIONS_TABLE', $prefix.'_downloads_extensions');
define('_DOWNLOADS_HISTORY_TABLE', $prefix.'_downloads_history');
define('_DOWNLOADS_LICENSES_TABLE', $prefix.'_downloads_licenses');

define('_FILE_REPOSITORY_CATEGORIES', $prefix.'_file_repository_categories');
define('_FILE_REPOSITORY_COMMENTS',   $prefix.'_file_repository_comments');
define('_FILE_REPOSITORY_EXTENSIONS', $prefix.'_file_repository_extensions');
define('_FILE_REPOSITORY_FILES',    $prefix.'_file_repository_files');
define('_FILE_REPOSITORY_ITEMS',    $prefix.'_file_repository_items');
define('_FILE_REPOSITORY_SCREENSHOTS',  $prefix.'_file_repository_screenshots');
define('_FILE_REPOSITORY_SETTINGS',   $prefix.'_file_repository_settings');
define('_FILE_REPOSITORY_THEMES',   $prefix.'_file_repository_themes');

define('AUTHORS_TABLE', $prefix.'_authors');
define('EVOLUTION_CONFIG_TABLE', $prefix.'_evolution');
define('META_TABLE', $prefix.'_meta');
// define('MODULES_TABLE', $prefix.'_modules');

define('EVOLUTION_SESSIONS_TABLE', $prefix.'_session');
define('USERS_BEEN_TABLE', $prefix.'_users_who_been');

define('THEMES_THEMES_TABLE', $prefix.'_themes');

define('HONEYPOT_TABLE', $prefix.'_honeypot');

define('IP_TO_COUNTRY_TABLE', $prefix.'_nsnst_ip2country');

?>