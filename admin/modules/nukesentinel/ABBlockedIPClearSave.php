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

$clearresult = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_blocked_ips`");
while($clearblock = $titanium_db->sql_fetchrow($clearresult)) {
  $titanium_db->sql_query("DELETE FROM `".$titanium_prefix."_nsnst_blocked_ips` WHERE `ip_addr`='".$clearblock['ip_addr']."'");
  $titanium_db->sql_query("OPTIMIZE TABLE `".$titanium_prefix."_nsnst_blocked_ips`");
  if($ab_config['htaccess_path'] != "") {
    if($ab_config['htaccess_path'] != "") { $ipfile = file($ab_config['htaccess_path']); }
    $ipfile = implode("", $ipfile);
    $i = 1;
    while($i <= 3) {
      $tip = substr($clearblock['ip_addr'], -2);
      if($tip == ".*") { $clearblock['ip_addr'] = substr($clearblock['ip_addr'], 0, -2); }
      $i++;
    }
    $testip = "deny from ".$clearblock['ip_addr']."\n";
    $ipfile = str_replace($testip, "", $ipfile);
    $doit = fopen($ab_config['htaccess_path'], "w");
    fwrite($doit, $ipfile);
    fclose($doit);
  }
}
header("Location: ".$admin_file.".php?op=ABBlockedIPMenu");

?>