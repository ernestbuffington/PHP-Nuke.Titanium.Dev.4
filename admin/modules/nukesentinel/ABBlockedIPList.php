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
OpenMenu(_AB_BLOCKEDIPS);
mastermenu();
CarryMenu();
blockedipmenu();
CloseMenu();
CloseTable();

OpenTable();
$perpage = $ab_config['block_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($min)) { $min=0; }
if(!isset($max)) { $max=$min+$perpage; }
if(!isset($column) || empty($column)) $column = $ab_config['block_sort_column'];
if(!isset($direction) || empty($direction)) $direction = $ab_config['block_sort_direction'];
if(!isset($selcolumn1)) $selcolumn1 = '';
if(!isset($selcolumn2)) $selcolumn2 = '';
if(!isset($selcolumn3)) $selcolumn3 = '';
if(!isset($selcolumn4)) $selcolumn4 = '';
if(!isset($selcolumn5)) $selcolumn5 = '';
if(!isset($seldirection1)) $seldirection1 = '';
if(!isset($seldirection2)) $seldirection2 = '';
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips`"));
if($totalselected > 0) {
  $selcolumn1 = $selcolumn2 = $selcolumn3 = $selcolumn4 = $selcolumn5 = $seldirection1 = $seldirection2 = '';
  if($column == "c2c") { $selcolumn2 = ' selected="selected"'; }
  elseif($column == "date") { $selcolumn3 = ' selected="selected"'; }
  elseif($column == "expires") { $selcolumn4 = ' selected="selected"'; }
  elseif($column == "reason") { $selcolumn5 = ' selected="selected"'; }
  else { $selcolumn1 = ' selected="selected"'; }
  if($direction == "desc") { $seldirection2 = ' selected="selected"'; }
  else { $seldirection1 = ' selected="selected"'; }
  // Page Sorting
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
  echo '<tr>'."\n";
  echo '<td align="right" nowrap="nowrap">'."\n";
  echo '<form class="nuke-sentinel-blocked-ip-list" action="'.$admin_file.'.php?op=ABBlockedIPList" method="post" style="padding: 0px; margin: 0px;">'."\n";
  echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
  echo '<option value="ip_long"'.$selcolumn1.'>'._AB_IPBLOCKED.'</option>'."\n";
  echo '<option value="expires"'.$selcolumn2.'>'._AB_EXPIRES.'</option>'."\n";
  echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
  echo '<option value="reason"'.$selcolumn4.'>'._AB_REASON.'</option>'."\n";
  echo '<option value="c2c"'.$selcolumn5.'>'._AB_C2CODE.'</option>'."\n";
  echo '</select> <select name="direction">'."\n";
  echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
  echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
  echo '</select> <input type="hidden" name="min" value="'.$min.'" /><input type="submit" value="'._AB_SORT.'" />'."\n";
  echo '</form>'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";
  echo '</table>'."\n";
  // Page Sorting
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td width="20%"><strong>'._AB_IPBLOCKED.'</strong></td>'."\n";
  echo '<td width="2%"><strong>&nbsp;</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_EXPIRES.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_REASON.'</strong></td>'."\n";
  echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` ORDER BY `$column` $direction LIMIT $min,$perpage");
  while($getIPs = $db->sql_fetchrow($result)) {
    list($getIPs['reason']) = $db->sql_fetchrow($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
    $getIPs['reason'] = str_replace("Abuse-", "", $getIPs['reason']);
    $bdate = date("Y-m-d @ H:i:s", $getIPs['date']);
    $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
    if($getIPs['expires']==0) { $bexpire = _AB_PERMENANT; } else { $bexpire = date("Y-m-d @ H:i:s", $getIPs['expires']); }
    list($bname) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='".$getIPs['user_id']."' LIMIT 0,1"));
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    $qs = htmlentities(base64_decode($getIPs['query_string']));
    $qs = str_replace("%20", " ", $qs);
    $qs = str_replace("/**/", "/* */", $qs);
    $qs = str_replace("&", "<br />&", $qs);
    $gs = htmlentities(base64_decode($getIPs['get_string']));
    $gs = str_replace("%20", " ", $gs);
    $gs = str_replace("/**/", "/* */", $gs);
    $gs = str_replace("&", "<br />&", $gs);
    $ps = htmlentities(base64_decode($getIPs['post_string']));
    $ps = str_replace("%20", " ", $ps);
    $ps = str_replace("/**/", "/* */", $ps);
    $ps = str_replace("&", "<br />&", $ps);
    $ua = $getIPs['user_agent'];
    $ua = htmlentities($ua, ENT_QUOTES);
    $getIPs['flag_img'] = flag_img($getIPs['c2c']);
    echo '<td>'.info_img('<strong>'._AB_USERAGENT.':</strong> '.$ua.'<br /><br /><strong>'._AB_QUERY.':</strong> '.$qs.'<br /><br /><strong>'._AB_GET.':</strong> '.$gs.'<br /><br /><strong>'._AB_POST.':</strong> '.$ps).' <a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$getIPs['ip_addr'].'</a></td>'."\n";
    echo '<td width="2%">'.$getIPs['flag_img'].'</td>'."\n";
    echo '<td align="center">'.$bdate.'</td>'."\n";
    echo '<td align="center">'.$bexpire.'</td>'."\n";
    echo '<td align="center">'.$getIPs['reason'].'</td>'."\n";
    echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABBlockedIPViewPrint&amp;xIPs='.$getIPs['ip_addr'].'" target="_blank"><img src="modules/NukeSentinel/images/print.png" border="0" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABBlockedIPView&amp;xIPs='.$getIPs['ip_addr'].'" target="_blank"><img src="modules/NukeSentinel/images/view.png" border="0" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABBlockedIPEdit&amp;xIPs='.$getIPs['ip_addr'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="modules/NukeSentinel/images/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABBlockedIPDelete&amp;xIPs='.$getIPs['ip_addr'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="modules/NukeSentinel/images/unblock.png" border="0" alt="'._AB_UNBLOCK.'" title="'._AB_UNBLOCK.'" height="16" width="16" /></a></td>'."\n";
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