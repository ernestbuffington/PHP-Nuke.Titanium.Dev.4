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
get_lang('Network_Projects');
if(!defined('SUPPORT_NETWORK')) { die("Illegal Access Detected!!!"); }
$project_id = intval($project_id);
$project = pjproject_info($project_id);
if($project['allowrequests'] > 0) {
  $status_id = $pj_config['new_request_status'];
  $date = time();
  $stop = "";
  $submitter_ip = $_SERVER['REMOTE_ADDR'];
  if((!$submitter_name) || (empty($submitter_name))) $stop = "<center>"._NETWORK_ERRORNONAME."</center><br />\n";
  if((!$submitter_email) || (empty($submitter_email))) $stop = "<center>"._NETWORK_ERRORNOEMAIL."</center><br />\n";
  if((!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/",$submitter_email))) $stop = "<center>"._NETWORK_ERRORINVALIDEMAIL."</center><br />\n";
  if((!$request_name) || (empty($request_name))) $stop = "<center>"._NETWORK_ERRORNOSUMMARY."</center><br />\n";
  if((!$request_description) || (empty($request_description))) $stop = "<center>"._NETWORK_ERRORNODESCRIPTION."</center><br />\n";
  if(empty($stop)) {
    $type_id = intval($type_id);
    $submitter_name = htmlentities($submitter_name, ENT_QUOTES);
    $request_name = htmlentities($request_name, ENT_QUOTES);
    $request_description = htmlentities($request_description, ENT_QUOTES);
    $db2->sql_query("INSERT INTO `".$network_prefix."_requests` VALUES (NULL, '$project_id', '$type_id', '$status_id', '$request_name', '$request_description', '$submitter_name', '$submitter_email', '$submitter_ip', '$date', '0', '0')");
    list($request_id) = $db2->sql_fetchrow($db2->sql_query("SELECT `request_id` FROM `".$network_prefix."_requests` WHERE `date_submitted`='$date' AND `project_id`='$project_id' AND `type_id`='$type_id' AND `status_id`='$status_id' AND `request_name`='$request_name'"));
    if($pj_config['notify_request_admin'] == 1){
      $admin_email = $adminmail;
      $subject = _NETWORK_NEWREQUESTMESSAGES;
      $message = _NETWORK_NEWREQUESTMESSAGE.":\r\n$nukeurl/modules.php?name=$module_name&amp;op=Request&amp;request_id=$request_id";
      $from  = "From: $admin_email\r\n";
      $from .= "Reply-To: $admin_email\r\n";
      $from .= "Return-Path: $admin_email\r\n";
      evo_mail($admin_email, $subject, $message, $from);
    }
    header("Location: modules.php?name=$module_name&op=Request&request_id=$request_id");
  } else {
    $pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']." ::: "._NETWORK_REQUESTADD." ::: ";
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo '<div align="center"><strong>'._NETWORK_TITLE." v".$pj_config['version_number']." ::: "._NETWORK_REQUESTADD." ::: ".'</strong></div>';
    echo '<div align="center">';
    echo '[ <a href="modules.php?name=Network_Projects">' . _NETWORK_PROJECTLIST . '</a> | ';
    echo '<a href="modules.php?name=Network_Projects&op=TaskMap">' . _NETWORK_TASKMAP . '</a> | ';
    echo '<a href="modules.php?name=Network_Projects&op=ReportMap">' . _NETWORK_REPORTMAP . '</a> | ';
    echo '<a href="modules.php?name=Network_Projects&op=RequestMap">' . _NETWORK_REQUESTMAP . '</a> ]';
    echo '</div><br/>';
	
	echo _NETWORK_ERRORREQUEST."<br />\n";
    echo "$stop<br />\n";
    echo _NETWORK_RETURN;
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
  }
} else {
  header("Location: modules.php?name=$module_name");
}

?>