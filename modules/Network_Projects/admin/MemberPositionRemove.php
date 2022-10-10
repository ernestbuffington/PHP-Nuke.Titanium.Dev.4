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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_MEMBERS.": "._NETWORK_DELETEPOSITION;
$position_id = intval($position_id);
if($position_id < 1) { header("Location: ".$admin_file.".php?op=MemberPositionList"); }
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$position = pjmemberposition_info($position_id);
pjadmin_menu(_NETWORK_MEMBERS.": "._NETWORK_DELETEPOSITION);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='MemberPositionDelete'>\n";
echo "<input type='hidden' name='position_id' value='$position_id'>";
echo "<tr><td align='center'><strong>"._NETWORK_SWAPPOSITION."</strong></td></tr>\n";
echo "<tr><td align='center'>".$position['position_name']." -> <select name='swap_position_id'>\n";
echo "<option value='-1'>"._NETWORK_NA."</option>\n";
$positionlist = $db2->sql_query("SELECT `position_id`, `position_name` FROM `".$network_prefix."_members_positions` WHERE `position_id` != '$position_id' AND `position_id` > 0 ORDER BY `position_weight`");
while(list($s_position_id, $s_position_name) = $db2->sql_fetchrow($positionlist)){
  echo "<option value='$s_position_id'>$s_position_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'><input type='submit' value='"._NETWORK_DELETEPOSITION."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>