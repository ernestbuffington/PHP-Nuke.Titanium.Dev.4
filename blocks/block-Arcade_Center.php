<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Center Arcade Block                                        */
/* ================================                                     */
/*                                                                      */
/* Copyright (c) 2004 by JRSweets                                       */
/* http://www.jeffrusso.net                                             */
/*                                                                      */
/* Originally by:                                                       */
/* Copyright (c) 2004 by Barcrest                                       */
/* http://baja.ods.org                                                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation                                         */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/20/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       09/20/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

define("_TOPGAMERS", "The Top Players");
define("_VICTOIRES", "Number Of Wins :");

define('IN_PHPBB', true);
include_once('includes/functions.php');
define('IN_PHPBB', false);

global $prefix, $user_prefix, $db, $ThemeSel;

/*****EDIT CONFIG SETTINGS*******/
/***** ON = 1  -  OFF = 0 *******/
//Top section of block
$top = 1;

//Last 5 High Score section
$last_five = 1;
//Limit of lastest highscores
$highscore_limit = 5;

//Arcade stats sections
$arcade_stats = 1;

//Who's playing what game section
$whos_playing = 1;
/*****END CONFIG SETTINGS********/

if(file_exists("themes/$ThemeSel/style/style.css"))
{
        $content = "<link rel=\"stylesheet\" href=\"themes/$ThemeSel/style/style.css\" type=\"text/css\">";
}else if (file_exists("themes/$ThemeSel/forums/forums.css"))
{
        $content = "<link rel=\"stylesheet\" href=\"themes/$ThemeSel/forums/forums.css\" type=\"text/css\">";
}
else
{
        $content = "<style type=\"text/css\">\n";
        $content .= "<!--\n";
        $content .= "td.row1    { background-color: #EFEFEF; }\n";
        $content .= "td.row2    { background-color: #DEE3E7; }\n";
        $content .= "td.row3    { background-color: #D1D7DC; }\n";
        $content .= "th    { color: #FFA34F; font-size: 11px; font-weight : bold;background-color: #006699; height: 25px;background-image: url(/modules/Forums/templates/subSilver/images/cellpic3.gif); }\n";
        $content .= "-->\n";
        $content .= "</style>\n";

}

        $sql = "SELECT game_id FROM ".$prefix."_bbgames";
        $total_games = $db->sql_numrows($db->sql_query($sql));
        $recent_scores = ($total_games > $highscore_limit) ? $highscore_limit : $total_games;

