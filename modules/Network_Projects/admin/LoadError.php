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
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal File Access Detected!!"); }
$pagetitle = "NukeProject(tm): Error Loading Functions";
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
title($pagetitle);
OpenTable();
echo "It appears that NukeProject(tm) has not been configured correctly.  The
most common cause is that you either have an error in the syntax that is
including includes/nsnbc_func.php from your mainfile.php, or you have not
added the NukeProject(tm) code to your mainfile.php.  Details for including this
code are included in the download package in the <strong>Edits_For_Core_Files</strong> directory.";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>