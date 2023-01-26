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
global $prefix, $db2;
if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

$module_name = basename(dirname(dirname(__FILE__)));
define('NETWORK_SUPPORT_ADMIN', true);
define('INDEX_FILE', true);
$aid = substr($aid, 0,125);
$row = $db2->sql_fetchrow($db2->sql_query("SELECT `title`, `admins` FROM `".$prefix."_modules` WHERE `title`='$module_name'"));
$row2 = $db2->sql_fetchrow($db2->sql_query("SELECT `name`, `radminsuper` FROM `".$prefix."_authors` WHERE `aid`='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if (isset($row2['name']) == "$admins[$i]" AND !empty($row['admins'])) {
        $auth_user = 1;
    }
}

if (isset($row2['radminsuper']) == 1 || $auth_user == 1) {
  if(!defined('NETWORK_SUPPORT_FUNC')) { $op = "LoadError"; }
  switch ($op) {
    case "Config":include_once(NUKE_MODULES_DIR.$module_name."/admin/Config.php");break;
    case "ConfigUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ConfigUpdate.php");break;
    case "LoadError":include_once(NUKE_MODULES_DIR.$module_name."/admin/LoadError.php");break;
    case "Main":include_once(NUKE_MODULES_DIR.$module_name."/admin/Main.php");break;
    case "MemberAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberAdd.php");break;
    case "MemberDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberDelete.php");break;
    case "MemberEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberEdit.php");break;
    case "MemberInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberInsert.php");break;
    case "MemberList":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberList.php");break;
    case "MemberPositionAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionAdd.php");break;
    case "MemberPositionDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionDelete.php");break;
    case "MemberPositionEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionEdit.php");break;
    case "MemberPositionFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionFix.php");break;
    case "MemberPositionInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionInsert.php");break;
    case "MemberPositionList":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionList.php");break;
    case "MemberPositionOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionOrder.php");break;
    case "MemberPositionRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionRemove.php");break;
    case "MemberPositionUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberPositionUpdate.php");break;
    case "MemberRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberRemove.php");break;
    case "MemberUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/MemberUpdate.php");break;
    case "ProjectAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectAdd.php");break;
    case "ProjectConfig":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectConfig.php");break;
    case "ProjectConfigUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectConfigUpdate.php");break;
    case "ProjectDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectDelete.php");break;
    case "ProjectEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectEdit.php");break;
    case "ProjectFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectFix.php");break;
    case "ProjectInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectInsert.php");break;
    case "ProjectList":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectList.php");break;
    case "ProjectMembers":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectMembers.php");break;
    case "ProjectOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectOrder.php");break;
    case "ProjectPriorityAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityAdd.php");break;
    case "ProjectPriorityDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityDelete.php");break;
    case "ProjectPriorityEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityEdit.php");break;
    case "ProjectPriorityFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityFix.php");break;
    case "ProjectPriorityInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityInsert.php");break;
    case "ProjectPriorityList":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityList.php");break;
    case "ProjectPriorityOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityOrder.php");break;
    case "ProjectPriorityRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityRemove.php");break;
    case "ProjectPriorityUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectPriorityUpdate.php");break;
    case "ProjectRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectRemove.php");break;
    case "ProjectReports":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectReports.php");break;
    case "ProjectRequests":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectRequests.php");break;
    case "ProjectStatusAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusAdd.php");break;
    case "ProjectStatusDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusDelete.php");break;
    case "ProjectStatusEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusEdit.php");break;
    case "ProjectStatusFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusFix.php");break;
    case "ProjectStatusInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusInsert.php");break;
    case "ProjectStatusList":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusList.php");break;
    case "ProjectStatusOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusOrder.php");break;
    case "ProjectStatusRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusRemove.php");break;
    case "ProjectStatusUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectStatusUpdate.php");break;
    case "ProjectTasks":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectTasks.php");break;
    case "ProjectUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ProjectUpdate.php");break;
    case "ReportCommentDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportCommentDelete.php");break;
    case "ReportCommentEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportCommentEdit.php");break;
    case "ReportCommentRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportCommentRemove.php");break;
    case "ReportCommentUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportCommentUpdate.php");break;
    case "ReportConfig":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportConfig.php");break;
    case "ReportConfigUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportConfigUpdate.php");break;
    case "ReportDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportDelete.php");break;
    case "ReportEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportEdit.php");break;
    case "ReportImport":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportImport.php");break;
    case "ReportImportInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportImportInsert.php");break;
    case "ReportList":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportList.php");break;
    case "ReportMembers":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportMembers.php");break;
    case "ReportPrint":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportPrint.php");break;
    case "ReportRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportRemove.php");break;
    case "ReportStatusAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusAdd.php");break;
    case "ReportStatusDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusDelete.php");break;
    case "ReportStatusEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusEdit.php");break;
    case "ReportStatusFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusFix.php");break;
    case "ReportStatusInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusInsert.php");break;
    case "ReportStatusList":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusList.php");break;
    case "ReportStatusOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusOrder.php");break;
    case "ReportStatusRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusRemove.php");break;
    case "ReportStatusUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportStatusUpdate.php");break;
    case "ReportTypeAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeAdd.php");break;
    case "ReportTypeDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeDelete.php");break;
    case "ReportTypeEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeEdit.php");break;
    case "ReportTypeFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeFix.php");break;
    case "ReportTypeInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeInsert.php");break;
    case "ReportTypeList":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeList.php");break;
    case "ReportTypeOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeOrder.php");break;
    case "ReportTypeRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeRemove.php");break;
    case "ReportTypeUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportTypeUpdate.php");break;
    case "ReportUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/ReportUpdate.php");break;
    case "RequestCommentDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestCommentDelete.php");break;
    case "RequestCommentEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestCommentEdit.php");break;
    case "RequestCommentRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestCommentRemove.php");break;
    case "RequestCommentUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestCommentUpdate.php");break;
    case "RequestConfig":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestConfig.php");break;
    case "RequestConfigUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestConfigUpdate.php");break;
    case "RequestDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestDelete.php");break;
    case "RequestEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestEdit.php");break;
    case "RequestImport":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestImport.php");break;
    case "RequestImportInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestImportInsert.php");break;
    case "RequestList":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestList.php");break;
    case "RequestMembers":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestMembers.php");break;
    case "RequestPrint":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestPrint.php");break;
    case "RequestRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestRemove.php");break;
    case "RequestStatusAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusAdd.php");break;
    case "RequestStatusDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusDelete.php");break;
    case "RequestStatusEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusEdit.php");break;
    case "RequestStatusFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusFix.php");break;
    case "RequestStatusInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusInsert.php");break;
    case "RequestStatusList":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusList.php");break;
    case "RequestStatusOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusOrder.php");break;
    case "RequestStatusRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusRemove.php");break;
    case "RequestStatusUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestStatusUpdate.php");break;
    case "RequestTypeAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeAdd.php");break;
    case "RequestTypeDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeDelete.php");break;
    case "RequestTypeEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeEdit.php");break;
    case "RequestTypeFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeFix.php");break;
    case "RequestTypeInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeInsert.php");break;
    case "RequestTypeList":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeList.php");break;
    case "RequestTypeOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeOrder.php");break;
    case "RequestTypeRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeRemove.php");break;
    case "RequestTypeUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestTypeUpdate.php");break;
    case "RequestUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/RequestUpdate.php");break;
    case "TaskAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskAdd.php");break;
    case "TaskConfig":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskConfig.php");break;
    case "TaskConfigUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskConfigUpdate.php");break;
    case "TaskDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskDelete.php");break;
    case "TaskEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskEdit.php");break;
    case "TaskInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskInsert.php");break;
    case "TaskList":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskList.php");break;
    case "TaskMembers":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskMembers.php");break;
    case "TaskPriorityAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityAdd.php");break;
    case "TaskPriorityDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityDelete.php");break;
    case "TaskPriorityEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityEdit.php");break;
    case "TaskPriorityFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityFix.php");break;
    case "TaskPriorityInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityInsert.php");break;
    case "TaskPriorityList":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityList.php");break;
    case "TaskPriorityOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityOrder.php");break;
    case "TaskPriorityRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityRemove.php");break;
    case "TaskPriorityUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskPriorityUpdate.php");break;
    case "TaskRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskRemove.php");break;
    case "TaskStatusAdd":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusAdd.php");break;
    case "TaskStatusDelete":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusDelete.php");break;
    case "TaskStatusEdit":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusEdit.php");break;
    case "TaskStatusFix":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusFix.php");break;
    case "TaskStatusInsert":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusInsert.php");break;
    case "TaskStatusList":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusList.php");break;
    case "TaskStatusOrder":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusOrder.php");break;
    case "TaskStatusRemove":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusRemove.php");break;
    case "TaskStatusUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskStatusUpdate.php");break;
    case "TaskUpdate":include_once(NUKE_MODULES_DIR.$module_name."/admin/TaskUpdate.php");break;
  }
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    //echo "<br />";
    OpenTable();
    echo "<center><strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>