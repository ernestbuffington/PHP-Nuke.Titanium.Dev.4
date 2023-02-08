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

if (!isset($popup))
{
  $module_name = basename(__DIR__);
  require("modules/".$module_name."/nukebb.php");
}
else
{
  $phpbb_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

include(NUKE_BASE_DIR . '/includes/bbcode.'.$phpEx);

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
$forum_id = ( isset($_GET[POST_FORUM_URL]) ) ? (int) $_GET[POST_FORUM_URL] : 0;
$forum_link = ( isset($_GET['forum_link']) ) ? (int) $_GET['forum_link'] : 0;

if(!isset($has_subforums))
$has_subforums  = '';
else
$has_subforums = 0;

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

$viewcat = ( empty($_GET[POST_CAT_URL]) ) ? -1 : $_GET[POST_CAT_URL];

$mark_read = isset($_GET['mark']) || isset($_POST['mark']) ? $_POST['mark'] ?? $_GET['mark'] : '';

//
// Handle marking posts
//
if( $mark_read == 'forums' )
{
   if( $userdata['session_logged_in'] )
   {
     setcookie($board_config['cookie_name'] . '_f_all', time(), ['expires' => 0, 'path' => (string) $board_config['cookie_path'], 'domain' => (string) $board_config['cookie_domain'], 'secure' => $board_config['cookie_secure']]);
   }

     $template->assign_vars(["META" => '<meta http-equiv="refresh" content="3;url='  .append_sid("index.$phpEx") . '">']
     );

     $message = $lang['Forums_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a> ');

     message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//

$tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . "_t"]) : [];
$tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . "_f"]) : [];

//
// If you don't use these stats on your index you may want to consider
// removing them
//
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$newest_userdata = get_db_stat('newestuser');
$newest_user = UsernameColor($newest_userdata['username']);
$newest_uid = $newest_userdata['user_id'];

if ($total_posts == 0) {
  $l_total_post_s = $lang['Posted_articles_zero_total'];
} elseif ($total_posts == 1) {
  $l_total_post_s = $lang['Posted_article_total'];
} else
{
  $l_total_post_s = $lang['Posted_articles_total'];
}

if ($total_users == 0) {
  $l_total_user_s = $lang['Registered_users_zero_total'];
} elseif ($total_users == 1) {
  $l_total_user_s = $lang['Registered_user_total'];
} else
{
  $l_total_user_s = $lang['Registered_users_total'];
}

