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
$request_name = htmlentities($request_name, ENT_QUOTES);
$request_description = htmlentities($request_description, ENT_QUOTES);
$submitter_name = htmlentities($submitter_name, ENT_QUOTES);
$db2->sql_query("UPDATE `".$network_prefix."_requests` SET `project_id`='$project_id', `type_id`='$type_id', `request_name`='$request_name', `request_description`='$request_description', `submitter_name`='$submitter_name', `submitter_email`='$submitter_email', `status_id`='$status_id', `date_modified`='$date' WHERE `request_id`='$request_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_requests`");
if(implode("", $member_ids) > "") {
  while(list($null, $member_id) = each($member_ids)) {
    $numrows = $db2->sql_numrows($db2->sql_query("SELECT * FROM `".$network_prefix."_requests_members` WHERE `request_id`='$request_id' AND `member_id`='$member_id'"));
    if($numrows == 0) {
      $db2->sql_query("INSERT INTO `".$network_prefix."_requests_members` VALUES ('$request_id', '$member_id', '".$pj_config['new_request_position']."')");
    }
  }
}
list($submitter_email) = $db2->sql_fetchrow($db2->sql_query("SELECT `submitter_email` FROM `".$network_prefix."_requests` WHERE `request_id`='$request_id'"));
$admin_email = $adminmail;
$subject = _NETWORK_NEWREQUESTUPDATEDS;
$message = _NETWORK_NEWREQUESTUPDATED.":\r\n$nukeurl/modules.php?name=$module_name&amp;op=Request&amp;request_id=$request_id";
$from  = "From: $admin_email\r\n";
$from .= "Reply-To: $admin_email\r\n";
$from .= "Return-Path: $admin_email\r\n";
if($pj_config['notify_request_admin'] == 1) { @evo_mail($admin_email, $subject, $message, $from); }
if($pj_config['notify_request_submitter'] == 1) { @evo_mail($submitter_email, $subject, $message, $from); }
header("Location: ".$admin_file.".php?op=RequestEdit&request_id=$request_id");

?>