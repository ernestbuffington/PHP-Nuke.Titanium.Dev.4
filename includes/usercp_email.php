<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             usercp_email.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: usercp_email.php,v 1.7.2.13 2003/06/06 18:02:15 acydburn Exp
 *
 ***************************************************************************/

/***************************************************************************
* phpbb2 forums port version 2.0.5 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Nuke Cops to phpbb2 standalone 2.0.5 Test
* and debugging completed by the Elite Nukers and site members.
*
* You run this package at your sole risk. Nuke Cops and affiliates cannot
* be held liable if anything goes wrong. You are advised to test this
* package on a development system. Backup everything before implementing
* in a production environment. If something goes wrong, you can always
* backout and restore your backups.
*
* Installing and running this also means you agree to the terms of the AUP
* found at Nuke Cops.
*
* This is version 2.0.5 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.0.5 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.5 that fixes some bugs and the
* invalid_session error message.
***************************************************************************/

/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
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
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

// Is send through board enabled? No, return to index
if (!$board_config['board_email_form'])
{
/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
        $header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", $_SERVER["SERVER_SOFTWARE"]) ) ? "Refresh: 0; URL=" : "Location: ";
        redirect(append_sid("index.$phpEx", true));
        exit;
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
}

if ( !empty($HTTP_GET_VARS[POST_USERS_URL]) || !empty($HTTP_POST_VARS[POST_USERS_URL]) )
{
        $user_id = ( !empty($HTTP_GET_VARS[POST_USERS_URL]) ) ? intval($HTTP_GET_VARS[POST_USERS_URL]) : intval($HTTP_POST_VARS[POST_USERS_URL]);
}
else
{
        message_die(GENERAL_MESSAGE, $lang['No_user_specified']);
}

if ( !$userdata['session_logged_in'] )
{
        redirect( append_sid("login.$phpEx?redirect=profile.$phpEx&mode=email&" . POST_USERS_URL . "=$user_id", true));
        exit;
}

$sql = "SELECT username, user_email, user_viewemail, user_lang
        FROM " . USERS_TABLE . "
        WHERE user_id = '$user_id'";
