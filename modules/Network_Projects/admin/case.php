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

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       10/25/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}
global $prefix, $db2;
$module_name = basename(dirname(dirname(__FILE__)));
$aid = substr($aid, 0,125);
$query = $db2->sql_query("SELECT `title`, `admins` FROM `".$prefix."_modules` WHERE `title`='$module_name'");
list($mod_title, $admins) = $db2->sql_fetchrow($query);
$db2->sql_freeresult($query);
$query2 = $db2->sql_query("SELECT `name`, `radminsuper` FROM `".$prefix."_authors` WHERE `aid`='$aid'");
list($rname, $radminsuper) = $db2->sql_fetchrow($query2);
$db2->sql_freeresult($query2);
$admins = explode(",", $admins);
$auth_user = 0;
for($i=0; $i < sizeof($admins); $i++) { if($rname == $admins[$i] AND !empty($admins)) { $auth_user = 1; } }
if($radminsuper == 1 || $auth_user == 1) {
  switch ($op) {
    case "Config":
    case "ConfigUpdate":
    case "LoadError":
    case "Main":
    case "MemberAdd":
    case "MemberDelete":
    case "MemberEdit":
    case "MemberInsert":
    case "MemberList":
    case "MemberPositionAdd":
    case "MemberPositionDelete":
    case "MemberPositionEdit":
    case "MemberPositionFix":
    case "MemberPositionInsert":
    case "MemberPositionList":
    case "MemberPositionOrder":
    case "MemberPositionRemove":
    case "MemberPositionUpdate":
    case "MemberRemove":
    case "MemberUpdate":
    case "ProjectAdd":
    case "ProjectConfig":
    case "ProjectConfigUpdate":
    case "ProjectDelete":
    case "ProjectEdit":
    case "ProjectFix":
    case "ProjectInsert":
    case "ProjectList":
    case "ProjectMembers":
    case "ProjectOrder":
    case "ProjectPriorityAdd":
    case "ProjectPriorityDelete":
    case "ProjectPriorityEdit":
    case "ProjectPriorityFix":
    case "ProjectPriorityInsert":
    case "ProjectPriorityList":
    case "ProjectPriorityOrder":
    case "ProjectPriorityRemove":
    case "ProjectPriorityUpdate":
    case "ProjectRemove":
    case "ProjectReports":
    case "ProjectRequests":
    case "ProjectStatusAdd":
    case "ProjectStatusDelete":
    case "ProjectStatusEdit":
    case "ProjectStatusFix":
    case "ProjectStatusInsert":
    case "ProjectStatusList":
    case "ProjectStatusOrder":
    case "ProjectStatusRemove":
    case "ProjectStatusUpdate":
    case "ProjectTasks":
    case "ProjectUpdate":
    case "ReportCommentDelete":
    case "ReportCommentEdit":
    case "ReportCommentRemove":
    case "ReportCommentUpdate":
    case "ReportConfig":
    case "ReportConfigUpdate":
    case "ReportDelete":
    case "ReportEdit":
    case "ReportImport":
    case "ReportImportInsert":
    case "ReportList":
    case "ReportMembers":
    case "ReportPrint":
    case "ReportRemove":
    case "ReportStatusAdd":
    case "ReportStatusDelete":
    case "ReportStatusEdit":
    case "ReportStatusFix":
    case "ReportStatusInsert":
    case "ReportStatusList":
    case "ReportStatusOrder":
    case "ReportStatusRemove":
    case "ReportStatusUpdate":
    case "ReportTypeAdd":
    case "ReportTypeDelete":
    case "ReportTypeEdit":
    case "ReportTypeFix":
    case "ReportTypeInsert":
    case "ReportTypeList":
    case "ReportTypeOrder":
    case "ReportTypeRemove":
    case "ReportTypeUpdate":
    case "ReportUpdate":
    case "RequestCommentDelete":
    case "RequestCommentEdit":
    case "RequestCommentRemove":
    case "RequestCommentUpdate":
    case "RequestConfig":
    case "RequestConfigUpdate":
    case "RequestDelete":
    case "RequestEdit":
    case "RequestImport":
    case "RequestImportInsert":
    case "RequestList":
    case "RequestMembers":
    case "RequestPrint":
    case "RequestRemove":
    case "RequestStatusAdd":
    case "RequestStatusDelete":
    case "RequestStatusEdit":
    case "RequestStatusFix":
    case "RequestStatusInsert":
    case "RequestStatusList":
    case "RequestStatusOrder":
    case "RequestStatusRemove":
    case "RequestStatusUpdate":
    case "RequestTypeAdd":
    case "RequestTypeDelete":
    case "RequestTypeEdit":
    case "RequestTypeFix":
    case "RequestTypeInsert":
    case "RequestTypeList":
    case "RequestTypeOrder":
    case "RequestTypeRemove":
    case "RequestTypeUpdate":
    case "RequestUpdate":
    case "TaskAdd":
    case "TaskConfig":
    case "TaskConfigUpdate":
    case "TaskDelete":
    case "TaskEdit":
    case "TaskInsert":
    case "TaskList":
    case "TaskMembers":
    case "TaskPriorityAdd":
    case "TaskPriorityDelete":
    case "TaskPriorityEdit":
    case "TaskPriorityFix":
    case "TaskPriorityInsert":
    case "TaskPriorityList":
    case "TaskPriorityOrder":
    case "TaskPriorityRemove":
    case "TaskPriorityUpdate":
    case "TaskRemove":
    case "TaskStatusAdd":
    case "TaskStatusDelete":
    case "TaskStatusEdit":
    case "TaskStatusFix":
    case "TaskStatusInsert":
    case "TaskStatusList":
    case "TaskStatusOrder":
    case "TaskStatusRemove":
    case "TaskStatusUpdate":
    case "TaskUpdate":
    	$title = $mod_title;
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;
  }
}
?>