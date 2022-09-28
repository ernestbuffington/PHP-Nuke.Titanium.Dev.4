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
if(!defined('SUPPORT_NETWORK')) { die("Illegal Access Detected!!!"); }

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_TASKMAP;

include_once(NUKE_BASE_DIR.'header.php');

$projectresult = $titanium_db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` ORDER BY `weight`");

while(list($project_id) = $titanium_db2->sql_fetchrow($projectresult)) {

  $project = pjprojectpercent_info($project_id);
  
  $projectstatus = pjprojectstatus_info($project['status_id']);
  
  $projectpriority = pjprojectpriority_info($project['priority_id']);
  
  $memberresult = $titanium_db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id' ORDER BY `member_id`");
  
  $member_total = $titanium_db2->sql_numrows($membersresult);

  OpenTable();
  
  echo '<div align="center"><strong>'._NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_TASKMAP.'</strong></div>';
  
  echo '<div align="center">';
  echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> ';
  echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> ';
  echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> ';
  echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a>';
  echo '</div><br/>';
  
  echo "<table class='forumline' align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
  echo "<tr>\n";
  echo "<td class='row1' width='100%' bgcolor='$bgcolor2' colspan='2'><strong>"._NETWORK_PROJECT."</strong></td>\n";
  echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_SITE."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
  echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_STATUS."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
  echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_PRIORITY."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
  echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>&nbsp;&nbsp;&nbsp;"._NETWORK_PROGRESSBAR."&nbsp;&nbsp;&nbsp;</strong></nobr></td>\n";
  echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_MEMBERS."</strong></nobr></td>\n";
  echo "</tr>\n";
  
    $pjimage = "<i style=\"font-size: 25px; color: #45B39D\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#45B39D'\" class=\"bi bi-server\"></i>";
    
	if($project['featured'] > 0) 
	{ 
	   $project['project_name'] = "<strong>".$project['project_name']."</strong>"; 

       # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
       $pjimage = "<i style=\"font-size: 25px; color: gold\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='gold'\" class=\"bi bi-server\"></i>";
       $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=".$project_id." target='_blank'>".$pjimage."</a> ";
       # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
	}
    else
	{
       # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
       $pjimage = "<i style=\"font-size: 25px; color: grey\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='white'\" class=\"bi bi-server\"></i>";
       $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=".$project_id." target='_blank'>".$pjimage."</a> ";
       # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
		
	}

    echo "<tr>\n<td align='center'>$demo</td>\n";

    echo "<td  class='row1' width='100%'>&nbsp;<a href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
    
	if($project['project_site'] > "") 
	{
      # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: #45B39D\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#45B39D'\" class=\"bi bi-box-arrow-up-right\"></i>";
      $demo = " <a href='".$project['project_site']."' target='_blank'>$pjimage</a>";
      # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
    } 
	else 
	{
      $demo = "&nbsp;";
    }
    echo "<td align='center'>$demo</td>\n";
  
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
  echo "<td class='row1' align='center'><nobr><font color=\"$color\">".$projectstatus['status_name']."</font></nobr></td>\n";
  
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
  echo "<td class='row1' align='center'><nobr><font color=\"$color\">".$projectpriority['priority_name']."</font></nobr></td>\n";
  
  $wbprogress = pjprogress($project['project_percent']);
  
  echo "<td class='row1' align='center'><nobr>$wbprogress</nobr></td>\n";
  
  echo "<td class='row1' align='center'><nobr>$member_total</nobr></td></tr>\n";
  
  echo "<tr><td class='row1' width='100%' bgcolor='$bgcolor2' colspan='7'><strong>"._NETWORK_PROJECTTASKS."</strong></td></tr>\n";
  
  $taskresult = $titanium_db2->sql_query("SELECT `task_id`, 
                                               `task_name`, 
											`task_percent`, 
											 `priority_id`, 
											   `status_id` 
											   
  FROM `".$network_prefix."_tasks` 
  
  WHERE `project_id`='$project_id' ORDER BY `task_name`");
  
  $task_total = $titanium_db2->sql_numrows($taskresult);
  
  if($task_total != 0)
  {
    while(list($task_id, $task_name, $task_percent, $priority_id, $status_id) = $titanium_db2->sql_fetchrow($taskresult)) 
	{
      $memberresult = $titanium_db2->sql_query("SELECT `member_id` FROM `".$network_prefix."_tasks_members` WHERE `task_id`='$task_id' ORDER BY `member_id`");
    
	  $member_total = $titanium_db2->sql_numrows($membersresult);
    
	  $taskstatus = pjtaskstatus_info($status_id);
    
	  $taskpriority = pjtaskpriority_info($priority_id);
    

	  if($taskstatus['status_name'] === 'Inactive'):
      $color1 = 'grey';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color1."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color1."'\" class=\"bi bi-calendar-check\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color1.">".$taskstatus['status_name']."</font></nobr></td>\n";
	  
	  elseif($taskstatus['status_name'] === 'On Going'):
      $color2 = 'red';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color2."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color2."'\" class=\"bi bi-calendar-x\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color2.">".$taskstatus['status_name']."</font></nobr></td>\n";
      
	  elseif($taskstatus['status_name'] === 'Holding'):
      $color3 = '#66FFFF';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color3."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color3."'\" class=\"bi bi-calendar-check\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color3.">".$taskstatus['status_name']."</font></nobr></td>\n";
      
	  
	  elseif($taskstatus['status_name'] === 'Open'):
      $color4 = 'orange';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color4."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color4."'\" class=\"bi bi-calendar-x\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color4.">".$taskstatus['status_name']."</font></nobr></td>\n";
      
	  # show green checkbox on completed tasks!
	  elseif($taskstatus['status_name'] === 'Completed'):
      $color5 = 'green';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color5."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color5."'\" class=\"bi bi-calendar-check\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color5.">".$taskstatus['status_name']."</font></nobr></td>\n";
      
	  # Show grey clipboard on disconiued tasks!
	  elseif($taskstatus['status_name'] === 'Discontinued'):
      $color6 = 'grey';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color6."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color6."'\" class=\"bi bi-calendar2-x\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color6.">".$taskstatus['status_name']."</font></nobr></td>\n";
      
	  # Show Red X on Active Tasks!
	  elseif($taskstatus['status_name'] === 'Active'):
      $color7 = 'red';
 	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color7."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color7."'\" class=\"bi bi-calendar-x\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color7.">".$taskstatus['status_name']."</font></nobr></td>\n";
      
	  # Show grey X on suspnded Tasks!
	  elseif($taskstatus['status_name'] === 'Suspended'):
      $color8 = 'grey';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color8."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color8 ."'\" class=\"bi bi-x-square\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font class=\"blink-one\" color=".$color8.">".$taskstatus['status_name']."</font></nobr></td>\n";
      
	  # Show green check box on completed tasks!
	  elseif($taskstatus['status_name'] === 'Fix Completed'):
      $color9 = 'green';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: ".$color9."\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color9."'\" class=\"bi bi-calendar-check\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color9.">".$taskstatus['status_name']."</font></nobr></td>\n";

      else:
      $color10 = 'white';
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: '".$color10."'\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='".$color10."'\" class=\"bi bi-calendar-check\"></i>";
      $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id' target='_blank'>$pjimage</a>";
	  # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color10.">".$taskstatus['status_name']."</font></nobr></td>\n";

	  endif;

      echo "<tr><td class='row1' >$demo</td>\n";
      echo "<td colspan='2' width='100%'><a href='modules.php?name=$titanium_module_name&amp;op=Task&amp;task_id=$task_id'>$task_name</a></td>\n";
    
	  
	  if(empty($taskstatus['status_name']))
	  { 
	    $taskstatus['status_name'] = _NETWORK_NA; 
	  }
      print $task_status_name;

	  if($taskpriority['priority_name'] === 'Low'):
      $color1 = 'white';
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color1.">".$taskpriority['priority_name']."</font></nobr></td>\n";
	  elseif($taskpriority['priority_name'] === 'Low-Med'):
      $color2 = '#FFCC99';
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color2.">".$taskpriority['priority_name']."</font></nobr></td>\n";
	  elseif($taskpriority['priority_name'] === 'Medium'):
      $color3 = '#FFCC00';
      $task_status_name = "<td class='row1' align='center'><nobr><font color=".$color3.">".$taskpriority['priority_name']."</font></nobr></td>\n";
	  elseif($taskpriority['priority_name'] === 'High-Med'):
      $color4 = '#ff632a';
      $task_priority_name = "<td class='row1' align='center'><nobr><font color=".$color4.">".$taskpriority['priority_name']."</font></nobr></td>\n";
	  # show green checkbox on completed tasks!
	  elseif($taskpriority['priority_name'] === 'High'):
      $color5 = 'red';
      $task_priority_name = "<td class='row1' align='center'><nobr><font color=".$color5.">".$taskpriority['priority_name']."</font></nobr></td>\n";
	  # Show grey clipboard on disconiued tasks!
	  elseif($taskpriority['priority_name'] === 'Urgent'):
      $color6 = 'red';
      $task_priority_name = "<td class='row1' align='center'><nobr><font color=".$color6.">".$taskpriority['priority_name']."</font></nobr></td>\n";
	  # Show Red X on Active Tasks!
	  elseif($taskpriority['priority_name'] === 'Yesterday'):
      $color7 = 'red';
      $task_priority_name = "<td class='row1' align='center'><nobr><font color=".$color7.">".$taskpriority['priority_name']."</font></nobr></td>\n";
	  # Show grey X on suspnded Tasks!
	  elseif($taskpriority['priority_name'] === '86it'):
      $color8 = 'grey';
      $task_priority_name = "<td class='row1' align='center'><nobr><font class=\"blink-one\" color=".$color8.">".$taskpriority['priority_name']."</font></nobr></td>\n";
      else:
      $color9 = 'white';
      $task_priority_name = "<td class='row1' align='center'><nobr><font color=".$color9.">".$taskpriority['priority_name']."</font></nobr></td>\n";
	  endif;

	  if(empty($taskpriority['priority_name']))
	  { 
	    $taskpriority['priority_name'] = _NETWORK_NA; 
	  }
      
	  echo $task_priority_name;
      
	  $wbprogress = pjprogress($task_percent);
      
	  echo "<td class='row1' align='center'><nobr>$wbprogress</nobr></td>\n";
      echo "<td class='row1' align='center'><nobr>$member_total</nobr></td></tr>\n";
    }
  } else {
    echo "<tr>\n";
    echo "<td class='row1' width='100%' colspan='7' align='center'><nobr>"._NETWORK_NOTASKS."</nobr></td>\n";
    echo "</tr>\n";
  }
  echo "</table>\n";
  CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');

?>