<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                posting.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: posting.php,v 1.159.2.23 2005/05/06 20:50:10 acydburn Exp
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
	  Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
	  Attachment Mod                           v2.4.1       07/20/2005
	  Global Announcements                     v1.2.8       06/13/2005
	  Smilies in Topic Titles                  v1.0.0       06/14/2005
	  Force Word Wrapping                      v1.0.16      06/15/2005
	  View Topic Name While Posting            v1.0.5       06/15/2005
	  Lock/Unlock in Posting Body              v1.0.1       06/17/2005
	  Automatic Subject on Reply               v1.0.0       06/17/2005
	  Admin Voting                             v1.1.8       07/24/2005
	  Advance Signature Divider Control        v1.0.0       07/24/2005
	  Must first vote to see results           v1.0.0       08/03/2005
	  Log Moderator Actions                    v1.1.6       08/06/2005
	  Extended Quote Tag                       v1.0.0       08/17/2005
	  At a Glance Cement                       v1.0.0       08/17/2005
	  At a Glance Submit                       v1.0.0       08/17/2005
	  Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
	  Time & Date in Quote                     v1.0.0
	  Hide BBCode                              v1.2.0
	  Thank You Mod                            v1.1.8
	  Post Icons                               v1.0.1
	  XtraColors                               v1.0.0       05/26/2009
 ************************************************************************/



if (!defined('MODULE_FILE')) {

   die ("You can't access this file directly...");

}



if ($popup != "1"){

	$pnt_module = basename(dirname(__FILE__));

	require("modules/".$pnt_module."/nukebb.php");

	}

	else

	{

	$phpbb2_root_path = NUKE_FORUMS_DIR;

}



define('IN_PHPBB2', true);

include($phpbb2_root_path . 'extension.inc');

include($phpbb2_root_path . 'common.'.$phpEx);

include_once("includes/bbcode.php");

include("includes/functions_post.php");

/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
include($phpbb2_root_path . 'reputation_common.'.$phpEx);
include('includes/functions_reputation.'.$phpEx);
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
include('includes/posting_icons.'.$phpEx);
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
include("includes/functions_log.php");
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

//
// Check and set various parameters
//
$post_id	= request_var('p', 0);
$topic_id	= request_var('t', 0);
$phpbb2_forum_id	= request_var('f', 0);

