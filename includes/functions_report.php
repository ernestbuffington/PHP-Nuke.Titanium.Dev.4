<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            functions_report.php
 *                            --------------------
 *   begin                : Sunday, Jun 19, 2005
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: functions_report.php,v 1.2.3.2 2005/08/17 14:18:00 chatasos Exp $
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
-=[Mod]=-
      Advanced Username Color                  v1.0.5       08/30/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

//define('REPORT_POST_NEW', 1);
//define('REPORT_POST_CLOSED', 2);

function insert_report($post_id, $comments)
{
    global $db, $userdata;

    $sql = "INSERT INTO " . POST_REPORTS_TABLE . " (post_id, reporter_id, report_time, report_status, report_comments)
        VALUES ($post_id, " . $userdata['user_id'] . ", " . time() . ", " . REPORT_POST_NEW . ", '" . str_replace("\'", "''", $comments) . "')";
    if ( !$db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, 'Could not insert report', '', __LINE__, __FILE__, $sql);
    }

    return;
}

function email_report($forum_id, $post_id, $topic_title, $comments)
{
    global $db, $phpEx, $userdata, $board_config, $lang;

    //
    // Obtain list of moderators of each forum
    // First users, then groups ... broken into two queries
    //
    $sql = "SELECT u.user_email
        FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
        WHERE aa.forum_id = $forum_id
            AND aa.auth_mod = " . TRUE . "
            AND g.group_single_user = 1
            AND ug.group_id = aa.group_id
            AND g.group_id = aa.group_id
            AND u.user_id = ug.user_id
            AND u.user_report_optout = 0
        GROUP BY u.user_id, u.username
        ORDER BY u.user_id";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
    }

    $moderators = array();
    while( $row = $db->sql_fetchrow($result) )
    {
        $moderators[] = $row['user_email'];
    }

    $sql = "SELECT g.group_id
        FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
        WHERE aa.forum_id = $forum_id
            AND aa.auth_mod = " . TRUE . "
            AND g.group_single_user = 0
            AND g.group_type <> ". GROUP_HIDDEN ."
            AND ug.group_id = aa.group_id
            AND g.group_id = aa.group_id
        GROUP BY g.group_id, g.group_name
        ORDER BY g.group_id";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not query forum group moderator information', '', __LINE__, __FILE__, $sql);
    }

    $groups = array();
    while( $row = $db->sql_fetchrow($result) )
    {
        $groups[] = $row['group_id'];
    }

    if ( count($groups) )
    {
        $sql = "SELECT u.user_email
            FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
            WHERE ug.group_id = g.group_id
                AND g.group_single_user = 0
                AND g.group_id IN (" . implode(',', $groups) . ")
                AND ug.user_id = u.user_id
                AND u.user_report_optout = 0";
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
        }

        while( $row = $db->sql_fetchrow($result) )
        {
            if ( !in_array($row['user_email'], $moderators) )
            {
                $moderators[] = $row['user_email'];
            }
        }
    }

    // get admins and email them
    $sql = "SELECT user_email FROM " . USERS_TABLE . "
        WHERE user_level = " . ADMIN . "
        AND user_report_optout = 0";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not query forum admin information', '', __LINE__, __FILE__, $sql);
    }

    while( $row = $db->sql_fetchrow($result) )
    {
        if ( !in_array($row['user_email'], $moderators) )
        {
                $moderators[] = $row['user_email'];
        }
    }

    // include('includes/emailer.'.$phpEx);

    // $emailer = new emailer($board_config['smtp_delivery']);

    // $emailer->from($board_config['board_email']);
    // $emailer->replyto($board_config['board_email']);

    // foreach($moderators as $email)
    // {
    //     $emailer->bcc($email);
    // }

    // $emailer->use_template('report_post');
    // $emailer->email_address($board_config['board_email']);
    // $emailer->set_subject($lang['Report_post'] . ' - ' . $topic_title);

    // $email_headers = 'X-AntiAbuse: Board servername - ' . $board_config['server_name'] . "\n";
    // $email_headers .= 'X-AntiAbuse: User_id - ' . $userdata['user_id'] . "\n";
    // $email_headers .= 'X-AntiAbuse: Username - ' . $userdata['username'] . "\n";
    // $email_headers .= 'X-AntiAbuse: User IP - ' . decode_ip($user_ip) . "\n";
    // $emailer->extra_headers($email_headers);

    $script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
    $script_name = ( $script_name != '' ) ? 'modules.php?name=Forums&file=viewtopic&' : 'modules.php?name=Forums&file=viewtopic&';
    $server_name = trim($board_config['server_name']);
    $server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
    $server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

    // $server_url = $server_protocol . $server_name . $server_port . $script_name;
    // $report_url = $server_protocol . $server_name . $server_port . 'modules.php?name=Forums&file=viewpost_reports';

    // $emailer->assign_vars(array(
    //     'SITENAME'        => $board_config['sitename'],
    //     'USERNAME'        => $userdata['username'],
    //     'POST_ID'        => $post_id,
    //     'TOPIC_TITLE'    => $topic_title,
    //     'COMMENTS'        => $comments,
    //     'EMAIL_SIG'        => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
    //     'REPORT_URL'    => urldecode($report_url),

    //     'U_VIEW_POST'    => urldecode($server_url . POST_POST_URL . '=' . $post_id . '#' . $post_id))
    // );
    // $emailer->send();
    // $emailer->reset();

    $server_url = $server_protocol . $server_name . $server_port . $script_name;
    $report_url = $server_protocol . $server_name . $server_port . 'modules.php?name=Forums&file=viewpost_reports';

    $content = str_replace( '{SITENAME}', $board_config['sitename'], $lang['report_post_template'] );
    $content = str_replace( '{USERNAME}', $userdata['username'], $content );
    $content = str_replace( '{POST_ID}', $post_id, $content );
    $content = str_replace( '{TOPIC_TITLE}', $topic_title, $content );
    $content = str_replace( '{COMMENTS}', $comments, $content );
    $content = str_replace( '{EMAIL_SIG}', ((!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : ''), $content );
    $content = str_replace( '{REPORT_URL}', '<a href="'.$report_url.'">'.$report_url.'</a>', $content );
    $content = str_replace( '{U_VIEW_POST}', '<a href="'.$server_url . POST_POST_URL . '=' . $post_id . '#' . $post_id.'">'.$server_url . POST_POST_URL . '=' . $post_id . '#' . $post_id.'</a>', $content );

    // $headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: '.$board_config['board_email'], 'Reply-To: '.$board_config['board_email'], 'Return-Path: '.$board_config['board_email'] );

    $subject = $lang['Report_post'] . ' - ' . $topic_title;

    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: '.$board_config['board_email'];
    $headers[] = 'Reply-To: '.$board_config['board_email'];
    $headers[] = 'Return-Path: '.$board_config['board_email'];  

    $headers[] = 'X-AntiAbuse: Board servername - ' . $board_config['server_name'] . "\n";
    $headers[] = 'X-AntiAbuse: User_id - ' . $userdata['user_id'] . "\n";
    $headers[] = 'X-AntiAbuse: Username - ' . $userdata['username'] . "\n";
    $headers[] = 'X-AntiAbuse: User IP - ' . decode_ip($user_ip) . "\n";

    foreach($moderators as $email)
    {
        $headers[] = 'Bcc: '.$email;
        // $addbcc[] = $bcc_list[$i]; 
    }

    phpmailer( $board_config['board_email'], $subject, $content, $headers );

    return;
}