if ($top) {

        $sql = "SELECT arcade_catid FROM ".$prefix."_bbarcade_categories";
        $total_cats = $db->sql_numrows($db->sql_query($sql));
        
		# PADDING OVER TABLE
		$content .= '<div align="center" style="padding-top:23px;"></div>'; 
        
		$content .= "<table class=\"catHead\" width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
        $content .= "<tr>\n";
        $content .= "<th class=\"thHead\" width=\"30%\" align=\"center\"><strong>Top Scorers</strong></th>\n";
        $content .= "<th class=\"thHead\" width=\"40%\" align=\"center\"><strong>Random Game</strong></th>\n";
        $content .= "<th class=\"thHead\" width=\"30%\" align=\"center\"><strong>New Games</strong></th>\n";
        $content .= "</tr>\n";
        $content .= "<tr>\n";
        $content .= "<td align=\"center\" class=\"row1\"><marquee behavior= \"scroll\" align= \"center\" direction= \"up\" scrollamount= \"2\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'><center>\n";

        $sql = "SELECT COUNT(*) AS nbvictoires, g.game_highuser, u.user_id, u.username, u.user_level 
		FROM ".$prefix."_bbgames g, ".$user_prefix."_users u WHERE g.game_highuser = u.user_id AND g.game_highuser <> 0 GROUP BY g.game_highuser ORDER BY nbvictoires DESC";
        
		$result = $db->sql_query($sql);

        $place = 0;
        $nbvictprec = 0;

        while ($row = $db->sql_fetchrow($result)) {
                if ($nbvictprec <> $row['nbvictoires']) {
                        $nbvictprec = $row['nbvictoires'];
                }

                $place++;

                                $lastUser = $row['username'];
                                $row['username'] = '<strong>' . UsernameColor($row['username']) . '</strong>';
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

                $content .= "<strong>$place - </strong>\n";
                $content .= "<a href=\"modules.php?name=Forums&amp;file=statarcade&amp;uid=".$row['user_id']."\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\" alt=\"Jump to $lastUser's stats...\"></a> \n";
                $content .= "<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$row['user_id']."\">".$row['username']."</a> \n";
                $content .= "<br /> "._VICTOIRES." $nbvictprec <br /><br />\n";

                $count = $count + 1;
        }

        $content .= "</center></marquee></td>\n";

        //Random Game
        $sql = "SELECT g.* , u.username FROM ".$prefix."_bbgames g, ".$user_prefix."_users u WHERE g.game_highuser = u.user_id ORDER BY rand() LIMIT 1";
        $row = $db->sql_fetchrow($db->sql_query($sql));
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $randomUser = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $row['game_highscore'] = number_format($row['game_highscore']);
        
        $content .= "<td valign=\"top\" align=\"center\" class=\"row2\"><center></br><a href=\"modules.php?name=Forums&amp;file=arcade\"><img width=\"269\" src=\"images/arcade_mod/arcade_logo.png\" border= \"0\"></a></center><br />
<strong>".$row['game_name']."</strong><br /><a href=\"modules.php?name=Forums&amp;file=games&amp;gid=".$row['game_id']."\"><img src=\"modules/Forums/games/pics/".$row['game_pic']."\" border= \"0\" alt=\"".$row['game_name']."\"></a><br /> High Score set by<br /><strong><a href=\"modules.php?name=Forums&amp;file=statarcade&amp;uid=".$row['game_highuser']."\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\" alt=\"Jump to ".$row['username']."...\"></a> <a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$row['game_highuser']."\">$randomUser</a> </strong><br />with <strong>".$row['game_highscore']."</strong> <br /><br />Total Games <strong>$total_games</strong><br />in <strong>$total_cats</strong> categories.</br></br>This site uses the ruffle Flash Engine</br></br></br>The ruffle Arcade Mod v4.0 is still in development.</td>\n";

        $content .= "<td align=\"center\" class=\"row1\">\n";

        $content .= "<marquee behavior= \"scroll\" align= \"center\" direction= \"up\" scrollamount= \"2\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'><center>\n";

        $sql = "SELECT game_name, game_id, game_pic FROM ".$prefix."_bbgames ORDER BY game_order DESC LIMIT 0,$recent_scores";

        $result = $db->sql_query($sql);

        while ($row = $db->sql_fetchrow($result)) {
                $lastGame = $row['game_name'];
                $lastgameid = $row['game_id'];
                $lastgamepic = $row['game_pic'];

                $content .= "<a href=\"modules.php?name=Forums&amp;file=games&amp;gid=$lastgameid\"><img src=\"modules/Forums/games/pics/$lastgamepic\" border= \"0\" alt=\"$lastGame\"><br /><strong>$lastGame</strong></a><br /><br />\n";
        }

        $content .= "</center></marquee></td>\n";
        $content .= "</tr></table>\n";
}

                if ($last_five) {
                $content .= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
                $content .= "<tr>\n";
                $content .= "<th class=\"thHead\" colspan=\"4\" align=\"center\"><strong>Latest High Scores</strong></th>\n";
                $content .= "</tr>\n";
                $content .= "<tr>\n";
                $content .= "<td class=\"row1\" align=\"center\"><strong>User</strong></td>\n";
                $content .= "<td class=\"row2\" align=\"center\"><strong>Score</strong></td>\n";
                $content .= "<td class=\"row1\" align=\"center\"><strong>Game</strong></td>\n";
                $content .= "<td class=\"row2\" align=\"center\"><strong>Date</strong></td>\n";
                $content .= "</tr>\n";

                 $place = 0;

                 $sql = "SELECT g.* , u.username FROM ".$prefix."_bbgames g, ".$user_prefix."_users u WHERE g.game_highuser = u.user_id ORDER BY game_highdate DESC LIMIT 0,$recent_scores";
                         $result = $db->sql_query($sql);

                 while ($row = $db->sql_fetchrow($result)) {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $lastUser = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $row['game_highscore'] = number_format($row['game_highscore']);
                //$lasthighdate = date("D M d, Y g:i a" , $row['game_highdate']);
                global $board_config;
                $lasthighdate = create_date( $board_config['default_dateformat'] , $row['game_highdate'] , $board_config['board_timezone'] );

                $content .= "<tr>\n";
                $content .= "<td width=\"18%\" align=\"center\" class=\"row1\"><a href=\"modules.php?name=Forums&amp;file=statarcade&amp;uid=".$row['game_highuser']."\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\" alt=\"Jump to ".$row['username']."'s stats...\"></a><a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$row['game_highuser']."\">$lastUser</a> </strong></td>\n";
                $content .= "<td width=\"18%\" align=\"center\" class=\"row2\"><strong>".$row['game_highscore']."</strong></td>\n";
                $content .= "<td width=\"34%\" align=\"left\" class=\"row1\"><strong>&nbsp;&nbsp;<a href=\"modules.php?name=Forums&amp;file=games&amp;gid=".$row['game_id']."\"><img height=\"20\" width=\"20\" src=\"modules/Forums/games/pics/".$row['game_pic']."\" border= \"0\" alt=\"".$row['game_name']."\"></a> - ".$row['game_name']."</strong></td>\n";
                $content .= "<td width=\"30%\" align=\"center\" class=\"row2\"><strong>$lasthighdate</strong></td>\n";
                $content .= "</tr>\n";
                }

           $content .= "</table>\n";
                   }

