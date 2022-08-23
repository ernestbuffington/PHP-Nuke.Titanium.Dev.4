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

$db->sql_query("DELETE FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$xIPs'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_blocked_ips`");
if($ab_config['htaccess_path'] != "") {
  $i = 1;
  while($i <= 3) {
    $tip = substr($xIPs, -2);
    if($tip == ".*") { $xIPs = substr($xIPs, 0, -2); }
    $i++;
  }
  $testip = "deny from $xIPs\n";
  $ipfile = file($ab_config['htaccess_path']);
  $ipfile = implode("", $ipfile);
  $ipfile = str_replace($testip, "", $ipfile);
  $doit = fopen($ab_config['htaccess_path'], "w");
  fwrite($doit, $ipfile);
  fclose($doit);
}
header("Location: ".$admin_file.".php?op=$xop&min=$min&column=$column&direction=$direction&sip=$sip");

?>