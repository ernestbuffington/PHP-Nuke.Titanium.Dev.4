<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            functions_post.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: functions_post.php,v 1.9.2.37 2004/11/18 17:49:44 acydburn Exp
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
-=[Base]=-
      Caching System                           v1.0.0       10/30/2005
-=[Mod]=-
      Allow multiple spaces in posts           v1.0.0       06/24/2005
      adminHtml                                v1.0.3       06/26/2005
      Topic Text Reply Email                   v1.0.0       07/11/2005
      Limit smilies per post                   v1.0.2       07/24/2005
      Must first vote to see results           v1.0.0       08/03/2005
      Log Moderator Actions                    v1.1.6       08/06/2005
      No Flood Control For Mods And Admins     v1.0.0       10/02/2005
      Auto Group                               v1.2.2       11/06/2006
	  Thank You Mod                            v1.1.8
	  Post Icons                               v1.0.1
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');

$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');

//
// This function will prepare a posted message for
// entry into the database.
//
function prepare_message($message, $html_on, $bbcode_on, $smile_on, $bbcode_uid = 0)
{
/*****[BEGIN]******************************************
 [ Mod:     adminHtml                          v1.0.3 ]
 ******************************************************/
        global $board_config, $html_entities_match, $html_entities_replace, $userdata;
/*****[END]********************************************
 [ Mod:     adminHtml                          v1.0.3 ]
 ******************************************************/

        //
        // Clean up the message
        //
        $message = trim($message);

        if ($html_on)
        {
         		// If HTML is on, we try to make it safe
         		// This approach is quite agressive and anything that does not look like a valid tag
         		// is going to get converted to HTML entities
         		$message = stripslashes($message);
         		$html_match = '#<[^\w<]*(\w+)((?:"[^"]*"|\'[^\']*\'|[^<>\'"])+)?>#';
         		$matches = array();

         		$message_split = preg_split($html_match, $message);
         		preg_match_all($html_match, $message, $matches);

         		$message = '';

         		foreach ($message_split as $part)
         		{
         			$tag = array(array_shift($matches[0]), array_shift($matches[1]), array_shift($matches[2]));
        			$message .= preg_replace($html_entities_match, $html_entities_replace, $part) . clean_html($tag);
        		}

        		$message = addslashes($message);
        		$message = str_replace('&quot;', '\&quot;', $message);
        }
        else
        {
/*****[BEGIN]******************************************
 [ Mod:     adminHtml                          v1.0.3 ]
 ******************************************************/
        if($userdata['user_level'] == ADMIN)
        {
            //do nothing
        }
        else
        {
/*****[END]********************************************
 [ Mod:     adminHtml                          v1.0.3 ]
 ******************************************************/
                $message = preg_replace($html_entities_match, $html_entities_replace, $message);
/*****[BEGIN]******************************************
 [ Mod:     adminHtml                          v1.0.3 ]
 ******************************************************/
        }
/*****[END]********************************************
 [ Mod:     adminHtml                          v1.0.3 ]
 ******************************************************/
        }

        if($bbcode_on && $bbcode_uid != '')
        {
                $message = bbencode_first_pass($message, $bbcode_uid);
        }
/*****[BEGIN]******************************************
 [ Mod:     Allow multiple spaces in posts     v1.0.0 ]
 ******************************************************/
        $message = replace_double_spaces($message);
/*****[END]********************************************
 [ Mod:     Allow multiple spaces in posts     v1.0.0 ]
 ******************************************************/

        return $message;
}

function unprepare_message($message)
{
        global $unhtml_specialchars_match, $unhtml_specialchars_replace;

        return preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, $message);
}

//
// Prepare a message for posting
//
/*****[BEGIN]******************************************
 [ Mod:    Must first vote to see results      v1.0.0 ]
 ******************************************************/
