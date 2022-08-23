<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                index.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: index.php,v 1.99.2.3 2004/07/11 16:46:15 acydburn Exp
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
      Advanced Username Color                  v1.0.5       06/11/2005
      At a Glance                              v2.2.1       06/12/2005
      Global Announcements                     v1.2.8       06/13/2005
      Number Format Total Posts                v1.0.0       06/24/2005
      At a Glance Options                      v1.0.0       08/17/2005
	  Colorize Forumtitle                      v1.0.0
	  Scrolling Global Announcement on Index   v1.0.1
	  Forumtitle as Weblink                    v1.2.2
	  Forum Icons                              v1.0.4
	  Birthdays                                v3.0.0
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if ($popup != "1")
    {
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

include('includes/bbcode.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
$forum_id = ( isset($HTTP_GET_VARS[POST_FORUM_URL]) ) ? intval($HTTP_GET_VARS[POST_FORUM_URL]) : 0;
$forum_link = ( isset($HTTP_GET_VARS['forum_link']) ) ? intval($HTTP_GET_VARS['forum_link']) : 0;

if ($forum_link && $forum_id)
{
	$sql = "UPDATE " . FORUMS_TABLE . "
		SET forum_link_count = forum_link_count + 1
		WHERE forum_id = $forum_id";
	if (!($db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not update link counter', '', __LINE__, __FILE__, $sql);
	}

	$sql = "SELECT weblink FROM " . FORUMS_TABLE . "
		WHERE forum_id = $forum_id";
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not read forum weblink', '', __LINE__, __FILE__, $sql);
	}

	while ($row = $db->sql_fetchrow($result))
	{
		$forum_weblink = $row['weblink'];
	}

	header("Location: ".$forum_weblink);
	exit;
}
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 

$viewcat = ( !empty($HTTP_GET_VARS[POST_CAT_URL]) ) ? $HTTP_GET_VARS[POST_CAT_URL] : -1;

if( isset($HTTP_GET_VARS['mark']) || isset($HTTP_POST_VARS['mark']) )
{
        $mark_read = ( isset($HTTP_POST_VARS['mark']) ) ? $HTTP_POST_VARS['mark'] : $HTTP_GET_VARS['mark'];
}
else
{
        $mark_read = '';
}

//
// Handle marking posts
//
if( $mark_read == 'forums' )
{
        if( $userdata['session_logged_in'] )
        {
                setcookie($board_config['cookie_name'] . '_f_all', time(), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
        }

        $template->assign_vars(array(
                "META" => '<meta http-equiv="refresh" content="3;url='  .append_sid("index.$phpEx") . '">')
        );

        $message = $lang['Forums_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a> ');

        message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//

$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_t"]) : array();
$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_f"]) : array();

//
// If you don't use these stats on your index you may want to consider
// removing them
//
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$newest_userdata = get_db_stat('newestuser');
$newest_user = UsernameColor($newest_userdata['username']);
$newest_uid = $newest_userdata['user_id'];

if( $total_posts == 0 )
{
        $l_total_post_s = $lang['Posted_articles_zero_total'];
}
else if( $total_posts == 1 )
{
        $l_total_post_s = $lang['Posted_article_total'];
}
else
{
        $l_total_post_s = $lang['Posted_articles_total'];
}

if( $total_users == 0 )
{
        $l_total_user_s = $lang['Registered_users_zero_total'];
}
else if( $total_users == 1 )
{
        $l_total_user_s = $lang['Registered_user_total'];
}
else
{
        $l_total_user_s = $lang['Registered_users_total'];
}

/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
if ( $board_config['global_enable']== 1  && $board_config['marquee_disable']== 0  ) 
{ 
   $template->assign_block_vars('switch_disable_global_marquee', array()); 
} 
else if ( $board_config['global_enable']== 1  &&  $board_config['marquee_disable']== 1  ) 
{ 
   $template->assign_block_vars('switch_enable_global_marquee', array()); 
} 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/

//
// Start page proper
//
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
        FROM " . CATEGORIES_TABLE . " c
        ".(($userdata['user_level']!=ADMIN)? "WHERE c.cat_id<>'".HIDDEN_CAT."'" :"" )."
        ORDER BY c.cat_order";
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
if( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}
$category_rows = array();
while ($row = $db->sql_fetchrow($result))
{
	$category_rows[] = $row;
}
$db->sql_freeresult($result);

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
$subforums_list = array();
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

if( ( $total_categories = count($category_rows) ) )
{
        $sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id, u.user_avatar, u.user_avatar_type
                FROM (( " . FORUMS_TABLE . " f
                LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
                LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
                ORDER BY f.cat_id, f.forum_order";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
        }

        $forum_data = array();
        while( $row = $db->sql_fetchrow($result) )
        {
                $forum_data[] = $row;
        }
        $db->sql_freeresult($result);

        if ( !($total_forums = count($forum_data)) )
        {
                message_die(GENERAL_MESSAGE, $lang['No_forums']);
        }

    //
    // Obtain a list of topic ids which contain
    // posts made since user last visited
    //
    if ($userdata['session_logged_in'])
    {
        // 60 days limit
        if ($userdata['user_lastvisit'] < (time() - 5184000))
        {
            $userdata['user_lastvisit'] = time() - 5184000;
        }
                $sql = "SELECT t.forum_id, t.topic_id, p.post_time
                        FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
                        WHERE p.post_id = t.topic_last_post_id
                                AND p.post_time > " . $userdata['user_lastvisit'] . "
                                AND t.topic_moved_id = '0'";
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not query new topic information', '', __LINE__, __FILE__, $sql);
                }

                $new_topic_data = array();
                while( $topic_data = $db->sql_fetchrow($result) )
                {
                        $new_topic_data[$topic_data['forum_id']][$topic_data['topic_id']] = $topic_data['post_time'];
                }
        $db->sql_freeresult($result);
        }

        //
        // Obtain list of moderators of each forum
        // First users, then groups ... broken into two queries
        //
        $forum_moderators = array();
        $sql = "SELECT aa.forum_id, u.user_id, u.username
                FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
                WHERE aa.auth_mod = " . TRUE . "
                AND g.group_single_user = '1'
                AND ug.group_id = aa.group_id
                AND g.group_id = aa.group_id
                AND u.user_id = ug.user_id
                GROUP BY u.user_id, u.username, aa.forum_id
                ORDER BY aa.forum_id, u.user_id";

        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
        }

        while( $row = $db->sql_fetchrow($result) )
        {
/*****[BEGIN]******************************************
[ Mod:    Advanced Username Color             v1.0.5 ]
******************************************************/
                $forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . UsernameColor($row['username']) . '</a>';
/*****[END]********************************************
[ Mod:    Advanced Username Color             v1.0.5 ]
******************************************************/
        }
        $db->sql_freeresult($result);

        $sql = "SELECT aa.forum_id, g.group_id, g.group_name
                FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
                WHERE aa.auth_mod = " . TRUE . "
                AND g.group_single_user = '0'
                AND g.group_type <> " . GROUP_HIDDEN . "
                AND ug.group_id = aa.group_id
                AND g.group_id = aa.group_id

                GROUP BY g.group_id, g.group_name, aa.forum_id
                ORDER BY aa.forum_id, g.group_id";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
        }

        while( $row = $db->sql_fetchrow($result) )
        {
                $forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . GroupColor($row['group_name']) . '</a>';
        }
        $db->sql_freeresult($result);
		
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
		if ( !$board_config['bday_hide'] || $userdata['session_logged_in'] )
		{
			// if birthday_display is set to "Display age (but not day or month)" (eg. BIRTHDAY_AGE), we don't display it here,
			// since this code would make it trivially easy to extrapolate that information.
			$sql = "SELECT user_id, username, user_birthday, birthday_display, user_level 
				FROM " . USERS_TABLE . " 
				WHERE user_birthday >= " . gmdate('md0000',time() + (3600 * $board_config['board_timezone'])) . " 
					AND user_birthday <= " . gmdate('md9999',time() + (3600 * $board_config['board_timezone']))." 
					AND user_active = 1 
					AND birthday_display <> " . BIRTHDAY_NONE . " 
					AND birthday_display <> " . BIRTHDAY_AGE . " 
				ORDER BY username DESC";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not query members birthday information', '', __LINE__, __FILE__, $sql);
			}
	
			$user_birthdays = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				// if birthday_display is set to "Display day and month (but not year)" (eg. BIRTHDAY_DATE), set the year
				// to 0.
				$bday_year = ( $row['birthday_display'] != BIRTHDAY_DATE ) ? $row['user_birthday'] % 10000 : 0;
				$age = ( $bday_year ) ? ' ('.(gmdate('Y')-$bday_year).')' : '';
				$color = '';
				if ( $row['user_level'] == ADMIN )
				{
					$color = ' style="color:#' . $theme['fontcolor3'] . '"';
				}
				else if ( $row['user_level'] == MOD )
				{
					$color = ' style="color:#' . $theme['fontcolor2'] . '"';
				}
				$user_birthdays[] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $color . '>' . UsernameColor($row['username']) . '</a>' . $age;
			}
			$db->sql_freeresult($result);
	
			$birthdays = (!empty($user_birthdays)) ?
				sprintf($lang['Congratulations'],implode(', ',$user_birthdays)) :
				$lang['No_birthdays'];
	
			if ( $board_config['bday_lookahead'] != -1 )
			{
				$start = gmdate('md9999',strtotime('+'.$board_config['bday_lookahead'].' day') + (3600 * $board_config['board_timezone']));
				$end = gmdate('md0000',strtotime('+1 day') + (3600 * $board_config['board_timezone']));
				$operator = ($start > $end) ? 'AND' : 'OR';
				$sql = "SELECT user_id, username, user_birthday, birthday_display, user_level 
					FROM " . USERS_TABLE . " 
					WHERE (user_birthday <= $start 
						$operator user_birthday >= $end)
						AND user_birthday <> 0 
						AND user_active = 1 
						AND birthday_display <> " . BIRTHDAY_NONE . " 
						AND birthday_display <> " . BIRTHDAY_AGE . " 
					ORDER BY user_birthday ASC, username DESC";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not query upcoming birthday information', '', __LINE__, __FILE__, $sql);
				}
				$upcoming_birthdays = array();
				while ( $row = $db->sql_fetchrow($result) )
				{
					$bday_month_day = floor($row['user_birthday'] / 10000);
					$bday_year_age = ( $row['birthday_display'] != BIRTHDAY_DATE ) ? $row['user_birthday'] - 10000*$bday_month_day : 0;
					$fudge = ( gmdate('md') < $bday_month_day ) ? 0 : 1;
					$age = ( $bday_year_age ) ? ' ('.(gmdate('Y')-$bday_year_age+$fudge).')' : '';
					$color = '';
					if ( $row['user_level'] == ADMIN )
					{
						$color = ' style="color:#' . $theme['fontcolor3'] . '"';
					}
					else if ( $row['user_level'] == MOD )
					{
						$color = ' style="color:#' . $theme['fontcolor2'] . '"';
						}
					$upcoming_birthdays[] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $color . '>' . UsernameColor($row['username']) . '</a>' . $age;
				}
	
				$upcoming = (!empty($upcoming_birthdays)) ?
					sprintf($lang['Upcoming_birthdays'],$board_config['bday_lookahead'],implode(', ',$upcoming_birthdays)) :
					sprintf($lang['No_upcoming'],$board_config['bday_lookahead']);
			}
	
			if ( !empty($user_birthdays) || !empty($upcoming_birthdays) || $board_config['bday_show'] )
			{
				$template->assign_block_vars('birthdays',array());
				if ( !empty($upcoming_birthdays) || $board_config['bday_show'] )
				{
					$template->assign_block_vars('birthdays.upcoming',array());
				}
			}
		}
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

        //
        // Find which forums are visible for this user
        //
        $is_auth_ary = array();
        $is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);

        //
        // Start output of page
        //
        define('SHOW_ONLINE', true);
        $page_title = $lang['Index'];
        include("includes/page_header.php");

        $template->set_filenames(array(
                'body' => 'index_body.tpl')
        );

