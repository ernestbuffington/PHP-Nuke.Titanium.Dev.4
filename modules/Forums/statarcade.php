<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              statarcade.php
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

$uid = get_var_gf(array('name' => 'uid', 'intval' => true, 'default' => 0));

if ($uid == 0) {
  message_die(GENERAL_ERROR, "Unknown user", '');
}

$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_STATARCADES, $nukeuser);
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
        'body' => 'statarcade_body.tpl')
);

$arcade_config = array();
$arcade_config = read_arcade_config();

$sql = "SELECT username, user_avatar_type, user_allowavatar, user_avatar FROM " . USERS_TABLE . " WHERE user_id = " . $uid ;

if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read the users table", '', __LINE__, __FILE__, $sql);
}

$row = $db->sql_fetchrow($result);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
$statuser = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
$user_avatar_type = $row['user_avatar_type'];
$user_allowavatar = $row['user_allowavatar'];
$user_avatar = $row['user_avatar'];
$avatar_img = '';

if ( $user_avatar_type && $user_allowavatar )
{
   switch( $user_avatar_type )
   {
      case USER_AVATAR_UPLOAD:
         $avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img class="rounded-corners-user-info" 
		 src="' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" border="0" hspace="20" align="center" valign="center"/>' : '';
         break;
      case USER_AVATAR_REMOTE:
         $avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img class="rounded-corners-user-info" 
		 src="' . $user_avatar . '" alt="" border="0"  hspace="20" align="center" valign="center" />' : '';
         break;
      case USER_AVATAR_GALLERY:
         $avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img class="rounded-corners-user-info" 
		 src="' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" border="0"  hspace="20" align="center" valign="center" />' : '';
         break;
   }

}

$nbcol = 2;
$liste_cat_auth = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'view');

if (empty($liste_cat_auth)) {
        $liste_cat_auth = "''";
}

$sql = "SELECT COUNT(*) AS nbtot FROM " . SCORES_TABLE . " s, " . GAMES_TABLE . " g  WHERE s.game_id = g.game_id AND g.arcade_catid IN ($liste_cat_auth) AND user_id = " . $uid;

if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read the scores table", '', __LINE__, __FILE__, $sql);
}

if ($row=$db->sql_fetchrow($result)) {
        $total_games = $row['nbtot'];
} else {
        $total_games = 0;
}

$start = get_var_gf(array('name' => 'start', 'intval' => true));
$limit_sql = (intval($arcade_config['stat_par_page']) > 0) ? " LIMIT $start," . intval($arcade_config['stat_par_page']) : '';

$sql = "SELECT s.*, g.* FROM " . SCORES_TABLE . " s LEFT JOIN " . GAMES_TABLE . " g ON g.game_id = s.game_id WHERE g.arcade_catid IN ($liste_cat_auth) AND s.user_id = " . $uid . " ORDER BY g.game_name ASC $limit_sql";

if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read the users/scores/games table", '', __LINE__, __FILE__, $sql);
}

$gamelist = array();
$liste_id = '';

while ($row=$db->sql_fetchrow($result)) {
        $gamelist[] = $row;
        $liste_id .= (!empty($liste_id)) ? ', ' : '';
        $liste_id .= "'" . $row['game_id'] . "'";
}

$games_par_page = intval($arcade_config['stat_par_page']);
$where_sql = (!empty($liste_id)) ? " AND s1.game_id IN ($liste_id)" : '';

//MAriaDB no longer supports SQL_BIG_SELECTS
//$sql = "SET OPTION SQL_BIG_SELECTS=1 ";
//$db->sql_query($sql);
$sql = "SELECT count(*) AS pos, s1.game_id , g.game_highuser, g.game_name 
FROM " . SCORES_TABLE . " s1 
LEFT JOIN " . SCORES_TABLE . " s2 
ON s1.score_game >= s2.score_game 
AND s1.game_id = s2.game_id 
LEFT JOIN " . GAMES_TABLE . " g 
ON g.game_id = s1.game_id 
WHERE s2.user_id = $uid AND ((s1.score_game > s2.score_game) 
OR (s1.user_id = $uid)) $where_sql 
GROUP BY s1.game_id";

