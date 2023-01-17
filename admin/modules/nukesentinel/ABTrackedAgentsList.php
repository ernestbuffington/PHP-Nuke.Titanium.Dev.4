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
OpenMenu(_AB_TRACKEDAGENTS);
mastermenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();

OpenTable();
$tbcol = 5;
$perpage = $ab_config['track_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
if(!isset($column) or !$column or $column=="") $column = "user_agent";
if(!isset($direction) or !$direction or $direction=="") $direction = "asc";
$totalselected = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`user_agent`) FROM `".$prefix."_nsnst_tracked_ips` GROUP BY 1"));
if($totalselected > 0) {
  // Page Sorting
  $selcolumn1 = $selcolumn2 = $selcolumn3 = $seldirection1 = $seldirection2 = "";
  if($column == "date") { $selcolumn1 = ' selected="selected"'; }
  elseif($column == 4) { $selcolumn3 = ' selected="selected"'; }
  else { $selcolumn2 = ' selected="selected"'; }
  if($direction == "desc") { $seldirection2 = ' selected="selected"'; }
  else { $seldirection1 = ' selected="selected"'; }
  echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" border="0">'."\n";
  echo '<tr>'."\n";
  echo '<td align="right" nowrap="nowrap">'."\n";
  echo '<form action="'.$admin_file.'.php?op=ABTrackedAgentsList" method="post" style="padding: 0px; margin: 0px;">'."\n";
  echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
  echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
  echo '<option value="date"'.$selcolumn1.'>'._AB_DATE.'</option>'."\n";
  echo '<option value="user_agent"'.$selcolumn2.'>'._AB_USERAGENT.'</option>'."\n";
  echo '<option value="4"'.$selcolumn3.'>'._AB_HITS.'</option>'."\n";
  echo '</select> <select name="direction">'."\n";
  echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
  echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
  echo '</select> <input type="submit" value="'._AB_SORT.'" />'."\n";
  echo '</form>'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";
  echo '</table>'."\n";
  // Page Sorting
  echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td><strong>'._AB_USERAGENT.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_IPSTRACKED.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_HITS.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT DISTINCT(`user_agent`), tid, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` GROUP BY 1 ORDER BY $column $direction LIMIT $min, $perpage");
  while(list($user_agent, $tid, $lastview, $hits) = $db->sql_fetchrow($result)){
    $trackedips = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='$user_agent'"));
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td>'.htmlentities($user_agent, ENT_QUOTES).'</td>'."\n";
    echo '<td align="center"><a href="'.$admin_file.'.php?op=ABTrackedAgentsIPs&amp;tid='.$tid.'" target="_blank">'.$trackedips.'</a></td>'."\n";
    echo '<td align="center" nowrap="nowrap">'.date("Y-m-d \@ H:i:s",$lastview).'</td>'."\n";
    echo '<td align="center">'.$hits.'</td>'."\n";
    echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABTrackedAgentsPagesPrint&amp;tid='.$tid.'" target="_blank"><img src="images/print.png" height="16" width="16" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" border="0" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABTrackedAgentsPages&amp;tid='.$tid.'" target="_blank"><img src="images/magnify.png" height="16" width="16" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" border="0" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABTrackedAgentsListAdd&amp;tid='.$tid.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'"><img src="images/shield_red.png" height="16" width="16" alt="'._AB_BLOCK.'" title="'._AB_BLOCK.'" border="0" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABTrackedAgentsDelete&amp;tid='.$tid.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'"><img src="images/delete.png" height="16" width="16" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" border="0" /></a></td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction);
} else {
  echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>