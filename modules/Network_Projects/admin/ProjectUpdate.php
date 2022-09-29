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

$project_name = htmlentities($project_name, ENT_QUOTES);

$project_description = htmlentities($project_description, ENT_QUOTES);

if($project_site == "http://") 
$project_site = ""; 

$priority_id = intval($priority_id);

$status_id = intval($status_id);

$project_percent = intval($project_percent);

$featured = intval($featured);

$project_id = intval($project_id);

$phpbb2_start_date = "$project_start_year-$project_start_month-$project_start_day";

if($phpbb2_start_date == "0000-00-00") 
  $phpbb2_start_date = 0; 
else 
  $phpbb2_start_date = strtotime($phpbb2_start_date); 

$finish_date = "$project_finish_year-$project_finish_month-$project_finish_day";

if($finish_date == "0000-00-00") 
  $finish_date = 0; 
else 
  $finish_date = strtotime($finish_date); 

$titanium_db2->sql_query("UPDATE `".$network_prefix."_projects` SET `project_name`='$project_name', `project_description`='$project_description', `project_site`='$project_site', `priority_id`='$priority_id', `status_id`='$status_id', `project_percent`='$project_percent', `featured`='$featured', `allowreports`='$allowreports', `allowrequests`='$allowrequests', `date_started`='$phpbb2_start_date', `date_finished`='$finish_date' WHERE `project_id`='$project_id'");

$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_projects`");

if(implode("", $member_ids) > ""): 
  while(list($null, $member_id) = each($member_ids)): 
    $numrows = $titanium_db2->sql_numrows($titanium_db2->sql_query("SELECT * FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id' AND `member_id`='$member_id'"));
    if($numrows == 0)
    $titanium_db2->sql_query("INSERT INTO `".$network_prefix."_projects_members` VALUES ('$project_id', '$member_id', '".$pj_config['new_project_position']."')");        
  endwhile;
endif;
header("Location: ".$admin_file.".php?op=ProjectEdit&project_id=$project_id");
?>
