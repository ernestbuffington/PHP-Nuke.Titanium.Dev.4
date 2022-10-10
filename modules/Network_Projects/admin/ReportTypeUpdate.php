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
$type_id = intval($type_id);
if($type_id < 1) { header("Location: ".$admin_file.".php?op=RequestTypeList"); }
$type_name = htmlentities($type_name, ENT_QUOTES);
$db2->sql_query("UPDATE `".$network_prefix."_reports_types` SET `type_name`='$type_name'  WHERE `type_id`='$type_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports_types`");
header("Location: ".$admin_file.".php?op=ReportTypeList");

?>