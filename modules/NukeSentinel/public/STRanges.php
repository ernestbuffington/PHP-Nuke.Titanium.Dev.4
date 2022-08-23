<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://nukescripts.86it.us)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_PUBLIC')) {
   die ('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
stmain_menu(_AB_BLOCKEDRANGES);
echo '<br />'."\n";
OpenTable();
if (!isset($perpage) or $perpage == 0) { $perpage = 10; } else { $perpage = intval($perpage); }
if (!isset($min)) { $min=0; } else { $min = intval($min); }
if (!isset($max)) { $max = $min + $perpage; } else { $max = intval($max); }
if ($column != "ip_lo" and $column != "date") { $column = "ip_lo"; }
if ($direction != "asc" and $direction != "desc") { $direction = "asc"; }
$totalselected = $db->sql_numrows($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blocked_ranges`"));
if ($totalselected > 0) {
  // Page Sorting
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
  echo '<tr>'."\n";
  echo '<td align="right" colspan="3">'."\n";
  echo '<form method="post" action="modules.php?name='.$module_name.'" style="padding: 0px; margin: 0px;">'."\n";
  echo '<input type="hidden" name="op" value="STRanges" />'."\n";
  echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
  echo '<strong>'._AB_SORT.':</strong> ';
  echo '<select name="column">'."\n";
  if($column == "ip_lo") $selcolumn1 = ' selected="selected"';
  echo '<option value="ip_lo"'.$selcolumn1.'>'._AB_IP2CRANGE.'</option>'."\n";
  if($column == "date") $selcolumn3 = ' selected="selected"';
  echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
  echo '</select> ';
  echo '<select name="direction">'."\n";
  if($direction == "asc") $seldirection1 = ' selected="selected"';
  echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
  if($direction == "desc") $seldirection2 = ' selected="selected"';
  echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
  echo '</select> ';
  echo '<input type="submit" value="'._AB_SORT.'" />'."\n";
  echo '</form>'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";
  echo '</table>'."\n";
  // Page Sorting
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td align="center" width="33%"><strong>'._AB_IPLO.'</strong></td>'."\n";
  echo '<td align="center" width="33%"><strong>'._AB_IPHI.'</strong></td>'."\n";
  echo '<td align="center" width="34%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` ORDER BY $column $direction LIMIT $min,$perpage");
  while ($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td align="center">'.$getIPs['ip_lo_ip'].'</td>'."\n";
    echo '<td align="center">'.$getIPs['ip_hi_ip'].'</td>'."\n";
    echo '<td align="center">'.date("Y-m-d \@ H:i:s",$getIPs['date']).'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  stpagenumspub($op, $totalselected, $perpage, $max, $column, $direction);
} else {
  echo '<center><strong>'._AB_NORANGES.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>