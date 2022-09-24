<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                 modcp.php
 *                            -------------------
 *   begin                : July 4, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: modcp.php,v 1.71.2.26 2005/06/26 12:03:46 acydburn Exp
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

/***************************************************************************
 * Moderator Control Panel
 *
 * From this 'Control Panel' the moderator of a forum will be able to do
 * mass topic operations (locking/unlocking/moving/deleteing), and it will
 * provide an interface to do quick locking/unlocking/moving/deleting of
 * topics via the moderator operations buttons on all of the viewtopic pages.
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Global Announcements                     v1.2.8       06/13/2005
      Topic Cement                             v1.0.3       06/15/2005
      Log Moderator Actions                    v1.1.6       08/06/2005
      Advanced Username Color                  v1.0.5       08/21/2005
      Smilies in Topic Titles                  v1.0.0       08/23/2005
      Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
      Auto Group                               v1.2.2       11/06/2006
	  Thank You Mod                            v1.1.8
	  Who viewed a topic                       v1.0.3
 ************************************************************************/

if (!defined('MODULE_FILE')) {

   die ("You can't access this file directly...");

}



$titanium_module_name = basename(dirname(__FILE__));

require("modules/".$titanium_module_name."/nukebb.php");



define('IN_PHPBB2', true);

include($phpbb2_root_path . 'extension.inc');

include($phpbb2_root_path . 'common.'.$phpEx);

include("includes/bbcode.$phpEx");

include("includes/functions_admin.$phpEx");

/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
include($phpbb2_root_path . 'reputation_common.'.$phpEx);
/*****[END]********************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

include("includes/functions_log.$phpEx");

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/



//

// Obtain initial var settings

//



if (isset($_REQUEST['mode']) && is_array($_REQUEST['mode']))

{

	$mode = request_var('mode', array(''));

	list($mode, ) = each($mode);

}

else

{

	$mode = request_var('mode', '');

}



$post_id = request_var('p', 0);

$topic_id = request_var('t', 0);

$phpbb2_forum_id = request_var('f', 0);



$confirm = ( $_POST['confirm'] ) ? TRUE : 0;



//

// Continue var definitions

//

$phpbb2_start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

$phpbb2_start = ($phpbb2_start < 0) ? 0 : $phpbb2_start;



$delete = ( isset($_POST['delete']) ) ? true : false;

$move = ( isset($_POST['move']) ) ? true : false;

$lock		= (isset($_POST['lock'])) ? true : false;

$unlock = ( isset($_POST['unlock']) ) ? true : false;

/*****[BEGIN]******************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

$cement = ( isset($_POST['cement']) ) ? true : false;

/*****[END]********************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/



if (isset($_REQUEST['mode']))

{

	$mode		= ($delete && $phpbb2_start) ? 'delete' : request_var('mode', '');

}

else

{

        if ( $delete )

        {

                $mode = 'delete';

        }

        else if ( $move )

        {

                $mode = 'move';

        }

        else if ( $lock )

        {

                $mode = 'lock';

        }

        else if ( $unlock )

        {

                $mode = 'unlock';

        }

/*****[BEGIN]******************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

    else if ( $cement )

    {

        $mode = 'cement';

    }

/*****[END]********************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

        else

        {

                $mode = '';

        }

}

// session id check

if (isset($_REQUEST['sid']) && is_array($_REQUEST['sid']))

{

	$sid = request_var('sid', array(''));

	list($sid, ) = each($sid);

}

else

{

	$sid = request_var('sid', '');

}



//

// Obtain relevant data

//

if ( !empty($topic_id) )

{

        $sql = "SELECT f.forum_id, f.forum_name, f.forum_topics

                FROM (" . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f)

                WHERE t.topic_id = " . $topic_id . "

                        AND f.forum_id = t.forum_id";

        if ( !($result = $titanium_db->sql_query($sql)) )

        {

                message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');

        }

        $topic_row = $titanium_db->sql_fetchrow($result);



    if (!$topic_row)

    {

        message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');

    }



        $forum_topics = ( $topic_row['forum_topics'] == 0 ) ? 1 : $topic_row['forum_topics'];

        $phpbb2_forum_id = $topic_row['forum_id'];

        $forum_name = $topic_row['forum_name'];

}

else if ( !empty($phpbb2_forum_id) )

{

        $sql = "SELECT forum_name, forum_topics

                FROM " . FORUMS_TABLE . "

                WHERE forum_id = " . $phpbb2_forum_id;

        if ( !($result = $titanium_db->sql_query($sql)) )

        {

                message_die(GENERAL_MESSAGE, 'Forum_not_exist');

        }

        $topic_row = $titanium_db->sql_fetchrow($result);



    if (!$topic_row)

    {

        message_die(GENERAL_MESSAGE, 'Forum_not_exist');

    }



        $forum_topics = ( $topic_row['forum_topics'] == 0 ) ? 1 : $topic_row['forum_topics'];

        $forum_name = $topic_row['forum_name'];

}

else

{

        message_die(GENERAL_MESSAGE, 'Forum_not_exist');

}



//

// Start session management

//

$userdata = titanium_session_pagestart($titanium_user_ip, $phpbb2_forum_id);

titanium_init_userprefs($userdata);

//

// End session management

//



// session id check

//if (empty($sid) || $sid != $userdata['session_id'])

//{

//        message_die(GENERAL_ERROR, 'Invalid_session');

//}



//

// Check if user did or did not confirm

// If they did not, forward them to the last page they were on

//

if ( isset($HTTP_POST_VARS['cancel']) )

{

        if ( $topic_id )

        {

                $redirect = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id";

        }

        else if ( $phpbb2_forum_id )

        {

                $redirect = "viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id";

        }

        else

        {

                $redirect = "index.$phpEx";

        }



        // not needed anymore due to function redirect_titanium()

        //$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';

        redirect_titanium(append_titanium_sid($redirect, true));

        exit;

}



//

// Start auth check

//

$phpbb2_is_auth = auth(AUTH_ALL, $phpbb2_forum_id, $userdata);



if ( !$phpbb2_is_auth['auth_mod'] )

{

        message_die(GENERAL_MESSAGE, $titanium_lang['Not_Moderator'], $titanium_lang['Not_Authorised']);

}

//

// End Auth Check

//



//

// Do major work ...

//

switch( $mode )

{

        case 'delete':

                if (!$phpbb2_is_auth['auth_delete'])

                {

                        message_die(GENERAL_MESSAGE, sprintf($titanium_lang['Sorry_auth_delete'], $phpbb2_is_auth['auth_delete_type']));

                }



                $phpbb2_page_title = $titanium_lang['Mod_CP'];

                include("includes/page_header.$phpEx");



                if ( $confirm )

                {



               			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )

            			{

             				message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

             			}

                        include("includes/functions_search.$phpEx");



                        $phpbb2_topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ? $HTTP_POST_VARS['topic_id_list'] : array($topic_id);



                        $topic_id_sql = '';

                        for($i = 0; $i < count($phpbb2_topics); $i++)

                        {

                $topic_id_sql .= ( ( !empty($topic_id_sql) ) ? ', ' : '' ) . intval($phpbb2_topics[$i]);

            }



            $sql = "SELECT topic_id

                FROM " . TOPICS_TABLE . "

                WHERE topic_id IN ($topic_id_sql)

                    AND forum_id = '$phpbb2_forum_id'";

            if ( !($result = $titanium_db->sql_query($sql)) )

            {

                message_die(GENERAL_ERROR, 'Could not get topic id information', '', __LINE__, __FILE__, $sql);

            }



            $topic_id_sql = '';

            while ($row = $titanium_db->sql_fetchrow($result))

            {

                $topic_id_sql .= ((!empty($topic_id_sql)) ? ', ' : '') . intval($row['topic_id']);

            }

            $titanium_db->sql_freeresult($result);



             			if ( $topic_id_sql == '')

             			{

             				message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

             			}

                        $sql = "SELECT poster_id, COUNT(post_id) AS posts

                                FROM " . POSTS_TABLE . "

                                WHERE topic_id IN ($topic_id_sql)

                                GROUP BY poster_id";

                        if ( !($result = $titanium_db->sql_query($sql)) )

                        {

                                message_die(GENERAL_ERROR, 'Could not get poster id information', '', __LINE__, __FILE__, $sql);

                        }



                        $count_sql = array();

/*****[BEGIN]******************************************

 [ Mod:    Auto Group                          v1.2.2 ]

 ******************************************************/

                        $titanium_user_updated = array();

