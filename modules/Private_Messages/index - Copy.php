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
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

if (isset($privmsg_id)) {
    $privmsg_id = intval($privmsg_id);
}

if (!empty($pm_uname)) {
    $sql = "SELECT user_id from ".$user_prefix."_users WHERE username='$pm_uname'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $u = intval($row['user_id']);
    $mode = 'post';
    redirect("modules.php?name=Private_Messages&mode=$mode&u=$u");
    exit;
}

$sql_title = "SELECT custom_title from ".$prefix."_modules where title='$name'";
$result_title = $db->sql_query($sql_title);
$row_title = $db->sql_fetchrow($result_title);

if (empty($row_title['custom_title'])) {
    $mod_name = str_replace("_", " ", $name);
} else {
    $mod_name = $row_title['custom_title'];
}
if (!(isset($popup)) || ($popup != "1")) {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_FORUMS_DIR.'nukebb.php');
    // title($sitename.': '.$mod_name);
    // if (is_user()) {
    //     include(NUKE_MODULES_DIR.'Your_Account/navbar.php');
    //     OpenTable();
    //     nav();
    //     CloseTable();
    //     echo "<br />";
    // }
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
    $nuke_file_path = 'modules.php?name=Forums&file=';
}
define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include(NUKE_INCLUDE_DIR.'bbcode.php');
include(NUKE_INCLUDE_DIR.'functions_post.php');

//
// Is PM disabled?
//
if ( !empty($board_config['privmsg_disable']) )
{
    message_die(GENERAL_MESSAGE, 'PM_disabled');
}

$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');

