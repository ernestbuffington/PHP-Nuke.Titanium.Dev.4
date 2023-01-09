<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                               groupmsgs.php
 *                            -------------------
 *   begin                : Saturday, Jun 11, 2002
 *   author               : Niels Chr. Denmark <ncr@db9.dk> (http://mods.db9.dk)
 *   email                : support@phpbb.com
 *
 *
 * version 0.9.9.
 *
 * History:
 *   0.9.0. - initial BETA
 *   0.9.1. - fixed that also "annonumous was getting a PM
 *   0.9.2. - now support auth level, users of different level can mass pm if allowed
 *   0.9.3. - added support for direct linked mass PM, e.g. www.yoursite.com/mass_email.php?groupname=newsletter (group name is case sensitive)
 *   0.9.4. - Minor bug, in some cases email notifications was not send
 *   0.9.5. - now posible to "personalice the PM with username, a "TAG" like [USERNAME] will be replaced with the users name
 *   0.9.6. - fixed that "usergroup selection was default to "all users" upon preview, also include number of recipents in preview
 *   0.9.7. - fixed, that this mod did have some code left over from my "extra permission mod"
 *   0.9.8. - fix, chaged || to &&
 *   0.9.9. - unroll the 0.9.8.
 *
 *
 * mass PM, based on the original privmsgs.php, modifyed to allow moderators of a group to
 * make PM to the users of the group he/she moderate
 * This mod require a SQL entry in the users table, named "user_allow_mass_pm",
 * and the user have enabled it in the users profile
 * a value of 0 means "Disable mass PM"
 * a value of 2 means "Enable mass PM, no notify by email"
 * a value of 4 means "Enable mass PM, notify by email"
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

define('IN_PHPBB', true);

$phpbb_root_path = NUKE_FORUMS_DIR;
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include('includes/bbcode.'.$phpEx);
include('includes/functions_post.'.$phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_mass_pm.' . $phpEx);
include(NUKE_BASE_DIR.'header.php');
//
// Is PM disabled?
//
if ( !empty($board_config['privmsg_disable']) )
{
    message_die(GENERAL_MESSAGE, 'PM_disabled');
}

//
// Increase maximum execution time in case of a lot of users, but don't complain about it if it isn't
// allowed.
//
set_time_limit(120);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PRIVMSGS);
init_userprefs($userdata);
//
// End session management
//

$html_entities_match = ['#&#', '#<#', '#>#'];
$html_entities_replace = ['&amp;', '&lt;', '&gt;'];

//
// Parameters
//
$submit = ( isset($_POST['post']) ) ? TRUE : 0;
$preview = ( isset($_POST['preview']) ) ? TRUE : 0;
$group_id = $_POST[POST_GROUPS_URL] = $_POST[POST_GROUPS_URL] ?? '';

if ( !empty($group_id) )
{
    if( $group_id != 'users' && $group_id != 'admins' && $group_id != 'moderators')
    {
        $sql = "SELECT DISTINCT g.group_name
            FROM ".GROUPS_TABLE . " g, ".USER_GROUP_TABLE . " ug
            WHERE g.group_single_user <> 1 AND g.group_id='".$group_id."'
            AND (
                        ('".$userdata['user_level']."'='".ADMIN."') OR
                        (g.group_allow_pm='".AUTH_MOD."' AND g.group_moderator = '" . $userdata['user_id']."') OR
                        (g.group_allow_pm='".AUTH_ACL."' AND ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ) OR
                        (g.group_allow_pm='".AUTH_REG."' AND '".$userdata['user_id']."'!='".ANONYMOUS."' ) OR
                        (g.group_allow_pm='".AUTH_ALL."')
                )" ;
        $result = $db->sql_query($sql);
        if( !$result = $db->sql_query($sql) )
            message_die(GENERAL_ERROR, "Could not select group name!", __LINE__, __FILE__, $sql);
        if( ! $db->sql_numrows($result)) message_die(GENERAL_ERROR, $lang['Not_Authorised']);
        $group = $db->sql_fetchrow($result);
        $group_name=$group['group_name'];
        $sql = "SELECT distinct u.user_id, u.user_lang, u.user_email, u.username, u.user_notify_pm,u.user_active,u.user_allow_mass_pm
            FROM " . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug
            WHERE u.user_allow_mass_pm > 1 AND ug.group_id = $group_id
                AND ug.user_pending <> " . TRUE . "
                AND u.user_id <> " . ANONYMOUS . "
                AND u.user_id = ug.user_id
                ORDER BY u.user_lang";
    }
    elseif ($group_id == 'users')
    {
        if( $userdata['user_level']!=ADMIN ) message_die(GENERAL_ERROR, $lang['Not_Authorised']);
        $sql = "SELECT distinct user_id, user_lang, user_email, username, user_notify_pm,user_active,user_allow_mass_pm
            FROM " . USERS_TABLE." WHERE user_allow_mass_pm > 1
                    AND user_id <> " . ANONYMOUS." ORDER BY user_lang";
        $group_name=$lang['All_users'];
    }
    elseif ($group_id == 'admins')
    {
        if( $userdata['user_level']!=ADMIN ) message_die(GENERAL_ERROR, $lang['Not_Authorised']);
        $sql = "SELECT distinct user_id, user_lang, user_email, username, user_notify_pm,user_active,user_allow_mass_pm
            FROM " . USERS_TABLE." WHERE user_allow_mass_pm > 1
                    AND user_level = '2' ORDER BY user_lang";
        $group_name=$lang['All_admins'];
    }
    elseif ($group_id == 'moderators')
    {
        if( $userdata['user_level']!=ADMIN ) message_die(GENERAL_ERROR, $lang['Not_Authorised']);
        $sql = "SELECT distinct user_id, user_lang, user_email, username, user_notify_pm,user_active,user_allow_mass_pm
            FROM " . USERS_TABLE." WHERE user_allow_mass_pm > 1
                    AND user_level = '3' ORDER BY user_lang";
        $group_name=$lang['All_mods'];
    }
    if( !$result = $db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, "Coult not select group members!", __LINE__, __FILE__, $sql);
    }
    if( ! $db->sql_numrows($result))
    {
        $pm_list = $db->sql_fetchrowset($result);
        //
        // Output a relevant GENERAL_MESSAGE about users/group
        // not existing
        //
        $error = TRUE;
        $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_to_user'];
    }
    $PM_list = $db->sql_fetchrowset($result);
    $PM_count=$db->sql_numrows($result);
}

