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
	  Forum Icon Path Mod                      v1.0.0       09/26/2022
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if ($popup != "1") 
    {
        $titanium_module_name = basename(dirname(__FILE__));
        require("modules/".$titanium_module_name."/nukebb.php");
    }
    else
    {
        $phpbb2_root_path = NUKE_FORUMS_DIR;
    }

define('IN_PHPBB2', true);
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);

include('includes/bbcode.'.$phpEx);

//
// Start session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_INDEX);
titanium_init_userprefs($userdata);
//
// End session management
//

/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
$phpbb2_forum_id = ( isset($HTTP_GET_VARS[POST_FORUM_URL]) ) ? intval($HTTP_GET_VARS[POST_FORUM_URL]) : 0;
$phpbb2_forum_link = ( isset($HTTP_GET_VARS['forum_link']) ) ? intval($HTTP_GET_VARS['forum_link']) : 0;

if ($phpbb2_forum_link && $phpbb2_forum_id)
{
	$sql = "UPDATE " . FORUMS_TABLE . "
		SET forum_link_count = forum_link_count + 1
		WHERE forum_id = $phpbb2_forum_id";
	if (!($titanium_db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not update link counter', '', __LINE__, __FILE__, $sql);
	}

	$sql = "SELECT weblink FROM " . FORUMS_TABLE . "
		WHERE forum_id = $phpbb2_forum_id";
	if (!($result = $titanium_db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not read forum weblink', '', __LINE__, __FILE__, $sql);
	}

	while ($row = $titanium_db->sql_fetchrow($result))
	{
		$phpbb2_forum_weblink = $row['weblink'];
	}

	header("Location: ".$phpbb2_forum_weblink);
	exit;
}
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 

$phpbb2_viewcat = ( !empty($HTTP_GET_VARS[POST_CAT_URL]) ) ? $HTTP_GET_VARS[POST_CAT_URL] : -1;

if( isset($HTTP_GET_VARS['mark']) || isset($HTTP_POST_VARS['mark']) )
{
        $phpbb2_mark_read = ( isset($HTTP_POST_VARS['mark']) ) ? $HTTP_POST_VARS['mark'] : $HTTP_GET_VARS['mark'];
}
else
{
        $phpbb2_mark_read = '';
}

//
// Handle marking posts
//
if( $phpbb2_mark_read == 'forums' )
{
        if( $userdata['session_logged_in'] )
        {
                setcookie($phpbb2_board_config['cookie_name'] . '_f_all', time(), 0, $phpbb2_board_config['cookie_path'], $phpbb2_board_config['cookie_domain'], $phpbb2_board_config['cookie_secure']);
        }

        $phpbb2_template->assign_vars(array(
                "META" => '<meta http-equiv="refresh" content="3;url='  .append_titanium_sid("index.$phpEx") . '">')
        );

        $message = $titanium_lang['Forums_marked_read'] . '<br /><br />' . sprintf($titanium_lang['Click_return_index'], '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a> ');

        message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//

$phpbb2_tracking_topics = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . "_t"]) : array();
$phpbb2_tracking_forums = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . "_f"]) : array();

//
// If you don't use these stats on your index you may want to consider
// removing them
//
$phpbb2_total_posts = get_db_stat('postcount');
$phpbb2_total_users = get_db_stat('usercount');
$phpbb2_newest_userdata = get_db_stat('newestuser');
$phpbb2_newest_user = UsernameColor($phpbb2_newest_userdata['username']);
$phpbb2_newest_uid = $phpbb2_newest_userdata['user_id'];

if( $phpbb2_total_posts == 0 )
{
        $phpbb2_l_total_post_s = $titanium_lang['Posted_articles_zero_total'];
}
else if( $phpbb2_total_posts == 1 )
{
        $phpbb2_l_total_post_s = $titanium_lang['Posted_article_total'];
}
else
{
        $phpbb2_l_total_post_s = $titanium_lang['Posted_articles_total'];
}

if( $phpbb2_total_users == 0 )
{
        $phpbb2_l_total_user_s = $titanium_lang['Registered_users_zero_total'];
}
else if( $phpbb2_total_users == 1 )
{
        $phpbb2_l_total_user_s = $titanium_lang['Registered_user_total'];
}
else
{
        $phpbb2_l_total_user_s = $titanium_lang['Registered_users_total'];
}

