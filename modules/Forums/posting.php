<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
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

    $module_name = basename(dirname(__FILE__));

    require("modules/".$module_name."/nukebb.php");

    }

    else

    {

    $phpbb_root_path = NUKE_FORUMS_DIR;

}



define('IN_PHPBB', true);

include($phpbb_root_path . 'extension.inc');

include($phpbb_root_path . 'common.'.$phpEx);

include_once("includes/bbcode.php");

include("includes/functions_post.php");

/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
include($phpbb_root_path . 'reputation_common.'.$phpEx);
include('includes/functions_reputation.'.$phpEx);
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/

include('includes/def_icons.'.$phpEx);

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

$forum_id	= request_var('f', 0);



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

$userdata = session_pagestart($user_ip, PAGE_POSTING);

init_userprefs($userdata);

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

        else if ( $forum_id )

        {

                $redirect = "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id";

                $post_append = '';

        }

        else

        {

                $redirect = "index.$phpEx";

                $post_append = '';

        }



        // not needed anymore due to function redirect()

//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';

        redirect(append_sid($redirect, true) . $post_append);

        exit;

}



//

// What auth type do we need to check?

//

$is_auth = array();

switch( $mode )

{

        case 'newtopic':

/*****[BEGIN]******************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/

                if ( $topic_type == POST_GLOBAL_ANNOUNCE )

                {

                   $is_auth_type = 'auth_globalannounce';

                } else

/*****[END]********************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/

                if ( $topic_type == POST_ANNOUNCE )

                {

                        $is_auth_type = 'auth_announce';

                }

                else if ( $topic_type == POST_STICKY )

                {

                        $is_auth_type = 'auth_sticky';

                }

                else

                {

                        $is_auth_type = 'auth_post';

                }

                break;

        case 'reply':

        case 'quote':

                $is_auth_type = 'auth_reply';

                break;

        case 'editpost':

                $is_auth_type = 'auth_edit';

                break;

        case 'delete':

        case 'poll_delete':

                $is_auth_type = 'auth_delete';

                break;

        case 'vote':

                $is_auth_type = 'auth_vote';

                break;

        case 'topicreview':

                $is_auth_type = 'auth_read';

                break;

/*****[BEGIN]******************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/

		case 'thank':

				$is_auth_type = 'auth_read';

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

                if ( empty($forum_id) )

                {

                        message_die(GENERAL_MESSAGE, $lang['Forum_not_exist']);

                }



                $sql = "SELECT *

                        FROM " . FORUMS_TABLE . "

                        WHERE forum_id = '$forum_id'";

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



if ( ($result = $db->sql_query($sql)) && ($post_info = $db->sql_fetchrow($result)) )

{

        $db->sql_freeresult($result);



        $forum_id = $post_info['forum_id'];

        $forum_name = $post_info['forum_name'];

/*****[BEGIN]******************************************

 [ Mod:     View Topic Name While Posting      v1.0.5 ]

 [ Mod:     Smilies in Topic Titles            v1.0.0 ]

 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]

 ******************************************************/

        $topic_title = ($board_config['smilies_in_titles']) ? smilies_pass($post_info['topic_title']) : $post_info['topic_title'];

/*****[END]********************************************

 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]

 [ Mod:     Smilies in Topic Titles            v1.0.0 ]

 [ Mod:     View Topic Name While Posting      v1.0.5 ]

 ******************************************************/



        $is_auth = auth(AUTH_ALL, $forum_id, $userdata, $post_info);



/*****[BEGIN]******************************************

 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]

 ******************************************************/

        $lock = ( isset($HTTP_POST_VARS['lock']) ) ? TRUE : FALSE;

        $unlock = ( isset($HTTP_POST_VARS['unlock']) ) ? TRUE : FALSE;



        if ( ($submit || $confirm) && ($lock || $unlock) && ($is_auth['auth_mod']) && ($mode != 'newtopic') && (!$refresh) )

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

                if ( !($result = $db->sql_query($sql)) )

                {

                    message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);

                }

            }

        }

/*****[END]********************************************

 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]

 ******************************************************/



        if ( $post_info['forum_status'] == FORUM_LOCKED && !$is_auth['auth_mod'])

        {

           message_die(GENERAL_MESSAGE, $lang['Forum_locked']);

        }

        else if ( $mode != 'newtopic' && $mode != 'thank' && $post_info['topic_status'] == TOPIC_LOCKED && !$is_auth['auth_mod'])

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

                        if ( !($result = $db->sql_query($sql)) )

                        {

                                message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);

                        }



                        $poll_options = array();

                        $poll_results_sum = 0;

                        if ( $row = $db->sql_fetchrow($result) )

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

                                while ( $row = $db->sql_fetchrow($result) );

                        }

                        $db->sql_freeresult($result);



                        $post_data['edit_poll'] = ( ( !$poll_results_sum || $is_auth['auth_mod'] ) && $post_data['first_post'] ) ? true : 0;

                }

                else

                {

                        $post_data['edit_poll'] = ($post_data['first_post'] && $is_auth['auth_pollcreate']) ? true : false;

                }



                //

                // Can this user edit/delete the post/poll?

                //

                if ( $post_info['poster_id'] != $userdata['user_id'] && !$is_auth['auth_mod'] )

                {

                        $message = ( $delete || $mode == 'delete' ) ? $lang['Delete_own_posts'] : $lang['Edit_own_posts'];

                        $message .= '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');



                        message_die(GENERAL_MESSAGE, $message);

                }

                else if ( !$post_data['last_post'] && !$is_auth['auth_mod'] && ( $mode == 'delete' || $delete ) )

                {

                        message_die(GENERAL_MESSAGE, $lang['Cannot_delete_replied']);

                }

                else if ( !$post_data['edit_poll'] && !$is_auth['auth_mod'] && ( $mode == 'poll_delete' || $poll_delete ) )

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

