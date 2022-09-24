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

if(!defined('IN_PHPBB2'))
{
	die('ACCESS DENIED');
}


function get_related_topics($topic_id)
{
	global $phpbb2_board_config, $titanium_db, $titanium_lang, $phpbb2_template, $theme, $images, $phpEx;
	global $userdata, $HTTP_COOKIE_VARS;

	//
	// Fetch all words that appear in the title of $topic_id
	//
	$sql = 'SELECT m.word_id FROM ' . SEARCH_MATCH_TABLE . ' m, ' . TOPICS_TABLE . ' t
			WHERE m.post_id = t.topic_first_post_id
				AND t.topic_id = ' . intval($topic_id);
	if( !$result = $titanium_db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not retrieve word matches', '', __LINE__, __FILE__, $sql);
	}

	$word_ids = array(0);
	while( $row = $titanium_db->sql_fetchrow($result) )
	{
		$word_ids[] = intval($row['word_id']);
	}
	$word_id_sql = implode(', ', $word_ids);

	//
	// Only search for related topics in the forums where the user has read access
	//
	$phpbb2_is_auth = array();
	$phpbb2_is_auth = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

	$phpbb2_forum_ids = array(0);
	while( list($phpbb2_forum_id, $forum_auth) = @each($phpbb2_is_auth) )
	{
		if( $forum_auth['auth_read'] )
		{
			$phpbb2_forum_ids[] = $phpbb2_forum_id;
		}
	}
	$phpbb2_forum_id_sql = implode(', ', $phpbb2_forum_ids);

	$sql = 'SELECT DISTINCT(t.topic_id)
			FROM ' . SEARCH_MATCH_TABLE . ' m, ' . POSTS_TABLE . ' p, ' . TOPICS_TABLE . ' t
			WHERE t.topic_id <> ' . intval($topic_id) . '
				AND t.topic_status <> ' . TOPIC_MOVED . '
				AND p.topic_id = t.topic_id
				AND p.post_id = m.post_id
				AND p.forum_id IN (' . $phpbb2_forum_id_sql . ')
				AND m.title_match = 1
				AND m.word_id IN (' . $word_id_sql . ')
			LIMIT 0, 5';
	if( !$result = $titanium_db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not retrieve related topics information', '', __LINE__, __FILE__, $sql);
	}

	$topic_ids = array();
	while( $row = $titanium_db->sql_fetchrow($result) )
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
	$phpbb2_template->set_filenames(array(
		'related_topics' => 'viewtopic_related_body.tpl'
	));

	$phpbb2_template->assign_vars(array(
		'L_RELATED_TOPICS' => $titanium_lang['Related_topics'],

		'L_AUTHOR' => $titanium_lang['Author'],
		'L_TOPICS' => $titanium_lang['Topics'],
		'L_REPLIES' => $titanium_lang['Replies'],
		'L_VIEWS' => $titanium_lang['Views'],
		'L_LASTPOST' => $titanium_lang['Last_Post'], 
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

	if( !$result = $titanium_db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not retrieve topic information', '', __LINE__, __FILE__, $sql);
	}

	$topic_row = array();
	$topic_row = $titanium_db->sql_fetchrowset($result);
	$titanium_db->sql_freeresult($result);

	if( count($topic_row) == 0 )
	{
		return;
	}

	$i = 0;
	foreach( $topic_row as $row )
	{
		$topic_id = $row['topic_id'];
		$phpbb2_forum_id = $row['forum_id'];

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
				$topic_type = $titanium_lang['Topic_Announcement'] . ' ';
				break;
			case POST_STICKY:
				$topic_type = $titanium_lang['Topic_Sticky'] . ' ';
				break;
			default:
				$topic_type = '';
				break;
		}

		if( $row['topic_vote'] )
		{
			$topic_type .= $titanium_lang['Topic_Poll'] . ' ';
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
			if($replies >= $phpbb2_board_config['hot_threshold'])
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

		$phpbb2_tracking_topics = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) : '';
		$phpbb2_tracking_forums = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f']) : '';

		$newest_post_img = '';
		if( $userdata['session_logged_in'] )
		{
			if( $row['post_time'] > $userdata['user_lastvisit'] ) 
			{
				if( !empty($phpbb2_tracking_topics) || !empty($phpbb2_tracking_forums) || isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all']) )
				{
					$phpbb2_unread_topics = true;

					if( !empty($phpbb2_tracking_topics[$topic_id]) )
					{
						if( $phpbb2_tracking_topics[$topic_id] >= $row['post_time'] )
						{
							$phpbb2_unread_topics = false;
						}
					}

					if( !empty($phpbb2_tracking_forums[$phpbb2_forum_id]) )
					{
						if( $phpbb2_tracking_forums[$phpbb2_forum_id] >= $row['post_time'] )
						{
							$phpbb2_unread_topics = false;
						}
					}

					if( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all']) )
					{
						if( $HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all'] >= $row['post_time'] )
						{
							$phpbb2_unread_topics = false;
						}
					}

					if( $phpbb2_unread_topics )
					{
						$phpbb2_folder_image = $folder_new;
						$phpbb2_folder_alt = $titanium_lang['New_posts'];

						$newest_post_img = '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $titanium_lang['View_newest_post'] . '" title="' . $titanium_lang['View_newest_post'] . '" border="0" /></a> ';
					}
					else
					{
						$phpbb2_folder_image = $folder;
						$phpbb2_folder_alt = ( $row['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];

						$newest_post_img = '';
					}
				}
				else
				{
					$phpbb2_folder_image = $folder_new;
					$phpbb2_folder_alt = ( $row['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['New_posts'];

					$newest_post_img = '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $titanium_lang['View_newest_post'] . '" title="' . $titanium_lang['View_newest_post'] . '" border="0" /></a> ';
				}
			}
			else 
			{
				$phpbb2_folder_image = $folder;
				$phpbb2_folder_alt = ( $row['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];

				$newest_post_img = '';
			}
		}
		else
		{
			$phpbb2_folder_image = $folder;
			$phpbb2_folder_alt = ( $row['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];

			$newest_post_img = '';
		}

		$topic_author = ( $row['user_id'] != ANONYMOUS ) ? '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['user_id']) . '">' : '';
		$topic_author .= ( $row['user_id'] != ANONYMOUS ) ? $row['username'] : ( ( $row['post_username'] != '' ) ? $row['post_username'] : $titanium_lang['Guest'] );
		$topic_author .= ( $row['user_id'] != ANONYMOUS ) ? '</a>' : '';

		$first_post_time = create_date($phpbb2_board_config['default_dateformat'], $row['topic_time'], $phpbb2_board_config['board_timezone']);
		$phpbb2_last_post_time = create_date($phpbb2_board_config['default_dateformat'], $row['post_time'], $phpbb2_board_config['board_timezone']);
		$phpbb2_last_post_author = ( $row['id2'] == ANONYMOUS ) ? ( ($row['post_username2'] != '' ) ? $row['post_username2'] . ' ' : $titanium_lang['Guest'] . ' ' ) : '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $row['id2']) . '">' . $row['user2'] . '</a>';
		$phpbb2_last_post_url = '<a href="' . append_titanium_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $row['topic_last_post_id']) . '#' . $row['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $titanium_lang['View_latest_post'] . '" title="' . $titanium_lang['View_latest_post'] . '" border="0" /></a>';

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$phpbb2_template->assign_block_vars('topicrow', array(
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,

			'L_TOPIC_FOLDER_ALT' => $phpbb2_folder_alt,

			'U_VIEW_TOPIC' => append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $row['topic_id']),

			'TOPIC_FOLDER_IMG' => $phpbb2_folder_image,
			'TOPIC_AUTHOR' => $topic_author,
			'REPLIES' => $replies,
			'NEWEST_POST_IMG' => $newest_post_img,
			'TOPIC_TITLE' => $topic_title,
			'TOPIC_TYPE' => $topic_type,
			'VIEWS' => $views,
			'LAST_POST_TIME' => $phpbb2_last_post_time,
			'LAST_POST_AUTHOR' => $phpbb2_last_post_author,
			'LAST_POST_IMG' => $phpbb2_last_post_url,
		));

		$i++;
	}

	$phpbb2_template->assign_var_from_handle('RELATED_TOPICS', 'related_topics');
	return;
}

?>
