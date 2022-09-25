<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              page_header.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: page_header.php,v 1.106.2.4 2002/07/19 16:14:16 psotfx Exp
 *
 *
 ***************************************************************************/

/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

define('HEADER_INC', TRUE);

//
// gzip_compression
//
$do_gzip_compress = FALSE;

//
// Parse and show the overall header.
//

$phpbb2_template->set_filenames(array(
    'overall_header' => ( empty($gen_simple_header) ) ? 'overall_header.tpl' : 'simple_header.tpl')
);

//
// Generate logged in/logged out status
//
if ( $userdata['session_logged_in'] )
{
        $u_login_logout = 'modules.php?name=Your_Account&op=logout&redirect=Forums';
        $l_login_logout = $titanium_lang['Logout'] . ' [ ' . $userdata['username'] . ' ]';
}
else
{
        $u_login_logout = 'modules.php?name=Your_Account&redirect=index';
        $l_login_logout = $titanium_lang['Login'];
}

$s_last_visit = ( $userdata['session_logged_in'] ) ? create_date($phpbb2_board_config['default_dateformat'], $userdata['user_lastvisit'], $phpbb2_board_config['board_timezone']) : '';

//
// Get basic (usernames + totals) online
// situation
//
$titanium_user_forum_sql = ( !empty($phpbb2_forum_id) ) ? "AND s.session_page = " . intval($phpbb2_forum_id) : '';
$sql = "SELECT u.username, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
    FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
    WHERE u.user_id = s.session_user_id
        AND s.session_time >= ".( time() - 300 ) . "
        $titanium_user_forum_sql
    ORDER BY u.username ASC, s.session_ip ASC";
