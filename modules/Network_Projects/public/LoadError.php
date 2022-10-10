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

if(!defined('SUPPORT_NETWORK')) { die("Illegal File Access Detected!!"); }
$pagetitle = "NukeProject(tm): Error Loading Functions";
include_once(NUKE_BASE_DIR.'header.php');
title($pagetitle);
OpenTable();
echo "It appears that NukeProject(tm) has not been configured correctly.  Please
contact the site admin and inform them of this error.";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>