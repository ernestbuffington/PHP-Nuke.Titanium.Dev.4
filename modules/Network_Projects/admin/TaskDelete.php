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
$task_id = intval($task_id);
$task = pjtask_info($task_id);
$titanium_db2->sql_query("DELETE FROM `".$network_prefix."_tasks` WHERE `task_id`='$task_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_tasks`");
$titanium_db2->sql_query("DELETE FROM `".$network_prefix."_tasks_members` WHERE `task_id`='$task_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_tasks_members`");
header("Location: modules.php?name=$titanium_module_name&op=Project&project_id=".$task['project_id']);

?>