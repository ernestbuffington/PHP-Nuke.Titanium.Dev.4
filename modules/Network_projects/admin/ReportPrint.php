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
include_once(NUKE_INCLUDE_DIR."counter.php");
$report = pjreport_info($report_id);
$Theme_Sel = get_theme();
echo "<html>\n";
echo "<head>\n";
echo "<title>"._NETWORK_REPORTVIEW.": ".$report['report_name']."</title>\n";
echo "</head>\n";
echo "<body>\n";
require_once("themes/$Theme_Sel/theme.php");
echo "<center><h3>"._NETWORK_REPORTVIEW.": ".$report['report_name']."</h3></center>\n";
echo "<br />\n";
$project = pjproject_info($report['project_id']);
$reportstatus = pjreportstatus_info($report['status_id']);
$reporttype = pjreporttype_info($report['type_id']);
if(empty($reportstatus['status_name'])){ $reportstatus['status_name'] = _NETWORK_NA; }
if(empty($reporttype['type_name'])){ $reporttype['type_name'] = _NETWORK_NA; }
echo "<center><table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td colspan='4' width='100%'><nobr><strong>"._NETWORK_PROJECTNAME."</strong></nobr></td></tr>\n";
$pjimage = pjimage("project.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td>\n";
echo "<td colspan='3' width='100%'><nobr>".$project['project_name']." (".$report['project_id'].")</nobr></td></tr>\n";
echo "<tr><td colspan='2' width='100%'><nobr><strong>"._NETWORK_REPORTINFO."</strong></nobr></td>\n";
echo "<td align='center'><strong>"._NETWORK_STATUS."</strong></td>\n";
echo "<td align='center'><strong>"._NETWORK_TYPE."</strong></td></tr>\n";
$pjimage = pjimage("report.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td><td width='100%'><nobr>".$report['report_name']."</nobr></td>\n";
echo "<td align='center'><nobr>".$reportstatus['status_name']."</nobr></td>\n";
echo "<td align='center'><nobr>".$reporttype['type_name']."</nobr></td></tr>\n";
if($report['report_description'] != ""){
    $pjimage = pjimage("description.png", $module_name);
    echo "<tr><td align='center' valign='top'><img src='$pjimage'></td>\n";
    echo "<td colspan='3' width='100%'>".nl2br($report['report_description'])."</td></tr>\n";
}
$pjimage = pjimage("reporter.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td>\n";
echo "<td colspan='3' width='100%'><nobr>"._NETWORK_REPORTEDBY.": <strong>".$report['submitter_email']."</strong></nobr></td></tr>\n";
if($report['date_submitted'] != '0'){
    $submit_date = date($pj_config['report_date_format'], $report['date_submitted']);
    $pjimage = pjimage("date.png", $module_name);
    echo "<tr><td align='center'><img src='$pjimage'></td>\n";
    echo "<td colspan='3' width='100%'><nobr>"._NETWORK_SUBMITTED.": <strong>$submit_date</strong></nobr></td></tr>\n";
}
if($report['date_modified'] != '0'){
    $modify_date = date($pj_config['report_date_format'], $report['date_modified']);
    $pjimage = pjimage("date.png", $module_name);
    echo "<tr><td align='center'><img src='$pjimage'></td>\n";
    echo "<td colspan='3' width='100%'><nobr>"._NETWORK_MODIFIED.": <strong>$modify_date</strong></nobr></td></tr>\n";
}
$memberresult = $db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_reports_members` WHERE `report_id`='$report_id' ORDER BY `member_id`");
$member_total = $db2->sql_numrows($memberresult);
echo "<tr><td colspan='4' width='100%'><nobr><strong>"._NETWORK_REPORTMEMBERS."</strong></nobr></td></tr>\n";
if($member_total != 0){
    while(list($member_id) = $db2->sql_fetchrow($memberresult)) {
        $pjimage = pjimage("member.png", $module_name);
        $member = pjmember_info($member_id);
        echo "<tr><td><img src='$pjimage'></td><td colspan='3' width='100%'>".$member['member_name']." (".$member['member_email'].")</td></tr>\n";
    }
} else {
    echo "<tr><td align='center' colspan='4' width='100%'><nobr>"._NETWORK_NOREPORTMEMBERS."</nobr></td></tr>\n";
}
echo "</table>\n";
echo "<br />\n";
$commentresult = $db2->sql_query("SELECT `comment_id` FROM `".$network_prefix."_reports_comments` WHERE `report_id`='$report_id' ORDER BY `date_commented` asc");
$comment_total = $db2->sql_numrows($commentresult);
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td width='100%'><nobr><strong>"._NETWORK_COMMENTS."</strong></nobr></td><tr>\n";
if($comment_total > 0){
    while(list($comment_id) = $db2->sql_fetchrow($commentresult)) {
        $comment = pjreportcomment_info($comment_id);
        $comment_date = date($pj_config['report_date_format'], $comment['date_commented']);
        echo "<tr><td><nobr><strong>".$comment['commenter_email']." @ $comment_date</strong>";
        echo "</nobr></td></tr>\n";
        echo "<tr><td>".nl2br($comment['comment_description'])."</td></tr>\n";
    }
} else {
    echo "<tr><td align='center'><nobr>"._NETWORK_NOREPORTCOMMENTS."</nobr></td></tr>\n";
}
echo "</table>\n";
    echo "</body>\n";
    echo "</html>\n";

?>