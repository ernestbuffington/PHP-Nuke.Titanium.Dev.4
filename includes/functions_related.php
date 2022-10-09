<?php

/***************************************************************************
 *                           functions_related.php
 *                          -----------------------
 *   copyright            : ©2003 Freakin' Booty ;-P
 *   built for            : Related topics 0.1.2
 *
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

if(!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}


function get_related_topics($topic_id)
{
	global $board_config, $db, $lang, $template, $theme, $images, $phpEx;
	global $userdata, $HTTP_COOKIE_VARS;

	//
	// Fetch all words that appear in the title of $topic_id
	//
	$sql = 'SELECT m.word_id FROM ' . SEARCH_MATCH_TABLE . ' m, ' . TOPICS_TABLE . ' t
			WHERE m.post_id = t.topic_first_post_id
				AND t.topic_id = ' . intval($topic_id);
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not retrieve word matches', '', __LINE__, __FILE__, $sql);
	}

	$word_ids = array(0);
	while( $row = $db->sql_fetchrow($result) )
	{
		$word_ids[] = intval($row['word_id']);
	}
	$word_id_sql = implode(', ', $word_ids);

	//
	// Only search for related topics in the forums where the user has read access
	//
	$is_auth = array();
	$is_auth = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

	$forum_ids = array(0);
	while( list($forum_id, $forum_auth) = @each($is_auth) )
	{
		if( $forum_auth['auth_read'] )
		{
			$forum_ids[] = $forum_id;
		}
	}
	$forum_id_sql = implode(', ', $forum_ids);

	$sql = 'SELECT DISTINCT(t.topic_id)
			FROM ' . SEARCH_MATCH_TABLE . ' m, ' . POSTS_TABLE . ' p, ' . TOPICS_TABLE . ' t
			WHERE t.topic_id <> ' . intval($topic_id) . '
				AND t.topic_status <> ' . TOPIC_MOVED . '
				AND p.topic_id = t.topic_id
				AND p.post_id = m.post_id
				AND p.forum_id IN (' . $forum_id_sql . ')
				AND m.title_match = 1
				AND m.word_id IN (' . $word_id_sql . ')
			LIMIT 0, 5';
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not retrieve related topics information', '', __LINE__, __FILE__, $sql);
	}

	$topic_ids = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$topic_ids[] = $row['topic_id'];
	}
	$topic_id_sql = implode(', ', $topic_ids);

	//
	// No topics? Exit
	//
	if( count($topic_ids) == 0 )
	{
		return;
	}

	//
	// Output to page
	//
	$template->set_filenames(array(
		'related_topics' => 'viewtopic_related_body.tpl'
	));

	$template->assign_vars(array(
		'L_RELATED_TOPICS' => $lang['Related_topics'],

		'L_AUTHOR' => $lang['Author'],
		'L_TOPICS' => $lang['Topics'],
		'L_REPLIES' => $lang['Replies'],
		'L_VIEWS' => $lang['Views'],
		'L_LASTPOST' => $lang['Last_Post'], 
	));

	//
	// Define censored word matches
	//
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	//
	// Fetch all topic information
	//
	$sql = 'SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time
			FROM ' . TOPICS_TABLE . ' t, ' . USERS_TABLE . ' u, ' . POSTS_TABLE . ' p, ' . POSTS_TABLE . ' p2, ' . USERS_TABLE . ' u2
			WHERE t.topic_id IN (' . $topic_id_sql . ')
				AND t.topic_poster = u.user_id
				AND p.post_id = t.topic_first_post_id
				AND p2.post_id = t.topic_last_post_id
				AND u2.user_id = p2.poster_id
			ORDER BY t.topic_type DESC, t.topic_last_post_id DESC';

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not retrieve topic information', '', __LINE__, __FILE__, $sql);
	}

	$topic_row = array();
	$topic_row = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

	if( count($topic_row) == 0 )
	{
		return;
	}

	$i = 0;
	foreach( $topic_row as $row )
	{
		$topic_id = $row['topic_id'];
		$forum_id = $row['forum_id'];

		$topic_title = $row['topic_title'];
		if( count($orig_word) )
		{
			$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
		}

		$replies = $row['topic_replies'];
		$views = $row['topic_views'];

		$topic_type = $row['topic_type'];
		switch( $topic_type )
		{
			case POST_ANNOUNCE:
				$topic_type = $lang['Topic_Announcement'] . ' ';
				break;
			case POST_STICKY:
				$topic_type = $lang['Topic_Sticky'] . ' ';
				break;
			default:
				$topic_type = '';
				break;
		}

		if( $row['topic_vote'] )
		{
			$topic_type .= $lang['Topic_Poll'] . ' ';
		}

		if( $row['topic_type'] == POST_ANNOUNCE )
		{
			$folder = $images['folder_announce'];
			$folder_new = $images['folder_announce_new'];
		}
		else if( $row['topic_type'] == POST_STICKY )
		{
			$folder = $images['folder_sticky'];
			$folder_new = $images['folder_sticky_new'];
		}
		else if( $row['topic_status'] == TOPIC_LOCKED )
		{
			$folder = $images['folder_locked'];
			$folder_new = $images['folder_locked_new'];
		}
		else
		{
			if($replies >= $board_config['hot_threshold'])
			{
				$folder = $images['folder_hot'];
				$folder_new = $images['folder_hot_new'];
			}
			else
			{
				$folder = $images['folder'];
				$folder_new = $images['folder_new'];
			}
		}

		$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : '';
		$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : '';

		$newest_post_img = '';
		if( $userdata['session_logged_in'] )
		{
			if( $row['post_time'] > $userdata['user_lastvisit'] ) 
			{
				if( !empty($tracking_topics) || !empty($tracking_forums) || isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
				{
					$unread_topics = true;

					if( !empty($tracking_topics[$topic_id]) )
					{
						if( $tracking_topics[$topic_id] >= $row['post_time'] )
						{
							$unread_topics = false;
						}
					}

					if( !empty($tracking_forums[$forum_id]) )
					{
						if( $tracking_forums[$forum_id] >= $row['post_time'] )
						{
							$unread_topics = false;
						}
					}

					if( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
					{
						if( $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all'] >= $row['post_time'] )
						{
							$unread_topics = false;
						}
					}

					if( $unread_topics )
					{
						$folder_image = $folder_new;
						$folder_alt = $lang['New_posts'];

						$newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
					}
					else
					{
						$folder_image = $folder;
						$folder_alt = ( $row['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

						$newest_post_img = '';
					}
				}
				else
				{
					$folder_image = $folder_new;
					$folder_alt = ( $row['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['New_posts'];

					$newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
				}
			}
			else 
			{
				$folder_image = $folder;
				$folder_alt = ( $row['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

				$newest_post_img = '';
			}
		}
		else
		{
			$folder_image = $folder;
			$folder_alt = ( $row['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

			$newest_post_img = '';
		}

		$topic_author = ( $row['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['user_id']) . '">' : '';
		$topic_author .= ( $row['user_id'] != ANONYMOUS ) ? $row['username'] : ( ( $row['post_username'] != '' ) ? $row['post_username'] : $lang['Guest'] );
		$topic_author .= ( $row['user_id'] != ANONYMOUS ) ? '</a>' : '';

		$first_post_time = create_date($board_config['default_dateformat'], $row['topic_time'], $board_config['board_timezone']);
		$last_post_time = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);
		$last_post_author = ( $row['id2'] == ANONYMOUS ) ? ( ($row['post_username2'] != '' ) ? $row['post_username2'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $row['id2']) . '">' . $row['user2'] . '</a>';
		$last_post_url = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $row['topic_last_post_id']) . '#' . $row['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars('topicrow', array(
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,

			'L_TOPIC_FOLDER_ALT' => $folder_alt,

			'U_VIEW_TOPIC' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $row['topic_id']),

			'TOPIC_FOLDER_IMG' => $folder_image,
			'TOPIC_AUTHOR' => $topic_author,
			'REPLIES' => $replies,
			'NEWEST_POST_IMG' => $newest_post_img,
			'TOPIC_TITLE' => $topic_title,
			'TOPIC_TYPE' => $topic_type,
			'VIEWS' => $views,
			'LAST_POST_TIME' => $last_post_time,
			'LAST_POST_AUTHOR' => $last_post_author,
			'LAST_POST_IMG' => $last_post_url,
		));

		$i++;
	}

	$template->assign_var_from_handle('RELATED_TOPICS', 'related_topics');
	return;
}

?>
