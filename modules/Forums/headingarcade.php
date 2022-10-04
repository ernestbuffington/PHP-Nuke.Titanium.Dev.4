<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             headingarcade.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Advanced Username Color                  v1.0.5       09/20/2005
 ************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

//Loading Template
$phpbb2_template->set_filenames(array(
   'headingarcade' => 'headingarcade_body.tpl')
);

    $class = ($class == 'row1') ? 'row2' : 'row1';

    $phpbb2_template->assign_block_vars('arcaderow2',array(
           'U_TOPARCADE' => append_titanium_sid("toparcade.$phpEx"),
           'BEST_SCORES' => $lang['best_scores'])
           );

    $phpbb2_template->assign_block_vars('arcaderow3',array(
           'CLASS' => $class,
           'U_TOPARCADE' => append_titanium_sid("toparcade.$phpEx"),
           'BEST_SCORES' => $lang['best_scores'])
           );
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $phpbb2_color_name = UsernameColor($userdata['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $phpbb2_template->assign_vars(array(
            'L_AVATAR' => $lang['Avatar'],
            'L_TOP' => $lang['heading_top'],
            'L_RECENT' => $lang['heading_recent'],
            'L_USER_INFO' => $lang['heading_user'],
            'L_POSTER_RANK' => $lang['Poster_rank'],
            'L_ARCADE_USER' => $lang['arcade_user'],
            'L_WINS' => $lang['heading_wins'],
            'L_SEARCH_ARCADE' => $lang['search_arcade'],
            'L_GAME_NAME' => $lang['search_game_name'],
            'L_GAME_DESCRIPTION' => $lang['search_game_desc'],
            'L_SEARCH_DESCRIPTION' => $lang['search_desc'],
            'L_NO_PLAY' =>$lang['games_no_play'],
            'L_GAMES_NEWEST' =>$lang['games_newest'],
            'L_LAST_FIVE' => $lang['heading_last_five'],
            'L_LAST_RECORDED' => $lang['heading_last_recorded'],
            'TOP_PLAYER' => $lang['Topgamers'],
            'PLAYER' => $lang['Player'],
            'VICTOIRES' => $lang['Victoires'],
            'ARCADE_VICTOIRES' => $nbvictoires,
            'AVATAR_IMG' => $avatar_img,
            'USERNAME' => '<a href="' . append_titanium_sid("statarcade.$phpEx?uid=" . $userdata['user_id'] ) . '" class="genmed">' . $phpbb2_color_name . '</a> ',
            'POSTER_RANK' => $poster_rank,
            'RANK_IMG' => $rank_image,
            'ARCADE_ANNOUNCEMENT' => $arcade_config['arcade_announcement'],
            'MAXSIZE_AVATAR' => intval($arcade_config['maxsize_avatar'])
           )
        );
//End of Template loading

// Start of Top 10 Arcade Players

$sql = "SELECT COUNT(*) AS nbvictoires, g.game_highuser, u.user_id, u.username, u.user_level FROM " . GAMES_TABLE . " g, " . USERS_TABLE . " u WHERE g.game_highuser = u.user_id AND g.game_highuser <> 0 GROUP BY g.game_highuser ORDER BY nbvictoires DESC LIMIT 0,10";

    if( !($result = $pnt_db->sql_query($sql)) )
    {
        message_die(CRITICAL_ERROR, "Could not query games information", "", __LINE__, __FILE__, $sql);
    }

    $place=0;
    $nbvictprec=0;
    while ( $row = $pnt_db->sql_fetchrow($result) )
    {
        if ($nbvictprec<>$row['nbvictoires'])
        {
         $place++;
         $nbvictprec=$row['nbvictoires'];
        }
        /*$style_color = '';
        if ( $row['user_level'] == ADMIN )
        {
            $row['username'] = '<strong>' . $row['username'] . '</strong>';
            $style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
        }
        else if ( $row['user_level'] == MOD )
        {
            $row['username'] = '<strong>' . $row['username'] . '</strong>';
            $style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
        }*/
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $pnt_user_online_link = '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'>' . $row['username'] . '</a>';

        $phpbb2_template->assign_block_vars('player_row', array(
            'CLASSEMENT' => $place,
            'USERNAME' => $pnt_user_online_link,
            'VICTOIRES' => $row['nbvictoires'])
        );

    }
