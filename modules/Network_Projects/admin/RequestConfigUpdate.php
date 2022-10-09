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
pjsave_config('admin_request_email', $admin_request_email);
pjsave_config('new_request_position', $new_request_position);
pjsave_config('new_request_status', $new_request_status);
pjsave_config('new_request_type', $new_request_type);
pjsave_config('notify_request_admin', $notify_request_admin);
pjsave_config('notify_request_submitter', $notify_request_submitter);
pjsave_config('request_date_format', $request_date_format);
header("Location: ".$admin_file.".php?op=RequestConfig");

?>