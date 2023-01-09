<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                               proarcade.php
 *                            -------------------
 *                                Arcade v4.0
 *
 *   Evo Xtreme Ported Arcade - http://www.php-nuke-titanium.86it.us
 *   Ported to Titanium by Ernest Allen Buffington aka TheGhost
 *   10/27/2022 8:41 pm Thursday
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Fixes]=-
       PHP-Nuke Titanium Session Handling
	   PM Arcade Messages 
-=[Base]=-
      Nuke Patched                             v3.1.0       09/20/2005
	  PHP-Nuke Titanium Patched                v4.0.3       10/27/2022
 ************************************************************************/
if(!defined('MODULE_FILE')):
  die('You can\'t access this file directly...');
endif;

if($popup != "1"):
  $module_name = basename(dirname(__FILE__));
  require("modules/".$module_name."/nukebb.php");
else:
  $phpbb_root_path = NUKE_FORUMS_DIR;
endif;

define('IN_PHPBB', true);

include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.' . $phpEx);
require($phpbb_root_path . 'gf_funcs/gen_funcs.' . $phpEx);

global $userinfo;

$gid = get_var_gf(array('name'=>'gid', 'intval'=>true, 'default'=>0));

$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";

/***************************
 *
 * Start session management
 *
 **************************/
$userdata = session_pagestart($user_ip, PAGE_GAME);
init_userprefs($userdata);
/***************************
 *
 * End session management
 *
 **************************/

include('includes/functions_arcade.' . $phpEx);

/***************************
 *
 * Start auth check
 *
 **************************/
$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";

$sql = "SELECT * FROM " . GAMES_TABLE . " WHERE game_id = '$gid'";

if(!($result = $db->sql_query($sql))):
  message_die(GENERAL_ERROR, "Could not read from the games table", '', __LINE__, __FILE__, $sql);
endif;

if(!($row = $db->sql_fetchrow($result))):
  message_die(GENERAL_ERROR, "Game does not exist.");
endif;

$hashoffset = get_var_gf(array('name'=>'hashoffset', 'default'=>''));
$gamehash = get_var_gf(array('name'=>'gamehash', 'default'=>''));
$vpaver = get_var_gf(array('name'=>'vpaver', 'default'=>''));
$newhash = get_var_gf(array('name'=>'newhash', 'default'=>''));
$gpaver = get_var_gf(array('name'=>'gpaver', 'default'=>''));
$settime = get_var_gf(array('name'=>'settime', 'intval'=>true, 'default'=>''));
$sid = get_var_gf(array('name'=>'sid', 'default'=>''));
$valid = get_var_gf(array('name'=>'valid', 'default'=>''));

if($row['game_type'] == 0):
  message_die(GENERAL_ERROR, "Game Type no longer supported, please contact the admin and have him/her delete it.");
endif;

if($row['game_type'] == 1):
  message_die(GENERAL_ERROR, "Game Type no longer supported, please contact the admin and have him/her delete it.");
endif;

if($row['game_type'] == 2):
  message_die(GENERAL_ERROR, "Game Type no longer supported, please contact the admin and have him/her delete it.");
endif;

if($row['game_type'] == 3):
  //$gamehash_id = substr($newhash , $hashoffset , 32) . substr($newhash , 0 , $hashoffset);
  $gamehash_id = substr((string) $newhash , (int)$hashoffset , 32) . substr((string) $newhash , 0 , (int)$hashoffset);
  $vpaver = ($gpaver == "GFARV2") ? '100B2' : '';
  $vscore = $row['game_scorevar'];
  $score = get_var_gf(array('name'=>$vscore, 'intval'=>true, 'default'=>''));
endif;

if($row['game_type'] == 4 or $row['game_type'] == 5):
  $gamehash_id = md5($user_ip);
  $vpaver = ($gpaver == "GFARV2") ? '100B2' : '';
  $score = $HTTP_POST_VARS['vscore'];
  $settime = $_COOKIE['timestarted'];
endif;

$vscore = $score;

if(!$userdata['session_logged_in']  && ($valid=='')):
  header($header_location . "modules.php?name=Forums&file=proarcade&$vscore=$score&gid=$gid&valid=X&newhash=$newhash&gamehash_id=$gamehash_id&gamehash=$gamehash&hashoffset=$hashoffset&settime=$settime&sid=$sid&vpaver=$vpaver");
  exit;
endif;

if(!$userdata['session_logged_in']):
  header($header_location . "modules.php?name=Your_Account");
  exit;
endif;

