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
$result = $db2->sql_query("SELECT * FROM `".$network_prefix."_members_positions` WHERE `position_weight`>'0' ORDER BY `position_id` ASC");
$weight = 0;
while($row = $db2->sql_fetchrow($result)) {
  $xid = intval($row['position_id']);
  $weight++;
  $db2->sql_query("UPDATE `".$network_prefix."_members_positions` SET `position_weight`='$weight' WHERE `position_id`='$xid'");
}
header("Location: ".$admin_file.".php?op=MemberPositionList");

?>