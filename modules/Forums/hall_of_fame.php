<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             hall_of_fame.php
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

$phpbb2_template->set_filenames(array(
        'hall_of_fame' => 'hall_of_fame.tpl')
);

$phpbb2_template->assign_vars(array(
                'L_RANK' => $lang['boardrank'],
                'L_GAME' => $lang['game'],
                'L_ARCADE_USER' => $lang['arcade_user'],
                'L_SCORE' => $lang['boardscore'],
                'L_HELD_TIME' => $lang['held_time'],
                'L_DATE' => $lang['boarddate'],
                'L_LONGEST_SCORE' => 'Longest Running Highscores')
);


$count = 1;

$sql ="SELECT g.*, u.username, u.user_id FROM " . GAMES_TABLE. " g LEFT JOIN " . USERS_TABLE. " u ON g.game_highuser = u.user_id WHERE g.game_highscore > 0 ORDER BY g.game_highdate ASC LIMIT 0,10";

if( !($result = $pnt_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Cannot access game stats", '', __LINE__, __FILE__, $sql); 
    }

while ( $row = $pnt_db->sql_fetchrow($result))
            {
            $held_time = time() - $row['game_highdate'];
            $held_time = sec2hms($held_time);

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        
            $phpbb2_template->assign_block_vars('record_row', array(
                        'GAME_NAME' => '<a href="' . append_titanium_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>', 
                        'USERNAME' => '<a href="' . append_titanium_sid("statarcade.$phpEx?uid=" . $row['user_id'] ) . '" class="genmed">' . $row['username'] . '</a> ',
                        'HIGHSCORE' =>  number_format($row['game_highscore']),
                        'HIGHSCORE_DATE' => create_date( $phpbb2_board_config['default_dateformat'] , $row['game_highdate'] , $phpbb2_board_config['board_timezone'] ),
                        'COUNT' =>  $count,
                        'HELD_TIME' =>  $held_time
                 ));
            $count++; 

            }

$phpbb2_template->assign_var_from_handle('HALL_OF_FAME', 'hall_of_fame');

?>