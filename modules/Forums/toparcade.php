<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                               toparcade.php
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
    $pnt_module = basename(dirname(__FILE__));
    require("modules/".$pnt_module."/nukebb.php");
}
else
{
    $phpbb2_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB2', true);
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);
require($phpbb2_root_path . 'gf_funcs/gen_funcs.' . $phpEx);

$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";

//
// Start session management
//
$userdata = titanium_session_pagestart($pnt_user_ip, PAGE_TOPARCADES, $nukeuser);
titanium_init_userprefs($userdata);
//
// End session management
//
include('includes/functions_arcade.' . $phpEx);
//
// Start auth check
//
$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";

if (!$userdata['session_logged_in']) {
        header($header_location . "modules.php?name=Your_Account");
        exit;
}
//
// End of auth check
//

$phpbb2_template->set_filenames(array(
        'body' => 'toparcade_body.tpl')
);

$phpbb2_template->assign_vars(array(
        'L_TOPARCADE_FIVE' => $lang['toparcade_five'],
        'L_ARCADE' => $lang['toparcade_players'],
        'NAV_DESC' => '<a class="nav" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a>'
)
);

$nbcol = 3;
$games_par_page = 12;
$liste_cat_auth = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'view');

if (empty($liste_cat_auth)) {
        $liste_cat_auth = "''";
}

$sql = "SELECT COUNT(*) AS nbtot FROM " . GAMES_TABLE . " WHERE arcade_catid IN ($liste_cat_auth)";

if (!($result = $pnt_db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read the games table", '', __LINE__, __FILE__, $sql);
}

if ($row=$pnt_db->sql_fetchrow($result)) {
        $total_phpbb2_games = $row['nbtot'];
} else {
        $total_phpbb2_games = 0;
}


$phpbb2_start = get_var_gf(array('name'=>'start', 'intval'=>true));
$limit_sql = " LIMIT $phpbb2_start," . $games_par_page;

$sql = "SELECT distinct game_id , game_name FROM " . GAMES_TABLE . " WHERE arcade_catid IN ($liste_cat_auth) ORDER BY game_name ASC $limit_sql";

if (!($result = $pnt_db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read the games table", '', __LINE__, __FILE__, $sql);
}

$fini = false;

if (!$row = $pnt_db->sql_fetchrow($result)) {
        $fini=true;
}

while ((!$fini) ) {
        $phpbb2_template->assign_block_vars('blkligne', array());

        for ($cg = 1; $cg <= $nbcol; $cg++) {
                $phpbb2_template->assign_block_vars('blkligne.blkcolonne', array());

                if (!$fini) {
                         $phpbb2_template->assign_block_vars('blkligne.blkcolonne.blkgame', array(
                                'GAMENAME' => '<nobr><a class="cattitle" href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a></nobr>')
                        );

                        $pos = 0;
                        $posreelle = 0;
                        $lastscore = 0;
                        $sql2 = "SELECT s.* , u.username FROM " . SCORES_TABLE . " s LEFT JOIN " . USERS_TABLE . " u ON u.user_id = s.user_id WHERE s.game_id = " . $row['game_id'] . " ORDER BY s.score_game DESC, s.score_date ASC LIMIT 0,5";

                        if (!($result2 = $pnt_db->sql_query($sql2))) {
                                message_die(GENERAL_ERROR, "Could not read from the scores/users tables", '', __LINE__, __FILE__, $sql);
                        }

                        while($row2 = $pnt_db->sql_fetchrow($result2)) {
                                $posreelle++;

                                if ($lastscore != $row2['score_game']) {
                                        $pos = $posreelle;
                                }
                                $lastscore = $row2['score_game'];
                                $phpbb2_template->assign_block_vars('blkligne.blkcolonne.blkgame.blkscore', array(
                                        'SCORE' => number_format($row2['score_game']),
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                        'USERNAME' => UsernameColor($row2['username']),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                        'POS' => $pos)
                                );
                        }

                        if (!($row = $pnt_db->sql_fetchrow($result))) {
                                $fini = true;
                        }
                }
        }
}

$phpbb2_template->assign_vars(array(
        'PAGINATION' => generate_pagination(append_titanium_sid("toparcade.$phpEx?uid=$uid"), $total_phpbb2_games, $games_par_page, $phpbb2_start),
        'PAGE_NUMBER' => sprintf($lang['Page_of'], (floor($phpbb2_start / $games_par_page) + 1), ceil($total_phpbb2_games / $games_par_page)))
);

include($phpbb2_root_path . 'hall_of_fame.'.$phpEx);

//
// Output page header
$phpbb2_page_title = $lang['toparcade'];
include('includes/page_header.'.$phpEx);
$phpbb2_template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>