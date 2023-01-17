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
OpenMenu(_AB_VIEWRANGE);
mastermenu();
CarryMenu();
blockedrangemenu();
CloseMenu();
CloseTable();

OpenTable();
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1"));
$getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
$getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
$masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
$masscidr = str_replace("||", "<br />", $masscidr);
if($getIPs['expires']==0) { $getIPs['expires'] =_AB_PERMENANT; } else { $getIPs['expires'] = date("Y-m-d \@ H:i:s", $getIPs['expires']); }
$blockerrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
$countryrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_countries` WHERE `c2c`='".$getIPs['c2c']."' LIMIT 0,1"));
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPLO.':</strong></td><td>'.$getIPs['ip_lo_ip'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPHI.':</strong></td><td>'.$getIPs['ip_hi_ip'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_CIDRS.':</strong></td><td>'.$masscidr.'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_EXPIRES.':</strong></td><td>'.$getIPs['expires'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td>'.$getIPs['notes'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REASON.':</strong></td><td>'.$blockerrow['reason'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_COUNTRY.':</strong></td><td>'.$countryrow['country'].'</td></tr>'."\n";
echo '</table>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>