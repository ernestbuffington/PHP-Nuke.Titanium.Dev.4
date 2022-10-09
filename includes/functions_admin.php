<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            functions_admin.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: functions_admin.php,v 1.5.2.3 2002/07/19 17:03:47 psotfx Exp
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
**************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
 ************************************************************************/

//
// Simple version of jumpbox, just lists authed forums
//

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

function make_forum_select($box_name, $ignore_forum = false, $select_forum = '')
{
        global $db, $userdata, $lang;

        $is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

        $sql = 'SELECT f.forum_id, f.forum_name, f.forum_parent
            FROM ' . CATEGORIES_TABLE . ' c, ' . FORUMS_TABLE . ' f
            WHERE f.cat_id = c.cat_id
        ORDER BY c.cat_order, f.forum_order';
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Couldn not obtain forums information', '', __LINE__, __FILE__, $sql);
        }

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
	//$forum_list = '';
	$list = array();
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
        while( $row = $db->sql_fetchrow($result) )
        {
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
		$list[] = $row;
	}
	$forum_list = '';
	for( $i = 0; $i < count($list); $i++ )
	{
		if( !$list[$i]['forum_parent'] )
		{
			$row = $list[$i];
			$parent_hidden = true;
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                if ( $is_auth_ary[$row['forum_id']]['auth_read'] && $ignore_forum != $row['forum_id'] )
                {
                        $selected = ( $select_forum == $row['forum_id'] ) ? ' selected="selected"' : '';
                        $forum_list .= '<option value="' . $row['forum_id'] . '"' . $selected .'>' . $row['forum_name'] . '</option>';
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
				$parent_hidden = false;
			}
			if ( $is_auth_ary[$row['forum_id']]['auth_read'] )
			{
				$parent_id = $row['forum_id'];
				for($j=0; $j<count($list); $j++)
				{
					$row = $list[$j];
					if( $row['forum_parent'] == $parent_id && $is_auth_ary[$row['forum_id']]['auth_read'] && $ignore_forum != $row['forum_id'] )
					{
						if( $parent_hidden )
						{
							$forum_list .= '<option value="" disabled="disabled">' . $list[$i]['forum_name'] . '</option>';
							$parent_hidden = false;
						}
						$selected = ( $select_forum == $row['forum_id'] ) ? ' selected="selected"' : '';
						$forum_list .= '<option value="' . $row['forum_id'] . '"' . $selected .'>-- ' . $row['forum_name'] . '</option>';
					}
				}			
			}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                }
        }
        $db->sql_freeresult($result);

        $forum_list = ( $forum_list == '' ) ? $lang['No_forums'] : '<select name="' . $box_name . '">' . $forum_list . '</select>';

        return $forum_list;
}

//
// Synchronise functions for forums/topics
//
function sync($type, $id = false)
{
        global $db;

        switch($type)
        {
                case 'all forums':
                        $sql = "SELECT forum_id
                                FROM " . FORUMS_TABLE;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get forum IDs', '', __LINE__, __FILE__, $sql);
                        }

                        while( $row = $db->sql_fetchrow($result) )
                        {
                                sync('forum', $row['forum_id']);
                        }
                        $db->sql_freeresult($result);
                           break;

                case 'all topics':
                        $sql = "SELECT topic_id
                                FROM " . TOPICS_TABLE;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
                        }

                        while( $row = $db->sql_fetchrow($result) )
                        {
                                sync('topic', $row['topic_id']);
                        }
                        $db->sql_freeresult($result);
                        break;

                  case 'forum':
                        $sql = "SELECT MAX(post_id) AS last_post, COUNT(post_id) AS total
                                FROM " . POSTS_TABLE . "
                                WHERE forum_id = '$id'";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $row = $db->sql_fetchrow($result) )
                        {
                                $last_post = ( $row['last_post'] ) ? $row['last_post'] : 0;
                                $total_posts = ($row['total']) ? $row['total'] : 0;
                        }
                        else
                        {
                                $last_post = 0;
                                $total_posts = 0;
                        }
                        $db->sql_freeresult($result);

                        $sql = "SELECT COUNT(topic_id) AS total
                                FROM " . TOPICS_TABLE . "
                                WHERE forum_id = '$id'";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get topic count', '', __LINE__, __FILE__, $sql);
                        }

                        $total_topics = ( $row = $db->sql_fetchrow($result) ) ? ( ( $row['total'] ) ? $row['total'] : 0 ) : 0;

                        $sql = "UPDATE " . FORUMS_TABLE . "
                                SET forum_last_post_id = '$last_post', forum_posts = '$total_posts', forum_topics = '$total_topics'
                                WHERE forum_id = '$id'";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update forum', '', __LINE__, __FILE__, $sql);
                        }
                        $db->sql_freeresult($result);
                        break;

                case 'topic':
                        $sql = "SELECT MAX(post_id) AS last_post, MIN(post_id) AS first_post, COUNT(post_id) AS total_posts
                                FROM " . POSTS_TABLE . "
                                WHERE topic_id = '$id'";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $row = $db->sql_fetchrow($result) )
                        {
                if ($row['total_posts'])
                {
                    // Correct the details of this topic
                    $sql = 'UPDATE ' . TOPICS_TABLE . '
                        SET topic_replies = ' . ($row['total_posts'] - 1) . ', topic_first_post_id = ' . $row['first_post'] . ', topic_last_post_id = ' . $row['last_post'] . "
                        WHERE topic_id = $id";

                    if (!$db->sql_query($sql))
                    {
                        message_die(GENERAL_ERROR, 'Could not update topic', '', __LINE__, __FILE__, $sql);
                    }
                }
                else
                {
                    // There are no replies to this topic
                    // Check if it is a move stub
                    $sql = 'SELECT topic_moved_id
                        FROM ' . TOPICS_TABLE . "
                        WHERE topic_id = $id";

                    if (!($result = $db->sql_query($sql)))
                    {
                        message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
                    }

                    if ($row = $db->sql_fetchrow($result))
                    {
                        if (!$row['topic_moved_id'])
                        {
                            $sql = 'DELETE FROM ' . TOPICS_TABLE . " WHERE topic_id = $id";

                            if (!$db->sql_query($sql))
                            {
                                message_die(GENERAL_ERROR, 'Could not remove topic', '', __LINE__, __FILE__, $sql);
                            }
                        }
                    }

                    $db->sql_freeresult($result);
                }
                        }
/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                        attachment_sync_topic($id);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                        break;
        }

        return true;
}

?>