<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                              topic_review.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: topic_review.php,v 1.5.2.3 2004/11/18 17:49:45 acydburn Exp
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
      Attachment Mod                           v2.4.1       07/20/2005
      Force Word Wrapping                      v1.0.16      06/15/2005
      Advanced Username Color                  v1.0.5       07/19/2005
      Smilies in Topic Titles                  v1.0.0       07/19/2005
      Extended Quote Tag                       v1.0.0       08/17/2005
      Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
	  Hide BBCode                              v1.2.0
	  Post Icons                               v1.0.1
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

function topic_review($topic_id, $is_inline_review)
{
        global $db, $board_config, $template, $lang, $images, $theme, $phpEx, $phpbb_root_path, $userdata, $user_ip, $orig_word, $replacement_word, $starttime;
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
		global $icones;
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

        if ( !$is_inline_review )
        {
            if ( !isset($topic_id) || !$topic_id)
            {
                message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
            }

                //
                // Get topic info ...
                //
                $sql = "SELECT t.topic_title, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments
                        FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f
                        WHERE t.topic_id = '$topic_id'
                                AND f.forum_id = t.forum_id";
/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                $tmp = '';
                attach_setup_viewtopic_auth($tmp, $sql);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
                }

                if ( !($forum_row = $db->sql_fetchrow($result)) )
                {
                        message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
                }
                $db->sql_freeresult($result);

                $forum_id = $forum_row['forum_id'];
                $topic_title = $forum_row['topic_title'];

                //
                // Start session management
                //
                $userdata = session_pagestart($user_ip, $forum_id);
                init_userprefs($userdata);
                //
                // End session management
                //

                $is_auth = array();
                $is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

                if ( !$is_auth['auth_read'] )
                {
                        message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']));
                }
        }

        //
        // Define censored word matches
        //
        if ( empty($orig_word) && empty($replacement_word) )
        {
                $orig_word = array();
                $replacement_word = array();

                obtain_word_list($orig_word, $replacement_word);
        }

        //
        // Dump out the page header and load viewtopic body template
        //
        if ( !$is_inline_review )
        {
                $gen_simple_header = TRUE;

                $page_title = $lang['Topic_review'] . ' - ' . $topic_title;
                include("includes/page_header_review.php");

                $template->set_filenames(array(
                        'reviewbody' => 'posting_topic_review.tpl')
                );
        }

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
        if(!isset($is_auth))
        $is_auth = 0;
		init_display_review_attachments($is_auth);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
        //
        // Go ahead and pull all data for this topic
        //
        $sql = "SELECT u.username, u.user_id, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
                FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
                WHERE p.topic_id = '$topic_id'
                        AND p.poster_id = u.user_id
                        AND p.post_id = pt.post_id
                ORDER BY p.post_time DESC
                LIMIT " . $board_config['posts_per_page'];
        if ( !($result = $db->sql_query($sql,false)) )
        {
                message_die(GENERAL_ERROR, 'Could not obtain post/user information', '', __LINE__, __FILE__, $sql);
        }

        /*--FNA #1--*/

        //
        // Okay, let's do the loop, yeah come on baby let's do the loop
        // and it goes like this ...
        //
        
        $row = $db->sql_fetchrow($result,SQL_BOTH);
        if ( $row )
        {
/*****[BEGIN]******************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/
				$valid = FALSE;
				if( $userdata['session_logged_in'] ) 
				{
					$sql = "SELECT p.poster_id, p.topic_id
						FROM " . POSTS_TABLE . " p
						WHERE p.topic_id = $topic_id
						AND p.poster_id = " . $userdata['user_id'];
					$resultat = $db->sql_query($sql);
					$valid = $db->sql_numrows($resultat) ? TRUE : FALSE;
				}
/*****[END]********************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/
                $mini_post_img = $images['icon_minipost'];
                $mini_post_alt = $lang['Post'];

                $i = 0;
                do
                {
                        $poster_id = $row['user_id'];
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
                        $plain_poster = $row['username'];
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
                        $poster = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        $post_date = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);

                        //
                        // Handle anon users posting with usernames
                        //
                        if( $poster_id == ANONYMOUS && $row['post_username'] != '' )
                        {
                                $poster = $row['post_username'];
                                $poster_rank = $lang['Guest'];
                        }
                        elseif ( $poster_id == ANONYMOUS )
                        {
                                $poster = $lang['Guest'];
                                $poster_rank = '';
                        }

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
 if ($board_config['smilies_in_titles'])
            {
                        $post_subject = ( $row['post_subject'] != '' ) ? smilies_pass($row['post_subject']) : '';
            } else {
                        $post_subject = ( $row['post_subject'] != '' ) ? $row['post_subject'] : '';
            }
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 ******************************************************/

                        $message = $row['post_text'];
                        $bbcode_uid = $row['bbcode_uid'];

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
            $plain_message = $row['post_text'];
            $plain_message = preg_replace('/\:(([a-z0-9]:)?)' . $bbcode_uid . '/s', '', $plain_message);
            $plain_message = str_replace('<', '&lt;', $plain_message);
            $plain_message = str_replace('>', '&gt;', $plain_message);
            $plain_message = str_replace('<br />', "\n", $plain_message);

            $orig_word = array();
            $replacement_word = array();
            obtain_word_list($orig_word, $replace_word);

            if ( !empty($orig_word) )
            {
                $plain_message = ( !empty($plain_message) ) ? preg_replace($orig_word, $replace_word, $plain_message) : '';
            }
            $plain_message = addslashes($plain_message);
            $plain_message = str_replace("\n", "\\n", $plain_message);
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

                        //
                        // If the board has HTML off but the post has HTML
                        // on then we process it, else leave it alone
                        //
                        if ( !$board_config['allow_html'] && $row['enable_html'] )
                        {
                                $message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $message);
                        }