if ( !$is_auth[$is_auth_type] )

{

        if ( $userdata['session_logged_in'] )

        {

                message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_' . $is_auth_type], $is_auth[$is_auth_type . "_type"]));

        }



        switch( $mode )

        {

                case 'newtopic':

                        $redirect = "mode=newtopic&" . POST_FORUM_URL . "=" . $forum_id;

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



        // not needed anymore due to function redirect()

//$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';

        redirect(append_sid("login.$phpEx?redirect=posting.$phpEx&" . $redirect, true));

        exit;

}

/*****[BEGIN]******************************************
 [ Mod:    Password Protect Forums             v0.5.1 ]
 ******************************************************/
if( !$is_auth['auth_mod'] && $userdata['user_level'] != ADMIN )
{
	$redirect = str_replace("&amp;", "&", preg_replace('#.*?([a-z]+?\.' . $phpEx . '.*?)$#i', '\1', htmlspecialchars($HTTP_SERVER_VARS['REQUEST_URI'])));
	if( $HTTP_POST_VARS['cancel'] )
	{
		redirect(append_sid("index.$phpEx"));
	}
	else if( $HTTP_POST_VARS['pass_login'] )
	{
		if( $post_info['topic_password'] != '' )
		{
			password_check('topic', $topic_id, $HTTP_POST_VARS['password'], $redirect);
		}
		else if( $post_info['forum_password'] != '' )
		{
			password_check('forum', $forum_id, $HTTP_POST_VARS['password'], $redirect);
		}
	}

	if( $post_info['topic_password'] != '' && $mode != 'newtopic' )
	{
		$passdata = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_tpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_tpass'])) : '';
		if( $passdata[$topic_id] != md5($post_info['topic_password']) )
		{
			password_box('topic', $redirect);
		}
	}
	else if( $post_info['forum_password'] != '' )
	{
		$passdata = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass'])) : '';
		if( $passdata[$forum_id] != md5($post_info['forum_password']) )
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

if ( !$board_config['allow_html'] )

{

        $html_on = 0;

}

else

{

        $html_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_html']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_html'] : $userdata['user_allowhtml'] );

}



if ( !$board_config['allow_bbcode'] )

{

        $bbcode_on = 0;

}

else

{

        $bbcode_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_bbcode']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );

}



if ( !$board_config['allow_smilies'] )

{

        $smilies_on = 0;

}

else

{

        $smilies_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_smilies']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_smilies'] : $userdata['user_allowsmile'] );

}



if ( ($submit || $refresh) && $is_auth['auth_read'])

{

        $notify_user = ( !empty($HTTP_POST_VARS['notify']) ) ? TRUE : 0;

}

else