function show_reports($status = REPORT_POST_NEW)
{
    global $db, $board_config, $template, $lang, $phpEx, $userdata;

    // find the forums where the user is a moderator
    $forum_ids = array();
    $forum_ids = get_forums_auth_mod();

    if ( empty($forum_ids) )
    {
        return;
    }
    else
    {
        $where_sql2 = ' AND p.forum_id IN (' . implode(',', $forum_ids) . ')';
    }

    $where_sql = ( $status == 'all') ? '' : ' AND pr.report_status = ' . intval($status);

    // get the reports from the user's moderated forums

    $sql = "SELECT pr.*, u.username, t.topic_title, f.forum_id, f.forum_name
        FROM " . POST_REPORTS_TABLE . " pr, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f
        WHERE u.user_id = pr.reporter_id
            AND pr.post_id = p.post_id
            AND p.topic_id = t.topic_id
            AND t.forum_id = f.forum_id
            $where_sql
            $where_sql2
        ORDER BY report_time DESC";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not query reports', '', __LINE__, __FILE__, $sql);
    }

    $i = 0;

    while( $row = $db->sql_fetchrow($result) )
    {

        $comments_temp = array();
        $comments_temp = create_comments($row);

        $last_action             = $comments_temp['last_action'];
        $comments                 = $comments_temp['comments'];
        $last_action_comments    = $comments_temp['last_action_comments'];

        $row_class = ( !($i % 2) ) ? 'row1' : 'row2';

        $template->assign_block_vars('postrow', array(
            'ROW_CLASS'            => $row_class,

            'REPORT_ID'            => $row['report_id'],
            'TOPIC_TITLE'        => $row['topic_title'],
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            'REPORTER'            => '<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['reporter_id'] . '">' . UsernameColor($row['username']) . '</a>',
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            'COMMENTS'            => $comments,
            'DATE'                => create_date($board_config['default_dateformat'], $row['report_time'], $board_config['board_timezone']),
            'FORUM'                => $row['forum_name'],

            'LAST_ACTION'                => $last_action,
            'LAST_ACTION_COMMENTS'  => $last_action_comments,

            'L_CLOSE_REPORT'    => ( $row['report_status'] == REPORT_POST_NEW ) ? $lang['Close'] : $lang['Open'],

            'U_VIEW_POST'        => append_sid('viewtopic.' . $phpEx . '?' . POST_POST_URL . '=' . $row['post_id'] . '#' . $row['post_id']),
            'U_CLOSE_REPORT'    => ( $row['report_status'] == REPORT_POST_NEW ) ? append_sid('viewpost_reports.' . $phpEx . '?mode=closereport&amp;report=' . $row['report_id']) : append_sid('viewpost_reports.' . $phpEx . '?mode=openreport&amp;report=' . $row['report_id']))
        );

        $i++;
    }

    //
    // do a little bit of cleanup
    //

    // find how many reports with non-existent posts will be deleted
    $delete_ids = array();
    $delete_ids = get_reports_with_no_posts();

    if ( !empty($delete_ids) )
    {
        // delete the specific reports
        $sql = "DELETE FROM " . POST_REPORTS_TABLE . "
            WHERE report_id IN (" . implode(',', $delete_ids) . ")";

        if ( !$db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not delete reports', '', __LINE__, __FILE__, $sql);
        }
        $deleted_reports = sprintf($lang['Non_existent_posts'], count($delete_ids));
    }
    else
    {
        $deleted_reports = '&nbsp;';
    }

    $template->assign_vars(array(
        'DELETED_REPORTS'    => $deleted_reports)
    );

    return;
}

