<?php # JOHN 3:16 #
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                               viewforum.php
 *                            -------------------
 *   update               : Fiday, May 21, 2021
 *   copyright            : (C) The 86it Developers Network
 *   email                : support@86it.us
 *
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: viewforum.php,v 1.139.2.12 2004/03/13 15:08:23 acydburn Exp
 *
 ***************************************************************************/

/***************************************************************************
* phpbb2 forums port version 2.0.5 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Nuke Cops to phpbb2 standalone 2.0.5 Test
* and debugging completed by the Elite Nukers and site members.
*
* You run this package at your sole risk. Nuke Cops and affiliates cannot
* be held liable if anything goes wrong. You are advised to test this
* package on a development system. Backup everything before implementing
* in a production environment. If something goes wrong, you can always
* backout and restore your backups.
*
* Installing and running this also means you agree to the terms of the AUP
* found at Nuke Cops.
*
* This is version 2.0.5 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.0.5 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.5 that fixes some bugs and the
* invalid_session error message.
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

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Advanced Username Color                  v1.0.5       06/11/2005
      At a Glance                              v2.2.1       06/12/2005
      Global Announcements                     v1.2.8       06/13/2005
      Smilies in Topic Titles                  v1.0.0       06/14/2005
      Topic Cement                             v1.0.3       06/15/2005
      Topic display order                      v1.0.2       06/15/2005
      Separate Announcements & Sticky          v2.0.0a      06/24/2005
      At a Glance Options                      v1.0.0       08/17/2005
      Customized Topic Status                  v1.0.0       08/25/2005
      Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
	  Forum Icons                              v1.0.4
	  Post Icons                               v1.0.1
 ************************************************************************/

if (!defined('MODULE_FILE')) 
exit("You can't access this file directly...");

if(!isset($popup)):
 $module_name = basename(dirname(__FILE__));
 require("modules/".$module_name."/nukebb.php");
else:
 $phpbb_root_path = NUKE_FORUMS_DIR;
endif;

define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

# Mod: Post Icons v1.0.1 START
include('includes/posting_icons.'. $phpEx);
# Mod: Post Icons v1.0.1 END

# Mod: Separate Announcements & Sticky v2.0.0a START
include('includes/functions_separate.'.$phpEx);
# Mod: Separate Announcements & Sticky v2.0.0a END

# Mod: Smilies in Topic Titles v1.0.0 START
include('includes/bbcode.' .$phpEx);
# Mod: Smilies in Topic Titles v1.0.0 END

# Start initial var setup
if(isset($HTTP_GET_VARS[POST_FORUM_URL]) || isset($HTTP_POST_VARS[POST_FORUM_URL]))
$forum_id = intval(isset($HTTP_GET_VARS[POST_FORUM_URL]) ? $HTTP_GET_VARS[POST_FORUM_URL] : $HTTP_POST_VARS[POST_FORUM_URL]);
else
$forum_id = '';

$start = (isset($HTTP_GET_VARS['start']) ? intval($HTTP_GET_VARS['start']) : 0);
$start = ($start < 0) ? 0 : $start;

if(isset($HTTP_GET_VARS['mark']) || isset($HTTP_POST_VARS['mark']))
$mark_read = (isset($HTTP_POST_VARS['mark'])) ? $HTTP_POST_VARS['mark'] : $HTTP_GET_VARS['mark'];
else
$mark_read = '';
# End initial var setup

if(!isset($parent_forum))
$parent_forum = '';
else
$parent_forum = 1;

if(!isset($has_subforums))
$has_subforums  = '';
else
$has_subforums = 0;

if(!isset($recent_item['ICON_ID']))
$recent_item['ICON_ID'] = 0;
	
# Check if the user has actually sent a forum ID with his/her request
# If not give them a nice error page.
if(!empty($forum_id)):
        $sql = "SELECT *
                FROM ".FORUMS_TABLE."
                WHERE forum_id = '$forum_id'";
        if(!($result = $db->sql_query($sql))):
          message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
        endif;
else:
  message_die(GENERAL_MESSAGE, 'Forum_not_exist');
endif;

# If the query doesn't return any rows this isn't a valid forum. Inform
# the user.
if(!($forum_row = $db->sql_fetchrow($result)))
message_die(GENERAL_MESSAGE, 'Forum_not_exist');

# Start session management
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
# End session management

# Start auth check
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

if(!$is_auth['auth_read'] || !$is_auth['auth_view']):
        if (!$userdata['session_logged_in']):
                $redirect = POST_FORUM_URL . "=$forum_id" . ( ( isset($start) ) ? "&start=$start" : '' );
                redirect(append_sid("login.$phpEx?redirect=viewforum.$phpEx&$redirect", true));
        endif;
        # The user is not authed to read this forum ...
        $message = ( !$is_auth['auth_view'] ) ? $lang['Forum_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
        message_die(GENERAL_MESSAGE, $message);
endif;
# End of auth check

# Password check
if(!$is_auth['auth_mod'] && $userdata['user_level'] != ADMIN):
	$redirect = str_replace("&amp;", "&", preg_replace('#.*?([a-z]+?\.' . $phpEx . '.*?)$#i', '\1', htmlspecialchars($HTTP_SERVER_VARS['REQUEST_URI'])));
	if(isset($HTTP_POST_VARS['cancel'])):
		redirect(append_sid("index.$phpEx"));
	elseif(isset($HTTP_POST_VARS['pass_login'])):
		if($forum_row['forum_password'] != '')
		password_check('forum', $forum_id, $HTTP_POST_VARS['password'], $redirect);
	endif;
	$passdata = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_fpass'])) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_fpass'])) : '';
	if($forum_row['forum_password'] != '' && ($passdata[$forum_id] != md5($forum_row['forum_password'])))
	password_box('forum', $redirect);
endif;
# END: Password check