/*****[BEGIN]******************************************
 [ Mod:     Number Format Total Posts          v1.0.4 ]
 ******************************************************/
        $total_posts_format = sprintf($l_total_post_s, $total_posts);
        $total_posts_format = str_replace($total_posts, number_format($total_posts), $total_posts_format);

        $template->assign_vars(array(
                'TOTAL_POSTS' => $total_posts_format,
/*****[END]********************************************
 [ Mod:     Number Format Total Posts          v1.0.4 ]
 ******************************************************/
                'TOTAL_USERS' => sprintf($l_total_user_s, $total_users),
                'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">', $newest_user, '</a>'),
				
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'BIRTHDAYS' => $birthdays,
				'UPCOMING' => $upcoming,
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				
/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/       
				  'GLOBAL_TITLE' => $board_config['global_title'], 
				  'GLOBAL_ANNOUNCEMENT' => str_replace(array('<br />', '<br>'), "", $board_config['global_announcement']), 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/

                  'SHOW_LAST_POST_AVATAR' => $board_config['last_post_avatar'],

/*****[BEGIN]******************************************
[ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
******************************************************/
		// 'U_CFI_JSLIB'			=> 'includes/collapsible_forum_index.js',
		'CFI_COOKIE_NAME'		=> get_cfi_cookie_name(),
		'COOKIE_PATH'			=> $board_config['cookie_path'],
		'COOKIE_DOMAIN'			=> $board_config['cookie_domain'],
		'COOKIE_SECURE'			=> $board_config['cookie_secure'],
		'L_CFI_OPTIONS'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_options']),
		'L_CFI_OPTIONS_EX'		=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_options_ex']),
		'L_CFI_CLOSE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_close']),
		'L_CFI_DELETE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_delete']),
		'L_CFI_RESTORE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_restore']),
		'L_CFI_SAVE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_save']),
		'L_CFI_EXPAND_ALL'		=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_Expand_all']),
		'L_CFI_COLLAPSE_ALL'	=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_Collapse_all']),
		'IMG_UP_ARROW'			=> $images['up_arrow'],
		'IMG_DW_ARROW'			=> $images['down_arrow'],
		'IMG_PLUS'				=> $images['icon_sign_plus'],
		'IMG_MINUS'				=> $images['icon_sign_minus'],
		'SPACER'				=> $phpbb_root_path . 'images/spacer.gif',
