<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                               privmsgs.php
 *                            -------------------
 *   begin                : Saturday, Jun 9, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: privmsg.php,v 1.96.2.40 2005/07/19 20:01:19 acydburn Exp
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Advanced Username Color                  v1.0.5       06/11/2005
      PM Quick Reply                           v1.3.5       06/14/2005
      Force Word Wrapping                      v1.0.16      06/15/2005
      Count PM                                 v1.0.1       06/23/2005
      Custom mass PM                           v1.4.7       07/04/2005
      PM threshold                             v1.0.0       07/19/2005
      Smilies in Topic Titles                  v1.0.0       07/19/2005
      Welcome PM                               v2.0.0       07/22/2005
      Advance Signature Divider Control        v1.0.0       08/07/2005
      Direct Inbox Linking (Email)             v1.0.0       08/27/2005
      Smilies in Topic Title Toggle            v1.0.0       09/10/2005
      Suppress Popup                           v1.0.0       09/13/2005
      Bottom aligned signature                 v1.2.0       10/01/2005
      Extended PM Notification                 v1.1.5       10/27/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2006
      Birthdays                                v3.0.0       04/25/2009
      PM Switchbox Repair                      v1.0.0       05/24/2009
	  XtraColors                               v1.0.0       05/26/2009
	  Added New Buttons w/HTML5                v1.0.0       09/25/2022
 ************************************************************************/

if(!defined('MODULE_FILE')){die('You can\'t access this file directly...');}

if(isset($privmsg_id)) 
$privmsg_id = intval($privmsg_id);

if (!empty($pm_uname)): 
    $sql = "SELECT user_id from ".$titanium_user_prefix."_users WHERE username='$pm_uname'";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $u = intval($row['user_id']);
    $mode = 'post';
    redirect_titanium("modules.php?name=Private_Messages&mode=$mode&u=$u");
    exit;
endif;

$sql_title = "SELECT custom_title from ".$titanium_prefix."_modules where title='$name'";
$result_title = $titanium_db->sql_query($sql_title);
$row_title = $titanium_db->sql_fetchrow($result_title);

if(empty($row_title['custom_title'])): 
 $mod_name = str_replace("_", " ", $name);
else: 
 $mod_name = $row_title['custom_title'];
endif;

if(!(isset($popup)) || ($popup != "1")): 
    $titanium_module_name = basename(dirname(__FILE__));
    require(NUKE_FORUMS_DIR.'nukebb.php');
    title($sitename.': '.$mod_name);
else: 
    $phpbb2_root_path = NUKE_FORUMS_DIR;
    $nuke_file_path = 'modules.php?name=Forums&file=';
endif;

define('IN_PHPBB2', true);
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);
include(NUKE_INCLUDE_DIR.'bbcode.php');
include(NUKE_INCLUDE_DIR.'functions_post.php');

# Is PM disabled?
if(!empty($phpbb2_board_config['privmsg_disable']))
message_die(GENERAL_MESSAGE, 'PM_disabled');

$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');

# Parameters
$submit = ( isset($_POST['post']) ) ? TRUE : 0;
$submit_search = ( isset($_POST['usersubmit']) ) ? TRUE : 0;
$submit_msgdays = ( isset($_POST['submit_msgdays']) ) ? TRUE : 0;
$cancel = ( isset($_POST['cancel']) ) ? TRUE : 0;
$preview = ( isset($_POST['preview']) ) ? TRUE : 0;
$confirm = ( isset($_POST['confirm']) ) ? TRUE : 0;
$delete = ( isset($_POST['delete']) ) ? TRUE : 0;
$delete_all = ( isset($_POST['deleteall']) ) ? TRUE : 0;
$save = ( isset($_POST['save']) ) ? TRUE : 0;
$sid = (isset($_POST['sid'])) ? $_POST['sid'] : 0;

$refresh = $preview || $submit_search;

$mark_list = ( !empty($_POST['mark']) ) ? $_POST['mark'] : 0;

if(isset($_POST['folder']) || isset($_GET['folder'])):
$folder = ( isset($_POST['folder']) ) ? $_POST['folder'] : $_GET['folder'];
  if (is_string($folder)): 
     $folder = htmlspecialchars($folder);
  else:
     $folder = '';
  endif;
   if($folder != 'inbox' && $folder != 'outbox' && $folder != 'sentbox' && $folder != 'savebox' ):
     $folder = 'inbox';
   endif;
else:
  $folder = 'inbox';
endif;

# Start session management
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_PRIVMSGS);
titanium_init_userprefs($userdata);
# End session management

