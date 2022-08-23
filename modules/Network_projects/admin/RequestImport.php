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
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_REQUESTS.": "._NETWORK_IMPORTASTASK;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$request = pjrequest_info($request_id);
$project = pjproject_info($request['project_id']);
pjadmin_menu(_NETWORK_REQUESTS.": "._NETWORK_IMPORTASTASK);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='RequestImportInsert'>\n";
echo "<input type='hidden' name='request_id' value='$request_id'>\n";
echo "<input type='hidden' name='project_id' value'".$request['project_id']."'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PROJECT.":</td>\n";
echo "<td><select name='project_id'>\n";
$projectlist = $db2->sql_query("SELECT `project_id`, `project_name` FROM `".$network_prefix."_projects` ORDER BY `project_name`");
while(list($s_project_id, $s_project_name) = $db2->sql_fetchrow($projectlist)){
    if($s_project_id == $request['project_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$s_project_id' $sel>$s_project_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_TASKNAME.":</td>\n";
echo "<td><input type='text' name='task_name' size='30' value=\"".$request['request_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_DESCRIPTION.":</td>\n";
echo "<td><textarea name='task_description' cols='60' rows='10' wrap='virtual'>".$request['request_description']."</textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PRIORITY.":</td>\n";
echo "<td><select name='priority_id'><option value='0'>---------</option>\n";
$prioritylist = $db2->sql_query("SELECT `priority_id`, `priority_name` FROM `".$network_prefix."_tasks_priorities` ORDER BY `priority_weight`");
while(list($s_priority_id, $s_priority_name) = $db2->sql_fetchrow($prioritylist)){
    echo "<option value='$s_priority_id'>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STATUSPERCENT.":</td>\n";
echo "<td><input type='text' name='task_percent' size='4' value='0'>%</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STATUS.":</td>\n";
echo "<td><select name='status_id'><option value='0'>---------</option>\n";
$statuslist = $db2->sql_query("SELECT `status_id`, `status_name` FROM `".$network_prefix."_tasks_status` ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $db2->sql_fetchrow($statuslist)){
    echo "<option value='$s_status_id'>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STARTDATE.":</td>\n";
echo "<td><select name='task_start_month'><option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
    if($i == date("m")){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='task_start_day'><option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
    if($i == date("d")){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type=text name='task_start_year' value='".date("Y")."' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_FINISHDATE.":</td>\n";
echo "<td><select name='task_finish_month'><option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
    echo "<option value='$i'>$i</option>\n";
}
echo "</select><select name='task_finish_day'><option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
    echo "<option value='$i'>$i</option>\n";
}
echo "</select><input type=text name='task_finish_year' value='0000' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple>\n";
$memberlistresult = $db2->sql_query("SELECT `member_id`, `member_name` FROM `".$network_prefix."_members` ORDER BY `member_name`");
while(list($member_id, $member_name) = $db2->sql_fetchrow($memberlistresult)) {
    echo "<option value='$member_id'>$member_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_TASKADD."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>