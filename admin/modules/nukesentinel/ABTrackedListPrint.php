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

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
echo '<html>'."\n";
echo '<head>'."\n";
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTTRACKEDIPS;
if (!isset($modfilter)) $modfilter='';
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
$totalselected = $db->sql_numrows($db->sql_query("SELECT `username`, `ip_addr`, `ip_long`, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` GROUP BY 1,2,3"));
if($totalselected > 0) {
  echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td><strong>'._AB_USER.'</strong></td>'."\n";
  echo '<td><strong>'._AB_IPADDRESS.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_HITS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT `user_id`, `username`, `ip_addr`, `ip_long`, MAX(`date`), COUNT(*), MIN(`tid`), `c2c` FROM `".$prefix."_nsnst_tracked_ips` $modfilter GROUP BY 2,3,4 ORDER BY `ip_addr`");
  while(list($userid,$username,$ipaddr,$ip_long,$lastview,$hits,$tid,$c2c) = $db->sql_fetchrow($result)){
    $countrytitleinfo = abget_countrytitle($c2c);
    echo '<tr bgcolor="#ffffff">'."\n";
    if($userid != 1) { echo '<td>'.$username.'</td>'."\n"; } else { echo '<td>'.$anonymous.'</td>'."\n"; }
    echo '<td>'.$ipaddr.'</td>'."\n";
    echo '<td align="center">'.strtoupper($c2c).' - '.$countrytitleinfo['country'].'</td>'."\n";
    echo '<td align="center">'.date("Y-m-d \@ H:i:s",$lastview).'</td>'."\n";
    echo '<td align="center">'.$hits.'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
} else {
  echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
}
echo '</body>'."\n";
echo '</html>';

?>