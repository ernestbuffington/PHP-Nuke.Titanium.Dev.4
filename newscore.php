<?php

/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to Nukeplanet.com for detailed information on PHP-Nuke Platinum*/
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */ 
/************************************************************************/

define('IN_PHPBB', true);
require_once("mainfile.php");

if (isset($_POST['game_name']) ){
$gamename = str_replace("\'","''",(string) $_POST['game_name']);
$gamename = preg_replace(['#&(?!(\#[0-9]+;))#', '#<#', '#>#'], ['&amp;', '&lt;', '&gt;'],$gamename);
//Get Game ID
$row = $db->sql_fetchrow($db->sql_query("SELECT game_id from ".$prefix."_bbgames WHERE game_scorevar='$gamename'"));
$gid = intval($row['game_id']);

}
elseif (isset($_POST['arcade_hash']) ) { 
 $gamehash = str_replace("\'","''",(string) $_POST['arcade_hash']); 
 $gamehash= preg_replace(['#&(?!(\#[0-9]+;))#', '#<#', '#>#'], ['&amp;', '&lt;', '&gt;'],$gamehash); 

 $result=$db->sql_query("SELECT game_id from ".$prefix."_bbgamehash WHERE gamehash_id='$gamehash'  LIMIT 1");
 if (!$result) {
 	die($prefix."_bbgamehash : pas de result: $gamehash");
 }
 $row=$db->sql_fetchrow($result);
 $gid=$row["game_id"];
 }else {
header($header_location . "modules.php?name=Forums&file=arcade");
exit;
}

if (isset($_POST['score'])){
$gamescore = intval($_POST['score']);
}

$ThemeSel = get_theme();
echo "<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
echo "<form method='post' name='ibpro_score' action='modules.php?name=Forums&file=proarcade&valid=X&gpaver=GFARV2'>";
echo "<input type=hidden name='vscore' value='$gamescore'>";
echo "<input type=hidden name='gid' value='$gid'>";
echo "</form>";

echo "<script type=\"text/javascript\">";
echo "window.onload = function(){document.forms[\"ibpro_score\"].submit()}";
echo "</script>";

exit;
