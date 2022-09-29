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
get_lang('Network_Projects');
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._NETWORK_TITLE." ".$pj_config['version_number']."::: "._NETWORK_REQUESTS.": "._NETWORK_STATUSLIST;
include_once(NUKE_BASE_DIR.'header.php');

pjadmin_menu(_NETWORK_REQUESTS.": "._NETWORK_STATUSLIST);
//echo "<br />";
$statusresult = $titanium_db2->sql_query("SELECT * FROM `".$network_prefix."_requests_status` WHERE `status_weight` > 0 ORDER BY `status_weight`");
$status_total = $titanium_db2->sql_numrows($statusresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<tr><td colspan='3' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_STATUSOPTIONS."</strong></nobr></td></tr>";
$pjimage = pjimage("options.png", $titanium_module_name);
echo "<tr><td><img src='$pjimage'></td><td colspan='2' width='100%'><nobr><a href='".$admin_file.".php?op=RequestStatusAdd'>"._NETWORK_STATUSADD."</a></nobr></td></tr>";
$pjimage = pjimage("stats.png", $titanium_module_name);
echo "<tr><td><img src='$pjimage'></td><td colspan='2' width='100%'><nobr>"._NETWORK_TOTALSTATUSES.": <strong>$status_total</strong></nobr></td></tr>";
echo "</table>";
//CloseTable();
//echo "<br />";
//OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._NETWORK_STATUSLIST."</strong></a></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_WEIGHT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_FUNCTIONS."</strong></td></tr>";
if($status_total != 0){
  while($status_row = $titanium_db2->sql_fetchrow($statusresult)) {
    $pjimage = pjimage("status.png", $titanium_module_name);
    echo "<tr><td><img src='$pjimage'></td><td width='100%'>".$status_row['status_name']."</td>";
    $weight1 = $status_row['status_weight'] - 1;
    $weight3 = $status_row['status_weight'] + 1;
    list($pid1) = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT `status_id` FROM `".$network_prefix."_requests_status` WHERE `status_weight`='$weight1'"));
    list($pid2) = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT `status_id` FROM `".$network_prefix."_requests_status` WHERE `status_weight`='$weight3'"));
    echo "<td align='center'><nobr>";
    if($pid1 AND $pid1 > 0) {
      echo "<a href='".$admin_file.".php?op=RequestStatusOrder&amp;weight=".$status_row['status_weight']."&amp;pid=".$status_row['status_id']."&amp;weightrep=$weight1&amp;pidrep=$pid1'><img src='modules/$titanium_module_name/images/weight_up.png' border='0' hspace='3' alt='"._NETWORK_UP."' title='"._NETWORK_UP."'></a>";
    } else {
      echo "<img src='modules/$titanium_module_name/images/weight_up_no.png' border='0' hspace='3' alt='' title=''>";
    }
    if($pid2) {
      echo "<a href='".$admin_file.".php?op=RequestStatusOrder&amp;weight=".$status_row['status_weight']."&amp;pid=".$status_row['status_id']."&amp;weightrep=$weight3&amp;pidrep=$pid2'><img src='modules/$titanium_module_name/images/weight_dn.png' border='0' hspace='3' alt='"._NETWORKDOWN."' title='"._NETWORK_DOWN."'></a>";
    } else {
      echo "<img src='modules/$titanium_module_name/images/weight_dn_no.png' border='0' hspace='3' alt='' title=''>";
    }
    echo"</nobr></td>\n";
    echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=RequestStatusEdit&amp;status_id=".$status_row['status_id']."'>"._NETWORK_EDIT."</a>";
    echo " | <a href='".$admin_file.".php?op=RequestStatusRemove&amp;status_id=".$status_row['status_id']."'>"._NETWORK_DELETE."</a> ]</nobr></td></tr>\n";
  }
  echo "<tr><td align='center' colspan='4'><a href='".$admin_file.".php?op=RequestStatusFix'>"._NETWORK_FIXWEIGHT."</a></td></tr>\n";
} else {
  echo "<tr><td width='100%' colspan='3' align='center'>"._NETWORK_NOREQUESTSTATUSES."</td></tr>";
}
echo "</table>";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>