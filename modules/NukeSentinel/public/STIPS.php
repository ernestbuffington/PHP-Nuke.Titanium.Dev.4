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
stmain_menu(_AB_BLOCKEDIPS);
echo '<br />'."\n";
OpenTable();
if (!isset($perpage) or $perpage == 0) { $perpage = 50; } else { $perpage = intval($perpage); }
if (!isset($min)) { $min=0; } else { $min = intval($min); }
if (!isset($max)) { $max = $min + $perpage; } else { $max = intval($max); }
if ($column != "ip_long" and $column != "reason" and $column != "date") { $column = "ip_long"; }
if ($direction != "asc" and $direction != "desc") { $direction = "asc"; }
$totalselected = $db->sql_numrows($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blocked_ips`"));
if ($totalselected > 0) {
  // Page Sorting
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
  echo '<tr><td align="right" colspan="3">'."\n";
  echo '<form action="modules.php?name='.$module_name.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
  echo '<input type="hidden" name="op" value="STIPS" />'."\n";
  echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
  echo '<strong>'._AB_SORT.':</strong> ';
  echo '<select name="column">'."\n";
  if($column == "ip_long") $selcolumn1 = ' selected="selected"';
  echo '<option value="ip_long"'.$selcolumn1.'>'._AB_IPBLOCKED.'</option>'."\n";
  if($column == "date") $selcolumn2 = ' selected="selected"';
  echo '<option value="date"'.$selcolumn2.'>'._AB_DATE.'</option>'."\n";
  if($column == "reason") $selcolumn3 = ' selected="selected"';
  echo '<option value="reason"'.$selcolumn3.'>'._AB_REASON.'</option>'."\n";
  echo '</select> ';
  echo '<select name="direction">'."\n";
  if($direction == "asc") $seldirection1 = ' selected="selected"';
  echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
  if($direction == "desc") $seldirection2 = ' selected="selected"';
  echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
  echo '</select> ';
  echo '<input type="submit" value="'._AB_SORT.'" />'."\n";
  echo '</form>'."\n";
  echo '</td></tr>'."\n";
  echo '</table>'."\n";
  // Page Sorting
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td align="center" width="34%"><strong>'._AB_IPBLOCKED.'</strong></td>'."\n";
  echo '<td align="center" width="33%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="33%"><strong>'._AB_REASON.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` ORDER BY $column $direction LIMIT $min,$perpage");
  while ($getIPs = $db->sql_fetchrow($result)) {
    $bdate = date("Y-m-d @ H:i:s", $getIPs['date']);
    $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    if((is_admin() AND $ab_config['display_link']==1) OR ((is_user() OR is_admin()) AND $ab_config['display_link']==2) OR $ab_config['display_link']==3) {
      $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
      $ipcontent = '<a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$getIPs['ip_addr'].'</a>';
    } else {
      $ipcontent = $getIPs['ip_addr'];
    }
    echo '<td align="center">'.$ipcontent.'</td>'."\n";
    echo '<td align="center">'.$bdate.'</td>'."\n";
    $reason = "----------";
    if((is_admin() AND $ab_config['display_reason']==1) OR ((is_user() OR is_admin()) AND $ab_config['display_reason']==2) OR $ab_config['display_reason']==3) {
      $result2 = $db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1");
      list($reason) = $db->sql_fetchrow($result2);
      $reason = str_replace("Abuse-","",$reason);
    }
    echo '<td align="center">'.$reason.'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  stpagenumspub($op, $totalselected, $perpage, $max, $column, $direction);
} else {
  echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>