function report_flood()
{
    global $db, $board_config, $userdata;

    $sql = "SELECT MAX(report_time) AS latest_time FROM " . POST_REPORTS_TABLE . "
        WHERE reporter_id = " . $userdata['user_id'];
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get most recent report', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);

    $current_time = time();
    if ( ($current_time - $row['latest_time']) < $board_config['flood_interval'] )
    {
        return false;
    }
    else
    {
        return true;
    }
}

// get the number of open/closed reports
function reports_count($status = REPORT_POST_NEW)
{
    global $db;

    $forum_ids = array();
    $forum_ids = get_forums_auth_mod();

    // if the user is not a moderator return 0
    // normally this shouldn't happen since we are checking it while calling the function
    if ( empty($forum_ids) )
    {
        return 0;
    }
    else
    {
        $where_sql = ' AND p.forum_id IN (' . implode(',', $forum_ids) . ')';
    }

    // get the number of open reports for all the forums the user is a moderator
    $sql = "SELECT COUNT(pr.report_id) as total
        FROM " . POST_REPORTS_TABLE . " pr, " . POSTS_TABLE . " p
        WHERE pr.report_status = " . intval($status) . "
            AND pr.post_id = p.post_id
            " . $where_sql;

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get reports count', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return ( $row['total'] ) ? $row['total'] : 0;
}

