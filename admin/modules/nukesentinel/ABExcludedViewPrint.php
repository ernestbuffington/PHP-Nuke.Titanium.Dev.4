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
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTEXCLUDED;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1"));
$getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
$getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
$countryrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_countries` WHERE `c2c`='".$getIPs['c2c']."' LIMIT 0,1"));
echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_IPLO.':</strong></td><td>'.$getIPs['ip_lo_ip'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_IPHI.':</strong></td><td>'.$getIPs['ip_hi_ip'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td valign="top"><strong>'._AB_NOTES.':</strong></td><td>'.$getIPs['notes'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_COUNTRY.':</strong></td><td>'.strtoupper($getIPs['c2c']).' - '.$countryrow['country'].'</td></tr>'."\n";
echo '</table>'."\n";
echo '</body>'."\n";
echo '</html>';

?>