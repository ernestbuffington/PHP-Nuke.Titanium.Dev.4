<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

 
/***************************************************************************
 *                              viewonline.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: viewonline.php,v 1.54.2.4 2005/05/06 20:50:10 acydburn Exp
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
      Recent Topics                            v1.2.4       06/11/2005
      Staff Site                               v2.0.3       06/24/2005
      Better Session Handling                  v1.0.0       06/25/2005
      Hidden Status Viewing                    v1.0.0       08/21/2005
      Online Time                              v1.0.0       08/21/2005
	  Users Reputations Systems                v1.0.0       05/24/2009
	  Arcade                                   v3.0.2       05/29/2009
      Who viewed a topic                       v1.0.3
 ************************************************************************/

if (!defined('MODULE_FILE')) 
{
    die ("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
require("modules/".$module_name."/nukebb.php");
define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_VIEWONLINE);
init_userprefs($userdata);
//
// End session management
//

//
// Output page header and load viewonline template
//
if(!isset($lang['Who_is_online']))
$lang['Who_is_online'] = 'Who is online?';

$page_title = $lang['Who_is_online'];

include("includes/page_header.php");

$template->set_filenames(array(
    'body' => 'viewonline_body.tpl')
);

make_jumpbox('viewforum.'.$phpEx);
$template->assign_vars(array(
        'L_WHOSONLINE' => $lang['Who_is_Online'],
        'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
        'L_USERNAME' => $lang['Username'],
        'L_FORUM_LOCATION' => $lang['Forum_Location'],
        'L_LAST_UPDATE' => $lang['Last_updated'])
);

/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
    $q = "SELECT forum_id, forum_name FROM ". FORUMS_TABLE ."";
    $r = $db->sql_query($q);
    $forums_data = $db->sql_fetchrowset($r);

    $q = "SELECT username, user_id FROM ". USERS_TABLE ."";
    $r = $db->sql_query($q);
    $users_data = $db->sql_fetchrowset($r);

    $q = "SELECT topic_id, topic_title FROM ". TOPICS_TABLE ."";
    $r = $db->sql_query($q);
    $topics_data = $db->sql_fetchrowset($r);

    $q = "SELECT cat_id, cat_title FROM ". CATEGORIES_TABLE ."";
    $r = $db->sql_query($q);
    $cats_data = $db->sql_fetchrowset($r);
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

//
// Forum info
//
$sql = "SELECT forum_name, forum_id FROM " . FORUMS_TABLE;
if ( $result = $db->sql_query($sql) )
{
    while( $row = $db->sql_fetchrow($result) )
    {
        $forum_data[$row['forum_id']] = $row['forum_name'];
    }
}
else
{
    message_die(GENERAL_ERROR, 'Could not obtain user/online forums information', '', __LINE__, __FILE__, $sql);
}

//
// Get auth data
//
$is_auth_ary = array();
$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata);

//
// Get user list
//
/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/
$sql = "SELECT u.user_id, u.username, u.user_allow_viewonline, u.user_level, s.session_url_qs, s.session_url_ps, s.session_url_specific, s.session_logged_in, s.session_time, s.session_page, s.session_ip

        FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s

        WHERE u.user_id = s.session_user_id

                AND s.session_time >= ".( time() - $board_config['online_time'] ) . "

        ORDER BY u.username ASC, s.session_ip ASC";
/*****[END]********************************************
 [ Mod:    Online Time                         v1.0.0 ]
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

if ( !($result = $db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not obtain regd user/online information', '', __LINE__, __FILE__, $sql);
}

$guest_users = 0;
$registered_users = 0;
$hidden_users = 0;
$reg_counter = 0;
$guest_counter = 0;
$prev_user = 0;
$prev_ip = '';

while ( $row = $db->sql_fetchrow($result) )
{
    $view_online = false;
    if ( $row['session_logged_in'] )
    {
        $user_id = $row['user_id'];
        if ( $user_id != $prev_user )
        {
            $username = $row['username'];
            $style_color = '';
            if ( $row['user_level'] == ADMIN )
            {
                $username = '<b style="color:#' . $theme['fontcolor3'] . '">' . $username . '</strong>';
            }
            else if ( $row['user_level'] == MOD )
            {
                $username = '<b style="color:#' . $theme['fontcolor2'] . '">' . $username . '</strong>';
            }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $username = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

            if ( !$row['user_allow_viewonline'] )
            {
/*****[BEGIN]******************************************
 [ Mod:    Hidden Status Viewing               v1.0.0 ]
 ******************************************************/
                $view_online = ( $userdata['user_level'] == ADMIN || $userdata['user_id'] == $user_id ) ? true : false;
