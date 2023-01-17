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
OpenMenu(_AB_REFERIPTRACKING);
mastermenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();

OpenTable();
//$perpage = $ab_config['track_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
$tid=intval($tid);
list($uname) = $db->sql_fetchrow($db->sql_query("SELECT `refered_from` FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$totalselected = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips` WHERE `refered_from`='$uname'"));
if($totalselected > 0) {
  echo '<center><strong>'.$uname.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td nowrap="nowrap" width="40%"><strong>'._AB_IPADDRESSES.'</strong></td>'."\n";
  echo '<td align="center" width="30%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="30%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips` WHERE `refered_from`='$uname' ORDER BY `ip_long` LIMIT $min, $perpage");
  while(list($lipaddr) = $db->sql_fetchrow($result)){
    $newrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_tracked_ips` WHERE `refered_from`='$uname' AND `ip_addr`='$lipaddr' ORDER BY `date` DESC LIMIT 1"));
    $countrytitle = abget_countrytitle($newrow['c2c']);
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td><a href="'.$ab_config['lookup_link'].$lipaddr.'" target="_blank">'.$lipaddr.'</a></td>'."\n";
    echo '<td align="center" nowrap="nowrap">'.date("Y-m-d \@ H:i:s",$newrow['date']).'</td>'."\n";
    echo '<td align="center" nowrap="nowrap">'.$countrytitle['country'].'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction, "", "", $tid);
} else {
  echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>