//
// Parameters
//
$submit = ( isset($HTTP_POST_VARS['post']) ) ? TRUE : 0;
$submit_search = ( isset($HTTP_POST_VARS['usersubmit']) ) ? TRUE : 0;
$submit_msgdays = ( isset($HTTP_POST_VARS['submit_msgdays']) ) ? TRUE : 0;
$cancel = ( isset($HTTP_POST_VARS['cancel']) ) ? TRUE : 0;
$preview = ( isset($HTTP_POST_VARS['preview']) ) ? TRUE : 0;
$confirm = ( isset($HTTP_POST_VARS['confirm']) ) ? TRUE : 0;
$delete = ( isset($HTTP_POST_VARS['delete']) ) ? TRUE : 0;
$delete_all = ( isset($HTTP_POST_VARS['deleteall']) ) ? TRUE : 0;
$save = ( isset($HTTP_POST_VARS['save']) ) ? TRUE : 0;
$sid = (isset($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : 0;

$refresh = $preview || $submit_search;

$mark_list = ( !empty($HTTP_POST_VARS['mark']) ) ? $HTTP_POST_VARS['mark'] : 0;

if ( isset($HTTP_POST_VARS['folder']) || isset($HTTP_GET_VARS['folder']) )
{
        $folder = ( isset($HTTP_POST_VARS['folder']) ) ? $HTTP_POST_VARS['folder'] : $HTTP_GET_VARS['folder'];
        if (is_string($folder)) {
            $folder = htmlspecialchars($folder);
        } else {
            $folder = '';
        }

        if ( $folder != 'inbox' && $folder != 'outbox' && $folder != 'sentbox' && $folder != 'savebox' )
        {
            $folder = 'inbox';
        }
}
else
{
        $folder = 'inbox';
}

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PRIVMSGS);
init_userprefs($userdata);
//
// End session management
//

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
$welcome_pm = ( isset($HTTP_POST_VARS['w_pm']) ) ? TRUE : 0;
if(!empty($welcome_pm) && !empty($submit)) {
    if(empty($HTTP_POST_VARS['subject'])) {
        message_die(GENERAL_ERROR,$lang['Welcome_PM_Subject']);
    }
    if($db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_welcome_pm")) != 0) {
        $sql_w_pm = "UPDATE ".$prefix."_welcome_pm SET subject='".$HTTP_POST_VARS['subject']."', msg='".$HTTP_POST_VARS['message']."'";
    } else {
        $sql_w_pm = "INSERT INTO ".$prefix."_welcome_pm VALUES('".$HTTP_POST_VARS['subject']."', '".$HTTP_POST_VARS['message']."')";
    }
    $db->sql_query($sql_w_pm );
    $msg = $lang['Welcome_PM_Set'] . '<br /><br />' . sprintf($lang['Click_return_inbox'], '<a href="' . append_sid("privmsg.$phpEx?folder=inbox") . '">', '</a> ') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

    message_die(GENERAL_MESSAGE, $msg);
}
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/
$pm_allow_threshold = isset($board_config['pm_allow_threshold']) ? $board_config['pm_allow_threshold'] : 1;
if ( ($userdata['user_posts'] < $pm_allow_threshold) && $userdata['user_level'] != ADMIN)
{
    message_die(GENERAL_MESSAGE, 'Not_Authorised');
}
if(!$userdata['session_logged_in']) {
    redirect('modules.php?name=Your_Account&redirect=privmsg&folder=inbox');
    exit;
}
/*****[END]********************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/

//
// Cancel
//
if ( $cancel )
{
    // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
    redirect(append_sid("privmsg.$phpEx?folder=$folder", true));
    exit;
}

//
// Var definitions
//
if ( !empty($HTTP_POST_VARS['mode']) || !empty($HTTP_GET_VARS['mode']) )
{
    $mode = ( !empty($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
    $mode = htmlspecialchars($mode);
}
else
{
    $mode = '';
}

$start = ( !empty($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

if ( isset($HTTP_POST_VARS[POST_POST_URL]) || isset($HTTP_GET_VARS[POST_POST_URL]) )
{
    $privmsg_id = ( isset($HTTP_POST_VARS[POST_POST_URL]) ) ? intval($HTTP_POST_VARS[POST_POST_URL]) : intval($HTTP_GET_VARS[POST_POST_URL]);
}
else
{
    $privmsg_id = '';
}

$error = FALSE;

//
// Define the box image links
//
$inbox_img = ( $folder != 'inbox' || !empty($mode) ) ? '<a href="' . append_sid("privmsg.$phpEx?folder=inbox") . '"><img src="' . $images['pm_inbox'] . '" border="0" alt="' . $lang['Inbox'] . '" /></a>' : '<img src="' . $images['pm_inbox'] . '" border="0" alt="' . $lang['Inbox'] . '" />';
$inbox_url = ( $folder != 'inbox' || !empty($mode) ) ? '<a href="' . append_sid("privmsg.$phpEx?folder=inbox") . '">' . $lang['Inbox'] . '</a>' : $lang['Inbox'];

$outbox_img = ( $folder != 'outbox' || !empty($mode) ) ? '<a href="' . append_sid("privmsg.$phpEx?folder=outbox") . '"><img src="' . $images['pm_outbox'] . '" border="0" alt="' . $lang['Outbox'] . '" /></a>' : '<img src="' . $images['pm_outbox'] . '" border="0" alt="' . $lang['Outbox'] . '" />';
$outbox_url = ( $folder != 'outbox' || !empty($mode) ) ? '<a href="' . append_sid("privmsg.$phpEx?folder=outbox") . '">' . $lang['Outbox'] . '</a>' : $lang['Outbox'];

$sentbox_img = ( $folder != 'sentbox' || !empty($mode) ) ? '<a href="' . append_sid("privmsg.$phpEx?folder=sentbox") . '"><img src="' . $images['pm_sentbox'] . '" border="0" alt="' . $lang['Sentbox'] . '" /></a>' : '<img src="' . $images['pm_sentbox'] . '" border="0" alt="' . $lang['Sentbox'] . '" />';
$sentbox_url = ( $folder != 'sentbox' || !empty($mode) ) ? '<a href="' . append_sid("privmsg.$phpEx?folder=sentbox") . '">' . $lang['Sentbox'] . '</a>' : $lang['Sentbox'];

$savebox_img = ( $folder != 'savebox' || !empty($mode) ) ? '<a href="' . append_sid("privmsg.$phpEx?folder=savebox") . '"><img src="' . $images['pm_savebox'] . '" border="0" alt="' . $lang['Savebox'] . '" /></a>' : '<img src="' . $images['pm_savebox'] . '" border="0" alt="' . $lang['Savebox'] . '" />';
$savebox_url = ( $folder != 'savebox' || !empty($mode) ) ? '<a href="' . append_sid("privmsg.$phpEx?folder=savebox") . '">' . $lang['Savebox'] . '</a>' : $lang['Savebox'];

/*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

if ( $folder == 'inbox' ) {
$max_boxsize_sql = "SELECT ug.group_id, g.max_inbox, g.override_max_inbox
FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
WHERE ug.user_id = " . $userdata['user_id'] . " AND
ug.group_id = g.group_id
ORDER BY override_max_inbox DESC, max_inbox DESC";
$max_boxsize_result = $db->sql_query($max_boxsize_sql);
$max_boxsize_row = $db->sql_fetchrow($max_boxsize_result);
$max_boxsize = $board_config['max_inbox_privmsgs'];
if ( $max_boxsize_row['override_max_inbox'] == 1 ) {
$max_boxsize = $max_boxsize_row['max_inbox']; }
}
else if ( $folder == 'savebox' ) {
$max_boxsize_sql = "SELECT ug.group_id, g.max_savebox, g.override_max_savebox
FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
WHERE ug.user_id = " . $userdata['user_id'] . " AND
ug.group_id = g.group_id
ORDER BY override_max_savebox DESC, max_savebox DESC";
$max_boxsize_result = $db->sql_query($max_boxsize_sql);
$max_boxsize_row = $db->sql_fetchrow($max_boxsize_result);
$max_boxsize = $board_config['max_savebox_privmsgs'];
if ( $max_boxsize_row['override_max_savebox'] == 1 ) {
$max_boxsize = $max_boxsize_row['max_savebox']; }
}
else if ( $folder == 'sentbox' )
        {
$max_boxsize_sql = "SELECT ug.group_id, g.max_sentbox, g.override_max_sentbox
FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
WHERE ug.user_id = " . $userdata['user_id'] . " AND
ug.group_id = g.group_id
ORDER BY override_max_sentbox DESC, max_sentbox DESC";
$max_boxsize_result = $db->sql_query($max_boxsize_sql);
$max_boxsize_row = $db->sql_fetchrow($max_boxsize_result);
$max_boxsize = $board_config['max_sentbox_privmsgs'];
if ( $max_boxsize_row['override_max_sentbox'] == 1 ) {
$max_boxsize = $max_boxsize_row['max_sentbox']; }
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

        $page_title = $lang['Private_Messaging'];
        include(NUKE_INCLUDE_DIR.'page_header_review.php');

        $template->set_filenames(array(
                'body' => 'privmsgs_popup.tpl')
        );

        if ( $userdata['session_logged_in'] )
        {
                if ( $userdata['user_new_privmsg'] )
                {
                    $l_new_message = ( $userdata['user_new_privmsg'] == 1 ) ? $lang['You_new_pm'] : $lang['You_new_pms'];
					$l_message_text_unread = sprintf($l_new_message, $userdata['user_new_privmsg']);
                }
                else
                {
                    #$l_new_message = $lang['You_no_new_pm'];
					$l_message_text_unread = $lang['No_unread_pm'];
                }

                $l_message_text_unread .= '<br /><br />' . sprintf($lang['Click_view_privmsg'], '<a href="' . append_sid("privmsg.".$phpEx."?folder=inbox") . '" onclick="jump_to_inbox();return false;" target="_new">', '</a>');
        }
        else
        {
                $l_new_message = $lang['Login_check_pm'];
				$l_message_text_unread = '';
        }

        $template->assign_vars(array(
                'L_CLOSE_WINDOW' => $lang['Close_window'],
                'L_MESSAGE' => $l_message_text_unread)
        );

        $template->pparse('body');

        include(NUKE_INCLUDE_DIR.'page_tail_review.php');
        exit;

}
else if ( $mode == 'read' )
{
        if ( !empty($HTTP_GET_VARS[POST_POST_URL]) )
        {
                $privmsgs_id = intval($HTTP_GET_VARS[POST_POST_URL]);
        }
        else
        {
                message_die(GENERAL_ERROR, $lang['No_post_id']);
        }

        if ( !$userdata['session_logged_in'] )
        {
                // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect("modules.php?name=Your_Account&redirect=privmsg&folder=$folder&mode=$mode&" . POST_POST_URL . "=$privmsgs_id");
                //redirect(append_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=$folder&mode=$mode&" . POST_POST_URL . "=$privmsgs_id", true));
                exit;
        }

        //
        // SQL to pull appropriate message, prevents nosey people
        // reading other peoples messages ... hopefully!
        //
        switch( $folder )
        {
                case 'inbox':
                        $l_box_name = $lang['Inbox'];
                        $pm_sql_user = "AND pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                                AND ( pm.privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                        OR pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                        OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                        break;
                case 'outbox':
                        $l_box_name = $lang['Outbox'];
                        $pm_sql_user = "AND pm.privmsgs_from_userid =  " . $userdata['user_id'] . "
                                AND ( pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                        OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) ";
                        break;
                case 'sentbox':
                        $l_box_name = $lang['Sentbox'];
                        $pm_sql_user = "AND pm.privmsgs_from_userid =  " . $userdata['user_id'] . "
                                AND pm.privmsgs_type = " . PRIVMSGS_SENT_MAIL;
                        break;
                case 'savebox':
                        $l_box_name = $lang['Savebox'];
                        $pm_sql_user = "AND ( ( pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                                        AND pm.privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                                OR ( pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                                        AND pm.privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " )
                                )";
                        break;
                default:
                        message_die(GENERAL_ERROR, $lang['No_such_folder']);
                        break;
        }

        //
        // Major query obtains the message ...
        //
/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
        $sql = "SELECT u.username AS username_1, u.user_id AS user_id_1, u2.username AS username_2, u2.user_id AS user_id_2, u.user_sig_bbcode_uid, u.user_posts, u.user_from, u.user_website, u.user_birthday, u.birthday_display, u.user_email, u.user_regdate, u.user_viewemail, u.user_rank, u.user_sig, u.user_avatar, u.user_allow_viewonline AS user_allow_viewonline_1, u2.user_allow_viewonline AS user_allow_viewonline_2, u.user_session_time AS user_session_time_1, u2.user_session_time AS user_session_time_2, pm.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text
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
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query private message post information', '', __LINE__, __FILE__, $sql);
        }

        //
        // Did the query return any data?
        //
        if ( !($privmsg = $db->sql_fetchrow($result)) )
        {
                // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect(append_sid("privmsg.$phpEx?folder=$folder", true));
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
                if ( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update private message read status for user', '', __LINE__, __FILE__, $sql);
                }

                $sql = "UPDATE " . PRIVMSGS_TABLE . "
                        SET privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                        WHERE privmsgs_id = " . $privmsg['privmsgs_id'];
                if ( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update private message read status', '', __LINE__, __FILE__, $sql);
                }

                // Check to see if the poster has a 'full' sent box
                $sql = "SELECT COUNT(privmsgs_id) AS sent_items, MIN(privmsgs_date) AS oldest_post_time
                        FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_type = " . PRIVMSGS_SENT_MAIL . "
                                AND privmsgs_from_userid = " . $privmsg['privmsgs_from_userid'];
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain sent message info for sendee', '', __LINE__, __FILE__, $sql);
                }

                $sql_priority = ( SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') ? 'LOW_PRIORITY' : '';

                if ( $sent_info = $db->sql_fetchrow($result) )
                {
                        if ($board_config['max_sentbox_privmsgs'] && $sent_info['sent_items'] >= $board_config['max_sentbox_privmsgs'])
                        {
                                $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                                        WHERE privmsgs_type = " . PRIVMSGS_SENT_MAIL . "
                                                AND privmsgs_date = " . $sent_info['oldest_post_time'] . "
                                                AND privmsgs_from_userid = " . $privmsg['privmsgs_from_userid'];
                                if ( !$result = $db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not find oldest privmsgs', '', __LINE__, __FILE__, $sql);
                                }
                                $old_privmsgs_id = $db->sql_fetchrow($result);
                                $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];

                                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                                        WHERE privmsgs_id = '$old_privmsgs_id'";
                                if ( !$db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (sent)', '', __LINE__, __FILE__, $sql);
                                }

                                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                                        WHERE privmsgs_text_id = '$old_privmsgs_id'";
                                if ( !$db->sql_query($sql) )
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
                if ( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not insert private message sent info', '', __LINE__, __FILE__, $sql);
                }

                $privmsg_sent_id = $db->sql_nextid();

                $sql = "INSERT $sql_priority INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
                        VALUES ('$privmsg_sent_id', '" . $privmsg['privmsgs_bbcode_uid'] . "', '" . str_replace("\'", "''", addslashes($privmsg['privmsgs_text'])) . "')";
                if ( !$db->sql_query($sql) )
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
                'post' => append_sid("privmsg.$phpEx?mode=post"),
                'reply' => append_sid("privmsg.$phpEx?mode=reply&amp;" . POST_POST_URL . "=$privmsg_id"),
                'quote' => append_sid("privmsg.$phpEx?mode=quote&amp;" . POST_POST_URL . "=$privmsg_id"),
                'edit' => append_sid("privmsg.$phpEx?mode=edit&amp;" . POST_POST_URL . "=$privmsg_id")
        );
        $post_icons = array(
                'post_img' => '<a href="' . $post_urls['post'] . '"><img src="' . $images['pm_postmsg'] . '" alt="' . $lang['Post_new_pm'] . '" border="0"></a>',
                'post' => '<a href="' . $post_urls['post'] . '">' . $lang['Post_new_pm'] . '</a>',
                'reply_img' => '<a href="' . $post_urls['reply'] . '"><img src="' . $images['pm_replymsg'] . '" alt="' . $lang['Post_reply_pm'] . '" border="0"></a>',
                'reply' => '<a href="' . $post_urls['reply'] . '">' . $lang['Post_reply_pm'] . '</a>',
                'quote_img' => '<a href="' . $post_urls['quote'] . '"><img src="' . $images['pm_quotemsg'] . '" alt="' . $lang['Post_quote_pm'] . '" border="0"></a>',
                'quote' => '<a href="' . $post_urls['quote'] . '">' . $lang['Post_quote_pm'] . '</a>',
                'edit_img' => '<a href="' . $post_urls['edit'] . '"><img src="' . $images['pm_editmsg'] . '" alt="' . $lang['Edit_pm'] . '" border="0"></a>',
                'edit' => '<a href="' . $post_urls['edit'] . '">' . $lang['Edit_pm'] . '</a>'
        );

        if ( $folder == 'inbox' )
        {
                $post_img = $post_icons['post_img'];
                $reply_img = $post_icons['reply_img'];
                $quote_img = $post_icons['quote_img'];
                $edit_img = '';
                $post = $post_icons['post'];
                $reply = $post_icons['reply'];
                $quote = $post_icons['quote'];
                $edit = '';
                $l_box_name = $lang['Inbox'];
        }
        else if ( $folder == 'outbox' )
        {
                $post_img = $post_icons['post_img'];
                $reply_img = '';
                $quote_img = '';
                $edit_img = $post_icons['edit_img'];
                $post = $post_icons['post'];
                $reply = '';
                $quote = '';
                $edit = $post_icons['edit'];
                $l_box_name = $lang['Outbox'];
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
                        $quote = $post_icons['quote'];
                        $edit = '';
                }
                else
                {
                        $post_img = $post_icons['post_img'];
                        $reply_img = '';
                        $quote_img = '';
                        $edit_img = '';
                        $post = $post_icons['post'];
                        $reply = '';
                        $quote = '';
                        $edit = '';
                }
                $l_box_name = $lang['Saved'];
        }
        else if ( $folder == 'sentbox' )
        {
                $post_img = $post_icons['post_img'];
                $reply_img = '';
                $quote_img = '';
                $edit_img = '';
                $post = $post_icons['post'];
                $reply = '';
                $quote = '';
                $edit = '';
                $l_box_name = $lang['Sent'];
        }

        $s_hidden_fields = '<input type="hidden" name="mark[]" value="' . $privmsgs_id . '" />';

        $page_title = $lang['Read_pm'];
        include(NUKE_INCLUDE_DIR.'page_header.php');

        //
        // Load templates
        //
        $template->set_filenames(array(
                'body' => 'privmsgs_read_body.tpl')
        );
        if (is_active("Forums")) {
            make_jumpbox('viewforum.'.$phpEx);
        }

        $template->assign_vars(array(
                'INBOX_IMG' => $inbox_img,
                'SENTBOX_IMG' => $sentbox_img,
                'OUTBOX_IMG' => $outbox_img,
                'SAVEBOX_IMG' => $savebox_img,
                'INBOX' => $inbox_url,

                'POST_PM_IMG' => $post_img,
                'REPLY_PM_IMG' => $reply_img,
                'EDIT_PM_IMG' => $edit_img,
                'QUOTE_PM_IMG' => $quote_img,
                'POST_PM' => $post,
                'REPLY_PM' => $reply,
                'EDIT_PM' => $edit,
                'QUOTE_PM' => $quote,

                'SENTBOX' => $sentbox_url,
                'OUTBOX' => $outbox_url,
                'SAVEBOX' => $savebox_url,

                'BOX_NAME' => $l_box_name,

                'L_MESSAGE' => $lang['Message'],
                'L_INBOX' => $lang['Inbox'],
                'L_OUTBOX' => $lang['Outbox'],
                'L_SENTBOX' => $lang['Sent'],
                'L_SAVEBOX' => $lang['Saved'],
                'L_FLAG' => $lang['Flag'],
                'L_SUBJECT' => $lang['Subject'],
                'L_POSTED' => $lang['Posted'],
                'L_DATE' => $lang['Date'],
                'L_FROM' => $lang['From'],
                'L_TO' => $lang['To'],
                'L_SAVE_MSG' => $lang['Save_message'],
                'L_DELETE_MSG' => $lang['Delete_message'],

                'S_PRIVMSGS_ACTION' => append_sid("privmsg.$phpEx?folder=$folder"),
                'S_HIDDEN_FIELDS' => $s_hidden_fields)
        );

        $user_id_from = $privmsg['user_id_1'];
        $user_id_to = $privmsg['user_id_2'];

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
      init_display_pm_attachments($privmsg['privmsgs_attachment']);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

        $post_date = create_date($board_config['default_dateformat'], $privmsg['privmsgs_date'], $board_config['board_timezone']);

        $temp_url = "modules.php?name=Profile&mode=viewprofile&amp;" . POST_USERS_URL . '=' . $user_id_from;
        $profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
        $profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

        $temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$user_id_from");
        $pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
        $pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

        if ( !empty($privmsg['user_viewemail']) || $userdata['user_level'] == ADMIN )
        {
                $email_uri = ( $board_config['board_email_form'] ) ? "modules.php?name=Profile&mode=email&amp;" . POST_USERS_URL .'=' . $user_id_from : 'mailto:' . $privmsg['user_email'];

                $email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
                $email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
        }
        else
        {
                $email_img = '';
                $email = '';
        }

        $www_img = ( $privmsg['user_website'] ) ? '<a href="' . $privmsg['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
        $www = ( $privmsg['user_website'] ) ? '<a href="' . $privmsg['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';
		
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
		$bday_month_day = floor($privmsg['user_birthday'] / 10000);
		$bday_year_age = ( $privmsg['birthday_display'] != BIRTHDAY_NONE && $privmsg['birthday_display'] != BIRTHDAY_DATE ) ? $privmsg['user_birthday'] - 10000*$bday_month_day : 0;
		$fudge = ( gmdate('md') < $bday_month_day ) ? 1 : 0;
		$age = ( $bday_year_age ) ? gmdate('Y')-$bday_year_age-$fudge : false;
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

        $temp_url = "modules.php?name=Profile&mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id_from";

        $temp_url = "modules.php?name=Forums&amp;file=search&amp;search_author=" . urlencode($username_from) . "&amp;showresults=posts";
        $search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $username_from) . '" title="' . sprintf($lang['Search_user_posts'], $username_from) . '" border="0" /></a>';
        $search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $username_from) . '</a>';
/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
        if ($privmsg['user_session_time_1'] >= (time()-$board_config['online_time']))
        {
            if ($privmsg['user_allow_viewonline_1'])
            {
                $online_status_img = '<a href="' . append_sid("viewonline.$phpEx") . '"><img src="' . $images['icon_online'] . '" alt="' . sprintf($lang['is_online'], $username_from) . '" title="' . sprintf($lang['is_online'], $username_from) . '" /></a>&nbsp;';
                $online_status = '&nbsp;(<strong><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_online'], $username_from) . '"' . $online_color . '>' . $lang['Online'] . '</a></strong>)';
            }
            else if ($userdata['user_level'] == ADMIN || $userdata['user_id'] == $user_id_from)
            {
                $online_status_img = '<a href="' . append_sid("viewonline.$phpEx") . '"><img src="' . $images['icon_hidden'] . '" alt="' . sprintf($lang['is_hidden'], $username_from) . '" title="' . sprintf($lang['is_hidden'], $username_from) . '" /></a>&nbsp;';
                $online_status = '&nbsp;(<strong><em><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_hidden'], $username_from) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></em></strong>)';
            }
            else
            {
                $online_status_img = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($lang['is_offline'], $username_from) . '" title="' . sprintf($lang['is_offline'], $username_from) . '" />&nbsp;';
                $online_status = '&nbsp;(<span title="' . sprintf($lang['is_offline'], $username_from) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>)';
            }
        }
        else
        {
            $online_status_img = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($lang['is_offline'], $username_from) . '" title="' . sprintf($lang['is_offline'], $username_from) . '" />&nbsp;';
            $online_status = '&nbsp;(<span title="' . sprintf($lang['is_offline'], $username_from) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>)';
        }

        if ($privmsg['user_session_time_2'] >= (time()-$board_config['online_time']))
        {
            if ($privmsg['user_allow_viewonline_2'])
            {
                $online_status_2 = '&nbsp;(<strong><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_online'], $username_to) . '"' . $online_color . '>' . $lang['Online'] . '</a></strong>)';
            }
            else if ($userdata['user_level'] == ADMIN || $userdata['user_id'] == $user_id_to)
            {
                $online_status_2 = '&nbsp;(<strong><em><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_hidden'], $username_to) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></em></strong>)';
            }
            else
            {
            $online_status_2 = '&nbsp;(<span title="' . sprintf($lang['is_offline'], $username_to) . '"' . $offline_color . '>' . $lang['Offline'] . '</strong></span>)';
            }
        }
        else
        {
            $online_status_2 = '&nbsp;(<span title="' . sprintf($lang['is_offline'], $username_to) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>)';
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
        $post_subject = ($board_config['smilies_in_titles']) ? smilies_pass($privmsg['privmsgs_subject']) : $privmsg['privmsgs_subject'];
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/

        $private_message = $privmsg['privmsgs_text'];
        $bbcode_uid = $privmsg['privmsgs_bbcode_uid'];

        if ( $board_config['allow_sig'] )
        {
                $user_sig = ( $privmsg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig'] : $privmsg['user_sig'];
        }
        else
        {
                $user_sig = '';
        }

        $user_sig_bbcode_uid = ( $privmsg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig_bbcode_uid'] : $privmsg['user_sig_bbcode_uid'];

        //
        // If the board has HTML off but the post has HTML
        // on then we process it, else leave it alone
        //
        if ( !$board_config['allow_html'] || !$userdata['user_allowhtml'])
        {
                if ( !empty($user_sig))
                {
                        $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
                }

                if ( $privmsg['privmsgs_enable_html'] )
                {
                        $private_message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $private_message);
                }
        }

        if ( !empty($user_sig) && $privmsg['privmsgs_attach_sig'] && !empty($user_sig_bbcode_uid) )
        {
                $user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
        }

        if ( !empty($bbcode_uid) )
        {
                $private_message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($private_message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $private_message);
        }

        $private_message = make_clickable($private_message);

        if ( $privmsg['privmsgs_attach_sig'] && !empty($user_sig) )
        {
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 [ Mod:     Bottom aligned signature           v1.2.0 ]
 ******************************************************/
                $private_message .= '<br />' . $board_config['sig_line'] . '<br />' . make_clickable($user_sig);
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

        if ( $board_config['allow_smilies'] && $privmsg['privmsgs_enable_smilies'] )
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
        $username_from = UsernameColor($privmsg['username_1']);
        $username_to = UsernameColor($privmsg['username_2']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

        //
        // Dump it to the templating engine
        //
        $template->assign_vars(array(
                'MESSAGE_TO' => $username_to,
                // 'MESSAGE_FROM' => $username_from,
                'MESSAGE_FROM' => (($privmsg['privmsgs_from_userid'] == 1) ? $board_config['welcome_pm_username'] : $username_from),
                'MESSAGE_FROM_ID' => $privmsg['privmsgs_from_userid'],
                'RANK_IMAGE' => $rank_image,
                'POSTER_JOINED' => $poster_joined,
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'POSTER_AGE' => ( $age !== false ) ? sprintf($lang['Age'], $age) : '',
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
                'POSTER_POSTS' => $poster_posts,
                'POSTER_FROM' => $poster_from,
                'POSTER_AVATAR' => $poster_avatar,
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

        $template->pparse('body');

        include(NUKE_INCLUDE_DIR.'page_tail.php');

}
else if ( ( $delete && $mark_list ) || $delete_all )
{
        if ( !$userdata['session_logged_in'] )
        {
                // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect("modules.php?name=Your_Account&redirect=privmsg&folder=inbox");
                //redirect(append_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=inbox", true));
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
                $s_hidden_fields .= ( isset($HTTP_POST_VARS['delete']) ) ? '<input type="hidden" name="delete" value="true" />' : '<input type="hidden" name="deleteall" value="true" />';
                $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

                for($i = 0; $i < count($mark_list); $i++)
                {
                        $s_hidden_fields .= '<input type="hidden" name="mark[]" value="' . intval($mark_list[$i]) . '" />';
                }

                //
                // Output confirmation page
                //
                include(NUKE_INCLUDE_DIR.'page_header.php');

                $template->set_filenames(array(
                        'confirm_body' => 'confirm_body.tpl')
                );
                $template->assign_vars(array(
                        'MESSAGE_TITLE' => $lang['Information'],
                        'MESSAGE_TEXT' => ( count($mark_list) == 1 ) ? $lang['Confirm_delete_pm'] : $lang['Confirm_delete_pms'],

                        'L_YES' => $lang['Yes'],
                        'L_NO' => $lang['No'],

                        'S_CONFIRM_ACTION' => append_sid("privmsg.$phpEx?folder=$folder"),
                        'S_HIDDEN_FIELDS' => $s_hidden_fields)
                );

                $template->pparse('confirm_body');

                include(NUKE_INCLUDE_DIR.'page_tail.php');

        }
        else if ( $confirm )
        {
				// session id check
				if ($sid == '' || $sid != $userdata['session_id'])
				{
					message_die(GENERAL_ERROR, $lang['Session_invalid']);
				}
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

                if ( !($result = $db->sql_query($sql)) )
                {
                   message_die(GENERAL_ERROR, 'Could not obtain id list to delete messages', '', __LINE__, __FILE__, $sql);
                }

                $mark_list = array();
                while ( $row = $db->sql_fetchrow($result) )
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
                                if ( !($result = $db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not obtain user id list for outbox messages', '', __LINE__, __FILE__, $sql);
                                }

                                if ( $row = $db->sql_fetchrow($result))
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
                                        while ($row = $db->sql_fetchrow($result));

                                        if (count($update_users))
                                        {
                                                while (list($type, $users) = each($update_users))
                                                {
                                                        while (list($user_id, $dec) = each($users))
                                                        {
                                                                $update_list[$type][$dec][] = $user_id;
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

                                                        while (list($dec, $user_ary) = each($dec_ary))
                                                        {
                                                                $user_ids = implode(', ', $user_ary);

                                                                $sql = "UPDATE " . USERS_TABLE . "
                                                                        SET $type = $type - $dec
                                                                        WHERE user_id IN ($user_ids)";
                                                                if ( !$db->sql_query($sql) )
                                                                {
                                                                        message_die(GENERAL_ERROR, 'Could not update user pm counters', '', __LINE__, __FILE__, $sql);
                                                                }
                                                        }
                                                }
                                                unset($update_list);
                                        }
                                }
                                $db->sql_freeresult($result);
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

                        if ( !$db->sql_query($delete_sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
                        }

                        if ( !$db->sql_query($delete_text_sql) )
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
                // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect("modules.php?name=Your_Account&redirect=privmsg&folder=inbox");
                //redirect(append_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=inbox", true));
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
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain sent message info for sendee', '', __LINE__, __FILE__, $sql);
                }

                $sql_priority = ( SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') ? 'LOW_PRIORITY' : '';

                if ( $saved_info = $db->sql_fetchrow($result) )
                {
                        if ($board_config['max_savebox_privmsgs'] && $saved_info['savebox_items'] >= $board_config['max_savebox_privmsgs'] )
                        {
                                $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                                        WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . "
                                                                AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                                                        OR ( privmsgs_from_userid = " . $userdata['user_id'] . "
                                                                AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )
                                                AND privmsgs_date = " . $saved_info['oldest_post_time'];
                                if ( !$result = $db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
                                }
                                $old_privmsgs_id = $db->sql_fetchrow($result);
                                $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];

                                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                                        WHERE privmsgs_id = '$old_privmsgs_id'";
                                if ( !$db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
                                }

                                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                                        WHERE privmsgs_text_id = '$old_privmsgs_id'";
                                if ( !$db->sql_query($sql) )
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
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain user id list for outbox messages', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $row = $db->sql_fetchrow($result))
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
                                while ($row = $db->sql_fetchrow($result));

                                if (count($update_users))
                                {
                                        while (list($type, $users) = each($update_users))
                                        {
                                                while (list($user_id, $dec) = each($users))
                                                {
                                                        $update_list[$type][$dec][] = $user_id;
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

                                                while (list($dec, $user_ary) = each($dec_ary))
                                                {
                                                        $user_ids = implode(', ', $user_ary);

                                                        $sql = "UPDATE " . USERS_TABLE . "
                                                                SET $type = $type - $dec
                                                                WHERE user_id IN ($user_ids)";
                                                        if ( !$db->sql_query($sql) )
                                                        {
                                                                message_die(GENERAL_ERROR, 'Could not update user pm counters', '', __LINE__, __FILE__, $sql);
                                                        }
                                                }
                                        }
                                        unset($update_list);
                                }
                        }
                        $db->sql_freeresult($result);
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

                if ( !$db->sql_query($saved_sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not save private messages', '', __LINE__, __FILE__, $saved_sql);
                }
                // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect(append_sid("privmsg.$phpEx?folder=savebox", true));
                exit;
        }
}
else if ( $submit || $refresh || !empty($mode) )
{
        if ( !$userdata['session_logged_in'] )
        {
                $user_id = ( isset($HTTP_GET_VARS[POST_USERS_URL]) ) ? '&' . POST_USERS_URL . '=' . intval($HTTP_GET_VARS[POST_USERS_URL]) : '';
                // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                redirect("modules.php?name=Your_Account&redirect=privmsg&folder=$folder&mode=$mode" . $user_id);
                //redirect(append_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=$folder&mode=$mode" . $user_id, true));
                exit;
        }

        //
        // Toggles
        //
        if ( !$board_config['allow_html'] )
        {
                $html_on = 0;
        }
        else
        {
                $html_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_html']) ) ? 0 : TRUE ) : $userdata['user_allowhtml'];
        }

        if ( !$board_config['allow_bbcode'] )
        {
                $bbcode_on = 0;
        }
        else
        {
                $bbcode_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_bbcode']) ) ? 0 : TRUE ) : $userdata['user_allowbbcode'];
        }

        if ( !$board_config['allow_smilies'] )
        {
                $smilies_on = 0;
        }
        else
        {
                $smilies_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_smilies']) ) ? 0 : TRUE ) : $userdata['user_allowsmile'];
        }

        $attach_sig = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['attach_sig']) ) ? TRUE : 0 ) : $userdata['user_attachsig'];
        $user_sig = ( !empty($userdata['user_sig']) && $board_config['allow_sig'] ) ? $userdata['user_sig'] : "";

        if ( $submit && $mode != 'edit' )
        {
                //
                // Flood control
                //
                $sql = "SELECT MAX(privmsgs_date) AS last_post_time
                        FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_from_userid = " . $userdata['user_id'];
                if ( $result = $db->sql_query($sql) )
                {
                        $db_row = $db->sql_fetchrow($result);

                        $last_post_time = $db_row['last_post_time'];
                        $current_time = time();

                        if ( ( $current_time - $last_post_time ) < $board_config['flood_interval'])
                        {
                                message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
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

        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, "Could not obtain message details", "", __LINE__, __FILE__, $sql);
        }

        if (!($row = $db->sql_fetchrow($result)))
        {
            message_die(GENERAL_MESSAGE, $lang['No_such_post']);
        }
        $db->sql_freeresult($result);

        unset($row);
    }

        if ( $submit )
        {
        		// session id check
        		if ($sid == '' || $sid != $userdata['session_id'])
        		{
        			$error = true;
        			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Session_invalid'];
        		}

                if ( !empty($HTTP_POST_VARS['username']) )
                {
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                        $to_username_array = explode (";", $HTTP_POST_VARS['username']);
                        sort ($to_username_array);
                        foreach ($to_username_array as $name) $to_usernames .= "'".phpbb_clean_username($name)."',";
                        $to_usernames[strlen($to_usernames)-1]=" ";

                        $sql = "SELECT user_id, username, user_notify_pm, user_email, user_lang, user_active
                                FROM " . USERS_TABLE . "
                                WHERE username IN ($to_usernames)
                                        AND user_id <> " . ANONYMOUS . " ORDER BY username ASC";

                        if( !($result2 = $db->sql_query($sql)) )
                        {
                            message_die(GENERAL_ERROR, 'Could not obtain users PM information', '', __LINE__, __FILE__, $sql);
                        }
                        $to_users = $db->sql_fetchrowset($result2);
                        $n=0;
                        while ($to_username_array[$n] && !$error)
                        {
                        if (strcasecmp($to_users[$n]['username'], str_replace("\'", "'",$to_username_array[$n])))
                        {
                            $error = TRUE;
                            $error_msg .= $lang['No_such_user']." '".str_replace("\'", "'", $to_username_array[$n]);
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
                        $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_to_user'];
                }

                $privmsg_subject = trim(htmlspecialchars($HTTP_POST_VARS['subject']));
                if ( empty($privmsg_subject) )
                {
                        $error = TRUE;
                        $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_subject'];
                }

                if ( !empty($HTTP_POST_VARS['message']) )
                {
                        if ( !$error )
                        {
                                if ( $bbcode_on )
                                {
                                        $bbcode_uid = make_bbcode_uid();
                                }

                                $privmsg_message = prepare_message($HTTP_POST_VARS['message'], $html_on, $bbcode_on, $smilies_on, $bbcode_uid);

/*****[BEGIN]******************************************
 [ Mod:     Extended PM Notification           v1.1.5 ]
 ******************************************************/
                //Clean up all BBcode UID
                $message_text = htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['message'])));
                $quote = $lang['Quote'];
                $code = $lang['Code'];

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
                        $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_message'];
                }
        }

        if ( $submit && !$error )
        {
                //
                // Has admin prevented user from sending PM's?
                //
                if ( !$userdata['user_allow_pm'] )
                {
                        $message = $lang['Cannot_send_privmsg'];
                        message_die(GENERAL_MESSAGE, $message);
                }

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                include(NUKE_INCLUDE_DIR.'emailer.'.$phpEx);
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
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_MESSAGE, $lang['No_such_user']);
                        }

                        $sql_priority = ( SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') ? 'LOW_PRIORITY' : '';

                        if ( $inbox_info = $db->sql_fetchrow($result) )
                        {
/*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
$max_inbox = $board_config['max_inbox_privmsgs'];
                        if ( $bbgroups_row['override_max_inbox'] == 1)
                        {
                        $max_inbox = $bbgroups_row['max_inbox'];
                        }
if ( $inbox_info['inbox_items'] >= $max_inbox )
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                                if ($board_config['max_inbox_privmsgs'] && $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'])
                                {
                                        $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                                                WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                                                OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  )
                                                        AND privmsgs_date = " . $inbox_info['oldest_post_time'] . "
                                                        AND privmsgs_to_userid = " . $to_userdata['user_id'];
                                        if ( !$result = $db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (inbox)', '', __LINE__, __FILE__, $sql);
                                        }
                                        $old_privmsgs_id = $db->sql_fetchrow($result);
                                        $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];

                                        $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                                                WHERE privmsgs_id = '$old_privmsgs_id'";
                                        if ( !$db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
                                        }

                                        $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                                                WHERE privmsgs_text_id = '$old_privmsgs_id'";
                                        if ( !$db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql);
                                        }
                                }
                        }

                        $sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
                                VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $privmsg_subject) . "', " . $userdata['user_id'] . ", " . $to_userdata['user_id'] . ", $msg_time, '$user_ip', '$html_on', '$bbcode_on', '$smilies_on', '$attach_sig')";
                }
                else
                {
                        $sql_info = "UPDATE " . PRIVMSGS_TABLE . "
                                SET privmsgs_type = " . PRIVMSGS_NEW_MAIL . ", privmsgs_subject = '" . str_replace("\'", "''", $privmsg_subject) . "', privmsgs_from_userid = " . $userdata['user_id'] . ", privmsgs_to_userid = " . $to_userdata['user_id'] . ", privmsgs_date = '$msg_time', privmsgs_ip = '$user_ip', privmsgs_enable_html = '$html_on', privmsgs_enable_bbcode = '$bbcode_on', privmsgs_enable_smilies = '$smilies_on', privmsgs_attach_sig = '$attach_sig'
                                WHERE privmsgs_id = '$privmsg_id'";
                }

                if ( !($result = $db->sql_query($sql_info)) )
                {
                        message_die(GENERAL_ERROR, "Could not insert/update private message sent info.", "", __LINE__, __FILE__, $sql_info);
                }

                if ( $mode != 'edit' )
                {
                        $privmsg_sent_id = $db->sql_nextid();

                        $sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
                                VALUES ('$privmsg_sent_id', '" . $bbcode_uid . "', '" . str_replace("\'", "''", $privmsg_message) . "')";
                }
                else
                {
                        $sql = "UPDATE " . PRIVMSGS_TEXT_TABLE . "
                                SET privmsgs_text = '" . str_replace("\'", "''", $privmsg_message) . "', privmsgs_bbcode_uid = '$bbcode_uid'
                                WHERE privmsgs_text_id = '$privmsg_id'";
                }

                if ( !$db->sql_query($sql) )
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
                        if ( !$status = $db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $to_userdata['user_notify_pm'] && !empty($to_userdata['user_email']) && $to_userdata['user_active'] )
                        {
//                              $script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
//                              $script_name = ( !empty($script_name) ) ? $script_name . '/privmsg.'.$phpEx : 'privmsg.'.$phpEx;
                                $script_name = 'modules.php?name=Private_Messages&file=index';
                                $server_name = trim($board_config['server_name']);
                                $server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
                                $server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

//                              include(NUKE_INCLUDE_DIR.'emailer.php');
                                $emailer = new emailer($board_config['smtp_delivery']);

                                $emailer->from($board_config['board_email']);
                                $emailer->replyto($board_config['board_email']);

                                $emailer->use_template('privmsg_notify', $to_userdata['user_lang']);
                                $emailer->email_address($to_userdata['user_email']);
                                $emailer->set_subject($lang['Notification_subject']);

                                $emailer->assign_vars(array(
                                        'USERNAME' => $to_userdata['username'],
/*****[BEGIN]******************************************
 [ Mod:     Extended PM Notification           v1.1.5 ]
 ******************************************************/
                                        'SENDER_USERNAME' => htmlspecialchars($userdata['username']),
                                        'PM_MESSAGE' => $message_text,
/*****[END]********************************************
 [ Mod:     Extended PM Notification           v1.1.5 ]
 ******************************************************/
                                        'FROM' => $userdata['username'],
                                        'SITENAME' => $board_config['sitename'],
                                        'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
/*****[BEGIN]******************************************
 [ Mod:     Direct Inbox Linking (Email)       v1.0.0 ]
 [ Mod:     Suppress Popup                     v1.0.0 ]
 ******************************************************/
                                        'U_INBOX' => $server_protocol . $server_name . $server_port . $script_name . '&folder=inbox&mode=read&p=' . $privmsg_sent_id . "&suppress=1")
/*****[END]********************************************
 [ Mod:     Direct Inbox Linking (Email)       v1.0.0 ]
 [ Mod:     Suppress Popup                     v1.0.0 ]
 ******************************************************/
                                );

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                                if (!($emailer_result = $emailer->send(1)))
                                {
                                    message_die(GENERAL_ERROR, 'Failed sending email :: ' . $emailer_result, '', __LINE__, __FILE__);
                                }
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                                $emailer->reset();
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                                }
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                        }
                }

                $template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("privmsg.$phpEx?folder=inbox") . '">')
                );

                $msg = $lang['Message_sent'] . '<br /><br />' . sprintf($lang['Click_return_inbox'], '<a href="' . append_sid("privmsg.$phpEx?folder=inbox") . '">', '</a> ') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

                message_die(GENERAL_MESSAGE, $msg);
        }
        else if ( $preview || $refresh || $error )
        {

                //
                // If we're previewing or refreshing then obtain the data
                // passed to the script, process it a little, do some checks
                // where neccessary, etc.
                //
                $to_username = (isset($HTTP_POST_VARS['username']) ) ? trim(htmlspecialchars(stripslashes($HTTP_POST_VARS['username']))) : '';
                $privmsg_subject = ( isset($HTTP_POST_VARS['subject']) ) ? trim(htmlspecialchars(stripslashes($HTTP_POST_VARS['subject']))) : '';
                $privmsg_message = ( isset($HTTP_POST_VARS['message']) ) ? trim($HTTP_POST_VARS['message']) : '';
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
                        $page_title = $lang['Post_new_pm'];

                        $user_sig = ( !empty($userdata['user_sig']) && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';

                }
                else if ( $mode == 'reply' )
                {
                        $page_title = $lang['Post_reply_pm'];

                        $user_sig = ( !empty($userdata['user_sig']) && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';

                }
                else if ( $mode == 'edit' )
                {
                        $page_title = $lang['Edit_pm'];

                        $sql = "SELECT u.user_id, u.user_sig
                                FROM " . PRIVMSGS_TABLE . " pm, " . USERS_TABLE . " u
                                WHERE pm.privmsgs_id = '$privmsg_id'
                                        AND u.user_id = pm.privmsgs_from_userid";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Could not obtain post and post text", "", __LINE__, __FILE__, $sql);
                        }

                        if ( $postrow = $db->sql_fetchrow($result) )
                        {
                                if ( $userdata['user_id'] != $postrow['user_id'] )
                                {
                                        message_die(GENERAL_MESSAGE, $lang['Edit_own_posts']);
                                }

                                $user_sig = ( !empty($postrow['user_sig']) && $board_config['allow_sig'] ) ? $postrow['user_sig'] : '';
                        }
                }
        }
        else
        {
                if ( !$privmsg_id && ( $mode == 'reply' || $mode == 'edit' || $mode == 'quote' ) )
                {
                        message_die(GENERAL_ERROR, $lang['No_post_id']);
                }

                if ( !empty($HTTP_GET_VARS[POST_USERS_URL]) )
                {
                        $user_id = intval($HTTP_GET_VARS[POST_USERS_URL]);

                        $sql = "SELECT username
                                FROM " . USERS_TABLE . "
                                WHERE user_id = '$user_id'
                                        AND user_id <> " . ANONYMOUS;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                $error = TRUE;
                                $error_msg = $lang['No_such_user'];
                        }

                        if ( $row = $db->sql_fetchrow($result) )
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
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain private message for editing', '', __LINE__, __FILE__, $sql);
                        }

                        if ( !($privmsg = $db->sql_fetchrow($result)) )
                        {
                                // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                                redirect(append_sid("privmsg.$phpEx?folder=$folder", true));
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

                        $user_sig = ( $board_config['allow_sig'] ) ? (($privmsg['privmsgs_type'] == PRIVMSGS_NEW_MAIL) ? $user_sig : $privmsg['user_sig']) : '';

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
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain private message for editing', '', __LINE__, __FILE__, $sql);
                        }

                        if ( !($privmsg = $db->sql_fetchrow($result)) )
                        {
                                // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
                                redirect(append_sid("privmsg.$phpEx?folder=$folder", true));
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

                                $msg_date =  create_date($board_config['default_dateformat'], $privmsg['privmsgs_date'], $board_config['board_timezone']);

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
                $message = $lang['Cannot_send_privmsg'];
                message_die(GENERAL_MESSAGE, $message);
        }

        //
        // Start output, first preview, then errors then post form
        //
        $page_title = $lang['Send_private_message'];
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
        if ( !$html_on || !$board_config['allow_html'] || !$userdata['user_allowhtml'] )
                {
                        if ( !empty($user_sig) )
                        {
                                $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
                        }
                }

                if ( $attach_sig && !empty($user_sig) && $userdata['user_sig_bbcode_uid'] )
                {
                        $user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
                }

                if ( $bbcode_on )
                {
                        $preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
                }

                if ( $attach_sig && !empty($user_sig) )
                {
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 [ Mod:     Bottom aligned signature           v1.2.0 ]
 ******************************************************/
                        $preview_message = $preview_message . '<br />' . $board_config['sig_line'] . '<br />' . $user_sig;
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
                        $preview_subject = ($board_config['smilies_in_titles']) ? smilies_pass($privmsg_subject) : $privmsg_subject;
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

                $template->set_filenames(array(
                        "preview" => 'privmsgs_preview.tpl')
                );

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                $attachment_mod['pm']->preview_attachments();
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

                $template->assign_vars(array(
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
                        'POST_DATE' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
                        'MESSAGE' => $preview_message,

                        'S_HIDDEN_FIELDS' => $s_hidden_fields,

                        'L_SUBJECT' => $lang['Subject'],
                        'L_DATE' => $lang['Date'],
                        'L_FROM' => $lang['From'],
                        'L_TO' => $lang['To'],
                        'L_PREVIEW' => $lang['Preview'],
                        'L_POSTED' => $lang['Posted'])
                );

                $template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
        }

        //
        // Start error handling
        //
        if ($error)
        {
                $privmsg_message = htmlspecialchars($privmsg_message);
                $template->set_filenames(array(
                        'reg_header' => 'error_body.tpl')
                );
                $template->assign_vars(array(
                        'ERROR_MESSAGE' => $error_msg)
                );
                $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
        }

        //
        // Load templates
        //
        $template->set_filenames(array(
                'body' => 'posting_body.tpl')
        );
    if ($forum_on) {
        make_jumpbox('viewforum.'.$phpEx);
    }

        //
        // Enable extensions in posting_body
        //
        $template->assign_block_vars('switch_privmsg', array());

        //
        // HTML toggle selection
        //
        if ( $board_config['allow_html'] )
        {
                $html_status = $lang['HTML_is_ON'];
                $template->assign_block_vars('switch_html_checkbox', array());
        }
        else
        {
                $html_status = $lang['HTML_is_OFF'];
        }

        //
        // BBCode toggle selection
        //
        if ( $board_config['allow_bbcode'] )
        {
                $bbcode_status = $lang['BBCode_is_ON'];
                $template->assign_block_vars('switch_bbcode_checkbox', array());
        }
        else
        {
                $bbcode_status = $lang['BBCode_is_OFF'];
        }

        //
        // Smilies toggle selection
        //
        if ( $board_config['allow_smilies'] )
        {
                $smilies_status = $lang['Smilies_are_ON'];
                $template->assign_block_vars('switch_smilies_checkbox', array());
        }
        else
        {
                $smilies_status = $lang['Smilies_are_OFF'];
        }

        //
        // Signature toggle selection - only show if
        // the user has a signature
        //
        if ( !empty($user_sig) )
        {
                $template->assign_block_vars('switch_signature_checkbox', array());
        }

        if ( $mode == 'post' )
        {
                $post_a = $lang['Send_a_new_message'];
        }
        else if ( $mode == 'reply' )
        {
                $post_a = $lang['Send_a_reply'];
                $mode = 'post';
        }
        else if ( $mode == 'edit' )
        {
                $post_a = $lang['Edit_message'];
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
                $template->assign_block_vars('switch_Welcome_PM', array());
        }
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

        //
        // Send smilies to template
        //
        generate_smilies('inline', PAGE_PRIVMSGS);

        $template->assign_vars(array(
                'SUBJECT' => $privmsg_subject,
        'USERNAME' => $to_username,
                'MESSAGE' => $privmsg_message,
                'HTML_STATUS' => $html_status,
                'SMILIES_STATUS' => $smilies_status,
                'BB_BOX' => Make_TextArea_Ret('message', $privmsg_message, 'post', '99.8%', '300px', true),
                'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
                'FORUM_NAME' => $lang['Private_Message'],

                'BOX_NAME' => $l_box_name,
                'INBOX_IMG' => $inbox_img,
                'SENTBOX_IMG' => $sentbox_img,
                'OUTBOX_IMG' => $outbox_img,
                'SAVEBOX_IMG' => $savebox_img,
                'INBOX' => $inbox_url,
                'SENTBOX' => $sentbox_url,
                'OUTBOX' => $outbox_url,
                'SAVEBOX' => $savebox_url,

                'L_SUBJECT' => $lang['Subject'],
                'L_MESSAGE_BODY' => $lang['Message_body'],
                'L_OPTIONS' => $lang['Options'],
                'L_SPELLCHECK' => $lang['Spellcheck'],
                'L_PREVIEW' => $lang['Preview'],
                'L_SUBMIT' => $lang['Submit'],
                'L_CANCEL' => $lang['Cancel'],
                'L_POST_A' => $post_a,
                'L_FIND_USERNAME' => $lang['Find_username'],
                'L_FIND' => $lang['Find'],
                'L_DISABLE_HTML' => $lang['Disable_HTML_pm'],
                'L_DISABLE_BBCODE' => $lang['Disable_BBCode_pm'],
                'L_DISABLE_SMILIES' => $lang['Disable_Smilies_pm'],
                'L_ATTACH_SIGNATURE' => $lang['Attach_signature'],

                'L_BBCODE_B_HELP' => $lang['bbcode_b_help'],
                'L_BBCODE_I_HELP' => $lang['bbcode_i_help'],
                'L_BBCODE_U_HELP' => $lang['bbcode_u_help'],
                'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'],
                'L_BBCODE_C_HELP' => $lang['bbcode_c_help'],
                'L_BBCODE_L_HELP' => $lang['bbcode_l_help'],
                'L_BBCODE_O_HELP' => $lang['bbcode_o_help'],
                'L_BBCODE_P_HELP' => $lang['bbcode_p_help'],
                'L_BBCODE_W_HELP' => $lang['bbcode_w_help'],
                'L_BBCODE_A_HELP' => $lang['bbcode_a_help'],
                'L_BBCODE_S_HELP' => $lang['bbcode_s_help'],
                'L_BBCODE_F_HELP' => $lang['bbcode_f_help'],
                'L_EMPTY_MESSAGE' => $lang['Empty_message'],

                'L_FONT_COLOR' => $lang['Font_color'],
                'L_COLOR_DEFAULT' => $lang['color_default'],
                'L_COLOR_DARK_RED' => $lang['color_dark_red'],
                'L_COLOR_RED' => $lang['color_red'],
                'L_COLOR_ORANGE' => $lang['color_orange'],
                'L_COLOR_BROWN' => $lang['color_brown'],
                'L_COLOR_YELLOW' => $lang['color_yellow'],
                'L_COLOR_GREEN' => $lang['color_green'],
                'L_COLOR_OLIVE' => $lang['color_olive'],
                'L_COLOR_CYAN' => $lang['color_cyan'],
                'L_COLOR_BLUE' => $lang['color_blue'],
                'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'],
                'L_COLOR_INDIGO' => $lang['color_indigo'],
                'L_COLOR_VIOLET' => $lang['color_violet'],
                'L_COLOR_WHITE' => $lang['color_white'],
                'L_COLOR_BLACK' => $lang['color_black'],
