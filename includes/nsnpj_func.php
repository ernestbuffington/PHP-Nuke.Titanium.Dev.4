<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network      */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       10/25/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
global $db2;
define('NETWORK_SUPPORT_FUNC', true);
// Load required scripts

// Load required lang file
if(!isset($lang)) 
{ 
  $lang = $nuke_config['language']; 
}

if (!stristr("$lang", ".") AND file_exists(NUKE_LANGUAGE_DIR."nukeproject/lang-$lang.php")) 
{
  @require_once(NUKE_LANGUAGE_DIR."nukeproject/lang-$lang.php");
} 
else 
{
  @require_once(NUKE_LANGUAGE_DIR."nukeproject/lang-english.php");
}

function pjget_configs()
{
  if(defined('network')):
  global $network_prefix, $db2;
  $configresult = $db2->sql_query("SELECT `config_name`, `config_value` FROM `".$network_prefix."_config`");
  
  while(list($config_name, $config_value) = $db2->sql_fetchrow($configresult)) 
  {
    $config[$config_name] = $config_value;
  }
  
  return $config;
  endif;
}

// Load Config data
$pj_config = pjget_configs();

function pjadmin_menu($pjtitle="")
{
  global $pj_config, $bgcolor1, $bgcolor2, $admin_file;

  OpenTable();
  
  if(!empty($pjtitle)) 
  { 
    $pjtitle = "::: ". $pjtitle; 
  } 
  else 
  { 
    $pjtitle = "::: "._NETWORK_ADMIN." ::: "; 
  }

  echo "<center class='title'><strong>"._NETWORK_TITLE." ".$pj_config['version_number']." $pjtitle ::: </strong></center><br />\n";
  echo "<table border='1' align='center' width='100%' cellpadding='2' cellspacing='0'>\n";
  echo "<tr bgcolor='$bgcolor2'>\n";
  echo "<td align='center' valign='top' width='20%'>&nbsp;<strong><u>"._NETWORK_PROJECTS."</u></strong>&nbsp;</td>\n";
  echo "<td align='center' valign='top' width='20%'>&nbsp;<strong><u>"._NETWORK_TASKS."</u></strong>&nbsp;</td>\n";
  echo "<td align='center' valign='top' width='20%'>&nbsp;<strong><u>"._NETWORK_REPORTS."</u></strong>&nbsp;</td>\n";
  echo "<td align='center' valign='top' width='20%'>&nbsp;<strong><u>"._NETWORK_REQUESTS."</u></strong>&nbsp;</td>\n";
  echo "<td align='center' valign='top' width='20%'>&nbsp;<strong><u>"._NETWORK_MEMBERS."</u></strong>&nbsp;</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td align='center' valign='top' width='20%' rowspan='3'>\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=ProjectConfig'>"._NETWORK_CONFIG."</a>&nbsp;<br />\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=ProjectList'>"._NETWORK_PROJECTLIST."</a>&nbsp;<br />\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=ProjectPriorityList'>"._NETWORK_PRIORITYLIST."</a>&nbsp;<br />\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=ProjectStatusList'>"._NETWORK_STATUSLIST."</a>&nbsp;<br />\n";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='20%' rowspan='3'>\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=TaskConfig'>"._NETWORK_CONFIG."</a>&nbsp;<br />\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=TaskList'>"._NETWORK_TASKLIST."</a>&nbsp;<br />\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=TaskPriorityList'>"._NETWORK_PRIORITYLIST."</a>&nbsp;<br />\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=TaskStatusList'>"._NETWORK_STATUSLIST."</a>&nbsp;<br />\n";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='20%' rowspan='3'>";
  echo "&nbsp;<a href='".$admin_file.".php?op=ReportConfig'>"._NETWORK_CONFIG."</a>&nbsp;<br />";
  echo "&nbsp;<a href='".$admin_file.".php?op=ReportList'>"._NETWORK_REPORTLIST."</a>&nbsp;<br />";
  echo "&nbsp;<a href='".$admin_file.".php?op=ReportStatusList'>"._NETWORK_STATUSLIST."</a>&nbsp;<br />";
  echo "&nbsp;<a href='".$admin_file.".php?op=ReportTypeList'>"._NETWORK_TYPELIST."</a>&nbsp;<br />";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='20%' rowspan='3'>";
  echo "&nbsp;<a href='".$admin_file.".php?op=RequestConfig'>"._NETWORK_CONFIG."</a>&nbsp;<br />";
  echo "&nbsp;<a href='".$admin_file.".php?op=RequestList'>"._NETWORK_REQUESTLIST."</a>&nbsp;<br />";
  echo "&nbsp;<a href='".$admin_file.".php?op=RequestStatusList'>"._NETWORK_STATUSLIST."</a>&nbsp;<br />";
  echo "&nbsp;<a href='".$admin_file.".php?op=RequestTypeList'>"._NETWORK_TYPELIST."</a>&nbsp;<br />";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='20%'>";
  echo "&nbsp;<a href='".$admin_file.".php?op=MemberList'>"._NETWORK_MEMBERLIST."</a>&nbsp;<br />\n";
  echo "&nbsp;<a href='".$admin_file.".php?op=MemberPositionList'>"._NETWORK_POSITIONLIST."</a>&nbsp;<br />\n";
  echo "&nbsp;&nbsp;<br />\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "<tr bgcolor='$bgcolor2'>\n";
  echo "<td align='center' valign='top' width='20%'><strong>"._NETWORK_GENERAL."</strong></td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td align='center' valign='top' width='20%'>";
  echo "&nbsp;<a href='".$admin_file.".php?op=Config'>"._NETWORK_GENCONFIG."</a>&nbsp;<br />\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
  CloseTable();
}