if ($arcade_stats) {
                $content .= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
        $content .= "<tr>\n";
                $content .= "<th class=\"thHead\" width=\"100%\" colspan=\"2\" align=\"center\" class=\"th\"><strong>Arcade Stats</strong></th>\n";
                $content .= "</tr>\n";

                //Most Played Game
        $sql = "SELECT game_set, game_name, game_id FROM ".$prefix."_bbgames ORDER BY game_set DESC LIMIT 1";
        $row = $db->sql_fetchrow($db->sql_query($sql));

        $content .= "<tr>\n";
                $content .= "<td width=\"50%\" align=\"center\" class=\"row1\">Most Popular: <a href=\"modules.php?name=Forums&amp;file=games&amp;gid=".$row['game_id']."\"><strong>".$row['game_name']."</strong> </a>with <strong>".$row['game_set']."</strong> plays.</td>\n";

                //Least Played Game
        $sql = "SELECT game_set, game_name, game_id FROM ".$prefix."_bbgames ORDER BY game_set ASC LIMIT 1";
                $row = $db->sql_fetchrow($db->sql_query($sql));

        $content .= "<td width=\"50%\" align=\"center\" class=\"row1\">Least Popular: <a href=\"modules.php?name=Forums&amp;file=games&amp;gid=".$row['game_id']."\"> <strong>".$row['game_name']."</strong> </a>with <strong>".$row['game_set']."</strong> plays.</td>\n";
        $content .= "</tr>\n";

        //Category Stats
        $content .= "<tr>\n";
                $content .= "<td colspan=\"2\" width=\"10%\" height=\"25\"  align=\"center\" class=\"row1\"><marquee behavior= \"scroll\" align= \"center\" direction= \"left\" width=\"100%\" scrollamount= \"2\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'>\n";

        $sql = "SELECT arcade_cattitle, arcade_nbelmt, arcade_catid FROM ".$prefix."_bbarcade_categories ORDER BY arcade_cattitle";
                $result = $db->sql_query($sql);

        while ($row = $db->sql_fetchrow($result))
                {
                    $content .="<a href=\"modules.php?name=Forums&amp;file=arcade&amp;cid=".$row['arcade_catid']."\">\n";
            $content .="<strong>".$row['arcade_cattitle']." (".$row['arcade_nbelmt']." Games)</strong>\n";
            $content .="</a>&nbsp;&nbsp;&nbsp;\n";
        }
                $content .= "</marquee></td>\n";
                $content .= "</tr>\n";
        $content .= "</table>\n";
}

