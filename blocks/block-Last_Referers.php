<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Last referers block for phpNuke portal                               */
/* Copyright (c) 2001 by Jack Kozbial (jack@internetintl.com            */
/* http://www.InternetIntl.com                                          */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $db, $prefix;

# how many referers should the block display?
$ref = 10;
$a = 1;
$content = '';

$result = $db->sql_query("SELECT url FROM ".$prefix."_referer ORDER BY lasttime DESC LIMIT 0,$ref");
$total = $db->sql_numrows($result);
if ($total < 1) {
    return $content = 'No referers to display';
}

while (list($url) = $db->sql_fetchrow($result)) {
    $url2 = str_replace('_', ' ', $url);
    
    if (strlen($url2) > 18) {
        $url2 = substr($url, 0, 20);
        $url2 .= '..';
    }
    
    $content .= "$a:&nbsp;\n"
               ."<a href=\"$url\" target=\"_blank\">$url2</a>\n"
               ."<br />\n";
    $a++;
}

if (is_admin()) {
    global $admin_file;
    $content .= "<br />\n"
               ."<div align=\"center\">\n"
               ."$total "._HTTPREFERERS."\n"
               ."<br /><br />\n"
               ."[ <a href=\"".$admin_file.".php?op=hreferer&amp;del=all\">"._DELETE."</a> ]\n"
               ."</div>\n";
}
$db->sql_freeresult($result);

?>