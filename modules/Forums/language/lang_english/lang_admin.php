<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                            lang_admin.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin.php,v 1.35.2.10 2005/02/21 18:38:17 acydburn Exp $
 ****************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Admin Userlist                           v2.0.2       06/11/2005
      Global Announcements                     v1.2.8       06/13/2005
      PM Quick Reply                           v1.3.5       06/14/2005
      Force Word Wrapping - Configurator       v1.0.16      06/15/2005
      Resize Posted Images                     v2.4.5       06/15/2005
      Advance Signature Divider Control        v1.0.0       06/16/2005
      Forum Blocks                             v1.0.0       06/23/2005
      Forum ACP Administration Links           v1.0.0       06/26/2005
      Faq Manager                              v1.0.0b      06/26/2005
      Board Rules                              v2.0.0       06/26/2005
      Default avatar                           v1.1.0       06/30/2005
      Disable Board Message                    v1.0.0       07/06/2005
      Disable Board Admin Override             v0.1.1       07/06/2005
      PM threshold                             v1.0.0       07/19/2005
      Limit smilies per post                   v1.0.2       07/24/2005
      Advance Admin Index Stats                v1.0.0       08/02/2005
      Log Moderator Actions                    v1.1.6       08/06/2005
      At a Glance Options                      v1.0.0       08/17/2005
      Quick Search                             v3.0.1       08/23/2005
      Show Users Today Toggle                  v1.0.0       08/24/2005
      Group Colors and Ranks                   v1.0.0       08/24/2005
      Customized Topic Status                  v1.0.0       08/25/2005
      Initial Usergroup                        v1.0.1       08/25/2005
      Hide Images and Links                    v1.0.0       08/30/2005
      DHTML Admin Menu                         v1.0.1       08/31/2005
      Hide Images                              v1.0.0       09/02/2005
      Super Quick Reply                        v1.3.2       09/08/2005
      Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
      Log Actions Mod - Topic View             v2.0.0       09/18/2005
      Forum Admin Style Selection              v1.0.0       10/01/2005
      Edit User Post Count                     v1.0.0       12/19/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2006
      Display Poster Information Once          v2.0.0       06/12/2006
      Auto Group                               v1.2.2       11/06/2006
	  Colorize Forumtitle                      v1.0.0
	  Scrolling Global Announcement on Index   v1.0.1
	  Forumtitle as Weblink                    v1.2.2
	  Forum Icons                              v1.0.4
	  Birthdays                                v3.0.0
	  Thank You Mod                            v1.1.8
	  Rebuild Search                           v2.4.0       5/24/2009
-=[Other]=-
      URL Check                                v1.0.0       07/01/2005
      Cookie Check                             v1.0.0       08/04/2005
	  Inline Banner Ad                         v1.2.3       05/26/2009
	  Overall Forums Permissions               v1.0.0       05/26/2009
 ************************************************************************/

/* CONTRIBUTORS
    2002-12-15    Philip M. White (pwhite@mailhaven.com)
        Fixed many minor grammatical mistakes
*/

//
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['General'] = 'General Admin';
$lang['Users'] = 'User Admin';
$lang['Groups'] = 'Group Admin';
$lang['Forums'] = 'Forum Admin';
/*****[BEGIN]******************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/
$lang['Faq_manager'] = 'FAQ Admin';
/*****[END]********************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/

$lang['Configuration'] = 'Configuration';
$lang['Permissions'] = 'Permissions';
$lang['Manage'] = 'Management';
$lang['Disallow'] = 'Disallow names';
$lang['Prune'] = 'Pruning';
$lang['Mass_Email'] = 'Mass Email';
$lang['Ranks'] = 'Ranks';
$lang['Smilies'] = 'Smilies';
$lang['Ban_Management'] = 'Ban Control';
$lang['Word_Censor'] = 'Word Censors';
$lang['Export'] = 'Export';
$lang['Create_new'] = 'Create';
$lang['Add_new'] = 'Add';
$lang['Backup_DB'] = 'Backup Database';
$lang['Restore_DB'] = 'Restore Database';
/*****[BEGIN]******************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/
$lang['board_faq'] = 'Board FAQ';
$lang['bbcode_faq'] = 'BBcode FAQ';
$lang['attachment_faq'] = 'Attachment FAQ';
$lang['prillian_faq'] = 'Prillian FAQ';
$lang['bid_faq'] = 'Buddy List FAQ';
/*****[END]********************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Board Rules                        v2.0.0 ]
 ******************************************************/
$lang['site_rules'] = 'Site Rules';
/*****[END]********************************************
 [ Mod:     Board Rules                        v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Rebuild Search                     v2.4.0 ]
 ******************************************************/
$lang['Rebuild_Search'] = 'Rebuild Search';
/*****[END]********************************************
 [ Mod:     Rebuild Search                     v2.4.0 ]
 ******************************************************/
//
// Index
//
$lang['Admin'] = 'Administration';
$lang['Not_admin'] = 'You are not authorized to administer this board';
$lang['Welcome_phpBB'] = 'Welcome to phpBB';
$lang['Admin_intro'] = 'Thank you for choosing PHP-Nuke Titanium and phpBB Titanium as your CMS solution. This screen will give you a quick overview of all the various statistics of your forums. You can get back to this page by clicking on the <u>Admin [Forums]</u> link in the left pane. To return to the index of your board, click the <u>Forums Index</u> link or the phpBB logo also in the left pane. The other links on the left hand side of this screen will allow you to control every aspect of your forum experience. Each screen will have instructions on how to use the tools.';
$lang['Main_index'] = 'Forum Index';
$lang['Forum_stats'] = 'Forum Statistics';
$lang['Preview_forum'] = 'Preview Forum';
/*****[BEGIN]******************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/
$lang['Admin_Index'] = 'phpBB Titanium Admin';
$lang['Admin_Nuke'] = 'PHP-Nuke Titanium Admin';
$lang['Home_Nuke'] = 'PHP-Nuke Titanium Home';
/*****[END]********************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/

$lang['Click_return_admin_index'] = 'Click %sHere%s to return to the Admin Index';

$lang['Statistic'] = 'Statistics';
$lang['Value'] = 'Value';
$lang['Number_posts'] = 'Number of posts';
$lang['Posts_per_day'] = 'Posts per day';
$lang['Number_topics'] = 'Number of topics';
$lang['Topics_per_day'] = 'Topics per day';
$lang['Number_users'] = 'Number of users';
$lang['Users_per_day'] = 'Users per day';
$lang['Board_started'] = 'Developer(s) Start Date';
$lang['Avatar_dir_size'] = 'Avatar directory size';
$lang['Database_size'] = 'Database size';
$lang['Gzip_compression'] ='Gzip compression';
$lang['Not_available'] = 'Not available';

$lang['ON'] = 'ON'; // This is for GZip compression
$lang['OFF'] = 'OFF';

//
// DB Utils
//
$lang['Database_Utilities'] = 'Database Utilities';

$lang['Restore'] = 'Restore';
$lang['Backup'] = 'Backup';
$lang['Restore_explain'] = 'This will perform a full restore of all phpBB tables from a saved file. If your server supports it, you may upload a gzip-compressed text file and it will automatically be decompressed. <strong>WARNING</strong>: This will overwrite any existing data. The restore may take a long time to process, so please do not move from this page until it is complete.';
$lang['Backup_explain'] = 'Here you can back up all your phpBB-related data. If you have any additional custom tables in the same database with phpBB that you would like to back up as well, please enter their names, separated by commas, in the Additional Tables textbox below. If your server supports it you may also gzip-compress the file to reduce its size before download.';

$lang['Backup_options'] = 'Backup options';
$lang['Start_backup'] = 'Start Backup';
$lang['Full_backup'] = 'Full backup';
$lang['Structure_backup'] = 'Structure-Only backup';
$lang['Data_backup'] = 'Data only backup';
$lang['Additional_tables'] = 'Additional tables';
$lang['Gzip_compress'] = 'Gzip compress file';
$lang['Select_file'] = 'Select a file';
$lang['Start_Restore'] = 'Start Restore';

$lang['Restore_success'] = 'The Database has been successfully restored.<br /><br />Your board should be back to the state it was when the backup was made.';
$lang['Backup_download'] = 'Your download will start shortly; please wait until it begins.';
$lang['Backups_not_supported'] = 'Sorry, but database backups are not currently supported for your database system.';

$lang['Restore_Error_uploading'] = 'Error in uploading the backup file';
$lang['Restore_Error_filename'] = 'Filename problem; please try an alternative file';
$lang['Restore_Error_decompress'] = 'Cannot decompress a gzip file; please upload a plain text version';
$lang['Restore_Error_no_file'] = 'No file was uploaded';

//
// Auth pages
//
$lang['Select_a_User'] = 'Select a User';
$lang['Select_a_Group'] = 'Select a Group';
$lang['Select_a_Forum'] = 'Select a Forum';
$lang['Auth_Control_User'] = 'User Permissions Control';
$lang['Auth_Control_Group'] = 'Group Permissions Control';
$lang['Auth_Control_Forum'] = 'Forum Permissions Control';
$lang['Look_up_User'] = 'Look up User';
$lang['Look_up_Group'] = 'Look up Group';
$lang['Look_up_Forum'] = 'Look up Forum';

$lang['Group_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each user group. Do not forget when changing group permissions that individual user permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$lang['User_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each individual user. Do not forget when changing user permissions that group permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$lang['Forum_auth_explain'] = 'Here you can alter the authorisation levels of each forum. You will have both a simple and advanced method for doing this, where advanced offers greater control of each forum operation. Remember that changing the permission level of forums will affect which users can carry out the various operations within them.';
/*****[BEGIN]******************************************
 [ Mod:  Overall Forums Permission Interactive v1.0.0 ]
 ******************************************************/
