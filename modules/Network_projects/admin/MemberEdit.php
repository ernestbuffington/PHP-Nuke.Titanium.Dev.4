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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_MEMBERS.": "._NETWORK_EDITMEMBER;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$member = pjmember_info($member_id);
pjadmin_menu(_NETWORK_MEMBERS.": "._NETWORK_EDITMEMBER);
//echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='MemberUpdate'>\n";
echo "<input type='hidden' name='member_id' value='$member_id'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_MEMBERNAME.":</td>\n";
echo "<td><input type='text' name='member_name' size='30' value=\"".$member['member_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_MEMBEREMAIL.":</td>\n";
echo "<td><input type='text' name='member_email' size='30' value=\"".$member['member_email']."\"></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_UPDATEMEMBER."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');
?>