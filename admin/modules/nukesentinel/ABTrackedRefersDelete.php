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
$deleterow = $pnt_db->sql_fetchrow($pnt_db->sql_query("SELECT `refered_from` FROM `".$pnt_prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$pnt_db->sql_query("DELETE FROM `".$pnt_prefix."_nsnst_tracked_ips` WHERE `refered_from`='".$deleterow['refered_from']."'");
$pnt_db->sql_query("OPTIMIZE TABLE `".$pnt_prefix."_nsnst_tracked_ips`");
header("Location: ".$admin_file.".php?op=ABTrackedRefersList&min=$min&column=$column&direction=$direction");

?>