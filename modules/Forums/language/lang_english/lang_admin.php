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
$titanium_lang['General'] = 'General Admin';
$titanium_lang['Users'] = 'User Admin';
$titanium_lang['Groups'] = 'Group Admin';
$titanium_lang['Forums'] = 'Forum Admin';
/*****[BEGIN]******************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/
$titanium_lang['Faq_manager'] = 'FAQ Admin';
/*****[END]********************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/

$titanium_lang['Configuration'] = 'Configuration';
$titanium_lang['Permissions'] = 'Permissions';
$titanium_lang['Manage'] = 'Management';
$titanium_lang['Disallow'] = 'Disallow names';
$titanium_lang['Prune'] = 'Pruning';
$titanium_lang['Mass_Email'] = 'Mass Email';
$titanium_lang['Ranks'] = 'Ranks';
$titanium_lang['Smilies'] = 'Smilies';
$titanium_lang['Ban_Management'] = 'Ban Control';
$titanium_lang['Word_Censor'] = 'Word Censors';
$titanium_lang['Export'] = 'Export';
$titanium_lang['Create_new'] = 'Create';
$titanium_lang['Add_new'] = 'Add';
$titanium_lang['Backup_DB'] = 'Backup Database';
$titanium_lang['Restore_DB'] = 'Restore Database';
/*****[BEGIN]******************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/
$titanium_lang['board_faq'] = 'Board FAQ';
$titanium_lang['bbcode_faq'] = 'BBcode FAQ';
$titanium_lang['attachment_faq'] = 'Attachment FAQ';
$titanium_lang['prillian_faq'] = 'Prillian FAQ';
$titanium_lang['bid_faq'] = 'Buddy List FAQ';
/*****[END]********************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Board Rules                        v2.0.0 ]
 ******************************************************/
$titanium_lang['site_rules'] = 'Site Rules';
/*****[END]********************************************
 [ Mod:     Board Rules                        v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Rebuild Search                     v2.4.0 ]
 ******************************************************/
$titanium_lang['Rebuild_Search'] = 'Rebuild Search';
/*****[END]********************************************
 [ Mod:     Rebuild Search                     v2.4.0 ]
 ******************************************************/
//
// Index
//
$titanium_lang['Admin'] = 'Administration';
$titanium_lang['Not_admin'] = 'You are not authorized to administer this board';
$titanium_lang['Welcome_phpBB'] = 'Welcome to phpBB';
$titanium_lang['Admin_intro'] = 'Thank you for choosing phpBB as your forum solution. This screen will give you a quick overview of all the various statistics of your board. You can get back to this page by clicking on the <u>Admin [Forums]</u> link in the left pane. To return to the index of your board, click the <u>Forums Index</u> link or the phpBB logo also in the left pane. The other links on the left hand side of this screen will allow you to control every aspect of your forum experience. Each screen will have instructions on how to use the tools.';
$titanium_lang['Main_index'] = 'Forum Index';
$titanium_lang['Forum_stats'] = 'Forum Statistics';
$titanium_lang['Preview_forum'] = 'Preview Forum';
/*****[BEGIN]******************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/
$titanium_lang['Admin_Index'] = 'Admin [Forums]';
$titanium_lang['Admin_Nuke'] = 'Admin [Nuke-Evo]';
$titanium_lang['Home_Nuke'] = 'Home [Nuke-Evo]';
/*****[END]********************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/

$titanium_lang['Click_return_admin_index'] = 'Click %sHere%s to return to the Admin Index';

$titanium_lang['Statistic'] = 'Statistics';
$titanium_lang['Value'] = 'Value';
$titanium_lang['Number_posts'] = 'Number of posts';
$titanium_lang['Posts_per_day'] = 'Posts per day';
$titanium_lang['Number_topics'] = 'Number of topics';
$titanium_lang['Topics_per_day'] = 'Topics per day';
$titanium_lang['Number_users'] = 'Number of users';
$titanium_lang['Users_per_day'] = 'Users per day';
$titanium_lang['Board_started'] = 'Board started';
$titanium_lang['Avatar_dir_size'] = 'Avatar directory size';
$titanium_lang['Database_size'] = 'Database size';
$titanium_lang['Gzip_compression'] ='Gzip compression';
$titanium_lang['Not_available'] = 'Not available';

$titanium_lang['ON'] = 'ON'; // This is for GZip compression
$titanium_lang['OFF'] = 'OFF';

//
// DB Utils
//
$titanium_lang['Database_Utilities'] = 'Database Utilities';

$titanium_lang['Restore'] = 'Restore';
$titanium_lang['Backup'] = 'Backup';
$titanium_lang['Restore_explain'] = 'This will perform a full restore of all phpBB tables from a saved file. If your server supports it, you may upload a gzip-compressed text file and it will automatically be decompressed. <strong>WARNING</strong>: This will overwrite any existing data. The restore may take a long time to process, so please do not move from this page until it is complete.';
$titanium_lang['Backup_explain'] = 'Here you can back up all your phpBB-related data. If you have any additional custom tables in the same database with phpBB that you would like to back up as well, please enter their names, separated by commas, in the Additional Tables textbox below. If your server supports it you may also gzip-compress the file to reduce its size before download.';

$titanium_lang['Backup_options'] = 'Backup options';
$titanium_lang['Start_backup'] = 'Start Backup';
$titanium_lang['Full_backup'] = 'Full backup';
$titanium_lang['Structure_backup'] = 'Structure-Only backup';
$titanium_lang['Data_backup'] = 'Data only backup';
$titanium_lang['Additional_tables'] = 'Additional tables';
$titanium_lang['Gzip_compress'] = 'Gzip compress file';
$titanium_lang['Select_file'] = 'Select a file';
$titanium_lang['Start_Restore'] = 'Start Restore';

$titanium_lang['Restore_success'] = 'The Database has been successfully restored.<br /><br />Your board should be back to the state it was when the backup was made.';
$titanium_lang['Backup_download'] = 'Your download will start shortly; please wait until it begins.';
$titanium_lang['Backups_not_supported'] = 'Sorry, but database backups are not currently supported for your database system.';

$titanium_lang['Restore_Error_uploading'] = 'Error in uploading the backup file';
$titanium_lang['Restore_Error_filename'] = 'Filename problem; please try an alternative file';
$titanium_lang['Restore_Error_decompress'] = 'Cannot decompress a gzip file; please upload a plain text version';
$titanium_lang['Restore_Error_no_file'] = 'No file was uploaded';

//
// Auth pages
//
$titanium_lang['Select_a_User'] = 'Select a User';
$titanium_lang['Select_a_Group'] = 'Select a Group';
$titanium_lang['Select_a_Forum'] = 'Select a Forum';
$titanium_lang['Auth_Control_User'] = 'User Permissions Control';
$titanium_lang['Auth_Control_Group'] = 'Group Permissions Control';
$titanium_lang['Auth_Control_Forum'] = 'Forum Permissions Control';
$titanium_lang['Look_up_User'] = 'Look up User';
$titanium_lang['Look_up_Group'] = 'Look up Group';
$titanium_lang['Look_up_Forum'] = 'Look up Forum';

$titanium_lang['Group_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each user group. Do not forget when changing group permissions that individual user permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$titanium_lang['User_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each individual user. Do not forget when changing user permissions that group permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$titanium_lang['Forum_auth_explain'] = 'Here you can alter the authorisation levels of each forum. You will have both a simple and advanced method for doing this, where advanced offers greater control of each forum operation. Remember that changing the permission level of forums will affect which users can carry out the various operations within them.';
/*****[BEGIN]******************************************
 [ Mod:  Overall Forums Permission Interactive v1.0.0 ]
 ******************************************************/
$titanium_lang['Forum_auth_explain_overall'] = 'Here you can alter the authorisation levels of each forum. Remember that changing the permission level of forums will affect which users can carry out the various operations within them.';
$titanium_lang['Forum_auth_explain_overall_edit'] = 'First click on the swatch in the key, then click on the forum swatch you want to change. Use "restore" to undo changes. Use "stop editing" to turn off further editing.';
$titanium_lang['Forum_auth_overall_restore'] = 'Restore Original';
$titanium_lang['Forum_auth_overall_stop'] = 'Stop Editing';
/*****[END]********************************************
 [ Mod:  Overall Forums Permission Interactive v1.0.0 ]
 ******************************************************/
$titanium_lang['Simple_mode'] = 'Simple Mode';
$titanium_lang['Advanced_mode'] = 'Advanced Mode';
$titanium_lang['Moderator_status'] = 'Moderator status';