$submit		= (isset($_POST['post'])) ? true : false;
$preview		= (isset($_POST['preview'])) ? true : false;
$delete		= (isset($_POST['delete'])) ? true : false;
$poll_delete		= (isset($_POST['poll_delete'])) ? true : false;
$poll_add		= (isset($_POST['add_poll_option'])) ? true : false;
$poll_edit		= (isset($_POST['edit_poll_option'])) ? true : false;
$confirm = isset($_POST['confirm']) ? true : false;
$sid = (isset($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : 0;

$refresh = $preview || $poll_add || $poll_edit || $poll_delete;

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
$post_icon = isset($HTTP_POST_VARS['post_icon']) ? intval($HTTP_POST_VARS['post_icon']) : 0;
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
$mode      = ($delete && !$preview && !$refresh && $submit) ? 'delete' : request_var('mode', '');
$orig_word = $replacement_word = array();

//
// Set topic type
//
$topic_type = ( !empty($HTTP_POST_VARS['topictype']) ) ? intval($HTTP_POST_VARS['topictype']) : POST_NORMAL;
$topic_type = ( in_array($topic_type, array(POST_NORMAL, POST_STICKY, POST_ANNOUNCE, POST_GLOBAL_ANNOUNCE)) ) ? $topic_type : POST_NORMAL;

//
// If the mode is set to topic review then output
// that review ...
//
if ( $mode == 'topicreview' )
{
	require("includes/topic_review.$phpEx");
	topic_review($topic_id, false);
	exit;
}
else if ( $mode == 'smilies' )
{
	generate_smilies('window', PAGE_POSTING);
	exit;
}

//
// Start session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_POSTING);
titanium_init_userprefs($userdata);
//
// End session management
//

//
// Was cancel pressed? If so then redirect to the appropriate
// page, no point in continuing with any further checks
//
if ( isset($HTTP_POST_VARS['cancel']) )
{
	if ( $post_id )
	{
			$redirect = "viewtopic.$phpEx?" . POST_POST_URL . "=$post_id";
			$post_append = "#$post_id";
	}
	else if ( $topic_id )
	{
			$redirect = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id";
			$post_append = '';
	}
	else if ( $phpbb2_forum_id )
	{
			$redirect = "viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id";
			$post_append = '';
	}
	else
	{
			$redirect = "index.$phpEx";
			$post_append = '';
	}
	redirect_titanium(append_titanium_sid($redirect, true) . $post_append);
	exit;
}

//
// What auth type do we need to check?
//
$phpbb2_is_auth = array();
switch( $mode )
{
	case 'newtopic':
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
******************************************************/
		if ( $topic_type == POST_GLOBAL_ANNOUNCE )
		{
		   $phpbb2_is_auth_type = 'auth_globalannounce';
		} else
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
******************************************************/
		if ( $topic_type == POST_ANNOUNCE )
		{
				$phpbb2_is_auth_type = 'auth_announce';
		}
		else if ( $topic_type == POST_STICKY )
		{
				$phpbb2_is_auth_type = 'auth_sticky';
		}
		else
		{
				$phpbb2_is_auth_type = 'auth_post';
		}
		break;

	case 'reply':
	case 'quote':
			$phpbb2_is_auth_type = 'auth_reply';
			break;

	case 'editpost':
			$phpbb2_is_auth_type = 'auth_edit';
			break;

	case 'delete':
	case 'poll_delete':
			$phpbb2_is_auth_type = 'auth_delete';
			break;

	case 'vote':
			$phpbb2_is_auth_type = 'auth_vote';
			break;

	case 'topicreview':
			$phpbb2_is_auth_type = 'auth_read';
			break;

/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
	case 'thank':
			$phpbb2_is_auth_type = 'auth_read';
			break;
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

	default:
		message_die(GENERAL_MESSAGE, $lang['No_post_mode']);
		break;

}



//

// Here we do various lookups to find topic_id, forum_id, post_id etc.

// Doing it here prevents spoofing (eg. faking forum_id, topic_id or post_id

//

$error_msg = '';

$post_data = array();

switch ( $mode )

{

		case 'newtopic':

				if ( empty($phpbb2_forum_id) )

				{

						message_die(GENERAL_MESSAGE, $lang['Forum_not_exist']);

				}



				$sql = "SELECT *

						FROM " . FORUMS_TABLE . "

						WHERE forum_id = '$phpbb2_forum_id'";

				break;

/*****[BEGIN]******************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/

		case 'thank':

/*****[END]********************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/

		case 'reply':

		case 'vote':

				if ( empty( $topic_id) )

				{

						message_die(GENERAL_MESSAGE, $lang['No_topic_id']);

				}



				$sql = "SELECT f.*, t.topic_status, t.topic_title, t.topic_type

						FROM (" . FORUMS_TABLE . " f, " . TOPICS_TABLE . " t)

						WHERE t.topic_id = '$topic_id'

								AND f.forum_id = t.forum_id";

				break;



		case 'quote':

		case 'editpost':

		case 'delete':

		case 'poll_delete':

				if ( empty($post_id) )

				{

						message_die(GENERAL_MESSAGE, $lang['No_post_id']);

				}	

/*****[BEGIN]******************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/			

				$select_sql = ( !$submit ) ? ", t.topic_title, t.topic_icon, p.enable_bbcode, p.enable_html, p.enable_smilies, p.enable_sig, p.post_username, p.post_time, pt.post_subject, p.post_icon, pt.post_text, pt.bbcode_uid, u.username, u.user_id, u.user_sig" : '';

/*****[END]********************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/

				$from_sql = ( !$submit ) ? ", " . POSTS_TEXT_TABLE . " pt, " . USERS_TABLE . " u" : '';

				$where_sql = ( !$submit ) ? "AND pt.post_id = p.post_id AND u.user_id = p.poster_id" : '';

/*****[BEGIN]******************************************

 [ Mod:      At a Glance Submit                v1.0.0 ]

 ******************************************************/

				$sql = "SELECT f.*, t.topic_id, t.topic_status, t.topic_glance_priority, t.topic_type, t.topic_first_post_id, t.topic_last_post_id, t.topic_vote, p.post_id, p.poster_id" . $select_sql . "

						FROM (" . POSTS_TABLE . " p, " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $from_sql . ")

						WHERE p.post_id = '$post_id'

								AND t.topic_id = p.topic_id

								AND f.forum_id = p.forum_id

								$where_sql";

/*****[END]********************************************

 [ Mod:      At a Glance Submit                v1.0.0 ]

 ******************************************************/

				break;



		default:

				message_die(GENERAL_MESSAGE, $lang['No_valid_mode']);

}



if ( ($result = $titanium_db->sql_query($sql)) && ($post_info = $titanium_db->sql_fetchrow($result)) )

{

		$titanium_db->sql_freeresult($result);



		$phpbb2_forum_id = $post_info['forum_id'];

		$forum_name = $post_info['forum_name'];

/*****[BEGIN]******************************************

 [ Mod:     View Topic Name While Posting      v1.0.5 ]

 [ Mod:     Smilies in Topic Titles            v1.0.0 ]

 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]

 ******************************************************/

		$topic_title = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($post_info['topic_title']) : $post_info['topic_title'];

/*****[END]********************************************

 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]

 [ Mod:     Smilies in Topic Titles            v1.0.0 ]

 [ Mod:     View Topic Name While Posting      v1.0.5 ]

 ******************************************************/



		$phpbb2_is_auth = auth(AUTH_ALL, $phpbb2_forum_id, $userdata, $post_info);



/*****[BEGIN]******************************************

 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]

 ******************************************************/

		$lock = ( isset($HTTP_POST_VARS['lock']) ) ? TRUE : FALSE;

		$unlock = ( isset($HTTP_POST_VARS['unlock']) ) ? TRUE : FALSE;



		if ( ($submit || $confirm) && ($lock || $unlock) && ($phpbb2_is_auth['auth_mod']) && ($mode != 'newtopic') && (!$refresh) )

		{

			$t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];



			if ( $unlock )

			{

/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

				log_action($lang['Unlock'], '', $t_id, $userdata['user_id'], '', '');

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

				$sql = "UPDATE " . TOPICS_TABLE . "

				SET topic_status = " . TOPIC_UNLOCKED . "

				WHERE topic_id = " . $t_id . "

				AND topic_moved_id = 0";

			}

			else if ($lock)

			{

/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

				log_action($lang['Lock'], '', $t_id, $userdata['user_id'], '', '');

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

				$sql = "UPDATE " . TOPICS_TABLE . "

				SET topic_status = " . TOPIC_LOCKED . "

				WHERE topic_id = " . $t_id . "

				AND topic_moved_id = 0";

			}



			if ($lock || $unlock)

			{

				if ( !($result = $titanium_db->sql_query($sql)) )

				{

					message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);

				}

			}

		}

/*****[END]********************************************

 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]

 ******************************************************/



		if ( $post_info['forum_status'] == FORUM_LOCKED && !$phpbb2_is_auth['auth_mod'])

		{

		   message_die(GENERAL_MESSAGE, $lang['Forum_locked']);

		}

		else if ( $mode != 'newtopic' && $mode != 'thank' && $post_info['topic_status'] == TOPIC_LOCKED && !$phpbb2_is_auth['auth_mod'])

		{

		   message_die(GENERAL_MESSAGE, $lang['Topic_locked']);

		}



		if ( $mode == 'editpost' || $mode == 'delete' || $mode == 'poll_delete' )

		{

				$topic_id = $post_info['topic_id'];



				$post_data['poster_post'] = ( $post_info['poster_id'] == $userdata['user_id'] ) ? true : false;

				$post_data['first_post'] = ( $post_info['topic_first_post_id'] == $post_id ) ? true : false;

				$post_data['last_post'] = ( $post_info['topic_last_post_id'] == $post_id ) ? true : false;

				$post_data['last_topic'] = ( $post_info['forum_last_post_id'] == $post_id ) ? true : false;

				$post_data['has_poll'] = ( $post_info['topic_vote'] ) ? true : false;

				$post_data['topic_type'] = $post_info['topic_type'];

/*****[BEGIN]******************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/

				$post_data['post_icon'] = $post_info['post_icon'];

/*****[END]********************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/

				$post_data['poster_id'] = $post_info['poster_id'];



				if ( $post_data['first_post'] && $post_data['has_poll'] )

				{

						$sql = "SELECT *

								FROM (" . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr)

								WHERE vd.topic_id = '$topic_id'

										AND vr.vote_id = vd.vote_id

								ORDER BY vr.vote_option_id";

						if ( !($result = $titanium_db->sql_query($sql)) )

						{

								message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);

						}



						$poll_options = array();

						$poll_results_sum = 0;

						if ( $row = $titanium_db->sql_fetchrow($result) )

						{

								$poll_title = $row['vote_text'];

								$poll_id = $row['vote_id'];

								$poll_length = $row['vote_length'] / 86400;

/*****[BEGIN]******************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

								 $poll_view_toggle = $row['poll_view_toggle'];

/*****[END]********************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

								do

								{

										$poll_options[$row['vote_option_id']] = $row['vote_option_text'];

										$poll_results_sum += $row['vote_result'];

								}

								while ( $row = $titanium_db->sql_fetchrow($result) );

						}

						$titanium_db->sql_freeresult($result);



						$post_data['edit_poll'] = ( ( !$poll_results_sum || $phpbb2_is_auth['auth_mod'] ) && $post_data['first_post'] ) ? true : 0;

				}

				else

				{

						$post_data['edit_poll'] = ($post_data['first_post'] && $phpbb2_is_auth['auth_pollcreate']) ? true : false;

				}



				//

				// Can this user edit/delete the post/poll?

				//

				if ( $post_info['poster_id'] != $userdata['user_id'] && !$phpbb2_is_auth['auth_mod'] )

				{

						$message = ( $delete || $mode == 'delete' ) ? $lang['Delete_own_posts'] : $lang['Edit_own_posts'];

						$message .= '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');



						message_die(GENERAL_MESSAGE, $message);

				}

				else if ( !$post_data['last_post'] && !$phpbb2_is_auth['auth_mod'] && ( $mode == 'delete' || $delete ) )

				{

						message_die(GENERAL_MESSAGE, $lang['Cannot_delete_replied']);

				}

				else if ( !$post_data['edit_poll'] && !$phpbb2_is_auth['auth_mod'] && ( $mode == 'poll_delete' || $poll_delete ) )

				{

						message_die(GENERAL_MESSAGE, $lang['Cannot_delete_poll']);

				}

		}

		else

		{

				if ( $mode == 'quote' )

				{

						$topic_id = $post_info['topic_id'];

				}

		if ( $mode == 'newtopic' )

		{

			$post_data['topic_type'] = POST_NORMAL;

		}



				$post_data['first_post'] = ( $mode == 'newtopic' ) ? true : 0;

				$post_data['last_post'] = false;

				$post_data['has_poll'] = false;

				$post_data['edit_poll'] = false;

		}

	if ( $mode == 'poll_delete' && !isset($poll_id) )

	{

		message_die(GENERAL_MESSAGE, $lang['No_such_post']);

	}

		/*--FNA #1--*/

}

else

{

		message_die(GENERAL_MESSAGE, $lang['No_such_post']);

}



//

// The user is not authed, if they're not logged in then redirect

// them, else show them an error message

//

if ( !$phpbb2_is_auth[$phpbb2_is_auth_type] )

{

		if ( $userdata['session_logged_in'] )

		{

				message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_' . $phpbb2_is_auth_type], $phpbb2_is_auth[$phpbb2_is_auth_type . "_type"]));

		}



		switch( $mode )

		{

				case 'newtopic':

						$redirect = "mode=newtopic&" . POST_FORUM_URL . "=" . $phpbb2_forum_id;

						break;

/*****[BEGIN]******************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/

				case 'thank':

/*****[END]********************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/

				case 'reply':

				case 'topicreview':

						$redirect = "mode=reply&" . POST_TOPIC_URL . "=" . $topic_id;

						break;

				case 'quote':

				case 'editpost':

						$redirect = "mode=quote&" . POST_POST_URL ."=" . $post_id;

						break;

		}



		// not needed anymore due to function redirect_titanium()

//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';

		redirect_titanium(append_titanium_sid("login.$phpEx?redirect=posting.$phpEx&" . $redirect, true));

		exit;

}

/*****[BEGIN]******************************************
 [ Mod:    Password Protect Forums             v0.5.1 ]
 ******************************************************/
if( !$phpbb2_is_auth['auth_mod'] && $userdata['user_level'] != ADMIN )
{
	$redirect = str_replace("&amp;", "&", preg_replace('#.*?([a-z]+?\.' . $phpEx . '.*?)$#i', '\1', htmlspecialchars($HTTP_SERVER_VARS['REQUEST_URI'])));
	if( $HTTP_POST_VARS['cancel'] )
	{
		redirect_titanium(append_titanium_sid("index.$phpEx"));
	}
	else if( $HTTP_POST_VARS['pass_login'] )
	{
		if( $post_info['topic_password'] != '' )
		{
			password_check('topic', $topic_id, $HTTP_POST_VARS['password'], $redirect);
		}
		else if( $post_info['forum_password'] != '' )
		{
			password_check('forum', $phpbb2_forum_id, $HTTP_POST_VARS['password'], $redirect);
		}
	}

	if( $post_info['topic_password'] != '' && $mode != 'newtopic' )
	{
		$passdata = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_tpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_tpass'])) : '';
		if( $passdata[$topic_id] != md5($post_info['topic_password']) )
		{
			password_box('topic', $redirect);
		}
	}
	else if( $post_info['forum_password'] != '' )
	{
		$passdata = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_fpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_fpass'])) : '';
		if( $passdata[$phpbb2_forum_id] != md5($post_info['forum_password']) )
		{
			password_box('forum', $redirect);
		}
	}
}
/*****[END]********************************************
 [ Mod:    Password Protect Forums             v0.5.1 ]
 ******************************************************/

//
// Set toggles for various options
//

if ( !$phpbb2_board_config['allow_html'] )

{

		$html_on = 0;

}

else

{

		$html_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_html']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $phpbb2_board_config['allow_html'] : $userdata['user_allowhtml'] );

}



if ( !$phpbb2_board_config['allow_bbcode'] )

{

		$bbcode_on = 0;

}

else

{

		$bbcode_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_bbcode']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $phpbb2_board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );

}



if ( !$phpbb2_board_config['allow_smilies'] )

{

		$smilies_on = 0;

}

else

{

		$smilies_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_smilies']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $phpbb2_board_config['allow_smilies'] : $userdata['user_allowsmile'] );

}



if ( ($submit || $refresh) && $phpbb2_is_auth['auth_read'])

{

		$notify_user = ( !empty($HTTP_POST_VARS['notify']) ) ? TRUE : 0;

}

else

{

		if ( $mode != 'newtopic' && $userdata['session_logged_in'] && $phpbb2_is_auth['auth_read'] )

		{

				$sql = "SELECT topic_id

						FROM " . TOPICS_WATCH_TABLE . "

						WHERE topic_id = '$topic_id'

								AND user_id = " . $userdata['user_id'];

				if ( !($result = $titanium_db->sql_query($sql)) )

				{

						message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);

				}



				$notify_user = ( $titanium_db->sql_fetchrow($result) ) ? TRUE : $userdata['user_notify'];

		$titanium_db->sql_freeresult($result);

		}

		else

		{

				$notify_user = ( $userdata['session_logged_in'] && $phpbb2_is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;

		}

}



$attach_sig = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['attach_sig']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_attachsig'] );



/*****[BEGIN]******************************************

 [ Mod:    Attachment Mod                      v2.4.1 ]

 ******************************************************/

execute_posting_attachment_handling();

/*****[END]********************************************

 [ Mod:    Attachment Mod                      v2.4.1 ]

 ******************************************************/



// --------------------

//  What shall we do?

//



/*--FNA #2--*/



if ( ( $delete || $poll_delete || $mode == 'delete' ) && !$confirm )

{

		//

		// Confirm deletion

		//

		$s_hidden_fields = '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';

		$s_hidden_fields .= ( $delete || $mode == "delete" ) ? '<input type="hidden" name="mode" value="delete" />' : '<input type="hidden" name="mode" value="poll_delete" />';

		$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';



		$l_confirm = ( $delete || $mode == 'delete' ) ? $lang['Confirm_delete'] : $lang['Confirm_delete_poll'];



		//

		// Output confirmation page

		//

		include("includes/page_header.php");



		$phpbb2_template->set_filenames(array(

				'confirm_body' => 'confirm_body.tpl')

		);



		$phpbb2_template->assign_vars(array(

				'MESSAGE_TITLE' => $lang['Information'],

				'MESSAGE_TEXT' => $l_confirm,



				'L_YES' => $lang['Yes'],

				'L_NO' => $lang['No'],



				'S_CONFIRM_ACTION' => append_titanium_sid("posting.$phpEx"),

				'S_HIDDEN_FIELDS' => $s_hidden_fields)

		);



		$phpbb2_template->pparse('confirm_body');



		include("includes/page_tail.php");

}

/*****[BEGIN]******************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/

else if ( $mode == 'thank' ) 

{

	$topic_id = intval($HTTP_GET_VARS[POST_TOPIC_URL]);

		if ( !($userdata['session_logged_in']) )

		{

			$message = $lang['thanks_not_logged'];

			$message .=  '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

		}

		if ( empty($topic_id) )

		{

			message_die(GENERAL_MESSAGE, 'No topic Selected');

		}



		$titanium_userid = $userdata['user_id'];

		$thanks_date = time();



		// Check if user is the topic starter

		$sql = "SELECT `topic_poster`

				FROM " . TOPICS_TABLE . " 

				WHERE topic_id = $topic_id

				AND topic_poster = $titanium_userid";

		if ( !($result = $titanium_db->sql_query($sql)) )

		{

			message_die(GENERAL_ERROR, "Couldn't check for topic starter", '', __LINE__, __FILE__, $sql);

					

		}



		if ( ($topic_starter_check = $titanium_db->sql_fetchrow($result)) )

		{

			$message = $lang['t_starter'];

			$message .=  '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

		}



		// Check if user had thanked before

		$sql = "SELECT `topic_id`

				FROM " . THANKS_TABLE . " 

				WHERE topic_id = $topic_id

				AND user_id = $titanium_userid";

		if ( !($result = $titanium_db->sql_query($sql)) )

		{

			message_die(GENERAL_ERROR, "Couldn't check for previous thanks", '', __LINE__, __FILE__, $sql);

					

		}

		if ( !($thankfull_check = $titanium_db->sql_fetchrow($result)) )

		{

			// Insert thanks if he/she hasn't

			$sql = "INSERT INTO " . THANKS_TABLE . " (topic_id, user_id, thanks_time) 

			VALUES ('" . $topic_id . "', '" . $titanium_userid . "', " . $thanks_date . ") ";

			if ( !($result = $titanium_db->sql_query($sql)) )

			{

				message_die(GENERAL_ERROR, "Could not insert thanks information", '', __LINE__, __FILE__, $sql);

					

			}

			$message = $lang['thanks_add'];

		}

		else

		{

			$message = $lang['thanked_before'];

		}



		$phpbb2_template->assign_vars(array(

			'META' => '<meta http-equiv="refresh" content="3;url=' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">')

		);



		$message .=  '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

		

		message_die(GENERAL_MESSAGE, $message);	

}

/*****[END]********************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/

else if ( $mode == 'vote' )

{

		//

		// Vote in a poll

		//

		if ( !empty($HTTP_POST_VARS['vote_id']) )

		{

				$vote_option_id = intval($HTTP_POST_VARS['vote_id']);



				$sql = "SELECT vd.vote_id

						FROM (" . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr)

						WHERE vd.topic_id = '$topic_id'

								AND vr.vote_id = vd.vote_id

								AND vr.vote_option_id = '$vote_option_id'

						GROUP BY vd.vote_id";

				if ( !($result = $titanium_db->sql_query($sql)) )

				{

						message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);

				}



				if ( $vote_info = $titanium_db->sql_fetchrow($result) )

				{

						$vote_id = $vote_info['vote_id'];



						$sql = "SELECT *

								FROM " . VOTE_USERS_TABLE . "

								WHERE vote_id = '$vote_id'

										AND vote_user_id = " . $userdata['user_id'];

			if ( !($result2 = $titanium_db->sql_query($sql)) )

						{

								message_die(GENERAL_ERROR, 'Could not obtain user vote data for this topic', '', __LINE__, __FILE__, $sql);

						}



			if ( !($row = $titanium_db->sql_fetchrow($result2)) )

						{

								$sql = "UPDATE " . VOTE_RESULTS_TABLE . "

										SET vote_result = vote_result + 1

										WHERE vote_id = '$vote_id'

												AND vote_option_id = '$vote_option_id'";

								if ( !$titanium_db->sql_query($sql) )

								{

										message_die(GENERAL_ERROR, 'Could not update poll result', '', __LINE__, __FILE__, $sql);

								}



/*****[BEGIN]******************************************

 [ Mod:    Admin Voting                        v1.1.8 ]

 ******************************************************/

								$sql = "INSERT INTO " . VOTE_USERS_TABLE . " (vote_id, vote_user_id, vote_user_ip, vote_cast)

										VALUES ('$vote_id', " . $userdata['user_id'] . ", '$titanium_user_ip', '$vote_option_id')";

/*****[END]********************************************

 [ Mod:    Admin Voting                        v1.1.8 ]

 ******************************************************/

								if ( !$titanium_db->sql_query($sql) )

								{

										message_die(GENERAL_ERROR, "Could not insert user_id for poll", "", __LINE__, __FILE__, $sql);

								}



								$message = $lang['Vote_cast'];

						}

						else

						{

								$message = $lang['Already_voted'];

						}

			$titanium_db->sql_freeresult($result2);

				}

				else

				{

						$message = $lang['No_vote_option'];

				}

		$titanium_db->sql_freeresult($result);



				$phpbb2_template->assign_vars(array(

						'META' => '<meta http-equiv="refresh" content="3;url=' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">')

				);

				$message .=  '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

				message_die(GENERAL_MESSAGE, $message);

		}

		else

		{

				redirect_titanium(append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true));

		}

}