if( !($result = $titanium_db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
}

$titanium_userlist_ary = array();
$titanium_userlist_visible = array();

$logged_visible_online = 0;
$logged_hidden_online = 0;
$guests_online = 0;
$online_userlist = '';

$prev_user_id = 0;
$prev_user_ip = '';

while( $row = $titanium_db->sql_fetchrow($result) )
{
    // User is logged in and therefor not a guest
    if ( $row['session_logged_in'] )
    {
        // Skip multiple sessions for one user
        if ( $row['user_id'] != $prev_user_id )
        {
            $style_color = '';
            if ( $row['user_level'] == ADMIN )
            {
                $row['username'] = '<strong>' . $row['username'] . '</strong>';
                $style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
            }
            else if ( $row['user_level'] == MOD )
            {
                $row['username'] = '<strong>' . $row['username'] . '</strong>';
                $style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
            }

            if ( $row['user_allow_viewonline'] )
            {
                $titanium_user_online_link = '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'>' . $row['username'] . '</a>';
                $logged_visible_online++;
            }
            else
            {
                $titanium_user_online_link = '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'><i>' . $row['username'] . '</i></a>';
                $logged_hidden_online++;
            }

            if ( $row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
            {
                $online_userlist .= ( $online_userlist != '' ) ? ', ' . $titanium_user_online_link : $titanium_user_online_link;
            }
        }

        $prev_user_id = $row['user_id'];
    }
    else
    {
        // Skip multiple sessions for one user
        if ( $row['session_ip'] != $prev_session_ip )
        {
            $guests_online++;
        }
    }

    $prev_session_ip = $row['session_ip'];
}

if ( empty($online_userlist) )
{
    $online_userlist = $titanium_lang['None'];
}
$online_userlist = ( ( isset($phpbb2_forum_id) ) ? $titanium_lang['Browsing_forum'] : $titanium_lang['Registered_users'] ) . ' ' . $online_userlist;

$total_phpbb2_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;

if ( $total_phpbb2_online_users > $phpbb2_board_config['record_online_users'])
{
    $phpbb2_board_config['record_online_users'] = $total_phpbb2_online_users;
    $phpbb2_board_config['record_online_date'] = time();

    $sql = "UPDATE " . CONFIG_TABLE . "
        SET config_value = '$total_phpbb2_online_users'
        WHERE config_name = 'record_online_users'";
    if ( !$titanium_db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);
    }

    $sql = "UPDATE " . CONFIG_TABLE . "
        SET config_value = '" . $phpbb2_board_config['record_online_date'] . "'
        WHERE config_name = 'record_online_date'";
    if ( !$titanium_db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
    }
/*****['BEGIN']******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    global $cache;
    $cache->delete('board_config', 'config');
/*****['END']********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
}

if ( $total_phpbb2_online_users == 0 )
{
    $l_t_user_s = $titanium_lang['Online_users_zero_total'];
}
else if ( $total_phpbb2_online_users == 1 )
{
    $l_t_user_s = $titanium_lang['Online_user_total'];
}
else
{
    $l_t_user_s = $titanium_lang['Online_users_total'];
}

if ( $logged_visible_online == 0 )
{
    $l_r_user_s = $titanium_lang['Reg_users_zero_total'];
}
else if ( $logged_visible_online == 1 )
{
    $l_r_user_s = $titanium_lang['Reg_user_total'];
}
else
{
    $l_r_user_s = $titanium_lang['Reg_users_total'];
}

if ( $logged_hidden_online == 0 )
{
    $l_h_user_s = $titanium_lang['Hidden_users_zero_total'];
}
else if ( $logged_hidden_online == 1 )
{
    $l_h_user_s = $titanium_lang['Hidden_user_total'];
}
else
{
    $l_h_user_s = $titanium_lang['Hidden_users_total'];
}

if ( $guests_online == 0 )
{
    $l_g_user_s = $titanium_lang['Guest_users_zero_total'];
}
else if ( $guests_online == 1 )
{
    $l_g_user_s = $titanium_lang['Guest_user_total'];
}
else
{
    $l_g_user_s = $titanium_lang['Guest_users_total'];
}

$l_online_users = sprintf($l_t_user_s, $total_phpbb2_online_users);
$l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
$l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
$l_online_users .= sprintf($l_g_user_s, $guests_online);

//
// Obtain number of new private messages
// if user is logged in
//
if ( $userdata['session_logged_in'] )
{
    if ( $userdata['user_new_privmsg'] )
    {
        $l_message_new = ( $userdata['user_new_privmsg'] == 1 ) ? $titanium_lang['New_pm'] : $titanium_lang['New_pms'];
        $l_privmsgs_text = sprintf($l_message_new, $userdata['user_new_privmsg']);

        if ( $userdata['user_last_privmsg'] > $userdata['user_lastvisit'] )
        {
            $sql = "UPDATE " . USERS_TABLE . "
                SET user_last_privmsg = " . $userdata['user_lastvisit'] . "
                WHERE user_id = " . $userdata['user_id'];
            if ( !$titanium_db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Could not update private message new/read time for user', '', __LINE__, __FILE__, $sql);
            }

            $s_privmsg_new = 1;
            $phpbb2_icon_pm = $images['pm_new_msg'];
        }
        else
        {
            $s_privmsg_new = 0;
            $phpbb2_icon_pm = $images['pm_no_new_msg'];
        }
    }
    else
    {
        $l_privmsgs_text = $titanium_lang['No_new_pm'];

        $s_privmsg_new = 0;
        $phpbb2_icon_pm = $images['pm_no_new_msg'];
    }

    if ( $userdata['user_unread_privmsg'] )
    {
        $l_message_unread = ( $userdata['user_unread_privmsg'] == 1 ) ? $titanium_lang['Unread_pm'] : $titanium_lang['Unread_pms'];
        $l_privmsgs_text_unread = sprintf($l_message_unread, $userdata['user_unread_privmsg']);
    }
    else
    {
        $l_privmsgs_text_unread = $titanium_lang['No_unread_pm'];
    }
}
else
{
    $phpbb2_icon_pm = $images['pm_no_new_msg'];
    $l_privmsgs_text = $titanium_lang['Login_check_pm'];
    $l_privmsgs_text_unread = '';
    $s_privmsg_new = 0;
}

//
// Generate HTML required for Mozilla Navigation bar
//
$titanium_nav_links_html = '';
$nav_link_proto = '<link rel="%s" href="%s" title="%s" />' . "\n";
while( list($nav_item, $nav_array) = @each($titanium_nav_links) )
{
    if ( !empty($nav_array['url']) )
    {
        $titanium_nav_links_html .= sprintf($nav_link_proto, $nav_item, $nav_array['url'], $nav_array['title']);
    }
    else
    {
        // We have a nested array, used for items like <link rel='chapter'> that can occur more than once.
        while( list(,$nested_array) = each($nav_array) )
        {
            $titanium_nav_links_html .= sprintf($nav_link_proto, $nav_item, $nested_array['url'], $nested_array['title']);
        }
    }
}

//
// The following assigns all _common_ variables that may be used at any point
// in a template.
//
$phpbb2_template->assign_vars(array(
    'SITENAME' => $phpbb2_board_config['sitename'],
    'SITE_DESCRIPTION' => $phpbb2_board_config['site_desc'],
    'PAGE_TITLE' => $phpbb2_page_title,
    'LAST_VISIT_DATE' => sprintf($titanium_lang['You_last_visit'], $s_last_visit),
    'CURRENT_TIME' => sprintf($titanium_lang['Current_time'], create_date($phpbb2_board_config['default_dateformat'], time(), $phpbb2_board_config['board_timezone'])),
    'TOTAL_USERS_ONLINE' => $l_online_users,
    'LOGGED_IN_USER_LIST' => $online_userlist,
    'RECORD_USERS' => sprintf($titanium_lang['Record_online_users'], $phpbb2_board_config['record_online_users'], create_date($phpbb2_board_config['default_dateformat'], $phpbb2_board_config['record_online_date'], $phpbb2_board_config['board_timezone'])),
    'PRIVATE_MESSAGE_INFO' => $l_privmsgs_text,
    'PRIVATE_MESSAGE_INFO_UNREAD' => $l_privmsgs_text_unread,
    'PRIVATE_MESSAGE_NEW_FLAG' => $s_privmsg_new,

    'PRIVMSG_IMG' => $phpbb2_icon_pm,

    'L_USERNAME' => $titanium_lang['Username'],
    'L_PASSWORD' => $titanium_lang['Password'],
    'L_LOGIN_LOGOUT' => $l_login_logout,
    'L_LOGIN' => $titanium_lang['Login'],
    'L_LOG_ME_IN' => $titanium_lang['Log_me_in'],
    'L_AUTO_LOGIN' => $titanium_lang['Log_me_in'],
    
	'L_INDEX' => sprintf($titanium_lang['Forum_Index'], $phpbb2_board_config['sitename']),
    'L_INDEXHOME' => $titanium_lang['Home_Index'],'index.php',
    
	'L_REGISTER' => $titanium_lang['Register'],
    'L_PROFILE' => $titanium_lang['Profile'],
    'L_SEARCH' => $titanium_lang['Search'],
    'L_PRIVATEMSGS' => $titanium_lang['Private_Messages'],
    'L_WHO_IS_ONLINE' => $titanium_lang['Who_is_Online'],
    'L_MEMBERLIST' => $titanium_lang['Memberlist'],
    'L_FAQ' => $titanium_lang['FAQ'],
    'L_USERGROUPS' => $titanium_lang['Usergroups'],
    'L_SEARCH_NEW' => $titanium_lang['Search_new'],
    'L_SEARCH_UNANSWERED' => $titanium_lang['Search_unanswered'],
    'L_SEARCH_SELF' => $titanium_lang['Search_your_posts'],
    'L_WHOSONLINE_ADMIN' => sprintf($titanium_lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
    'L_WHOSONLINE_MOD' => sprintf($titanium_lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'),

    'U_SEARCH_UNANSWERED' => append_titanium_sid('search.'.$phpEx.'?search_id=unanswered'),
    'U_SEARCH_SELF' => append_titanium_sid('search.'.$phpEx.'?search_id=egosearch'),
    'U_SEARCH_NEW' => append_titanium_sid('search.'.$phpEx.'?search_id=newposts'),
	'U_INDEX' => append_titanium_sid('index.'.$phpEx),
    
	# Home Index Mod START
	'U_HINDEX' => titanium_home_sid('index.'.$phpEx),
    # Home Index Mod END
    
	'U_REGISTER' => append_titanium_sid('profile.'.$phpEx.'?mode=register'),
    'U_PROFILE' => append_titanium_sid('modules.php?name=Your_Account&op=edituser'),
    'U_PRIVATEMSGS' => append_titanium_sid('privmsg.'.$phpEx.'?folder=inbox'),
    'U_PRIVATEMSGS_POPUP' => append_titanium_sid('privmsg.'.$phpEx.'?mode=newpm&popup=1'),
    'U_SEARCH' => append_titanium_sid('search.'.$phpEx),
    'U_MEMBERLIST' => append_titanium_sid('memberlist.'.$phpEx),
    'U_MODCP' => append_titanium_sid('modcp.'.$phpEx),
    'U_FAQ' => append_titanium_sid('faq.'.$phpEx),
    'U_VIEWONLINE' => append_titanium_sid('viewonline.'.$phpEx),
    'U_LOGIN_LOGOUT' => append_titanium_sid($u_login_logout),
    'U_MEMBERSLIST' => append_titanium_sid('memberlist.'.$phpEx),
    'U_GROUP_CP' => append_titanium_sid('groupcp.'.$phpEx),

    'S_CONTENT_DIRECTION' => $titanium_lang['DIRECTION'],
    'S_CONTENT_ENCODING' => $titanium_lang['ENCODING'],
    'S_CONTENT_DIR_LEFT' => $titanium_lang['LEFT'],
    'S_CONTENT_DIR_RIGHT' => $titanium_lang['RIGHT'],
    'S_TIMEZONE' => sprintf($titanium_lang['All_times'], $titanium_lang[number_format($phpbb2_board_config['board_timezone'])]),
    'S_LOGIN_ACTION' => append_titanium_sid('login.'.$phpEx),

    'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],

    'T_BODY_BACKGROUND' => $theme['body_background'],
    'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
    'T_BODY_TEXT' => '#'.$theme['body_text'],
    'T_BODY_LINK' => '#'.$theme['body_link'],
    'T_BODY_VLINK' => '#'.$theme['body_vlink'],
    'T_BODY_ALINK' => '#'.$theme['body_alink'],
    'T_BODY_HLINK' => '#'.$theme['body_hlink'],

    'T_TR_COLOR1' => '#'.$theme['tr_color1'],
    'T_TR_COLOR2' => '#'.$theme['tr_color2'],
    'T_TR_COLOR3' => '#'.$theme['tr_color3'],
    'T_TR_CLASS1' => $theme['tr_class1'],
    'T_TR_CLASS2' => $theme['tr_class2'],
    'T_TR_CLASS3' => $theme['tr_class3'],
    'T_TH_COLOR1' => '#'.$theme['th_color1'],
    'T_TH_COLOR2' => '#'.$theme['th_color2'],
    'T_TH_COLOR3' => '#'.$theme['th_color3'],
    'T_TH_CLASS1' => $theme['th_class1'],
    'T_TH_CLASS2' => $theme['th_class2'],
    'T_TH_CLASS3' => $theme['th_class3'],
    'T_TD_COLOR1' => '#'.$theme['td_color1'],
    'T_TD_COLOR2' => '#'.$theme['td_color2'],
    'T_TD_COLOR3' => '#'.$theme['td_color3'],
    'T_TD_CLASS1' => $theme['td_class1'],
    'T_TD_CLASS2' => $theme['td_class2'],
    'T_TD_CLASS3' => $theme['td_class3'],
    'T_FONTFACE1' => $theme['fontface1'],
    'T_FONTFACE2' => $theme['fontface2'],
    'T_FONTFACE3' => $theme['fontface3'],
    'T_FONTSIZE1' => $theme['fontsize1'],
    'T_FONTSIZE2' => $theme['fontsize2'],
    'T_FONTSIZE3' => $theme['fontsize3'],
    'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
    'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
    'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
    'T_SPAN_CLASS1' => $theme['span_class1'],
    'T_SPAN_CLASS2' => $theme['span_class2'],
    'T_SPAN_CLASS3' => $theme['span_class3'],

    'NAV_LINKS' => $titanium_nav_links_html)
);

//
// Login box?
//
if ( !$userdata['session_logged_in'] )
{
    $phpbb2_template->assign_block_vars('switch_user_logged_out', array());
}
else
{
    $phpbb2_template->assign_block_vars('switch_user_logged_in', array());

    if ( !empty($userdata['user_popup_pm']) )
    {
        $phpbb2_template->assign_block_vars('switch_enable_pm_popup', array());
    }
}

$phpbb2_template->pparse('overall_header');

?>