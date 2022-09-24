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

$getIPs = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_ip2country` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1"));
list($xcountry) = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT `country` FROM `".$titanium_prefix."_nsnst_countries` WHERE `c2c`='".$getIPs['c2c']."' LIMIT 0,1"));
$titanium_db->sql_query("DELETE FROM `".$titanium_prefix."_nsnst_ip2country` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi'");
$titanium_db->sql_query("OPTIMIZE TABLE `".$titanium_prefix."_nsnst_ip2country`");
$titanium_db->sql_query("UPDATE `".$titanium_prefix."_nsnst_tracked_ips` SET `c2c`='00' WHERE `ip_long` >= '$ip_lo' AND `ip_long` <= '$ip_hi'");
$titanium_db->sql_query("UPDATE `".$titanium_prefix."_nsnst_blocked_ips` SET `c2c`='00' WHERE `ip_long` >= '$ip_lo' AND `ip_long` <= '$ip_hi'");
$titanium_db->sql_query("UPDATE `".$titanium_prefix."_nsnst_blocked_ranges` SET `c2c`='00' WHERE `ip_lo` >= '$ip_lo' AND `ip_lo` <= '$ip_hi'");
header("Location: ".$admin_file.".php?op=$xop&min=$min&column=$column&direction=$direction&sip=$sip&showcountry=$showcountry");

?>