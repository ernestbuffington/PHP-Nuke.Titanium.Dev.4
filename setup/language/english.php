<?php

/**
*****************************************************************************************
** PHP-Nuke Titanium v4.0.4 - Project Start Date 11/04/2022 Friday 4:09 am             **
*****************************************************************************************
** https://www.php-nuke-titanium.86it.us
** https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4
** https://www.php-nuke-titanium.86it.us/index.php (DEMO)
** Apache License, Version 2.0. MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File language/english.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

if (!defined('IN_NUKE'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("_ok", "OK");
define("_error", "Error");
define("_warning", "Warning");
define("_nextstep", "Next");
define("_reset", "Reset");

// Step 1
define("_step1", "<strong>Step 1: Installation Requirements</strong>");
define("_phpvercheck", "Checking PHP Version");
define("_phpverfail", "You need at least PHP version 8.2 to Install PHP-Nuke Titanium.");
define("_zlibcheck", "Checking Zlib");
define("_zlibfail", "Installing Zlib allows you to Save Bandwidth.");
define("_mysqlcheck", "Checking MySQL");
define("_mysqlfail", "You need MySQL PHP Extension to Access MySQL Database.");
define("_domxmlcheck", "Checking Installed DOM XML");
define("_domxmlnotinstalled", "DOM XML is not loaded in PHP and this could affect Performance.");
define("_domxmlload", "Loading DOM XML from External Library");

define("_domxmlcantload", "Cannot load DOM XML.  Check out how to Compile and Install it.  This is Required but, you could still run the Tracker without it.");

define("_externalcheck", "Testing Outgoing Connections");
define("_externalfail", "Cannot Update External Torrent Statistics in Real-time nor determine Active and Passive Users.");
define("_oscheck", "Checking Operating System");
define("_file_repository_folder", "Checking to see if Site File Repository Folders are Writeable");
define("_file_repository_folder_fail", "Site File Repository Folders are Not Writeable");
define("_image_repository_folder", "Checking to see if user Image Repository Folders are Writeable");
define("_image_repository_folder_fail", "User Image Repository Folders are Not Writeable");
define("_cat_pics", "Checking to see if your Category Pictures Folder is Writeable");
define("_cat_pics_fail", "This Folder needs to be Writeable or you will not be able to Upload Category Images.");
define("_massupload", "Checking to see if your Mass Upload Folder is Writeable");
define("_massupload_fail", "This Folder needs to be Writeable for the Mass Upload System to work.");
define("_torrent_folder", "Checking to see if your Torrent Folder is Writeable ");
define("_torrent_fail", "This Folder needs to be Writeable or you will not be able to Upload Torrent Files.");
define("_forum_avatars", "Checking to see if your User Avatar Files Folder is Writeable ");
define("_forum_avatars_fail", "This Folder needs to be Writeable or your Users won't be able Upload Images to the Image Bucket.");
define("_avatarfolder", "Checking to see if your Avatar Folder is Writeable ");

define("_log_folder", "Checking to see if Log Folders are Writeable");
define("_log_folder_fail", "Log Folders are Not Writeable");

define("_google_site_map", "Checking to see if Google Site Map Folders are Writeable");
define("_google_site_map_fail", "Google Site Map Folders are Not Writeable");


define("_avatarfail", "This Folder needs to be Writeable or your Users will not be able to Upload their own Avatars.<br />They can still use Local or External Avatars depending on how you Configure Avatars in the Administration Panel.");

define("_cachefolder", "Checking to make sure your Cache Folder is Writeable");

define("_cache_fail", "This Folder needs to be Writeable because as the Template System depends on it.  Please <strong>CHMOD</strong> the Cache Folder to <strong>777</strong>.");

define("_udp_check", "Checking to make sure UDP:// works on your Server");

define("_udpfail", "Your Server is not Configured to work with Torrents that have a UDP Announce URL.<br />You may still be able to handle External Torrents so as long as their Announce URL is not based on the UDP Protocol.");

define("_step1fail", "You cannot proceed with the Installation of PHP-Nuke Titanium as your Server doesn't meet the Minimum System Requirements.");

define("_step1warn", "You can proceed with the Installation of PHP-Nuke Titanium, but you will not experience the Best Performance.");

// Step 2
define("_step2", "<strong>Step 2: License Agreement</strong>");

define("_gpllicense", "In order to Install PHP-Nuke Titanium you must Agree to ALL the Terms of the Apache License, under which PHP-Nuke Titanium is Released.");

define("_lgpllicense", "You must also Agree to ALL Terms of the GNU/LGPL License because PHP-Nuke Titanium uses Open Source Libraries Released under that License.");

define("_iagree", "I Agree");
define("_idontagree", "I Do Not Agree");
define("_step2fail", "You cannot proceed until you Accept both Licenses.");

// Step 3
define("_step3", "<strong>Step 3: Basic Configuration</strong>");

define("_step3explain", "You can now Configure PHP-Nuke Titanium's Basic Settings.  These Settings include Database Access (i.e. username, password...) and some Advanced Settings like Cookie Encryption and the Mass Uploads Directory.  Further details below.");

define("_dbconfig", "Database Configuration");
define("_dbtype", "Database Type");
define("_dbhost", "Database Server");
define("_dbhosterror", "Host is Unreachable.");
define("_dbuser", "Access User Name");
define("_dbusererror", "Cannot use these Credentials.");
define("_dbpass", "Password");
define("_dbname", "Database Name");
define("_dbnameerror", "Cannot use this Database.  It may be non-existent or not accessible.");
define("_dbprefix", "Table Prefix");
define("_dbpers", "Persistent Connection");
define("_moresettings", "More Settings");
define("_uploaddirectory", "Upload Directory");
define("_mustwritable", "Must be Writeable");
define("_updirnoexist", "Directory Does Not Exist.");
define("_updirnowrite", "Directory is Not Writeable.");
define("_serverreturned", "Server Returned: <strong>**msg**</strong>");
define("_securecookies", "Secure Cookies");
define("_rsacookies", "Enable RSA&reg; Security");
define("_rsamod", "Modulo");
define("_pubkey", "Public Key");
define("_privkey", "Private Key");

define("_permissioncmd", "In order to make the Directory Writeable, Run the following Command from your Server Shell, making sure that your Logged in as <em>**User**</em>: <u>**cmd**</u>");

define("_cannotwriteconfig", "Cannot Save the Configuration File.  Please Create a File named <strong>configdata.php</strong> in the <strong>/include</strong> directory of PHP-Nuke Titanium and Paste the following code in it (ALL of it -- if you Copy & Pasted correctly, the file starts with <strong><?php</strong> and ends with <strong>?></strong>)");

define("_step3complete", "Configuration Completed.  You can now Install the PHP-Nuke Titanium Database.");

// Step  4
define("_step4", "<strong>Step 4: Installing Database</strong>");
define("_checkingfiles", "Checking Files...");
define("_step4fnotfound", "Fatal Error.  Unable to Read File **file**.  Check Package Integrity and File Access Permissions.");
define("_nuke_sql_error1", "Error Executing SQL Query ");
define("_nuke_sql_error2", "Error ID: ");
define("_nuke_sql_error3", "Error Message: ");
define("_tblcreating", "Creating Table <strong>**table**</strong>...");
define("_installcategories", "Creating Default Categories...");
define("_installsmiles", "Installing Default Smiley's...");
define("_step4failed", "A Fatal Error Occurred during Setup.  Please Fix the above Error and try running the Setup again, or Refreshing your Browser.");
define("_step4complete", "Database Installation was Completed Successfully.  You can now Configure your website according to your Preferences.");

define("_sql_admin_fc", "Creating Default Admin Table Settings...");

define("_sql_author", "Creating Default Author Table Settings...");

define("_sql_banner", "Creating Default Banner Table Settings...");
define("_sql_banner_clients", "Creating Default Banner Client Table Settings...");
define("_sql_banner_plans", "Creating Default Banner Plans Table Settings...");
define("_sql_banner_positions", "Creating Default Banner Postions Table Settings...");
define("_sql_banner_terms", "Creating Default Banner Terms Table Settings...");

define("_sql_advanced_username_colors", "Creating Default User Name Color Table Settings...");

define("_sql_bbarcade_settings", "Creating Default Arcade Table Settings...");
define("_sql_bbarcade_categories", "Creating Default Arcade Categories Table Settings...");
define("_sql_bbarcade_comments", "Creating Default Arcade Comments Table Settings...");
define("_sql_bbarcade_favorites", "Creating Default Arcade Favorites Table Settings...");
define("_sql_bbarcade_auth_access", "Creating Default Auth Arcade Access Table Settings...");
define("_sql_bbarcade_games", "Creating Default Arcade Games Table Settings...");
define("_sql_bbarcade_games_hash", "Creating Default Arcade Games Hash Table Settings...");
define("_sql_bbarcade_hack_games", "Creating Default Arcade Hack Games Table Settings...");
define("_sql_bbarcade_scores", "Creating Default Arcade Scores Table Settings...");


define("_sql_bbattachments", "Creating Default Attachments Table Settings...");
define("_sql_bbattachments_config", "Creating Default Attachments Config Table Settings...");
define("_sql_bbattachments_descriptions", "Creating Default Attachments Descriptions Table Settings...");
define("_sql_bbattachments_quota", "Creating Default Attachments Quota Table Settings...");

define("_sql_bbauth_access", "Creating Default Auth Access Table Settings...");
define("_sql_bb_banlist", "Creating Default Ban List Table Settings...");
define("_sql_bb_categories", "Creating Default Forum Categories Table Settings...");
define("_sql_bb_config", "Creating Default Forum Config Table Settings...");
define("_sql_bb_disallow", "Creating Default Forum Disallow Table Settings...");
define("_sql_bb_extensions", "Creating Default Attachments Extensions Table Settings...");
define("_sql_bb_extensions_groups", "Creating Default Attachments Extensions Groups Table Settings...");
define("_sql_bb_flags", "Creating Default Forum Flag Table Settings...");
define("_sql_bb_forbidden_attachemnets_extensions", "Creating Default Attachemnts Forbidden Extensions Table Settings...");
define("_sql_bb_forums", "Creating Default Forum Table Settings...");
define("_sql_bb_forums_prune", "Creating Default Forum Prune Table Settings...");
define("_sql_bb_groups", "Creating Default Forum Groups Table Settings...");
define("_sql_bb_inline_ads", "Creating Default Forum InLine Ads Table Settings...");
define("_sql_bb_logs", "Creating Default Forum Logs Table Settings...");
define("_sql_bb_logs_config", "Creating Default Forum Logs Config Table Settings...");
define("_sql_bb_forum_posts", "Creating Default Forum Posts Table Settings...");
define("_sql_bb_forum_posts_text", "Creating Default Forum Posts Text Table Settings...");
define("_sql_bb_forum_posts_reports", "Creating Default Forum Posts Reports Table Settings...");
define("_sql_bb_private_messages", "Creating Default Forum Private Messages Table Settings...");
define("_sql_bb_private_messages_text", "Creating Default Forum Private Messages Text Table Settings...");
define("_sql_bb_private_messages_archive", "Creating Default Forum Private Messages Archive Table Settings...");
define("_sql_bb_quick_search", "Creating Default Forum Quick Search Table Settings...");
define("_sql_bb_quota_limits", "Creating Default Forum Quota Limits Table Settings...");
define("_sql_bb_ranks", "Creating Default Forum Ranks Table Settings...");
define("_sql_bb_reputation", "Creating Default Forum Reputations Table Settings...");
define("_sql_bb_reputation_config", "Creating Default Forum Reputations Config Table Settings...");
define("_sql_bb_search_rebuild", "Creating Default Forum Search Rebuild Table Settings...");
define("_sql_bb_search_results", "Creating Default Forum Search Results Table Settings...");
define("_sql_bb_search_word_list", "Creating Default Forum Search Word List Table Settings...");
define("_sql_bb_search_word_match", "Creating Default Forum Search Word Match Table Settings...");
define("_sql_bb_sessions", "Creating Default Forum Sessions Table Settings...");
define("_sql_bb_sessions_keys", "Creating Default Forum Sessions Keys Table Settings...");
define("_sql_bb_smilies", "Creating Default Forum Smilies Table Settings...");
define("_sql_bb_smilies_index", "Creating Default Forum Smilies Index Table Settings...");
define("_sql_bb_smilies_info", "Creating Default Forum Smilies Info Table Settings...");
define("_sql_bb_stats", "Creating Default Forum Stats Table Settings...");
define("_sql_bb_stats_modules", "Creating Default Forum Stats Modules Table Settings...");
define("_sql_bb_stats_modules_admin_panel", "Creating Default Forum Stats Modules Admin Panel Table Settings...");
define("_sql_bb_stats_modules_cache", "Creating Default Forum Stats Modules Cache Table Settings...");
define("_sql_bb_stats_group_auth", "Creating Default Forum Stats Group Auth Table Settings...");
define("_sql_bb_stats_modules_info", "Creating Default Forum Stats Modules Info Table Settings...");
define("_sql_bb_thanks", "Creating Default Forum Thanks Table Settings...");
define("_sql_bb_themes", "Creating Default Themes Table Settings...");
define("_sql_bb_themes_names", "Creating Default Themes Names Table Settings...");
define("_sql_bb_forum_topics", "Creating Default Forum Topics Table Settings...");
define("_sql_bb_forum_topics_watch", "Creating Default Forum Topics Watch Table Settings...");
define("_sql_bb_forum_topics_email", "Creating Default Forum Topics Email Table Settings...");
define("_sql_bb_forum_topic_moved", "Creating Default Forum Topic Moved Table Settings...");
define("_sql_bb_forum_topic_viewed", "Creating Default Forum Topics Viewed Table Settings...");
define("_sql_bb_user_groups", "Creating Default Forum User Groups Table Settings...");
define("_sql_bb_vote_description", "Creating Default Forum Vote Description Table Settings...");
define("_sql_bb_vote_results", "Creating Default Forum Vote Results Table Settings...");
define("_sql_bb_voters", "Creating Default Forum Voters Table Settings...");
define("_sql_bb_filtered_words", "Creating Default Forum Filtered Words Table Settings...");
define("_sql_bb_xdata_auth", "Creating Default Forum XDATA Auth Table Settings...");
define("_sql_bb_xdata_data", "Creating Default Forum XDATA Data Table Settings...");
define("_sql_bb_xdata_fields", "Creating Default Forum XDATA Fields Table Settings...");

define("_sql_blocks", "Creating Default Titanium Blocks Table Settings...");

define("_sql_blogs_config", "Creating Default Titanium Blogs Config Table Settings...");
define("_sql_blogs", "Creating Default Titanium Blogs Table Settings...");
define("_sql_auto_blogs", "Creating Default Titanium Auto Blogs Table Settings...");
define("_sql_blog_categories", "Creating Default Titanium Blogs Categories Table Settings...");
define("_sql_blog_comments", "Creating Default Titanium Blogs Comments Table Settings...");
define("_sql_blogs_queue", "Creating Default Titanium Blogs Queue Table Settings...");
define("_sql_blogs_topics", "Creating Default Titanium Blogs Topics Table Settings...");

define("_sql_titanium_bookmarks", "Creating Default Titanium Bookmarks Table Settings...");
define("_sql_titanium_bookmarks_categories", "Creating Default Titanium Bookmarks Categories Table Settings...");

define("_sql_titanium_cemetery", "Creating Default Titanium Cemetery Table Settings...");
define("_sql_titanium_cemetery_categories", "Creating Default Titanium Cemetery Categories Table Settings...");

define("_sql_titanium_your_account", "Creating Default Titanium Your Account Table Settings...");
define("_sql_titanium_your_account_fields", "Creating Default Titanium Your Account Fields Table Settings...");
define("_sql_titanium_your_account_value", "Creating Default Titanium Your Account Value Table Settings...");
define("_sql_titanium_your_account_value_temp", "Creating Default Titanium Your Account Value Temp Table Settings...");

define("_sql_nuke_config", "Creating Default Titanium Nuke Config Table Settings...");

define("_sql_nuke_confirm", "Creating Default Titanium Nuke Confirm Table Settings...");

define("_sql_nuke_counter", "Creating Default Titanium Nuke Counter Table Settings...");

define("_sql_titanium_donaters", "Creating Default Titanium Donaters Table Settings...");
define("_sql_titanium_donaters_config", "Creating Default Titanium Donaters Config Table Settings...");

define("_sql_evo_ecalendar", "Creating Default Evo eCalendar Table Settings...");
define("_sql_evo_userblock", "Creating Default Evo User Block Table Settings...");
define("_sql_evo_userblock_addons", "Creating Default Evo User Block Addons Table Settings...");

define("_sql_titanium_config", "Creating Default Titanium Config Table Settings...");
define("_sql_titanium_faq", "Creating Default Titanium FAQ Table Settings...");
define("_sql_titanium_faq_categories", "Creating Default Titanium FAQ Categories Table Settings...");

define("_sql_file_repository_categories", "Creating Default File Respository Categories Table Settings...");
define("_sql_file_repository_comments", "Creating Default File Respository Comments Table Settings...");
define("_sql_file_repository_files", "Creating Default File Respository Files Table Settings...");
define("_sql_file_repository_items", "Creating Default File Respository Items Table Settings...");
define("_sql_file_repository_screenshots", "Creating Default File Respository Screen Shots Table Settings...");
define("_sql_file_repository_settings", "Creating Default File Respository Config Table Settings...");
define("_sql_file_repository_themes", "Creating Default File Respository Themes Table Settings...");

define("_sql_titanium_headlines", "Creating Default Titanium Headlines Table Settings...");

define("_sql_evo_news_letter_categories", "Creating Default Evo News Letter Categories Table Settings...");
define("_sql_evo_news_letter_config", "Creating Default Evo News Letter Config Table Settings...");
define("_sql_evo_news_letters", "Creating Default Evo News Letters Table Settings...");

define("_sql_titanium_honey_pot", "Creating Default Titanium Honey Pot Table Settings...");
define("_sql_titanium_honey_pot_config", "Creating Default Titanium Honey Pot Config Table Settings...");

define("_sql_image_repository_settings", "Creating Default Image Respository Config Table Settings...");
define("_sql_image_repository_uploads", "Creating Default Image Respository Uploads Table Settings...");
define("_sql_image_repository_users", "Creating Default Image Respository Users Table Settings...");

define("_sql_titanium_google_site_map", "Creating Default Titanium Google Site Map Table Settings...");

define("_sql_titanium_web_links_categories", "Creating Default Web Links Categories Table Settings...");
define("_sql_titanium_web_links_editorials", "Creating Default Web Links Editorials Table Settings...");
define("_sql_titanium_web_links_main", "Creating Default Web Links Table Settings...");
define("_sql_titanium_web_links_mod_requests", "Creating Default Web Links Modification Requests Table Settings...");
define("_sql_titanium_web_links_new_link", "Creating Default Web Links New Link Table Settings...");
define("_sql_titanium_web_links_vote_data", "Creating Default Web Links Vote Data Table Settings...");

define("_sql_titanium_link_us", "Creating Default Titanium Link Us Table Settings...");
define("_sql_titanium_link_us_config", "Creating Default Titanium Link Us Config Table Settings...");

define("_sql_titanium_main", "Creating Default Titanium Main Table Settings...");

define("_sql_titanium_menu", "Creating Default Titanium Menu Table Settings...");
define("_sql_titanium_menu_categories", "Creating Default Menu Categories Table Settings...");

define("_sql_titanium_messages", "Creating Default Messages Table Settings...");

define("_sql_titanium_meta_tags", "Creating Default Meta Tags Table Settings...");

define("_sql_titanium_modules", "Creating Default Modules Table Settings...");
define("_sql_titanium_modules_categories", "Creating Default Modules Categories Table Settings...");
define("_sql_titanium_modules_links", "Creating Default Modules Links Table Settings...");

define("_sql_nuke_mostonline", "Creating Default Titanium Most Online Table Settings...");

define("_sql_nuke_center_blocks", "Creating Default Titanium Center Blocks Table Settings...");
define("_sql_nuke_center_blocks_config", "Creating Default Titanium Center Blocks Config Table Settings...");

define("_sql_titanium_supporters_config", "Creating Default Supporters Config Table Settings...");
define("_sql_titanium_supporters_sites", "Creating Default Supporters Sites Table Settings...");

define("_sql_titanium_nuke_sentienl_admins", "Creating Default Nuke Sentinel Admins Table Settings...");
define("_sql_titanium_nuke_sentienl_blocked_ips", "Creating Default Nuke Sentinel Blocked IPs Table Settings...");
define("_sql_titanium_nuke_sentienl_blocked_ranges", "Creating Default Nuke Sentinel Blocked Ranges Table Settings...");
define("_sql_titanium_nuke_sentienl_blockers", "Creating Default Nuke Sentinel Blockers Table Settings...");
define("_sql_titanium_nuke_sentienl_cidrs", "Creating Default Nuke Sentinel CIDRS Table Settings...");
define("_sql_titanium_nuke_sentienl_config", "Creating Default Nuke Sentinel Config Table Settings...");
define("_sql_titanium_nuke_sentienl_countries", "Creating Default Nuke Sentinel Countries Table Settings...");
define("_sql_titanium_nuke_sentienl_excluded_ranges", "Creating Default Nuke Sentinel Excluded Ranges Table Settings...");
define("_sql_titanium_nuke_sentienl_harvesters", "Creating Default Nuke Sentinel Harvesters Table Settings...");
define("_sql_titanium_nuke_sentienl_ip2_country", "Creating Default Nuke Sentinel ip2 Country Table Settings...");
define("_sql_titanium_nuke_sentienl_protected_ranges", "Creating Default Nuke Sentinel Protected Ranges Table Settings...");
define("_sql_titanium_nuke_sentienl_referers", "Creating Default Nuke Sentinel Referers Table Settings...");
define("_sql_titanium_nuke_sentienl_strings", "Creating Default Nuke Sentinel Strings Table Settings...");
define("_sql_titanium_nuke_sentienl_tracked_ips", "Creating Default Nuke Sentinel Tracked IPs Table Settings...");

define("_sql_titanium_pages", "Creating Default Titanium Pages Table Settings...");
define("_sql_titanium_pages_categories", "Creating Default Titanium Pages Categories Table Settings...");

define("_sql_titanium_poll_comments", "Creating Default Titanium Poll Comments Table Settings...");
define("_sql_titanium_poll_check", "Creating Default Titanium Poll Check Table Settings...");
define("_sql_titanium_poll_data", "Creating Default Titanium Poll Data Table Settings...");
define("_sql_titanium_poll_description", "Creating Default Titanium Poll Description Table Settings...");

define("_sql_titanium_quotes", "Creating Default Titanium Quotes Table Settings...");

define("_sql_titanium_referers", "Creating Default Titanium Referers Table Settings...");

define("_sql_titanium_related", "Creating Default Titanium Related Table Settings...");

define("_sql_titanium_reviews", "Creating Default Titanium Reviews Table Settings...");
define("_sql_titanium_reviews_add", "Creating Default Titanium Reviews Add Table Settings...");
define("_sql_titanium_reviews_comments", "Creating Default Titanium Reviews Comments Table Settings...");
define("_sql_titanium_reviews_main", "Creating Default Titanium Reviews Main Table Settings...");

define("_sql_titanium_security_agents", "Creating Default Titanium Security Agents Table Settings...");

define("_sql_titanium_sessions", "Creating Default Titanium Sessions Table Settings...");

define("_sql_titanium_shoutbox_censor", "Creating Default Titanium ShoutBox Censor Table Settings...");
define("_sql_titanium_shoutbox_config", "Creating Default Titanium ShoutBox Config Table Settings...");
define("_sql_titanium_shoutbox_date", "Creating Default Titanium ShoutBox Date Table Settings...");
define("_sql_titanium_shoutbox_emoticons", "Creating Default Titanium ShoutBox Emoticons Table Settings...");
define("_sql_titanium_shoutbox_ip_block", "Creating Default Titanium ShoutBox IP Block Table Settings...");
define("_sql_titanium_shoutbox_manage_count", "Creating Default Titanium ShoutBox Manage Count Table Settings...");
define("_sql_titanium_shoutbox_name_block", "Creating Default Titanium ShoutBox Name Block Table Settings...");
define("_sql_titanium_shoutbox_shouts", "Creating Default Titanium ShoutBox Shouts Table Settings...");
define("_sql_titanium_shoutbox_sticky_shouts", "Creating Default Titanium ShoutBox Sticky Shouts Table Settings...");
define("_sql_titanium_shoutbox_themes", "Creating Default Titanium ShoutBox Themes Table Settings...");
define("_sql_titanium_shoutbox_themes_images", "Creating Default Titanium ShoutBox Themes Images Table Settings...");
define("_sql_titanium_shoutbox_version", "Creating Default Titanium ShoutBox Version Table Settings...");

define("_sql_titanium_sommaire", "Creating Default Sommaire Table Settings...");
define("_sql_titanium_sommaire_categories", "Creating Default Sommaire Categories Table Settings...");

define("_sql_titanium_stats_hour", "Creating Default Stats Hour Table Settings...");

define("_sql_titanium_subscriptions", "Creating Default Titanium Subscriptions Table Settings...");

define("_sql_titanium_themes", "Creating Default Titanium Themes Table Settings...");

define("_sql_titanium_users", "Creating Default Titanium Users Table Settings...");
define("_sql_titanium_users_countries", "Creating Default Titanium Users Countries Table Settings...");
define("_sql_titanium_users_temp", "Creating Default Titanium Users Temp Table Settings...");

define("_sql_titanium_center_last_visitors", "Creating Default Titanium Last Visitors Table Settings...");

define("_sql_titanium_welcome_pm", "Creating Default Titanium Welcome PM Table Settings...");


// Step  5
define("_step5", "Step 5: PHP-Nuke Titanium Configuration");

define("_step5explain", "Now you have to Configure your New PHP-Nuke Titanium Tracker.  The following are the Configuration Parameters that are available that allow you to Customize every aspect of the Tracker.  However, you only need to make sure that the Basic Parameters are Set Correctly.  You will always be able to Change these Settings through the (ACP) Administrator Configuration Panel.");

define("_admpfree_dl", "<strong>Freeleech Torrents</strong>");

define("_admpfree_dlexplain", "Any Torrent that is marked Freeleech will NOT count against their Download Credit.  They will however still receive Upload Credit for any amount they Upload.  This is a Excellent way for them to Build up their Ratio.");

define("_admpgive_sign_up_credit", "Give Upload Credit upon Signup");
define("_admpgive_sign_up_creditexplain", "Give Users Upload Credit when they Signup to the Site.");

define("_admpconferm_email", "Force email Confirmation");
define("_admpconferm_emailexplain", "Force a User to Confirm their email Address before they can Access the Site.");

define("_admpallow_multy_tracker", "Allow Multi-Tracker Torrents");
define("_admpallow_multy_trackerexplain", "Allow Users to Upload a Torrent with more then one Announce URL.");

define("_admpallow_external", "Allow External Torrents");
define("_admpallow_externalexplain", "Allow Users to Upload Torrents from other Sites.  Note: this May Not Work for every Site.");

define("_admppivate_mode", "Private Tracker Mode");

define("_admppivate_modeexplain", "Sets the Tracker to Private, this way no one can see the content unless they are a Member and are Logged in.");

define("_admpforce_passkey", "Force Passkey");
define("_admpforce_passkeyexplain", "Set this to Force your Members to use the Passkey System.");

define("_admpaddprivate", "Make ALL Internal Torrents Private");

define("_admpaddprivateexplain", "When this is Set, ALL Internal Torrents will be set to Private and the Uploaders will have to Download the Torrent from the Site in order to Seed it<br /><strong>This Does Not change External Torrents.</strong>");

define("_admpwait_time", "Add Wait Time");

define("_admpwait_timeexplain", "Once Enabled, Users who Do Not meet the Requirements that you've Set will have to Wait for 'x' amount of time before their Downloads will Start.<br /><br /><strong>You Must Remember</strong><br />to Set the Announce Access Level to Users and the Torrents will need to be set to Private.");

define("_admpGIGSA", "Members with Uploads (in Gigabytes) Less than");
define("_admpGIGSAexplain", "Set the First Minimum Upload in GB for the First Wait Period.");

define("_admpGIGSB", "Members with Uploads (in Gigabytes) Less than");
define("_admpGIGSBexplain", "Set the Second Minimum Upload in GB for the Second Wait Period.");

define("_admpGIGSC", "Members with Uploads (in Gigabytes) Less than");
define("_admpGIGSCexplain", "Set the Third Minimum Upload in GB for the Third Wait Period.");

define("_admpGIGSD", "Members with Uploads (in Gigabytes) Less than");
define("_admpGIGSDexplain", "Set the Fourth Minimum Upload in GB for the Fourth Wait Period.");

define("_admpRATIOA", "Members with a Ratio Less than");
define("_admpRATIOAexplain", "Set the Fist Minimum Ratio.");

define("_admpRATIOB", "Members with a Ratio Less than");
define("_admpRATIOBexplain", "Set the Second Minimum Ratio.");

define("_admpRATIOC", "Members with a Ratio Less than");
define("_admpRATIOCexplain", "Set the Third Minimum Ratio.");

define("_admpRATIOD", "Members with a Ratio Less than");
define("_admpRATIODexplain", "Set the Fourth Minimum Ratio.");

define("_admpWAITA", "Members must Wait 'x' amount of Hours.");
define("_admpWAITAexplain", "Set the First Wait Period in Hours.");

define("_admpWAITB", "Members must Wait 'x' amount of Hours");
define("_admpWAITBexplain", "Set the Second Wait Period in Hours.");

define("_admpWAITC", "Members must Wait 'x' amount of Hours");
define("_admpWAITCexplain", "Set the Third Wait Period in Hours.");

define("_admpWAITD", "Members must Wait 'x' amount of Hours");
define("_admpWAITDexplain", "Set the Fourth Wait Period in Hours.");

define("_admpallow_magnet", "Allow eD2K/Magnet Link's");
define("_admpallow_magnetexplain", "");

define("_admpauto_clean", "Auto Clean Timer");
define("_admpauto_cleanexplain", "Sets the Time Intervals of the Cleanup Sessions.  Example the Bonus System.");

define("_admpmax_members", "Maximum Allowed Members");
define("_admpmax_membersexplain", "Maximum Number of Members Allowed to Join your Site.");

define("_admpinvite_only", "Invite Only");
define("_admpinvite_onlyexplain", "Only Allows Users who have been Sent an Invite to Join.");

define("_admpinvites_open", "Invite System");
define("_admpinvites_openexplain", "Turns the Invite System On and Off.");

define("_admpupload_dead", "Allow 'Dead' External Torrents");

define("_admpupload_deadexplain", "Use this to Allow for (apparently) Unseeded External Torrents to be Uploaded to the Tracker.<br />This might be useful if the External Torrent Monitoring System doesn't work so well, which depends on your Server Configuration.");

define("_basicsettings", "Basic Settings");
define("_advancedsettings", "Advanced Settings");
define("_admpsitename", "Site Name");
define("_admpsitenameexplain", "The Name of your Site.  This will be Displayed as the Page Title.");

define("_admpsiteurl", "Site URL");
define("_admpsiteurlexplain", "The URL of this Site.  This Must be Entered before using the Tracker.");

define("_admpcookiedomain", "Cookie Domain");

define("_admpcookiedomainexplain", "Cookie Domain.  This Must be Set to the Domain Name of this Site (e.g. <strong>yoursite.com</strong>).  Required for User Login to Work.");

define("_admpcookiepath", "Cookie Path");

define("_admpcookiepathexplain", "Cookie Path.  Change this Setting <strong>ONLY</strong> if PHP-Nuke Titanium is Installed in a <strong>Sub-Directory</strong> on your Server.  If your Installation is in <strong>http://yoursite.com/an602</strong>, the Setting should be <strong>/an602</strong>");

define("_admpsourcedir", "Source Directory");

define("_admpsourcedirexplain", "Please Enter the Full Source/File Directory Path for System use.<br />DO NOT use / or ./ Using the Wrong Path will Cause Errors on the Site Pages.");

define("_admpuse_gzip", "Use gzip Compression");

define("_admpuse_gzipexplain", "This Option Allows you to Enable or Disable PHP's gzip Compression on HTML and Announce Output.  If Enabled, Bandwidth Usage will be Lower <strong>but</strong> CPU Usage will be Higher.  This Setting doesn't work on ALL Servers.  If your Users Report any gzip Errors in their Clients, Turn it Off.  Verify that your Tracker Reads the Announce Response Correctly.");

define("_admpadmin_email", "Administrator email Address");

define("_admpadmin_emailexplain", "The email Address from which ALL emails to Users will be Sent (Signup, PM Notifications, Authorisations, etc..).  Make sure that the email Address is Valid.");

define("_admplanguage", "Default Language");
define("_admplanguageexplain", "Set the Default Language the Site will use.");

define("_admpannounce_url", "Site Announce URL's");

define("_admpannounce_urlexplain", "Add the Announce URL's that will be used by the Site.<br />Put each one on a New Line.");

define("_admptheme", "Theme");

define("_admpthemeexplain", "Set the Default Theme for the Site.  Registered Users can Override this Setting from their User Control Panel.");

define("_admpwelcome_message", "Site News");

define("_admpwelcome_messageexplain", "Can be used to Post any News Items (e.g. Welcome Message, Donation Drive etc..).  This will be shown on the Sites Index Page.");

define("_admpannounce_text", "Tracker Message");

define("_admpannounce_textexplain", "This Defines the Message that Users will see in their Torrent Client when they Connect to the Tracker.<br />Useful for Announcements and Publicity.");

define("_admpallow_html", "Use HTML Editor");

define("_admpallow_htmlexplain", "Enable this Option to Allow Users to Write Torrent Descriptions using the embedded HTML Editor. <br /><strong>WARNING</strong>: this Feature is still Experimental!");

define("_admprewrite_engine", "Search Rewrite");

define("_admprewrite_engineexplain", "Search Rewrite transforms php's Complex URL's into Faux HTML Pages, making it easier to type into the Address Bar.  This Feature is also very useful to Increase Search Engine Traffic.<br />Apaches mod_rewrite or IIS's ISAPI_Rewrite is <strong>REQUIRED</strong> on your Server.");

define("_admptorrent_prefix", "Torrent Prefix");

define("_admptorrent_prefixexplain", "This Option Allows you to Add a Custom Prefix to ALL Torrents Downloaded from this Tracker.  <br />Useful to Spread the Word about your Community.");

define("_admptorrent_per_page", "Torrents Per Page");

define("_admptorrent_per_pageexplain", "Indicates how many Torrents can be Displayed on each page, both in Listing and in Search Mode.");

define("_admponlysearch", "Search Only");

define("_admponlysearchexplain", "Hides the Torrent List so that Users without Administrator Access (whether Registered or NOT) will have to Perform a Search in order to View any Torrents.");

define("_admpmax_torrent_size", "Maximum Torrent Size");

define("_admpmax_torrent_sizeexplain", "Maximum Byte Size for Uploaded .torrent Files.<br />This DOES NOT put any Limits on the actual Torrent itself but ONLY on the size of the .torrent File itself.");

define("_admpannounce_interval", "Announce Update Interval");
define("_admpannounce_intervalexplain", "Recommended Time Interval (in Seconds) between Announce Requests.<br />This Value is Sent to the Torrent Client.");

define("_admpannounce_interval_min", "Minimum Announce Update Interval");

define("_admpannounce_interval_minexplain", "Recommended Time Interval between Announce Requests (in Seconds).<br /> More Frequent Requests will be Refused.");

define("_admpdead_torrent_interval", "Dead Torrent Interval");

define("_admpdead_torrent_intervalexplain", "Specifies the Amount of Time (in Seconds) that a Dead Torrent (NO Peers) can be kept Visible on the Site, after which period they will Automatically be Hidden.");

define("_admpminvotes", "Minimum Votes");
define("_admpminvotesexplain", "Minimum Number of Votes Required to Display Torrent Ratings.");

define("_admptime_tracker_update", "Autoscrape Time Interval");

define("_admptime_tracker_updateexplain", "Sets the Autoscrape Time Interval (in Seconds).");

define("_admpbest_limit", "Best Torrent Peer Limit");
define("_admpbest_limitexplain", "Number of Total Peers above which the Torrent is Included in the Top Torrents List/RSS Feed.");

define("_admpdown_limit", "Dead Torrent Peer Limit");
define("_admpdown_limitexplain", "Number of Total Peers below which the Torrent is Treated as Dead.");

define("_admptorrent_complaints", "Torrent Complaints");

define("_admptorrent_complaintsexplain", "Allows Users to make a Complaint about a Torrent on the Details Page.  This Helps to Block Undesired Content, such as Child Pornography.  Any Torrent that receives 20 Complaints will Automatically be Banned.");

define("_admptorrent_global_privacy", "Torrent Authorisations");

define("_admptorrent_global_privacyexplain", "Switching this ON Allows Registered Uploaders to put Limitations on Who can Download their Torrents.  The Owner of a Torrent can either Authorise Downloads on a Case-by-Case Basis, or Automatically, by Setting an Overall Share Ratio that the Downloader has to meet.<br />You have to Set the Tracker Access Level to User in Order for this to Work.");

define("_admpdisclaimer_check", "Disclaimer");

define("_admpdisclaimer_checkexplain", "If Checked, Users have to Accept a Disclaimer before they can Register.  You can change the Disclaimer by Changing the File <strong>/disclaimer/english.txt</strong>");

define("_admpgfx_check", "CAPTCHA Setting");
define("_admpgfx_checkexplain", "If Checked, Users will have to Type in a Code from a CAPTCHA Image when Registering and Logging in.");

define("_admpupload_level", "Upload Access Level");

define("_admpupload_levelexplain", "Determines the User Level Required to Upload Torrents<ul><li><strong>Everyone</strong> Allows Anyone to Upload Torrent Files to the Site. They won't be able to Edit them or Manage Authorisations<li><strong>Registered</strong> Requires Users to be Registered.<li><strong>Premium</strong> ONLY Allows Premium Users to Upload.</ul>");

define("_admpupload_levelopt1", "Everyone");
define("_admpupload_levelopt2", "Registered");
define("_admpupload_levelopt3", "Premium");

define("_admpdownload_level", "Download Access Level");

define("_admpdownload_levelexplain", "Determines the User Level Required to Download Torrents.<ul><li><strong>Everyone</strong> Allows Anyone to Download Torrent Files from the Site<li><strong>Registered</strong> Requires Users to be Registered<li><strong>Premium</strong> ONLY Allows Premium Users to Download Torrents from the Site</ul>This Setting DOES NOT affect the Tracker.  So if somebody got their hands on a .torrent, they would not be able to Download.");

define("_admpdownload_levelopt1", "Everyone");
define("_admpdownload_levelopt2", "Registered");
define("_admpdownload_levelopt3", "Premium");

define("_admpannounce_level", "Tracker Access Level");

define("_admpannounce_levelexplain", "<ul><li><strong>Everyone</strong> Allows Anyone to Connect to the Tracker (i.e. Announce)<li><strong>Registered</strong> Requires the User to Log In (IP Address is Checked!) before Connecting to the Tracker.  </ul>This Setting DOES NOT Affect Torrents Downloaded from the Site.");

define("_admpannounce_levelopt1", "Everyone");
define("_admpannounce_levelopt2", "Registered");

define("_admpmax_num_file", "Maximum Amount of Files in a Torrent");

define("_admpmax_num_fileexplain", "Maximum Number of Files a Torrent can contain, any amount above this will cause the Upload to Fail.<br />Use it if you'd like to encourage Users to use Compressed Archives.<br />Setting this to Zero will Disable this Option.");

define("_admpmax_share_size", "Maximum Torrent Share Size");

define("_admpmax_share_sizeexplain", "Total Combined Size of Files in a Torrent, any amount above this will cause the Upload to Fail.<br />Setting this to Zero will Disable this Option.");

define("_admpglobal_min_ratio", "Global Minimum Ratio");

define("_admpglobal_min_ratioexplain", "Specify the Minimum Upload/Download Ratio.<br />Users will NOT be Allowed to Download any more Torrents if they don't meet this criteria.<br />The Option is applicable ONLY if the Announce Level (above) is Set to User on the Download Page.<br />Setting this to Zero will Disable this Option.");

define("_admpautoscrape", "External Torrent Monitoring");

define("_admpautoscrapeexplain", "This Allows you to Monitor the Peer Count for Torrents Tracked by Remote Trackers.<br />Be careful here.<br /><br />You can ONLY use this if your Server can Open Sockets to Other Machines.  Many Cheap or Free Hosting Services have Firewalls that Block Outgoing Connections.  If your NOT using a Dedicated/Home Server, it is recommended that you DO NOT Enable this Option unless your sure you know what your doing.<br /><br />If you don't Enable it ALL External Torrents will be Displayed as having Zero Sources.<br /><br />If you Enable it, but your Server can't Build Connections to Scrape then External Uploads may be Rejected (unless you Check 'Allow Dead External Torrents')");

define("_admpmax_num_file_day_e", "Maximum Number of Daily Downloads");

define("_admpmax_num_file_day_eexplain", "Defines how many Files can be Downloaded Per Day by a Single User.  Any Requests above this will be Refused and the User will be asked to try again the following Day.<br />Premium Users are NOT affected by this Setting.  Setting this to Zero will Disable this Option.");

define("_admpmax_num_file_week_e", "Maximum Number of Weekly Downloads");

define("_admpmax_num_file_week_eexplain", "Defines how many Files can be Downloaded in a Week by a Single User.  Further Requests will be Refused and the User will be asked to try again the following Week.<br />Premium Users are Not affected by this Setting.  Setting this to Zero will Disable this Option.");

define("_admpmin_num_seed_e", "Minimum Seed Number for New Downloads");

define("_admpmin_num_seed_eexplain", "Defines how many Torrents a User must be Seeding before Downloading any New Files.<br />Premium Users are NOT affected by this Setting.<br />Setting this to Zero will Disable this Option.");

define("_admpmin_size_seed_e", "Minimum Seed Size for New Downloads");

define("_admpmin_size_seed_eexplain", "Defines the Minimum Share Ratio a User must have before Downloading New Files.<br />Premium Users are NOT affected by this setting.<br />Setting this to Zero will Disable this Option.");

define("_admin_source_dir", "Sources Directory");
define("_admin_source_direxplain", "Please give the Full Source Directory Path for System Use.<br />DO NOT use / or ./");

define("_admpmaxupload_day_num", "Maximum Daily Uploads");

define("_admpmaxupload_day_numexplain", "Defines how many Torrents can be Uploaded in a Single Day.  Any Uploads above this will NOT be accepted and the User will be asked to try again the following Day.<br />Premium Users are NOT affected by this Setting.  Setting this to Zero will Disable this Option.");

define("_admpmaxupload_day_share", "Maximum Daily Files Upload");

define("_admpmaxupload_day_shareexplain", "Defines the Maximum Total Size of Files (ALL Files within a Torrent Combined) a User can Upload in a Single Day.  Any further Uploads will NOT be Accepted and the User will be asked to try again the following Day.<br />Premium Users are NOT affected by this Setting.  Setting this to Zero will Disable this Option.");

define("_admpminupload_file_size", "Minimum Torrent Size for Upload");

define("_admpminupload_file_sizeexplain", "Defines the Torrent's Minimum Size (ALL Files within a Torrent Combined) for Upload.<br />Premium Users are NOT affected by this Setting.  Setting this to Zero will Disable this Option.");

define("_admpallow_backup_tracker", "Backup Tracker");

define("_admpallow_backup_trackerexplain", "Runs your Tracker as a Backup Tracker according to the BitTorrent's Announce List extension.<br />Usage is subject to the Announce Level Settings and DOES NOT affect Ratios.<br />This Option is Ignored if Stealth Mode is Enabled.");

define("_admpstealthmode", "Disable Local Tracker");

define("_admpstealthmodeexplain", "This will Disable and Hide the Local Tracker.  PHP-Nuke Titanium will ONLY Accept Externally Tracked Torrents.");

define("_step5complete", "Tracker is now Configured.  Now Create your Administrator Account and get ready to Log in!");

// Step 6
define("_step6", "<strong>Step 6: Administrator Account</strong>");

define("_step6explain", "Now that you have Configured your Tracker, you need to Define an Administrator Account.  Logging in as an Administrator will give you Access the Administration Panel and you'll have Full Control over your Tracker.  Administrators act as Super Users.  Remember that you can Change your Personal Settings in your Profile Page.");

define("_username", "Username");
define("_password", "Password");
define("_passwordconf", "Confirm Password");
define("_email", "email Address");
define("_fullname", "Full Name (Optional)");
define("_usernamereq", "Username (Required)");
define("_usernametoolong", "Username can NOT be Longer than 25 Characters!");
define("_passwordreq", "Password (Required)");
define("_passwordnomatch", "Passwords DO NOT Match!");
define("_emailinvalid", "A Valid email Address is Required!");
define("_step6complete", "Administrator Account Successfully Created.  Now you are ready to Complete the Setup.");

// Step 7
define("_step7", "<strong>Installation Complete!</strong>");

define("_step7explain", "Congratulations!  PHP-Nuke Titanium has now been Installed and Configured.  Now you can start using your Brand New Tracker and Start Sharing Files!  Before starting, keep in mind the following:-");

define("_thingstodo", "<ul>\n
<li><p>Please Delete the <em>setup</em> Directory!  For Security Reasons, PHP-Nuke Titanium will NOT work until the Directory is Deleted.</p></li>\n
<li><p>Use the Account you just Created to Set your Tracker Preferences to Create your Peer-to-Peer Community.  Don't Share your Administrator Password.</p></li>\n
<li><p>Please remember to Run the Database Optimiser often.  It's an Important Tool to keep the Tracker efficient when Server Load Grows.</p></li>\n
<li><p>If you need Help from Trusted Users to Manage the Tracker.  Remember that Moderators can Freely Manage Torrents without them needing Access to the Administration Panel.</p></li>\n
<li><p>Finally, remember that Culture Exchange is Freedom, but Piracy is a Crime.</p></li>\n
<li><p>If you like PHP-Nuke Titanium, why don't you consider making a Small <strong>Donation</strong> to those who wrote it in order to help keep the Project Alive and Updated?</p></li>\n
</ul>\n");

define("_thanks", "Thank you for choosing this fantastic Open Source Software.  Regards, The PHP-Nuke Titanium Group!");
define("_enter", "Enter PHP-Nuke Titanium");

?>