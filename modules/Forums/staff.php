<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/11/2005
      Remote Avatar Resize                     v2.0.0       19/11/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!isset($popup)){
    $module_name = basename(dirname(__FILE__));
    require("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB', true);

global $db, $board_config, $template, $auth, $lang, $images, $phpEx, $user_ip, $session_length, $userdata;

include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);


$userdata = session_pagestart($user_ip, PAGE_STAFF, $session_length);
init_userprefs($userdata);

$page_title = $lang['Staff'];
include('includes/page_header.'.$phpEx);

        $template->set_filenames(array(
                'body' => 'staff_body.tpl')
        );
$uid = (isset($userdata['user_id']) && !empty($userdata['user_id'])) ? $userdata['user_id'] : '1';

// forums
 $sql = "SELECT ug.user_id, f.forum_id, f.forum_name
           FROM (" . USER_GROUP_TABLE . " ug
           LEFT JOIN  " . USER_GROUP_TABLE . " ug2  ON ug2.user_id = " . $uid . "
           LEFT JOIN  " . AUTH_ACCESS_TABLE . " aa2 ON aa2.group_id = ug2.group_id AND aa2.auth_view = " . TRUE . ",
           " . FORUMS_TABLE . " f, " . AUTH_ACCESS_TABLE . " aa)
           WHERE aa.auth_mod = " . TRUE . "
                      AND ug.group_id = aa.group_id
                      AND f.forum_id = aa.forum_id
                      AND ( f.auth_view <= '.$auth.'
                      OR aa2.auth_view = " . TRUE . ")
           ";
/*$sql = "SELECT ug.user_id, f.forum_id, f.forum_name
           FROM ".AUTH_ACCESS_TABLE." aa, ".USER_GROUP_TABLE." ug, ".FORUMS_TABLE." f
           WHERE aa.auth_mod = " . TRUE . "
                    AND ug.group_id = aa.group_id
                      AND f.forum_id = aa.forum_id";*/
if ( !$result = $db->sql_query($sql) )
{
        message_die(GENERAL_ERROR, 'Could not query forums.', '', __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) )
{
        $forum_id = $row['forum_id'];
        $staff2[$row['user_id']][$row['forum_id']] = '<a href='.append_sid("viewforum.$phpEx?f=$forum_id").' class=genmed>'.$row['forum_name'].'</a><br />';
}

//main
$sql = "SELECT * FROM ".USERS_TABLE."
           WHERE user_level >= 2
           AND user_active = ".TRUE."
           ORDER BY user_level = 3, user_level = 4";
if ( !($results = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not obtain user information.', '', __LINE__, __FILE__, $sql);
}
while($staff = $db->sql_fetchrow($results))
{
        if ( $staff['user_avatar'] )
        {
                switch( $staff['user_avatar_type'] )
                {
                     case USER_AVATAR_UPLOAD:
                     $avatar = ( $board_config['allow_avatar_upload'] ) ? '<img class="rounded-corners-forum" width="200" src="' . $board_config['avatar_path'] . '/' . $staff['user_avatar'] . '" border="0" />' : '';
                     break;
                    /*****[BEGIN]******************************************
                     [ Mod:     Remote Avatar Resize               v2.0.0 ]
                     ******************************************************/
                     case USER_AVATAR_REMOTE:
                     $avatar = resize_avatar($staff['user_avatar']);
                     break;
                    /*****[END]********************************************
                     [ Mod:     Remote Avatar Resize               v2.0.0 ]
                     ******************************************************/
                     case USER_AVATAR_GALLERY:
                     $avatar = ( $board_config['allow_avatar_local'] ) 
					 ? '<img class="rounded-corners-forum" width="200" src="' . $board_config['avatar_gallery_path'] . '/' . $staff['user_avatar'] . '" alt="" border="0" />' : '';
                     break;
                }
        }
        else
        {
           $avatar = '';
        }

        $lvl = $staff['user_level']-1;
        $result = $db->sql_query('SELECT group_name FROM '. AUC_TABLE .' WHERE group_id='.$lvl);
        list($group_name) = $db->sql_fetchrow($result);
        $level = GroupColor($group_name);
        $db->sql_freeresult($result);

        $level .= "<br />\n<hr>\n";

        //Groups
        $result = $db->sql_query("SELECT group_name FROM " . GROUPS_TABLE . " g LEFT JOIN " . USER_GROUP_TABLE . " ug on ug.group_id=g.group_id WHERE ug.user_id='".$staff['user_id']."' and g.group_description != 'Personal User'");
	    if ($db->sql_numrows($result) != 0) {
	        while(list($group_name) = $db->sql_fetchrow($result)) {
	            $level .= GroupColor($group_name). "<br />";
	        }
	        $db->sql_freeresult($result);
	    }


        $forums = '';
        if ( !empty($staff2[$staff['user_id']]) )
        {
                asort($staff2[$staff['user_id']]);
                $forums = implode(' ',$staff2[$staff['user_id']]);
        }
        $regdate = $staff['user_regdate'];
        $nukedate = strtotime($regdate);
        $memberdays = max(1, round( ( time() - $nukedate ) / 86400 ));
        $posts_per_day = $staff['user_posts'] / $memberdays;
        if ( $staff['user_posts'] != 0 )
        {
                $total_posts = get_db_stat('postcount');
                $percentage = ( $total_posts ) ? min(100, ($staff['user_posts'] / $total_posts) * 100) : 0;
        }
        else
        {
                $percentage = 0;
        }
        $user_id = $staff['user_id'];
        $sql = "SELECT post_time, post_id FROM ".POSTS_TABLE." WHERE poster_id = " . $user_id . " ORDER BY post_time DESC LIMIT 1";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Error getting user last post time', '', __LINE__, __FILE__, $post_time_sql);
        }
        $row = $db->sql_fetchrow($result);
        $last_post = ( isset($row['post_time']) ) ? '<a href="'.append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$row[post_id]#$row[post_id]").'" class=gensmall>'.create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']).'</a>' : $lang['None'];

        $mailto = ( $board_config['board_email_form'] ) ? "modules.php?name=Profile&mode=email&amp;" . POST_USERS_URL .'=' . $staff['user_id'] : 'mailto:' . $staff['user_email'];
        $mail = ( $staff['user_email'] ) ? '<a href="' . $mailto . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>' : '';

        $pmto = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$staff[user_id]");
        $pm = '<a href="' . $pmto . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';

        $www = ( $staff['user_website'] ) ? '<a href="' . $staff['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';

        $sql = "SELECT * FROM " . RANKS_TABLE . " ORDER BY rank_special, rank_min";
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
        }
        $ranksrow = array();
        while ( $row = $db->sql_fetchrow($result) )
        {
                $ranksrow[] = $row;
        }
        $db->sql_freeresult($result);

        $rank = '';
        $rank_image = '';
        if ( $staff['user_rank'] )
        {
                for($j = 0; $j < count($ranksrow); $j++)
                {
                        if ( $staff['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
                        {
                                $rank = $ranksrow[$j]['rank_title'];
                                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$j]['rank_image'] . '" alt="' . $rank . '" title="' . $rank . '" border="0" /><br />' : '';
                        }
                }
        }
        else
        {
                for($j = 0; $j < count($ranksrow); $j++)
                {
                        if ( $staff['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
                        {
                                $rank = $ranksrow[$j]['rank_title'];
                                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$j]['rank_image'] . '" alt="' . $rank . '" title="' . $rank . '" border="0" /><br />' : '';
                        }
                }
        }

        $template->assign_block_vars('staff', array(
                'AVATAR' => $avatar,
                'RANK' => $rank,
                'RANK_IMAGE' => $rank_image,
                'U_NAME' => "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=$staff[user_id]",
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                'NAME' => UsernameColor($staff['username']),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                'LEVEL' => $level,
                'FORUMS' => $forums,
                'JOINED' => $staff['user_regdate'],
                'PERIOD' => sprintf($lang['Period'], $memberdays),
                'POSTS' => $staff['user_posts'],
                'POST_DAY' => sprintf($lang['User_post_day_stats'], $posts_per_day),
                'POST_PERCENT' => sprintf($lang['User_post_pct_stats'], $percentage),
                'LAST_POST' => $last_post,
                'MAIL' => $mail,
                'PM' => $pm,
                'WWW' => $www)
        );
}
        $template->assign_vars(array(
                'L_AVATAR' => $lang['Avatar'],
                'L_USERNAME' => $lang['Username'],
                'L_FORUMS' => $lang['Forums'],
                'L_POSTS' => $lang['Posts'],
                'L_JOINED' => $lang['Joined'],
                'L_EMAIL' => $lang['Email'],
                'L_PM' => $lang['Private_Message'],
                'L_MESSENGER' => $lang['Messenger'],
                'L_WWW' => $lang['Website'])
        );

        $template->pparse('body');

include('includes/page_tail.'.$phpEx);

?>