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
	  PHP-Nuke Titanium Patched                v4.0.3       10/31/2022 
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die('You can\'t access this file directly...');
}

if ( $popup != "1" ) :
  $module_name = basename( dirname( __FILE__ ) );
  require( "modules/".$module_name."/nukebb.php" );
else :
  $phpbb_root_path = NUKE_FORUMS_DIR;
endif;

define('IN_PHPBB',true);

global $br, $userinfo;

$phpbb_root_path = NUKE_FORUMS_DIR;

include($phpbb_root_path.'extension.inc');
include($phpbb_root_path.'common.'. $phpEx );
require($phpbb_root_path.'gf_funcs/gen_funcs.'.$phpEx);

include('includes/constants.'.$phpEx);

# Start session management
$userdata = session_pagestart($user_ip,PAGE_ARCADES);
init_userprefs($userdata);
# End session management

include('includes/functions_arcade.'.$phpEx);

# Start auth check
if(!$userdata['session_logged_in']):
  $header_location = (preg_match("/Microsoft|WebSTAR|Xitami/", getenv( "SERVER_SOFTWARE" ))) ? "Refresh: 0; URL=" : "Location: ";
  header($header_location."modules.php?name=Your_Account");
  exit;
endif;
# End of auth check

$arcade_catid = get_var_gf(array('name' => 'cid','intval' => true));
$start = get_var_gf(array('name' => 'start','intval' => true ));

$arcade_config = array();
$arcade_config = read_arcade_config();

$liste_cat_auth = get_arcade_categories($userinfo['user_id'], $userinfo['user_level'],'view');

if (empty($liste_cat_auth)) {
    $liste_cat_auth = "''";
}

$order_by = '';

switch($arcade_config['game_order']):
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
  default:
    $order_by = ' game_order ASC ';
    break;
endswitch;

if (isset($_GET['favori'])) {
    $favori = intval($_GET['favori']);
}

if (isset($_GET['delfavori'])) {
    $delfavori = intval($_GET['delfavori']);
}

/** @var type $favori - the fumes from her snatch made me dizzy and as i dazed into her eyes I could see she was bat shit crazy */
if($favori):
  
    $sql = "SELECT COUNT(*) AS `nbfav` FROM `".ARCADE_FAV_TABLE."` WHERE user_id =".$userinfo['user_id']." AND game_id=".$favori;
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $nbfav = $row['nbfav'];

    if(!$nbfav && $favori):
    $sql = "REPLACE INTO ".ARCADE_FAV_TABLE." VALUES (0,'".$userinfo['user_id']."','$favori')"; # changed to REPLACE INTO 10/22/2022 TheGhost
    endif;
  
    if(!($result = $db->sql_query($sql))): 
    message_die( GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql );
    endif;
    header("Location: modules.php?name=Forums&file=arcade"); # dont echo the file number you are deleting from favorites!
    exit();
	
elseif($delfavori): 
    
    $sql = "DELETE FROM ".ARCADE_FAV_TABLE." WHERE user_id=".$userinfo[ 'user_id' ]." AND game_id=".$delfavori;
    if(!($result = $db->sql_query($sql))): 
    message_die( GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql );
    endif;
    header("Location: modules.php?name=Forums&file=arcade"); # dont echo the file number you are adding to favorites!
    exit();

endif;

$games_par_categorie = $arcade_config['category_preview_games'];

