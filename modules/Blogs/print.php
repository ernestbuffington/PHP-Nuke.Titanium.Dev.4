<?php
/*=======================================================================
 PHP-Nuke Titanium v4.0.3 : Enhanced PHP-Nuke Web Portal System
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
	  Titanium Patched                         v4.0.3       01/25/2023
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
	  Titanium Patched                         v3.0.0       08/26/2019
-=[Applied Rules]=-
 * DirNameFileConstantToDirConstantRector
 * NullToStrictStringFuncCallArgRector	  
 ************************************************************************/
if (!defined('MODULE_FILE')) { die('You can\'t access this file directly...'); }

$module_name = basename(__DIR__);

get_lang($module_name);

if(!isset($sid)) 
exit();

function PrintPage($sid) 
{
    global $site_logo, $nukeurl, $sitename, $datetime, $prefix, $db, $module_name;
    
	// Ernest Buffington 0/31/2022 12:45am Wednesday
	// I took the image out as this is a print page and wastes ink!!!
	//<img src=\"images/$site_logo\" alt=\"$sitename\" title=\"$sitename\" /><br /><br />

    $sid = intval($sid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT aid, title, datePublished, dateModified, hometext, bodytext, topic, notes FROM ".$prefix."_blogs WHERE sid='$sid'"));
    $title = stripslashes((string) check_html($row["title"], "nohtml"));
    
	// START Ernest Buffington 0/31/2022 12:45am Wednesday
	$aid = $row["aid"];
	// END Ernest Buffington 0/31/2022 12:45am Wednesday
	
	$time = $row["datePublished"];
    $modified = $row["dateModified"];
	
	$hometext = decode_bbcode(set_smilies(stripslashes((string) $row["hometext"])), 1, true);
    $bodytext = decode_bbcode(set_smilies(stripslashes((string) $row["bodytext"])), 1, true);
    $topic = intval($row["topic"]);
    $notes = stripslashes((string) $row["notes"]);
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT topictext FROM ".$prefix."_blogs_topics WHERE topicid='$topic'"));
    $topictext = stripslashes((string) $row2["topictext"]);

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
        <div align=\"center\">
        <span class=\"content\">
        <strong><font size=\"6\">$sitename</strong></font> <br />
		<strong>$title</strong></span><br />
        <span class=\"tiny\"><strong>"._PDATE."</strong> $datetime<br /><strong>"._PTOPIC."</strong> $topictext</span><br /><br />
        </div>
        <span class=\"content\">
        $hometext";
		
		// START Ernest Buffington 0/31/2022 12:45am Wednesday
		if (!empty($bodytext)) :
        echo '<br />$bodytext<br />';
        endif;
		/*$notes<br />*/
		//SIGNATTURE GOES HERE
   print blog_signature($aid);
		// END Ernest Buffington 0/31/2022 12:45am Wednesday

   
   echo "</span>
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

