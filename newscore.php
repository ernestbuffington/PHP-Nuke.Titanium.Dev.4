<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                newscore.php
 *                            -------------------
 *   THIS FILE SHOULD BE AT THE SITE ROOT
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

define('IN_PHPBB', true);
include(dirname(__FILE__).'/mainfile.php');

if (isset($HTTP_POST_VARS['game_name']) ) {
$gamename = str_replace("\'","''",$HTTP_POST_VARS['game_name']);
$gamename = preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$gamename);
//Get Game ID
$row = $db->sql_fetchrow($db->sql_query("SELECT game_id FROM ".$prefix."_bbgames WHERE game_scorevar='$gamename'"));
$gid = intval($row['game_id']);
}
elseif (isset($HTTP_POST_VARS['arcade_hash']) ) { 
    $gamehash = str_replace("\'","''",$HTTP_POST_VARS['arcade_hash']); 
    $gamehash= preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$gamehash); 

    $result=$db->sql_query("SELECT game_id FROM ".$prefix."_bbgamehash WHERE gamehash_id='$gamehash' LIMIT 1");
    if (!$result) {
        die($prefix."_bbgamehash : pas de result: $gamehash");
    }
    $row=$db->sql_fetchrow($result);
    $gid=$row["game_id"];
    }else {
header($header_location . "modules.php?name=Forums&file=arcade");
exit;
}

if (isset($HTTP_POST_VARS['score'])){
$gamescore = intval($HTTP_POST_VARS['score']);
}

$ThemeSel = get_theme();
echo "<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
echo "<form method='post' name='ibpro_score' action='modules.php?name=Forums&amp;file=proarcade&amp;valid=X&amp;gpaver=GFARV2'>";
echo "<input type=hidden name='vscore' value='$gamescore'>";
echo "<input type=hidden name='gid' value='$gid'>";
echo "</form>";

echo "<script type=\"text/javascript\">";
echo "window.onload = function(){document.forms[\"ibpro_score\"].submit()}";
echo "</script>";

exit;

?>