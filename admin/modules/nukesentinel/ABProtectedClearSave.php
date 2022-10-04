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

$result = $pnt_db->sql_query("DELETE FROM `".$pnt_prefix."_nsnst_protected_ranges`");
$pnt_db->sql_query("OPTIMIZE TABLE `".$pnt_prefix."_nsnst_protected_ranges`");
header("Location: ".$admin_file.".php?op=ABProtectedMenu");

?>