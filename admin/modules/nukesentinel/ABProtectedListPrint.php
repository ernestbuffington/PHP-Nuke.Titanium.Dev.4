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
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTPROTECTEDRANGES;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges`"));
if($totalselected > 0) {
  echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td><strong>'._AB_IPLO.'</strong></td>'."\n";
  echo '<td><strong>'._AB_IPHI.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` ORDER BY `ip_lo`");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td>'.$getIPs['ip_lo_ip'].'</td>'."\n";
    echo '<td>'.$getIPs['ip_hi_ip'].'</td>'."\n";
    echo '<td align="center">'.strtoupper($getIPs['c2c']).' - '.$countrytitleinfo['country'].'</td>'."\n";
    echo '<td align="center">'.date("Y-m-d \@ H:i:s",$getIPs['date']).'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
} else {
  echo '<center><strong>'._AB_NORANGES.'</strong></center>'."\n";
}
echo '</body>'."\n";
echo '</html>';

?>