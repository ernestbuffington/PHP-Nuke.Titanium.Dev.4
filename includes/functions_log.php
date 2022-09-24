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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

function log_action($action, $new_topic_id, $topic_id, $titanium_user_id, $phpbb2_forum_id, $new_forum_id)
{
    global $titanium_db;
    if (!isset($titanium_user_id) || empty($titanium_user_id)) {
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

    if ( $phpbb2_forum_id ):
        $phpbb2_forum_id = $phpbb2_forum_id;
    else:
        $phpbb2_forum_id = 0;
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
    $phpbb2_last_post_id = 0;

    $sql = "SELECT topic_last_post_id FROM ". TOPICS_TABLE ." $where";
    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get topic_last_post_id', '', __LINE__, __FILE__, $sql);
    }
    $row = $titanium_db->sql_fetchrow($result);
    if ( $row['topic_last_post_id'] )
    	$phpbb2_last_post_id = $row['topic_last_post_id'];
    $titanium_db->sql_freeresult($result);

    // else:
    //     $phpbb2_last_post_id = 0;
    // endif;


    $sql = "SELECT session_ip
        FROM " . SESSIONS_TABLE . "
        WHERE session_user_id = $titanium_user_id ";

    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not select session_ip', '', __LINE__, __FILE__, $sql);
    }
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    $titanium_user_ip = $row['session_ip'];

    $sql = "SELECT username
        FROM " . USERS_TABLE . "
        WHERE user_id = $titanium_user_id ";

    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not select username', '', __LINE__, __FILE__, $sql);
    }
    $row2 = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    $titanium_username = $row2['username'];
    $titanium_username = addslashes($titanium_username);

    $time = time();

    $sql = "INSERT INTO " . LOGS_TABLE . " (mode, topic_id, user_id, username, user_ip, time, new_topic_id, forum_id, new_forum_id, last_post_id)
        VALUES ('$action', '$topic_id', '$titanium_user_id', '$titanium_username', '$titanium_user_ip', '$time', '$new_topic_id', '$phpbb2_forum_id', '$new_forum_id', '$phpbb2_last_post_id')";

    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not insert data into logs table', '', __LINE__, __FILE__, $sql);
    }
    $titanium_db->sql_freeresult($result);
}

function prune_logs($prune_days)
{
    global $titanium_db;

    $prune = time() - ( $prune_days * 86400 );

    $sql = "SELECT log_id
        FROM " . LOGS_TABLE . "
        WHERE time < $prune ";

    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not obtain list of logs to prune', '', __LINE__, __FILE__, $sql);
    }

    $logs = '';
    while ( $row = $titanium_db->sql_fetchrow($result) )
    {
        $logs .= ( ( $logs != '' ) ? ', ' : '' ) . $row['log_id'];
    }
    $titanium_db->sql_freeresult($result);

    if ( $logs != '' )
    {
        $sql = "DELETE FROM " . LOGS_TABLE . "
            WHERE log_id IN ($logs)";

        if ( !$titanium_db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not delete logs', '', __LINE__, __FILE__, $sql);
        }

        return TRUE;
    }
}

function auto_prune_logs()
{
    global $titanium_db;

    // To do
}

?>