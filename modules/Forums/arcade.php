<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                arcade.php
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
$phpbb2_root_path = NUKE_FORUMS_DIR;
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);
require($phpbb2_root_path . 'gf_funcs/gen_funcs.' . $phpEx );
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

$arcade_catid = get_var_gf(array('name' => 'cid', 'intval' => true));
$phpbb2_start = get_var_gf(array('name' => 'start', 'intval' => true));

$arcade_config = array();
$arcade_config = read_arcade_config();

$liste_cat_auth = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'view');

if( empty($liste_cat_auth) ) {
        $liste_cat_auth = "''";
}

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

$favori = $HTTP_GET_VARS['favori'];
$delfavori = $HTTP_GET_VARS['delfavori'];

if ($actfav=$favori+$delfavori)
    {
    $sql = "SELECT COUNT(*) AS nbfav FROM ".ARCADE_FAV_TABLE." WHERE  user_id= ".$userdata['user_id']." AND game_id= ".$actfav;
    if( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql);
        }
    $row = $titanium_db->sql_fetchrow($result);
    $nbfav = $row['nbfav'];

    if (!$nbfav && $favori)
        {
            $sql = "INSERT INTO ". ARCADE_FAV_TABLE ." VALUES ('','".$userdata['user_id']."','$favori')";
            if( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql);
                }
        }

    elseif($delfavori)
        {
            $sql = "DELETE FROM ". ARCADE_FAV_TABLE ." WHERE  user_id= ".$userdata['user_id']." AND game_id= ".$delfavori;
            if( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql);
                }
        }
    };

$games_par_categorie = $arcade_config['category_preview_games'];

