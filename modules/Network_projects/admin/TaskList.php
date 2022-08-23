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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_TASKS.": "._NETWORK_TASKLIST;
if(!$page) $page = 1;
if(!$per_page) $per_page = 25;
if(!$column) $column = "project_id";
if(!$direction) $direction = "desc";
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
pjadmin_menu(_NETWORK_TASKS.": "._NETWORK_TASKLIST);
//echo "<br />\n";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='3' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_TASKOPTIONS."</strong></nobr></td></tr>\n";
$pjimage = pjimage("options.png", $module_name);
echo "<tr><td><img src='$pjimage'></td><td colspan='2' width='100%'><nobr><a href='".$admin_file.".php?op=TaskAdd'>"._NETWORK_TASKADD."</a></nobr></td></tr>\n";
$taskrows = $db2->sql_numrows($db2->sql_query("SELECT `task_id` FROM `".$network_prefix."_tasks`"));
$pjimage = pjimage("stats.png", $module_name);
echo "<tr><td><img src='$pjimage'></td><td colspan='2' width='100%'><nobr>"._NETWORK_TOTALTASKS.": <strong>$taskrows</strong></nobr></td></tr>\n";
echo "</table>\n";
//CloseTable();
//echo "<br />\n";
$total_pages = ($taskrows / $per_page);
$total_pages_quotient = ($taskrows % $per_page);
if($total_pages_quotient != 0){ $total_pages = ceil($total_pages); }
$start_list = ($per_page * ($page-1));
$end_list = $per_page;
//OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='2'><nobr><strong>"._NETWORK_TASKS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_PROJECT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_STATUS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_PRIORITY."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_FUNCTIONS."</strong></td></tr>\n";
if($taskrows > 0){
  $reviewresult = $db2->sql_query("SELECT `task_id`, `task_name`, `project_id`, `priority_id`, `status_id` FROM `".$network_prefix."_tasks` ORDER BY `$column` $direction LIMIT $start_list, $end_list");
  while(list($task_id, $task_name, $project_id, $priority_id, $status_id) = $db2->sql_fetchrow($reviewresult)){
    $taskstatus = pjtaskstatus_info($status_id);
    $project = pjproject_info($project_id);
    $taskpriority = pjtaskpriority_info($priority_id);
    $members = $db2->sql_numrows($db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_tasks_members` WHERE `task_id`='$task_id'"));
    $pjimage = pjimage("task.png", $module_name);
    echo "<tr><td><img src='$pjimage'></td><td width='100%'>$task_name</td>\n";
    echo "<td align='center'><nobr><a href='".$admin_file.".php?op=ProjectList'>".$project['project_name']."</a></nobr></td>\n";
    if($taskstatus['status_name'] == ''){ $taskstatus['status_name'] = _NETWORK_NA; }
    echo "<td align=center><nobr><a href='".$admin_file.".php?op=TaskStatusList'>".$taskstatus['status_name']."</a></nobr></td>\n";
    echo "";
    if(empty($taskpriority['priority_name'])){ $taskpriority['priority_name'] = _NETWORK_NA; }
    echo "<td align=center><nobr><a href='".$admin_file.".php?op=TaskPriorityList'>".$taskpriority['priority_name']."</a></nobr></td>\n";
    echo "<td align=center><nobr>[ <a href='".$admin_file.".php?op=TaskEdit&amp;task_id=$task_id'>"._NETWORK_EDIT."</a>";
    echo " | <a href='".$admin_file.".php?op=TaskRemove&amp;task_id=$task_id'>"._NETWORK_DELETE."</a> ]</td></tr>\n";
  }
  echo "<form method='post' action='".$admin_file.".php'>\n";
  echo "<input type='hidden' name='op' value='TaskList'>\n";
  echo "<input type='hidden' name='column' value='$column'>\n";
  echo "<input type='hidden' name='direction' value='$direction'>\n";
  echo "<input type='hidden' name='per_page' value='$per_page'>\n";
  echo "<tr><td colspan='6' width='100%' bgcolor='$bgcolor2'>\n";
  echo "<table width='100%'><tr><td bgcolor='$bgcolor2'><strong>"._NETWORK_PAGE."</strong> <select name='page' onChange='submit()'>\n";
  for($i=1; $i<=$total_pages; $i++){
    if($i==$page){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
  }
  echo "</select> <strong>"._NETWORK_OF." $total_pages</strong></td>\n";
  echo "</form>\n";
  echo "<form method='post' action='".$admin_file.".php'>\n";
  echo "<input type='hidden' name='op' value='TaskList'>\n";
  echo "<td align='right' bgcolor='$bgcolor2'><strong>"._NETWORK_SORT.":</strong> <select name='column'>\n";
  if($column == "task_id") $selcolumn1 = "selected";
  echo "<option value='task_id' $selcolumn1>"._NETWORK_TASKID."</option>\n";
  if($column == "project_id") $selcolumn2 = "selected";
  echo "<option value='project_id' $selcolumn2>"._NETWORK_PROJECTID."</option>\n";
  if($column == "status_id") $selcolumn3 = "selected";
  echo "<option value='status_id' $selcolumn3>"._NETWORK_STATUSID."</option>\n";
  if($column == "priority_id") $selcolumn4 = "selected";
  echo "<option value='priority_id' $selcolumn4>"._NETWORK_PRIORITYID."</option>\n";
  echo "</select> <select name='direction'>\n";
  if($direction == "asc") $seldirection1 = "selected";
  echo "<option value='asc' $seldirection1>"._NETWORK_ASC."</option>\n";
  if($direction == "desc") $seldirection2 = "selected";
  echo "<option value='desc' $seldirection2>"._NETWORK_DESC."</option>\n";
  echo "</select> <select name='per_page'>\n";
  if($per_page == 5) $selperpage1 = "selected";
  echo "<option value='5' $selperpage1>5</option>\n";
  if($per_page == 10) $selperpage2 = "selected";
  echo "<option value='10' $selperpage2>10</option>\n";
  if($per_page == 25) $selperpage3 = "selected";
  echo "<option value='25' $selperpage3>25</option>\n";
  if($per_page == 50) $selperpage4 = "selected";
  echo "<option value='50' $selperpage4>50</option>\n";
  if($per_page == 100) $selperpage5 = "selected";
  echo "<option value='100' $selperpage5>100</option>\n";
  if($per_page == 200) $selperpage6 = "selected";
  echo "<option value='200' $selperpage6>200</option>\n";
  echo "</select> <input type='submit' value='"._NETWORK_SORT."'></td>\n";
  echo "</form>\n";
  echo "</tr></table>\n";
  echo "</td></tr>\n";
} else {
  echo "<tr><td colspan='6' width='100%' align='center'>"._NETWORK_NOTASKS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>