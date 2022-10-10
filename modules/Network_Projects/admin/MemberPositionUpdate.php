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
$position_id = intval($position_id);
if($position_id < 1) { header("Location: ".$admin_file.".php?op=MemberPositionList"); }
$position_name = htmlentities($position_name, ENT_QUOTES);
$db2->sql_query("UPDATE `".$network_prefix."_members_positions` SET `position_name`='$position_name' WHERE `position_id`='$position_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_members_positions`");
header("Location: ".$admin_file.".php?op=MemberPositionList");

?>