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

global $titanium_db2;

get_lang('Network_Projects');

if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_PROJECTS.': '._NETWORK_PROJECTLIST; 

include_once(NUKE_BASE_DIR.'header.php');

pjadmin_menu(_NETWORK_PROJECTS.": "._NETWORK_PROJECTLIST);

$projectresult = $titanium_db2->sql_query("SELECT `project_id`, `project_name`, `weight`, `featured`, `status_id`, `priority_id` FROM `".$network_prefix."_projects` ORDER BY `weight`");

$project_total = $titanium_db2->sql_numrows($projectresult);

OpenTable();

echo "<table class='projects_row1' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";

echo "<tr><td class='projects_row1' colspan='3' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_PROJECTOPTIONS."</strong></nobr></td></tr>\n";

$pjimage = pjimage("options.png", $titanium_module_name);

echo "<tr>";

echo "<td class='projects_row1'><i style=\"font-size: 40px; color: #45B39D\" class=\"bi bi-pencil-square\"></i></td>";

echo "<td class='projects_row1' colspan='2' width='100%'><nobr>";

echo "<a class=\"titaniumbutton\" href='".$admin_file.".php?op=ProjectAdd'>"._NETWORK_PROJECTADD."</a></nobr>";

echo "</td></tr>\n";

$pjimage = pjimage("stats.png", $titanium_module_name);

echo "<tr><td align='center' class='projects_row1'><img width='30' height='30' src='$pjimage'></td><td class='projects_row1' colspan='3' width='100%'><nobr>"._NETWORK_TOTALPROJECTS.": <strong>$project_total</strong></nobr></td></tr>\n";
echo "</table>\n";

echo "<table class='projects_row1' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td class='projects_row1' colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._NETWORK_PROJECTS."</strong></a></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_WEIGHT."</strong></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_STATUS."</strong></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_PRIORITY."</strong></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_TASKS."</strong></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_REPORTS."</strong></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_REQUESTS."</strong></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_FUNCTIONS."</strong></td></tr>\n";

if($project_total != 0):

  while(list($project_id, $project_name, $weight, $featured, $status_id, $priority_id) = $titanium_db2->sql_fetchrow($projectresult)): 
  
    $tasksresult = $titanium_db2->sql_query("SELECT * FROM `".$network_prefix."_tasks` WHERE `project_id`='$project_id'");

    $tasks = $titanium_db2->sql_numrows($tasksresult);

    $reportsresult = $titanium_db2->sql_query("SELECT * FROM `".$network_prefix."_reports` WHERE `project_id`='$project_id'");

    $reports = $titanium_db2->sql_numrows($reportsresult);

    $requestsresult = $titanium_db2->sql_query("SELECT * FROM `".$network_prefix."_requests` WHERE `project_id`='$project_id'");

    $requests = $titanium_db2->sql_numrows($requestsresult);

    $projectstatus = pjprojectstatus_info($status_id);

    $projectpriority = pjprojectpriority_info($priority_id);
  
    if($featured > 0) 
      $pjimage = pjimage("project_featured.png", $titanium_module_name);
	else 
      $pjimage = pjimage("project.png", $titanium_module_name);
    
	echo "<tr><td class='projects_row1'><img src='$pjimage'></td><td class='projects_row1' width='100%'>$project_name</td>\n";

    $weight1 = $weight - 1;
    $weight3 = $weight + 1;
    $res = $titanium_db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` WHERE `weight`='$weight1'");

    list($pid1) = $titanium_db2->sql_fetchrow($res);

    $con1 = "$pid1";
    $res2 = $titanium_db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` WHERE `weight`='$weight3'");

    list($pid2) = $titanium_db2->sql_fetchrow($res2);
    $con2 = "$pid2";

    echo "<td class='projects_row1' align='center'><nobr>";

    if($con1): 
      echo"<a href='".$admin_file.".php?op=ProjectOrder&amp;weight=$weight&amp;pid=$project_id&amp;weightrep=$weight1&amp;pidrep=$con1'>";
	  echo"<img src='modules/$titanium_module_name/images/weight_up.png' border='0' hspace='3' alt='"._NETWORKUP."' title='"._NETWORK_UP."'></a>";
	else: 
      echo "<img src='modules/$titanium_module_name/images/weight_up_no.png' border='0' hspace='3' alt='' title=''>";
	endif;
    
	if($con2): 
      echo "<a href='".$admin_file.".php?op=ProjectOrder&amp;weight=$weight&amp;pid=$project_id&amp;weightrep=$weight3&amp;pidrep=$con2'>";
	  echo "<img src='modules/$titanium_module_name/images/weight_dn.png' border='0' hspace='3' alt='"._NETWORKDOWN."' title='"._NETWORK_DOWN."'></a>";
	else: 
      echo "<img src='modules/$titanium_module_name/images/weight_dn_no.png' border='0' hspace='3' alt='' title=''>";
    endif;
    
	echo"</nobr></td>\n";
    
	if(empty($projectstatus['status_name'])) 
	  $projectstatus['status_name'] = _NETWORK_NA; 

    echo "<td class='projects_row1' align='center'><a href='".$admin_file.".php?op=ProjectStatusList'>".$projectstatus['status_name']."</a></td>\n";

    if(empty($projectpriority['priority_name'])) 
	  $projectpriority['priority_name'] = _NETWORK_NA; 
    
	echo "<td class='projects_row1' align='center'><a href='".$admin_file.".php?op=ProjectPriorityList'>".$projectpriority['priority_name']."</a></td>\n";
    echo "<td class='projects_row1' align='center'><a href='".$admin_file.".php?op=ProjectTasks&amp;project_id=$project_id'>$tasks</a></td>\n";
    echo "<td class='projects_row1' align='center'><a href='".$admin_file.".php?op=ProjectReports&amp;project_id=$project_id'>$reports</a></td>\n";
    echo "<td class='projects_row1' align='center'><a href='".$admin_file.".php?op=ProjectRequests&amp;project_id=$project_id'>$requests</a></td>\n";
    echo "<td class='projects_row1' align='center'><nobr> <a class='titaniumbutton' href='".$admin_file.".php?op=ProjectEdit&amp;project_id=$project_id'>"._NETWORK_EDIT."</a>";
    echo " <a class='titaniumbutton' href='".$admin_file.".php?op=ProjectRemove&amp;project_id=$project_id'>"._NETWORK_DELETE."</a> </nobr></td></tr>\n";
  endwhile;

  echo "<tr><td align='center' colspan='9'>&nbsp;</td></tr>\n";
  echo "<tr><td align='center' colspan='9'><a class='titaniumbutton' href='".$admin_file.".php?op=ProjectFix'>"._NETWORK_FIXWEIGHT."</a></td></tr>\n";
 
else: 
  echo "<tr><td width='100%' colspan='9' align='center'>"._NETWORK_NOPROJECTS."</td></tr>\n";
endif;

echo "</table>\n";

CloseTable();

pj_copy();

include_once(NUKE_BASE_DIR.'footer.php');
?>
