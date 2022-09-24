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

$tid = intval($tid);
$deleterow = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT `refered_from` FROM `".$titanium_prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$titanium_db->sql_query("DELETE FROM `".$titanium_prefix."_nsnst_tracked_ips` WHERE `refered_from`='".$deleterow['refered_from']."'");
$titanium_db->sql_query("OPTIMIZE TABLE `".$titanium_prefix."_nsnst_tracked_ips`");
header("Location: ".$admin_file.".php?op=ABTrackedRefersList&min=$min&column=$column&direction=$direction");

?>