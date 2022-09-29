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
$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_TASKS.': '._NETWORK_CONFIG;
include_once(NUKE_BASE_DIR.'header.php');

pjadmin_menu(_NETWORK_TASKS.': '._NETWORK_CONFIG);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='TaskConfigUpdate'>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._NETWORK_NEWTASKSTATUS.":</strong></td>\n";
echo "<td><select name='new_task_status'>\n";
$status = $titanium_db2->sql_query("SELECT `status_id`, `status_name` FROM `".$network_prefix."_tasks_status` ORDER BY `status_weight`");
while(list($status_id, $status_name) = $titanium_db2->sql_fetchrow($status)) {
  if($pj_config['new_task_status'] == $status_id) { $sel = " selected"; } else { $sel = ""; }
  echo "<option value='$status_id' $sel>$status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._NETWORK_NEWTASKPRIORITY.":</strong></td>\n";
echo "<td><select name='new_task_priority'>\n";
$priority = $titanium_db2->sql_query("SELECT `priority_id`, `priority_name` FROM `".$network_prefix."_tasks_priorities` ORDER BY `priority_weight`");
while(list($priority_id, $priority_name) = $titanium_db2->sql_fetchrow($priority)) {
  if($pj_config['new_task_priority'] == $priority_id) { $sel = " selected"; } else { $sel = ""; }
  echo "<option value='$priority_id' $sel>$priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'><strong>"._NETWORK_DATEFORMAT.":</strong></td>\n";
echo "<td><input type='text' name='task_date_format' value=\"".$pj_config['task_date_format']."\" size='30'><br />("._NETWORK_DATENOTE.")</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._NETWORK_NEWTASKPOSITION.":</strong></td>\n";
echo "<td><select name='new_task_position'>\n";
$position = $titanium_db2->sql_query("SELECT `position_id`, `position_name` FROM `".$network_prefix."_members_positions` ORDER BY `position_weight`");
while(list($position_id, $position_name) = $titanium_db2->sql_fetchrow($position)) {
  if($pj_config['new_task_position'] == $position_id) { $sel = " selected"; } else { $sel = ""; }
  echo "<option value='$position_id' $sel>$position_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_CONFIGUPDATE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>