function prepare_post(&$mode, &$post_data, &$bbcode_on, &$html_on, &$smilies_on, &$error_msg, &$username, &$bbcode_uid, &$subject, &$message, &$poll_title, &$poll_options, &$poll_length, &$poll_view_toggle)
/*****[END]********************************************
 [ Mod:    Must first vote to see results      v1.0.0 ]
 ******************************************************/
{
        global $board_config, $userdata, $lang, $phpEx, $phpbb_root_path;

        // Check username
        if (!empty($username))
        {
        $username = phpbb_clean_username($username);

                if (!$userdata['session_logged_in'] || ($userdata['session_logged_in'] && $username != $userdata['username']))
                {
                        include("includes/functions_validate.php");

                        $result = validate_username($username);
                        if ($result['error'])
                        {
                                $error_msg .= (!empty($error_msg)) ? '<br />' . $result['error_msg'] : $result['error_msg'];
                        }
                }
                else
                {
                        $username = '';
                }
        }

        // Check subject
/*****[BEGIN]******************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
        if (substr_count(smilies_pass($message), '<img src="'. $board_config['smilies_path']) > $board_config['max_smilies'] )
        {
            $to_much_smilies = substr_count(smilies_pass($message), '<img src="'. $board_config['smilies_path']) - $board_config['max_smilies'];
            $to_many_smilies = sprintf($lang['Max_smilies_per_post'], $board_config['max_smilies'], $to_much_smilies);
            $error_msg .= ( !empty($error_msg) ) ? '<br />' . $to_many_smilies : $to_many_smilies;
        }
/*****[END]********************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
        if (!empty($subject))
        {
                $subject = htmlspecialchars(trim($subject));
        }
        else if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
        {
                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_subject'] : $lang['Empty_subject'];
        }

        // Check message
        if (!empty($message))
        {
                $bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : '';
                $message = prepare_message(trim($message), $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
        }
        else if ($mode != 'delete' && $mode != 'poll_delete')
        {
                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_message'] : $lang['Empty_message'];
        }

        //
        // Handle poll stuff
        //
        if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
        {
                $poll_length = (isset($poll_length)) ? max(0, intval($poll_length)) : 0;

                if (!empty($poll_title))
                {
                        $poll_title = htmlspecialchars(trim($poll_title));
                }

                if(!empty($poll_options))
                {
                        $temp_option_text = array();
						foreach ($poll_options as $option_id => $option_text)
                        {
                                $option_text = trim($option_text);
                                if (!empty($option_text))
                                {
                                        $temp_option_text[intval($option_id)] = htmlspecialchars($option_text);
                                }
                        }
                        $option_text = $temp_option_text;

                        if (count($poll_options) < 2)
                        {
                                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_few_poll_options'] : $lang['To_few_poll_options'];
                        }
                        else if (count($poll_options) > $board_config['max_poll_options'])
                        {
                                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_many_poll_options'] : $lang['To_many_poll_options'];
                        }
                        else if ($poll_title == '')
                        {
                                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_poll_title'] : $lang['Empty_poll_title'];
                        }
                }
        }

        return;
}

//
// Post a new topic/reply/poll or edit existing post/poll
//
/*****[BEGIN]******************************************
 [ Mod:    Must first vote to see results      v1.0.0 ]
 [ Mod:    Post Icons                          v1.0.1 ]
 ******************************************************/
function submit_post($mode, &$post_data, &$message, &$meta, &$forum_id, &$topic_id, &$post_id, &$poll_id, &$topic_type, &$bbcode_on, &$html_on, &$smilies_on, &$attach_sig, &$bbcode_uid, $post_username, $post_subject, $post_message, $poll_title, &$poll_options, &$poll_length, &$poll_view_toggle, $post_icon = 0)
/*****[END]********************************************
 [ Mod:    Post Icons                          v1.0.1 ]
 [ Mod:    Must first vote to see results      v1.0.0 ]
 ******************************************************/
{
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    global $cache;
    $cache->delete('TopicData', 'home');
    $cache->delete('AnnounceData', 'home');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        global $board_config, $lang, $db, $phpbb_root_path, $phpEx, $userdata, $user_ip;

            /*--FNA--*/

        include("includes/functions_search.php");

        $current_time = time();

/*****[BEGIN]******************************************
 [ Mod:   No Flood Control For Mods And Admins v1.0.0 ]
 ******************************************************/
        //
        // Retreive authentication info to determine if this user has moderator status
        //
        $is_auth = auth(AUTH_ALL, $forum_id, $userdata);
        $is_mod = $is_auth['auth_mod'];
		
        # TheGhost aka Erbest Buffington 10/14/2022 10:41am
		# if somehow the person is able to get more than 120 characters to submit in a post subject
		# we just chop the mother fucker off!
		if(strlen($post_subject) >  117)
		$post_subject = substr($post_subject,0,117) . "...";

        if (($mode == 'newtopic' || $mode == 'reply' || $mode == 'editpost') && !$is_mod)
/*****[END]********************************************
 [ Mod:   No Flood Control For Mods And Admins v1.0.0 ]
 ******************************************************/
        {
                //
                // Flood control
                //
                $where_sql = ($userdata['user_id'] == ANONYMOUS) ? "poster_ip = '$user_ip'" : 'poster_id = ' . $userdata['user_id'];
                $sql = "SELECT MAX(post_time) AS last_post_time
                        FROM " . POSTS_TABLE . "
                        WHERE $where_sql";
                if ($result = $db->sql_query($sql))
                {
                        if ($row = $db->sql_fetchrow($result))
                        {
                                if (intval($row['last_post_time']) > 0 && ($current_time - intval($row['last_post_time'])) < intval($board_config['flood_interval']))
                                {
                                        message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
                                }
                        }
                }
        }

        if ($mode == 'editpost')
        {
                remove_search_post($post_id);
        }

        if(!isset($post_data['edit_vote']))
        $post_data['edit_vote'] = '';

        if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
        {

                # TheGhost aka Erbest Buffington 10/14/2022 10:41am
		        # if somehow the person is able to get more than 120 characters to submit in a post subject
		        # we just chop the mother fucker off!
		        if(strlen($post_subject) >  117)
		        $post_subject = substr($post_subject,0,117) . "...";

                $topic_vote = (!empty($poll_title) && count($poll_options) >= 2) ? 1 : 0;
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
                $sql  = ($mode != "editpost") ? "INSERT INTO " . TOPICS_TABLE . " (topic_title, 
				                                                                  topic_poster, 
																				    topic_time, 
																					  forum_id, 
																				  topic_status, 
																				    topic_type, 
																					topic_icon, 
																					topic_vote) 
																					
		       VALUES ('$post_subject', 
		  " . $userdata['user_id'] . ", 
		               '$current_time', 
					       '$forum_id', 
				" . TOPIC_UNLOCKED . ", 
				         '$topic_type', 
						    $post_icon, 
						  '$topic_vote')" : "UPDATE " . TOPICS_TABLE . " 
						  
		SET topic_title = '$post_subject', 
		            topic_icon=$post_icon, 
				 topic_type = $topic_type " . (($post_data['edit_vote'] || !empty($poll_title)) ? ", topic_vote = " . $topic_vote : "") . " WHERE topic_id = '$topic_id'";
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
				if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }

                if ($mode == 'newtopic')
                {
                        $topic_id = $db->sql_nextid();
                }
        }

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
if ($mode == 'newtopic')
           if ( $topic_type == POST_GLOBAL_ANNOUNCE )
           log_action('Global Announcement', '', $topic_id, $userdata['user_id'], '', '');
           if ( $topic_type == POST_ANNOUNCE )
           log_action('Announcement', '', $topic_id, $userdata['user_id'], '', '');
           else if ( $topic_type == POST_STICKY )
           log_action('Sticky', '', $topic_id, $userdata['user_id'], '', '');
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
        $edited_sql = ($mode == 'editpost' && !$post_data['last_post'] && $post_data['poster_post']) ? ", post_edit_time = $current_time, post_edit_count = post_edit_count + 1 " : "";
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
        $sql = ($mode != "editpost") ? "INSERT INTO " . POSTS_TABLE . " (topic_id, 
		                                                                 forum_id, 
																		poster_id, 
																	post_username, 
																	    post_time, 
																		poster_ip, 
																	enable_bbcode, 
																	  enable_html, 
																   enable_smilies, 
																       enable_sig, 
																	    post_icon) 
																		
	    VALUES ('$topic_id', 
	            '$forum_id', 
   ".$userdata['user_id'].", 
           '$post_username', 
		    '$current_time', 
			     '$user_ip', 
			   '$bbcode_on', 
			     '$html_on', 
			  '$smilies_on', 
			  '$attach_sig', 
			    $post_icon)" : "UPDATE ".POSTS_TABLE." 
				
	              SET post_username = '$post_username', 
	                      enable_bbcode = '$bbcode_on', 
						    enable_html = '$html_on', 
						 enable_smilies = '$smilies_on', 
						     enable_sig = '$attach_sig', 
							  post_icon = $post_icon".$edited_sql." 
   
   WHERE post_id = '$post_id'";
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
        if (!$db->sql_query($sql))
        {
                message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }

        if ($mode != 'editpost')
        {
                $post_id = $db->sql_nextid();
        }

		$sql = ($mode != 'editpost') ? "INSERT INTO " . POSTS_TEXT_TABLE . " (post_id, 
		                                                                 post_subject, 
																		   bbcode_uid, 
																		    post_text) 
																			
		VALUES ('$post_id', 
		   '$post_subject', 
		     '$bbcode_uid', 
		   '$post_message')" : "UPDATE ".POSTS_TEXT_TABLE." SET post_text = '$post_message',bbcode_uid = '$bbcode_uid',post_subject = '$post_subject' WHERE post_id = '$post_id'";
        
		if (!$db->sql_query($sql))
        {
                message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }

        add_search_words('single', $post_id, stripslashes($post_message), stripslashes($post_subject));

        //
        // Add poll
        //
        if (($mode == 'newtopic' || ($mode == 'editpost' && $post_data['edit_poll'])) && !empty($poll_title) && count($poll_options) >= 2)
        {
/*****[BEGIN]******************************************
 [ Mod:    Must first vote to see results      v1.0.0 ]
 ******************************************************/
                $sql = (!$post_data['has_poll']) ? "INSERT INTO " . VOTE_DESC_TABLE . " (topic_id, vote_text, vote_start, vote_length, poll_view_toggle) VALUES ('$topic_id', '$poll_title', '$current_time', " . ($poll_length * 86400) . ", '$poll_view_toggle')" : "UPDATE " . VOTE_DESC_TABLE . " SET vote_text = '$poll_title', vote_length = " . ($poll_length * 86400) . ", poll_view_toggle = '$poll_view_toggle' WHERE topic_id = '$topic_id'";
/*****[END]********************************************
 [ Mod:    Must first vote to see results      v1.0.0 ]
 ******************************************************/
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }

                $delete_option_sql = '';
                $old_poll_result = array();
                if ($mode == 'editpost' && $post_data['has_poll'])
                {
                        $sql = "SELECT vote_option_id, vote_result
                                FROM " . VOTE_RESULTS_TABLE . "
                                WHERE vote_id = '$poll_id'
                                ORDER BY vote_option_id ASC";
                        if (!($result = $db->sql_query($sql)))
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain vote data results for this topic', '', __LINE__, __FILE__, $sql);
                        }

                        while ($row = $db->sql_fetchrow($result))
                        {
                                $old_poll_result[$row['vote_option_id']] = $row['vote_result'];

                                if (!isset($poll_options[$row['vote_option_id']]))
                                {
                                        $delete_option_sql .= ($delete_option_sql != '') ? ', ' . $row['vote_option_id'] : $row['vote_option_id'];
                                }
                        }
                }
                else
                {
                        $poll_id = $db->sql_nextid();
                }

                reset($poll_options);

                $poll_option_id = 1;
				foreach ($poll_options as $option_id => $option_text)
                {
                        if (!empty($option_text))
                        {
                                $option_text = str_replace("\'", "''", htmlspecialchars($option_text));
                                $poll_result = ($mode == "editpost" && isset($old_poll_result[$option_id])) ? $old_poll_result[$option_id] : 0;

                                $sql = ($mode != "editpost" || !isset($old_poll_result[$option_id])) ? "INSERT INTO " . VOTE_RESULTS_TABLE . " (vote_id, vote_option_id, vote_option_text, vote_result) VALUES ('$poll_id', '$poll_option_id', '$option_text', '$poll_result')" : "UPDATE " . VOTE_RESULTS_TABLE . " SET vote_option_text = '$option_text', vote_result = '$poll_result' WHERE vote_option_id = '$option_id' AND vote_id = '$poll_id'";
                                if (!$db->sql_query($sql))
                                {
                                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                                }
                                $poll_option_id++;
                        }
                }

                if ($delete_option_sql != '')
                {
                        $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "
                                WHERE vote_option_id IN ($delete_option_sql)
                                        AND vote_id = '$poll_id'";
                        if (!$db->sql_query($sql))
                        {
                                message_die(GENERAL_ERROR, 'Error deleting pruned poll options', '', __LINE__, __FILE__, $sql);
                        }
                }
        }

        $meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">';
        $message = $lang['Stored'] . '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');

        return false;
}