/*****[END]********************************************

 [ Mod:    Auto Group                          v1.2.2 ]

 ******************************************************/

                        while ( $row = $titanium_db->sql_fetchrow($result) )

                        {
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                                $rep = ($rep_config['posts_to_earn'] != 0) ? (1/$rep_config['posts_to_earn']) : 0;
                                $count_sql[] = "UPDATE " . USERS_TABLE . "

                                        SET user_posts = user_posts - " . $row['posts'] . ", user_reputation = user_reputation - " . $rep . "
                                        WHERE user_id = " . $row['poster_id'];
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************

 [ Mod:    Auto Group                          v1.2.2 ]

 ******************************************************/

                                $titanium_user_updated [] = "SELECT ug.user_id, g.group_id as g_id, u.user_posts, g.group_count, g.group_count_max, ".$row['poster_id']." as u_id FROM (" . GROUPS_TABLE . " g, ".USERS_TABLE." u)

                                        LEFT JOIN ". USER_GROUP_TABLE." ug ON g.group_id=ug.group_id AND ug.user_id=".$row['poster_id']."

                                        WHERE u.user_id=".$row['poster_id']."

                                        AND g.group_single_user=0

                                        AND g.group_count_enable=1

                                        AND g.group_moderator<>".$row['poster_id'];

/*****[END]********************************************

 [ Mod:    Auto Group                          v1.2.2 ]

 ******************************************************/

                        }

                        $titanium_db->sql_freeresult($result);



                        if ( count($count_sql) )

                        {

                                for($i = 0; $i < count($count_sql); $i++)

                                {

                                        if ( !$titanium_db->sql_query($count_sql[$i]) )

                                        {

                                                message_die(GENERAL_ERROR, 'Could not update user post count information', '', __LINE__, __FILE__, $sql);

                                        }

                                }

                        }



/*****[BEGIN]******************************************

 [ Mod:    Auto Group                          v1.2.2 ]

 ******************************************************/

                        if ( sizeof($titanium_user_updated) )

                        {

                        	for($i = 0; $i < sizeof($titanium_user_updated); $i++)

                        	{

                        		if ( !($result = $titanium_db->sql_query($titanium_user_updated[$i])) )

                        		{

                        			message_die(GENERAL_ERROR, 'Error geting users post stat', '', __LINE__, __FILE__, $titanium_user_updated[$i]);

                        		}

                        		while ($group_data = $titanium_db->sql_fetchrow($result))

                        		{

                        			$titanium_user_already_added = (!empty($group_data['user_id']) || $group_data['u_id']==ANONYMOUS) ? TRUE : FALSE;

                        			$titanium_user_add = ($group_data['group_count'] == $group_data['user_posts'] && $group_data['u_id']!=ANONYMOUS) ? TRUE : FALSE;

                        			$titanium_user_remove = ($group_data['group_count'] > $group_data['user_posts'] && $group_data['u_id']!=ANONYMOUS) ? TRUE : FALSE;

                        			if ($titanium_user_add && !$titanium_user_already_added)

                        			{

                        				//user join a autogroup

                        				$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)

                        					VALUES (".$group_data['g_id'].", ".$group_data['u_id'].", '0')";

                        				if ( !($titanium_db->sql_query($sql)) )

                        				{

                        					message_die(GENERAL_ERROR, 'Error insert users, group count', '', __LINE__, __FILE__, $sql);

                        				}

                        			} else

                        			if ( $titanium_user_already_added && $titanium_user_remove)

                        			{

                        				//remove user from autogroup

                        				$sql = "DELETE FROM " . USER_GROUP_TABLE . "

                        					WHERE group_id=".$group_data['g_id']."

                        					AND user_id=".$group_data['u_id'];

                        				if ( !($titanium_db->sql_query($sql)) )

                        				{

                        					message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);

                        				}

                        			}

                        			unset ($group_data);

                        		}

                        		$titanium_db->sql_freeresult($result);

                        	}

                        }

/*****[END]********************************************

 [ Mod:    Auto Group                          v1.2.2 ]

 ******************************************************/

                        $sql = "SELECT post_id

                                FROM " . POSTS_TABLE . "

                                WHERE topic_id IN ($topic_id_sql)";

                        if ( !($result = $titanium_db->sql_query($sql)) )

                        {

                                message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);

                        }



                        $post_id_sql = '';

                        while ( $row = $titanium_db->sql_fetchrow($result) )

                        {

                                $post_id_sql .= ( ( !empty($post_id_sql) ) ? ', ' : '' ) . intval($row['post_id']);

                        }

                        $titanium_db->sql_freeresult($result);



                        $sql = "SELECT vote_id

                                FROM " . VOTE_DESC_TABLE . "

                                WHERE topic_id IN ($topic_id_sql)";

                        if ( !($result = $titanium_db->sql_query($sql)) )

                        {

                                message_die(GENERAL_ERROR, 'Could not get vote id information', '', __LINE__, __FILE__, $sql);

                        }



                        $vote_id_sql = '';

                        while ( $row = $titanium_db->sql_fetchrow($result) )

                        {

                                $vote_id_sql .= ( ( !empty($vote_id_sql) ) ? ', ' : '' ) . $row['vote_id'];

                        }

                        $titanium_db->sql_freeresult($result);

						

