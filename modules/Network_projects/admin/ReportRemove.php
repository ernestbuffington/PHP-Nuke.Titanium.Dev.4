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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_REPORTS.": "._NETWORK_DELETEREPORT;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$report = pjreport_info($report_id);
pjadmin_menu(_NETWORK_REPORTS.": "._NETWORK_DELETEREPORT);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ReportDelete'>\n";
echo "<input type='hidden' name='report_id' value='$report_id'>\n";
echo "<input type='hidden' name='project_id' value='".$report['project_id']."'>";
echo "<tr><td align='center'><strong>"._NETWORK_REPORTCONFIRMDELETE."</strong></td></tr>\n";
echo "<tr><td align='center'><strong><i>".$report['report_name'].":</i></strong></td></tr>\n";
echo "<tr><td align='center'><i>".$report['report_description']."</i></td></tr>\n";
echo "<tr><td align='center'><br /><br /><input type='submit' value='"._NETWORK_DELETEREPORT."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>