else if ( $submit || $confirm )

{

		//

		// Submit post/vote (newtopic, edit, reply, etc.)

		//

		$return_message = '';

		$return_meta = '';

		// session id check

		// if ($sid == '' || $sid != $userdata['session_id'])

		// {

		// 	$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Session_invalid'] : $lang['Session_invalid'];

		// }

		switch ( $mode )

		{

				case 'editpost':

/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

					$titanium_username = ( !empty($HTTP_POST_VARS['username']) ) ? $HTTP_POST_VARS['username'] : '';

					$subject = ( !empty($HTTP_POST_VARS['subject']) ) ? trim($HTTP_POST_VARS['subject']) : '';

					$message = ( !empty($HTTP_POST_VARS['message']) ) ? $HTTP_POST_VARS['message'] : '';

					$poll_title = ( isset($HTTP_POST_VARS['poll_title']) && $phpbb2_is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_title'] : '';

					$poll_options = ( isset($HTTP_POST_VARS['poll_option_text']) && $phpbb2_is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_option_text'] : '';

					$poll_length = ( isset($HTTP_POST_VARS['poll_length']) && $phpbb2_is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_length'] : '';

/*****[BEGIN]******************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

					$poll_view_toggle = ( isset($HTTP_POST_VARS['poll_view_toggle']) && $phpbb2_is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_view_toggle'] : '0';

/*****[END]********************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

					$bbcode_uid = '';



					prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $titanium_username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length, $poll_view_toggle);



					if ( $error_msg == '' )

					{

						$topic_type = ( $topic_type != $post_data['topic_type'] && !$phpbb2_is_auth['auth_sticky'] && !$phpbb2_is_auth['auth_announce']  && !$phpbb2_is_auth['auth_globalannounce'] ) ? $post_data['topic_type'] : $topic_type;



						/*--FNA REPLACE 1--*/

/*****[BEGIN]******************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/

						submit_post($mode, $post_data, $return_message, $return_meta, $phpbb2_forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, str_replace("\'", "''", $titanium_username), str_replace("\'", "''", $subject), str_replace("\'", "''", $message), str_replace("\'", "''", $poll_title), $poll_options, $poll_length, $poll_view_toggle, $post_icon);

/*****[END]********************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/



/*****[BEGIN]******************************************

 [ Mod:      At a Glance Cement                v1.0.0 ]

 ******************************************************/

						 if($phpbb2_is_auth['auth_mod'] && $post_data['first_post']) {

								$topic_glance_priority = ( isset($HTTP_POST_VARS['topic_glance_priority']) ) ? "1" : "0";

								$t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];

								$sqlA = "UPDATE " . TOPICS_TABLE . "

								SET topic_glance_priority = " . $topic_glance_priority . "

								WHERE topic_id = " . $topic_id . "

								AND topic_moved_id = '0'";

							   if ( !($resultA = $titanium_db->sql_query($sqlA)) )

								{

									message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);

								}

						}

/*****[END]********************************************

 [ Mod:      At a Glance Cement                v1.0.0 ]

 ******************************************************/



					   if ( $phpbb2_is_auth['auth_mod'] )

					   {

							log_action($lang['Edit_Post'], '', $topic_id, $userdata['user_id'], '', '');

					   }

				   }

				   break;

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

				case 'newtopic':

				case 'reply':

						$titanium_username = ( !empty($HTTP_POST_VARS['username']) ) ? $HTTP_POST_VARS['username'] : '';

						$subject = ( !empty($HTTP_POST_VARS['subject']) ) ? trim($HTTP_POST_VARS['subject']) : '';

						$message = ( !empty($HTTP_POST_VARS['message']) ) ? $HTTP_POST_VARS['message'] : '';

						$poll_title = ( isset($HTTP_POST_VARS['poll_title']) && $phpbb2_is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_title'] : '';

						$poll_options = ( isset($HTTP_POST_VARS['poll_option_text']) && $phpbb2_is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_option_text'] : '';

						$poll_length = ( isset($HTTP_POST_VARS['poll_length']) && $phpbb2_is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_length'] : '';

/*****[BEGIN]******************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

						  $poll_view_toggle = ( isset($HTTP_POST_VARS['poll_view_toggle']) && $phpbb2_is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_view_toggle'] : '0';

/*****[END]********************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

						$bbcode_uid = '';



						prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $titanium_username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length, $poll_view_toggle);



						if ( $error_msg == '' )

						{

/*****[BEGIN]******************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/

								$topic_type = ( $topic_type != $post_data['topic_type'] && !$phpbb2_is_auth['auth_sticky'] && !$phpbb2_is_auth['auth_announce']  && !$phpbb2_is_auth['auth_globalannounce']) ? $post_data['topic_type'] : $topic_type;

/*****[END]********************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/



								/*--FNA REPLACE 2--*/

								submit_post($mode, $post_data, $return_message, $return_meta, $phpbb2_forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, str_replace("\'", "''", $titanium_username), str_replace("\'", "''", $subject), str_replace("\'", "''", $message), str_replace("\'", "''", $poll_title), $poll_options, $poll_length, $poll_view_toggle, $post_icon);



/*****[BEGIN]******************************************

 [ Mod:      At a Glance Cement                v1.0.0 ]

 ******************************************************/

							 if($phpbb2_is_auth['auth_mod'] && $mode == 'newtopic') {

								$topic_glance_priority = ( isset($HTTP_POST_VARS['topic_glance_priority']) ) ? "1" : "0";

								$t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];

								$sqlA = "UPDATE " . TOPICS_TABLE . "

								SET topic_glance_priority = " . $topic_glance_priority . "

								WHERE topic_id = " . $topic_id . "

								AND topic_moved_id = '0'";

							   if ( !($resultA = $titanium_db->sql_query($sqlA)) )

								{

									message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);

								}

							}

/*****[END]********************************************

 [ Mod:      At a Glance Cement                v1.0.0 ]

 ******************************************************/

						}

						break;



				case 'delete':

				case 'poll_delete':

					if ($error_msg != '')

					{

						message_die(GENERAL_MESSAGE, $error_msg);

					}

/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

					 if ( $phpbb2_is_auth['auth_mod'] )

						{

						   log_action($lang['Delete'], '', $topic_id, $userdata['user_id'], '', '');

						}

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/



						delete_post($mode, $post_data, $return_message, $return_meta, $phpbb2_forum_id, $topic_id, $post_id, $poll_id);

						/*--FNA #3--*/

						break;

		}



		if ( $error_msg == '' )

		{

				if ( $mode != 'editpost' )

				{

						$titanium_user_id = ( $mode == 'reply' || $mode == 'newtopic' ) ? $userdata['user_id'] : $post_data['poster_id'];

						update_post_stats($mode, $post_data, $phpbb2_forum_id, $topic_id, $post_id, $titanium_user_id);

/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
						update_reputations($mode, $titanium_user_id);
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/

				}

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
				$attachment_mod['posting']->insert_attachment($post_id);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

				if ($error_msg == '' && $mode != 'poll_delete')
				{
						user_notification($mode, $post_data, $post_info['topic_title'], $phpbb2_forum_id, $topic_id, $post_id, $notify_user);
				}

				/*--FNA #4--*/

/*****[BEGIN]******************************************
 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]
 ******************************************************/
				if ( ( $error_msg == '' ) && ( $lock ) && ( $mode == 'newtopic' ) )
				{
					$sql = "UPDATE " . TOPICS_TABLE . "
					SET topic_status = " . TOPIC_LOCKED . "
					WHERE topic_id = " . $topic_id . "
					AND topic_moved_id = 0";

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
					log_action($lang['Lock'], '', $topic_id, $userdata['user_id'], '', '');
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

					if ( !($result = $titanium_db->sql_query($sql)) )
						{
						message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
					}
				}
/*****[END]********************************************
 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]
 ******************************************************/

				if ( $mode == 'newtopic' || $mode == 'reply' )
				{
						$phpbb2_tracking_topics = ( !empty($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) : array();
						$phpbb2_tracking_forums = ( !empty($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f']) : array();

						if ( count($phpbb2_tracking_topics) + count($phpbb2_tracking_forums) == 100 && empty($phpbb2_tracking_topics[$topic_id]) )
						{
								asort($phpbb2_tracking_topics);
								unset($phpbb2_tracking_topics[key($phpbb2_tracking_topics)]);
						}

						$phpbb2_tracking_topics[$topic_id] = time();

						setcookie($phpbb2_board_config['cookie_name'] . '_t', serialize($phpbb2_tracking_topics), 0, $phpbb2_board_config['cookie_path'], $phpbb2_board_config['cookie_domain'], $phpbb2_board_config['cookie_secure']);
				}

				$phpbb2_template->assign_vars(array(
						'META' => $return_meta)
				);
				message_die(GENERAL_MESSAGE, $return_message);
		}
}

if( $refresh || isset($HTTP_POST_VARS['del_poll_option']) || $error_msg != '' )
{
		$titanium_username = ( !empty($HTTP_POST_VARS['username']) ) ? htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['username']))) : '';
		$subject = ( !empty($HTTP_POST_VARS['subject']) ) ? htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['subject']))) : '';
		$message = ( !empty($HTTP_POST_VARS['message']) ) ? htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['message']))) : '';

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
		$post_icon = ( !empty($HTTP_POST_VARS['post_icon']) ) ? intval($HTTP_POST_VARS['post_icon']) : 0;
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

		$poll_title = ( !empty($HTTP_POST_VARS['poll_title']) ) ? htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['poll_title']))) : '';
		$poll_length = ( isset($HTTP_POST_VARS['poll_length']) ) ? max(0, intval($HTTP_POST_VARS['poll_length'])) : 0;