/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
if ($board_config['global_enable']== 1  && $board_config['marquee_disable']== 0) {
  $template->assign_block_vars('switch_disable_global_marquee', []);
} elseif ($board_config['global_enable']== 1  &&  $board_config['marquee_disable']== 1) {
  $template->assign_block_vars('switch_enable_global_marquee', []);
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
        ".(($userdata['user_level'] != ADMIN)? "WHERE c.cat_id<>'".HIDDEN_CAT."'" :"" )."
        ORDER BY c.cat_order";
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
if( !($result = $db->sql_query($sql)) )
{
  message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}
$category_rows = [];
while ($row = $db->sql_fetchrow($result))
{
  $category_rows[] = $row;
}
$db->sql_freeresult($result);

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
$subforums_list = [];
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

if( ( ($total_categories = count($category_rows)) !== 0 ) )
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

  $forum_data = [];
  while( $row = $db->sql_fetchrow($result) )
  {
    $forum_data[] = $row;
  }
  $db->sql_freeresult($result);

  if ( ($total_forums = count($forum_data)) === 0 )
  {
    message_die(GENERAL_MESSAGE, $lang['No_forums']);
  }

    //
    // Obtain a list of topic ids which contain
    // posts made since user last visited
    //
    if (isset($userdata['session_logged_in']))
    {
        // 60 days limit
        if ($userdata['user_lastvisit'] < (time() - 5_184_000))
        {
            $userdata['user_lastvisit'] = time() - 5_184_000;
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

        $new_topic_data = [];
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
        $forum_moderators = [];
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
          # Change The Font size of the moderators groups links on the forum index HERE    
		  $forum_moderators[$row['forum_id']][] = '<a style="font-size:0.9em !important;" href="'.append_sid("groupcp.$phpEx?".POST_GROUPS_URL."=".$row['group_id']).'">'.GroupColor($row['group_name']).'</a>';
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

			$user_birthdays = [];
			while ( $row = $db->sql_fetchrow($result) )
			{
				// if birthday_display is set to "Display day and month (but not year)" (eg. BIRTHDAY_DATE), set the year
				// to 0.
				$bday_year = ( $row['birthday_display'] != BIRTHDAY_DATE ) ? $row['user_birthday'] % 10000 : 0;
				$age = ( $bday_year !== 0 ) ? ' ('.(gmdate('Y')-$bday_year).')' : '';
				$color = '';
				if ($row['user_level'] == ADMIN) {
        $color = ' style="color:#' . $theme['fontcolor3'] . '"';
    } elseif ($row['user_level'] == MOD) {
        $color = ' style="color:#' . $theme['fontcolor2'] . '"';
    }
				$user_birthdays[] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $color . '>' . UsernameColor($row['username']) . '</a>' . $age;
			}
			$db->sql_freeresult($result);

			$birthdays = ($user_birthdays === []) ?
				$lang['No_birthdays'] :
				sprintf($lang['Congratulations'],implode(', ',$user_birthdays));

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
				$upcoming_birthdays = [];
				while ( $row = $db->sql_fetchrow($result) )
				{
					$bday_month_day = floor($row['user_birthday'] / 10000);
					$bday_year_age = ( $row['birthday_display'] != BIRTHDAY_DATE ) ? $row['user_birthday'] - 10000*$bday_month_day : 0;
					$fudge = ( gmdate('md') < $bday_month_day ) ? 0 : 1;
					$age = ( $bday_year_age ) ? ' ('.(gmdate('Y')-$bday_year_age+$fudge).')' : '';
					$color = '';
					if ($row['user_level'] == ADMIN) {
         $color = ' style="color:#' . $theme['fontcolor3'] . '"';
     } elseif ($row['user_level'] == MOD) {
         $color = ' style="color:#' . $theme['fontcolor2'] . '"';
     }
					$upcoming_birthdays[] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $color . '>' . UsernameColor($row['username']) . '</a>' . $age;
				}

				$upcoming = ($upcoming_birthdays === []) ?
					sprintf($lang['No_upcoming'],$board_config['bday_lookahead']) :
					sprintf($lang['Upcoming_birthdays'],$board_config['bday_lookahead'],implode(', ',$upcoming_birthdays));
			}

			if ( $user_birthdays !== [] || !empty($upcoming_birthdays) || $board_config['bday_show'] )
			{
				$template->assign_block_vars('birthdays',[]);
				if ( !empty($upcoming_birthdays) || $board_config['bday_show'] )
				{
					$template->assign_block_vars('birthdays.upcoming',[]);
				}
			}
		}
       /*****[END]********************************************
        [ Mod:    Birthdays                           v3.0.0 ]
        ******************************************************/

        //
        // Find which forums are visible for this user
        //
        $is_auth_ary = [];
        $is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);

        //
        // Start output of page
        //
        define('SHOW_ONLINE', true);
        $page_title = $lang['Index'];
        include(NUKE_BASE_DIR . "/includes/page_header.php");

        $template->set_filenames(['body' => 'index_body.tpl']
        );

        /*****[BEGIN]******************************************
         [ Mod:     Number Format Total Posts          v1.0.4 ]
         ******************************************************/
        $total_posts_format = sprintf($l_total_post_s, $total_posts);
        $total_posts_format = str_replace($total_posts, number_format($total_posts), $total_posts_format);

