<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced and Advanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                               comments.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/20/2005
	  Titanium Patched                         v4.0.3       01/26/2023
-=[Applied Rules]=-
 * DirNameFileConstantToDirConstantRector
 * ReplaceHttpServerVarsByServerRector (https://blog.tigertech.net/posts/php-5-3-http-server-vars/)
 * LongArrayToShortArrayRector
 * NullToStrictStringFuncCallArgRector	  
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die('You can\'t access this file directly...');
}

if (!isset($popup)){
    $module_name = basename(__DIR__);
    require("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

global $userinfo;

define('IN_PHPBB', true);

include($phpbb_root_path .'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include('includes/functions_post.'. $phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_POSTING);
init_userprefs($userdata);
//
// End session management
//
include('includes/functions_arcade.' . $phpEx);

$header_location = ( preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";

if ( !$userdata['session_logged_in'] )
{
    header($header_location . "modules.php?name=Your_Account");
    exit;
}
//
// End of auth check
//
generate_smilies('inline', PAGE_POSTING);
include("includes/page_header.php");

$mode = $_GET['mode'] ?? '';

if($mode == "z")
{
  $user_allow_arcadepm = (int) $_POST['user_allow_arcadepm'];


  $sql = "UPDATE " . USERS_TABLE. " SET user_allow_arcadepm = '$user_allow_arcadepm' WHERE user_id =  " . $userinfo['user_id'];
        if( !($result = $db->sql_query($sql)))
            {
            message_die(GENERAL_ERROR, "Error updating selection", '', __LINE__, __FILE__, $sql);
            }

    header($header_location ."modules.php?name=Forums&file=comments");
    exit;

}
//Comment update section
if($mode == "update")
    {
            $game_id = intval($_POST['comment_id']);
            $comment_text = str_replace("\'","''",(string) $_POST['message']);
            $comment_text = preg_replace(['#&(?!(\#[0-9]+;))#', '#<#', '#>#'], ['&amp;', '&lt;', '&gt;'], $comment_text);

            //Checks to make sure the user has privledge to enter highscores.
            //This query checks the user_id stored in the users cookie and in the database.
            //If they don't match, the comments is not entered and error message is displayed.
            global $userinfo;

            $user_id = $userinfo['user_id'];
			
            $sql = "SELECT game_highuser FROM " . GAMES_TABLE. " WHERE game_id = $game_id";

            if(!($result = $db->sql_query($sql)))
            {
               message_die(GENERAL_ERROR, "Error Authenticating User", '', __LINE__, __FILE__, $sql);
            }
            $row = $db->sql_fetchrow($result);

            if($row['game_highuser'] != $userinfo['user_id'])
            {
               message_die(GENERAL_ERROR, "Error Authenticating User - You are not the HighScore User!!", '');
            }
			else
			{
            //Enters Comment into the DB
            //$sql = "UPDATE " . COMMENTS_TABLE . " SET comments_value = ".$comment_text." WHERE game_id = ".$game_id;
			
			$sql = "REPLACE INTO `" . COMMENTS_TABLE . "` VALUES($game_id, '$comment_text');";
            
			if(!($result = $db->sql_query($sql)))
            {
                message_die(GENERAL_ERROR, "Couldn't insert row in comments table", "", __LINE__, __FILE__, $sql);
            }

			}
            //Comment Updated/Added Successfully
               $message = "Comment sucessfully updated.";
               $message .= "<br /><br />Click <a href=\"modules.php?name=Forums&amp;file=arcade\">here</a> to return to the Arcade.";
               $message .= "<META HTTP-EQUIV=\"refresh\" content=\"5;URL=modules.php?name=Forums&amp;file=comments\">";
                        message_die(GENERAL_MESSAGE, $message);
    }


if($mode == "submit")
{
    global $userinfo;

	$template->set_filenames(['body' => 'comments_body.tpl']);

    $game_id = intval($_POST['comment_id']);

    //Gets comments from database
    $sql = "SELECT g.game_id, g.game_name, c.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id WHERE g.game_id = $game_id";
    
	if( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Error retrieving comment list", '', __LINE__, __FILE__, $sql);
    }

    $row = $db->sql_fetchrow($result);

    $template->assign_vars(['L_ADD_EDIT_COMMENTS' => $lang['add_edit_comments'], 'NAV_DESC' => '<a class="nav" href="' . append_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ', 'GAME_ID' => $row['game_id'], 'L_GAME_NAME' => $lang['game_name'], 'GAME_NAME' => '<a href="' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>', 'L_ENTER_COMMENT' => $lang['enter_comment'], 'COMMENTS' => $row['comments_value'], 'S_ACTION' => append_sid("comments?mode=update")]);

    //Gets Avatar based on user settings and other user stats
    $sql = "SELECT username, user_avatar_type, user_allowavatar, user_avatar FROM " . USERS_TABLE . " WHERE user_id = " . $userinfo['user_id'] ;
    if( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Cannot access the users table", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);

    $user_avatar_type = $row['user_avatar_type'];
    $user_allowavatar = $row['user_allowavatar'];
    $user_avatar = $row['user_avatar'];
    $avatar_img = '';

    if ( $user_avatar_type && $user_allowavatar )
    {
       switch( $user_avatar_type )
       {
          case USER_AVATAR_UPLOAD:
             $avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" border="0" hspace="20" align="center" valign="center"/>' : '';
             break;
          case USER_AVATAR_REMOTE:
             $avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $user_avatar . '" alt="" border="0"  hspace="20" align="center" valign="center" />' : '';
             break;
          case USER_AVATAR_GALLERY:
             $avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" border="0"  hspace="20" align="center" valign="center" />' : '';
             break;
       }

    }
        $template->assign_vars(['L_QUICK_STATS' => $lang['quick_stats'], 'USER_AVATAR' => '<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $userinfo['user_id'] . '">' . $avatar_img . '</a>', 'USERNAME' => '<a href="' . append_sid("statarcade.$phpEx?uid=" . $userinfo['user_id'] ) . '" class="genmed">' . $row['username'] . '</a> ']);

    //Gets some user stats to display on the comment submission page
    $sql ="SELECT s.score_set, s.game_id, g.game_name FROM " . SCORES_TABLE. " s LEFT JOIN " . USERS_TABLE. " u ON s.user_id = u.user_id LEFT JOIN " . GAMES_TABLE. " g ON s.game_id = g.game_id 
	
	WHERE s.user_id = " . $userinfo['user_id'] . " ORDER BY score_set DESC LIMIT 1";

    if( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Cannot access user stats to display", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);

        $times_played = $row['score_set'];
        $fav_game_name = '<a href="' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>';


    $sql="SELECT * FROM " .GAMES_TABLE ." WHERE game_highuser = " . $userinfo['user_id'] . " ORDER BY game_highdate DESC";
    if( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Cannot access last high score data", '', __LINE__, __FILE__, $sql);
    }
    $score_count = $db->sql_numrows( $result ); //Gets the number of highscores for the current user
    $row = $db->sql_fetchrow($result);

    $highscore_date = create_date( $board_config['default_dateformat'] , $row['game_highdate'] , $board_config['board_timezone'] );
    $highscore_game_name = '<a href="' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>';

        $template->assign_vars(['L_QUICK_STATS_MESSAGE' => sprintf($lang['quick_stats_message'], $score_count, $fav_game_name, $times_played, $highscore_date, $highscore_game_name)]);

//
// Generate the page end
//
$template->pparse('body');
include("includes/page_tail.php");
}

global $userinfo;

$template->set_filenames(['body' => 'comments_select_body.tpl']);

$link    = "comments";
$uid = $userinfo['user_id'];
$submit = append_sid($link."?mode=submit");
$z = append_sid($link."?mode=z");

        $sql = "SELECT g.*, c.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id WHERE game_highuser = $uid ORDER BY game_name ASC";
            if( !($result = $db->sql_query($sql)) )
            {
            message_die(GENERAL_ERROR, "Error retrieving high score list", '', __LINE__, __FILE__, $sql);
            }
        $score_count = $db->sql_numrows( $result );
                $select_highscore = "<select name='comment_id' class='post'>";
        while ( $row = $db->sql_fetchrow($result))
            {

                $select_highscore .= "<option value='" . $row['game_id'] . "' >" . $row['game_name'] . "</option>";

            }
                 $select_highscore .= '</select>';
//User Options for PM
$sql = "SELECT user_allow_arcadepm FROM " . USERS_TABLE . " WHERE user_id = $uid";
            if( !($result = $db->sql_query($sql)) )
            {
            message_die(GENERAL_ERROR, "Error retrieving user arcade pm preference", '', __LINE__, __FILE__, $sql);
            }

$row = $db->sql_fetchrow($result);

$user_allow_arcadepm_yes = ( $row['user_allow_arcadepm'] ) ? "checked=\"checked\"" : "";
$user_allow_arcadepm_no = ( !$row['user_allow_arcadepm'] ) ? "checked=\"checked\"" : "";

$template->assign_vars(['NAV_DESC' => '<a class="nav" href="' . append_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ']);
if ($score_count != 0)
{
$template->assign_block_vars('comment_select',['NAV_DESC' => '<a class="nav" href="' . append_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ', 'HIGHSCORE_COUNT' => $score_count, 'HIGHSCORE_SELECT' => $select_highscore, 'S_ACTION' => $submit]);

}

$template->assign_block_vars('comment_settings',['S_ACTION_PM' => $z, 'L_YES' => $lang['Yes'], 'L_NO' => $lang['No'], 'USER_ALLOW_ARCADEPM_YES' => $user_allow_arcadepm_yes, 'USER_ALLOW_ARCADEPM_NO' => $user_allow_arcadepm_no]);

//
// Generate the page end
//
$template->pparse('body');
include("includes/page_tail.php");


