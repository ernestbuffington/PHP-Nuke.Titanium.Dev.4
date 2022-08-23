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
if(!defined('SUPPORT_NETWORK')) { die("Illegal Access Detected!!!"); }
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']." ::: "._NETWORK_VIEWPROJECT." ::: ";
include_once(NUKE_BASE_DIR.'header.php');
$project_id = intval($project_id);
$project = pjprojectpercent_info($project_id);
$projectstatus = pjprojectstatus_info($project['status_id']);
$memberresult = $db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id' ORDER BY `member_id`");
$member_total = $db2->sql_numrows($memberresult);
$project_reports = $db2->sql_numrows($db2->sql_query("SELECT `report_id` FROM `".$network_prefix."_reports` WHERE `project_id`='$project_id'"));
$project_requests = $db2->sql_numrows($db2->sql_query("SELECT `request_id` FROM `".$network_prefix."_requests` WHERE `project_id`='$project_id'"));
$project_tasks = $db2->sql_numrows($db2->sql_query("SELECT `task_id` FROM `".$network_prefix."_tasks` WHERE `project_id`='$project_id'"));
$projectpriority = pjprojectpriority_info($project['priority_id']);
OpenTable();
echo '<div align="center"><strong>'._NETWORK_TITLE." v".$pj_config['version_number']." ::: "._NETWORK_VIEWPROJECT." ::: ".'</strong></div>';
echo '<div align="center">';
echo '[ <a href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a> ]';
echo '</div><br/>';

