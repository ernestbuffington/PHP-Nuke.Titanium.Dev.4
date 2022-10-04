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

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_REPORTS.': '._NETWORK_TYPELIST;

include_once(NUKE_BASE_DIR.'header.php');

pjadmin_menu(_NETWORK_REPORTS.": "._NETWORK_TYPELIST);
//echo "<br />\n";
$typeresult = $titanium_db2->sql_query("SELECT * FROM `".$network_prefix."_reports_types` WHERE `type_weight` > 0 ORDER BY `type_weight`");
$type_total = $titanium_db2->sql_numrows($typeresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan=3 width='100%' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_TYPEOPTIONS."</strong></nobr></td></tr>\n";
$pjimage = pjimage("options.png", $pnt_module);
echo "<tr><td><img src='$pjimage'></td><td colspan='2' width='100%'><nobr><a href='".$admin_file.".php?op=ReportTypeAdd'>"._NETWORK_TYPEADD."</a></nobr></td></tr>\n";
$pjimage = pjimage("stats.png", $pnt_module);
echo "<tr><td><img src='$pjimage'></td><td colspan='2' width='100%'><nobr>"._NETWORK_TOTALTYPES.": <strong>$type_total</strong></nobr></td></tr>\n";
echo "</table>\n";
//CloseTable();
//echo "<br />\n";
//OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._NETWORK_TYPELIST."</strong></a></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_WEIGHT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_FUNCTIONS."</strong></td></tr>\n";
if($type_total != 0){
  while($type_row = $titanium_db2->sql_fetchrow($typeresult)) {
    $pjimage = pjimage("type.png", $pnt_module);
    echo "<tr><td><img src='$pjimage'></td><td width='100%'>".$type_row['type_name']."</td>\n";
    $weight1 = $type_row['type_weight'] - 1;
    $weight3 = $type_row['type_weight'] + 1;
    list($pid1) = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT `type_id` FROM `".$network_prefix."_reports_types` WHERE `type_weight`='$weight1'"));
    list($pid2) = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT `type_id` FROM `".$network_prefix."_reports_types` WHERE `type_weight`='$weight3'"));
    echo "<td align='center'><nobr>";
    if($pid1 AND $pid1 > 0) {
      echo "<a href='".$admin_file.".php?op=ReportTypeOrder&amp;weight=".$type_row['type_weight']."&amp;pid=".$type_row['type_id']."&amp;weightrep=$weight1&amp;pidrep=$pid1'><img src='modules/$pnt_module/images/weight_up.png' border='0' hspace='3' alt='"._NETWORK_UP."' title='"._NETWORK_UP."'></a>";
    } else {
      echo "<img src='modules/$pnt_module/images/weight_up_no.png' border='0' hspace='3' alt='' title=''>";
    }
    if($pid2) {
      echo "<a href='".$admin_file.".php?op=ReportTypeOrder&amp;weight=".$type_row['type_weight']."&amp;pid=".$type_row['type_id']."&amp;weightrep=$weight3&amp;pidrep=$pid2'><img src='modules/$pnt_module/images/weight_dn.png' border='0' hspace='3' alt='"._NETWORKDOWN."' title='"._NETWORK_DOWN."'></a>";
    } else {
      echo "<img src='modules/$pnt_module/images/weight_dn_no.png' border='0' hspace='3' alt='' title=''>";
    }
    echo"</nobr></td>\n";
    echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=ReportTypeEdit&amp;type_id=".$type_row['type_id']."'>"._NETWORK_EDIT."</a>";
    echo " | <a href='".$admin_file.".php?op=ReportTypeRemove&amp;type_id=".$type_row['type_id']."'>"._NETWORK_DELETE."</a> ]</nobr></td></tr>\n";
  }
  echo "<tr><td align='center' colspan='4'><a href='".$admin_file.".php?op=ReportTypeFix'>"._NETWORK_FIXWEIGHT."</a></td></tr>\n";
} else {
  echo "<tr><td width='100%' colspan='3' align='center'>"._NETWORK_NOREPORTTYPES."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
pj_copy();
include_once(NUKE_BASE_DIR.'footer.php');

?>