function pjimage($imgfile, $module_name) 
{
  $ThemeSel = get_theme();
  if(file_exists("themes/$ThemeSel/images/$module_name/$imgfile")) 
    $pjimage = "themes/$ThemeSel/images/$module_name/$imgfile";
  else 
    $pjimage = "modules/$module_name/images/$imgfile";

  return($pjimage);
}

function pjprogress($percent) {
  global $module_name;
  $pjimage = pjimage("bar_left.png", $module_name);
  $wbprogress  = "<img src='$pjimage' width='1' height='7'>";
  if($percent == 0){
    $pjimage = pjimage("bar_center_red.png", $module_name);
    $wbprogress .= "<img src='$pjimage' width='100' height='7' alt='0"._NETWORK_PERCENT." "._NETWORK_COMPLETED."' title='0"._NETWORK_PERCENT." "._NETWORK_COMPLETED."'>";
  } else {
    if($percent > 100){ $progress = 100; } else { $progress = $percent; }
    $pjimage = pjimage("bar_center_grn.png", $module_name);
    $wbprogress .= "<img src='$pjimage' width='".$progress."' height=7 alt='".$progress.""._NETWORK_PERCENT." "._NETWORK_COMPLETED."' title='".$progress.""._NETWORK_PERCENT." "._NETWORK_COMPLETED."'>";
    if($progress < 100){
      $incomplete = 100 - $progress;
      $pjimage = pjimage("bar_center_red.png", $module_name);
      $wbprogress .= "<img src='$pjimage' width='".$incomplete."' height=7 alt='".$progress.""._NETWORK_PERCENT." "._NETWORK_COMPLETED."' title='".$progress.""._NETWORK_PERCENT." "._NETWORK_COMPLETED."'>";
    }
  }
  $pjimage = pjimage("bar_right.png", $module_name);
  $wbprogress .= "<img src='$pjimage' width='1' height='7'>";
  return($wbprogress);
}

function pjmember_info($member_id){
  global $network_prefix, $db2;
  $member_id = intval($member_id);
  $member = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_members` WHERE `member_id`='$member_id'"));
  return $member;
}

function pjmemberposition_info($position_id){
  global $network_prefix, $db2;
  $position_id = intval($position_id);
  $position = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_members_positions` WHERE `position_id`='$position_id'"));
  return $position;
}

function pjproject_info($project_id){
  global $network_prefix, $db2;
  $project_id = intval($project_id);
  $project = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_projects` WHERE `project_id`='$project_id'"));
  return $project;
}

function pjprojectpriority_info($priority_id)
{
  global $network_prefix, $db2;
  $priority_id = intval($priority_id);
  $priority = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_projects_priorities` WHERE `priority_id`='$priority_id'"));
  return $priority;
}

