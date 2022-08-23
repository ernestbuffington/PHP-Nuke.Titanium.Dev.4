<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                                 prune.php
*                            -------------------
*   begin                : Thursday, June 14, 2001
*   copyright            : (C) 2001 The phpBB Group
*   email                : support@phpbb.com
*
*   Id: prune.php,v 1.19.2.6 2003/03/18 23:23:57 acydburn Exp
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
-=[Mod]=-
      Attachment Mod                           v2.4.1       06/10/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

if (defined('FORUM_ADMIN')) {
    require("../../../includes/functions_search.php");
} else {
    require("includes/functions_search.php");
}

function prune($forum_id, $prune_date, $prune_all = false)
{
        global $db, $lang;
        
     	// Before pruning, lets try to clean up the invalid topic entries
     	$sql = 'SELECT topic_id FROM ' . TOPICS_TABLE . '
     		WHERE topic_last_post_id = 0';
     	if ( !($result = $db->sql_query($sql)) )
     	{
     		message_die(GENERAL_ERROR, 'Could not obtain lists of topics to sync', '', __LINE__, __FILE__, $sql);
     	}
     
     	while( $row = $db->sql_fetchrow($result) )
     	{
     		sync('topic', $row['topic_id']);
     	}
 
 	    $db->sql_freeresult($result);
 	    
        $prune_all = ($prune_all) ? '' : 'AND t.topic_vote = 0 AND t.topic_type <> ' . POST_ANNOUNCE;
        //
        // Those without polls and announcements ... unless told otherwise!
        //
        $sql = "SELECT t.topic_id
                FROM (" . POSTS_TABLE . " p, " . TOPICS_TABLE . " t)
                WHERE t.forum_id = '$forum_id'
                        $prune_all
                        AND p.post_id = t.topic_last_post_id";
        
        if ( $prune_date != '' )
        {
                $sql .= " AND p.post_time < '$prune_date'";
        }

        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not obtain lists of topics to prune', '', __LINE__, __FILE__, $sql);
        }

        $sql_topics = '';
        while( $row = $db->sql_fetchrow($result) )
        {
                $sql_topics .= ( ( $sql_topics != '' ) ? ', ' : '' ) . $row['topic_id'];
        }
        $db->sql_freeresult($result);

        if( $sql_topics != '' )
        {
                $sql = "SELECT post_id
                        FROM " . POSTS_TABLE . "
                        WHERE forum_id = '$forum_id'
                                AND topic_id IN ($sql_topics)";
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain list of posts to prune', '', __LINE__, __FILE__, $sql);
                }

                $sql_post = '';
                while ( $row = $db->sql_fetchrow($result) )
                {
                        $sql_post .= ( ( $sql_post != '' ) ? ', ' : '' ) . $row['post_id'];
                }
                $db->sql_freeresult($result);

                if ( $sql_post != '' )
                {
                        $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
                                WHERE topic_id IN ($sql_topics)";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete watched topics during prune', '', __LINE__, __FILE__, $sql);
                        }

                        $sql = "DELETE FROM " . TOPICS_TABLE . "
                                WHERE topic_id IN ($sql_topics)";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete topics during prune', '', __LINE__, __FILE__, $sql);
                        }

                        $pruned_topics = $db->sql_affectedrows();

                        $sql = "DELETE FROM " . POSTS_TABLE . "
                                WHERE post_id IN ($sql_post)";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete post_text during prune', '', __LINE__, __FILE__, $sql);
                        }

                        $pruned_posts = $db->sql_affectedrows();

                        $sql = "DELETE FROM " . POSTS_TEXT_TABLE . "
                                WHERE post_id IN ($sql_post)";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete post during prune', '', __LINE__, __FILE__, $sql);
                        }

                        remove_search_post($sql_post);

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                        prune_attachments($sql_post);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

                        return array ('topics' => $pruned_topics, 'posts' => $pruned_posts);
                }
        }

        return array('topics' => 0, 'posts' => 0);
}

//
// Function auto_prune(), this function will read the configuration data from
// the auto_prune table and call the prune function with the necessary info.
//
function auto_prune($forum_id = 0)
{
        global $db, $lang;

        $sql = "SELECT *
                FROM " . PRUNE_TABLE . "
                WHERE forum_id = '$forum_id'";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not read auto_prune table', '', __LINE__, __FILE__, $sql);
        }

        if ( $row = $db->sql_fetchrow($result) )
        {
                if ( $row['prune_freq'] && $row['prune_days'] )
                {
                        $prune_date = time() - ( $row['prune_days'] * 86400 );
                        $next_prune = time() + ( $row['prune_freq'] * 86400 );

                        prune($forum_id, $prune_date);
                        sync('forum', $forum_id);

                        $sql = "UPDATE " . FORUMS_TABLE . "
                                SET prune_next = '$next_prune'
                                WHERE forum_id = '$forum_id'";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update forum table', '', __LINE__, __FILE__, $sql);
                        }
                }
        }

        return;
}

?>