/*****[BEGIN]******************************************
[ Base:    XtraColors                            v1.0 ]
******************************************************/
                'L_COLOR_CADET_BLUE' => $lang['color_cadet_blue'], 
                'L_COLOR_CORAL' => $lang['color_coral'], 
                'L_COLOR_CRIMSON' => $lang['color_crimson'], 
                'L_COLOR_TOMATO' => $lang['color_tomato'], 
                'L_COLOR_SEA_GREEN' => $lang['color_sea_green'], 
                'L_COLOR_DARK_ORCHID' => $lang['color_dark_orchid'],
                'L_COLOR_CHOCOLATE' => $lang['color_chocolate'],
                'L_COLOR_DEEPSKYBLUE' => $lang['color_deepskyblue'], 
                'L_COLOR_GOLD' => $lang['color_gold'], 
                'L_COLOR_GRAY' => $lang['color_gray'], 
                'L_COLOR_MIDNIGHTBLUE' => $lang['color_midnightblue'], 
                'L_COLOR_DARKGREEN' => $lang['color_darkgreen'], 
/*****[END]*******************************************
[ Base:    XtraColors                            v1.0 ]
******************************************************/
                'L_FONT_SIZE' => $lang['Font_size'],
                'L_FONT_TINY' => $lang['font_tiny'],
                'L_FONT_SMALL' => $lang['font_small'],
                'L_FONT_NORMAL' => $lang['font_normal'],
                'L_FONT_LARGE' => $lang['font_large'],
                'L_FONT_HUGE' => $lang['font_huge'],

                'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'],
                'L_STYLES_TIP' => $lang['Styles_tip'],

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
                'L_WELCOME_PM' => $lang['Welcome_PM'],
                'S_WELCOME_PM' => ( $welcome_pm ) ? ' checked="checked"' : '',
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

                'S_HTML_CHECKED' => ( !$html_on ) ? ' checked="checked"' : '',
                'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? ' checked="checked"' : '',
                'S_SMILIES_CHECKED' => ( !$smilies_on ) ? ' checked="checked"' : '',
                'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? ' checked="checked"' : '',
                'S_HIDDEN_FORM_FIELDS' => $s_hidden_fields,
                'S_POST_ACTION' => append_sid("privmsg.$phpEx"),

                'U_SEARCH_USER' => "modules.php?name=Forums&amp;file=search&amp;mode=searchuser&amp;popup=1",
                'U_VIEW_FORUM' => append_sid("privmsg.$phpEx"))
        );

        $template->pparse('body');

        include(NUKE_INCLUDE_DIR.'page_tail.php');
}

