<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             arcade_search.php
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
$phpbb2_root_path = NUKE_FORUMS_DIR;
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);
require( $phpbb2_root_path . 'gf_funcs/gen_funcs.' . $phpEx );
include('includes/constants.'. $phpEx);

//
// Start session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_ARCADES, $nukeuser);
titanium_init_userprefs($userdata);
//
// End session management
//
include('includes/functions_arcade.' . $phpEx);
//
// Start auth check
//
if (!$userdata['session_logged_in']) {
        $header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
        header($header_location . "modules.php?name=Your_Account");
        exit;
}
//
// End of auth check
//


$x = intval($HTTP_GET_VARS['x']);
//Games user hasn't played
if($x == 1)
{

//Reads your ACP Arcade settings...
$arcade_config = array();
$arcade_config = read_arcade_config();

//Sets the order by for the games based ON you ACP settings
$order_by = '';
switch ( $arcade_config['game_order']) {
        case 'Alpha':
            $order_by = ' game_name ASC ';
            break;

        case 'Popular':
            $order_by = ' game_set DESC ';
            break;

        case 'Fixed':
            $order_by = ' game_order ASC ';
            break;

        case 'Random':
            $order_by = ' RAND() ';
            break;

        case 'News':
            $order_by = ' game_id DESC ';
            break;

        default :
            $order_by = ' game_order ASC ';
            break;
}


$phpbb2_template->set_filenames(array(
        'body' => 'arcade_body.tpl')
);

$phpbb2_template->assign_vars(array(
        'URL_ARCADE' => '<nobr><a class="cattitle" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $lang['lib_arcade'] . '</a></nobr> ',
        'URL_BESTSCORES' => '<nobr><a class="cattitle" href="' . append_titanium_sid("toparcade.$phpEx") . '">' . $lang['best_scores'] . '</a></nobr> ',
        'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=$gid") . '">' . $lang['scoreboard'] . '</a></nobr> ',
        'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_titanium_sid("comments_list.$phpEx") . '">' . $lang['comments'] . '</a></nobr> ',
        'CATTITLE' => 'Games I haven\'t played',
        'NAV_DESC' => '<a class="nav" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ' ,
        'L_GAME' => $lang['games'],
        'ARCADE_COL' => ($arcade_config['use_fav_category'])? 6:5,
        'ARCADE_COL1' => ($arcade_config['use_fav_category'])? 2:1,
        'FAV' => $lang['fav'],
        'L_HIGHSCORE' => $lang['highscore'],
        'L_YOURSCORE' => $lang['yourbestscore'],
        'L_DESC' => $lang['desc_game'],
        'L_ARCADE' => $lang['lib_arcade'])
);

$sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date FROM " . GAMES_TABLE . " g LEFT JOIN " . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN " . SCORES_TABLE . " s ON s.game_id = g.game_id AND s.user_id = " . $userdata['user_id'] . " ORDER BY $order_by";

if( !($result = $titanium_db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Unable to retrieve game AND score data", '', __LINE__, __FILE__, $sql);
}

$total_phpbb2_match_count = 0;

while( $row = $titanium_db->sql_fetchrow($result) ) {
        //Displays ON the games that you have no score/haven't played
        if($row['score_game'] == 0)
         {
                $total_phpbb2_match_count++;
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $phpbb2_template->assign_block_vars('gamerow', array(
                'GAMENAME' => $row['game_name'],
                'GAMEPIC' => ( $row['game_pic'] != '' ) ? "<a href='" . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . "'><img src='".$phpbb2_root_path ."games/pics/" . $row['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' alt='" . $row['game_name'] . "' ></a>" : '' ,
                'GAMESET' => ( $row['game_set'] != 0  ) ? $lang['game_actual_nbset'] . $row['game_set'] : '',
                'GAMEDESC' => $row['game_desc'],
                'HIGHSCORE' => number_format($row['game_highscore']),
                'YOURHIGHSCORE' => number_format($row['score_game']),
                'CLICKPLAY' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">Click to Play!</a>',
                'NORECORD' => ( $row['game_highscore'] == 0 ) ? $lang['no_record'] : '',
                'HIGHUSER' => ( $row['game_highuser'] != 0 ) ? '(' . $row['username'] . ')' : '' ,
                'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=" . $row['game_id'] ) . '">' . "<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang['scoreboard'] . " " . $row['game_name'] . "'>" . '</a></nobr> ',
                'GAMEID' => $row['game_id'],
                'DATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $row['game_highdate'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'YOURDATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $row['score_date'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'IMGFIRST' => ( $row['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,
                'ADD_FAV' => ($arcade_config['use_fav_category'])?'<td class="row1" width="25" align="center" valign="center"><a href="' . append_titanium_sid("arcade.$phpEx?favori=" . $row['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/favs.gif" border=0 alt="'.$lang['add_fav'].'"></a></td>':'',
                'GAMEPOPUPLINK' => "<a href='javascript:Arcade_Popup(\"".append_titanium_sid("gamespopup.$phpEx?gid=".$row['game_id'] )."\", \"New_Window\",\"".$row['game_width']."\",\"".$row['game_height']."\", \"no\")'>New Window</a>",
                'GAMELINK' => '<nobr><a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">' . $row['game_name'] . '</a></nobr> ' )
        );

        if ( $row['game_highscore'] !=0 ) {
                $phpbb2_template->assign_block_vars('gamerow.recordrow',array());
        }

        if ( $row['score_game'] !=0 ) {
                $phpbb2_template->assign_block_vars('gamerow.yourrecordrow',array());
        }
        else
        {
            $phpbb2_template->assign_block_vars('gamerow.playrecordrow',array()) ;
        }
         }
}


//Sets the number of total search results to be displayed.
$l_search_matches = ( $total_phpbb2_match_count == 1 ) ? sprintf($lang['Found_search_match'], $total_phpbb2_match_count) : sprintf($lang['Found_search_matches'], $total_phpbb2_match_count);

$phpbb2_template->assign_block_vars('arcade_search', array(
                'L_SEARCH_MATCHES' => $l_search_matches));




//
// Output page header
include($phpbb2_root_path . 'headingarcade.'.$phpEx);
include($phpbb2_root_path . 'whoisplaying.'.$phpEx);
$phpbb2_page_title = $lang['arcade'];
include('includes/page_header.'.$phpEx);
$phpbb2_template->pparse('body');
include('includes/page_tail.'.$phpEx);

}

//Newest Games
if($x == 2)
{

//Reads your ACP Arcade settings...
$arcade_config = array();
$arcade_config = read_arcade_config();

//Total number of Newest Games to display
$total_phpbb2_match_count = 25;

$phpbb2_template->set_filenames(array(
        'body' => 'arcade_body.tpl')
);

$phpbb2_template->assign_vars(array(
        'URL_ARCADE' => '<nobr><a class="cattitle" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $lang['lib_arcade'] . '</a></nobr> ',
        'URL_BESTSCORES' => '<nobr><a class="cattitle" href="' . append_titanium_sid("toparcade.$phpEx") . '">' . $lang['best_scores'] . '</a></nobr> ',
        'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=$gid") . '">' . $lang['scoreboard'] . '</a></nobr> ',
        'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_titanium_sid("comments_list.$phpEx") . '">' . $lang['comments'] . '</a></nobr> ',
        'CATTITLE' => $total_phpbb2_match_count. ' Newest Games',
        'NAV_DESC' => '<a class="nav" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ' ,
        'L_GAME' => $lang['games'],
        'ARCADE_COL' => ($arcade_config['use_fav_category'])? 6:5,
        'ARCADE_COL1' => ($arcade_config['use_fav_category'])? 2:1,
        'FAV' => $lang['fav'],
        'L_HIGHSCORE' => $lang['highscore'],
        'L_YOURSCORE' => $lang['yourbestscore'],
        'L_DESC' => $lang['desc_game'],
        'L_ARCADE' => $lang['lib_arcade'])
);

$sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date FROM " . GAMES_TABLE . " g LEFT JOIN " . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN " . SCORES_TABLE . " s ON s.game_id = g.game_id AND s.user_id = " . $userdata['user_id'] . " ORDER BY g.game_order DESC LIMIT 0, $total_phpbb2_match_count";

if( !($result = $titanium_db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Unable to retrieve game AND score data", '', __LINE__, __FILE__, $sql);
}

while( $row = $titanium_db->sql_fetchrow($result) ) {
        //Displays ON the games that you have no score/haven't played
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $phpbb2_template->assign_block_vars('gamerow', array(
                'GAMENAME' => $row['game_name'],
                'GAMEPIC' => ( $row['game_pic'] != '' ) ? "<a href='" . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . "'><img src='".$phpbb2_root_path ."games/pics/" . $row['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' alt='" . $row['game_name'] . "' ></a>" : '' ,
                'GAMESET' => ( $row['game_set'] != 0  ) ? $lang['game_actual_nbset'] . $row['game_set'] : '',
                'GAMEDESC' => $row['game_desc'],
                'HIGHSCORE' => number_format($row['game_highscore']),
                'YOURHIGHSCORE' => number_format($row['score_game']),
                'CLICKPLAY' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">Click to Play!</a>',
                'NORECORD' => ( $row['game_highscore'] == 0 ) ? $lang['no_record'] : '',
                'HIGHUSER' => ( $row['game_highuser'] != 0 ) ? '(' . $row['username'] . ')' : '' ,
                'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=" . $row['game_id'] ) . '">' . "<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang['scoreboard'] . " " . $row['game_name'] . "'>" . '</a></nobr> ',
                'GAMEID' => $row['game_id'],
                'DATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $row['game_highdate'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'YOURDATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $row['score_date'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'IMGFIRST' => ( $row['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,
                'ADD_FAV' => ($arcade_config['use_fav_category'])?'<td class="row1" width="25" align="center" valign="center"><a href="' . append_titanium_sid("arcade.$phpEx?favori=" . $row['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/favs.gif" border=0 alt="'.$lang['add_fav'].'"></a></td>':'',
                'GAMEPOPUPLINK' => "<a href='javascript:Arcade_Popup(\"".append_titanium_sid("gamespopup.$phpEx?gid=".$row['game_id'] )."\", \"New_Window\",\"".$row['game_width']."\",\"".$row['game_height']."\", \"no\")'>New Window</a>",
                'GAMELINK' => '<nobr><a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">' . $row['game_name'] . '</a></nobr> ' )
        );

        if ( $row['game_highscore'] !=0 ) {
                $phpbb2_template->assign_block_vars('gamerow.recordrow',array());
        }

        if ( $row['score_game'] !=0 ) {
                $phpbb2_template->assign_block_vars('gamerow.yourrecordrow',array());
        }
        else
        {
            $phpbb2_template->assign_block_vars('gamerow.playrecordrow',array()) ;
        }
         }



//Sets the number of total search results to be displayed.
$l_search_matches = ( $total_phpbb2_match_count == 1 ) ? sprintf($lang['Found_search_match'], $total_phpbb2_match_count) : sprintf($lang['Found_search_matches'], $total_phpbb2_match_count);

$phpbb2_template->assign_block_vars('arcade_search', array(
                'L_SEARCH_MATCHES' => $l_search_matches));




//
// Output page header
include($phpbb2_root_path . 'headingarcade.'.$phpEx);
include($phpbb2_root_path . 'whoisplaying.'.$phpEx);
$phpbb2_page_title = $lang['arcade'];
include('includes/page_header.'.$phpEx);
$phpbb2_template->pparse('body');
include('includes/page_tail.'.$phpEx);

}
        //Arcade Search is called
        //Return Search string AND format it.
        $srchstring = $HTTP_POST_VARS['srchstring'];
        $srchstring="*".$srchstring."*";
    if (trim($srchstring) <> "**")
        {
        // replace wildcards */? to use with mysql "LIKE"
        $search = str_replace("_", "\\_", $srchstring);
        $search = str_replace("%", "\\%", $search);
        $search = str_replace("*", "%" , $search);
        $search = str_replace("?", "_" , $search);
        }

        //Sets search by game name or description
        $searchin = $HTTP_POST_VARS['searchin'];
        if($searchin == 'name')
        {
        $where_search= "WHERE game_name LIKE '$search'";
        }
        elseif($searchin == 'desc')
        {
        $where_search= "WHERE game_desc LIKE '$search'";
        }

//Reads your ACP Arcade settings...
$arcade_config = array();
$arcade_config = read_arcade_config();

//Gets total games from you search results AND set the number of total search results.
$sql = "SELECT COUNT(*) as total_games FROM " . GAMES_TABLE . " $where_search";

        if( !($result = $titanium_db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Unable to retrieve data from game table", '', __LINE__, __FILE__, $sql);
        }


        $row = $titanium_db->sql_fetchrow($result);
        $total_phpbb2_match_count = $row['total_games'];
        $l_search_matches = ( $total_phpbb2_match_count == 1 ) ? sprintf($lang['Found_search_match'], $total_phpbb2_match_count) : sprintf($lang['Found_search_matches'], $total_phpbb2_match_count);

//Sets the order by for the games based ON you ACP settings
$order_by = '';
switch ( $arcade_config['game_order']) {
        case 'Alpha':
            $order_by = ' game_name ASC ';
            break;

        case 'Popular':
            $order_by = ' game_set DESC ';
            break;

        case 'Fixed':
            $order_by = ' game_order ASC ';
            break;

        case 'Random':
            $order_by = ' RAND() ';
            break;

        case 'News':
            $order_by = ' game_id DESC ';
            break;

        default :
            $order_by = ' game_order ASC ';
            break;
}


$phpbb2_template->set_filenames(array(
        'body' => 'arcade_body.tpl')
);

$phpbb2_template->assign_block_vars('arcade_search', array(
                'L_SEARCH_MATCHES' => $l_search_matches));

$phpbb2_template->assign_vars(array(
        'URL_ARCADE' => '<nobr><a class="cattitle" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $lang['lib_arcade'] . '</a></nobr> ',
        'URL_BESTSCORES' => '<nobr><a class="cattitle" href="' . append_titanium_sid("toparcade.$phpEx") . '">' . $lang['best_scores'] . '</a></nobr> ',
        'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=$gid") . '">' . $lang['scoreboard'] . '</a></nobr> ',
        'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_titanium_sid("comments_list.$phpEx") . '">' . $lang['comments'] . '</a></nobr> ',
        'CATTITLE' => 'Arcade Search',
        'NAV_DESC' => '<a class="nav" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ' ,
        'L_GAME' => $lang['games'],
        'ARCADE_COL' => ($arcade_config['use_fav_category'])? 6:5,
        'ARCADE_COL1' => ($arcade_config['use_fav_category'])? 2:1,
        'FAV' => $lang['fav'],
        'L_HIGHSCORE' => $lang['highscore'],
        'L_YOURSCORE' => $lang['yourbestscore'],
        'L_DESC' => $lang['desc_game'],
        'L_ARCADE' => $lang['lib_arcade'])
);

$sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date FROM " . GAMES_TABLE . " g LEFT JOIN " . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN " . SCORES_TABLE . " s ON s.game_id = g.game_id AND s.user_id = " . $userdata['user_id'] . " $where_search ORDER BY $order_by";

if( !($result = $titanium_db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Could not read from the games/users table", '', __LINE__, __FILE__, $sql);
}

while( $row = $titanium_db->sql_fetchrow($result) ) {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $phpbb2_template->assign_block_vars('gamerow', array(
                'GAMENAME' => $row['game_name'],
                'GAMEPIC' => ( $row['game_pic'] != '' ) ? "<a href='" . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . "'><img src='".$phpbb2_root_path ."games/pics/" . $row['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' alt='" . $row['game_name'] . "' ></a>" : '' ,
                'GAMESET' => ( $row['game_set'] != 0  ) ? $lang['game_actual_nbset'] . $row['game_set'] : '',
                'GAMEDESC' => $row['game_desc'],
                'HIGHSCORE' => number_format($row['game_highscore']),
                'YOURHIGHSCORE' => number_format($row['score_game']),
                'CLICKPLAY' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">Click to Play!</a>',
                'NORECORD' => ( $row['game_highscore'] == 0 ) ? $lang['no_record'] : '',
                'HIGHUSER' => ( $row['game_highuser'] != 0 ) ? '(' . $row['username'] . ')' : '' ,
                'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=" . $row['game_id'] ) . '">' . "<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang['scoreboard'] . " " . $row['game_name'] . "'>" . '</a></nobr> ',
                'GAMEID' => $row['game_id'],
                'DATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $row['game_highdate'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'YOURDATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $row['score_date'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'IMGFIRST' => ( $row['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,
                'ADD_FAV' => ($arcade_config['use_fav_category'])?'<td class="row1" width="25" align="center" valign="center"><a href="' . append_titanium_sid("arcade.$phpEx?favori=" . $row['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/favs.gif" border=0 alt="'.$lang['add_fav'].'"></a></td>':'',
                'GAMEPOPUPLINK' => "<a href='javascript:Arcade_Popup(\"".append_titanium_sid("gamespopup.$phpEx?gid=".$row['game_id'] )."\", \"New_Window\",\"".$row['game_width']."\",\"".$row['game_height']."\", \"no\")'>New Window</a>",
                'GAMELINK' => '<nobr><a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">' . $row['game_name'] . '</a></nobr> ' )
        );

        if ( $row['game_highscore'] !=0 ) {
                $phpbb2_template->assign_block_vars('gamerow.recordrow',array());
        }

        if ( $row['score_game'] !=0 ) {
                $phpbb2_template->assign_block_vars('gamerow.yourrecordrow',array());
        }
        else
        {
            $phpbb2_template->assign_block_vars('gamerow.playrecordrow',array());
        }
}

//
// Output page header
include($phpbb2_root_path . 'headingarcade.'.$phpEx);
include($phpbb2_root_path . 'whoisplaying.'.$phpEx);
$phpbb2_page_title = $lang['arcade'];
include('includes/page_header.'.$phpEx);
$phpbb2_template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>