if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read the scores table", '', __LINE__, __FILE__, $sql);
}

while ($row = $db->sql_fetchrow($result)) {
        $tbpos[ $row['game_id'] ] = $row['pos'];
        $tbhighuser[ $row['game_id'] ] = $row['game_highuser'];
}

$fini = false;

if (!$row = $db->sql_fetchrow($result)) {
        $fini=true;
}

$template->assign_vars(array(
        'PAGINATION' => generate_pagination(append_sid("statarcade.$phpEx?uid=$uid"), $total_games, $games_par_page, $start),
        'PAGE_NUMBER' => sprintf($lang['Page_of'], (floor($start / $games_par_page) + 1), ceil($total_games / $games_par_page)),
        'URL_ARCADE' => '<nobr><a class="arcadeTitleLink" href="' . append_sid("arcade.$phpEx") . '">' . $lang['lib_arcade'] . '</a></nobr> ',
        'URL_BESTSCORES' => '<nobr><a class="arcadeTitleLink" href="' . append_sid("toparcade.$phpEx") . '">' . $lang['best_scores'] . '</a></nobr> ',
        'USER_AVATAR' => '<a href="modules.php?name=Forums&file=profile&mode=viewprofile&u=' . $uid . '">' . $avatar_img . '</a>',
        'L_STATS' => $lang['statuser'] . ' ' . $statuser)
);


$nbjeux = count($gamelist);
$i = 0;
$fini = ($i == $nbjeux) ? true : false;

while(!$fini) {
        $template->assign_block_vars('blkligne', array());

        for ($cg = 1; $cg <= $nbcol; $cg++) {
                $template->assign_block_vars('blkligne.blkcolonne', array());

                if (!$fini) {
                        if ($gamelist[$i]['score_set'] != 0) {
                                $total_time = sec2hms($gamelist[$i]['score_time']);
                                $scoremoy = round($gamelist[$i]['score_time'] / $gamelist[$i]['score_set']);
                                $avgtime = sec2hms($scoremoy);

                        }


                        $pos = (isset($tbpos[ $gamelist[$i]['game_id'] ])) ? $tbpos[ $gamelist[$i]['game_id'] ] : 1;

                        $template->assign_block_vars('blkligne.blkcolonne.blkgame', array(
                                'GAMENAME' => '<nobr><a class="arcadeTitleLink" href="' . append_sid("games.$phpEx?gid=" . $gamelist[$i]['game_id']) . '">' . $gamelist[$i]['game_name'] . '</a></nobr> ',
                                'L_NBSET' => $lang['statnbset'],
                                'NBSET' =>  ($gamelist[$i]['score_set'] == 0) ? "n/a" : $gamelist[$i]['score_set'],
                                'L_TPSSET' => $lang['stattottime'],
                                'TPSSET' => ($gamelist[$i]['score_set'] == 0) ? "n/a" : $total_time,
                                'L_HIGHSCR' => $lang['stathighscore'],
                                'HIGHSCR' => number_format($gamelist[$i]['score_game']),
                                'L_DATHIGHSCR' => $lang['statdatehigh'],
                                'DATHIGHSCR' => create_date($board_config['default_dateformat'] , $gamelist[$i]['score_date'] , $board_config['board_timezone']),
                                'L_POSGAME' => $lang['statposition'],
                                'POSGAME' => ( $pos == 1 ) ? $pos . "st" : ( ( $pos == 2 ) ? $pos . "nd" : ( ( $pos == 3 ) ? $pos . "rd" : $pos . "th" ) ),
                                'IMGFIRST' => ( $tbhighuser[ $gamelist[$i]['game_id'] ] == $uid ) ? "<img width='19' src='".$phpbb_root_path . "templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,
                                'L_TPSMOY' => $lang['statmedtime'],
                                'TPSMOY' =>  ($gamelist[$i]['score_set'] == 0) ? "n/a" : $avgtime)
                        );


                        $i++;
                        $fini = ($i == $nbjeux) ? true : false;
                }
        }
}

//
// Output page header
$page_title = $lang['statarcade_user'];
include('includes/page_header.'.$phpEx);
$template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>