# Handle marking posts
if($mark_read == 'topics'):

    # Mod: Simple Subforums v1.0.1 START
	$mark_list = ( isset($HTTP_GET_VARS['mark_list']) ) ? explode(',', $HTTP_GET_VARS['mark_list']) : array($forum_id);
	$old_forum_id = $forum_id;
    # Mod: Simple Subforums v1.0.1 END

        if($userdata['session_logged_in']):
                $sql = "SELECT p.post_time AS last_post
                        FROM (" . POSTS_TABLE . " p, " . TOPICS_TABLE . " t)
                        WHERE t.forum_id = $forum_id
                        AND t.topic_last_post_id = p.post_id
                        ORDER BY t.topic_last_post_id DESC LIMIT 1";
                if( !($result = $db->sql_query($sql)))
                message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);

                if($row = $db->sql_fetchrow($result)):
                        $tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();
                        $tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();

                        if((count($tracking_forums) + count($tracking_topics)) >= 150 && empty($tracking_forums[$forum_id])):
                          asort($tracking_forums);
                          unset($tracking_forums[key($tracking_forums)]);
                        endif;

                        if($row['last_post'] > $userdata['user_lastvisit']):
                          $tracking_forums[$forum_id] = time();
				          # Mod: Simple Subforums v1.0.1 START
				          //setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 0, $board_config['cookie_path'], 
					      //$board_config['cookie_domain'], $board_config['cookie_secure']);
				          $set_cookie = true;
					      if( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) )
					      $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f'] = serialize($tracking_forums);
				          # Mod: Simple Subforums v1.0.1 END
                       endif;
                endif;

                # Mod: Simple Subforums v1.0.1 START
		        if($set_cookie)
		        setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);

		        $forum_id = $old_forum_id;
                # Mod: Simple Subforums v1.0.1 END

                $template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url='.append_sid("viewforum.$phpEx?".POST_FORUM_URL."=$forum_id").'">')
                );
        endif;

        $message = $lang['Topics_marked_read'].'<br /><br />'.sprintf($lang['Click_return_forum'],'<a href="'.append_sid("viewforum.$phpEx?".POST_FORUM_URL."=$forum_id").'">','</a>');
        message_die(GENERAL_MESSAGE, $message);
endif;
# End handle marking posts

$tracking_topics = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_t'])) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_t']) : '';
$tracking_forums = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_f']) : '';

# Do the forum Prune
if($is_auth['auth_mod'] && $board_config['prune_enable']):
  if($forum_row['prune_next'] < time() && $forum_row['prune_enable']):
     include("includes/prune.php");
     require("includes/functions_admin.php");
     auto_prune($forum_id);
  endif;
endif;
# End of forum prune

# Obtain list of moderators of each forum
# First users, then groups ... broken into two queries
$sql = "SELECT u.user_id, u.username
        FROM (" . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u)
        WHERE aa.forum_id = '$forum_id'
                AND aa.auth_mod = " . TRUE . "
                AND g.group_single_user = '1'
                AND ug.group_id = aa.group_id
                AND g.group_id = aa.group_id
                AND u.user_id = ug.user_id
        GROUP BY u.user_id, u.username
        ORDER BY u.user_id";

if(!($result = $db->sql_query($sql)))
{
  message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
}

$moderators = array();

while($row = $db->sql_fetchrow($result)):
    # Mod: Advanced Username Color v1.0.5 START
    $moderators[] = '<a href="'.append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=".$row['user_id']).'">'.UsernameColor($row['username']).'</a>';
    # Mod: Advanced Username Color v1.0.5 START
endwhile;

$sql = "SELECT g.group_id, g.group_name
        FROM (".AUTH_ACCESS_TABLE." aa, ".USER_GROUP_TABLE." ug, ".GROUPS_TABLE." g)
        WHERE aa.forum_id = '$forum_id'
                AND aa.auth_mod = ".TRUE."
                AND g.group_single_user = '0'
                AND g.group_type <> ".GROUP_HIDDEN."
                AND ug.group_id = aa.group_id
                AND g.group_id = aa.group_id
        GROUP BY g.group_id, g.group_name
        ORDER BY g.group_id";

if(!($result = $db->sql_query($sql)))
message_die(GENERAL_ERROR,'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);

while($row = $db->sql_fetchrow($result)):
  $moderators[] = '<a href="'.append_sid("groupcp.$phpEx?".POST_GROUPS_URL."=".$row['group_id']).'">'.GroupColor($row['group_name']).'</a>';
endwhile;

$l_moderators = (count($moderators) == 1) ? $lang['Moderator'] : $lang['Moderators'];
$forum_moderators = (count($moderators)) ? implode(', ', $moderators) : $lang['None'];
unset($moderators);

# Generate a 'Show topics in previous x days' select box. If the topicsdays var is sent
# then get it's value, find the number of topics with dates newer than it (to properly
# handle pagination) and alter the main query
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Topics'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if(!empty($HTTP_POST_VARS['topicdays']) || !empty($HTTP_GET_VARS['topicdays'])):
        $topic_days = (!empty($HTTP_POST_VARS['topicdays'])) ? intval($HTTP_POST_VARS['topicdays']) : intval($HTTP_GET_VARS['topicdays']);
        $min_topic_time = time() - ($topic_days * 86400);
        $sql = "SELECT COUNT(t.topic_id) AS forum_topics
                FROM (".TOPICS_TABLE." t, ".POSTS_TABLE." p)
                WHERE t.forum_id = '$forum_id'
                        AND p.post_id = t.topic_last_post_id
                        AND p.post_time >= '$min_topic_time'";
        if (!($result = $db->sql_query($sql))):
        message_die(GENERAL_ERROR,'Could not obtain limited topics count information','', __LINE__, __FILE__,$sql);
        endif;
        
		$row = $db->sql_fetchrow($result);

        $topics_count = ($row['forum_topics']) ? $row['forum_topics'] : 1;
        $limit_topics_time = "AND p.post_time >= $min_topic_time";

        if(!empty($HTTP_POST_VARS['topicdays'])):
        $start = 0;
		endif;
else:
  $topics_count = ($forum_row['forum_topics']) ? $forum_row['forum_topics'] : 1;
  $limit_topics_time = '';
  $topic_days = 0;
endif;

$select_topic_days = '<select name="topicdays">';

for($i = 0; $i < count($previous_days); $i++):
  $selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
  $select_topic_days .= '<option value="'.$previous_days[$i].'"'.$selected.'>'.$previous_days_text[$i].'</option>';
endfor;

$select_topic_days .= '</select>';

# Mod: Global Announcements v1.2.8 START
# All GLOBAL announcement data, this keeps GLOBAL announcements
# on each viewforum page ...

 # Mod: Topic Cement v1.0.3 START
 $sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
   FROM (".TOPICS_TABLE." t, ".USERS_TABLE." u, ".POSTS_TABLE." p, ".USERS_TABLE." u2)
   WHERE t.topic_poster = u.user_id
      AND p.post_id = t.topic_last_post_id
      AND p.poster_id = u2.user_id
      AND t.topic_type = ".POST_GLOBAL_ANNOUNCE."
   ORDER BY t.topic_priority DESC, t.topic_last_post_id DESC ";
 # Mod: Topic Cement v1.0.3 END

if(!$result = $db->sql_query($sql))
message_die(GENERAL_ERROR,"Couldn't obtain topic information","", __LINE__, __FILE__,$sql);
$topic_rowset = array();
$total_announcements = 0;
while($row = $db->sql_fetchrow($result)):
   $topic_rowset[] = $row;
   $total_announcements++;
endwhile;
$db->sql_freeresult($result);
# Mod: Global Announcements v1.2.8 END

# All announcement data, this keeps announcements
# on each viewforum page ...
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
        FROM (".TOPICS_TABLE." t, ".USERS_TABLE." u, ".POSTS_TABLE." p, ".USERS_TABLE." u2)
        WHERE t.forum_id = '$forum_id'
                AND t.topic_poster = u.user_id
                AND p.post_id = t.topic_last_post_id
                AND p.poster_id = u2.user_id
                AND t.topic_type = ".POST_ANNOUNCE."
        ORDER BY t.topic_last_post_id DESC ";

if ( !($result = $db->sql_query($sql)) )
message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ] HERE WE GO AGAIN WITH UNCOMMENTED CHANGES? WHY? WHO?
 ******************************************************/
//$topic_rowset = array();
//$total_announcements = 0;
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ] HERE WE GO AGAIN WITH UNCOMMENTED CHANGES? WHY? WHO?
 ******************************************************/

