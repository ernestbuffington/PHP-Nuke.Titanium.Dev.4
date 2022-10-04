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

$pnt_db->sql_query("DELETE FROM `".$pnt_prefix."_nsnst_tracked_ips` WHERE `tid`='$tid'");
$pnt_db->sql_query("OPTIMIZE TABLE `".$pnt_prefix."_nsnst_tracked_ips`");
header("Location: ".$admin_file.".php?op=ABTrackedPages&user_id=$pnt_user_id&ip_addr=$ip_addr&column=$column&direction=$direction&min=$min");

?>