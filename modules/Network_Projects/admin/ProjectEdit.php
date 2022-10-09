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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_PROJECTS.": "._NETWORK_EDITPROJECT;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$project = pjproject_info($project_id);
pjadmin_menu(_NETWORK_PROJECTS.": "._NETWORK_EDITPROJECT);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ProjectUpdate'>\n";
echo "<input type='hidden' name='project_id' value='$project_id'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PROJECTNAME.":</td>\n";
echo "<td><input type='text' name='project_name' size='30' value=\"".$project['project_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PROJECTSITE.":</td>\n";
echo "<td><input type='text' name='project_site' size='30' value=\"".$project['project_site']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_PROJECTDESCRIPTION.":</td>\n";
echo "<td><textarea name='project_description' cols='60' rows='10' wrap='virtual'>".$project['project_description']."</textarea></td></tr>\n";
$sel1 = $sel2 = $sel3 = $sel4 = "";
if($project['featured'] == 0) { $sel1 = " selected"; } else { $sel2 = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_FEATUREDBLOCK.":</td>\n";
echo "<td><select name='featured'><option value='0'$sel1>"._NETWORK_NO."</option>\n";
echo "<option value='1'$sel2>"._NETWORK_YES."</option></select></td></tr>\n";
$repn = $repy = "";
if($project['allowreports'] == 0) { $repn = " selected"; } else { $repy = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_ACTIVATEREPORTS.":</td>\n";
echo "<td><select name='allowreports'><option value='0'$repn>"._NETWORK_NO."</option>\n";
echo "<option value='1'$repy>"._NETWORK_YES."</option></select></td></tr>\n";
$reqn = $reqy = "";
if($project['allowrequests'] == 0) { $reqn = " selected"; } else { $reqy = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_ACTIVATEREQUESTS.":</td>\n";
echo "<td><select name='allowrequests'><option value='0'$reqn>"._NETWORK_NO."</option>\n";
echo "<option value='1'$reqy>"._NETWORK_YES."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PRIORITY.":</td>\n";
echo "<td><select name='priority_id'>\n";
$prioritylist = $db2->sql_query("SELECT `priority_id`, `priority_name` FROM `".$network_prefix."_projects_priorities` ORDER BY `priority_weight`");
while(list($s_priority_id, $s_priority_name) = $db2->sql_fetchrow($prioritylist)){
  if($s_priority_id == $project['priority_id']){ $sel = "SELECTed"; } else { $sel = ""; }
  echo "<option value='$s_priority_id' $sel>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STATUSPERCENT.":</td>\n";
echo "<td><input type='text' name='project_percent' size='4' value='".$project['project_percent']."'>% "._NETWORK_STATUSPERCENT_CALCULATE."</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STATUS.":</td>\n";
echo "<td><select name='status_id'>\n";
$statuslist = $db2->sql_query("SELECT `status_id`, `status_name` FROM `".$network_prefix."_projects_status` ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $db2->sql_fetchrow($statuslist)){
  if($s_status_id == $project['status_id']){ $sel = "SELECTed"; } else { $sel = ""; }
  echo "<option value='$s_status_id' $sel>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
if($project['date_started'] > 0) {
  $sday = date("j",$project['date_started']);
  $smon = date("n",$project['date_started']);
  $syear = date("Y",$project['date_started']);
} else {
  $sday = "00";
  $smon = "00";
  $syear = "0000";
}
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STARTDATE.":</td>\n";
echo "<td><select name='project_start_month'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
  if($i == $smon){ $sel = "SELECTed"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='project_start_day'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
  if($i == $sday){ $sel = "SELECTed"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type=text name='project_start_year' value='".$syear."' size=4 maxlength=4></td></tr>\n";
if($project['date_finished'] > 0) {
  $fday = date("j",$project['date_finished']);
  $fmon = date("n",$project['date_finished']);
  $fyear = date("Y",$project['date_finished']);
} else {
  $fday = "00";
  $fmon = "00";
  $fyear = "0000";
}
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_FINISHDATE.":</td>\n";
echo "<td><select name='project_finish_month'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
  if($i == $fmon){ $sel = "SELECTed"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='project_finish_day'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
  if($i == $fday){ $sel = "SELECTed"; } else { $sel = ""; }
  echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type=text name='project_finish_year' value='".$fyear."' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple>\n";
$memberlistresult = $db2->sql_query("SELECT `member_id`, `member_name` FROM `".$network_prefix."_members` ORDER BY `member_name`");
while(list($member_id, $member_name) = $db2->sql_fetchrow($memberlistresult)) {
  $memberexresult = $db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_projects_members` WHERE `member_id`='$member_id' AND `project_id`='$project_id'");
  $numrows = $db2->sql_numrows($memberexresult);
  if($numrows < 1){
    echo "<option value='$member_id'>$member_name</option>\n";
  }
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_UPDATEPROJECT."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
//echo "<br />";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='ProjectMembers'>";
echo "<input type='hidden' name='project_id' VALUE='$project_id'>";
echo "<tr><td align='left' bgcolor='$bgcolor2' width='100%' colspan='2'><strong>"._NETWORK_PROJECTMEMBERS."</strong></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_POSITION."</strong></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_DELETE."</strong></td></tr>";
$membersresult = $db2->sql_query("SELECT `member_id`, `position_id` FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id'");
$numrows = $db2->sql_numrows($membersresult);
if($numrows > 0){
  while(list($member_id, $position_id) = $db2->sql_fetchrow($membersresult)){
    $member = pjmember_info($member_id);
    $position = pjmemberposition_info($position_id);
    echo "<tr>";
    $pjimage = pjimage("member.png", $module_name);
    echo "<td><img src='$pjimage'></td><td width='100%'>".$member['member_name']."</td>";
    echo "<td><input type='hidden' name='member_ids[]' VALUE='$member_id'><select name='position_ids[]'>";
    $positionlistresult = $db2->sql_query("SELECT `position_id`, `position_name` FROM `".$network_prefix."_members_positions` ORDER BY `position_weight`");
    while(list($l_position_id, $l_position_name) = $db2->sql_fetchrow($positionlistresult)) {
      if($l_position_id == $position_id){ $sel = "SELECTed"; } else { $sel = ""; }
      echo "<option value='$l_position_id' $sel>$l_position_name</option>";
    }
    echo "</select></td>";
    echo "<td align=center><nobr><input name='delete_member_ids[]' type='checkbox' value='$member_id'></td>";
    echo "</tr>";
  }
  echo "<tr><td colspan='4' width='100%' align=right bgcolor='$bgcolor2'><input type='submit' value='"._NETWORK_UPDATE."'>";
  echo "<input type='submit' value='"._NETWORK_DELETE."'></td></tr>";
} else {
  echo "<tr><td colspan='4' width='100%' align=center>"._NETWORK_NOPROJECTMEMBERS."</td></tr>";
}
echo "</form></table>";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>