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
global $db2;
get_lang('Network_Projects');
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_PROJECTS.": "._NETWORK_PROJECTADD;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
pjadmin_menu(_NETWORK_PROJECTS.": "._NETWORK_PROJECTADD);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ProjectInsert'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PROJECTNAME.":</td>\n";
echo "<td><input type='text' name='project_name' size='30'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PROJECTSITE.":</td>\n";
echo "<td><input type='text' name='project_site' size='30'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_PROJECTDESCRIPTION.":</td>\n";
echo "<td><textarea name='project_description' cols='60' rows='10' wrap='virtual'></textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_FEATUREDBLOCK.":</td>\n";
echo "<td><select name='featured'><option value='0' selected>"._NETWORK_NO."</option>\n";
echo "<option value='1'>"._NETWORK_YES."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_ACTIVATEREPORTS.":</td>\n";
echo "<td><select name='allowreports'><option value='0' selected>"._NETWORK_NO."</option>\n";
echo "<option value='1'>"._NETWORK_YES."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_ACTIVATEREQUESTS.":</td>\n";
echo "<td><select name='allowrequests'><option value='0'$reqn>"._NETWORK_NO."</option>\n";
echo "<option value='1'$reqy>"._NETWORK_YES."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PRIORITY.":</td>\n";
echo "<td><select name='priority_id'>\n";
$prioritylist = $db2->sql_query("SELECT `priority_id`, `priority_name` FROM `".$network_prefix."_projects_priorities` ORDER BY `priority_weight`");
while(list($s_priority_id, $s_priority_name) = $db2->sql_fetchrow($prioritylist)){
  echo "<option value='$s_priority_id'>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STATUSPERCENT.":</td>\n";
echo "<td><input type='text' name='project_percent' size='4'>% "._NETWORK_STATUSPERCENT_CALCULATE."</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STATUS.":</td>\n";
echo "<td><select name='status_id'>\n";
$statuslist = $db2->sql_query("SELECT `status_id`, `status_name` FROM `".$network_prefix."_projects_status` ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $db2->sql_fetchrow($statuslist)){
  echo "<option value='$s_status_id'>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STARTDATE.":</td>\n";
echo "<td><select name='project_start_month'>\n";
echo "<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
  if($i == date("m")){ $sel = "SELECTed"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='project_start_day'>\n";
echo "<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
  if($i == date("d")){ $sel = "SELECTed"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type=text name='project_start_year' value='".date("Y")."' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_FINISHDATE.":</td>\n";
echo "<td><select name='project_finish_month'>\n";
echo "<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
  echo "<option value='$i'>$i</option>\n";
}
echo "</select><select name='project_finish_day'>\n";
echo "<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
  echo "<option value='$i'>$i</option>\n";
}
echo "</select><input type=text name='project_finish_year' value='0000' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple>\n";
$memberlistresult = $db2->sql_query("SELECT `member_id`, `member_name` FROM `".$network_prefix."_members` ORDER BY `member_name`");
while(list($member_id, $member_name) = $db2->sql_fetchrow($memberlistresult)) {
  echo "<option value='$member_id'>$member_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_PROJECTADD."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>