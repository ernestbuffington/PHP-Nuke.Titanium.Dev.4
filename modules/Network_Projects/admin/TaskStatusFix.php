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
$result = $titanium_db2->sql_query("SELECT * FROM `".$network_prefix."_tasks_status` WHERE `status_weight`>'0' ORDER BY `status_id` ASC");
$weight = 0;
while($row = $titanium_db2->sql_fetchrow($result)) {
  $xid = intval($row['status_id']);
  $weight++;
  $titanium_db2->sql_query("UPDATE `".$network_prefix."_tasks_status` SET `status_weight`='$weight' WHERE `status_id`='$xid'");
}
header("Location: ".$admin_file.".php?op=TaskStatusList");

?>