/*****[BEGIN]******************************************
 [ Mod:     Must first vote to see Results     v1.0.0 ]
 ******************************************************/
	   $poll_view_toggle = ( !empty($HTTP_POST_VARS['poll_view_toggle']) ) ? htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['poll_view_toggle']))) : '';
/*****[END]********************************************
 [ Mod:     Must first vote to see Results     v1.0.0 ]
 ******************************************************/
		$poll_options = array();
		if ( !empty($HTTP_POST_VARS['poll_option_text']) )
		{
				while( list($option_id, $option_text) = @each($HTTP_POST_VARS['poll_option_text']) )
				{
						if( isset($HTTP_POST_VARS['del_poll_option'][$option_id]) )
						{
								unset($poll_options[$option_id]);
						}
						else if ( !empty($option_text) )
						{
								$poll_options[intval($option_id)] = htmlspecialchars(trim(stripslashes($option_text)));
						}
				}
		}

		if ( isset($poll_add) && !empty($HTTP_POST_VARS['add_poll_option_text']) )
		{
				$poll_options[] = htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['add_poll_option_text'])));
		}

		if ( $mode == 'newtopic' || $mode == 'reply')
		{
				$titanium_user_sig = ( $userdata['user_sig'] != '' && $phpbb2_board_config['allow_sig'] ) ? $userdata['user_sig'] : '';
		}
		else if ( $mode == 'editpost' )
		{
				$titanium_user_sig = ( $post_info['user_sig'] != '' && $phpbb2_board_config['allow_sig'] ) ? $post_info['user_sig'] : '';
				$userdata['user_sig_bbcode_uid'] = $post_info['user_sig_bbcode_uid'];
		}

		if( $preview )
		{
				$orig_word = array();
				$replacement_word = array();
				obtain_word_list($orig_word, $replacement_word);

				$bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
				$preview_message = stripslashes(prepare_message(addslashes(unprepare_message($message)), $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
				$preview_subject = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($subject) : $subject;
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
				$preview_subject = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($subject) : $subject;
				$preview_username = $titanium_username;

				//
				// Finalise processing as per viewtopic
				//
				if( !$html_on )
				{
						if( $titanium_user_sig != '' || !$userdata['user_allowhtml'] )
						{
								$titanium_user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $titanium_user_sig);
						}
				}

/*****[BEGIN]******************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/
				$valid = FALSE;
				if( $userdata['session_logged_in'] ) {
					$sql = "SELECT p.poster_id, p.topic_id
						FROM " . POSTS_TABLE . " p
						WHERE p.topic_id = $topic_id
						AND p.poster_id = " . $userdata['user_id'];
					$resultat = $titanium_db->sql_query($sql);
					$valid = $titanium_db->sql_numrows($resultat) ? TRUE : FALSE;}

				if( $attach_sig && $titanium_user_sig != '' && $userdata['user_sig_bbcode_uid'] )
				{
						$titanium_user_sig = bbencode_second_pass($titanium_user_sig, $userdata['user_sig_bbcode_uid']);
						$titanium_user_sig = bbencode_third_pass($titanium_user_sig, $userdata['user_sig_bbcode_uid'], $valid);
				}

				if( $bbcode_on )
				{
						$preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
						$preview_message = bbencode_third_pass($preview_message, $bbcode_uid, $valid);
				}
/*****[END]********************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/

				if( !empty($orig_word) )
				{
						$preview_username = ( !empty($titanium_username) ) ? preg_replace($orig_word, $replacement_word, $preview_username) : '';
						$preview_subject = ( !empty($subject) ) ? preg_replace($orig_word, $replacement_word, $preview_subject) : '';
						$preview_message = ( !empty($preview_message) ) ? preg_replace($orig_word, $replacement_word, $preview_message) : '';
				}

				if( $titanium_user_sig != '' )
				{
						$titanium_user_sig = make_clickable($titanium_user_sig);
				}
				$preview_message = make_clickable($preview_message);

				if( $smilies_on )
				{
						if( $userdata['user_allowsmile'] && $titanium_user_sig != '' )
						{
								$titanium_user_sig = smilies_pass($titanium_user_sig);
						}

						$preview_message = smilies_pass($preview_message);
				}

				if( $attach_sig && $titanium_user_sig != '' )
				{
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
				$phpbb2_board_config['sig_line'] = str_replace('{THEME_NAME}', $ThemeSel, $phpbb2_board_config['sig_line']);
				$preview_message = $preview_message . '<br />' . $phpbb2_board_config['sig_line'] . '<br />' . $titanium_user_sig;
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
				}

/*****[BEGIN]******************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/
		$preview_message = word_wrap_pass($preview_message);
/*****[END]********************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/

				$preview_message = str_replace("\n", '<br />', $preview_message);

				$phpbb2_template->set_filenames(array(
						'preview' => 'posting_preview.tpl')
				);

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
				$preview_subject = get_icon_title($post_icon) . '&nbsp;' . $preview_subject;
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
				$attachment_mod['posting']->preview_attachments();
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

				$phpbb2_template->assign_vars(array(
						'THEME_NAME' => $ThemeSel,
						'TOPIC_TITLE' => $preview_subject,
						'POST_SUBJECT' => $preview_subject,
						'POSTER_NAME' => $preview_username,
						'POST_DATE' => create_date($phpbb2_board_config['default_dateformat'], time(), $phpbb2_board_config['board_timezone']),
						'MESSAGE' => decode_bbcode(set_smilies(stripslashes($preview_message)), 1, true),
						// 'MESSAGE' => $preview_message,
						'L_POST_SUBJECT' => $lang['Post_subject'],
						'L_PREVIEW' => $lang['Preview'],
						'L_POSTED' => $lang['Posted'],
						'L_POST' => $lang['Post'])
				);
				$phpbb2_template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
		}
		else if( $error_msg != '' )
		{
				$phpbb2_template->set_filenames(array(
						'reg_header' => 'error_body.tpl')
				);
				$phpbb2_template->assign_vars(array(
						'ERROR_MESSAGE' => $error_msg)
				);
				$phpbb2_template->assign_var_from_handle('ERROR_BOX', 'reg_header');
		}
}
else
{
		//
		// User default entry point
		//
		if ( $mode == 'newtopic' )
		{
				$titanium_user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

				$titanium_username = ($userdata['session_logged_in']) ? $userdata['username'] : '';
				$poll_title = '';
				$poll_length = '';
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
				$post_icon = 0;
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Must first vote to see Results     v1.0.0 ]
 ******************************************************/
				$poll_view_toggle = '';
/*****[END]********************************************
 [ Mod:     Must first vote to see Results     v1.0.0 ]
 ******************************************************/
				$subject = '';
				$message = '';
		}
		else if ( $mode == 'reply' )
		{
				$titanium_user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

				$titanium_username = ( $userdata['session_logged_in'] ) ? $userdata['username'] : '';
				$subject = '';

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
				$post_icon = 0;
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Automatic Subject on Reply         v1.0.0 ]
 ******************************************************/
				$subject = $post_info['topic_title'];
				if ( !preg_match('/^Re:/', $subject) && strlen($subject) > 0)
				{
						$subject = 'Re: ' . $subject;
				}
/*****[END]********************************************
 [ Mod:     Automatic Subject on Reply         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/
if( !$userdata['session_logged_in'] ) {$message = hide_in_quote($message);}
else { $sql = "SELECT p.poster_id, p.topic_id
FROM " . POSTS_TABLE . " p
WHERE p.topic_id = $topic_id
AND p.poster_id = " . $userdata['user_id'];
$resultat = $titanium_db->sql_query($sql);
if(!$titanium_db->sql_numrows($resultat)) {$message = hide_in_quote($message);}
				}
/*****[END]********************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/

				$message = '';

		}
		else if ( $mode == 'quote' || $mode == 'editpost' )
		{
				$subject = ( $post_data['first_post'] ) ? $post_info['topic_title'] : $post_info['post_subject'];
				$message = $post_info['post_text'];
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
				$post_icon = ( $post_data['first_post'] ) ? $post_info['topic_icon'] : $post_info['post_icon'];
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

				if ( $mode == 'editpost' )
				{
						$attach_sig = ( $post_info['enable_sig'] && $post_info['user_sig'] != '' ) ? TRUE : 0;
						$titanium_user_sig = $post_info['user_sig'];

						$html_on = ( $post_info['enable_html'] ) ? true : false;
						$bbcode_on = ( $post_info['enable_bbcode'] ) ? true : false;
						$smilies_on = ( $post_info['enable_smilies'] ) ? true : false;
				}
				else
				{
						$attach_sig = ( $userdata['user_attachsig'] ) ? TRUE : 0;
						$titanium_user_sig = $userdata['user_sig'];
				}

				if ( $post_info['bbcode_uid'] != '' )
				{
						$message = preg_replace('/\:(([a-z0-9]:)?)' . $post_info['bbcode_uid'] . '/s', '', $message);
				}

				$message = str_replace('<', '&lt;', $message);
				$message = str_replace('>', '&gt;', $message);
				$message = str_replace('<br />', "\n", $message);

				if ( $mode == 'quote' )
				{
						$orig_word = array();
						$replacement_word = array();
						obtain_word_list($orig_word, $replace_word);

/*****[BEGIN]******************************************
 [ Mod:      Time & Date in Quote              v1.0.0 ]
 ******************************************************/
					   $whitespacer = " @ ";
/*****[END]********************************************
 [ Mod:      Time & Date in Quote              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:      Time & Date in Quote              v1.0.0 ]
 ******************************************************/
						 $msg_date =  create_date($phpbb2_board_config['default_dateformat'], $post_info['post_time'], $phpbb2_board_config['board_timezone']);
/*****[END]********************************************
 [ Mod:      Time & Date in Quote              v1.0.0 ]
 ******************************************************/

						// Use trim to get rid of spaces placed there by MS-SQL 2000
						$quote_username = ( trim($post_info['post_username']) != '' ) ? $post_info['post_username'] : $post_info['username'];

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
						$message = '[quote="' . $quote_username . '";p="' . $post_id . '"]' . $message . '[/quote]';
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

						if ( !empty($orig_word) )
						{
								$subject = ( !empty($subject) ) ? preg_replace($orig_word, $replace_word, $subject) : '';
								$message = ( !empty($message) ) ? preg_replace($orig_word, $replace_word, $message) : '';
						}

						if ( !preg_match('/^Re:/', $subject) && strlen($subject) > 0 )
						{
								$subject = 'Re: ' . $subject;
						}



						$mode = 'reply';

						/*--FNA #5--*/
				}
				else
				{
						$titanium_username = ( $post_info['user_id'] == ANONYMOUS && !empty($post_info['post_username']) ) ? $post_info['post_username'] : '';
				}
		}
}