/*****[END]********************************************
 [ Mod:    Hidden Status Viewing               v1.0.0 ]
 ******************************************************/
                $hidden_users++;
                $username = '<i>' . $username . '</i>';
            }
            else
            {
                $view_online = true;
                $registered_users++;
            }

            $which_counter = 'reg_counter';
            $which_row = 'reg_user_row';
            $prev_user = $user_id;
        }
    }
    else
    {
        if ( $row['session_ip'] != $prev_ip )
        {
            $username = $lang['Guest'];
            $view_online = true;
            $guest_users++;
            $which_counter = 'guest_counter';
            $which_row = 'guest_user_row';
        }
    }

    $prev_ip = $row['session_ip'];
    if ( $view_online )
    {
        if ( $row['session_page'] < 1 || !$is_auth_ary[$row['session_page']]['auth_view'] )
        {
            switch( $row['session_page'] )
            {
                case PAGE_INDEX:
                    $location = $lang['Forum_index'];
                    $location_url = "modules.php?name=Forums&amp;file=index";
                    break;

                case PAGE_POSTING:
                    $location = $lang['Posting_message'];
                    $location_url = "modules.php?name=Forums&amp;file=index";
                    break;

                case PAGE_LOGIN:
                    $location = $lang['Logging_on'];
                    $location_url = "modules.php?name=Forums&amp;file=index";
                    break;

                case PAGE_SEARCH:
                    $location = $lang['Searching_forums'];
                    $location_url = "modules.php?name=Forums&amp;file=search";
                    break;

                case PAGE_PROFILE:
                    $location = $lang['Viewing_profile'];
                    $location_url = "modules.php?name=Forums&amp;file=index";
                    break;

                case PAGE_VIEWONLINE:
                    $location = $lang['Viewing_online'];
                    $location_url = "modules.php?name=Forums&amp;file=viewonline";
                    break;

                case PAGE_VIEWMEMBERS:
                    $location = $lang['Viewing_member_list'];
                    $location_url = "modules.php?name=Memberlist";
                    break;

                case PAGE_PRIVMSGS:
                    $location = $lang['Viewing_priv_msgs'];
                    $location_url = "modules.php?name=Private_Messages";
                    break;

                case PAGE_FAQ:
                    $location = $lang['Viewing_FAQ'];
                    $location_url = "modules.php?name=Forums&file=faq";
                    break;                                
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                case PAGE_REPUTATION:
                    $location = $lang['Reputation'];
                    $location_url = "reputation.$phpEx";
                    break;
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
                case PAGE_GAME: 
                    $location = $lang['Playing_game']; 
                    $location_url = "arcade.$phpEx"; 
                    break; 

                case PAGE_ARCADES: 
                    $location = $lang['Viewing_arcades']; 
                    $location_url = "arcade.$phpEx"; 
                    break; 

                case PAGE_TOPARCADES: 
                    $location = $lang['Viewing_toparcades']; 
                    $location_url = "toparcade.$phpEx"; 
                    break; 

                case PAGE_STATARCADES: 
                    $location = $lang['watchingstats']; 
                    $location_url = "statarcade.$phpEx"; 
                    break; 

                case PAGE_SCOREBOARD: 
                    $location = $lang['watchingboard']; 
                    $location_url = "arcade.$phpEx"; 
                    break;
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/
                case PAGE_STAFF:
                    $location = $lang['Staff'];
                    $location_url = "modules.php?name=Forums&file=staff";
                    break;
/*****[END]********************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
                case PAGE_RECENT:
                    $location = $lang['Recent_topics'];
                    $location_url = "modules.php?name=Forums&file=recent";
                    break;
/*****[END]********************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/

/*****[START]******************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/
                case PAGE_TOPIC_VIEW: 
                    $location = $lang['Topic_view_count']; 
                    $location_url = "viewtopic_whoview.$phpEx"; 
                    break;
/*****[END]********************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/

                default:
                    $location = $lang['Forum_index'];
                    $location_url = "modules.php?name=Forums&file=index";
            }
        }
        else
        {
            $location_url = "modules.php?name=Forums&file=viewforum&amp;" . POST_FORUM_URL . "=" . $row['session_page'];
            $location = $forum_data[$row['session_page']];

        }

/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
        // $BSH = select_session_url($row['session_page'], $row['session_url_qs'], $row['session_url_ps'], $row['session_url_specific'], $userdata['user_level'], $row['user_id'], $forums_data, $topics_data, $users_data, $cats_data);
        // $location = $BSH;
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

        $row_color = ( $$which_counter % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( $$which_counter % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

        $template->assign_block_vars("$which_row", array(
            'ROW_COLOR' => '#' . $row_color,
            'ROW_CLASS' => $row_class,
            'USERNAME' => $username,
            'LASTUPDATE' => create_date($board_config['default_dateformat'], $row['session_time'], $board_config['board_timezone']),
            'FORUM_LOCATION' => $location,
            'U_USER_PROFILE' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $user_id),
            'U_FORUM_LOCATION' => append_sid($location_url))
        );
        $$which_counter++;
    }
}

if( $registered_users == 0 )
    $l_r_user_s = $lang['Reg_users_zero_online'];
else if( $registered_users == 1 )
    $l_r_user_s = $lang['Reg_user_online'];
else
    $l_r_user_s = $lang['Reg_users_online'];

if( $hidden_users == 0 )
    $l_h_user_s = $lang['Hidden_users_zero_online'];
else if( $hidden_users == 1 )
    $l_h_user_s = $lang['Hidden_user_online'];
else
    $l_h_user_s = $lang['Hidden_users_online'];

if( $guest_users == 0 )
    $l_g_user_s = $lang['Guest_users_zero_online'];
else if( $guest_users == 1 )
    $l_g_user_s = $lang['Guest_user_online'];
else
    $l_g_user_s = $lang['Guest_users_online'];

$template->assign_vars(array(
    'TOTAL_REGISTERED_USERS_ONLINE' => sprintf($l_r_user_s, $registered_users) . sprintf($l_h_user_s, $hidden_users),
    'TOTAL_GUEST_USERS_ONLINE' => sprintf($l_g_user_s, $guest_users))
);

if ( $registered_users + $hidden_users == 0 )
{
    $template->assign_vars(array(
        'L_NO_REGISTERED_USERS_BROWSING' => $lang['No_users_browsing'])
    );
}

if ( $guest_users == 0 )
{
    $template->assign_vars(array(
        'L_NO_GUESTS_BROWSING' => $lang['No_users_browsing'])
    );
}

$template->pparse('body');
include("includes/page_tail.php");

?>