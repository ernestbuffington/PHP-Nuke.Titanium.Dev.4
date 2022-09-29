<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
global $titanium_db2;
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_REQUESTS.': '._NETWORK_DELETESTATUS;
$status_id = intval($status_id);
if($status_id < 1) { header("Location: ".$admin_file.".php?op=RequestStatusList"); }
include_once(NUKE_BASE_DIR.'header.php');

$statusresult = $titanium_db2->sql_query("SELECT `status_name` FROM `".$network_prefix."_requests_status` WHERE `status_id`='$status_id'");
list($status_name) = $titanium_db2->sql_fetchrow($statusresult);
pjadmin_menu(_NETWORK_REQUESTS.': '._NETWORK_DELETESTATUS);
//echo "<br />";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='RequestStatusDelete'>";
echo "<input type='hidden' name='status_id' value='$status_id'>";
echo "<tr><td align='center'><strong>"._NETWORK_SWAPREQUESTSTATUS."</strong></td></tr>";
echo "<tr><td align='center'>$status_name -> <select name='swap_status_id'>";
echo "<option value='-1'>"._NETWORK_NA."</option>\n";
$statuslist = $titanium_db2->sql_query("SELECT `status_id`, `status_name` FROM `".$network_prefix."_requests_status` WHERE `status_id` != '$status_id' AND `status_id` > 0 ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $titanium_db2->sql_fetchrow($statuslist)){
  echo "<option value='$s_status_id'>$s_status_name</option>";
}
echo "</select></td></tr>";
echo "<tr><td align='center'><input type='submit' value='"._NETWORK_DELETESTATUS."'></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>