// check if a post has already been reported
function report_exists($post_id)
{
    global $db;

    // maybe we have to check if the report is closed too in order to reopen it after the 2nd report
    $sql = "SELECT report_id FROM " . POST_REPORTS_TABLE . "
        WHERE post_id = $post_id
        AND report_status = " . REPORT_POST_NEW;

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get report', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);

    return ( $row ) ? TRUE : FALSE;
}

// get the already stored report comments
function get_report_comments($report_id)
{
    global $db;

    $sql = "SELECT last_action_comments FROM " . POST_REPORTS_TABLE . "
        WHERE report_id = " . $report_id;

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get report comments', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);

    return ( $row['last_action_comments'] && $row['last_action_comments'] != '' ) ? $row['last_action_comments'] : '';
}

// get the forums where the user is a moderator
function get_forums_auth_mod()
{
    global $userdata;

    $auth = auth(AUTH_MOD, AUTH_LIST_ALL, $userdata);

    // create an array to store the moderated forums
    $forums_auth = array();

    //while ( list($forum) = each($auth) )
	foreach (array_keys($auth) as $forum)
    {
        if ( $auth[$forum]['auth_mod'] )
        {
            $forums_auth[] = $forum;
        }
    }

    return $forums_auth;
}

// create the comments from the reports
function create_comments($row)
{
    global $db, $board_config, $lang, $phpEx;

        // find if we have a last action user_id and last action time
        if ( $row['last_action_user_id'] != 0 && $row['last_action_time'] != 0 )
        {
            $sql2 = "SELECT username FROM " . USERS_TABLE . "
                WHERE user_id = " . $row['last_action_user_id'];

            if ( !($result2 = $db->sql_query($sql2)) )
            {
                message_die(GENERAL_ERROR, 'Could not get last action user id information', '', __LINE__, __FILE__, $sql2);
            }

            $row2 = $db->sql_fetchrow($result2);

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $last_action_user = '<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['last_action_user_id'] . '">' . UsernameColor($row2['username']) . '</a>';
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $last_action_date = create_date($board_config['default_dateformat'], $row['last_action_time'], $board_config['board_timezone']);

            if ( $row['report_status'] == REPORT_POST_NEW )
            {
                $last_action = sprintf($lang['Opened_by_user_on_date'], $last_action_user, $last_action_date);
            }
            else
            {
                $last_action = sprintf($lang['Closed_by_user_on_date'], $last_action_user, $last_action_date);
            }

            $last_action_comments = $row['last_action_comments'];
        }
        else
        {
            $last_action = ( $row['report_status'] == REPORT_POST_NEW ) ? $lang['Opened'] : $lang['Closed'];
            $last_action_comments = '';
        }

         // replace "\n" with "\n<br />\n" for correct html output on browser
        $comments = str_replace("\n", "\n<br />\n", $row['report_comments']);
        $last_action_comments = str_replace("\n", "\n<br />\n", $last_action_comments);

        $comments_temp = array('last_action' => $last_action,
                                    'comments' => $comments,
                                    'last_action_comments' => $last_action_comments
                                    );

        return $comments_temp;
}

// find which reports have their posts non-existent
function get_reports_with_no_posts()
{
    global $db;

    $sql = "SELECT pr.post_id FROM " . POST_REPORTS_TABLE . ' pr, ' . POSTS_TABLE . " p
        WHERE pr.post_id = p.post_id";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not query reports', '', __LINE__, __FILE__, $sql);
    }

    // create an array with all the common post_ids of the reports and posts table
    $common_post_ids = array();
    while( $row = $db->sql_fetchrow($result) )
    {
        $common_post_ids[] = $row['post_id'];
    }

    // get all the post_ids from the reports table
    $sql = "SELECT report_id, post_id
        FROM " . POST_REPORTS_TABLE ;

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not query reports', '', __LINE__, __FILE__, $sql);
    }

    // find which reports exist in the reports table but do not exist in the posts table
    $delete_ids = array();
    while( $row = $db->sql_fetchrow($result) )
    {
        if ( !in_array($row['post_id'], $common_post_ids) )
        {
            $delete_ids[] = $row['report_id'];
        }
    }

    return $delete_ids;
}

?>