//
// Signature toggle selection
//
if( $titanium_user_sig != '' )
{
		$phpbb2_template->assign_block_vars('switch_signature_checkbox', array());
}

//
// HTML toggle selection
//
if ( $phpbb2_board_config['allow_html'] )
{
		$html_status = $lang['HTML_is_ON'];
		$phpbb2_template->assign_block_vars('switch_html_checkbox', array());
}
else
{
		$html_status = $lang['HTML_is_OFF'];
}

//
// BBCode toggle selection
//
if ( $phpbb2_board_config['allow_bbcode'] )
{
		$bbcode_status = $lang['BBCode_is_ON'];
		$phpbb2_template->assign_block_vars('switch_bbcode_checkbox', array());
}
else
{
		$bbcode_status = $lang['BBCode_is_OFF'];
}

//
// Smilies toggle selection
//
if ( $phpbb2_board_config['allow_smilies'] )
{
		$smilies_status = $lang['Smilies_are_ON'];
		$phpbb2_template->assign_block_vars('switch_smilies_checkbox', array());
}
else
{
		$smilies_status = $lang['Smilies_are_OFF'];
}

if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) )
{
		$phpbb2_template->assign_block_vars('switch_username_select', array());
}

//
// Notify checkbox - only show if user is logged in
//
if ( $userdata['session_logged_in'] && $phpbb2_is_auth['auth_read'] )
{
		if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) )
		{
				$phpbb2_template->assign_block_vars('switch_notify_checkbox', array());
		}
}

