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
OpenMenu(_AB_REFERERLISTING);
mastermenu();
CarryMenu();
referermenu();
CloseMenu();
CloseTable();

OpenTable();
$perpage = $ab_config['block_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($min) or !$min or $min=="") $min=0;
if(!isset($max)) $max=$min+$perpage;
if(!isset($direction) or !$direction or $direction=="") $direction = "asc";
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_referers`"));
if($totalselected > 0) {
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td width="90%"><strong>'._AB_REFERER.'</strong></td>'."\n";
  echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_referers` ORDER BY `referer` $direction LIMIT $min,$perpage");
  while($getIPs = $db->sql_fetchrow($result)) {
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td>'.$getIPs['referer'].'</a></td>'."\n";
    echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABRefererEdit&amp;rid='.$getIPs['rid'].'&amp;direction='.$direction.'&amp;xop='.$op.'&amp;min='.$min.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABRefererDelete&amp;rid='.$getIPs['rid'].'&amp;direction='.$direction.'&amp;xop='.$op.'&amp;min='.$min.'"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a></td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  abadminpagenums($op, $totalselected, $perpage, $max, "", $direction);
} else {
  echo '<center><strong>'._AB_NOREFERERS.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>