/*****[BEGIN]******************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/

						$sql = "DELETE FROM " . THANKS_TABLE . "

								WHERE topic_id IN ($topic_id_sql)";

						if ( !$titanium_db->sql_query($sql) )

						{

							message_die(GENERAL_ERROR, 'Error in deleting Thanks post Information', '', __LINE__, __FILE__, $sql);

						}

/*****[END]********************************************

 [ Mod:    Thank You Mod                       v1.1.8 ]

 ******************************************************/



                        //

                        // Got all required info so go ahead and start deleting everything

                        //

                        $sql = "DELETE

                                FROM " . TOPICS_TABLE . "

                                WHERE topic_id IN ($topic_id_sql)

                                        OR topic_moved_id IN ($topic_id_sql)";

                        if ( !$titanium_db->sql_query($sql) )

                        {

							message_die(GENERAL_ERROR, 'Could not delete topics', '', __LINE__, __FILE__, $sql);

                        }



                        if ( !empty($post_id_sql) )

                        {

                                $sql = "DELETE

                                        FROM " . POSTS_TABLE . "

                                        WHERE post_id IN ($post_id_sql)";

                                if ( !$titanium_db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, 'Could not delete posts', '', __LINE__, __FILE__, $sql);

                                }

/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

                                 log_action('delete', '', $topic_id_sql, $userdata['user_id'], '', '');

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/



                                $sql = "DELETE

                                        FROM " . POSTS_TEXT_TABLE . "

                                        WHERE post_id IN ($post_id_sql)";



                                if ( !$titanium_db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, 'Could not delete posts text', '', __LINE__, __FILE__, $sql);

                                }



                                remove_search_post($post_id_sql);

/*****[BEGIN]******************************************

 [ Mod:    Attachment Mod                      v2.4.1 ]

 ******************************************************/

                                delete_attachment(explode(', ', $post_id_sql));

/*****[END]********************************************

 [ Mod:    Attachment Mod                      v2.4.1 ]

 ******************************************************/

                        }



                        if ( !empty($vote_id_sql) )

                        {

                                $sql = "DELETE

                                        FROM " . VOTE_DESC_TABLE . "

                                        WHERE vote_id IN ($vote_id_sql)";

                                if ( !$titanium_db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, 'Could not delete vote descriptions', '', __LINE__, __FILE__, $sql);

                                }



                                $sql = "DELETE

                                        FROM " . VOTE_RESULTS_TABLE . "

                                        WHERE vote_id IN ($vote_id_sql)";

                                if ( !$titanium_db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, 'Could not delete vote results', '', __LINE__, __FILE__, $sql);

                                }



                                $sql = "DELETE

                                        FROM " . VOTE_USERS_TABLE . "

                                        WHERE vote_id IN ($vote_id_sql)";

                                if ( !$titanium_db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, 'Could not delete vote users', '', __LINE__, __FILE__, $sql);

                                }

                        }



                        $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . " WHERE topic_id IN ($topic_id_sql)";
                        if ( !$titanium_db->sql_query($sql) )
                        {
                            message_die(GENERAL_ERROR, 'Could not delete watched post list', '', __LINE__, __FILE__, $sql);
                        }

