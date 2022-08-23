<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2008 by NukeScripts Network       */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

$pagetitle = _AB_NUKESENTINEL.": "._AB_IMPORTDATA;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_IMPORTDATA);
ipbanmenu();
CarryMenu();
importmenu();
CloseMenu();
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>