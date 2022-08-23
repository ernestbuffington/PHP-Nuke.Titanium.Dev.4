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
$new_task_position = intval($new_task_position);
$new_task_priority = intval($new_task_priority);
$new_task_status = intval($new_task_status);
pjsave_config('new_task_position', $new_task_position);
pjsave_config('new_task_priority', $new_task_priority);
pjsave_config('new_task_status', $new_task_status);
pjsave_config('task_date_format', $task_date_format);
header("Location: ".$admin_file.".php?op=TaskConfig");

?>