//
// Delete selection
//
if ( $mode == 'editpost' && ( ( $phpbb2_is_auth['auth_delete'] && $post_data['last_post'] && ( !$post_data['has_poll'] || $post_data['edit_poll'] ) ) || $phpbb2_is_auth['auth_mod'] ) )
{
		$phpbb2_template->assign_block_vars('switch_delete_checkbox', array());
}

/*****[BEGIN]******************************************
 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]
 ******************************************************/
if ( ( $mode == 'editpost' || $mode == 'reply' || $mode == 'quote' || $mode == 'newtopic' ) && ( $phpbb2_is_auth['auth_mod'] ) )
{
	if ( $post_info['topic_status'] == TOPIC_LOCKED )
	{
		$phpbb2_template->assign_block_vars('switch_unlock_topic', array());

		$phpbb2_template->assign_vars(array(
			'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
			'S_UNLOCK_CHECKED' => ( $unlock ) ? 'checked="checked"' : '')
		);
	}
	else if ( $post_info['topic_status'] == TOPIC_UNLOCKED )
	{
		$phpbb2_template->assign_block_vars('switch_lock_topic', array());

		$phpbb2_template->assign_vars(array(
			'L_LOCK_TOPIC' => $lang['Lock_topic'],
			'S_LOCK_CHECKED' => ( $lock ) ? 'checked="checked"' : '')
		);
	}
}
/*****[END]********************************************
 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:      At a Glance Cement                v1.0.0 ]
 ******************************************************/
 if ( ( $mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post'])) && ( $phpbb2_is_auth['auth_mod'] ) ) {
	 if ($post_info['topic_glance_priority']) {
		 $checked = 'checked="checked"';
	 } else if ($HTTP_POST_VARS['topic_glance_priority']){
		 $checked = 'checked="checked"';
	 } else {
		 $checked = '';
	 }
	$phpbb2_template->assign_block_vars('switch_topic_glance_priority', array());
		$phpbb2_template->assign_vars(array(
			 'L_TOPIC_GLANCE_PRIORITY' => $lang['topic_glance_priority'],
			 'TOPIC_GLANCE_PRIORITY_CHECKED' => $checked,
			 )
		);
}
/*****[END]********************************************
 [ Mod:      At a Glance Cement               v1.0.0 ]
 ******************************************************/



//
// Topic type selection
//
$topic_type_toggle = '';
if ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['first_post'] ) )
{
	$phpbb2_template->assign_block_vars('switch_type_toggle', array());

	/**
	 * Responsive theme support added here
	 */
	$show_sticky = $show_announce = $show_global_announce = false;
	$show_topic_select = false;

	if( $phpbb2_is_auth['auth_sticky'] )
	{
		$topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_STICKY . '"';
		if ( $post_data['topic_type'] == POST_STICKY || $topic_type == POST_STICKY )
		{
			$topic_type_toggle .= ' checked="checked"';
		}
		$topic_type_toggle .= ' /> ' . $lang['Post_Sticky'] . '&nbsp;&nbsp;';
		/**
		 * Responsive theme support added here
		 */
		$show_sticky = true;
	}

	if( $phpbb2_is_auth['auth_announce'] )
	{
		$topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_ANNOUNCE . '"';
		if ( $post_data['topic_type'] == POST_ANNOUNCE || $topic_type == POST_ANNOUNCE )
		{
			$topic_type_toggle .= ' checked="checked"';
		}
		$topic_type_toggle .= ' /> ' . $lang['Post_Announcement'] . '&nbsp;&nbsp;';
		/**
		 * Responsive theme support added here
		 */
		$show_announce = true;
	}

	if( $phpbb2_is_auth['auth_globalannounce'] )
	{
		$topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_GLOBAL_ANNOUNCE . '"';
		if ( $post_data['topic_type'] == POST_GLOBAL_ANNOUNCE || $topic_type == POST_GLOBAL_ANNOUNCE )
		{
			$topic_type_toggle .= ' checked="checked"';
		}
		$topic_type_toggle .= ' /> ' . $lang['Post_global_announcement'] . '&nbsp;&nbsp;';
		/**
		 * Responsive theme support added here
		 */
		$show_global_announce = true;
	}

	/**
	 * Support for reponsive theme added here.
	 */	
	if ( $topic_type_toggle != '' ):
	
		$topic_type_toggle = '<input type="radio" name="topictype" value="' . POST_NORMAL .'"' . ( ( $post_data['topic_type'] == POST_NORMAL || $topic_type == POST_NORMAL ) ? ' checked="checked"' : '' ) . ' /> ' . $lang['Post_Normal'] . '&nbsp;&nbsp;' . $topic_type_toggle;
		$show_topic_select = TRUE;

	endif;
}

