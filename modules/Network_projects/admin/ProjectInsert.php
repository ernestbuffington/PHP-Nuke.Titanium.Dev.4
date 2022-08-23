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
get_lang('Network_Projects');
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$date = time();
$project_name = htmlentities($project_name, ENT_QUOTES);
$project_description = htmlentities($project_description, ENT_QUOTES);
$project_site = str_replace("http://", "", strtolower($project_site));
$project_site = "http://".htmlentities($project_site, ENT_QUOTES);
if($project_site == "http://") { $project_site = ""; }
$priority_id = intval($priority_id);
$status_id = intval($status_id);
$project_percent = intval($project_percent);
$featured = intval($featured);
$start_date = "$project_start_year-$project_start_month-$project_start_day";
if($start_date == "0000-00-00") { $start_date = 0; } else { $start_date = strtotime($start_date); }
$finish_date = "$project_finish_year-$project_finish_month-$project_finish_day";
if($finish_date == "0000-00-00") { $finish_date = 0; } else { $finish_date = strtotime($finish_date); }
$result = $db2->sql_query("SELECT `weight` FROM `".$network_prefix."_projects` ORDER BY `weight` DESC");
if(!$result) {
  $weight = 1;
} else {
  list($lweight) = $db2->sql_fetchrow($result);
  $weight = $lweight + 1;
}
$db2->sql_query("INSERT INTO `".$network_prefix."_projects` VALUES (NULL, '$project_name', '$project_description', '$project_site', '$priority_id', '$status_id', '$project_percent', '$weight', '$featured', '$allowreports', '$allowrequests', '$date', '$start_date', '$finish_date')");
$projectresult = $db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` WHERE `date_created`='$date'");
list($project_id) = $db2->sql_fetchrow($projectresult);
if(implode("", $member_ids) > "") {
  while(list($null, $member_id) = each($member_ids)) {
    $numrows = $db2->sql_numrows($db2->sql_query("SELECT * FROM `".$network_prefix."_projects_members` WHERE `project_id`='$project_id' AND `member_id`='$member_id'"));
    if($numrows == 0) {
      $db2->sql_query("INSERT INTO `".$network_prefix."_projects_members` VALUES ('$project_id', '$member_id', '".$pj_config['new_project_position']."')");        
    }
  }
}
header("Location: ".$admin_file.".php?op=ProjectList&project_id=$project_id");

?>