//
// Update post stats and details
//
function update_post_stats(&$mode, &$post_data, &$forum_id, &$topic_id, &$post_id, &$user_id)
{
        global $db, $userdata;

        $sign = ($mode == 'delete') ? '- 1' : '+ 1';
        $forum_update_sql = "forum_posts = forum_posts $sign";
        $topic_update_sql = '';

        if ($mode == 'delete')
        {
                if ($post_data['last_post'])
                {
                        if ($post_data['first_post'])
                        {
                                $forum_update_sql .= ', forum_topics = forum_topics - 1';
                        }
                        else
                        {

                                $topic_update_sql .= 'topic_replies = topic_replies - 1';

                                $sql = "SELECT MAX(post_id) AS last_post_id
                                        FROM " . POSTS_TABLE . "
                                        WHERE topic_id = '$topic_id'";
                                if (!($result = $db->sql_query($sql)))
                                {
                                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                                }

                                if ($row = $db->sql_fetchrow($result))
                                {
                                        $topic_update_sql .= ', topic_last_post_id = ' . $row['last_post_id'];
                                }
                        }

                        if ($post_data['last_topic'])
                        {
                                $sql = "SELECT MAX(post_id) AS last_post_id
                                        FROM " . POSTS_TABLE . "
                                        WHERE forum_id = '$forum_id'";
                                if (!($result = $db->sql_query($sql)))
                                {
                                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                                }

                                if ($row = $db->sql_fetchrow($result))
                                {
                                        $forum_update_sql .= ($row['last_post_id']) ? ', forum_last_post_id = ' . $row['last_post_id'] : ', forum_last_post_id = 0';
                                }
                        }
                }
                else if ($post_data['first_post'])
                {
                        $sql = "SELECT MIN(post_id) AS first_post_id
                                FROM " . POSTS_TABLE . "
                                WHERE topic_id = '$topic_id'";
                        if (!($result = $db->sql_query($sql)))
                        {
                                message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                        }

                        if ($row = $db->sql_fetchrow($result))
                        {
                                $topic_update_sql .= 'topic_replies = topic_replies - 1, topic_first_post_id = ' . $row['first_post_id'];
                        }
                }
                else
                {
                        $topic_update_sql .= 'topic_replies = topic_replies - 1';
                }
        }
        else if ($mode != 'poll_delete')
        {
                $forum_update_sql .= ", forum_last_post_id = $post_id" . (($mode == 'newtopic') ? ", forum_topics = forum_topics $sign" : "");
                $topic_update_sql = "topic_last_post_id = $post_id" . (($mode == 'reply') ? ", topic_replies = topic_replies $sign" : ", topic_first_post_id = $post_id");
        }
        else
        {
                $topic_update_sql .= 'topic_vote = 0';
        }

    	if ($mode != 'poll_delete')
    	{
    		$sql = "UPDATE " . FORUMS_TABLE . " SET
    			$forum_update_sql
    			WHERE forum_id = $forum_id";
    		if (!$db->sql_query($sql))
    		{
    			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
    		}
    	}

        if ($topic_update_sql != '')
        {
                $sql = "UPDATE " . TOPICS_TABLE . " SET
                        $topic_update_sql
                        WHERE topic_id = '$topic_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }
        }

        if ($mode != 'poll_delete')
        {
                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_posts = user_posts $sign
                        WHERE user_id = '$user_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }
        }

/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
    if ($userdata['user_level'] == USER) {
    	$sql = "SELECT ug.user_id, g.group_id as g_id, u.user_posts, g.group_count, g.group_count_max FROM ".USERS_TABLE." u, " . GROUPS_TABLE . " g
    		LEFT JOIN ". USER_GROUP_TABLE." ug ON g.group_id=ug.group_id AND ug.user_id=$user_id
    		WHERE u.user_id=$user_id
    		AND g.group_single_user=0
    		AND g.group_count_enable=1
    		AND g.group_moderator<>$user_id
    		ORDER BY g.group_count_max ASC";
    	if ( !($result = $db->sql_query($sql)) )
    	{
    		message_die(GENERAL_ERROR, 'Error geting users post stat', '', __LINE__, __FILE__, $sql);
    	}
    	while ($group_data = $db->sql_fetchrow($result))
    	{
            $user_already_added = (empty($group_data['user_id'])) ? FALSE : TRUE;
            $user_add = ($group_data['group_count'] == $group_data['user_posts'] && $user_id!=ANONYMOUS) ? TRUE : FALSE;
            $user_remove = ($group_data['group_count'] > $group_data['user_posts'] || $group_data['group_count_max'] < $group_data['user_posts']) ? TRUE : FALSE;
    		if ($user_add && !$user_already_added)
    		{
    			//user join a autogroup
    			$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
    				VALUES (".$group_data['g_id'].", $user_id, '0')";
    			if ( !($db->sql_query($sql)) )
    			{
    				message_die(GENERAL_ERROR, 'Error insert users, group count', '', __LINE__, __FILE__, $sql);
    			}
    			add_group_attributes($user_id, $group_data['g_id']);
    		} else
    		if ( $user_already_added && $user_remove)
    		{
    			//remove user from auto group
    			$sql = "DELETE FROM " . USER_GROUP_TABLE . "
    				WHERE group_id=".$group_data['g_id']."
    				AND user_id=$user_id";
    			if ( !($db->sql_query($sql)) )
    			{
    				message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
    			}
    		}
    	}
    }
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/

        return;
}

