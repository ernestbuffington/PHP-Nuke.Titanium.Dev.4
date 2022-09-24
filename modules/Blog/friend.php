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
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
	  Titanium Patched                         v3.0.0       08/26/2019
	  reCAPTCHA                                v2.0.0       08/27/2019
 ************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...'); 

if (!file_exists("includes/nukesentinel.php")) 
{
   if (stristr($_SERVER['QUERY_STRING'],'%25')) 
   redirect_titanium("index.php");
}

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

$pagetitle = "- "._RECOMMEND."";

if (!is_user()) 
{
    redirect_titanium("modules.php?name=$titanium_module_name&file=article&sid=$sid");
    exit;
}

function FriendSend($sid) 
{
    global $titanium_user, $cookie, $titanium_prefix, $titanium_db, $titanium_user_prefix, $titanium_module_name;

    $sid = intval($sid);

    if(!isset($sid)) 
    exit(); 
    
	include_once(NUKE_BASE_DIR."header.php");
    
	$row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT title FROM ".$titanium_prefix."_stories WHERE sid='$sid'"));
    $title = stripslashes(check_html($row["title"], "nohtml"));
    
    OpenTable();
    
	echo "<div align=\"center\"><span class=\"content\"><strong>"._FRIEND."</strong></span></div><br /><br />"
        .""._YOUSENDSTORY." <strong>$title</strong> "._TOAFRIEND."<br /><br />"
        ."<form action=\"modules.php?name=$titanium_module_name&amp;file=friend\" method=\"post\">"
        ."<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
    
	if (is_user()) 
	{
        $row2 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT name, username, user_email FROM ".$titanium_user_prefix."_users WHERE user_id = '".intval($cookie[0])."'"));
        $yn = stripslashes($row2["name"]);
        $ye = stripslashes($row2["user_email"]);
    }
    
	echo "<strong>"._FYOURNAME." </strong> <input type=\"text\" name=\"yname\" value=\"$yn\"><br /><br />\n";
    echo "<strong>"._FYOUREMAIL." </strong> <input type=\"text\" name=\"ymail\" value=\"$ye\"><br /><br /><br />\n";
    echo "<strong>"._FFRIENDNAME." </strong> <input type=\"text\" name=\"fname\"><br /><br />\n";
    echo "<strong>"._FFRIENDEMAIL." </strong> <input type=\"text\" name=\"fmail\"><br /><br />\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"SendStory\">\n";
	
	#recaptcha add Ernest Buffington	
	echo "<table>".security_code(array(0,1,2,3,4,5,6,7), 'normal')."</table><br />";
    #recaptcha add Ernest Buffington		
	
	echo "<br /><input type=\"submit\" value="._SEND.">\n";
    echo "</form>\n";
    CloseTable();
    @include_once('footer.php');
}


function SendEmailVirus($sid, $yname, $ymail, $fname, $fmail) {
    
	global $sitename, $nukeurl, $titanium_prefix, $titanium_db, $titanium_module_name;

    #recaptcha add Ernest Buffington	
	if (!security_code_check($_POST['g-recaptcha-response'], array(0,1,2,3,4,5,6,7))):
        include_once(NUKE_BASE_DIR."header.php");
        OpenTable();

        echo '<div align="center"><strong>reCaptcha Security Check Failed</strong></div>';
		echo "<div align=\"center\"><strong>[ <a href=\"$nukeurl/modules.php?name=$titanium_module_name&file=article&sid=$sid\">Back To Blog</a> ]</strong></div>";
		echo "<div align=\"center\"><strong>[ <a href=\"javascript:history.go(-1)\">Go Back</a> ]</strong></div>";

        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
	endif;
    #recaptcha add Ernest Buffington		

    $fname = stripslashes(removecrlf($fname));
    $fmail = stripslashes(removecrlf($fmail));
    $yname = stripslashes(removecrlf($yname));
    $ymail = stripslashes(removecrlf($ymail));
    $sid = intval($sid);
    $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT title, time, topic FROM ".$titanium_prefix."_stories WHERE sid='$sid'"));
    $title = stripslashes(check_html($row["title"], "nohtml"));
    $time = $row["time"];
    $topic = intval($row["topic"]);
    $row2 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT topictext FROM ".$titanium_prefix."_topics WHERE topicid='$topic'"));
    $topictext = stripslashes(check_html($row2["topictext"], "nohtml"));
    $subject = ""._INTERESTING." $sitename";
    $message = ""._HELLO." $fname:\n\n"._YOURFRIEND." $yname "._CONSIDERED."\n\n\n$title\n("._FDATE." $time)\n"._FTOPIC." $topictext\n\n"._URL.": $nukeurl/modules.php?name=$titanium_module_name&file=article&sid=$sid\n\n"._YOUCANREAD." $sitename\n$nukeurl";
    evo_mail($fmail, $subject, $message, "From: \"$yname\" <$ymail>\nX-Mailer: PHP/" . phpversion());
    $title = urlencode($title);
    $fname = urlencode($fname);
    redirect_titanium("modules.php?name=$titanium_module_name&file=friend&op=StorySent&title=$title&fname=$fname");
}

