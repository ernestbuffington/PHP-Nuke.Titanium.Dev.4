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
$pagetitle = _AB_NUKESENTINEL.": "._AB_SEARCHIPS;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
echo '<br />'."\n";
$sip = str_replace("X", "%", $sip);
$tempip = str_replace("%", "0", $sip);
$tempip = sprintf("%u", ip2long($tempip));
//BLOCKED IP SEARCH RESULTS
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr` LIKE '$sip'"));
if($totalselected > 0) {
  echo '<br />'."\n";
  echo '<center class="title"><strong>'._AB_SEARCHBLOCKEDIPS.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td width="20%"><strong>'._AB_IPBLOCKED.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_EXPIRES.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_REASON.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr` LIKE '$sip' ORDER BY `ip_long`");
  while($getIPs = $db->sql_fetchrow($result)) {
    list($getIPs['reason']) = $db->sql_fetchrow($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
    $getIPs['reason'] = str_replace("Abuse-", "", $getIPs['reason']);
    $bdate = date("Y-m-d", $getIPs['date']);
    $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
    if($getIPs['expires']==0) { $bexpire = _AB_PERMENANT; } else { $bexpire = date("Y-m-d", $getIPs['expires']); }
    list($bname) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='".$getIPs['user_id']."' LIMIT 0,1"));
    echo '<tr bgcolor="#ffffff">'."\n";
    $qs = htmlentities(base64_decode($getIPs['query_string']));
    $qs = str_replace("%20", " ", $qs);
    $qs = str_replace("/**/", "/* */", $qs);
    $qs = str_replace("&", "<br />&", $qs);
    $ua = $getIPs['user_agent'];
    $ua = htmlentities($ua, ENT_QUOTES);
    echo '<td>'.$getIPs['ip_addr'].'</td>'."\n";
    $countrytitle = abget_countrytitle($getIPs['c2c']);
    $getIPs['country'] = $countrytitle['country'];
    echo '<td align="center">('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
    echo '<td align="center">'.$bdate.'</td>'."\n";
    echo '<td align="center">'.$bexpire.'</td>'."\n";
    echo '<td align="center">'.$getIPs['reason'].'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
}
//BLOCKED RANGES SEARCH RESULTS
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'"));
if($totalselected > 0) {
  echo '<br />'."\n";
  echo '<center class="title"><strong>'._AB_SEARCHBLOCKEDRANGES.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
  echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $x = 0;
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
    $masscidr = str_replace("||", ",<br />", $masscidr);
    if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
    $getIPs['c2c'] = strtoupper($getIPs['c2c']);
    $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
    $getIPs['country'] = $countrytitleinfo['country'];
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td'.$valign.'>'.$getIPs['ip_lo_ip'].'</td>'."\n";
    echo '<td'.$valign.'>'.$getIPs['ip_hi_ip'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
    echo '</tr>'."\n";
    $x++;
  }
  echo '</table>'."\n";
}
//EXCLUDED RANGES SEARCH RESULTS
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'"));
if($totalselected > 0) {
  echo '<br />'."\n";
  echo '<center class="title"><strong>'._AB_SEARCHEXCLUDEDRANGES.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
  echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $x = 0;
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
    $masscidr = str_replace("||", ",<br />", $masscidr);
    if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
    $getIPs['c2c'] = strtoupper($getIPs['c2c']);
    $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
    $getIPs['country'] = $countrytitleinfo['country'];
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td'.$valign.'>'.$getIPs['ip_lo_ip'].'</td>'."\n";
    echo '<td'.$valign.'>'.$getIPs['ip_hi_ip'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.$masscidr.'s</td>'."\n";
    echo '</tr>'."\n";
    $x++;
  }
  echo '</table>'."\n";
}
//PROTECTED RANGES SEARCH RESULTS
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'"));
if($totalselected > 0) {
  echo '<br />'."\n";
  echo '<center class="title"><strong>'._AB_SEARCHPROTECTEDRANGES.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
  echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $x = 0;
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
    $masscidr = str_replace("||", ",<br />", $masscidr);
    if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
    $getIPs['c2c'] = strtoupper($getIPs['c2c']);
    $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
    $getIPs['country'] = $countrytitleinfo['country'];
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td'.$valign.'>'.$getIPs['ip_lo_ip'].'</td>'."\n";
    echo '<td'.$valign.'>'.$getIPs['ip_hi_ip'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
    echo '</tr>'."\n";
    $x++;
  }
  echo '</table>'."\n";
}
//IP 2 COUNTRY SEARCH
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'"));
if($totalselected > 0) {
  echo '<br />'."\n";
  echo '<center class="title"><strong>'._AB_IP2CSEARCH.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
  echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="20%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $x = 0;
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
    $masscidr = str_replace("||", ",<br />", $masscidr);
    if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
    $getIPs['c2c'] = strtoupper($getIPs['c2c']);
    $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
    $getIPs['country'] = $countrytitleinfo['country'];
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td'.$valign.'>'.$getIPs['ip_lo_ip'].'</td>'."\n";
    echo '<td'.$valign.'>'.$getIPs['ip_hi_ip'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
    echo '</tr>'."\n";
    $x++;
  }
  echo '</table>'."\n";
}
//TRACKED IP SEARCH RESULTS
$totalselected = $db->sql_numrows($db->sql_query("SELECT `username`, `ip_addr`, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` WHERE `ip_addr` LIKE '$sip' GROUP BY 1,2"));
if($totalselected > 0) {
  echo '<br />'."\n";
  echo '<center class="title"><strong>'._AB_SEARCHTRACKEDIPS.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td width="25%"><strong>'._AB_IPADDRESS.'</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_HITS.'</strong></td>'."\n";
  $result = $db->sql_query("SELECT `user_id`, `username`, `ip_addr`, MAX(`date`), COUNT(*), MIN(`tid`), `c2c` FROM `".$prefix."_nsnst_tracked_ips` WHERE `ip_addr` LIKE '$sip' GROUP BY 2,3");
  while(list($userid,$username,$ipaddr,$lastview,$hits,$tid, $c2c) = $db->sql_fetchrow($result)){
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td>'.$ipaddr.'</td>'."\n";
    $countrytitle = abget_countrytitle($c2c);
    echo '<td align="center">('.strtoupper($countrytitle['c2c']).') '.$countrytitle['country'].'</td>'."\n";
    echo '<td align="center">'.date("Y-m-d",$lastview).'</td>'."\n";
    echo '<td align="center">'.$hits.'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
}
//USER IP SEARCH RESULTS
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$user_prefix."_users` WHERE `last_ip` LIKE '$sip'"));
if($totalselected > 0) {
  echo '<br />'."\n";
  echo '<center class="title"><strong>'._AB_USERSDB.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td width="16%"><strong>'._AB_USERNAME.'</strong></td>'."\n";
  echo '<td width="16%"><strong>'._AB_USEREMAIL.'</strong></td>'."\n";
  echo '<td align="center" width="16%"><strong>'._AB_USERID.'</strong></td>'."\n";
  echo '<td align="center" width="16%"><strong>'._AB_LASTIP.'</strong></td>'."\n";
  echo '<td align="center" width="16%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '<td align="center" width="16%"><strong>'._AB_REGDATE.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT * FROM `".$user_prefix."_users` WHERE `last_ip` LIKE '$sip'");
  while($chnginfo = $db->sql_fetchrow($result)) {
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td>'.$chnginfo['username'].'</td>'."\n";
    echo '<td>'.$chnginfo['user_email'].'</td>'."\n";
    echo '<td align="center">'.$chnginfo['user_id'].'</td>'."\n";
    echo '<td align="center">'.$chnginfo['last_ip'].'</td>'."\n";
    $countryinfo = abget_country($chnginfo['last_ip']);
    echo '<td align="center"><strong>('.strtoupper($countryinfo['c2c']).') '.$countryinfo['country'].'</strong></td>'."\n";
    echo '<td align="center">'.$chnginfo['user_regdate'].'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
}
echo '</body>'."\n";
echo '</html>';

?>