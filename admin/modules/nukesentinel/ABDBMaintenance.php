<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://nukescripts.86it.us)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

if(is_god($admin)) {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_DBMAINTENANCE);
  mastermenu();
  CarryMenu();
  databasemenu();
  CloseMenu();
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>