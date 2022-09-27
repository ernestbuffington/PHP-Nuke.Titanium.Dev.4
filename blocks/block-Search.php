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

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

$content = "<br/><form onsubmit=\"this.submit.disabled='true'\" action=\"modules.php?name=Search\" method=\"post\">";
$content .= "<div align=\"center\"><input type=\"text\" name=\"query\" size=\"15\"><br/>";
$content .= "<br /><input class=\"titaniumbutton\" type=\"submit\" value=\""._SEARCH."\"></div></form><br/>";

?>