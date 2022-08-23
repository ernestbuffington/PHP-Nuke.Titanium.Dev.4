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
$report_id = intval($report_id);
$report = pjreport_info($report_id);
$db2->sql_query("DELETE FROM `".$network_prefix."_reports` WHERE `report_id`='$report_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports`");
$db2->sql_query("DELETE FROM `".$network_prefix."_reports_comments` WHERE `report_id`='$report_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports_comments`");
$db2->sql_query("DELETE FROM `".$network_prefix."_reports_members` WHERE `report_id`='$report_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports_members`");
header("Location: modules.php?name=$module_name&op=Project&project_id=".$report['project_id']);

?>