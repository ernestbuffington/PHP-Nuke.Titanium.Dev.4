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
global $db2;
if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

global $admin_file;

adminmenu($admin_file.".php?op=Main", 'Network Projects', "nukeproject.png");

?>