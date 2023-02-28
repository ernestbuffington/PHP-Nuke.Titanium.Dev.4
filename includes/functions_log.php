<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                        functions_log.php
 *                       -------------------
 *     begin                : Jan 24 2003
 *     copyright            : Morpheus
 *     email                : morpheus@2037.biz
 *
 *     $Id: function_log.php,v 1.85.2.9 2003/01/24 18:31:54 Moprheus Exp $
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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

function log_action($action, $new_topic_id, $topic_id, $user_id, $forum_id, $new_forum_id)
{
    global $db;
    if (!isset($user_id) || empty($user_id)) {
        return;
    }

    # added in 3.0.0
    if ( $topic_id ):
        $topic_id = $topic_id;
    else:
        $topic_id = 0;
    endif;

    if ( $new_topic_id ):
        $new_topic_id = $new_topic_id;
    else:
        $new_topic_id = 0;
    endif;

    if ( $forum_id ):
        $forum_id = $forum_id;
    else:
        $forum_id = 0;
    endif;

    if ( $new_forum_id ):
        $new_forum_id = $new_forum_id;
    else:
        $new_forum_id = 0;
    endif;

    # added in 3.0.0

    if ( $action == 'split' )
    {
        $where = "WHERE topic_id = '$new_topic_id'";
    }
    else
    {
        $where = "WHERE topic_id = '$topic_id'";
    }

    // if ( $topic_id || $new_topic_id ):
    $last_post_id = 0;

    $sql = "SELECT topic_last_post_id FROM ". TOPICS_TABLE ." $where";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get topic_last_post_id', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    if (isset($row['topic_last_post_id']))
    	$last_post_id = $row['topic_last_post_id'];
    $db->sql_freeresult($result);

    // else:
    //     $last_post_id = 0;
    // endif;


    $sql = "SELECT session_ip
        FROM " . SESSIONS_TABLE . "
        WHERE session_user_id = $user_id ";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not select session_ip', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $user_ip = $row['session_ip'];

    $sql = "SELECT username
        FROM " . USERS_TABLE . "
        WHERE user_id = $user_id ";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not select username', '', __LINE__, __FILE__, $sql);
    }
    $row2 = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $username = $row2['username'];
    $username = addslashes($username);

    $time = time();

    $sql = "INSERT INTO " . LOGS_TABLE . " (mode, topic_id, user_id, username, user_ip, time, new_topic_id, forum_id, new_forum_id, last_post_id)
        VALUES ('$action', '$topic_id', '$user_id', '$username', '$user_ip', '$time', '$new_topic_id', '$forum_id', '$new_forum_id', '$last_post_id')";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not insert data into logs table', '', __LINE__, __FILE__, $sql);
    }
    $db->sql_freeresult($result);
}

function prune_logs($prune_days)
{
    global $db;

    $prune = time() - ( $prune_days * 86400 );

    $sql = "SELECT log_id
        FROM " . LOGS_TABLE . "
        WHERE time < $prune ";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not obtain list of logs to prune', '', __LINE__, __FILE__, $sql);
    }

    $logs = '';
    while ( $row = $db->sql_fetchrow($result) )
    {
        $logs .= ( ( $logs != '' ) ? ', ' : '' ) . $row['log_id'];
    }
    $db->sql_freeresult($result);

    if ( $logs != '' )
    {
        $sql = "DELETE FROM " . LOGS_TABLE . "
            WHERE log_id IN ($logs)";

        if ( !$db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not delete logs', '', __LINE__, __FILE__, $sql);
        }

        return TRUE;
    }
}

function auto_prune_logs()
{
    global $db;

    // To do
}

?>