# Mod: Welcome PM v2.0.0 START
$welcome_pm = ( isset($_POST['w_pm']) ) ? TRUE : 0;
if(!empty($welcome_pm) && !empty($submit)) 
{
    if(empty($_POST['subject'])) 
    message_die(GENERAL_ERROR,$titanium_lang['Welcome_PM_Subject']);
    
	if($titanium_db->sql_numrows($titanium_db->sql_query("SELECT * FROM ".$titanium_prefix."_welcome_pm")) != 0) 
    $sql_w_pm = "UPDATE ".$titanium_prefix."_welcome_pm SET subject='".$_POST['subject']."', msg='".$_POST['message']."'";
	else 
    $sql_w_pm = "INSERT INTO ".$titanium_prefix."_welcome_pm VALUES('".$_POST['subject']."', '".$_POST['message']."')";
    
	$titanium_db->sql_query($sql_w_pm);
    $msg = $titanium_lang['Welcome_PM_Set'] . '<br /><br />' . sprintf($titanium_lang['Click_return_inbox'], '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=inbox") . '">', '</a> ') . '<br /><br />' . sprintf($titanium_lang['Click_return_index'], '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a>');

    message_die(GENERAL_MESSAGE, $msg);
}
# Mod: Welcome PM v2.0.0 END

# Mod: PM threshold v1.0.0 START
$pm_allow_threshold = isset($phpbb2_board_config['pm_allow_threshold']) ? $phpbb2_board_config['pm_allow_threshold'] : 1;

if(($userdata['user_posts'] < $pm_allow_threshold) && $userdata['user_level'] != ADMIN)
message_die(GENERAL_MESSAGE, 'Not_Authorised');

if(!$userdata['session_logged_in']):
  redirect_titanium('modules.php?name=Your_Account&redirect=privmsg&folder=inbox');
  exit;
endif;
# Mod: PM threshold v1.0.0 START


# Cancel
if($cancel):
    redirect_titanium(append_titanium_sid("privmsg.$phpEx?folder=$folder", true));
    exit;
endif;

//
// Var definitions
//
if ( !empty($_POST['mode']) || !empty($_GET['mode']) )
{
    $mode = ( !empty($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
    $mode = htmlspecialchars($mode);
}
else
{
    $mode = '';
}



if ( $HTTP_GET_VARS['page'] ):

    $pageroot       = (!empty($HTTP_GET_VARS['page'])) ? $HTTP_GET_VARS['page'] : 1;
    $page           = (isset($pageroot)) ? intval($pageroot) : 1;

    $calc           = $phpbb2_board_config['topics_per_page'] * $page;
    $phpbb2_start          = $calc - $phpbb2_board_config['topics_per_page'];

else:

    $phpbb2_start = ( !empty($_GET['start']) ) ? intval($_GET['start']) : 0;
    $phpbb2_start = ($phpbb2_start < 0) ? 0 : $phpbb2_start;

endif;

if ( isset($_POST[POST_POST_URL]) || isset($_GET[POST_POST_URL]) )
{
    $privmsg_id = ( isset($_POST[POST_POST_URL]) ) ? intval($_POST[POST_POST_URL]) : intval($_GET[POST_POST_URL]);
}
else
{
    $privmsg_id = '';
}

$error = FALSE;

//
// Define the box image links
//
$inbox_img = ( $folder != 'inbox' || !empty($mode) ) ? '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=inbox") . '"><img src="' . $images['pm_inbox'] . '" border="0" alt="' . $titanium_lang['Inbox'] . '" /></a>' : '<img src="' . $images['pm_inbox'] . '" border="0" alt="' . $titanium_lang['Inbox'] . '" />';
$inbox_url = ( $folder != 'inbox' || !empty($mode) ) ? '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=inbox") . '">' . $titanium_lang['Inbox'] . '</a>' : $titanium_lang['Inbox'];


$inbox_uri = append_titanium_sid("privmsg.$phpEx?folder=inbox");
$inbox_title = $titanium_lang['Inbox'];


$outbox_img = ( $folder != 'outbox' || !empty($mode) ) ? '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=outbox") . '"><img src="' . $images['pm_outbox'] . '" border="0" alt="' . $titanium_lang['Outbox'] . '" /></a>' : '<img src="' . $images['pm_outbox'] . '" border="0" alt="' . $titanium_lang['Outbox'] . '" />';
$outbox_url = ( $folder != 'outbox' || !empty($mode) ) ? '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=outbox") . '">' . $titanium_lang['Outbox'] . '</a>' : $titanium_lang['Outbox'];


$outbox_uri = append_titanium_sid("privmsg.$phpEx?folder=outbox");
$outbox_title = $titanium_lang['Outbox'];


$sentbox_img = ( $folder != 'sentbox' || !empty($mode) ) ? '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=sentbox") . '"><img src="' . $images['pm_sentbox'] . '" border="0" alt="' . $titanium_lang['Sentbox'] . '" /></a>' : '<img src="' . $images['pm_sentbox'] . '" border="0" alt="' . $titanium_lang['Sentbox'] . '" />';
$sentbox_url = ( $folder != 'sentbox' || !empty($mode) ) ? '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=sentbox") . '">' . $titanium_lang['Sentbox'] . '</a>' : $titanium_lang['Sentbox'];


$sentbox_uri = append_titanium_sid("privmsg.$phpEx?folder=sentbox");
$sentbox_title = $titanium_lang['Sentbox'];


$savebox_img = ( $folder != 'savebox' || !empty($mode) ) ? '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=savebox") . '"><img src="' . $images['pm_savebox'] . '" border="0" alt="' . $titanium_lang['Savebox'] . '" /></a>' : '<img src="' . $images['pm_savebox'] . '" border="0" alt="' . $titanium_lang['Savebox'] . '" />';
$savebox_url = ( $folder != 'savebox' || !empty($mode) ) ? '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=savebox") . '">' . $titanium_lang['Savebox'] . '</a>' : $titanium_lang['Savebox'];


$savebox_uri = append_titanium_sid("privmsg.$phpEx?folder=savebox");
$savebox_title = $titanium_lang['Savebox'];


/*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

if ( $folder == 'inbox' ) 
{
    $max_boxsize_sql = "SELECT ug.group_id, g.max_inbox, g.override_max_inbox FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g WHERE ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ORDER BY override_max_inbox DESC, max_inbox DESC";
    $max_boxsize_result = $titanium_db->sql_query($max_boxsize_sql);
    $max_boxsize_row = $titanium_db->sql_fetchrow($max_boxsize_result);
    $max_boxsize = $phpbb2_board_config['max_inbox_privmsgs'];
    if ( $max_boxsize_row['override_max_inbox'] == 1 ) 
    {
        $max_boxsize = $max_boxsize_row['max_inbox']; 
    }
}
else if ( $folder == 'savebox' ) 
{
    $max_boxsize_sql = "SELECT ug.group_id, g.max_savebox, g.override_max_savebox FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g WHERE ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ORDER BY override_max_savebox DESC, max_savebox DESC";
    $max_boxsize_result = $titanium_db->sql_query($max_boxsize_sql);
    $max_boxsize_row = $titanium_db->sql_fetchrow($max_boxsize_result);
    $max_boxsize = $phpbb2_board_config['max_savebox_privmsgs'];
    if ( $max_boxsize_row['override_max_savebox'] == 1 ) 
    {
        $max_boxsize = $max_boxsize_row['max_savebox']; 
    }
}
else if ( $folder == 'sentbox' )
{
    $max_boxsize_sql = "SELECT ug.group_id, g.max_sentbox, g.override_max_sentbox FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g WHERE ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ORDER BY override_max_sentbox DESC, max_sentbox DESC";
    $max_boxsize_result = $titanium_db->sql_query($max_boxsize_sql);
    $max_boxsize_row = $titanium_db->sql_fetchrow($max_boxsize_result);
    $max_boxsize = $phpbb2_board_config['max_sentbox_privmsgs'];
    if ( $max_boxsize_row['override_max_sentbox'] == 1 ) 
    {
        $max_boxsize = $max_boxsize_row['max_sentbox']; 
    }
}

/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
execute_privmsgs_attachment_handling($mode);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

// ----------
// Start main
//
if ( $mode == 'newpm' )
{
        $gen_simple_header = TRUE;

        $phpbb2_page_title = $titanium_lang['Private_Messaging'];
        include(NUKE_INCLUDE_DIR.'page_header_review.php');

        $phpbb2_template->set_filenames(array(
                'body' => 'privmsgs_popup.tpl')
        );

        if ( $userdata['session_logged_in'] )
        {
                if ( $userdata['user_new_privmsg'] )
                {
                    $l_new_message = ( $userdata['user_new_privmsg'] == 1 ) ? $titanium_lang['You_new_pm'] : $titanium_lang['You_new_pms'];
					$l_message_text_unread = sprintf($l_new_message, $userdata['user_new_privmsg']);
                }
                else
                {
                    #$l_new_message = $titanium_lang['You_no_new_pm'];
					$l_message_text_unread = $titanium_lang['No_unread_pm'];
                }

                $l_message_text_unread .= '<br /><br />' . sprintf($titanium_lang['Click_view_privmsg'], '<a href="' . append_titanium_sid("privmsg.".$phpEx."?folder=inbox") . '" onclick="jump_to_inbox();return false;" target="_new">', '</a>');
        }
        else
        {
                $l_new_message = $titanium_lang['Login_check_pm'];
				$l_message_text_unread = '';
        }

        $phpbb2_template->assign_vars(array(
                'L_CLOSE_WINDOW' => $titanium_lang['Close_window'],
                'L_MESSAGE' => $l_message_text_unread)
        );

        $phpbb2_template->pparse('body');

        include(NUKE_INCLUDE_DIR.'page_tail_review.php');
        exit;

}
else if ( $mode == 'read' )
{
        if ( !empty($_GET[POST_POST_URL]) )
        {
                $privmsgs_id = intval($_GET[POST_POST_URL]);
        }
        else
        {
                message_die(GENERAL_ERROR, $titanium_lang['No_post_id']);
        }

        if ( !$userdata['session_logged_in'] )
        {
                // not needed anymore due to function redirect_titanium()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect_titanium("modules.php?name=Your_Account&redirect=privmsg&folder=$folder&mode=$mode&" . POST_POST_URL . "=$privmsgs_id");
                //redirect_titanium(append_titanium_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=$folder&mode=$mode&" . POST_POST_URL . "=$privmsgs_id", true));
                exit;
        }

        //
        // SQL to pull appropriate message, prevents nosey people
        // reading other peoples messages ... hopefully!
        //
        switch( $folder )
        {
                case 'inbox':
                        $l_box_name = $titanium_lang['Inbox'];
                        $pm_sql_user = "AND pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                                AND ( pm.privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                        OR pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                        OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                        break;
                case 'outbox':
                        $l_box_name = $titanium_lang['Outbox'];
                        $pm_sql_user = "AND pm.privmsgs_from_userid =  " . $userdata['user_id'] . "
                                AND ( pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                        OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) ";
                        break;
                case 'sentbox':
                        $l_box_name = $titanium_lang['Sentbox'];
                        $pm_sql_user = "AND pm.privmsgs_from_userid =  " . $userdata['user_id'] . "
                                AND pm.privmsgs_type = " . PRIVMSGS_SENT_MAIL;
                        break;
                case 'savebox':
                        $l_box_name = $titanium_lang['Savebox'];
                        $pm_sql_user = "AND ( ( pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                                        AND pm.privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                                OR ( pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                                        AND pm.privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " )
                                )";
                        break;
                default:
                        message_die(GENERAL_ERROR, $titanium_lang['No_such_folder']);
                        break;
        }

        //
        // Major query obtains the message ...
        //
/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
        $sql = "SELECT u.username AS username_1, u.user_id AS user_id_1, u2.username AS username_2, u2.user_id AS user_id_2, u.user_sig_bbcode_uid, u.user_posts, u.user_from, u.user_website, u.user_birthday, u.birthday_display, u.user_email, u.user_regdate, u.user_viewemail, u.user_rank, u.user_sig, u.user_avatar, u.user_avatar_type, u.user_allow_viewonline AS user_allow_viewonline_1, u2.user_allow_viewonline AS user_allow_viewonline_2, u.user_session_time AS user_session_time_1, u2.user_session_time AS user_session_time_2, pm.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text
                FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u, " . USERS_TABLE . " u2
                WHERE pm.privmsgs_id = '$privmsgs_id'
                        AND pmt.privmsgs_text_id = pm.privmsgs_id
                        $pm_sql_user
                        AND u.user_id = pm.privmsgs_from_userid
                        AND u2.user_id = pm.privmsgs_to_userid";
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query private message post information', '', __LINE__, __FILE__, $sql);
        }

        //
        // Did the query return any data?
        //
        if ( !($privmsg = $titanium_db->sql_fetchrow($result)) )
        {
                redirect_titanium(append_titanium_sid("privmsg.$phpEx?folder=$folder", true));
                exit;
        }

        $privmsg_id = $privmsg['privmsgs_id'];

        //
        // Is this a new message in the inbox? If it is then save
        // a copy in the posters sent box
        //
        if (($privmsg['privmsgs_type'] == PRIVMSGS_NEW_MAIL || $privmsg['privmsgs_type'] == PRIVMSGS_UNREAD_MAIL) && $folder == 'inbox')
        {
                // Update appropriate counter
                switch ($privmsg['privmsgs_type'])
                {
                        case PRIVMSGS_NEW_MAIL:
                                $sql = "user_new_privmsg = user_new_privmsg - 1";
                                break;
                        case PRIVMSGS_UNREAD_MAIL:
                                $sql = "user_unread_privmsg = user_unread_privmsg - 1";
                                break;
                }

                $sql = "UPDATE " . USERS_TABLE . "
                        SET $sql
                        WHERE user_id = " . $userdata['user_id'];
                if ( !$titanium_db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update private message read status for user', '', __LINE__, __FILE__, $sql);
                }

                $sql = "UPDATE " . PRIVMSGS_TABLE . "
                        SET privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                        WHERE privmsgs_id = " . $privmsg['privmsgs_id'];
                if ( !$titanium_db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update private message read status', '', __LINE__, __FILE__, $sql);
                }

                // Check to see if the poster has a 'full' sent box
                $sql = "SELECT COUNT(privmsgs_id) AS sent_items, MIN(privmsgs_date) AS oldest_post_time
                        FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_type = " . PRIVMSGS_SENT_MAIL . "
                                AND privmsgs_from_userid = " . $privmsg['privmsgs_from_userid'];
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain sent message info for sendee', '', __LINE__, __FILE__, $sql);
                }

                $sql_priority = ( SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') ? 'LOW_PRIORITY' : '';

                if ( $sent_info = $titanium_db->sql_fetchrow($result) )
                {
                        if ($phpbb2_board_config['max_sentbox_privmsgs'] && $sent_info['sent_items'] >= $phpbb2_board_config['max_sentbox_privmsgs'])
                        {
                                $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                                        WHERE privmsgs_type = " . PRIVMSGS_SENT_MAIL . "
                                                AND privmsgs_date = " . $sent_info['oldest_post_time'] . "
                                                AND privmsgs_from_userid = " . $privmsg['privmsgs_from_userid'];
                                if ( !$result = $titanium_db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not find oldest privmsgs', '', __LINE__, __FILE__, $sql);
                                }
                                $old_privmsgs_id = $titanium_db->sql_fetchrow($result);
                                $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];

                                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                                        WHERE privmsgs_id = '$old_privmsgs_id'";
                                if ( !$titanium_db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (sent)', '', __LINE__, __FILE__, $sql);
                                }

                                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                                        WHERE privmsgs_text_id = '$old_privmsgs_id'";
                                if ( !$titanium_db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (sent)', '', __LINE__, __FILE__, $sql);
                                }
                        }
                }

                //
                // This makes a copy of the post and stores it as a SENT message from the sendee. Perhaps
                // not the most DB friendly way but a lot easier to manage, besides the admin will be able to
                // set limits on numbers of storable posts for users ... hopefully!
                //
                $sql = "INSERT $sql_priority INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
                        VALUES (" . PRIVMSGS_SENT_MAIL . ", '" . str_replace("\'", "''", addslashes($privmsg['privmsgs_subject'])) . "', " . $privmsg['privmsgs_from_userid'] . ", " . $privmsg['privmsgs_to_userid'] . ", " . $privmsg['privmsgs_date'] . ", '" . $privmsg['privmsgs_ip'] . "', " . $privmsg['privmsgs_enable_html'] . ", " . $privmsg['privmsgs_enable_bbcode'] . ", " . $privmsg['privmsgs_enable_smilies'] . ", " .  $privmsg['privmsgs_attach_sig'] . ")";
                if ( !$titanium_db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not insert private message sent info', '', __LINE__, __FILE__, $sql);
                }

                $privmsg_sent_id = $titanium_db->sql_nextid();

                $sql = "INSERT $sql_priority INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
                        VALUES ('$privmsg_sent_id', '" . $privmsg['privmsgs_bbcode_uid'] . "', '" . str_replace("\'", "''", addslashes($privmsg['privmsgs_text'])) . "')";
                if ( !$titanium_db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not insert private message sent text', '', __LINE__, __FILE__, $sql);
                }
        }

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
       $attachment_mod['pm']->duplicate_attachment_pm($privmsg['privmsgs_attachment'], $privmsg['privmsgs_id'], $privmsg_sent_id);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

        //
        // Pick a folder, any folder, so long as it's one below ...
        //
        $post_urls = array(
                'post' => append_titanium_sid("privmsg.$phpEx?mode=post"),
                'reply' => append_titanium_sid("privmsg.$phpEx?mode=reply&amp;" . POST_POST_URL . "=$privmsg_id"),
                'quote' => append_titanium_sid("privmsg.$phpEx?mode=quote&amp;" . POST_POST_URL . "=$privmsg_id"),
                'edit' => append_titanium_sid("privmsg.$phpEx?mode=edit&amp;" . POST_POST_URL . "=$privmsg_id")
        );
        $post_icons = array(
                'post_img' => '<a href="' . $post_urls['post'] . '"><img src="' . $images['pm_postmsg'] . '" alt="' . $titanium_lang['Post_new_pm'] . '" border="0"></a>',
                'post' => '<a href="' . $post_urls['post'] . '">' . $titanium_lang['Post_new_pm'] . '</a>',
                'reply_img' => '<a href="' . $post_urls['reply'] . '"><img src="' . $images['pm_replymsg'] . '" alt="' . $titanium_lang['Post_reply_pm'] . '" border="0"></a>',
                'reply' => '<a href="' . $post_urls['reply'] . '">' . $titanium_lang['Post_reply_pm'] . '</a>',
                'quote_img' => '<a href="' . $post_urls['quote'] . '"><img src="' . $images['pm_quotemsg'] . '" alt="' . $titanium_lang['Post_quote_pm'] . '" border="0"></a>',
                'quote' => '<a href="' . $post_urls['quote'] . '">' . $titanium_lang['Post_quote_pm'] . '</a>',
                'edit_img' => '<a href="' . $post_urls['edit'] . '"><img src="' . $images['pm_editmsg'] . '" alt="' . $titanium_lang['Edit_pm'] . '" border="0"></a>',
                'edit' => '<a href="' . $post_urls['edit'] . '">' . $titanium_lang['Edit_pm'] . '</a>'
        );

        if ( $folder == 'inbox' )
        {
                $post_img = $post_icons['post_img'];
                $reply_img = $post_icons['reply_img'];
                $quote_img = $post_icons['quote_img'];
                $edit_img = '';
                $post = $post_icons['post'];
                $reply = $post_icons['reply'];
                /**
                 *  Code added for use with reposnsive themes
                 */
                $reply_uri = $post_urls['reply'];
                $reply_locale = $titanium_lang['Post_reply_pm'];
                
                $quote = $post_icons['quote'];
                $l_box_name = $titanium_lang['Inbox'];
                /**
                 *  Code added for use with reposnsive themes
                 */
                $edit = '';
                $edit_uri = '';
                $edit_locale = '';
        }
        else if ( $folder == 'outbox' )
        {
                $post_img = $post_icons['post_img'];
                $reply_img = '';
                $quote_img = '';
                $edit_img = $post_icons['edit_img'];
                $post = $post_icons['post'];
                $reply = '';
                /**
                 *  Code added for use with reposnsive themes
                 */
                $reply_uri = '';
                $reply_locale = '';

                $quote = '';
                $edit = $post_icons['edit'];
                $l_box_name = $titanium_lang['Outbox'];
                /**
                 *  Code added for use with reposnsive themes
                 */
                $edit_uri = $post_urls['edit'];
                $edit_locale = $titanium_lang['Edit_pm'];
                
        }
        else if ( $folder == 'savebox' )
        {
                if ( $privmsg['privmsgs_type'] == PRIVMSGS_SAVED_IN_MAIL )
                {
                        $post_img = $post_icons['post_img'];
                        $reply_img = $post_icons['reply_img'];
                        $quote_img = $post_icons['quote_img'];
                        $edit_img = '';
                        $post = $post_icons['post'];
                        $reply = $post_icons['reply'];
                        /**
                         *  Code added for use with reposnsive themes
                         */
                        $reply_uri = $post_urls['reply'];
                        $reply_locale = $titanium_lang['Post_reply_pm'];

                        $quote = $post_icons['quote'];
                        $edit = '';
                        /**
                         *  Code added for use with reposnsive themes
                         */
                        $edit_uri = '';
                        $edit_locale = '';
                }
                else
                {
                        $post_img = $post_icons['post_img'];
                        $reply_img = '';
                        $quote_img = '';
                        $edit_img = '';
                        $post = $post_icons['post'];
                        $reply = '';
                        /**
                         *  Code added for use with reposnsive themes
                         */
                        $reply_uri = '';
                        $reply_locale = '';

                        $quote = '';
                        $edit = '';
                        /**
                         *  Code added for use with reposnsive themes
                         */
                        $edit_uri = '';
                        $edit_locale = '';
                }
                $l_box_name = $titanium_lang['Saved'];
        }
        else if ( $folder == 'sentbox' )
        {
                $post_img = $post_icons['post_img'];
                $reply_img = '';
                $quote_img = '';
                $edit_img = '';
                $post = $post_icons['post'];
                $reply = '';
                /**
                 *  Code added for use with reposnsive themes
                 */
                $reply_uri = '';
                $reply_locale = '';

                $quote = '';
                $edit = '';
                $l_box_name = $titanium_lang['Sent'];
                /**
                 *  Code added for use with reposnsive themes
                 */
                $edit_uri = '';
                $edit_locale = '';
                
        }

        $s_hidden_fields = '<input type="hidden" name="mark[]" value="' . $privmsgs_id . '" />';

        $phpbb2_page_title = $titanium_lang['Read_pm'];
        include(NUKE_INCLUDE_DIR.'page_header.php');

        //
        // Load templates
        //
        $phpbb2_template->set_filenames(array(
                'body' => 'privmsgs_read_body.tpl')
        );
        if (is_active("Forums")) {
            make_jumpbox('viewforum.'.$phpEx);
        }

        $titanium_user_id_from = $privmsg['user_id_1'];
        $titanium_user_id_to = $privmsg['user_id_2'];

        switch( $privmsg['user_avatar_type'] ):
	
			# user_allowavatar = 1
			case USER_AVATAR_UPLOAD:
				$phpbb2_poster_avatar = ( $phpbb2_board_config['allow_avatar_upload'] ) ? '<img class="priv-msgs-avatar" style="max-height: '.$phpbb2_board_config['avatar_max_height'].'px; max-width: '.$phpbb2_board_config['avatar_max_width'].'px;" src="' . $phpbb2_board_config['avatar_path'] . '/' . $privmsg['user_avatar'] . '" alt="" border="0" />' : '';
				break;

			# user_allowavatar = 2
			case USER_AVATAR_REMOTE:
				// $evouserinfo_avatar .= avatar_resize($userinfo['user_avatar']);
				$phpbb2_poster_avatar = '<img class="priv-msgs-avatar" style="max-height: '.$phpbb2_board_config['avatar_max_height'].'px; max-width: '.$phpbb2_board_config['avatar_max_width'].'px;" src="'.avatar_resize($privmsg['user_avatar']).'" alt="" border="0" />';
				break;

			# user_allowavatar = 3
			case USER_AVATAR_GALLERY:
				$phpbb2_poster_avatar = ( $phpbb2_board_config['allow_avatar_local'] ) ? '<img class="priv-msgs-avatar" style="max-height: '.$phpbb2_board_config['avatar_max_height'].'px; max-width: '.$phpbb2_board_config['avatar_max_width'].'px;" src="' . $phpbb2_board_config['avatar_gallery_path'] . '/' . (($privmsg['user_avatar'] == 'blank.gif' || $privmsg['user_avatar'] == 'gallery/blank.gif') ? 'blank.png' : $privmsg['user_avatar']) . '" alt="" border="0" />' : '';
				break;
		
		endswitch;

        $phpbb2_template->assign_vars(array(
        		'MODULE_NAME' => $mod_name,
        		'MODULE_URI' => append_titanium_sid("privmsg.$phpEx"),
        		'SENDER_AVATAR' => $phpbb2_poster_avatar,
        		'SENDER_PROIFLE_URI' => "modules.php?name=Profile&mode=viewprofile&amp;" . POST_USERS_URL . '=' . $titanium_user_id_from,
        		'MESSAGE_INBOX_URI' => 'modules.php?name=Private_Messages&file=index&folder=inbox&mode=read&p=' . $privmsgs_id,

                'INBOX_IMG' => $inbox_img,
                'SENTBOX_IMG' => $sentbox_img,
                'OUTBOX_IMG' => $outbox_img,
                'SAVEBOX_IMG' => $savebox_img,
                'INBOX' => $inbox_url,

                //'POST_PM_IMG' => $post_img,
				'POST_PM_IMG' => 'BUTTON REPLACE',
                'REPLY_PM_IMG' => $reply_img,
                'EDIT_PM_IMG' => $edit_img,
                'QUOTE_PM_IMG' => $quote_img,
                'POST_PM' => $post,
                'REPLY_PM' => $reply,

                /**
                 *  Code added for use with reposnsive themes
                 */
                'REPLY_URI' => $reply_uri,
                'REPLY_LOCALE' => $reply_locale,
                'EDIT_URI' => $edit_uri,
                'EDIT_LOCALE' => $edit_locale,

                'EDIT_PM' => $edit,
                'QUOTE_PM' => $quote,


                'SENTBOX' => $sentbox_url,
                'OUTBOX' => $outbox_url,
                'SAVEBOX' => $savebox_url,

                'BOX_NAME' => $l_box_name,

                'L_MESSAGE' => $titanium_lang['Message'],
                'L_INBOX' => $titanium_lang['Inbox'],
                'L_OUTBOX' => $titanium_lang['Outbox'],
                'L_SENTBOX' => $titanium_lang['Sent'],
                'L_SAVEBOX' => $titanium_lang['Saved'],
                'L_FLAG' => $titanium_lang['Flag'],
                'L_SUBJECT' => $titanium_lang['Subject'],
                'L_POSTED' => $titanium_lang['Posted'],
                'L_DATE' => $titanium_lang['Date'],
                'L_FROM' => $titanium_lang['From'],
                'L_TO' => $titanium_lang['To'],
                'L_SAVE_MSG' => $titanium_lang['Save_message'],
                'L_DELETE_MSG' => $titanium_lang['Delete_message'],

                'S_PRIVMSGS_ACTION' => append_titanium_sid("privmsg.$phpEx?folder=$folder"),
                'S_HIDDEN_FIELDS' => $s_hidden_fields)
        );

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
      init_display_pm_attachments($privmsg['privmsgs_attachment']);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

        $post_date = create_date($phpbb2_board_config['default_dateformat'], $privmsg['privmsgs_date'], $phpbb2_board_config['board_timezone']);

        $temp_url = "modules.php?name=Profile&mode=viewprofile&amp;" . POST_USERS_URL . '=' . $titanium_user_id_from;
        $profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $titanium_lang['Read_profile'] . '" title="' . $titanium_lang['Read_profile'] . '" border="0" /></a>';
        $profile = '<a href="' . $temp_url . '">' . $titanium_lang['Read_profile'] . '</a>';

        $temp_url = append_titanium_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$titanium_user_id_from");
        $pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $titanium_lang['Send_private_message'] . '" title="' . $titanium_lang['Send_private_message'] . '" border="0" /></a>';
        $pm = '<a href="' . $temp_url . '">' . $titanium_lang['Send_private_message'] . '</a>';

        if ( !empty($privmsg['user_viewemail']) || $userdata['user_level'] == ADMIN )
        {
                $email_uri = ( $phpbb2_board_config['board_email_form'] ) ? "modules.php?name=Profile&mode=email&amp;" . POST_USERS_URL .'=' . $titanium_user_id_from : 'mailto:' . $privmsg['user_email'];

                $email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $titanium_lang['Send_email'] . '" title="' . $titanium_lang['Send_email'] . '" border="0" /></a>';
                $email = '<a href="' . $email_uri . '">' . $titanium_lang['Send_email'] . '</a>';
        }
        else
        {
                $email_img = '';
                $email = '';
        }

        $www_img = ( $privmsg['user_website'] ) ? '<a href="' . $privmsg['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $titanium_lang['Visit_website'] . '" title="' . $titanium_lang['Visit_website'] . '" border="0" /></a>' : '';
        $www = ( $privmsg['user_website'] ) ? '<a href="' . $privmsg['user_website'] . '" target="_userwww">' . $titanium_lang['Visit_website'] . '</a>' : '';
		
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
		$phpbb2_bday_month_day = floor($privmsg['user_birthday'] / 10000);
		$phpbb2_bday_year_age = ( $privmsg['birthday_display'] != BIRTHDAY_NONE && $privmsg['birthday_display'] != BIRTHDAY_DATE ) ? $privmsg['user_birthday'] - 10000*$phpbb2_bday_month_day : 0;
		$phpbb2_fudge = ( gmdate('md') < $phpbb2_bday_month_day ) ? 1 : 0;
		$phpbb2_age = ( $phpbb2_bday_year_age ) ? gmdate('Y')-$phpbb2_bday_year_age-$phpbb2_fudge : false;
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

        $temp_url = "modules.php?name=Profile&mode=viewprofile&amp;" . POST_USERS_URL . "=$titanium_user_id_from";

        $temp_url = "modules.php?name=Forums&amp;file=search&amp;search_author=" . urlencode($titanium_username_from) . "&amp;showresults=posts";
        $search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($titanium_lang['Search_user_posts'], $titanium_username_from) . '" title="' . sprintf($titanium_lang['Search_user_posts'], $titanium_username_from) . '" border="0" /></a>';
        $search = '<a href="' . $temp_url . '">' . sprintf($titanium_lang['Search_user_posts'], $titanium_username_from) . '</a>';
/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
        if ($privmsg['user_session_time_1'] >= (time()-$phpbb2_board_config['online_time']))
        {
            if ($privmsg['user_allow_viewonline_1'])
            {
                $online_status_img = '<a href="' . append_titanium_sid("viewonline.$phpEx") . '"><img src="' . $images['icon_online'] . '" alt="' . sprintf($titanium_lang['is_online'], $titanium_username_from) . '" title="' . sprintf($titanium_lang['is_online'], $titanium_username_from) . '" /></a>&nbsp;';
                $online_status = '&nbsp;(<strong><a href="' . append_titanium_sid("viewonline.$phpEx") . '" title="' . sprintf($titanium_lang['is_online'], $titanium_username_from) . '"' . $online_color . '>' . $titanium_lang['Online'] . '</a></strong>)';
            }
            else if ($userdata['user_level'] == ADMIN || $userdata['user_id'] == $titanium_user_id_from)
            {
                $online_status_img = '<a href="' . append_titanium_sid("viewonline.$phpEx") . '"><img src="' . $images['icon_hidden'] . '" alt="' . sprintf($titanium_lang['is_hidden'], $titanium_username_from) . '" title="' . sprintf($titanium_lang['is_hidden'], $titanium_username_from) . '" /></a>&nbsp;';
                $online_status = '&nbsp;(<strong><em><a href="' . append_titanium_sid("viewonline.$phpEx") . '" title="' . sprintf($titanium_lang['is_hidden'], $titanium_username_from) . '"' . $hidden_color . '>' . $titanium_lang['Hidden'] . '</a></em></strong>)';
            }
            else
            {
                $online_status_img = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($titanium_lang['is_offline'], $titanium_username_from) . '" title="' . sprintf($titanium_lang['is_offline'], $titanium_username_from) . '" />&nbsp;';
                $online_status = '&nbsp;(<span title="' . sprintf($titanium_lang['is_offline'], $titanium_username_from) . '"' . $offline_color . '><strong>' . $titanium_lang['Offline'] . '</strong></span>)';
            }
        }
        else
        {
            $online_status_img = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($titanium_lang['is_offline'], $titanium_username_from) . '" title="' . sprintf($titanium_lang['is_offline'], $titanium_username_from) . '" />&nbsp;';
            $online_status = '&nbsp;(<span title="' . sprintf($titanium_lang['is_offline'], $titanium_username_from) . '"' . $offline_color . '><strong>' . $titanium_lang['Offline'] . '</strong></span>)';
        }

        if ($privmsg['user_session_time_2'] >= (time()-$phpbb2_board_config['online_time']))
        {
            if ($privmsg['user_allow_viewonline_2'])
            {
                $online_status_2 = '&nbsp;(<strong><a href="' . append_titanium_sid("viewonline.$phpEx") . '" title="' . sprintf($titanium_lang['is_online'], $titanium_username_to) . '"' . $online_color . '>' . $titanium_lang['Online'] . '</a></strong>)';
            }
            else if ($userdata['user_level'] == ADMIN || $userdata['user_id'] == $titanium_user_id_to)
            {
                $online_status_2 = '&nbsp;(<strong><em><a href="' . append_titanium_sid("viewonline.$phpEx") . '" title="' . sprintf($titanium_lang['is_hidden'], $titanium_username_to) . '"' . $hidden_color . '>' . $titanium_lang['Hidden'] . '</a></em></strong>)';
            }
            else
            {
            $online_status_2 = '&nbsp;(<span title="' . sprintf($titanium_lang['is_offline'], $titanium_username_to) . '"' . $offline_color . '>' . $titanium_lang['Offline'] . '</strong></span>)';
            }
        }
        else
        {
            $online_status_2 = '&nbsp;(<span title="' . sprintf($titanium_lang['is_offline'], $titanium_username_to) . '"' . $offline_color . '><strong>' . $titanium_lang['Offline'] . '</strong></span>)';
        }
/*****[END]********************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/

        //
        // Processing of post
        //
/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
        $post_subject = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($privmsg['privmsgs_subject']) : $privmsg['privmsgs_subject'];
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/

        $private_message = $privmsg['privmsgs_text'];
        $bbcode_uid = $privmsg['privmsgs_bbcode_uid'];

        if ( $phpbb2_board_config['allow_sig'] )
        {
                $titanium_user_sig = ( $privmsg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig'] : $privmsg['user_sig'];
        }
        else
        {
                $titanium_user_sig = '';
        }

        $titanium_user_sig_bbcode_uid = ( $privmsg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig_bbcode_uid'] : $privmsg['user_sig_bbcode_uid'];

        //
        // If the board has HTML off but the post has HTML
        // on then we process it, else leave it alone
        //
        if ( !$phpbb2_board_config['allow_html'] || !$userdata['user_allowhtml'])
        {
                if ( !empty($titanium_user_sig))
                {
                        $titanium_user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $titanium_user_sig);
                }

                if ( $privmsg['privmsgs_enable_html'] )
                {
                        $private_message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $private_message);
                }
        }

        if ( !empty($titanium_user_sig) && $privmsg['privmsgs_attach_sig'] && !empty($titanium_user_sig_bbcode_uid) )
        {
                $titanium_user_sig = ( $phpbb2_board_config['allow_bbcode'] ) ? bbencode_second_pass($titanium_user_sig, $titanium_user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $titanium_user_sig);
        }

        if ( !empty($bbcode_uid) )
        {
                $private_message = ( $phpbb2_board_config['allow_bbcode'] ) ? bbencode_second_pass($private_message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $private_message);
        }

        $private_message = make_clickable($private_message);

        if ( $privmsg['privmsgs_attach_sig'] && !empty($titanium_user_sig) )
        {
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 [ Mod:     Bottom aligned signature           v1.2.0 ]
 ******************************************************/
                $private_message .= '<br />' . $phpbb2_board_config['sig_line'] . '<br />' . make_clickable($titanium_user_sig);
/*****[END]********************************************
 [ Mod:     Bottom aligned signature           v1.2.0 ]
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
        }

        $orig_word = array();
        $replacement_word = array();
        obtain_word_list($orig_word, $replacement_word);

        if ( count($orig_word) )
        {
                $post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
                $private_message = preg_replace($orig_word, $replacement_word, $private_message);
        }

        if ( $phpbb2_board_config['allow_smilies'] && $privmsg['privmsgs_enable_smilies'] )
        {
                $private_message = smilies_pass($private_message);
        }

/*****[BEGIN]******************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/
        $private_message = word_wrap_pass($private_message);
/*****[END]********************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/

        $private_message = str_replace("\n", '<br />', $private_message);

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $titanium_username_from = UsernameColor($privmsg['username_1']);
        $titanium_username_to = UsernameColor($privmsg['username_2']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

        //
        // Dump it to the templating engine
        //
        $phpbb2_template->assign_vars(array(
                'MESSAGE_TO' => $titanium_username_to,
                // 'MESSAGE_FROM' => $titanium_username_from,
                'MESSAGE_FROM' => (($privmsg['privmsgs_from_userid'] == 1) ? $phpbb2_board_config['welcome_pm_username'] : $titanium_username_from),
                'MESSAGE_FROM_ID' => $privmsg['privmsgs_from_userid'],
                'RANK_IMAGE' => $rank_image,
                'POSTER_JOINED' => $poster_joined,
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'POSTER_AGE' => ( $phpbb2_age !== false ) ? sprintf($titanium_lang['Age'], $phpbb2_age) : '',
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
                'POSTER_POSTS' => $poster_posts,
                'POSTER_FROM' => $poster_from,
                'POSTER_AVATAR' => $phpbb2_poster_avatar,
                'POST_SUBJECT' => $post_subject,
                'POST_DATE' => $post_date,
                'MESSAGE' => $private_message,
/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
                'POSTER_FROM_ONLINE_STATUS_IMG' => $online_status_img,
                'POSTER_FROM_ONLINE_STATUS' => $online_status,
                'POSTER_TO_ONLINE_STATUS' => $online_status_2,
/*****[END]********************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/

                'PROFILE_IMG' => $profile_img,
                'PROFILE' => $profile,
                'SEARCH_IMG' => $search_img,
                'SEARCH' => $search,
                'EMAIL_IMG' => $email_img,
                'EMAIL' => $email,
                'WWW_IMG' => $www_img,
                'WWW' => $www)
        );

/*****[BEGIN]******************************************
 [ Mod:    PM Quick Reply                      v1.3.5 ]
 ******************************************************/
        include(NUKE_INCLUDE_DIR.'ropm_quick_reply.php');
/*****[END]********************************************
 [ Mod:    PM Quick Reply                      v1.3.5 ]
 ******************************************************/

        $phpbb2_template->pparse('body');

        include(NUKE_INCLUDE_DIR.'page_tail.php');

}
else if ( ( $delete && $mark_list ) || $delete_all )
{
        if ( !$userdata['session_logged_in'] )
        {
                // not needed anymore due to function redirect_titanium()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect_titanium("modules.php?name=Your_Account&redirect=privmsg&folder=inbox");
                //redirect_titanium(append_titanium_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=inbox", true));
                exit;
        }

        if ( isset($mark_list) && !is_array($mark_list) )
        {
                // Set to empty array instead of '0' if nothing is selected.
                $mark_list = array();
        }

        if ( !$confirm )
        {
                $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
                $s_hidden_fields .= ( isset($_POST['delete']) ) ? '<input type="hidden" name="delete" value="true" />' : '<input type="hidden" name="deleteall" value="true" />';
                $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

                for($i = 0; $i < count($mark_list); $i++)
                {
                        $s_hidden_fields .= '<input type="hidden" name="mark[]" value="' . intval($mark_list[$i]) . '" />';
                }

                //
                // Output confirmation page
                //
                include(NUKE_INCLUDE_DIR.'page_header.php');

                $phpbb2_template->set_filenames(array(
                        'confirm_body' => 'confirm_body.tpl')
                );
                $phpbb2_template->assign_vars(array(
                        'MESSAGE_TITLE' => $titanium_lang['Information'],
                        'MESSAGE_TEXT' => ( count($mark_list) == 1 ) ? $titanium_lang['Confirm_delete_pm'] : $titanium_lang['Confirm_delete_pms'],

                        'L_YES' => $titanium_lang['Yes'],
                        'L_NO' => $titanium_lang['No'],

                        'S_CONFIRM_ACTION' => append_titanium_sid("privmsg.$phpEx?folder=$folder"),
                        'S_HIDDEN_FIELDS' => $s_hidden_fields)
                );

                $phpbb2_template->pparse('confirm_body');

                include(NUKE_INCLUDE_DIR.'page_tail.php');

        }
        else if ( $confirm )
        {
				// session id check
				// if ($sid == '' || $sid != $userdata['session_id'])
				// {
				// 	message_die(GENERAL_ERROR, $titanium_lang['Session_invalid']);
				// }

                $delete_sql_id = '';

                if (!$delete_all)
                {
                   for ($i = 0; $i < count($mark_list); $i++)
                   {
                      $delete_sql_id .= ((!empty($delete_sql_id)) ? ', ' : '') . intval($mark_list[$i]);
                   }
                   $delete_sql_id = "AND privmsgs_id IN ($delete_sql_id)";
                }

                switch($folder)
                {
                   case 'inbox':
                      $delete_type = "privmsgs_to_userid = " . $userdata['user_id'] . " AND (
                      privmsgs_type = " . PRIVMSGS_READ_MAIL . " OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                      break;

                   case 'outbox':
                      $delete_type = "privmsgs_from_userid = " . $userdata['user_id'] . " AND ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                      break;

                   case 'sentbox':
                      $delete_type = "privmsgs_from_userid = " . $userdata['user_id'] . " AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
                      break;

                   case 'savebox':
                      $delete_type = "( ( privmsgs_from_userid = " . $userdata['user_id'] . "
                      AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " )
                      OR ( privmsgs_to_userid = " . $userdata['user_id'] . "
                      AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) )";
                      break;
                }

                $sql = "SELECT privmsgs_id
                   FROM " . PRIVMSGS_TABLE . "
                   WHERE $delete_type $delete_sql_id";

                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                   message_die(GENERAL_ERROR, 'Could not obtain id list to delete messages', '', __LINE__, __FILE__, $sql);
                }

                $mark_list = array();
                while ( $row = $titanium_db->sql_fetchrow($result) )
                {
                   $mark_list[] = $row['privmsgs_id'];
                }

                unset($delete_type);

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                $attachment_mod['pm']->delete_all_pm_attachments($mark_list);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

                if ( count($mark_list) )
                {
                        $delete_sql_id = '';
                        for ($i = 0; $i < count($mark_list); $i++)
                        {
                                $delete_sql_id .= ((!empty($delete_sql_id)) ? ', ' : '') . intval($mark_list[$i]);
                        }

                        if ($folder == 'inbox' || $folder == 'outbox')
                        {
                                switch ($folder)
                                {
                                        case 'inbox':
                                                $sql = "privmsgs_to_userid = " . $userdata['user_id'];
                                                break;
                                        case 'outbox':
                                                $sql = "privmsgs_from_userid = " . $userdata['user_id'];
                                                break;
                                }

                                // Get information relevant to new or unread mail
                                // so we can adjust users counters appropriately
                                $sql = "SELECT privmsgs_to_userid, privmsgs_type
                                        FROM " . PRIVMSGS_TABLE . "
                                        WHERE privmsgs_id IN ($delete_sql_id)
                                                AND $sql
                                                AND privmsgs_type IN (" . PRIVMSGS_NEW_MAIL . ", " . PRIVMSGS_UNREAD_MAIL . ")";
                                if ( !($result = $titanium_db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not obtain user id list for outbox messages', '', __LINE__, __FILE__, $sql);
                                }

                                if ( $row = $titanium_db->sql_fetchrow($result))
                                {
                                        $update_users = $update_list = array();

                                        do
                                        {
                                                switch ($row['privmsgs_type'])
                                                {
                                                        case PRIVMSGS_NEW_MAIL:
                                                                $update_users['new'][$row['privmsgs_to_userid']]++;
                                                                break;

                                                        case PRIVMSGS_UNREAD_MAIL:
                                                                $update_users['unread'][$row['privmsgs_to_userid']]++;
                                                                break;
                                                }
                                        }
                                        while ($row = $titanium_db->sql_fetchrow($result));

                                        if (count($update_users))
                                        {
                                                while (list($type, $titanium_users) = each($update_users))
                                                {
                                                        while (list($titanium_user_id, $dec) = each($titanium_users))
                                                        {
                                                                $update_list[$type][$dec][] = $titanium_user_id;
                                                        }
                                                }
                                                unset($update_users);

                                                while (list($type, $dec_ary) = each($update_list))
                                                {
                                                        switch ($type)
                                                        {
                                                                case 'new':
                                                                        $type = "user_new_privmsg";
                                                                        break;

                                                                case 'unread':
                                                                        $type = "user_unread_privmsg";
                                                                        break;
                                                        }

                                                        while (list($dec, $titanium_user_ary) = each($dec_ary))
                                                        {
                                                                $titanium_user_ids = implode(', ', $titanium_user_ary);

                                                                $sql = "UPDATE " . USERS_TABLE . "
                                                                        SET $type = $type - $dec
                                                                        WHERE user_id IN ($titanium_user_ids)";
                                                                if ( !$titanium_db->sql_query($sql) )
                                                                {
                                                                        message_die(GENERAL_ERROR, 'Could not update user pm counters', '', __LINE__, __FILE__, $sql);
                                                                }
                                                        }
                                                }
                                                unset($update_list);
                                        }
                                }
                                $titanium_db->sql_freeresult($result);
                        }

                        // Delete the messages
                        $delete_text_sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
                                WHERE privmsgs_text_id IN ($delete_sql_id)";
                        $delete_sql = "DELETE FROM " . PRIVMSGS_TABLE . "
                                WHERE privmsgs_id IN ($delete_sql_id)
                                        AND ";

                        switch( $folder )
                        {
                                case 'inbox':
                                        $delete_sql .= "privmsgs_to_userid = " . $userdata['user_id'] . " AND (
                                                privmsgs_type = " . PRIVMSGS_READ_MAIL . " OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                                        break;

                                case 'outbox':
                                        $delete_sql .= "privmsgs_from_userid = " . $userdata['user_id'] . " AND (
                                                privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                                        break;

                                case 'sentbox':
                                        $delete_sql .= "privmsgs_from_userid = " . $userdata['user_id'] . " AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
                                        break;

                                case 'savebox':
                                        $delete_sql .= "( ( privmsgs_from_userid = " . $userdata['user_id'] . "
                                                AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " )
                                        OR ( privmsgs_to_userid = " . $userdata['user_id'] . "
                                                AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) )";
                                        break;
                        }

                        if ( !$titanium_db->sql_query($delete_sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
                        }

                        if ( !$titanium_db->sql_query($delete_text_sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
                        }
                }
        }
}
else if ( $save && $mark_list && $folder != 'savebox' && $folder != 'outbox' )
{
        if ( !$userdata['session_logged_in'] )
        {
                // not needed anymore due to function redirect_titanium()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect_titanium("modules.php?name=Your_Account&redirect=privmsg&folder=inbox");
                //redirect_titanium(append_titanium_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=inbox", true));
                exit;
        }

        if (count($mark_list))
        {
                // See if recipient is at their savebox limit
                $sql = "SELECT COUNT(privmsgs_id) AS savebox_items, MIN(privmsgs_date) AS oldest_post_time
                        FROM " . PRIVMSGS_TABLE . "
                        WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . "
                                        AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                                OR ( privmsgs_from_userid = " . $userdata['user_id'] . "
                                        AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )";
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain sent message info for sendee', '', __LINE__, __FILE__, $sql);
                }

                $sql_priority = ( SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') ? 'LOW_PRIORITY' : '';

                if ( $saved_info = $titanium_db->sql_fetchrow($result) )
                {
                        if ($phpbb2_board_config['max_savebox_privmsgs'] && $saved_info['savebox_items'] >= $phpbb2_board_config['max_savebox_privmsgs'] )
                        {
                                $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                                        WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . "
                                                                AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                                                        OR ( privmsgs_from_userid = " . $userdata['user_id'] . "
                                                                AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )
                                                AND privmsgs_date = " . $saved_info['oldest_post_time'];
                                if ( !$result = $titanium_db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
                                }
                                $old_privmsgs_id = $titanium_db->sql_fetchrow($result);
                                $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];

                                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                                        WHERE privmsgs_id = '$old_privmsgs_id'";
                                if ( !$titanium_db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
                                }

                                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                                        WHERE privmsgs_text_id = '$old_privmsgs_id'";
                                if ( !$titanium_db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (save)', '', __LINE__, __FILE__, $sql);
                                }
                        }
                }

                $saved_sql_id = '';
                for ($i = 0; $i < count($mark_list); $i++)
                {
                        $saved_sql_id .= ((!empty($saved_sql_id)) ? ', ' : '') . intval($mark_list[$i]);
                }

                // Process request
                $saved_sql = "UPDATE " . PRIVMSGS_TABLE;

                // Decrement read/new counters if appropriate
                if ($folder == 'inbox' || $folder == 'outbox')
                {
                        switch ($folder)
                        {
                                case 'inbox':
                                        $sql = "privmsgs_to_userid = " . $userdata['user_id'];
                                        break;
                                case 'outbox':
                                        $sql = "privmsgs_from_userid = " . $userdata['user_id'];
                                        break;
                        }

                        // Get information relevant to new or unread mail
                        // so we can adjust users counters appropriately
                        $sql = "SELECT privmsgs_to_userid, privmsgs_type
                                FROM " . PRIVMSGS_TABLE . "
                                WHERE privmsgs_id IN ($saved_sql_id)
                                        AND $sql
                                        AND privmsgs_type IN (" . PRIVMSGS_NEW_MAIL . ", " . PRIVMSGS_UNREAD_MAIL . ")";
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain user id list for outbox messages', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $row = $titanium_db->sql_fetchrow($result))
                        {
                                $update_users = $update_list = array();

                                do
                                {
                                        switch ($row['privmsgs_type'])
                                        {
                                                case PRIVMSGS_NEW_MAIL:
                                                        $update_users['new'][$row['privmsgs_to_userid']]++;
                                                        break;

                                                case PRIVMSGS_UNREAD_MAIL:
                                                        $update_users['unread'][$row['privmsgs_to_userid']]++;
                                                        break;
                                        }
                                }
                                while ($row = $titanium_db->sql_fetchrow($result));

                                if (count($update_users))
                                {
                                        while (list($type, $titanium_users) = each($update_users))
                                        {
                                                while (list($titanium_user_id, $dec) = each($titanium_users))
                                                {
                                                        $update_list[$type][$dec][] = $titanium_user_id;
                                                }
                                        }
                                        unset($update_users);

                                        while (list($type, $dec_ary) = each($update_list))
                                        {
                                                switch ($type)
                                                {
                                                        case 'new':
                                                                $type = "user_new_privmsg";
                                                                break;

                                                        case 'unread':
                                                                $type = "user_unread_privmsg";
                                                                break;
                                                }

                                                while (list($dec, $titanium_user_ary) = each($dec_ary))
                                                {
                                                        $titanium_user_ids = implode(', ', $titanium_user_ary);

                                                        $sql = "UPDATE " . USERS_TABLE . "
                                                                SET $type = $type - $dec
                                                                WHERE user_id IN ($titanium_user_ids)";
                                                        if ( !$titanium_db->sql_query($sql) )
                                                        {
                                                                message_die(GENERAL_ERROR, 'Could not update user pm counters', '', __LINE__, __FILE__, $sql);
                                                        }
                                                }
                                        }
                                        unset($update_list);
                                }
                        }
                        $titanium_db->sql_freeresult($result);
                }

                switch ($folder)
                {
                        case 'inbox':
                                $saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . "
                                        WHERE privmsgs_to_userid = " . $userdata['user_id'] . "
                                                AND ( privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                                        OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . ")";
                                break;

                        case 'outbox':
                                $saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . "
                                        WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                                                AND ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) ";
                                break;

                        case 'sentbox':
                                $saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . "
                                        WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                                                AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
                                break;
                }

                $saved_sql .= " AND privmsgs_id IN ($saved_sql_id)";

                if ( !$titanium_db->sql_query($saved_sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not save private messages', '', __LINE__, __FILE__, $saved_sql);
                }
                // not needed anymore due to function redirect_titanium()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect_titanium(append_titanium_sid("privmsg.$phpEx?folder=savebox", true));
                exit;
        }
}
else if ( $submit || $refresh || !empty($mode) )
{
        if ( !$userdata['session_logged_in'] )
        {
                $titanium_user_id = ( isset($_GET[POST_USERS_URL]) ) ? '&' . POST_USERS_URL . '=' . intval($_GET[POST_USERS_URL]) : '';
                // not needed anymore due to function redirect_titanium()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect_titanium("modules.php?name=Your_Account&redirect=privmsg&folder=$folder&mode=$mode" . $titanium_user_id);
                //redirect_titanium(append_titanium_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=$folder&mode=$mode" . $titanium_user_id, true));
                exit;
        }

        //
        // Toggles
        //
        if ( !$phpbb2_board_config['allow_html'] )
        {
                $html_on = 0;
        }
        else
        {
                $html_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_html']) ) ? 0 : TRUE ) : $userdata['user_allowhtml'];
        }

        if ( !$phpbb2_board_config['allow_bbcode'] )
        {
                $bbcode_on = 0;
        }
        else
        {
                $bbcode_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_bbcode']) ) ? 0 : TRUE ) : $userdata['user_allowbbcode'];
        }

        if ( !$phpbb2_board_config['allow_smilies'] )
        {
                $smilies_on = 0;
        }
        else
        {
                $smilies_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_smilies']) ) ? 0 : TRUE ) : $userdata['user_allowsmile'];
        }

        $attach_sig = ( $submit || $refresh ) ? ( ( !empty($_POST['attach_sig']) ) ? TRUE : 0 ) : $userdata['user_attachsig'];
        $titanium_user_sig = ( !empty($userdata['user_sig']) && $phpbb2_board_config['allow_sig'] ) ? $userdata['user_sig'] : "";

        if ( $submit && $mode != 'edit' )
        {
                //
                // Flood control
                //
                $sql = "SELECT MAX(privmsgs_date) AS last_post_time
                        FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_from_userid = " . $userdata['user_id'];
                if ( $result = $titanium_db->sql_query($sql) )
                {
                        $titanium_db_row = $titanium_db->sql_fetchrow($result);

                        $phpbb2_last_post_time = $titanium_db_row['last_post_time'];
                        $current_time = time();

                        if ( ( $current_time - $phpbb2_last_post_time ) < $phpbb2_board_config['flood_interval'])
                        {
                                message_die(GENERAL_MESSAGE, $titanium_lang['Flood_Error']);
                        }
                }
                //
                // End Flood control
                //
        }

    if ($submit && $mode == 'edit')
    {
        $sql = 'SELECT privmsgs_from_userid
            FROM ' . PRIVMSGS_TABLE . '
            WHERE privmsgs_id = ' . (int) $privmsg_id . '
                AND privmsgs_from_userid = ' . $userdata['user_id'];

        if (!($result = $titanium_db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, "Could not obtain message details", "", __LINE__, __FILE__, $sql);
        }

        if (!($row = $titanium_db->sql_fetchrow($result)))
        {
            message_die(GENERAL_MESSAGE, $titanium_lang['No_such_post']);
        }
        $titanium_db->sql_freeresult($result);

        unset($row);
    }

        if ( $submit )
        {
        		// session id check
        		// if ($sid == '' || $sid != $userdata['session_id'])
        		// {
        		// 	$error = true;
        		// 	$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $titanium_lang['Session_invalid'];
        		// }

                if ( !empty($_POST['username']) )
                {
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                        $to_username_array = explode (";", $_POST['username']);
                        sort ($to_username_array);
                        foreach ($to_username_array as $name) $to_usernames .= "'".phpbb_clean_username($name)."',";
                        $to_usernames[strlen($to_usernames)-1]=" ";

                        $sql = "SELECT user_id, username, user_notify_pm, user_email, user_lang, user_active
                                FROM " . USERS_TABLE . "
                                WHERE username IN ($to_usernames)
                                        AND user_id <> " . ANONYMOUS . " ORDER BY username ASC";

                        if( !($result2 = $titanium_db->sql_query($sql)) )
                        {
                            message_die(GENERAL_ERROR, 'Could not obtain users PM information', '', __LINE__, __FILE__, $sql);
                        }
                        $to_users = $titanium_db->sql_fetchrowset($result2);
                        $n=0;
                        while ($to_username_array[$n] && !$error)
                        {
                        if (strcasecmp($to_users[$n]['username'], str_replace("\'", "'",$to_username_array[$n])))
                        {
                            $error = TRUE;
                            $error_msg .= $titanium_lang['No_such_user']." '".str_replace("\'", "'", $to_username_array[$n]);
                        }
                        $n++;
                    }
                }
                else
                {
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                        $error = TRUE;
                        $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $titanium_lang['No_to_user'];
                }

                $privmsg_subject = trim(htmlspecialchars($_POST['subject']));
                if ( empty($privmsg_subject) )
                {
                        $error = TRUE;
                        $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $titanium_lang['Empty_subject'];
                }

                if ( !empty($_POST['message']) )
                {
                        if ( !$error )
                        {
                                if ( $bbcode_on )
                                {
                                        $bbcode_uid = make_bbcode_uid();
                                }

                                $privmsg_message = prepare_message($_POST['message'], $html_on, $bbcode_on, $smilies_on, $bbcode_uid);

/*****[BEGIN]******************************************
 [ Mod:     Extended PM Notification           v1.1.5 ]
 ******************************************************/
                //Clean up all BBcode UID
                $message_text = htmlspecialchars(trim(stripslashes($_POST['message'])));
                $quote = $titanium_lang['Quote'];
                $code = $titanium_lang['Code'];

                //Clean up all BBcode tags
                $bbcode_match = array('/\[quote=\&quot\;\w+\&quot\;\]/si', '/\[quote\]/si', '/\[\/quote\]/si', '/\[code\]/si', '/\[\/code\]/si', '/\[\w+\]/si', '/\[\/\w+\]/si', '/\[\w+=\w+\]/si', '/\[\/\w+=\w+\]/si','/\[\w+\]/si', '/\[\/\w+\]/si');
                $bbcode_replace = array("\n$quote >>\n", "\n$quote >>\n","\n<< $quote\n", "\n$code >>\n","\n<< $code\n",'','','','','','');
                $message_text = preg_replace($bbcode_match, $bbcode_replace, $message_text);
/*****[END]********************************************
 [ Mod:     Extended PM Notification           v1.1.5 ]
 ******************************************************/

                        }
                }
                else
                {
                        $error = TRUE;
                        $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $titanium_lang['Empty_message'];
                }
        }

        if ( $submit && !$error )
        {
                //
                // Has admin prevented user from sending PM's?
                //
                if ( !$userdata['user_allow_pm'] )
                {
                        $message = $titanium_lang['Cannot_send_privmsg'];
                        message_die(GENERAL_MESSAGE, $message);
                }

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                foreach($to_users as $to_userdata)
                {
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

                $msg_time = time();

                if ( $mode != 'edit' )
                {
                        //
                        // See if recipient is at their inbox limit
                        //
                        $sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time
                                FROM " . PRIVMSGS_TABLE . "
                                WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                                OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )
                                        AND privmsgs_to_userid = " . $to_userdata['user_id'];
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_MESSAGE, $titanium_lang['No_such_user']);
                        }

                        $sql_priority = ( SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') ? 'LOW_PRIORITY' : '';

                        if ( $inbox_info = $titanium_db->sql_fetchrow($result) )
                        {
/*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
$max_inbox = $phpbb2_board_config['max_inbox_privmsgs'];
                        if ( $bbgroups_row['override_max_inbox'] == 1)
                        {
                        $max_inbox = $bbgroups_row['max_inbox'];
                        }
if ( $inbox_info['inbox_items'] >= $max_inbox )
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                                if ($phpbb2_board_config['max_inbox_privmsgs'] && $inbox_info['inbox_items'] >= $phpbb2_board_config['max_inbox_privmsgs'])
                                {
                                        $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                                                WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                                                OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  )
                                                        AND privmsgs_date = " . $inbox_info['oldest_post_time'] . "
                                                        AND privmsgs_to_userid = " . $to_userdata['user_id'];
                                        if ( !$result = $titanium_db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (inbox)', '', __LINE__, __FILE__, $sql);
                                        }
                                        $old_privmsgs_id = $titanium_db->sql_fetchrow($result);
                                        $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];

                                        $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                                                WHERE privmsgs_id = '$old_privmsgs_id'";
                                        if ( !$titanium_db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
                                        }

                                        $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                                                WHERE privmsgs_text_id = '$old_privmsgs_id'";
                                        if ( !$titanium_db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql);
                                        }
                                }
                        }

                        $sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
                                VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $privmsg_subject) . "', " . $userdata['user_id'] . ", " . $to_userdata['user_id'] . ", $msg_time, '$titanium_user_ip', '$html_on', '$bbcode_on', '$smilies_on', '$attach_sig')";
                }
                else
                {
                        $sql_info = "UPDATE " . PRIVMSGS_TABLE . "
                                SET privmsgs_type = " . PRIVMSGS_NEW_MAIL . ", privmsgs_subject = '" . str_replace("\'", "''", $privmsg_subject) . "', privmsgs_from_userid = " . $userdata['user_id'] . ", privmsgs_to_userid = " . $to_userdata['user_id'] . ", privmsgs_date = '$msg_time', privmsgs_ip = '$titanium_user_ip', privmsgs_enable_html = '$html_on', privmsgs_enable_bbcode = '$bbcode_on', privmsgs_enable_smilies = '$smilies_on', privmsgs_attach_sig = '$attach_sig'
                                WHERE privmsgs_id = '$privmsg_id'";
                }

                if ( !($result = $titanium_db->sql_query($sql_info)) )
                {
                        message_die(GENERAL_ERROR, "Could not insert/update private message sent info.", "", __LINE__, __FILE__, $sql_info);
                }

                if ( $mode != 'edit' )
                {
                        $privmsg_sent_id = $titanium_db->sql_nextid();

                        $sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
                                VALUES ('$privmsg_sent_id', '" . $bbcode_uid . "', '" . str_replace("\'", "''", $privmsg_message) . "')";
                }
                else
                {
                        $sql = "UPDATE " . PRIVMSGS_TEXT_TABLE . "
                                SET privmsgs_text = '" . str_replace("\'", "''", $privmsg_message) . "', privmsgs_bbcode_uid = '$bbcode_uid'
                                WHERE privmsgs_text_id = '$privmsg_id'";
                }

                if ( !$titanium_db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql);
                }

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                $attachment_mod['pm']->insert_attachment_pm($privmsg_id);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

                if ( $mode != 'edit' )
                {
                        //
                        // Add to the users new pm counter
                        //
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . "
                                WHERE user_id = " . $to_userdata['user_id'];
                        if ( !$status = $titanium_db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $to_userdata['user_notify_pm'] && !empty($to_userdata['user_email']) && $to_userdata['user_active'] )
                        {
                            $script_name = 'modules.php?name=Private_Messages&file=index';
                            $server_name = trim($phpbb2_board_config['server_name']);
                            $server_protocol = ( $phpbb2_board_config['cookie_secure'] ) ? 'https://' : 'http://';
                            $server_port = ( $phpbb2_board_config['server_port'] <> 80 ) ? ':' . trim($phpbb2_board_config['server_port']) . '/' : '/';

                            $inbox_url = $server_protocol.$server_name.$server_port.$script_name.'&folder=inbox&mode=read&p='.$privmsg_sent_id;

                            $content = str_replace( '{USERNAME}', $to_userdata['username'],  $titanium_lang['private_message_notify'] );
                            $content = str_replace( '{SENDER_USERNAME}', htmlspecialchars($userdata['username']),  $content );
                            $content = str_replace( '{SITENAME}', $phpbb2_board_config['sitename'],  $content );
                            $content = str_replace( '{PM_MESSAGE}', $message_text,  $content );
                            $content = str_replace( '{U_INBOX}', '<a href="'.$inbox_url.'">'.$inbox_url.'</a>',  $content );
                            $content = str_replace( '{EMAIL_SIG}', ((!empty($phpbb2_board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $phpbb2_board_config['board_email_sig']) : ''),  $content );

                            $headers[] = 'From: '.$phpbb2_board_config['sitename'].' <'.$phpbb2_board_config['board_email'].'>';
                            $headers[] = 'Content-Type: text/html; charset=utf-8';
                            evo_phpmailer( $to_userdata['user_email'], $titanium_lang['Notification_subject'], $content, $headers );
                        }

                    }
            }

                $phpbb2_template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url=' . append_titanium_sid("privmsg.$phpEx?folder=inbox") . '">')
                );

                $msg = $titanium_lang['Message_sent'] . '<br /><br />' . sprintf($titanium_lang['Click_return_inbox'], '<a href="' . append_titanium_sid("privmsg.$phpEx?folder=inbox") . '">', '</a> ') . '<br /><br />' . sprintf($titanium_lang['Click_return_index'], '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a>');

                message_die(GENERAL_MESSAGE, $msg);
        }
        else if ( $preview || $refresh || $error )
        {

                //
                // If we're previewing or refreshing then obtain the data
                // passed to the script, process it a little, do some checks
                // where neccessary, etc.
                //
                $to_username = (isset($_POST['username']) ) ? trim(htmlspecialchars(stripslashes($_POST['username']))) : '';
                $privmsg_subject = ( isset($_POST['subject']) ) ? trim(htmlspecialchars(stripslashes($_POST['subject']))) : '';
                $privmsg_message = ( isset($_POST['message']) ) ? trim($_POST['message']) : '';
                //$privmsg_message = preg_replace('#<textarea>#si', '&lt;textarea&gt;', $privmsg_message);
                if ( !$preview )
                {
                        $privmsg_message = stripslashes($privmsg_message);
                }

                //
                // Do mode specific things
                //
                if ( $mode == 'post' )
                {
                        $phpbb2_page_title = $titanium_lang['Post_new_pm'];

                        $titanium_user_sig = ( !empty($userdata['user_sig']) && $phpbb2_board_config['allow_sig'] ) ? $userdata['user_sig'] : '';

                }
                else if ( $mode == 'reply' )
                {
                        $phpbb2_page_title = $titanium_lang['Post_reply_pm'];

                        $titanium_user_sig = ( !empty($userdata['user_sig']) && $phpbb2_board_config['allow_sig'] ) ? $userdata['user_sig'] : '';

                }
                else if ( $mode == 'edit' )
                {
                        $phpbb2_page_title = $titanium_lang['Edit_pm'];

                        $sql = "SELECT u.user_id, u.user_sig
                                FROM " . PRIVMSGS_TABLE . " pm, " . USERS_TABLE . " u
                                WHERE pm.privmsgs_id = '$privmsg_id'
                                        AND u.user_id = pm.privmsgs_from_userid";
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Could not obtain post and post text", "", __LINE__, __FILE__, $sql);
                        }

                        if ( $postrow = $titanium_db->sql_fetchrow($result) )
                        {
                                if ( $userdata['user_id'] != $postrow['user_id'] )
                                {
                                        message_die(GENERAL_MESSAGE, $titanium_lang['Edit_own_posts']);
                                }

                                $titanium_user_sig = ( !empty($postrow['user_sig']) && $phpbb2_board_config['allow_sig'] ) ? $postrow['user_sig'] : '';
                        }
                }
        }
        else
        {
                if ( !$privmsg_id && ( $mode == 'reply' || $mode == 'edit' || $mode == 'quote' ) )
                {
                        message_die(GENERAL_ERROR, $titanium_lang['No_post_id']);
                }

                if ( !empty($_GET[POST_USERS_URL]) )
                {
                        $titanium_user_id = intval($_GET[POST_USERS_URL]);

                        $sql = "SELECT username
                                FROM " . USERS_TABLE . "
                                WHERE user_id = '$titanium_user_id'
                                        AND user_id <> " . ANONYMOUS;
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                $error = TRUE;
                                $error_msg = $titanium_lang['No_such_user'];
                        }

                        if ( $row = $titanium_db->sql_fetchrow($result) )
                        {
                                $to_username = $row['username'];
                        }
                }
                else if ( $mode == 'edit' )
                {
                        $sql = "SELECT pm.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text, u.username, u.user_id, u.user_sig
                                FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u
                                WHERE pm.privmsgs_id = '$privmsg_id'
                                        AND pmt.privmsgs_text_id = pm.privmsgs_id
                                        AND pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                                        AND ( pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                                OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )
                                        AND u.user_id = pm.privmsgs_to_userid";
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain private message for editing', '', __LINE__, __FILE__, $sql);
                        }

                        if ( !($privmsg = $titanium_db->sql_fetchrow($result)) )
                        {
                                // not needed anymore due to function redirect_titanium()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                                redirect_titanium(append_titanium_sid("privmsg.$phpEx?folder=$folder", true));
                                exit;
                        }

                        $privmsg_subject = $privmsg['privmsgs_subject'];
                        $privmsg_message = $privmsg['privmsgs_text'];
                        $privmsg_bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
                        $privmsg_bbcode_enabled = ($privmsg['privmsgs_enable_bbcode'] == 1);

                        if ( $privmsg_bbcode_enabled )
                        {
                                $privmsg_message = preg_replace("/\:(([a-z0-9]:)?)$privmsg_bbcode_uid/si", '', $privmsg_message);
                        }

                        $privmsg_message = str_replace('<br />', "\n", $privmsg_message);
                        //$privmsg_message = preg_replace('#</textarea>#si', '&lt;/textarea&gt;', $privmsg_message);

                        $titanium_user_sig = ( $phpbb2_board_config['allow_sig'] ) ? (($privmsg['privmsgs_type'] == PRIVMSGS_NEW_MAIL) ? $titanium_user_sig : $privmsg['user_sig']) : '';

                        $to_username = $privmsg['username'];
                        $to_userid = $privmsg['user_id'];

                }
                else if ( $mode == 'reply' || $mode == 'quote' )
                {

                        $sql = "SELECT pm.privmsgs_subject, pm.privmsgs_date, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text, u.username, u.user_id
                                FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u
                                WHERE pm.privmsgs_id = '$privmsg_id'
                                        AND pmt.privmsgs_text_id = pm.privmsgs_id
                                        AND pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                                        AND u.user_id = pm.privmsgs_from_userid";
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain private message for editing', '', __LINE__, __FILE__, $sql);
                        }

                        if ( !($privmsg = $titanium_db->sql_fetchrow($result)) )
                        {
                                // not needed anymore due to function redirect_titanium()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                                redirect_titanium(append_titanium_sid("privmsg.$phpEx?folder=$folder", true));
                                exit;
                        }
             			$orig_word = $replacement_word = array();
 			            obtain_word_list($orig_word, $replacement_word);
                        $privmsg_subject = ( ( !preg_match('/^Re:/', $privmsg['privmsgs_subject']) ) ? 'Re: ' : '' ) . $privmsg['privmsgs_subject'];
                        $privmsg_subject = preg_replace($orig_word, $replacement_word, $privmsg_subject);

                        $to_username = $privmsg['username'];
                        $to_userid = $privmsg['user_id'];

                        if ( $mode == 'quote' )
                        {
                                $privmsg_message = $privmsg['privmsgs_text'];
                                $privmsg_bbcode_uid = $privmsg['privmsgs_bbcode_uid'];

                                $privmsg_message = preg_replace("/\:(([a-z0-9]:)?)$privmsg_bbcode_uid/si", '', $privmsg_message);
                                $privmsg_message = str_replace('<br />', "\n", $privmsg_message);
                                //$privmsg_message = preg_replace('#</textarea>#si', '&lt;/textarea&gt;', $privmsg_message);
                                $privmsg_message = preg_replace($orig_word, $replacement_word, $privmsg_message);

                                $msg_date =  create_date($phpbb2_board_config['default_dateformat'], $privmsg['privmsgs_date'], $phpbb2_board_config['board_timezone']);

                                $privmsg_message = '[quote="' . $to_username . '"]' . $privmsg_message . '[/quote]';

                                $mode = 'reply';
                        }
                }
                else
                {
                   $privmsg_subject = $privmsg_message = $to_username = '';
                }
        }

        //
        // Has admin prevented user from sending PM's?
        //
        if ( !$userdata['user_allow_pm'] && $mode != 'edit' )
        {
                $message = $titanium_lang['Cannot_send_privmsg'];
                message_die(GENERAL_MESSAGE, $message);
        }

        //
        // Start output, first preview, then errors then post form
        //
        $phpbb2_page_title = $titanium_lang['Send_private_message'];
        include(NUKE_INCLUDE_DIR.'page_header.php');

        if ( $preview && !$error )
        {
                $orig_word = array();
                $replacement_word = array();
                obtain_word_list($orig_word, $replacement_word);

                if ( $bbcode_on )
                {
                        $bbcode_uid = make_bbcode_uid();
                }

                $preview_message = stripslashes(prepare_message($privmsg_message, $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
                $privmsg_message = stripslashes(preg_replace($html_entities_match, $html_entities_replace, $privmsg_message));

                //
                // Finalise processing as per viewtopic
                //
        if ( !$html_on || !$phpbb2_board_config['allow_html'] || !$userdata['user_allowhtml'] )
                {
                        if ( !empty($titanium_user_sig) )
                        {
                                $titanium_user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $titanium_user_sig);
                        }
                }

                if ( $attach_sig && !empty($titanium_user_sig) && $userdata['user_sig_bbcode_uid'] )
                {
                        $titanium_user_sig = bbencode_second_pass($titanium_user_sig, $userdata['user_sig_bbcode_uid']);
                }

                if ( $bbcode_on )
                {
                        $preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
                }

                if ( $attach_sig && !empty($titanium_user_sig) )
                {
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 [ Mod:     Bottom aligned signature           v1.2.0 ]
 ******************************************************/
                        $preview_message = $preview_message . '<br />' . $phpbb2_board_config['sig_line'] . '<br />' . $titanium_user_sig;
/*****[END]********************************************
 [ Mod:     Bottom aligned signature           v1.2.0 ]
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
                }

                if ( count($orig_word) )
                {
                        $preview_subject = preg_replace($orig_word, $replacement_word, $privmsg_subject);
                        $preview_message = preg_replace($orig_word, $replacement_word, $preview_message);
                }
                else
                {
/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
                        $preview_subject = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($privmsg_subject) : $privmsg_subject;
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
                }

                if ( $smilies_on )
                {
                        $preview_message = smilies_pass($preview_message);
                }

/*****[BEGIN]******************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/
                $preview_message = word_wrap_pass($preview_message);
/*****[END]********************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/

                $preview_message = make_clickable($preview_message);
                $preview_message = str_replace("\n", '<br />', $preview_message);

                $s_hidden_fields = '<input type="hidden" name="folder" value="' . $folder . '" />';
                $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
                $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

                if ( isset($privmsg_id) )
                {
                        $s_hidden_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $privmsg_id . '" />';
                }

                $phpbb2_template->set_filenames(array(
                        "preview" => 'privmsgs_preview.tpl')
                );

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                $attachment_mod['pm']->preview_attachments();
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

                $phpbb2_template->assign_vars(array(
                        'TOPIC_TITLE' => $preview_subject,
                        'POST_SUBJECT' => $preview_subject,
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        'MESSAGE_TO' => UsernameColor($to_username),
                        'MESSAGE_FROM' => UsernameColor($userdata['username']),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        'POST_DATE' => create_date($phpbb2_board_config['default_dateformat'], time(), $phpbb2_board_config['board_timezone']),
                        'MESSAGE' => $preview_message,

                        'S_HIDDEN_FIELDS' => $s_hidden_fields,

                        'L_SUBJECT' => $titanium_lang['Subject'],
                        'L_DATE' => $titanium_lang['Date'],
                        'L_FROM' => $titanium_lang['From'],
                        'L_TO' => $titanium_lang['To'],
                        'L_PREVIEW' => $titanium_lang['Preview'],
                        'L_POSTED' => $titanium_lang['Posted'])
                );

                $phpbb2_template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
        }

        //
        // Start error handling
        //
        if ($error)
        {
                $privmsg_message = htmlspecialchars($privmsg_message);
                $phpbb2_template->set_filenames(array(
                        'reg_header' => 'error_body.tpl')
                );
                $phpbb2_template->assign_vars(array(
                        'ERROR_MESSAGE' => $error_msg)
                );
                $phpbb2_template->assign_var_from_handle('ERROR_BOX', 'reg_header');
        }

        //
        // Load templates
        //
        $phpbb2_template->set_filenames(array(
                'body' => 'posting_body.tpl')
        );
    if ($forum_on) {
        make_jumpbox('viewforum.'.$phpEx);
    }

        //
        // Enable extensions in posting_body
        //
        $phpbb2_template->assign_block_vars('switch_privmsg', array());

        //
        // HTML toggle selection
        //
        if ( $phpbb2_board_config['allow_html'] )
        {
                $html_status = $titanium_lang['HTML_is_ON'];
                $phpbb2_template->assign_block_vars('switch_html_checkbox', array());
        }
        else
        {
                $html_status = $titanium_lang['HTML_is_OFF'];
        }

        //
        // BBCode toggle selection
        //
        if ( $phpbb2_board_config['allow_bbcode'] )
        {
                $bbcode_status = $titanium_lang['BBCode_is_ON'];
                $phpbb2_template->assign_block_vars('switch_bbcode_checkbox', array());
        }
        else
        {
                $bbcode_status = $titanium_lang['BBCode_is_OFF'];
        }

        //
        // Smilies toggle selection
        //
        if ( $phpbb2_board_config['allow_smilies'] )
        {
                $smilies_status = $titanium_lang['Smilies_are_ON'];
                $phpbb2_template->assign_block_vars('switch_smilies_checkbox', array());
        }
        else
        {
                $smilies_status = $titanium_lang['Smilies_are_OFF'];
        }

        //
        // Signature toggle selection - only show if
        // the user has a signature
        //
        if ( !empty($titanium_user_sig) )
        {
                $phpbb2_template->assign_block_vars('switch_signature_checkbox', array());
        }

        if ( $mode == 'post' )
        {
                $post_a = $titanium_lang['Send_a_new_message'];
        }
        else if ( $mode == 'reply' )
        {
                $post_a = $titanium_lang['Send_a_reply'];
                $mode = 'post';
        }
        else if ( $mode == 'edit' )
        {
                $post_a = $titanium_lang['Edit_message'];
        }

        $s_hidden_fields = '<input type="hidden" name="folder" value="' . $folder . '" />';
        $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
        $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
        if ( $mode == 'edit' )
        {
                $s_hidden_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $privmsg_id . '" />';
        }
/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
        if ( $userdata['user_level'] == ADMIN ) {
                $phpbb2_template->assign_block_vars('switch_Welcome_PM', array());
        }
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

        //
        // Send smilies to template
        //
        generate_smilies('inline', PAGE_PRIVMSGS);

        $phpbb2_template->assign_vars(array(
                'SUBJECT' => $privmsg_subject,
                'USERNAME' => $to_username,
                'MESSAGE' => $privmsg_message,
                'HTML_STATUS' => $html_status,
                'SMILIES_STATUS' => $smilies_status,
                'BB_BOX' => Make_TextArea_Ret('message', $privmsg_message, 'post', '99.8%', '300px', true),
                'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_titanium_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
                'FORUM_NAME' => $titanium_lang['Private_Message'],

                'BOX_NAME' => $l_box_name,
                'INBOX_IMG' => $inbox_img,
                'SENTBOX_IMG' => $sentbox_img,
                'OUTBOX_IMG' => $outbox_img,
                'SAVEBOX_IMG' => $savebox_img,
                'INBOX' => $inbox_url,
                'SENTBOX' => $sentbox_url,
                'OUTBOX' => $outbox_url,
                'SAVEBOX' => $savebox_url,

                'L_SUBJECT' => $titanium_lang['Subject'],
                'L_MESSAGE_BODY' => $titanium_lang['Message_body'],
                'L_OPTIONS' => $titanium_lang['Options'],
                'L_SPELLCHECK' => $titanium_lang['Spellcheck'],
                'L_PREVIEW' => $titanium_lang['Preview'],
                'L_SUBMIT' => $titanium_lang['Submit'],
                'L_CANCEL' => $titanium_lang['Cancel'],
                'L_POST_A' => $post_a,
                'L_FIND_USERNAME' => $titanium_lang['Find_username'],
                'L_FIND' => $titanium_lang['Find'],
                'L_DISABLE_HTML' => $titanium_lang['Disable_HTML_pm'],
                'L_DISABLE_BBCODE' => $titanium_lang['Disable_BBCode_pm'],
                'L_DISABLE_SMILIES' => $titanium_lang['Disable_Smilies_pm'],
                'L_ATTACH_SIGNATURE' => $titanium_lang['Attach_signature'],

                'L_BBCODE_B_HELP' => $titanium_lang['bbcode_b_help'],
                'L_BBCODE_I_HELP' => $titanium_lang['bbcode_i_help'],
                'L_BBCODE_U_HELP' => $titanium_lang['bbcode_u_help'],
                'L_BBCODE_Q_HELP' => $titanium_lang['bbcode_q_help'],
                'L_BBCODE_C_HELP' => $titanium_lang['bbcode_c_help'],
                'L_BBCODE_L_HELP' => $titanium_lang['bbcode_l_help'],
                'L_BBCODE_O_HELP' => $titanium_lang['bbcode_o_help'],
                'L_BBCODE_P_HELP' => $titanium_lang['bbcode_p_help'],
                'L_BBCODE_W_HELP' => $titanium_lang['bbcode_w_help'],
                'L_BBCODE_A_HELP' => $titanium_lang['bbcode_a_help'],
                'L_BBCODE_S_HELP' => $titanium_lang['bbcode_s_help'],
                'L_BBCODE_F_HELP' => $titanium_lang['bbcode_f_help'],
                'L_EMPTY_MESSAGE' => $titanium_lang['Empty_message'],

                'L_FONT_COLOR' => $titanium_lang['Font_color'],
                'L_COLOR_DEFAULT' => $titanium_lang['color_default'],
                'L_COLOR_DARK_RED' => $titanium_lang['color_dark_red'],
                'L_COLOR_RED' => $titanium_lang['color_red'],
                'L_COLOR_ORANGE' => $titanium_lang['color_orange'],
                'L_COLOR_BROWN' => $titanium_lang['color_brown'],
                'L_COLOR_YELLOW' => $titanium_lang['color_yellow'],
                'L_COLOR_GREEN' => $titanium_lang['color_green'],
                'L_COLOR_OLIVE' => $titanium_lang['color_olive'],
                'L_COLOR_CYAN' => $titanium_lang['color_cyan'],
                'L_COLOR_BLUE' => $titanium_lang['color_blue'],
                'L_COLOR_DARK_BLUE' => $titanium_lang['color_dark_blue'],
                'L_COLOR_INDIGO' => $titanium_lang['color_indigo'],
                'L_COLOR_VIOLET' => $titanium_lang['color_violet'],
                'L_COLOR_WHITE' => $titanium_lang['color_white'],
                'L_COLOR_BLACK' => $titanium_lang['color_black'],
/*****[BEGIN]******************************************
[ Base:    XtraColors                            v1.0 ]
******************************************************/
                'L_COLOR_CADET_BLUE' => $titanium_lang['color_cadet_blue'], 
                'L_COLOR_CORAL' => $titanium_lang['color_coral'], 
                'L_COLOR_CRIMSON' => $titanium_lang['color_crimson'], 
                'L_COLOR_TOMATO' => $titanium_lang['color_tomato'], 
                'L_COLOR_SEA_GREEN' => $titanium_lang['color_sea_green'], 
                'L_COLOR_DARK_ORCHID' => $titanium_lang['color_dark_orchid'],
                'L_COLOR_CHOCOLATE' => $titanium_lang['color_chocolate'],
                'L_COLOR_DEEPSKYBLUE' => $titanium_lang['color_deepskyblue'], 
                'L_COLOR_GOLD' => $titanium_lang['color_gold'], 
                'L_COLOR_GRAY' => $titanium_lang['color_gray'], 
                'L_COLOR_MIDNIGHTBLUE' => $titanium_lang['color_midnightblue'], 
                'L_COLOR_DARKGREEN' => $titanium_lang['color_darkgreen'], 
/*****[END]*******************************************
[ Base:    XtraColors                            v1.0 ]
******************************************************/
                'L_FONT_SIZE' => $titanium_lang['Font_size'],
                'L_FONT_TINY' => $titanium_lang['font_tiny'],
                'L_FONT_SMALL' => $titanium_lang['font_small'],
                'L_FONT_NORMAL' => $titanium_lang['font_normal'],
                'L_FONT_LARGE' => $titanium_lang['font_large'],
                'L_FONT_HUGE' => $titanium_lang['font_huge'],

                'L_BBCODE_CLOSE_TAGS' => $titanium_lang['Close_Tags'],
                'L_STYLES_TIP' => $titanium_lang['Styles_tip'],

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
                'L_WELCOME_PM' => $titanium_lang['Welcome_PM'],
                'S_WELCOME_PM' => ( $welcome_pm ) ? ' checked="checked"' : '',
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

                'S_HTML_CHECKED' => ( !$html_on ) ? ' checked="checked"' : '',
                'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? ' checked="checked"' : '',
                'S_SMILIES_CHECKED' => ( !$smilies_on ) ? ' checked="checked"' : '',
                'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? ' checked="checked"' : '',
                'S_HIDDEN_FORM_FIELDS' => $s_hidden_fields,
                'S_POST_ACTION' => append_titanium_sid("privmsg.$phpEx"),

                'U_SEARCH_USER' => "modules.php?name=Forums&amp;file=search&amp;mode=searchuser&amp;popup=1",
                'U_VIEW_FORUM' => append_titanium_sid("privmsg.$phpEx"))
        );

        $phpbb2_template->pparse('body');

        include(NUKE_INCLUDE_DIR.'page_tail.php');
}

//
// Default page
//
if ( !$userdata['session_logged_in'] )
{
    redirect_titanium("modules.php?name=Your_Account&redirect=privmsg&folder=inbox");
    exit;
}

//
// Update unread status
//
$sql = "UPDATE " . USERS_TABLE . "
        SET user_unread_privmsg = user_unread_privmsg + user_new_privmsg, user_new_privmsg = '0', user_last_privmsg = " . $userdata['session_start'] . "
        WHERE user_id = " . $userdata['user_id'];
if ( !$titanium_db->sql_query($sql) )
{
        message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
}

$sql = "UPDATE " . PRIVMSGS_TABLE . "
        SET privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "
        WHERE privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                AND privmsgs_to_userid = " . $userdata['user_id'];
if ( !$titanium_db->sql_query($sql) )
{
        message_die(GENERAL_ERROR, 'Could not update private message new/read status (2) for user', '', __LINE__, __FILE__, $sql);
}

//
// Reset PM counters
//
$userdata['user_new_privmsg'] = 0;
$userdata['user_unread_privmsg'] = ( $userdata['user_new_privmsg'] + $userdata['user_unread_privmsg'] );

//
// Generate page
//
$phpbb2_page_title = $titanium_lang['Private_Messaging'];
if( empty($mode) ) {
        include(NUKE_INCLUDE_DIR.'page_header.php');
}

//
// Load templates
//
$phpbb2_template->set_filenames(array(
        'body' => 'privmsgs_body.tpl')
);
if (isset($forum_on)) {
    if($forum_on) {
        make_jumpbox('viewforum.'.$phpEx);
    }
}

$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// New message
//
$send_new_private_message = '<a href="' . append_titanium_sid("privmsg.$phpEx?mode=post") . '"><img src="' . $images['post_new'] . '" alt="' . $titanium_lang['Send_a_new_message'] . '" border="0" /></a>';

//
// General SQL to obtain messages
//

$sql_tot = "SELECT COUNT(privmsgs_id) AS total
        FROM " . PRIVMSGS_TABLE . " ";
$sql = "SELECT pm.privmsgs_type, pm.privmsgs_id, pm.privmsgs_date, pm.privmsgs_subject, pm.privmsgs_from_userid, u.user_id, u.username
        FROM " . PRIVMSGS_TABLE . " pm, " . USERS_TABLE . " u ";

switch( $folder )
{
        case 'inbox':
                $sql_tot .= "WHERE privmsgs_to_userid = " . $userdata['user_id'] . "
                        AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                                OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";

                $sql .= "WHERE pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                        AND u.user_id = pm.privmsgs_from_userid
                        AND ( pm.privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                                OR pm.privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                break;

        case 'outbox':
                $sql_tot .= "WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                        AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";

                $sql .= "WHERE pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                        AND u.user_id = pm.privmsgs_to_userid
                        AND ( pm.privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                break;

        case 'sentbox':
                $sql_tot .= "WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                        AND privmsgs_type =  " . PRIVMSGS_SENT_MAIL;

                $sql .= "WHERE pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                        AND u.user_id = pm.privmsgs_to_userid
                        AND pm.privmsgs_type =  " . PRIVMSGS_SENT_MAIL;
                break;

        case 'savebox':
                $sql_tot .= "WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . "
                                AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                        OR ( privmsgs_from_userid = " . $userdata['user_id'] . "
                                AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )";

                $sql .= "WHERE u.user_id = pm.privmsgs_from_userid
                        AND ( ( pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                                AND pm.privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                        OR ( pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                                AND pm.privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " ) )";
                break;

        default:
                message_die(GENERAL_MESSAGE, $titanium_lang['No_such_folder']);
                break;
}

//
// Show messages over previous x days/months
//
if ( $submit_msgdays && ( !empty($_POST['msgdays']) || !empty($_GET['msgdays']) ) )
{
        $msg_days = ( !empty($_POST['msgdays']) ) ? intval($_POST['msgdays']) : intval($_GET['msgdays']);
        $min_msg_time = time() - ($msg_days * 86400);

        $limit_msg_time_total = " AND privmsgs_date > $min_msg_time";
        $limit_msg_time = " AND pm.privmsgs_date > $min_msg_time ";

        if ( !empty($_POST['msgdays']) )
        {
                $phpbb2_start = 0;
        }
}
else
{
        $limit_msg_time = $limit_msg_time_total = '';
        $msg_days = 0;
}

$sql .= $limit_msg_time . " ORDER BY pm.privmsgs_date DESC LIMIT $phpbb2_start, " . $phpbb2_board_config['topics_per_page'];
$sql_all_tot = $sql_tot;
$sql_tot .= $limit_msg_time_total;

/*****[BEGIN]******************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/
$total_phpbb2_inbox = '';
$total_phpbb2_sentbox = '';
$total_phpbb2_outbox = '';
$total_phpbb2_savebox = '';

for ($i = 1; $i < 5; $i++)
{
    $sql1 = 'sql_'.$i;
    $sql2 = 'sql_'.$i;
    $tot  = 'tot_'.$i;

    $$sql1 = "SELECT COUNT(privmsgs_id) AS $tot FROM " . PRIVMSGS_TABLE . " ";

    // inbox (1)
    $sql_1 .= "WHERE privmsgs_to_userid = " . $userdata['user_id'] . " AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_READ_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";

    // sentbox (2)
    $sql_2 .= "WHERE privmsgs_from_userid = " . $userdata['user_id'] . " AND privmsgs_type =  " . PRIVMSGS_SENT_MAIL;

    // outbox (3)
    $sql_3 .= "WHERE privmsgs_from_userid = " . $userdata['user_id'] . " AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";

    // savebox (4)
    $sql_4 .= "WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . " AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) OR ( privmsgs_from_userid = " . $userdata['user_id'] . " AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )";

    if ( !($result1 = $titanium_db->sql_query($$sql2)) )
    {
        message_die(GENERAL_ERROR, 'Could not query forum PM information', '', __LINE__, __FILE__, $sql_tot_pm_savebox);
    }
    while ($row1 = $titanium_db->sql_fetchrow($result1))
    {
        $total_phpbb2_inbox .= $row1['tot_1'];
        $total_phpbb2_sentbox .= $row1['tot_2'];
        $total_phpbb2_outbox .= $row1['tot_3'];
        $total_phpbb2_savebox .= $row1['tot_4'];
    }

}
/*****[END]********************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/

//
// Get messages
//
if ( !($result = $titanium_db->sql_query($sql_tot)) )
{
        message_die(GENERAL_ERROR, 'Could not query private message information', '', __LINE__, __FILE__, $sql_tot);
}

$pm_total = ( $row = $titanium_db->sql_fetchrow($result) ) ? $row['total'] : 0;

if ( !($result = $titanium_db->sql_query($sql_all_tot)) )
{
        message_die(GENERAL_ERROR, 'Could not query private message information', '', __LINE__, __FILE__, $sql_tot);
}

$pm_all_total = ( $row = $titanium_db->sql_fetchrow($result) ) ? $row['total'] : 0;

//
// Build select box
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($titanium_lang['All_Posts'], $titanium_lang['1_Day'], $titanium_lang['7_Days'], $titanium_lang['2_Weeks'], $titanium_lang['1_Month'], $titanium_lang['3_Months'], $titanium_lang['6_Months'], $titanium_lang['1_Year']);

$select_msg_days = '';
for($i = 0; $i < count($previous_days); $i++)
{
        $selected = ( $msg_days == $previous_days[$i] ) ? ' selected="selected"' : '';
        $select_msg_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}

//
// Define correct icons
//
switch ( $folder )
{
        case 'inbox':
                $l_box_name = $titanium_lang['Inbox'];
                break;
        case 'outbox':
                $l_box_name = $titanium_lang['Outbox'];
                break;
        case 'savebox':
                $l_box_name = $titanium_lang['Savebox'];
                break;
        case 'sentbox':
                $l_box_name = $titanium_lang['Sentbox'];
                break;
}
$post_pm = append_titanium_sid("privmsg.$phpEx?mode=post");

/**
 *  Modded for use with bootstrap template
 *
 *  @since 2.0.9e.001
 */
$post_pm_url = append_titanium_sid("privmsg.$phpEx?mode=post");

$post_pm_img = '<a href="' . $post_pm . '"><img src="' . $images['pm_postmsg'] . '" alt="' . $titanium_lang['Post_new_pm'] . '" border="0"></a>';
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
include($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_mass_pm.' . $phpEx);
$mass_pm_url = append_titanium_sid("groupmsg.$phpEx");
$mass_pm_allowed = false;
if ( $userdata['user_level'] == ADMIN )
{
    $mass_pm_img = '<a href="' . append_titanium_sid("groupmsg.$phpEx") . '"><img src="' . $images['mass_pm'] . '" border="0" alt="' . $titanium_lang['Mass_pm'] . '" /></a>';
    /**
     *  Modded for use with bootstrap template
     *
     *  @since 2.0.9e.001
     */
    $mass_pm_allowed = true;
       
} else
{
    $sql_g = "SELECT DISTINCT g.group_id
    FROM ".GROUPS_TABLE . " g, ".USER_GROUP_TABLE . " ug
    WHERE g.group_single_user <> 1
        AND (
            (g.group_allow_pm='".AUTH_MOD."' AND g.group_moderator = '" . $userdata['user_id']."') OR
            (g.group_allow_pm='".AUTH_ACL."' AND ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ) OR
            (g.group_allow_pm='".AUTH_REG."')
        )" ;
    if( !$g_result = $titanium_db->sql_query($sql_g) )
    {
        message_die(GENERAL_ERROR, "Could not select group names!", __LINE__, __FILE__, $sql_g);
    }
    if( $titanium_db->sql_numrows($g_result))
    {
        $mass_pm_img = '<a href="' . append_titanium_sid("groupmsg.$phpEx") . '"><img src="' . $images['mass_pm'] . '" border="0" alt="' . $titanium_lang['Mass_pm'] . '" /></a>';
        $mass_pm_allowed = true;
    }
}
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
$post_pm = '<a href="' . $post_pm . '">' . $titanium_lang['Post_new_pm'] . '</a>';

//
// Output data for inbox status
//
if ( $folder != 'outbox' )
{
/*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
//        $inbox_limit_pct = ( $max_boxsize > 0 ) ? round(( $pm_all_total / $max_boxsize ) * 100) : 100;
//        $inbox_limit_img_length = ( $max_boxsize > 0 ) ? round(( $pm_all_total / $max_boxsize ) * 1) : 1;
//        $inbox_limit_remain = ( $max_boxsize > 0 ) ? $max_boxsize - $pm_all_total : 0;
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
 /*****[Begin]******************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/
    $inbox_limit_pct = ( $phpbb2_board_config['max_' . $folder . '_privmsgs'] > 0 ) ? round(( $pm_all_total / $phpbb2_board_config['max_' . $folder . '_privmsgs'] ) * 100) : 100;
    $inbox_limit_img_length = ( $phpbb2_board_config['max_' . $folder . '_privmsgs'] > 0 ) ? round(( $pm_all_total / $phpbb2_board_config['max_' . $folder . '_privmsgs'] ) * $phpbb2_board_config['privmsg_graphic_length']) : $phpbb2_board_config['privmsg_graphic_length'];
    $inbox_limit_remain = ( $phpbb2_board_config['max_' . $folder . '_privmsgs'] > 0 ) ? $phpbb2_board_config['max_' . $folder . '_privmsgs'] - $pm_all_total : 0;
 /*****[END]********************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/
        $phpbb2_template->assign_block_vars('switch_box_size_notice', array());

        switch( $folder )
        {
                case 'inbox':
                        $l_box_size_status = sprintf($titanium_lang['Inbox_size'], $inbox_limit_pct);
                        break;
                case 'sentbox':
                        $l_box_size_status = sprintf($titanium_lang['Sentbox_size'], $inbox_limit_pct);
                        break;
                case 'savebox':
                        $l_box_size_status = sprintf($titanium_lang['Savebox_size'], $inbox_limit_pct);
                        break;
                default:
                        $l_box_size_status = '';
                        break;
        }
}
else
{
   $inbox_limit_img_length = $inbox_limit_pct = $l_box_size_status = '';
}

# We use this for themes that use HTML buttons instead of images!
if ( defined('bootstrap') ):
$phpbb2_template->assign_vars(array(
        'BOX_NAME' => $l_box_name,
        'INBOX_IMG' => $inbox_img,
        'SENTBOX_IMG' => $sentbox_img,
        'OUTBOX_IMG' => $outbox_img,
        'SAVEBOX_IMG' => $savebox_img,
        'INBOX' => $inbox_url,
        'SENTBOX' => $sentbox_url,
        'OUTBOX' => $outbox_url,
        'SAVEBOX' => $savebox_url,

        /**
         *  Modded for use with bootstrap template
         *
         *  @since 2.0.9e.001
         */
        'INBOX_URI' => $inbox_uri,
        'INBOX_TITLE' => $inbox_title,

        'OUTBOX_URI' => $outbox_uri,
        'OUTBOX_TITLE' => $outbox_title,

        'SENTBOX_URI' => $sentbox_uri,
        'SENTBOX_TITLE' => $sentbox_title,

        'SAVEBOX_URI' => $savebox_uri,
        'SAVEBOX_TITLE' => $savebox_title,

        // $post_pm_img = '<a href="' . $post_pm . '"><img src="' . $images['pm_postmsg'] . '" alt="' . $titanium_lang['Post_new_pm'] . '" border="0"></a>';
        'POST_PM_URL' => $post_pm_url,
        'L_POST_PM' => $titanium_lang['Post_new_pm'],

        'MASS_PM_PERMS' => $mass_pm_allowed,
        'MASS_PM_URL' => $mass_pm_url,
        'L_MASS_PM' => $titanium_lang['Mass_pm'],

/*****[BEGIN]******************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/
        'TOTAL_INBOX' => $total_phpbb2_inbox,
        'TOTAL_SENTBOX' => $total_phpbb2_sentbox,
        'TOTAL_OUTBOX' => $total_phpbb2_outbox,
        'TOTAL_SAVEBOX' => $total_phpbb2_savebox,
/*****[END]********************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/

 		'MODULE_NAME' => $mod_name,
        'MODULE_URI' => append_titanium_sid("privmsg.$phpEx"),

        //'POST_PM_IMG' => $post_pm_img,
		'POST_PM_IMG' => '<a href="modules.php?name=Private_Messages&mode=post" class="titaniumbutton">Send Private Message</a>',
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        'MASS_PM_IMG' => '<a href="modules.php?name=Forums&file=groupmsg" class="titaniumbutton">Message Everyone</a>',

/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        'POST_PM' => $post_pm,
        'L_GO' => $titanium_lang['Go'],

        'INBOX_LIMIT_IMG_WIDTH' => $inbox_limit_img_length,
        'INBOX_LIMIT_PERCENT' => $inbox_limit_pct,
 /*****[Begin]******************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/
        // 'LCAP_IMG' => $images['voting_lcap'],
        // 'MAINBAR_IMG' => $images['voting_graphic'][0],
        // 'RCAP_IMG' => $images['voting_rcap'],
/*****[END]********************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/


        'BOX_SIZE_STATUS' => $l_box_size_status,

        'L_INBOX' => $titanium_lang['Inbox'],
        'L_OUTBOX' => $titanium_lang['Outbox'],
        'L_SENTBOX' => $titanium_lang['Sent'],
        'L_SAVEBOX' => $titanium_lang['Saved'],
        'L_MARK' => $titanium_lang['Mark'],
        'L_FLAG' => $titanium_lang['Flag'],
        'L_SUBJECT' => $titanium_lang['Subject'],
        'L_DATE' => $titanium_lang['Date'],
        'L_DISPLAY_MESSAGES' => $titanium_lang['Display_messages'],
        'L_FROM_OR_TO' => ( $folder == 'inbox' || $folder == 'savebox' ) ? $titanium_lang['From'] : $titanium_lang['To'],
        'L_MARK_ALL' => $titanium_lang['Mark_all'],
        'L_UNMARK_ALL' => $titanium_lang['Unmark_all'],
        'L_DELETE_MARKED' => $titanium_lang['Delete_marked'],
        'L_DELETE_ALL' => $titanium_lang['Delete_all'],
        'L_SAVE_MARKED' => $titanium_lang['Save_marked'],

        'S_PRIVMSGS_ACTION' => append_titanium_sid("privmsg.$phpEx?folder=$folder"),
        'S_HIDDEN_FIELDS' => '',
        'S_POST_NEW_MSG' => $send_new_private_message,
        'S_SELECT_MSG_DAYS' => $select_msg_days,

        'U_POST_NEW_TOPIC' => append_titanium_sid("privmsg.$phpEx?mode=post"))
);
else:
//
// Dump vars to template
//
$phpbb2_template->assign_vars(array(
        'BOX_NAME' => $l_box_name,
        'INBOX_IMG' => $inbox_img,
        'SENTBOX_IMG' => $sentbox_img,
        'OUTBOX_IMG' => $outbox_img,
        'SAVEBOX_IMG' => $savebox_img,
        'INBOX' => $inbox_url,
        'SENTBOX' => $sentbox_url,
        'OUTBOX' => $outbox_url,
        'SAVEBOX' => $savebox_url,

        /**
         *  Modded for use with bootstrap template
         *
         *  @since 2.0.9e.001
         */
        'INBOX_URI' => $inbox_uri,
        'INBOX_TITLE' => $inbox_title,

        'OUTBOX_URI' => $outbox_uri,
        'OUTBOX_TITLE' => $outbox_title,

        'SENTBOX_URI' => $sentbox_uri,
        'SENTBOX_TITLE' => $sentbox_title,

        'SAVEBOX_URI' => $savebox_uri,
        'SAVEBOX_TITLE' => $savebox_title,

        // $post_pm_img = '<a href="' . $post_pm . '"><img src="' . $images['pm_postmsg'] . '" alt="' . $titanium_lang['Post_new_pm'] . '" border="0"></a>';
        'POST_PM_URL' => $post_pm_url,
        'L_POST_PM' => $titanium_lang['Post_new_pm'],

        'MASS_PM_PERMS' => $mass_pm_allowed,
        'MASS_PM_URL' => $mass_pm_url,
        'L_MASS_PM' => $titanium_lang['Mass_pm'],

/*****[BEGIN]******************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/
        'TOTAL_INBOX' => $total_phpbb2_inbox,
        'TOTAL_SENTBOX' => $total_phpbb2_sentbox,
        'TOTAL_OUTBOX' => $total_phpbb2_outbox,
        'TOTAL_SAVEBOX' => $total_phpbb2_savebox,
/*****[END]********************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/

 		'MODULE_NAME' => $mod_name,
        'MODULE_URI' => append_titanium_sid("privmsg.$phpEx"),

        'POST_PM_IMG' => $post_pm_img,
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        'MASS_PM_IMG' => $mass_pm_img,

/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        'POST_PM' => $post_pm,
        'L_GO' => $titanium_lang['Go'],

        'INBOX_LIMIT_IMG_WIDTH' => $inbox_limit_img_length,
        'INBOX_LIMIT_PERCENT' => $inbox_limit_pct,
 /*****[Begin]******************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/
        // 'LCAP_IMG' => $images['voting_lcap'],
        // 'MAINBAR_IMG' => $images['voting_graphic'][0],
        // 'RCAP_IMG' => $images['voting_rcap'],
/*****[END]********************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/


        'BOX_SIZE_STATUS' => $l_box_size_status,

        'L_INBOX' => $titanium_lang['Inbox'],
        'L_OUTBOX' => $titanium_lang['Outbox'],
        'L_SENTBOX' => $titanium_lang['Sent'],
        'L_SAVEBOX' => $titanium_lang['Saved'],
        'L_MARK' => $titanium_lang['Mark'],
        'L_FLAG' => $titanium_lang['Flag'],
        'L_SUBJECT' => $titanium_lang['Subject'],
        'L_DATE' => $titanium_lang['Date'],
        'L_DISPLAY_MESSAGES' => $titanium_lang['Display_messages'],
        'L_FROM_OR_TO' => ( $folder == 'inbox' || $folder == 'savebox' ) ? $titanium_lang['From'] : $titanium_lang['To'],
        'L_MARK_ALL' => $titanium_lang['Mark_all'],
        'L_UNMARK_ALL' => $titanium_lang['Unmark_all'],
        'L_DELETE_MARKED' => $titanium_lang['Delete_marked'],
        'L_DELETE_ALL' => $titanium_lang['Delete_all'],
        'L_SAVE_MARKED' => $titanium_lang['Save_marked'],

        'S_PRIVMSGS_ACTION' => append_titanium_sid("privmsg.$phpEx?folder=$folder"),
        'S_HIDDEN_FIELDS' => '',
        'S_POST_NEW_MSG' => $send_new_private_message,
        'S_SELECT_MSG_DAYS' => $select_msg_days,

        'U_POST_NEW_TOPIC' => append_titanium_sid("privmsg.$phpEx?mode=post"))
);
endif;

//
// Okay, let's build the correct folder
//
if ( !($result = $titanium_db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not query private messages', '', __LINE__, __FILE__, $sql);
}

if ( $row = $titanium_db->sql_fetchrow($result) )
{
    $i = 0;
    do
    {
        $privmsg_id = $row['privmsgs_id'];

                $flag = $row['privmsgs_type'];

                $phpbb2_icon_flag = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? $images['pm_unreadmsg'] : $images['pm_readmsg'];
                $phpbb2_icon_flag_alt = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? $titanium_lang['Unread_message'] : $titanium_lang['Read_message'];

                $pm_status_flag = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? true : false;

                $msg_userid = $row['user_id'];
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $msg_username = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

                $u_from_user_profile = "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=$msg_userid";

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
                $msg_subject = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($row['privmsgs_subject']) : $row['privmsgs_subject'];
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/

                if ( count($orig_word) )
                {
                        $msg_subject = preg_replace($orig_word, $replacement_word, $msg_subject);
                }

                $u_subject = append_titanium_sid("privmsg.$phpEx?folder=$folder&amp;mode=read&amp;" . POST_POST_URL . "=$privmsg_id");

                $msg_date = create_date($phpbb2_board_config['default_dateformat'], $row['privmsgs_date'], $phpbb2_board_config['board_timezone']);

                if ( $flag == PRIVMSGS_NEW_MAIL && $folder == 'inbox' )
                {
                        $msg_subject = '<strong>' . $msg_subject . '</strong>';
                        $msg_date = '<strong>' . $msg_date . '</strong>';
                        $msg_username = '<strong>' . $msg_username . '</strong>';
                }

                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
                $i++;
                $phpbb2_template->assign_block_vars('listrow', array(
                        'ROW_COLOR' => '#' . $row_color,
                        'ROW_CLASS' => $row_class,
                        'FROM' => (($row['privmsgs_from_userid'] == 1) ? $phpbb2_board_config['welcome_pm_username'] : $msg_username),
                        'SUBJECT' => $msg_subject,
                        'DATE' => $msg_date,
/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                        'PRIVMSG_ATTACHMENTS_IMG' => privmsgs_attachment_image($privmsg_id),
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                        'PRIVMSG_FOLDER_IMG' => $phpbb2_icon_flag,
                        'PRIVMSG_STATUS_FLAG' => $pm_status_flag,
                        'L_PRIVMSG_FOLDER_ALT' => $phpbb2_icon_flag_alt,
                        'S_MARK_ID' => $privmsg_id,
                        'U_READ' => $u_subject,
                        'U_FROM_USER_ID' => $row['privmsgs_from_userid'],
                        'U_FROM_USER_PROFILE' => $u_from_user_profile)
                );
        }
        while( $row = $titanium_db->sql_fetchrow($result) );

        $pagination_variables = array(
            'url' => append_titanium_sid('privmsg.'.$phpEx.'?folder='.$folder), 
            'total' => $pm_total,
            'per-page' => $phpbb2_board_config['topics_per_page'],
            'next-previous' => true,
            'first-last' => true,
            'adjacents' => 2
        );

        $phpbb2_template->assign_vars(array(

                'PAGINATION' => generate_pagination("privmsg.$phpEx?folder=$folder", $pm_total, $phpbb2_board_config['topics_per_page'], $phpbb2_start),
                // 'PAGINATION_BOOTSTRAP' => get_bootstrap_pagination($pagination_variables),

                'PAGE_NUMBER' => sprintf($titanium_lang['Page_of'], ( floor( $phpbb2_start / $phpbb2_board_config['topics_per_page'] ) + 1 ), ceil( $pm_total / $phpbb2_board_config['topics_per_page'] )),

                'L_GOTO_PAGE' => $titanium_lang['Goto_page'])
        );

}
else
{
        $phpbb2_template->assign_vars(array(
                'L_NO_MESSAGES' => $titanium_lang['No_messages_folder'])
        );

        $phpbb2_template->assign_block_vars("switch_no_messages", array() );
}
if( empty($mode) ) {
    $phpbb2_template->pparse('body');

    include(NUKE_INCLUDE_DIR.'page_tail.php');
}

?>