if(($arcade_catid == 0 ) && ($arcade_config['use_category_mod'])):
  
  $template->set_filenames(array(
    'body' => 'arcade_cat_body.tpl' ));

  $template->assign_vars(array(
    
	'URL_ARCADE' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "arcade.$phpEx" ) . '">' . $lang[ 'lib_arcade' ] . '</a></nobr> ',
    
	'URL_BESTSCORES' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "toparcade.$phpEx" ) . '">' . $lang[ 'best_scores' ] . '</a></nobr> ',
    
	'URL_SCOREBOARD' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "scoreboard.$phpEx?gid=$gid" ) . '">' . $lang[ 'scoreboard' ] . '</a></nobr> ',
    
	'MANAGE_COMMENTS' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "comments_list.$phpEx" ) . '">' . $lang[ 'comments' ] . '</a></nobr> ',
    
	'ARCADE_COL' => ( $arcade_config[ 'use_fav_category' ] ) ? 6 : 5,
    
	'ARCADE_COL1' => ( $arcade_config[ 'use_fav_category' ] ) ? 2 : 1,
    
	'FAV' => $lang[ 'fav' ],
    
	'L_GAME' => $lang[ 'games' ],
    
	'L_HIGHSCORE' => $lang[ 'highscore' ],
    
	'L_YOURSCORE' => $lang[ 'yourbestscore' ],
    
	'L_DESC' => $lang[ 'desc_game' ],
    
	'L_ARCADE' => $lang[ 'lib_arcade' ] ) );

  if($arcade_config['use_fav_category' ]):
    
    $sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date, f.* FROM "
    
    . GAMES_TABLE . " g LEFT JOIN "
    . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN "
    . SCORES_TABLE . " s ON s.game_id = g.game_id and s.user_id = " . $userinfo[ 'user_id' ] . " LEFT JOIN "
    . ARCADE_FAV_TABLE . " f ON f.game_id = g.game_id WHERE f.user_id=" . $userinfo[ 'user_id' ];

    if(!($result = $db->sql_query($sql))): 
    message_die( GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql );
    endif;

    if($db->sql_numrows($result)):
	  
      # FAVORITES ARCADE TABLE
      $template->assign_block_vars('favrow',array());
      
       while($frow = $db->sql_fetchrow($result)) :
        
		$template->assign_block_vars('favrow.fav_row',array(
        
		  'GAMENAMEF' => $frow['game_name'],
          
		  'DELFAVORI' => '<a class="arcadeTitleLink" href="'.append_sid("arcade.$phpEx?delfavori=".$frow['game_id']).'"><i class="bi bi-x-square"></i></br>Del Favorite</a>', 
          
		  'GAMELINKF' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "games.$phpEx?gid=" . $frow[ 'game_id' ] ) . '">' . $frow[ 'game_name' ] . '</a></nobr> ',
          
		  'GAMEPOPUPLINKF' => "<a 
		  class='popup' href='javascript:Arcade_Popup(\"" . append_sid("gamespopup.$phpEx?gid=".$frow[ 'game_id' ])."\", \"New_Window\",\"".$frow[ 'game_width' ]."\",\"".$frow[ 'game_height' ]."\", \"no\")'>New Window</a>",
          
		  # Game Pic
		  'GAMEPICF' => ( $frow[ 'game_pic' ] != '' ) ? "<a class=\"rounded-corners-arcade\" width=\"70\" href='" . append_sid( "games.$phpEx?gid=" . $frow[ 'game_id' ] ) . "'><img 
		  class=\"rounded-corners-arcade\" width=\"60\" src='" . "modules/Forums/games/pics/" . $frow[ 'game_pic' ] . "'
		  align='absmiddle' border='0' vspace='2' hspace='2' alt='" . $frow[ 'game_name' ] . "' ></a>" : '',

                  'GAMESETF' => ( $frow[ 'game_set' ] != 0 ) ? '<span class="arcadeTextWhite">'.$lang[ 'game_actual_nbset' ].'</span>'.'<span '
                  . 'class="w3-badge w3-blue"><strong>'. $frow[ 'game_set' ].'</strong></span>' : '',
        
		  'HIGHSCOREF' => '<span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">'.$frow['game_highscore'].'</span>',
        
		  'CLICKPLAY' => '<a class="clicktoplay" href="' . append_sid( "games.$phpEx?gid=" . $frow[ 'game_id' ] ) . '">Click to Play!</a>',
          
		  'YOURHIGHSCOREF' => '<span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">'.$frow[ 'score_game' ].'</span>',
          
		  'NORECORDF' => ( $frow[ 'game_highscore' ] == 0 ) ? $lang[ 'no_record' ] : '',
          
		  'HIGHUSERF' => ($frow['game_highuser'] != 0) ? '<span class="arcadeTextWhite">'.UsernameColor($frow['username']).'</span>' : '', 
          
		  'URL_SCOREBOARDF' => '<nobr><a class="cattitle" href="' . append_sid( "scoreboard.$phpEx?gid=" . $frow[ 'game_id' ] ) . '">' . "<img"
                  . "src='modules/Forums/templates/" . $theme[ 'template_name' ] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang[ 'scoreboard' ] . " " . $frow[ 'game_name' ] . "'>" . '</a></nobr> ',

                  'GAMEIDF' => $frow[ 'game_id' ],
          
		  # Favorites date for high score!
		  'DATEHIGHF' => "<nobr><span class='arcadeTextDate'>" . create_date( $board_config[ 'default_dateformat' ], $frow[ 'game_highdate' ], $board_config[ 'board_timezone' ] ) . "</span></nobr>",
          
		  'YOURDATEHIGHF' => "<nobr><span class='arcadeTextDate'>" . create_date( $board_config[ 'default_dateformat' ], $frow[ 'score_date' ], $board_config[ 'board_timezone' ] ) . "</span></nobr>",
          
		  # Favorites curren winner - if your the high scorer this shows up!
		  'IMGFIRSTF' => ($frow['game_highuser'] == $userinfo['user_id']) ? "<span class='arcadeTextDate'>1st Place</span>".$br."<img "
                  . "src='".$phpbb_root_path."templates/".$theme['template_name']."/images/couronne.gif' align='absmiddle'>" : "",
          
		  'GAMEDESCF' => '<span class="arcadeTextDescription">'.$frow[ 'game_desc' ].'</span>'
        ) );

        
           if($frow['game_highscore'] != 0 ): 
             $template->assign_block_vars( 'favrow.fav_row.recordrow', array() );
           endif;

           if($frow['score_game'] != 0 ):
             $template->assign_block_vars( 'favrow.fav_row.yourrecordrow', array() );
           else: 
           $template->assign_block_vars( 'favrow.fav_row.playrecordrow', array() );
           endif;
      
           endwhile;
    
      endif;
  
    endif;

  $liste_jeux = array();

  $sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date 
		FROM " . GAMES_TABLE . " g 
		LEFT JOIN " . USERS_TABLE . " u 
		ON g.game_highuser = u.user_id 
		LEFT JOIN " . SCORES_TABLE . " s 
		ON s.game_id = g.game_id and s.user_id = " . $userinfo[ 'user_id' ] . " 
		WHERE  g.arcade_catid IN ($liste_cat_auth) 
		ORDER BY g.arcade_catid, $order_by";

  if(!( $result = $db->sql_query($sql))):
    message_die( GENERAL_ERROR, "Could not read arcade categories", '', __LINE__, __FILE__, $sql );
  endif;

  while($row = $db->sql_fetchrow($result)):
  
    $liste_jeux[ $row[ 'arcade_catid' ] ][] = $row;
  
  endwhile;


  $sql = "SELECT arcade_catid, arcade_cattitle, arcade_nbelmt, arcade_catauth FROM " . ARCADE_CATEGORIES_TABLE . " WHERE  arcade_catid IN ($liste_cat_auth) ORDER BY arcade_catorder";

  if(!( $result = $db->sql_query($sql))): 
    message_die( GENERAL_ERROR, "Could not read arcade categories", '', __LINE__, __FILE__, $sql );
  endif;

  while($row = $db->sql_fetchrow($result)):
    
	if (is_countable($liste_jeux[ $row[ 'arcade_catid' ] ]) && count($liste_jeux[ $row[ 'arcade_catid' ] ]) > 0):
	  $nbjeux = sizeof( $liste_jeux[ $row[ 'arcade_catid' ] ] );
    else:
	  continue;
	endif;
	
    if($nbjeux > 0 ):
      $template->assign_block_vars( 'cat_row', array(
    
	    'U_ARCADE' => append_sid( "arcade.$phpEx?cid=" . $row[ 'arcade_catid' ] ),
    
	    'LINKCAT_ALIGN' => ( $arcade_config[ 'linkcat_align' ] == '0' ) ? 'left' : ( ( $arcade_config[ 'linkcat_align' ] == '1' ) ? 'center' : 'right' ),
    
	    'L_ARCADE' => sprintf( $lang[ 'Other_games' ], $row[ 'arcade_nbelmt' ] ),
    
	    'CATTITLE' => $row[ 'arcade_cattitle' ] ) );

      $nbjeux = ( $nbjeux < $games_par_categorie ) ? $nbjeux : $games_par_categorie;

      for($i = 0; $i < $nbjeux; $i++ ):

        $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'username' ] = UsernameColor( $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'username' ] );

        $template->assign_block_vars( 'cat_row.game_row', array(
          
		  'GAMENAME' => $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_name' ],
          
		  'GAMELINK' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "games.$phpEx?gid=" . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_id' ] ) . '">' . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_name' ] . '</a></nobr> ',
          
		  'GAMEPOPUPLINK' => "<a class='popup' href='javascript:Arcade_Popup(\"" . append_sid( "gamespopup.$phpEx?gid=" . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_id' ] ) . "\", \"New_Window\",\"" 
		  . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_width' ] . "\",\"" . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_height' ] . "\", \"no\")'>New Window</a>",
          
		  'GAMEPIC' => ( $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_pic' ] != '' ) ? "<a class='rounded-corners-arcade' width='60' href='" . append_sid( "games.$phpEx?gid=" 
		  . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_id' ] ) . "'><img class='rounded-corners-arcade' width='60' src='" . $phpbb_root_path . "games/pics/" 
		  . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_pic' ] . "' align='absmiddle' border='0' vspace='2' hspace='2' alt='" . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_name' ] . "' ></a>" : '',
          
		  'GAMESET' => ( $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_set' ] != 0 ) ? '<span class="arcadeTextWhite">'.$lang[ 'game_actual_nbset' ].'</span>' 
		  .'<span class="w3-badge w3-blue"><strong>'.$liste_jeux[ $row['arcade_catid']][$i]['game_set'].'</strong></span>' : '',
          
		  'HIGHSCORE' => '<span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">'.$liste_jeux[$row['arcade_catid' ]][$i]['game_highscore'].'</span>' ,
          
		  'YOURHIGHSCORE' => '<span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">'.$liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'score_game' ].'</span>' ,
          
		  'CLICKPLAY' => '<a class="clicktoplay" href="' . append_sid( "games.$phpEx?gid=" . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_id' ] ) . '">Click to Play!</a>',
          
		  'NORECORD' => ( $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_highscore' ] == 0 ) ? $lang[ 'no_record' ] : '',
          
		  'HIGHUSER' => ($liste_jeux[$row['arcade_catid']][$i]['game_highuser'] != 0) ? '' .'<span class="arcadeTextWhite">'.$liste_jeux[$row['arcade_catid']][$i]['username'].'</span>'.'' : '',
          
		  'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_sid( "scoreboard.$phpEx?gid=" . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_id' ] ) . '">' . "<img 
		  src='" . $phpbb_root_path . "templates/" . $theme[ 'template_name' ] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang[ 'scoreboard' ] . " " 
		  . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_name' ] . "'>" . '</a></nobr> ',
          
		  'GAMEID' => $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_id' ],
          
		  'DATEHIGH' => "<nobr><span class='arcadeTextDate'>".create_date($board_config['default_dateformat'],$liste_jeux[$row['arcade_catid']][$i]['game_highdate'],$board_config['board_timezone'])."</span></nobr>",
          
		  'YOURDATEHIGH' => "<nobr><span class='arcadeTextDate'>" . create_date( $board_config[ 'default_dateformat' ], $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'score_date' ], $board_config[ 'board_timezone' ] ) 
		  . "</span></nobr>",
          
		  'IMGFIRST' => ( $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_highuser' ] == $userinfo[ 'user_id' ] ) ? "<span class='arcadeTextDate'>1st Place</span>".$br."<img 
		  src='" . $phpbb_root_path . "templates/" . $theme[ 'template_name' ] . "/images/couronne.gif' align='absmiddle'>" : "",
		  
		  'ADD_FAV' => ( $arcade_config[ 'use_fav_category' ] ) ? '<td class="arcadeRow1" width="8%" align="center" valign="center"><a class="arcadeTitleLink" href="' . append_sid( "arcade.$phpEx?favori=" 
		  . $liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_id' ] ) . '"><i class="bi bi-plus-square"></i></br><font size="2">Add Favorite</font></a></td>' : '',
          
		  'GAMEDESC' => '<span class="arcadeTextDescription">'.$liste_jeux[ $row[ 'arcade_catid' ] ][ $i ][ 'game_desc' ].'</span>' ) );

        if($liste_jeux[$row['arcade_catid']][$i]['game_highscore'] != 0): 
          $template->assign_block_vars( 'cat_row.game_row.recordrow', array() );
        endif;

        if($liste_jeux[$row['arcade_catid']][$i]['score_game'] != 0):
          $template->assign_block_vars( 'cat_row.game_row.yourrecordrow', array() );
        else: 
          $template->assign_block_vars( 'cat_row.game_row.playrecordrow', array() );
        endif;
      endfor;
    endif;
  endwhile;


  include($phpbb_root_path.'whoisplaying.'.$phpEx);

  # Output page header
  include($phpbb_root_path.'headingarcade.'.$phpEx);
  $page_title = $lang['arcade'];
  include('includes/page_header.'.$phpEx);
  $template->pparse('body');
  include('includes/page_tail.'.$phpEx);
  exit;

endif;

$games_par_page = $arcade_config['games_par_page'];
$sql_where = '';
$limit = " LIMIT $start,$games_par_page ";

$total_games = 0;

if($arcade_config['use_category_mod']):

  $sql_where = " WHERE  arcade_catid = $arcade_catid AND arcade_catid IN ($liste_cat_auth)";
  $sql = "SELECT arcade_cattitle, arcade_nbelmt AS nbgames FROM " . ARCADE_CATEGORIES_TABLE . " $sql_where";

  if(!($result = $db->sql_query($sql))):
    message_die( GENERAL_ERROR, "Could not read the arcade categories table", '', __LINE__, __FILE__, $sql );
  endif;
  
  $row = $db->sql_fetchrow($result);

  if($row):
    $total_games = $row[ 'nbgames' ];
  else:
    message_die( GENERAL_MESSAGE, $lang['no_arcade_cat'] );
  endif;

  $template->assign_block_vars('use_category_mod',array() );

else:

  $sql = "SELECT COUNT(*) AS nbgames FROM " . GAMES_TABLE;

  $result = $db->sql_query($sql);
  
  if(!($result)):
    message_die( GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql );
  endif;

  $row = $db->sql_fetchrow($result);
  
  if($row):
    $total_games = $row[ 'nbgames' ];
  endif;

endif;

# load the template
$template->set_filenames( array(
  'body' => 'arcade_body.tpl' ) );

$template->assign_vars( array(
  
  'URL_ARCADE' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "arcade.$phpEx" ) . '">' . $lang[ 'lib_arcade' ] . '</a></nobr> ',
  
  'URL_BESTSCORES' => '<nobr><a class="cattitle" href="' . append_sid( "toparcade.$phpEx" ) . '">' . $lang[ 'best_scores' ] . '</a></nobr> ',
  
  'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_sid( "scoreboard.$phpEx?gid=$gid" ) . '">' . $lang[ 'scoreboard' ] . '</a></nobr> ',
  
  'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_sid( "comments_list.$phpEx" ) . '">' . $lang[ 'comments' ] . '</a></nobr> ',
  
  'CATTITLE' => $row[ 'arcade_cattitle' ],
  
  'NAV_DESC' => '<a class="nav" href="' . append_sid( "arcade.$phpEx" ) . '">' . $lang[ 'arcade' ] . '</a> ',
  
  'L_GAME' => $lang[ 'games' ],
  
  'PAGINATION' => generate_pagination( append_sid( "arcade.$phpEx?cid=$arcade_catid" ), $total_games, $games_par_page, $start ),
  
  'PAGE_NUMBER' => sprintf( $lang[ 'Page_of' ], ( floor( $start / $games_par_page ) + 1 ), ceil( $total_games / $games_par_page ) ),
  
  'ARCADE_COL' => ( $arcade_config[ 'use_fav_category' ] ) ? 6 : 5,
  
  'ARCADE_COL1' => ( $arcade_config[ 'use_fav_category' ] ) ? 2 : 1,
  
  'FAV' => $lang[ 'fav' ],
  
  'L_HIGHSCORE' => $lang[ 'highscore' ],
  
  'L_YOURSCORE' => $lang[ 'yourbestscore' ],
  
  'L_DESC' => $lang[ 'desc_game' ],
  
  'L_ARCADE' => $lang[ 'lib_arcade' ] ) );

