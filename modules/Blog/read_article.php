<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* Titanium Blog                                                        */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
	  Titanium Patched                         v3.0.0       08/26/2019
 ************************************************************************/
if (!defined('MODULE_FILE')) { die('You can\'t access this file directly...'); }

global $cookie, $userinfo;

@include_once(NUKE_INCLUDE_DIR.'counter.php');

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

$sid = (int) $sid;

if (stristr($REQUEST_URI,"mainfile")) 
redirect_titanium("modules.php?name=$titanium_module_name&file=read_article&sid=$sid");
else
if (!isset($sid) && !isset($tid)) 
redirect_titanium("index.php");

if ($save AND is_user()) 
{
    $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET umode='$mode', uorder='$order', thold='$thold' where uid='$cookie[0]'");
    $info = base64_encode("$userinfo[user_id]:$userinfo[username]:$userinfo[user_password]:$userinfo[storynum]:$userinfo[umode]:$userinfo[uorder]:$userinfo[thold]:$userinfo[noscore]");
    setcookie("user","$info",time()+$cookieusrtime);
}

if ($op == "Reply") 
redirect_titanium("modules.php?name=$titanium_module_name&file=comments&op=Reply&pid=0&sid=$sid&mode=$mode&order=$order&thold=$thold");

$sql = "select catid, aid, datePublished, dateModified, title, counter, hometext, bodytext, topic, informant, notes, acomm, haspoll, pollID, score, ratings FROM ".$titanium_prefix."_stories where sid='$sid'";
$result = $titanium_db->sql_query($sql);

if ($numrows = $titanium_db->sql_numrows($result) != 1) 
{
    redirect_titanium("index.php");
    exit;
}

$row = $titanium_db->sql_fetchrow($result);

$catid = $row["catid"];

$aid['name'] = stripslashes($row["aid"]);

$aid['color'] = UsernameColor($aid['name']);

$time = $row["datePublished"];
$modified = $row["dateModified"];

$title = $row["title"];

$counter = $row["counter"];

$hometext = decode_bbcode(set_smilies(stripslashes($row["hometext"])), 1, true);

$bodytext = decode_bbcode(set_smilies(stripslashes($row["bodytext"])), 1, true);

$bodytext = evo_img_tag_to_resize($bodytext);
$hometext = evo_img_tag_to_resize($hometext);

$topic = $row["topic"];

$informant = $row["informant"];

$notes = $row["notes"];

$acomm = $row["acomm"];

$haspoll = $row["haspoll"];

$pollID = $row["pollID"];

$score = $row["score"];

$ratings = $row["ratings"];

if (empty($aid['name'])) 
redirect_titanium("modules.php?name=$titanium_module_name"); 

$titanium_db->sql_query("UPDATE ".$titanium_prefix."_stories SET counter=counter+1 where sid=$sid");

$artpage = 1;

$pagetitle = "- $title";

$Theme_Sel = get_theme();

echo "<html>\n";
echo "<head>\n";

@require_once("themes/".$Theme_Sel."/theme.php");

echo "<link href=\"themes/".$Theme_Sel."/style/style.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>".$title."</title>\n";
echo "<base target='parent'>\n";
echo "</head>\n";
echo "<body>\n";

$artpage = 0;

formatTimestamp($time);

$title = stripslashes($title);
$hometext = stripslashes($hometext);
$bodytext = stripslashes($bodytext);
$notes = stripslashes($notes);
$counter = stripslashes($counter);

if($notes != "") 
$notes = "<br /><br /><strong><i>"._NOTE." $notes</i></strong>"; 
else 
$notes = ""; 

if(empty($bodytext)) 
$bodytext = "$hometext$notes"; 
else 
$bodytext = "$hometext<br /><br />$bodytext$notes"; 

if(empty($informant)) 
$informant = $anonymous;

getTopics($sid);

if($catid != 0) 
{
    $sql = "select title from ".$titanium_prefix."_stories_cat where catid='$catid'";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $title1 = $row["title"];
    $title = "<a href=\"modules.php?name=$titanium_module_name&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><font class=\"storycat\">$title1</font></a>: $title";
}

echo "<table width=\"100%\" border=\"0\"><tr><td valign=\"top\" width=\"100%\">\n";

themearticle($aid['name'], $informant, $datetime, $modified, $title, $counter, $bodytext, $topic, $topicname, $topicimage, $topictext);

echo "</td><td>&nbsp;</td><td valign=\"top\">\n";

echo "</body>\n";
echo "</html>\n";
exit;
?>
