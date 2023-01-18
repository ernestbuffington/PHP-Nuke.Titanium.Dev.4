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

@set_time_limit(600);
$perpage = 200;
if(!$ab_config['page_delay'] OR $ab_config['page_delay'] < 1) { $pagedelay = 5; } else { $pagedelay = $ab_config['page_delay']; }
$totalselected = $db->sql_numrows($db->sql_query("SELECT `ip_addr` FROM `".$prefix."_nsnst_blocked_ips`"));
if(!isset($min)) {
  $min=0;
  $pagesint = ($totalselected / $perpage);
  $pages = ceil($pagesint);
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_IP2CUPDATEBLOCKED);
  mastermenu();
  CarryMenu();
  ip2cmenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  echo _AB_IP2CUPDATEBLOCKED01.'<br />'."\n";
  echo _AB_IP2CUPDATEBLOCKED02.'<br />'."\n";
  echo _AB_IP2CINSECTIONS.'<br />'."\n";
  echo _AB_YOUHAVE.$pages._AB_SECTIONSTOGO.'<br />'."\n";
  echo _AB_IP2CUPDATE04C.'<br />'."\n";
  echo '<br />'."\n";
  echo '<form action="'.$admin_file.'.php" method="post">'."\n";
  echo '<input type="hidden" name="op" value="ABIP2CountryUpdateBlocked" />'."\n";
  echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
  echo '<input type="submit" value="'._AB_LETSGETSTART.'" />'."\n";
  echo '</form>'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else if($min < $totalselected) {
  $db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='1' WHERE `config_name`='site_switch'");
  $ab_config['site_switch'] = 1;
  $result = $db->sql_query("SELECT `ip_addr` FROM `".$prefix."_nsnst_blocked_ips` LIMIT $min, $perpage");
  while(list($xip_addr) = $db->sql_fetchrow($result)) {
    $ip_addr = str_replace("*", "0", $xip_addr);
    $xip_long = sprintf("%u", ip2long($ip_addr));
    list($xc2c) = $db->sql_fetchrow($db->sql_query("SELECT `c2c` FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`<='$xip_long' AND `ip_hi`>='$xip_long' LIMIT 0,1"));
    if(!$xc2c) { $xc2c = "00"; }
    $db->sql_query("UPDATE `".$prefix."_nsnst_blocked_ips` SET `c2c`='$xc2c' WHERE `ip_addr`='$xip_addr'");
  }
  $max=$min+$perpage;
  $pagesint = ($totalselected / $perpage);
  $pages = ceil($pagesint);
  $currentpage = ($max / $perpage);
  $pagetitle = _AB_NUKESENTINEL.": "._AB_IP2CUPDATEBLOCKED;
  include_once(NUKE_BASE_DIR.'header.php');
  title($pagetitle);
  OpenTable();
  echo '<script><!--'."\n";
  echo 'setTimeout(\'Redirect()\','.($pagedelay*1000).');'."\n";
  echo 'function Redirect()'."\n";
  echo '{'."\n";
  echo ' location.href = \''.$admin_file.'.php?op=ABIP2CountryUpdateBlocked&min='.$max.'\';'."\n";
  echo '}'."\n";
  echo '// --></script>'."\n";
  echo '<strong>'._AB_SECTION.' '.$currentpage.' '._AB_OF.' '.$pages.' '._AB_COMPLETED.'</strong><br />'."\n";
  if($currentpage < $pages) {
    echo '<strong>'._AB_SECTION.' '.($currentpage+1).' '._AB_WILLSTART.'</strong><br />'."\n";
  }
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  $db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='0' WHERE `config_name`='site_switch'");
  $ab_config['site_switch'] = 0;
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_IP2CUPDATEBLOCKED);
  mastermenu();
  CarryMenu();
  ip2cmenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  echo '<center><strong>'._AB_IP2CUPDATEBLOCKED.' '._AB_COMPLETED.'</strong></center>'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
}

?>