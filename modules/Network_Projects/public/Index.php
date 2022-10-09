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
if(!defined('SUPPORT_NETWORK')) 
{ 
   die("Illegal Access Detected!!!"); 
}

global $network_prefix, $db2;

$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']." ::: "._NETWORK_PROJECTLIST." ::: ";

include_once(NUKE_BASE_DIR.'header.php');
title($sitename.' '.$pagetitle);

OpenTable();
echo '<div align="center"><strong>'._NETWORK_TITLE." v".$pj_config['version_number']." ::: "._NETWORK_PROJECTLIST." ::: ".'</strong></div>';
echo '<div align="center">';
echo '[ <a href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> | ';
echo '<a href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a> ]';
echo '</div><br/>';


echo "<table align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr>\n";
echo "<td width='100%' bgcolor='$bgcolor2' colspan='2'><strong>"._NETWORK_PROJECTNAME."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_SITE."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_TASKS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_REPORTS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_REQUESTS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_STATUS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_PRIORITY."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_MEMBERS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_PROGRESSBAR."</strong></nobr></td>\n";
echo "</tr>\n";
$projectresult = $db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` ORDER BY `weight`");

while(list($project_id) = $db2->sql_fetchrow($projectresult)) 
{
  $project = pjprojectpercent_info($project_id);
  
  $projectstatus = pjprojectstatus_info($project['status_id']);
  
  $projectpriority = pjprojectpriority_info($project['priority_id']);
  
  $memberresult = $db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id' ORDER BY `member_id`");
  
  $member_total = $db2->sql_numrows($memberresult);
  
  $taskresult = $db2->sql_query("SELECT `task_id`, `status_id` FROM `".$network_prefix."_tasks` WHERE `project_id`='$project_id' ORDER BY `task_name`");
  
  $taskrows = $db2->sql_numrows($taskresult);
  
  $reportresult = $db2->sql_query("SELECT `report_id` FROM `".$network_prefix."_reports` WHERE `project_id`='$project_id'");
  
  $report_total = $db2->sql_numrows($reportresult);
  
  $requestresult = $db2->sql_query("SELECT `request_id` FROM `".$network_prefix."_requests` WHERE `project_id`='$project_id'");
  
  $request_total = $db2->sql_numrows($requestresult);
  
  echo "<tr>\n";

  if($project['featured'] > 0) 
  {
    $pjimage = pjimage("project_featured.png", $module_name);
  } 
  else 
  {
    $pjimage = pjimage("project.png", $module_name);
  }
  
  echo "<td align='center'><img src='$pjimage'></td><td width='100%'><a href='modules.php?name=$module_name&amp;op=Project&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
  
  if($project['project_site'] > "") 
  {
    $pjimage = pjimage("demo.png", $module_name);
    $demo = " <a href='".$project['project_site']."' target='_blank'><img src='$pjimage' border='0' alt='".$project['project_name']." "._NETWORK_SITE."' title='".$project['project_name']." "._NETWORK_SITE."'></a>";
  } 
  else 
  {
    $demo = "&nbsp;";
  }
  echo "<td align='center'>$demo</td>\n";
  echo "<td align='center'>$taskrows</a></td>\n";
  
  if($project['allowreports'] > 0) 
  {
    echo "<td align='center'>$report_total</td>\n";
  } 
  else 
  {
    echo "<td align='center'>----</td>\n";
  }
  
  if($project['allowrequests'] > 0) 
  {
    echo "<td align='center'>$request_total</td>\n";
  } 
  else 
  {
    echo "<td align='center'>----</td>\n";
  }
  
  if(empty($projectstatus['status_name']))
  { 
    $projectstatus['status_name'] = _NETWORK_NA; 
  }
  echo "<td align='center'>".$projectstatus['status_name']."</td>\n";
  
  if(empty($projectpriority['priority_name']))
  { 
    $projectpriority['priority_name'] = _NETWORK_NA; 
  }
  
  echo "<td align='center'><nobr>".$projectpriority['priority_name']."</nobr></td>\n";
  echo "<td align='center'><nobr>$member_total</nobr></td>\n";
  
  $wbprogress = pjprogress($project['project_percent']);
  
  echo "<td align='center'><nobr>$wbprogress</nobr></td>\n";
  echo "</tr>\n";
}

echo "<tr><td bgcolor='$bgcolor2' colspan='10' align='right'>\n";
echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>\n";
echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;op=TaskMap'><strong>"._NETWORK_TASKMAP."</strong></a></td>\n";
echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;op=ReportMap'><strong>"._NETWORK_REPORTMAP."</strong></a></td>\n";
echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;op=RequestMap'><strong>"._NETWORK_REQUESTMAP."</strong></a></td>\n";
echo "</tr></table>\n";
echo "</td></tr>\n";
echo "</table>\n";

CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');

?>