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
$status_name = htmlentities($status_name, ENT_QUOTES);
$result = $db2->sql_query("SELECT `status_weight` FROM `".$network_prefix."_reports_status` ORDER BY `status_weight` DESC");
list($lweight) = $db2->sql_fetchrow($result);
$weight = $lweight + 1;
if($weight < 1) { $weight = 1; }
$db2->sql_query("INSERT INTO `".$network_prefix."_reports_status` VALUES (NULL, '$status_name', '$weight')");
header("Location: ".$admin_file.".php?op=ReportStatusList");

?>