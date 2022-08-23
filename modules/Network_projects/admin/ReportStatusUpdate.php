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
$status_id = intval($status_id);
if($status_id < 1) { header("Location: ".$admin_file.".php?op=RequestStatusList"); }
$status_name = htmlentities($status_name, ENT_QUOTES);
$db2->sql_query("UPDATE `".$network_prefix."_reports_status` SET `status_name`='$status_name' WHERE `status_id`='$status_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports_status`");
header("Location: ".$admin_file.".php?op=ReportStatusList");

?>