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
$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_REQUESTS.': '._NETWORK_DELETEREQUEST;
include_once(NUKE_BASE_DIR.'header.php');

$request = pjrequest_info($request_id);
pjadmin_menu(_NETWORK_REQUESTS.': '._NETWORK_DELETEREQUEST);
//echo "<br />";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='RequestDelete'>";
echo "<input type='hidden' name='request_id' value='$request_id'>";
echo "<input type='hidden' name='project_id' value='".$request['project_id']."'>";
echo "<tr><td align='center'><strong>"._NETWORK_REQUESTCONFIRMDELETE."</strong></td></tr>";
echo "<tr><td align='center'><strong><i>".$request['request_name'].":</i></strong></td></tr>";
echo "<tr><td align='center'><i>".$request['request_description']."</i></td></tr>";
echo "<tr><td align='center'><input type='submit' value='"._NETWORK_DELETEREQUEST."'></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>