function SendStory($sid, $yname, $ymail, $fname, $fmail) {
    global $sitename, $nukeurl, $titanium_prefix, $titanium_db, $titanium_module_name;

    #recaptcha add Ernest Buffington	
	if (!security_code_check($_POST['g-recaptcha-response'], array(0,1,2,3,4,5,6,7))):
        include_once(NUKE_BASE_DIR."header.php");
        OpenTable();
        echo '<div align="center"><strong>reCaptcha Security Check Failed</strong></div>';
        
		echo "<div align=\"center\"><strong>[ <a href=\"$nukeurl/modules.php?name=$titanium_module_name&file=article&sid=$sid\">Back To Blog</a> ]</strong></div>";
		
		echo "<div align=\"center\"><strong>[ <a href=\"javascript:history.go(-1)\">Go Back</a> ]</strong></div>";
		
		
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
	endif;
    #recaptcha add Ernest Buffington		

    $fname = stripslashes(removecrlf($fname));
    $fmail = stripslashes(removecrlf($fmail));
    $yname = stripslashes(removecrlf($yname));
    $ymail = stripslashes(removecrlf($ymail));
    $sid = intval($sid);
    $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT title, datePublished, topic FROM ".$titanium_prefix."_stories WHERE sid='$sid'"));
    $title = stripslashes(check_html($row["title"], "nohtml"));
    $time = $row["datePublished"];
    $topic = intval($row["topic"]);
    $row2 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT topictext FROM ".$titanium_prefix."_topics WHERE topicid='$topic'"));
    $topictext = stripslashes(check_html($row2["topictext"], "nohtml"));
    $subject = ""._INTERESTING." $sitename";
    $message = ""._HELLO." $fname:\n\n"._YOURFRIEND." $yname "._CONSIDERED."\n\n\n$title\n("._FDATE." $time)\n"._FTOPIC." $topictext\n\n"._URL.": $nukeurl/modules.php?name=$titanium_module_name&file=article&sid=$sid\n\n"._YOUCANREAD." $sitename\n$nukeurl";
    evo_mail($fmail, $subject, $message, "From: \"$yname\" <$ymail>\nX-Mailer: PHP/" . phpversion());
    $title = urlencode($title);
    $fname = urlencode($fname);
    redirect_titanium("modules.php?name=$titanium_module_name&file=friend&op=StorySent&title=$title&fname=$fname");
}

function StorySent($title, $fname) 
{
    include_once(NUKE_BASE_DIR."header.php");
    $title = htmlspecialchars(urldecode(check_html($title, "nohtml")));
    $fname = htmlspecialchars(urldecode($fname));

    OpenTable();

    echo "<div align=\"center\"><span class=\"content\">"._FSTORY." <strong>$title</strong> "._HASSENT." $fname... "._THANKS."</span></div>";
    echo "<div align=\"center\"><strong>[ <a href=\"modules.php?name=Blog_Topics\">Back To Blog Topics</a> ]</strong></div>";
	echo "<div align=\"center\"><strong>[ <a href=\"javascript:history.go(-1)\">Send To More Friends</a> ]</strong></div>";

	CloseTable();
    @include_once("footer.php");
}

switch($op) 
{
    case "SendStory":
    SendStory($sid, $yname, $ymail, $fname, $fmail);
    break;
    case "StorySent":
    StorySent($title, $fname);
    break;
    case "SendEmailVirus": /* This was put here as a joke - Ghost's Idea of a funny Easter Egg - 08/27/2019 */
    SendEmailVirus($sid, $yname, $ymail, $fname, $fmail);
    break;
    case "FriendSend":
    FriendSend($sid);
    break;
}
?>