function pjprojectstatus_info($status_id){
  global $network_prefix, $db2;
  $status_id = intval($status_id);
  $status = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_projects_status` WHERE `status_id`='$status_id'"));
  return $status;
}

function pjtask_info($task_id){
  global $network_prefix, $db2;
  $task_id = intval($task_id);
  $task = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_tasks` WHERE `task_id`='$task_id'"));
  return $task;
}

function pjtaskpriority_info($priority_id){
  global $network_prefix, $db2;
  $priority_id = intval($priority_id);
  $priority = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_tasks_priorities` WHERE `priority_id`='$priority_id'"));
  return $priority;
}

function pjtaskstatus_info($status_id){
  global $network_prefix, $db2;
  $status_id = intval($status_id);
  $status = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_tasks_status` WHERE `status_id`='$status_id'"));
  return $status;
}

function pjprojectpercent_info($project_id){
  global $network_prefix, $db2;
  $project_id = intval($project_id);
  $project = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_projects` WHERE `project_id`='$project_id'"));
  $percentresult = $db2->sql_query("SELECT `task_percent`, `priority_id` FROM `".$network_prefix."_tasks` WHERE `project_id`='$project_id'");
  $percentnumber = $db2->sql_numrows($percentresult);
  if($project['project_percent'] == 0 AND $percentnumber > 0) 
  {
    $percentoverall = $percentfactor = 0;
  
    while(list($task_percent, $priority_id) = $db2->sql_fetchrow($percentresult)) 
	{
      $taskpriority = pjtaskpriority_info($priority_id);
    
	  if($taskpriority['priority_weight'] > 0) 
	  {
        $percentoverall = $percentoverall + ($task_percent * $taskpriority['priority_weight']);
        $percentfactor = $percentfactor + $taskpriority['priority_weight'];
      }
    }
    if($percentnumber > 0 AND $percentfactor > 0) 
	{
      $percenttotal = $percentoverall / $percentfactor;
      $project['project_percent'] = number_format($percenttotal, 0, '.', ',');
    }
  }
  return $project;
}

function pjencode_email($email_address){
  $encoded = bin2hex("$email_address");
  $encoded = chunk_split($encoded, 2, '%');
  $encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);
  return $encoded;
}

function pjsave_config($config_name, $config_value)
{
  global $network_prefix, $db2;
  
  $resultnum = $db2->sql_numrows($db2->sql_query("SELECT * FROM `".$network_prefix."_config` WHERE `config_name`='$config_name'"));
  
  if($resultnum < 1) 
  {
    $db2->sql_query("INSERT INTO `".$network_prefix."_config` (`config_name`, `config_value`) VALUES ('$config_name', '$config_value')");
  } 
  else 
  {
    $db2->sql_query("UPDATE `".$network_prefix."_config` SET `config_value`='$config_value' WHERE `config_name`='$config_name'");
  }
   
   $db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_config`");
}

function pjunhtmlentities($string) {
  $trans_tbl = get_html_translation_table(HTML_ENTITIES);
  $trans_tbl = array_flip($trans_tbl);
  return strtr($string, $trans_tbl);
}

function pjreport_info($report_id){
  global $network_prefix, $db2;
  $report_id = intval($report_id);
  $report = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_reports` WHERE `report_id`='$report_id'"));
  return $report;
}

function pjreportcomment_info($comment_id)
{
  global $network_prefix, $db2;
  $comment_id = intval($comment_id);
  $reportcomment = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_reports_comments` WHERE `comment_id`='$comment_id'"));
  return $reportcomment;
}

function pjreportstatus_info($status_id){
  global $network_prefix, $db2;
  $status_id = intval($status_id);
  $reportstatus = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_reports_status` WHERE `status_id`='$status_id'"));
  return $reportstatus;
}

function pjreporttype_info($type_id){
  global $network_prefix, $db2;
  $type_id = intval($type_id);
  $reporttype = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_reports_types` WHERE `type_id`='$type_id'"));
  return $reporttype;
}

function pjrequest_info($request_id)
{
  global $network_prefix, $db2;
  $request_id = intval($request_id);
  $request = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_requests` WHERE `request_id`='$request_id'"));
  return $request;
}

function pjrequestcomment_info($comment_id){
  global $network_prefix, $db2;
  $comment_id = intval($comment_id);
  $requestcomment = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_requests_comments` WHERE `comment_id`='$comment_id'"));
  return $requestcomment;
}

