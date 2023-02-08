<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              admin_users.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: admin_users.php,v 1.57.2.27 2005/07/19 20:01:07 acydburn Exp
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
      Theme Management                         v1.0.2       12/14/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Force Word Wrapping - Configurator       v1.0.16      06/15/2005
      View/Disable Avatars/Signatures          v1.1.2       06/16/2005
      Super Quick Reply                        v1.3.2       09/08/2005
      Advanced Time Management                 v2.2.0       09/08/2005
      XData                                    v1.0.3       02/08/2007
      Hide Images                              v1.0.0       09/02/2005
      Remote Avatar Resize                     v2.0.0       11/19/2005
      Initial Usergroup                        v1.0.1       09/02/2005
      Edit User Post Count                     v1.0.0       12/19/2005
	  Member Country Flags                     v2.0.7
	  Multiple Ranks And Staff View            v2.0.3
	  Gender                                   v1.2.6
	  Birthdays                                v3.0.0
	  Admin User Notes                         v1.0.0       05/28/2009
	  Arcade                                   v3.0.2       05/29/2009
	  PHP 8.1 Patched                          v4.0.3       12/13/2022
-=[Last Updated]=-
      12/13/2022 11:00 am Ernest ALlen Buffington	  
 ************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $module['Users']['Manage'] = $filename;

        return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require(__DIR__ . '/pagestart.' . $phpEx);
require(__DIR__ . "/../../../includes/bbcode.php");
require(__DIR__ . "/../../../includes/functions_post.php");
require(__DIR__ . "/../../../includes/functions_selects.php");
require(__DIR__ . "/../../../includes/functions_validate.php");

