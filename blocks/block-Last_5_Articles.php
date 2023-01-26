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

/* Block to fit perfectly in the center of the site, remember that not all
   blocks looks good on Center, just try and see yourself what fits your needs */

if(!defined('NUKE_EVO')) exit;

global $prefix, $multilingual, $currentlang, $db;

if ($multilingual == 1) {
    $querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
} else {
    $querylang = '';
}
$content = "<table width=\"100%\" border=\"0\">";
$sql = "SELECT sid, title, comments, counter FROM ".$prefix."_blogs $querylang ORDER BY sid DESC LIMIT 0,5";
$result = $db->sql_query($sql);
while (list($sid, $title, $comments, $counter) = $db->sql_fetchrow($result)) {
    $title = stripslashes($title);
    $content .= "<tr><td align=\"left\">";
    $content .= "<strong><big>&middot;</big></strong>";
    $content .= " <a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=".$sid."\">$title</a>";
    $content .= "</td><td align=\"right\">";
    $content .= "[ $comtotal "._COMMENTS." - $counter "._READS." ]";
    $content .= "</td></tr>";
}
$db->sql_freeresult($result);
$content .= "</table>";
$content .= "<br /><center>[ <a href=\"modules.php?name=Blogs\">"._MOREBLOGS."</a> ]</center>";

?>