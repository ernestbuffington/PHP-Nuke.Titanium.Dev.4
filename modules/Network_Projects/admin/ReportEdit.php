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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_REPORTS.": "._NETWORK_REPORTEDIT;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$report = pjreport_info($report_id);
pjadmin_menu(_NETWORK_REPORTS.": "._NETWORK_REPORTEDIT);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ReportUpdate'>\n";
echo "<input type='hidden' name='report_id' value='$report_id'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_PROJECT.":</td>\n";
echo "<td><select name='project_id'>\n";
$projectlist = $db2->sql_query("SELECT `project_id`, `project_name` FROM `".$network_prefix."_projects` ORDER BY `project_name`");
while(list($p_project_id, $p_project_name) = $db2->sql_fetchrow($projectlist)){
    if($p_project_id == $report['project_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$p_project_id' $sel>$p_project_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_TYPE.":</td>\n";
echo "<td><select name='type_id'>\n";
$typelist = $db2->sql_query("SELECT `type_id`, `type_name` FROM `".$network_prefix."_reports_types` ORDER BY `type_weight`");
while(list($t_type_id, $t_type_name) = $db2->sql_fetchrow($typelist)){
    if($t_type_id == $report['type_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$t_type_id' $sel>$t_type_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_STATUS.":</td>\n";
echo "<td><select name='status_id'>\n";
$statuslist = $db2->sql_query("SELECT `status_id`, `status_name` FROM `".$network_prefix."_reports_status` ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $db2->sql_fetchrow($statuslist)){
    if($s_status_id == $report['status_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$s_status_id' $sel>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_USERNAME.":</td>\n";
echo "<td><input type='text' name='submitter_name' size='30' value=\"".$report['submitter_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_EMAILADDRESS.":</td>\n";
echo "<td><input type='text' name='submitter_email' size='30' value=\"".$report['submitter_email']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_SUMMARY.":</td>\n";
echo "<td><input type='text' name='report_name' size='30' value=\"".$report['report_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_DESCRIPTION.":</td>\n";
echo "<td><textarea name='report_description' cols='60' rows='10' wrap='virtual'>".$report['report_description']."</textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple>\n";
$memberlistresult = $db2->sql_query("SELECT `member_id`, `member_name` FROM `".$network_prefix."_members` ORDER BY `member_name`");
while(list($member_id, $member_name) = $db2->sql_fetchrow($memberlistresult)) {
    $memberexresult = $db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_reports_members` WHERE `member_id`='$member_id' AND `report_id`='$report_id'");
    $numrows = $db2->sql_numrows($memberexresult);
    if($numrows < 1){ echo "<option value='$member_id'>$member_name</option>\n"; }
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_REPORTUPDATE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
//echo "<br />\n";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ReportMembers'>\n";
echo "<input type='hidden' name='report_id' value='$report_id'>\n";

echo "<tr><td align='left' bgcolor='$bgcolor2' width='100%' colspan='2'><strong>"._NETWORK_REPORTMEMBERS."</strong></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_POSITION."</strong></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_DELETE."</strong></td></tr>";
$membersresult = $db2->sql_query("SELECT `member_id`, `position_id` FROM `".$network_prefix."_reports_members` WHERE `report_id`='$report_id'");
$memrows = $db2->sql_numrows($membersresult);
if($memrows > 0){
    while(list($member_id, $position_id) = $db2->sql_fetchrow($membersresult)){
        $member = pjmember_info($member_id);
        $position = pjmemberposition_info($position_id);
        echo "<tr>";
        $pjimage = pjimage("member.png", $module_name);
        echo "<td><img src='$pjimage'></td><td width='100%'>".$member['member_name']."</td>";
        echo "<td><input type='hidden' name='member_ids[]' VALUE='$member_id'><select name='position_ids[]'>";
        $positionlistresult = $db2->sql_query("SELECT `position_id`, `position_name` FROM `".$network_prefix."_members_positions` ORDER BY `position_weight`");
        while(list($l_position_id, $l_position_name) = $db2->sql_fetchrow($positionlistresult)) {
            if($l_position_id == $position_id){ $sel = "selected"; } else { $sel = ""; }
            echo "<option value='$l_position_id' $sel>$l_position_name</option>";
        }
        echo "</select></td>";
        echo "<td align=center><nobr><input name='delete_member_ids[]' type='checkbox' value='$member_id'></td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='4' width='100%' align=right bgcolor='$bgcolor2'><input type='submit' value='"._NETWORK_UPDATE."'>";
    echo "<input type='submit' value='"._NETWORK_DELETE."'></td></tr>";
} else {
    echo "<tr><td colspan='4' width='100%' align=center>"._NETWORK_NOREPORTMEMBERS."</td></tr>";
}

echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>