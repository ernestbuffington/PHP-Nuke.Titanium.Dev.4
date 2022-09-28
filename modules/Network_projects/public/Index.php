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

global $network_prefix, $titanium_db2;

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_PROJECTLIST;

include_once(NUKE_BASE_DIR.'header.php');
title($sitename.' '.$pagetitle);

OpenTable();

echo '<div align="center"><strong>'._NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_PROJECTLIST.'</strong></div>';

echo '<div align="center">';
echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> ';
echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> ';
echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> ';
echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a>';
echo '</div><br/>';


echo "<table class='forumline' align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr>\n";
echo "<td class='row1' width='100%' bgcolor='$bgcolor2' colspan='2'><strong>"._NETWORK_PROJECTNAME."</strong></td>\n";
echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;&nbsp;"._NETWORK_SITE."&nbsp;&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_TASKS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_REPORTS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_REQUESTS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_STATUS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_PRIORITY."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_MEMBERS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_PROGRESSBAR."</strong></nobr></td>\n";
echo "</tr>\n";
$projectresult = $titanium_db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` ORDER BY `weight`");

while(list($project_id) = $titanium_db2->sql_fetchrow($projectresult)) 
{
  $project = pjprojectpercent_info($project_id);
  
  $projectstatus = pjprojectstatus_info($project['status_id']);
  
  $projectpriority = pjprojectpriority_info($project['priority_id']);
  
  $memberresult = $titanium_db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id' ORDER BY `member_id`");
  
  $member_total = $titanium_db2->sql_numrows($memberresult);
  
  $taskresult = $titanium_db2->sql_query("SELECT `task_id`, `status_id` FROM `".$network_prefix."_tasks` WHERE `project_id`='$project_id' ORDER BY `task_name`");
  
  $taskrows = $titanium_db2->sql_numrows($taskresult);
  
  $reportresult = $titanium_db2->sql_query("SELECT `report_id` FROM `".$network_prefix."_reports` WHERE `project_id`='$project_id'");
  
  $report_total = $titanium_db2->sql_numrows($reportresult);
  
  $requestresult = $titanium_db2->sql_query("SELECT `request_id` FROM `".$network_prefix."_requests` WHERE `project_id`='$project_id'");
  
  $request_total = $titanium_db2->sql_numrows($requestresult);
  
  echo "<tr>\n";

  if($project['featured'] > 0) 
  {
    $pjimage = pjimage("project_featured.png", $titanium_module_name);
  } 
  else 
  {
    $pjimage = pjimage("project.png", $titanium_module_name);
  }
  
  echo "<td class='row1' align='center'><img src='$pjimage'></td><td width='100%'><a href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
  
  if($project['project_site'] > "") 
  {
	# got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
    $pjimage = "<i style=\"font-size: 25px; color: #008080\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#008080'\" class=\"bi bi-server\"></i>";
    $demo = " <a href='".$project['project_site']."' target='_blank'>$pjimage</a>";
	# got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
  } 
  else 
  {
    $demo = "&nbsp;";
  }
  echo "<td class='row1' align='center'>$demo</td>\n";
  echo "<td class='row1' align='center'>$taskrows</a></td>\n";
  
  if($project['allowreports'] > 0) 
  {
    echo "<td class='row1' align='center'>$report_total</td>\n";
  } 
  else 
  {
    echo "<td class='row1' align='center'>----</td>\n";
  }
  
  if($project['allowrequests'] > 0) 
  {
    echo "<td class='row1' align='center'>$request_total</td>\n";
  } 
  else 
  {
    echo "<td class='row1' align='center'>----</td>\n";
  }
  
  if(empty($projectstatus['status_name']))
  { 
    $projectstatus['status_name'] = _NETWORK_NA; 
  }
  echo "<td class='row1' align='center'>".$projectstatus['status_name']."</td>\n";
  
  if(empty($projectpriority['priority_name']))
  { 
    $projectpriority['priority_name'] = _NETWORK_NA; 
  }
  
  echo "<td class='row1' align='center'><nobr>".$projectpriority['priority_name']."</nobr></td>\n";
  echo "<td class='row1' align='center'><nobr>$member_total</nobr></td>\n";
  
  $wbprogress = pjprogress($project['project_percent']);
  
  echo "<td class='row1' align='center'><nobr>$wbprogress</nobr></td>\n";
  echo "</tr>\n";
}


echo "</td></tr>\n";
echo "</table>\n";

CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');

?>