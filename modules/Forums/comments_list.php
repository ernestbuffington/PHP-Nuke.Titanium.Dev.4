<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
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
-=[Mod]=-
      Advanced Username Color                  v1.0.5       09/20/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die('You can\'t access this file directly...');
}

if ($popup != "1"){
    $titanium_module_name = basename(dirname(__FILE__));
    require("modules/".$titanium_module_name."/nukebb.php");
}
else
{
    $phpbb2_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB2', true);
include($phpbb2_root_path .'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);
require_once('includes/bbcode.' . $phpEx);

//
// Start session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_INDEX, $nukeuser);
titanium_init_userprefs($userdata);
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

    if ( !($result_count = $titanium_db->sql_query($comments_sql)) )
      {
         // Error if it fails...
         message_die(GENERAL_ERROR, "Couldn't obtain comment count.", "", __LINE__, __FILE__, $sql);
      }

    $count_rows = $titanium_db->sql_fetchrowset($result_count);
    $comments_total= count($count_rows);

    $phpbb2_start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
    $comments_perpage = 15;


$phpbb2_template->set_filenames(array(
   'body' => 'comments_list_body.tpl'));

            $phpbb2_template->assign_vars(array(
                        'L_ARCADE_COMMENTS_FULL' => $titanium_lang['arcade_comments_full'],
                        'L_ARCADE_COMMENTS' => $titanium_lang['arcade_comments'],
                        'L_GAME' => $titanium_lang['game'],
                        'L_COMMENTS' => $titanium_lang['comments'],
                        'L_ARCADE_USER' => $titanium_lang['arcade_user'],
                        'L_SCORE' => $titanium_lang['boardscore'],
                        'NAV_DESC' => '<a class="nav" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $titanium_lang['arcade'] . '</a> ' ,
            ));


$sql = "SELECT g.*, c.*, u.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id LEFT JOIN " . USERS_TABLE ." u  ON g.game_highuser=u.user_id WHERE comments_value <> '' ORDER BY game_name ASC LIMIT $phpbb2_start, $comments_perpage";
            if( !($result = $titanium_db->sql_query($sql)) )
            {
            message_die(GENERAL_ERROR, "Error retrieving high score list", '', __LINE__, __FILE__, $sql);
            }

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

while ( $row = $titanium_db->sql_fetchrow($result))
            {

            if ( count($orig_word) )
                        {
                             $row['comments_value'] = preg_replace($orig_word, $replacement_word, $row['comments_value']);
                        }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $phpbb2_template->assign_block_vars('commentrow', array(
                        'GAME_NAME' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>',
                        'COMMENTS_VALUE' =>  smilies_pass($row['comments_value']),
                        'USERNAME' => '<a href="' . append_titanium_sid("statarcade.$phpEx?uid=" . $row['user_id'] ) . '" class="genmed">' . $row['username'] . '</a> ',
                        'HIGHSCORE' =>  number_format($row['game_highscore']),
                 ));

            }

$phpbb2_template->assign_vars(array(
                'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_titanium_sid("comments.$phpEx") . '">' . $titanium_lang['manage_comments'] . '</a></nobr> ',
                'PAGINATION' => generate_pagination("comments_list.$phpEx?", $comments_total, $comments_perpage, $phpbb2_start),
                'PAGE_NUMBER' => sprintf($titanium_lang['Page_of'], ( floor( $phpbb2_start / $comments_perpage) + 1 ), ceil( $comments_total / $comments_perpage )),
                'L_GOTO_PAGE' => $titanium_lang['Goto_page'])
        );

//
// Generate the page end
//

$phpbb2_template->pparse('body');
include("includes/page_tail.php");

?>