{

        if ( $mode != 'newtopic' && $userdata['session_logged_in'] && $is_auth['auth_read'] )

        {

                $sql = "SELECT topic_id

                        FROM " . TOPICS_WATCH_TABLE . "

                        WHERE topic_id = '$topic_id'

                                AND user_id = " . $userdata['user_id'];

                if ( !($result = $db->sql_query($sql)) )

                {

                        message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);

                }



                $notify_user = ( $db->sql_fetchrow($result) ) ? TRUE : $userdata['user_notify'];

        $db->sql_freeresult($result);

        }

        else

        {

                $notify_user = ( $userdata['session_logged_in'] && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;

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



        $template->set_filenames(array(

                'confirm_body' => 'confirm_body.tpl')

        );



        $template->assign_vars(array(

                'MESSAGE_TITLE' => $lang['Information'],

                'MESSAGE_TEXT' => $l_confirm,



                'L_YES' => $lang['Yes'],

                'L_NO' => $lang['No'],



                'S_CONFIRM_ACTION' => append_sid("posting.$phpEx"),

                'S_HIDDEN_FIELDS' => $s_hidden_fields)

        );



        $template->pparse('confirm_body');



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

			$message .=  '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

		}

		if ( empty($topic_id) )

		{

			message_die(GENERAL_MESSAGE, 'No topic Selected');

		}



		$userid = $userdata['user_id'];

		$thanks_date = time();



		// Check if user is the topic starter

		$sql = "SELECT `topic_poster`

				FROM " . TOPICS_TABLE . " 

				WHERE topic_id = $topic_id

				AND topic_poster = $userid";

		if ( !($result = $db->sql_query($sql)) )

		{

			message_die(GENERAL_ERROR, "Couldn't check for topic starter", '', __LINE__, __FILE__, $sql);

					

		}



		if ( ($topic_starter_check = $db->sql_fetchrow($result)) )

		{

			$message = $lang['t_starter'];

			$message .=  '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

		}



		// Check if user had thanked before

		$sql = "SELECT `topic_id`

				FROM " . THANKS_TABLE . " 

				WHERE topic_id = $topic_id

				AND user_id = $userid";

		if ( !($result = $db->sql_query($sql)) )

		{

			message_die(GENERAL_ERROR, "Couldn't check for previous thanks", '', __LINE__, __FILE__, $sql);

					

		}

		if ( !($thankfull_check = $db->sql_fetchrow($result)) )

		{

			// Insert thanks if he/she hasn't

			$sql = "INSERT INTO " . THANKS_TABLE . " (topic_id, user_id, thanks_time) 

			VALUES ('" . $topic_id . "', '" . $userid . "', " . $thanks_date . ") ";

			if ( !($result = $db->sql_query($sql)) )

			{

				message_die(GENERAL_ERROR, "Could not insert thanks information", '', __LINE__, __FILE__, $sql);

					

			}

			$message = $lang['thanks_add'];

		}

		else

		{

			$message = $lang['thanked_before'];

		}



		$template->assign_vars(array(

			'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">')

		);



		$message .=  '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

		

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

                if ( !($result = $db->sql_query($sql)) )

                {

                        message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);

                }



                if ( $vote_info = $db->sql_fetchrow($result) )

                {

                        $vote_id = $vote_info['vote_id'];



                        $sql = "SELECT *

                                FROM " . VOTE_USERS_TABLE . "

                                WHERE vote_id = '$vote_id'

                                        AND vote_user_id = " . $userdata['user_id'];

            if ( !($result2 = $db->sql_query($sql)) )

                        {

                                message_die(GENERAL_ERROR, 'Could not obtain user vote data for this topic', '', __LINE__, __FILE__, $sql);

                        }



            if ( !($row = $db->sql_fetchrow($result2)) )

                        {

                                $sql = "UPDATE " . VOTE_RESULTS_TABLE . "

                                        SET vote_result = vote_result + 1

                                        WHERE vote_id = '$vote_id'

                                                AND vote_option_id = '$vote_option_id'";

                                if ( !$db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, 'Could not update poll result', '', __LINE__, __FILE__, $sql);

                                }



/*****[BEGIN]******************************************

 [ Mod:    Admin Voting                        v1.1.8 ]

 ******************************************************/

                                $sql = "INSERT INTO " . VOTE_USERS_TABLE . " (vote_id, vote_user_id, vote_user_ip, vote_cast)

                                        VALUES ('$vote_id', " . $userdata['user_id'] . ", '$user_ip', '$vote_option_id')";

/*****[END]********************************************

 [ Mod:    Admin Voting                        v1.1.8 ]

 ******************************************************/

                                if ( !$db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Could not insert user_id for poll", "", __LINE__, __FILE__, $sql);

                                }



                                $message = $lang['Vote_cast'];

                        }

                        else

                        {

                                $message = $lang['Already_voted'];

                        }

            $db->sql_freeresult($result2);

                }

                else

                {

                        $message = $lang['No_vote_option'];

                }

        $db->sql_freeresult($result);



                $template->assign_vars(array(

                        'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">')

                );

                $message .=  '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

                message_die(GENERAL_MESSAGE, $message);

        }

        else

        {

                redirect(append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true));

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

    	if ($sid == '' || $sid != $userdata['session_id'])

    	{

    		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Session_invalid'] : $lang['Session_invalid'];

    	}

        switch ( $mode )

        {

                case 'editpost':

/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

                    $username = ( !empty($HTTP_POST_VARS['username']) ) ? $HTTP_POST_VARS['username'] : '';

                    $subject = ( !empty($HTTP_POST_VARS['subject']) ) ? trim($HTTP_POST_VARS['subject']) : '';

                    $message = ( !empty($HTTP_POST_VARS['message']) ) ? $HTTP_POST_VARS['message'] : '';

                    $poll_title = ( isset($HTTP_POST_VARS['poll_title']) && $is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_title'] : '';

                    $poll_options = ( isset($HTTP_POST_VARS['poll_option_text']) && $is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_option_text'] : '';

                    $poll_length = ( isset($HTTP_POST_VARS['poll_length']) && $is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_length'] : '';

/*****[BEGIN]******************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

                    $poll_view_toggle = ( isset($HTTP_POST_VARS['poll_view_toggle']) && $is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_view_toggle'] : '0';

/*****[END]********************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

                    $bbcode_uid = '';



                    prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length, $poll_view_toggle);



                    if ( $error_msg == '' )

                    {

                        $topic_type = ( $topic_type != $post_data['topic_type'] && !$is_auth['auth_sticky'] && !$is_auth['auth_announce']  && !$is_auth['auth_globalannounce'] ) ? $post_data['topic_type'] : $topic_type;



                        /*--FNA REPLACE 1--*/

/*****[BEGIN]******************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/

                        submit_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, str_replace("\'", "''", $username), str_replace("\'", "''", $subject), str_replace("\'", "''", $message), str_replace("\'", "''", $poll_title), $poll_options, $poll_length, $poll_view_toggle, $post_icon);

/*****[END]********************************************

 [ Mod:     Post Icons                         v1.0.1 ]

 ******************************************************/



/*****[BEGIN]******************************************

 [ Mod:      At a Glance Cement                v1.0.0 ]

 ******************************************************/

                         if($is_auth['auth_mod'] && $post_data['first_post']) {

                                $topic_glance_priority = ( isset($HTTP_POST_VARS['topic_glance_priority']) ) ? "1" : "0";

                                $t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];

                                $sqlA = "UPDATE " . TOPICS_TABLE . "

                                SET topic_glance_priority = " . $topic_glance_priority . "

                                WHERE topic_id = " . $topic_id . "

                                AND topic_moved_id = '0'";

                               if ( !($resultA = $db->sql_query($sqlA)) )

                                {

                                    message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);

                                }

                        }

/*****[END]********************************************

 [ Mod:      At a Glance Cement                v1.0.0 ]

 ******************************************************/



                       if ( $is_auth['auth_mod'] )

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

                        $username = ( !empty($HTTP_POST_VARS['username']) ) ? $HTTP_POST_VARS['username'] : '';

                        $subject = ( !empty($HTTP_POST_VARS['subject']) ) ? trim($HTTP_POST_VARS['subject']) : '';

                        $message = ( !empty($HTTP_POST_VARS['message']) ) ? $HTTP_POST_VARS['message'] : '';

                        $poll_title = ( isset($HTTP_POST_VARS['poll_title']) && $is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_title'] : '';

                        $poll_options = ( isset($HTTP_POST_VARS['poll_option_text']) && $is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_option_text'] : '';

                        $poll_length = ( isset($HTTP_POST_VARS['poll_length']) && $is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_length'] : '';

/*****[BEGIN]******************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

                          $poll_view_toggle = ( isset($HTTP_POST_VARS['poll_view_toggle']) && $is_auth['auth_pollcreate'] ) ? $HTTP_POST_VARS['poll_view_toggle'] : '0';

/*****[END]********************************************

 [ Mod:     Must first vote to see Results     v1.0.0 ]

 ******************************************************/

                        $bbcode_uid = '';



                        prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length, $poll_view_toggle);



                        if ( $error_msg == '' )

                        {

/*****[BEGIN]******************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/

                                $topic_type = ( $topic_type != $post_data['topic_type'] && !$is_auth['auth_sticky'] && !$is_auth['auth_announce']  && !$is_auth['auth_globalannounce']) ? $post_data['topic_type'] : $topic_type;

/*****[END]********************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/



                                /*--FNA REPLACE 2--*/

                                submit_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, str_replace("\'", "''", $username), str_replace("\'", "''", $subject), str_replace("\'", "''", $message), str_replace("\'", "''", $poll_title), $poll_options, $poll_length, $poll_view_toggle, $post_icon);



/*****[BEGIN]******************************************

 [ Mod:      At a Glance Cement                v1.0.0 ]

 ******************************************************/

                             if($is_auth['auth_mod'] && $mode == 'newtopic') {

                                $topic_glance_priority = ( isset($HTTP_POST_VARS['topic_glance_priority']) ) ? "1" : "0";

                                $t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];

                                $sqlA = "UPDATE " . TOPICS_TABLE . "

                                SET topic_glance_priority = " . $topic_glance_priority . "

                                WHERE topic_id = " . $topic_id . "

                                AND topic_moved_id = '0'";

                               if ( !($resultA = $db->sql_query($sqlA)) )

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

                     if ( $is_auth['auth_mod'] )

                        {

                           log_action($lang['Delete'], '', $topic_id, $userdata['user_id'], '', '');

                        }

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/



                        delete_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id);

                        /*--FNA #3--*/

                        break;

        }



        if ( $error_msg == '' )

        {

                if ( $mode != 'editpost' )

                {

                        $user_id = ( $mode == 'reply' || $mode == 'newtopic' ) ? $userdata['user_id'] : $post_data['poster_id'];

                        update_post_stats($mode, $post_data, $forum_id, $topic_id, $post_id, $user_id);

/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                        update_reputations($mode, $user_id);
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
                        user_notification($mode, $post_data, $post_info['topic_title'], $forum_id, $topic_id, $post_id, $notify_user);
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

                    if ( !($result = $db->sql_query($sql)) )
                        {
                        message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
                    }
                }
/*****[END]********************************************
 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]
 ******************************************************/

                if ( $mode == 'newtopic' || $mode == 'reply' )
                {
                        $tracking_topics = ( !empty($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();
                        $tracking_forums = ( !empty($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();

                        if ( count($tracking_topics) + count($tracking_forums) == 100 && empty($tracking_topics[$topic_id]) )
                        {
                                asort($tracking_topics);
                                unset($tracking_topics[key($tracking_topics)]);
                        }

                        $tracking_topics[$topic_id] = time();

                        setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
                }

                $template->assign_vars(array(
                        'META' => $return_meta)
                );
                message_die(GENERAL_MESSAGE, $return_message);
        }
}

if( $refresh || isset($HTTP_POST_VARS['del_poll_option']) || $error_msg != '' )
{
        $username = ( !empty($HTTP_POST_VARS['username']) ) ? htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['username']))) : '';
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
                $user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';
        }
        else if ( $mode == 'editpost' )
        {
                $user_sig = ( $post_info['user_sig'] != '' && $board_config['allow_sig'] ) ? $post_info['user_sig'] : '';
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
                $preview_subject = ($board_config['smilies_in_titles']) ? smilies_pass($subject) : $subject;
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
                $preview_subject = ($board_config['smilies_in_titles']) ? smilies_pass($subject) : $subject;
                $preview_username = $username;

                //
                // Finalise processing as per viewtopic
                //
                if( !$html_on )
                {
                        if( $user_sig != '' || !$userdata['user_allowhtml'] )
                        {
                                $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $user_sig);
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
					$resultat = $db->sql_query($sql);
					$valid = $db->sql_numrows($resultat) ? TRUE : FALSE;}

				if( $attach_sig && $user_sig != '' && $userdata['user_sig_bbcode_uid'] )
				{
						$user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
						$user_sig = bbencode_third_pass($user_sig, $userdata['user_sig_bbcode_uid'], $valid);
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
                        $preview_username = ( !empty($username) ) ? preg_replace($orig_word, $replacement_word, $preview_username) : '';
                        $preview_subject = ( !empty($subject) ) ? preg_replace($orig_word, $replacement_word, $preview_subject) : '';
                        $preview_message = ( !empty($preview_message) ) ? preg_replace($orig_word, $replacement_word, $preview_message) : '';
                }

                if( $user_sig != '' )
                {
                        $user_sig = make_clickable($user_sig);
                }
                $preview_message = make_clickable($preview_message);

                if( $smilies_on )
                {
                        if( $userdata['user_allowsmile'] && $user_sig != '' )
                        {
                                $user_sig = smilies_pass($user_sig);
                        }

                        $preview_message = smilies_pass($preview_message);
                }

                if( $attach_sig && $user_sig != '' )
                {
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
                $preview_message = $preview_message . '<br />' . $board_config['sig_line'] . '<br />' . $user_sig;
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

                $template->set_filenames(array(
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

                $template->assign_vars(array(
                        'TOPIC_TITLE' => $preview_subject,
                        'POST_SUBJECT' => $preview_subject,
                        'POSTER_NAME' => $preview_username,
                        'POST_DATE' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
                        'MESSAGE' => $preview_message,

                        'L_POST_SUBJECT' => $lang['Post_subject'],
                        'L_PREVIEW' => $lang['Preview'],
                        'L_POSTED' => $lang['Posted'],
                        'L_POST' => $lang['Post'])
                );
                $template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
        }
        else if( $error_msg != '' )
        {
                $template->set_filenames(array(
                        'reg_header' => 'error_body.tpl')
                );
                $template->assign_vars(array(
                        'ERROR_MESSAGE' => $error_msg)
                );
                $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
        }
}
else
{
        //
        // User default entry point
        //
        if ( $mode == 'newtopic' )
        {
                $user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

                $username = ($userdata['session_logged_in']) ? $userdata['username'] : '';
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
                $user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

                $username = ( $userdata['session_logged_in'] ) ? $userdata['username'] : '';
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
$resultat = $db->sql_query($sql);
if(!$db->sql_numrows($resultat)) {$message = hide_in_quote($message);}
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
                        $user_sig = $post_info['user_sig'];

                        $html_on = ( $post_info['enable_html'] ) ? true : false;
                        $bbcode_on = ( $post_info['enable_bbcode'] ) ? true : false;
                        $smilies_on = ( $post_info['enable_smilies'] ) ? true : false;
                }
                else
                {
                        $attach_sig = ( $userdata['user_attachsig'] ) ? TRUE : 0;
                        $user_sig = $userdata['user_sig'];
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
                         $msg_date =  create_date($board_config['default_dateformat'], $post_info['post_time'], $board_config['board_timezone']);
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
                        $username = ( $post_info['user_id'] == ANONYMOUS && !empty($post_info['post_username']) ) ? $post_info['post_username'] : '';
                }
        }
}

//
// Signature toggle selection
//
if( $user_sig != '' )
{
        $template->assign_block_vars('switch_signature_checkbox', array());
}

//
// HTML toggle selection
//
if ( $board_config['allow_html'] )
{
        $html_status = $lang['HTML_is_ON'];
        $template->assign_block_vars('switch_html_checkbox', array());
}
else
{
        $html_status = $lang['HTML_is_OFF'];
}

//
// BBCode toggle selection
//
if ( $board_config['allow_bbcode'] )
{
        $bbcode_status = $lang['BBCode_is_ON'];
        $template->assign_block_vars('switch_bbcode_checkbox', array());
}
else
{
        $bbcode_status = $lang['BBCode_is_OFF'];
}

//
// Smilies toggle selection
//
if ( $board_config['allow_smilies'] )
{
        $smilies_status = $lang['Smilies_are_ON'];
        $template->assign_block_vars('switch_smilies_checkbox', array());
}
else
{
        $smilies_status = $lang['Smilies_are_OFF'];
}

if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) )
{
        $template->assign_block_vars('switch_username_select', array());
}

//
// Notify checkbox - only show if user is logged in
//
if ( $userdata['session_logged_in'] && $is_auth['auth_read'] )
{
        if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) )
        {
                $template->assign_block_vars('switch_notify_checkbox', array());
        }
}