if ($row['game_type'] != 4 or $row['game_type'] != 5) {
  
  $sql = "SELECT * FROM " . GAMEHASH_TABLE . " WHERE gamehash_id = '$gamehash_id' and game_id = '$gid' and user_id = '" . $userdata['user_id'] . "'";

    if (!($result = $db->sql_query($sql))) {
      message_die(GENERAL_ERROR, "Could not read the hashtable", '', __LINE__, __FILE__, $sql);
    }

    if (!($row = $db->sql_fetchrow($result)) or ($vpaver != "100B2") or (!isset($vscore))) {
      
	  $sql = "INSERT INTO " . HACKGAME_TABLE . " (user_id , game_id , date_hack) VALUES ('" . $userdata['user_id'] . "' , '$gid' , '" . time() . "')" ;

        if (!$db->sql_query($sql)) {
          message_die(GENERAL_ERROR, 'Could not insert hack game data', '', __LINE__, __FILE__, $sql);
        }

        header($header_location . "modules.php?name=Forums&file=arcade");
        exit;
    }
}

$sql = "DELETE FROM " . GAMEHASH_TABLE . " WHERE gamehash_id = '$gamehash_id' and game_id = $gid and user_id = " . $userdata['user_id'] ;

if (!$db->sql_query($sql)) {
  message_die(GENERAL_ERROR, 'Could not delete hash data from the games table', '', __LINE__, __FILE__, $sql);
}

if ($row['game_type'] == 4 or $row['game_type'] ==5) {
  
  if ($_COOKIE['gidstarted'] != $gid || !isset($_COOKIE['gidstarted'])) {
    
	$sql = "INSERT INTO " . HACKGAME_TABLE . " (user_id , game_id , date_hack) VALUES ('" . $userdata['user_id'] . "' , '$gid' , '" . time() . "')";

    if (!$db->sql_query($sql)) {
      message_die(GENERAL_ERROR, 'Could not insert hack data from the games table', '', __LINE__, __FILE__, $sql);
    }

    header($header_location . "modules.php?name=Forums&file=arcade");
    exit;
 }
}
/***************************
 *
 * End auth check
 *
 **************************/

$sql = "SELECT * FROM " . SCORES_TABLE . " WHERE game_id = $gid and user_id = " . $userdata['user_id'] ;

if (!($result = $db->sql_query($sql))) {
  message_die(GENERAL_ERROR, "Unable to insert data into scores table", '', __LINE__, __FILE__, $sql);
}

$datenow = time();
$ecart = $datenow - $settime ;