$titanium_lang['Allowed_Access'] = 'Allowed Access';
$titanium_lang['Disallowed_Access'] = 'Disallowed Access';
$titanium_lang['Is_Moderator'] = 'Is Moderator';
$titanium_lang['Not_Moderator'] = 'Not Moderator';

$titanium_lang['Conflict_warning'] = 'Authorization Conflict Warning';
$titanium_lang['Conflict_access_userauth'] = 'This user still has access rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having access rights. The groups granting rights (and the forums involved) are noted below.';
$titanium_lang['Conflict_mod_userauth'] = 'This user still has moderator rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having moderator rights. The groups granting rights (and the forums involved) are noted below.';

$titanium_lang['Conflict_access_groupauth'] = 'The following user (or users) still have access rights to this forum via their user permission settings. You may want to alter the user permissions to fully prevent them having access rights. The users granted rights (and the forums involved) are noted below.';
$titanium_lang['Conflict_mod_groupauth'] = 'The following user (or users) still have moderator rights to this forum via their user permissions settings. You may want to alter the user permissions to fully prevent them having moderator rights. The users granted rights (and the forums involved) are noted below.';

$titanium_lang['Public'] = 'Public';
$titanium_lang['Private'] = 'Private';
$titanium_lang['Registered'] = 'Registered';
$titanium_lang['Administrators'] = 'Administrators';
$titanium_lang['Hidden'] = 'Hidden';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$titanium_lang['Forum_ALL'] = 'ALL';
$titanium_lang['Forum_REG'] = 'REG';
$titanium_lang['Forum_PRIVATE'] = 'PRIVATE';
$titanium_lang['Forum_MOD'] = 'MOD';
$titanium_lang['Forum_ADMIN'] = 'ADMIN';

$titanium_lang['View'] = 'View';
$titanium_lang['Read'] = 'Read';
$titanium_lang['Post'] = 'Post';
$titanium_lang['Reply'] = 'Reply';
$titanium_lang['Edit'] = 'Edit';
$titanium_lang['Delete'] = 'Delete';
$titanium_lang['Sticky'] = 'Sticky';
$titanium_lang['Announce'] = 'Announce';
$titanium_lang['Vote'] = 'Vote';
$titanium_lang['Pollcreate'] = 'Poll create';

$titanium_lang['Permissions'] = 'Permissions';
$titanium_lang['Simple_Permission'] = 'Simple Permissions';

$titanium_lang['User_Level'] = 'User Level';
$titanium_lang['Auth_User'] = 'User';
$titanium_lang['Auth_Admin'] = 'Administrator';
$titanium_lang['Group_memberships'] = 'Usergroup memberships';
$titanium_lang['Usergroup_members'] = 'This group has the following members';

$titanium_lang['Forum_auth_updated'] = 'Forum permissions updated';
$titanium_lang['User_auth_updated'] = 'User permissions updated';
$titanium_lang['Group_auth_updated'] = 'Group permissions updated';

$titanium_lang['Auth_updated'] = 'Permissions have been updated';
$titanium_lang['Click_return_userauth'] = 'Click %sHere%s to return to User Permissions';
$titanium_lang['Click_return_groupauth'] = 'Click %sHere%s to return to Group Permissions';
$titanium_lang['Click_return_forumauth'] = 'Click %sHere%s to return to Forum Permissions';

//
// Banning
//
$titanium_lang['Ban_control'] = 'Ban Control';
$titanium_lang['Ban_explain'] = 'Here you can control the banning of users. You can achieve this by banning either or both of a specific user or an individual or range of IP addresses or hostnames. These methods prevent a user from even reaching the index page of your board. To prevent a user from registering under a different username you can also specify a banned email address. Please note that banning an email address alone will not prevent that user from being able to log on or post to your board. You should use one of the first two methods to achieve this.';
$titanium_lang['Ban_explain_warn'] = 'Please note that entering a range of IP addresses results in all the addresses between the start and end being added to the banlist. Attempts will be made to minimise the number of addresses added to the database by introducing wildcards automatically where appropriate. If you really must enter a range, try to keep it small or better yet state specific addresses.';

$titanium_lang['Select_username'] = 'Select a Username';
$titanium_lang['Select_ip'] = 'Select an IP address';
$titanium_lang['Select_email'] = 'Select an Email address';

$titanium_lang['Ban_username'] = 'Ban one or more specific users';
$titanium_lang['Ban_username_explain'] = 'You can ban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$titanium_lang['Ban_IP'] = 'Ban one or more IP addresses or hostnames';
$titanium_lang['IP_hostname'] = 'IP addresses or hostnames';
$titanium_lang['Ban_IP_explain'] = 'To specify several different IP addresses or hostnames separate them with commas. To specify a range of IP addresses, separate the start and end with a hyphen (-); to specify a wildcard, use an asterisk (*).';

$titanium_lang['Ban_email'] = 'Ban one or more email addresses';
$titanium_lang['Ban_email_explain'] = 'To specify more than one email address, separate them with commas. To specify a wildcard username, use * like *@hotmail.com';

$titanium_lang['Unban_username'] = 'Un-ban one or more specific users';
$titanium_lang['Unban_username_explain'] = 'You can unban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$titanium_lang['Unban_IP'] = 'Un-ban one or more IP addresses';
$titanium_lang['Unban_IP_explain'] = 'You can unban multiple IP addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$titanium_lang['Unban_email'] = 'Un-ban one or more email addresses';
$titanium_lang['Unban_email_explain'] = 'You can unban multiple email addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$titanium_lang['No_banned_users'] = 'No banned usernames';
$titanium_lang['No_banned_ip'] = 'No banned IP addresses';
$titanium_lang['No_banned_email'] = 'No banned email addresses';

$titanium_lang['Ban_update_sucessful'] = 'The banlist has been updated successfully';
$titanium_lang['Click_return_banadmin'] = 'Click %sHere%s to return to Ban Control';