//
// Delete a post/poll
//
function delete_post($mode, &$post_data, &$message, &$meta, &$forum_id, &$topic_id, &$post_id, &$poll_id)
{
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    global $cache;
    $cache->delete('TopicData', 'home');
    $cache->delete('AnnounceData', 'home');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        global $board_config, $lang, $db, $phpbb_root_path, $phpEx, $userdata, $user_ip;

        if ($mode != 'poll_delete')
        {
        include("includes/functions_search.php");

                $sql = "DELETE FROM " . POSTS_TABLE . "
                        WHERE post_id = '$post_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . POSTS_TEXT_TABLE . "
                        WHERE post_id = '$post_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                }

                if ($post_data['last_post'])
                {
                        if ($post_data['first_post'])
                        {
                         
                                $forum_update_sql = '';

						        $forum_update_sql .= ', forum_topics = forum_topics - 1';
                                $sql = "DELETE FROM " . TOPICS_TABLE . "
                                        WHERE topic_id = '$topic_id'
                                                OR topic_moved_id = '$topic_id'";
                                if (!$db->sql_query($sql))
                                {
                                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                                }
								
/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
								$sql = "DELETE FROM " . THANKS_TABLE . "
									WHERE topic_id = $topic_id";
								if (!$db->sql_query($sql))
								{
									message_die(GENERAL_ERROR, 'Error in deleting Thanks post Information', '', __LINE__, __FILE__, $sql);
								}
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

                                $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
                                        WHERE topic_id = '$topic_id'";
                                if (!$db->sql_query($sql))
                                {
                                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                                }
                        }
                }

                remove_search_post($post_id);
        }

        if ($mode == 'poll_delete' || ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post']) && $post_data['has_poll'] && $post_data['edit_poll'])
        {
                $sql = "DELETE FROM " . VOTE_DESC_TABLE . "
                        WHERE topic_id = '$topic_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "
                        WHERE vote_id = '$poll_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . VOTE_USERS_TABLE . "
                        WHERE vote_id = '$poll_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
                }
        }

        if ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post'])
        {
                $meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_id) . '">';
                $message = $lang['Deleted'];
        }
        else
        {
                $meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id) . '">';
                $message = (($mode == 'poll_delete') ? $lang['Poll_delete'] : $lang['Deleted']) . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
        }

        $message .=  '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');

        return;
}

