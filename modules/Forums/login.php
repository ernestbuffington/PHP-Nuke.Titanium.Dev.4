<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                login.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: login.php,v 1.47.2.18 2005/05/06 20:50:10 acydburn Exp
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
      Evolution Functions                      v1.5.0       12/20/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

$titanium_module_name = basename(dirname(__FILE__));
require("modules/".$titanium_module_name."/nukebb.php");

//
// Allow people to reach login page if
// board is shut down
//
define("IN_LOGIN", true);

define('IN_PHPBB2', true);
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);

//
// Set page ID for session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_LOGIN);
titanium_init_userprefs($userdata);
//
// End session management
//

// session id check
if (!empty($HTTP_POST_VARS['sid']) || !empty($HTTP_GET_VARS['sid']))
{
    $sid = (!empty($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS['sid'];
}
else
{
    $sid = '';
}

if( isset($HTTP_POST_VARS['login']) || isset($HTTP_GET_VARS['login']) || isset($HTTP_POST_VARS['logout']) || isset($HTTP_GET_VARS['logout']) )
{
    if( ( isset($HTTP_POST_VARS['login']) || isset($HTTP_GET_VARS['login']) ) && (!$userdata['session_logged_in'] || isset($HTTP_POST_VARS['admin'])) )
    {
        $titanium_username = isset($HTTP_POST_VARS['username']) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';
        $password = isset($HTTP_POST_VARS['password']) ? $HTTP_POST_VARS['password'] : '';

        $sql = "SELECT user_id, username, user_password, user_active, user_level, user_login_tries, user_last_login_try
            FROM " . USERS_TABLE . "
            WHERE username = '" . str_replace("\\'", "''", $titanium_username) . "'";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);
        }

        if( $row = $titanium_db->sql_fetchrow($result) )
        {
            if( $row['user_level'] != ADMIN && $phpbb2_board_config['board_disable'] )
            {
                                redirect_titanium(append_titanium_sid("index.$phpEx", true));
                                exit;
            }
            else
            {
                 // If the last login is more than x minutes ago, then reset the login tries/time
                 if ($row['user_last_login_try'] && $phpbb2_board_config['login_reset_time'] && $row['user_last_login_try'] < (time() - ($phpbb2_board_config['login_reset_time'] * 60)))
                 {
                    $titanium_db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
                    $row['user_last_login_try'] = $row['user_login_tries'] = 0;
                 }

                 // Check to see if user is allowed to login again... if his tries are exceeded
                 if ($row['user_last_login_try'] && $phpbb2_board_config['login_reset_time'] && $phpbb2_board_config['max_login_attempts'] &&
                    $row['user_last_login_try'] >= (time() - ($phpbb2_board_config['login_reset_time'] * 60)) && $row['user_login_tries'] >= $phpbb2_board_config['max_login_attempts'] && $userdata['user_level'] != ADMIN)
                 {
                    message_die(GENERAL_MESSAGE, sprintf($titanium_lang['Login_attempts_exceeded'], $phpbb2_board_config['max_login_attempts'], $phpbb2_board_config['login_reset_time']));
                }
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                if( md5($password) == $row['user_password'] && $row['user_active'] )
                {
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                    $autologin = ( isset($HTTP_POST_VARS['autologin']) ) ? TRUE : 0;

                    $admin = (isset($HTTP_POST_VARS['admin'])) ? 1 : 0;
                    $titanium_session_id = session_begin_titanium($row['user_id'], $titanium_user_ip, PAGE_INDEX, FALSE, $autologin, $admin);
                    // Reset login tries
                    $titanium_db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);

                    if( $titanium_session_id )
                    {
                        $url = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "index.$phpEx";
                        redirect_titanium(append_titanium_sid($url, true));
                    }
                    else
                    {
                        message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);
                    }
                }
                // Only store a failed login attempt for an active user - inactive users can't login even with a correct password
 				elseif( $row['user_active'] )
                {
                       // Save login tries and last login
                       if ($row['user_id'] != ANONYMOUS)
                       {
                          $sql = 'UPDATE ' . USERS_TABLE . '
                             SET user_login_tries = user_login_tries + 1, user_last_login_try = ' . time() . '
                             WHERE user_id = ' . $row['user_id'];
                          $titanium_db->sql_query($sql);
                       }
                    $redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : '';
                    $redirect = str_replace('?', '&', $redirect);

                    if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
                    {
                        message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
                    }

                    $phpbb2_template->assign_vars(array(
                        'META' => '<meta http-equiv=\"refresh\" content=\"3;url=' . append_titanium_sid("login.$phpEx?redirect=$redirect") . '\">')
                    );

                    $message = $titanium_lang['Error_login'] . '<br /><br />' . sprintf($titanium_lang['Click_return_login'], '<a href=\"' . append_titanium_sid("login.$phpEx?redirect=$redirect") . '\">', '</a>') . '<br /><br />' .  sprintf($titanium_lang['Click_return_index'], '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a>');

                    message_die(GENERAL_MESSAGE, $message);
                }
            }
        }
        else
        {

				$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : '';
				$redirect = str_replace('?', '&', $redirect);

				if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
				{
					message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
				}

				$phpbb2_template->assign_vars(array(
					'META' => "<meta http-equiv=\"refresh\" content=\"3;url=login.$phpEx?redirect=$redirect\">")
				);

				$message = $titanium_lang['Error_login'] . '<br /><br />' . sprintf($titanium_lang['Click_return_login'], "<a href=\"login.$phpEx?redirect=$redirect\">", '</a>') . '<br /><br />' .  sprintf($titanium_lang['Click_return_index'], '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a>');

				message_die(GENERAL_MESSAGE, $message);
        }
    }
    else if( ( isset($HTTP_GET_VARS['logout']) || isset($HTTP_POST_VARS['logout']) ) && $userdata['session_logged_in'] )
    {
        // session id check
        if ($sid == '' || $sid != $userdata['session_id'])
        {
            message_die(GENERAL_ERROR, 'Invalid_session');
        }
        if( $userdata['session_logged_in'] )
        {
            titanium_session_end($userdata['session_id'], $userdata['user_id']);
        }

        if (!empty($HTTP_POST_VARS['redirect']) || !empty($HTTP_GET_VARS['redirect']))
        {
            $url = (!empty($HTTP_POST_VARS['redirect'])) ? htmlspecialchars($HTTP_POST_VARS['redirect']) : htmlspecialchars($HTTP_GET_VARS['redirect']);
            $url = str_replace('&amp;', '&', $url);
            redirect_titanium(append_titanium_sid($url, true));
        }
        else
        {
            redirect_titanium(append_titanium_sid("index.$phpEx", true));
        }
    }
    else
    {
        $url = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "index.$phpEx";
        redirect_titanium(append_titanium_sid($url, true));
    }
}
else
{
    //
    // Do a full login page dohickey if
    // user not already logged in
    //
    if( !$userdata['session_logged_in'] || (isset($HTTP_GET_VARS['admin']) && $userdata['session_logged_in'] && $userdata['user_level'] == ADMIN))
    {
        $phpbb2_page_title = $titanium_lang['Login'];
                include("includes/page_header.php");

        $phpbb2_template->set_filenames(array(
            'body' => 'login_body.tpl')
        );

        $forward_page = '';

        if( isset($HTTP_POST_VARS['redirect']) || isset($HTTP_GET_VARS['redirect']) )
        {
            $forward_to = $HTTP_SERVER_VARS['QUERY_STRING'];

            if( preg_match("/^redirect=([a-z0-9\.#\/\?&=\+\-_]+)/si", $forward_to, $forward_matches) )
            {
                $forward_to = ( !empty($forward_matches[3]) ) ? $forward_matches[3] : $forward_matches[1];
                $forward_match = explode('&', $forward_to);

                if(count($forward_match) > 1)
                {
                    for($i = 1; $i < count($forward_match); $i++)
                    {
                        if( !preg_match("/sid=/", $forward_match[$i]) )
                        {
                            if( $forward_page != '' )
                            {
                                $forward_page .= '&';
                            }
                            $forward_page .= $forward_match[$i];
                        }
                    }
                    $forward_page = $forward_match[0] . '?' . $forward_page;
                }
                else
                {
                    $forward_page = $forward_match[0];
                }
            }
        }

        redirect_titanium("modules.php?name=Your_Account&redirect=$forward_page");
        $titanium_username = ( $userdata['user_id'] != ANONYMOUS ) ? $userdata['username'] : '';

        $s_hidden_fields = '<input type="hidden" name="redirect" value="' . $forward_page . '" />';

        $s_hidden_fields .= (isset($HTTP_GET_VARS['admin'])) ? '<input type="hidden" name="admin" value="1" />' : '';

        make_jumpbox('viewforum.'.$phpEx);
        $phpbb2_template->assign_vars(array(
            'USERNAME' => $titanium_username,

            'L_ENTER_PASSWORD' => (isset($HTTP_GET_VARS['admin'])) ? $titanium_lang['Admin_reauthenticate'] : $titanium_lang['Enter_password'],
            'L_SEND_PASSWORD' => $titanium_lang['Forgotten_password'],

            'U_SEND_PASSWORD' => append_titanium_sid("profile.$phpEx?mode=sendpassword"),

            'S_HIDDEN_FIELDS' => $s_hidden_fields)
        );

        $phpbb2_template->pparse('body');

                include("includes/page_tail.php");
    }
    else
    {
                redirect_titanium(append_titanium_sid("index.$phpEx", true));
                exit;
    }

}

?>