/*****[BEGIN]******************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/
						if ( $bbcode_uid != "" )
						{
								$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
								$message = bbencode_third_pass($message, $bbcode_uid, $valid);
						}
/*****[END]********************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/

                        $message = make_clickable($message);

                        if ( count($orig_word) )
                        {
                                $post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
                                $message = preg_replace($orig_word, $replacement_word, $message);
                        }

                        if ( $board_config['allow_smilies'] && $row['enable_smilies'] )
                        {
                                $message = smilies_pass($message);
                        }

/*****[BEGIN]******************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/
                        $message = word_wrap_pass($message);
/*****[END]********************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/

                        $message = str_replace("\n", '<br />', $message);
						
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
						$post_subject = get_icon_title($row['post_icon']) . '&nbsp;' . $post_subject;
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

                        //
                        // Again this will be handled by the templating
                        // code at some point
                        //
                        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                        /*--FNA #2--*/

                        $template->assign_block_vars('postrow', array(
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,

                                'MINI_POST_IMG' => $mini_post_img,
                                'POSTER_NAME' => $poster,
                                'POST_DATE' => $post_date,
                                'POST_SUBJECT' => $post_subject,
                                'MESSAGE' => $message,

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
                                'U_POST_ID' => $row['post_id'],
                                'PLAIN_MESSAGE' => str_replace(chr(13), '', $plain_message),
                                'EXT_POSTER_NAME' => $plain_poster,
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

                                'L_MINI_POST_ALT' => $mini_post_alt)
                        );

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
                        display_review_attachments($row['post_id'], $row['post_attachment'], $is_auth);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

                        $i++;
                }
                while ( $row = $db->sql_fetchrow($result) );
        }
        else
        {
                message_die(GENERAL_MESSAGE, 'Topic_post_not_exist', '', __LINE__, __FILE__, $sql);
        }
    $db->sql_freeresult($result);

        $template->assign_vars(array(
                'L_AUTHOR' => $lang['Author'],
                'L_MESSAGE' => $lang['Message'],
                'L_POSTED' => $lang['Posted'],
                'L_POST_SUBJECT' => $lang['Post_subject'],
                'L_TOPIC_REVIEW' => $lang['Topic_review'])
        );

        if ( !$is_inline_review )
        {
                $template->pparse('reviewbody');
                include("includes/page_tail_review.php");
        }
}

?>