/*****[START]******************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/
						$sql = "DELETE FROM " . TOPIC_VIEW_TABLE . " WHERE topic_id IN ($topic_id_sql)"; 
						if ( !$titanium_db->sql_query($sql, END_TRANSACTION) ) 
						{ 
							message_die(GENERAL_ERROR, 'Could not delete viewed post list', '', __LINE__, __FILE__, $sql); 
						}
/*****[END]********************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/

                        sync('forum', $phpbb2_forum_id);

                        if ( !empty($topic_id) )
                        {
                                $redirect_page = append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id");
                                $l_redirect = sprintf($titanium_lang['Click_return_forum'], '<a href="' . $redirect_page . '">', '</a>');
                        }
                        else
                        {
                                $redirect_page = append_titanium_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id");
                                $l_redirect = sprintf($titanium_lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
                        }

                        $phpbb2_template->assign_vars(array(
                                'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
                        );

                        message_die(GENERAL_MESSAGE, $titanium_lang['Topics_Removed'] . '<br /><br />' . $l_redirect);
                }
                else
                {

                        // Not confirmed, show confirmation message

                        if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )

                        {

                                message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

                        }



                        $hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $phpbb2_forum_id . '" />';



                        if ( isset($HTTP_POST_VARS['topic_id_list']) )

                        {

                                $phpbb2_topics = $HTTP_POST_VARS['topic_id_list'];

                                for($i = 0; $i < count($phpbb2_topics); $i++)

                                {

                                        $hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($phpbb2_topics[$i]) . '" />';

                                }

                        }

                        else

                        {

                                $hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';

                        }



                        //

                        // Set template files

                        //

                        $phpbb2_template->set_filenames(array(

                                'confirm' => 'confirm_body.tpl')

                        );



/*****[BEGIN]******************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/

			$all_forums = array();

			make_jumpbox_ref('modcp.'.$phpEx, $phpbb2_forum_id, $all_forums);



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

                                'MESSAGE_TITLE' => $titanium_lang['Confirm'],

                                'MESSAGE_TEXT' => $titanium_lang['Confirm_delete_topic'],



                                'L_YES' => $titanium_lang['Yes'],

                                'L_NO' => $titanium_lang['No'],



                                'S_CONFIRM_ACTION' => append_titanium_sid("modcp.$phpEx"),

                                'S_HIDDEN_FIELDS' => $hidden_fields)

                        );



                        $phpbb2_template->pparse('confirm');



                        include("includes/page_tail.$phpEx");

                }

                break;



        case 'move':

                $phpbb2_page_title = $titanium_lang['Mod_CP'];

                include("includes/page_header.$phpEx");



                if ( $confirm )

                {

                        if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )

                        {

                                message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

                        }



                        $new_forum_id = intval($HTTP_POST_VARS['new_forum']);

                        $old_forum_id = $phpbb2_forum_id;



                               $sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . '

                              WHERE forum_id = ' . $new_forum_id;

                           if ( !($result = $titanium_db->sql_query($sql)) )

                           {

                              message_die(GENERAL_ERROR, 'Could not select from forums table', '', __LINE__, __FILE__, $sql);

                           }



                           if (!$titanium_db->sql_fetchrow($result))

                           {

                              message_die(GENERAL_MESSAGE, 'New forum does not exist');

                           }



                           $titanium_db->sql_freeresult($result);



                        if ( $new_forum_id != $old_forum_id )

                        {

                                $phpbb2_topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?  $HTTP_POST_VARS['topic_id_list'] : array($topic_id);



                                $topic_list = '';

                                for($i = 0; $i < count($phpbb2_topics); $i++)

                                {

                                        $topic_list .= ( ( !empty($topic_list) ) ? ', ' : '' ) . intval($phpbb2_topics[$i]);

                                }



                                $sql = "SELECT *

                                        FROM " . TOPICS_TABLE . "

                                        WHERE topic_id IN ($topic_list)

                        AND forum_id = '$old_forum_id'

                                                AND topic_status <> " . TOPIC_MOVED;

                                if ( !($result = $titanium_db->sql_query($sql)) )

                                {

                                        message_die(GENERAL_ERROR, 'Could not select from topic table', '', __LINE__, __FILE__, $sql);

                                }



                                $row = $titanium_db->sql_fetchrowset($result);

                                $titanium_db->sql_freeresult($result);



                                for($i = 0; $i < count($row); $i++)

                                {

                                        $topic_id = $row[$i]['topic_id'];



                                        if ( isset($HTTP_POST_VARS['move_leave_shadow']) )

                                        {

                                                // Insert topic in the old forum that indicates that the forum has moved.

                                                $sql = "INSERT INTO " . TOPICS_TABLE . " (forum_id, topic_title, topic_poster, topic_time, topic_status, topic_type, topic_vote, topic_views, topic_replies, topic_first_post_id, topic_last_post_id, topic_moved_id)

                                                        VALUES ('$old_forum_id', '" . addslashes(str_replace("\'", "''", $row[$i]['topic_title'])) . "', '" . str_replace("\'", "''", $row[$i]['topic_poster']) . "', " . $row[$i]['topic_time'] . ", " . TOPIC_MOVED . ", " . POST_NORMAL . ", " . $row[$i]['topic_vote'] . ", " . $row[$i]['topic_views'] . ", " . $row[$i]['topic_replies'] . ", " . $row[$i]['topic_first_post_id'] . ", " . $row[$i]['topic_last_post_id'] . ", '$topic_id')";

                                                if ( !$titanium_db->sql_query($sql) )

                                                {

                                                        message_die(GENERAL_ERROR, 'Could not insert shadow topic', '', __LINE__, __FILE__, $sql);

                                                }

                                        }



/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

                                        log_action('move', '', $topic_id, $userdata['user_id'], $old_forum_id, $new_forum_id);

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/



                                        $sql = "UPDATE " . TOPICS_TABLE . "

                                                SET forum_id = '$new_forum_id'

                                                WHERE topic_id = '$topic_id'";

                                        if ( !$titanium_db->sql_query($sql) )

                                        {

                                                message_die(GENERAL_ERROR, 'Could not update old topic', '', __LINE__, __FILE__, $sql);

                                        }



                                        $sql = "UPDATE " . POSTS_TABLE . "

                                                SET forum_id = '$new_forum_id'

                                                WHERE topic_id = '$topic_id'";

                                        if ( !$titanium_db->sql_query($sql) )

                                        {

                                                message_die(GENERAL_ERROR, 'Could not update post topic ids', '', __LINE__, __FILE__, $sql);

                                        }

                                }



                                // Sync the forum indexes

                                sync('forum', $new_forum_id);

                                sync('forum', $old_forum_id);



                                $message = $titanium_lang['Topics_Moved'] . '<br /><br />';



                        }

                        else

                        {

                                $message = $titanium_lang['No_Topics_Moved'] . '<br /><br />';

                        }



                        if ( !empty($topic_id) )

                        {

                                $redirect_page = append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");

                                $message .= sprintf($titanium_lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');

                        }

                        else

                        {

                                $redirect_page = append_titanium_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id");

                                $message .= sprintf($titanium_lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');

                        }



                        $message = $message . '<br /><br />' . sprintf($titanium_lang['Click_return_forum'], '<a href="' . append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$old_forum_id") . '">', '</a>');



                        $phpbb2_template->assign_vars(array(

                                'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')

                        );



                        message_die(GENERAL_MESSAGE, $message);

                }

                else

                {

                        if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )

                        {

                                message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

                        }



                        $hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $phpbb2_forum_id . '" />';



                        if ( isset($HTTP_POST_VARS['topic_id_list']) )

                        {

                                $phpbb2_topics = $HTTP_POST_VARS['topic_id_list'];



                                for($i = 0; $i < count($phpbb2_topics); $i++)

                                {

                                        $hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($phpbb2_topics[$i]) . '" />';

                                }

                        }

                        else

                        {

                                $hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';

                        }



                        //

                        // Set template files

                        //

                        $phpbb2_template->set_filenames(array(

                                'movetopic' => 'modcp_move.tpl')

                        );



                        $phpbb2_template->assign_vars(array(

                                'MESSAGE_TITLE' => $titanium_lang['Confirm'],

                                'MESSAGE_TEXT' => $titanium_lang['Confirm_move_topic'],



                                'L_MOVE_TO_FORUM' => $titanium_lang['Move_to_forum'],

                                'L_LEAVESHADOW' => $titanium_lang['Leave_shadow_topic'],

                                'L_YES' => $titanium_lang['Yes'],

                                'L_NO' => $titanium_lang['No'],



                                'S_FORUM_SELECT' => make_forum_select('new_forum', $phpbb2_forum_id),

                                'S_MODCP_ACTION' => append_titanium_sid("modcp.$phpEx"),

                                'S_HIDDEN_FIELDS' => $hidden_fields)

                        );



                        $phpbb2_template->pparse('movetopic');



                        include("includes/page_tail.$phpEx");

                }

                break;



        case 'lock':

                if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )

                {

                        message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

                }



                $phpbb2_topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?  $HTTP_POST_VARS['topic_id_list'] : array($topic_id);



                $topic_id_sql = '';

                for($i = 0; $i < count($phpbb2_topics); $i++)

                {

                        $topic_id_sql .= ( ( !empty($topic_id_sql) ) ? ', ' : '' ) . intval($phpbb2_topics[$i]);

                }



/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

                log_action('lock', '', $topic_id_sql, $userdata['user_id'], '', '');

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/



                $sql = "UPDATE " . TOPICS_TABLE . "

                        SET topic_status = " . TOPIC_LOCKED . "

                        WHERE topic_id IN ($topic_id_sql)

                        AND forum_id = '$phpbb2_forum_id'

                        AND topic_moved_id = '0'";

                if ( !($result = $titanium_db->sql_query($sql)) )

                {

                        message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);

                }



                if ( !empty($topic_id) )

                {

                        $redirect_page = append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");

                        $message = sprintf($titanium_lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');

                }

                else

                {

                        $redirect_page = append_titanium_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id");

                        $message = sprintf($titanium_lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');

                }



                $message = $message . '<br /><br />' . sprintf($titanium_lang['Click_return_forum'], '<a href="' . append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id") . '">', '</a>');



                $phpbb2_template->assign_vars(array(

                        'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')

                );



                message_die(GENERAL_MESSAGE, $titanium_lang['Topics_Locked'] . '<br /><br />' . $message);



                break;



        case 'unlock':

                if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )

                {

                        message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

                }



                $phpbb2_topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?  $HTTP_POST_VARS['topic_id_list'] : array($topic_id);



                $topic_id_sql = '';

                for($i = 0; $i < count($phpbb2_topics); $i++)

                {

                        $topic_id_sql .= ( ( !empty($topic_id_sql) ) ? ', ' : '' ) . intval($phpbb2_topics[$i]);

                }



                $sql = "UPDATE " . TOPICS_TABLE . "

                        SET topic_status = " . TOPIC_UNLOCKED . "

                        WHERE topic_id IN ($topic_id_sql)

                        AND forum_id = '$phpbb2_forum_id'

                        AND topic_moved_id = '0'";

                if ( !($result = $titanium_db->sql_query($sql)) )

                {

                        message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);

                }



/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

                log_action('unlock', '', $topic_id_sql, $userdata['user_id'], '', '');

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/



                if ( !empty($topic_id) )

                {

                        $redirect_page = append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");

                        $message = sprintf($titanium_lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');

                }

                else

                {

                        $redirect_page = append_titanium_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id");

                        $message = sprintf($titanium_lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');

                }



                $message = $message . '<br /><br />' . sprintf($titanium_lang['Click_return_forum'], '<a href="' . append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id") . '">', '</a>');



                $phpbb2_template->assign_vars(array(

                        'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')

                );



                message_die(GENERAL_MESSAGE, $titanium_lang['Topics_Unlocked'] . '<br /><br />' . $message);



                break;



        case 'split':

                $phpbb2_page_title = $titanium_lang['Mod_CP'];

                include("includes/page_header.$phpEx");



                $post_id_sql = '';



                if (isset($HTTP_POST_VARS['split_type_all']) || isset($HTTP_POST_VARS['split_type_beyond']))

                {

                        $phpbb2_posts = $HTTP_POST_VARS['post_id_list'];



                        for ($i = 0; $i < count($phpbb2_posts); $i++)

                        {

                                $post_id_sql .= ((!empty($post_id_sql)) ? ', ' : '') . intval($phpbb2_posts[$i]);

                        }

                }



                if (!empty($post_id_sql))

                {

                        $sql = "SELECT post_id

                        FROM " . POSTS_TABLE . "

                        WHERE post_id IN ($post_id_sql)

                        AND forum_id = '$phpbb2_forum_id'";

                        if ( !($result = $titanium_db->sql_query($sql)) )

                        {

                                message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);

                        }



                        $post_id_sql = '';

                        while ($row = $titanium_db->sql_fetchrow($result))

                        {

                                $post_id_sql .= ((!empty($post_id_sql)) ? ', ' : '') . intval($row['post_id']);

                        }

                        $titanium_db->sql_freeresult($result);

             			if ($post_id_sql == '')

             			{

             				message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

             			}

                        $sql = "SELECT post_id, poster_id, topic_id, post_time

                                FROM " . POSTS_TABLE . "

                                WHERE post_id IN ($post_id_sql)

                                ORDER BY post_time ASC";

                        if (!($result = $titanium_db->sql_query($sql)))

                        {

                                message_die(GENERAL_ERROR, 'Could not get post information', '', __LINE__, __FILE__, $sql);

                        }



                        if ($row = $titanium_db->sql_fetchrow($result))

                        {

                                $first_poster = $row['poster_id'];

                                $topic_id = $row['topic_id'];

                                $post_time = $row['post_time'];



                                $titanium_user_id_sql = '';

                                $post_id_sql = '';

                                do

                                {

                                        $titanium_user_id_sql .= ((!empty($titanium_user_id_sql)) ? ', ' : '') . intval($row['poster_id']);

                                        $post_id_sql .= (($post_id_sql != '') ? ', ' : '') . intval($row['post_id']);;                                          $post_id_sql .= ((!empty($post_id_sql)) ? ', ' : '') . intval($row['post_id']);;



                                }

                                while ($row = $titanium_db->sql_fetchrow($result));



                                $post_subject = trim(htmlspecialchars($HTTP_POST_VARS['subject']));

                                if (empty($post_subject))

                                {

                                        message_die(GENERAL_MESSAGE, $titanium_lang['Empty_subject']);

                                }



                                $new_forum_id = intval($HTTP_POST_VARS['new_forum_id']);

                                $topic_time = time();



                                $sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . '

                                      WHERE forum_id = ' . $new_forum_id;

                                   if ( !($result = $titanium_db->sql_query($sql)) )

                                   {

                                      message_die(GENERAL_ERROR, 'Could not select from forums table', '', __LINE__, __FILE__, $sql);

                                   }



                                   if (!$titanium_db->sql_fetchrow($result))

                                   {

                                      message_die(GENERAL_MESSAGE, 'New forum does not exist');

                                   }



                                   $titanium_db->sql_freeresult($result);



                                $sql  = "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type)

                                        VALUES ('" . str_replace("\'", "''", $post_subject) . "', '$first_poster', " . $topic_time . ", '$new_forum_id', " . TOPIC_UNLOCKED . ", " . POST_NORMAL . ")";

                                if (!($titanium_db->sql_query($sql)))

                                {

                                        message_die(GENERAL_ERROR, 'Could not insert new topic', '', __LINE__, __FILE__, $sql);

                                }



                                $new_topic_id = $titanium_db->sql_nextid();



/*****[BEGIN]******************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/

                                log_action('split', $new_topic_id, $topic_id, $userdata['user_id'], $phpbb2_forum_id, '');

/*****[END]********************************************

 [ Mod:     Log Moderator Actions              v1.1.6 ]

 ******************************************************/



                                // Update topic watch table, switch users whose posts

                                // have moved, over to watching the new topic

                                $sql = "UPDATE " . TOPICS_WATCH_TABLE . "

                                        SET topic_id = '$new_topic_id'

                                        WHERE topic_id = '$topic_id'

                                                AND user_id IN ($titanium_user_id_sql)";

                                if (!$titanium_db->sql_query($sql))

                                {

                                        message_die(GENERAL_ERROR, 'Could not update topics watch table', '', __LINE__, __FILE__, $sql);

                                }



                                $sql_where = (!empty($HTTP_POST_VARS['split_type_beyond'])) ? " post_time >= '$post_time' AND topic_id = '$topic_id'" : "post_id IN ($post_id_sql)";



                                $sql =         "UPDATE " . POSTS_TABLE . "

                                        SET topic_id = '$new_topic_id', forum_id = '$new_forum_id'

                                        WHERE $sql_where";

                                if (!$titanium_db->sql_query($sql))

                                {

                                        message_die(GENERAL_ERROR, 'Could not update posts table', '', __LINE__, __FILE__, $sql);

                                }



                                sync('topic', $new_topic_id);

                                sync('topic', $topic_id);

                                sync('forum', $new_forum_id);

                                sync('forum', $phpbb2_forum_id);



                                $phpbb2_template->assign_vars(array(

                                'META' => '<meta http-equiv="refresh" content="3;url=' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">')

                                );



                        $message = $titanium_lang['Topic_split'] . '<br /><br />' . sprintf($titanium_lang['Click_return_topic'], '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

                                message_die(GENERAL_MESSAGE, $message);

                        }

                }

                else

                {

                        //

                        // Set template files

                        //

                        $phpbb2_template->set_filenames(array(

                                'split_body' => 'modcp_split.tpl')

                        );



                        $sql = "SELECT u.username, p.*, pt.post_text, pt.bbcode_uid, pt.post_subject, p.post_username

                                FROM (" . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt)

                                WHERE p.topic_id = '$topic_id'

                                        AND p.poster_id = u.user_id

                                        AND p.post_id = pt.post_id

                                ORDER BY p.post_time ASC";



                        if ( !($result = $titanium_db->sql_query($sql)) )

                        {

                                message_die(GENERAL_ERROR, 'Could not get topic/post information', '', __LINE__, __FILE__, $sql);

                        }



                        $s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $phpbb2_forum_id . '" /><input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" /><input type="hidden" name="mode" value="split" />';



                        if( ( $phpbb2_total_posts = $titanium_db->sql_numrows($result) ) > 0 )

                        {

                                $postrow = $titanium_db->sql_fetchrowset($result);



                                $phpbb2_template->assign_vars(array(

                                        'L_SPLIT_TOPIC' => $titanium_lang['Split_Topic'],

                                        'L_SPLIT_TOPIC_EXPLAIN' => $titanium_lang['Split_Topic_explain'],

                                        'L_AUTHOR' => $titanium_lang['Author'],

                                        'L_MESSAGE' => $titanium_lang['Message'],

                                        'L_SELECT' => $titanium_lang['Select'],

                                        'L_SPLIT_SUBJECT' => $titanium_lang['Split_title'],

                                        'L_SPLIT_FORUM' => $titanium_lang['Split_forum'],

                                        'L_POSTED' => $titanium_lang['Posted'],

                                        'L_SPLIT_POSTS' => $titanium_lang['Split_posts'],

                                        'L_SUBMIT' => $titanium_lang['Submit'],

                                        'L_SPLIT_AFTER' => $titanium_lang['Split_after'],

                                        'L_POST_SUBJECT' => $titanium_lang['Post_subject'],

                                        'L_MARK_ALL' => $titanium_lang['Mark_all'],

                                        'L_UNMARK_ALL' => $titanium_lang['Unmark_all'],

                                        'L_POST' => $titanium_lang['Post'],



                                        'FORUM_NAME' => $forum_name,



                                        'U_VIEW_FORUM' => append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id"),



                                        'S_SPLIT_ACTION' => append_titanium_sid("modcp.$phpEx"),

                                        'S_HIDDEN_FIELDS' => $s_hidden_fields,

                                        'S_FORUM_SELECT' => make_forum_select("new_forum_id", false, $phpbb2_forum_id))

                                );

                                        //

                                        // Define censored word matches

                                        //

                                        $orig_word = array();

                                        $replacement_word = array();

                                        obtain_word_list($orig_word, $replacement_word);

                                for($i = 0; $i < $phpbb2_total_posts; $i++)

                                {

                                        $post_id = $postrow[$i]['post_id'];

                                        $poster_id = $postrow[$i]['poster_id'];

/*****[BEGIN]******************************************

 [ Mod:    Advanced Username Color             v1.0.5 ]

 ******************************************************/

                                        $poster = UsernameColor($postrow[$i]['username']);

/*****[END]********************************************

 [ Mod:    Advanced Username Color             v1.0.5 ]

 ******************************************************/



                                        $post_date = create_date($phpbb2_board_config['default_dateformat'], $postrow[$i]['post_time'], $phpbb2_board_config['board_timezone']);



                                        $bbcode_uid = $postrow[$i]['bbcode_uid'];

                                        $message = $postrow[$i]['post_text'];

                                        $post_subject = ( !empty($postrow[$i]['post_subject']) ) ? $postrow[$i]['post_subject'] : $topic_title;



                                        //

                                        // If the board has HTML off but the post has HTML

                                        // on then we process it, else leave it alone

                                        //

                                        if ( !$phpbb2_board_config['allow_html'] )

                                        {

                                                if ( $postrow[$i]['enable_html'] )

                                                {

                                                        $message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);

                                                }

                                        }



                                        if ( !empty($bbcode_uid) )

                                        {

                                                $message = ( $phpbb2_board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);

                                        }



                                        if ( count($orig_word) )

                                        {

                                                $post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

                                                $message = preg_replace($orig_word, $replacement_word, $message);

                                        }



                                        $message = make_clickable($message);



                                        if ( $phpbb2_board_config['allow_smilies'] && $postrow[$i]['enable_smilies'] )

                                        {

                                                $message = smilies_pass($message);

                                        }



                                        $message = str_replace("\n", '<br />', $message);



                                        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];

                                        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];



                                        $checkbox = ( $i > 0 ) ? '<input type="checkbox" name="post_id_list[]" value="' . $post_id . '" />' : '&nbsp;';



                                        $phpbb2_template->assign_block_vars('postrow', array(

                                                'ROW_COLOR' => '#' . $row_color,

                                                'ROW_CLASS' => $row_class,

                                                'POSTER_NAME' => $poster,

                                                'POST_DATE' => $post_date,

                                                'POST_SUBJECT' => $post_subject,

                                                'MESSAGE' => $message,

                                                'POST_ID' => $post_id,



                                                'S_SPLIT_CHECKBOX' => $checkbox)

                                        );

                                }



                                $phpbb2_template->pparse('split_body');

                        }

                }

                break;



        case 'ip':

                $phpbb2_page_title = $titanium_lang['Mod_CP'];

                include("includes/page_header.$phpEx");



                $rdns_ip_num = ( isset($HTTP_GET_VARS['rdns']) ) ? $HTTP_GET_VARS['rdns'] : "";



                if ( !$post_id )

                {

                        message_die(GENERAL_MESSAGE, $titanium_lang['No_such_post']);

                }



                //

                // Set template files

                //

                $phpbb2_template->set_filenames(array(

                        'viewip' => 'modcp_viewip.tpl')

                );



                // Look up relevent data for this post

                $sql = "SELECT poster_ip, poster_id

                        FROM " . POSTS_TABLE . "

                        WHERE post_id = '$post_id'

                        AND forum_id = '$phpbb2_forum_id'";

                if ( !($result = $titanium_db->sql_query($sql)) )

                {

                        message_die(GENERAL_ERROR, 'Could not get poster IP information', '', __LINE__, __FILE__, $sql);

                }



                if ( !($post_row = $titanium_db->sql_fetchrow($result)) )

                {

                        message_die(GENERAL_MESSAGE, $titanium_lang['No_such_post']);

                }



                $ip_this_post = decode_ip($post_row['poster_ip']);

                $ip_this_post = ( $rdns_ip_num == $ip_this_post ) ? htmlspecialchars(gethostbyaddr($ip_this_post)) : $ip_this_post;



                $poster_id = $post_row['poster_id'];



                $phpbb2_template->assign_vars(array(

                        'L_IP_INFO' => $titanium_lang['IP_info'],

                        'L_THIS_POST_IP' => $titanium_lang['This_posts_IP'],

                        'L_OTHER_IPS' => $titanium_lang['Other_IP_this_user'],

                        'L_OTHER_USERS' => $titanium_lang['Users_this_IP'],

                        'L_LOOKUP_IP' => $titanium_lang['Lookup_IP'],

                        'L_SEARCH' => $titanium_lang['Search'],



                        'SEARCH_IMG' => $images['icon_search'],



                        'IP' => $ip_this_post,



                        'U_LOOKUP_IP' => append_titanium_sid("modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=$post_id&amp;" . POST_TOPIC_URL . "=$topic_id&amp;rdns=" . $ip_this_post))

                );



                //

                // Get other IP's this user has posted under

                //

                $sql = "SELECT poster_ip, COUNT(*) AS postings

                        FROM " . POSTS_TABLE . "

                        WHERE poster_id = '$poster_id'

                        GROUP BY poster_ip

                        ORDER BY " . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . " DESC";

                if ( !($result = $titanium_db->sql_query($sql)) )

                {

                        message_die(GENERAL_ERROR, 'Could not get IP information for this user', '', __LINE__, __FILE__, $sql);

                }



                if ( $row = $titanium_db->sql_fetchrow($result) )

                {

                        $i = 0;

                        do

                        {

                                if ( $row['poster_ip'] == $post_row['poster_ip'] )

                                {

                                        $phpbb2_template->assign_vars(array(

                                                'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $titanium_lang['Post'] : $titanium_lang['Posts'] ))

                                        );

                                        continue;

                                }



                                $ip = decode_ip($row['poster_ip']);

                                $ip = ( $rdns_ip_num == $row['poster_ip'] || $rdns_ip_num == 'all') ? htmlspecialchars(gethostbyaddr($ip)) : $ip;



                                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];

                                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];



                                $phpbb2_template->assign_block_vars('iprow', array(

                                        'ROW_COLOR' => '#' . $row_color,

                                        'ROW_CLASS' => $row_class,

                                        'IP' => $ip,

                                        'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $titanium_lang['Post'] : $titanium_lang['Posts'] ),



                                        'U_LOOKUP_IP' => append_titanium_sid("modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=$post_id&amp;" . POST_TOPIC_URL . "=$topic_id&amp;rdns=" . $row['poster_ip']))

                                );



                                $i++;

                        }

                        while ( $row = $titanium_db->sql_fetchrow($result) );

                }



                //

                // Get other users who've posted under this IP

                //

                $sql = "SELECT u.user_id, u.username, COUNT(*) as postings

                        FROM (" . USERS_TABLE ." u, " . POSTS_TABLE . " p)

                        WHERE p.poster_id = u.user_id

                                AND p.poster_ip = '" . $post_row['poster_ip'] . "'

                        GROUP BY u.user_id, u.username

                        ORDER BY " . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . " DESC";

                if ( !($result = $titanium_db->sql_query($sql)) )

                {

                        message_die(GENERAL_ERROR, 'Could not get posters information based on IP', '', __LINE__, __FILE__, $sql);

                }



                if ( $row = $titanium_db->sql_fetchrow($result) )

                {

                        $i = 0;

                        do

                        {

                                $id = $row['user_id'];

                                $titanium_username = ( $id == ANONYMOUS ) ? $titanium_lang['Guest'] : $row['username'];



                                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];

                                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];



                                $phpbb2_template->assign_block_vars('userrow', array(

                                        'ROW_COLOR' => '#' . $row_color,

                                        'ROW_CLASS' => $row_class,

                                        'USERNAME' => $titanium_username,

                                        'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $titanium_lang['Post'] : $titanium_lang['Posts'] ),

                                        'L_SEARCH_POSTS' => sprintf($titanium_lang['Search_user_posts'], $titanium_username),



                                        'U_PROFILE' => append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$id"),

                                        'U_SEARCHPOSTS' => append_titanium_sid("search.$phpEx?search_author=" . (($id == ANONYMOUS) ? 'Anonymous' : urlencode($titanium_username)) . "&amp;showresults=topics"))

                                );



                                $i++;

                        }

                        while ( $row = $titanium_db->sql_fetchrow($result) );

                }



                $phpbb2_template->pparse('viewip');



                break;

