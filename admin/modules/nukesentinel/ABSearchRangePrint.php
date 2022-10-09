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
$pagetitle = _AB_NUKESENTINEL.": "._AB_SEARCHRANGES;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
echo '<br />'."\n";
$longip_lo = sprintf("%u", ip2long($sip_lo)); // 0
$longip_hi = sprintf("%u", ip2long($sip_hi)); // 4294967295
//BLOCKED IP SEARCH RESULTS
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_long` >='$longip_lo' AND `ip_long`<='$longip_hi'"));
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
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_long` >='$longip_lo' AND `ip_long`<='$longip_hi'");
  while($getIPs = $db->sql_fetchrow($result)) {
    list($getIPs['reason']) = $db->sql_fetchrow($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
    $getIPs['reason'] = str_replace("Abuse-", "", $getIPs['reason']);
    $bdate = date("Y-m-d", $getIPs['date']);
    $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
    if($getIPs['expires']==0) { $bexpire = _AB_PERMENANT; } else { $bexpire = date("Y-m-d", $getIPs['expires']); }
    list($bname) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='".$getIPs['user_id']."' LIMIT 0,1"));
    $qs = htmlentities(base64_decode($getIPs['query_string']));
    $qs = str_replace("%20", " ", $qs);
    $qs = str_replace("/**/", "/* */", $qs);
    $qs = str_replace("&", "<br />&", $qs);
    $ua = $getIPs['user_agent'];
    $ua = htmlentities($ua, ENT_QUOTES);
    $countrytitle = abget_countrytitle($getIPs['c2c']);
    $getIPs['country'] = $countrytitle['country'];
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td>'.$getIPs['ip_addr'].'</td>'."\n";
    echo '<td align="center">('.strtoupper($getIPs['c2c']).') '.$getIPs['country'].'</td>'."\n";
    echo '<td align="center">'.$bdate.'</td>'."\n";
    echo '<td align="center">'.$bexpire.'</td>'."\n";
    echo '<td align="center">'.$getIPs['reason'].'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
}
if($longip_lo > 0 || $longip_hi < 4294967295) {
  //BLOCKED RANGES SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    echo '<center class="title"><strong>'._AB_SEARCHBLOCKEDRANGES.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $x = 0;
    $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
    while($getIPs = $db->sql_fetchrow($result)) {
      $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
      $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
      $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
      $masscidr = str_replace("||", ",<br />", $masscidr);
      if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
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
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    echo '<center class="title"><strong>'._AB_SEARCHEXCLUDEDRANGES.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $x = 0;
    $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
    while($getIPs = $db->sql_fetchrow($result)) {
      $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
      $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
      $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
      $masscidr = str_replace("||", ",<br />", $masscidr);
      if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
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
  //PROTECTED RANGES SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    echo '<center class="title"><strong>'._AB_SEARCHPROTECTEDRANGES.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $x = 0;
    $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
    while($getIPs = $db->sql_fetchrow($result)) {
      $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
      $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
      $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
      $masscidr = str_replace("||", ",<br />", $masscidr);
      if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
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
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    echo '<center class="title"><strong>'._AB_IP2CSEARCH.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#000000" width="75%">'."\n";
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="20%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $x = 0;
    $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
    while($getIPs = $db->sql_fetchrow($result)) {
      $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
      $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
      $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
      $masscidr = str_replace("||", ",<br />", $masscidr);
      if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
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
}
echo '</body>'."\n";
echo '</html>';

?>