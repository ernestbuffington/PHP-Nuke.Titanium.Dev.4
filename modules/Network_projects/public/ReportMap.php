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

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_REPORTMAP;

include_once(NUKE_BASE_DIR.'header.php');

$projectresult = $titanium_db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` ORDER BY `weight`");

while(list($project_id) = $titanium_db2->sql_fetchrow($projectresult)) 
{
  $project = pjproject_info($project_id);

  $projectstatus = pjprojectstatus_info($project['status_id']);

  $projectpriority = pjprojectpriority_info($project['priority_id']);

  if($project['allowreports'] > 0) 
  {
    $reportresult = $titanium_db2->sql_query("SELECT `report_id`, `report_name`, `status_id`, `type_id` 
	
	FROM `".$network_prefix."_reports` 
	
	WHERE `project_id`='$project_id' 
	
	ORDER BY `report_name`");
  
    $report_total = $titanium_db2->sql_numrows($reportresult);
  
    OpenTable();
    
	echo '<div align="center"><strong>'._NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_REPORTMAP.'</strong></div>';
    
	echo '<div align="center">';
    echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> ';
    echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> ';
    echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> ';
    echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a>';
    echo '</div><br/>';

	echo "<table class='forumline' align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
    echo "<tr>\n<td class='row1' bgcolor='$bgcolor2' colspan='2' width='100%'><strong>"._NETWORK_PROJECT."</strong></td>\n";
    echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr>&nbsp;&nbsp;&nbsp;<strong>"._NETWORK_SITE."</strong>&nbsp;&nbsp;&nbsp;</nobr></td>\n";
    echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr>&nbsp;&nbsp;&nbsp;<strong>"._NETWORK_STATUS."</strong>&nbsp;&nbsp;&nbsp;</nobr></td>\n";
    echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr>&nbsp;&nbsp;&nbsp;<strong>"._NETWORK_PRIORITY."</strong>&nbsp;&nbsp;&nbsp;</nobr></td>\n";
    echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr>&nbsp;&nbsp;&nbsp;<strong>"._NETWORK_REPORTS."</strong>&nbsp;&nbsp;&nbsp;</nobr></td>\n";
    echo "<td class='row1' align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_LASTSUBMISSION."</strong></nobr></td>\n</tr>\n";

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
       $pjimage = "<i style=\"font-size: 25px; color: white\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='white'\" class=\"bi bi-server\"></i>";
       $demo = " <a href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=".$project_id." target='_blank'>".$pjimage."</a> ";
       # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff END
		
	}

    echo "<tr>\n<td align='center'>$demo</td>\n";
    echo "<td width='100%'>&nbsp;<a href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
    
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
    
	if(empty($projectstatus['status_name']))
	{ 
	  $projectstatus['status_name'] = _NETWORK_NA; 
	}
    echo "<td align='center'><nobr>".$projectstatus['status_name']."</nobr></td>\n";
    
	if(empty($projectpriority['priority_name']))
	{ 
	  $projectpriority['priority_name'] = _NETWORK_NA; 
	}
    echo "<td align='center'><nobr>".$projectpriority['priority_name']."</nobr></td>\n";
    
	
	echo "<td align='center'><nobr>$report_total</nobr></td>\n";
    
	if($report_total > 0)
	{
      list($last_date) = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT `date_submitted` 
	  
	  FROM `".$network_prefix."_reports` 
	  
	  WHERE `project_id`='$project_id' 
	  
	  ORDER BY `date_submitted` desc"));
      
	  $last_date = date($pj_config['report_date_format'], $last_date);
    } 
	else 
	{
      $last_date = _NETWORK_NA;
    }
    
	echo "<td align='center'><nobr>$last_date</nobr></td>\n</tr>\n";
    
	echo "<tr>\n<td bgcolor='$bgcolor2' colspan='3'><strong>"._NETWORK_REPORTS."</strong></td>\n";
    
	echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_STATUS."</strong></td>\n";
    
	echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_TYPE."</strong></td>\n";
    
	echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_COMMENTS."</strong></td>\n";
    
	echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_LASTSUBMISSION."</strong></td>\n</tr>\n";
    
	if($report_total != 0)
	{
    
	  while(list($report_id, $report_name, $status_id, $type_id) = $titanium_db2->sql_fetchrow($reportresult)) 
	  {
        $reportcommentresult = $titanium_db2->sql_query("SELECT `report_id` FROM `".$network_prefix."_reports_comments` WHERE `report_id`='$report_id'");
      
	    $reportcomment_total = $titanium_db2->sql_numrows($reportcommentresult);
      
	    $reportstatus = pjreportstatus_info($status_id);
      
	    $reporttype = pjreporttype_info($type_id);
      
	    if(empty($report_name)) 
		{ 
		  $report_name = "----------"; 
		}
        
		$pjimage = pjimage("report.png", $titanium_module_name);
        echo "<tr>\n<td><img src='$pjimage'></td>\n";
        echo "<td width='100%' colspan='2'><a href='modules.php?name=$titanium_module_name&amp;op=Report&amp;report_id=$report_id'>$report_name</a></td>\n";
        
		if(empty($reportstatus['status_name']))
		{ 
		  $reportstatus['status_name'] = _NETWORK_NA; 
		}
        echo "<td align='center'><nobr>".$reportstatus['status_name']."</nobr></td>\n";
        
		if(empty($reportpriority['priority_name']))
		{ 
		  $reportpriority['priority_name'] = _NETWORK_NA; 
		}
        echo "<td align='center'><nobr>".$reportpriority['priority_name']."</nobr></td>\n";
        
		echo "<td align='center'><nobr>$reportcomment_total</nobr></td>\n";
        
		if($reportcomment_total > 0)
		{
          list($last_date) = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT `date_commented` 
		  
		  FROM `".$network_prefix."_reports_comments` 
		  
		  WHERE `report_id`='$report_id' ORDER BY `date_commented` desc"));
          
		  $last_date = date($pj_config['report_date_format'], $last_date);    
        } 
		else 
		{
          $last_date = _NETWORK_NA;
        }
        echo "<td align='center'><nobr>$last_date</nobr></td>\n</tr>\n";
      }
    } 
	else 
	{
      echo "<tr>\n<td align='center' colspan='7' width='100%'><nobr>"._NETWORK_NOPROJECTREPORTS."</nobr></td>\n</tr>\n";
    }
    echo "</table>\n";
    CloseTable();
  }
}
include_once(NUKE_BASE_DIR.'footer.php');
?>