/*****[BEGIN]******************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

    case 'cement':

        if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )

        {

            message_die(GENERAL_MESSAGE, $titanium_lang['None_selected']);

        }



        $phpbb2_topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?  $HTTP_POST_VARS['topic_id_list'] : array($topic_id);



        for($i = 0; $i < count($phpbb2_topics); $i++)

        {

            $priority_box_id = "topic_cement:" . intval($phpbb2_topics[$i]);

            $topic_priority = (isset($HTTP_POST_VARS[$priority_box_id])) ?

                intval($HTTP_POST_VARS[$priority_box_id]) : 0;

            $sql = "UPDATE " . TOPICS_TABLE . "

                    SET topic_priority = $topic_priority

                    WHERE topic_id = ".$phpbb2_topics[$i];

             if ( !($result = $titanium_db->sql_query($sql)) )

             {

                 message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);

             }



        }



        if ( !empty($topic_id) )

        {

            // Quake: Wtf happened here

            //$redirect_page = "modules.php?name=Forums&file=viewtopic&" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'];

            $redirect_page = append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");

            $message = sprintf($titanium_lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');

        }

        else

        {

            // And here again. Dam we must use append_titanium_sid for this!!

            //$redirect_page = "modules.php?name=Forums&file=modcp&" . POST_FORUM_URL . "=$phpbb2_forum_id&amp;sid=" . $userdata['session_id'];

            $redirect_page = append_titanium_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id");

            $message = sprintf($titanium_lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');

        }



        // And also here. Also notice the two WRONG <br /> and the '  . "modules.php which is totally wrong

        //$message = $message . '<br /><br />' . sprintf($titanium_lang['Click_return_forum'], '<a href="' . "modules.php?name=Forums&file=viewtopic&" . POST_FORUM_URL . "=$phpbb2_forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

        $message .= '<br /><br />' . sprintf($titanium_lang['Click_return_forum'], '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id") . '">', '</a>');



        $phpbb2_template->assign_vars(array(

            'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')

        );



        message_die(GENERAL_MESSAGE, $titanium_lang['Topics_Prioritized'] . '<br /><br />' . $message);



        break;

/*****[END]********************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/



        default:

                $phpbb2_page_title = $titanium_lang['Mod_CP'];

                include("includes/page_header.$phpEx");



                $phpbb2_template->assign_vars(array(

                        'FORUM_NAME' => $forum_name,



                        'L_MOD_CP' => $titanium_lang['Mod_CP'],

                        'L_MOD_CP_EXPLAIN' => $titanium_lang['Mod_CP_explain'],

                        'L_SELECT' => $titanium_lang['Select'],

/*****[BEGIN]******************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

                        'L_PRIORITY' =>   $titanium_lang['Priority'],

                        'L_PRIORITIZE' => $titanium_lang['Prioritize'],

/*****[END]********************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

                        'L_DELETE' => $titanium_lang['Delete'],

                        'L_MOVE' => $titanium_lang['Move'],

                        'L_LOCK' => $titanium_lang['Lock'],

                        'L_UNLOCK' => $titanium_lang['Unlock'],

                        'L_TOPICS' => $titanium_lang['Topics'],

                        'L_REPLIES' => $titanium_lang['Replies'],

                        'L_LASTPOST' => $titanium_lang['Last_Post'],

                        'L_SELECT' => $titanium_lang['Select'],



                        'U_VIEW_FORUM' => append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id"),

                        'S_HIDDEN_FIELDS' => '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $phpbb2_forum_id . '" />',

                        'S_MODCP_ACTION' => append_titanium_sid("modcp.$phpEx"))

                );



                $phpbb2_template->set_filenames(array(

                        'body' => 'modcp_body.tpl')

                );

/*****[BEGIN]******************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/

		//make_jumpbox('modcp.'.$phpEx);

		$all_forums = array();

		make_jumpbox_ref('modcp.'.$phpEx, $phpbb2_forum_id, $all_forums);



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



                //

                // Define censored word matches

                //

                $orig_word = array();

                $replacement_word = array();

                obtain_word_list($orig_word, $replacement_word);



/*****[BEGIN]******************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

                $sql = "SELECT t.*, u.username, u.user_id, p.post_time

                        FROM (" . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p)

                        WHERE t.forum_id = '$phpbb2_forum_id'

                                AND t.topic_poster = u.user_id

                                AND p.post_id = t.topic_last_post_id

                        ORDER BY t.topic_type DESC, t.topic_priority DESC, p.post_time DESC

                        LIMIT $phpbb2_start, " . $phpbb2_board_config['topics_per_page'];

/*****[END]********************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

                if ( !($result = $titanium_db->sql_query($sql)) )

                {

                           message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);

                }



                while ( $row = $titanium_db->sql_fetchrow($result) )

                {

                        $topic_title = '';



                        if ( $row['topic_status'] == TOPIC_LOCKED )

                        {

                                $folder_img = $images['folder_locked'];

                                $phpbb2_folder_alt = $titanium_lang['Topic_locked'];

                        }

                        else

                        {

/*****[BEGIN]******************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/

                        if ( $row['topic_type'] == POST_GLOBAL_ANNOUNCE )

                        {

                           $folder_img = $images['folder_global_announce'];

                           $phpbb2_folder_alt = $titanium_lang['Global_announcement'];

                        } else

/*****[END]********************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/

                                if ( $row['topic_type'] == POST_ANNOUNCE )

                                {

                                        $folder_img = $images['folder_announce'];

                                        $phpbb2_folder_alt = $titanium_lang['Topic_Announcement'];

                                }

                                else if ( $row['topic_type'] == POST_STICKY )

                                {

                                        $folder_img = $images['folder_sticky'];

                                        $phpbb2_folder_alt = $titanium_lang['Topic_Sticky'];

                                }

                                else

                                {

                                        $folder_img = $images['folder'];

                                        $phpbb2_folder_alt = $titanium_lang['No_new_posts'];

                                }

                        }



                        $topic_id = $row['topic_id'];

                        $topic_type = $row['topic_type'];

                        $topic_status = $row['topic_status'];

/*****[BEGIN]******************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

                        $topic_priority = $row['topic_priority'];

/*****[END]********************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/



/*****[BEGIN]******************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/

                        if ( $topic_type == POST_GLOBAL_ANNOUNCE )

                        {

                           $topic_type = $titanium_lang['Topic_global_announcement'] . ' ';

                        } else

/*****[END]********************************************

 [ Mod:     Global Announcements               v1.2.8 ]

 ******************************************************/

                        if ( $topic_type == POST_ANNOUNCE )

                        {

                                $topic_type = $titanium_lang['Topic_Announcement'] . ' ';

                        }

                        else if ( $topic_type == POST_STICKY )

                        {

                                $topic_type = $titanium_lang['Topic_Sticky'] . ' ';

                        }

                        else if ( $topic_status == TOPIC_MOVED )

                        {

                                $topic_type = $titanium_lang['Topic_Moved'] . ' ';

                        }

                        else

                        {

                                $topic_type = '';

                        }



                        if ( $row['topic_vote'] )

                        {

                                $topic_type .= $titanium_lang['Topic_Poll'] . ' ';

                        }



