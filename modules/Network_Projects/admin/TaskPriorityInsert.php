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
global $pnt_db2;
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$priority_name = htmlentities($priority_name, ENT_QUOTES);
$result = $pnt_db2->sql_query("SELECT `priority_weight` FROM `".$network_prefix."_tasks_priorities` ORDER BY `priority_weight` DESC");
list($lweight) = $pnt_db2->sql_fetchrow($result);
$weight = $lweight + 1;
if($weight < 1) { $weight = 1; }
$pnt_db2->sql_query("INSERT INTO `".$network_prefix."_tasks_priorities` VALUES (NULL, '$priority_name', '$weight')");
header("Location: ".$admin_file.".php?op=TaskPriorityList");

?>