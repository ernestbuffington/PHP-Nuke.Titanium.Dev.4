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
$type = pjreporttype_info($type_id);
$db2->sql_query("DELETE FROM `".$network_prefix."_reports_types` WHERE `type_id`='$type_id'");
$db2->sql_query("UPDATE `".$network_prefix."_reports` SET `type_id`='$swap_type_id' WHERE `type_id`='$type_id'");
$typeresult = $db2->sql_query("SELECT `type_id`, `type_weight` FROM `".$network_prefix."_reports_types` WHERE `type_weight`>='".$type['type_weight']."'");
while(list($p_id, $weight) = $db2->sql_fetchrow($typeresult)) {
    $new_weight = $weight - 1;
    $db2->sql_query("UPDATE `".$network_prefix."_reports_types` SET `type_weight`='$new_weight' WHERE `type_id`='$p_id'");
}
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports_types`");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports`");
header("Location: ".$admin_file.".php?op=ReportTypeList");

?>