//
// Default page
//
if ( !$userdata['session_logged_in'] )
{
        // not needed anymore due to function redirect()
//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
        redirect("modules.php?name=Your_Account&redirect=privmsg&folder=inbox");
        //redirect(append_sid("login.$phpEx?redirect=privmsg.$phpEx&folder=inbox", true));
        exit;
}

//
// Update unread status
//
$sql = "UPDATE " . USERS_TABLE . "
        SET user_unread_privmsg = user_unread_privmsg + user_new_privmsg, user_new_privmsg = '0', user_last_privmsg = " . $userdata['session_start'] . "
        WHERE user_id = " . $userdata['user_id'];
if ( !$db->sql_query($sql) )
{
        message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
}

$sql = "UPDATE " . PRIVMSGS_TABLE . "
        SET privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "
        WHERE privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                AND privmsgs_to_userid = " . $userdata['user_id'];
if ( !$db->sql_query($sql) )
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
$page_title = $lang['Private_Messaging'];
if( empty($mode) ) {
        include(NUKE_INCLUDE_DIR.'page_header.php');
}

//
// Load templates
//
$template->set_filenames(array(
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
$post_new_mesg_url = '<a href="' . append_sid("privmsg.$phpEx?mode=post") . '"><img src="' . $images['post_new'] . '" alt="' . $lang['Send_a_new_message'] . '" border="0" /></a>';

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
                message_die(GENERAL_MESSAGE, $lang['No_such_folder']);
                break;
}

//
// Show messages over previous x days/months
//
if ( $submit_msgdays && ( !empty($HTTP_POST_VARS['msgdays']) || !empty($HTTP_GET_VARS['msgdays']) ) )
{
        $msg_days = ( !empty($HTTP_POST_VARS['msgdays']) ) ? intval($HTTP_POST_VARS['msgdays']) : intval($HTTP_GET_VARS['msgdays']);
        $min_msg_time = time() - ($msg_days * 86400);

        $limit_msg_time_total = " AND privmsgs_date > $min_msg_time";
        $limit_msg_time = " AND pm.privmsgs_date > $min_msg_time ";

        if ( !empty($HTTP_POST_VARS['msgdays']) )
        {
                $start = 0;
        }
}
else
{
        $limit_msg_time = $limit_msg_time_total = '';
        $msg_days = 0;
}

$sql .= $limit_msg_time . " ORDER BY pm.privmsgs_date DESC LIMIT $start, " . $board_config['topics_per_page'];
$sql_all_tot = $sql_tot;
$sql_tot .= $limit_msg_time_total;

/*****[BEGIN]******************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/
$total_inbox = '';
$total_sentbox = '';
$total_outbox = '';
$total_savebox = '';

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

    if ( !($result1 = $db->sql_query($$sql2)) )
    {
        message_die(GENERAL_ERROR, 'Could not query forum PM information', '', __LINE__, __FILE__, $sql_tot_pm_savebox);
    }
    while ($row1 = $db->sql_fetchrow($result1))
    {
        $total_inbox .= $row1['tot_1'];
        $total_sentbox .= $row1['tot_2'];
        $total_outbox .= $row1['tot_3'];
        $total_savebox .= $row1['tot_4'];
    }

}
/*****[END]********************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/

//
// Get messages
//
if ( !($result = $db->sql_query($sql_tot)) )
{
        message_die(GENERAL_ERROR, 'Could not query private message information', '', __LINE__, __FILE__, $sql_tot);
}

$pm_total = ( $row = $db->sql_fetchrow($result) ) ? $row['total'] : 0;

if ( !($result = $db->sql_query($sql_all_tot)) )
{
        message_die(GENERAL_ERROR, 'Could not query private message information', '', __LINE__, __FILE__, $sql_tot);
}

$pm_all_total = ( $row = $db->sql_fetchrow($result) ) ? $row['total'] : 0;

//
// Build select box
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

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
                $l_box_name = $lang['Inbox'];
                break;
        case 'outbox':
                $l_box_name = $lang['Outbox'];
                break;
        case 'savebox':
                $l_box_name = $lang['Savebox'];
                break;
        case 'sentbox':
                $l_box_name = $lang['Sentbox'];
                break;
}
$post_pm = append_sid("privmsg.$phpEx?mode=post");
$post_pm_img = '<a href="' . $post_pm . '"><img src="' . $images['pm_postmsg'] . '" alt="' . $lang['Post_new_pm'] . '" border="0"></a>';
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_mass_pm.' . $phpEx);
if ( $userdata['user_level'] == ADMIN )
{
    $mass_pm_img = '<a href="' . append_sid("groupmsg.$phpEx") . '"><img src="' . $images['mass_pm'] . '" border="0" alt="' . $lang['Mass_pm'] . '" /></a>';
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
    if( !$g_result = $db->sql_query($sql_g) )
    {
        message_die(GENERAL_ERROR, "Could not select group names!", __LINE__, __FILE__, $sql_g);
    }
    if( $db->sql_numrows($g_result))
    {
        $mass_pm_img = '<a href="' . append_sid("groupmsg.$phpEx") . '"><img src="' . $images['mass_pm'] . '" border="0" alt="' . $lang['Mass_pm'] . '" /></a>';
    }
}
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
$post_pm = '<a href="' . $post_pm . '">' . $lang['Post_new_pm'] . '</a>';

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
    $inbox_limit_pct = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? round(( $pm_all_total / $board_config['max_' . $folder . '_privmsgs'] ) * 100) : 100;
    $inbox_limit_img_length = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? round(( $pm_all_total / $board_config['max_' . $folder . '_privmsgs'] ) * $board_config['privmsg_graphic_length']) : $board_config['privmsg_graphic_length'];
    $inbox_limit_remain = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? $board_config['max_' . $folder . '_privmsgs'] - $pm_all_total : 0;
 /*****[END]********************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/
        $template->assign_block_vars('switch_box_size_notice', array());

        switch( $folder )
        {
                case 'inbox':
                        $l_box_size_status = sprintf($lang['Inbox_size'], $inbox_limit_pct);
                        break;
                case 'sentbox':
                        $l_box_size_status = sprintf($lang['Sentbox_size'], $inbox_limit_pct);
                        break;
                case 'savebox':
                        $l_box_size_status = sprintf($lang['Savebox_size'], $inbox_limit_pct);
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

//
// Dump vars to template
//
$template->assign_vars(array(
        'BOX_NAME' => $l_box_name,
        'INBOX_IMG' => $inbox_img,
        'SENTBOX_IMG' => $sentbox_img,
        'OUTBOX_IMG' => $outbox_img,
        'SAVEBOX_IMG' => $savebox_img,
        'INBOX' => $inbox_url,
        'SENTBOX' => $sentbox_url,
        'OUTBOX' => $outbox_url,
        'SAVEBOX' => $savebox_url,

/*****[BEGIN]******************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/
        'TOTAL_INBOX' => $total_inbox,
        'TOTAL_SENTBOX' => $total_sentbox,
        'TOTAL_OUTBOX' => $total_outbox,
        'TOTAL_SAVEBOX' => $total_savebox,
/*****[END]********************************************
 [ Mod:     Count PM                           v1.0.1 ]
 ******************************************************/
        'POST_PM_IMG' => $post_pm_img,
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        'MASS_PM_IMG' => $mass_pm_img,
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        'POST_PM' => $post_pm,
        'L_GO' => $lang['Go'],

        'INBOX_LIMIT_IMG_WIDTH' => $inbox_limit_img_length,
        'INBOX_LIMIT_PERCENT' => $inbox_limit_pct,
 /*****[Begin]******************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/
        'LCAP_IMG' => $images['voting_lcap'],
        'MAINBAR_IMG' => $images['voting_graphic'][0],
        'RCAP_IMG' => $images['voting_rcap'],
/*****[END]********************************************
 [ Mod:         PM Switchbox Repair              v1.0.0 ]
 *******************************************************/


        'BOX_SIZE_STATUS' => $l_box_size_status,

        'L_INBOX' => $lang['Inbox'],
        'L_OUTBOX' => $lang['Outbox'],
        'L_SENTBOX' => $lang['Sent'],
        'L_SAVEBOX' => $lang['Saved'],
        'L_MARK' => $lang['Mark'],
        'L_FLAG' => $lang['Flag'],
        'L_SUBJECT' => $lang['Subject'],
        'L_DATE' => $lang['Date'],
        'L_DISPLAY_MESSAGES' => $lang['Display_messages'],
        'L_FROM_OR_TO' => ( $folder == 'inbox' || $folder == 'savebox' ) ? $lang['From'] : $lang['To'],
        'L_MARK_ALL' => $lang['Mark_all'],
        'L_UNMARK_ALL' => $lang['Unmark_all'],
        'L_DELETE_MARKED' => $lang['Delete_marked'],
        'L_DELETE_ALL' => $lang['Delete_all'],
        'L_SAVE_MARKED' => $lang['Save_marked'],

        'S_PRIVMSGS_ACTION' => append_sid("privmsg.$phpEx?folder=$folder"),
        'S_HIDDEN_FIELDS' => '',
        'S_POST_NEW_MSG' => $post_new_mesg_url,
        'S_SELECT_MSG_DAYS' => $select_msg_days,

        'U_POST_NEW_TOPIC' => append_sid("privmsg.$phpEx?mode=post"))
);

