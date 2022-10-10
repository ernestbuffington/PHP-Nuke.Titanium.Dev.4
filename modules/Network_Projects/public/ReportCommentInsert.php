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
if(!defined('SUPPORT_NETWORK')) { die("Illegal Access Detected!!!"); }
$report_id = intval($report_id);
$report = pjreport_info($report_id);
$project = pjproject_info($report['project_id']);
if($project['allowreports'] > 0) {
  $date = time();
  $stop = "";
  $commenter_ip = $_SERVER['REMOTE_ADDR'];
  if((!$commenter_name) || (empty($commenter_name))) $stop = "<center>"._NETWORK_ERRORNONAME."</center><br />\n";
  if((!$commenter_email) || (empty($commenter_email))) $stop = "<center>"._NETWORK_ERRORNOEMAIL."</center><br />\n";
  if((!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$commenter_email))) $stop = "<center>"._NETWORK_ERRORINVALIDEMAIL."</center><br />\n";
  if((!$comment_description) || (empty($comment_description))) $stop = "<center>"._NETWORK_ERRORNOCOMMENT."</center><br />\n";
  if(empty($stop)) {
    $report_id = intval($report_id);
    $commenter_name = htmlentities($commenter_name, ENT_QUOTES);
    $comment_description = htmlentities($comment_description, ENT_QUOTES);
    $db2->sql_query("INSERT INTO `".$network_prefix."_reports_comments` VALUES (NULL, '$report_id', '$commenter_name', '$commenter_email', '$commenter_ip', '$comment_description', '$date')");
    $db2->sql_query("UPDATE `".$network_prefix."_reports` SET `date_commented`='$date' WHERE `report_id`='$report_id'");
    list($submitter_email) = $db2->sql_fetchrow($db2->sql_query("SELECT `submitter_email` FROM `".$network_prefix."_reports` WHERE `report_id`='$report_id'"));
    $admin_email = $adminmail;
    $subject = _NETWORK_NEWREPORTCOMMENTS;
    $message = _NETWORK_NEWREPORTCOMMENT.":\r\n$nukeurl/modules.php?name=$module_name&op=Report&report_id=$report_id";
    $from  = "From: $admin_email\r\n";
    $from .= "Reply-To: $admin_email\r\n";
    $from .= "Return-Path: $admin_email\r\n";
    if($pj_config['notify_report_admin'] == 1) { evo_mail($admin_email, $subject, $message, $from); }
    if($pj_config['notify_report_submitter'] == 1) { evo_mail($submitter_email, $subject, $message, $from); }
    header("Location: modules.php?name=$module_name&op=Report&report_id=$report_id");
  } else {
    $pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']." ::: "._NETWORK_COMMENTADD." ::: ";
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo '<div align="center"><strong>'._NETWORK_TITLE." v".$pj_config['version_number']." ::: "._NETWORK_COMMENTADD." ::: ".'</strong></div><br />';
    echo "<center><strong>"._NETWORK_ERRORCOMMENT."</strong><br />\n";
    echo "$stop<br />\n";
    echo _NETWORK_RETURN."</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
  }
} else {
  header("Location: modules.php?name=$module_name");
}

?>