if (( $arcade_catid == 0 ) and ( $arcade_config['use_category_mod'] )) {
        $phpbb2_template->set_filenames(array(
                 'body' => 'arcade_cat_body.tpl')
        );

        $phpbb2_template->assign_vars(array(
                'URL_ARCADE' => '<nobr><a class="cattitle" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $titanium_lang['lib_arcade'] . '</a></nobr> ',
                'URL_BESTSCORES' => '<nobr><a class="cattitle" href="' . append_titanium_sid("toparcade.$phpEx") . '">' . $titanium_lang['best_scores'] . '</a></nobr> ',
                'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=$gid") . '">' . $titanium_lang['scoreboard'] . '</a></nobr> ',
                'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_titanium_sid("comments_list.$phpEx") . '">' . $titanium_lang['comments'] . '</a></nobr> ',
                'ARCADE_COL' => ($arcade_config['use_fav_category'])? 6:5,
                'ARCADE_COL1' => ($arcade_config['use_fav_category'])? 2:1,
                'FAV' => $titanium_lang['fav'],
                'L_GAME' => $titanium_lang['games'],
                'L_HIGHSCORE' => $titanium_lang['highscore'],
                'L_YOURSCORE' => $titanium_lang['yourbestscore'],
                'L_DESC' => $titanium_lang['desc_game'],
                'L_ARCADE' => $titanium_lang['lib_arcade'])
        );

    if($arcade_config['use_fav_category'])
        {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date, f.* FROM "
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            . GAMES_TABLE." g LEFT JOIN "
            . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN "
            . SCORES_TABLE . " s ON s.game_id = g.game_id and s.user_id = " . $userdata['user_id'] . " LEFT JOIN "
            . ARCADE_FAV_TABLE . " f ON f.game_id = g.game_id WHERE f.user_id=".$userdata['user_id'] ;

            if( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql);
            }
            if ($titanium_db->sql_numrows($result))
            {
                $phpbb2_template->assign_block_vars('favrow',array()) ;
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $frow['username'] = UsernameColor($frow['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                while( $frow = $titanium_db->sql_fetchrow($result))
                {
                $phpbb2_template->assign_block_vars('favrow.fav_row',array(
                'GAMENAMEF' => $frow[game_name],
                'DELFAVORI' => '<a href="' . append_titanium_sid("arcade.$phpEx?delfavori=" . $frow['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/delfavs.gif" border=0 alt="'.$titanium_lang['del_fav'].'"></a>',
                'GAMELINKF' => '<nobr><a href="' . append_titanium_sid("games.$phpEx?gid=" . $frow['game_id'] ) . '">' . $frow['game_name'] . '</a></nobr> ',
                'GAMEPOPUPLINKF' => "<a href='javascript:Arcade_Popup(\"".append_titanium_sid("gamespopup.$phpEx?gid=".$frow['game_id'] )."\", \"New_Window\",\"".$frow['game_width']."\",\"".$frow['game_height']."\", \"no\")'>New Window</a>",
                'GAMEPICF' => ( $frow['game_pic'] != '' ) ? "<a href='" . append_titanium_sid("games.$phpEx?gid=" . $frow['game_id'] ) . "'><img src='" . "modules/Forums/games/pics/" . $frow['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' vspace='2' hspace='2' alt='" . $frow['game_name'] . "' ></a>" : '' ,
                'GAMESETF' => ( $frow['game_set'] != 0  ) ? $titanium_lang['game_actual_nbset'] . $frow['game_set'] : '',
                'HIGHSCOREF' => number_format($frow['game_highscore']),
                'CLICKPLAY' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $frow['game_id'] ) . '">Click to Play!</a>',
                'YOURHIGHSCOREF' => number_format($frow['score_game']),
                'NORECORDF' => ( $frow['game_highscore'] == 0 ) ? $titanium_lang['no_record'] : '',
                'HIGHUSERF' => ( $frow['game_highuser'] != 0 ) ? '(' . $frow['username'] . ')' : '' ,
                'URL_SCOREBOARDF' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=" . $frow['game_id'] ) . '">' . "<img src='modules/Forums/templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $titanium_lang['scoreboard'] . " " . $frow['game_name'] . "'>" . '</a></nobr> ',
                'GAMEIDF' => $frow['game_id'],
                'DATEHIGHF' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $frow['game_highdate'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'YOURDATEHIGHF' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $frow['score_date'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'IMGFIRSTF' => ( $frow['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,
                'GAMEDESCF' => $frow['game_desc']
                ));

                if ( $frow['game_highscore'] !=0 )
                        {
                            $phpbb2_template->assign_block_vars('favrow.fav_row.recordrow',array()) ;
                        }
                if ( $frow['score_game'] !=0 )
                        {
                            $phpbb2_template->assign_block_vars('favrow.fav_row.yourrecordrow',array()) ;
                        }
                else        {
                            $phpbb2_template->assign_block_vars('favrow.fav_row.playrecordrow',array()) ;
                        }
                }
            }
        }

        $liste_jeux = array();

        $sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date FROM " . GAMES_TABLE . " g LEFT JOIN " . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN " . SCORES_TABLE . " s ON s.game_id = g.game_id and s.user_id = " . $userdata['user_id'] . " WHERE  g.arcade_catid IN ($liste_cat_auth) ORDER BY g.arcade_catid, $order_by";

        if( !($result = $titanium_db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Could not read arcade categories", '', __LINE__, __FILE__, $sql);
        }

        while( $row = $titanium_db->sql_fetchrow($result)) {
                $liste_jeux[$row['arcade_catid']][] = $row;
        }

        $sql = "SELECT arcade_catid, arcade_cattitle, arcade_nbelmt, arcade_catauth FROM " . ARCADE_CATEGORIES_TABLE . " WHERE  arcade_catid IN ($liste_cat_auth) ORDER BY arcade_catorder";

        if( !($result = $titanium_db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Could not read arcade categories", '', __LINE__, __FILE__, $sql);
        }

        while( $row = $titanium_db->sql_fetchrow($result)) {
                $nbjeux = sizeof($liste_jeux[$row['arcade_catid']]);

                if ($nbjeux > 0) {
                        $phpbb2_template->assign_block_vars('cat_row',array(
                                'U_ARCADE' => append_titanium_sid("arcade.$phpEx?cid=" . $row['arcade_catid'] ),
                                'LINKCAT_ALIGN' => ( $arcade_config['linkcat_align'] == '0' ) ? 'left' : ( ( $arcade_config['linkcat_align'] == '1' ) ? 'center' : 'right'),
                                'L_ARCADE' => sprintf($titanium_lang['Other_games'],$row['arcade_nbelmt']),
                                'CATTITLE' => $row['arcade_cattitle'])
                        );

                        $nbjeux = ( $nbjeux < $games_par_categorie ) ? $nbjeux : $games_par_categorie;

                        for ($i=0; $i<$nbjeux; $i++) {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                        $liste_jeux[$row['arcade_catid']][$i]['username'] = UsernameColor($liste_jeux[$row['arcade_catid']][$i]['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                $phpbb2_template->assign_block_vars('cat_row.game_row',array(
                                        'GAMENAME' => $liste_jeux[$row['arcade_catid']][$i]['game_name'],
                                        'GAMELINK' => '<nobr><a href="' . append_titanium_sid("games.$phpEx?gid=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) . '">' . $liste_jeux[$row['arcade_catid']][$i]['game_name'] . '</a></nobr> ',
                                        'GAMEPOPUPLINK' => "<a href='javascript:Arcade_Popup(\"".append_titanium_sid("gamespopup.$phpEx?gid=".$liste_jeux[$row['arcade_catid']][$i]['game_id'] )."\", \"New_Window\",\"".$liste_jeux[$row['arcade_catid']][$i]['game_width']."\",\"".$liste_jeux[$row['arcade_catid']][$i]['game_height']."\", \"no\")'>New Window</a>",
                                        'GAMEPIC' => ( $liste_jeux[$row['arcade_catid']][$i]['game_pic'] != '' ) ? "<a href='" . append_titanium_sid("games.$phpEx?gid=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) . "'><img src='".$phpbb2_root_path ."games/pics/" . $liste_jeux[$row['arcade_catid']][$i]['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' vspace='2' hspace='2' alt='" . $liste_jeux[$row['arcade_catid']][$i]['game_name'] . "' ></a>" : '' ,
                                        'GAMESET' => ( $liste_jeux[$row['arcade_catid']][$i]['game_set'] != 0  ) ? $titanium_lang['game_actual_nbset'] . $liste_jeux[$row['arcade_catid']][$i]['game_set'] : '',
                                        'HIGHSCORE' => number_format($liste_jeux[$row['arcade_catid']][$i]['game_highscore']),
                                        'YOURHIGHSCORE' => number_format($liste_jeux[$row['arcade_catid']][$i]['score_game']),
                                        'CLICKPLAY' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) . '">Click to Play!</a>',
                                        'NORECORD' => ( $liste_jeux[$row['arcade_catid']][$i]['game_highscore'] == 0 ) ? $titanium_lang['no_record'] : '',
                                        'HIGHUSER' => ( $liste_jeux[$row['arcade_catid']][$i]['game_highuser'] != 0 ) ? '(' . $liste_jeux[$row['arcade_catid']][$i]['username'] . ')' : '' ,
                                        'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) . '">' . "<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $titanium_lang['scoreboard'] . " " . $liste_jeux[$row['arcade_catid']][$i]['game_name'] . "'>" . '</a></nobr> ',
                                        'GAMEID' => $liste_jeux[$row['arcade_catid']][$i]['game_id'],
                                        'DATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $liste_jeux[$row['arcade_catid']][$i]['game_highdate'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                                        'YOURDATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $liste_jeux[$row['arcade_catid']][$i]['score_date'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                                        'IMGFIRST' => ( $liste_jeux[$row['arcade_catid']][$i]['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,
                                        'ADD_FAV' => ($arcade_config['use_fav_category'])?'<td class="row1" width="25" align="center" valign="center"><a href="' . append_titanium_sid("arcade.$phpEx?favori=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/favs.gif" border=0 alt="'.$titanium_lang['add_fav'].'"></a></td>':'',
                                        'GAMEDESC' => $liste_jeux[$row['arcade_catid']][$i]['game_desc'])
                                );

                                if ( $liste_jeux[$row['arcade_catid']][$i]['game_highscore'] !=0 ) {
                                        $phpbb2_template->assign_block_vars('cat_row.game_row.recordrow',array());
                                }

                                if ( $liste_jeux[$row['arcade_catid']][$i]['score_game'] !=0 ) {
                                        $phpbb2_template->assign_block_vars('cat_row.game_row.yourrecordrow',array());
                                }
                                else
                                {
                                        $phpbb2_template->assign_block_vars('cat_row.game_row.playrecordrow',array()) ;
                                }
                        }
                }
        }


        include($phpbb2_root_path . 'whoisplaying.'.$phpEx);

        //
        // Output page header
        include($phpbb2_root_path . 'headingarcade.'.$phpEx);
        $phpbb2_page_title = $titanium_lang['arcade'];
        include('includes/page_header.'.$phpEx);
        $phpbb2_template->pparse('body');
        include('includes/page_tail.'.$phpEx);
        exit;
}

$games_par_page = $arcade_config['games_par_page'];
$sql_where = '';
$limit = " LIMIT $phpbb2_start,$games_par_page ";

$total_phpbb2_games = 0;

if ( $arcade_config['use_category_mod']) {
        $sql_where = " WHERE  arcade_catid = $arcade_catid AND arcade_catid IN ($liste_cat_auth)";
        $sql = "SELECT arcade_cattitle, arcade_nbelmt AS nbgames FROM " . ARCADE_CATEGORIES_TABLE . " $sql_where";

        if( !($result = $titanium_db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Could not read the arcade categories table", '', __LINE__, __FILE__, $sql);
        }

        if ( $row = $titanium_db->sql_fetchrow($result)) {
                $total_phpbb2_games = $row['nbgames'];
        } else {
                message_die(GENERAL_MESSAGE,$titanium_lang['no_arcade_cat']);
        }

        $phpbb2_template->assign_block_vars('use_category_mod', array());
} else {
        $sql = "SELECT COUNT(*) AS nbgames FROM " . GAMES_TABLE;

        if( !($result = $titanium_db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql);
        }

        if ( $row = $titanium_db->sql_fetchrow($result)) {
                $total_phpbb2_games = $row['nbgames'];
        }
}

//chargement du template
$phpbb2_template->set_filenames(array(
        'body' => 'arcade_body.tpl')
);

$phpbb2_template->assign_vars(array(
        'URL_ARCADE' => '<nobr><a class="cattitle" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $titanium_lang['lib_arcade'] . '</a></nobr> ',
        'URL_BESTSCORES' => '<nobr><a class="cattitle" href="' . append_titanium_sid("toparcade.$phpEx") . '">' . $titanium_lang['best_scores'] . '</a></nobr> ',
        'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=$gid") . '">' . $titanium_lang['scoreboard'] . '</a></nobr> ',
        'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_titanium_sid("comments_list.$phpEx") . '">' . $titanium_lang['comments'] . '</a></nobr> ',
        'CATTITLE' => $row['arcade_cattitle'],
        'NAV_DESC' => '<a class="nav" href="' . append_titanium_sid("arcade.$phpEx") . '">' . $titanium_lang['arcade'] . '</a> ' ,
        'L_GAME' => $titanium_lang['games'],
        'PAGINATION' => generate_pagination(append_titanium_sid("arcade.$phpEx?cid=$arcade_catid"), $total_phpbb2_games, $games_par_page, $phpbb2_start),
        'PAGE_NUMBER' => sprintf($titanium_lang['Page_of'], ( floor( $phpbb2_start / $games_par_page ) + 1 ), ceil( $total_phpbb2_games / $games_par_page )),
        'ARCADE_COL' => ($arcade_config['use_fav_category'])? 6:5,
        'ARCADE_COL1' => ($arcade_config['use_fav_category'])? 2:1,
        'FAV' => $titanium_lang['fav'],
        'L_HIGHSCORE' => $titanium_lang['highscore'],
        'L_YOURSCORE' => $titanium_lang['yourbestscore'],
        'L_DESC' => $titanium_lang['desc_game'],
        'L_ARCADE' => $titanium_lang['lib_arcade'])
);
    if(($arcade_config['use_fav_category'])&&(!$arcade_config['use_category_mod']))
        {
            $sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date, f.* FROM "
            . GAMES_TABLE." g LEFT JOIN "
            . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN "
            . SCORES_TABLE . " s ON s.game_id = g.game_id and s.user_id = " . $userdata['user_id'] . " LEFT JOIN "
            . ARCADE_FAV_TABLE . " f ON f.game_id = g.game_id WHERE  f.user_id=".$userdata['user_id'] ;

            if( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql);
            }
            if ($titanium_db->sql_numrows($result))
            {
                $phpbb2_template->assign_block_vars('favrow',array()) ;

                while( $frow = $titanium_db->sql_fetchrow($result))
                {
                $phpbb2_template->assign_block_vars('favrow.fav_row',array(
                'GAMENAMEF' => $frow[game_name],
                'DELFAVORI' => '<a href="' . append_titanium_sid("arcade.$phpEx?delfavori=" . $frow['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/delfavs.gif" border=0 alt="'.$titanium_lang['del_fav'].'"></a>',
                'GAMELINKF' => '<nobr><a href="' . append_titanium_sid("games.$phpEx?gid=" . $frow['game_id'] ) . '">' . $frow['game_name'] . '</a></nobr> ',
                'GAMEPOPUPLINKF' => "<a href='javascript:Arcade_Popup(\"".append_titanium_sid("gamespopup.$phpEx?gid=".$frow['game_id'] )."\", \"New_Window\",\"".$frow['game_width']."\",\"".$frow['game_height']."\", \"no\")'>New Window</a>",
                'GAMEPICF' => ( $frow['game_pic'] != '' ) ? "<a href='" . append_titanium_sid("games.$phpEx?gid=" . $frow['game_id'] ) . "'><img src='" . "modules/Forums/games/pics/" . $frow['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' vspace='2' hspace='2' alt='" . $frow['game_name'] . "' ></a>" : '' ,
                'GAMESETF' => ( $frow['game_set'] != 0  ) ? $titanium_lang['game_actual_nbset'] . $frow['game_set'] : '',
                'HIGHSCOREF' => number_format($frow['game_highscore']),
                'CLICKPLAY' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $frow['game_id'] ) .'">Click to Play!</a>',
                'YOURHIGHSCOREF' => number_format($frow['score_game']),
                'NORECORDF' => ( $frow['game_highscore'] == 0 ) ? $titanium_lang['no_record'] : '',
                'HIGHUSERF' => ( $frow['game_highuser'] != 0 ) ? '(' . $frow['username'] . ')' : '' ,
                'URL_SCOREBOARDF' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=" . $frow['game_id'] ) . '">' . "<img src='modules/Forums/templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $titanium_lang['scoreboard'] . " " . $frow['game_name'] . "'>" . '</a></nobr> ',
                'GAMEIDF' => $frow['game_id'],
                'DATEHIGHF' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $frow['game_highdate'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'YOURDATEHIGHF' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $frow['score_date'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'IMGFIRSTF' => ( $frow['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='modules/Forums/templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,
                'GAMEDESCF' => $frow['game_desc']
                ));

                if ( $frow['game_highscore'] !=0 )
                        {
                            $phpbb2_template->assign_block_vars('favrow.fav_row.recordrow',array()) ;
                        }
                if ( $frow['score_game'] !=0 )
                        {
                            $phpbb2_template->assign_block_vars('favrow.fav_row.yourrecordrow',array()) ;
                        }
                        else
                        {
                            $phpbb2_template->assign_block_vars('favrow.fav_row.playrecordrow',array()) ;
                        }
                }
            }
        }

$sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date FROM " . GAMES_TABLE . " g LEFT JOIN " . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN " . SCORES_TABLE . " s ON s.game_id = g.game_id and s.user_id = " . $userdata['user_id'] . " $sql_where ORDER BY $order_by $limit";

if( !($result = $titanium_db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql);
}

while( $row = $titanium_db->sql_fetchrow($result) ) {
        $phpbb2_template->assign_block_vars('gamerow', array(
                'GAMENAME' => $row['game_name'],
                'GAMEPIC' => ( $row['game_pic'] != '' ) ? "<a href='" . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . "'><img src='".$phpbb2_root_path ."games/pics/" . $row['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' alt='" . $row['game_name'] . "' ></a>" : '' ,
                'GAMESET' => ( $row['game_set'] != 0  ) ? $titanium_lang['game_actual_nbset'] . $row['game_set'] : '',
                'GAMEDESC' => $row['game_desc'],
                'HIGHSCORE' => number_format($row['game_highscore']),
                'YOURHIGHSCORE' => number_format($row['score_game']),
                'CLICKPLAY' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">Click to Play!</a>',
                'NORECORD' => ( $row['game_highscore'] == 0 ) ? $titanium_lang['no_record'] : '',
                'HIGHUSER' => ( $row['game_highuser'] != 0 ) ? '(' . $row['username'] . ')' : '' ,
                'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_titanium_sid("scoreboard.$phpEx?gid=" . $row['game_id'] ) . '">' . "<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $titanium_lang['scoreboard'] . " " . $row['game_name'] . "'>" . '</a></nobr> ',
                'GAMEID' => $row['game_id'],
                'DATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $row['game_highdate'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'YOURDATEHIGH' => "<nobr>" . create_date( $phpbb2_board_config['default_dateformat'] , $row['score_date'] , $phpbb2_board_config['board_timezone'] ) . "</nobr>",
                'IMGFIRST' => ( $row['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb2_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,
                'ADD_FAV' => ($arcade_config['use_fav_category'])?'<td class="row1" width="25" align="center" valign="center"><a href="' . append_titanium_sid("arcade.$phpEx?favori=" . $row['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/favs.gif" border=0 alt="'.$titanium_lang['add_fav'].'"></a></td>':'',
                'GAMELINK' => '<nobr><a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">' . $row['game_name'] . '</a></nobr> ' ,
                'GAMEPOPUPLINK' => "<a href='javascript:Arcade_Popup(\"".append_titanium_sid("gamespopup.$phpEx?gid=".$row['game_id'] )."\", \"New_Window\",\"".$row['game_width']."\",\"".$row['game_height']."\", \"no\")'>New Window</a>")
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

include($phpbb2_root_path . 'whoisplaying.'.$phpEx);

//
// Output page header
include($phpbb2_root_path . 'headingarcade.'.$phpEx);
$phpbb2_page_title = $titanium_lang['arcade'];
include('includes/page_header.'.$phpEx);
$phpbb2_template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>