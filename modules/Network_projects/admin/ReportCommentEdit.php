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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_REPORTS.": "._NETWORK_COMMENTEDIT;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$reportcomment = pjreportcomment_info($comment_id);
pjadmin_menu(_NETWORK_REPORTS.": "._NETWORK_COMMENTEDIT);
//echo "<br />\n";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<input type='hidden' name='op' value='ReportCommentUpdate'>\n";
echo "<input type='hidden' name='comment_id' value='$comment_id'>\n";
echo "<input type='hidden' name='report_id' value='".$reportcomment['report_id']."'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_USERNAME.":</td>\n";
echo "<td><input type='text' name='commenter_name' size='30' value=\"".$reportcomment['commenter_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_EMAILADDRESS.":</td>\n";
echo "<td><input type='text' name='commenter_email' size='30' value=\"".$reportcomment['commenter_email']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_COMMENT.":</td>\n";
echo "<td><textarea name='comment_description' cols='60' rows='10'>".$reportcomment['comment_description']."</textarea></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_COMMENTUPDATE."'></td></tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>