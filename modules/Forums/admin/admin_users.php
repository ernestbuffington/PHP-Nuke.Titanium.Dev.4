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
 ************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $module['Users']['Manage'] = $filename;

        return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require("../../../includes/bbcode.php");
require("../../../includes/functions_post.php");
require("../../../includes/functions_selects.php");
require("../../../includes/functions_validate.php");

/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_adv_time.' . $phpEx)) )
{
    include_once($phpbb_root_path . 'language/lang_english/lang_adv_time.' . $phpEx);
} else
{
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_adv_time.' . $phpEx);
}
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/

$html_entities_match = array('#<#', '#>#');
$html_entities_replace = array('&lt;', '&gt;');

//
// Set mode
//
if( isset( $HTTP_POST_VARS['mode'] ) || isset( $HTTP_GET_VARS['mode'] ) )
{
        $mode = ( isset( $HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
        $mode = htmlspecialchars($mode);
}
else
{
        $mode = '';
}

//
// Begin program
//
if ( $mode == 'edit' || $mode == 'save' && ( isset($HTTP_POST_VARS['username']) || isset($HTTP_GET_VARS[POST_USERS_URL]) || isset( $HTTP_POST_VARS[POST_USERS_URL]) ) )
{
/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
      attachment_quota_settings('user', $HTTP_POST_VARS['submit'], $mode);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
        //
        // Ok, the profile has been modified and submitted, let's update
        //
        if ( ( $mode == 'save' && isset( $HTTP_POST_VARS['submit'] ) ) || isset( $HTTP_POST_VARS['avatargallery'] ) || isset( $HTTP_POST_VARS['submitavatar'] ) || isset( $HTTP_POST_VARS['cancelavatar'] ) )
        {
                $user_id = intval($HTTP_POST_VARS['id']);

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

        if( $HTTP_POST_VARS['deleteuser'] && ( $userdata['user_id'] != $user_id ) )
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
                                SET poster_id = " . DELETED . ", post_username = '" . str_replace("\\'", "''", addslashes($this_userdata['username'])) . "'
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

                        if (intval($row['group_id']) > 0)
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

                        if ( count($mark_list) )
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

                $username = ( !empty($HTTP_POST_VARS['username']) ) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';
                $email = ( !empty($HTTP_POST_VARS['email']) ) ? trim(strip_tags(htmlspecialchars( $HTTP_POST_VARS['email'] ) )) : '';

                $password = ( !empty($HTTP_POST_VARS['password']) ) ? trim(strip_tags(htmlspecialchars( $HTTP_POST_VARS['password'] ) )) : '';
                $password_confirm = ( !empty($HTTP_POST_VARS['password_confirm']) ) ? trim(strip_tags(htmlspecialchars( $HTTP_POST_VARS['password_confirm'] ) )) : '';

/*****[BEGIN]******************************************
 [ Mod:  Birthdays                             v3.0.0 ]
 ******************************************************/
				$bday_year = ( !empty($HTTP_POST_VARS['bday_year']) ) ? $HTTP_POST_VARS['bday_year'] : 0;
				$bday_month = ( !empty($HTTP_POST_VARS['bday_month']) ) ? $HTTP_POST_VARS['bday_month'] : 0;
				$bday_day = ( !empty($HTTP_POST_VARS['bday_day']) ) ? $HTTP_POST_VARS['bday_day'] : 0;
		
				$birthday_display = ( isset($HTTP_POST_VARS['birthday_display']) ) ? intval($HTTP_POST_VARS['birthday_display']) : 0;
				$birthday_greeting = ( isset($HTTP_POST_VARS['bday_greeting']) ) ? $HTTP_POST_VARS['bday_greeting'] : 0;
/*****[END]********************************************
 [ Mod:  Birthdays                             v3.0.0 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                $reputation = ( !empty($HTTP_POST_VARS['reputation']) ) ? trim(strip_tags( $HTTP_POST_VARS['reputation'] ) ) : 0;
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
				$facebook = ( !empty($HTTP_POST_VARS['facebook']) ) ? trim(strip_tags( $HTTP_POST_VARS['facebook'] ) ) : '';
                $website = ( !empty($HTTP_POST_VARS['website']) ) ? trim(strip_tags( $HTTP_POST_VARS['website'] ) ) : '';
                $location = ( !empty($HTTP_POST_VARS['location']) ) ? trim(strip_tags( $HTTP_POST_VARS['location'] ) ) : '';
                $occupation = ( !empty($HTTP_POST_VARS['occupation']) ) ? trim(strip_tags( $HTTP_POST_VARS['occupation'] ) ) : '';
                $interests = ( !empty($HTTP_POST_VARS['interests']) ) ? trim(strip_tags( $HTTP_POST_VARS['interests'] ) ) : '';
/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
                $gender = ( isset($HTTP_POST_VARS['gender']) ) ? intval ($HTTP_POST_VARS['gender']) : 0;
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
                $glance_show = ( !empty($HTTP_POST_VARS['glance_show']) ) ? trim(strip_tags( $HTTP_POST_VARS['glance_show'] ) ) : '';
/*****[END]********************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
                $user_posts = ( !empty($HTTP_POST_VARS['user_posts']) ) ? trim(strip_tags( $HTTP_POST_VARS['user_posts'] ) ) : 0;
/*****[END]********************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
 /*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
                $hide_images = ( !empty($HTTP_POST_VARS['hide_images']) ) ? trim(strip_tags( $HTTP_POST_VARS['hide_images'] ) ) : 0;
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
                $signature = ( !empty($HTTP_POST_VARS['signature']) ) ? trim(str_replace('<br />', "\n", $HTTP_POST_VARS['signature'] ) ) : '';
/*****[BEGIN]******************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
                $user_admin_notes = ( !empty($HTTP_POST_VARS['user_admin_notes']) ) ? trim(str_replace('<br />', "\n", $HTTP_POST_VARS['user_admin_notes'] ) ) : '';
/*****[END]********************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                $xdata = array();
                $xd_meta = get_xd_metadata();
                foreach ($xd_meta as $name => $info)
                {
                    if ( !empty($HTTP_POST_VARS[$name]) && $info['handle_input'] )
                    {
                        $xdata[$name] = trim(str_replace('<br />', "\n", $HTTP_POST_VARS[$name] ) );
                    }
                }
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

                validate_optional_fields($website, $location, $occupation, $interests, $signature, $facebook);

                $viewemail = ( isset( $HTTP_POST_VARS['viewemail']) ) ? ( ( $HTTP_POST_VARS['viewemail'] ) ? TRUE : 0 ) : 0;
                $allowviewonline = ( isset( $HTTP_POST_VARS['hideonline']) ) ? ( ( $HTTP_POST_VARS['hideonline'] ) ? 0 : TRUE ) : TRUE;
                $notifyreply = ( isset( $HTTP_POST_VARS['notifyreply']) ) ? ( ( $HTTP_POST_VARS['notifyreply'] ) ? TRUE : 0 ) : 0;
                $notifypm = ( isset( $HTTP_POST_VARS['notifypm']) ) ? ( ( $HTTP_POST_VARS['notifypm'] ) ? TRUE : 0 ) : TRUE;
                $popuppm = ( isset( $HTTP_POST_VARS['popup_pm']) ) ? ( ( $HTTP_POST_VARS['popup_pm'] ) ? TRUE : 0 ) : TRUE;
                $attachsig = ( isset( $HTTP_POST_VARS['attachsig']) ) ? ( ( $HTTP_POST_VARS['attachsig'] ) ? TRUE : 0 ) : 0;

                $allowhtml = ( isset( $HTTP_POST_VARS['allowhtml']) ) ? intval( $HTTP_POST_VARS['allowhtml'] ) : $board_config['allow_html'];
                $allowbbcode = ( isset( $HTTP_POST_VARS['allowbbcode']) ) ? intval( $HTTP_POST_VARS['allowbbcode'] ) : $board_config['allow_bbcode'];
                $allowsmilies = ( isset( $HTTP_POST_VARS['allowsmilies']) ) ? intval( $HTTP_POST_VARS['allowsmilies'] ) : $board_config['allow_smilies'];
/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
                $showavatars = ( isset( $HTTP_POST_VARS['showavatars']) ) ? intval( $HTTP_POST_VARS['showavatars'] ) : $board_config['showavatars'];
                $showsignatures = ( isset( $HTTP_POST_VARS['showsignatures']) ) ? intval( $HTTP_POST_VARS['showsignatures'] ) : $board_config['showsignatures'];
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/

                $user_style = ( $HTTP_POST_VARS['theme'] ) ?  $HTTP_POST_VARS['theme'] : '';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
                $user_wordwrap = ( $HTTP_POST_VARS['user_wordwrap'] ) ? intval( $HTTP_POST_VARS['user_wordwrap'] ) : $board_config['wrap_def'];
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
                $user_lang = ( $HTTP_POST_VARS['language'] ) ? $HTTP_POST_VARS['language'] : $board_config['default_lang'];
                $user_timezone = ( isset( $HTTP_POST_VARS['timezone']) ) ? doubleval( $HTTP_POST_VARS['timezone'] ) : $board_config['board_timezone'];
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
				$user_flag = ( !empty($HTTP_POST_VARS['user_flag']) ) ? $HTTP_POST_VARS['user_flag'] : '' ;
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                $time_mode = ( isset($HTTP_POST_VARS['time_mode']) ) ? intval($HTTP_POST_VARS['time_mode']) : $board_config['default_time_mode'];
                if ( !preg_match("/[^0-9]/i",$HTTP_POST_VARS['dst_time_lag']) )
                {
                    $dst_time_lag = ( isset($HTTP_POST_VARS['dst_time_lag']) ) ? intval($HTTP_POST_VARS['dst_time_lag']) : $board_config['default_dst_time_lag'];
                }
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                $user_template = ( $HTTP_POST_VARS['template'] ) ? $HTTP_POST_VARS['template'] : $board_config['board_template'];
                $user_dateformat = ( $HTTP_POST_VARS['dateformat'] ) ? trim( $HTTP_POST_VARS['dateformat'] ) : $board_config['default_dateformat'];

/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
                $user_show_quickreply = ( isset( $HTTP_POST_VARS['show_quickreply'] ) ) ? intval( $HTTP_POST_VARS['show_quickreply'] ) : 1;
                $user_quickreply_mode = ( isset( $HTTP_POST_VARS['quickreply_mode'] ) ) ? ( ( $HTTP_POST_VARS['quickreply_mode'] ) ? TRUE : 0 ) : TRUE;
                $user_open_quickreply = ( isset( $HTTP_POST_VARS['open_quickreply'] ) ) ? ( ( $HTTP_POST_VARS['open_quickreply'] ) ? TRUE : 0 ) : TRUE;
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

                $user_avatar_local = ( isset( $HTTP_POST_VARS['avatarselect'] ) && !empty($HTTP_POST_VARS['submitavatar'] ) && $board_config['allow_avatar_local'] ) ? $HTTP_POST_VARS['avatarselect'] : ( ( isset( $HTTP_POST_VARS['avatarlocal'] )  ) ? $HTTP_POST_VARS['avatarlocal'] : '' );
                $user_avatar_category = ( isset($HTTP_POST_VARS['avatarcatname']) && $board_config['allow_avatar_local'] ) ? htmlspecialchars($HTTP_POST_VARS['avatarcatname']) : '' ;

                $user_avatar_remoteurl = ( !empty($HTTP_POST_VARS['avatarremoteurl']) ) ? trim( $HTTP_POST_VARS['avatarremoteurl'] ) : '';
                $user_avatar_url = ( !empty($HTTP_POST_VARS['avatarurl']) ) ? trim( $HTTP_POST_VARS['avatarurl'] ) : '';
                $user_avatar_loc = ( $HTTP_POST_FILES['avatar']['tmp_name'] != "none") ? $HTTP_POST_FILES['avatar']['tmp_name'] : '';
                $user_avatar_name = ( !empty($HTTP_POST_FILES['avatar']['name']) ) ? $HTTP_POST_FILES['avatar']['name'] : '';
                $user_avatar_size = ( !empty($HTTP_POST_FILES['avatar']['size']) ) ? $HTTP_POST_FILES['avatar']['size'] : 0;
                $user_avatar_filetype = ( !empty($HTTP_POST_FILES['avatar']['type']) ) ? $HTTP_POST_FILES['avatar']['type'] : '';

                $user_avatar = ( empty($user_avatar_loc) ) ? $this_userdata['user_avatar'] : '';
                $user_avatar_type = ( empty($user_avatar_loc) ) ? $this_userdata['user_avatar_type'] : '';

                $user_status = ( !empty($HTTP_POST_VARS['user_status']) ) ? intval( $HTTP_POST_VARS['user_status'] ) : 0;
                $user_allowpm = ( !empty($HTTP_POST_VARS['user_allowpm']) ) ? intval( $HTTP_POST_VARS['user_allowpm'] ) : 0;

                $user_rank = ( !empty($HTTP_POST_VARS['user_rank']) ) ? intval( $HTTP_POST_VARS['user_rank'] ) : 0;
/*****[BEGIN]******************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
				$user_rank2 = ( !empty($HTTP_POST_VARS['user_rank2']) ) ? intval( $HTTP_POST_VARS['user_rank2'] ) : 0;
				$user_rank3 = ( !empty($HTTP_POST_VARS['user_rank3']) ) ? intval( $HTTP_POST_VARS['user_rank3'] ) : 0;
				$user_rank4 = ( !empty($HTTP_POST_VARS['user_rank4']) ) ? intval( $HTTP_POST_VARS['user_rank4'] ) : 0;
				$user_rank5 = ( !empty($HTTP_POST_VARS['user_rank5']) ) ? intval( $HTTP_POST_VARS['user_rank5'] ) : 0;
/*****[END]********************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
                $user_allowavatar = ( !empty($HTTP_POST_VARS['user_allowavatar']) ) ? intval( $HTTP_POST_VARS['user_allowavatar'] ) : 0;

                if( isset( $HTTP_POST_VARS['avatargallery'] ) || isset( $HTTP_POST_VARS['submitavatar'] ) || isset( $HTTP_POST_VARS['cancelavatar'] ) )
                {
                        $username = stripslashes($username);
                        $email = stripslashes($email);
                        $password = '';
                        $password_confirm = '';
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                        $reputation = intval(stripslashes($reputation));
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
                        $user_posts = intval(stripslashes($user_posts));
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
                        $func = create_function('$a', 'return htmlspecialchars(stripslashes($a));');
                        $xdata = array_map($func, $xdata);
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

                        $user_lang = stripslashes($user_lang);
                        $user_dateformat = htmlspecialchars(stripslashes($user_dateformat));

                        if ( !isset($HTTP_POST_VARS['cancelavatar']))
                        {
                                $user_avatar = $user_avatar_category . '/' . $user_avatar_local;
                                $user_avatar_type = USER_AVATAR_GALLERY;
                        }
                }
        }

        if( isset( $HTTP_POST_VARS['submit'] ) )
        {
                include("../../../includes/usercp_avatar.php");

                $error = FALSE;

                if (stripslashes($username) != $this_userdata['username'])
                {
                        unset($rename_user);

                        if ( stripslashes(strtolower($username)) != strtolower($this_userdata['username']) )
                        {
                                $result = validate_username($username);
                                if ( $result['error'] )
                                {
                                        $error = TRUE;
                                        $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
                                }
                                else if ( strtolower(str_replace("\\'", "''", $username)) == strtolower($userdata['username']) )
                                {
                                        $error = TRUE;
                                        $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Username_taken'];
                                }
                        }

                        if (!$error)
                        {
                                $username_sql = "username = '" . str_replace("\\'", "''", $username) . "', ";
                                $rename_user = $username; // Used for renaming usergroup
                        }
                }

                $passwd_sql = '';
                if( !empty($password) && !empty($password_confirm) )
                {
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
                                $password = md5($password);
                                $passwd_sql = "user_password = '$password', ";
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                        }
                }
                else if( $password && !$password_confirm )
                {
                        $error = TRUE;
                        $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
                }
                else if( !$password && $password_confirm )
                {
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
					case $board_config['bday_year'] && (($empty_month != $empty_day) || ($empty_day != $empty_year)):
					case !$board_config['bday_year'] && (($empty_month != $empty_day) || ($empty_day && !$empty_year)):
					case !@checkdate( $temp_month, $temp_day, $temp_year ) && (!$board_config['bday_lock'] || $userdata['user_birthday'] == 0):
						$error = TRUE;
						$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Birthday_invalid'];
				}
		
				$user_birthday = sprintf('%02d%02d%04d',$bday_month,$bday_day,$bday_year);
				$user_birthday2 = ( $birthday_display != BIRTHDAY_DATE && $birthday_display != BIRTHDAY_NONE && !$empty_month && !$empty_day && !$empty_year ) ? sprintf('%04d%02d%02d',$bday_year,$bday_month,$bday_day) : 'NULL';
		
				if ( $birthday_greeting && !( $board_config['bday_greeting'] & 1<<($birthday_greeting-1) ) )
				{
					$birthday_greeting = 0;
				}
/*****[END]********************************************
 [ Mod:  Birthdays                             v3.0.0 ]
 ******************************************************/

                if ($signature != '')
                {
                        $sig_length_check = preg_replace('/(\[.*?)(=.*?)\]/is', '\\1]', stripslashes($signature));
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
                if ( preg_match("/[^0-9]/i",$HTTP_POST_VARS['dst_time_lag']) || $dst_time_lag<0 || $dst_time_lag>120 )
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
                while ( list($code_name, $meta) = each($xd_meta) )
                {
                    if ( $meta['handle_input'] && ( ( $mode == 'register' && $meta['default_auth'] == XD_AUTH_ALLOW ) || xdata_auth($code_name, $userdata['user_id']) ) )
                    {
                        if ( ($meta['field_length'] > 0) && (strlen($xdata[$code_name]) > $meta['field_length']) )
                        {
                               $error = TRUE;
                            $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_too_long'], $meta['field_name']);
                        }

                        if ( ( count($meta['values_array']) > 0 ) && ( ! in_array($xdata[$code_name], $meta['values_array']) ) )
                        {
                               $error = TRUE;
                            $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
                        }

                        if ( ( strlen($meta['field_regexp']) > 0 ) && ( ! preg_match($meta['field_regexp'], $xdata[$code_name]) ) )
                        {
                            $error = TRUE;
                            $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
                        }

                        if ( $meta['allow_bbcode'] )
                        {
                            if ( $signature_bbcode_uid == '' )
                            {
                                $signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
                            }
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
                if( isset($HTTP_POST_VARS['avatardel']) )
                {
                        if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "" )
                        {
                                if( @file_exists(@phpbb_realpath('./../' . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])) )
					            {
               						@unlink('./../' . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar']);
                                }
                        }
                        $avatar_sql = ", user_avatar = '', user_avatar_type = " . USER_AVATAR_NONE;
                }
                else if( ( $user_avatar_loc != "" || !empty($user_avatar_url) ) && !$error )
                {
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

                        if( $user_avatar_loc != "" )
                        {
                                if( file_exists(@phpbb_realpath($user_avatar_loc)) && preg_match("/\.(jpg|gif|png)$/i", $user_avatar_name) )
                                {
                                        if( $user_avatar_size <= $board_config['avatar_filesize'] && $user_avatar_size > 0)
                                        {
                                                $error_type = false;

                                                //
                                                // Opera appends the image name after the type, not big, not clever!
                                                //
                                                preg_match("'image\/[x\-]*([a-z]+)'", $user_avatar_filetype, $user_avatar_filetype);
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
                                                                $error_msg = (!empty($error_msg)) ? $error_msg . "<br />" . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
                                                                break;
                                                }

                                                if( !$error )
                                                {
                                                        list($width, $height) = @getimagesize($user_avatar_loc);

                                                        if( $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
                                                        {
                                                                $user_id = $this_userdata['user_id'];

                                                                $avatar_filename = $user_id . $imgtype;

                                                                if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "" )
                                                                {
                                                                        if( @file_exists(@phpbb_realpath("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])) )
                                                                        {
                                                                                @unlink("./../" . $board_config['avatar_path'] . "/". $this_userdata['user_avatar']);
                                                                        }
                                                                }
                                                                @copy($user_avatar_loc, "./../" . $board_config['avatar_path'] . "/$avatar_filename");

                                                                $avatar_sql = ", user_avatar = '$avatar_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
                                                        }
                                                        else
                                                        {
                                                                $l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

                                                                $error = true;
                                                                $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
                                                        }
                                                }
                                        }
                                        else
                                        {
                                                $l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

                                                $error = true;
                                                $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
                                        }
                                }
                                else
                                {
                                        $error = true;
                                        $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
                                }
                        }
                        else if( !empty($user_avatar_url) )
                        {
                                //
                                // First check what port we should connect
                                // to, look for a :[xxxx]/ or, if that doesn't
                                // exist assume port 80 (http)
                                //
                                preg_match("/^(http:\/\/)?([\w\-\.]+)\:?([0-9]*)\/(.*)$/", $user_avatar_url, $url_ary);

                                if( !empty($url_ary[4]) )
                                {
                                        $port = (!empty($url_ary[3])) ? $url_ary[3] : 80;

                                        $fsock = @fsockopen($url_ary[2], $port, $errno, $errstr);
                                        if( $fsock )
                                        {
                                                $base_get = "/" . $url_ary[4];

                                                //
                                                // Uses HTTP 1.1, could use HTTP 1.0 ...
                                                //
                                                @fputs($fsock, "GET $base_get HTTP/1.1\r\n");
                                                @fputs($fsock, "HOST: " . $url_ary[2] . "\r\n");
                                                @fputs($fsock, "Connection: close\r\n\r\n");

                                                unset($avatar_data);
                                                while( !@feof($fsock) )
                                                {
                                                        $avatar_data .= @fread($fsock, $board_config['avatar_filesize']);
                                                }
                                                @fclose($fsock);

                                                if( preg_match("/Content-Length\: ([0-9]+)[^\/ ][\s]+/i", $avatar_data, $file_data1) && preg_match("/Content-Type\: image\/[x\-]*([a-z]+)[\s]+/i", $avatar_data, $file_data2) )
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
                                                                        $error_msg = (!empty($error_msg)) ? $error_msg . "<br />" . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
                                                                        break;
                                                        }

                                                        if( !$error && $file_size > 0 && $file_size < $board_config['avatar_filesize'] )
                                                        {
                                                                $avatar_data = substr($avatar_data, strlen($avatar_data) - $file_size, $file_size);

                                                                $tmp_filename = tempnam ("/tmp", $this_userdata['user_id'] . "-");
                                                                $fptr = @fopen($tmp_filename, "wb");
                                                                $bytes_written = @fwrite($fptr, $avatar_data, $file_size);
                                                                @fclose($fptr);

                                                                if( $bytes_written == $file_size )
                                                                {
                                                                        list($width, $height) = @getimagesize($tmp_filename);

                                                                        if( $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
                                                                        {
                                                                                $user_id = $this_userdata['user_id'];

                                                                                $avatar_filename = $user_id . $imgtype;

                                                                                if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "")
                                                                                {
                                                                                        if( file_exists(@phpbb_realpath("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])) )
                                                                                        {
                                                                                                @unlink("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar']);
                                                                                        }
                                                                                }
                                                                                @copy($tmp_filename, "./../" . $board_config['avatar_path'] . "/$avatar_filename");
                                                                                @unlink($tmp_filename);

                                                                                $avatar_sql = ", user_avatar = '$avatar_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
                                                                        }
                                                                        else
                                                                        {
                                                                                $l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

                                                                                $error = true;
                                                                                $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
                                                                        }
                                                                }
                                                                else
                                                                {
                                                                        //
                                                                        // Error writing file
                                                                        //
                                                                        @unlink($tmp_filename);
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
                                                        $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['File_no_data'] : $lang['File_no_data'];
                                                }
                                        }
                                        else
                                        {
                                                //
                                                // No connection
                                                //
                                                $error = true;
                                                $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['No_connection_URL'] : $lang['No_connection_URL'];
                                        }
                                }
                                else
                                {
                                        $error = true;
                                        $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['Incomplete_URL'] : $lang['Incomplete_URL'];
                                }
                        }
                        else if( !empty($user_avatar_name) )
                        {
                                $l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

                                $error = true;
                                $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
                        }
                }
                else 
				if( $user_avatar_remoteurl != "" && empty($avatar_sql) && !$error )
                {
                        if( !preg_match("#^http:\/\/#i", $user_avatar_remoteurl) )
                        {
                                $user_avatar_remoteurl = "http://" . $user_avatar_remoteurl;
                        }

                        if( preg_match("#^(http:\/\/[a-z0-9\-]+?\.([a-z0-9\-]+\.)*[a-z]+\/.*?\.(gif|jpg|png)$)#is", $user_avatar_remoteurl) )
                        {
                                $avatar_sql = ", user_avatar = '" . str_replace("\'", "''", $user_avatar_remoteurl) . "', user_avatar_type = " . USER_AVATAR_REMOTE;
                        }
                        else
                        {
                                $error = true;
                                $error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['Wrong_remote_avatar_format'] : $lang['Wrong_remote_avatar_format'];
                        }
                }
                else 
				if( $user_avatar_local != "" && empty($avatar_sql) && !$error )
                {
                        $avatar_sql = ", user_avatar = '" . str_replace("\'", "''", phpbb_ltrim(basename($user_avatar_category), "'") . '/' . phpbb_ltrim(basename($user_avatar_local), "'")) . "', user_avatar_type = " . USER_AVATAR_GALLERY;
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
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET " . $username_sql . $passwd_sql . "user_email = '" . str_replace("\'", "''", $email) . "', user_reputation = '" . str_replace("\'", "''", $reputation) . "', user_birthday = $user_birthday, user_birthday2 = $user_birthday2, birthday_display = $birthday_display, birthday_greeting = $birthday_greeting, user_website = '" . str_replace("\'", "''", $website) . "', user_occ = '" . str_replace("\'", "''", $occupation) . "', user_from = '" . str_replace("\'", "''", $location) . "', user_from_flag = '$user_flag', user_interests = '" . str_replace("\'", "''", $interests) . "', user_glance_show = '" . str_replace("\'", "''", $glance_show) . "', user_sig = '" . str_replace("\'", "''", $signature) . "', user_admin_notes = '" . str_replace("\'", "''", $user_admin_notes) . "', user_viewemail = $viewemail, user_facebook = '" . str_replace("\'", "''", $facebook) . "', user_attachsig = '$attachsig', user_sig_bbcode_uid = '$signature_bbcode_uid', user_allowsmile = '$allowsmilies', user_showavatars = '$showavatars', user_showsignatures = '$showsignatures', user_allowhtml = '$allowhtml', user_allowavatar = '$user_allowavatar', user_allowbbcode = '$allowbbcode', user_allow_viewonline = '$allowviewonline', user_notify = '$notifyreply', user_allow_pm = '$user_allowpm', user_notify_pm = '$notifypm', user_popup_pm = '$popuppm', user_wordwrap = '$user_wordwrap', user_lang = '" . str_replace("\'", "''", $user_lang) . "', theme = '$user_style', user_timezone = '$user_timezone', user_time_mode = '$time_mode', user_dst_time_lag = '$dst_time_lag', user_dateformat = '" . str_replace("\'", "''", $user_dateformat) . "', user_show_quickreply = '$user_show_quickreply', user_quickreply_mode = '$user_quickreply_mode', user_open_quickreply = $user_open_quickreply, user_active = '$user_status', user_hide_images = '$hide_images', user_rank = '$user_rank', user_rank2 = '$user_rank2', user_rank3 = '$user_rank3', user_rank4 = '$user_rank4', user_rank5 = '$user_rank5', user_gender = '$gender', user_posts='$user_posts'" . $avatar_sql . "
                                WHERE user_id = '$user_id'";
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
                        if( $result = $db->sql_query($sql) )
                        {
                                if( isset($rename_user) )
                                {
                                        $sql = "UPDATE " . GROUPS_TABLE . "
                                                SET group_name = '".str_replace("\'", "''", $rename_user)."'
                                                WHERE group_name = '".str_replace("'", "''", $this_userdata['username'] )."'";
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
                                while ( list($code_name, $meta) = each($xd_meta) )
                                {
                                    $xd_value = $xdata[$code_name];
                                    if ( ( in_array($xd_value, $meta['values_array']) || count($meta['values_array']) == 0 ) && $meta['handle_input'] )
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
                        $template->set_filenames(array(
                                'reg_header' => 'error_body.tpl')
                        );

                        $template->assign_vars(array(
                                'ERROR_MESSAGE' => $error_msg)
                        );

                        $template->assign_var_from_handle('ERROR_BOX', 'reg_header');

                        $username = htmlspecialchars(stripslashes($username));
                        $email = stripslashes($email);
                        $password = '';
                        $password_confirm = '';
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                        $reputation = intval($reputation);
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
/*****[END]**********77********************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
                        $user_posts = intval(stripslashes($user_posts));
/*****[END]**********77********************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
 /*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
                        $hide_images = stripslashes($hide_images);
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/

                        $signature = htmlspecialchars(stripslashes($signature));

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                        $func = create_function('$a', 'return htmlspecialchars(stripslashes($a));');
                        $xdata = array_map($func, $xdata);
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

                        $user_lang = stripslashes($user_lang);
                        $user_dateformat = htmlspecialchars(stripslashes($user_dateformat));
                }
        }
        else if( !isset( $HTTP_POST_VARS['submit'] ) && $mode != 'save' && !isset( $HTTP_POST_VARS['avatargallery'] ) && !isset( $HTTP_POST_VARS['submitavatar'] ) && !isset( $HTTP_POST_VARS['cancelavatar'] ) )
        {
                if( isset( $HTTP_GET_VARS[POST_USERS_URL]) || isset( $HTTP_POST_VARS[POST_USERS_URL]) )
                {
                        $user_id = ( isset( $HTTP_POST_VARS[POST_USERS_URL]) ) ? intval( $HTTP_POST_VARS[POST_USERS_URL]) : intval( $HTTP_GET_VARS[POST_USERS_URL]);
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
                        $this_userdata = get_userdata($HTTP_POST_VARS['username'], true);
                        if( !$this_userdata )
                        {
                                message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
                        }
/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                        $this_userdata['xdata'] = get_user_xdata($HTTP_POST_VARS['username'], true);
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
				$facebook = htmlspecialchars($this_userdata['user_facebook']);
                $website = htmlspecialchars($this_userdata['user_website']);
                $location = htmlspecialchars($this_userdata['user_from']);
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
				$user_flag = htmlspecialchars($this_userdata['user_from_flag']);
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
                $occupation = htmlspecialchars($this_userdata['user_occ']);
                $interests = htmlspecialchars($this_userdata['user_interests']);
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
                $glance_show = htmlspecialchars($this_userdata['user_glance_show']);
/*****[END]********************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
                $user_posts = intval($this_userdata['user_posts']);
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

                $signature = ($this_userdata['user_sig_bbcode_uid'] != '') ? preg_replace('#:' . $this_userdata['user_sig_bbcode_uid'] . '#si', '', $this_userdata['user_sig']) : $this_userdata['user_sig'];
                $signature = preg_replace($html_entities_match, $html_entities_replace, $signature);

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                foreach ($this_userdata['xdata'] as $name => $value)
                {
                    $value = ($this_userdata['user_sig_bbcode_uid'] != '') ? preg_replace('#:' . $this_userdata['user_sig_bbcode_uid'] . '#si', '', $value) : $value;
                    $xdata[$name] = preg_replace($html_entities_match, $html_entities_replace, $value);
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
                if ( preg_match("/[^0-9]/i",$HTTP_POST_VARS['dst_time_lag']) || $dst_time_lag<0 || $dst_time_lag>120 )
                {
                    $error = TRUE;
                    $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['dst_time_lag_error'];
                }
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                $user_dateformat = htmlspecialchars($this_userdata['user_dateformat']);
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

        if( isset($HTTP_POST_VARS['avatargallery']) && !$error )
        {
                if( !$error )
                {
                        $user_id = intval($HTTP_POST_VARS['id']);

                        $template->set_filenames(array(
                                "body" => "admin/user_avatar_gallery.tpl")
                        );

                        $dir = @opendir("../" . $board_config['avatar_gallery_path']);

                        $avatar_images = array();
                        while( $file = @readdir($dir) )
                        {
                                if( $file != "." && $file != ".." && !is_file(phpbb_realpath("./../" . $board_config['avatar_gallery_path'] . "/" . $file)) && !is_link(phpbb_realpath("./../" . $board_config['avatar_gallery_path'] . "/" . $file)) )
                                {
                                        $sub_dir = @opendir("../" . $board_config['avatar_gallery_path'] . "/" . $file);

                                        $avatar_row_count = 0;
                                        $avatar_col_count = 0;

                                        while( $sub_file = @readdir($sub_dir) )
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

                        @closedir($dir);

                        if( isset($HTTP_POST_VARS['avatarcategory']) )
                        {
                                $category = htmlspecialchars($HTTP_POST_VARS['avatarcategory']);
                        }
                        else
                        {
                                list($category, ) = each($avatar_images);
                        }
                        @reset($avatar_images);

                        $s_categories = "";
                        while( list($key) = each($avatar_images) )
                        {
                                $selected = ( $key == $category ) ? "selected=\"selected\"" : "";
                                if( count($avatar_images[$key]) )
                                {
                                        $s_categories .= '<option value="' . $key . '"' . $selected . '>' . ucfirst($key) . '</option>';
                                }
                        }

                        $s_colspan = 0;
                        for($i = 0; $i < count($avatar_images[$category]); $i++)
                        {
                                $template->assign_block_vars("avatar_row", array());

                                $s_colspan = max($s_colspan, count($avatar_images[$category][$i]));

                                for($j = 0; $j < count($avatar_images[$category][$i]); $j++)
                                {
                                        $template->assign_block_vars("avatar_row.avatar_column", array(
                                                "AVATAR_IMAGE" => "../" . $board_config['avatar_gallery_path'] . '/' . $category . '/' . $avatar_images[$category][$i][$j])
                                        );

                                        $template->assign_block_vars("avatar_row.avatar_option_column", array(
                                                "S_OPTIONS_AVATAR" => $avatar_images[$category][$i][$j])
                                        );
                                }
                        }

                        $coppa = ( ( !$HTTP_POST_VARS['coppa'] && !$HTTP_GET_VARS['coppa'] ) || $mode == "register") ? 0 : TRUE;

                        $s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" /><input type="hidden" name="avatarcatname" value="' . $category . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="id" value="' . $user_id . '" />';

                        $s_hidden_fields .= '<input type="hidden" name="username" value="' . str_replace("\"", "&quot;", $username) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="email" value="' . str_replace("\"", "&quot;", $email) . '" />';
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
                        $s_hidden_fields .= '<input type="hidden" name="reputation" value="' . str_replace("\"", "&quot;", $reputation) . '" />';
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
						$s_hidden_fields .= '<input type="hidden" name="facebook" value="' . str_replace("\"", "&quot;", $facebook) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="website" value="' . str_replace("\"", "&quot;", $website) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="location" value="' . str_replace("\"", "&quot;", $location) . '" />';
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
						$s_hidden_fields .= '<input type="hidden" name="user_flag" value="' . $user_flag . '" />';
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="occupation" value="' . str_replace("\"", "&quot;", $occupation) . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="interests" value="' . str_replace("\"", "&quot;", $interests) . '" />';
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="glance_show" value="' . str_replace("\"", "&quot;", $glance_show) . '" />';
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

                        $s_hidden_fields .= '<input type="hidden" name="signature" value="' . str_replace("\"", "&quot;", $signature) . '" />';
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
                        while ( list($key, $value) = each($xdata) )
                        {
                            $s_hidden_fields .= '<input type="hidden" name="' . $key . '" value="' . str_replace("\"", "&quot;", $value) . '" />';
                        }
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                        $s_hidden_fields .= '<input type="hidden" name="time_mode" value="' . $time_mode . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="dst_time_lag" value="' . $dst_time_lag . '" />';
                        $s_hidden_fields .= '<input type="hidden" name="dateformat" value="' . str_replace("\"", "&quot;", $user_dateformat) . '" />';
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
						$s_hidden_fields .= '<input type="hidden" name="user_rank" value="' . $user_rank . '" />';
						$s_hidden_fields .= '<input type="hidden" name="user_rank2" value="' . $user_rank2 . '" />';
						$s_hidden_fields .= '<input type="hidden" name="user_rank3" value="' . $user_rank3 . '" />';
						$s_hidden_fields .= '<input type="hidden" name="user_rank4" value="' . $user_rank4 . '" />';
						$s_hidden_fields .= '<input type="hidden" name="user_rank5" value="' . $user_rank5 . '" />';
/*****[END]********************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/

                        $template->assign_vars(array(
                                "L_USER_TITLE" => $lang['User_admin'],
                                "L_USER_EXPLAIN" => $lang['User_admin_explain'],
                                "L_AVATAR_GALLERY" => $lang['Avatar_gallery'],
                                "L_SELECT_AVATAR" => $lang['Select_avatar'],
                                "L_RETURN_PROFILE" => $lang['Return_profile'],
                                "L_CATEGORY" => $lang['Select_category'],
                                "L_GO" => $lang['Go'],

                                "S_OPTIONS_CATEGORIES" => $s_categories,
                                "S_COLSPAN" => $s_colspan,
                                "S_PROFILE_ACTION" => append_sid("admin_users.$phpEx?mode=$mode"),
                                "S_HIDDEN_FIELDS" => $s_hidden_fields)
                        );
                }
        }
        else
        {
                $s_hidden_fields = '<input type="hidden" name="mode" value="save" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" />';
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
                                        $avatar = '<img src="../../../' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />';
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
                                        $avatar = '<img src="../../../' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />';
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

                $template->set_filenames(array(
                        "body" => "admin/user_edit_body.tpl")
                );
/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
                $xd_meta = get_xd_metadata();
                while ( list($code_name, $info) = each($xd_meta) )
                {

                	if ( xdata_auth($code_name, $userdata['user_id']) || intval($userdata['user_level']) == ADMIN )
                	{
                		if ($info['display_register'] == XD_DISPLAY_NORMAL)
                		{
                			$template->assign_block_vars('xdata', array(
                				'CODE_NAME' => $code_name,
                				'NAME' => $info['field_name'],
                				'DESCRIPTION' => $info['field_desc'],
                    			'VALUE' => isset($xdata[$code_name]) ? str_replace('"', '&quot;', $xdata[$code_name]) : '',
                				'MAX_LENGTH' => ( $info['field_length'] > 0) ? ( $info['field_length'] ) : ''
                				)
                			);

                			switch ($info['field_type'])
                			{
                				case 'text':
                					$template->assign_block_vars('xdata.switch_type_text', array());
                					break;

                				case 'textarea':
                					$template->assign_block_vars('xdata.switch_type_textarea', array());
                					break;

                				case 'checkbox':
                					$template->assign_block_vars('xdata.switch_type_checkbox', array( 'CHECKED' => ($xdata[$code_name] == $lang['true']) ? ' checked="checked"' : ''  ));
                					break;

                				case 'radio':
                					$template->assign_block_vars('xdata.switch_type_radio', array());

                					while ( list( , $option) = each($info['values_array']) )
                					{
                	                	$template->assign_block_vars('xdata.switch_type_radio.options', array(
                	                		'OPTION' => $option,
                	                		'CHECKED' => ($xdata[$code_name] == $option) ? 'checked="checked"' : ''
                							)
                	                	);
                					}
                					break;

                				case 'select':
                					$template->assign_block_vars('xdata.switch_type_select', array());

                					while ( list( , $option) = each($info['values_array']) )
                					{
                	                	$template->assign_block_vars('xdata.switch_type_select.options', array(
                	                		'OPTION' => $option,
                	                		'SELECTED' => ($xdata[$code_name] == $option) ? 'selected="selected"' : ''
                							)
                	                	);
                					}
                					break;
                			}
                		}
                		elseif ($info['display_register'] == XD_DISPLAY_ROOT)
                		{
                            $template->assign_block_vars('xdata',
                	 	  		array(
                		  			'CODE_NAME' => $code_name,
                		  			'NAME' => $xd_meta[$code_name]['field_name'],
                		  			'DESCRIPTION' => $xd_meta[$code_name]['field_desc'],
                       				'VALUE' => isset($xdata[$code_name]) ? str_replace('"', '&quot;', $xdata[$code_name]) : ''
                		  		) );
                		  	$template->assign_block_vars('xdata.switch_is_'.$code_name, array());

                		  	switch ($info['field_type'])
                			{
                				case 'checkbox':
                					$template->assign_block_vars('xdata.switch_type_checkbox', array( 'CHECKED' => ($xdata[$code_name] == 1) ? ' checked="checked"' : ''  ));
                					break;

                				case 'radio':

                					while ( list( , $option) = each($info['values_array']) )
                					{
                	                	$template->assign_block_vars('xdata.switch_is_'.$code_name.'.options', array(
                	                		'OPTION' => $option,
                	                		'CHECKED' => ($xdata[$code_name] == $option) ? 'checked="checked"' : ''
                							)
                	                	);
                					}
                					break;

                				case 'select':

                					while ( list( , $option) = each($info['values_array']) )
                					{
                	                	$template->assign_block_vars('xdata.switch_is_'.$code_name.'.options', array(
                	                		'OPTION' => $option,
                	                		'SELECTED' => ($xdata[$code_name] == $option) ? 'selected="selected"' : ''
                							)
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

                switch ($board_config['default_time_mode'])
                {
                    case MANUAL_DST:
                        $l_time_mode_1 = $l_time_mode_1 . "*";
                        break;
                    case SERVER_SWITCH:
                        $l_time_mode_2 = $l_time_mode_2 . "*";
                        break;
                    case FULL_SERVER:
                        $l_time_mode_3 = $l_time_mode_3 . "*";
                        break;
                    case SERVER_PC:
                        $l_time_mode_4 = $l_time_mode_4 . "*";
                        break;
                    case FULL_PC:
                        $l_time_mode_6 = $l_time_mode_6 . "*";
                        break;
                    default:
                        $l_time_mode_0 = $l_time_mode_0 . "*";
                        break;
                }

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
                $form_enctype = ( !@$ini_val('file_uploads') || phpversion() == '4.0.4pl1' || !$board_config['allow_avatar_upload'] || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';
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
					$selected = ( isset( $user_flag) ) ? ((str_replace('.png','',$user_flag) == str_replace('.png','',$flag_image)) ? 'selected="selected"' : '' ) : '' ;
					$flag_select .= '  <option value="'.$flag_image.'"'.$selected.'>'.$flag_name.'</option>';
					if ( isset($user_flag) && ($user_flag == $flag_image))
					{
						// $flag_start_image = $flag_image;
                        $flag_start_image = str_replace('.png','',$flag_image);
					}
				}
				$flag_select .= '</select>';




/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
                $template->assign_vars(array(
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
                        'GENDER_NO_SPECIFY_CHECKED' => $gender_no_specify_checked, 
                        'GENDER_MALE_CHECKED' => $gender_male_checked, 
                        'GENDER_FEMALE_CHECKED' => $gender_female_checked,
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
                        'HIDE_IMAGES_NO' => ( !$hide_images ) ? 'checked="checked"' : '',
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
						'BDAY_NONE_ENABLED' => ( !$birthday_greeting ) ? ' checked="checked"' : '',
						'BDAY_EMAIL' => BIRTHDAY_EMAIL,
						'BDAY_EMAIL_ENABLED' => ( $birthday_greeting == BIRTHDAY_EMAIL ) ? ' checked="checked"' : '',
						'BDAY_PM' => BIRTHDAY_PM,
						'BDAY_PM_ENABLED' => ( $birthday_greeting == BIRTHDAY_PM ) ? ' checked="checked"' : '', 
						'BDAY_POPUP' => BIRTHDAY_POPUP,
						'BDAY_POPUP_ENABLED' => ( $birthday_greeting == BIRTHDAY_POPUP ) ? ' checked="checked"' : '',
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
                        'SIGNATURE' => str_replace('<br />', "\n", $signature),
                        'VIEW_EMAIL_YES' => ($viewemail) ? 'checked="checked"' : '',
                        'VIEW_EMAIL_NO' => (!$viewemail) ? 'checked="checked"' : '',
                        'HIDE_USER_YES' => (!$allowviewonline) ? 'checked="checked"' : '',
                        'HIDE_USER_NO' => ($allowviewonline) ? 'checked="checked"' : '',
                        'NOTIFY_PM_YES' => ($notifypm) ? 'checked="checked"' : '',
                        'NOTIFY_PM_NO' => (!$notifypm) ? 'checked="checked"' : '',
                        'POPUP_PM_YES' => ($popuppm) ? 'checked="checked"' : '',
                        'POPUP_PM_NO' => (!$popuppm) ? 'checked="checked"' : '',
                        'ALWAYS_ADD_SIGNATURE_YES' => ($attachsig) ? 'checked="checked"' : '',
                        'ALWAYS_ADD_SIGNATURE_NO' => (!$attachsig) ? 'checked="checked"' : '',
                        'NOTIFY_REPLY_YES' => ( $notifyreply ) ? 'checked="checked"' : '',
                        'NOTIFY_REPLY_NO' => ( !$notifyreply ) ? 'checked="checked"' : '',
                        'ALWAYS_ALLOW_BBCODE_YES' => ($allowbbcode) ? 'checked="checked"' : '',
                        'ALWAYS_ALLOW_BBCODE_NO' => (!$allowbbcode) ? 'checked="checked"' : '',
                        'ALWAYS_ALLOW_HTML_YES' => ($allowhtml) ? 'checked="checked"' : '',
                        'ALWAYS_ALLOW_HTML_NO' => (!$allowhtml) ? 'checked="checked"' : '',
                        'ALWAYS_ALLOW_SMILIES_YES' => ($allowsmilies) ? 'checked="checked"' : '',
                        'ALWAYS_ALLOW_SMILIES_NO' => (!$allowsmilies) ? 'checked="checked"' : '',
/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
                        'SHOW_AVATARS_YES' => ($showavatars) ? 'checked="checked"' : '',
                        'SHOW_AVATARS_NO' => (!$showavatars) ? 'checked="checked"' : '',
                        'SHOW_SIGNATURES_YES' => ($showsignatures) ? 'checked="checked"' : '',
                        'SHOW_SIGNATURES_NO' => (!$showsignatures) ? 'checked="checked"' : '',
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
                        'TIME_MODE_MANUAL_CHECKED' => $time_mode_manual_checked,
                        'TIME_MODE_MANUAL_DST_CHECKED' => $time_mode_manual_dst_checked,
                        'TIME_MODE_SERVER_SWITCH_CHECKED' => $time_mode_server_switch_checked,
                        'TIME_MODE_FULL_SERVER_CHECKED' => $time_mode_full_server_checked,
                        'TIME_MODE_SERVER_PC_CHECKED' => $time_mode_server_pc_checked,
                        'TIME_MODE_FULL_PC_CHECKED' => $time_mode_full_pc_checked,
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
                        'QUICK_REPLY_MODE_ADVANCED' => ( $user_quickreply_mode!=0 ) ? 'checked="checked"' : '',
                        'OPEN_QUICK_REPLY_YES' => ( $user_open_quickreply ) ? 'checked="checked"' : '',
                        'OPEN_QUICK_REPLY_NO' => ( !$user_open_quickreply ) ? 'checked="checked"' : '',
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
                        'ALLOW_PM_YES' => ($user_allowpm) ? 'checked="checked"' : '',
                        'ALLOW_PM_NO' => (!$user_allowpm) ? 'checked="checked"' : '',
                        'ALLOW_AVATAR_YES' => ($user_allowavatar) ? 'checked="checked"' : '',
                        'ALLOW_AVATAR_NO' => (!$user_allowavatar) ? 'checked="checked"' : '',
                        'USER_ACTIVE_YES' => ($user_status) ? 'checked="checked"' : '',
                        'USER_ACTIVE_NO' => (!$user_status) ? 'checked="checked"' : '',
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
						'L_FACEBOOK' => $lang['FACEBOOK'],
                        'L_LOCATION' => $lang['Location'],
                        'L_OCCUPATION' => $lang['Occupation'],						
/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
                        'L_WORD_WRAP' => $lang['Word_Wrap'],
                        'L_WORD_WRAP_EXPLAIN' => $lang['Word_Wrap_Explain'],
                        'L_WORD_WRAP_EXTRA' => strtr($lang['Word_Wrap_Extra'],array('%min%' => $board_config['wrap_min'], '%max%' => $board_config['wrap_max'])),
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
                        'S_PROFILE_ACTION' => append_sid("admin_users.$phpEx"))
                );
				
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				$block = ( $board_config['bday_require'] == TRUE ) ? 'birthday_required' : 'birthday_optional';
				$template->assign_block_vars($block, array());
				$template->birthday_interface();
		
				if ( $board_config['bday_greeting'] != 0 )
				{
					$template->assign_block_vars('birthdays_greeting',array());
					if ($board_config['bday_greeting'] & (1<<(BIRTHDAY_EMAIL-1)))
					{
						$template->assign_block_vars('birthdays_greeting.birthdays_email',array());
					}
					if ($board_config['bday_greeting'] & (1<<(BIRTHDAY_PM-1)))
					{
							$template->assign_block_vars('birthdays_greeting.birthdays_pm',array());
					}
					if ($board_config['bday_greeting'] & (1<<(BIRTHDAY_POPUP-1)))
					{
						$template->assign_block_vars('birthdays_greeting.birthdays_popup',array());
					}
				}
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

                if( file_exists(@phpbb_realpath('./../' . $board_config['avatar_path'])) && ($board_config['allow_avatar_upload'] == TRUE) )
                {
                        if ( $form_enctype != '' )
                        {
                                $template->assign_block_vars('avatar_local_upload', array() );
                        }
                        $template->assign_block_vars('avatar_remote_upload', array() );
                }

                if( file_exists(@phpbb_realpath('./../' . $board_config['avatar_gallery_path'])) && ($board_config['allow_avatar_local'] == TRUE) )
                {
                        $template->assign_block_vars('avatar_local_gallery', array() );
                }

                if( $board_config['allow_avatar_remote'] == TRUE )
                {
                        $template->assign_block_vars('avatar_remote_link', array() );
                }
        }

        $template->pparse('body');
}
else
{
        //
        // Default user selection box
        //
        $template->set_filenames(array(
                'body' => 'admin/user_select_body.tpl')
        );

        $template->assign_vars(array(
                'L_USER_TITLE' => $lang['User_admin'],
                'L_USER_EXPLAIN' => $lang['User_admin_explain'],
                'L_USER_SELECT' => $lang['Select_a_User'],
                'L_LOOK_UP' => $lang['Look_up_user'],
                'L_FIND_USERNAME' => $lang['Find_username'],

                'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser&popup=1&menu=1"),

                'S_USER_ACTION' => append_sid("admin_users.$phpEx"),
                'S_USER_SELECT' => $select_list)
        );
        $template->pparse('body');

}

include('./page_footer_admin.'.$phpEx);

?>