/*****[END]********************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/

                'FORUM_IMG' => $images['forum'],
                'FORUM_NEW_IMG' => $images['forum_new'],
                'FORUM_LOCKED_IMG' => $images['forum_locked'],

/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'L_TODAYS_BIRTHDAYS' => $lang['Todays_Birthdays'],
				'L_VIEW_BIRTHDAYS' => $lang['View_Birthdays'],
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

                'L_FORUM' => $lang['Forum'],
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
		        'L_SUBFORUMS' => $lang['Subforums'],
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                'L_TOPICS' => $lang['Topics'],
                'L_REPLIES' => $lang['Replies'],
                'L_VIEWS' => $lang['Views'],
                'L_POSTS' => $lang['Posts'],
                'L_LASTPOST' => $lang['Last_Post'],
                'L_NO_NEW_POSTS' => $lang['No_new_posts'],
                'L_NEW_POSTS' => $lang['New_posts'],
                'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'],
                'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'],
                'L_ONLINE_EXPLAIN' => $lang['Online_explain'],

                'L_MODERATOR' => $lang['Moderators'],
                'L_FORUM_LOCKED' => $lang['Forum_is_locked'],
                'L_MARK_FORUMS_READ' => $lang['Mark_all_forums'],

                'U_MARK_READ' => append_sid("index.$phpEx?mark=forums"))
        );

      	//
     	// Let's decide which categories we should display
     	//
     	$display_categories = array();

     	for ($i = 0; $i < $total_forums; $i++ )
     	{
     		if ($is_auth_ary[$forum_data[$i]['forum_id']]['auth_view'])
     		{
     			$display_categories[$forum_data[$i]['cat_id']] = true;
     		}
     	}

        //
        // Okay, let's build the index
        //
        for($i = 0; $i < $total_categories; $i++)
        {
                $cat_id = $category_rows[$i]['cat_id'];

                //
                // Yes, we should, so first dump out the category
                // title, then, if appropriate the forum list
                //
                if (isset($display_categories[$cat_id]) && $display_categories[$cat_id])
                {
                        $template->assign_block_vars('catrow', array(
/*****[BEGIN]******************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
				            'DISPLAY' => (is_category_collapsed($cat_id) ? '' : 'none'),
/*****[END]********************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
                                
                            'CAT_ID' => $cat_id,
                            'CAT_DESC' => $category_rows[$i]['cat_title'],
                            'U_VIEWCAT' => append_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"))
                        );

                        if ( $viewcat == $cat_id || $viewcat == -1 )
                        {
                                for($j = 0; $j < $total_forums; $j++)
                                {
                                        if ( $forum_data[$j]['cat_id'] == $cat_id )
                                        {
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
                                            // if ($forum_data[$j]['user_avatar'] == "")
                                            //     $poster_avatar = $board_config['avatar_path']."/blank.gif";
                                            // elseif ($forum_data[$j]['user_avatar'] == "gallery/blank.gif")
                                            //     $poster_avatar = $board_config['avatar_path']."/blank.gif";
                                            // elseif (preg_match('#http://#i', $forum_data[$j]['user_avatar']))
                                            //     $poster_avatar = $forum_data[$j]['user_avatar'];
                                            // elseif (preg_match('#gallery/#i', $forum_data[$j]['user_avatar'])) 
                                            //     $poster_avatar = $board_config['avatar_gallery_path'].'/'.$forum_data[$j]['user_avatar'];
                                            // else
                                            //     $poster_avatar = $board_config['avatar_path']."/".$forum_data[$j]['user_avatar']; 

                                            $poster_avatar = $board_config['default_avatar_users_url'];
                                            switch( $forum_data[$j]['user_avatar_type'] )
                                            {
                                                case USER_AVATAR_UPLOAD:
                                                    $poster_avatar = $board_config['avatar_path'] . '/' . $forum_data[$j]['user_avatar'];
                                                    break;
                                                case USER_AVATAR_REMOTE:
                                                    $poster_avatar = resize_avatar($forum_data[$j]['user_avatar']);
                                                    break;
                                                case USER_AVATAR_GALLERY:
                                                    $poster_avatar = $board_config['avatar_gallery_path'] . '/' . (($forum_data[$j]['user_avatar'] 
													== 'blank.gif' || $forum_data[$j]['user_avatar'] == 'gallery/blank.gif') ? 'blank.png' : $forum_data[$j]['user_avatar']);
                                                    break;
                                            }                                  
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
                                                $forum_id = $forum_data[$j]['forum_id'];

                                                if ( $is_auth_ary[$forum_id]['auth_view'] )
                                                {
                                                        if ( $forum_data[$j]['forum_status'] == FORUM_LOCKED )
                                                        {
                                                                $folder_image = $images['forum_locked'];
                                                               $folder_alt = $lang['Forum_locked'];
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
																$unread_topics = false;
																$folder_images = array(
																	'default'	=> $folder_image,
																	'new'		=> $images['forum_locked'],
																	'sub'		=> ( isset($images['forums_locked']) ) ? $images['forums_locked'] : $images['forum_locked'],
																	'subnew'	=> ( isset($images['forums_locked']) ) ? $images['forums_locked'] : $images['forum_locked'],
																	'subalt'	=> $lang['Forum_locked'],
																	'subaltnew'	=> $lang['Forum_locked'],
																	);
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                        }
                                                        else
                                                        {
                                                                $unread_topics = false;
                                                                if ( $userdata['session_logged_in'] )
                                                                {
                                                                       if ( !empty($new_topic_data[$forum_id]) )
                                                                        {
                                                                                $forum_last_post_time = 0;

                                                                                while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$forum_id]) )
                                                                                {
                                                                                        if ( empty($tracking_topics[$check_topic_id]) )
                                                                                        {
                                                                                                $unread_topics = true;
                                                                                                $forum_last_post_time = max($check_post_time, $forum_last_post_time);

                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                if ( $tracking_topics[$check_topic_id] < $check_post_time )
                                                                                                {
                                                                                                        $unread_topics = true;
                                                                                                        $forum_last_post_time = max($check_post_time, $forum_last_post_time);
                                                                                                }
                                                                                        }
                                                                                }

                                                                                if ( !empty($tracking_forums[$forum_id]) )
                                                                                {
                                                                                        if ( $tracking_forums[$forum_id] > $forum_last_post_time )
                                                                                        {
                                                                                                $unread_topics = false;
                                                                                        }
                                                                                }

                                                                                if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
                                                                                {
                                                                                        if ( $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all'] > $forum_last_post_time )
                                                                                        {
                                                                                                $unread_topics = false;
                                                                                        }
                                                                                }

                                                                        }
                                                                }

                                                                $folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum'];
                                                                $folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts'];
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
																$folder_images = array(
																	'default'	=> $folder_image,
																	'new'		=> $images['forum_new'],
																	'sub'		=> ( isset($images['forums']) ) ? $images['forums'] : $images['forum'],
																	'subnew'	=> ( isset($images['forums_new']) ) ? $images['forums_new'] : $images['forum_new'],
																	'subalt'	=> $lang['No_new_posts'],
																	'subaltnew'	=> $lang['New_posts'],
																	);
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                        }

                                                        $posts = $forum_data[$j]['forum_posts'];
                                                        $topics = $forum_data[$j]['forum_topics'];
/*****[BEGIN]******************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
														$icon = $forum_data[$j]['forum_icon'];
/*****[END]********************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/



                                                       if ( $forum_data[$j]['forum_last_post_id'] )
                                                        {
                                                                $last_post_time = create_date($board_config['default_dateformat'], $forum_data[$j]['post_time'], $board_config['board_timezone']);

                                                                // $last_post = $last_post_time . '<br />';
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                                                $last_post_username = ( $forum_data[$j]['user_id'] == ANONYMOUS ) ? ( ($forum_data[$j]['post_username'] != '' ) ? $forum_data[$j]['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $forum_data[$j]['user_id']) . '">' . UsernameColor($forum_data[$j]['username']) . '</a> ';
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

                                                                // $last_post = '<a href="'.append_sid("viewtopic.$phpEx?".POST_POST_URL.'='.$forum_data[$j]['forum_last_post_id']).'#'.$forum_data[$j]['forum_last_post_id'].'"><img src="'.$images['icon_latest_reply'].'" border="0" alt="'.$lang['View_latest_post'].'" title="'.$lang['View_latest_post'].'" /></a>';
                                                                $last_post = '<a href="'.append_sid("viewtopic.$phpEx?".POST_POST_URL.'='.$forum_data[$j]['forum_last_post_id']).'#'.$forum_data[$j]['forum_last_post_id'].'"><i class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$lang['View_latest_post'].'"></i></a>';
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
																$last_post_sub = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $forum_data[$j]['forum_last_post_id']) . '#' . $forum_data[$j]['forum_last_post_id'] . '"><img src="' . ($unread_topics ? $images['icon_miniforum_new'] : $images['icon_miniforum']) . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                        }
                                                        else
                                                        {
                                                            $last_post_username = '';
                                                            $last_post = $lang['No_Posts'];
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
															$last_post_sub = '<img src="' . $images['icon_miniforum'] . '" border="0" alt="' . $lang['No_Posts'] . '" title="' . $lang['No_Posts'] . '" />';
															$last_post_time = '';
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                        }

                                                        if (isset($forum_moderators[$forum_id])) {
                                                            if ( count($forum_moderators[$forum_id]) > 0 )
                                                            {
                                                                    $l_moderators = ( count($forum_moderators[$forum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
                                                                    $moderator_list = implode(', ', $forum_moderators[$forum_id]);
                                                            }
                                                            else
                                                            {
                                                                    $l_moderators = '';
                                                                    $moderator_list = '';
                                                            }
                                                        }
                                                        else
                                                        {
                                                                $l_moderators = '';
                                                                $moderator_list = '';
                                                        }

                                                        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                                                        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                                                        /*--FNA--*/

                                                        $template->assign_block_vars('catrow.forumrow', array(
/*****[BEGIN]******************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
								                                'FORUM_ID' => $forum_id,
							                                	'DISPLAY' => (is_category_collapsed($cat_id) ? 'none' : ''),
/*****[END]********************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
                                                                'ROW_COLOR' => '#' . $row_color,
                                                                'ROW_CLASS' => $row_class,
/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 [ Mod:    Forum Icons                         v1.0.4 ]
 ******************************************************/ 
								                                'FORUM_FOLDER_IMG' => ( $forum_data[$j]['title_is_link'] == 1 && $forum_data[$j]['forum_link_icon'] != '' ) ? $forum_data[$j]['forum_link_icon'] : $folder_image,
																'FORUM_ICON_IMG' => ($icon) ? '<img src="' . $phpbb_root_path . $icon . '" alt="'.$forum_data[$j]['forum_name'].'" title="'.$forum_data[$j]['forum_name'].'" />' : '',
								                                'FORUM_LINK_COUNT' => ( $forum_data[$j]['title_is_link'] == 1 ) ? sprintf($lang['Forum_link_count'], $forum_data[$j]['forum_link_count']) : '',
								                                'FORUM_LINK_TARGET' => ($forum_data[$j]['forum_link_target']) ? 'target="_blank"' : '',
/*****[END]********************************************
 [ Mod:    Forum Icons                         v1.0.4 ]
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
                                                                'FORUM_NAME' => $forum_data[$j]['forum_name'],
/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                                                'FORUM_COLOR' => ( $forum_data[$j]['forum_color'] != '' ) ? ' style="color: #'.$forum_data[$j]['forum_color'].'"' : '',
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                                                'FORUM_DESC' => $forum_data[$j]['forum_desc'],
                                                                'POSTS' => $forum_data[$j]['forum_posts'],
                                                                'TOPICS' => $forum_data[$j]['forum_topics'],
                                                                'LAST_POST' => $last_post,
                                                                'LAST_POST_USERNAME' => ($last_post_username) ? sprintf(trim($lang['Recent_first_poster']),$last_post_username) : $last_post_username,
                                                                'LAST_POSTTIME' => $last_post_time,
                                                                'MODERATORS' => $moderator_list,
                                                                'L_MODERATOR' => $l_moderators,
                                                                'L_FORUM_FOLDER_ALT' => $folder_alt,
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
																'FORUM_FOLDERS' => serialize($folder_images),
																'HAS_SUBFORUMS' => 0,
																'PARENT' => $forum_data[$j]['forum_parent'],
																'ID' => $forum_data[$j]['forum_id'],
																'UNREAD' => intval($unread_topics),
																'TOTAL_UNREAD' => intval($unread_topics),
																'TOTAL_POSTS' => $forum_data[$j]['forum_posts'],
																'TOTAL_TOPICS' => $forum_data[$j]['forum_topics'],
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/                                                                
                                                                'LAST_POST_AVATAR' => $poster_avatar,
                                                                'LAST_POST_AVATAR_DISPLAY' => ($topics == 0) ? 'display:none; ' : '',
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
																'LAST_POST_FORUM' => $last_post,
																'LAST_POST_TIME' => $last_post_time,
																'LAST_POST_TIME_FORUM' => $last_post_time,
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                                'LAST_POST_COUNT' => $posts,
/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
								'U_VIEWFORUM' => ( $forum_data[$j]['title_is_link'] == 1 ) ? append_sid("index.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;forum_link=1") : append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"))

							);

							if ($forum_data[$j]['title_is_link'])
							{
								$template->assign_block_vars('catrow.forumrow.switch_forum_link_on', array());
							}
							else
							{
								$template->assign_block_vars('catrow.forumrow.switch_forum_link_off', array());
							}
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
							if( $forum_data[$j]['forum_parent'] )
							{
								$subforums_list[] = array(
									'forum_data'	=> $forum_data[$j],
									'folder_image'	=> $folder_image,
									'last_post'        => $last_post,
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
                                    'last_post_avatar' => $poster_avatar,
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
									'last_post_sub'	=> $last_post_sub,
									'moderator_list'	=> $moderator_list,
									'unread_topics'	=> $unread_topics,
									'l_moderators'	=> $l_moderators,
									'folder_alt'	=> $folder_alt,
									'last_post_time'	=> $last_post_time,
									'desc'			=> $forum_data[$j]['forum_desc'],
									);
							}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                }
                                        }
                                }
                        }
                }
        } // for ... categories

}// if ... total_categories
else
{
        message_die(GENERAL_MESSAGE, $lang['No_forums']);
}

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
unset($data);
unset($item);
unset($cat_item);
unset($row_item);
for( $i = 0; $i < count($subforums_list); $i++ )
{
	$forum_data = $subforums_list[$i]['forum_data'];
	$parent_id = $forum_data['forum_parent'];
	
	// Find parent item
	if( isset($template->_tpldata['catrow.']) )
	{
		$data = &$template->_tpldata['catrow.'];
		$count = count($data);
		for( $j = 0; $j < $count; $j++)
		{
			$cat_item = &$data[$j];
			$row_item = &$cat_item['forumrow.'];
			$count2 = count($row_item);
			for( $k = 0; $k < $count2; $k++)
			{
				if( $row_item[$k]['ID'] == $parent_id )
				{
					$item = &$row_item[$k];
					break;
				}
			}
			if( isset($item) )
			{
				break;
			}
		}
	}
	
	if( isset($item) )
	{
		if( isset($item['sub.']) )
		{
			$num = count($item['sub.']);
			$data = &$item['sub.'];
		}
		else
		{
			$num = 0;
			$item[] = 'sub.';
			$data = &$item['sub.'];
		}
		
		// Append new entry
		$data[] = array(
			'NUM' => $num,
			'FORUM_FOLDER_IMG' => $subforums_list[$i]['folder_image'], 
			'FORUM_NAME' => $forum_data['forum_name'],
/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
            'FORUM_COLOR' => ( $forum_data['forum_color'] != '' ) ? 'style="color: #'.$forum_data['forum_color'].'"' : '',
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
			'FORUM_DESC' => $forum_data['forum_desc'],
			'FORUM_DESC_HTML' => htmlspecialchars(preg_replace('@<[\/\!]*?[^<>]*?>@si', '', $forum_data['forum_desc'])),
			'POSTS' => $forum_data['forum_posts'],
			'TOPICS' => $forum_data['forum_topics'],
			'LAST_POST' => $subforums_list[$i]['last_post'],
			'LAST_POST_SUB' => $subforums_list[$i]['last_post_sub'],
			'LAST_TOPIC' => $forum_data['topic_title'],
			'MODERATORS' => $subforums_list[$i]['moderator_list'],
			'PARENT' => $forum_data['forum_parent'],
			'ID' => $forum_data['forum_id'],
			'UNREAD' => intval($subforums_list[$i]['unread_topics']),	
			'L_MODERATOR' => $subforums_list[$i]['l_moderators'], 
			'L_FORUM_FOLDER_ALT' => $subforums_list[$i]['folder_alt'], 	
			'U_VIEWFORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_data['forum_id'])
		);
		$item['HAS_SUBFORUMS'] ++;
		$item['TOTAL_UNREAD'] += intval($subforums_list[$i]['unread_topics']);
		// Change folder image
		$images2 = unserialize($item['FORUM_FOLDERS']);
		$item['FORUM_FOLDER_IMG'] = $item['TOTAL_UNREAD'] ? $images2['subnew'] : $images2['sub'];
		$item['L_FORUM_FOLDER_ALT'] = $item['TOTAL_UNREAD'] ? $images2['subaltnew'] : $images2['subalt'];
		// Check last post
		if( $item['LAST_POST_TIME'] < $subforums_list[$i]['last_post_time'] )
		{
			$item['LAST_POST'] = $subforums_list[$i]['last_post'];
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
            $item['LAST_POST_AVATAR'] = $subforums_list[$i]['last_post_avatar'];
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
			$item['LAST_POST_TIME'] = $subforums_list[$i]['last_post_time'];
		}
		if( !$item['LAST_POST_TIME_FORUM'] )
		{
			$item['LAST_POST_FORUM'] = $item['LAST_POST'];
		}
		// Add topics/posts
		$item['TOTAL_POSTS'] += $forum_data['forum_posts'];
		$item['TOTAL_TOPICS'] += $forum_data['forum_topics'];
	}
	unset($item);
	unset($data);
	unset($cat_item);
	unset($row_item);
}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    At a Glance                        v2.2.1 ]
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
if (show_glance("index")) {
    include($phpbb_root_path . 'glance.php');
}
/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Base:    At a Glance                        v2.2.1 ]
 ******************************************************/

//
// Generate the page
//
$template->pparse('body');

include("includes/page_tail.php");

?>