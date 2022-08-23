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
$date = time();
$report_name = htmlentities($report_name, ENT_QUOTES);
$report_description = htmlentities($report_description, ENT_QUOTES);
$submitter_name = htmlentities($submitter_name, ENT_QUOTES);
$db2->sql_query("UPDATE `".$network_prefix."_reports` SET `project_id`='$project_id', `type_id`='$type_id', `report_name`='$report_name', `report_description`='$report_description', `submitter_name`='$submitter_name', `submitter_email`='$submitter_email', `status_id`='$status_id', `date_modified`='$date' WHERE `report_id`='$report_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports`");
if(implode("", $member_ids) > "") {
  while(list($null, $member_id) = each($member_ids)) {
    $numrows = $db2->sql_numrows($db2->sql_query("SELECT * FROM `".$network_prefix."_reports_members` WHERE `report_id`='$report_id' AND `member_id`='$member_id'"));
    if($numrows == 0) {
      $db2->sql_query("INSERT INTO `".$network_prefix."_reports_members` VALUES ('$report_id', '$member_id', '".$pj_config['new_report_position']."')");
    }
  }
}
list($submitter_email) = $db2->sql_fetchrow($db2->sql_query("SELECT `submitter_email` FROM `".$network_prefix."_reports` WHERE `report_id`='$report_id'"));
$admin_email = $adminmail;
$subject = _NETWORK_NEWREPORTUPDATEDS;
$message = _NETWORK_NEWREPORTUPDATED.":\r\n$nukeurl/modules.php?name=$module_name&op=Report&amp;report_id=$report_id";
$from  = "From: $admin_email\r\n";
$from .= "Reply-To: $admin_email\r\n";
$from .= "Return-Path: $admin_email\r\n";
if($pj_config['notify_report_admin'] == 1) { @evo_mail($admin_email, $subject, $message, $from); }
if($pj_config['notify_report_submitter'] == 1) { @evo_mail($submitter_email, $subject, $message, $from); }
header("Location: ".$admin_file.".php?op=ReportEdit&report_id=$report_id");

?>