if(($arcade_config['use_fav_category']) && (!$arcade_config['use_category_mod'])):
  
  $sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date, f.* FROM "
  . GAMES_TABLE . " g LEFT JOIN "
  . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN "
  . SCORES_TABLE . " s ON s.game_id = g.game_id and s.user_id = " . $userinfo[ 'user_id' ] . " LEFT JOIN "
  . ARCADE_FAV_TABLE . " f ON f.game_id = g.game_id WHERE  f.user_id=" . $userinfo[ 'user_id' ];

  if(!($result = $db->sql_query($sql))):
    message_die( GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql );
  endif;
  
  if($db->sql_numrows($result)):
  
	$frow['username'] = UsernameColor($frow['username']);
    $template->assign_block_vars('favrow',array());

    while($frow = $db->sql_fetchrow($result)):
	  	
      $template->assign_block_vars('favrow.fav_row',array(

        'GAMENAMEF' => $frow[ game_name ],

        'DELFAVORI' => '<a href="' . append_sid( "arcade.$phpEx?delfavori=" . $frow[ 'game_id' ] ) . '"><img src="modules/Forums/templates/subSilver/images/delfavs.gif" border=0 alt="' . $lang[ 'del_fav' ] . '"></a>',

        'GAMELINKF' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "games.$phpEx?gid=" . $frow[ 'game_id' ] ) . '">' . $frow[ 'game_name' ] . '</a></nobr> ',
        
		'GAMEPOPUPLINKF' => "<a class='popup' href='javascript:Arcade_Popup(\"" . append_sid( "gamespopup.$phpEx?gid=" . $frow[ 'game_id' ] ) . "\", \"New_Window\",\"" . $frow[ 'game_width' ] . "\",\"" 
		. $frow[ 'game_height' ] . "\", \"no\")'>New Window</a>",
        
		'GAMEPICF' => ( $frow[ 'game_pic' ] != '' ) ? "<a href='" . append_sid( "games.$phpEx?gid=" . $frow[ 'game_id' ] ) . "'><img src='" . "modules/Forums/games/pics/" 
		. $frow[ 'game_pic' ] . "' align='absmiddle' border='0' width='30' height='30' vspace='2' hspace='2' alt='" . $frow[ 'game_name' ] . "' ></a>" : '',
        
		'GAMESETF' => ( $frow[ 'game_set' ] != 0 ) ? '<span class="arcadeTextWhite">'.$lang[ 'game_actual_nbset' ].'</span>'.'<span class="w3-badge w3-blue"><strong>'.$frow[ 'game_set' ].'</strong></span>' : '',
        
		'HIGHSCOREF' => '<span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">'.number_format($frow['game_highscore'].'</span>'),
        
		'CLICKPLAY' => '<a class="clicktoplay" href="' . append_sid( "games.$phpEx?gid=" . $frow[ 'game_id' ] ) . '">Click to Play!</a>',
        
		'YOURHIGHSCOREF' => '<span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">'.number_format( $frow[ 'score_game' ].'</span>' ),
        
		'NORECORDF' => ( $frow[ 'game_highscore' ] == 0 ) ? $lang[ 'no_record' ] : '',
        
		'HIGHUSERF' => ($frow['game_highuser'] != 0) ? '<span class="arcadeTextWhite">'.$frow['username'].'</span>' : '',
        
		'URL_SCOREBOARDF' => '<nobr><a class="cattitle" href="' . append_sid( "scoreboard.$phpEx?gid=" . $frow[ 'game_id' ] ) . '">' . "<img src='modules/Forums/templates/" 
		. $theme[ 'template_name' ] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang[ 'scoreboard' ] . " " . $frow[ 'game_name' ] . "'>" . '</a></nobr> ',
        
		'GAMEIDF' => $frow[ 'game_id' ],
        
		'DATEHIGHF' => "<nobr>" . create_date( $board_config[ 'default_dateformat' ], $frow[ 'game_highdate' ], $board_config[ 'board_timezone' ] ) . "</nobr>",
        
		'YOURDATEHIGHF' => "<nobr><span class='arcadeTextDate'>" . create_date( $board_config[ 'default_dateformat' ], $frow[ 'score_date' ], $board_config[ 'board_timezone' ] ) . "</span></nobr>",
        
		  # Favorites curren winner - if your the high scorer this shows up!
		  'IMGFIRSTF' => ($frow['game_highuser'] == $userinfo['user_id']) ? "<span class='arcadeTextDate'>1st Place</span>".$br."<img 
		  src='".$phpbb_root_path."templates/".$theme['template_name']."/images/couronne.gif' align='absmiddle'>" : "",
        
		'GAMEDESCF' => '<span class="arcadeTextDescription">'.$frow[ 'game_desc' ].'</span>'
      ) );

      if($frow['game_highscore' ] != 0):
        $template->assign_block_vars( 'favrow.fav_row.recordrow', array() );
      endif;
	  
      if($frow['score_game' ] != 0):
        $template->assign_block_vars( 'favrow.fav_row.yourrecordrow', array() );
      else:
        $template->assign_block_vars( 'favrow.fav_row.playrecordrow', array() );
      endif;
    endwhile;
  endif;