$hidden_form_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
$hidden_form_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

switch( $mode )
{
	case 'newtopic':
		$phpbb2_page_title = $lang['Post_a_new_topic'];
		$hidden_form_fields .= '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $phpbb2_forum_id . '" />';
		break;

	case 'reply':
		$phpbb2_page_title = $lang['Post_a_reply'];
		$hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
		break;

	case 'editpost':
		$phpbb2_page_title = $lang['Edit_Post'];
		$hidden_form_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';
		break;
}

// Generate smilies listing for page output
generate_smilies('inline', PAGE_POSTING);

/*--FNA #6--*/

//
// Include page header
//
include("includes/page_header.$phpEx");

$phpbb2_template->set_filenames(array(
		'body' => 'posting_body.tpl',
		'pollbody' => 'posting_poll_body.tpl',
		'reviewbody' => 'posting_topic_review.tpl')
);
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
//make_jumpbox('viewforum.'.$phpEx);
$all_forums = array();
make_jumpbox_ref('viewforum.'.$phpEx, $phpbb2_forum_id, $all_forums);

$phpbb2_parent_id = 0;
for( $i = 0; $i < count($all_forums); $i++ )
{
	if( $all_forums[$i]['forum_id'] == $phpbb2_forum_id )
	{
		$phpbb2_parent_id = $all_forums[$i]['forum_parent'];
	}
}

if( $phpbb2_parent_id )
{
	for( $i = 0; $i < count($all_forums); $i++)
	{
		if( $all_forums[$i]['forum_id'] == $phpbb2_parent_id )
		{
			$phpbb2_template->assign_vars(array(
				'PARENT_FORUM'			=> 1,
				'U_VIEW_PARENT_FORUM'	=> append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id']),
				'PARENT_FORUM_NAME'		=> $all_forums[$i]['forum_name'],
				));
		}
	}
}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

