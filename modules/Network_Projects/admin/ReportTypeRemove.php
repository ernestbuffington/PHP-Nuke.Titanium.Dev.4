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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_REPORTS.": "._NETWORK_DELETETYPE;
$type_id = intval($type_id);
if($type_id < 1) { header("Location: ".$admin_file.".php?op=RequestTypeList"); }
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$typeresult = $db2->sql_query("SELECT `type_name` FROM `".$network_prefix."_reports_types` WHERE `type_id`='$type_id'");
list($type_name) = $db2->sql_fetchrow($statusresult);
pjadmin_menu(_NETWORK_REPORTS.": "._NETWORK_DELETETYPE);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ReportTypeDelete'>\n";
echo "<input type='hidden' name='type_id' value='$type_id'>\n";
echo "<tr><td align='center'><strong>"._NETWORK_SWAPREPORTTYPE."</strong></td></tr>\n";
echo "<tr><td align='center'>$type_name -> <select name='swap_type_id'>\n";
echo "<option value='-1'>"._NETWORK_NA."</option>\n";
$typelist = $db2->sql_query("SELECT `type_id`, `type_name` FROM `".$network_prefix."_reports_types` WHERE `type_id` != '$type_id' AND `type_id` > 0 ORDER BY `type_weight`");
while(list($t_type_id, $t_type_name) = $db2->sql_fetchrow($typelist)){
    echo "<option value='$t_type_id'>$t_type_id - $t_type_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'><input type='submit' value='"._NETWORK_DELETETYPE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>