//
// Handle user notification on new post
//
function user_notification($mode, &$post_data, &$topic_title, &$forum_id, &$topic_id, &$post_id, &$notify_user)
{
        global $board_config, $lang, $db, $phpbb_root_path, $phpEx, $userdata, $user_ip;

        $current_time = time();

        if ($mode != 'delete')
        {
                if ($mode == 'reply')
                {
                        $sql = "SELECT ban_userid
                                FROM " . BANLIST_TABLE;
                        if (!($result = $db->sql_query($sql)))
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain banlist', '', __LINE__, __FILE__, $sql);
                        }

                        $user_id_sql = '';
                        while ($row = $db->sql_fetchrow($result))
                        {
                                if (isset($row['ban_userid']) && !empty($row['ban_userid']))
                                {
                                        $user_id_sql .= ', ' . $row['ban_userid'];
                                }
                        }
/*****[BEGIN]******************************************
 [ Mod:     Topic Text Reply Email             v1.0.0 ]
 ******************************************************/
                        $sql = "SELECT u.user_id, u.user_email, u.user_lang, pt.post_text, u.username
                                FROM " . TOPICS_WATCH_TABLE . " tw, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
                                WHERE tw.topic_id = '$topic_id'
                                        AND tw.user_id NOT IN (" . $userdata['user_id'] . ", " . ANONYMOUS . $user_id_sql . ")
                                        AND tw.notify_status = " . TOPIC_WATCH_UN_NOTIFIED . "
                                        AND u.user_id = tw.user_id
                                        AND pt.post_id = '$post_id'";

                        $sql_topic = "SELECT u.username,  p.post_attachment
                                      FROM " . USERS_TABLE . " u, " . POSTS_TABLE . " p
                                      WHERE p.post_id = '$post_id'
                                         AND u.user_id = poster_id";
                        if (!($result_topic = $db->sql_query($sql_topic)))
                        {
                                message_die(GENERAL_ERROR, 'Could not get user name', '', __LINE__, __FILE__, $sql_topic);
                        }
                        $row_topic = $db->sql_fetchrow($result_topic);
                        if(!empty($row_topic["post_attachment"]))
                        {
                                $sql_attach = "SELECT ad.physical_filename
                                               FROM ".ATTACHMENTS_TABLE." a, ".ATTACHMENTS_DESC_TABLE." ad
                                               WHERE a.post_id = '$post_id'
                                                  AND a.attach_id = ad.attach_id";
                                if (!($result_attach = $db->sql_query($sql_attach)))
                                {
                                       message_die(GENERAL_ERROR, 'Could not get attachment', '', __LINE__, __FILE__, $sql_attach);
                                }
                                $row_attach = $db->sql_fetchrow($result_attach);
                        }
/*****[END]********************************************
 [ Mod:     Topic Text Reply Email             v1.0.0 ]
 ******************************************************/
                        if (!($result = $db->sql_query($sql)))
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain list of topic watchers', '', __LINE__, __FILE__, $sql);
                        }

                        $update_watched_sql = '';
                        $bcc_list_ary = array();

                        if ($row = $db->sql_fetchrow($result))
                        {
                                //$user_name = $row["username"];
                                $text = $row["post_text"];
                                $poster_name = $row_topic["username"];
                                if(!empty($row_attach[0])) {
                                      $attachment = "The file ".$row_attach[0]." was attached to the post\n\n------------------------------------------------------------------\n";
                                } else {
                                      $attachment ="\n------------------------------------------------------------------\n";
                                }
                                // Sixty second limit
                                set_time_limit(60);

                                do
                                {
                                        if ($row['user_email'] != '')
                                        {
                                                $bcc_list_ary[$row['user_lang']][] = $row['user_email'];
                                        }
                                        $update_watched_sql .= ($update_watched_sql != '') ? ', ' . $row['user_id'] : $row['user_id'];
                                }
                                while ($row = $db->sql_fetchrow($result));

                                //
                                // Let's do some checking to make sure that mass mail functions
                                // are working in win32 versions of php.
                                //
                                if (preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
                                {
                                        $ini_val = (phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';

                                        // We are running on windows, force delivery to use our smtp functions
                                        // since php's are broken by default
                                        $board_config['smtp_delivery'] = 1;
                                        $board_config['smtp_host'] = $ini_val('SMTP');
                                }

                                if (count($bcc_list_ary))
                                {
                                    $script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
                                    $script_name = 'modules.php?name=Forums&file=viewtopic';
                                    $server_name = trim($board_config['server_name']);
                                    $server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
                                    $server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';

                                    $orig_word = array();
                                    $replacement_word = array();
                                    obtain_word_list($orig_word, $replacement_word);

                                    $topic_title = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($topic_title)) : unprepare_message($topic_title);
                                    
									if (isset($bcc_list_ary))
                                    reset($bcc_list_ary);
                                    if (isset($user_name))
									reset($user_name);

                                    $notify_body_pattern    = array(
                                        '{USERNAME}',
                                        '{TOPIC_TITLE}',
                                        '{SITENAME}',
                                        '{U_TOPIC}',
                                        '{REPLY_BY}',
                                        '{CONTENTS}',
                                        '{ATTACHMENT}',
                                        '{U_STOP_WATCHING_TOPIC}',
                                        '{EMAIL_SIG}'
                                    );

                                    $notify_body_replace    = array(
                                        $lang['From'].' '.$board_config['sitename'],
                                        $topic_title,
                                        $board_config['sitename'],
                                        $server_protocol . $server_name . $server_port . $script_name . '&' . POST_POST_URL . "=$post_id#$post_id",
                                        $poster_name,
                                        $text,
                                        $attachment,
                                        $server_protocol . $server_name . $server_port . $script_name . '&' . POST_TOPIC_URL . "=$topic_id&unwatch=topic",
                                        (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : ''
                                    );

                                    $email_data = array(
                                        'email'         => $row['user_email'] ?? '',
                                        'from'          => $board_config['board_email']?? '',
                                        'reply_to'      => $board_config['board_email'] ?? '',
                                        'subject'       => $lang['Topic_reply_notification'] ?? '',
                                        'signature'     => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
                                        'content_type'  => 'text/html',
                                        'charset'       => 'UTF-8',

                                        'username'      => $lang['From'].' '.$board_config['sitename'],
                                        'topic_title'   => $topic_title,
                                        'sitename'      => $board_config['sitename'],
                                        'topic_link'    => $server_protocol . $server_name . $server_port . $script_name . '&' . POST_POST_URL . "=$post_id#$post_id",
                                        'reply_by'      => $poster_name ?? '',
                                        'contents'      => $text ?? '',
                                        'attachment'    => $attachment ?? '',
                                        'stop_watching' => $server_protocol . $server_name . $server_port . $script_name . '&' . POST_TOPIC_URL . "=$topic_id&unwatch=topic",
                                        'signature'     => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : ''
                                    );

                                    $content = str_replace( '{USERNAME}', $email_data['username'], $lang['topic_notify'] );
                                    $content = str_replace( '{TOPIC_TITLE}', $email_data['topic_title'], $content );
                                    $content = str_replace( '{SITENAME}', $email_data['sitename'], $content );
                                    $content = str_replace( '{U_TOPIC}', '<a href="'.$email_data['topic_link'].'">'.$email_data['topic_link'].'</a>', $content );
                                    $content = str_replace( '{REPLY_BY}', $email_data['reply_by'], $content );
                                    $content = str_replace( '{CONTENTS}', $email_data['contents'], $content );
                                    $content = str_replace( '{ATTACHMENT}', $email_data['attachment'], $content );
                                    $content = str_replace( '{U_STOP_WATCHING_TOPIC}', '<a href="'.$email_data['stop_watching'].'">'.$email_data['stop_watching'].'</a>', $content );
                                    $content = str_replace( '{EMAIL_SIG}', $email_data['signature'], $content );

									foreach ($bcc_list_ary as $user_lang => $bcc_list)
                                    {
                                        $name_list = $user_name[$user_lang] ?? '';
                                        $headers[] = 'From: '.$email_data['from'];
                                        for ($i = 0; $i < count($bcc_list); $i++):
                                            $headers[] = 'Bcc: '.$bcc_list[$i];
                                            $addbcc[] = $bcc_list[$i];
                                        endfor;

                                        $headers[] = 'Reply-To: '.$email_data['reply_to'];
                                        $headers[] = 'Content-Type: '.$email_data['content_type'].'; charset='.$email_data['charset'];
                                        phpmailer( $addbcc, $email_data['subject'], $content, $headers );
                                    }
                                }
                        }
                        $db->sql_freeresult($result);

                        if ($update_watched_sql != '')
                        {
                                $sql = "UPDATE " . TOPICS_WATCH_TABLE . "
                                        SET notify_status = " . TOPIC_WATCH_NOTIFIED . "
                                        WHERE topic_id = '$topic_id'
                                                AND user_id IN ($update_watched_sql)";
                                $db->sql_query($sql);
                        }
                }

                $sql = "SELECT topic_id
                        FROM " . TOPICS_WATCH_TABLE . "
                        WHERE topic_id = '$topic_id'
                                AND user_id = " . $userdata['user_id'];
                if (!($result = $db->sql_query($sql)))
                {
                        message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
                }

                $row = $db->sql_fetchrow($result);

                if (!$notify_user && !empty($row['topic_id']))
                {
                        $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
                                WHERE topic_id = '$topic_id'
                                        AND user_id = " . $userdata['user_id'];
                        if (!$db->sql_query($sql))
                        {
                                message_die(GENERAL_ERROR, 'Could not delete topic watch information', '', __LINE__, __FILE__, $sql);
                        }
                }
                else if ($notify_user && empty($row['topic_id']))
                {
                        $sql = "INSERT INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
                                VALUES (" . $userdata['user_id'] . ", '$topic_id', '0')";
                        if (!$db->sql_query($sql))
                        {
                                message_die(GENERAL_ERROR, 'Could not insert topic watch information', '', __LINE__, __FILE__, $sql);
                        }
                }
        }
}

