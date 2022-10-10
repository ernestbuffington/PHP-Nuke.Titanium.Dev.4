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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_REPORTS.": "._NETWORK_DELETESTATUS;
$status_id = intval($status_id);
if($status_id < 1) { header("Location: ".$admin_file.".php?op=RequestStatusList"); }
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$statusresult = $db2->sql_query("SELECT `status_name` FROM `".$network_prefix."_reports_status` WHERE `status_id`='$status_id'");
list($status_name) = $db2->sql_fetchrow($statusresult);
pjadmin_menu(_NETWORK_REPORTS.": "._NETWORK_DELETESTATUS);
echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ReportStatusDelete'>\n";
echo "<input type='hidden' name='status_id' value='$status_id'>\n";
echo "<tr><td align='center'><strong>"._NETWORK_SWAPREPORTSTATUS."</strong></td></tr>\n";
echo "<tr><td align='center'>$status_name -> <select name='swap_status_id'>\n";
echo "<option value='-1'>"._NETWORK_NA."</option>\n";
$statuslist = $db2->sql_query("SELECT `status_id`, `status_name` FROM `".$network_prefix."_reports_status` WHERE `status_id` != '$status_id' AND `status_id` > 0 ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $db2->sql_fetchrow($statuslist)){
    echo "<option value='$s_status_id'>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'><input type='submit' value='"._NETWORK_DELETESTATUS."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>