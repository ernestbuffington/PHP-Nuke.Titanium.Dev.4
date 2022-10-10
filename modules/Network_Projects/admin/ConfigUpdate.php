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
$location = htmlentities($location, ENT_QUOTES);
pjsave_config('reports_active', $reports_active);
pjsave_config('requests_active', $requests_active);
pjsave_config('location', $location);
header("Location: ".$admin_file.".php?op=Config");

?>