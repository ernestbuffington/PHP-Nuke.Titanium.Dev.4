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
global $titanium_db2;
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_REQUESTS.': '._NETWORK_DELETECOMMENT;

include_once(NUKE_BASE_DIR.'header.php');

$requestcomment = pjrequestcomment_info($comment_id);
pjadmin_menu(_NETWORK_REQUESTS.": "._NETWORK_DELETECOMMENT);
//echo "<br />";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='RequestCommentDelete'>";
echo "<input type='hidden' name='comment_id' value='$comment_id'>";
echo "<input type='hidden' name='request_id' value='".$requestcomment['request_id']."'>";
echo "<tr><td align='center' colspan='2'><strong>"._NETWORK_CONFIRMCOMMENTDELETE."</strong></td></tr>";
echo "<tr><td align='center' valign='top'><strong>"._NETWORK_COMMENT." #$comment_id</strong></td><td>".$requestcomment['comment_description']."</td></tr>";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._NETWORK_DELETECOMMENT."'></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>