/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
if ( !file_exists(phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_adv_time.' . $phpEx)) )
{
    include_once($phpbb_root_path . 'language/lang_english/lang_adv_time.' . $phpEx);
} else
{
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_adv_time.' . $phpEx);
}
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/

$html_entities_match = ['#<#', '#>#'];
$html_entities_replace = ['&lt;', '&gt;'];

//
// Set mode
//
if( isset( $_POST['mode'] ) || isset( $_GET['mode'] ) )
{
        $mode = $_POST['mode'] ?? $_GET['mode'];
        $mode = htmlspecialchars((string) $mode);
}
else
{
        $mode = '';
}

//
// Begin program
//
if ( $mode == 'edit' || $mode == 'save' && ( isset($_POST['username']) || isset($_GET[POST_USERS_URL]) || isset( $_POST[POST_USERS_URL]) ) )
{
/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
      if(isset($mode) && isset($_POST['submit'])) {
        attachment_quota_settings('user', $_POST['submit'], $mode);
	  }
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
        //
        // Ok, the profile has been modified and submitted, let's update
        //
        if ( ( $mode == 'save' && isset( $_POST['submit'] ) ) || isset( $_POST['avatargallery'] ) || isset( $_POST['submitavatar'] ) || isset( $_POST['cancelavatar'] ) )
        {
                $user_id = (int) $_POST['id'];

                if (!($this_userdata = get_userdata($user_id)))
                {
                        message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
                }

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                $this_userdata['xdata'] = get_user_xdata($user_id);
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
	    if(!isset($_POST['deleteuser']))
	    $_POST['deleteuser'] = '';
	
        if( $_POST['deleteuser'] && ( $userdata['user_id'] != $user_id ) )
                {
                        $sql = "SELECT g.group_id
                                FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
                                WHERE ug.user_id = '$user_id'
                                        AND g.group_id = ug.group_id
                                        AND g.group_single_user = 1";
                        if( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
                        }

                        $row = $db->sql_fetchrow($result);

                        $sql = "UPDATE " . POSTS_TABLE . "
                                SET poster_id = " . DELETED . ", post_username = '" . str_replace("\\'", "''", addslashes((string) $this_userdata['username'])) . "'
                                WHERE poster_id = '$user_id'";
                        if( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update posts for this user', '', __LINE__, __FILE__, $sql);
                        }

                        $sql = "UPDATE " . TOPICS_TABLE . "
                                SET topic_poster = " . DELETED . "
                                WHERE topic_poster = '$user_id'";
                        if( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update topics for this user', '', __LINE__, __FILE__, $sql);
                        }

                        $sql = "UPDATE " . VOTE_USERS_TABLE . "
                                SET vote_user_id = " . DELETED . "
                                WHERE vote_user_id = '$user_id'";
                        if( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
                        }

                        $sql = "UPDATE " . GROUPS_TABLE . "
            				SET group_moderator = " . $userdata['user_id'] . "
            				WHERE group_moderator = $user_id";
            			if( !$db->sql_query($sql) )
            			{
            				message_die(GENERAL_ERROR, 'Could not update group moderators', '', __LINE__, __FILE__, $sql);
                        }

                        $sql = "DELETE FROM " . USERS_TABLE . "
                                WHERE user_id = '$user_id'";
                        if( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
                        }

                        $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                                WHERE user_id = '$user_id'";
                        if( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete user from user_group table', '', __LINE__, __FILE__, $sql);
                        }

                        if ((int) $row['group_id'] > 0)
                        {
                        $sql = "DELETE FROM " . GROUPS_TABLE . "
                                WHERE group_id = " . $row['group_id'];
                        if( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
                        }

                        $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                                WHERE group_id = " . $row['group_id'];
                        if( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
                          }
                        }

                        $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
                                WHERE user_id = '$user_id'";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
                        }

/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
                                                $sql = "DELETE FROM " . SCORES_TABLE . " WHERE user_id = $user_id";

                                                if ( !$db->sql_query($sql) )
                                                {
                                                                message_die(GENERAL_ERROR, 'Could not delete scores from table', '', __LINE__, __FILE__, $sql);
                                                }

                                                $sql = "SELECT * FROM " . GAMES_TABLE . " WHERE game_highuser = $user_id";

                                                if( !($result = $db->sql_query($sql)) )
                                                {
                                                                message_die(GENERAL_ERROR, 'Could not read games table', '', __LINE__, __FILE__, $sql);
                                                }

                                                while ( $row_games = $db->sql_fetchrow($result) ) {
                                                                $sql2 = "SELECT * FROM " . SCORES_TABLE . " WHERE game_id = " . $row_games['game_id'] . " ORDER BY score_game DESC, score_date ASC LIMIT 0,1";

                                                                if( !($result2 = $db->sql_query($sql2)) )
                                                                {
                                                                                message_die(GENERAL_ERROR, 'Could not select scores', '', __LINE__, __FILE__, $sql2);
                                                                }

                                                                $game_highuser = 0 ;
                                                                $game_highscore = 0 ;
                                                                $game_highdate = 0 ;

                                                                if ( $row_high = $db->sql_fetchrow($result2) )
                                                                {
                                                                                $game_highuser = $row_high['user_id'] ;
                                                                                $game_highscore = $row_high['score_game'] ;
                                                                                $game_highdate =  $row_high['score_date'] ;
                                                                }

                                                                $sql2 = "UPDATE " . GAMES_TABLE . " SET game_highuser = $game_highuser , game_highdate = $game_highdate , game_highscore = $game_highscore WHERE game_id = " . $row_games['game_id'];

                                                                if ( !$db->sql_query($sql2) )
                                                                {
                                                                                message_die(GENERAL_ERROR, 'Could not update games table', '', __LINE__, __FILE__, $sql2);
                                                                }

                                                                $sql2 = "UPDATE " . COMMENTS_TABLE. " SET comments_value = '' WHERE game_id = " . $row_games['game_id'];
                                                                if (!$db->sql_query($sql2))
                                                                {
                                                                                message_die(GENERAL_ERROR, 'Could not delete from comments table', '', __LINE__, __FILE__, $sql2);
                                                                }
                                                }
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

                        $sql = "DELETE FROM " . BANLIST_TABLE . "
                                WHERE ban_userid = '$user_id'";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
                        }

						 $sql = "DELETE FROM " . SESSIONS_TABLE . "
							WHERE session_user_id = $user_id";
						 if ( !$db->sql_query($sql) )
						 {
							message_die(GENERAL_ERROR, 'Could not delete sessions for this user', '', __LINE__, __FILE__, $sql);
						 }

						 $sql = "DELETE FROM " . SESSIONS_KEYS_TABLE . "
							WHERE user_id = $user_id";
						 if ( !$db->sql_query($sql) )
						 {
							message_die(GENERAL_ERROR, 'Could not delete auto-login keys for this user', '', __LINE__, __FILE__, $sql);
						 }

/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                        $sql = "DELETE FROM ".$prefix."_bbuser_group
                                WHERE user_id = '$user_id'";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not delete user from inital user group table', '', __LINE__, __FILE__, $sql);
                        }
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

                        $sql = "SELECT privmsgs_id
                                FROM " . PRIVMSGS_TABLE . "
                                WHERE privmsgs_from_userid = '$user_id'
                                        OR privmsgs_to_userid = '$user_id'";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not select all users private messages', '', __LINE__, __FILE__, $sql);
                        }

                        // This little bit of code directly from the private messaging section.
                        while ( $row_privmsgs = $db->sql_fetchrow($result) )
                        {
                                $mark_list[] = $row_privmsgs['privmsgs_id'];
                        }

                        if ( (is_countable($mark_list) ? count($mark_list) : 0) > 0 )
                        {
                                $delete_sql_id = implode(', ', $mark_list);

                                $delete_text_sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
                                        WHERE privmsgs_text_id IN ($delete_sql_id)";
                                $delete_sql = "DELETE FROM " . PRIVMSGS_TABLE . "
                                        WHERE privmsgs_id IN ($delete_sql_id)";

                                if ( !$db->sql_query($delete_sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
                                }

                                if ( !$db->sql_query($delete_text_sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
                                }
                        }

                        $message = $lang['User_deleted'] . '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

                        message_die(GENERAL_MESSAGE, $message);
                }

                $username = ( empty($_POST['username']) ) ? '' : phpbb_clean_username($_POST['username']);
                $email = ( empty($_POST['email']) ) ? '' : trim(strip_tags(htmlspecialchars( (string) $_POST['email'] ) ));

                $password = ( empty($_POST['password']) ) ? '' : trim(strip_tags(htmlspecialchars( (string) $_POST['password'] ) ));
                $password_confirm = ( empty($_POST['password_confirm']) ) ? '' : trim(strip_tags(htmlspecialchars( (string) $_POST['password_confirm'] ) ));

/*****[BEGIN]******************************************
 [ Mod:  Birthdays                             v3.0.0 ]
 ******************************************************/
				$bday_year = ( empty($_POST['bday_year']) ) ? 0 : $_POST['bday_year'];
				$bday_month = ( empty($_POST['bday_month']) ) ? 0 : $_POST['bday_month'];
				$bday_day = ( empty($_POST['bday_day']) ) ? 0 : $_POST['bday_day'];
		
				$birthday_display = ( isset($_POST['birthday_display']) ) ? (int) $_POST['birthday_display'] : 0;
				$birthday_greeting = $_POST['bday_greeting'] ?? 0;
/*****[END]********************************************
 [ Mod:  Birthdays                             v3.0.0 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                $reputation = ( empty($_POST['reputation']) ) ? 0 : trim(strip_tags( (string) $_POST['reputation'] ) );
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
				$facebook = ( empty($_POST['facebook']) ) ? '' : trim(strip_tags( (string) $_POST['facebook'] ) );
                $website = ( empty($_POST['website']) ) ? '' : trim(strip_tags( (string) $_POST['website'] ) );
                $location = ( empty($_POST['location']) ) ? '' : trim(strip_tags( (string) $_POST['location'] ) );
                $occupation = ( empty($_POST['occupation']) ) ? '' : trim(strip_tags( (string) $_POST['occupation'] ) );
                $interests = ( empty($_POST['interests']) ) ? '' : trim(strip_tags( (string) $_POST['interests'] ) );
/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
                $gender = ( isset($_POST['gender']) ) ? (int) $_POST['gender'] : 0;
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
                $glance_show = ( empty($_POST['glance_show']) ) ? '' : trim(strip_tags( (string) $_POST['glance_show'] ) );
/*****[END]********************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
                $user_posts = ( empty($_POST['user_posts']) ) ? 0 : trim(strip_tags( (string) $_POST['user_posts'] ) );
/*****[END]********************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
 /*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
                $hide_images = ( empty($_POST['hide_images']) ) ? 0 : trim(strip_tags( (string) $_POST['hide_images'] ) );
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
                $signature = ( empty($_POST['signature']) ) ? '' : trim(str_replace('<br />', "\n", (string) $_POST['signature'] ) );
/*****[BEGIN]******************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
                $user_admin_notes = ( empty($_POST['user_admin_notes']) ) ? '' : trim(str_replace('<br />', "\n", (string) $_POST['user_admin_notes'] ) );
/*****[END]********************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                $xdata = [];
                $xd_meta = get_xd_metadata();
                foreach ($xd_meta as $name => $info)
                {
                    if ( !empty($_POST[$name]) && $info['handle_input'] )
                    {
                        $xdata[$name] = trim(str_replace('<br />', "\n", (string) $_POST[$name] ) );
                    }
                }
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

                validate_optional_fields($website, $location, $occupation, $interests, $signature, $facebook);

                $viewemail = ( isset( $_POST['viewemail']) ) ? ( ( $_POST['viewemail'] ) ? TRUE : 0 ) : 0;
                $allowviewonline = ( isset( $_POST['hideonline']) ) ? ( ( $_POST['hideonline'] ) ? 0 : TRUE ) : TRUE;
                $notifyreply = ( isset( $_POST['notifyreply']) ) ? ( ( $_POST['notifyreply'] ) ? TRUE : 0 ) : 0;
                $notifypm = ( isset( $_POST['notifypm']) ) ? ( ( $_POST['notifypm'] ) ? TRUE : 0 ) : TRUE;
                $popuppm = ( isset( $_POST['popup_pm']) ) ? ( ( $_POST['popup_pm'] ) ? TRUE : 0 ) : TRUE;
                $attachsig = ( isset( $_POST['attachsig']) ) ? ( ( $_POST['attachsig'] ) ? TRUE : 0 ) : 0;

                $allowhtml = ( isset( $_POST['allowhtml']) ) ? (int) $_POST['allowhtml'] : $board_config['allow_html'];
                $allowbbcode = ( isset( $_POST['allowbbcode']) ) ? (int) $_POST['allowbbcode'] : $board_config['allow_bbcode'];
                $allowsmilies = ( isset( $_POST['allowsmilies']) ) ? (int) $_POST['allowsmilies'] : $board_config['allow_smilies'];
/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
                $showavatars = ( isset( $_POST['showavatars']) ) ? (int) $_POST['showavatars'] : $board_config['showavatars'];
                $showsignatures = ( isset( $_POST['showsignatures']) ) ? (int) $_POST['showsignatures'] : $board_config['showsignatures'];
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/

                $user_style = $_POST['theme'] ?: '';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
                $user_wordwrap = ( $_POST['user_wordwrap'] ) ? (int) $_POST['user_wordwrap'] : $board_config['wrap_def'];
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
                $user_lang = $_POST['language'] ?: $board_config['default_lang'];
                $user_timezone = ( isset( $_POST['timezone']) ) ? (float) $_POST['timezone'] : $board_config['board_timezone'];
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
				$user_flag = ( empty($_POST['user_flag']) ) ? '' : $_POST['user_flag'] ;
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                $time_mode = ( isset($_POST['time_mode']) ) ? (int) $_POST['time_mode'] : $board_config['default_time_mode'];
                if ( !preg_match("/[^0-9]/i",(string) $_POST['dst_time_lag']) )
                {
                    $dst_time_lag = ( isset($_POST['dst_time_lag']) ) ? (int) $_POST['dst_time_lag'] : $board_config['default_dst_time_lag'];
                }
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                $user_template = $_POST['template'] = $_POST['template'] ?? '' ?: $board_config['board_template'] = $board_config['board_template'] ?? '';
                $user_dateformat = ( $_POST['dateformat'] ) ? trim( (string) $_POST['dateformat'] ) : $board_config['default_dateformat'];

/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
                $user_show_quickreply = ( isset( $_POST['show_quickreply'] ) ) ? (int) $_POST['show_quickreply'] : 1;
                $user_quickreply_mode = ( isset( $_POST['quickreply_mode'] ) ) ? ( ( $_POST['quickreply_mode'] ) ? TRUE : 0 ) : TRUE;
                $user_open_quickreply = ( isset( $_POST['open_quickreply'] ) ) ? ( ( $_POST['open_quickreply'] ) ? TRUE : 0 ) : TRUE;
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

                $user_avatar_local = ( isset( $_POST['avatarselect'] ) && !empty($_POST['submitavatar'] ) && $board_config['allow_avatar_local'] ) ? $_POST['avatarselect'] : ( $_POST['avatarlocal'] ?? '' );
                $user_avatar_category = ( isset($_POST['avatarcatname']) && $board_config['allow_avatar_local'] ) ? htmlspecialchars((string) $_POST['avatarcatname']) : '' ;

                $user_avatar_remoteurl = ( empty($_POST['avatarremoteurl']) ) ? '' : trim( (string) $_POST['avatarremoteurl'] );
                $user_avatar_url = ( empty($_POST['avatarurl']) ) ? '' : trim( (string) $_POST['avatarurl'] );
                
				if(!isset($_FILES['avatar']['tmp_name']))
				$_FILES['avatar']['tmp_name'] = '';
				$user_avatar_loc = ( $_FILES['avatar']['tmp_name'] != "none") ? $_FILES['avatar']['tmp_name'] : '';
                
				$user_avatar_name = ( empty($_FILES['avatar']['name']) ) ? '' : $_FILES['avatar']['name'];
                $user_avatar_size = ( empty($_FILES['avatar']['size']) ) ? 0 : $_FILES['avatar']['size'];
                $user_avatar_filetype = ( empty($_FILES['avatar']['type']) ) ? '' : $_FILES['avatar']['type'];

                $user_avatar = ( empty($user_avatar_loc) ) ? $this_userdata['user_avatar'] : '';
                $user_avatar_type = ( empty($user_avatar_loc) ) ? $this_userdata['user_avatar_type'] : '';

                $user_status = ( empty($_POST['user_status']) ) ? 0 : (int) $_POST['user_status'];
                $user_allowpm = ( empty($_POST['user_allowpm']) ) ? 0 : (int) $_POST['user_allowpm'];

                $user_rank = ( empty($_POST['user_rank']) ) ? 0 : (int) $_POST['user_rank'];
/*****[BEGIN]******************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
				$user_rank2 = ( empty($_POST['user_rank2']) ) ? 0 : (int) $_POST['user_rank2'];
				$user_rank3 = ( empty($_POST['user_rank3']) ) ? 0 : (int) $_POST['user_rank3'];
				$user_rank4 = ( empty($_POST['user_rank4']) ) ? 0 : (int) $_POST['user_rank4'];
				$user_rank5 = ( empty($_POST['user_rank5']) ) ? 0 : (int) $_POST['user_rank5'];
/*****[END]********************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
                $user_allowavatar = ( empty($_POST['user_allowavatar']) ) ? 0 : (int) $_POST['user_allowavatar'];

                if( isset( $_POST['avatargallery'] ) || isset( $_POST['submitavatar'] ) || isset( $_POST['cancelavatar'] ) )
                {
                        $username = stripslashes((string) $username);
                        $email = stripslashes($email);
                        $password = '';
                        $password_confirm = '';
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                        $reputation = (int) stripslashes($reputation);
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
						$facebook = htmlspecialchars(stripslashes($facebook));
                        $website = htmlspecialchars(stripslashes($website));
                        $location = htmlspecialchars(stripslashes($location));
                        $occupation = htmlspecialchars(stripslashes($occupation));
                        $interests = htmlspecialchars(stripslashes($interests));
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
                        $glance_show = htmlspecialchars(stripslashes($glance_show));
/*****[END]********************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
                        $user_posts = (int) stripslashes($user_posts);
/*****[END]********************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
                        $signature = htmlspecialchars(stripslashes($signature));
/*****[BEGIN]******************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
                        $user_admin_notes = htmlspecialchars(stripslashes($user_admin_notes));
/*****[END]********************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                        $func = fn($a): string => htmlspecialchars(stripslashes((string) $a));
                        $xdata = array_map($func, $xdata);
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

                        $user_lang = stripslashes((string) $user_lang);
                        $user_dateformat = htmlspecialchars(stripslashes((string) $user_dateformat));

                        if ( !isset($_POST['cancelavatar']))
                        {
                                $user_avatar = $user_avatar_category . '/' . $user_avatar_local;
                                $user_avatar_type = USER_AVATAR_GALLERY;
                        }
                }
        }

        if (isset( $_POST['submit'] )) {
            include(__DIR__ . "/../../../includes/usercp_avatar.php");
            $error = FALSE;
            if (stripslashes((string) $username) != $this_userdata['username'])
            {
                    unset($rename_user);

                    if ( stripslashes(strtolower((string) $username)) !== strtolower((string) $this_userdata['username']) )
                    {
                            $result = validate_username($username);
                            if ($result['error']) {
                                $error = TRUE;
                                $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
                            } elseif (strtolower(str_replace("\\'", "''", (string) $username)) === strtolower((string) $userdata['username'])) {
                                $error = TRUE;
                                $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Username_taken'];
                            }
                    }

                    if (!$error)
                    {
                            $username_sql = "username = '" . str_replace("\\'", "''", (string) $username) . "', ";
                            $rename_user = $username; // Used for renaming usergroup
                    }
            }
            $passwd_sql = '';
            if (!empty($password) && !empty($password_confirm)) {
                //
                // Awww, the user wants to change their password, isn't that cute..
                //
                if($password != $password_confirm)
                {
                        $error = TRUE;
                        $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
                }
                else
                {
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                        $password = md5((string) $password);
                        $passwd_sql = "user_password = '$password', ";
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                }
            } elseif ($password && !$password_confirm) {
                $error = TRUE;
                $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
            } elseif (!$password && $password_confirm) {
                $error = TRUE;
                $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
            }
            /*****[BEGIN]******************************************
             [ Mod:  Birthdays                             v3.0.0 ]
             ******************************************************/
            $empty_month = empty($bday_month) || $bday_month == $lang['Default_Month'];
            $empty_day = empty($bday_day) || $bday_day == $lang['Default_Day'];
            $empty_year = empty($bday_year) || $bday_year == $lang['Default_Year'];
            $temp_month = $empty_month ? 1 : $bday_month;
            $temp_day = $empty_day ? 1 : $bday_day;
            $temp_year = $empty_year ? 4 : $bday_year;
            switch (true)
        				{
        					case $board_config['bday_year'] && (($empty_month !== $empty_day) || ($empty_day !== $empty_year)):
        					case !$board_config['bday_year'] && (($empty_month !== $empty_day) || ($empty_day && !$empty_year)):
        					case !checkdate( $temp_month, $temp_day, $temp_year ) && (!$board_config['bday_lock'] || $userdata['user_birthday'] == 0):
        						$error = TRUE;
        						$error_msg .= ( ( empty($error_msg) ) ? '' : '<br />' ) . $lang['Birthday_invalid'];
        				}
            
			$user_birthday = sprintf('%02d%02d%04d',$bday_month,$bday_day,$bday_year);
            
			$user_birthday2 = ( $birthday_display != BIRTHDAY_DATE 
			                    && $birthday_display != BIRTHDAY_NONE 
								&& !$empty_month 
								&& !$empty_day 
								&& !$empty_year ) ? sprintf('%04d%02d%02d',$bday_year,$bday_month,$bday_day) : '0';
								
            if ( $birthday_greeting && !( $board_config['bday_greeting'] & 1<<($birthday_greeting-1) ) )
        	{
        	  $birthday_greeting = 0;
			}
            /*****[END]********************************************
             [ Mod:  Birthdays                             v3.0.0 ]
             ******************************************************/
            if ($signature != '')
            {
                    $sig_length_check = preg_replace('/(\[.*?)(=.*?)\]/is', '\\1]', stripslashes((string) $signature));
                    if ( $allowhtml )
                    {
                            $sig_length_check = preg_replace('/(\<.*?)(=.*?)( .*?=.*?)?([ \/]?\>)/is', '\\1\\3\\4', $sig_length_check);
                    }

                    // Only create a new bbcode_uid when there was no uid yet.
                    if ( $signature_bbcode_uid == '' )
                    {
                            $signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
                    }
                    $signature = prepare_message($signature, $allowhtml, $allowbbcode, $allowsmilies, $signature_bbcode_uid);

                    if ( strlen($sig_length_check) > $board_config['max_sig_chars'] )
                    {
                            $error = TRUE;
                            $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Signature_too_long'];
                    }
            }
            /*****[BEGIN]******************************************
             [ Mod:    Advanced Time Management            v2.2.0 ]
             ******************************************************/
            if ( preg_match("/[^0-9]/i",(string) $_POST['dst_time_lag']) || $dst_time_lag<0 || $dst_time_lag>120 )
            {
                $error = TRUE;
                $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['dst_time_lag_error'];
            }
            /*****[END]********************************************
             [ Mod:    Advanced Time Management            v2.2.0 ]
             ******************************************************/
            /*****[BEGIN]******************************************
             [ Mod:     XData                              v1.0.3 ]
             ******************************************************/
            $xd_meta = get_xd_metadata();
            foreach ($xd_meta as $code_name => $meta) {
                if ( $meta['handle_input'] && ( ( $mode == 'register' && $meta['default_auth'] == XD_AUTH_ALLOW ) || xdata_auth($code_name, $userdata['user_id']) ) )
                {
                    if ( ($meta['field_length'] > 0) && (strlen((string) $xdata[$code_name]) > $meta['field_length']) )
                    {
                           $error = TRUE;
                        $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_too_long'], $meta['field_name']);
                    }

                    if ( ( (is_countable($meta['values_array']) ? count($meta['values_array']) : 0) > 0 ) && ( ! in_array($xdata[$code_name], $meta['values_array']) ) )
                    {
                           $error = TRUE;
                        $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
                    }

                    if ( ( strlen((string) $meta['field_regexp']) > 0 ) && ( ! preg_match($meta['field_regexp'], (string) $xdata[$code_name]) ) )
                    {
                        $error = TRUE;
                        $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
                    }

                    if ( $meta['allow_bbcode'] && $signature_bbcode_uid == '' )
                    {
                        $signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
                    }

                    $xdata[$code_name] = prepare_message($xdata[$code_name], $meta['allow_html'], $meta['allow_bbcode'], $meta['allow_smilies'], $signature_bbcode_uid);
                  }
            }
            /*****[END]********************************************
             [ Mod:     XData                              v1.0.3 ]
             ******************************************************/
            //
            // Avatar stuff
            //
            $avatar_sql = "";
            if (isset($_POST['avatardel'])) {
                if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "" && file_exists(phpbb_realpath('./../' . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])) )
                {
                        unlink('./../' . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar']);
                }
                $avatar_sql = ", user_avatar = '', user_avatar_type = " . USER_AVATAR_NONE;
            } elseif (( $user_avatar_loc != "" || !empty($user_avatar_url) ) && !$error) {
                //
                // Only allow one type of upload, either a
                // filename or a URL
                //
                if( !empty($user_avatar_loc) && !empty($user_avatar_url) )
                {
                        $error = TRUE;
                        if( isset($error_msg) )
                        {
                                $error_msg .= "<br />";
                        }
                        $error_msg .= $lang['Only_one_avatar'];
                }
                if ($user_avatar_loc != "") {
                    if( file_exists(phpbb_realpath($user_avatar_loc)) && preg_match("/\.(jpg|gif|png)$/i", (string) $user_avatar_name) )
                    {
                            if( $user_avatar_size <= $board_config['avatar_filesize'] && $user_avatar_size > 0)
                            {
                                    $error_type = false;

                                    //
                                    // Opera appends the image name after the type, not big, not clever!
                                    //
                                    preg_match("'image\/[x\-]*([a-z]+)'", (string) $user_avatar_filetype, $user_avatar_filetype);
                                    $user_avatar_filetype = $user_avatar_filetype[1];

                                    switch( $user_avatar_filetype )
                                    {
                                            case "jpeg":
                                            case "pjpeg":
                                            case "jpg":
                                                    $imgtype = '.jpg';
                                                    break;
                                            case "gif":
                                                    $imgtype = '.gif';
                                                    break;
                                            case "png":
                                                    $imgtype = '.png';
                                                    break;
                                            default:
                                                    $error = true;
                                                    $error_msg = (empty($error_msg)) ? $lang['Avatar_filetype'] : $error_msg . "<br />" . $lang['Avatar_filetype'];
                                                    break;
                                    }

                                    if( !$error )
                                    {
                                            [$width, $height] = getimagesize($user_avatar_loc);

                                            if( $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
                                            {
                                                    $user_id = $this_userdata['user_id'];

                                                    $avatar_filename = $user_id . $imgtype;

                                                    if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "" && file_exists(phpbb_realpath("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])) )
                                                    {
                                                            unlink("./../" . $board_config['avatar_path'] . "/". $this_userdata['user_avatar']);
                                                    }
                                                    copy($user_avatar_loc, "./../" . $board_config['avatar_path'] . "/$avatar_filename");

                                                    $avatar_sql = ", user_avatar = '$avatar_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
                                            }
                                            else
                                            {
                                                    $l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

                                                    $error = true;
                                                    $error_msg = ( empty($error_msg) ) ? $l_avatar_size : $error_msg . "<br />" . $l_avatar_size;
                                            }
                                    }
                            }
                            else
                            {
                                    $l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

                                    $error = true;
                                    $error_msg = ( empty($error_msg) ) ? $l_avatar_size : $error_msg . "<br />" . $l_avatar_size;
                            }
                    }
                    else
                    {
                            $error = true;
                            $error_msg = ( empty($error_msg) ) ? $lang['Avatar_filetype'] : $error_msg . "<br />" . $lang['Avatar_filetype'];
                    }
                } elseif (!empty($user_avatar_url)) {
                    //
                    // First check what port we should connect
                    // to, look for a :[xxxx]/ or, if that doesn't
                    // exist assume port 80 (http)
                    //
                    preg_match("/^(http:\\/\\/)?([\\w\\-\\.]+)\\:?(\\d*)\\/(.*)\$/", (string) $user_avatar_url, $url_ary);
                    if( !empty($url_ary[4]) )
                    {
                            $port = (empty($url_ary[3])) ? 80 : $url_ary[3];

                            $fsock = fsockopen($url_ary[2], $port, $errno, $errstr);
                            if( $fsock )
                            {
                                    $base_get = "/" . $url_ary[4];

                                    //
                                    // Uses HTTP 1.1, could use HTTP 1.0 ...
                                    //
                                    fwrite($fsock, "GET $base_get HTTP/1.1\r\n");
                                    fwrite($fsock, "HOST: " . $url_ary[2] . "\r\n");
                                    fwrite($fsock, "Connection: close\r\n\r\n");

                                    unset($avatar_data);
                                    while( !feof($fsock) )
                                    {
                                            $avatar_data .= fread($fsock, $board_config['avatar_filesize']);
                                    }
                                    fclose($fsock);

                                    if( preg_match("/Content-Length\\: (\\d+)[^\\/ ][\\s]+/i", (string) $avatar_data, $file_data1) && preg_match("/Content-Type\: image\/[x\-]*([a-z]+)[\s]+/i", (string) $avatar_data, $file_data2) )
                                    {
                                            $file_size = $file_data1[1];
                                            $file_type = $file_data2[1];

                                            switch( $file_type )
                                            {
                                                    case "jpeg":
                                                    case "pjpeg":
                                                    case "jpg":
                                                            $imgtype = '.jpg';
                                                            break;
                                                    case "gif":
                                                            $imgtype = '.gif';
                                                            break;
                                                    case "png":
                                                            $imgtype = '.png';
                                                            break;
                                                    default:
                                                            $error = true;
                                                            $error_msg = (empty($error_msg)) ? $lang['Avatar_filetype'] : $error_msg . "<br />" . $lang['Avatar_filetype'];
                                                            break;
                                            }

                                            if( !$error && $file_size > 0 && $file_size < $board_config['avatar_filesize'] )
                                            {
                                                    $avatar_data = substr((string) $avatar_data, strlen((string) $avatar_data) - $file_size, $file_size);

                                                    $tmp_filename = tempnam ("/tmp", $this_userdata['user_id'] . "-");
                                                    $fptr = fopen($tmp_filename, "wb");
                                                    $bytes_written = fwrite($fptr, $avatar_data, $file_size);
                                                    fclose($fptr);

                                                    if( $bytes_written == $file_size )
                                                    {
                                                            [$width, $height] = getimagesize($tmp_filename);

                                                            if( $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
                                                            {
                                                                    $user_id = $this_userdata['user_id'];

                                                                    $avatar_filename = $user_id . $imgtype;

                                                                    if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "" && file_exists(phpbb_realpath("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])))
                                                                    {
                                                                            unlink("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar']);
                                                                    }
                                                                    copy($tmp_filename, "./../" . $board_config['avatar_path'] . "/$avatar_filename");
                                                                    unlink($tmp_filename);

                                                                    $avatar_sql = ", user_avatar = '$avatar_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
                                                            }
                                                            else
                                                            {
                                                                    $l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

                                                                    $error = true;
                                                                    $error_msg = ( empty($error_msg) ) ? $l_avatar_size : $error_msg . "<br />" . $l_avatar_size;
                                                            }
                                                    }
                                                    else
                                                    {
                                                            //
                                                            // Error writing file
                                                            //
                                                            unlink($tmp_filename);
                                                            message_die(GENERAL_ERROR, "Could not write avatar file to local storage. Please contact the board administrator with this message", "", __LINE__, __FILE__);
                                                    }
                                            }
                                    }
                                    else
                                    {
                                            //
                                            // No data
                                            //
                                            $error = true;
                                            $error_msg = ( empty($error_msg) ) ? $lang['File_no_data'] : $error_msg . "<br />" . $lang['File_no_data'];
                                    }
                            }
                            else
                            {
                                    //
                                    // No connection
                                    //
                                    $error = true;
                                    $error_msg = ( empty($error_msg) ) ? $lang['No_connection_URL'] : $error_msg . "<br />" . $lang['No_connection_URL'];
                            }
                    }
                    else
                    {
                            $error = true;
                            $error_msg = ( empty($error_msg) ) ? $lang['Incomplete_URL'] : $error_msg . "<br />" . $lang['Incomplete_URL'];
                    }
                } elseif (!empty($user_avatar_name)) {
                    $l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));
                    $error = true;
                    $error_msg = ( empty($error_msg) ) ? $l_avatar_size : $error_msg . "<br />" . $l_avatar_size;
                }
            } elseif ($user_avatar_remoteurl != "" && empty($avatar_sql) && !$error) {
                if( !preg_match("#^http:\/\/#i", (string) $user_avatar_remoteurl) )
                {
                        $user_avatar_remoteurl = "http://" . $user_avatar_remoteurl;
                }
                if( preg_match("#^(http:\/\/[a-z0-9\-]+?\.([a-z0-9\-]+\.)*[a-z]+\/.*?\.(gif|jpg|png)$)#is", (string) $user_avatar_remoteurl) )
                {
                        $avatar_sql = ", user_avatar = '" . str_replace("\'", "''", (string) $user_avatar_remoteurl) . "', user_avatar_type = " . USER_AVATAR_REMOTE;
                }
                else
                {
                        $error = true;
                        $error_msg = ( empty($error_msg) ) ? $lang['Wrong_remote_avatar_format'] : $error_msg . "<br />" . $lang['Wrong_remote_avatar_format'];
                }
            } elseif ($user_avatar_local != "" && empty($avatar_sql) && !$error) {
                $avatar_sql = ", user_avatar = '" . str_replace("\'", "''", phpbb_ltrim(basename((string) $user_avatar_category), "'") . '/' . phpbb_ltrim(basename((string) $user_avatar_local), "'")) . "', user_avatar_type = " . USER_AVATAR_GALLERY;
            }
            //
            // Update entry in DB
            //
            if( !$error )
            {
/*****[BEGIN]******************************************
 [ Mod:    Super Quick Reply                   v1.3.2 ]
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 [ Mod:    View/Disable Avatars/Signatures     v1.1.2 ]
 [ Mod:    Advanced Time Management            v2.2.0 ]
 [ Mod:    At a Glance Options                 v1.0.0 ]
 [ Mod:    Hide Images                         v1.0.0 ]
 [ Mod:    Edit User Post Count                v1.0.0 ]
 [ Mod:    Member Country Flags                v2.0.7 ]
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ] 
 [ Mod:    Gender                              v1.2.6 ]
 [ Mod:    Birthdays                           v3.0.0 ]
 [ Mod:    Users Reputations Systems           v1.0.0 ]
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
                    if(!isset($username_sql))
					$username_sql = '';
					
					if(!isset($signature_bbcode_uid))
					$signature_bbcode_uid = '';
					
                    $sql = "UPDATE " . USERS_TABLE . "
                                SET " . $username_sql . $passwd_sql . "user_email = '" . str_replace("\'", "''", (string) $email) . "', 
								user_reputation = '" . str_replace("\'", "''", (string) $reputation) . "', 
								user_birthday = '".$user_birthday."', 
								user_birthday2 = '".$user_birthday2."', 
								birthday_display = '".$birthday_display."', 
								birthday_greeting = '".$birthday_greeting."', 
								user_website = '" . str_replace("\'", "''", (string) $website) . "', 
								user_occ = '" . str_replace("\'", "''", (string) $occupation) . "', 
								user_from = '" . str_replace("\'", "''", (string) $location) . "', 
								user_from_flag = '".$user_flag."', 
								user_interests = '" . str_replace("\'", "''", (string) $interests) . "', 
								user_glance_show = '" . str_replace("\'", "''", (string) $glance_show) . "', 
								user_sig = '" . str_replace("\'", "''", (string) $signature) . "', 
								user_admin_notes = '" . str_replace("\'", "''", (string) $user_admin_notes) . "', 
								user_viewemail = '".$viewemail."', 
								user_facebook = '" . str_replace("\'", "''", (string) $facebook) . "', 
								user_attachsig = '".$attachsig."', 
								user_sig_bbcode_uid = '".$signature_bbcode_uid."', 
								user_allowsmile = '".$allowsmilies."', 
								user_showavatars = '".$showavatars."', 
								user_showsignatures = '".$showsignatures."', 
								user_allowhtml = '".$allowhtml."', 
								user_allowavatar = '".$user_allowavatar."', 
								user_allowbbcode = '".$allowbbcode."', 
								user_allow_viewonline = '".$allowviewonline."', 
								user_notify = '".$notifyreply."', 
								user_allow_pm = '".$user_allowpm."', 
								user_notify_pm = '".$notifypm."', 
								user_popup_pm = '".$popuppm."', 
								user_wordwrap = '".$user_wordwrap."', 
								user_lang = '" . str_replace("\'", "''", (string) $user_lang) . "', 
								theme = '".$user_style."', 
								user_timezone = '".$user_timezone."', 
								user_time_mode = '".$time_mode."', 
								user_dst_time_lag = '".$dst_time_lag."', 
								user_dateformat = '" . str_replace("\'", "''", (string) $user_dateformat) . "', 
								user_show_quickreply = '".$user_show_quickreply."', 
								user_quickreply_mode = '".$user_quickreply_mode."', 
								user_open_quickreply = '".$user_open_quickreply."', 
								user_active = '".$user_status."', 
								user_hide_images = '".$hide_images."', 
								user_rank =  '".$user_rank."', 
								user_rank2 = '".$user_rank2."', 
								user_rank3 = '".$user_rank3."', 
								user_rank4 = '".$user_rank4."', 
								user_rank5 = '".$user_rank5."', 
								user_gender = '".$gender."', 
								user_posts  = '".$user_posts.$avatar_sql."'
                                
								WHERE user_id = '".$user_id."'";
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 [ Mod:    Gender                              v1.2.6 ]
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 [ Mod:    Member Country Flags                v2.0.7 ]
 [ Mod:    Super Quick Reply                   v1.3.2 ]
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 [ Mod:    View/Disable Avatars/Signatures     v1.1.2 ]
 [ Mod:    Advanced Time Management            v2.2.0 ]
 [ Mod:    At a Glance Options                 v1.0.0 ]
 [ Mod:    Hide Images                         v1.0.0 ]
 [ Mod:    Edit User Post Count                v1.0.0 ]
 [ Mod:    Users Reputations Systems           v1.0.0 ]
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
                    $xdata = [];
					
                    if( $result = $db->sql_query($sql) )
                    {
                            if( isset($rename_user) )
                            {
                                    $sql = "UPDATE " . GROUPS_TABLE . "
                                                SET group_name = '".str_replace("\'", "''", (string) $rename_user)."'
                                                WHERE group_name = '".str_replace("'", "''", (string) $this_userdata['username'] )."'";
                                    if( !$result = $db->sql_query($sql) )
                                    {
                                            message_die(GENERAL_ERROR, 'Could not rename users group', '', __LINE__, __FILE__, $sql);
                                    }
                            }

                            // Delete user session, to prevent the user navigating the forum (if logged in) when disabled
                            if (!$user_status)
                            {
                                    $sql = "DELETE FROM " . SESSIONS_TABLE . "
                                                WHERE session_user_id = " . $user_id;

                                    if ( !$db->sql_query($sql) )
                                    {
                                            message_die(GENERAL_ERROR, 'Error removing user session', '', __LINE__, __FILE__, $sql);
                                    }
                            }

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                            $xd_meta = get_xd_metadata();
                            foreach ($xd_meta as $code_name => $meta) {
                                
								if(!isset($xdata[$code_name]))
								$xdata[$code_name] = '';
								
								$xd_value = $xdata[$code_name];
                                
								if ( ( in_array($xd_value, $meta['values_array']) || (is_countable($meta['values_array']) ? count($meta['values_array']) : 0) == 0 ) && $meta['handle_input'] )
                                {
                                    set_user_xdata($user_id, $code_name, $xd_value);
                                }
                            }
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                            // We remove all stored login keys since the password has been updated
             				// and change the current one (if applicable)
             				if ( !empty($passwd_sql) )
             				{
             					session_reset_keys($user_id, $user_ip);
             				}
                            
							if(!isset($message))
							$message = '';
							
							$message .= $lang['Admin_user_updated'];
                    }
                    else
                    {
                        message_die(GENERAL_ERROR, 'Admin_user_fail', '', __LINE__, __FILE__, $sql);
                    }

                    $message .= '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

                    message_die(GENERAL_MESSAGE, $message);
            }
            else
            {
                    $template->set_filenames(['reg_header' => 'error_body.tpl']
                    );

                    $template->assign_vars(['ERROR_MESSAGE' => $error_msg]
                    );

                    $template->assign_var_from_handle('ERROR_BOX', 'reg_header');

                    $username = htmlspecialchars(stripslashes((string) $username));
                    $email = stripslashes((string) $email);
                    $password = '';
                    $password_confirm = '';
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                    $reputation = (int) $reputation;
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
						$facebook = htmlspecialchars(stripslashes((string) $facebook));
                    $website = htmlspecialchars(stripslashes((string) $website));
                    $location = htmlspecialchars(stripslashes((string) $location));
                    $occupation = htmlspecialchars(stripslashes((string) $occupation));
                    $interests = htmlspecialchars(stripslashes((string) $interests));
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
                    $glance_show = htmlspecialchars(stripslashes((string) $glance_show));
/*****[END]**********77********************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
                    $user_posts = (int) stripslashes((string) $user_posts);
/*****[END]**********77********************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
 /*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
                    $hide_images = stripslashes((string) $hide_images);
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/

                    $signature = htmlspecialchars(stripslashes((string) $signature));

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                    $func = fn($a): string => htmlspecialchars(stripslashes((string) $a));
                    $xdata = array_map($func, $xdata);
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

                    $user_lang = stripslashes((string) $user_lang);
                    $user_dateformat = htmlspecialchars(stripslashes((string) $user_dateformat));
            }
        } elseif (!isset( $_POST['submit'] ) && $mode != 'save' && !isset( $_POST['avatargallery'] ) && !isset( $_POST['submitavatar'] ) && !isset( $_POST['cancelavatar'] )) {
            if( isset( $_GET[POST_USERS_URL]) || isset( $_POST[POST_USERS_URL]) )
            {
                    $user_id = ( isset( $_POST[POST_USERS_URL]) ) ? (int) $_POST[POST_USERS_URL] : (int) $_GET[POST_USERS_URL];
                    $this_userdata = get_userdata($user_id);
                    if( !$this_userdata )
                    {
                            message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
                    }
/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                    $this_userdata['xdata'] = get_user_xdata($user_id);
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
            }
            else
            {
                    $this_userdata = get_userdata($_POST['username'], true);
                    if( !$this_userdata )
                    {
                            message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
                    }
/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                    $this_userdata['xdata'] = get_user_xdata($_POST['username'], true);
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
            }
            //
            // Now parse and display it as a template
            //
            $user_id = $this_userdata['user_id'];
            $username = $this_userdata['username'];
            $email = $this_userdata['user_email'];
            $password = '';
            $password_confirm = '';
            /*****[BEGIN]******************************************
             [ Mod:    Birthdays                           v3.0.0 ]
             ******************************************************/
            preg_match('/(..)(..)(....)/', sprintf('%08d',$this_userdata['user_birthday']), $bday_parts);
            $bday_month = $bday_parts[1];
            $bday_day = $bday_parts[2];
            $bday_year = $bday_parts[3];
            $birthday_display = $this_userdata['birthday_display'];
            $birthday_greeting = $this_userdata['birthday_greeting'];
            /*****[END]********************************************
             [ Mod:    Birthdays                           v3.0.0 ]
             ******************************************************/
            /*****[BEGIN]******************************************
             [ Mod:     Users Reputations Systems          v1.0.0 ]
             ******************************************************/
            $reputation = $this_userdata['user_reputation'];
            /*****[END]********************************************
             [ Mod:     Users Reputations System           v1.0.0 ]
             ******************************************************/
            $facebook = htmlspecialchars((string) $this_userdata['user_facebook']);
            $website = htmlspecialchars((string) $this_userdata['user_website']);
            $location = htmlspecialchars((string) $this_userdata['user_from']);
            /*****[BEGIN]******************************************
             [ Mod:     Member Country Flags               v2.0.7 ]
             ******************************************************/
            $user_flag = htmlspecialchars((string) $this_userdata['user_from_flag']);
            /*****[END]********************************************
             [ Mod:     Member Country Flags               v2.0.7 ]
             ******************************************************/
            $occupation = htmlspecialchars((string) $this_userdata['user_occ']);
            $interests = htmlspecialchars((string) $this_userdata['user_interests']);
            /*****[BEGIN]******************************************
             [ Mod:    Gender                              v1.2.6 ]
             ******************************************************/
            $gender = $this_userdata['user_gender'];
            /*****[END]********************************************
             [ Mod:    Gender                              v1.2.6 ]
             ******************************************************/
            /*****[BEGIN]******************************************
             [ Mod:    At a Glance Options                 v1.0.0 ]
             *****************************************************/
            $glance_show = htmlspecialchars((string) $this_userdata['user_glance_show']);
            /*****[END]********************************************
             [ Mod:    At a Glance Options                 v1.0.0 ]
             *****************************************************/
            /*****[BEGIN]******************************************
             [ Mod:    Edit User Post Count                v1.0.0 ]
             *****************************************************/
            $user_posts = (int) $this_userdata['user_posts'];
            /*****[END]********************************************
             [ Mod:    Edit User Post Count                v1.0.0 ]
             *****************************************************/
            /*****[BEGIN]******************************************
             [ Mod:    Hide Images                         v1.0.0 ]
             ******************************************************/
            $hide_images = $this_userdata['user_hide_images'];
            /*****[END]********************************************
             [ Mod:    Hide Images                         v1.0.0 ]
             ******************************************************/
            $signature = ($this_userdata['user_sig_bbcode_uid'] != '') ? preg_replace('#:' . $this_userdata['user_sig_bbcode_uid'] . '#si', '', (string) $this_userdata['user_sig']) : $this_userdata['user_sig'];
            $signature = preg_replace($html_entities_match, $html_entities_replace, (string) $signature);
            /*****[BEGIN]******************************************
             [ Mod:     XData                              v1.0.3 ]
             ******************************************************/
            foreach ($this_userdata['xdata'] as $name => $value)
            {
                $value = ($this_userdata['user_sig_bbcode_uid'] != '') ? preg_replace('#:' . $this_userdata['user_sig_bbcode_uid'] . '#si', '', (string) $value) : $value;
                $xdata[$name] = preg_replace($html_entities_match, $html_entities_replace, (string) $value);
            }
            /*****[END]********************************************
             [ Mod:     XData                              v1.0.3 ]
             ******************************************************/
            $viewemail = $this_userdata['user_viewemail'];
            $notifypm = $this_userdata['user_notify_pm'];
            $popuppm = $this_userdata['user_popup_pm'];
            $notifyreply = $this_userdata['user_notify'];
            $attachsig = $this_userdata['user_attachsig'];
            $allowhtml = $this_userdata['user_allowhtml'];
            $allowbbcode = $this_userdata['user_allowbbcode'];
            $allowsmilies = $this_userdata['user_allowsmile'];
            $user_lang = $this_userdata['user_lang'];
            /*****[BEGIN]******************************************
             [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
             ******************************************************/
            $showavatars = $this_userdata['user_showavatars'];
            $showsignatures = $this_userdata['user_showsignatures'];
            /*****[END]********************************************
             [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
             ******************************************************/
            $user_timezone = $this_userdata['user_timezone'];
            $allowviewonline = $this_userdata['user_allow_viewonline'];
            $user_avatar = $this_userdata['user_avatar'];
            $user_avatar_type = $this_userdata['user_avatar_type'];
            $user_style = $this_userdata['theme'];
            /*****[BEGIN]******************************************
             [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
             ******************************************************/
            $user_wordwrap = $this_userdata['user_wordwrap'];
            /*****[END]********************************************
             [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
             ******************************************************/
            $time_mode = $this_userdata['user_time_mode'];
            $dst_time_lag = $this_userdata['user_dst_time_lag'];
            /*****[BEGIN]******************************************
             [ Mod:    Advanced Time Management            v2.2.0 ]
             ******************************************************/
			if(!isset($_POST['dst_time_lag']))
			$_POST['dst_time_lag'] = '';
            
			if ( preg_match("/[^0-9]/i",(string) $_POST['dst_time_lag']) || $dst_time_lag<0 || $dst_time_lag>120 )
            {
                $error = TRUE;
                $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['dst_time_lag_error'];
            }
            /*****[END]********************************************
             [ Mod:    Advanced Time Management            v2.2.0 ]
             ******************************************************/
            $user_dateformat = htmlspecialchars((string) $this_userdata['user_dateformat']);
            /*****[BEGIN]******************************************
             [ Mod:     Super Quick Reply                  v1.3.2 ]
             ******************************************************/
            $user_show_quickreply = $this_userdata['user_show_quickreply'];
            $user_quickreply_mode = $this_userdata['user_quickreply_mode'];
            $user_open_quickreply = $this_userdata['user_open_quickreply'];
            /*****[END]********************************************
             [ Mod:     Super Quick Reply                  v1.3.2 ]
             ******************************************************/
            $user_status = $this_userdata['user_active'];
            $user_allowavatar = $this_userdata['user_allowavatar'];
            $user_allowpm = $this_userdata['user_allow_pm'];
            /*****[BEGIN]******************************************
             [ Mod:    Admin User Notes                    v1.0.0 ]
             ******************************************************/
            $admin_notes = $this_userdata['user_admin_notes'];
            /*****[END]********************************************
             [ Mod:    Admin User Notes                    v1.0.0 ]
             ******************************************************/
            $COPPA = false;
            $html_status =  ($this_userdata['user_allowhtml'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
            $bbcode_status = ($this_userdata['user_allowbbcode'] ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
            $smilies_status = ($this_userdata['user_allowsmile'] ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];
        }

        if( isset($_POST['avatargallery']) && !$error )
        {
                if( !$error )
                {
                        $user_id = (int) $_POST['id'];

                        $template->set_filenames(["body" => "admin/user_avatar_gallery.tpl"]
                        );

                        $dir = opendir("../" . $board_config['avatar_gallery_path']);

                        $avatar_images = [];
                        while( $file = readdir($dir) )
                        {
                                if( $file != "." && $file != ".." && !is_file(phpbb_realpath("./../" . $board_config['avatar_gallery_path'] . "/" . $file)) && !is_link(phpbb_realpath("./../" . $board_config['avatar_gallery_path'] . "/" . $file)) )
                                {
                                        $sub_dir = opendir("../" . $board_config['avatar_gallery_path'] . "/" . $file);

                                        $avatar_row_count = 0;
                                        $avatar_col_count = 0;

                                        while( $sub_file = readdir($sub_dir) )
                                        {
                                                if( preg_match("/(\.gif$|\.png$|\.jpg)$/is", $sub_file) )
                                                {
                                                        $avatar_images[$file][$avatar_row_count][$avatar_col_count] = $sub_file;

                                                        $avatar_col_count++;
                                                        if( $avatar_col_count == 5 )
                                                        {
                                                                $avatar_row_count++;
                                                                $avatar_col_count = 0;
                                                        }
                                                }
                                        }
                                }
                        }

                        closedir($dir);

                        $category = isset($_POST['avatarcategory']) ? htmlspecialchars((string) $_POST['avatarcategory']) : key($avatar_images);
                        reset($avatar_images);

                        $s_categories = "";
                        foreach (array_keys($avatar_images) as $key) {
                            $selected = ( $key == $category ) ? "selected=\"selected\"" : "";
                            if( $avatar_images[$key] !== [] )
                            {
                                    $s_categories .= '<option value="' . $key . '"' . $selected . '>' . ucfirst((string) $key) . '</option>';
                            }
                        }

                        $s_colspan = 0;
                        $itemsCount = count($avatar_images[$category]);
                        for($i = 0; $i < $itemsCount; $i++)
                        {
                                $template->assign_block_vars("avatar_row", []);

                                $s_colspan = max($s_colspan, count($avatar_images[$category][$i]));
                                $itemsCount2 = count($avatar_images[$category][$i]);

                                for($j = 0; $j < $itemsCount2; $j++)
                                {
                                        $template->assign_block_vars("avatar_row.avatar_column", ["AVATAR_IMAGE" => "../" . $board_config['avatar_gallery_path'] . '/' . $category . '/' . $avatar_images[$category][$i][$j]]
                                        );

                                        $template->assign_block_vars("avatar_row.avatar_option_column", ["S_OPTIONS_AVATAR" => $avatar_images[$category][$i][$j]]
                                        );
                                }
                        }

                        $coppa = ( ( !$_POST['coppa'] && !$_GET['coppa'] ) || $mode == "register") ? 0 : TRUE;

                        $s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" /><input type="hidden" name="avatarcatname" value="' . $category . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="id" value="' . $user_id . '" />';

                        $s_hidden_fields .= '<input type="hidden" name="username" value="' . str_replace("\"", "&quot;", (string) $username) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="email" value="' . str_replace("\"", "&quot;", (string) $email) . '" />';
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
						$s_hidden_fields .= '<input type="hidden" name="bday_years" value="' . $bday_years . '" />';
						$s_hidden_fields .= '<input type="hidden" name="bday_months" value="' . $bday_months . '" />';
						$s_hidden_fields .= '<input type="hidden" name="bday_days" value="' . $bday_days . '" />';
						$s_hidden_fields .= '<input type="hidden" name="birthday_display" value="' . $birthday_display . '" />';
						$s_hidden_fields .= '<input type="hidden" name="birthday_greeting" value="' . $birthday_greeting . '" />';
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
 
 /*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="reputation" value="' . str_replace("\"", "&quot;", (string) $reputation) . '" />';
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
						$s_hidden_fields .= '<input type="hidden" name="facebook" value="' . str_replace("\"", "&quot;", (string) $facebook) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="website" value="' . str_replace("\"", "&quot;", (string) $website) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="location" value="' . str_replace("\"", "&quot;", (string) $location) . '" />';
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
						$s_hidden_fields .= '<input type="hidden" name="user_flag" value="' . $user_flag . '" />';
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="occupation" value="' . str_replace("\"", "&quot;", (string) $occupation) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="interests" value="' . str_replace("\"", "&quot;", (string) $interests) . '" />';
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="glance_show" value="' . str_replace("\"", "&quot;", (string) $glance_show) . '" />';
/*****[END]********************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="user_posts" value="' . $user_posts . '" />';
/*****[END]********************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
 /*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="hide_images" value="' . $hide_images . '" />';
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/

                        $s_hidden_fields .= '<input type="hidden" name="signature" value="' . str_replace("\"", "&quot;", (string) $signature) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="viewemail" value="' . $viewemail . '" />';
/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="gender" value="' . $gender . '" />';
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="notifypm" value="' . $notifypm . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="popup_pm" value="' . $popuppm . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="notifyreply" value="' . $notifyreply . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="attachsig" value="' . $attachsig . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="allowhtml" value="' . $allowhtml . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="allowbbcode" value="' . $allowbbcode . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="allowsmilies" value="' . $allowsmilies . '" />';
/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="showavatars" value="' . $showavatars . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="showsignatures" value="' . $showsignatures . '" />';
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="hideonline" value="' . !$allowviewonline . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="theme" value="' . $user_style . '" />';
/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="wrap" value="' . $user_wordwrap .'" />';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="language" value="' . $user_lang . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="timezone" value="' . $user_timezone . '" />';
/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                        reset($xdata);
                        foreach ($xdata as $key => $value) {
                            $s_hidden_fields .= '<input type="hidden" name="' . $key . '" value="' . str_replace("\"", "&quot;", (string) $value) . '" />';
                        }
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="time_mode" value="' . $time_mode . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="dst_time_lag" value="' . $dst_time_lag . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="dateformat" value="' . str_replace("\"", "&quot;", (string) $user_dateformat) . '" />';
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="show_quickreply" value="' . $user_show_quickreply . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="quickreply_mode" value="' . $user_quickreply_mode . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="open_quickreply" value="' . $user_quickreply_mode . '" />';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

                        $s_hidden_fields .= '<input type="hidden" name="user_status" value="' . $user_status . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="user_allowpm" value="' . $user_allowpm . '" />';
/*****[BEGIN]******************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="user_admin_notes" value="' . $user_admin_notes . '" />';
/*****[END]********************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="user_allowavatar" value="' . $user_allowavatar . '" />';
/*****[BEGIN]******************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
						$s_hidden_fields .= '<input type="hidden" name="user_rank"  value="' . $user_rank  . '" />';
						$s_hidden_fields .= '<input type="hidden" name="user_rank2" value="' . $user_rank2 . '" />';
						$s_hidden_fields .= '<input type="hidden" name="user_rank3" value="' . $user_rank3 . '" />';
						$s_hidden_fields .= '<input type="hidden" name="user_rank4" value="' . $user_rank4 . '" />';
						$s_hidden_fields .= '<input type="hidden" name="user_rank5" value="' . $user_rank5 . '" />';
/*****[END]********************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/

                        $template->assign_vars(["L_USER_TITLE" => $lang['User_admin'], 
						                        "L_USER_EXPLAIN" => $lang['User_admin_explain'], 
												"L_AVATAR_GALLERY" => $lang['Avatar_gallery'], 
												"L_SELECT_AVATAR" => $lang['Select_avatar'], 
												"L_RETURN_PROFILE" => $lang['Return_profile'], 
												"L_CATEGORY" => $lang['Select_category'], 
												"L_GO" => $lang['Go'], 
												"S_OPTIONS_CATEGORIES" => $s_categories, 
												"S_COLSPAN" => $s_colspan, 
												"S_PROFILE_ACTION" => append_sid("admin_users.$phpEx?mode=$mode"), 
												"S_HIDDEN_FIELDS" => $s_hidden_fields]
                        );
                }
        }
        else
        {
                $s_hidden_fields = '<input type="hidden" name="mode" value="save" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa = $coppa ?? '' . '" />';
                $s_hidden_fields .= '<input type="hidden" name="id" value="' . $this_userdata['user_id'] . '" />';

           if( !empty($user_avatar_local) )
           {
             $s_hidden_fields .= '<input type="hidden" name="avatarlocal" value="' . $user_avatar_local . '" /><input type="hidden" name="avatarcatname" value="' . $user_avatar_category . '" />';
           }

                if( $user_avatar_type )
                {
                        switch( $user_avatar_type )
                        {
                                case USER_AVATAR_UPLOAD:
                                        $avatar = '<img width="200px" style="border-radius: 25px;" src="../../../' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />';
                                        break;
                                /*****[BEGIN]******************************************
                                 [ Mod:     Remote Avatar Resize               v2.0.0 ]
                                 ******************************************************/
                                case USER_AVATAR_REMOTE:
                                        $avatar = resize_avatar($user_avatar);
                                        break;
                                /*****[END]********************************************
                                 [ Mod:     Remote Avatar Resize               v2.0.0 ]
                                 ******************************************************/
                                case USER_AVATAR_GALLERY:
                                        $avatar = '<img width="200px" style="border-radius: 25px;" src="../../../' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />';
                                        break;
                        }
                }
                else
                {
                        $avatar = "";
                }

                $sql = "SELECT * FROM " . RANKS_TABLE . "
                        WHERE rank_special = '1'
                        ORDER BY rank_title";
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain ranks data', '', __LINE__, __FILE__, $sql);
                }

/*****[BEGIN]******************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
				$selected1 = ( $this_userdata['user_rank'] == '-2' ) ? ' selected="selected"' : '';
				$selected2 = ( $this_userdata['user_rank2'] == '-2' ) ? ' selected="selected"' : '';
				$selected3 = ( $this_userdata['user_rank3'] == '-2' ) ? ' selected="selected"' : '';
				$selected4 = ( $this_userdata['user_rank4'] == '-2' ) ? ' selected="selected"' : '';
				$selected5 = ( $this_userdata['user_rank5'] == '-2' ) ? ' selected="selected"' : '';
				$rank1_select_box = '<option value="-2"' . $selected1 . '>' . $lang['No_Rank'] . '</option>';
				$rank2_select_box = '<option value="-2"' . $selected2 . '>' . $lang['No_Rank'] . '</option>';
				$rank3_select_box = '<option value="-2"' . $selected3 . '>' . $lang['No_Rank'] . '</option>';
				$rank4_select_box = '<option value="-2"' . $selected4 . '>' . $lang['No_Rank'] . '</option>';
				$rank5_select_box = '<option value="-2"' . $selected5 . '>' . $lang['No_Rank'] . '</option>';
				$selected1 = ( $this_userdata['user_rank'] == '-1' ) ? ' selected="selected"' : '';
				$selected2 = ( $this_userdata['user_rank2'] == '-1' ) ? ' selected="selected"' : '';
				$selected3 = ( $this_userdata['user_rank3'] == '-1' ) ? ' selected="selected"' : '';
				$selected4 = ( $this_userdata['user_rank4'] == '-1' ) ? ' selected="selected"' : '';
				$selected5 = ( $this_userdata['user_rank5'] == '-1' ) ? ' selected="selected"' : '';
				$rank1_select_box .= '<option value="-1"' . $selected1 . '>' . $lang['Rank_Days_Count'] . '</option>';
				$rank2_select_box .= '<option value="-1"' . $selected2 . '>' . $lang['Rank_Days_Count'] . '</option>';
				$rank3_select_box .= '<option value="-1"' . $selected3 . '>' . $lang['Rank_Days_Count'] . '</option>';
				$rank4_select_box .= '<option value="-1"' . $selected4 . '>' . $lang['Rank_Days_Count'] . '</option>';
				$rank5_select_box .= '<option value="-1"' . $selected5 . '>' . $lang['Rank_Days_Count'] . '</option>';
				$selected1 = ( $this_userdata['user_rank'] == '0' ) ? ' selected="selected"' : '';
				$selected2 = ( $this_userdata['user_rank2'] == '0' ) ? ' selected="selected"' : '';
				$selected3 = ( $this_userdata['user_rank3'] == '0' ) ? ' selected="selected"' : '';
				$selected4 = ( $this_userdata['user_rank4'] == '0' ) ? ' selected="selected"' : '';
				$selected5 = ( $this_userdata['user_rank5'] == '0' ) ? ' selected="selected"' : '';
				$rank1_select_box .= '<option value="0"' . $selected1 . '>' . $lang['Rank_Posts_Count'] . '</option>';
				$rank2_select_box .= '<option value="0"' . $selected2 . '>' . $lang['Rank_Posts_Count'] . '</option>';
				$rank3_select_box .= '<option value="0"' . $selected3 . '>' . $lang['Rank_Posts_Count'] . '</option>';
				$rank4_select_box .= '<option value="0"' . $selected4 . '>' . $lang['Rank_Posts_Count'] . '</option>';
				$rank5_select_box .= '<option value="0"' . $selected5 . '>' . $lang['Rank_Posts_Count'] . '</option>';
/*****[END]********************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/ 
                while( $row = $db->sql_fetchrow($result) )
                {
                        $rank = $row['rank_title'];
                        $rank_id = $row['rank_id'];

/*****[BEGIN]******************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
						$selected1 = ( $this_userdata['user_rank'] == $rank_id ) ? ' selected="selected"' : '';
						$selected2 = ( $this_userdata['user_rank2'] == $rank_id ) ? ' selected="selected"' : '';
						$selected3 = ( $this_userdata['user_rank3'] == $rank_id ) ? ' selected="selected"' : '';
						$selected4 = ( $this_userdata['user_rank4'] == $rank_id ) ? ' selected="selected"' : '';
						$selected5 = ( $this_userdata['user_rank5'] == $rank_id ) ? ' selected="selected"' : '';
						$rank1_select_box .= '<option value="' . $rank_id . '"' . $selected1 . '>' . $rank . '</option>';
						$rank2_select_box .= '<option value="' . $rank_id . '"' . $selected2 . '>' . $rank . '</option>';
						$rank3_select_box .= '<option value="' . $rank_id . '"' . $selected3 . '>' . $rank . '</option>';
						$rank4_select_box .= '<option value="' . $rank_id . '"' . $selected4 . '>' . $rank . '</option>';
						$rank5_select_box .= '<option value="' . $rank_id . '"' . $selected5 . '>' . $rank . '</option>';
/*****[END]********************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
                }

                $template->set_filenames(["body" => "admin/user_edit_body.tpl"]
                );
/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                $xd_meta = get_xd_metadata();
                foreach ($xd_meta as $code_name => $info) {
                    if ( xdata_auth($code_name, $userdata['user_id']) || (int) $userdata['user_level'] == ADMIN )
                   	{
                   		if ($info['display_register'] == XD_DISPLAY_NORMAL)
                   		{
                   			$template->assign_block_vars('xdata', ['CODE_NAME' => $code_name, 'NAME' => $info['field_name'], 'DESCRIPTION' => $info['field_desc'], 'VALUE' => isset($xdata[$code_name]) ? str_replace('"', '&quot;', (string) $xdata[$code_name]) : '', 'MAX_LENGTH' => ( $info['field_length'] > 0) ? ( $info['field_length'] ) : '']
                   			);
   
                   			switch ($info['field_type'])
                   			{
                   				case 'text':
                   					$template->assign_block_vars('xdata.switch_type_text', []);
                   					break;
   
                   				case 'textarea':
                   					$template->assign_block_vars('xdata.switch_type_textarea', []);
                   					break;
   
                   				case 'checkbox':
                   					$template->assign_block_vars('xdata.switch_type_checkbox', ['CHECKED' => ($xdata[$code_name] == $lang['true']) ? ' checked="checked"' : '']);
                   					break;
   
                   				case 'radio':
                   					$template->assign_block_vars('xdata.switch_type_radio', []);
   
                   					foreach ($info['values_array'] as $option) {
                            $template->assign_block_vars('xdata.switch_type_radio.options', ['OPTION' => $option, 'CHECKED' => ($xdata[$code_name] == $option) ? 'checked="checked"' : '']
          	                	);
                        }
                   					break;
   
                   				case 'select':
                   					$template->assign_block_vars('xdata.switch_type_select', []);
   
                   					foreach ($info['values_array'] as $option) {
                            $template->assign_block_vars('xdata.switch_type_select.options', ['OPTION' => $option, 'SELECTED' => ($xdata[$code_name] == $option) ? 'selected="selected"' : '']
          	                	);
                        }
                   					break;
                   			}
                   		}
                   		elseif ($info['display_register'] == XD_DISPLAY_ROOT)
                   		{
                               $template->assign_block_vars('xdata',
                   	 	  		['CODE_NAME' => $code_name, 'NAME' => $xd_meta[$code_name]['field_name'], 'DESCRIPTION' => $xd_meta[$code_name]['field_desc'], 'VALUE' => isset($xdata[$code_name]) ? str_replace('"', '&quot;', (string) $xdata[$code_name]) : ''] );
                   		  	$template->assign_block_vars('xdata.switch_is_'.$code_name, []);
   
                   		  	switch ($info['field_type'])
                   			{
                   				case 'checkbox':
                   					$template->assign_block_vars('xdata.switch_type_checkbox', ['CHECKED' => ($xdata[$code_name] == 1) ? ' checked="checked"' : '']);
                   					break;
   
                   				case 'radio':
   
                   					foreach ($info['values_array'] as $option) {
                            $template->assign_block_vars('xdata.switch_is_'.$code_name.'.options', ['OPTION' => $option, 'CHECKED' => ($xdata[$code_name] == $option) ? 'checked="checked"' : '']
          	                	);
                        }
                   					break;
   
                   				case 'select':
   
                   					foreach ($info['values_array'] as $option) {
                            $template->assign_block_vars('xdata.switch_is_'.$code_name.'.options', ['OPTION' => $option, 'SELECTED' => ($xdata[$code_name] == $option) ? 'selected="selected"' : '']
          	                	);
                        }
                   					break;
                   			}
                   		}
                   	}
                }
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                $l_time_mode_0 = "";
                $l_time_mode_1 = "";
                $l_time_mode_2 = $lang['time_mode_dst_server'];
                $l_time_mode_3 = $lang['time_mode_full_server'];
                $l_time_mode_4 = $lang['time_mode_server_pc'];
                $l_time_mode_6 = $lang['time_mode_full_pc'];

                match ($board_config['default_time_mode']) {
                    MANUAL_DST => $l_time_mode_1 .= "*",
                    SERVER_SWITCH => $l_time_mode_2 .= "*",
                    FULL_SERVER => $l_time_mode_3 .= "*",
                    SERVER_PC => $l_time_mode_4 .= "*",
                    FULL_PC => $l_time_mode_6 .= "*",
                    default => $l_time_mode_0 .= "*",
                };

                switch ($time_mode)
                {
                    case MANUAL_DST:
                        $time_mode_manual_dst_checked='checked="checked"';
                        break;
                    case SERVER_SWITCH:
                        $time_mode_server_switch_checked='checked="checked"';
                        break;
                    case FULL_SERVER:
                        $time_mode_full_server_checked='checked="checked"';
                        break;
                    case SERVER_PC:
                        $time_mode_server_pc_checked='checked="checked"';
                        break;
                    case FULL_PC:
                        $time_mode_full_pc_checked='checked="checked"';
                        break;
                    default:
                        $time_mode_manual_checked='checked="checked"';
                        break;
            }
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
                switch ($gender) 
                { 
                    case 1: $gender_male_checked="checked=\"checked\"";break; 
                    case 2: $gender_female_checked="checked=\"checked\"";break; 
                    default:$gender_no_specify_checked="checked=\"checked\""; 
                }
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
                //
                // Let's do an overall check for settings/versions which would prevent
                // us from doing file uploads....
                //
                $ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
                $form_enctype = ( !$ini_val('file_uploads') || phpversion() == '4.0.4pl1' || !$board_config['allow_avatar_upload'] || ( phpversion() < '4.0.3' && $ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
				$sql = "SELECT *
					FROM " . FLAG_TABLE . "
					ORDER BY flag_id";
				if(!$flags_result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, "Couldn't obtain flags information.", "", __LINE__, __FILE__, $sql);
				}
				if(!isset($ranksresult))
				$ranksresult = '';
				
				$flag_row = $db->sql_fetchrowset($ranksresult);
				$num_flags = $db->sql_numrows($ranksresult) ;

			
				$flag_start_image = 'blank' ;
				$selected = ( isset($user_flag) ) ? '' : ' selected="selected"'  ;
				// $flag_select  = '<select name="user_flag" onChange="document.images['user_flag'].src = "../../../images/flags/"+ this.value;">';
                $flag_select  = '<select class="user_from_flag_select" name="user_flag">';
				$flag_select .= '  <option value="blank"'.$selected.'>'.$lang['Select_Country'].'</option>';
				for ($i = 0; $i < $num_flags; $i++)
				{
					$flag_name = $flag_row[$i]['flag_name'];
					$flag_image = $flag_row[$i]['flag_image'];
					$selected = ( isset( $user_flag) ) ? ((str_replace('.png','',(string) $user_flag) === str_replace('.png','',(string) $flag_image)) ? 'selected="selected"' : '' ) : '' ;
					$flag_select .= '  <option value="'.$flag_image.'"'.$selected.'>'.$flag_name.'</option>';
					if ( isset($user_flag) && ($user_flag == $flag_image))
					{
						// $flag_start_image = $flag_image;
                        $flag_start_image = str_replace('.png','',(string) $flag_image);
					}
				}
				$flag_select .= '</select>';




/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
                $template->assign_vars([
                    'USERNAME' => $username,
                    'EMAIL' => $email,
                    /*****[BEGIN]******************************************
                     [ Mod:     Users Reputations Systems          v1.0.0 ]
                     ******************************************************/
                    'REPUTATION' => $reputation,
                    /*****[END]********************************************
                     [ Mod:     Users Reputations System           v1.0.0 ]
                     ******************************************************/
                    'FACEBOOK' => $facebook,
                    'OCCUPATION' => $occupation,
                    'INTERESTS' => $interests,
                    /*****[BEGIN]******************************************
                     [ Mod:    Gender                              v1.2.6 ]
                     ******************************************************/
                    'GENDER' => $gender,
                    'GENDER_NO_SPECIFY_CHECKED' => $gender_no_specify_checked = $gender_no_specify_checked ?? '',
                    'GENDER_MALE_CHECKED' => $gender_male_checked = $gender_male_checked ?? '',
                    'GENDER_FEMALE_CHECKED' => $gender_female_checked = $gender_female_checked ?? '',
                    /*****[END]********************************************
                     [ Mod:    Gender                              v1.2.6 ]
                     ******************************************************/
                    /*****[BEGIN]******************************************
                     [ Mod:    At a Glance Options                 v1.0.0 ]
                     *****************************************************/
                    'GLANCE_SHOW' => glance_option_select($glance_show, 'glance_show'),
                    'L_GLANCE_SHOW' => $lang['glance_show'],
                    /*****[END]********************************************
                     [ Mod:    At a Glance Options                 v1.0.0 ]
                     *****************************************************/
                    /*****[BEGIN]******************************************
                     [ Mod:    Edit User Post Count                v1.0.0 ]
                     *****************************************************/
                    'USER_POSTS' => $user_posts,
                    'L_USER_POSTS' => $lang['user_posts'],
                    /*****[END]********************************************
                     [ Mod:    Edit User Post Count                v1.0.0 ]
                     *****************************************************/
                    /*****[BEGIN]******************************************
                     [ Mod:    Hide Images                         v1.0.0 ]
                     ******************************************************/
                    'HIDE_IMAGES_YES' => ( $hide_images ) ? 'checked="checked"' : '',
                    'HIDE_IMAGES_NO' => ( $hide_images ) ? '' : 'checked="checked"',
                    'L_HIDE_IMAGES' => $lang['user_hide_images'],
                    /*****[END]********************************************
                     [ Mod:    Hide Images                         v1.0.0 ]
                     ******************************************************/
                    'LOCATION' => $location,
                    /*****[BEGIN]******************************************
                     [ Mod:     Member Country Flags               v2.0.7 ]
                     ******************************************************/
                    'L_FLAG' => $lang['Country_Flag'],
                    'FLAG_SELECT' => $flag_select,
                    'FLAG_START' => $flag_start_image,
                    /*****[END]********************************************
                     [ Mod:     Member Country Flags               v2.0.7 ]
                     ******************************************************/
                    'WEBSITE' => $website,
                    /*****[BEGIN]******************************************
                     [ Mod:    Birthdays                           v3.0.0 ]
                     ******************************************************/
                    'BDAY_MONTH' => ($bday_month != 0) ? $bday_month : $lang['Default_Month'],
                    'BDAY_DAY' => ($bday_day != 0) ? $bday_day : $lang['Default_Day'],
                    'BDAY_YEAR' => ($bday_year != 0) ? $bday_year : $lang['Default_Year'],
                    'BIRTHDAY_ALL' => BIRTHDAY_ALL,
                    'BIRTHDAY_ALL_SELECTED' => ( $birthday_display == BIRTHDAY_ALL ) ? ' selected="selected"' : '',
                    'BIRTHDAY_DATE' => BIRTHDAY_DATE,
                    'BIRTHDAY_DATE_SELECTED' => ( $birthday_display == BIRTHDAY_DATE ) ? ' selected="selected"' : '',
                    'BIRTHDAY_AGE' => BIRTHDAY_AGE,
                    'BIRTHDAY_AGE_SELECTED' => ( $birthday_display == BIRTHDAY_AGE ) ? ' selected="selected"' : '',
                    'BIRTHDAY_NONE' => BIRTHDAY_NONE,
                    'BIRTHDAY_NONE_SELECTED' => ( $birthday_display == BIRTHDAY_NONE ) ? ' selected="selected"' : '',
                    'BDAY_NONE_ENABLED' => ( $birthday_greeting ) ? '' : ' checked="checked"',
                    'BDAY_EMAIL' => BIRTHDAY_EMAIL,
                    'BDAY_EMAIL_ENABLED' => ( $birthday_greeting == BIRTHDAY_EMAIL ) ? ' checked="checked"' : '',
                    'BDAY_PM' => BIRTHDAY_PM,
                    'BDAY_PM_ENABLED' => ( $birthday_greeting == BIRTHDAY_PM ) ? ' checked="checked"' : '',
                    'BDAY_POPUP' => BIRTHDAY_POPUP,
                    'BDAY_POPUP_ENABLED' => ( $birthday_greeting == BIRTHDAY_POPUP ) ? ' checked="checked"' : '',
                    /*****[END]********************************************
                     [ Mod:    Birthdays                           v3.0.0 ]
                     ******************************************************/
                    'SIGNATURE' => str_replace('<br />', "\n", (string) $signature),
                    'VIEW_EMAIL_YES' => ($viewemail) ? 'checked="checked"' : '',
                    'VIEW_EMAIL_NO' => ($viewemail) ? '' : 'checked="checked"',
                    'HIDE_USER_YES' => ($allowviewonline) ? '' : 'checked="checked"',
                    'HIDE_USER_NO' => ($allowviewonline) ? 'checked="checked"' : '',
                    'NOTIFY_PM_YES' => ($notifypm) ? 'checked="checked"' : '',
                    'NOTIFY_PM_NO' => ($notifypm) ? '' : 'checked="checked"',
                    'POPUP_PM_YES' => ($popuppm) ? 'checked="checked"' : '',
                    'POPUP_PM_NO' => ($popuppm) ? '' : 'checked="checked"',
                    'ALWAYS_ADD_SIGNATURE_YES' => ($attachsig) ? 'checked="checked"' : '',
                    'ALWAYS_ADD_SIGNATURE_NO' => ($attachsig) ? '' : 'checked="checked"',
                    'NOTIFY_REPLY_YES' => ( $notifyreply ) ? 'checked="checked"' : '',
                    'NOTIFY_REPLY_NO' => ( $notifyreply ) ? '' : 'checked="checked"',
                    'ALWAYS_ALLOW_BBCODE_YES' => ($allowbbcode) ? 'checked="checked"' : '',
                    'ALWAYS_ALLOW_BBCODE_NO' => ($allowbbcode) ? '' : 'checked="checked"',
                    'ALWAYS_ALLOW_HTML_YES' => ($allowhtml) ? 'checked="checked"' : '',
                    'ALWAYS_ALLOW_HTML_NO' => ($allowhtml) ? '' : 'checked="checked"',
                    'ALWAYS_ALLOW_SMILIES_YES' => ($allowsmilies) ? 'checked="checked"' : '',
                    'ALWAYS_ALLOW_SMILIES_NO' => ($allowsmilies) ? '' : 'checked="checked"',
                    /*****[BEGIN]******************************************
                     [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
                     ******************************************************/
                    'SHOW_AVATARS_YES' => ($showavatars) ? 'checked="checked"' : '',
                    'SHOW_AVATARS_NO' => ($showavatars) ? '' : 'checked="checked"',
                    'SHOW_SIGNATURES_YES' => ($showsignatures) ? 'checked="checked"' : '',
                    'SHOW_SIGNATURES_NO' => ($showsignatures) ? '' : 'checked="checked"',
                    /*****[END]********************************************
                     [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
                     ******************************************************/
                    'AVATAR' => $avatar,
                    /*****[BEGIN]******************************************
                     [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
                     ******************************************************/
                    'WRAP_ROW' => $user_wordwrap,
                    /*****[END]********************************************
                     [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
                     ******************************************************/
                    'LANGUAGE_SELECT' => language_select($user_lang, 'language', NUKE_MODULES_DIR.'Forums/language'),
                    /*****[BEGIN]******************************************
                     [ Mod:    Birthdays                           v3.0.0 ]
                     ******************************************************/
                    'BIRTHMONTH_SELECT' => bday_month_select($bday_month, 'bday_month'),
                    'BIRTHDAY_SELECT' => bday_day_select($bday_day, 'bday_day'),
                    'BIRTHYEAR_SELECT' => bday_year_select($bday_year, 'bday_year'),
                    /*****[END]********************************************
                     [ Mod:    Birthdays                           v3.0.0 ]
                     ******************************************************/
                    'TIMEZONE_SELECT' => tz_select($user_timezone),
                    /*****[END]********************************************
                     [ Mod:    Advanced Time Management            v2.2.0 ]
                     ******************************************************/
                    'TIME_MODE' => $time_mode,
                    'TIME_MODE_MANUAL_CHECKED' => $time_mode_manual_checked = $time_mode_manual_checked ?? '',
                    'TIME_MODE_MANUAL_DST_CHECKED' => $time_mode_manual_dst_checked = $time_mode_manual_dst_checked ?? '',
                    'TIME_MODE_SERVER_SWITCH_CHECKED' => $time_mode_server_switch_checked = $time_mode_server_switch_checked ?? '',
                    'TIME_MODE_FULL_SERVER_CHECKED' => $time_mode_full_server_checked = $time_mode_full_server_checked ?? '',
                    'TIME_MODE_SERVER_PC_CHECKED' => $time_mode_server_pc_checked = $time_mode_server_pc_checked ?? '',
                    'TIME_MODE_FULL_PC_CHECKED' => $time_mode_full_pc_checked = $time_mode_full_pc_checked ?? '',
                    'DST_TIME_LAG' => $dst_time_lag,
                    /*****[BEGIN]******************************************
                     [ Mod:    Advanced Time Management            v2.2.0 ]
                     ******************************************************/
                    /*****[BEGIN]******************************************
                     [ Base:    Theme Management                   v1.0.2 ]
                     ******************************************************/
                    'STYLE_SELECT' => GetThemeSelect('theme', 'active', $this_userdata),
                    /*****[END]********************************************
                     [ Base:    Theme Management                   v1.0.2 ]
                     ******************************************************/
                    'DATE_FORMAT' => $user_dateformat,
                    /*****[BEGIN]******************************************
                     [ Mod:     Super Quick Reply                  v1.3.2 ]
                     ******************************************************/
                    'QUICK_REPLY_SELECT' => quick_reply_select($user_show_quickreply, 'show_quickreply'),
                    'QUICK_REPLY_MODE_BASIC' => ( $user_quickreply_mode==0 ) ? 'checked="checked"' : '',
                    'QUICK_REPLY_MODE_ADVANCED' => ( $user_quickreply_mode != 0 ) ? 'checked="checked"' : '',
                    'OPEN_QUICK_REPLY_YES' => ( $user_open_quickreply ) ? 'checked="checked"' : '',
                    'OPEN_QUICK_REPLY_NO' => ( $user_open_quickreply ) ? '' : 'checked="checked"',
                    /*****[END]********************************************
                     [ Mod:     Super Quick Reply                  v1.3.2 ]
                     ******************************************************/
                    'ALLOW_PM_YES' => ($user_allowpm) ? 'checked="checked"' : '',
                    'ALLOW_PM_NO' => ($user_allowpm) ? '' : 'checked="checked"',
                    'ALLOW_AVATAR_YES' => ($user_allowavatar) ? 'checked="checked"' : '',
                    'ALLOW_AVATAR_NO' => ($user_allowavatar) ? '' : 'checked="checked"',
                    'USER_ACTIVE_YES' => ($user_status) ? 'checked="checked"' : '',
                    'USER_ACTIVE_NO' => ($user_status) ? '' : 'checked="checked"',
                    /*****[BEGIN]******************************************
                     [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
                     ******************************************************/
                    'RANK1_SELECT_BOX' => $rank1_select_box,
                    'RANK2_SELECT_BOX' => $rank2_select_box,
                    'RANK3_SELECT_BOX' => $rank3_select_box,
                    'RANK4_SELECT_BOX' => $rank4_select_box,
                    'RANK5_SELECT_BOX' => $rank5_select_box,
                    /*****[END]********************************************
                     [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
                     ******************************************************/
                    /*****[BEGIN]******************************************
                     [ Mod:    Admin User Notes                    v1.0.0 ]
                     ******************************************************/
                    'ADMIN_NOTES' => $admin_notes,
                    'L_ADMIN_NOTES' =>  $lang['Admin_notes'],
                    /*****[END]********************************************
                     [ Mod:    Admin User Notes                    v1.0.0 ]
                     ******************************************************/
                    'L_USERNAME' => $lang['Username'],
                    'L_USER_TITLE' => $lang['User_admin'],
                    'L_USER_EXPLAIN' => $lang['User_admin_explain'],
                    'L_NEW_PASSWORD' => $lang['New_password'],
                    'L_PASSWORD_IF_CHANGED' => $lang['password_if_changed'],
                    'L_CONFIRM_PASSWORD' => $lang['Confirm_password'],
                    'L_PASSWORD_CONFIRM_IF_CHANGED' => $lang['password_confirm_if_changed'],
                    'L_SUBMIT' => $lang['Submit'],
                    'L_RESET' => $lang['Reset'],
                    'L_REQUIRED' => $lang['Required'],
                    /*****[BEGIN]******************************************
                     [ Mod:    Birthdays                           v3.0.0 ]
                     ******************************************************/
                    'L_CLEAR' => $lang['Clear'],
                    'L_BIRTHDAY' => $lang['Birthday'],
                    'L_MONTH' => $lang['Month'],
                    'L_DAY' => $lang['Day'],
                    'L_YEAR' => ( $board_config['bday_year'] ) ? $lang['Year'] : $lang['Year_Optional'],
                    'L_OPTIONAL' => ( $board_config['bday_year'] ) ? '' : $lang['Optional'],
                    'L_BIRTHDAY_DISPLAY' => $lang['Birthday_Display'],
                    'L_BIRTHDAY_ALL' => $lang['Display_all'],
                    'L_BIRTHDAY_YEAR' => $lang['Display_day_and_month'],
                    'L_BIRTHDAY_AGE' => $lang['Display_age'],
                    'L_BIRTHDAY_NONE' => $lang['Display_nothing'],
                    'L_BDAY_SEND_GREETING' => $lang['bday_send_greeting'],
                    'L_BDAY_SEND_GREETING_EXPLAIN' => $lang['bday_send_greeting_user_explain'],
                    'L_NONE' => $lang['Do_not_send'],
                    'L_EMAIL' => $lang['Email'],
                    'L_PM' => $lang['PM'],
                    'L_POPUP' => $lang['Popup'],
                    /*****[END]********************************************
                     [ Mod:    Birthdays                           v3.0.0 ]
                     ******************************************************/
                    /*****[BEGIN]******************************************
                     [ Mod:     Users Reputations Systems          v1.0.0 ]
                     ******************************************************/
                    'L_REPUTATION' => $lang['Reputation'],
                    /*****[END]********************************************
                     [ Mod:     Users Reputations System           v1.0.0 ]
                     ******************************************************/
                    'L_WEBSITE' => $lang['Website'],
                    'L_FACEBOOK' => $lang['FACEBOOK'] = $lang['FACEBOOK'] ?? 'Facebook',
                    'L_LOCATION' => $lang['Location'],
                    'L_OCCUPATION' => $lang['Occupation'],
                    /*****[BEGIN]******************************************
                     [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
                     ******************************************************/
                    'L_WORD_WRAP' => $lang['Word_Wrap'],
                    'L_WORD_WRAP_EXPLAIN' => $lang['Word_Wrap_Explain'],
                    'L_WORD_WRAP_EXTRA' => strtr($lang['Word_Wrap_Extra'],['%min%' => $board_config['wrap_min'], '%max%' => $board_config['wrap_max']]),
                    /*****[END]********************************************
                     [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
                     ******************************************************/
                    'L_BOARD_LANGUAGE' => $lang['Board_lang'],
                    'L_BOARD_STYLE' => $lang['theme'],
                    'L_TIMEZONE' => $lang['Timezone'],
                    /*****[BEGIN]******************************************
                     [ Mod:    Advanced Time Management            v2.2.0 ]
                     ******************************************************/
                    'L_TIME_MODE' => $lang['time_mode'],
                    'L_TIME_MODE_TEXT' => $lang['time_mode_text'],
                    'L_TIME_MODE_MANUAL' => $lang['time_mode_manual'],
                    'L_TIME_MODE_DST' => $lang['time_mode_dst'],
                    'L_TIME_MODE_DST_OFF' => $l_time_mode_0,
                    'L_TIME_MODE_DST_ON' => $l_time_mode_1,
                    'L_TIME_MODE_DST_SERVER' => $l_time_mode_2,
                    'L_TIME_MODE_DST_TIME_LAG' => $lang['time_mode_dst_time_lag'],
                    'L_TIME_MODE_DST_MN' => $lang['time_mode_dst_mn'],
                    'L_TIME_MODE_TIMEZONE' => $lang['time_mode_timezone'],
                    'L_TIME_MODE_AUTO' => $lang['time_mode_auto'],
                    'L_TIME_MODE_FULL_SERVER' => $l_time_mode_3,
                    'L_TIME_MODE_SERVER_PC' => $l_time_mode_4,
                    'L_TIME_MODE_FULL_PC' => $l_time_mode_6,
                    /*****[END]********************************************
                     [ Mod:    Advanced Time Management            v2.2.0 ]
                     ******************************************************/
                    'L_DATE_FORMAT' => $lang['Date_format'],
                    'L_DATE_FORMAT_EXPLAIN' => $lang['Date_format_explain'],
                    /*****[BEGIN]******************************************
                     [ Mod:     Super Quick Reply                  v1.3.2 ]
                     ******************************************************/
                    'L_QUICK_REPLY_PANEL' => $lang['Quick_reply_panel'],
                    'L_SHOW_QUICK_REPLY' => $lang['Show_quick_reply'],
                    'L_QUICK_REPLY_MODE' => $lang['Quick_reply_mode'],
                    'L_QUICK_REPLY_MODE_BASIC' => $lang['Quick_reply_mode_basic'],
                    'L_QUICK_REPLY_MODE_ADVANCED' => $lang['Quick_reply_mode_advanced'],
                    'L_OPEN_QUICK_REPLY' => $lang['Open_quick_reply'],
                    /*****[END]********************************************
                     [ Mod:     Super Quick Reply                  v1.3.2 ]
                     ******************************************************/
                    'L_YES' => $lang['Yes'],
                    'L_NO' => $lang['No'],
                    'L_INTERESTS' => $lang['Interests'],
                    /*****[BEGIN]******************************************
                     [ Mod:    Gender                              v1.2.6 ]
                     ******************************************************/
                    'L_GENDER' =>$lang['Gender'],
                    'L_GENDER_MALE' =>$lang['Male'],
                    'L_GENDER_FEMALE' =>$lang['Female'],
                    'L_GENDER_NOT_SPECIFY' =>$lang['No_gender_specify'],
                    /*****[END]********************************************
                     [ Mod:    Gender                              v1.2.6 ]
                     ******************************************************/
                    'L_ALWAYS_ALLOW_SMILIES' => $lang['Always_smile'],
                    /*****[BEGIN]******************************************
                     [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
                     ******************************************************/
                    'L_SHOW_AVATARS' => $lang['Show_avatars'],
                    'L_SHOW_SIGNATURES' => $lang['Show_signatures'],
                    /*****[END]********************************************
                     [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
                     ******************************************************/
                    'L_ALWAYS_ALLOW_BBCODE' => $lang['Always_bbcode'],
                    'L_ALWAYS_ALLOW_HTML' => $lang['Always_html'],
                    'L_HIDE_USER' => $lang['Hide_user'],
                    'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],
                    'L_SPECIAL' => $lang['User_special'],
                    'L_SPECIAL_EXPLAIN' => $lang['User_special_explain'],
                    'L_USER_ACTIVE' => $lang['User_status'],
                    'L_ALLOW_PM' => $lang['User_allowpm'],
                    'L_ALLOW_AVATAR' => $lang['User_allowavatar'],
                    'L_AVATAR_PANEL' => $lang['Avatar_panel'],
                    'L_AVATAR_EXPLAIN' => $lang['Admin_avatar_explain'],
                    'L_DELETE_AVATAR' => $lang['Delete_Image'],
                    'L_CURRENT_IMAGE' => $lang['Current_Image'],
                    'L_UPLOAD_AVATAR_FILE' => $lang['Upload_Avatar_file'],
                    'L_UPLOAD_AVATAR_URL' => $lang['Upload_Avatar_URL'],
                    'L_AVATAR_GALLERY' => $lang['Select_from_gallery'],
                    'L_SHOW_GALLERY' => $lang['View_avatar_gallery'],
                    'L_LINK_REMOTE_AVATAR' => $lang['Link_remote_Avatar'],
                    'L_SIGNATURE' => $lang['Signature'],
                    'L_SIGNATURE_EXPLAIN' => sprintf($lang['Signature_explain'], $board_config['max_sig_chars'] ),
                    'L_NOTIFY_ON_PRIVMSG' => $lang['Notify_on_privmsg'],
                    'L_NOTIFY_ON_REPLY' => $lang['Always_notify'],
                    'L_POPUP_ON_PRIVMSG' => $lang['Popup_on_privmsg'],
                    'L_PREFERENCES' => $lang['Preferences'],
                    'L_PUBLIC_VIEW_EMAIL' => $lang['Public_view_email'],
                    'L_ITEMS_REQUIRED' => $lang['Items_required'],
                    'L_REGISTRATION_INFO' => $lang['Registration_info'],
                    'L_PROFILE_INFO' => $lang['Profile_info'],
                    'L_PROFILE_INFO_NOTICE' => $lang['Profile_info_warn'],
                    'L_EMAIL_ADDRESS' => $lang['Email_address'],
                    'S_FORM_ENCTYPE' => $form_enctype,
                    'HTML_STATUS' => $html_status,
                    'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="../' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
                    'SMILIES_STATUS' => $smilies_status,
                    'L_DELETE_USER' => $lang['User_delete'],
                    'L_DELETE_USER_EXPLAIN' => $lang['User_delete_explain'],
                    /*****[BEGIN]******************************************
                     [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
                     ******************************************************/
                    'L_SELECT_RANK1' => $lang['Rank1_title'],
                    'L_SELECT_RANK2' => $lang['Rank2_title'],
                    'L_SELECT_RANK3' => $lang['Rank3_title'],
                    'L_SELECT_RANK4' => $lang['Rank4_title'],
                    'L_SELECT_RANK5' => $lang['Rank5_title'],
                    /*****[END]********************************************
                     [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
                     ******************************************************/
                    'S_HIDDEN_FIELDS' => $s_hidden_fields,
                    'S_PROFILE_ACTION' => append_sid("admin_users.$phpEx"),
                ]
                );
				
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				$block = ( $board_config['bday_require'] == TRUE ) ? 'birthday_required' : 'birthday_optional';
				$template->assign_block_vars($block, []);
				$template->birthday_interface();
		
				if ( $board_config['bday_greeting'] != 0 )
				{
					$template->assign_block_vars('birthdays_greeting',[]);
					if (($board_config['bday_greeting'] & (1<<(BIRTHDAY_EMAIL-1))) !== 0)
					{
						$template->assign_block_vars('birthdays_greeting.birthdays_email',[]);
					}
					if (($board_config['bday_greeting'] & (1<<(BIRTHDAY_PM-1))) !== 0)
					{
							$template->assign_block_vars('birthdays_greeting.birthdays_pm',[]);
					}
					if (($board_config['bday_greeting'] & (1<<(BIRTHDAY_POPUP-1))) !== 0)
					{
						$template->assign_block_vars('birthdays_greeting.birthdays_popup',[]);
					}
				}
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

                if( file_exists(phpbb_realpath('./../' . $board_config['avatar_path'])) && ($board_config['allow_avatar_upload'] == TRUE) )
                {
                        if ( $form_enctype != '' )
                        {
                                $template->assign_block_vars('avatar_local_upload', [] );
                        }
                        $template->assign_block_vars('avatar_remote_upload', [] );
                }

                if( file_exists(phpbb_realpath('./../' . $board_config['avatar_gallery_path'])) && ($board_config['allow_avatar_local'] == TRUE) )
                {
                        $template->assign_block_vars('avatar_local_gallery', [] );
                }

                if( $board_config['allow_avatar_remote'] == TRUE )
                {
                        $template->assign_block_vars('avatar_remote_link', [] );
                }
        }

        $template->pparse('body');
}
else
{
        //
        // Default user selection box
        //
        $template->set_filenames(['body' => 'admin/user_select_body.tpl']
        );

        $template->assign_vars(['L_USER_TITLE' => $lang['User_admin'], 
		                        'L_USER_EXPLAIN' => $lang['User_admin_explain'], 
								'L_USER_SELECT' => $lang['Select_a_User'], 
								'L_LOOK_UP' => $lang['Look_up_user'], 
								'L_FIND_USERNAME' => $lang['Find_username'], 
								'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser&popup=1&menu=1"), 
								'S_USER_ACTION' => append_sid("admin_users.$phpEx"), 
								'S_USER_SELECT' => $select_list = $select_list ?? '']
        );
        $template->pparse('body');

}

include(__DIR__ . '/page_footer_admin.'.$phpEx);

?>