$lang['Forum_auth_explain_overall'] = 'Here you can alter the authorisation levels of each forum. Remember that changing the permission level of forums will affect which users can carry out the various operations within them.';
$lang['Forum_auth_explain_overall_edit'] = 'First click on the swatch in the key, then click on the forum swatch you want to change. Use "restore" to undo changes. Use "stop editing" to turn off further editing.';
$lang['Forum_auth_overall_restore'] = 'Restore Original';
$lang['Forum_auth_overall_stop'] = 'Stop Editing';
/*****[END]********************************************
 [ Mod:  Overall Forums Permission Interactive v1.0.0 ]
 ******************************************************/
$lang['Simple_mode'] = 'Simple Mode';
$lang['Advanced_mode'] = 'Advanced Mode';
$lang['Moderator_status'] = 'Moderator status';

$lang['Allowed_Access'] = 'Allowed Access';
$lang['Disallowed_Access'] = 'Disallowed Access';
$lang['Is_Moderator'] = 'Is Moderator';
$lang['Not_Moderator'] = 'Not Moderator';

$lang['Conflict_warning'] = 'Authorization Conflict Warning';
$lang['Conflict_access_userauth'] = 'This user still has access rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having access rights. The groups granting rights (and the forums involved) are noted below.';
$lang['Conflict_mod_userauth'] = 'This user still has moderator rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having moderator rights. The groups granting rights (and the forums involved) are noted below.';

$lang['Conflict_access_groupauth'] = 'The following user (or users) still have access rights to this forum via their user permission settings. You may want to alter the user permissions to fully prevent them having access rights. The users granted rights (and the forums involved) are noted below.';
$lang['Conflict_mod_groupauth'] = 'The following user (or users) still have moderator rights to this forum via their user permissions settings. You may want to alter the user permissions to fully prevent them having moderator rights. The users granted rights (and the forums involved) are noted below.';

$lang['Public'] = 'Public';
$lang['Private'] = 'Private';
$lang['Registered'] = 'Registered';
$lang['Administrators'] = 'Administrators';
$lang['Hidden'] = 'Hidden';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'ALL';
$lang['Forum_REG'] = 'REG';
$lang['Forum_PRIVATE'] = 'PRIVATE';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_ADMIN'] = 'ADMIN';

$lang['View'] = 'View';
$lang['Read'] = 'Read';
$lang['Post'] = 'Post';
$lang['Reply'] = 'Reply';
$lang['Edit'] = 'Edit';
$lang['Delete'] = 'Delete';
$lang['Sticky'] = 'Sticky';
$lang['Announce'] = 'Announce';
$lang['Vote'] = 'Vote';
$lang['Pollcreate'] = 'Poll create';

$lang['Permissions'] = 'Permissions';
$lang['Simple_Permission'] = 'Simple Permissions';

$lang['User_Level'] = 'User Level';
$lang['Auth_User'] = 'User';
$lang['Auth_Admin'] = 'Administrator';
$lang['Group_memberships'] = 'Usergroup memberships';
$lang['Usergroup_members'] = 'This group has the following members';

$lang['Forum_auth_updated'] = 'Forum permissions updated';
$lang['User_auth_updated'] = 'User permissions updated';
$lang['Group_auth_updated'] = 'Group permissions updated';

$lang['Auth_updated'] = 'Permissions have been updated';
$lang['Click_return_userauth'] = 'Click %sHere%s to return to User Permissions';
$lang['Click_return_groupauth'] = 'Click %sHere%s to return to Group Permissions';
$lang['Click_return_forumauth'] = 'Click %sHere%s to return to Forum Permissions';

//
// Banning
//
$lang['Ban_control'] = 'Ban Control';
$lang['Ban_explain'] = 'Here you can control the banning of users. You can achieve this by banning either or both of a specific user or an individual or range of IP addresses or hostnames. These methods prevent a user from even reaching the index page of your board. To prevent a user from registering under a different username you can also specify a banned email address. Please note that banning an email address alone will not prevent that user from being able to log on or post to your board. You should use one of the first two methods to achieve this.';
$lang['Ban_explain_warn'] = 'Please note that entering a range of IP addresses results in all the addresses between the start and end being added to the banlist. Attempts will be made to minimise the number of addresses added to the database by introducing wildcards automatically where appropriate. If you really must enter a range, try to keep it small or better yet state specific addresses.';

$lang['Select_username'] = 'Select a Username';
$lang['Select_ip'] = 'Select an IP address';
$lang['Select_email'] = 'Select an Email address';

$lang['Ban_username'] = 'Ban one or more specific users';
$lang['Ban_username_explain'] = 'You can ban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$lang['Ban_IP'] = 'Ban one or more IP addresses or hostnames';
$lang['IP_hostname'] = 'IP addresses or hostnames';
$lang['Ban_IP_explain'] = 'To specify several different IP addresses or hostnames separate them with commas. To specify a range of IP addresses, separate the start and end with a hyphen (-); to specify a wildcard, use an asterisk (*).';

$lang['Ban_email'] = 'Ban one or more email addresses';
$lang['Ban_email_explain'] = 'To specify more than one email address, separate them with commas. To specify a wildcard username, use * like *@hotmail.com';

$lang['Unban_username'] = 'Un-ban one or more specific users';
$lang['Unban_username_explain'] = 'You can unban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$lang['Unban_IP'] = 'Un-ban one or more IP addresses';
$lang['Unban_IP_explain'] = 'You can unban multiple IP addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$lang['Unban_email'] = 'Un-ban one or more email addresses';
$lang['Unban_email_explain'] = 'You can unban multiple email addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$lang['No_banned_users'] = 'No banned usernames';
$lang['No_banned_ip'] = 'No banned IP addresses';
$lang['No_banned_email'] = 'No banned email addresses';

$lang['Ban_update_sucessful'] = 'The banlist has been updated successfully';
$lang['Click_return_banadmin'] = 'Click %sHere%s to return to Ban Control';