/*****[BEGIN]******************************************

 [ Mod:     Smilies in Topic Titles            v1.0.0 ]

 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]

 ******************************************************/

                        $topic_title = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($row['topic_title']) : $row['topic_title'];

/*****[END]********************************************

 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]

 [ Mod:     Smilies in Topic Titles            v1.0.0 ]

 ******************************************************/

                        if ( count($orig_word) )

                        {

                                $topic_title = preg_replace($orig_word, $replacement_word, $topic_title);

                        }



                        $u_view_topic = append_titanium_sid("modcp.$phpEx?mode=split&amp;" . POST_TOPIC_URL . "=$topic_id");

                        $topic_replies = $row['topic_replies'];



                        $phpbb2_last_post_time = create_date($phpbb2_board_config['default_dateformat'], $row['post_time'], $phpbb2_board_config['board_timezone']);



                        $phpbb2_template->assign_block_vars('topicrow', array(

                                'U_VIEW_TOPIC' => $u_view_topic,



                                'TOPIC_FOLDER_IMG' => $folder_img,

                                'TOPIC_TYPE' => $topic_type,

                                'TOPIC_TITLE' => $topic_title,

                                'REPLIES' => $topic_replies,

                                'LAST_POST_TIME' => $phpbb2_last_post_time,

                                'TOPIC_ID' => $topic_id,

/*****[BEGIN]******************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

                                'TOPIC_PRIORITY' => $topic_priority,

/*****[END]********************************************

 [ Mod:    Topic Cement                        v1.0.3 ]

 ******************************************************/

/*****[BEGIN]******************************************

 [ Mod:    Attachment Mod                      v2.4.1 ]

 ******************************************************/

                                'TOPIC_ATTACHMENT_IMG' => topic_attachment_image($row['topic_attachment']),

/*****[END]********************************************

 [ Mod:    Attachment Mod                      v2.4.1 ]

 ******************************************************/



                                'L_TOPIC_FOLDER_ALT' => $phpbb2_folder_alt)

                        );

                }



                $phpbb2_template->assign_vars(array(

                        'PAGINATION' => generate_pagination("modcp.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id&amp;sid=" . $userdata['session_id'], $forum_topics, $phpbb2_board_config['topics_per_page'], $phpbb2_start),

                        'PAGE_NUMBER' => sprintf($titanium_lang['Page_of'], ( floor( $phpbb2_start / $phpbb2_board_config['topics_per_page'] ) + 1 ), ceil( $forum_topics / $phpbb2_board_config['topics_per_page'] )),

                        'L_GOTO_PAGE' => $titanium_lang['Goto_page'])

                );



                $phpbb2_template->pparse('body');



                break;

}



include("includes/page_tail.$phpEx");



?>