while($row = $db->sql_fetchrow($result)):
  $topic_rowset[] = $row;
  $total_announcements++;
endwhile;
$db->sql_freeresult($result);

# Grab all the basic data (all topics except announcements)
# for this forum

# Mod: Topic display order v1.0.2 START
$dft_sort = $forum_row['forum_display_sort'];
$dft_order = $forum_row['forum_display_order'];

# Sort def
$sort_value = $dft_sort;
if(isset($HTTP_GET_VARS['sort']) || isset($HTTP_POST_VARS['sort']))
$sort_value = isset($HTTP_GET_VARS['sort']) ? intval($HTTP_GET_VARS['sort']) : intval($HTTP_POST_VARS['sort']);
$sort_list = '<select name="sort">'.get_forum_display_sort_option($sort_value,'list','sort').'</select>';

# Order def
$order_value = $dft_order;
if(isset($HTTP_GET_VARS['order']) || isset($HTTP_POST_VARS['order']))
$order_value = isset($HTTP_GET_VARS['order']) ? intval($HTTP_GET_VARS['order']) : intval($HTTP_POST_VARS['order']);
$order_list = '<select name="order">'.get_forum_display_sort_option($order_value,'list','order').'</select>';

# display
$s_display_order = '&nbsp;'.$lang['Sort_by'].':&nbsp;'.$sort_list.$order_list.'&nbsp;';

# selected method
$sort_method = get_forum_display_sort_option($sort_value,'field','sort');
$order_method = get_forum_display_sort_option($order_value,'field','order');
# Mod: Topic display order v1.0.2 END


# Mod: Global Announcements v1.2.8 START
# Mod: Topic Cement v1.0.3 START
# Mod: Topic display order v1.0.2 START
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time
        FROM (".TOPICS_TABLE." t, ".USERS_TABLE." u, ".POSTS_TABLE." p, ".POSTS_TABLE." p2, ".USERS_TABLE." u2)
        WHERE t.forum_id = '$forum_id'
                AND t.topic_poster = u.user_id
                AND p.post_id = t.topic_first_post_id
                AND p2.post_id = t.topic_last_post_id
                AND u2.user_id = p2.poster_id
                AND t.topic_type <> ".POST_ANNOUNCE."
                AND t.topic_type <> ".POST_GLOBAL_ANNOUNCE."
                $limit_topics_time
        ORDER BY t.topic_type DESC, t.topic_priority DESC, $sort_method $order_method, t.topic_last_post_id DESC
        LIMIT $start, ".$board_config['topics_per_page'];
# Mod: Global Announcements v1.2.8 END
# Mod: Topic Cement v1.0.3 END
# Mod: Topic display order v1.0.2 END

if(!($result = $db->sql_query($sql)))
message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);

$total_topics = 0;
while($row = $db->sql_fetchrow($result)):
    $topic_rowset[] = $row;
    $total_topics++;
endwhile;
$db->sql_freeresult($result);

# Total topics ...
$total_topics += $total_announcements;

# Mod: Separate Announcements & Sticky v2.0.0a START
$dividers = get_dividers($topic_rowset);
# Mod: Separate Announcements & Sticky v2.0.0a END

# Define censored word matches
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

