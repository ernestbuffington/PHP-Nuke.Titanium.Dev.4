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

if(!defined('NUKE_EVO')) exit;

global $prefix, $db;

$sql = "SELECT pid, title FROM " . $prefix . "_pages WHERE active='1'";
$result = $db->sql_query($sql);
while (list($pid, $title) = $db->sql_fetchrow($result)) {
    $pid = intval($pid);
    $title = stripslashes($title);
    $content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Content&amp;pa=showpage&amp;pid=$pid\">$title</a><br />";
}
$db->sql_freeresult($result);

?>