$phpbb2_template->assign_vars(array(
		'FORUM_NAME' => $forum_name,
/*****[BEGIN]******************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
		'TOPIC_SUBJECT' => $topic_title,
/*****[END]********************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
		'L_POST_A' => $phpbb2_page_title,
		'L_POST_SUBJECT' => $lang['Post_subject'],

/*****[BEGIN]******************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
		'U_VIEW_TOPIC' => append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id"),
/*****[END]********************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
		'U_VIEW_FORUM' => append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id"))
);

//
// This enables the forum/topic title to be output for posting
// but not for privmsg (where it makes no sense)
//
$phpbb2_template->assign_block_vars('switch_not_privmsg', array());

/*****[BEGIN]******************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
if ( $mode == 'reply' || $mode == 'quote' || $mode == 'editpost' )
{
$phpbb2_template->assign_block_vars('switch_not_privmsg.reply_mode', array());
}
/*****[END]********************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/

//
// Output the data to the template
//
$phpbb2_template->assign_vars(array(
		'USERNAME' => $titanium_username,
		'SUBJECT' => $subject,
		'MESSAGE' => $message,
		'HTML_STATUS' => $html_status,
		// 'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_titanium_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
		'BBCODE_STATUS' => $bbcode_status,
		'SMILIES_STATUS' => $smilies_status,

		'BB_BOX' => Make_TextArea_Ret('message', $message, 'post', '99.8%', '350px', true),
		
		'L_SUBJECT' => $lang['Subject'],
		'L_MESSAGE_BODY' => $lang['Message_body'],
		'L_OPTIONS' => $lang['Options'],
		'L_PREVIEW' => $lang['Preview'],
		'L_SPELLCHECK' => $lang['Spellcheck'],
		'L_SUBMIT' => $lang['Submit'],
		'L_CANCEL' => $lang['Cancel'],
		'L_CONFIRM_DELETE' => $lang['Confirm_delete'],
		'L_DISABLE_HTML' => $lang['Disable_HTML_post'],
		'L_DISABLE_BBCODE' => $lang['Disable_BBCode_post'],
		'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'],
		'L_ATTACH_SIGNATURE' => $lang['Attach_signature'],
		'L_NOTIFY_ON_REPLY' => $lang['Notify'],
		'L_DELETE_POST' => $lang['Delete_post'],
		'L_STYLES_TIP' => $lang['Styles_tip'],

		'U_VIEWTOPIC' => ( $mode == 'reply' ) ? append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postorder=desc") : '',
		'U_REVIEW_TOPIC' => ( $mode == 'reply' ) ? append_titanium_sid("posting.$phpEx?mode=topicreview&amp;" . POST_TOPIC_URL . "=$topic_id&popup=1") : '',

		'S_HTML_CHECKED' => ( !$html_on ) ? 'checked="checked"' : '',
		'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? 'checked="checked"' : '',
		'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : '',
		'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? 'checked="checked"' : '',
		'S_NOTIFY_CHECKED' => ( $notify_user ) ? 'checked="checked"' : '',

		'L_TYPE_TOGGLE' => $lang['Post_topic_as'],
		'S_TYPE_TOGGLE' => $topic_type_toggle,

		/**
		 * Repsonsive theme support added here
		 */
		'S_SHOW_TYPE_SELECT' => $show_topic_select,
		'S_SHOW_TYPE_STICKY' => $show_sticky,
		'S_SHOW_TYPE_ANNOUNCE' => $show_announce,
		'S_SHOW_TYPE_GLOBAL_ANNOUNCE' => $show_global_announce,
		'S_IS_NORMAL' => ( $post_data['topic_type'] == POST_NORMAL || $topic_type == POST_NORMAL ) ? ' selected="selected"' : '',
		'S_IS_STICKY' => ( $post_data['topic_type'] == POST_STICKY || $topic_type == POST_STICKY ) ? ' selected="selected"' : '',
		'S_IS_ANNOUNCE' => ( $post_data['topic_type'] == POST_ANNOUNCE || $topic_type == POST_ANNOUNCE ) ? ' selected="selected"' : '',
		'S_IS_GLOBAL_ANNOUNCE' => ( $post_data['topic_type'] == POST_GLOBAL_ANNOUNCE || $topic_type == POST_GLOBAL_ANNOUNCE ) ? ' selected="selected"' : '',
		'L_TYPE_NORMAL_TOPIC' => $lang['Post_Normal'],
		'L_TYPE_STICKY_TOPIC' => $lang['Post_Sticky'],
		'L_TYPE_ANNOUNCE_TOPIC' => $lang['Post_Announcement'],
		'L_TYPE_GLOBAL_ANNOUNCE_TOPIC' => $lang['Post_global_announcement'],

		'S_TOPIC_ID' => $topic_id,
		'S_POST_ACTION' => append_titanium_sid("posting.$phpEx"),
		'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
);

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
// get the number of icon per row from config

$phpbb2_icon_per_row = isset($phpbb2_board_config['icon_per_row']) ? intval($phpbb2_board_config['icon_per_row']) : 10;
if ($phpbb2_icon_per_row <= 1)
{
	$phpbb2_icon_per_row = 10;
}

// get the list of icon available to the user

$phpbb2_icones_sort = array();
for ($i = 0; $i < count($phpbb2_icones); $i++)
{
	switch ($phpbb2_icones[$i]['auth'])
	{

		case AUTH_ADMIN:
			if ( $userdata['user_level'] == ADMIN )
			{
				$phpbb2_icones_sort[] = $i;
			}
			break;
		case AUTH_MOD:
			if ( $phpbb2_is_auth['auth_mod'] )
			{
				$phpbb2_icones_sort[] = $i;
			}
			break;
		case AUTH_REG:
			if ( $userdata['session_logged_in'] )
			{
				$phpbb2_icones_sort[] = $i;
			}
			break;
		default:
			$phpbb2_icones_sort[] = $i;
			break;
	}
}

// check if the icon exists

$found = false;
for ($i=0; ( ($i < count($phpbb2_icones_sort)) && !$found );$i++)
{
	$found = ($phpbb2_icones[ $phpbb2_icones_sort[$i] ]['ind'] == $post_icon);
}

if (!$found) $post_icon = 0;

// send to template

$phpbb2_template->assign_block_vars('switch_icon_checkbox', array());
$phpbb2_template->assign_vars(array(
	'L_ICON_TITLE' => $lang['post_icon_title'],
	/**
	 * Responsive theme support added here.
	 */
	'ICONS_SHOWN' => $phpbb2_icon_per_row,
	'ICONS_PER_ROW' => $phpbb2_icon_per_row
	)
);

// display the icons

if ( defined('BOOTSTRAP') ):

	// display the icons
	if ( $phpbb2_icon_per_row > 0 ):

		$nb_row = intval( (count($phpbb2_icones_sort)-1) / $phpbb2_icon_per_row )+1;
		$offset = 0;
		$phpbb2_template->assign_block_vars('switch_icon_checkbox.row',array(
		    'ICON_IMG'      => get_icon_title($phpbb2_icones[$phpbb2_icon_id]['ind'], 2)
		));


		for ($i=0; $i < $nb_row; $i++)
		{
			
			for ($j=0; ( ($j < $phpbb2_icon_per_row) && ($offset < count($phpbb2_icones_sort)) ); $j++)
			{
				$phpbb2_icon_id  = $phpbb2_icones_sort[$offset];

				// send to cell or cell_none

		        $phpbb2_template->assign_block_vars('switch_icon_checkbox.row.cell', array(
					'ICON_ID'		=> $phpbb2_icones[$phpbb2_icon_id]['ind'],
					'ICON_CHECKED'	=> ($post_icon == $phpbb2_icones[$phpbb2_icon_id]['ind']) ? ' checked="checked"' : '',
					'ICON_SELECTED' => ($post_icon == $phpbb2_icones[$phpbb2_icon_id]['ind']) ? ' selected="selected"' : '',
					'ICON_IMG'		=> get_icon_title($phpbb2_icones[$phpbb2_icon_id]['ind'], 2),
					'ICON_NAME'     => ucwords( str_replace( array( 'icon_', '_' ), array( '', ' ' ), $phpbb2_icones[$phpbb2_icon_id]['alt'] ) ),
					'ICON' => $phpbb2_icones[$phpbb2_icon_id]['img']
				));

				$offset++;
			}
		}

	endif;

else:

	$nb_row = intval( (count($phpbb2_icones_sort)-1) / $phpbb2_icon_per_row )+1;
	$offset = 0;
	for ($i=0; $i < $nb_row; $i++)
	{

		$phpbb2_template->assign_block_vars('switch_icon_checkbox.row',array());

		for ($j=0; ( ($j < $phpbb2_icon_per_row) && ($offset < count($phpbb2_icones_sort)) ); $j++)

		{
			$phpbb2_icon_id  = $phpbb2_icones_sort[$offset];

			// send to cell or cell_none

			$phpbb2_template->assign_block_vars('switch_icon_checkbox.row.cell', array(
				'ICON_ID'		=> $phpbb2_icones[$phpbb2_icon_id]['ind'],
				'ICON_CHECKED'	=> ($post_icon == $phpbb2_icones[$phpbb2_icon_id]['ind']) ? ' checked="checked"' : '',
				'ICON_IMG'		=> get_icon_title($phpbb2_icones[$phpbb2_icon_id]['ind'], 2),
				'ICON_NAME'     => ucwords( str_replace( array( 'icon_', '_' ), array( '', ' ' ), $phpbb2_icones[$phpbb2_icon_id]['alt'] ) ),
				'ICON' => $phpbb2_icones[$phpbb2_icon_id]['img']			

				)
			);

			$offset++;
		}
	}

endif;
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

//
// Poll entry switch/output
//
if( ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['edit_poll']) ) && $phpbb2_is_auth['auth_pollcreate'] )
{
		$phpbb2_template->assign_vars(array(
				'L_ADD_A_POLL' => $lang['Add_poll'],
				'L_ADD_POLL_EXPLAIN' => $lang['Add_poll_explain'],
				'L_POLL_QUESTION' => $lang['Poll_question'],
				'L_POLL_OPTION' => $lang['Poll_option'],
				'L_ADD_OPTION' => $lang['Add_option'],
				'L_UPDATE_OPTION' => $lang['Update'],
				'L_DELETE_OPTION' => $lang['Delete'],
				'L_POLL_LENGTH' => $lang['Poll_for'],
/*****[BEGIN]******************************************
 [ Mod:     Must first vote to see Results     v1.0.0 ]
 ******************************************************/
				'L_POLL_TOGGLE' => $lang['Poll_view_toggle'],
				'L_POLL_TOGGLE_EXPLAIN' => $lang['Poll_view_toggle_explain'],
/*****[END]********************************************
 [ Mod:     Must first vote to see Results     v1.0.0 ]
 ******************************************************/
				'L_DAYS' => $lang['Days'],
				'L_POLL_LENGTH_EXPLAIN' => $lang['Poll_for_explain'],
				'L_POLL_DELETE' => $lang['Delete_poll'],
				'POLL_TITLE' => $poll_title,
				'POLL_LENGTH' => $poll_length,
/*****[BEGIN]******************************************
 [ Mod:     Must first vote to see Results     v1.0.0 ]
 ******************************************************/
				'POLL_TOGGLE_CHECKED' => ($poll_view_toggle) ? "checked" : "",
				'POLL_TOGGLE' => $poll_view_toggle)
/*****[END]********************************************
 [ Mod:     Must first vote to see Results     v1.0.0 ]
 ******************************************************/
		);

		if( $mode == 'editpost' && $post_data['edit_poll'] && $post_data['has_poll'])
		{
				$phpbb2_template->assign_block_vars('switch_poll_delete_toggle', array());
		}

		if( !empty($poll_options) )
		{
				while( list($option_id, $option_text) = each($poll_options) )
				{
						$phpbb2_template->assign_block_vars('poll_option_rows', array(
								'POLL_OPTION' => str_replace('"', '&quot;', $option_text),

								'S_POLL_OPTION_NUM' => $option_id)
						);
				}
		}

		$phpbb2_template->assign_var_from_handle('POLLBOX', 'pollbody');
}

//
// Topic review
//
if( $mode == 'reply' && $phpbb2_is_auth['auth_read'] )
{
		require("includes/topic_review.$phpEx");
		topic_review($topic_id, true);

		$phpbb2_template->assign_block_vars('switch_inline_mode', array());
		$phpbb2_template->assign_var_from_handle('TOPIC_REVIEW_BOX', 'reviewbody');
}

$phpbb2_template->pparse('body');

include("includes/page_tail.$phpEx");

?>