//
// Configuration
//
$lang['General_Config'] = 'General Configuration';
$lang['Config_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side.';

$lang['Click_return_config'] = 'Click %sHere%s to return to General Configuration';

$lang['General_settings'] = 'General Board Settings';
$lang['Server_name'] = 'Domain Name';
$lang['Server_name_explain'] = 'The domain name from which this board runs';
$lang['Script_path'] = 'Script path';
$lang['Script_path_explain'] = 'The path where phpBB2 is located relative to the domain name';
$lang['Server_port'] = 'Server Port';
$lang['Server_port_explain'] = 'The port your server is running on, usually 80. Only change if different';
$lang['Site_name'] = 'Site name';
$lang['Site_desc'] = 'Site description';
/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
$lang['Global_title'] = 'Global announcement title'; 
$lang['Global_title_explain'] = 'Enter a different title for the announcement if the default "Global Announcement" is not suitable.'; 
$lang['Global'] = 'Global Announcement'; 
$lang['Global_explain'] = 'Enter the special announcement you want displayed on your forums main index page here.'; 
$lang['Enable_global'] = 'Enable Global Announcement'; 
$lang['Enable_global_explain'] = 'If you enable this, a global announcement will be displayed on your main index page.'; 
$lang['Global_marquee_effect'] = 'Enable the scrolling global announcement effect'; 
$lang['Global_marquee_effect_explain'] = 'If you enable this, your global announcement will scroll on the main index.'; 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/
$lang['Board_disable'] = 'Disable board';
$lang['Board_disable_explain'] = 'This will make the board unavailable to users. Administrators are able to access the Administration Panel while the board is disabled.';
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
$lang['Board_disable_msg'] = 'Disable board message';
$lang['Board_disable_msg_explain'] = 'This text will be showed if "Disable board" is on "Yes".';
/*****[END]********************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
$lang['Acct_activation'] = 'Enable account activation';
$lang['Acc_None'] = 'None'; // These three entries are the type of activation
$lang['Acc_User'] = 'User';
$lang['Acc_Admin'] = 'Admin';

$lang['Abilities_settings'] = 'User and Forum Basic Settings';
$lang['Max_poll_options'] = 'Max number of poll options';
$lang['Flood_Interval'] = 'Flood Interval';
$lang['Flood_Interval_explain'] = 'Number of seconds a user must wait between posts';
$lang['Board_email_form'] = 'User email via board';
$lang['Board_email_form_explain'] = 'Users send email to each other via this board';
$lang['Topics_per_page'] = 'Topics Per Page';
$lang['Posts_per_page'] = 'Posts Per Page';
$lang['Hot_threshold'] = 'Posts for Popular Threshold';
$lang['Default_style'] = 'Default Theme';
$lang['Override_style'] = 'Override user style';
$lang['Override_style_explain'] = 'Replaces users style with the default';
$lang['Default_language'] = 'Default Language';
$lang['Date_format'] = 'Date Format';
$lang['System_timezone'] = 'System Timezone';
$lang['Enable_gzip'] = 'Enable GZip Compression';
$lang['Enable_prune'] = 'Enable Forum Pruning';
$lang['Allow_HTML'] = 'Allow HTML';
$lang['Allow_BBCode'] = 'Allow BBCode';
$lang['Allowed_tags'] = 'Allowed HTML tags';
$lang['Allowed_tags_explain'] = 'Separate tags with commas';
$lang['Allow_smilies'] = 'Allow Smilies';
$lang['Smilies_path'] = 'Smilies Storage Path';
$lang['Smilies_path_explain'] = 'Path under your phpBB root dir, e.g. modules/Forums/images/smiles';
$lang['Allow_sig'] = 'Allow Signatures';
$lang['Max_sig_length'] = 'Maximum signature length';
$lang['Max_sig_length_explain'] = 'Maximum number of characters in user signatures';
$lang['Allow_name_change'] = 'Allow Username changes';

$lang['Avatar_settings'] = 'Avatar Settings';
$lang['Allow_local'] = 'Enable gallery avatars';
$lang['Allow_remote'] = 'Enable remote avatars';
$lang['Allow_remote_explain'] = 'Avatars linked to from another website';
$lang['Allow_upload'] = 'Enable avatar uploading';
$lang['Max_filesize'] = 'Maximum Avatar File Size';
$lang['Max_filesize_explain'] = 'For uploaded avatar files';
$lang['Max_avatar_size'] = 'Maximum Avatar Dimensions';
$lang['Max_avatar_size_explain'] = '(Height x Width in pixels)';
$lang['Avatar_storage_path'] = 'Avatar Storage Path';
$lang['Avatar_storage_path_explain'] = 'Path under your phpBB root dir, e.g. modules/Forums/images/avatars';
$lang['Avatar_gallery_path'] = 'Avatar Gallery Path';
$lang['Avatar_gallery_path_explain'] = 'Path under your phpBB root dir for pre-loaded images, e.g. modules/Forums/images/avatars/gallery';

$lang['COPPA_settings'] = 'COPPA Settings';
$lang['COPPA_fax'] = 'COPPA Fax Number';
$lang['COPPA_mail'] = 'COPPA Mailing Address';
$lang['COPPA_mail_explain'] = 'This is the mailing address to which parents will send COPPA registration forms';

$lang['Email_settings'] = 'Email Settings';
$lang['Admin_email'] = 'Admin Email Address';
$lang['Email_sig'] = 'Email Signature';
$lang['Email_sig_explain'] = 'This text will be attached to all emails the board sends';
$lang['Use_SMTP'] = 'Use SMTP Server for email';
$lang['Use_SMTP_explain'] = 'Say yes if you want or have to send email via a named server instead of the local mail function';
$lang['SMTP_server'] = 'SMTP Host';

$lang['SMTP_encryption'] = 'Encryption';
$lang['SMTP_encryption_explain'] = 'For most servers TLS is the recommended option.<br /><br />If your SMTP provider offers both SSL and TLS options, we recommend using TLS.';

$lang['SMTP_port'] = 'SMTP Port';

$lang['SMPT_Authentication'] = 'Authentication';

$lang['SMTP_username'] = 'SMTP Username';
$lang['SMTP_username_explain'] = 'Only enter a username if your SMTP server requires it';
$lang['SMTP_password'] = 'SMTP Password';
$lang['SMTP_password_explain'] = 'The password is stored in plain text. We highly recommend you setup your password in your configuration file for improved security; to do this add the lines below to your config.php file.
<br /><br />define( \'SMTP_Password\', \'your_password\' );';

$lang['Disable_privmsg'] = 'Private Messaging';
$lang['Inbox_limits'] = 'Max posts in Inbox';
$lang['Sentbox_limits'] = 'Max posts in Sentbox';
$lang['Savebox_limits'] = 'Max posts in Savebox';

$lang['Cookie_settings'] = 'Cookie settings';
$lang['Cookie_settings_explain'] = 'These details define how cookies are sent to your users\' browsers. In most cases the default values for the cookie settings should be sufficient, but if you need to change them do so with care -- incorrect settings can prevent users from logging in';
$lang['Cookie_domain'] = 'Cookie domain';
$lang['Cookie_name'] = 'Cookie name';
$lang['Cookie_path'] = 'Cookie path';
$lang['Cookie_secure'] = 'Cookie secure';
$lang['Cookie_secure_explain'] = 'If your server is running via SSL, set this to enabled, else leave as disabled';
$lang['Session_length'] = 'Session length [ seconds ]';

// Visual Confirmation
$lang['Visual_confirm'] = 'Enable Visual Confirmation';
$lang['Visual_confirm_explain'] = 'Requires users enter a code defined by an image when registering.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Allow automatic logins';
$lang['Allow_autologin_explain'] = 'Determines whether users are allowed to select to be automatically logged in when visiting the forum';
$lang['Autologin_time'] = 'Automatic login key expiry';
$lang['Autologin_time_explain'] = 'How long a autologin key is valid for in days if the user does not visit the board. Set to zero to disable expiry.';
// Search Flood Control - added 2.0.20
$lang['Search_Flood_Interval'] = 'Search Flood Interval';
$lang['Search_Flood_Interval_explain'] = 'Number of seconds a user must wait between search requests';
$lang['Stylesheet_explain'] = 'Filename for CSS stylesheet to use for this theme.';

//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Allowed login attempts';
$lang['Max_login_attempts_explain'] = 'The number of allowed board login attempts.';
$lang['Login_reset_time'] = 'Login lock time';
$lang['Login_reset_time_explain'] = 'Time in minutes the user have to wait until he is allowed to login again after exceeding the number of allowed login attempts.';

//
// Forum Management
//
$lang['Forum_admin'] = 'Forum Administration';
$lang['Forum_admin_explain'] = 'From this panel you can add, delete, edit, re-order and re-synchronise categories and forums';
$lang['Edit_forum'] = 'Edit forum';
$lang['Create_forum'] = 'Create new forum';
$lang['Create_category'] = 'Create new category';
$lang['Remove'] = 'Remove';
$lang['Action'] = 'Action';
$lang['Update_order'] = 'Update Order';
$lang['Config_updated'] = 'Forum Configuration Updated Successfully';
$lang['Edit'] = 'Edit';
$lang['Delete'] = 'Delete';
$lang['Move_up'] = 'Move up';
$lang['Move_down'] = 'Move down';
$lang['Resync'] = 'Resync';
$lang['No_mode'] = 'No mode was set';
$lang['Forum_edit_delete_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side';

/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
$lang['Forum_color'] = 'Set a color for the forum title';
$lang['Forum_color_explain'] = 'Leave this field blank to use the default color. Just enter the color number without leading \'#\'!';
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/

$lang['Move_contents'] = 'Move all contents';
$lang['Forum_delete'] = 'Delete Forum';
$lang['Forum_delete_explain'] = 'The form below will allow you to delete a forum (or category) and decide where you want to put all topics (or forums) it contained.';

$lang['Status_locked'] = 'Locked';
$lang['Status_unlocked'] = 'Unlocked';
$lang['Forum_settings'] = 'General Forum Settings';
$lang['Forum_name'] = 'Forum name';
$lang['Forum_desc'] = 'Description';
$lang['Forum_status'] = 'Forum status';
$lang['Forum_pruning'] = 'Auto-pruning';

$lang['prune_freq'] = 'Check for topic age every';
$lang['prune_days'] = 'Remove topics that have not been posted to in';
$lang['Set_prune_data'] = 'You have turned on auto-prune for this forum but did not set a frequency or number of days to prune. Please go back and do so.';

$lang['Move_and_Delete'] = 'Move and Delete';

$lang['Delete_all_posts'] = 'Delete all posts';
$lang['Nowhere_to_move'] = 'Nowhere to move to';

$lang['Edit_Category'] = 'Edit Category';
$lang['Edit_Category_explain'] = 'Use this form to modify a category\'s name.';

$lang['Forums_updated'] = 'Forum and Category information updated successfully';

$lang['Must_delete_forums'] = 'You need to delete all forums before you can delete this category';

$lang['Click_return_forumadmin'] = 'Click %sHere%s to return to Forum Administration';

//
// Smiley Management
//
$lang['smiley_title'] = 'Smiles Editing Utility';
$lang['smile_desc'] = 'From this page you can add, remove and edit the emoticons or smileys that your users can use in their posts and private messages.';

$lang['smiley_config'] = 'Smiley Configuration';
$lang['smiley_code'] = 'Smiley Code';
$lang['smiley_url'] = 'Smiley Image File';
$lang['smiley_emot'] = 'Smiley Emotion';
$lang['smile_add'] = 'Add a new Smiley';
$lang['Smile'] = 'Smile';
$lang['Emotion'] = 'Emotion';

$lang['Select_pak'] = 'Select Pack (.pak) File';
$lang['replace_existing'] = 'Replace Existing Smiley';
$lang['keep_existing'] = 'Keep Existing Smiley';
$lang['smiley_import_inst'] = 'You should unzip the smiley package and upload all files to the appropriate Smiley directory for your installation. Then select the correct information in this form to import the smiley pack.';
$lang['smiley_import'] = 'Smiley Pack Import';
$lang['choose_smile_pak'] = 'Choose a Smile Pack .pak file';
$lang['import'] = 'Import Smileys';
$lang['smile_conflicts'] = 'What should be done in case of conflicts';
$lang['del_existing_smileys'] = 'Delete existing smileys before import';
$lang['import_smile_pack'] = 'Import Smiley Pack';
$lang['export_smile_pack'] = 'Create Smiley Pack';
$lang['export_smiles'] = 'To create a smiley pack from your currently installed smileys, click %sHere%s to download the smiles.pak file. Name this file appropriately making sure to keep the .pak file extension.  Then create a zip file containing all of your smiley images plus this .pak configuration file.';

$lang['smiley_add_success'] = 'The Smiley was successfully added';
$lang['smiley_edit_success'] = 'The Smiley was successfully updated';
$lang['smiley_import_success'] = 'The Smiley Pack was imported successfully!';
$lang['smiley_del_success'] = 'The Smiley was successfully removed';
$lang['Click_return_smileadmin'] = 'Click %sHere%s to return to Smiley Administration';
$lang['Confirm_delete_smiley'] = 'Are you sure you want to delete this Smiley?';

//
// User Management
//
$lang['User_admin'] = 'User Administration';
$lang['User_admin_explain'] = 'Here you can change your users\' information and certain options. To modify the users\' permissions, please use the user and group permissions system.';

$lang['Look_up_user'] = 'Look up user';

$lang['Admin_user_fail'] = 'Couldn\'t update the user\'s profile.';
$lang['Admin_user_updated'] = 'The user\'s profile was successfully updated.';
$lang['Click_return_useradmin'] = 'Click %sHere%s to return to User Administration';

$lang['User_delete'] = 'Delete this user';
$lang['User_delete_explain'] = 'Click here to delete this user; this cannot be undone.';
$lang['User_deleted'] = 'User was successfully deleted.';

$lang['User_status'] = 'User is active';
$lang['User_allowpm'] = 'Can send Private Messages';
$lang['User_allowavatar'] = 'Can display avatar';

$lang['Admin_avatar_explain'] = 'Here you can see and delete the user\'s current avatar.';

$lang['User_special'] = 'Special admin-only fields';
$lang['User_special_explain'] = 'These fields are not able to be modified by the users.  Here you can set their status and other options that are not given to users.';

//
// Group Management
//
$lang['Group_administration'] = 'Group Administration';
$lang['Group_admin_explain'] = 'From this panel you can administer all your usergroups. You can delete, create and edit existing groups. You may choose moderators, toggle open/closed group status and set the group name and description';
$lang['Error_updating_groups'] = 'There was an error while updating the groups';
$lang['Updated_group'] = 'The group was successfully updated';
$lang['Added_new_group'] = 'The new group was successfully created';
$lang['Deleted_group'] = 'The group was successfully deleted';
$lang['New_group'] = 'Create new group';
$lang['Edit_group'] = 'Edit group';
$lang['group_name'] = 'Group name';
$lang['group_description'] = 'Group description';
$lang['group_moderator'] = 'Group moderator';
$lang['group_status'] = 'Group status';
$lang['group_open'] = 'Open group';
$lang['group_closed'] = 'Closed group';
$lang['group_hidden'] = 'Hidden group';
$lang['group_delete'] = 'Delete group';
$lang['group_delete_check'] = 'Delete this group';
$lang['submit_group_changes'] = 'Submit Changes';
$lang['reset_group_changes'] = 'Reset Changes';
$lang['No_group_name'] = 'You must specify a name for this group';
$lang['No_group_moderator'] = 'You must specify a moderator for this group';
$lang['No_group_mode'] = 'You must specify a mode for this group, open or closed';
$lang['No_group_action'] = 'No action was specified';
$lang['delete_group_moderator'] = 'Delete the old group moderator?';
$lang['delete_moderator_explain'] = 'If you\'re changing the group moderator, check this box to remove the old moderator from the group.  Otherwise, do not check it, and the user will become a regular member of the group.';
$lang['Click_return_groupsadmin'] = 'Click %sHere%s to return to Group Administration.';
$lang['Select_group'] = 'Select a group';
$lang['Look_up_group'] = 'Look up group';

//
// Prune Administration
//
$lang['Forum_Prune'] = 'Forum Prune';
$lang['Forum_Prune_explain'] = 'This will delete any topic which has not been posted to within the number of days you select. If you do not enter a number then all topics will be deleted. It will not remove topics in which polls are still running nor will it remove announcements. You will need to remove those topics manually.';
$lang['Do_Prune'] = 'Do Prune';
$lang['All_Forums'] = 'All Forums';
$lang['Prune_topics_not_posted'] = 'Prune topics with no replies in this many days';
$lang['Topics_pruned'] = 'Topics pruned';
$lang['Posts_pruned'] = 'Posts pruned';
$lang['Prune_success'] = 'Pruning of forums was successful';

//
// Word censor
//
$lang['Words_title'] = 'Word Censoring';
$lang['Words_explain'] = 'From this control panel you can add, edit, and remove words that will be automatically censored on your forums. In addition people will not be allowed to register with usernames containing these words. Wildcards (*) are accepted in the word field. For example, *test* will match detestable, test* would match testing, *test would match detest.';
$lang['Word'] = 'Word';
$lang['Edit_word_censor'] = 'Edit word censor';
$lang['Replacement'] = 'Replacement';
$lang['Add_new_word'] = 'Add new word';
$lang['Update_word'] = 'Update word censor';

$lang['Must_enter_word'] = 'You must enter a word and its replacement';
$lang['No_word_selected'] = 'No word selected for editing';

$lang['Word_updated'] = 'The selected word censor has been successfully updated';
$lang['Word_added'] = 'The word censor has been successfully added';
$lang['Word_removed'] = 'The selected word censor has been successfully removed';

$lang['Click_return_wordadmin'] = 'Click %sHere%s to return to Word Censor Administration';
$lang['Confirm_delete_word'] = 'Are you sure you want to delete this word censor?';

//
// Mass Email
//
$lang['Mass_email_explain'] = 'Here you can email a message to either all of your users or all users of a specific group.  To do this, an email will be sent out to the administrative email address supplied, with a blind carbon copy sent to all recipients. If you are emailing a large group of people please be patient after submitting and do not stop the page halfway through. It is normal for a mass emailing to take a long time and you will be notified when the script has completed';
$lang['Compose'] = 'Compose';

$lang['Recipients'] = 'Recipients';
$lang['All_users'] = 'All Users';

$lang['Email_successfull'] = 'Your message has been sent';
$lang['Click_return_massemail'] = 'Click %sHere%s to return to the Mass Email form';

//
// Ranks admin
//
$lang['Ranks_title'] = 'Rank Administration';
$lang['Ranks_explain'] = 'Using this form you can add, edit, view and delete ranks. You can also create custom ranks which can be applied to a user via the user management facility';

$lang['Add_new_rank'] = 'Add new rank';

$lang['Rank_title'] = 'Rank Title';
$lang['Rank_special'] = 'Set as Special Rank';
$lang['Rank_minimum'] = 'Minimum Posts';
$lang['Rank_maximum'] = 'Maximum Posts';
$lang['Rank_image'] = 'Rank Image (Relative to phpBB2 root path)';
$lang['Rank_image_explain'] = 'Use this to define a small image associated with the rank';

$lang['Must_select_rank'] = 'You must select a rank';
$lang['No_assigned_rank'] = 'No special rank assigned';

$lang['Rank_updated'] = 'The rank was successfully updated';
$lang['Rank_added'] = 'The rank was successfully added';
$lang['Rank_removed'] = 'The rank was successfully deleted';
$lang['No_update_ranks'] = 'The rank was successfully deleted. However, user accounts using this rank were not updated.  You will need to manually reset the rank on these accounts';

$lang['Click_return_rankadmin'] = 'Click %sHere%s to return to Rank Administration';
$lang['Confirm_delete_rank'] = 'Are you sure you want to delete this rank?';

//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Username Disallow Control';
$lang['Disallow_explain'] = 'Here you can control usernames which will not be allowed to be used.  Disallowed usernames are allowed to contain a wildcard character of *.  Please note that you will not be allowed to specify any username that has already been registered. You must first delete that name then disallow it.';

$lang['Delete_disallow'] = 'Delete';
$lang['Delete_disallow_title'] = 'Remove a Disallowed Username';
$lang['Delete_disallow_explain'] = 'You can remove a disallowed username by selecting the username from this list and clicking delete';

$lang['Add_disallow'] = 'Add';
$lang['Add_disallow_title'] = 'Add a disallowed username';
$lang['Add_disallow_explain'] = 'You can disallow a username using the wildcard character * to match any character';

$lang['No_disallowed'] = 'No Disallowed Usernames';

$lang['Disallowed_deleted'] = 'The disallowed username has been successfully removed';
$lang['Disallow_successful'] = 'The disallowed username has been successfully added';
$lang['Disallowed_already'] = 'The name you entered could not be disallowed. It either already exists in the list, exists in the word censor list, or a matching username is present.';

$lang['Click_return_disallowadmin'] = 'Click %sHere%s to return to Disallow Username Administration';

$lang['Install'] = 'Install';
$lang['Upgrade'] = 'Upgrade';

$lang['Install_No_PCRE'] = 'phpBB2 Requires the Perl-Compatible Regular Expressions Module for PHP which your PHP configuration doesn\'t appear to support!';

$lang['theme'] = 'Theme';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$lang['wrap_title'] = 'Force Word Wrapping';
$lang['wrap_enable'] = 'Force Word Wrapping';
$lang['wrap_min'] = 'Minimum Screen Width';
$lang['wrap_max'] = 'Maximum Screen Width';
$lang['wrap_def'] = 'Default Screen Width';
$lang['wrap_units'] = 'characters';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/

//
// Version Check
//
$lang['Version_up_to_date'] = 'Your installation is up to date, no updates are available for your version of phpBB Titanium.';
$lang['Version_not_up_to_date'] = 'Your installation does <strong>not</strong> seem to be up to date. Updates are available for your version of phpBB Titanium.';
$lang['Latest_version_info'] = 'The latest available version is <strong>phpBB Titanium %s</strong>. ';
$lang['Current_version_info'] = 'You are running <strong>phpBB Titanium '.PHPBB_TITANIUM.'</strong>.';
$lang['Connect_socket_error'] = 'Unable to open connection to phpBB Titanium Server, reported error is:<br />%s';
$lang['Socket_functions_disabled'] = 'Unable to use socket functions.';
$lang['Mailing_list_subscribe_reminder'] = 'For the latest information on updates for phpBB Titanium, send a <u><a href="https://www.php-nuke-titanium.86it.us/modules.php?name=Private_Messages&mode=post&u=3/" target="_new">Private Message</a></u> to Ernest Allen Buffington.';
$lang['Version_information'] = 'Version Information';

/*****[BEGIN]******************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
$lang['Board_statistic'] = 'Board statistics';
$lang['Database_statistic'] = 'Database statistics';
$lang['Version_info'] = 'Version information';
$lang['Thereof_deactivated_users'] = 'Number of non-active members';
$lang['Thereof_Moderators'] = 'Number of Moderators';
$lang['Thereof_Administrators'] = 'Number of Administrators';
$lang['Deactivated_Users'] = 'Members in need of Activation';
$lang['Users_with_Admin_Privileges'] = 'Members with administrator privileges';
$lang['Users_with_Mod_Privileges'] = 'Members with moderator privileges';
$lang['DB_size'] = 'Size of the database';
$lang['Version_of_board'] = 'Version of <a href="http://www.php-nuke-titanium.86it.us" target="_blank">phpBB Titanium</a>';
$lang['Version_of_PHP'] = 'Version of <a href="http://www.php.net/" target="_blank">PHP</a>';
$lang['Version_of_MySQL'] = 'Version of <a href="https://mariadb.org/" target="_blank">MariaDB</a>';
/*****[END]********************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$lang['SQR_settings'] = 'SQR Settings';
$lang['Allow_quick_reply'] = 'Allow Quick Reply';
$lang['Anonymous_show_SQR'] = 'Show Quick Reply Form to Anonymous Users';
$lang['Anonymous_SQR_mode'] = 'Anonymous Users Quick Reply Mode';
$lang['Anonymous_open_SQR'] = 'Open Quick Reply Form for Anonymous Users automatically';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Admin Userlist                     v2.0.2 ]
 ******************************************************/

$lang['Userlist_description'] = 'View a complete list of your users and perform various actions on them';

$lang['Add_group'] = 'Add to a Group';
$lang['Add_group_explain'] = 'Select which group to add the selected users to';

$lang['Open_close'] = 'Open/Close';
$lang['Active'] = 'Active';
$lang['Group'] = 'Group(s)';
$lang['Rank'] = 'Rank';
$lang['Last_activity'] = 'Last Activity';
$lang['Never'] = 'Never';
$lang['User_manage'] = 'Manage';
$lang['Find_all_posts'] = 'Find All Posts';
$lang['Filter']='Filter';

$lang['Select_one'] = 'Select One...';
$lang['Ban'] = 'Ban';
$lang['Activate_deactivate'] = 'Activate/De-activate';

$lang['Sort_User_id'] = 'By User id';
$lang['Sort_User_level'] = 'By User Level';
$lang['Sort_Rank'] = 'By Rank';
$lang['Sort_Active'] = 'By Active';
$lang['Sort_Last_Activity'] = 'By Last Activity';
$lang['Sort_User_Level'] = 'By User Level';

$lang['User_id'] = 'User id';
$lang['User_level'] = 'User Level';
$lang['Show'] = 'Show';
$lang['All'] = 'All';

$lang['Member'] = 'Member';
$lang['Pending'] = 'Pending';

$lang['Confirm_user_ban'] = 'Are you sure you want to ban the selected user(s)?';
$lang['Confirm_user_deleted'] = 'Are you sure you want to detele the selected user(s)?';

$lang['User_status_updated'] = 'User(s) status updated successfully!';
$lang['User_banned_successfully'] = 'User(s) banned successfully!';
$lang['User_deleted_successfully'] = 'User(s) deleted successfully!';
$lang['User_add_group_successfully'] = 'User(s) added to group successfully!';

$lang['Click_return_userlist'] = 'Click %shere%s to return to the User List';
/*****[END]********************************************
 [ Mod:     Admin Userlist                     v2.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$lang['Globalannounce'] ='Global Announce';
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    PM Quick Reply                      v1.3.5 ]
 ******************************************************/
$lang['ropm_quick_reply'] = 'PM Quick Reply';
$lang['enable_ropm_quick_reply'] = 'Enable PM Quick Reply';
$lang['ropm_quick_reply_bbc'] = 'Enable BBCode-Buttons';
$lang['ropm_quick_reply_smilies'] = 'Number of smilies';
$lang['ropm_quick_reply_smilies_info'] = 'You have to enter 0 here, if you don\'t want any smilies to be displayed.';
/*****[END]********************************************
 [ Mod:    PM Quick Reply                      v1.3.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
$lang['Must_select_search'] = 'You must select a quick search';
$lang['Search_title'] = 'Quick Search Management';
$lang['Search_explain'] = 'Using this facility, you can add, edit, and select search tools to add in the quick search.';
$lang['Search_name'] = 'Search Name';
$lang['Search_name_explain'] = 'The name display on the search drop down list. Examples: <strong>Yahoo / Google</strong>';
$lang['Search_url'] = 'Search URL';
$lang['Search_url_explain'] = 'The URL required for search to work. Examples:<br /><span style="color:red">Note: If the search engine needs additional string <strong>AFTER</strong> a</span> <strong>Keyword</strong><span style="color:red">, put the additional string in the second box! You don\'t have to add the word</span> <strong>Keyword</strong> <span style="color:red">of course, just leave it blank.</span><br /><br />- <span style="color:blue">http://search.yahoo.com/search?ei=utf-8&fr=sfp&p=</span><strong>Keyword</strong><br />- <span style="color:blue">http://www.google.com/search?hl=en&ie=utf-8&oe=utf-8&q=</span><strong>Keyword</strong><br />- <span style="color:blue">http://www.alltheweb.com/search?cat=web&cs=utf8&q=</span><strong>Keyword</strong><span style="color:blue">&rys=0&itag=crv&_sb_lang=pref</span><br />';
$lang['Must_enter_search_name'] = 'You must enter the search name';
$lang['Search_updated'] = 'Search was updated successfully';
$lang['Search_added'] = 'Search was added successfully';
$lang['Click_return_addsearchadmin'] = 'Click %sHere%s to return to the Add-Search Management Panel';
// a href, /a tags
$lang['Search_removed'] = 'Search was removed successfully';
$lang['Add_new_search'] = 'Add a new search';
// Quick Search Enable Setting for Board Configuration Panel
$lang['Quick_search_enable'] = 'Enable Quick Search';
$lang['Quick_search_enable_explain'] = 'Shows the Quick Search field in the overall header.';
/*****[END]********************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
$lang['sig_title']   = 'Advanced Signature Control';
$lang['sig_divider'] = 'Current Signature Divider';
$lang['sig_explain'] = 'This is where you control what divides the user\'s signature from their post';
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
$lang['Default_avatar'] = 'Set a default avatar';
$lang['Default_avatar_explain'] = 'This gives users that haven\'t yet selected an avatar, a default one. Set the default avatar for guests and users, and then select whether you want the avatar to be displayed for registered users, guests, both or none.<br />The path is \'modules/Forums/images/avatars/gallery\'';
$lang['Default_avatar_guests'] = 'Guests';
$lang['Default_avatar_users'] = 'Users';
$lang['Default_avatar_both'] = 'Both';
$lang['Default_avatar_none'] = 'None';
/*****[END]********************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
$lang['Board_disable_adminview'] = 'Administrator access when board disabled';
$lang['Board_disable_adminview_explain'] = 'This will allow Administrators to access the entire board when it is disabled.';
/*****[END]********************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/
$lang['URL_server_error'] = 'The URL you entered (%s) does not match the URL that the server is reporting (%s)';
$lang['URL_error_confirm'] = 'Do you want to keep this setting?';
/*****[END]********************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/
$lang['pm_allow_threshold'] = 'Allow PM threshold';
$lang['pm_allow_threshold_explain'] = 'Set here the minimal amount of posts the user has to write before being able to use the private messages.';
/*****[END]********************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
$lang['Max_smilies'] = 'Maximum smilies limit per post';
/*****[END]********************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  Cookie Check                        v1.0.0 ]
 ******************************************************/
$lang['Cookie_server_error'] = 'The Cookie Domain you entered (%s) does not match the URL that the server is reporting (%s)';
$lang['Cookie_error_confirm'] = 'Do you want to keep this setting?';
$lang['Cookie_name_error'] = 'The Cookie Name you entered (%s) is a standard cookie name and might cause problems. <br /> A recommend name might be %s';
/*****[END]********************************************
 [ Other:  Cookie Check                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
$lang['File_not_deleted'] = 'You have not yet delete the file install_tables.php : do it before trying to see this page.';
$lang['Log_action_title'] = 'Logs Actions';
$lang['Log_action_explain'] = 'Here you can see your moderators/administrators actions';
$lang['Choose_sort_method'] = 'Choose sorting method';
$lang['Order'] = 'Order';
$lang['Go'] = 'Go';
$lang['Id_log'] = 'Log Id';
$lang['Choose_log'] = 'Select Log';
$lang['Delete'] = 'Delete';
$lang['Action'] = 'Action';
$lang['Topic'] = 'Topic';
$lang['Done_by'] = 'Done By';
$lang['User_ip'] = 'User IP';
$lang['Select_all'] = 'Select All';
$lang['Unselect_all'] = 'Unselect All';
$lang['Date'] = 'Date';
$lang['See_topic'] = 'See the post';
$lang['Log_delete'] = 'Log deleted successfully.';
$lang['Click_return_admin_log'] = 'Click %sHere%s to return to the Log Actions';
$lang['Log_Config_updated'] = 'Configuration of Log Actions MOD successfull';
$lang['Click_return_admin_log_config'] = 'Click %sHere%s to return to the Log Actions MOD Configuration';
$lang['Log_Config'] = 'Configuration of the Log';
$lang['Log_Config_explain'] = 'Here, you will be able to configure some options of the Log Actions MOD.';
$lang['General_Config_Log'] = 'General Configuration of Log Actions MOD';
$lang['Allow_all_admin'] = 'Allow other Admins to see the Log Actions ?';
$lang['Allow_all_admin_explain'] = 'This option will allow you to choose if only the first admin of the board will be able to see the Log';
$lang['Admin_not_authorized'] = 'Sorry, you\'re not allowed to view this page. Only the main Admin has permission.';
$lang['Add_username_admin_explain'] = 'Choose the name of another Admin that you want to allow to see the logged actions';
$lang['Delete_username_admin_explain'] = 'Choose the name of another Admin that you don\'t want to allow to see the logged actions';
$lang['No_other_admins'] = 'No other Admins to choose';
$lang['No_admins_authorized'] = 'No other Admins authorized';
$lang['Add_Admin_Username'] = 'Choose an username to add';
$lang['Delete_Admin_Username'] = 'Choose an username to delete';
$lang['No_admins_allow'] = 'There are no admins to allow to view the logs';
$lang['No_admins_disallow'] = 'There are no admins to disallow to view the logs';
$lang['Admins_add_success'] = 'Admin have been added to the list successfully';
$lang['Admins_del_success'] = 'Admin(s) have been deleted from the list successfully';
$lang['Prune_success'] = 'Prune of the Logs successfull';
$lang['Prune_of_logs'] = 'Prune of the Logs';
$lang['Prune'] = 'Prune Logs';
$lang['Prune_!'] = 'Prune !';
$lang['Prune_explain'] = 'Enter the number of days that you want to prune the logs. 0 = all the logs';
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
$lang['glance_title'] = 'At a Glance Options';
$lang['glance_override_title'] = 'Override User Settings';

$lang['glance_news'] = 'Enter the Forum ID of your News Forum';
$lang['glance_news_explain'] = 'Set to 0 if you dont have a news forum or dont want news displayed. Seperate News Forums with , (1,2,3).';

$lang['glance_num_news'] = 'Enter the number of news articles to display.';
$lang['glance_num_news_explain'] = 'Set to 0 if you dont have a news forum or dont want news displayed.';

$lang['glance_num_explain'] = 'Enter the amount of recent topics to display';

$lang['glance_ignore_forums'] = 'Enter the Forum ID of Forums you would like to be ignored on the recent topics list.';
$lang['glance_ignore_forums_explain'] = 'Seperate Forums with , (1,2,3). Leave blank to show all.';

$lang['glance_table_width'] = 'Enter the width you would like the Recent Blocks displayed.';
$lang['glance_table_width_explain'] = 'Default : 100%';
$lang['glance_auth_read_explain'] = 'Show topics the user can view but not read?';

$lang['glance_topic_length'] = 'Limit the number of characters displayed in topic title.';
$lang['glance_topic_length_explain'] = 'Set to 0 to show full title.';
/*****[END]********************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
$lang['Online_time'] = 'Online status time';
$lang['Online_time_explain'] = 'Number of seconds a user must be displayed online (do not use lower value than 60).';
$lang['Online_setting'] = 'Online Status Setting';
$lang['Online_color'] = 'Online text color';
$lang['Offline_color'] = 'Offline text color';
$lang['Hidden_color'] = 'Hidden text color';
/*****[END]********************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/

 /*****[BEGIN]******************************************
 [ Mod:   Show Users Today Toggle              v1.0.0 ]
 ******************************************************/
 $lang['show_users_today'] = 'Show users who logged on today on Index<br /><small>Note: Not Recommended for large sites</small>';
/*****[END]********************************************
 [ Mod:   Show Users Today Toggle              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Group Colors and Ranks             v1.0.0 ]
 ******************************************************/
$lang['group_color'] = 'Select the default color group for this group.';
$lang['group_rank'] = 'Select the default rank for this group.';
/*****[BEGIN]******************************************
 [ Mod:     Group Colors and Ranks             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
$lang['topic_explain'] = 'You  can use any form of HTML to do this. You can customize a different style for each topic type';
$lang['locked'] = 'Locked Topic';
$lang['sticky'] = 'Sticky';
$lang['global'] = 'Global Announcement';
$lang['announce'] = 'Announcement';
$lang['current'] = 'Current';
$lang['current_explain'] = 'This is your current settings for this topic type. This is how it will be displayed on the forum.';
$lang['tag'] = 'Change the view';
$lang['tag_explain'] = 'Please do not use quotes or slashes in your html. Ex: &lt;font color=#FFFFFF&gt;Title&lt;/font&gt;';
$lang['topic_title'] = 'Topic Title';
$lang['moved'] = 'Moved';
$lang['topic_view_settings'] = 'Customized Topic View';
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
$lang['Initial_user_group'] = 'Initial User Group';
$lang['Initial_user_group_explain'] = 'Sets the Inital usergroup users are put in on signup';
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
$lang['hide_images'] = 'Hide Images to Guests';
$lang['hide_links'] = 'Hide Links to Guests';
$lang['hide_emails'] = 'Hide Email links to Guests';
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
$lang['dhtml_menu'] = 'Use DHTML on Forum Configuration.';
$lang['dhtml_menu_explain'] = 'Makes the Configuration Tables Collapse';
/*****[END]********************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
$lang['user_hide_images'] = 'Hide Images in Forums';
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
$lang['smilies_in_titles'] = 'Show Smilies in Topic Titles';
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
$lang['last_poster_avatar'] = 'Show Last Post Avatar on Index';
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
$lang['logs_view_level'][0] = 'Admins, Mods, Users, Anonymous';
$lang['logs_view_level'][1] = 'Admins, Mods, Users';
$lang['logs_view_level'][3] = 'Admins, Mods';
$lang['logs_view_level'][2] = 'Admins';
$lang['show_edited_logs'] = 'Show Topic Edit logs';
$lang['show_locked_logs'] = 'Show Topic Locked logs';
$lang['show_unlocked_logs'] = 'Show Topic Unlocked logs';
$lang['show_moved_logs'] = 'Show Topic Moved logs';
$lang['show_splitted_logs'] = 'Show Topic Splitted logs';
$lang['allow_logs_view'] = 'Show logs to';
/*****[END]********************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/
$lang['image_resize_width'] = 'Resize Image Width';
$lang['image_resize_height'] = 'Resize Image Height';
/*****[END]********************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
$lang['admin_style'] = 'Use your site theme\'s style for forum admin';
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
$lang['ADMIN_IP_LOCK'] = 'Admin IP Lock';
$lang['ADMIN_IP_LOCK_OFF'] = 'Disabled';
$lang['ADMIN_IP_LOCK_ON'] = 'Enabled';
/*****[END]********************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
$lang['user_posts'] = 'User Post Count';
/*****[END]********************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Display Poster Information Once    v2.0.0 ]
 ******************************************************/
$lang['once_settings'] = 'Show Once Per Post';
$lang['show_sig_once'] = 'Show sig once per post';
$lang['show_avatar_once'] = 'Show avatar once per post';
$lang['show_rank_once'] = 'Show rank once per post';
/*****[END]********************************************
 [ Mod:     Display Poster Information Once    v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Xdata                              v0.1.1 ]
 ******************************************************/
$lang['User_Permissions'] = 'User Permissions';
$lang['Group_Permissions'] = 'Group Permissions';
$lang['Manage_Fields'] = 'Manage Fields';
/*****[END]********************************************
 [ Mod:     Xdata                              v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [Mod:      Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
$lang['max_inbox'] = "Maximum Size of User's Private Message Inbox";
$lang['max_sentbox'] = "Maximum Size of User's Private Message Sentbox";
$lang['max_savebox'] = "Maximum Size of User's Private Message Savebox";
$lang['override_max'] = "Override Main Board Setting";
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

$lang['Login_page'] = 'Loginpage';
$lang['Login_page_explain'] = 'After Login, User is redirected to his Profile (Yes) or to Forum Index page (No)';

/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
$lang['group_count'] = 'Number of required posts';
$lang['group_count_max'] = 'Number of max posts';
$lang['group_count_updated'] = '%d member(s) have been removed, %d members are added to this group';
$lang['Group_count_enable'] = 'Users automatic added when posting';
$lang['Group_count_update'] = 'Add/Update new users';
$lang['Group_count_delete'] = 'Delete/Update old users';
$lang['User_allow_ag'] = "Activate Auto Group";
$lang['group_count_explain'] = 'When users have posted more posts than this value <i>(in any forum)</i> then they will be added to this usergroup<br/> This only applys if "'.$lang['Group_count_enable'].'" are enabled';
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
$lang['Forum_is_link'] = 'Change the forumtitle in a weblink';
$lang['Forum_weblink'] = 'Weblink ( inclusive HTTP:// )';
$lang['Forum_link_icon'] = 'Icon for this forum. This will replace the default icon in the forum index.<br />You can enter an image from your phpBB directories (without leading "/")<br />or an external link (Full path!).';
$lang['Forum_link_target'] = 'Link open a new window';
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 

/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/ 
$lang['Flags_title'] = 'Flag Administration';
$lang['Flags_explain'] = 'Using this form you can add, edit, view and delete flags. You can also create custom flags which can be applied to a user via the user management facility';

$lang['Add_new_flag'] = 'Add new flag';

$lang['Flag_name'] = 'Flag Name';
$lang['Flag_pic'] = 'Image';
$lang['Flag_image'] = 'Flag Image (in the images/flags/ directory)';
$lang['Flag_image_explain'] = 'Use this to define a small image associated with the flag';

$lang['Must_select_flag'] = 'You must select a flag';
$lang['Flag_updated'] = 'The flag was successfully updated';
$lang['Flag_added'] = 'The flag was successfully added';
$lang['Flag_removed'] = 'The flag was successfully deleted';
$lang['No_update_flags'] = 'The flag was successfully deleted. However, user accounts using this flag were not updated.  You will need to manually reset the flag on these accounts';

$lang['Flag_confirm'] = 'Delete Flag' ;
$lang['Confirm_delete_flag'] = 'Are you sure you want to remove the selected flag?' ;

$lang['Click_return_flagadmin'] = 'Click %sHere%s to return to Flag Administration';
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
$lang['Forum_icon'] = 'Forum icon';
/*****[END]********************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
$lang['Birthdays'] = 'Birthdays';
$lang['bday_show'] = 'Birthday Panel Visibility';
$lang['Unconditional'] = 'Unconditional';
$lang['Conditional'] = 'Conditional';
$lang['bday_show_explain'] = 'Determines whether or not the Birthday Panel on the main Index should be visible in the event that there are no birthdays or upcoming birthdays (unconditional = yes, conditional = no)';
$lang['bday_require'] = 'Require Date of Birth';
$lang['bday_require_explain'] = 'The year of birth will only be required if the "Require Year" option is selected';
$lang['bday_year'] = 'Require Year';
$lang['bday_year_explain'] = 'When this option is selected, users attempting to provide a date of birth will also need to provide a year of birth.';
$lang['bday_lock'] = 'Disallow Date of Birth Changes';
$lang['bday_lock_explain'] = 'Once entered, the date of birth cannot be changed, again.  Atleast when this option is selected.';
$lang['bday_lookahead'] = 'Number of Days to Look Ahead';
$lang['bday_lookahead_explain'] = 'Affects the Birthday Panel on the main Index.  Entering -1 will disable Birthday Lookahead';
$lang['bday_age_range'] = 'Allowable Age Range (in years)';
$lang['bday_hide'] = 'Hide Birthday Panel from Guests';
$lang['bday_send_greeting_admin_explain'] = 'Your members will choose either one or none of the options you enable.';
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
$lang['use_thank'] = 'Allow to Thank posts';
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
$lang['Reputation'] = 'Reputation';
$lang['Reputation_Config_Title'] = 'Reputation System Configuration';
$lang['Reputation_Config_Explain'] = 'Here you can set the options for Users Reputation System.';
$lang['Rep_config_updated'] = 'Reputation System config updated';
$lang['Click_return_rep_config'] = '%sReturn to Reputation System config%s';
$lang['Disable_rep'] = 'Disable Reputation System';
$lang['Graphic_version'] = 'Graphic version';
$lang['Show_stats_to_mods'] = 'Show the stats of given points only to administrators/moderators';
$lang['PM_notify'] = 'Notify users through PM when they receive new reputation points';
$lang['Posts_to_earn'] = 'Amount of posts to earn 1 reputation point (0 - to disable)';
$lang['Days_to_earn'] = 'Amount of days on forum to earn 1 reputation point (0 - to disable)';
$lang['Flood_control_time'] = 'Minimum amount of minutes between reputation givings by the same user (no use for admins and mods)';
$lang['Medal1_to_earn'] = 'Amount of reputation points to earn the 1st size medal';
$lang['Medal2_to_earn'] = 'Amount of reputation points to earn the 2nd size medal';
$lang['Medal3_to_earn'] = 'Amount of reputation points to earn the 3rd size medal';
$lang['Medal4_to_earn'] = 'Amount of reputation points to earn the 4th size medal';
$lang['Given_rep_to_earn'] = 'Amount of given reputation to earn 1 reputation point (0 - to disable)';
$lang['Repsum_limit'] = 'Limit of giving reputation points to a user (0 - no limits)';
$lang['Default_amount'] = 'Turn the simple version on and set the default amount of every giving to this number (0 - to disable)';
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/ 

/*****[BEGIN]*****************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/
$lang['ad_managment']  = 'Ad Management';
$lang['inline_ad_config']  = 'Inline Ad Config';
$lang['inline_ads']  = 'Inline Ads';
$lang['ad_code_about']  = 'This page lists current ads.  You may edit, delete or add new ads here.';
$lang['Click_return_firstpost'] = 'Click %sHere%s to return to Inline Ad Configuration';
$lang['Click_return_inline_code'] = 'Click %sHere%s to return to Inline Ad Code Configuration';
$lang['ad_after_post'] = 'Display Ad After x Post';
$lang['ad_every_post'] = 'Display Ad Every x Post';
$lang['ad_display'] = 'Display Ads To';
$lang['ad_all'] = 'All';
$lang['ad_reg'] = 'Registered Users';
$lang['ad_guest'] = 'Guests';
$lang['ad_exclude'] = 'Exclude These Groups (You may select multiple groups)';
$lang['ad_forums'] = 'Exclude These Forums (You may select multiplt forums)';
$lang['ad_code'] = 'Ad Code';
$lang['ad_style'] = 'Display Style';
$lang['ad_new_style'] = 'Ad looks like a special user post';
$lang['ad_old_style'] = 'Ad falls inline with the topic';
$lang['ad_post_threshold'] = 'Do not display if user has more than x posts (Leave blank to disable)';
$lang['ad_add']  = 'Add New Ad';
$lang['ad_name']  = 'Short name to identify ad';
$lang['exclude_none']  = 'Exclude None';
/*****[END]*******************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/

$lang['youtube_dimensions'] = 'YouTube Video Dimensions';
$lang['twitch_dimensions'] = 'Twitch Video Dimensions';
$lang['facebook_dimensions'] = 'Facebook Video Dimensions';

//
// That's all Folks!
// -------------------------------------------------

?>
