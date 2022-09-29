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

if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }

$position_id = intval($position_id);

if($position_id < 1) 
{ 
  header("Location: ".$admin_file.".php?op=MemberPositionList"); 
}

$position = pjmemberposition_info($position_id);
$titanium_db2->sql_query("DELETE FROM `".$network_prefix."_members_positions` WHERE `position_id`='$position_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_members_positions`");
$titanium_db2->sql_query("UPDATE `".$network_prefix."_projects_members` SET `position_id`='$swap_position_id' WHERE `position_id`='$position_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_projects_members`");
$titanium_db2->sql_query("UPDATE `".$network_prefix."_reports_members` SET `position_id`='$swap_position_id' WHERE `position_id`='$position_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports_members`");
$titanium_db2->sql_query("UPDATE `".$network_prefix."_requests_members` SET `position_id`='$swap_position_id' WHERE `position_id`='$position_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_requests_members`");
$titanium_db2->sql_query("UPDATE `".$network_prefix."_tasks_members` SET `position_id`='$swap_position_id' WHERE `position_id`='$position_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_tasks_members`");
$positionresult = $titanium_db2->sql_query("SELECT `position_id`, `position_weight` FROM `".$network_prefix."_members_positions` WHERE `position_weight`>='".$position['position_weight']."'");

while(list($p_id, $weight) = $titanium_db2->sql_fetchrow($projectresult)) 
{
  $new_weight = $weight - 1;
  $titanium_db2->sql_query("UPDATE `".$network_prefix."_members_positions` SET `position_weight`='$new_weight' WHERE `position_id`='$p_id'");
  $titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_members_positions`");
}

header("Location: ".$admin_file.".php?op=MemberPositionList");
?>