if(!isset($images['up_arrow']))
$images['up_arrow'] = '';
if(!isset($images['down_arrow']))
$images['down_arrow'] = '';
if(!isset($images['icon_sign_plus']))
$images['icon_sign_plus'] = '';
if(!isset($images['icon_sign_minus']))
$images['icon_sign_minus'] = '';
if(!isset($images['Mini_Arcade']))
$images['Mini_Arcade'] = '';

        $template->assign_vars([
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
            'GLOBAL_ANNOUNCEMENT' => str_replace(['<br />', '<br>'], "", (string) $board_config['global_announcement']),
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
            'L_CFI_OPTIONS'			=> str_replace(["'", ' '], ["\'", '&nbsp;'], (string) $lang['CFI_options']),
            'L_CFI_OPTIONS_EX'		=> str_replace(["'", ' '], ["\'", '&nbsp;'], (string) $lang['CFI_options_ex']),
            'L_CFI_CLOSE'			=> str_replace(["'", ' '], ["\'", '&nbsp;'], (string) $lang['CFI_close']),
            'L_CFI_DELETE'			=> str_replace(["'", ' '], ["\'", '&nbsp;'], (string) $lang['CFI_delete']),
            'L_CFI_RESTORE'			=> str_replace(["'", ' '], ["\'", '&nbsp;'], (string) $lang['CFI_restore']),
            'L_CFI_SAVE'			=> str_replace(["'", ' '], ["\'", '&nbsp;'], (string) $lang['CFI_save']),
            'L_CFI_EXPAND_ALL'		=> str_replace(["'", ' '], ["\'", '&nbsp;'], (string) $lang['CFI_Expand_all']),
            'L_CFI_COLLAPSE_ALL'	=> str_replace(["'", ' '], ["\'", '&nbsp;'], (string) $lang['CFI_Collapse_all']),
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
            'U_MARK_READ' => append_sid("index.$phpEx?mark=forums"),
        ]
        );

      	//
     	// Let's decide which categories we should display
     	//
     	$display_categories = [];

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
                        $template->assign_block_vars('catrow', [
                            /*****[BEGIN]******************************************
                             [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
                             ******************************************************/
                            'DISPLAY' => (is_category_collapsed($cat_id) ? '' : 'none'),
                            /*****[END]********************************************
                             [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
                             ******************************************************/
                            'CAT_ID' => $cat_id,
                            'CAT_DESC' => $category_rows[$i]['cat_title'],
                            'U_VIEWCAT' => append_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"),
                        ]
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
                                            //     $poster_avatar = $board_config['avatar_path']."/blank.png";
                                            // elseif ($forum_data[$j]['user_avatar'] == "gallery/blank.png")
                                            //     $poster_avatar = $board_config['avatar_path']."/blank.png";
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
													== 'blank.png' || $forum_data[$j]['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $forum_data[$j]['user_avatar']);
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
																$folder_images = ['default'	=> 
																       $folder_image, 'new' => $images['forum_locked'], 
																	                  'sub' => $images['forums_locked'] 
													   ?? $images['forum_locked'], 'subnew' => $images['forums_locked'] 
											  		   ?? $images['forum_locked'], 'subalt' => $lang['Forum_locked'], 
														                        'subaltnew' => $lang['Forum_locked']];
                                            /*****[END]********************************************
                                             [ Mod:    Simple Subforums                    v1.0.1 ]
                                             ******************************************************/
                                                        }
                                                        else
                                                        {
                                                                $unread_topics = false;
                                                                if ($userdata['session_logged_in'] && !empty($new_topic_data[$forum_id])) {
                                                                    $forum_last_post_time = 0;
                                                                    
																	foreach ($new_topic_data[$forum_id] as $check_topic_id => $check_post_time)
                                                                    {
                                                                            if (empty($tracking_topics[$check_topic_id])) {
                                                                                $unread_topics = true;
                                                                                $forum_last_post_time = max($check_post_time, $forum_last_post_time);
                                                                            } elseif ($tracking_topics[$check_topic_id] < $check_post_time) {
                                                                                $unread_topics = true;
                                                                                $forum_last_post_time = max($check_post_time, $forum_last_post_time);
                                                                            }
                                                                    }
                                                                    if ( !empty($tracking_forums[$forum_id]) && $tracking_forums[$forum_id] > $forum_last_post_time )
                                                                    {
                                                                            $unread_topics = false;
                                                                    }
                                                                    if ( isset($_COOKIE[$board_config['cookie_name'] . '_f_all']) && $_COOKIE[$board_config['cookie_name'] . '_f_all'] > $forum_last_post_time )
                                                                    {
                                                                            $unread_topics = false;
                                                                    }
                                                                }

                                                                $folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum'];
                                                                $folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts'];
                                                               /*****[BEGIN]******************************************
                                                                [ Mod:    Simple Subforums                    v1.0.1 ]
                                                                ******************************************************/
																$folder_images = ['default'	=> $folder_image, 'new'		
																                            => $images['forum_new'], 'sub'		
																							=> $images['forums'] ?? $images['forum'], 'subnew'	
																							=> $images['forums_new'] ?? $images['forum_new'], 'subalt'	
																							=> $lang['No_new_posts'], 'subaltnew'	
																							=> $lang['New_posts']];
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
                                                                $last_post_username = ( $forum_data[$j]['user_id'] == ANONYMOUS ) 
																? ( ($forum_data[$j]['post_username'] != '' ) 
																? $forum_data[$j]['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a 
																href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $forum_data[$j]['user_id']) . 
																'">' . UsernameColor($forum_data[$j]['username']) . '</a> ';
                                                         /*****[END]********************************************
                                                          [ Mod:    Advanced Username Color             v1.0.5 ]
                                                          ******************************************************/
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
                                                            if ( $forum_moderators[$forum_id] !== [] )
                                                            {
                                                                    $moderator_list_font_change = ( count($forum_moderators[$forum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
																	$l_moderators = '<span style="font-size:0.9em !important;">'.$moderator_list_font_change.'</span>';
                                                                    $moderator_list_font_change = implode(', ', $forum_moderators[$forum_id]);
																	$moderator_list = '<span style="font-size:0.9em !important;">'.$moderator_list_font_change.'</span>';
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

                                                        $row_color = ( $i % 2 === 0 ) ? $theme['td_color1'] : $theme['td_color2'];
                                                        $row_class = ( $i % 2 ) ? $theme['td_class2'] : $theme['td_class1'];

                                                        /*--FNA--*/
                                                        if(!isset($forum_rows[$j]['forum_icon']))
														$forum_rows[$j]['forum_icon'] = '';
                                                        
														$l_moderators_font_change = '<span style="font-size:0.9em !important;">'.$l_moderators.'</span>';
														$moderator_list_font_change = '<span style="font-size:0.9em !important;">'.$moderator_list.'</span>';
														
														$template->assign_block_vars('catrow.forumrow', [
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
                                                            ############################################################################################################################################
                                                            # Forum Icon Path Mod - 09/26/2022 by Ernest Buffington - START                                                                            #
                                                            ############################################################################################################################################
                                                            'FORUM_ICON_IMG' => ($icon) 
                                                            ? '<img src="' . forum_icon_img_path($forum_rows[$j]['forum_icon'], 'Forums') . $icon . '" alt="'.$forum_data[$j]['forum_name'].'" title="'.$forum_data[$j]['forum_name'].'" />' : '',
                                                            ############################################################################################################################################
                                                            # Forum Icon Path Mod - 09/26/2022 by Ernest Buffington - END                                                                              #
                                                            ############################################################################################################################################
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
                                                            'LAST_POST_USERNAME' => ($last_post_username !== '' && $last_post_username !== '0') ? sprintf(trim((string) $lang['Recent_first_poster']),$last_post_username) : $last_post_username,
                                                            'LAST_POSTTIME' => $last_post_time,
                                                            'MODERATORS' => $moderator_list_font_change,
                                                            'L_MODERATOR' => $l_moderators_font_change, 
                                                            'L_FORUM_FOLDER_ALT' => $folder_alt,
                                                            /*****[BEGIN]******************************************
                                                             [ Mod:    Simple Subforums                    v1.0.1 ]
                                                             ******************************************************/
                                                            'FORUM_FOLDERS' => serialize($folder_images),
                                                            'HAS_SUBFORUMS' => $has_subforums,
                                                            'PARENT' => $forum_data[$j]['forum_parent'],
                                                            'ID' => $forum_data[$j]['forum_id'],
                                                            'UNREAD' => (int) $unread_topics,
                                                            'TOTAL_UNREAD' => (int) $unread_topics,
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
                                                            'U_VIEWFORUM' => ( $forum_data[$j]['title_is_link'] == 1 ) 
															? append_sid("index.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;forum_link=1") : append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
                                                        ]

							);

							if ($forum_data[$j]['title_is_link'])
							{
								$template->assign_block_vars('catrow.forumrow.switch_forum_link_on', []);
							}
							else
							{
								$template->assign_block_vars('catrow.forumrow.switch_forum_link_off', []);
							}
            /*****[END]********************************************
             [ Mod:    Forumtitle as Weblink               v1.2.2 ]
             ******************************************************/
            /*****[BEGIN]******************************************
             [ Mod:    Simple Subforums                    v1.0.1 ]
             ******************************************************/
							if( $forum_data[$j]['forum_parent'] )
							{
								$subforums_list[] = [
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
        ];
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
foreach ($subforums_list as $i => $singleSubforums_list) {
    $forum_data = $singleSubforums_list['forum_data'];
    $parent_id = $forum_data['forum_parent'];
    // Find parent item
    if( isset($template->_tpldata['catrow.']) )
   	{
   		$data = &$template->_tpldata['catrow.'];
   		$count = is_countable($data) ? count($data) : 0;
   		for( $j = 0; $j < $count; $j++)
   		{
   			$cat_item = &$data[$j];
   			$row_item = &$cat_item['forumrow.'];
   			$count2 = is_countable($row_item) ? count($row_item) : 0;
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
   			$num = is_countable($item['sub.']) ? count($item['sub.']) : 0;
   			$data = &$item['sub.'];
   		}
   		else
   		{
   			$num = 0;
   			$item[] = 'sub.';
   			$data = &$item['sub.'];
   		}
   		
		if(!isset($forum_data['topic_title']))
        $forum_data['topic_title'] = 'No Topic Ttile';
   		// Append new entry
   		$data[] = [
         'NUM' => $num,
         'FORUM_FOLDER_IMG' => $singleSubforums_list['folder_image'],
         'FORUM_NAME' => $forum_data['forum_name'],
         /*****[BEGIN]******************************************
          [ Mod:    Colorize Forumtitle                 v1.0.0 ]
          ******************************************************/
         'FORUM_COLOR' => ( $forum_data['forum_color'] != '' ) ? 'style="color: #'.$forum_data['forum_color'].'"' : '',
         /*****[END]********************************************
          [ Mod:    Colorize Forumtitle                 v1.0.0 ]
          ******************************************************/
         'FORUM_DESC' => $forum_data['forum_desc'],
         'FORUM_DESC_HTML' => htmlspecialchars(preg_replace('#<[\/\!]*?[^<>]*?>#si', '', (string) $forum_data['forum_desc'])),
         'POSTS' => $forum_data['forum_posts'],
         'TOPICS' => $forum_data['forum_topics'],
         'LAST_POST' => $singleSubforums_list['last_post'],
         'LAST_POST_SUB' => $singleSubforums_list['last_post_sub'],
         'LAST_TOPIC' => $forum_data['topic_title'],
         'MODERATORS' => $singleSubforums_list['moderator_list'],
         'PARENT' => $forum_data['forum_parent'],
         'ID' => $forum_data['forum_id'],
         'UNREAD' => (int) $singleSubforums_list['unread_topics'],
         'L_MODERATOR' => $singleSubforums_list['l_moderators'],
         'L_FORUM_FOLDER_ALT' => $singleSubforums_list['folder_alt'],
         'U_VIEWFORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_data['forum_id']),
     ];
   		$item['HAS_SUBFORUMS'] ++;
   		$item['TOTAL_UNREAD'] += (int) $singleSubforums_list['unread_topics'];
   		// Change folder image
   		$images2 = unserialize($item['FORUM_FOLDERS']);
   		$item['FORUM_FOLDER_IMG'] = $item['TOTAL_UNREAD'] ? $images2['subnew'] : $images2['sub'];
   		$item['L_FORUM_FOLDER_ALT'] = $item['TOTAL_UNREAD'] ? $images2['subaltnew'] : $images2['subalt'];
   		// Check last post
   		if( $item['LAST_POST_TIME'] < $singleSubforums_list['last_post_time'] )
   		{
   			$item['LAST_POST'] = $singleSubforums_list['last_post'];
   /*****[BEGIN]******************************************
    [ Mod:    Forum Index Avatar Mod                 v1.0]
    ******************************************************/
               $item['LAST_POST_AVATAR'] = $singleSubforums_list['last_post_avatar'];
   /*****[END]********************************************
    [ Mod:    Forum Index Avatar Mod                 v1.0]
    ******************************************************/
   			$item['LAST_POST_TIME'] = $singleSubforums_list['last_post_time'];
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

include(NUKE_BASE_DIR . "/includes/page_tail.php");

?>
