<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            usercp_activate.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: usercp_activate.php,v 1.6.2.8 2005/07/19 20:01:16 acydburn Exp
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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

$sql = "SELECT user_active, user_id, username, user_email, user_newpasswd, user_lang, user_actkey
        FROM " . USERS_TABLE . "
        WHERE user_id = " . intval($HTTP_GET_VARS[POST_USERS_URL]);
if ( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not obtain user information', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
        if ( $row['user_active'] && empty($row['user_actkey']) )
        {
                $template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.$phpEx") . '">')
                );

                message_die(GENERAL_MESSAGE, $lang['Already_activated']);
        }
        else if ((trim($row['user_actkey']) == trim($HTTP_GET_VARS['act_key'])) && (!empty($row['user_actkey'])))
        {
            if (intval($board_config['require_activation']) == USER_ACTIVATION_ADMIN && $row['user_newpasswd'] == '')
            {
                if (!$userdata['session_logged_in'])
                {
                    redirect(append_sid('login.' . $phpEx . '?redirect=profile.' . $phpEx . '&mode=activate&' . POST_USERS_URL . '=' . $row['user_id'] . '&act_key=' . trim($HTTP_GET_VARS['act_key'])));
                }
                else if ($userdata['user_level'] != ADMIN)
                {
                    message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
                }
            }
                $sql_update_pass = ( !empty($row['user_newpasswd']) ) ? ", user_password = '" . str_replace("\'", "''", $row['user_newpasswd']) . "', user_newpasswd = ''" : '';

                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_active = 1, user_actkey = ''" . $sql_update_pass . "
                        WHERE user_id = " . $row['user_id'];
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql_update);
                }

                if ( intval($board_config['require_activation']) == USER_ACTIVATION_ADMIN && empty($sql_update_pass) )
                {
                        include("includes/emailer.php");
                        $emailer = new emailer($board_config['smtp_delivery']);

                        $emailer->from($board_config['board_email']);
                        $emailer->replyto($board_config['board_email']);

                        $emailer->use_template('admin_welcome_activated', $row['user_lang']);
                        $emailer->email_address($row['user_email']);
                        $emailer->set_subject($lang['Account_activated_subject']);

                        $emailer->assign_vars(array(
                                'SITENAME' => $board_config['sitename'],
                                'USERNAME' => $row['username'],
                                'PASSWORD' => $password_confirm,
                                'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '')
                        );
                        $emailer->send();
                        $emailer->reset();

                        $template->assign_vars(array(
                                'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.$phpEx") . '">')
                        );

                        message_die(GENERAL_MESSAGE, $lang['Account_active_admin']);
                }
                else
                {
                        $template->assign_vars(array(
                                'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.$phpEx") . '">')
                        );

                        $message = ( $sql_update_pass == '' ) ? $lang['Account_active'] : $lang['Password_activated'];
                        message_die(GENERAL_MESSAGE, $message);
                }
        }
        else
        {
                message_die(GENERAL_MESSAGE, $lang['Wrong_activation']);
        }
        $db->sql_freeresult($result);
}
else
{
        message_die(GENERAL_MESSAGE, $lang['No_such_user']);
}
?>