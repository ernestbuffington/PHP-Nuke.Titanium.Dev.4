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
$priority_id = intval($priority_id);
if($priority_id < 1) { header("Location: ".$admin_file.".php?op=ProjectPriorityList"); }
$priority_name = htmlentities($priority_name, ENT_QUOTES);
$db2->sql_query("UPDATE `".$network_prefix."_projects_priorities` SET `priority_name`='$priority_name' WHERE `priority_id`='$priority_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_projects_priorities`");
header("Location: ".$admin_file.".php?op=ProjectPriorityList");

?>