<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                             admin_mass_email.php
*                              -------------------
*     begin                : Thu May 31, 2001
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*     Id: admin_mass_email.php,v 1.15.2.7 2003/05/03 23:24:01 acydburn Exp
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $titanium_module['General']['Mass_Email'] = $filename;

        return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Increase maximum execution time in case of a lot of users, but don't complain about it if it isn't
// allowed.
//
@set_time_limit(1200);

$message = '';
$subject = '';

//
// Do the job ...
//
if ( isset($HTTP_POST_VARS['submit']) )
{
        $subject = stripslashes(trim($HTTP_POST_VARS['subject']));
        $message = stripslashes(trim($HTTP_POST_VARS['message']));

        $error = FALSE;
        $error_msg = '';

        if ( empty($subject) )
        {
                $error = true;
                $error_msg .= ( !empty($error_msg) ) ? '<br />' . $titanium_lang['Empty_subject'] : $titanium_lang['Empty_subject'];
        }

        if ( empty($message) )
        {
                $error = true;
                $error_msg .= ( !empty($error_msg) ) ? '<br />' . $titanium_lang['Empty_message'] : $titanium_lang['Empty_message'];
        }

        $group_id = intval($HTTP_POST_VARS[POST_GROUPS_URL]);

        $sql = ( $group_id != -1 ) ? "SELECT u.user_email FROM " . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug WHERE ug.group_id = $group_id AND ug.user_pending <> " . TRUE . " AND u.user_id = ug.user_id" : "SELECT user_email FROM " . USERS_TABLE;
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not select group members', '', __LINE__, __FILE__, $sql);
        }

        if ( $row = $titanium_db->sql_fetchrow($result) )
        {
                $bcc_list = array();
                do
                {
                        $bcc_list[] = $row['user_email'];
                }
                while ( $row = $titanium_db->sql_fetchrow($result) );

                $titanium_db->sql_freeresult($result);
        }
        else
        {
                $message = ( $group_id != -1 ) ? $titanium_lang['Group_not_exist'] : $titanium_lang['No_such_user'];

                $error = true;
                $error_msg .= ( !empty($error_msg) ) ? '<br />' . $message : $message;
        }

        if ( !$error )
        {
                include("../../../includes/emailer.php");

                //
                // Let's do some checking to make sure that mass mail functions
                // are working in win32 versions of php.
                //
                if ( preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$phpbb2_board_config['smtp_delivery'])
                {
                        $ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

                        // We are running on windows, force delivery to use our smtp functions
                        // since php's are broken by default
                        $phpbb2_board_config['smtp_delivery'] = 1;
                        $phpbb2_board_config['smtp_host'] = @$ini_val('SMTP');
                }

                $emailer = new emailer($phpbb2_board_config['smtp_delivery']);

                $emailer->from($phpbb2_board_config['board_email']);
                $emailer->replyto($phpbb2_board_config['board_email']);

                for ($i = 0; $i < count($bcc_list); $i++)
                {
                        $emailer->bcc($bcc_list[$i]);
                }

                $email_headers = 'X-AntiAbuse: Board servername - ' . $phpbb2_board_config['server_name'] . "\n";
                $email_headers .= 'X-AntiAbuse: User_id - ' . $userdata['user_id'] . "\n";
                $email_headers .= 'X-AntiAbuse: Username - ' . $userdata['username'] . "\n";
                $email_headers .= 'X-AntiAbuse: User IP - ' . decode_ip($titanium_user_ip) . "\n";

                $emailer->use_template('admin_send_email');
                $emailer->email_address($phpbb2_board_config['board_email']);
                $emailer->set_subject($subject);
                $emailer->extra_headers($email_headers);

                $emailer->assign_vars(array(
                        'SITENAME' => $phpbb2_board_config['sitename'],
                        'BOARD_EMAIL' => $phpbb2_board_config['board_email'],
                        'MESSAGE' => $message)
                );
                $emailer->send();
                $emailer->reset();

                message_die(GENERAL_MESSAGE, $titanium_lang['Email_sent'] . '<br /><br />' . sprintf($titanium_lang['Click_return_admin_index'],  '<a href="' . append_titanium_sid("index.$phpEx?pane=right") . '">', '</a>'));
        }
}

if ( $error )
{
        $phpbb2_template->set_filenames(array(
                'reg_header' => 'error_body.tpl')
        );
        $phpbb2_template->assign_vars(array(
                'ERROR_MESSAGE' => $error_msg)
        );
        $phpbb2_template->assign_var_from_handle('ERROR_BOX', 'reg_header');
}

//
// Initial selection
//

$sql = "SELECT group_id, group_name
        FROM ".GROUPS_TABLE . "
        WHERE group_single_user <> 1";
if ( !($result = $titanium_db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not obtain list of groups', '', __LINE__, __FILE__, $sql);
}

$select_list = '<select name = "' . POST_GROUPS_URL . '"><option value = "-1">' . $titanium_lang['All_users'] . '</option>';
if ( $row = $titanium_db->sql_fetchrow($result) )
{
        do
        {
                $select_list .= '<option value = "' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
        }
        while ( $row = $titanium_db->sql_fetchrow($result) );
}
$select_list .= '</select>';

//
// Generate page
//
include('./page_header_admin.'.$phpEx);

$phpbb2_template->set_filenames(array(
        'body' => 'admin/user_email_body.tpl')
);

$phpbb2_template->assign_vars(array(
        'MESSAGE' => $message,
        'SUBJECT' => $subject,

        'L_EMAIL_TITLE' => $titanium_lang['Email'],
        'L_EMAIL_EXPLAIN' => $titanium_lang['Mass_email_explain'],
        'L_COMPOSE' => $titanium_lang['Compose'],
        'L_RECIPIENTS' => $titanium_lang['Recipients'],
        'L_EMAIL_SUBJECT' => $titanium_lang['Subject'],
        'L_EMAIL_MSG' => $titanium_lang['Message'],
        'L_EMAIL' => $titanium_lang['Email'],
        'L_NOTICE' => $notice,

        'S_USER_ACTION' => append_titanium_sid('admin_mass_email.'.$phpEx),
        'S_GROUP_SELECT' => $select_list)
);

$phpbb2_template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>