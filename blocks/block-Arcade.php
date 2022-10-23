<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Arcade Block                                               */
/* ================================                                     */
/*                                                                      */
/* Copyright (c) 2004 by Barcrest                                       */
/* http://baja.ods.org/                                                 */
/*                                                                      */
/* And                                                                  */
/*                                                                      */
/* Copyright (c) 2004 by Phantomk                                       */
/* http://www.5thlegion.com                                             */
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

global $prefix, $user_prefix, $db;

$sql = "SELECT g.* , u.username FROM ".$prefix."_bbgames g, ".$user_prefix."_users u WHERE g.game_highuser = u.user_id ORDER BY game_highdate DESC LIMIT 0,1 " ;

if(!($result = $db->sql_query($sql)))
{
        die("Could not query games user information");
}

$row = $db->sql_fetchrow($result);

$lastScore = number_format($row['game_highscore']);
$lastGame = $row['game_name'];
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
$lastUser = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

$lastgameid = $row['game_id'];
$lastgamepic = $row['game_pic'];
$lastuserid = $row['game_highuser'];

$count = 1;
$content = "<center><a href=\"modules.php?name=Forums&amp;file=arcade\"><img width=\"169\" src=\"images/arcade_mod/arcade_logo.png\" border= \"0\"></a></center><br />";
$content .="<marquee behavior= \"scroll\" align= \"center\" direction= \"up\" height=\"160\" scrollamount= \"2\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'>";

$content .= "<center><a href=\"modules.php?name=Forums&amp;file=games&amp;gid=$lastgameid\">";
$content .= "<img src=\"modules/Forums/games/pics/$lastgamepic\" border= \"0\"></a><br /> ";
$content .= "Latest High Score set by <br /><strong>";
$content .= "<a href=\"modules.php?name=Forums&amp;file=statarcade&amp;uid=$lastuserid\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\"></a> ";
$content .= "<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$lastuserid\">$lastUser</a> ";
$content .= "</strong><br />with <strong>$lastScore</strong> on <strong>$lastGame</strong>";

$content .= "<br />";
$content .= "--------";
$content .= "<br />";
$content .= "<span color=\"#666666\"><strong>"._TOPGAMERS."</strong><br />";

$content .= "<br />";

$sql = "SELECT COUNT(*) AS nbvictoires, g.game_highuser, u.user_id, u.username, u.user_level FROM ".$prefix."_bbgames g, ".$user_prefix."_users u WHERE g.game_highuser = u.user_id AND g.game_highuser <> 0 GROUP BY g.game_highuser ORDER BY nbvictoires DESC";

if(!($result = $db->sql_query($sql)))
{
        die("Could not query games information");
}

$place=0;
$nbvictprec=0;
while ($row = $db->sql_fetchrow($result)) {
        if ($nbvictprec <> $row['nbvictoires'])
        {
                $nbvictprec = $row['nbvictoires'];
        }

        $place++;
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $row['username'] = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $content .= "<strong>$place - </strong>";
        $content .= "<a href=\"modules.php?name=Forums&amp;file=statarcade&amp;uid=".$row['user_id']."\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\"></a> ";
        $content .= "<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$row['user_id']."\"><strong>".$row['username']."</strong></a> ";
        $content .= "<br /> "._VICTOIRES." $nbvictprec<br /><br />";
        $count = $count + 1;
}

$content .= "</span></center></marquee>"

?>