//
// Okay, let's build the correct folder
//
if ( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not query private messages', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
    $i = 0;
    do
    {
        $privmsg_id = $row['privmsgs_id'];

                $flag = $row['privmsgs_type'];

                $icon_flag = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? $images['pm_unreadmsg'] : $images['pm_readmsg'];
                $icon_flag_alt = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? $lang['Unread_message'] : $lang['Read_message'];

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
                $msg_subject = ($board_config['smilies_in_titles']) ? smilies_pass($row['privmsgs_subject']) : $row['privmsgs_subject'];
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/

                if ( count($orig_word) )
                {
                        $msg_subject = preg_replace($orig_word, $replacement_word, $msg_subject);
                }

                $u_subject = append_sid("privmsg.$phpEx?folder=$folder&amp;mode=read&amp;" . POST_POST_URL . "=$privmsg_id");

                $msg_date = create_date($board_config['default_dateformat'], $row['privmsgs_date'], $board_config['board_timezone']);

                if ( $flag == PRIVMSGS_NEW_MAIL && $folder == 'inbox' )
                {
                        $msg_subject = '<strong>' . $msg_subject . '</strong>';
                        $msg_date = '<strong>' . $msg_date . '</strong>';
                        $msg_username = '<strong>' . $msg_username . '</strong>';
                }

                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
                $i++;
                $template->assign_block_vars('listrow', array(
                        'ROW_COLOR' => '#' . $row_color,
                        'ROW_CLASS' => $row_class,
                        'FROM' => (($row['privmsgs_from_userid'] == 1) ? $board_config['welcome_pm_username'] : $msg_username),
                        'SUBJECT' => $msg_subject,
                        'DATE' => $msg_date,
/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                        'PRIVMSG_ATTACHMENTS_IMG' => privmsgs_attachment_image($privmsg_id),
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                        'PRIVMSG_FOLDER_IMG' => $icon_flag,
                        'L_PRIVMSG_FOLDER_ALT' => $icon_flag_alt,
                        'S_MARK_ID' => $privmsg_id,
                        'U_READ' => $u_subject,
                        'U_FROM_USER_ID' => $row['privmsgs_from_userid'],
                        'U_FROM_USER_PROFILE' => $u_from_user_profile)
                );
        }
        while( $row = $db->sql_fetchrow($result) );

        $template->assign_vars(array(
                'PAGINATION' => generate_pagination("privmsg.$phpEx?folder=$folder", $pm_total, $board_config['topics_per_page'], $start),
                'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $pm_total / $board_config['topics_per_page'] )),

                'L_GOTO_PAGE' => $lang['Goto_page'])
        );

}
else
{
        $template->assign_vars(array(
                'L_NO_MESSAGES' => $lang['No_messages_folder'])
        );

        $template->assign_block_vars("switch_no_messages", array() );
}
if( empty($mode) ) {
    $template->pparse('body');

    include(NUKE_INCLUDE_DIR.'page_tail.php');
}

?>