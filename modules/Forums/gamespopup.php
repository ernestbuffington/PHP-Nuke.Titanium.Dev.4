<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              games_popup.php
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

$popup = 1;
if ($popup != "1"){
    $module_name = basename(dirname(__FILE__));
    require("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = NUKE_FORUMS_DIR;
    echo '<script src="includes/ruffle-core/ruffle.js"></script>'."\n";
}

define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_GAME);
init_userprefs($userdata);
//
// End session management
//
include('includes/functions_arcade.' . $phpEx);
//
// Start auth check
//
if (!$userdata['session_logged_in']) {
        $header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";
        header($header_location . "modules.php?name=Your_Account");
        exit;
}
//
// End of auth check
//

$arcade_config = array();
$arcade_config = read_arcade_config();

if($arcade_config['limit_by_posts'] && $userdata['user_level'] != ADMIN){
$secs = 86400;
$uid = $userdata['user_id'];

$days = $arcade_config['days_limit'];
$posts = $arcade_config['posts_needed'];

$current_time = time();
$old_time = $current_time - ($secs * $days);

//Begin Limit Play mod
if($arcade_config['limit_type']=='posts')
{
$sql = "SELECT * FROM " . POSTS_TABLE . " WHERE poster_id = $uid";
}
else
{
$sql = "SELECT * FROM " . POSTS_TABLE . " WHERE poster_id = $uid and post_time BETWEEN $old_time AND $current_time";
}
if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
    }

    $Amount_Of_Posts = $db->sql_numrows( $result );


    if($Amount_Of_Posts < $posts)
    {
    $diff_posts = $posts - $Amount_Of_Posts;

    if($arcade_config['limit_type']=='posts')
        {
            $message = "You need $posts posts to play the arcade.<br />You need $diff_posts more posts.";
        }
        else 
        {
            $message = "You need $posts posts in the last $days days to play the arcade.<br />You need $diff_posts more posts.";
        }
        message_die(GENERAL_MESSAGE, $message);
    }
}

if ((isset($_POST['gid']) && !empty($_POST['gid'])) && (isset($_GET['gid']) && !empty($_GET['gid']))) 
    $gid = (isset($_GET['gid']) && !stristr($_GET['gid'],'..') && !stristr($_GET['gid'],'://')) ? addslashes(trim($_GET['gid'])) : false;
else 
    $gid = (isset($_REQUEST['gid']) && !stristr($_REQUEST['gid'],'..') && !stristr($_REQUEST['gid'],'://')) ? addslashes(trim($_REQUEST['gid'])) : false;
	
$sql = "SELECT g.* , u.username, MAX(s.score_game) AS highscore FROM " . GAMES_TABLE . " g LEFT JOIN " . SCORES_TABLE . " s ON g.game_id = s.game_id LEFT JOIN " . USERS_TABLE . " u ON g.game_highuser = u.user_id WHERE g.game_id = $gid GROUP BY g.game_id,g.game_highscore";

if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql);
}

if (!($row = $db->sql_fetchrow($result)) ) {
        message_die(GENERAL_ERROR, "This game does not exist", '', __LINE__, __FILE__, $sql);
}

$mode = $HTTP_GET_VARS['mode'];
if($mode == "done")
    {
        $gamename = $row['game_name'];
        // set page title
        $page_title = "Current Highscore's for " .$gamename;

        $gen_simple_header = TRUE;
        include("includes/page_header_review.php");


        $template->set_filenames(array(
                        'body' => 'gamespopup_finish.tpl'));

                $template->assign_vars(array(
                        'GAMENAME' => $gamename,
                        'PLAYAGAIN' => append_sid("gamespopup.$phpEx?gid=$gid", true),
                        'RETURN' => append_sid("arcade.$phpEx", true),
                        ));

                $sql = "SELECT s.*, u.username FROM " . SCORES_TABLE . " s LEFT JOIN " . USERS_TABLE . " u ON s.user_id = u.user_id WHERE game_id = $gid ORDER BY s.score_game DESC, s.score_date ASC LIMIT 0,15";

                if (!($result = $db->sql_query($sql)))
                {
        message_die(GENERAL_ERROR, "Could not read from scores table", '', __LINE__, __FILE__, $sql);
                }

                $pos = 0;
                $posreelle = 0;
                $lastscore = 0;
                while ($row = $db->sql_fetchrow($result))
                {
                    $posreelle++;
                        if ($lastscore!=$row['score_game'])
                        {
                    $pos = $posreelle;
                }

		       $row['trophy'] = '';

               # Ordinal Number Suffix - TheGhost 11:05 pm Saturday 10/22/2022
		       $last = substr($posreelle,-1);

               if($last > 3 or $last == 0 or ($posreelle >= 11 and $posreelle <= 19 )) {
                $row['trophy'] = '<font size="2">th</font>';
               }
               elseif($last == 3) {
                $row['trophy'] = '<font size="2">rd</font>';
               }
               elseif($last == 2) {
                $row['trophy'] = '<font size="2">nd</font>';
               }
               else 
               {
                $row['trophy'] = '<font size="2">st</font>';
               }
            
			    $lastscore = $row['score_game'];
                $class = ($class == 'row1') ? 'row2' : 'row1';
                $template->assign_block_vars('scorerow', array(
                            'CLASS' => $class,
                            'POS' => $pos,
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                'USERNAME' => UsernameColor($row['username']),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                'URL_STATS' => '<nobr><a class="cattitle" href="' . append_sid("statarcade.$phpEx?uid=" . $row['user_id']) . '">' . "<img src='modules/Forums/templates/" . $theme['template_name'] . "/images/loupe.gif' align='absmiddle' border='0' alt='" . $lang['statuser'] . " " . $row['username'] . "'>" . '</a></nobr>',
                'SCORE' => number_format($row['score_game']),
				'TROPHY' => $row['trophy'],
                'DATEHIGH' => create_date($board_config['default_dateformat'] , $row['score_date'] , $board_config['board_timezone']))
                        );

                }

                //
                // Generate the page end
                //
                $template->pparse('body');
                include("includes/page_tail_review.php");
                exit;

    }

