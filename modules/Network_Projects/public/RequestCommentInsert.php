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
$request_id = intval($request_id);
$request = pjrequest_info($request_id);
$project = pjproject_info($request['project_id']);
if($project['allowrequests'] > 0) {
  $date = time();
  $stop = "";
  $commenter_ip = $_SERVER['REMOTE_ADDR'];
  if((!$commenter_name) || (empty($commenter_name))) $stop = "<center>"._NETWORK_ERRORNONAME."</center><br />\n";
  if((!$commenter_email) || (empty($commenter_email))) $stop = "<center>"._NETWORK_ERRORNOEMAIL."</center><br />\n";
  if((!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$commenter_email))) $stop = "<center>"._NETWORK_ERRORINVALIDEMAIL."</center><br />\n";
  if((!$comment_description) || (empty($comment_description))) $stop = "<center>"._NETWORK_ERRORNOCOMMENT."</center><br />\n";
  if(empty($stop)) {
    $commenter_name = htmlentities($commenter_name, ENT_QUOTES);
    $comment_description = htmlentities($comment_description, ENT_QUOTES);
    $db2->sql_query("INSERT INTO `".$network_prefix."_requests_comments` VALUES (NULL, '$request_id', '$commenter_name', '$commenter_email', '$commenter_ip', '$comment_description', '$date')");
    $db2->sql_query("UPDATE `".$network_prefix."_requests` SET `date_commented`='$date' WHERE `request_id`='$request_id'");
    list($submitter_email) = $db2->sql_fetchrow($db2->sql_query("SELECT `submitter_email` FROM `".$network_prefix."_requests` WHERE `request_id`='$request_id'"));
    $admin_email = $adminmail;
    $subject = _NETWORK_NEWREQUESTCOMMENTS;
    $message = _NETWORK_NEWREQUESTCOMMENT.":\r\n$nukeurl/modules.php?name=$module_name&amp;op=Request&amp;request_id=$request_id";
    $from  = "From: $admin_email\r\n";
    $from .= "Reply-To: $admin_email\r\n";
    $from .= "Return-Path: $admin_email\r\n";
    if($pj_config['notify_request_admin'] == 1) { evo_mail($admin_email, $subject, $message, $from); }
    if($pj_config['notify_request_submitter'] == 1) { evo_mail($submitter_email, $subject, $message, $from); }
    header("Location: modules.php?name=$module_name&op=Request&request_id=$request_id");
  } else {
    $pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']." ::: "._NETWORK_COMMENTADD." ::: ";
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo '<div align="center"><strong>'._NETWORK_TITLE." v".$pj_config['version_number']." ::: "._NETWORK_COMMENTADD." ::: ".'</strong></div>';
    echo '<div align="center">';
    echo '[ <a href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> | ';
    echo '<a href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> | ';
    echo '<a href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> | ';
    echo '<a href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a> ]';
    echo '</div><br/>';
	
	echo _NETWORK_ERRORCOMMENT."<br />\n";
    echo "$stop<br />\n";
    echo _NETWORK_RETURN;
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
  }
} else {
  header("Location: modules.php?name=$module_name");
}

?>