//
// Fill smiley templates (or just the variables) with smileys
// Either in a window or inline
//
function generate_smilies($mode, $page_id)
{
        global $db, $board_config, $template, $lang, $images, $theme, $phpEx, $phpbb_root_path, $user_ip, $session_length, $starttime, $userdata;

        $inline_columns = 4;
        $inline_rows = 5;
        $window_columns = 8;

        if ($mode == 'window')
        {
                $userdata = session_pagestart($user_ip, $page_id);
                init_userprefs($userdata);

                $gen_simple_header = TRUE;

                $page_title = $lang['Emoticons'];
        if ( defined('IN_ADMIN') )
        {
            include("./page_header_admin.php");
        }
        else
        {
                include("includes/page_header_review.php");
        }

                $template->set_filenames(array(
                        'smiliesbody' => 'posting_smilies.tpl')
                );
        }

        $sql = "SELECT emoticon, code, smile_url
                FROM " . SMILIES_TABLE . "
                ORDER BY smilies_id";
        if ($result = $db->sql_query($sql))
        {
                $num_smilies = 0;
                $rowset = array();
                while ($row = $db->sql_fetchrow($result))
                {
                        if (empty($rowset[$row['smile_url']]))
                        {
                                $rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
                                $rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
                                $num_smilies++;
                        }
                }
                $db->sql_freeresult($result);

                if ($num_smilies)
                {
                        $smilies_count = ($mode == 'inline') ? min(19, $num_smilies) : $num_smilies;
                        $smilies_split_row = ($mode == 'inline') ? $inline_columns - 1 : $window_columns - 1;

                        $s_colspan = 0;
                        $row = 0;
                        $col = 0;

                        if(!isset($lang['Emoticons']))
                        $lang['Emoticons'] = 'Emoticons';
				        						
						foreach ($rowset as $smile_url => $data)
                        {
                                if (!$col)
                                {
                                        $template->assign_block_vars('smilies_row', array());
                                }

                                $template->assign_block_vars('smilies_row.smilies_col', array(
                                        'SMILEY_CODE' => $data['code'],
                                        'SMILEY_IMG' => $board_config['smilies_path'] . '/' . $smile_url,
                                        'SMILEY_DESC' => $data['emoticon'])
                                );

                                $s_colspan = max($s_colspan, $col + 1);

                                if ($col == $smilies_split_row)
                                {
                                        if ($mode == 'inline' && $row == $inline_rows - 1)
                                        {
                                                break;
                                        }
                                        $col = 0;
                                        $row++;
                                }
                                else
                                {
                                        $col++;
                                }
                        }

                        if ($mode == 'inline' && $num_smilies > $inline_rows * $inline_columns)
                        {
                                $template->assign_block_vars('switch_smilies_extra', array());

                                $template->assign_vars(array(
                                        'L_MORE_SMILIES' => $lang['More_emoticons'],
                                        'U_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies&popup=1"))
                                );
                        }

                        $template->assign_vars(array(
                                'L_EMOTICONS' => $lang['Emoticons'],
                                'L_CLOSE_WINDOW' => $lang['Close_window'],
                                'S_SMILIES_COLSPAN' => $s_colspan)
                        );
                }
        }

        if ($mode == 'window')
        {
                $template->pparse('smiliesbody');

                include("includes/page_tail_review.php");
        }
}

/*****[BEGIN]******************************************
 [ Mod:     Allow multiple spaces in posts     v1.0.0 ]
 ******************************************************/
function replace_double_spaces($message)
{
    // setup find/replace vars
    $nbsp_match = '/  /';
    $nbsp_replace = ' &nbsp;';

    // replace all instances of double-spaces with a single space + &nbsp;
    $message = preg_replace($nbsp_match, $nbsp_replace, $message);

    return $message;
}
/*****[END]********************************************
 [ Mod:     Allow multiple spaces in posts     v1.0.0 ]
 ******************************************************/

/**
* Called from within prepare_message to clean included HTML tags if HTML is
* turned on for that post
* @param array $tag Matching text from the message to parse
*/
function clean_html($tag)
{
	global $board_config;

	if (empty($tag[0]))
	{
		return '';
	}

	$allowed_html_tags = preg_split('/, */', strtolower($board_config['allow_html_tags']));
	$disallowed_attributes = '/^(?:style|on)/i';

	// Check if this is an end tag
	preg_match('/<[^\w\/]*\/[\W]*(\w+)/', $tag[0], $matches);
	if (sizeof($matches))
	{
		if (in_array(strtolower($matches[1]), $allowed_html_tags))
		{
			return  '</' . $matches[1] . '>';
		}
		else
		{
			return  htmlspecialchars('</' . $matches[1] . '>');
		}
	}

	// Check if this is an allowed tag
	if (in_array(strtolower($tag[1]), $allowed_html_tags))
	{
		$attributes = '';
		if (!empty($tag[2]))
		{
			preg_match_all('/[\W]*?(\w+)[\W]*?=[\W]*?(["\'])((?:(?!\2).)*)\2/', $tag[2], $test);
			for ($i = 0; $i < sizeof($test[0]); $i++)
			{
				if (preg_match($disallowed_attributes, $test[1][$i]))
				{
					continue;
				}
				$attributes .= ' ' . $test[1][$i] . '=' . $test[2][$i] . str_replace(array('[', ']'), array('&#91;', '&#93;'), htmlspecialchars($test[3][$i])) . $test[2][$i];
			}
		}
		if (in_array(strtolower($tag[1]), $allowed_html_tags))
		{
			return '<' . $tag[1] . $attributes . '>';
		}
		else
		{
			return htmlspecialchars('<' . $tag[1] . $attributes . '>');
		}
	}
	// Finally, this is not an allowed tag so strip all the attibutes and escape it
	else
	{
		return htmlspecialchars('<' .   $tag[1] . '>');
	}
}

?>