/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
if ( $phpbb2_board_config['global_enable']== 1  && $phpbb2_board_config['marquee_disable']== 0  ) 
{ 
   $phpbb2_template->assign_block_vars('switch_disable_global_marquee', array()); 
} 
else if ( $phpbb2_board_config['global_enable']== 1  &&  $phpbb2_board_config['marquee_disable']== 1  ) 
{ 
   $phpbb2_template->assign_block_vars('switch_enable_global_marquee', array()); 
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
if( !($result = $titanium_db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}
$category_rows = array();
while ($row = $titanium_db->sql_fetchrow($result))
{
	$category_rows[] = $row;
}
$titanium_db->sql_freeresult($result);

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
$phpbb2_subforums_list = array();
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

if( ( $total_phpbb2_categories = count($category_rows) ) )
{
        $sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id, u.user_avatar, u.user_avatar_type
                FROM (( " . FORUMS_TABLE . " f
                LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
                LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
                ORDER BY f.cat_id, f.forum_order";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
        }

        $phpbb2_forum_data = array();
        while( $row = $titanium_db->sql_fetchrow($result) )
        {
                $phpbb2_forum_data[] = $row;
        }
        $titanium_db->sql_freeresult($result);

        if ( !($total_phpbb2_forums = count($phpbb2_forum_data)) )
        {
                message_die(GENERAL_MESSAGE, $titanium_lang['No_forums']);
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
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not query new topic information', '', __LINE__, __FILE__, $sql);
                }

                $new_phpbb2_topic_data = array();
                while( $phpbb2_topic_data = $titanium_db->sql_fetchrow($result) )
                {
                        $new_phpbb2_topic_data[$phpbb2_topic_data['forum_id']][$phpbb2_topic_data['topic_id']] = $phpbb2_topic_data['post_time'];
                }
        $titanium_db->sql_freeresult($result);
        }

        //
        // Obtain list of moderators of each forum
        // First users, then groups ... broken into two queries
        //
        $phpbb2_forum_moderators = array();
        $sql = "SELECT aa.forum_id, u.user_id, u.username
                FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
                WHERE aa.auth_mod = " . TRUE . "
                AND g.group_single_user = '1'
                AND ug.group_id = aa.group_id
                AND g.group_id = aa.group_id
                AND u.user_id = ug.user_id
                GROUP BY u.user_id, u.username, aa.forum_id
                ORDER BY aa.forum_id, u.user_id";

        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
        }

        while( $row = $titanium_db->sql_fetchrow($result) )
        {
/*****[BEGIN]******************************************
[ Mod:    Advanced Username Color             v1.0.5 ]
******************************************************/
                $phpbb2_forum_moderators[$row['forum_id']][] = '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . UsernameColor($row['username']) . '</a>';
/*****[END]********************************************
[ Mod:    Advanced Username Color             v1.0.5 ]
******************************************************/
        }
        $titanium_db->sql_freeresult($result);

        $sql = "SELECT aa.forum_id, g.group_id, g.group_name
                FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
                WHERE aa.auth_mod = " . TRUE . "
                AND g.group_single_user = '0'
                AND g.group_type <> " . GROUP_HIDDEN . "
                AND ug.group_id = aa.group_id
                AND g.group_id = aa.group_id

                GROUP BY g.group_id, g.group_name, aa.forum_id
                ORDER BY aa.forum_id, g.group_id";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
        }

        while( $row = $titanium_db->sql_fetchrow($result) )
        {
                $phpbb2_forum_moderators[$row['forum_id']][] = '<a href="' . append_titanium_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . GroupColor($row['group_name']) . '</a>';
        }
        $titanium_db->sql_freeresult($result);
		
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
		if ( !$phpbb2_board_config['bday_hide'] || $userdata['session_logged_in'] )
		{
			// if birthday_display is set to "Display age (but not day or month)" (eg. BIRTHDAY_AGE), we don't display it here,
			// since this code would make it trivially easy to extrapolate that information.
			$sql = "SELECT user_id, username, user_birthday, birthday_display, user_level 
				FROM " . USERS_TABLE . " 
				WHERE user_birthday >= " . gmdate('md0000',time() + (3600 * $phpbb2_board_config['board_timezone'])) . " 
					AND user_birthday <= " . gmdate('md9999',time() + (3600 * $phpbb2_board_config['board_timezone']))." 
					AND user_active = 1 
					AND birthday_display <> " . BIRTHDAY_NONE . " 
					AND birthday_display <> " . BIRTHDAY_AGE . " 
				ORDER BY username DESC";
			if ( !($result = $titanium_db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not query members birthday information', '', __LINE__, __FILE__, $sql);
			}
	
			$phpbb2_user_birthdays = array();
			while ( $row = $titanium_db->sql_fetchrow($result) )
			{
				// if birthday_display is set to "Display day and month (but not year)" (eg. BIRTHDAY_DATE), set the year
				// to 0.
				$phpbb2_bday_year = ( $row['birthday_display'] != BIRTHDAY_DATE ) ? $row['user_birthday'] % 10000 : 0;
				$phpbb2_age = ( $phpbb2_bday_year ) ? ' ('.(gmdate('Y')-$phpbb2_bday_year).')' : '';
				$phpbb2_color = '';
				if ( $row['user_level'] == ADMIN )
				{
					$phpbb2_color = ' style="color:#' . $theme['fontcolor3'] . '"';
				}
				else if ( $row['user_level'] == MOD )
				{
					$phpbb2_color = ' style="color:#' . $theme['fontcolor2'] . '"';
				}
				$phpbb2_user_birthdays[] = '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $phpbb2_color . '>' . UsernameColor($row['username']) . '</a>' . $phpbb2_age;
			}
			$titanium_db->sql_freeresult($result);
	
			$phpbb2_birthdays = (!empty($phpbb2_user_birthdays)) ?
				sprintf($titanium_lang['Congratulations'],implode(', ',$phpbb2_user_birthdays)) :
				$titanium_lang['No_birthdays'];
	
			if ( $phpbb2_board_config['bday_lookahead'] != -1 )
			{
				$phpbb2_start = gmdate('md9999',strtotime('+'.$phpbb2_board_config['bday_lookahead'].' day') + (3600 * $phpbb2_board_config['board_timezone']));
				$phpbb2_end = gmdate('md0000',strtotime('+1 day') + (3600 * $phpbb2_board_config['board_timezone']));
				$phpbb2_operator = ($phpbb2_start > $phpbb2_end) ? 'AND' : 'OR';
				$sql = "SELECT user_id, username, user_birthday, birthday_display, user_level 
					FROM " . USERS_TABLE . " 
					WHERE (user_birthday <= $phpbb2_start 
						$phpbb2_operator user_birthday >= $phpbb2_end)
						AND user_birthday <> 0 
						AND user_active = 1 
						AND birthday_display <> " . BIRTHDAY_NONE . " 
						AND birthday_display <> " . BIRTHDAY_AGE . " 
					ORDER BY user_birthday ASC, username DESC";
				if ( !($result = $titanium_db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not query upcoming birthday information', '', __LINE__, __FILE__, $sql);
				}
				$phpbb2_upcoming_birthdays = array();
				while ( $row = $titanium_db->sql_fetchrow($result) )
				{
					$phpbb2_bday_month_day = floor($row['user_birthday'] / 10000);
					$phpbb2_bday_year_age = ( $row['birthday_display'] != BIRTHDAY_DATE ) ? $row['user_birthday'] - 10000*$phpbb2_bday_month_day : 0;
					$phpbb2_fudge = ( gmdate('md') < $phpbb2_bday_month_day ) ? 0 : 1;
					$phpbb2_age = ( $phpbb2_bday_year_age ) ? ' ('.(gmdate('Y')-$phpbb2_bday_year_age+$phpbb2_fudge).')' : '';
					$phpbb2_color = '';
					if ( $row['user_level'] == ADMIN )
					{
						$phpbb2_color = ' style="color:#' . $theme['fontcolor3'] . '"';
					}
					else if ( $row['user_level'] == MOD )
					{
						$phpbb2_color = ' style="color:#' . $theme['fontcolor2'] . '"';
						}
					$phpbb2_upcoming_birthdays[] = '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $phpbb2_color . '>' . UsernameColor($row['username']) . '</a>' . $phpbb2_age;
				}
	
				$phpbb2_upcoming = (!empty($phpbb2_upcoming_birthdays)) ?
					sprintf($titanium_lang['Upcoming_birthdays'],$phpbb2_board_config['bday_lookahead'],implode(', ',$phpbb2_upcoming_birthdays)) :
					sprintf($titanium_lang['No_upcoming'],$phpbb2_board_config['bday_lookahead']);
			}
	
			if ( !empty($phpbb2_user_birthdays) || !empty($phpbb2_upcoming_birthdays) || $phpbb2_board_config['bday_show'] )
			{
				$phpbb2_template->assign_block_vars('birthdays',array());
				if ( !empty($phpbb2_upcoming_birthdays) || $phpbb2_board_config['bday_show'] )
				{
					$phpbb2_template->assign_block_vars('birthdays.upcoming',array());
				}
			}
		}
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

        //
        // Find which forums are visible for this user
        //
        $phpbb2_is_auth_ary = array();
        $phpbb2_is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $phpbb2_forum_data);

        //
        // Start output of page
        //
        define('SHOW_ONLINE', true);
        $phpbb2_page_title = $titanium_lang['Index'];
        include("includes/page_header.php");

        $phpbb2_template->set_filenames(array(
                'body' => 'index_body.tpl')
        );

/*****[BEGIN]******************************************
 [ Mod:     Number Format Total Posts          v1.0.4 ]
 ******************************************************/
        $phpbb2_total_posts_format = sprintf($phpbb2_l_total_post_s, $phpbb2_total_posts);
        $phpbb2_total_posts_format = str_replace($phpbb2_total_posts, number_format($phpbb2_total_posts), $phpbb2_total_posts_format);

        $phpbb2_template->assign_vars(array(
                'TOTAL_POSTS' => $phpbb2_total_posts_format,
/*****[END]********************************************
 [ Mod:     Number Format Total Posts          v1.0.4 ]
 ******************************************************/
                'TOTAL_USERS' => sprintf($phpbb2_l_total_user_s, $phpbb2_total_users),
                'NEWEST_USER' => sprintf($titanium_lang['Newest_user'], '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$phpbb2_newest_uid") . '">', $phpbb2_newest_user, '</a>'),
				
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'BIRTHDAYS' => $phpbb2_birthdays,
				'UPCOMING' => $phpbb2_upcoming,
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				
/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/       
				  'GLOBAL_TITLE' => $phpbb2_board_config['global_title'], 
				  'GLOBAL_ANNOUNCEMENT' => str_replace(array('<br />', '<br>'), "", $phpbb2_board_config['global_announcement']), 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/

                  'SHOW_LAST_POST_AVATAR' => $phpbb2_board_config['last_post_avatar'],

/*****[BEGIN]******************************************
[ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
******************************************************/
		// 'U_CFI_JSLIB'			=> 'includes/collapsible_forum_index.js',
		'CFI_COOKIE_NAME'		=> get_cfi_cookie_name(),
		'COOKIE_PATH'			=> $phpbb2_board_config['cookie_path'],
		'COOKIE_DOMAIN'			=> $phpbb2_board_config['cookie_domain'],
		'COOKIE_SECURE'			=> $phpbb2_board_config['cookie_secure'],
		'L_CFI_OPTIONS'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $titanium_lang['CFI_options']),
		'L_CFI_OPTIONS_EX'		=> str_replace(array("'",' '), array("\'",'&nbsp;'), $titanium_lang['CFI_options_ex']),
		'L_CFI_CLOSE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $titanium_lang['CFI_close']),
		'L_CFI_DELETE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $titanium_lang['CFI_delete']),
		'L_CFI_RESTORE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $titanium_lang['CFI_restore']),
		'L_CFI_SAVE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $titanium_lang['CFI_save']),
		'L_CFI_EXPAND_ALL'		=> str_replace(array("'",' '), array("\'",'&nbsp;'), $titanium_lang['CFI_Expand_all']),
		'L_CFI_COLLAPSE_ALL'	=> str_replace(array("'",' '), array("\'",'&nbsp;'), $titanium_lang['CFI_Collapse_all']),
		'IMG_UP_ARROW'			=> $images['up_arrow'],
		'IMG_DW_ARROW'			=> $images['down_arrow'],
		'IMG_PLUS'				=> $images['icon_sign_plus'],
		'IMG_MINUS'				=> $images['icon_sign_minus'],
		'SPACER'				=> $phpbb2_root_path . 'images/spacer.gif',
/*****[END]********************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/

                'FORUM_IMG' => $images['forum'],
                'FORUM_NEW_IMG' => $images['forum_new'],
                'FORUM_LOCKED_IMG' => $images['forum_locked'],

/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'L_TODAYS_BIRTHDAYS' => $titanium_lang['Todays_Birthdays'],
				'L_VIEW_BIRTHDAYS' => $titanium_lang['View_Birthdays'],
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

                'L_FORUM' => $titanium_lang['Forum'],
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
		        'L_SUBFORUMS' => $titanium_lang['Subforums'],
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                'L_TOPICS' => $titanium_lang['Topics'],
                'L_REPLIES' => $titanium_lang['Replies'],
                'L_VIEWS' => $titanium_lang['Views'],
                'L_POSTS' => $titanium_lang['Posts'],
                'L_LASTPOST' => $titanium_lang['Last_Post'],
                'L_NO_NEW_POSTS' => $titanium_lang['No_new_posts'],
                'L_NEW_POSTS' => $titanium_lang['New_posts'],
                'L_NO_NEW_POSTS_LOCKED' => $titanium_lang['No_new_posts_locked'],
                'L_NEW_POSTS_LOCKED' => $titanium_lang['New_posts_locked'],
                'L_ONLINE_EXPLAIN' => $titanium_lang['Online_explain'],

                'L_MODERATOR' => $titanium_lang['Moderators'],
                'L_FORUM_LOCKED' => $titanium_lang['Forum_is_locked'],
                'L_MARK_FORUMS_READ' => $titanium_lang['Mark_all_forums'],

                'U_MARK_READ' => append_titanium_sid("index.$phpEx?mark=forums"))
        );

      	//
     	// Let's decide which categories we should display
     	//
     	$phpbb2_display_categories = array();

     	for ($i = 0; $i < $total_phpbb2_forums; $i++ )
     	{
     		if ($phpbb2_is_auth_ary[$phpbb2_forum_data[$i]['forum_id']]['auth_view'])
     		{
     			$phpbb2_display_categories[$phpbb2_forum_data[$i]['cat_id']] = true;
     		}
     	}

        //
        // Okay, let's build the index
        //
        for($i = 0; $i < $total_phpbb2_categories; $i++)
        {
                $cat_id = $category_rows[$i]['cat_id'];

                //
                // Yes, we should, so first dump out the category
                // title, then, if appropriate the forum list
                //
                if (isset($phpbb2_display_categories[$cat_id]) && $phpbb2_display_categories[$cat_id])
                {
                        $phpbb2_template->assign_block_vars('catrow', array(
/*****[BEGIN]******************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
				            'DISPLAY' => (is_category_collapsed($cat_id) ? '' : 'none'),
/*****[END]********************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
                                
                            'CAT_ID' => $cat_id,
                            'CAT_DESC' => $category_rows[$i]['cat_title'],
                            'U_VIEWCAT' => append_titanium_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"))
                        );

                        if ( $phpbb2_viewcat == $cat_id || $phpbb2_viewcat == -1 )
                        {
                                for($j = 0; $j < $total_phpbb2_forums; $j++)
                                {
                                        if ( $phpbb2_forum_data[$j]['cat_id'] == $cat_id )
                                        {
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
                                            // if ($phpbb2_forum_data[$j]['user_avatar'] == "")
                                            //     $phpbb2_poster_avatar = $phpbb2_board_config['avatar_path']."/blank.gif";
                                            // elseif ($phpbb2_forum_data[$j]['user_avatar'] == "gallery/blank.gif")
                                            //     $phpbb2_poster_avatar = $phpbb2_board_config['avatar_path']."/blank.gif";
                                            // elseif (preg_match('#http://#i', $phpbb2_forum_data[$j]['user_avatar']))
                                            //     $phpbb2_poster_avatar = $phpbb2_forum_data[$j]['user_avatar'];
                                            // elseif (preg_match('#gallery/#i', $phpbb2_forum_data[$j]['user_avatar'])) 
                                            //     $phpbb2_poster_avatar = $phpbb2_board_config['avatar_gallery_path'].'/'.$phpbb2_forum_data[$j]['user_avatar'];
                                            // else
                                            //     $phpbb2_poster_avatar = $phpbb2_board_config['avatar_path']."/".$phpbb2_forum_data[$j]['user_avatar']; 

                                            $phpbb2_poster_avatar = $phpbb2_board_config['default_avatar_users_url'];
                                            switch( $phpbb2_forum_data[$j]['user_avatar_type'] )
                                            {
                                                case USER_AVATAR_UPLOAD:
                                                    $phpbb2_poster_avatar = $phpbb2_board_config['avatar_path'] . '/' . $phpbb2_forum_data[$j]['user_avatar'];
                                                    break;
                                                case USER_AVATAR_REMOTE:
                                                    $phpbb2_poster_avatar = resize_avatar($phpbb2_forum_data[$j]['user_avatar']);
                                                    break;
                                                case USER_AVATAR_GALLERY:
                                                    $phpbb2_poster_avatar = $phpbb2_board_config['avatar_gallery_path'] . '/' . (($phpbb2_forum_data[$j]['user_avatar'] 
													== 'blank.gif' || $phpbb2_forum_data[$j]['user_avatar'] == 'gallery/blank.gif') ? 'blank.png' : $phpbb2_forum_data[$j]['user_avatar']);
                                                    break;
                                            }                                  
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
                                                $phpbb2_forum_id = $phpbb2_forum_data[$j]['forum_id'];

                                                if ( $phpbb2_is_auth_ary[$phpbb2_forum_id]['auth_view'] )
                                                {
                                                        if ( $phpbb2_forum_data[$j]['forum_status'] == FORUM_LOCKED )
                                                        {
                                                                $phpbb2_folder_image = $images['forum_locked'];
                                                               $phpbb2_folder_alt = $titanium_lang['Forum_locked'];
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
																$phpbb2_unread_topics = false;
																$phpbb2_folder_images = array(
																	'default'	=> $phpbb2_folder_image,
																	'new'		=> $images['forum_locked'],
																	'sub'		=> ( isset($images['forums_locked']) ) ? $images['forums_locked'] : $images['forum_locked'],
																	'subnew'	=> ( isset($images['forums_locked']) ) ? $images['forums_locked'] : $images['forum_locked'],
																	'subalt'	=> $titanium_lang['Forum_locked'],
																	'subaltnew'	=> $titanium_lang['Forum_locked'],
																	);
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                        }
                                                        else
                                                        {
                                                                $phpbb2_unread_topics = false;
                                                                if ( $userdata['session_logged_in'] )
                                                                {
                                                                       if ( !empty($new_phpbb2_topic_data[$phpbb2_forum_id]) )
                                                                        {
                                                                                $phpbb2_forum_last_post_time = 0;

                                                                                while( list($check_phpbb2_topic_id, $check_phpbb2_post_time) = @each($new_phpbb2_topic_data[$phpbb2_forum_id]) )
                                                                                {
                                                                                        if ( empty($phpbb2_tracking_topics[$check_phpbb2_topic_id]) )
                                                                                        {
                                                                                                $phpbb2_unread_topics = true;
                                                                                                $phpbb2_forum_last_post_time = max($check_phpbb2_post_time, $phpbb2_forum_last_post_time);

                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                if ( $phpbb2_tracking_topics[$check_phpbb2_topic_id] < $check_phpbb2_post_time )
                                                                                                {
                                                                                                        $phpbb2_unread_topics = true;
                                                                                                        $phpbb2_forum_last_post_time = max($check_phpbb2_post_time, $phpbb2_forum_last_post_time);
                                                                                                }
                                                                                        }
                                                                                }

                                                                                if ( !empty($phpbb2_tracking_forums[$phpbb2_forum_id]) )
                                                                                {
                                                                                        if ( $phpbb2_tracking_forums[$phpbb2_forum_id] > $phpbb2_forum_last_post_time )
                                                                                        {
                                                                                                $phpbb2_unread_topics = false;
                                                                                        }
                                                                                }

                                                                                if ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all']) )
                                                                                {
                                                                                        if ( $HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all'] > $phpbb2_forum_last_post_time )
                                                                                        {
                                                                                                $phpbb2_unread_topics = false;
                                                                                        }
                                                                                }

                                                                        }
                                                                }

                                                                $phpbb2_folder_image = ( $phpbb2_unread_topics ) ? $images['forum_new'] : $images['forum'];
                                                                $phpbb2_folder_alt = ( $phpbb2_unread_topics ) ? $titanium_lang['New_posts'] : $titanium_lang['No_new_posts'];
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
																$phpbb2_folder_images = array(
																	'default'	=> $phpbb2_folder_image,
																	'new'		=> $images['forum_new'],
																	'sub'		=> ( isset($images['forums']) ) ? $images['forums'] : $images['forum'],
																	'subnew'	=> ( isset($images['forums_new']) ) ? $images['forums_new'] : $images['forum_new'],
																	'subalt'	=> $titanium_lang['No_new_posts'],
																	'subaltnew'	=> $titanium_lang['New_posts'],
																	);
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                        }

                                                        $phpbb2_posts = $phpbb2_forum_data[$j]['forum_posts'];
                                                        $phpbb2_topics = $phpbb2_forum_data[$j]['forum_topics'];
/*****[BEGIN]******************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
														$phpbb2_icon = $phpbb2_forum_data[$j]['forum_icon'];
/*****[END]********************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/



                                                       if ( $phpbb2_forum_data[$j]['forum_last_post_id'] )
                                                        {
                                                                $phpbb2_last_post_time = create_date($phpbb2_board_config['default_dateformat'], $phpbb2_forum_data[$j]['post_time'], $phpbb2_board_config['board_timezone']);

                                                                // $phpbb2_last_post = $phpbb2_last_post_time . '<br />';
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                                                $phpbb2_last_post_username = ( $phpbb2_forum_data[$j]['user_id'] == ANONYMOUS ) ? ( ($phpbb2_forum_data[$j]['post_username'] != '' ) ? $phpbb2_forum_data[$j]['post_username'] . ' ' : $titanium_lang['Guest'] . ' ' ) : '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $phpbb2_forum_data[$j]['user_id']) . '">' . UsernameColor($phpbb2_forum_data[$j]['username']) . '</a> ';
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

                                                                // $phpbb2_last_post = '<a href="'.append_titanium_sid("viewtopic.$phpEx?".POST_POST_URL.'='.$phpbb2_forum_data[$j]['forum_last_post_id']).'#'.$phpbb2_forum_data[$j]['forum_last_post_id'].'"><img src="'.$images['icon_latest_reply'].'" border="0" alt="'.$titanium_lang['View_latest_post'].'" title="'.$titanium_lang['View_latest_post'].'" /></a>';
                                                                $phpbb2_last_post = '<a href="'.append_titanium_sid("viewtopic.$phpEx?".POST_POST_URL.'='.$phpbb2_forum_data[$j]['forum_last_post_id']).'#'.$phpbb2_forum_data[$j]['forum_last_post_id'].'"><i class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$titanium_lang['View_latest_post'].'"></i></a>';
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
																$phpbb2_last_post_sub = '<a href="' . append_titanium_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $phpbb2_forum_data[$j]['forum_last_post_id']) . '#' . $phpbb2_forum_data[$j]['forum_last_post_id'] . '"><img src="' . ($phpbb2_unread_topics ? $images['icon_miniforum_new'] : $images['icon_miniforum']) . '" border="0" alt="' . $titanium_lang['View_latest_post'] . '" title="' . $titanium_lang['View_latest_post'] . '" /></a>';
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                        }
                                                        else
                                                        {
                                                            $phpbb2_last_post_username = '';
                                                            $phpbb2_last_post = $titanium_lang['No_Posts'];
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
															$phpbb2_last_post_sub = '<img src="' . $images['icon_miniforum'] . '" border="0" alt="' . $titanium_lang['No_Posts'] . '" title="' . $titanium_lang['No_Posts'] . '" />';
															$phpbb2_last_post_time = '';
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                        }

                                                        if (isset($phpbb2_forum_moderators[$phpbb2_forum_id])) {
                                                            if ( count($phpbb2_forum_moderators[$phpbb2_forum_id]) > 0 )
                                                            {
                                                                    $l_phpbb2_moderators = ( count($phpbb2_forum_moderators[$phpbb2_forum_id]) == 1 ) ? $titanium_lang['Moderator'] : $titanium_lang['Moderators'];
                                                                    $phpbb2_moderator_list = implode(', ', $phpbb2_forum_moderators[$phpbb2_forum_id]);
                                                            }
                                                            else
                                                            {
                                                                    $l_phpbb2_moderators = '';
                                                                    $phpbb2_moderator_list = '';
                                                            }
                                                        }
                                                        else
                                                        {
                                                                $l_phpbb2_moderators = '';
                                                                $phpbb2_moderator_list = '';
                                                        }

                                                        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                                                        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                                                        /*--FNA--*/
                                                        global $phpbb2_icon;
														
                                                        $phpbb2_template->assign_block_vars('catrow.forumrow', array(
/*****[BEGIN]******************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
								                                'FORUM_ID' => $phpbb2_forum_id,
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
								                                'FORUM_FOLDER_IMG' => ( $phpbb2_forum_data[$j]['title_is_link'] == 1 && $phpbb2_forum_data[$j]['forum_link_icon'] != '' ) ? $phpbb2_forum_data[$j]['forum_link_icon'] : $phpbb2_folder_image,
	
############################################################################################################################################
# Forum Icon Path Mod - 09/26/2022 by Ernest Buffington - START                                                                            #       
############################################################################################################################################
'FORUM_ICON_IMG' => ($phpbb2_icon) 
? '<img src="' . forum_icon_img_path($forum_rows[$j]['forum_icon'], 'Forums') . $phpbb2_icon . '" alt="'.$phpbb2_forum_data[$j]['forum_name'].'" title="'.$phpbb2_forum_data[$j]['forum_name'].'" />' : '',
############################################################################################################################################
# Forum Icon Path Mod - 09/26/2022 by Ernest Buffington - END                                                                              #       
############################################################################################################################################

								                                
																'FORUM_LINK_COUNT' => ( $phpbb2_forum_data[$j]['title_is_link'] == 1 ) ? sprintf($titanium_lang['Forum_link_count'], $phpbb2_forum_data[$j]['forum_link_count']) : '',
								                                'FORUM_LINK_TARGET' => ($phpbb2_forum_data[$j]['forum_link_target']) ? 'target="_blank"' : '',
/*****[END]********************************************
 [ Mod:    Forum Icons                         v1.0.4 ]
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
                                                                'FORUM_NAME' => $phpbb2_forum_data[$j]['forum_name'],
/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                                                'FORUM_COLOR' => ( $phpbb2_forum_data[$j]['forum_color'] != '' ) ? ' style="color: #'.$phpbb2_forum_data[$j]['forum_color'].'"' : '',
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                                                'FORUM_DESC' => $phpbb2_forum_data[$j]['forum_desc'],
                                                                'POSTS' => $phpbb2_forum_data[$j]['forum_posts'],
                                                                'TOPICS' => $phpbb2_forum_data[$j]['forum_topics'],
                                                                'LAST_POST' => $phpbb2_last_post,
                                                                'LAST_POST_USERNAME' => ($phpbb2_last_post_username) ? sprintf(trim($titanium_lang['Recent_first_poster']),$phpbb2_last_post_username) : $phpbb2_last_post_username,
                                                                'LAST_POSTTIME' => $phpbb2_last_post_time,
                                                                'MODERATORS' => $phpbb2_moderator_list,
                                                                'L_MODERATOR' => $l_phpbb2_moderators,
                                                                'L_FORUM_FOLDER_ALT' => $phpbb2_folder_alt,
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
																'FORUM_FOLDERS' => serialize($phpbb2_folder_images),
																'HAS_SUBFORUMS' => 0,
																'PARENT' => $phpbb2_forum_data[$j]['forum_parent'],
																'ID' => $phpbb2_forum_data[$j]['forum_id'],
																'UNREAD' => intval($phpbb2_unread_topics),
																'TOTAL_UNREAD' => intval($phpbb2_unread_topics),
																'TOTAL_POSTS' => $phpbb2_forum_data[$j]['forum_posts'],
																'TOTAL_TOPICS' => $phpbb2_forum_data[$j]['forum_topics'],
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/                                                                
                                                                'LAST_POST_AVATAR' => $phpbb2_poster_avatar,
                                                                'LAST_POST_AVATAR_DISPLAY' => ($phpbb2_topics == 0) ? 'display:none; ' : '',
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
																'LAST_POST_FORUM' => $phpbb2_last_post,
																'LAST_POST_TIME' => $phpbb2_last_post_time,
																'LAST_POST_TIME_FORUM' => $phpbb2_last_post_time,
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                                                'LAST_POST_COUNT' => $phpbb2_posts,
/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
								'U_VIEWFORUM' => ( $phpbb2_forum_data[$j]['title_is_link'] == 1 ) ? append_titanium_sid("index.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id&amp;forum_link=1") : append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id"))

							);

							if ($phpbb2_forum_data[$j]['title_is_link'])
							{
								$phpbb2_template->assign_block_vars('catrow.forumrow.switch_forum_link_on', array());
							}
							else
							{
								$phpbb2_template->assign_block_vars('catrow.forumrow.switch_forum_link_off', array());
							}
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
							if( $phpbb2_forum_data[$j]['forum_parent'] )
							{
								$phpbb2_subforums_list[] = array(
									'forum_data'	=> $phpbb2_forum_data[$j],
									'folder_image'	=> $phpbb2_folder_image,
									'last_post'        => $phpbb2_last_post,
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
                                    'last_post_avatar' => $phpbb2_poster_avatar,
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
									'last_post_sub'	=> $phpbb2_last_post_sub,
									'moderator_list'	=> $phpbb2_moderator_list,
									'unread_topics'	=> $phpbb2_unread_topics,
									'l_moderators'	=> $l_phpbb2_moderators,
									'folder_alt'	=> $phpbb2_folder_alt,
									'last_post_time'	=> $phpbb2_last_post_time,
									'desc'			=> $phpbb2_forum_data[$j]['forum_desc'],
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
        message_die(GENERAL_MESSAGE, $titanium_lang['No_forums']);
}

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
unset($data);
unset($item);
unset($cat_item);
unset($row_item);
for( $i = 0; $i < count($phpbb2_subforums_list); $i++ )
{
	$phpbb2_forum_data = $phpbb2_subforums_list[$i]['forum_data'];
	$phpbb2_parent_id = $phpbb2_forum_data['forum_parent'];
	
	// Find parent item
	if( isset($phpbb2_template->_tpldata['catrow.']) )
	{
		$data = &$phpbb2_template->_tpldata['catrow.'];
		$count = count($data);
		for( $j = 0; $j < $count; $j++)
		{
			$cat_item = &$data[$j];
			$row_item = &$cat_item['forumrow.'];
			$count2 = count($row_item);
			for( $k = 0; $k < $count2; $k++)
			{
				if( $row_item[$k]['ID'] == $phpbb2_parent_id )
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
			'FORUM_FOLDER_IMG' => $phpbb2_subforums_list[$i]['folder_image'], 
			'FORUM_NAME' => $phpbb2_forum_data['forum_name'],
/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
            'FORUM_COLOR' => ( $phpbb2_forum_data['forum_color'] != '' ) ? 'style="color: #'.$phpbb2_forum_data['forum_color'].'"' : '',
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
			'FORUM_DESC' => $phpbb2_forum_data['forum_desc'],
			'FORUM_DESC_HTML' => htmlspecialchars(preg_replace('@<[\/\!]*?[^<>]*?>@si', '', $phpbb2_forum_data['forum_desc'])),
			'POSTS' => $phpbb2_forum_data['forum_posts'],
			'TOPICS' => $phpbb2_forum_data['forum_topics'],
			'LAST_POST' => $phpbb2_subforums_list[$i]['last_post'],
			'LAST_POST_SUB' => $phpbb2_subforums_list[$i]['last_post_sub'],
			'LAST_TOPIC' => $phpbb2_forum_data['topic_title'],
			'MODERATORS' => $phpbb2_subforums_list[$i]['moderator_list'],
			'PARENT' => $phpbb2_forum_data['forum_parent'],
			'ID' => $phpbb2_forum_data['forum_id'],
			'UNREAD' => intval($phpbb2_subforums_list[$i]['unread_topics']),	
			'L_MODERATOR' => $phpbb2_subforums_list[$i]['l_moderators'], 
			'L_FORUM_FOLDER_ALT' => $phpbb2_subforums_list[$i]['folder_alt'], 	
			'U_VIEWFORUM' => append_titanium_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $phpbb2_forum_data['forum_id'])
		);
		$item['HAS_SUBFORUMS'] ++;
		$item['TOTAL_UNREAD'] += intval($phpbb2_subforums_list[$i]['unread_topics']);
		// Change folder image
		$images2 = unserialize($item['FORUM_FOLDERS']);
		$item['FORUM_FOLDER_IMG'] = $item['TOTAL_UNREAD'] ? $images2['subnew'] : $images2['sub'];
		$item['L_FORUM_FOLDER_ALT'] = $item['TOTAL_UNREAD'] ? $images2['subaltnew'] : $images2['subalt'];
		// Check last post
		if( $item['LAST_POST_TIME'] < $phpbb2_subforums_list[$i]['last_post_time'] )
		{
			$item['LAST_POST'] = $phpbb2_subforums_list[$i]['last_post'];
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
            $item['LAST_POST_AVATAR'] = $phpbb2_subforums_list[$i]['last_post_avatar'];
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
			$item['LAST_POST_TIME'] = $phpbb2_subforums_list[$i]['last_post_time'];
		}
		if( !$item['LAST_POST_TIME_FORUM'] )
		{
			$item['LAST_POST_FORUM'] = $item['LAST_POST'];
		}
		// Add topics/posts
		$item['TOTAL_POSTS'] += $phpbb2_forum_data['forum_posts'];
		$item['TOTAL_TOPICS'] += $phpbb2_forum_data['forum_topics'];
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
    include($phpbb2_root_path . 'glance.php');
}
/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Base:    At a Glance                        v2.2.1 ]
 ******************************************************/

//
// Generate the page 
//
$phpbb2_template->pparse('body');

include("includes/page_tail.php");

?>