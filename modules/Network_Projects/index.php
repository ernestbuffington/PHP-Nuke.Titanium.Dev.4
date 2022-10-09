<?php
/*======================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================*/
/********************************************************/
/* PHP-Nuke Titanium(tm)                                */
/* By: The 86it Social Network                          */
/* http://cvs.86it.us                                   */
/* Copyright (c) 2000-2017 by SEBASTIAN ENTERPRISES     */
/********************************************************/
/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
/*****[CHANGES]******************************************
[Base]
      Nuke Patched                  v3.1.0     10/25/2005
[Mod]
      Networked                     v11.11.11  10/08/2017
	  Converted To Network Support             10/08/2017	  
 ********************************************************/
global $db2;

if (!defined('MODULE_FILE'))
{ 
  die ("You can't access this file directly..."); 
}

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

define('SUPPORT_NETWORK', true);

define('INDEX_FILE', true);

if(!defined('NETWORK_SUPPORT_FUNC'))
{
 $op = "LoadError"; 
}

if(!isset($op))
{ 
  $op = "Index"; 
}

switch($op) 
{
  case "Index":
  include_once(NUKE_MODULES_DIR.$module_name."/public/Index.php");
  break;
  case "LoadError":
  include_once(NUKE_MODULES_DIR.$module_name."/public/LoadError.php");
  break;
  case "Project":
  include_once(NUKE_MODULES_DIR.$module_name."/public/Project.php");
  break;
  case "Report":
  include_once(NUKE_MODULES_DIR.$module_name."/public/Report.php");
  break;
  case "ReportCommentInsert":
  include_once(NUKE_MODULES_DIR.$module_name."/public/ReportCommentInsert.php");
  break;
  case "ReportCommentSubmit":
  include_once(NUKE_MODULES_DIR.$module_name."/public/ReportCommentSubmit.php");
  break;
  case "ReportInsert":
  include_once(NUKE_MODULES_DIR.$module_name."/public/ReportInsert.php");
  break;
  case "ReportMap":
  include_once(NUKE_MODULES_DIR.$module_name."/public/ReportMap.php");
  break;
  case "ReportSubmit":
  include_once(NUKE_MODULES_DIR.$module_name."/public/ReportSubmit.php");
  break;
  case "Request":
  include_once(NUKE_MODULES_DIR.$module_name."/public/Request.php");
  break;
  case "RequestCommentInsert":
  include_once(NUKE_MODULES_DIR.$module_name."/public/RequestCommentInsert.php");
  break;
  case "RequestCommentSubmit":
  include_once(NUKE_MODULES_DIR.$module_name."/public/RequestCommentSubmit.php");
  break;
  case "RequestInsert":
  include_once(NUKE_MODULES_DIR.$module_name."/public/RequestInsert.php");
  break;
  case "RequestMap":
  include_once(NUKE_MODULES_DIR.$module_name."/public/RequestMap.php");
  break;
  case "RequestSubmit":
  include_once(NUKE_MODULES_DIR.$module_name."/public/RequestSubmit.php");
  break;
  case "Task":
  include_once(NUKE_MODULES_DIR.$module_name."/public/Task.php");
  break;
  case "TaskMap":
  include_once(NUKE_MODULES_DIR.$module_name."/public/TaskMap.php");
  break;
}
?>
