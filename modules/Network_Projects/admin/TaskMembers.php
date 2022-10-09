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
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
for($i = 0; $i < count($delete_member_ids); $i++){
  $db2->sql_query("DELETE FROM `".$network_prefix."_tasks_members` WHERE `member_id`='".$delete_member_ids[$i]."' AND `task_id`='$task_id'");
}
for($i = 0; $i < count($member_ids); $i++){
  $db2->sql_query("UPDATE `".$network_prefix."_tasks_members` SET `position_id`='".$position_ids[$i]."' WHERE `task_id`='$task_id' AND `member_id`='".$member_ids[$i]."'");
}
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_tasks_members`");
header("Location: ".$admin_file.".php?op=TaskEdit&task_id=$task_id");

?>