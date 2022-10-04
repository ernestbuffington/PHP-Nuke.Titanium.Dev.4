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
$result = $pnt_db2->sql_query("SELECT * FROM `".$network_prefix."_reports_types` WHERE `type_weight`>'0' ORDER BY `type_id` ASC");
$weight = 0;
while($row = $pnt_db2->sql_fetchrow($result)) {
  $xid = intval($row['type_id']);
  $weight++;
  $pnt_db2->sql_query("UPDATE `".$network_prefix."_reports_types` SET `type_weight`='$weight' WHERE `type_id`='$xid'");
}
header("Location: ".$admin_file.".php?op=PJREportTypeList");

?>