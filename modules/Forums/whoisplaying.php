<?php # JOHN 3:16 #
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
 *                              whoisplaying.php
 *                            -------------------
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Advanced Username Color                  v1.0.5       09/20/2005
 ************************************************************************/
if (!defined('IN_PHPBB')) die('Hacking attempt');

if (!function_exists('get_arcade_categories')) 
include('includes/functions_arcade.'.$phpEx);

$template->set_filenames(array(
        'whoisplaying' => 'whoisplaying_body.tpl')
);

$template->assign_vars(array(
        "L_WHOISPLAYING" => $lang['whoisplaying'])
);

if(!isset($liste_cat_auth)):
  $liste_cat_auth = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'view');
    if(empty($liste_cat_auth)): 
      $liste_cat_auth = "''";
    endif;
endif;

$sql = "SELECT u.username, 
                u.user_id, 
			 u.user_level, 
	user_allow_viewonline, 
	          g.game_name, 
			    g.game_id FROM ".GAMEHASH_TABLE." gh 
				
				LEFT JOIN ".SESSIONS_TABLE." s 
				ON gh.user_id = s.session_user_id 
				LEFT JOIN ".USERS_TABLE." u 
				ON gh.user_id = u.user_id 
				LEFT JOIN ".GAMES_TABLE." g 
				ON gh.game_id = g.game_id 
				WHERE gh.hash_date >= s.session_time 
				AND (".time()."- gh.hash_date <= 300) 
				AND g.arcade_catid 
				IN ($liste_cat_auth) 
				ORDER BY gh.hash_date DESC";

if(!($result = $db->sql_query($sql))) 
message_die(CRITICAL_ERROR, "Could not query games information", "", __LINE__, __FILE__, $sql);

while($row = $db->sql_fetchrow($result)):
  $players[] = $row;
endwhile;

$last_game = '';
$list_player = '';
$prev_user_id = '';
$class = '';

if(!isset($players))
$players = 0;

$nbplayers = is_countable($players) ? count($players) : 0;
$listeid = array();
$games_players = array();
$games_names = array();

for($i=0 ; $i<$nbplayers ; $i++): 
  if(!isset($listeid[$players[$i]['user_id']])): 
     $listeid[ $players[$i]['user_id'] ] = true ;
     $style_color = '';
	 
     # Mod: Advanced Username Color v1.0.5 START
     $players[$i]['username'] = UsernameColor($players[$i]['username']);
     # Mod: Advanced Username Color v1.0.5 END

     if ($players[$i]['user_allow_viewonline']) 
         $player_link = '<a href="'.append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=".$players[$i]['user_id']).'"'.$style_color.'>'.$players[$i]['username'].'</a>';
	 else 
         $player_link = '<a href="'.append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=
		 ".$players[$i]['user_id']).'"'.$style_color.'><i>'.$players[$i]['username'].'</i></a>';
         if ($players[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN): 
            if (!isset($games_names[ $players[$i]['game_id'] ])): 
                $games_names[ $players[$i]['game_id'] ] = $players[$i]['game_name'] ;
                $games_players[ $players[$i]['game_id'] ] = $player_link ;
			else: 
                $games_players[ $players[$i]['game_id'] ] .=  ', ' . $player_link ;
            endif;
         endif;
  endif;
endfor;

foreach($games_names AS $key => $val): 
 if ($games_players[$key]!=''): 
   $class = ($class == 'arcadeRow1') ? 'arcadeRow2' : 'arcadeRow1';
   $template->assign_block_vars('whoisplaying_row', array(
   'CLASS' => $class,
   'GAME' => '<a href="' . append_sid("games.$phpEx?gid=" . $key) . '">' . $val . '</a>',
   'PLAYER_LIST' => $games_players[$key])
   );
 endif;
endforeach;

$template->assign_var_from_handle('WHOISPLAYING', 'whoisplaying');
?>
