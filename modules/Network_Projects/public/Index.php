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

$projects_name = basename(dirname(dirname(__FILE__)));

title($sitename.' '.$pagetitle);

OpenTable();

echo '<div align="center"><strong>'._NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_PROJECTLIST.'</strong></div>';

echo '<div align="center">';
echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> ';
echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> ';
echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> ';
echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a>';
echo '</div><br/>';


echo "<table class='projects_row1' align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr>\n";
echo "<td class='projects_row1' width='100%' bgcolor='$bgcolor2' colspan='2'><strong>"._NETWORK_PROJECTNAME."</strong></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;&nbsp;"._NETWORK_SITE."&nbsp;&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_TASKS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_REPORTS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_REQUESTS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_STATUS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_PRIORITY."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_MEMBERS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
echo "<td class='projects_row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_PROGRESSBAR."</strong></nobr></td>\n";
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
  
  # Set the icon for the projext START
  $pjimage = "<i style=\"font-size: 25px; color: #45B39D\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#45B39D'\" class=\"bi bi-exclamation-triangle\"></i>";
  $project['project_name'] = "<strong>".$project['project_name']."</strong>"; 

  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
  if($project['featured'] == 0) # PHP-Nuke Titanium Web Portal
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-grid-3x2-gap\"></i>";

  if($project['featured'] == 1) # PHP-Nuke Titanium Module
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-grid-1x2\"></i>";

  if($project['featured'] == 2) # PHP-Nuke Titanium Block
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-box\"></i>";

  if($project['featured'] == 3) # PHP-Nuke Titanium phpBB2 Mod
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-file-earmark-bar-graph\"></i>";

  if($project['featured'] == 4) # PHP-Nuke Titanium Theme
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-palette\"></i>";

  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
  if($project['featured'] == 5) # Nuke Evo Web Portal
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-grid-3x2-gap\"></i>";

  if($project['featured'] == 6) # Nuke Evo Module
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-grid-1x2\"></i>";

  if($project['featured'] == 7) # Nuke Evo Block
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-box\"></i>";

  if($project['featured'] == 8) # Nuke Evo phpBB2 Mod
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-file-earmark-bar-graph\"></i>";

  if($project['featured'] == 9) # Nuke Evo Theme
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-palette\"></i>";

  if($project['featured'] == 10) # Misc Project
  $pjimage = "<i style=\"font-size: 25px; color: #0078d7\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#0078d7'\" class=\"bi bi-palette\"></i>";
  # Set the icon for the projext END


       
	   $demo = " <a class='projectlink' href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=".$project_id." target='_blank'>".$pjimage."</a> ";
       # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
  
  echo "<td class='projects_row1' align='center'><a class='projectlink' href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=$project_id'>$pjimage</a></td><td class='projects_row1' width='100%'><a class='projectlink' href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
  
  $pjimage = "<i style=\"font-size: 25px; color: #45B39D\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#45B39D'\" class=\"bi bi-server\"></i>";
    
if($project['project_site'] > "") 
	{
      # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: #45B39D\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#45B39D'\" class=\"bi bi-box-arrow-up-right\"></i>";
      $demo = " <a class='projectlink' href='".$project['project_site']."' target='_blank'>$pjimage</a>";
      # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
    } 
	else 
	{
      $demo = "&nbsp;";
    }
    echo "<td class='projects_row1' align='center'>$demo</td>\n";

    
  if($taskrows > 0)
  $color = '#ECAB53';
  else
  $color = '#008080';

  echo "<td class='projects_row1' align='center'><font color=\"$color\">$taskrows</font></td>\n";
  
  if($project['allowreports'] > 0) 
  {
	if($report_total > 0)
	$color = '#ECAB53';
	else
	$color = '#008080';

    echo "<td class='projects_row1' align='center'><font color=\"$color\">$report_total</font></td>\n";
  } 
  else 
  {
    echo "<td class='projects_row1' align='center'>----</td>\n";
  }
  
  if($request_total > 0)
  $color = '#ECAB53';
  else
  $color = '#008080';

  if($project['allowrequests'] > 0) 
  {
    echo "<td class='projects_row1' align='center'><font color=\"$color\">$request_total</font></td>\n";
  } 
  else 
  {
    echo "<td class='projects_row1' align='center'>----</td>\n";
  }

  if($projectstatus['status_name'] === 'Active')
  $color = '#66FF00';
  elseif($projectstatus['status_name'] === 'Inactive')
  $color = 'grey';
  elseif($projectstatus['status_name'] === 'Pending')
  $color = '#66FFFF';
  elseif($projectstatus['status_name'] === 'Released')
  $color = '#FF3366';
  elseif($projectstatus['status_name'] === 'N/A')
  $color = 'grey';
  else
  $color = 'white';
  
  if(empty($projectstatus['status_name']))
  { 
    $projectstatus['status_name'] = _NETWORK_NA; 
  }
  echo "<td class='projects_row1' align='center'><font color=\"$color\">".$projectstatus['status_name']."</font></td>\n";
  

  if($projectpriority['priority_name'] === 'Low')
  $color = 'white';
  elseif($projectpriority['priority_name'] === 'Low-Med')
  $color = '#FFCC99';
  elseif($projectpriority['priority_name'] === 'Medium')
  $color = '#FFCC00';
  elseif($projectpriority['priority_name'] === 'High-Med')
  $color = '#ff632a';
  elseif($projectpriority['priority_name'] === 'High')
  $color = 'red';
  else
  $color = 'grey';

  if(empty($projectpriority['priority_name']))
  { 
    $projectpriority['priority_name'] = _NETWORK_NA; 
  }
  
  echo "<td class='projects_row1' align='center'><nobr><font color=\"$color\">".$projectpriority['priority_name']."</font></nobr></td>\n";

  if($member_total > 0)
  $color = '#FFCC66';

  echo "<td class='projects_row1' align='center'><nobr><font color=\"$color\">$member_total</font></nobr></td>\n";
  
  $wbprogress = pjprogress($project['project_percent']);
  
  echo "<td class='projects_row1' align='center'><nobr>$wbprogress</nobr></td>\n";
  echo "</tr>\n";
}


echo "</td></tr>\n";
echo "</table>\n";

CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');
?>