if ( $result = $db->sql_query($sql) )
{
        if ( $row = $db->sql_fetchrow($result) )
	{
        $db->sql_freeresult($result);

        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_lang = $row['user_lang'];

        if ( $row['user_viewemail'] || $userdata['user_level'] == ADMIN )
        {
                if ( time() - $userdata['user_emailtime'] < $board_config['flood_interval'] )
                {
                        message_die(GENERAL_MESSAGE, $lang['Flood_email_limit']);
                }

                if ( isset($HTTP_POST_VARS['submit']) )
                {
                        $error = FALSE;

                        if ( !empty($HTTP_POST_VARS['subject']) )
                        {
                                $subject = trim(stripslashes($HTTP_POST_VARS['subject']));
                        }
                        else
                        {
                                $error = TRUE;
                                $error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Empty_subject_email'] : $lang['Empty_subject_email'];
                        }

                        if ( !empty($HTTP_POST_VARS['message']) )
                        {
                                $message = trim(stripslashes($HTTP_POST_VARS['message']));
                        }
                        else
                        {
                                $error = TRUE;
                                $error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Empty_message_email'] : $lang['Empty_message_email'];
                        }

                        if ( !$error )
                        {
                                $sql = "UPDATE " . USERS_TABLE . "
                                        SET user_emailtime = " . time() . "
                                        WHERE user_id = " . $userdata['user_id'];
                                if ( $result = $db->sql_query($sql) )
                                {
                                        $db->sql_freeresult($result);
                                        include("includes/emailer.php");
                                        $emailer = new emailer($board_config['smtp_delivery']);

                                        $emailer->from($userdata['user_email']);
                                        $emailer->replyto($userdata['user_email']);

                                        $email_headers = 'X-AntiAbuse: Board servername - ' . $server_name . "\n";
                                        $email_headers .= 'X-AntiAbuse: User_id - ' . $userdata['user_id'] . "\n";
                                        $email_headers .= 'X-AntiAbuse: Username - ' . $userdata['username'] . "\n";
                                        $email_headers .= 'X-AntiAbuse: User IP - ' . decode_ip($user_ip) . "\n";

                                        $emailer->use_template('profile_send_email', $user_lang);
                                        $emailer->email_address($user_email);
                                        $emailer->set_subject($subject);
                                        $emailer->extra_headers($email_headers);

                                        $emailer->assign_vars(array(
                                                'SITENAME' => $board_config['sitename'],
                                                'BOARD_EMAIL' => $board_config['board_email'],
                                                'FROM_USERNAME' => $userdata['username'],
                                                'TO_USERNAME' => $username,
                                                'MESSAGE' => $message)
                                        );
                                        $emailer->send();
                                        $emailer->reset();

                                        if ( !empty($HTTP_POST_VARS['cc_email']) )
                                        {
                                                $emailer->from($userdata['user_email']);
                                                $emailer->replyto($userdata['user_email']);
                                                $emailer->use_template('profile_send_email');
                                                $emailer->email_address($userdata['user_email']);
                                                $emailer->set_subject($subject);

                                                $emailer->assign_vars(array(
                                                        'SITENAME' => $board_config['sitename'],
                                                        'BOARD_EMAIL' => $board_config['board_email'],
                                                        'FROM_USERNAME' => $userdata['username'],
                                                        'TO_USERNAME' => $username,
                                                        'MESSAGE' => $message)
                                                );
                                                $emailer->send();
                                                $emailer->reset();
                                        }

                                        $template->assign_vars(array(
                                                'META' => '<meta http-equiv="refresh" content="5;url=' . append_sid("index.$phpEx") . '">')
                                        );

                                        $message = $lang['Email_sent'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

                                        message_die(GENERAL_MESSAGE, $message);
                                }
                                else
                                {
                                        message_die(GENERAL_ERROR, 'Could not update last email time', '', __LINE__, __FILE__, $sql);
                                }
                        }
                }

                include("includes/page_header.php");

                $template->set_filenames(array(
                        'body' => 'profile_send_email.tpl')
                );
                make_jumpbox('viewforum.'.$phpEx);

                if ( $error )
                {
                        $template->set_filenames(array(
                                'reg_header' => 'error_body.tpl')
                        );
                        $template->assign_vars(array(
                                'ERROR_MESSAGE' => $error_msg)
                        );
                        $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
                }

                $template->assign_vars(array(
                        'USERNAME' => $username,

                        'S_HIDDEN_FIELDS' => '',
                        'S_POST_ACTION' => append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL . "=$user_id"),

                        'L_SEND_EMAIL_MSG' => $lang['Send_email_msg'],
                        'L_RECIPIENT' => $lang['Recipient'],
                        'L_SUBJECT' => $lang['Subject'],
                        'L_MESSAGE_BODY' => $lang['Message_body'],
                        'L_MESSAGE_BODY_DESC' => $lang['Email_message_desc'],
                        'L_EMPTY_SUBJECT_EMAIL' => $lang['Empty_subject_email'],
                        'L_EMPTY_MESSAGE_EMAIL' => $lang['Empty_message_email'],
                        'L_OPTIONS' => $lang['Options'],
                        'L_CC_EMAIL' => $lang['CC_email'],
                        'L_SPELLCHECK' => $lang['Spellcheck'],
                        'L_SEND_EMAIL' => $lang['Send_email'])
                );

                $template->pparse('body');

                include("includes/page_tail.php");
        }
        else
        {
                message_die(GENERAL_MESSAGE, $lang['User_prevent_email']);
        }
}
	else
	{
		message_die(GENERAL_MESSAGE, $lang['User_not_exist']);
	}
}
else
{
	message_die(GENERAL_ERROR, 'Could not select user data', '', __LINE__, __FILE__, $sql);
}

?>