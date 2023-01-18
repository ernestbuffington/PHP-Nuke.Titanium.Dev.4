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

$referer = addslashes($referer); 
$testnum1 = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_referers` WHERE `referer`='".$referer."' AND `rid`!='".$rid."'"));
if($testnum1 > 0) {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_EDITREFERERERROR);
  mastermenu();
  CarryMenu();
  referermenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  echo '<center><strong>'._AB_REFEREREXISTS.'</strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} elseif($referer == "") {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_EDITREFERERERROR);
  mastermenu();
  CarryMenu();
  referermenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  echo '<center><strong>'._AB_REFEREREMPTY.'</strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  $getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_referers` WHERE `rid`='".$rid."' LIMIT 0,1"));
  $db->sql_query("UPDATE `".$prefix."_nsnst_referers` SET `referer`='".$referer."' WHERE `rid`='".$rid."'");
  $list_referer = explode("\r\n", $ab_config['list_referer']);
  $list_referer = str_replace($getIPs['referer'], $referer, $list_referer);
  rsort($list_referer);
  $endlist = count($list_referer)-1;
  if(empty($list_referer[$endlist])) { array_pop($list_referer); }
  sort($list_referer);
  $list_referer = implode("\r\n", $list_referer);
  absave_config("list_referer", $list_referer);
  header("Location: ".$admin_file.".php?op=$xop&min=$min&direction=$direction");
}

?>