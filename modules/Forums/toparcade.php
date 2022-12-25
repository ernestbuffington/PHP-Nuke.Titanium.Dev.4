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

if (!isset($popup)){
    $module_name = basename(dirname(__FILE__));
    require("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
require($phpbb_root_path . 'gf_funcs/gen_funcs.' . $phpEx);

$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_TOPARCADES, $nukeuser);
init_userprefs($userdata);
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

$template->set_filenames(array(
        'body' => 'toparcade_body.tpl')
);

$template->assign_vars(array(
        'L_TOPARCADE_FIVE' => $lang['toparcade_five'],
        'L_ARCADE' => $lang['toparcade_players'],
        'NAV_DESC' => '<a class="nav" href="' . append_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a>'
)
);

$nbcol = 3;
$games_par_page = 12;
$liste_cat_auth = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'view');

if (empty($liste_cat_auth)) {
        $liste_cat_auth = "''";
}

$sql = "SELECT COUNT(*) AS nbtot FROM " . GAMES_TABLE . " WHERE arcade_catid IN ($liste_cat_auth)";

if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read the games table", '', __LINE__, __FILE__, $sql);
}

if ($row=$db->sql_fetchrow($result)) {
        $total_games = $row['nbtot'];
} else {
        $total_games = 0;
}


$start = get_var_gf(array('name'=>'start', 'intval'=>true));
$limit_sql = " LIMIT $start," . $games_par_page;

$sql = "SELECT distinct game_id , game_name FROM " . GAMES_TABLE . " WHERE arcade_catid IN ($liste_cat_auth) ORDER BY game_name ASC $limit_sql";

if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read the games table", '', __LINE__, __FILE__, $sql);
}

$fini = false;

if (!$row = $db->sql_fetchrow($result)) {
        $fini=true;
}

while ((!$fini) ) {
        $template->assign_block_vars('blkligne', array());

        for ($cg = 1; $cg <= $nbcol; $cg++) {
                $template->assign_block_vars('blkligne.blkcolonne', array());

                if (!$fini) {
                         $template->assign_block_vars('blkligne.blkcolonne.blkgame', array(
                                'GAMENAME' => '<nobr><a class="cattitle" href="' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a></nobr>')
                        );

		$row2['trophy'] = '';
		
		if(!isset($row2['score_game']))
		$row2['score_game'] = 0;
		
		if($row2['score_game'] == 1)
		$row2['trophy'] = 'st';
		if($row2['score_game'] == 2)
		$row2['trophy'] = 'nd';
		if($row2['score_game'] == 3)
		$row2['trophy'] = 'rd';
		if($row2['score_game'] == 4)
		$row2['trophy'] = 'th';
		if($row2['score_game'] == 5)
		$row2['trophy'] = 'th';
		if($row2['score_game'] == 6)
		$row2['trophy'] = 'rd';
		if($row2['score_game'] == 7)
		$row2['trophy'] = 'th';
		if($row2['score_game'] == 8)
		$row2['trophy'] = 'th';
		if($row2['score_game'] == 9)
		$row2['trophy'] = 'th';
		if($row2['score_game'] == 10)
		$row2['trophy'] = 'th';
		
                        $pos = 0;
                        $posreelle = 0;
                        $lastscore = 0;
                        $sql2 = "SELECT s.* , u.username FROM " . SCORES_TABLE . " s LEFT JOIN " . USERS_TABLE . " u ON u.user_id = s.user_id WHERE s.game_id = " . $row['game_id'] . " ORDER BY s.score_game DESC, s.score_date ASC LIMIT 0,5";

                        if (!($result2 = $db->sql_query($sql2))) {
                                message_die(GENERAL_ERROR, "Could not read from the scores/users tables", '', __LINE__, __FILE__, $sql);
                        }

						while($row2 = $db->sql_fetchrow($result2)) {
                                $posreelle++;

                                if ($lastscore != $row2['score_game']) {
                                        $pos = $posreelle;
                                }
                                $lastscore = $row2['score_game'];

                                if(!isset($row2['trophy']))
						        $row2['trophy'] = '';

                                $template->assign_block_vars('blkligne.blkcolonne.blkgame.blkscore', array(
                                        'SCORE' => number_format($row2['score_game']),
										'TROPHY' => $row2['trophy'],
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

                        if (!($row = $db->sql_fetchrow($result))) {
                                $fini = true;
                        }
                }
        }
}

if(!isset($uid))
$uid = '';

$template->assign_vars(array(
        'PAGINATION' => generate_pagination(append_sid("toparcade.$phpEx?uid=$uid"), $total_games, $games_par_page, $start),
        'PAGE_NUMBER' => sprintf($lang['Page_of'], (floor($start / $games_par_page) + 1), ceil($total_games / $games_par_page)))
);

include($phpbb_root_path . 'hall_of_fame.'.$phpEx);

//
// Output page header
$page_title = $lang['toparcade'];
include('includes/page_header.'.$phpEx);
$template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>