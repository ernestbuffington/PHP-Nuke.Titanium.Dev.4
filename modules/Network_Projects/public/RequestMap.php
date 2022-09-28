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

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_REQUESTMAP;

include_once(NUKE_BASE_DIR.'header.php');

$projectresult = $titanium_db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` ORDER BY `weight`");

while(list($project_id) = $titanium_db2->sql_fetchrow($projectresult)) 
{
  $project = pjproject_info($project_id);
  $projectstatus = pjprojectstatus_info($project['status_id']);
  $projectpriority = pjprojectpriority_info($project['priority_id']);

  if($project['allowrequests'] > 0) 
  {
    $requestresult = $titanium_db2->sql_query("SELECT `request_id`, 
	                                                `request_name`, 
													   `status_id`, 
													     `type_id` 
														 
	FROM `".$network_prefix."_requests` 
	
	WHERE `project_id`='$project_id' ORDER BY `request_name`");
    
	$request_total = $titanium_db2->sql_numrows($requestresult);
    
	OpenTable();
    
	echo '<div align="center"><strong>'._NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_REQUESTMAP.'</strong></div>';
    
	echo '<div align="center">';
    echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> ';
    echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> ';
    echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> ';
    echo '<a class="titaniumbutton" href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a>';
    echo '</div><br/>';
    
	echo "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
    echo "<tr>\n<td bgcolor='$bgcolor2' colspan='2' width='100%'><strong>"._NETWORK_PROJECT."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_SITE."</strong></nobr></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_STATUS."</strong></nobr></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_PRIORITY."</strong></nobr></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_REQUESTS."</strong></nobr></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_LASTSUBMISSION."</strong></nobr></td>\n</tr>\n";
    
	$pjimage = pjimage("project.png", $titanium_module_name);
    
	if($project['featured'] > 0) 
	{ 
	  $project['project_name'] = "<strong>".$project['project_name']."</strong>"; 
	}
    
	echo "<tr>\n<td align='center'><img src='$pjimage'></td>\n";
    echo "<td width='100%'><a href='modules.php?name=$titanium_module_name&amp;op=Project&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
    
	if($project['project_site'] > "") 
	{
      # got rid of the image and used in inline style to create a button effect! 09/27/2022 Bob Marion aka NukeSheriff START
      $pjimage = "<i style=\"font-size: 25px; color: #45B39D\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#45B39D'\" class=\"bi bi-server\"></i>";
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
    echo "<td align='center'><nobr>$request_total</nobr></td>\n";
    
	if($request_total > 0)
	{
      list($last_date) = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT `date_submitted` 
	  
	  FROM `".$network_prefix."_requests` WHERE `project_id`='$project_id' ORDER BY `date_submitted` desc"));
      
	  $last_date = date($pj_config['request_date_format'], $last_date);
    } 
	else 
	{
     $last_date = _NETWORK_NA;
    }
    
	echo "<td align='center'><nobr>$last_date</nobr></td>\n</tr>\n";
    
	echo "<tr>\n<td bgcolor='$bgcolor2' colspan='3'><strong>"._NETWORK_REQUESTS."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_STATUS."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_TYPE."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_COMMENTS."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_LASTSUBMISSION."</strong></td>\n</tr>\n";
    
	if($request_total != 0)
	{
    
	  while(list($request_id, $request_name, $status_id, $type_id) = $titanium_db2->sql_fetchrow($requestresult)) 
	  {
        $requestcommentresult = $titanium_db2->sql_query("SELECT `request_id` FROM `".$network_prefix."_requests_comments` WHERE `request_id`='$request_id'");
      
	    $requestcomment_total = $titanium_db2->sql_numrows($requestcommentresult);
      
	    $requeststatus = pjrequeststatus_info($status_id);
      
	    $requesttype = pjrequesttype_info($type_id);
      
	    if(empty($request_name)) 
		{ 
		  $request_name = "----------"; 
		}
        
		$pjimage = pjimage("request.png", $titanium_module_name);
        echo "<tr>\n<td><img src='$pjimage'></td>\n";
        echo "<td width='100%' colspan='2'><a href='modules.php?name=$titanium_module_name&amp;op=Request&amp;request_id=$request_id'>$request_name</a></td>\n";
        
		if(empty($requeststatus['status_name']))
		{ 
		  $requeststatus['status_name'] = _NETWORK_NA; 
		}
        echo "<td align='center'><nobr>".$requeststatus['status_name']."</nobr></td>\n";
        
		if(empty($requestpriority['priority_name']))
		{ 
		  $requestpriority['priority_name'] = _NETWORK_NA; 
		}
		echo "<td align='center'><nobr>".$requestpriority['priority_name']."</nobr></td>\n";
        echo "<td align='center'><nobr>$requestcomment_total</nobr></td>\n";

        if($requestcomment_total > 0)
		{
          list($last_date) = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT `date_commented` 
		  
		  FROM `".$network_prefix."_requests_comments` WHERE `request_id`='$request_id' ORDER BY `date_commented` desc"));
          
		  $last_date = date($pj_config['request_date_format'], $last_date);
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
      echo "<tr>\n<td align='center' colspan='7' width='100%'><nobr>"._NETWORK_NOPROJECTREQUESTS."</nobr></td>\n</tr>\n";
    }
    echo "</table>\n";
    CloseTable();
  }
}
include_once(NUKE_BASE_DIR.'footer.php');
?>
