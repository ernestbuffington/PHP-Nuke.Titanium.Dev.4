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

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_EXCLUDEDLISTING);
mastermenu();
CarryMenu();
excludedmenu();
CloseMenu();
CloseTable();

OpenTable();
$perpage = $ab_config['block_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
if(!isset($column) or !$column or $column=="") $column = "ip_lo";
if(!isset($direction) or !$direction or $direction=="") $direction = "asc";
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges`"));
if($totalselected > 0) {
  $selcolumn1 = $selcolumn2 = $selcolumn3 = $seldirection1 = $seldirection2 = "";
  if($column == "c2c") { $selcolumn2 = ' selected="selected"'; }
  elseif($column == "date") { $selcolumn3 = ' selected="selected"'; }
  else { $selcolumn1 = ' selected="selected"'; }
  if($direction == "desc") { $seldirection2 = ' selected="selected"'; }
  else { $seldirection1 = ' selected="selected"'; }
  // Page Sorting
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
  echo '<tr><td align="right" nowrap="nowrap">'."\n";
  echo '<form action="'.$admin_file.'.php?op=ABExcludedList" method="post" style="padding: 0px; margin: 0px;">';
  echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
  echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
  echo '<option value="ip_lo"'.$selcolumn1.'>'._AB_IP2CRANGE.'</option>'."\n";
  echo '<option value="c2c"'.$selcolumn2.'>'._AB_C2CODE.'</option>'."\n";
  echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
  echo '</select> <select name="direction">'."\n";
  echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
  echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
  echo '</select> <input type="submit" value="'._AB_SORT.'" />'."\n";
  echo '</form>'."\n";
  echo '</td></tr>'."\n";
  echo '</table>'."\n";
  // Page Sorting
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
  echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
  echo '<td align="center" width="2%"><strong>&nbsp;</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
  echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` ORDER BY $column $direction LIMIT $min,$perpage");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
    $masscidr = str_replace("||", ",<br />", $masscidr);
    if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
    $getIPs['c2c'] = strtoupper($getIPs['c2c']);
    $getIPs['flag_img'] = flag_img($getIPs['c2c']);
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_lo_ip'].'" target="_blank">'.$getIPs['ip_lo_ip'].'</a></td>'."\n";
    echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_hi_ip'].'" target="_blank">'.$getIPs['ip_hi_ip'].'</a></td>'."\n";
    echo '<td align="center"'.$valign.'>'.$getIPs['flag_img'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.date("Y-m-d",$getIPs['date']).'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
    echo '<td align="center"'.$valign.' nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABExcludedViewPrint&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'" target="_blank"><img src="images/nukesentinel/print.png" border="0" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABExcludedView&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'" target="_blank"><img src="images/nukesentinel/view.png" border="0" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABExcludedEdit&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABExcludedDelete&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a></td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction);
} else {
  echo '<center><strong>'._AB_NORANGES.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>