function pjrequeststatus_info($status_id){
  global $network_prefix, $db2;
  $status_id = intval($status_id);
  $requeststatus = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_requests_status` WHERE `status_id`='$status_id'"));
  return $requeststatus;
}

function pjrequesttype_info($type_id){
  global $network_prefix, $db2;
  $type_id = intval($type_id);
  $requesttype = $db2->sql_fetchrow($db2->sql_query("SELECT * FROM `".$network_prefix."_requests_types` WHERE `type_id`='$type_id'"));
  return $requesttype;
}

function pj_convert_text($conv_text)
{
  $conv_text = stripslashes($conv_text);
  $conv_text = strtr($conv_text, "\015\012", '');
  $conv_text = str_replace("\r", "", $conv_text);
  $pj_fr1 = array("%25", "%00", "%01", "%02", "%03", "%04", "%05", "%06", "%07", "%08", "%09", "%0A", "%0B", "%0C", "%0D", "%0E", "%0F", "%10", "%11", "%12", "%13", "%14", "%15", "%16", "%17", "%18", "%19", "%1A", "%1B", "%1C", "%1D", "%1E", "%1F");
  $pj_to1 = array("%", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
  $pj_fr2 = array("%20", "%21", "%22", "%23", "%24", "%25", "%26", "%27", "%28", "%29", "%2A", "%2B", "%2C", "%2D", "%2E", "%2F", "%30", "%31", "%32", "%33", "%34", "%35", "%36", "%37", "%38", "%39", "%3A", "%3B", "%3C", "%3D", "%3E", "%3F");
  $pj_to2 = array(" ", "!", "\"", "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", "-", ".", "/", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", ":", ";", "<", "=", ">", "?");
  $pj_fr3 = array("%40", "%41", "%42", "%43", "%44", "%45", "%46", "%47", "%48", "%49", "%4A", "%4B", "%4C", "%4D", "%4E", "%4F", "%50", "%51", "%52", "%53", "%54", "%55", "%56", "%57", "%58", "%59", "%5A", "%5B", "%5C", "%5D", "%5E", "%5F");
  $pj_to3 = array("@", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "[", "\\", "]", "^", "_");
  $pj_fr4 = array("%60", "%61", "%62", "%63", "%64", "%65", "%66", "%67", "%68", "%69", "%6A", "%6B", "%6C", "%6D", "%6E", "%6F", "%70", "%71", "%72", "%73", "%74", "%75", "%76", "%77", "%78", "%79", "%7A", "%7B", "%7C", "%7D", "%7E", "%7F");
  $pj_to4 = array("`", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "{", "|", "}", "`", "");
  $conv_text = str_replace($pj_fr1, $pj_to1, $conv_text);
  $conv_text = str_replace($pj_fr2, $pj_to2, $conv_text);
  $conv_text = str_replace($pj_fr3, $pj_to3, $conv_text);
  $conv_text = str_replace($pj_fr4, $pj_to4, $conv_text);
  $conv_text = ereg_replace("\\\\'", "'", $conv_text);
  $conv_text = str_replace("<br />", "<br />", $conv_text);
  $conv_text = str_replace("<BR />", "<br />", $conv_text);
  $conv_text = str_replace("<br />", "<br />", $conv_text);
  $conv_text = str_replace("<br />\n", "<br />", $conv_text);
  $conv_text = str_replace("\n", "<br />", $conv_text);
  $conv_text = str_replace("<br />", "\n", $conv_text);
  $conv_text = str_replace("''", "'", $conv_text);
  return $conv_text;
}

function pj_copy() 
{
  global $pj_config;
  
  # DEPRECATED - REPLACE WITH preg_replace - added by Ernest Allen Buffington 10/02/2017 Monday @ 8:42pm
  # ereg_replace has been deprecated 
  # $cpname = ereg_replace("_", " ", $pj_config['location']);
  $cpname = preg_replace("/_/", " ", $pj_config['location']);
  
  $pcname = $pj_config['location'];
  echo "<script>\n";
  echo "<!--\n";
  echo "function nsnpjwindow(){\n";
  echo "  window.open (\"modules/$pcname/copyright.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,height=200,width=400,screenX=100,left=100,screenY=100,top=100\");\n";
  echo "}\n";
  echo "//-->\n";
  echo "</SCRIPT>\n\n";
  echo "<div align=\"right\"><a href=\"javascript:nsnpjwindow()\">$cpname &copy;</a></div>";
}
?>