$liste_cat_auth_play = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'play');
$tbauth_play = array();
$tbauth_play = explode(',',$liste_cat_auth_play);

if (!in_array($row['arcade_catid'],$tbauth_play)) {
        message_die(GENERAL_MESSAGE, $lang['game_forbidden']);
}


//chargement du template
$template->set_filenames(array(
        'body' => 'gamespopup_body.tpl')
);

$sql = "DELETE FROM " . GAMEHASH_TABLE . " WHERE hash_date < " . (time() - 72000);

if (!$db->sql_query($sql)) {
        message_die(GENERAL_ERROR, "Could not delete from the hash table", '', __LINE__, __FILE__, $sql);
}

// Type V2 Game Else Type V1
if ($row['game_type'] == 3) {
        $type_v2 = true;
        $template->assign_block_vars('game_type_V2',array());
        $gamehash_id = md5(uniqid($user_ip));
        $sql = "INSERT INTO " . GAMEHASH_TABLE . " (gamehash_id , game_id , user_id , hash_date) VALUES ('$gamehash_id' , '$gid' , '" . $userdata['user_id'] . "' , '" . time() . "')";

        if (!($result = $db->sql_query($sql))) {
                message_die(GENERAL_ERROR, "Could not delete from the hash table", '', __LINE__, __FILE__, $sql);
        }
}
elseif ($row['game_type'] == 4 or $row['game_type'] == 5)
{
        if ($row['game_type'] == 5)
                {
               $template->assign_block_vars('game_type_V5',array());
            }
            else
            {
           $template->assign_block_vars('game_type_V2',array());
            }
        setcookie('gidstarted', '', time() - 3600);
        setcookie('gidstarted',$gid);
        setcookie('timestarted', '', time() - 3600);
        setcookie('timestarted', time());

        $gamehash_id = md5($user_ip);
        $sql = "INSERT INTO " . GAMEHASH_TABLE . " (gamehash_id , game_id , user_id , hash_date) VALUES ('$gamehash_id' , '$gid' , '" . $userdata['user_id'] . "' , '" . time() . "')";

        if (!($result = $db->sql_query($sql)))
                {
        message_die(GENERAL_ERROR, "Couldn't update hashtable", '', __LINE__, __FILE__, $sql);
        }

}
else
{
        message_die(GENERAL_ERROR, "Game Type no longer supported, please contact the admin and have him/her delete it.");
}

setcookie('arcadepopup', '', time() - 3600);
setcookie('arcadepopup', '1');

$scriptpath = substr($board_config['script_path'] , strlen($board_config['script_path']) - 1 , 1) == '/' ? substr($board_config['script_path'] , 0 , strlen($board_config['script_path']) - 1) : $board_config['script_path'];
$scriptpath = "http://" . $board_config['server_name'] .$scriptpath;
global $prefix;
$sql = "SELECT arcade_cattitle FROM `".$prefix."_bbarcade_categories` WHERE arcade_catid = " . $row['arcade_catid'];
$result = $db->sql_query($sql);
$ourrow = $db->sql_fetchrow($result);
$cat_title = $ourrow['arcade_cattitle'];

$template->assign_vars(array(
        
  'SWF_GAME' => $row['game_swf'] ,
  
  'GAMEHASH' => $gamehash_id,
  
  'L_GAME' => $row['game_name'],
  
  'HIGHUSER' => (!empty($row['username'])) ? "'s Highscore: ".$row['username']." - ": " : No Highscore",
  
  'HIGHSCORE' => $row['highscore'])
);

//
// Output page header
$page_title = $lang['arcade_game'];
$template->pparse('body');

?>