//
// Delete selection
//
if ( $mode == 'editpost' && ( ( $is_auth['auth_delete'] && $post_data['last_post'] && ( !$post_data['has_poll'] || $post_data['edit_poll'] ) ) || $is_auth['auth_mod'] ) )
{
        $template->assign_block_vars('switch_delete_checkbox', array());
}

/*****[BEGIN]******************************************
 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]
 ******************************************************/
if ( ( $mode == 'editpost' || $mode == 'reply' || $mode == 'quote' || $mode == 'newtopic' ) && ( $is_auth['auth_mod'] ) )
{
    if ( $post_info['topic_status'] == TOPIC_LOCKED )
    {
        $template->assign_block_vars('switch_unlock_topic', array());

        $template->assign_vars(array(
            'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
            'S_UNLOCK_CHECKED' => ( $unlock ) ? 'checked="checked"' : '')
        );
    }
    else if ( $post_info['topic_status'] == TOPIC_UNLOCKED )
    {
        $template->assign_block_vars('switch_lock_topic', array());

        $template->assign_vars(array(
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
 if ( ( $mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post'])) && ( $is_auth['auth_mod'] ) ) {
     if ($post_info['topic_glance_priority']) {
         $checked = 'checked="checked"';
     } else if ($HTTP_POST_VARS['topic_glance_priority']){
         $checked = 'checked="checked"';
     } else {
         $checked = '';
     }
    $template->assign_block_vars('switch_topic_glance_priority', array());
        $template->assign_vars(array(
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
        $template->assign_block_vars('switch_type_toggle', array());



        if( $is_auth['auth_sticky'] )

        {

                $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_STICKY . '"';

                if ( $post_data['topic_type'] == POST_STICKY || $topic_type == POST_STICKY )
                {

                        $topic_type_toggle .= ' checked="checked"';

                }

                $topic_type_toggle .= ' /> ' . $lang['Post_Sticky'] . '&nbsp;&nbsp;';

        }

        if( $is_auth['auth_announce'] )
        {

                $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_ANNOUNCE . '"';

                if ( $post_data['topic_type'] == POST_ANNOUNCE || $topic_type == POST_ANNOUNCE )
                {

                        $topic_type_toggle .= ' checked="checked"';

                }

                $topic_type_toggle .= ' /> ' . $lang['Post_Announcement'] . '&nbsp;&nbsp;';

        }
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
        if( $is_auth['auth_globalannounce'] )
        {
           $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_GLOBAL_ANNOUNCE . '"';
            if ( $post_data['topic_type'] == POST_GLOBAL_ANNOUNCE || $topic_type == POST_GLOBAL_ANNOUNCE )
           {
              $topic_type_toggle .= ' checked="checked"';
           }
           $topic_type_toggle .= ' /> ' . $lang['Post_global_announcement'] . '&nbsp;&nbsp;';
        }
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

        if ( $topic_type_toggle != '' )
        {
                $topic_type_toggle = $lang['Post_topic_as'] . ': <input type="radio" name="topictype" value="' . POST_NORMAL .'"' . ( ( $post_data['topic_type'] == POST_NORMAL || $topic_type == POST_NORMAL ) ? ' checked="checked"' : '' ) . ' /> ' . $lang['Post_Normal'] . '&nbsp;&nbsp;' . $topic_type_toggle;
        }
}



$hidden_form_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
$hidden_form_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

switch( $mode )
{
        case 'newtopic':
                $page_title = $lang['Post_a_new_topic'];
                $hidden_form_fields .= '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
                break;

        case 'reply':
                $page_title = $lang['Post_a_reply'];
                $hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
                break;

        case 'editpost':
                $page_title = $lang['Edit_Post'];
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

$template->set_filenames(array(
        'body' => 'posting_body.tpl',
        'pollbody' => 'posting_poll_body.tpl',
        'reviewbody' => 'posting_topic_review.tpl')
);
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
//make_jumpbox('viewforum.'.$phpEx);
$all_forums = array();
make_jumpbox_ref('viewforum.'.$phpEx, $forum_id, $all_forums);

$parent_id = 0;
for( $i = 0; $i < count($all_forums); $i++ )
{
	if( $all_forums[$i]['forum_id'] == $forum_id )
	{
		$parent_id = $all_forums[$i]['forum_parent'];
	}
}

if( $parent_id )
{
	for( $i = 0; $i < count($all_forums); $i++)
	{
		if( $all_forums[$i]['forum_id'] == $parent_id )
		{
			$template->assign_vars(array(
				'PARENT_FORUM'			=> 1,
				'U_VIEW_PARENT_FORUM'	=> append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id']),
				'PARENT_FORUM_NAME'		=> $all_forums[$i]['forum_name'],
				));
		}
	}
}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

$template->assign_vars(array(
        'FORUM_NAME' => $forum_name,
/*****[BEGIN]******************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
        'TOPIC_SUBJECT' => $topic_title,
/*****[END]********************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
        'L_POST_A' => $page_title,
        'L_POST_SUBJECT' => $lang['Post_subject'],

/*****[BEGIN]******************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
        'U_VIEW_TOPIC' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id"),
/*****[END]********************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
        'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"))
);

//
// This enables the forum/topic title to be output for posting
// but not for privmsg (where it makes no sense)
//
$template->assign_block_vars('switch_not_privmsg', array());

/*****[BEGIN]******************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/
if ( $mode == 'reply' || $mode == 'quote' || $mode == 'editpost' )
{
$template->assign_block_vars('switch_not_privmsg.reply_mode', array());
}
/*****[END]********************************************
 [ Mod:     View Topic Name While Posting      v1.0.5 ]
 ******************************************************/

//
// Output the data to the template
//
$template->assign_vars(array(
        'USERNAME' => $username,
        'SUBJECT' => $subject,
        'MESSAGE' => $message,
        'HTML_STATUS' => $html_status,
        'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
        'SMILIES_STATUS' => $smilies_status,

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

        'L_BBCODE_B_HELP' => $lang['bbcode_b_help'],
        'L_BBCODE_I_HELP' => $lang['bbcode_i_help'],
        'L_BBCODE_U_HELP' => $lang['bbcode_u_help'],
        'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'],
        'L_BBCODE_C_HELP' => $lang['bbcode_c_help'],
        'L_BBCODE_L_HELP' => $lang['bbcode_l_help'],
        'L_BBCODE_O_HELP' => $lang['bbcode_o_help'],
        'L_BBCODE_P_HELP' => $lang['bbcode_p_help'],
        'L_BBCODE_W_HELP' => $lang['bbcode_w_help'],
        'L_BBCODE_A_HELP' => $lang['bbcode_a_help'],
        'L_BBCODE_S_HELP' => $lang['bbcode_s_help'],
        'L_BBCODE_F_HELP' => $lang['bbcode_f_help'],
        'L_EMPTY_MESSAGE' => $lang['Empty_message'],

        'L_FONT_COLOR' => $lang['Font_color'],
        'L_COLOR_DEFAULT' => $lang['color_default'],
        'L_COLOR_DARK_RED' => $lang['color_dark_red'],
        'L_COLOR_RED' => $lang['color_red'],
        'L_COLOR_ORANGE' => $lang['color_orange'],
        'L_COLOR_BROWN' => $lang['color_brown'],
        'L_COLOR_YELLOW' => $lang['color_yellow'],
        'L_COLOR_GREEN' => $lang['color_green'],
        'L_COLOR_OLIVE' => $lang['color_olive'],
        'L_COLOR_CYAN' => $lang['color_cyan'],
        'L_COLOR_BLUE' => $lang['color_blue'],
        'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'],
        'L_COLOR_INDIGO' => $lang['color_indigo'],
        'L_COLOR_VIOLET' => $lang['color_violet'],
        'L_COLOR_WHITE' => $lang['color_white'],
        'L_COLOR_BLACK' => $lang['color_black'],
/*****[BEGIN]******************************************
[ Base:    XtraColors                            v1.0 ]
******************************************************/
        'L_COLOR_CADET_BLUE' => $lang['color_cadet_blue'],
        'L_COLOR_CORAL' => $lang['color_coral'],
        'L_COLOR_CRIMSON' => $lang['color_crimson'],
        'L_COLOR_TOMATO' => $lang['color_tomato'],
        'L_COLOR_SEA_GREEN' => $lang['color_sea_green'],
        'L_COLOR_DARK_ORCHID' => $lang['color_dark_orchid'],
        'L_COLOR_CHOCOLATE' => $lang['color_chocolate'],
        'L_COLOR_DEEPSKYBLUE' => $lang['color_deepskyblue'],
        'L_COLOR_GOLD' => $lang['color_gold'],
        'L_COLOR_GRAY' => $lang['color_gray'],
        'L_COLOR_MIDNIGHTBLUE' => $lang['color_midnightblue'],
        'L_COLOR_DARKGREEN' => $lang['color_darkgreen'], 
/*****[END]*******************************************
[ Base:    XtraColors                            v1.0 ]
******************************************************/
        'L_FONT_SIZE' => $lang['Font_size'],
        'L_FONT_TINY' => $lang['font_tiny'],
        'L_FONT_SMALL' => $lang['font_small'],
        'L_FONT_NORMAL' => $lang['font_normal'],
        'L_FONT_LARGE' => $lang['font_large'],
        'L_FONT_HUGE' => $lang['font_huge'],

        'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'],
        'L_STYLES_TIP' => $lang['Styles_tip'],

        'U_VIEWTOPIC' => ( $mode == 'reply' ) ? append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postorder=desc") : '',
        'U_REVIEW_TOPIC' => ( $mode == 'reply' ) ? append_sid("posting.$phpEx?mode=topicreview&amp;" . POST_TOPIC_URL . "=$topic_id&popup=1") : '',

        'S_HTML_CHECKED' => ( !$html_on ) ? 'checked="checked"' : '',
        'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? 'checked="checked"' : '',
        'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : '',
        'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? 'checked="checked"' : '',
        'S_NOTIFY_CHECKED' => ( $notify_user ) ? 'checked="checked"' : '',
        'S_TYPE_TOGGLE' => $topic_type_toggle,
        'S_TOPIC_ID' => $topic_id,
        'S_POST_ACTION' => append_sid("posting.$phpEx"),
        'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
);

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
// get the number of icon per row from config

$icon_per_row = isset($board_config['icon_per_row']) ? intval($board_config['icon_per_row']) : 10;
if ($icon_per_row <= 1)
{
	$icon_per_row = 10;
}

// get the list of icon available to the user

$icones_sort = array();
for ($i = 0; $i < count($icones); $i++)
{
	switch ($icones[$i]['auth'])
	{

		case AUTH_ADMIN:
			if ( $userdata['user_level'] == ADMIN )
			{
				$icones_sort[] = $i;
			}
			break;
		case AUTH_MOD:
			if ( $is_auth['auth_mod'] )
			{
				$icones_sort[] = $i;
			}
			break;
		case AUTH_REG:
			if ( $userdata['session_logged_in'] )
			{
				$icones_sort[] = $i;
			}
			break;
		default:
			$icones_sort[] = $i;
			break;
	}
}

// check if the icon exists

$found = false;
for ($i=0; ( ($i < count($icones_sort)) && !$found );$i++)
{
	$found = ($icones[ $icones_sort[$i] ]['ind'] == $post_icon);
}

if (!$found) $post_icon = 0;

// send to template

$template->assign_block_vars('switch_icon_checkbox', array());
$template->assign_vars(array(
	'L_ICON_TITLE' => $lang['post_icon_title'],
	)
);

// display the icons

$nb_row = intval( (count($icones_sort)-1) / $icon_per_row )+1;
$offset = 0;
for ($i=0; $i < $nb_row; $i++)

{
	$template->assign_block_vars('switch_icon_checkbox.row',array());
	for ($j=0; ( ($j < $icon_per_row) && ($offset < count($icones_sort)) ); $j++)

	{
		$icon_id  = $icones_sort[$offset];

		// send to cell or cell_none

		$template->assign_block_vars('switch_icon_checkbox.row.cell', array(
			'ICON_ID'		=> $icones[$icon_id]['ind'],
			'ICON_CHECKED'	=> ($post_icon == $icones[$icon_id]['ind']) ? ' checked="checked"' : '',
			'ICON_IMG'		=> get_icon_title($icones[$icon_id]['ind'], 2),

			)
		);

		$offset++;
	}
}
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

//
// Poll entry switch/output
//
if( ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['edit_poll']) ) && $is_auth['auth_pollcreate'] )
{
        $template->assign_vars(array(
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
                $template->assign_block_vars('switch_poll_delete_toggle', array());
        }

        if( !empty($poll_options) )
        {
                while( list($option_id, $option_text) = each($poll_options) )
                {
                        $template->assign_block_vars('poll_option_rows', array(
                                'POLL_OPTION' => str_replace('"', '&quot;', $option_text),

                                'S_POLL_OPTION_NUM' => $option_id)
                        );
                }
        }

        $template->assign_var_from_handle('POLLBOX', 'pollbody');
}

//
// Topic review
//
if( $mode == 'reply' && $is_auth['auth_read'] )
{
        require("includes/topic_review.$phpEx");
        topic_review($topic_id, true);

        $template->assign_block_vars('switch_inline_mode', array());
        $template->assign_var_from_handle('TOPIC_REVIEW_BOX', 'reviewbody');
}

$template->pparse('body');

include("includes/page_tail.$phpEx");

?>