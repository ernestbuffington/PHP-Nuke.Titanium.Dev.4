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

if(($xip[0] < 0 OR $xip[0] > 255 OR (!is_numeric($xip[0]) AND $xip[0] != "*")) OR ($xip[1] < 0 OR $xip[1] > 255 OR (!is_numeric($xip[1]) AND $xip[1] != "*")) OR ($xip[2] < 0 OR $xip[2] > 255 OR (!is_numeric($xip[2]) AND $xip[2] != "*")) OR ($xip[3] < 0 OR $xip[3] > 255 OR (!is_numeric($xip[3]) AND $xip[3] != "*"))) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDIPERROR;
  include_once(NUKE_BASE_DIR.'header.php');
  title($pagetitle);
  OpenTable();
  echo '<br />'."\n";
  echo '<center><strong>'._AB_IPERROR.'</strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
  die();
}
$xIPs = implode(".", $xip);
$bantemp = str_replace("*", "0", $xIPs);
$xIPl = sprintf("%u", ip2long($bantemp));
$ip = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$xIPs'"));
$bantime = time();
$xnotes = str_replace("<br>", "\r\n", $xnotes);
$xnotes = str_replace("<br />", "\r\n", $xnotes);
$xnotes = htmlentities($xnotes, ENT_QUOTES);
$xnotes = addslashes($xnotes);
$xusername = addslashes($xusername);
if($xexpires>0) { $xexpires = $bantime + ($xexpires * 86400); }
if($ip < 1) {
  $temp_qs = $xquery_string;
  $temp_qs = base64_encode($temp_qs);
  $db->sql_query("INSERT INTO `".$prefix."_nsnst_blocked_ips` VALUES ('$xIPs', '$xIPl', '$xuser_id', '$xusername', '$xuser_agent', '$bantime', '$xnotes', '$xreason', '$temp_qs', '$temp_qs', '$temp_qs', '$xx_forward_for', '$xclient_ip', '$xremote_addr', '$xremote_port', '$xrequest_method', '$xexpires', '$xc2c')");
  if($ab_config['htaccess_path'] != "") {
    $i = 1;
    while($i <= 3) {
      $tip = substr($xIPs, -2);
      if($tip == ".*") { $xIPs = substr($xIPs, 0, -2); }
      $i++;
    }
    $tempip = "";
    if($xIPs != "*") { $tempip = "deny from ".$xIPs."\n"; }
    $doit = fopen($ab_config['htaccess_path'], "a");
    fwrite($doit, $tempip);
    fclose($doit);
  }
}
if($another == 1) {
  header("Location: ".$admin_file.".php?op=ABBlockedIPAdd");
}else {
  header("Location: ".$admin_file.".php?op=ABBlockedIPList");
}

?>