if (!($row = $db->sql_fetchrow($result))) {
  
  $sql = "INSERT INTO " . SCORES_TABLE . " (game_id , user_id , score_game , score_date , score_time , score_set) VALUES ($gid , " . $userdata['user_id'] . " , $score , $datenow , $ecart , 1) ";

  if (!($result = $db->sql_query($sql))) {
    message_die(GENERAL_ERROR, "Unable to insert data into scores table", '', __LINE__, __FILE__, $sql);
  }
} 
else 
{
   if ($row['score_game'] < $score) 
   {
     
	 $sql = "UPDATE " . SCORES_TABLE . " set score_game = $score , score_set = score_set + 1 , score_date = $datenow , score_time = score_time + $ecart WHERE game_id = $gid and user_id = " . $userdata['user_id'] ;

       if (!($result = $db->sql_query($sql))) {
         message_die(GENERAL_ERROR, "Unable to insert data into scores table", '', __LINE__, __FILE__, $sql);
                }
       } 
	   else 
	   {
          $sql = "UPDATE " . SCORES_TABLE . " set score_set = score_set + 1  , score_time = score_time + $ecart WHERE game_id = $gid and user_id = " . $userdata['user_id'] ;

          if (!($result = $db->sql_query($sql))) {
            message_die(GENERAL_ERROR, "Unable to insert data into scores table", '', __LINE__, __FILE__, $sql);
          }
       }
   }

   $sql = "SELECT * FROM " . GAMES_TABLE . " WHERE game_id = " . $gid;

   if (!($result = $db->sql_query($sql))) {
     message_die(GENERAL_ERROR, "Could not read the games table", '', __LINE__, __FILE__, $sql);
   }

   if (($row = $db->sql_fetchrow($result)) && ($row['game_highscore']< $score)) {
     
	 $sql = "UPDATE " . GAMES_TABLE . " SET game_highscore = $score, game_highuser = " . $userdata['user_id'] . ", game_highdate = " . time() . ", game_set = game_set+1 WHERE game_id = $gid" ;

       if (!($result = $db->sql_query($sql))) {
         message_die(GENERAL_ERROR, "Error accessing games table", '', __LINE__, __FILE__, $sql);
       }

       if ($row['game_highuser'] != $userdata['user_id']) {
         
		 $sql = "UPDATE " . COMMENTS_TABLE . " SET comments_value = '' WHERE game_id = $gid";

         if (!($result = $db->sql_query($sql))) {
           message_die(GENERAL_ERROR, "Error accessing comments table", '', __LINE__, __FILE__, $sql);
         }

         $flag = 1;

         $sql = "SELECT * FROM " . SCORES_TABLE . " WHERE game_id = $gid ORDER BY score_game DESC LIMIT 1,1";

         if (!($result = $db->sql_query($sql))) {
           message_die(GENERAL_ERROR, "Error accessing scores table", '', __LINE__, __FILE__, $sql);
         }

         if ($row = $db->sql_fetchrow($result)) {
           
		   $sql= "SELECT s.score_game, s.game_id, g.game_name, u.user_id, u.username 
		   FROM " . SCORES_TABLE . " s 
		   LEFT JOIN " . USERS_TABLE . " u 
		   ON s.user_id = u.user_id 
		   LEFT JOIN " . GAMES_TABLE . " g 
		   ON s.game_id = g.game_id WHERE s.game_id = " . $gid . " 
		   ORDER BY score_game DESC LIMIT 0,1";

           if (!($result = $db->sql_query($sql))) {
             message_die(GENERAL_ERROR, "Error accessing scores and users table", '', __LINE__, __FILE__, $sql);
           }

           $row[0] = $db->sql_fetchrow($result);

           $sql= "SELECT s.score_game, s.game_id, g.game_name, u.user_id, u.username 
		   FROM " . SCORES_TABLE . " s 
		   LEFT JOIN " . USERS_TABLE . " u 
		   ON s.user_id = u.user_id LEFT JOIN " . GAMES_TABLE . " g 
		   ON s.game_id = g.game_id WHERE s.game_id = " . $gid . " 
		   ORDER BY score_game DESC LIMIT 1,1";

           if (!($result = $db->sql_query($sql))) {
             message_die(GENERAL_ERROR, "Error accessing scores and users table", '', __LINE__, __FILE__, $sql);
           }

           $row[1] = $db->sql_fetchrow($result);

           $user_id = $row[1]['user_id'];

           $sql = "SELECT user_allow_arcadepm FROM " . USERS_TABLE . " WHERE user_id = $user_id";

           if (!($result = $db->sql_query($sql))) {
             message_die(GENERAL_ERROR, "Error retrieving user arcade pm preference", '', __LINE__, __FILE__, $sql);
           }

           $row_check = $db->sql_fetchrow($result);

           if ($row_check['user_allow_arcadepm'] == 1) {
          
          # Add to the users new pm counter
          $sql = "UPDATE " . USERS_TABLE . "
          SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . "
          WHERE user_id = " . $user_id;
								
          if ( !$status = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
          }
                              
		  $link = "<a href=modules.php?name=Forums&amp;file=games&amp;gid=" . $row[0]['game_id'] . ">here</a>";

                                                                $privmsgs_date = date("U");

                                $sql = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, 
								                                         privmsgs_subject, 
																     privmsgs_from_userid, 
																	   privmsgs_to_userid, 
																	        privmsgs_date, 
																	 privmsgs_enable_html, 
																   privmsgs_enable_bbcode, 
																  privmsgs_enable_smilies, 
																      privmsgs_attach_sig) 
																	  
							                               VALUES (".PRIVMSGS_NEW_MAIL.",
								                                   '" . str_replace("\'", 
		 "''",addslashes(sprintf($lang['register_pm_subject'],$row[0]['game_name'])))."', 
																					 '2', 
																		   ".$user_id .", 
																	 ".$privmsgs_date .", 
																					 '0', 
																					 '1', 
																					 '1', 
																					 '0')";

          if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Could not insert private message sent info', '', __LINE__, __FILE__, $sql);
          }

          $privmsg_sent_id = $db->sql_nextid();

          $sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_text) 
		  VALUES ($privmsg_sent_id, '" . str_replace("\'", "''", addslashes(sprintf($lang['register_pm'],$row[1]['score_game'],$row[0]['game_name'],$row[0]['username'],$row[0]['score_game'],$link))) . "')";

          if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Could not insert private message sent text', '', __LINE__, __FILE__, $sql);
          }
      }
    }
  }
   
}
else
{
  $sql = "UPDATE " . GAMES_TABLE . " SET game_set = game_set+1 WHERE game_id = $gid";
    if (!$db->sql_query($sql))
    {
      message_die(GENERAL_ERROR, 'Could not update games table', '', __LINE__, __FILE__, $sql);
    }
}

if ($flag == 1) {
  
  if ($_COOKIE['arcadepopup']=='1') {
    header($header_location . "modules.php?name=Forums&file=commentspopup_new&gid=$gid");
    exit;
  }
  else
     {
        header($header_location . "modules.php?name=Forums&file=comments_new&gid=$gid");
        exit;
     }
}
else
   {
     if ($_COOKIE['arcadepopup']=='1')
     {
        header($header_location . "modules.php?name=Forums&file=gamespopup&gid=$gid&mode=done");
        exit;
     }
     else
        {
           header($header_location . "modules.php?name=Forums&file=games&gid=$gid");
           exit;
        }
   }
?>
