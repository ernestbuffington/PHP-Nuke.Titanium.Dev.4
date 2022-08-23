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

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

if(!isset($sid)) 
exit();

function PrintPage($sid) 
{
    global $site_logo, $nukeurl, $sitename, $datetime, $prefix, $db, $module_name;

    $sid = intval($sid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT title, datePublished, dateModified, hometext, bodytext, topic, notes FROM ".$prefix."_stories WHERE sid='$sid'"));
    $title = stripslashes(check_html($row["title"], "nohtml"));
    
	$time = $row["datePublished"];
    $modified = $row["dateModified"];
	
	$hometext = decode_bbcode(set_smilies(stripslashes($row["hometext"])), 1, true);
    $bodytext = decode_bbcode(set_smilies(stripslashes($row["bodytext"])), 1, true);
    $topic = intval($row["topic"]);
    $notes = stripslashes($row["notes"]);
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT topictext FROM ".$prefix."_topics WHERE topicid='$topic'"));
    $topictext = stripslashes($row2["topictext"]);

    formatTimestamp($time);

    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
        <html>
        <head>
        <title>$sitename - $title</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        </head>
        <body bgcolor=\"#ffffff\" text=\"#000000\">
        <table border=\"0\" align=\"center\"><tr><td>

        <table border=\"0\" width=\"640\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#000000\"><tr><td>
        <table border=\"0\" width=\"640\" cellpadding=\"20\" cellspacing=\"1\" bgcolor=\"#ffffff\"><tr><td>
        <center>
        <img src=\"images/$site_logo\" alt=\"$sitename\" title=\"$sitename\" /><br /><br />
        <span class=\"content\">
        <strong>$title</strong></span><br />
        <span class=\"tiny\"><strong>"._PDATE."</strong> $datetime<br /><strong>"._PTOPIC."</strong> $topictext</span><br /><br />
        </center>
        <span class=\"content\">
        $hometext<br /><br />
        $bodytext<br /><br />
        $notes<br /><br />
        </span>
        </td></tr></table></td></tr></table>
        <br /><br /><center>
        <span class=\"content\">
        "._COMESFROM." $sitename<br />
        <a href=\"$nukeurl\">$nukeurl</a><br /><br />
        "._THEURL."<br />
        <a href=\"$nukeurl/modules.php?name=$module_name&amp;file=article&amp;sid=$sid\">$nukeurl/modules.php?name=$module_name&amp;file=article&amp;sid=$sid</a>
        </span></center>
        </td></tr></table>
        </body>
        </html>";
    exit;
}

PrintPage($sid);
?>
