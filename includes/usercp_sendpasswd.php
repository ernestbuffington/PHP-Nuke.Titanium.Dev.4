<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                           usercp_sendpasswd.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: usercp_sendpasswd.php,v 1.6.2.12 2004/11/18 17:49:45 acydburn Exp
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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

if ( isset($HTTP_POST_VARS['submit']) )
{
    $titanium_username = ( !empty($HTTP_POST_VARS['username']) ) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';
    $email = ( !empty($HTTP_POST_VARS['email']) ) ? trim(strip_tags(htmlspecialchars($HTTP_POST_VARS['email']))) : '';

        $sql = "SELECT user_id, username, user_email, user_active, user_lang
                FROM " . USERS_TABLE . "
                WHERE user_email = '" . str_replace("\'", "''", $email) . "'
            AND username = '" . str_replace("\'", "''", $titanium_username) . "'";
    if ( $result = $titanium_db->sql_query($sql) )
    {
        if ( $row = $titanium_db->sql_fetchrow($result) )
        {
            if ( !$row['user_active'] )
            {
                message_die(GENERAL_MESSAGE, $lang['No_send_account_inactive']);
            }

            $titanium_username = $row['username'];
            $titanium_user_id = $row['user_id'];

            $titanium_user_actkey = gen_rand_string(true);
            $key_len = 54 - strlen($server_url);
            $key_len = ($key_len > 6) ? $key_len : 6;
            $titanium_user_actkey = substr($titanium_user_actkey, 0, $key_len);
            $user_password = gen_rand_string(false);
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                        $sql = "UPDATE " . USERS_TABLE . "
                SET user_newpasswd = '" . md5($user_password) . "', user_actkey = '$titanium_user_actkey'  
                WHERE user_id = " . $row['user_id'];
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            if ( !$titanium_db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Could not update new password information', '', __LINE__, __FILE__, $sql);
            }

            include("includes/emailer.php");
            $emailer = new emailer($phpbb2_board_config['smtp_delivery']);

            $emailer->from($phpbb2_board_config['board_email']);
            $emailer->replyto($phpbb2_board_config['board_email']);

            $emailer->use_template('user_activate_passwd', $row['user_lang']);
            $emailer->email_address($row['user_email']);
            $emailer->set_subject($lang['New_password_activation']);

            $emailer->assign_vars(array(
                'SITENAME' => $phpbb2_board_config['sitename'], 
                'USERNAME' => $titanium_username,
                'PASSWORD' => $user_password,
                'EMAIL_SIG' => (!empty($phpbb2_board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $phpbb2_board_config['board_email_sig']) : '', 

                'U_ACTIVATE' => $server_url . '&mode=activate&' . POST_USERS_URL . '=' . $titanium_user_id . '&act_key=' . $titanium_user_actkey)
            );
            $emailer->send();
            $emailer->reset();

            $phpbb2_template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="15;url=' . append_titanium_sid("index.$phpEx") . '">')
            );

            $message = $lang['Password_updated'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a>');

            message_die(GENERAL_MESSAGE, $message);
        }
        else
        {
            message_die(GENERAL_MESSAGE, $lang['No_email_match']);
        }
    }
    else
    {
        message_die(GENERAL_ERROR, 'Could not obtain user information for sendpassword', '', __LINE__, __FILE__, $sql);
    }
}
else
{
    $titanium_username = '';
    $email = '';
}

//
// Output basic page
//
include("includes/page_header.php");

$phpbb2_template->set_filenames(array(
    'body' => 'profile_send_pass.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$phpbb2_template->assign_vars(array(
    'USERNAME' => $titanium_username,
    'EMAIL' => $email,

        'L_SEND_PASSWORD' => $lang['Send_password'],
    'L_ITEMS_REQUIRED' => $lang['Items_required'],
    'L_EMAIL_ADDRESS' => $lang['Email_address'],
    'L_SUBMIT' => $lang['Submit'],
    'L_RESET' => $lang['Reset'],

        'S_HIDDEN_FIELDS' => '',
    'S_PROFILE_ACTION' => append_titanium_sid("profile.$phpEx?mode=sendpassword"))
);

$phpbb2_template->pparse('body');

include("includes/page_tail.php");

?>