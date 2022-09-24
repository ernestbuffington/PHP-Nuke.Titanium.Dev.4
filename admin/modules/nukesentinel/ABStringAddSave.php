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

if(!get_magic_quotes_runtime()) { $string = addslashes($string); }
$testnum1 = $titanium_db->sql_numrows($titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_strings` WHERE `string`='$string'"));
if($testnum1 > 0) {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_ADDSTRINGERROR);
  mastermenu();
  CarryMenu();
  stringmenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<center><strong>'._AB_STRINGEXISTS.'</strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} elseif($string == "") {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_EDITSTRINGERROR);
  mastermenu();
  CarryMenu();
  stringmenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<center><strong>'._AB_STRINGEMPTY.'</strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  $titanium_db->sql_query("INSERT INTO `".$titanium_prefix."_nsnst_strings` (`string`) VALUES ('$string')");
  $titanium_db->sql_query("ALTER TABLE `".$titanium_prefix."_nsnst_strings` ORDER BY `string`");
  $titanium_db->sql_query("OPTIMIZE TABLE `".$titanium_prefix."_nsnst_strings`");
  $list_string = $ab_config['list_string']."\r\n".$string;
  $list_string = explode("\r\n", $list_string);
  rsort($list_string);
  $phpbb2_endlist = count($list_string)-1;
  if(empty($list_string[$phpbb2_endlist])) { array_pop($list_string); }
  sort($list_string);
  $list_string = implode("\r\n", $list_string);
  absave_config("list_string", $list_string);
  if($another == 1) {
    header("Location: ".$admin_file.".php?op=ABStringAdd");
  }else {
    header("Location: ".$admin_file.".php?op=ABStringList");
  }
}

?>