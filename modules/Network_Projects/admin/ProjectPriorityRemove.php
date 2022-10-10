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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_PROJECTS.": "._NETWORK_DELETEPRIORITY;
$priority_id = intval($priority_id);
if($priority_id < 1) { header("Location: ".$admin_file.".php?op=ProjectPriorityList"); }
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$priority = pjprojectpriority_info($priority_id);
pjadmin_menu(_NETWORK_PROJECTS.": "._NETWORK_DELETEPRIORITY);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ProjectPriorityDelete'>\n";
echo "<input type='hidden' name='priority_id' value='$priority_id'>\n";
echo "<tr><td align='center'><strong>"._NETWORK_SWAPPROJECTPRIORITY."</strong></td></tr>\n";
echo "<tr><td align='center'>".$priority['priority_name']." -> <select name='swap_priority_id'>\n";
echo "<option value='-1'>"._NETWORK_NA."</option>\n";
$prioritylist = $db2->sql_query("SELECT `priority_id`, `priority_name` FROM `".$network_prefix."_projects_priorities` WHERE `priority_id` != '$priority_id' AND `priority_id` > 0 ORDER BY `priority_weight`");
while(list($s_priority_id, $s_priority_name) = $db2->sql_fetchrow($prioritylist)){
    echo "<option value='$s_priority_id'>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'><input type='submit' value='"._NETWORK_DELETEPRIORITY."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>