# Post URL generation for templating vars
$template->assign_vars(array(
    'L_DISPLAY_TOPICS' => $lang['Display_topics'],
    'U_POST_NEW_TOPIC' => append_sid("posting.$phpEx?mode=newtopic&amp;".POST_FORUM_URL."=$forum_id"),
    'S_SELECT_TOPIC_DAYS' => $select_topic_days,
    'S_POST_DAYS_ACTION' => append_sid("viewforum.$phpEx?".POST_FORUM_URL."=".$forum_id."&amp;start=$start"))
);

# User authorisation levels output
$s_auth_can = (($is_auth['auth_post']) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot']).'<br />';
$s_auth_can .= (($is_auth['auth_reply']) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot']).'<br />';
$s_auth_can .= (($is_auth['auth_edit']) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot']).'<br />';
$s_auth_can .= (($is_auth['auth_delete']) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot']).'<br />';
$s_auth_can .= (($is_auth['auth_vote']) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ).'<br />';

# Mod: Attachment Mod v2.4.1 START
attach_build_auth_levels($is_auth, $s_auth_can);
# Mod: Attachment Mod v2.4.1 END

if($is_auth['auth_mod'])
$s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="'.append_sid("modcp.$phpEx?".POST_FORUM_URL."=$forum_id").'">', '</a>');

# Mozilla navigation bar
$nav_links['up'] = array(
        'url' => append_sid('index.'.$phpEx),
        'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
);

# Dump out the page header and load viewforum template
define('SHOW_ONLINE', true);
$page_title = $lang['View_forum'].' - '.$forum_row['forum_name'];
include("includes/page_header.$phpEx");
$template->set_filenames(array(
    'body' => 'viewforum_body.tpl')
);

# Mod: Simple Subforums v1.0.1 START
$all_forums = array();
make_jumpbox_ref('viewforum.'.$phpEx, $forum_id, $all_forums);
# Mod: Simple Subforums v1.0.1 END
$look_in_themes_dir_for_forum_icons = forum_icon_img_path($forum_row['forum_icon'], 'Forums');
$template->assign_vars(array(
        'HAS_SUBFORUMS' => $has_subforums,
        'PARENT_FORUM' => $parent_forum,
        'FORUM_ID' => $forum_id,
        'FORUM_NAME' => $forum_row['forum_name'],
        
		# Mod: Forum Icons v1.0.4 START
		'FORUM_ICON_IMG' => ($forum_row['forum_icon']) ? '<img width="32" height="32" src="'.$look_in_themes_dir_for_forum_icons.'" 
		alt="'.$forum_row['forum_name'].'" title="'.$forum_row['forum_name'].'" />&nbsp;' : '',
		# Mod: Forum Icons v1.0.4 END

        'MODERATORS' => $forum_moderators,
        'POST_IMG' => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'],
        'FOLDER_IMG' => $images['folder'],
        'FOLDER_NEW_IMG' => $images['folder_new'],
        'FOLDER_HOT_IMG' => $images['folder_hot'],
        'FOLDER_HOT_NEW_IMG' => $images['folder_hot_new'],
        'FOLDER_LOCKED_IMG' => $images['folder_locked'],
        'FOLDER_LOCKED_NEW_IMG' => $images['folder_locked_new'],
        'FOLDER_STICKY_IMG' => $images['folder_sticky'],
        'FOLDER_STICKY_NEW_IMG' => $images['folder_sticky_new'],
        'FOLDER_ANNOUNCE_IMG' => $images['folder_announce'],
        'FOLDER_ANNOUNCE_NEW_IMG' => $images['folder_announce_new'],

        # Mod: Global Announcements v1.2.8 START
        'FOLDER_GLOBAL_ANNOUNCE_IMG' => $images['folder_global_announce'],
        'FOLDER_GLOBAL_ANNOUNCE_NEW_IMG' => $images['folder_global_announce_new'],
        # Mod: Global Announcements v1.2.8 END

        'L_TOPICS' => $lang['Topics'],
        'L_REPLIES' => $lang['Replies'],
        'L_VIEWS' => $lang['Views'],
        'L_POSTS' => $lang['Posts'],
        'L_LASTPOST' => $lang['Last_Post'],
        'L_MODERATOR' => $l_moderators,
        'L_MARK_TOPICS_READ' => $lang['Mark_all_topics'],
        'L_POST_NEW_TOPIC' => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'],
        'L_NO_NEW_POSTS' => $lang['No_new_posts'],
        'L_NEW_POSTS' => $lang['New_posts'],
        'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'],
        'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'],
        'L_NO_NEW_POSTS_HOT' => $lang['No_new_posts_hot'],
        'L_NEW_POSTS_HOT' => $lang['New_posts_hot'],
        'L_ANNOUNCEMENT' => $lang['Post_Announcement'],

        # Mod: Global Announcements v1.2.8 START
        'L_GLOBAL_ANNOUNCEMENT' => $lang['Post_global_announcement'],
        # Mod: Global Announcements v1.2.8 END

        'L_STICKY' => $lang['Post_Sticky'],
        'L_POSTED' => $lang['Posted'],
        'L_JOINED' => $lang['Joined'],
        'L_AUTHOR' => $lang['Author'],
        'S_AUTH_LIST' => $s_auth_can,
        'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?".POST_FORUM_URL."=$forum_id"),
        'U_MARK_READ' => append_sid("viewforum.$phpEx?".POST_FORUM_URL."=$forum_id&amp;mark=topics"))
);

# Mod: Simple Subforums v1.0.1 START
if($forum_row['forum_parent']):
	$parent_id = $forum_row['forum_parent'];
	for($i = 0; $i < count($all_forums); $i++):
		if($all_forums[$i]['forum_id'] == $parent_id):
			$template->assign_vars(array(
				'PARENT_FORUM'			=> $parent_forum,
				'U_VIEW_PARENT_FORUM'	=> append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id']),
				'PARENT_FORUM_NAME'		=> $all_forums[$i]['forum_name'],
				));
		endif;
	endfor;
else:
	$sub_list = array();
	for( $i = 0; $i < count($all_forums); $i++ ):
		if( $all_forums[$i]['forum_parent'] == $forum_id )
		$sub_list[] = $all_forums[$i]['forum_id'];
	endfor;

	if(count($sub_list)):
		$sub_list[] = $forum_id;
		$template->vars['U_MARK_READ'] .= '&amp;mark_list=' . implode(',', $sub_list);
	endif;
endif;

# assign additional variables for subforums mod
$template->assign_vars(array(
	'NUM_TOPICS' => $forum_row['forum_topics'],
	'CAN_POST' => $is_auth['auth_post'] ? 1 : 0,
	'L_FORUM' => $lang['Forum'],
));
# Mod: Simple Subforums v1.0.1 END
# End header


# Okay, lets dump out the page ...
# Mod: Topic display order v1.0.2 START
$template->assign_vars(array(
    'S_DISPLAY_ORDER' => $s_display_order,
    )
);
# Mod: Topic display order v1.0.2 END

if($total_topics):
   for($i = 0; $i < $total_topics; $i++):
   
     $topic_id = $topic_rowset[$i]['topic_id'];
     $topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_title']) : $topic_rowset[$i]['topic_title'];
     
	 # Mod: Smilies in Topic Titles v1.0.0 START
     # Mod: Smilies in Topic Titles Toggle v1.0.0 START
     $topic_title = ($board_config['smilies_in_titles']) ? smilies_pass($topic_title) : $topic_title;
     # Mod: Smilies in Topic Titles v1.0.0 END
     # Mod: Smilies in Topic Titles Toggle v1.0.0 END

     $replies = $topic_rowset[$i]['topic_replies'];

     # Mod: Post Icons v1.0.1 START
	 $type = $topic_rowset[$i]['topic_type'];

	 if($type == POST_NORMAL):
		if(!empty($topic_rowset[$i]['topic_calendar_time']))
			$type = POST_CALENDAR;
		if(!empty($topic_rowset[$i]['topic_pic_url']))
		    $type = POST_PICTURE;
	endif;

	$icon = get_icon_title($topic_rowset[$i]['topic_icon'], 1, $type);
	$icon_ID = $topic_rowset[$i]['topic_icon'];
    # Mod: Post Icons v1.0.1 END

    $topic_type = $topic_rowset[$i]['topic_type'];
    $topic_type = '';

    if($topic_rowset[$i]['topic_vote'])
    $topic_type .= $lang['Topic_Poll'].' ';

    if($topic_rowset[$i]['topic_status'] == TOPIC_MOVED):
       $topic_id = $topic_rowset[$i]['topic_moved_id'];
	   
	   # Mod: Customized Topic Status v1.0.0 START
       $topic_title = "" . $board_config['moved_view_open'] . " " . $topic_title . "" . $board_config['moved_view_close'] . "";
	   # Mod: Customized Topic Status v1.0.0 END
       
	   $folder_image =  $images['folder'];
       $folder_alt = $lang['Topics_Moved'];
       $newest_post_img = '';
    else:
       # Mod: Global Announcements v1.2.8 START
       if($topic_rowset[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE):
          $folder = $images['folder_global_announce'];
          $folder_new = $images['folder_global_announce_new'];
          $topic_title = "".$board_config['global_view_open']." ".$topic_title."".$board_config['global_view_close']."";
       # Mod: Global Announcements v1.2.8 END

	   # Mod: Customized Topic Status v1.0.0 START
      elseif($topic_rowset[$i]['topic_type'] == POST_ANNOUNCE):
             $folder = $images['folder_announce'];
             $folder_new = $images['folder_announce_new'];
             $topic_title = "".$board_config['announce_view_open']." ".$topic_title."".$board_config['announce_view_close']."";
       elseif($topic_rowset[$i]['topic_type'] == POST_STICKY):
             $folder = $images['folder_sticky'];
             $folder_new = $images['folder_sticky_new'];
             $topic_title = "".$board_config['sticky_view_open']." ".$topic_title."".$board_config['sticky_view_close']."";
       elseif($topic_rowset[$i]['topic_status'] == TOPIC_LOCKED):
             $folder = $images['folder_locked'];
             $folder_new = $images['folder_locked_new'];
             $topic_title = "".$board_config['locked_view_open']." ".$topic_title."".$board_config['locked_view_close']."";
       else:
             if($replies >= $board_config['hot_threshold']):
               $folder = $images['folder_hot'];
               $folder_new = $images['folder_hot_new'];
             else:
               $folder = $images['folder'];
               $folder_new = $images['folder_new'];
             endif;
       endif;
       # Mod: Customized Topic Status v1.0.0 END

       $newest_post_img = '';

       if($userdata['session_logged_in']):
       
         if($topic_rowset[$i]['post_time'] > $userdata['user_lastvisit']):
            if(!empty($tracking_topics) || !empty($tracking_forums) || isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all'])):
            
               $unread_topics = true;

                  if(!empty($tracking_topics[$topic_id])):
                     if($tracking_topics[$topic_id] >= $topic_rowset[$i]['post_time'])
                       $unread_topics = false;
                  endif;

                  if(!empty($tracking_forums[$forum_id])):
                    if($tracking_forums[$forum_id] >= $topic_rowset[$i]['post_time'])
                       $unread_topics = false;
                  endif;

                  if(isset($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_f_all'])):
                     if($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_f_all'] >= $topic_rowset[$i]['post_time'])
                       $unread_topics = false;
                  endif;

                  if($unread_topics):
                    $folder_image = $folder_new;
                    $folder_alt = $lang['New_posts'];
                    $newest_post_img = '<a href="'.append_sid("viewtopic.$phpEx?".POST_TOPIC_URL."=$topic_id&amp;view=newest").'"><img 
					src="'.$images['icon_newest_reply'].'" alt="'.$lang['View_newest_post'].'" title="'.$lang['View_newest_post'].'" width="14" border="0" /></a> ';
                  else:
                    $folder_image = $folder;
                    $folder_alt = ($topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
                    $newest_post_img = '';
                  endif;
            else:
            
               $folder_image = $folder_new;
               $folder_alt = ($topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['New_posts'];
               $newest_post_img = '<a href="'.append_sid("viewtopic.$phpEx?".POST_TOPIC_URL."=$topic_id&amp;view=newest").'"><img 
			   src="'.$images['icon_newest_reply'].'" alt="'.$lang['View_newest_post'].'" title="'.$lang['View_newest_post'].'" width="14" border="0" /></a> ';
            endif;
        else:
          $folder_image = $folder;
          $folder_alt = ($topic_rowset[$i]['topic_status'] == TOPIC_LOCKED) ? $lang['Topic_locked'] : $lang['No_new_posts'];
          $newest_post_img = '';
        endif;
      else:
        $folder_image = $folder;
        $folder_alt = ($topic_rowset[$i]['topic_status'] == TOPIC_LOCKED) ? $lang['Topic_locked'] : $lang['No_new_posts'];
        $newest_post_img = '';
      endif;
    endif;

    if(($replies + 1) > $board_config['posts_per_page']):
    
       $total_pages = ceil(($replies + 1) / $board_config['posts_per_page']);
       $goto_page = ' [ <img width="14" src="'.$images['icon_gotopost'].'" alt="'.$lang['Goto_page'].'" title="'.$lang['Goto_page'].'" />'.$lang['Goto_page'].': ';
       $times = 1;

       for($j = 0; $j < $replies + 1; $j += $board_config['posts_per_page']):
         $goto_page .= '<a href="'.append_sid("viewtopic.$phpEx?".POST_TOPIC_URL."=".$topic_id."&amp;start=$j").'">'.$times.'</a>';
         if($times == 1 && $total_pages > 4):
            $goto_page .= ' ... ';
            $times = $total_pages - 3;
            $j += ($total_pages - 4) * $board_config['posts_per_page'];
         elseif($times < $total_pages):
           $goto_page .= ', ';
         endif;
         $times++;
	   endfor;
	   
       $goto_page .= ' ] ';
    
    else:
      $goto_page = '';
    endif;

    if(!isset($topic_rowset[$i]['username2']))
    $topic_rowset[$i]['username2'] = '';
    
	# Mod: Advanced Username Color v1.0.5 START
    $topic_rowset[$i]['username'] = UsernameColor($topic_rowset[$i]['username']);
    $topic_rowset[$i]['username2'] = UsernameColor($topic_rowset[$i]['username2']);
    $topic_rowset[$i]['user2'] = UsernameColor($topic_rowset[$i]['user2']);
    # Mod: Advanced Username Color v1.0.5 END

    $view_topic_url = append_sid("viewtopic.$phpEx?".POST_TOPIC_URL."=$topic_id");
    $topic_author = ($topic_rowset[$i]['user_id'] != ANONYMOUS) ? '<a href="'.append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL.'='.$topic_rowset[$i]['user_id']).'">' : '';
    
	$topic_author .= ($topic_rowset[$i]['user_id'] != ANONYMOUS) ? $topic_rowset[$i]['username'] : (($topic_rowset[$i]['post_username'] != '') 
	? $topic_rowset[$i]['post_username'] : $lang['Guest']);
    
	$topic_author .= ($topic_rowset[$i]['user_id'] != ANONYMOUS) ? '</a>' : '';
    $first_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['topic_time'], $board_config['board_timezone']);
    $last_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['post_time'], $board_config['board_timezone']);
    
	$last_post_author = ($topic_rowset[$i]['id2'] == ANONYMOUS) ? (($topic_rowset[$i]['post_username2'] != '') 
	? $topic_rowset[$i]['post_username2'].' ' : $lang['Guest'].' ' ) : '<a 
	href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL.'='.$topic_rowset[$i]['id2']).'">'.$topic_rowset[$i]['user2'].'</a>';
    
	$last_post_url = '<a href="'.append_sid("viewtopic.$phpEx?".POST_POST_URL.'='.$topic_rowset[$i]['topic_last_post_id']).'#'.$topic_rowset[$i]['topic_last_post_id'].'"><i 
	class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$lang['View_latest_post'].'"></i></a>';
    
	$views = $topic_rowset[$i]['topic_views'];
    $row_color = (!($i % 2)) ? $theme['td_color1'] : $theme['td_color2'];
    $row_class = (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'];

    $template->assign_block_vars('topicrow', array(
       # Mod: Post Icons v1.0.1 START
	   'ICON' => $icon,
	   'ICON_ID' => $icon_ID,
       # Mod: Post Icons v1.0.1 END
 
       'ROW_COLOR' => $row_color,
       'ROW_CLASS' => $row_class,
       'FORUM_ID' => $forum_id,
       'TOPIC_ID' => $topic_id,
       'TOPIC_FOLDER_IMG' => $folder_image,
       'TOPIC_AUTHOR' => $topic_author,
       'GOTO_PAGE' => $goto_page,
       'REPLIES' => $replies,
       'NEWEST_POST_IMG' => $newest_post_img,
       
	   # Mod: Attachment Mod v2.4.1 START
       'TOPIC_ATTACHMENT_IMG' => topic_attachment_image($topic_rowset[$i]['topic_attachment']),
	   # Mod: Attachment Mod v2.4.1 END

       'TOPIC_TITLE' => $topic_title,
       'TOPIC_TYPE' => $topic_type,
       'VIEWS' => $views,
       'FIRST_POST_TIME' => $first_post_time,
       'LAST_POST_TIME' => $last_post_time,
       // 'LAST_POST_AUTHOR' => $last_post_author,
       'LAST_POST_AUTHOR' => sprintf(trim($lang['Recent_first_poster']),$last_post_author),
       'LAST_POST_IMG' => $last_post_url,
       'L_TOPIC_FOLDER_ALT' => $folder_alt,
       'U_VIEW_TOPIC' => $view_topic_url)
        );

       # Mod: Separate Announcements & Sticky v2.0.0a START
       if(array_key_exists($i, $dividers)):
          $template->assign_block_vars('topicrow.divider', array(
          'L_DIV_HEADERS' => $dividers[$i])
           );
       endif;
       # Mod: Separate Announcements & Sticky v2.0.0a END
     
	 endfor;
        
		$topics_count -= $total_announcements;
        $template->assign_vars(array(

       # Mod: Topic display order v1.0.2 START
          'PAGINATION' => generate_pagination("viewforum.$phpEx?".POST_FORUM_URL."=$forum_id&amp;
		  topicdays=$topic_days&amp;sort=$sort_value&amp;order=$order_value", $topics_count, $board_config['topics_per_page'], $start),
       # Mod: Topic display order v1.0.2 START
          'PAGE_NUMBER' => sprintf($lang['Page_of'], (floor($start / $board_config['topics_per_page']) + 1), ceil($topics_count / $board_config['topics_per_page'] )),
          'L_GOTO_PAGE' => $lang['Goto_page'])
        );

else:
    # No topics
    $no_topics_msg = ($forum_row['forum_status'] == FORUM_LOCKED) ? $lang['Forum_locked'] : $lang['No_topics_post_one'];
    $template->assign_vars(array(
        'L_NO_TOPICS' => $no_topics_msg)
    );
    $template->assign_block_vars('switch_no_topics', array());
endif;

# Mod: Simple Subforums v1.0.1 START
switch(SQL_LAYER):
	case 'postgresql':
		$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id 
			FROM ".FORUMS_TABLE." f, ".POSTS_TABLE." p, ".USERS_TABLE." u
			WHERE p.post_id = f.forum_last_post_id 
				AND u.user_id = p.poster_id  
				AND f.forum_parent = '{$forum_id}'
				UNION (
					SELECT f.*, NULL, NULL, NULL, NULL
					FROM ".FORUMS_TABLE." f
					WHERE NOT EXISTS (
						SELECT p.post_time
						FROM ".POSTS_TABLE." p
						WHERE p.post_id = f.forum_last_post_id  
					)
				)
				ORDER BY cat_id, forum_order";
		break;
	case 'oracle':
		$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id
			FROM ".FORUMS_TABLE." f, ".POSTS_TABLE." p, ".USERS_TABLE." u
			WHERE p.post_id = f.forum_last_post_id(+)
				AND u.user_id = p.poster_id(+)
				AND f.forum_parent = '{$forum_id}'
			ORDER BY f.cat_id, f.forum_order";
		break;
	default:
		$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id
			FROM (( ".FORUMS_TABLE." f
			LEFT JOIN ".POSTS_TABLE." p ON p.post_id = f.forum_last_post_id )
			LEFT JOIN ".USERS_TABLE." u ON u.user_id = p.poster_id )
			WHERE f.forum_parent = '{$forum_id}'
			ORDER BY f.cat_id, f.forum_order";
		break;
endswitch;

if(!($result = $db->sql_query($sql)))
message_die(GENERAL_ERROR,'Could not query subforums information','', __LINE__, __FILE__,$sql);
$subforum_data = array();
while($row = $db->sql_fetchrow($result)):
 $subforum_data[] = $row;
endwhile;
$db->sql_freeresult($result);

if(($total_forums = count($subforum_data)) > 0):
	# Find which forums are visible for this user
	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $subforum_data);
	$display_forums = false;

	for($j = 0; $j < $total_forums; $j++):
	  if($is_auth_ary[$subforum_data[$j]['forum_id']]['auth_view'])
		$display_forums = true;
	endfor;	

	if(!$display_forums)
	$total_forums = 0;
endif;

if($total_forums)
{
	$template->assign_var('HAS_SUBFORUMS', $has_subforums);
	$template->assign_block_vars('catrow', array(
		'CAT_ID'	=> $forum_id,
		'CAT_DESC'	=> $forum_row['forum_name'],
		'U_VIEWCAT' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL ."=$forum_id"),
		));

	
	# Obtain a list of topic ids which contain
	# posts made since user last visited
	if($userdata['session_logged_in']):
		$sql = "SELECT t.forum_id, t.topic_id, p.post_time 
			FROM ".TOPICS_TABLE." t, ".POSTS_TABLE." p 
			WHERE p.post_id = t.topic_last_post_id 
				AND p.post_time > ".$userdata['user_lastvisit']." 
				AND t.topic_moved_id = 0"; 

		if(!($result = $db->sql_query($sql)))
		message_die(GENERAL_ERROR,'Could not query new topic information','', __LINE__, __FILE__,$sql);

		$new_topic_data = array();

		while($topic_data = $db->sql_fetchrow($result)):
			$new_topic_data[$topic_data['forum_id']][$topic_data['topic_id']] = $topic_data['post_time'];
		endwhile;
		$db->sql_freeresult($result);
	endif;

	# Obtain list of moderators of each forum
	# First users, then groups ... broken into two queries
	$subforum_moderators = array();
	$sql = "SELECT aa.forum_id, u.user_id, u.username 
		FROM ".AUTH_ACCESS_TABLE." aa, ".USER_GROUP_TABLE." ug, ".GROUPS_TABLE." g, ".USERS_TABLE." u
		WHERE aa.auth_mod = ".TRUE." 
			AND g.group_single_user = 1 
			AND ug.group_id = aa.group_id 
			AND g.group_id = aa.group_id 
			AND u.user_id = ug.user_id 
		GROUP BY u.user_id, u.username, aa.forum_id 
		ORDER BY aa.forum_id, u.user_id";

	if (!($result = $db->sql_query($sql, false, true)))
	message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);

	while($row = $db->sql_fetchrow($result)):
	 $subforum_moderators[$row['forum_id']][] = '<a href="'.append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=".$row['user_id']).'">'.UsernameColor($row['username']).'</a>';
	endwhile;
	$db->sql_freeresult($result);	

	$sql = "SELECT aa.forum_id, g.group_id, g.group_name 
		FROM ".AUTH_ACCESS_TABLE." aa, ".USER_GROUP_TABLE." ug, ".GROUPS_TABLE." g 
		WHERE aa.auth_mod = ".TRUE." 
			AND g.group_single_user = 0 
			AND g.group_type <> ".GROUP_HIDDEN."
			AND ug.group_id = aa.group_id 
			AND g.group_id = aa.group_id 
		GROUP BY g.group_id, g.group_name, aa.forum_id 
		ORDER BY aa.forum_id, g.group_id";

	if(!($result = $db->sql_query($sql,false,true)))
	message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);

	while($row = $db->sql_fetchrow($result)):
		$subforum_moderators[$row['forum_id']][] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . 	GroupColor($row['group_name']) . '</a>';
	endwhile;
	$db->sql_freeresult($result);

	# show subforums
	for($j = 0; $j < $total_forums; $j++):
		$subforum_id = $subforum_data[$j]['forum_id'];
		if($is_auth_ary[$subforum_id]['auth_view']):
		
			$unread_topics = false;

			if($subforum_data[$j]['forum_status'] == FORUM_LOCKED):
				$folder_image = $images['forum_locked']; 
				$folder_alt = $lang['Forum_locked'];
			else:
				if($userdata['session_logged_in']):
					if(!empty($new_topic_data[$subforum_id])):
						$subforum_last_post_time = 0;

						foreach($new_topic_data[$subforum_id] as $check_topic_id => $check_post_time):
							if(empty($tracking_topics[$check_topic_id])):
								$unread_topics = true;
								$subforum_last_post_time = max($check_post_time, $subforum_last_post_time);
							else:
								if($tracking_topics[$check_topic_id] < $check_post_time):
									$unread_topics = true;
									$subforum_last_post_time = max($check_post_time, $subforum_last_post_time);
								endif;
							endif;
						endforeach;

						if(!empty($tracking_forums[$subforum_id])):
							if ( $tracking_forums[$subforum_id] > $subforum_last_post_time )
							$unread_topics = false;
						endif;

						if(isset($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_f_all'])):
							if($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_f_all'] > $subforum_last_post_time)
							$unread_topics = false;
						endif;
					endif;
				endif;
				$folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum']; 
				$folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts']; 
			endif;

			$posts = $subforum_data[$j]['forum_posts'];
			$topics = $subforum_data[$j]['forum_topics'];

			if($subforum_data[$j]['forum_last_post_id']):
				$last_post_time = create_date($board_config['default_dateformat'], $subforum_data[$j]['post_time'], $board_config['board_timezone']);
				$last_post = $last_post_time . '<br />';
				
				$last_post .= ($subforum_data[$j]['user_id'] == ANONYMOUS) ? (($subforum_data[$j]['post_username'] != '') 
				? $subforum_data[$j]['post_username'].' ' : $lang['Guest'].' ' ) : '<a 
				href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL.'='.$subforum_data[$j]['user_id']).'">'.UsernameColor($subforum_data[$j]['username']).'</a> ';
				
				$last_post .= '<a href="'.append_sid("viewtopic.$phpEx?".POST_POST_URL.'='.$subforum_data[$j]['forum_last_post_id']).'#'.$subforum_data[$j]['forum_last_post_id'].'"><img 
				src="'.$images['icon_latest_reply'].'" width="14" border="0" alt="'.$lang['View_latest_post'].'" title="'.$lang['View_latest_post'].'" /></a>';
			
			else:
				$last_post = $lang['No_Posts'];
			endif;

			// if(count($subforum_moderators[$subforum_id]) > 0)                                                               whO? WHY?
			// {                                                                                                               whO? WHY?
			// 	$l_moderators = (count($subforum_moderators[$subforum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];  whO? WHY?
			// 	$moderator_list = implode(', ', $subforum_moderators[$subforum_id]);                                           whO? WHY?
			// }                                                                                                               whO? WHY?
			// else                                                                                                            whO? WHY?
			// {                                                                                                               whO? WHY?
			// 	$l_moderators = '&nbsp;';                                                                                      whO? WHY?
			// 	$moderator_list = '';                                                                                          whO? WHY?
			// }                                                                                                               whO? WHY?

            $moderator_list = $forum_moderators;

			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$template->assign_block_vars('catrow.forumrow',	array(
				'ROW_COLOR' => '#' . $row_color,
				'ROW_CLASS' => $row_class,
				'FORUM_FOLDER_IMG' => $folder_image, 
				'FORUM_NAME' => $subforum_data[$j]['forum_name'],
				'FORUM_DESC' => $subforum_data[$j]['forum_desc'],
				'POSTS' => $subforum_data[$j]['forum_posts'],
				'TOPICS' => $subforum_data[$j]['forum_topics'],
				'LAST_POST' => $last_post,
				'MODERATORS' => $moderator_list,
				'ID' => $subforum_data[$j]['forum_id'],
				'UNREAD' => intval($unread_topics),
				'LAST_POST_TIME' => $last_post_time,
				'L_MODERATOR' => $l_moderators, 
				'L_FORUM_FOLDER_ALT' => $folder_alt,
				'U_VIEWFORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$subforum_id"))
			);
		endif;
	endfor;
}
# Mod: Simple Subforums v1.0.1 END

# Base: At a Glance v2.2.1 START
# Mod: At a Glance Option v1.0.0 START
if (show_glance("forums")) 
include($phpbb_root_path . 'glance.'.$phpEx);
# Base: At a Glance v2.2.1 END
# Mod: At a Glance Option v1.0.0 END

# Parse the page and print
$template->pparse('body');

# Page footer
include("includes/page_tail.$phpEx");
?>
