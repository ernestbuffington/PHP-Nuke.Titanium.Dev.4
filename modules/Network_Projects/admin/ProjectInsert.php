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

$date = time();

$project_name = htmlentities($project_name, ENT_QUOTES);

$project_description = htmlentities($project_description, ENT_QUOTES);

if($project_site == "http://") 
  $project_site = ""; 

$priority_id = intval($priority_id);

$status_id = intval($status_id);

$project_percent = intval($project_percent);

$featured = intval($featured);

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

$result = $titanium_db2->sql_query("SELECT `weight` FROM `".$network_prefix."_projects` ORDER BY `weight` DESC");

if(!$result): 
  $weight = 1;
else: 
  list($lweight) = $titanium_db2->sql_fetchrow($result);
  $weight = $lweight + 1;
endif;

$titanium_db2->sql_query("INSERT INTO `".$network_prefix."_projects` VALUES (NULL, '$project_name', '$project_description', '$project_site', '$priority_id', '$status_id', '$project_percent', '$weight', '$featured', '$allowreports', '$allowrequests', '$date', '$phpbb2_start_date', '$finish_date')");

$projectresult = $titanium_db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` WHERE `date_created`='$date'");

list($project_id) = $titanium_db2->sql_fetchrow($projectresult);

if(implode("", $member_ids) > ""):  

  while(list($null, $member_id) = each($member_ids)): 
    $numrows = $titanium_db2->sql_numrows($titanium_db2->sql_query("SELECT * FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id' AND `member_id`='$member_id'"));
	if($numrows == 0) 
      $titanium_db2->sql_query("INSERT INTO `".$network_prefix."_projects_members` VALUES ('$project_id', '$member_id', '".$pj_config['new_project_position']."')");        
  endwhile;
endif;

header("Location: ".$admin_file.".php?op=ProjectList&project_id=$project_id");
?>
