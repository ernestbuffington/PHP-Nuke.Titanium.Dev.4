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
$pagetitle = "::: "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_REQUESTS.": "._NETWORK_COMMENTEDIT;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Main\">" . _NETWORK_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NETWORK_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
//echo "<br />";
$requestcomment = pjrequestcomment_info($comment_id);
pjadmin_menu(_NETWORK_REQUESTS.": "._NETWORK_COMMENTEDIT);
//echo "<br />";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='RequestCommentUpdate'>";
echo "<input type='hidden' name='comment_id' value='$comment_id'>";
echo "<input type='hidden' name='request_id' value='".$requestcomment['request_id']."'>";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_USERNAME.":</td>";
echo "<td><input type='text' name='commenter_name' size='30' value=\"".$requestcomment['commenter_name']."\"></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._NETWORK_EMAILADDRESS.":</td>";
echo "<td><input type='text' name='commenter_email' size='30' value=\"".$requestcomment['commenter_email']."\"></td></tr>";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._NETWORK_COMMENT.":</td>";
echo "<td><textarea name='comment_description' cols='60' rows='10'>".$requestcomment['comment_description']."</textarea></td></tr>";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_COMMENTUPDATE."'></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>