if ($whos_playing) {
                $content .= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
        $content .= "<tr>\n";
                $content .= "<th class=\"thHead\" width=\"100%\" colspan=\"2\" align=\"center\"><strong>Who's Playing</strong></th>\n";
                $content .= "</tr>\n";

        $sql = "SELECT u.username, u.user_id, u.user_level, user_allow_viewonline, g.game_name, g.game_id FROM ".$prefix."_bbgamehash gh LEFT JOIN ".$prefix."_bbsessions s ON gh.user_id = s.session_user_id LEFT JOIN ".$user_prefix."_users u ON gh.user_id = u.user_id LEFT JOIN ".$prefix."_bbgames g ON gh.game_id = g.game_id WHERE gh.hash_date >= s.session_time AND (" . time() . "- gh.hash_date <= 300) ORDER BY gh.hash_date DESC";

        $result = $db->sql_query($sql);

        while ($row = $db->sql_fetchrow($result)) {
                $players[] = $row;
        }

        $nbplayers = count($players);
        $listeid = array();
        $games_players = array();
        $games_names = array();

        if ($nbplayers != 0) {
                $content .="<tr>\n";
                                $content .="<td class=\"row1\"><strong>Game</strong></td>\n";
                                $content .="<td class=\"row2\"><strong>Users</strong></td>\n";

                for ($i=0 ; $i<$nbplayers ; $i++) {
                        if (!isset($listeid[ $players[$i]['user_id'] ])) {
                                $listeid[ $players[$i]['user_id'] ] = true ;

                                if ($players[$i]['user_allow_viewonline'])
                                                                {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                                $players[$i]['username'] = UsernameColor($players[$i]['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                        $player_link = '<a href=modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$players[$i]['user_id']. '>' . $players[$i]['username'] . '</a>';
                                                                }
                                                                else
                                                                {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                                                                $players[$i]['username'] = UsernameColor($players[$i]['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                                                                $player_link = '<a href=modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$players[$i]['user_id']. '><i>' . $players[$i]['username'] . '</i></a>';
                                                                }

                                if ($players[$i]['user_allow_viewonline'] || $userdata['user_level'] == 2) {
                                        if(!isset($games_names[ $players[$i]['game_id'] ])) {
                                                $games_names[ $players[$i]['game_id'] ] = $players[$i]['game_name'] ;
                                                $games_players[ $players[$i]['game_id'] ] = $player_link ;
                                        } else {
                                                $games_players[ $players[$i]['game_id'] ] .=  ', ' . $player_link ;
                                        }
                                }
                        }
                }
                foreach($games_names AS $key => $val) {
                        if ($games_players[$key]!='') {
                                $content .= "<tr>\n";
                                                                $content .= "<td width=\"30%\" class=\"row1\"><a href=\"modules.php?name=Forums&amp;file=games&amp;gid=$key\">$val</a></td>\n";
                                $content .= "<td class=\"row2\">" .$games_players[$key]. "</td>\n";
                                                                $content .= "</tr>\n";
                        }
                }
                $content .= "</table>";
        } else {
                $content .="<td colspan=\"2\" align=\"center\" class=\"row1\">There are currently no games being played in the arcade.</td>\n";
                $content .= "</table>\n";
        }
		
		# PADDING AT BOTTOM OF TABLE
		$content .= '<div align="center" style="padding-top:23px;"></div>'; 

}

?>