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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']." ::: "._NETWORK_VIEWTASK." ::: ";
include_once(NUKE_BASE_DIR.'header.php');
$task_id = intval($task_id);
$task = pjtask_info($task_id);
$project = pjproject_info($task['project_id']);
$taskstatus = pjtaskstatus_info($task['status_id']);
$taskpriority = pjtaskpriority_info($task['priority_id']);
OpenTable();
echo '<div align="center"><strong>'._NETWORK_TITLE." v".$pj_config['version_number']." ::: "._NETWORK_VIEWTASK." ::: ".'</strong></div>';
echo '<div align="center">';
echo '[ <a href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a> ]';
echo '</div><br/>';

echo "<table align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='5'><nobr><strong>"._NETWORK_PROJECTNAME."</strong></nobr></td></tr>\n";
$pjimage = pjimage("project.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td>\n";
echo "<td width='100%' colspan='4'><nobr><a href='modules.php?name=$module_name&amp;op=Project&amp;project_id=".$task['project_id']."'>".$project['project_name']."</a></nobr></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='2'><nobr><strong>"._NETWORK_TASKNAME." / "._NETWORK_TASKDETAILS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._NETWORK_STATUS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._NETWORK_PRIORITY."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._NETWORK_PROGRESSBAR."</strong></nobr></td></tr>\n";
$pjimage = pjimage("task.png", $module_name);
echo "<tr><td align='center'><img src='$pjimage'></td><td width='100%'><nobr>".$task['task_name']."</nobr></td>\n";
if(empty($taskstatus['status_name'])){ $taskstatus['status_name'] = _NETWORK_NA; }
echo "<td align='center'><nobr>".$taskstatus['status_name']."</nobr></td>\n";
if(empty($taskpriority['priority_name'])){ $taskpriority['priority_name'] = _NETWORK_NA; }
echo "<td align='center'><nobr>".$taskpriority['priority_name']."</nobr></td>\n";
$wbprogress = pjprogress($task['task_percent']);
echo "<td align='center'><nobr>$wbprogress</nobr></td></tr>\n";
if(!empty($task['task_description'])){
  $pjimage = pjimage("description.png", $module_name);
  echo "<tr><td align='center' valign='top'><img src='$pjimage'></td>";
  echo "<td width='100%' colspan='4'>".nl2br($task['task_description'])."</td></tr>";
}
if($task['date_started'] > 0){
  $start_date = date($pj_config['task_date_format'], $task['date_started']);
  $pjimage = pjimage("date.png", $module_name);
  echo "<tr><td align='center'><img src='$pjimage'></td>\n";
  echo "<td width='100%' colspan='4'><nobr>"._NETWORK_STARTDATE.": <strong>$start_date</strong></nobr></td></tr>\n";
}
if($task['date_finished'] > 0){
  $finish_date = date($pj_config['task_date_format'], $task['date_finished']);
  $pjimage = pjimage("date.png", $module_name);
  echo "<tr><td align='center'><img src='$pjimage'></td>\n";
  echo "<td width='100%' colspan='4'><nobr>"._NETWORK_FINISHDATE.": <strong>$finish_date</strong></nobr></td></tr>\n";
}
echo "<tr><td bgcolor='$bgcolor2' colspan='3'><nobr><strong>"._NETWORK_TASKMEMBERS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center' colspan='2'><nobr><strong>"._NETWORK_POSITION."</strong></nobr></td></tr>\n";
$memberresult = $db2->sql_query("SELECT `member_id`, `position_id` FROM `".$network_prefix."_tasks_members` WHERE `task_id`='$task_id' ORDER BY member_id");
$member_total = $db2->sql_numrows($memberresult);
if($member_total != 0){
  while(list($member_id, $position_id) = $db2->sql_fetchrow($memberresult)) {
    $member = pjmember_info($member_id);
    $position = pjmemberposition_info($position_id);
    $pjimage = pjimage("member.png", $module_name);
    echo "<tr><td><img src='$pjimage'></td><td width='100%' colspan='2'><a href='mailto:".pjencode_email($member['member_email'])."'>".$member['member_name']."</a></td>\n";
    if(empty($position['position_name'])){ $position['position_name'] = "----------"; }
    echo "<td align='center' colspan='2'><nobr>".$position['position_name']."</nobr></td></tr>\n";
  }
} else {
  echo "<tr><td colspan='5'>"._NETWORK_NOTASKMEMBERS."</td></tr>\n";
}
if(is_admin()) {
  echo "<tr><td bgcolor='$bgcolor2' colspan='5' width='100%'><nobr><strong>"._NETWORK_ADMINFUNCTIONS."</strong></nobr></td></tr>\n";
  $pjimage = pjimage("options.png", $module_name);
  echo "<tr><td align='center'><img src='$pjimage'></td>\n";
  echo "<td colspan='4' width='100%'><nobr><a href='".$admin_file.".php?op=TaskEdit&amp;task_id=$task_id'>"._NETWORK_EDITTASK."</a>";
  echo ", <a href='".$admin_file.".php?op=TaskRemove&amp;task_id=$task_id'>"._NETWORK_DELETETASK."</a></nobr></td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>