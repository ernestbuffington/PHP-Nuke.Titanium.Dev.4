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
if(preg_match("#All.*Modules#", $showmodule) || !$showmodule ) {
  $modfilter="";
} elseif(preg_match("#Admin#", $showmodule)) {
  $modfilter="AND page LIKE '%".$admin_file.".php%'";
} elseif(preg_match("#Index#", $showmodule)) {
  $modfilter="AND page LIKE '%index.php%'";
} elseif(preg_match("#Backend#", $showmodule)) {
  $modfilter="AND page LIKE '%backend.php%'";
} else {
  $modfilter="AND page LIKE '%name=$showmodule%'";
}
$deleterow = $db->sql_fetchrow($db->sql_query("SELECT `user_id`, `ip_addr` FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_id`='".$deleterow['user_id']."' AND `ip_addr`='".$deleterow['ip_addr']."' $modfilter");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_tracked_ips`");
header("Location: ".$admin_file.".php?op=$xop&min=$min&column=$column&direction=$direction&showmodule=$showmodule&sip=$sip");

?>