//
// Configuration
//
$titanium_lang['General_Config'] = 'General Configuration';
$titanium_lang['Config_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side.';

$titanium_lang['Click_return_config'] = 'Click %sHere%s to return to General Configuration';

$titanium_lang['General_settings'] = 'General Board Settings';
$titanium_lang['Server_name'] = 'Domain Name';
$titanium_lang['Server_name_explain'] = 'The domain name from which this board runs';
$titanium_lang['Script_path'] = 'Script path';
$titanium_lang['Script_path_explain'] = 'The path where phpBB2 is located relative to the domain name';
$titanium_lang['Server_port'] = 'Server Port';
$titanium_lang['Server_port_explain'] = 'The port your server is running on, usually 80. Only change if different';
$titanium_lang['Site_name'] = 'Site name';
$titanium_lang['Site_desc'] = 'Site description';
/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
$titanium_lang['Global_title'] = 'Global announcement title'; 
$titanium_lang['Global_title_explain'] = 'Enter a different title for the announcement if the default "Global Announcement" is not suitable.'; 
$titanium_lang['Global'] = 'Global Announcement'; 
$titanium_lang['Global_explain'] = 'Enter the special announcement you want displayed on your forums main index page here.'; 
$titanium_lang['Enable_global'] = 'Enable Global Announcement'; 
$titanium_lang['Enable_global_explain'] = 'If you enable this, a global announcement will be displayed on your main index page.'; 
$titanium_lang['Global_marquee_effect'] = 'Enable the scrolling global announcement effect'; 
$titanium_lang['Global_marquee_effect_explain'] = 'If you enable this, your global announcement will scroll on the main index.'; 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/
$titanium_lang['Board_disable'] = 'Disable board';
$titanium_lang['Board_disable_explain'] = 'This will make the board unavailable to users. Administrators are able to access the Administration Panel while the board is disabled.';
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
$titanium_lang['Board_disable_msg'] = 'Disable board message';
$titanium_lang['Board_disable_msg_explain'] = 'This text will be showed if "Disable board" is on "Yes".';
/*****[END]********************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
$titanium_lang['Acct_activation'] = 'Enable account activation';
$titanium_lang['Acc_None'] = 'None'; // These three entries are the type of activation
$titanium_lang['Acc_User'] = 'User';
$titanium_lang['Acc_Admin'] = 'Admin';

$titanium_lang['Abilities_settings'] = 'User and Forum Basic Settings';
$titanium_lang['Max_poll_options'] = 'Max number of poll options';
$titanium_lang['Flood_Interval'] = 'Flood Interval';
$titanium_lang['Flood_Interval_explain'] = 'Number of seconds a user must wait between posts';
$titanium_lang['Board_email_form'] = 'User email via board';
$titanium_lang['Board_email_form_explain'] = 'Users send email to each other via this board';
$titanium_lang['Topics_per_page'] = 'Topics Per Page';
$titanium_lang['Posts_per_page'] = 'Posts Per Page';
$titanium_lang['Hot_threshold'] = 'Posts for Popular Threshold';
$titanium_lang['Default_style'] = 'Default Theme';
$titanium_lang['Override_style'] = 'Override user style';
$titanium_lang['Override_style_explain'] = 'Replaces users style with the default';
$titanium_lang['Default_language'] = 'Default Language';
$titanium_lang['Date_format'] = 'Date Format';
$titanium_lang['System_timezone'] = 'System Timezone';
$titanium_lang['Enable_gzip'] = 'Enable GZip Compression';
$titanium_lang['Enable_prune'] = 'Enable Forum Pruning';
$titanium_lang['Allow_HTML'] = 'Allow HTML';
$titanium_lang['Allow_BBCode'] = 'Allow BBCode';
$titanium_lang['Allowed_tags'] = 'Allowed HTML tags';
$titanium_lang['Allowed_tags_explain'] = 'Separate tags with commas';
$titanium_lang['Allow_smilies'] = 'Allow Smilies';
$titanium_lang['Smilies_path'] = 'Smilies Storage Path';
$titanium_lang['Smilies_path_explain'] = 'Path under your phpBB root dir, e.g. modules/Forums/images/smiles';
$titanium_lang['Allow_sig'] = 'Allow Signatures';
$titanium_lang['Max_sig_length'] = 'Maximum signature length';
$titanium_lang['Max_sig_length_explain'] = 'Maximum number of characters in user signatures';
$titanium_lang['Allow_name_change'] = 'Allow Username changes';

$titanium_lang['Avatar_settings'] = 'Avatar Settings';
$titanium_lang['Allow_local'] = 'Enable gallery avatars';
$titanium_lang['Allow_remote'] = 'Enable remote avatars';
$titanium_lang['Allow_remote_explain'] = 'Avatars linked to from another website';
$titanium_lang['Allow_upload'] = 'Enable avatar uploading';
$titanium_lang['Max_filesize'] = 'Maximum Avatar File Size';
$titanium_lang['Max_filesize_explain'] = 'For uploaded avatar files';
$titanium_lang['Max_avatar_size'] = 'Maximum Avatar Dimensions';
$titanium_lang['Max_avatar_size_explain'] = '(Height x Width in pixels)';
$titanium_lang['Avatar_storage_path'] = 'Avatar Storage Path';
$titanium_lang['Avatar_storage_path_explain'] = 'Path under your phpBB root dir, e.g. modules/Forums/images/avatars';
$titanium_lang['Avatar_gallery_path'] = 'Avatar Gallery Path';
$titanium_lang['Avatar_gallery_path_explain'] = 'Path under your phpBB root dir for pre-loaded images, e.g. modules/Forums/images/avatars/gallery';

$titanium_lang['COPPA_settings'] = 'COPPA Settings';
$titanium_lang['COPPA_fax'] = 'COPPA Fax Number';
$titanium_lang['COPPA_mail'] = 'COPPA Mailing Address';
$titanium_lang['COPPA_mail_explain'] = 'This is the mailing address to which parents will send COPPA registration forms';

$titanium_lang['Email_settings'] = 'Email Settings';
$titanium_lang['Admin_email'] = 'Admin Email Address';
$titanium_lang['Email_sig'] = 'Email Signature';
$titanium_lang['Email_sig_explain'] = 'This text will be attached to all emails the board sends';
$titanium_lang['Use_SMTP'] = 'Use SMTP Server for email';
$titanium_lang['Use_SMTP_explain'] = 'Say yes if you want or have to send email via a named server instead of the local mail function';
$titanium_lang['SMTP_server'] = 'SMTP Host';

$titanium_lang['SMTP_encryption'] = 'Encryption';
$titanium_lang['SMTP_encryption_explain'] = 'For most servers TLS is the recommended option.<br /><br />If your SMTP provider offers both SSL and TLS options, we recommend using TLS.';

$titanium_lang['SMTP_port'] = 'SMTP Port';

$titanium_lang['SMPT_Authentication'] = 'Authentication';

$titanium_lang['SMTP_username'] = 'SMTP Username';
$titanium_lang['SMTP_username_explain'] = 'Only enter a username if your SMTP server requires it';
$titanium_lang['SMTP_password'] = 'SMTP Password';
$titanium_lang['SMTP_password_explain'] = 'The password is stored in plain text. We highly recommend you setup your password in your configuration file for improved security; to do this add the lines below to your config.php file.
<br /><br />define( \'SMTP_Password\', \'your_password\' );';

$titanium_lang['Disable_privmsg'] = 'Private Messaging';
$titanium_lang['Inbox_limits'] = 'Max posts in Inbox';
$titanium_lang['Sentbox_limits'] = 'Max posts in Sentbox';
$titanium_lang['Savebox_limits'] = 'Max posts in Savebox';

$titanium_lang['Cookie_settings'] = 'Cookie settings';
$titanium_lang['Cookie_settings_explain'] = 'These details define how cookies are sent to your users\' browsers. In most cases the default values for the cookie settings should be sufficient, but if you need to change them do so with care -- incorrect settings can prevent users from logging in';
$titanium_lang['Cookie_domain'] = 'Cookie domain';
$titanium_lang['Cookie_name'] = 'Cookie name';
$titanium_lang['Cookie_path'] = 'Cookie path';
$titanium_lang['Cookie_secure'] = 'Cookie secure';
$titanium_lang['Cookie_secure_explain'] = 'If your server is running via SSL, set this to enabled, else leave as disabled';
$titanium_lang['Session_length'] = 'Session length [ seconds ]';

// Visual Confirmation
$titanium_lang['Visual_confirm'] = 'Enable Visual Confirmation';
$titanium_lang['Visual_confirm_explain'] = 'Requires users enter a code defined by an image when registering.';

// Autologin Keys - added 2.0.18
$titanium_lang['Allow_autologin'] = 'Allow automatic logins';
$titanium_lang['Allow_autologin_explain'] = 'Determines whether users are allowed to select to be automatically logged in when visiting the forum';
$titanium_lang['Autologin_time'] = 'Automatic login key expiry';
$titanium_lang['Autologin_time_explain'] = 'How long a autologin key is valid for in days if the user does not visit the board. Set to zero to disable expiry.';
// Search Flood Control - added 2.0.20
$titanium_lang['Search_Flood_Interval'] = 'Search Flood Interval';
$titanium_lang['Search_Flood_Interval_explain'] = 'Number of seconds a user must wait between search requests';
$titanium_lang['Stylesheet_explain'] = 'Filename for CSS stylesheet to use for this theme.';

//
// Login attempts configuration
//
$titanium_lang['Max_login_attempts'] = 'Allowed login attempts';
$titanium_lang['Max_login_attempts_explain'] = 'The number of allowed board login attempts.';
$titanium_lang['Login_reset_time'] = 'Login lock time';
$titanium_lang['Login_reset_time_explain'] = 'Time in minutes the user have to wait until he is allowed to login again after exceeding the number of allowed login attempts.';

//
// Forum Management
//
$titanium_lang['Forum_admin'] = 'Forum Administration';
$titanium_lang['Forum_admin_explain'] = 'From this panel you can add, delete, edit, re-order and re-synchronise categories and forums';
$titanium_lang['Edit_forum'] = 'Edit forum';
$titanium_lang['Create_forum'] = 'Create new forum';
$titanium_lang['Create_category'] = 'Create new category';
$titanium_lang['Remove'] = 'Remove';
$titanium_lang['Action'] = 'Action';
$titanium_lang['Update_order'] = 'Update Order';
$titanium_lang['Config_updated'] = 'Forum Configuration Updated Successfully';
$titanium_lang['Edit'] = 'Edit';
$titanium_lang['Delete'] = 'Delete';
$titanium_lang['Move_up'] = 'Move up';
$titanium_lang['Move_down'] = 'Move down';
$titanium_lang['Resync'] = 'Resync';
$titanium_lang['No_mode'] = 'No mode was set';
$titanium_lang['Forum_edit_delete_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side';

/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
$titanium_lang['Forum_color'] = 'Set a color for the forum title';
$titanium_lang['Forum_color_explain'] = 'Leave this field blank to use the default color. Just enter the color number without leading \'#\'!';
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/

$titanium_lang['Move_contents'] = 'Move all contents';
$titanium_lang['Forum_delete'] = 'Delete Forum';
$titanium_lang['Forum_delete_explain'] = 'The form below will allow you to delete a forum (or category) and decide where you want to put all topics (or forums) it contained.';

$titanium_lang['Status_locked'] = 'Locked';
$titanium_lang['Status_unlocked'] = 'Unlocked';
$titanium_lang['Forum_settings'] = 'General Forum Settings';
$titanium_lang['Forum_name'] = 'Forum name';
$titanium_lang['Forum_desc'] = 'Description';
$titanium_lang['Forum_status'] = 'Forum status';
$titanium_lang['Forum_pruning'] = 'Auto-pruning';

$titanium_lang['prune_freq'] = 'Check for topic age every';
$titanium_lang['prune_days'] = 'Remove topics that have not been posted to in';
$titanium_lang['Set_prune_data'] = 'You have turned on auto-prune for this forum but did not set a frequency or number of days to prune. Please go back and do so.';

$titanium_lang['Move_and_Delete'] = 'Move and Delete';

$titanium_lang['Delete_all_posts'] = 'Delete all posts';
$titanium_lang['Nowhere_to_move'] = 'Nowhere to move to';

$titanium_lang['Edit_Category'] = 'Edit Category';
$titanium_lang['Edit_Category_explain'] = 'Use this form to modify a category\'s name.';

$titanium_lang['Forums_updated'] = 'Forum and Category information updated successfully';

$titanium_lang['Must_delete_forums'] = 'You need to delete all forums before you can delete this category';

$titanium_lang['Click_return_forumadmin'] = 'Click %sHere%s to return to Forum Administration';

//
// Smiley Management
//
$titanium_lang['smiley_title'] = 'Smiles Editing Utility';
$titanium_lang['smile_desc'] = 'From this page you can add, remove and edit the emoticons or smileys that your users can use in their posts and private messages.';

$titanium_lang['smiley_config'] = 'Smiley Configuration';
$titanium_lang['smiley_code'] = 'Smiley Code';
$titanium_lang['smiley_url'] = 'Smiley Image File';
$titanium_lang['smiley_emot'] = 'Smiley Emotion';
$titanium_lang['smile_add'] = 'Add a new Smiley';
$titanium_lang['Smile'] = 'Smile';
$titanium_lang['Emotion'] = 'Emotion';

$titanium_lang['Select_pak'] = 'Select Pack (.pak) File';
$titanium_lang['replace_existing'] = 'Replace Existing Smiley';
$titanium_lang['keep_existing'] = 'Keep Existing Smiley';
$titanium_lang['smiley_import_inst'] = 'You should unzip the smiley package and upload all files to the appropriate Smiley directory for your installation. Then select the correct information in this form to import the smiley pack.';
$titanium_lang['smiley_import'] = 'Smiley Pack Import';
$titanium_lang['choose_smile_pak'] = 'Choose a Smile Pack .pak file';
$titanium_lang['import'] = 'Import Smileys';
$titanium_lang['smile_conflicts'] = 'What should be done in case of conflicts';
$titanium_lang['del_existing_smileys'] = 'Delete existing smileys before import';
$titanium_lang['import_smile_pack'] = 'Import Smiley Pack';
$titanium_lang['export_smile_pack'] = 'Create Smiley Pack';
$titanium_lang['export_smiles'] = 'To create a smiley pack from your currently installed smileys, click %sHere%s to download the smiles.pak file. Name this file appropriately making sure to keep the .pak file extension.  Then create a zip file containing all of your smiley images plus this .pak configuration file.';

$titanium_lang['smiley_add_success'] = 'The Smiley was successfully added';
$titanium_lang['smiley_edit_success'] = 'The Smiley was successfully updated';
$titanium_lang['smiley_import_success'] = 'The Smiley Pack was imported successfully!';
$titanium_lang['smiley_del_success'] = 'The Smiley was successfully removed';
$titanium_lang['Click_return_smileadmin'] = 'Click %sHere%s to return to Smiley Administration';
$titanium_lang['Confirm_delete_smiley'] = 'Are you sure you want to delete this Smiley?';

//
// User Management
//
$titanium_lang['User_admin'] = 'User Administration';
$titanium_lang['User_admin_explain'] = 'Here you can change your users\' information and certain options. To modify the users\' permissions, please use the user and group permissions system.';

$titanium_lang['Look_up_user'] = 'Look up user';

$titanium_lang['Admin_user_fail'] = 'Couldn\'t update the user\'s profile.';
$titanium_lang['Admin_user_updated'] = 'The user\'s profile was successfully updated.';
$titanium_lang['Click_return_useradmin'] = 'Click %sHere%s to return to User Administration';

$titanium_lang['User_delete'] = 'Delete this user';
$titanium_lang['User_delete_explain'] = 'Click here to delete this user; this cannot be undone.';
$titanium_lang['User_deleted'] = 'User was successfully deleted.';

$titanium_lang['User_status'] = 'User is active';
$titanium_lang['User_allowpm'] = 'Can send Private Messages';
$titanium_lang['User_allowavatar'] = 'Can display avatar';

$titanium_lang['Admin_avatar_explain'] = 'Here you can see and delete the user\'s current avatar.';

$titanium_lang['User_special'] = 'Special admin-only fields';
$titanium_lang['User_special_explain'] = 'These fields are not able to be modified by the users.  Here you can set their status and other options that are not given to users.';

//
// Group Management
//
$titanium_lang['Group_administration'] = 'Group Administration';
$titanium_lang['Group_admin_explain'] = 'From this panel you can administer all your usergroups. You can delete, create and edit existing groups. You may choose moderators, toggle open/closed group status and set the group name and description';
$titanium_lang['Error_updating_groups'] = 'There was an error while updating the groups';
$titanium_lang['Updated_group'] = 'The group was successfully updated';
$titanium_lang['Added_new_group'] = 'The new group was successfully created';
$titanium_lang['Deleted_group'] = 'The group was successfully deleted';
$titanium_lang['New_group'] = 'Create new group';
$titanium_lang['Edit_group'] = 'Edit group';
$titanium_lang['group_name'] = 'Group name';
$titanium_lang['group_description'] = 'Group description';
$titanium_lang['group_moderator'] = 'Group moderator';
$titanium_lang['group_status'] = 'Group status';
$titanium_lang['group_open'] = 'Open group';
$titanium_lang['group_closed'] = 'Closed group';
$titanium_lang['group_hidden'] = 'Hidden group';
$titanium_lang['group_delete'] = 'Delete group';
$titanium_lang['group_delete_check'] = 'Delete this group';
$titanium_lang['submit_group_changes'] = 'Submit Changes';
$titanium_lang['reset_group_changes'] = 'Reset Changes';
$titanium_lang['No_group_name'] = 'You must specify a name for this group';
$titanium_lang['No_group_moderator'] = 'You must specify a moderator for this group';
$titanium_lang['No_group_mode'] = 'You must specify a mode for this group, open or closed';
$titanium_lang['No_group_action'] = 'No action was specified';
$titanium_lang['delete_group_moderator'] = 'Delete the old group moderator?';
$titanium_lang['delete_moderator_explain'] = 'If you\'re changing the group moderator, check this box to remove the old moderator from the group.  Otherwise, do not check it, and the user will become a regular member of the group.';
$titanium_lang['Click_return_groupsadmin'] = 'Click %sHere%s to return to Group Administration.';
$titanium_lang['Select_group'] = 'Select a group';
$titanium_lang['Look_up_group'] = 'Look up group';

//
// Prune Administration
//
$titanium_lang['Forum_Prune'] = 'Forum Prune';
$titanium_lang['Forum_Prune_explain'] = 'This will delete any topic which has not been posted to within the number of days you select. If you do not enter a number then all topics will be deleted. It will not remove topics in which polls are still running nor will it remove announcements. You will need to remove those topics manually.';
$titanium_lang['Do_Prune'] = 'Do Prune';
$titanium_lang['All_Forums'] = 'All Forums';
$titanium_lang['Prune_topics_not_posted'] = 'Prune topics with no replies in this many days';
$titanium_lang['Topics_pruned'] = 'Topics pruned';
$titanium_lang['Posts_pruned'] = 'Posts pruned';
$titanium_lang['Prune_success'] = 'Pruning of forums was successful';

//
// Word censor
//
$titanium_lang['Words_title'] = 'Word Censoring';
$titanium_lang['Words_explain'] = 'From this control panel you can add, edit, and remove words that will be automatically censored on your forums. In addition people will not be allowed to register with usernames containing these words. Wildcards (*) are accepted in the word field. For example, *test* will match detestable, test* would match testing, *test would match detest.';
$titanium_lang['Word'] = 'Word';
$titanium_lang['Edit_word_censor'] = 'Edit word censor';
$titanium_lang['Replacement'] = 'Replacement';
$titanium_lang['Add_new_word'] = 'Add new word';
$titanium_lang['Update_word'] = 'Update word censor';

$titanium_lang['Must_enter_word'] = 'You must enter a word and its replacement';
$titanium_lang['No_word_selected'] = 'No word selected for editing';

$titanium_lang['Word_updated'] = 'The selected word censor has been successfully updated';
$titanium_lang['Word_added'] = 'The word censor has been successfully added';
$titanium_lang['Word_removed'] = 'The selected word censor has been successfully removed';

$titanium_lang['Click_return_wordadmin'] = 'Click %sHere%s to return to Word Censor Administration';
$titanium_lang['Confirm_delete_word'] = 'Are you sure you want to delete this word censor?';

//
// Mass Email
//
$titanium_lang['Mass_email_explain'] = 'Here you can email a message to either all of your users or all users of a specific group.  To do this, an email will be sent out to the administrative email address supplied, with a blind carbon copy sent to all recipients. If you are emailing a large group of people please be patient after submitting and do not stop the page halfway through. It is normal for a mass emailing to take a long time and you will be notified when the script has completed';
$titanium_lang['Compose'] = 'Compose';

$titanium_lang['Recipients'] = 'Recipients';
$titanium_lang['All_users'] = 'All Users';

$titanium_lang['Email_successfull'] = 'Your message has been sent';
$titanium_lang['Click_return_massemail'] = 'Click %sHere%s to return to the Mass Email form';

//
// Ranks admin
//
$titanium_lang['Ranks_title'] = 'Rank Administration';
$titanium_lang['Ranks_explain'] = 'Using this form you can add, edit, view and delete ranks. You can also create custom ranks which can be applied to a user via the user management facility';

$titanium_lang['Add_new_rank'] = 'Add new rank';

$titanium_lang['Rank_title'] = 'Rank Title';
$titanium_lang['Rank_special'] = 'Set as Special Rank';
$titanium_lang['Rank_minimum'] = 'Minimum Posts';
$titanium_lang['Rank_maximum'] = 'Maximum Posts';
$titanium_lang['Rank_image'] = 'Rank Image (Relative to phpBB2 root path)';
$titanium_lang['Rank_image_explain'] = 'Use this to define a small image associated with the rank';

$titanium_lang['Must_select_rank'] = 'You must select a rank';
$titanium_lang['No_assigned_rank'] = 'No special rank assigned';

$titanium_lang['Rank_updated'] = 'The rank was successfully updated';
$titanium_lang['Rank_added'] = 'The rank was successfully added';
$titanium_lang['Rank_removed'] = 'The rank was successfully deleted';
$titanium_lang['No_update_ranks'] = 'The rank was successfully deleted. However, user accounts using this rank were not updated.  You will need to manually reset the rank on these accounts';

$titanium_lang['Click_return_rankadmin'] = 'Click %sHere%s to return to Rank Administration';
$titanium_lang['Confirm_delete_rank'] = 'Are you sure you want to delete this rank?';

//
// Disallow Username Admin
//
$titanium_lang['Disallow_control'] = 'Username Disallow Control';
$titanium_lang['Disallow_explain'] = 'Here you can control usernames which will not be allowed to be used.  Disallowed usernames are allowed to contain a wildcard character of *.  Please note that you will not be allowed to specify any username that has already been registered. You must first delete that name then disallow it.';

$titanium_lang['Delete_disallow'] = 'Delete';
$titanium_lang['Delete_disallow_title'] = 'Remove a Disallowed Username';
$titanium_lang['Delete_disallow_explain'] = 'You can remove a disallowed username by selecting the username from this list and clicking delete';

$titanium_lang['Add_disallow'] = 'Add';
$titanium_lang['Add_disallow_title'] = 'Add a disallowed username';
$titanium_lang['Add_disallow_explain'] = 'You can disallow a username using the wildcard character * to match any character';

$titanium_lang['No_disallowed'] = 'No Disallowed Usernames';

$titanium_lang['Disallowed_deleted'] = 'The disallowed username has been successfully removed';
$titanium_lang['Disallow_successful'] = 'The disallowed username has been successfully added';
$titanium_lang['Disallowed_already'] = 'The name you entered could not be disallowed. It either already exists in the list, exists in the word censor list, or a matching username is present.';

$titanium_lang['Click_return_disallowadmin'] = 'Click %sHere%s to return to Disallow Username Administration';

$titanium_lang['Install'] = 'Install';
$titanium_lang['Upgrade'] = 'Upgrade';

$titanium_lang['Install_No_PCRE'] = 'phpBB2 Requires the Perl-Compatible Regular Expressions Module for PHP which your PHP configuration doesn\'t appear to support!';

$titanium_lang['theme'] = 'Theme';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$titanium_lang['wrap_title'] = 'Force Word Wrapping';
$titanium_lang['wrap_enable'] = 'Force Word Wrapping';
$titanium_lang['wrap_min'] = 'Minimum Screen Width';
$titanium_lang['wrap_max'] = 'Maximum Screen Width';
$titanium_lang['wrap_def'] = 'Default Screen Width';
$titanium_lang['wrap_units'] = 'characters';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/

//
// Version Check
//
$titanium_lang['Version_up_to_date'] = 'Your installation is up to date, no updates are available for your version of phpBB.';
$titanium_lang['Version_not_up_to_date'] = 'Your installation does <strong>not</strong> seem to be up to date. Updates are available for your version of phpBB.';
$titanium_lang['Latest_version_info'] = 'The latest available version is <strong>phpBB %s</strong>. ';
$titanium_lang['Current_version_info'] = 'You are running <strong>phpBB %s</strong>.';
$titanium_lang['Connect_socket_error'] = 'Unable to open connection to phpBB Server, reported error is:<br />%s';
$titanium_lang['Socket_functions_disabled'] = 'Unable to use socket functions.';
$titanium_lang['Mailing_list_subscribe_reminder'] = 'For the latest information on updates to phpBB, why not <a href="http://www.phpbb.com/support/" target="_new">subscribe to our mailing list</a>.';
$titanium_lang['Version_information'] = 'Version Information';

/*****[BEGIN]******************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
$titanium_lang['Board_statistic'] = 'Board statistics';
$titanium_lang['Database_statistic'] = 'Database statistics';
$titanium_lang['Version_info'] = 'Version information';
$titanium_lang['Thereof_deactivated_users'] = 'Number of non-active members';
$titanium_lang['Thereof_Moderators'] = 'Number of Moderators';
$titanium_lang['Thereof_Administrators'] = 'Number of Administrators';
$titanium_lang['Deactivated_Users'] = 'Members in need of Activation';
$titanium_lang['Users_with_Admin_Privileges'] = 'Members with administrator privileges';
$titanium_lang['Users_with_Mod_Privileges'] = 'Members with moderator privileges';
$titanium_lang['DB_size'] = 'Size of the database';
$titanium_lang['Version_of_board'] = 'Version of <a href="http://www.phpbb.com">phpbb</a>';
$titanium_lang['Version_of_PHP'] = 'Version of <a href="http://www.php.net/">PHP</a>';
$titanium_lang['Version_of_MySQL'] = 'Version of <a href="http://www.mysql.com/">MySQL</a>';
/*****[END]********************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$titanium_lang['SQR_settings'] = 'SQR Settings';
$titanium_lang['Allow_quick_reply'] = 'Allow Quick Reply';
$titanium_lang['Anonymous_show_SQR'] = 'Show Quick Reply Form to Anonymous Users';
$titanium_lang['Anonymous_SQR_mode'] = 'Anonymous Users Quick Reply Mode';
$titanium_lang['Anonymous_open_SQR'] = 'Open Quick Reply Form for Anonymous Users automatically';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Admin Userlist                     v2.0.2 ]
 ******************************************************/

$titanium_lang['Userlist_description'] = 'View a complete list of your users and perform various actions on them';

$titanium_lang['Add_group'] = 'Add to a Group';
$titanium_lang['Add_group_explain'] = 'Select which group to add the selected users to';

$titanium_lang['Open_close'] = 'Open/Close';
$titanium_lang['Active'] = 'Active';
$titanium_lang['Group'] = 'Group(s)';
$titanium_lang['Rank'] = 'Rank';
$titanium_lang['Last_activity'] = 'Last Activity';
$titanium_lang['Never'] = 'Never';
$titanium_lang['User_manage'] = 'Manage';
$titanium_lang['Find_all_posts'] = 'Find All Posts';
$titanium_lang['Filter']='Filter';

$titanium_lang['Select_one'] = 'Select One...';
$titanium_lang['Ban'] = 'Ban';
$titanium_lang['Activate_deactivate'] = 'Activate/De-activate';

$titanium_lang['Sort_User_id'] = 'By User id';
$titanium_lang['Sort_User_level'] = 'By User Level';
$titanium_lang['Sort_Rank'] = 'By Rank';
$titanium_lang['Sort_Active'] = 'By Active';
$titanium_lang['Sort_Last_Activity'] = 'By Last Activity';
$titanium_lang['Sort_User_Level'] = 'By User Level';

$titanium_lang['User_id'] = 'User id';
$titanium_lang['User_level'] = 'User Level';
$titanium_lang['Show'] = 'Show';
$titanium_lang['All'] = 'All';

$titanium_lang['Member'] = 'Member';
$titanium_lang['Pending'] = 'Pending';

$titanium_lang['Confirm_user_ban'] = 'Are you sure you want to ban the selected user(s)?';
$titanium_lang['Confirm_user_deleted'] = 'Are you sure you want to detele the selected user(s)?';

$titanium_lang['User_status_updated'] = 'User(s) status updated successfully!';
$titanium_lang['User_banned_successfully'] = 'User(s) banned successfully!';
$titanium_lang['User_deleted_successfully'] = 'User(s) deleted successfully!';
$titanium_lang['User_add_group_successfully'] = 'User(s) added to group successfully!';

$titanium_lang['Click_return_userlist'] = 'Click %shere%s to return to the User List';
/*****[END]********************************************
 [ Mod:     Admin Userlist                     v2.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$titanium_lang['Globalannounce'] ='Global Announce';
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    PM Quick Reply                      v1.3.5 ]
 ******************************************************/
$titanium_lang['ropm_quick_reply'] = 'PM Quick Reply';
$titanium_lang['enable_ropm_quick_reply'] = 'Enable PM Quick Reply';
$titanium_lang['ropm_quick_reply_bbc'] = 'Enable BBCode-Buttons';
$titanium_lang['ropm_quick_reply_smilies'] = 'Number of smilies';
$titanium_lang['ropm_quick_reply_smilies_info'] = 'You have to enter 0 here, if you don\'t want any smilies to be displayed.';
/*****[END]********************************************
 [ Mod:    PM Quick Reply                      v1.3.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
$titanium_lang['Must_select_search'] = 'You must select a quick search';
$titanium_lang['Search_title'] = 'Quick Search Management';
$titanium_lang['Search_explain'] = 'Using this facility, you can add, edit, and select search tools to add in the quick search.';
$titanium_lang['Search_name'] = 'Search Name';
$titanium_lang['Search_name_explain'] = 'The name display on the search drop down list. Examples: <strong>Yahoo / Google</strong>';
$titanium_lang['Search_url'] = 'Search URL';
$titanium_lang['Search_url_explain'] = 'The URL required for search to work. Examples:<br /><span style="color:red">Note: If the search engine needs additional string <strong>AFTER</strong> a</span> <strong>Keyword</strong><span style="color:red">, put the additional string in the second box! You don\'t have to add the word</span> <strong>Keyword</strong> <span style="color:red">of course, just leave it blank.</span><br /><br />- <span style="color:blue">http://search.yahoo.com/search?ei=utf-8&fr=sfp&p=</span><strong>Keyword</strong><br />- <span style="color:blue">http://www.google.com/search?hl=en&ie=utf-8&oe=utf-8&q=</span><strong>Keyword</strong><br />- <span style="color:blue">http://www.alltheweb.com/search?cat=web&cs=utf8&q=</span><strong>Keyword</strong><span style="color:blue">&rys=0&itag=crv&_sb_lang=pref</span><br />';
$titanium_lang['Must_enter_search_name'] = 'You must enter the search name';
$titanium_lang['Search_updated'] = 'Search was updated successfully';
$titanium_lang['Search_added'] = 'Search was added successfully';
$titanium_lang['Click_return_addsearchadmin'] = 'Click %sHere%s to return to the Add-Search Management Panel';
// a href, /a tags
$titanium_lang['Search_removed'] = 'Search was removed successfully';
$titanium_lang['Add_new_search'] = 'Add a new search';
// Quick Search Enable Setting for Board Configuration Panel
$titanium_lang['Quick_search_enable'] = 'Enable Quick Search';
$titanium_lang['Quick_search_enable_explain'] = 'Shows the Quick Search field in the overall header.';
/*****[END]********************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
$titanium_lang['sig_title']   = 'Advanced Signature Control';
$titanium_lang['sig_divider'] = 'Current Signature Divider';
$titanium_lang['sig_explain'] = 'This is where you control what divides the user\'s signature from their post';
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
$titanium_lang['Default_avatar'] = 'Set a default avatar';
$titanium_lang['Default_avatar_explain'] = 'This gives users that haven\'t yet selected an avatar, a default one. Set the default avatar for guests and users, and then select whether you want the avatar to be displayed for registered users, guests, both or none.<br />The path is \'modules/Forums/images/avatars/gallery\'';
$titanium_lang['Default_avatar_guests'] = 'Guests';
$titanium_lang['Default_avatar_users'] = 'Users';
$titanium_lang['Default_avatar_both'] = 'Both';
$titanium_lang['Default_avatar_none'] = 'None';
/*****[END]********************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
$titanium_lang['Board_disable_adminview'] = 'Administrator access when board disabled';
$titanium_lang['Board_disable_adminview_explain'] = 'This will allow Administrators to access the entire board when it is disabled.';
/*****[END]********************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/
$titanium_lang['URL_server_error'] = 'The URL you entered (%s) does not match the URL that the server is reporting (%s)';
$titanium_lang['URL_error_confirm'] = 'Do you want to keep this setting?';
/*****[END]********************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/
$titanium_lang['pm_allow_threshold'] = 'Allow PM threshold';
$titanium_lang['pm_allow_threshold_explain'] = 'Set here the minimal amount of posts the user has to write before being able to use the private messages.';
/*****[END]********************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
$titanium_lang['Max_smilies'] = 'Maximum smilies limit per post';
/*****[END]********************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  Cookie Check                        v1.0.0 ]
 ******************************************************/
$titanium_lang['Cookie_server_error'] = 'The Cookie Domain you entered (%s) does not match the URL that the server is reporting (%s)';
$titanium_lang['Cookie_error_confirm'] = 'Do you want to keep this setting?';
$titanium_lang['Cookie_name_error'] = 'The Cookie Name you entered (%s) is a standard cookie name and might cause problems. <br /> A recommend name might be %s';
/*****[END]********************************************
 [ Other:  Cookie Check                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
$titanium_lang['File_not_deleted'] = 'You have not yet delete the file install_tables.php : do it before trying to see this page.';
$titanium_lang['Log_action_title'] = 'Logs Actions';
$titanium_lang['Log_action_explain'] = 'Here you can see your moderators/administrators actions';
$titanium_lang['Choose_sort_method'] = 'Choose sorting method';
$titanium_lang['Order'] = 'Order';
$titanium_lang['Go'] = 'Go';
$titanium_lang['Id_log'] = 'Log Id';
$titanium_lang['Choose_log'] = 'Select Log';
$titanium_lang['Delete'] = 'Delete';
$titanium_lang['Action'] = 'Action';
$titanium_lang['Topic'] = 'Topic';
$titanium_lang['Done_by'] = 'Done By';
$titanium_lang['User_ip'] = 'User IP';
$titanium_lang['Select_all'] = 'Select All';
$titanium_lang['Unselect_all'] = 'Unselect All';
$titanium_lang['Date'] = 'Date';
$titanium_lang['See_topic'] = 'See the post';
$titanium_lang['Log_delete'] = 'Log deleted successfully.';
$titanium_lang['Click_return_admin_log'] = 'Click %sHere%s to return to the Log Actions';
$titanium_lang['Log_Config_updated'] = 'Configuration of Log Actions MOD successfull';
$titanium_lang['Click_return_admin_log_config'] = 'Click %sHere%s to return to the Log Actions MOD Configuration';
$titanium_lang['Log_Config'] = 'Configuration of the Log';
$titanium_lang['Log_Config_explain'] = 'Here, you will be able to configure some options of the Log Actions MOD.';
$titanium_lang['General_Config_Log'] = 'General Configuration of Log Actions MOD';
$titanium_lang['Allow_all_admin'] = 'Allow other Admins to see the Log Actions ?';
$titanium_lang['Allow_all_admin_explain'] = 'This option will allow you to choose if only the first admin of the board will be able to see the Log';
$titanium_lang['Admin_not_authorized'] = 'Sorry, you\'re not allowed to view this page. Only the main Admin has permission.';
$titanium_lang['Add_username_admin_explain'] = 'Choose the name of another Admin that you want to allow to see the logged actions';
$titanium_lang['Delete_username_admin_explain'] = 'Choose the name of another Admin that you don\'t want to allow to see the logged actions';
$titanium_lang['No_other_admins'] = 'No other Admins to choose';
$titanium_lang['No_admins_authorized'] = 'No other Admins authorized';
$titanium_lang['Add_Admin_Username'] = 'Choose an username to add';
$titanium_lang['Delete_Admin_Username'] = 'Choose an username to delete';
$titanium_lang['No_admins_allow'] = 'There are no admins to allow to view the logs';
$titanium_lang['No_admins_disallow'] = 'There are no admins to disallow to view the logs';
$titanium_lang['Admins_add_success'] = 'Admin have been added to the list successfully';
$titanium_lang['Admins_del_success'] = 'Admin(s) have been deleted from the list successfully';
$titanium_lang['Prune_success'] = 'Prune of the Logs successfull';
$titanium_lang['Prune_of_logs'] = 'Prune of the Logs';
$titanium_lang['Prune'] = 'Prune Logs';
$titanium_lang['Prune_!'] = 'Prune !';
$titanium_lang['Prune_explain'] = 'Enter the number of days that you want to prune the logs. 0 = all the logs';
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
$titanium_lang['glance_title'] = 'At a Glance Options';
$titanium_lang['glance_override_title'] = 'Override User Settings';

$titanium_lang['glance_news'] = 'Enter the Forum ID of your News Forum';
$titanium_lang['glance_news_explain'] = 'Set to 0 if you dont have a news forum or dont want news displayed. Seperate News Forums with , (1,2,3).';

$titanium_lang['glance_num_news'] = 'Enter the number of news articles to display.';
$titanium_lang['glance_num_news_explain'] = 'Set to 0 if you dont have a news forum or dont want news displayed.';

$titanium_lang['glance_num_explain'] = 'Enter the amount of recent topics to display';

$titanium_lang['glance_ignore_forums'] = 'Enter the Forum ID of Forums you would like to be ignored on the recent topics list.';
$titanium_lang['glance_ignore_forums_explain'] = 'Seperate Forums with , (1,2,3). Leave blank to show all.';

$titanium_lang['glance_table_width'] = 'Enter the width you would like the Recent Blocks displayed.';
$titanium_lang['glance_table_width_explain'] = 'Default : 100%';
$titanium_lang['glance_auth_read_explain'] = 'Show topics the user can view but not read?';

$titanium_lang['glance_topic_length'] = 'Limit the number of characters displayed in topic title.';
$titanium_lang['glance_topic_length_explain'] = 'Set to 0 to show full title.';
/*****[END]********************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
$titanium_lang['Online_time'] = 'Online status time';
$titanium_lang['Online_time_explain'] = 'Number of seconds a user must be displayed online (do not use lower value than 60).';
$titanium_lang['Online_setting'] = 'Online Status Setting';
$titanium_lang['Online_color'] = 'Online text color';
$titanium_lang['Offline_color'] = 'Offline text color';
$titanium_lang['Hidden_color'] = 'Hidden text color';
/*****[END]********************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/

 /*****[BEGIN]******************************************
 [ Mod:   Show Users Today Toggle              v1.0.0 ]
 ******************************************************/
 $titanium_lang['show_users_today'] = 'Show users who logged on today on Index<br /><small>Note: Not Recommended for large sites</small>';
/*****[END]********************************************
 [ Mod:   Show Users Today Toggle              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Group Colors and Ranks             v1.0.0 ]
 ******************************************************/
$titanium_lang['group_color'] = 'Select the default color group for this group.';
$titanium_lang['group_rank'] = 'Select the default rank for this group.';
/*****[BEGIN]******************************************
 [ Mod:     Group Colors and Ranks             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
$titanium_lang['topic_explain'] = 'You  can use any form of HTML to do this. You can customize a different style for each topic type';
$titanium_lang['locked'] = 'Locked Topic';
$titanium_lang['sticky'] = 'Sticky';
$titanium_lang['global'] = 'Global Announcement';
$titanium_lang['announce'] = 'Announcement';
$titanium_lang['current'] = 'Current';
$titanium_lang['current_explain'] = 'This is your current settings for this topic type. This is how it will be displayed on the forum.';
$titanium_lang['tag'] = 'Change the view';
$titanium_lang['tag_explain'] = 'Please do not use quotes or slashes in your html. Ex: &lt;font color=#FFFFFF&gt;Title&lt;/font&gt;';
$titanium_lang['topic_title'] = 'Topic Title';
$titanium_lang['moved'] = 'Moved';
$titanium_lang['topic_view_settings'] = 'Customized Topic View';
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
$titanium_lang['Initial_user_group'] = 'Initial User Group';
$titanium_lang['Initial_user_group_explain'] = 'Sets the Inital usergroup users are put in on signup';
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
$titanium_lang['hide_images'] = 'Hide Images to Guests';
$titanium_lang['hide_links'] = 'Hide Links to Guests';
$titanium_lang['hide_emails'] = 'Hide Email links to Guests';
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
$titanium_lang['dhtml_menu'] = 'Use DHTML on Forum Configuration.';
$titanium_lang['dhtml_menu_explain'] = 'Makes the Configuration Tables Collapse';
/*****[END]********************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
$titanium_lang['user_hide_images'] = 'Hide Images in Forums';
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
$titanium_lang['smilies_in_titles'] = 'Show Smilies in Topic Titles';
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
$titanium_lang['last_poster_avatar'] = 'Show Last Post Avatar on Index';
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
$titanium_lang['logs_view_level'][0] = 'Admins, Mods, Users, Anonymous';
$titanium_lang['logs_view_level'][1] = 'Admins, Mods, Users';
$titanium_lang['logs_view_level'][3] = 'Admins, Mods';
$titanium_lang['logs_view_level'][2] = 'Admins';
$titanium_lang['show_edited_logs'] = 'Show Topic Edit logs';
$titanium_lang['show_locked_logs'] = 'Show Topic Locked logs';
$titanium_lang['show_unlocked_logs'] = 'Show Topic Unlocked logs';
$titanium_lang['show_moved_logs'] = 'Show Topic Moved logs';
$titanium_lang['show_splitted_logs'] = 'Show Topic Splitted logs';
$titanium_lang['allow_logs_view'] = 'Show logs to';
/*****[END]********************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/
$titanium_lang['image_resize_width'] = 'Resize Image Width';
$titanium_lang['image_resize_height'] = 'Resize Image Height';
/*****[END]********************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
$titanium_lang['admin_style'] = 'Use your site theme\'s style for forum admin';
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
$titanium_lang['ADMIN_IP_LOCK'] = 'Admin IP Lock';
$titanium_lang['ADMIN_IP_LOCK_OFF'] = 'Disabled';
$titanium_lang['ADMIN_IP_LOCK_ON'] = 'Enabled';
/*****[END]********************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
$titanium_lang['user_posts'] = 'User Post Count';
/*****[END]********************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Display Poster Information Once    v2.0.0 ]
 ******************************************************/
$titanium_lang['once_settings'] = 'Show Once Per Post';
$titanium_lang['show_sig_once'] = 'Show sig once per post';
$titanium_lang['show_avatar_once'] = 'Show avatar once per post';
$titanium_lang['show_rank_once'] = 'Show rank once per post';
/*****[END]********************************************
 [ Mod:     Display Poster Information Once    v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Xdata                              v0.1.1 ]
 ******************************************************/
$titanium_lang['User_Permissions'] = 'User Permissions';
$titanium_lang['Group_Permissions'] = 'Group Permissions';
$titanium_lang['Manage_Fields'] = 'Manage Fields';
/*****[END]********************************************
 [ Mod:     Xdata                              v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [Mod:      Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
$titanium_lang['max_inbox'] = "Maximum Size of User's Private Message Inbox";
$titanium_lang['max_sentbox'] = "Maximum Size of User's Private Message Sentbox";
$titanium_lang['max_savebox'] = "Maximum Size of User's Private Message Savebox";
$titanium_lang['override_max'] = "Override Main Board Setting";
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

$titanium_lang['Login_page'] = 'Loginpage';
$titanium_lang['Login_page_explain'] = 'After Login, User is redirected to his Profile (Yes) or to Forum Index page (No)';

/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
$titanium_lang['group_count'] = 'Number of required posts';
$titanium_lang['group_count_max'] = 'Number of max posts';
$titanium_lang['group_count_updated'] = '%d member(s) have been removed, %d members are added to this group';
$titanium_lang['Group_count_enable'] = 'Users automatic added when posting';
$titanium_lang['Group_count_update'] = 'Add/Update new users';
$titanium_lang['Group_count_delete'] = 'Delete/Update old users';
$titanium_lang['User_allow_ag'] = "Activate Auto Group";
$titanium_lang['group_count_explain'] = 'When users have posted more posts than this value <i>(in any forum)</i> then they will be added to this usergroup<br/> This only applys if "'.$titanium_lang['Group_count_enable'].'" are enabled';
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
$titanium_lang['Forum_is_link'] = 'Change the forumtitle in a weblink';
$titanium_lang['Forum_weblink'] = 'Weblink ( inclusive HTTP:// )';
$titanium_lang['Forum_link_icon'] = 'Icon for this forum. This will replace the default icon in the forum index.<br />You can enter an image from your phpBB directories (without leading "/")<br />or an external link (Full path!).';
$titanium_lang['Forum_link_target'] = 'Link open a new window';
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
 
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/ 
$titanium_lang['Flags_title'] = 'Flag Administration';
$titanium_lang['Flags_explain'] = 'Using this form you can add, edit, view and delete flags. You can also create custom flags which can be applied to a user via the user management facility';

$titanium_lang['Add_new_flag'] = 'Add new flag';

$titanium_lang['Flag_name'] = 'Flag Name';
$titanium_lang['Flag_pic'] = 'Image';
$titanium_lang['Flag_image'] = 'Flag Image (in the images/flags/ directory)';
$titanium_lang['Flag_image_explain'] = 'Use this to define a small image associated with the flag';

$titanium_lang['Must_select_flag'] = 'You must select a flag';
$titanium_lang['Flag_updated'] = 'The flag was successfully updated';
$titanium_lang['Flag_added'] = 'The flag was successfully added';
$titanium_lang['Flag_removed'] = 'The flag was successfully deleted';
$titanium_lang['No_update_flags'] = 'The flag was successfully deleted. However, user accounts using this flag were not updated.  You will need to manually reset the flag on these accounts';

$titanium_lang['Flag_confirm'] = 'Delete Flag' ;
$titanium_lang['Confirm_delete_flag'] = 'Are you sure you want to remove the selected flag?' ;

$titanium_lang['Click_return_flagadmin'] = 'Click %sHere%s to return to Flag Administration';
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
$titanium_lang['Forum_icon'] = 'Forum icon';
/*****[END]********************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
$titanium_lang['Birthdays'] = 'Birthdays';
$titanium_lang['bday_show'] = 'Birthday Panel Visibility';
$titanium_lang['Unconditional'] = 'Unconditional';
$titanium_lang['Conditional'] = 'Conditional';
$titanium_lang['bday_show_explain'] = 'Determines whether or not the Birthday Panel on the main Index should be visible in the event that there are no birthdays or upcoming birthdays (unconditional = yes, conditional = no)';
$titanium_lang['bday_require'] = 'Require Date of Birth';
$titanium_lang['bday_require_explain'] = 'The year of birth will only be required if the "Require Year" option is selected';
$titanium_lang['bday_year'] = 'Require Year';
$titanium_lang['bday_year_explain'] = 'When this option is selected, users attempting to provide a date of birth will also need to provide a year of birth.';
$titanium_lang['bday_lock'] = 'Disallow Date of Birth Changes';
$titanium_lang['bday_lock_explain'] = 'Once entered, the date of birth cannot be changed, again.  Atleast when this option is selected.';
$titanium_lang['bday_lookahead'] = 'Number of Days to Look Ahead';
$titanium_lang['bday_lookahead_explain'] = 'Affects the Birthday Panel on the main Index.  Entering -1 will disable Birthday Lookahead';
$titanium_lang['bday_age_range'] = 'Allowable Age Range (in years)';
$titanium_lang['bday_hide'] = 'Hide Birthday Panel from Guests';
$titanium_lang['bday_send_greeting_admin_explain'] = 'Your members will choose either one or none of the options you enable.';
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
$titanium_lang['use_thank'] = 'Allow to Thank posts';
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
$titanium_lang['Reputation'] = 'Reputation';
$titanium_lang['Reputation_Config_Title'] = 'Reputation System Configuration';
$titanium_lang['Reputation_Config_Explain'] = 'Here you can set the options for Users Reputation System.';
$titanium_lang['Rep_config_updated'] = 'Reputation System config updated';
$titanium_lang['Click_return_rep_config'] = '%sReturn to Reputation System config%s';
$titanium_lang['Disable_rep'] = 'Disable Reputation System';
$titanium_lang['Graphic_version'] = 'Graphic version';
$titanium_lang['Show_stats_to_mods'] = 'Show the stats of given points only to administrators/moderators';
$titanium_lang['PM_notify'] = 'Notify users through PM when they receive new reputation points';
$titanium_lang['Posts_to_earn'] = 'Amount of posts to earn 1 reputation point (0 - to disable)';
$titanium_lang['Days_to_earn'] = 'Amount of days on forum to earn 1 reputation point (0 - to disable)';
$titanium_lang['Flood_control_time'] = 'Minimum amount of minutes between reputation givings by the same user (no use for admins and mods)';
$titanium_lang['Medal1_to_earn'] = 'Amount of reputation points to earn the 1st size medal';
$titanium_lang['Medal2_to_earn'] = 'Amount of reputation points to earn the 2nd size medal';
$titanium_lang['Medal3_to_earn'] = 'Amount of reputation points to earn the 3rd size medal';
$titanium_lang['Medal4_to_earn'] = 'Amount of reputation points to earn the 4th size medal';
$titanium_lang['Given_rep_to_earn'] = 'Amount of given reputation to earn 1 reputation point (0 - to disable)';
$titanium_lang['Repsum_limit'] = 'Limit of giving reputation points to a user (0 - no limits)';
$titanium_lang['Default_amount'] = 'Turn the simple version on and set the default amount of every giving to this number (0 - to disable)';
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/ 
 
/*****[BEGIN]*****************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/
$titanium_lang['ad_managment']  = 'Ad Management';
$titanium_lang['inline_ad_config']  = 'Inline Ad Config';
$titanium_lang['inline_ads']  = 'Inline Ads';
$titanium_lang['ad_code_about']  = 'This page lists current ads.  You may edit, delete or add new ads here.';
$titanium_lang['Click_return_firstpost'] = 'Click %sHere%s to return to Inline Ad Configuration';
$titanium_lang['Click_return_inline_code'] = 'Click %sHere%s to return to Inline Ad Code Configuration';
$titanium_lang['ad_after_post'] = 'Display Ad After x Post';
$titanium_lang['ad_every_post'] = 'Display Ad Every x Post';
$titanium_lang['ad_display'] = 'Display Ads To';
$titanium_lang['ad_all'] = 'All';
$titanium_lang['ad_reg'] = 'Registered Users';
$titanium_lang['ad_guest'] = 'Guests';
$titanium_lang['ad_exclude'] = 'Exclude These Groups (You may select multiple groups)';
$titanium_lang['ad_forums'] = 'Exclude These Forums (You may select multiplt forums)';
$titanium_lang['ad_code'] = 'Ad Code';
$titanium_lang['ad_style'] = 'Display Style';
$titanium_lang['ad_new_style'] = 'Ad looks like a special user post';
$titanium_lang['ad_old_style'] = 'Ad falls inline with the topic';
$titanium_lang['ad_post_threshold'] = 'Do not display if user has more than x posts (Leave blank to disable)';
$titanium_lang['ad_add']  = 'Add New Ad';
$titanium_lang['ad_name']  = 'Short name to identify ad';
$titanium_lang['exclude_none']  = 'Exclude None';
/*****[END]*******************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/

$titanium_lang['youtube_dimensions'] = 'YouTube Video Dimensions';
$titanium_lang['twitch_dimensions'] = 'Twitch Video Dimensions';
$titanium_lang['facebook_dimensions'] = 'Facebook Video Dimensions';

//
// That's all Folks!
// -------------------------------------------------

?>