echo "<table align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='2'><nobr><strong>"._NETWORK_PROJECTNAME."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_STATUS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_PRIORITY."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_PROGRESSBAR."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_MEMBERS."</strong></nobr></td></tr>\n";
if($project['featured'] > 0) { $project['project_name'] = "<strong>".$project['project_name']."</strong>"; }
$pjimage = pjimage("project.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td>\n";
echo "<td width='100%'><nobr>".$project['project_name']."</nobr></td>\n";
if(empty($projectstatus['status_name'])){ $projectstatus['status_name'] = _NETWORK_NA; }
echo "<td align='center'><nobr>".$projectstatus['status_name']."</nobr></td>\n";
if(empty($projectpriority['priority_name'])){ $projectpriority['priority_name'] = _NETWORK_NA; }
echo "<td align='center'><nobr>".$projectpriority['priority_name']."</nobr></td>\n";
$wbprogress = pjprogress($project['project_percent']);
echo "<td align='center'><nobr>$wbprogress</nobr></td>\n";
echo "<td align='center'><nobr>$member_total</nobr></td></tr>\n";
if($project['project_site'] != ""){
  $pjimage = pjimage("demo.png", $module_name);
  echo "<tr><td align='center' valign='top'><img src='$pjimage'></td>";
  echo "<td width='100%' colspan='5'><a href='".$project['project_site']."' target='_blank'>".$project['project_site']."</a></td></tr>";
}
if($project['project_description'] != ""){
  $pjimage = pjimage("description.png", $module_name);
  echo "<tr><td align='center' valign='top'><img src='$pjimage'></td>";
  echo "<td width='100%' colspan='5'>".nl2br($project['project_description'])."</td></tr>";
}
$pjimage = pjimage("stats.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td><td width='100%' colspan='5'><nobr>"._NETWORK_TASKS.": <strong>$project_tasks</strong>&nbsp;&nbsp;/&nbsp;&nbsp;"._NETWORK_REPORTS.": <strong>$project_reports</strong>&nbsp;&nbsp;/&nbsp;&nbsp;"._NETWORK_REQUESTS.": <strong>$project_requests</strong></nobr></td></tr>";
if($project['date_started'] > 0){
  $start_date = date($pj_config['project_date_format'], $project['date_started']);
} else {
  $start_date = _NETWORK_NA;
}
$pjimage = pjimage("date.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td>\n";
echo "<td width='100%' colspan='5'><nobr>"._NETWORK_STARTDATE.": <strong>$start_date</strong></nobr></td></tr>\n";
if($project['date_finished'] > 0){
  $finish_date = date($pj_config['project_date_format'], $project['date_finished']);
} else {
  $finish_date = _NETWORK_NA;
}
$pjimage = pjimage("date.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td>\n";
echo "<td width='100%' colspan='5'><nobr>"._NETWORK_FINISHDATE.": <strong>$finish_date</strong></nobr></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' colspan='4'><nobr><strong>"._NETWORK_PROJECTMEMBERS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2' colspan='2'><nobr><strong>"._NETWORK_POSITION."</strong></nobr></td></tr>\n";
$memberresult = $db2->sql_query("SELECT `member_id`, `position_id` FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id' ORDER BY `member_id`");
$member_total = $db2->sql_numrows($memberresult);
if($member_total != 0){
  while(list($member_id, $position_id) = $db2->sql_fetchrow($memberresult)) {
    $member = pjmember_info($member_id);
    $position = pjmemberposition_info($position_id);
    $pjimage = pjimage("member.png", $module_name);
    echo "<tr><td><img src='$pjimage'></td><td width='100%' colspan='3'><a href='mailto:".pjencode_email($member['member_email'])."'>".$member['member_name']."</a></td>\n";
    if(empty($position['position_name'])){ $position['position_name'] = "----------"; }
    echo "<td align='center' colspan='2'><nobr>".$position['position_name']."</nobr></td></tr>\n";
  }
} else {
  echo "<tr><td colspan='3'><center><nobr>"._NETWORK_NOPROJECTMEMBERS."</nobr></center></td></tr>\n";
}
if(is_admin()) {
  echo "<tr><td bgcolor='$bgcolor2' colspan='6' width='100%'><nobr><strong>"._NETWORK_ADMINFUNCTIONS."</strong></nobr></td></tr>\n";
  $pjimage = pjimage("options.png", $module_name);
  echo "<tr><td align='center'><img src='$pjimage'></td>\n";
  echo "<td colspan='5' width='100%'><nobr><a href='".$admin_file.".php?op=ProjectEdit&amp;project_id=$project_id'>"._NETWORK_EDITPROJECT."</a>";
  echo ", <a href='".$admin_file.".php?op=ProjectRemove&amp;project_id=$project_id'>"._NETWORK_DELETEPROJECT."</a></nobr></td></tr>\n";
}
echo "</table>\n";
echo "<br />\n";
if(!$column1) $column1 = "task_name";
if(!$direction1) $direction1 = "asc";
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr>\n";
echo "<td colspan='2' bgcolor='$bgcolor2' width='100%'><nobr><strong>"._NETWORK_TASKS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_STATUS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_PRIORITY."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_PROGRESSBAR."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_MEMBERS."</strong></nobr></td>\n";
echo "</tr>\n";
$taskresult = $db2->sql_query("SELECT `task_id`, `task_name`, `task_percent`, `priority_id`, `status_id` FROM `".$network_prefix."_tasks` WHERE `project_id`='$project_id' ORDER BY `$column1` $direction1");
$task_total = $db2->sql_numrows($taskresult);
if($task_total != 0){
  while(list($task_id, $task_name, $task_percent, $priority_id, $status_id) = $db2->sql_fetchrow($taskresult)) {
    $taskstatus = pjtaskstatus_info($status_id);
    $memberresult = $db2->sql_query("SELECT member_id FROM ".$network_prefix."_tasks_members WHERE task_id='$task_id' ORDER BY member_id");
    $member_total = $db2->sql_numrows($memberresult);
    $taskpriority = pjtaskpriority_info($priority_id);
    echo "<tr>\n";
    $pjimage = pjimage("task.png", $module_name);
    echo "<td><img src='$pjimage'></td>\n";
    echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=Task&amp;task_id=$task_id'>$task_name</a></td>\n";
    if(empty($taskstatus['status_name'])){ $taskstatus['status_name'] = _NETWORK_NA; }
    echo "<td align='center'><nobr>".$taskstatus['status_name']."</nobr></td>\n";
    if(empty($taskpriority['priority_name'])){ $taskpriority['priority_name'] = _NETWORK_NA; }
    echo "<td align='center'><nobr>".$taskpriority['priority_name']."</nobr></td>\n";
    $wbprogress = pjprogress($task_percent);
    echo "<td align='center'><nobr>$wbprogress</nobr></td>\n";
    echo "<td align='center'><nobr>$member_total</nobr></td>\n";
    echo "</tr>\n";
  }
  echo "<tr>\n";
  echo "<form method='post' action='modules.php'>\n";
  echo "<input type='hidden' name='name' value='$module_name'>\n";
  echo "<input type='hidden' name='op' value='Project'>\n";
  echo "<input type='hidden' name='project_id' value='$project_id'>\n";
  echo "<td align='right' bgcolor='$bgcolor2' width='100%' colspan='6'><strong>"._NETWORK_SORT.":</strong> ";
  echo "<select name='column1'>\n";
  if($column1 == "task_name") $selcolumn11 = "selected";
  echo "<option value='task_name' $selcolumn11>"._NETWORK_TASKNAME."</option>\n";
  if($column1 == "status_id") $selcolumn12 = "selected";
  echo "<option value='status_id' $selcolumn12>"._NETWORK_STATUS."</option>\n";
  if($column1 == "priority_id") $selcolumn13 = "selected";
  echo "<option value='priority_id' $selcolumn13>"._NETWORK_PRIORITY."</option>\n";
  echo "</select> ";
  echo "<select name='direction1'>\n";
  if($direction1 == "asc") $seldirection11 = "selected";
  echo "<option value='asc' $seldirection11>"._NETWORK_ASC."</option>\n";
  if($direction1 == "desc") $seldirection12 = "selected";
  echo "<option value='desc' $seldirection12>"._NETWORK_DESC."</option>\n";
  echo "</select> ";
  echo "<input type='submit' value='"._NETWORK_SORT."'>\n";
  echo "</td></form></tr>\n";
  echo "<tr>\n";
} else {
  echo "<tr><td width='100%' colspan='6' align='center'><nobr>"._NETWORK_NOPROJECTTASKS."</nobr></td></tr>\n";
}
echo "</table>\n";
if($project['allowreports'] > 0) {
  echo "<br />\n";
  if(!$column2) $column2 = "report_name";
  if(!$direction2) $direction2 = "asc";
  echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
  echo "<tr><td colspan='6'><nobr><a href='modules.php?name=$module_name&amp;op=ReportSubmit&amp;project_id=$project_id'>"._NETWORK_SUBMITAREPORT."</a></nobr></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._NETWORK_REPORTS."</strong></nobr></td>\n";
  echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_TYPE."</strong></nobr></td>\n";
  echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_STATUS."</strong></nobr></td>\n";
  echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_SUBMITTED."</strong></nobr></td>\n";
  echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_COMMENTS."</strong></nobr></td></tr>\n";
  $reportresult = $db2->sql_query("SELECT `report_id` FROM `".$network_prefix."_reports` WHERE `project_id`='$project_id' ORDER BY `$column2` $direction2");
  $report_total = $db2->sql_numrows($reportresult);
  if($report_total != 0){
    while(list($report_id) = $db2->sql_fetchrow($reportresult)) {
      $report = pjreport_info($report_id);
      $reporttype = pjreporttype_info($report['type_id']);
      $reportstatus = pjreportstatus_info($report['status_id']);
      if(empty($report['report_name'])) { $report['report_name'] = "----------"; }
      if(empty($reporttype['type_name'])) { $reporttype['type_name'] = _NETWORK_NA; }
      if(empty($reportstatus['status_name'])) { $reportstatus['status_name'] = _NETWORK_NA; }
      $last_date = date($pj_config['report_date_format'], $report['date_submitted']);    
      $comments = $db2->sql_numrows($db2->sql_query("SELECT * FROM `".$network_prefix."_reports_comments` WHERE `report_id`='$report_id'"));
      $pjimage = pjimage("report.png", $module_name);
      echo "<tr><td><img src='$pjimage'></td>\n";
      echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=Report&amp;report_id=$report_id'>".$report['report_name']."</a></td>\n";
      echo "<td align='center'><nobr>".$reporttype['type_name']."</nobr></td>\n";
      echo "<td align='center'><nobr>".$reportstatus['status_name']."</nobr></td>\n";
      echo "<td align='center'><nobr>$last_date</nobr></td>\n";
      echo "<td align='center'><nobr>$comments</nobr></td></tr>\n";
    }
    echo "<form method='post' action='modules.php'>\n";
    echo "<input type='hidden' name='name' value='$module_name'>\n";
    echo "<input type='hidden' name='op' value='Project'>\n";
    echo "<input type='hidden' name='project_id' value='$project_id'>\n";
    echo "<td align='right' bgcolor='$bgcolor2' width='100%' colspan='6'><strong>"._NETWORK_SORT.":</strong> ";
    echo "<select name='column2'>\n";
    if($column2 == "report_name") $selcolumn21 = "selected";
    echo "<option value='report_name' $selcolumn21>"._NETWORK_REPORTNAME."</option>\n";
    if($column2 == "status_id") $selcolumn22 = "selected";
    echo "<option value='status_id' $selcolumn22>"._NETWORK_STATUS."</option>\n";
    if($column2 == "type_id") $selcolumn23 = "selected";
    echo "<option value='type_id' $selcolumn23>"._NETWORK_TYPE."</option>\n";
    if($column2 == "date_submitted") $selcolumn24 = "selected";
    echo "<option value='date_submitted' $selcolumn24>"._NETWORK_SUBMITTED."</option>\n";
    echo "</select> ";
    echo "<select name='direction2'>\n";
    if($direction2 == "asc") $seldirection21 = "selected";
    echo "<option value='asc' $seldirection21>"._NETWORK_ASC."</option>\n";
    if($direction2 == "desc") $seldirection22 = "selected";
    echo "<option value='desc' $seldirection22>"._NETWORK_DESC."</option>\n";
    echo "</select> ";
    echo "<input type='submit' value='"._NETWORK_SORT."'>\n";
    echo "</td></form></tr>\n";
    echo "<tr>\n";
  } else {
    echo "<tr><td align='center' colspan='6' width='100%'><nobr>"._NETWORK_NOPROJECTREPORTS."</nobr></td></tr>\n";
  }
  echo "</table>\n";
}
if($project['allowrequests'] > 0) {
  echo "<br />\n";
  if(!$column3) $column3 = "request_name";
  if(!$direction3) $direction3 = "asc";
  echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
  echo "<tr><td colspan='6'><nobr><a href='modules.php?name=$module_name&amp;op=RequestSubmit&amp;project_id=$project_id'>"._NETWORK_SUBMITAREQUEST."</a></nobr></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._NETWORK_REQUESTS."</strong></nobr></td>\n";
  echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_TYPE."</strong></nobr></td>\n";
  echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_STATUS."</strong></nobr></td>\n";
  echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_SUBMITTED."</strong></nobr></td>\n";
  echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_COMMENTS."</strong></nobr></td></tr>\n";
  $requestresult = $db2->sql_query("SELECT `request_id` FROM `".$network_prefix."_requests` WHERE `project_id`='$project_id' ORDER BY `$column3` $direction3");
  $request_total = $db2->sql_numrows($requestresult);
  if($request_total != 0){
    while(list($request_id) = $db2->sql_fetchrow($requestresult)) {
      $request = pjrequest_info($request_id);
      $requesttype = pjrequesttype_info($request['type_id']);
      $requeststatus = pjrequeststatus_info($request['status_id']);
      if(empty($request['request_name'])) { $request['request_name'] = "----------"; }
      if(empty($requesttype['type_name'])) { $requesttype['type_name'] = _NETWORK_NA; }
      if(empty($requeststatus['status_name'])) { $requeststatus['status_name'] = _NETWORK_NA; }
      $last_date = date($pj_config['request_date_format'], $request['date_submitted']);
      $comments = $db2->sql_numrows($db2->sql_query("SELECT * FROM `".$network_prefix."_requests_comments` WHERE `request_id`='$request_id'"));
      $pjimage = pjimage("request.png", $module_name);
      echo "<tr><td><img src='$pjimage'></td>\n";
      echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=Request&amp;request_id=$request_id'>".$request['request_name']."</a></td>\n";
      echo "<td align='center'><nobr>".$requesttype['type_name']."</nobr></td>\n";
      echo "<td align='center'><nobr>".$requeststatus['status_name']."</nobr></td>\n";
      echo "<td align='center'><nobr>$last_date</nobr></td>\n";
      echo "<td align='center'><nobr>$comments</nobr></td></tr>\n";
    }
    echo "<form method='post' action='modules.php'>\n";
    echo "<input type='hidden' name='name' value='$module_name'>\n";
    echo "<input type='hidden' name='op' value='Project'>\n";
    echo "<input type='hidden' name='project_id' value='$project_id'>\n";
    echo "<td align='right' bgcolor='$bgcolor2' width='100%' colspan='6'><strong>"._NETWORK_SORT.":</strong> ";
    echo "<select name='column3'>\n";
    if($column3 == "request_name") $selcolumn31 = "selected";
    echo "<option value='request_name' $selcolumn31>"._NETWORK_REQUESTNAME."</option>\n";
    if($column3 == "status_id") $selcolumn32 = "selected";
    echo "<option value='status_id' $selcolumn32>"._NETWORK_STATUS."</option>\n";
    if($column3 == "type_id") $selcolumn33 = "selected";
    echo "<option value='type_id' $selcolumn33>"._NETWORK_TYPE."</option>\n";
    if($column3 == "date_submitted") $selcolumn34 = "selected";
    echo "<option value='date_submitted' $selcolumn34>"._NETWORK_SUBMITTED."</option>\n";
    echo "</select> ";
    echo "<select name='direction3'>\n";
    if($direction3 == "asc") $seldirection31 = "selected";
    echo "<option value='asc' $seldirection31>"._NETWORK_ASC."</option>\n";
    if($direction3 == "desc") $seldirection32 = "selected";
    echo "<option value='desc' $seldirection32>"._NETWORK_DESC."</option>\n";
    echo "</select> ";
    echo "<input type='submit' value='"._NETWORK_SORT."'>\n";
    echo "</td></form></tr>\n";
    echo "<tr>\n";
  } else {
    echo "<tr><td align='center' colspan='6' width='100%'><nobr>"._NETWORK_NOPROJECTREQUESTS."</nobr></td></tr>\n";
  }
  echo "</table>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>