endif;

$sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date 
FROM " . GAMES_TABLE . " g 
LEFT JOIN " . USERS_TABLE . " u 
ON g.game_highuser = u.user_id 
LEFT JOIN " . SCORES_TABLE . " s 
ON s.game_id = g.game_id and s.user_id = " . $userinfo[ 'user_id' ] . " $sql_where 
ORDER BY $order_by $limit";

if(!($result = $db->sql_query($sql))):
  message_die( GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql );
endif;

while($row = $db->sql_fetchrow($result)):

  $template->assign_block_vars('gamerow',array(

    'GAMENAME' => $row['game_name'],
    
	'GAMEPIC' => ( $row[ 'game_pic' ] != '' ) ? "<a class='rounded-corners-arcade' width='60' href='" . append_sid( "games.$phpEx?gid=" . $row[ 'game_id' ] ) . "'><img 
	class='rounded-corners-arcade' width='60' src='" . $phpbb_root_path . "games/pics/" . $row[ 'game_pic' ] . "' align='absmiddle' border='0' alt='" . $row[ 'game_name' ] . "' ></a>" : '',
    
	'GAMESET' => ( $row[ 'game_set' ] != 0 ) ? '<span class="arcadeTextWhite">'.$lang[ 'game_actual_nbset' ].'</span>'.'<span class="w3-badge w3-blue"><strong>'.$row['game_set'].'</strong></span>' : '',
    
	'GAMEDESC' => '<span class="arcadeTextDescription">'.$row[ 'game_desc' ].'</span>',
    
	'HIGHSCORE' => '<span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">'.number_format($row['game_highscore'].'<span'),
	
    'YOURHIGHSCORE' => '<span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">'.number_format( $row[ 'score_game' ].'</span>' ),
    
	'CLICKPLAY' => '<a class="clicktoplay" href="' . append_sid( "games.$phpEx?gid=" . $row[ 'game_id' ] ) . '">Click to Play!</a>',

    'NORECORD' => ( $row[ 'game_highscore' ] == 0 ) ? $lang[ 'no_record' ] : '',

    'HIGHUSER' => ($row['game_highuser'] != 0) ? '<span class="arcadeTextWhite">'.$row[ 'username' ].'</span>' : '',
    
	'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_sid( "scoreboard.$phpEx?gid=" . $row[ 'game_id' ] ) . '">' . "<img 
	src='" . $phpbb_root_path . "templates/" . $theme[ 'template_name' ] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang[ 'scoreboard' ] . " " . $row[ 'game_name' ] . "'>" . '</a></nobr> ',
    
	'GAMEID' => $row[ 'game_id' ],

    'DATEHIGH' => "<nobr>" . create_date( $board_config[ 'default_dateformat' ], $row[ 'game_highdate' ], $board_config[ 'board_timezone' ] ) . "</nobr>",
    
	'YOURDATEHIGH' => "<nobr><span class='arcadeTextDate'>" . create_date( $board_config[ 'default_dateformat' ], $row[ 'score_date' ], $board_config[ 'board_timezone' ] ) . "</span></nobr>",
    
   # Not Favorites Ref Cat curren winner - if your the high scorer this shows up!
	'IMGFIRST' => ($row['game_highuser'] == $userinfo['user_id']) ? "<span class='arcadeTextDate'>1st Place</span>".$br."<img 
	src='".$phpbb_root_path."templates/".$theme['template_name']."/images/couronne.gif' align='absmiddle'>" : "",
    
	'ADD_FAV' => ( $arcade_config[ 'use_fav_category' ] ) ? '<td class="row1" width="25" align="center" valign="center"><a 
	href="' . append_sid( "arcade.$phpEx?favori=" . $row[ 'game_id' ] ) . '"><img src="modules/Forums/templates/subSilver/images/favs.gif" border=0 alt="' . $lang[ 'add_fav' ] . '"></a></td>' : '',
    
	'GAMELINK' => '<nobr><a class="arcadeTitleLink" href="' . append_sid( "games.$phpEx?gid=" . $row[ 'game_id' ] ) . '">' . $row[ 'game_name' ] . '</a></nobr> ',
    
	'GAMEPOPUPLINK' => "<a class='popup' href='javascript:Arcade_Popup(\"" . append_sid( "gamespopup.$phpEx?gid=" . $row[ 'game_id' ] ) . "\", \"New_Window\",\"" . $row[ 'game_width' ] . "\",\"" 
	. $row[ 'game_height' ] . "\", \"no\")'>New Window</a>" ) );

  if($row['game_highscore'] != 0):
    $template->assign_block_vars( 'gamerow.recordrow', array() );
  endif;

  if($row['score_game' ] != 0):
    $template->assign_block_vars( 'gamerow.yourrecordrow', array() );
  else:
    $template->assign_block_vars( 'gamerow.playrecordrow', array() );
  endif;
  
endwhile;

include($phpbb_root_path.'whoisplaying.'.$phpEx);

# Output page header
include( $phpbb_root_path . 'headingarcade.' . $phpEx );
$page_title = $lang[ 'arcade' ];
include( 'includes/page_header.' . $phpEx );
$template->pparse( 'body' );
include( 'includes/page_tail.' . $phpEx );

?>