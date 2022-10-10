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
$member_id = intval($member_id);
$db2->sql_query("DELETE FROM `".$network_prefix."_members` WHERE `member_id`='$member_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_members`");
$db2->sql_query("UPDATE `".$network_prefix."_projects_members` SET `member_id`='$swap_member_id' WHERE `member_id`='$member_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_projects_members`");
$db2->sql_query("UPDATE `".$network_prefix."_tasks_members` SET `member_id`='$swap_member_id' WHERE `member_id`='$member_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_tasks_members`");
$db2->sql_query("UPDATE `".$network_prefix."_reports_members` SET `member_id`='$swap_member_id' WHERE `member_id`='$member_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports_members`");
$db2->sql_query("UPDATE `".$network_prefix."_requests_members` SET `member_id`='$swap_member_id' WHERE `member_id`='$member_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_requests_members`");
header("Location: ".$admin_file.".php?op=MemberList");
?>