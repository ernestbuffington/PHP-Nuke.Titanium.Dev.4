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

if(!get_magic_quotes_runtime()) { $referer = addslashes($referer); }
$testnum1 = $pnt_db->sql_numrows($pnt_db->sql_query("SELECT * FROM `".$pnt_prefix."_nsnst_referers` WHERE `referer`='$referer'"));
if($testnum1 > 0) {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_ADDREFERERERROR);
  mastermenu();
  CarryMenu();
  trackedmenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
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
  trackedmenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<center><strong>'._AB_REFEREREMPTY.'</strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  $pnt_db->sql_query("INSERT INTO `".$pnt_prefix."_nsnst_referers` (`referer`) VALUES ('$referer')");
  $pnt_db->sql_query("ALTER TABLE `".$pnt_prefix."_nsnst_referers` ORDER BY `referer`");
  $pnt_db->sql_query("OPTIMIZE TABLE `".$pnt_prefix."_nsnst_referers`");
  $list_referer = $ab_config['list_referer']."\r\n".$referer;
  $list_referer = explode("\r\n", $list_referer);
  rsort($list_referer);
  $phpbb2_endlist = count($list_referer)-1;
  if(empty($list_referer[$phpbb2_endlist])) { array_pop($list_referer); }
  sort($list_referer);
  $list_referer = implode("\r\n", $list_referer);
  absave_config("list_referer", $list_referer);
}
header("Location: ".$admin_file.".php?op=ABTrackedRefersList&min=$min&column=$column&direction=$direction");

?>