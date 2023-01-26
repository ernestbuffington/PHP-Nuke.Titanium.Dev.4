<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced and Advanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                             comments_list.php
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
-=[Mod]=-
      Advanced Username Color                  v1.0.5       09/20/2005
-=[Applied Rules]=-
 * DirNameFileConstantToDirConstantRector
 * ReplaceHttpServerVarsByServerRector (https://blog.tigertech.net/posts/php-5-3-http-server-vars/)
 * LongArrayToShortArrayRector
 * CountOnNullRector (https://3v4l.org/Bndc9)
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

define('IN_PHPBB', true);
include($phpbb_root_path .'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
require_once('includes/bbcode.' . $phpEx);

global $userinfo;
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//
include('includes/functions_arcade.' . $phpEx);

$header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";

if ( !$userdata['session_logged_in'] )
{
    header($header_location . "modules.php?name=Your_Account");
    exit;
}
//
// End of auth check
//

include("includes/page_header.php");

    $comments_sql = "SELECT * FROM " . COMMENTS_TABLE . " WHERE comments_value <> '' ";

    if ( !($result_count = $db->sql_query($comments_sql)) )
      {
         // Error if it fails...
         message_die(GENERAL_ERROR, "Couldn't obtain comment count.", "", __LINE__, __FILE__, $sql);
      }

    $count_rows = $db->sql_fetchrowset($result_count);
    $comments_total= is_countable($count_rows) ? count($count_rows) : 0;

    $start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
    $comments_perpage = 15;


$template->set_filenames(['body' => 'comments_list_body.tpl']);

            $template->assign_vars(['L_ARCADE_COMMENTS_FULL' => $lang['arcade_comments_full'], 'L_ARCADE_COMMENTS' => $lang['arcade_comments'], 'L_GAME' => $lang['game'], 'L_COMMENTS' => $lang['comments'], 'L_ARCADE_USER' => $lang['arcade_user'], 'L_SCORE' => $lang['boardscore'], 'NAV_DESC' => '<a class="nav" href="' . append_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ']);


$sql = "SELECT g.*, c.*, u.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id LEFT JOIN " . USERS_TABLE ." u  ON g.game_highuser=u.user_id WHERE comments_value <> '' ORDER BY game_name ASC LIMIT $start, $comments_perpage";
            if( !($result = $db->sql_query($sql)) )
            {
            message_die(GENERAL_ERROR, "Error retrieving high score list", '', __LINE__, __FILE__, $sql);
            }

//
// Define censored word matches
//
$orig_word = [];
$replacement_word = [];
obtain_word_list($orig_word, $replacement_word);

while ( $row = $db->sql_fetchrow($result))
            {

            if ( count($orig_word) )
                        {
                             $row['comments_value'] = preg_replace($orig_word, $replacement_word, (string) $row['comments_value']);
                        }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $template->assign_block_vars('commentrow', ['GAME_NAME' => '<a href="' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>', 'COMMENTS_VALUE' =>  smilies_pass($row['comments_value']), 'USERNAME' => '<a href="' . append_sid("statarcade.$phpEx?uid=" . $row['user_id'] ) . '" class="genmed">' . $row['username'] . '</a> ', 'HIGHSCORE' =>  number_format($row['game_highscore'])]);

            }

$template->assign_vars(['MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_sid("comments.$phpEx") . '">' . $lang['manage_comments'] . '</a></nobr> ', 'PAGINATION' => generate_pagination("comments_list.$phpEx?", $comments_total, $comments_perpage, $start), 'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $comments_perpage) + 1 ), ceil( $comments_total / $comments_perpage )), 'L_GOTO_PAGE' => $lang['Goto_page']]
        );

//
// Generate the page end
//

$template->pparse('body');
include("includes/page_tail.php");


