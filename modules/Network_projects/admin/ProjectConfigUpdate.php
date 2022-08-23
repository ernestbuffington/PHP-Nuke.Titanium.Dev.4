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
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$new_project_position = intval($new_project_position);
$new_project_priority = intval($new_project_priority);
$new_project_status = intval($new_project_status);
pjsave_config('new_project_position', $new_project_position);
pjsave_config('new_project_priority', $new_project_priority);
pjsave_config('new_project_status', $new_project_status);
pjsave_config('project_date_format', $project_date_format);
header("Location: ".$admin_file.".php?op=ProjectConfig");

?>