// End of Top 10 Arcade Players

// Start of Last 5 highscores

   $sql = " SELECT g.* , u.username FROM " . GAMES_TABLE . " g, " . USERS_TABLE . " u WHERE g.game_highuser = u.user_id ORDER BY game_highdate DESC LIMIT 0,5  ";

   if ( !($result = $pnt_db->sql_query($sql)) )
   {
      message_die(GENERAL_ERROR, 'Could not query the games/users table', '', __LINE__, __FILE__, $sql);
   }
   while($rowArcade = $pnt_db->sql_fetchrow($result))
   {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
       $rowArcade['username'] = UsernameColor($rowArcade['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $class = ($class == 'row1') ? 'row2' : 'row1' ;
    $last_scoregame = '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $rowArcade['game_id']) . '">' . $rowArcade['game_name'] . '</a>';
    $last_scoreuser = '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $rowArcade['game_highuser']) . '">' . $rowArcade['username'] . '</a>';
    $last_score = number_format($rowArcade['game_highscore']);

        $phpbb2_template->assign_block_vars('arcaderow2.bestscore2',array(
    'CLASS' => $class,
    'L_HEADING_CHAMP' => sprintf($lang['heading_champ'], $last_scoreuser, $last_scoregame, $last_score),
        'LAST_SCOREDATE' => create_date($phpbb2_board_config['default_dateformat'], $rowArcade['game_highdate'] , $phpbb2_board_config['board_timezone']))
      );
    }
// End Last Five Highscores

// Last Recorded Score

   $sql = " SELECT u.user_id, u.username, s.game_id, s.score_game, s.score_date, g.game_name FROM " . SCORES_TABLE . " s, " . USERS_TABLE . " u, " . GAMES_TABLE . " g WHERE s.user_id = u.user_id AND s.game_id = g.game_id ORDER BY score_date DESC LIMIT 0,1";

   if ( !($result = $pnt_db->sql_query($sql)) )
   {
      message_die(GENERAL_ERROR, 'Could not query the scores/users table', '', __LINE__, __FILE__, $sql);
   }
   if($rowScore = $pnt_db->sql_fetchrow($result))
   {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
      $rowScore['username'] = UsernameColor($rowScore['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
      $last_scoregame = '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $rowScore['game_id']) . '">' . $rowScore['game_name'] . '</a>';
      $last_scoredate = create_date($phpbb2_board_config['default_dateformat'], $rowScore['score_date'], $phpbb2_board_config['board_timezone']);
      $last_scoreuser = '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $rowScore['user_id']) . '">' . $rowScore['username'] . '</a>';
      $last_score = number_format($rowScore['score_game']);

      $phpbb2_template->assign_block_vars('arcaderow3.score3',array(
      'L_LAST_SCORE' => sprintf($lang['heading_last_score'], $last_scoreuser, $last_score, $last_scoregame, $last_scoredate ))
      );
    }
// End Last Recorded Score

// Start User Rank
$sql = "SELECT *
    FROM " . RANKS_TABLE . "
    ORDER BY rank_special, rank_min";
if ( !($result = $pnt_db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
}

while ( $row = $pnt_db->sql_fetchrow($result) )
{
    $ranksrow[] = $row;
}
$pnt_db->sql_freeresult($result);

$poster_rank = '';
$rank_image = '';
if ( $userdata['user_rank'] )
{
    for($i = 0; $i < count($ranksrow); $i++)
    {
        if ( $userdata['user_rank'] == $ranksrow[$i]['rank_id'] && $ranksrow[$i]['rank_special'] )
        {
            if (empty($userdata['user_custom_title'])){
            $poster_rank = $ranksrow[$i]['rank_title'];}
            else{$poster_rank = $userdata['user_custom_title'];}
            $rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
        }
    }
}
else
{
    for($i = 0; $i < count($ranksrow); $i++)
    {
        if ( $userdata['user_posts'] >= $ranksrow[$i]['rank_min'] && !$ranksrow[$i]['rank_special'] )
        {
            if (empty($userdata['user_custom_title'])){
            $poster_rank = $ranksrow[$i]['rank_title'];}
            else{$poster_rank = $userdata['user_custom_title'];}
            $rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
        }
    }
}
// End User Rank

// Calculates the users total number of arcade victories
$sql = "SELECT COUNT(*) AS nbvictoires FROM " . GAMES_TABLE . " WHERE game_highuser = " . $userdata['user_id'];
if( !$result = $pnt_db->sql_query($sql))
{
    message_die(GENERAL_ERROR, 'Could not obtain games information', '', __LINE__, __FILE__, $sql);
}
$row = $pnt_db->sql_fetchrow($result);
$nbvictoires = $row['nbvictoires'];
// Ends calculation the users total number of arcade victories

// Gets the avatar
$avatar_img = '';
if ( $userdata['user_avatar_type'] && $userdata['user_allowavatar'] )
{
    switch( $userdata['user_avatar_type'] )
    {
        case USER_AVATAR_UPLOAD:
            $avatar_img = ( $phpbb2_board_config['allow_avatar_upload'] ) ? '<img src="' . $phpbb2_board_config['avatar_path'] . '/' . $userdata['user_avatar'] . '" alt="" border="0" onload="resize_avatar(this)"/>' : '';
            break;
        case USER_AVATAR_REMOTE:
            $avatar_img = ( $phpbb2_board_config['allow_avatar_remote'] ) ? '<img src="' . $userdata['user_avatar'] . '" alt="" border="0" onload="resize_avatar(this)"/>' : '';
            break;
        case USER_AVATAR_GALLERY:
            $avatar_img = ( $phpbb2_board_config['allow_avatar_local'] ) ? '<img src="' . $phpbb2_board_config['avatar_gallery_path'] . '/' . $userdata['user_avatar'] . '" alt="" border="0" onload="resize_avatar(this)"/>' : '';
            break;
    }
}
IF ( empty($avatar_img) )
{
   $avatar_img = '<img src="' . $phpbb2_board_config['avatar_gallery_path'] . '/blank.png" alt="Default Avatar" border="0" />';
}
// Finished avatar

//Total times playing Arcade
$sql = "SELECT SUM(score_set) AS games_played FROM " . SCORES_TABLE . " WHERE user_id = " . $userdata['user_id'];
if( !$result = $pnt_db->sql_query($sql))
{
    message_die(GENERAL_ERROR, 'Could not obtain games information', '', __LINE__, __FILE__, $sql);
}
$row = $pnt_db->sql_fetchrow($result);
$games_played = $row['games_played'];

//Total time playing Arcade
$sql = "SELECT SUM(score_time) AS games_time FROM " . SCORES_TABLE . " WHERE user_id = " . $userdata['user_id'];
if( !$result = $pnt_db->sql_query($sql))
{
    message_die(GENERAL_ERROR, 'Could not obtain games information', '', __LINE__, __FILE__, $sql);
}
$row = $pnt_db->sql_fetchrow($result);
$games_time = sec2hms($row['games_time']);


            $phpbb2_template->assign_block_vars('arcaderow2',array(
                   'U_TOPARCADE' => append_titanium_sid("toparcade.$phpEx"),
                   'BEST_SCORES' => $lang['best_scores'])
               );

            $phpbb2_template->assign_block_vars('arcaderow3',array(
                   'U_TOPARCADE' => append_titanium_sid("toparcade.$phpEx"),
                   'BEST_SCORES' => $lang['best_scores'])
               );

            $phpbb2_template->assign_vars(array(
                "AVATAR_IMG" => $avatar_img,
                "POSTER_RANK" => $poster_rank,
                "RANK_IMG" => $rank_image,
                "ARCADE_VICTOIRES" => sprintf($lang['heading_stats'], $nbvictoires),
                "L_ARCADE_TOTAL_PLAYS" => $lang['heading_plays'],
                "ARCADE_TOTAL_PLAYS" => $games_played,
                "L_ARCADE_TOTAL_TIME" => $lang['heading_time'],
                "ARCADE_TOTAL_TIME" => $games_time
            )
            );

$phpbb2_template->assign_var_from_handle('HEADINGARCADE', 'headingarcade');

?>