//
// Var definitions
//
if ( !empty($_POST['mode']) || !empty($_GET['mode']) )
{
    $mode = ( !empty($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
}
else
{
    $mode = 'post';
}
$error = FALSE;

// ----------
// Start main
//
    //
    // Toggles
    //
    if ( !$board_config['allow_html'] )
    {
        $html_on = 0;
    }
    else
    {
        $html_on = ( $submit = $submit ?? '' || $refresh = $refresh ?? '' ) ? ( ( !empty($_POST['disable_html']) ) ? 0 : TRUE ) : $userdata['user_allowhtml'];
    }

    if ( !$board_config['allow_bbcode'] )
    {
        $bbcode_on = 0;
    }
    else
    {
        $bbcode_on = ( $submit = $submit ?? '' || $refresh = $refresh ?? '' ) ? ( ( !empty($_POST['disable_bbcode']) ) ? 0 : TRUE ) : $userdata['user_allowbbcode'];
    }

    if ( !$board_config['allow_smilies'] )
    {
        $smilies_on = 0;
    }
    else
    {
        $smilies_on = ( $submit = $submit ?? '' || $refresh = $refresh ?? '' ) ? ( ( !empty($_POST['disable_smilies']) ) ? 0 : TRUE ) : $userdata['user_allowsmile'];
    }

    $attach_sig = ( $submit = $submit ?? '' || $refresh = $refresh ?? '' ) ? ( ( !empty($_POST['attach_sig']) ) ? TRUE : 0 ) : $userdata['user_attachsig'];
    $user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : "";

    if ( $submit)
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
        if ( empty($group_id) )
        {
            $error = TRUE;
            $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_to_user'];
        }

        $privmsg_subject = trim(strip_tags((string) $_POST['subject']));
        if ( empty($privmsg_subject) )
        {
            $error = TRUE;
            $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_subject'];
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
        include('includes/emailer.'.$phpEx);
        $i=0;
        while ($i<(is_countable($PM_list) ? count($PM_list) : 0))
        {
            set_time_limit(30);
            $to_userdata=$PM_list[$i];
            $msg_time = time();

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
                if ( $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'] )
                {
                    $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                        WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  )
                            AND privmsgs_date = " . $inbox_info['oldest_post_time'] . "
                            AND privmsgs_to_userid = " . $to_userdata['user_id'];
                    if ( !$db->sql_query($sql) )
                    {
                        message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs', '', __LINE__, __FILE__, $sql);
                    }
                }
            }

            $sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, 
			                                                 privmsgs_subject, 
													         privmsgs_from_userid, 
															 privmsgs_to_userid, 
															 privmsgs_date, 
															 privmsgs_ip, 
															 privmsgs_enable_html, 
															 privmsgs_enable_bbcode, 
															 privmsgs_enable_smilies, 
															 privmsgs_attach_sig)
            
			VALUES (" . PRIVMSGS_NEW_MAIL . ", 
			       '" . str_replace("\'", "''", str_replace("[USERNAME]",$to_userdata['username'],$privmsg_subject)) . "', 
				   " . $userdata['user_id'] . ", 
				   " . $to_userdata['user_id'] . ", 
				   $msg_time, 
				   '$user_ip', 
				   $html_on, 
				   $bbcode_on, 
				   $smilies_on, 
				   $attach_sig)";

            if ( !($result = $db->sql_query($sql_info)) )
            {
                message_die(GENERAL_ERROR, "Could not insert private message sent info.", "", __LINE__, __FILE__, $sql_info);
            }

            $privmsg_sent_id = $db->sql_nextid();

            $sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
                VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", str_replace("[USERNAME]",$to_userdata['username'],(string) $privmsg_message)) . "')";

            if ( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql_info);
            }

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

            if (!empty($to_userdata['user_email']) && $to_userdata['user_active'] && $to_userdata['user_allow_mass_pm']>3 )
            {
                $email_headers = 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\r\n";
                $script_name = 'modules.php?name=Private_Messages';
                $server_name = trim((string) $board_config['server_name']);
                $server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
                $server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim((string) $board_config['server_port']) . '/' : '/';

                $emailer = new emailer($board_config['smtp_delivery']);

                $emailer->use_template('privmsg_notify', $to_userdata['user_lang']);
                $emailer->extra_headers($email_headers);
                $emailer->email_address($to_userdata['user_email']);
                $emailer->set_subject(); 

            $emailer->assign_vars([
                'USERNAME' => $to_userdata['username'],
                /*****[BEGIN]******************************************
                 [ Mod:     Extended PM Notification           v1.1.5 ]
                 ******************************************************/
                'SENDER_USERNAME' => htmlspecialchars((string) $userdata['username']),
                'PM_MESSAGE' => $privmsg_message,
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
                'U_INBOX' => $server_protocol . $server_name . $server_port . $script_name . '&folder=inbox&mode=read&p=' . $privmsg_sent_id . "&suppress=1",
            ]
/*****[END]********************************************
 [ Mod:     Direct Inbox Linking (Email)       v1.0.0 ]
 [ Mod:     Suppress Popup                     v1.0.0 ]
 ******************************************************/
                );
                
				if(!isset($n))
				$n = 0;
				
				$emailer->send();
                $emailer->reset();
                $n++;
            }
            $i++;
        }
        $template->assign_vars(['META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("privmsg.$phpEx?folder=inbox") . '">']
        );
        
		$msg = $lang['PM_delivered'] . '<br /><br />'.sprintf($lang['Mass_pm_count'],$i,$n).'<br />' . sprintf($lang['Click_return_inbox'], '<a 
		href="' . append_sid("privmsg.$phpEx?folder=inbox") . '">', '</a> ') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $msg);
    }
    else if ( $preview || $error )
    {
        //
        // If we're previewing then obtain the data
        // passed to the script, process it a little, do some checks
        // where neccessary, etc.
        //

        $to_username = ($PM_count)? sprintf($lang['Pm_mass_users'],$group_name,$PM_count): sprintf($lang['No_mass_pm_users'],$group_name);
        $privmsg_subject = ( isset($_POST['subject']) ) ? trim(strip_tags(stripslashes((string) $_POST['subject']))) : '';
        $privmsg_message = ( isset($_POST['message']) ) ? trim((string) $_POST['message']) : '';
        $privmsg_message = preg_replace('#<textarea>#si', '&lt;textarea&gt;', $privmsg_message);
        if ( !$preview )
        {
            $privmsg_message = stripslashes($privmsg_message);
        }

        //
        // Do mode specific things
        //
        if ( $mode == 'post' )
        {
            $page_title = $lang['Send_mass_pm'];
            $user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';

        }
    }
    //
    // Start output, first preview, then errors then post form
    //
    $page_title = $lang['Send_mass_pm'];
    include('includes/page_header.'.$phpEx);

    if ( $preview && !$error )
    {
        $orig_word = [];
        $replacement_word = [];
        obtain_word_list($orig_word, $replacement_word);

        if ( $bbcode_on )
        {
            $bbcode_uid = make_bbcode_uid();
        }

        $preview_message = stripslashes((string) prepare_message($privmsg_message, $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
        $privmsg_message = stripslashes(preg_replace($html_entities_match, $html_entities_replace, (string) $privmsg_message));

        //
        // Finalise processing as per viewtopic
        //
        if ( !$html_on )
        {
            if ( $user_sig != '' || !$userdata['user_allowhtml'] )
            {
                $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", (string) $user_sig);
            }
        }

        if ( $attach_sig && $user_sig != '' && $userdata['user_sig_bbcode_uid'] )
        {
            $user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
        }

        if ( $bbcode_on )
        {
            $preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
        }

        if ( $attach_sig && $user_sig != '' )
        {
            $preview_message = $preview_message . '<br /><br />_________________<br />' . $user_sig;
        }

        if ( count($orig_word) )
        {
            $preview_subject = preg_replace($orig_word, $replacement_word, (string) $privmsg_subject);
            $preview_message = preg_replace($orig_word, $replacement_word, (string) $preview_message);
        }
        else
        {
            $preview_subject = $privmsg_subject;
        }

        if ( $smilies_on )
        {
            $preview_message = smilies_pass($preview_message);
        }

        $preview_message = make_clickable($preview_message);
        $preview_message = str_replace("\n", '<br />', (string) $preview_message);
        $template->set_filenames(["preview" => 'privmsgs_preview.tpl']
        );

        $template->assign_vars(['TOPIC_TITLE' => $preview_subject, 
		                        'POST_SUBJECT' => $preview_subject, 
								'MESSAGE_TO' => $group_name.' ('. $PM_count.')', 
								'MESSAGE_FROM' => $userdata['username'], 
								'POST_DATE' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']), 
								'MESSAGE' => $preview_message, 
								'L_SUBJECT' => $lang['Subject'], 
								'L_DATE' => $lang['Date'], 
								'L_FROM' => $lang['From'], 
								'L_TO' => $lang['To_group'], 
								'L_PREVIEW' => $lang['Preview'], 
								'L_POSTED' => $lang['Posted']]
        );

        $template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
    }

    //
    // Start error handling
    //
    if ($error)
    {
        $template->set_filenames(['reg_header' => 'error_body.tpl']
        );
        $template->assign_vars(['ERROR_MESSAGE' => $error_msg]
        );
        $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
    }

    //
    // Load templates
    //
    $template->set_filenames(['body' => 'posting_body.tpl']
    );
    make_jumpbox('viewforum.'.$phpEx);

    //
    // Enable extensions in posting_body
    //
    $template->assign_block_vars('switch_groupmsg', []);

    //
    // HTML toggle selection
    //
    if ( $board_config['allow_html'] )
    {
        $html_status = $lang['HTML_is_ON'];
        $template->assign_block_vars('switch_html_checkbox', []);
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
        $template->assign_block_vars('switch_bbcode_checkbox', []);
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
        $template->assign_block_vars('switch_smilies_checkbox', []);
    }
    else
    {
        $smilies_status = $lang['Smilies_are_OFF'];
    }

    //
    // Signature toggle selection - only show if
    // the user has a signature
    //
    if ( $user_sig != '' )
    {
        $template->assign_block_vars('switch_signature_checkbox', []);
    }

    if ( $mode == 'post' )
    {
        $post_a = $lang['Send_mass_pm'];
    }

    $sql = "SELECT DISTINCT g.group_id, g.group_name
    FROM ".GROUPS_TABLE . " g, ".USER_GROUP_TABLE . " ug
    WHERE g.group_single_user <> 1
        AND (
                ('".$userdata['user_level']."'='".ADMIN."') OR
                (g.group_allow_pm='".AUTH_MOD."' AND g.group_moderator = '" . $userdata['user_id']."') OR
                (g.group_allow_pm='".AUTH_ACL."' AND ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ) OR
                (g.group_allow_pm='".AUTH_REG."' AND '".$userdata['user_id']."'!='".ANONYMOUS."' ) OR
                (g.group_allow_pm='".AUTH_ALL."')
        )" ;
    if( !$g_result = $db->sql_query($sql) )
    message_die(GENERAL_ERROR, "Could not select group names!", __LINE__, __FILE__, $sql);
    $group_list = $db->sql_fetchrowset($g_result);
    if( $userdata['user_level']!=ADMIN && empty($group_list)) message_die(GENERAL_ERROR, $lang['Mass_pm_not_allowed']);
    $groupname = $_REQUEST[POST_GROUPS_URL] = $_REQUEST[POST_GROUPS_URL] ?? '';
    $select_list = '<select name = "' . POST_GROUPS_URL . '">';
    $select_list .= ($userdata['user_level']==ADMIN) ? '<option value = "users" '. (($groupname=='users') ? ' SELECTED ' : '' ).'>' . $lang['All_users'] .'</option>':'';
    $select_list .= ($userdata['user_level']==ADMIN) ? '<option value = "admins" '. (($groupname=='admins') ? ' SELECTED ' : '' ).'>' . $lang['All_admins'] .'</option>':'';
    $select_list .= ($userdata['user_level']==ADMIN) ? '<option value = "moderators" '. (($groupname=='moderators') ? ' SELECTED ' : '' ).'>' . $lang['All_mods'] .'</option>':'';
    for($i = 0;$i < (is_countable($group_list) ? count($group_list) : 0); $i++)
    {
        $select_list .= '<option value = "' . $group_list[$i]['group_id'].'"'. (($group_list[$i]['group_id']==$groupname) ? ' SELECTED ' : '').'>'.$group_list[$i]['group_name'] .'</option>';
    }
    $select_list .= "</select>";

    //
    // Send smilies to template
    //
    generate_smilies('inline', PAGE_PRIVMSGS);

    $template->assign_vars(['SUBJECT' => preg_replace($html_entities_match, $html_entities_replace, (string) $privmsg_subject = $privmsg_subject ?? ''), 
	                        'USERNAME' => $select_list, 
							'MESSAGE' => $privmsg_message = $privmsg_message ?? '', 
							'BB_BOX' => Make_TextArea_Ret('message', $message = $message ?? '', 'post', '99.8%', '200px', true), 
							'HTML_STATUS' => $html_status, 
							'SMILIES_STATUS' => $smilies_status, 
							'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'), 
							'FORUM_NAME' => $lang['Private_message'] = $lang['Private_message'] ?? 'Private Message', 
							'L_SUBJECT' => $lang['Subject'] = $lang['Subject'] ?? 'Subject', 
							'L_MESSAGE_BODY' => $lang['Message_body'], 
							'L_OPTIONS' => $lang['Options'], 
							'L_SPELLCHECK' => $lang['Spellcheck'], 
							'L_PREVIEW' => $lang['Preview'], 
							'L_SUBMIT' => $lang['Submit'], 
							'L_CANCEL' => $lang['Cancel'], 
							'L_POST_A' => $post_a, 
							'L_DISABLE_HTML' => $lang['Disable_HTML_pm'], 
							'L_DISABLE_BBCODE' => $lang['Disable_BBCode_pm'], 
							'L_DISABLE_SMILIES' => $lang['Disable_Smilies_pm'], 
							'L_ATTACH_SIGNATURE' => $lang['Attach_signature'], 
							'L_BBCODE_B_HELP' => $lang['bbcode_b_help'] = $lang['bbcode_b_help'] ?? '', 
							'L_BBCODE_I_HELP' => $lang['bbcode_i_help'] = $lang['bbcode_i_help'] ?? '', 
							'L_BBCODE_U_HELP' => $lang['bbcode_u_help'] = $lang['bbcode_u_help'] ?? '', 
							'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'] = $lang['bbcode_q_help'] ?? '', 
							'L_BBCODE_C_HELP' => $lang['bbcode_c_help'] = $lang['bbcode_c_help'] ?? '', 
							'L_BBCODE_L_HELP' => $lang['bbcode_l_help'] = $lang['bbcode_l_help'] ?? '', 
							'L_BBCODE_O_HELP' => $lang['bbcode_o_help'] = $lang['bbcode_o_help'] ?? '', 
							'L_BBCODE_P_HELP' => $lang['bbcode_p_help'] = $lang['bbcode_p_help'] ?? '', 
							'L_BBCODE_W_HELP' => $lang['bbcode_w_help'] = $lang['bbcode_w_help'] ?? '', 
							'L_BBCODE_A_HELP' => $lang['bbcode_a_help'] = $lang['bbcode_a_help'] ?? '', 
							'L_BBCODE_S_HELP' => $lang['bbcode_s_help'] = $lang['bbcode_s_help'] ?? '', 
							'L_BBCODE_F_HELP' => $lang['bbcode_f_help'] = $lang['bbcode_f_help'] ?? '', 
							'L_EMPTY_MESSAGE' => $lang['Empty_message'] = $lang['Empty_message'] ?? '', 
							'L_FONT_COLOR' => $lang['Font_color'] = $lang['Font_color'] ?? '', 
							'L_COLOR_DEFAULT' => $lang['color_default'] = $lang['color_default'] ?? '', 
							'L_COLOR_DARK_RED' => $lang['color_dark_red'] = $lang['color_dark_red'] ?? '', 
							'L_COLOR_RED' => $lang['color_red'] = $lang['color_red'] ?? '', 
							'L_COLOR_ORANGE' => $lang['color_orange'] = $lang['color_orange'] ?? '', 
							'L_COLOR_BROWN' => $lang['color_brown'] = $lang['color_brown'] ?? '', 
							'L_COLOR_YELLOW' => $lang['color_yellow'] = $lang['color_yellow'] ?? '', 
							'L_COLOR_GREEN' => $lang['color_green'] = $lang['color_green'] ?? '', 
							'L_COLOR_OLIVE' => $lang['color_olive'] = $lang['color_olive'] ?? '', 
							'L_COLOR_CYAN' => $lang['color_cyan'] = $lang['color_cyan'] ?? '', 
							'L_COLOR_BLUE' => $lang['color_blue'] = $lang['color_blue'] ?? '', 
							'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'] = $lang['color_dark_blue'] ?? '', 
							'L_COLOR_INDIGO' => $lang['color_indigo'] = $lang['color_indigo'] ?? '', 
							'L_COLOR_VIOLET' => $lang['color_violet'] = $lang['color_violet'] ?? '', 
							'L_COLOR_WHITE' => $lang['color_white'] = $lang['color_white'] ?? '', 
							'L_COLOR_BLACK' => $lang['color_black'] = $lang['color_black'] ?? '', 
							'L_FONT_SIZE' => $lang['Font_size'] = $lang['Font_size'] ?? '', 
							'L_FONT_TINY' => $lang['font_tiny'] = $lang['font_tiny'] ?? '', 
							'L_FONT_SMALL' => $lang['font_small'] = $lang['font_small'] ?? '', 
							'L_FONT_NORMAL' => $lang['font_normal'] = $lang['font_normal'] ?? '', 
							'L_FONT_LARGE' => $lang['font_large'] = $lang['font_large'] ?? '', 
							'L_FONT_HUGE' => $lang['font_huge'] = $lang['font_huge'] ?? '', 
							'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'], 
							'L_STYLES_TIP' => $lang['Styles_tip'], 
							'S_HTML_CHECKED' => ( !$html_on ) ? ' checked="checked"' : '', 
							'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? ' checked="checked"' : '', 
							'S_SMILIES_CHECKED' => ( !$smilies_on ) ? ' checked="checked"' : '', 
							'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? ' checked="checked"' : '', 
							'S_NAMES_SELECT' => $user_names_select = $user_names_select ?? '', 
							'S_HIDDEN_FORM_FIELDS' => $s_hidden_fields = $s_hidden_fields ?? '', 
							'S_POST_ACTION' => append_sid("groupmsg.$phpEx"), 
							'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser"), 
							'U_VIEW_FORUM' => append_sid("privmsg.$phpEx")]
    );

    $template->pparse('body');

    include('includes/page_tail.'.$phpEx);
//
// Default page
//

//
// Generate page
//
$page_title = $lang['Private_Messaging'];

include('includes/page_header.'.$phpEx);

//
// Load templates
//
$template->set_filenames(['body' => 'privmsgs_body.tpl']
);
make_jumpbox('viewforum.'.$phpEx);

//
// Dump vars to template
//
$template->assign_vars(['L_SUBJECT' => $lang['Subject'], 
                        'L_DATE' => $lang['Date'], 
						'L_DISPLAY_MESSAGES' => $lang['Display_messages'], 
						'L_FROM_OR_TO' => $lang['To_group'], 
						'S_PRIVMSGS_ACTION' => append_sid("groupmsg.$phpEx?folder=$folder")]
);
$template->pparse('body');

include('includes/page_tail.'.$phpEx);
include(NUKE_BASE_DIR.'footer.php');


