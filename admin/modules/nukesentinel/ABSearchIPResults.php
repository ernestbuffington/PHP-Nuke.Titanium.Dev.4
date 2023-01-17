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
if(!empty($sip)) { $torun = 1; } else { $torun = 0; }
$sip = str_replace("X", "%", isset($sip));
OpenTable();
OpenMenu(_AB_SEARCHIPS);
mastermenu();
CarryMenu();
searchmenu();
CloseMenu();
CloseTable();
$tempsip = str_replace("%", "X", $sip);
$tempsip = str_replace("*", "X", $tempsip);
$tempip = str_replace("*", "0", $sip);
$tempip = str_replace("%", "0", $tempip);
$tempip = sprintf("%u", ip2long($tempip));
echo '<br />'."\n";
OpenTable();
echo '<form action="'.$admin_file.'.php?op=ABSearchIPResults" method="post">'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" colspan="2"><i>'._AB_SEARCHNOTE.'</i></td></tr>'."\n";
echo '<tr><td align="center"><strong>'._AB_SEARCHFOR.':</strong><br />'."\n";
echo '<input type="text" name="sip" value="'.$sip.'" style="text-align: center;" /></td></tr>'."\n";
echo '<tr><td align="center"><input type="submit" value="'._AB_GO.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
echo '<form action="'.$admin_file.'.php?op=ABSearchIPPrint" method="post" target="_blank">'."\n";
echo '<input type="hidden" name="sip" value="'.$tempsip.'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center"><input type="submit" value="'._AB_PRINTERFRIENDLY.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
if($torun > 0) {
  //BLOCKED IP SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr` LIKE '$sip'"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    OpenTable();
    echo '<center class="title"><strong>'._AB_SEARCHBLOCKEDIPS.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td width="20%"><strong>'._AB_IPBLOCKED.'</strong></td>'."\n";
    echo '<td width="2%"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_EXPIRES.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_REASON.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr` LIKE '$sip' ORDER BY `ip_long`");
    while($getIPs = $db->sql_fetchrow($result)) {
      list($getIPs['reason']) = $db->sql_fetchrow($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
      $getIPs['reason'] = str_replace("Abuse-", "", $getIPs['reason']);
      $bdate = date("Y-m-d @ H:i:s", $getIPs['date']);
      $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
      if($getIPs['expires']==0) { $bexpire = _AB_PERMENANT; } else { $bexpire = date("Y-m-d @ H:i:s", $getIPs['expires']); }
      list($bname) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='".$getIPs['user_id']."' LIMIT 0,1"));
      $qs = htmlentities(base64_decode($getIPs['query_string']));
      $qs = str_replace("%20", " ", $qs);
      $qs = str_replace("/**/", "/* */", $qs);
      $qs = str_replace("&", "<br />&", $qs);
      $ua = $getIPs['user_agent'];
      $ua = htmlentities($ua, ENT_QUOTES);
      $countrytitle = abget_countrytitle($getIPs['c2c']);
      $flagimg = flag_img($countrytitle['c2c']);
      echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      echo '<td>'.info_img("<strong>"._AB_USERAGENT.":</strong> $ua<br /><br /><strong>"._AB_QUERY.":</strong> $qs").' <a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$getIPs['ip_addr'].'</a></td>'."\n";
      echo '<td width="2%">'.$flagimg.'</td>'."\n";
      echo '<td align="center">'.$bdate.'</td>'."\n";
      echo '<td align="center">'.$bexpire.'</td>'."\n";
      echo '<td align="center">'.$getIPs['reason'].'</td>'."\n";
      echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABBlockedIPViewPrint&amp;xIPs='.$getIPs['ip_addr'].'" target="_blank"><img src="images/nukesentinel/print.png" border="0" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" height="16" width="16" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABBlockedIPView&amp;xIPs='.$getIPs['ip_addr'].'" target="_blank"><img src="images/nukesentinel/view.png" border="0" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" height="16" width="16" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABBlockedIPEdit&amp;xIPs='.$getIPs['ip_addr'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'&amp;sip='.$tempsip.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABBlockedIPDelete&amp;xIPs='.$getIPs['ip_addr'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'&amp;sip='.$tempsip.'"><img src="images/nukesentinel/unblock.png" border="0" alt="'._AB_UNBLOCK.'" title="'._AB_UNBLOCK.'" height="16" width="16" /></a></td>'."\n";
      echo '</tr>'."\n";
    }
    echo '</table>'."\n";
    CloseTable();
  }
  //BLOCKED RANGES SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    OpenTable();
    echo '<center class="title"><strong>'._AB_SEARCHBLOCKEDRANGES.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="2%"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
    echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
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
      $getIPs['flag_img'] = flag_img($getIPs['c2c']);
      echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_lo_ip'].'" target="_blank">'.$getIPs['ip_lo_ip'].'</a></td>'."\n";
      echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_hi_ip'].'" target="_blank">'.$getIPs['ip_hi_ip'].'</a></td>'."\n";
      echo '<td align="center"'.$valign.'>'.$getIPs['flag_img'].'</td>'."\n";
      echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
      echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
      echo '<td align="center"'.$valign.' nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;sip='.$tempsip.'&amp;xop='.$op.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;sip='.$tempsip.'&amp;xop='.$op.'"><img src="images/nukesentinel/unblock.png" border="0" alt="'._AB_UNBLOCK.'" title="'._AB_UNBLOCK.'" height="16" width="16" /></a></td>'."\n";
      echo '</tr>'."\n";
      $x++;
    }
    echo '</table>'."\n";
    CloseTable();
  }
  //EXCLUDED RANGES SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    OpenTable();
    echo '<center class="title"><strong>'._AB_SEARCHEXCLUDEDRANGES.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="2%"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
    echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
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
      $getIPs['flag_img'] = flag_img($getIPs['c2c']);
      echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_lo_ip'].'" target="_blank">'.$getIPs['ip_lo_ip'].'</a></td>'."\n";
      echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_hi_ip'].'" target="_blank">'.$getIPs['ip_hi_ip'].'</a></td>'."\n";
      echo '<td align="center"'.$valign.'>'.$getIPs['flag_img'].'</td>'."\n";
      echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
      echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
      echo '<td align="center"'.$valign.' nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABExcludedEdit&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;sip='.$tempsip.'&amp;xop='.$op.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABExcludedDelete&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;sip='.$tempsip.'&amp;xop='.$op.'"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a></td>'."\n";
      echo '</tr>'."\n";
      $x++;
    }
    echo '</table>'."\n";
    CloseTable();
  }
  //PROTECTED RANGES SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    OpenTable();
    echo '<center class="title"><strong>'._AB_SEARCHPROTECTEDRANGES.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="2%"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
    echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
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
      $getIPs['flag_img'] = flag_img($getIPs['c2c']);
      echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_lo_ip'].'" target="_blank">'.$getIPs['ip_lo_ip'].'</a></td>'."\n";
      echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_hi_ip'].'" target="_blank">'.$getIPs['ip_hi_ip'].'</a></td>'."\n";
      echo '<td align="center"'.$valign.'>'.$getIPs['flag_img'].'</td>'."\n";
      echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
      echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
      echo '<td align="center"'.$valign.' nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABProtectedEdit&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;sip='.$tempsip.'&amp;xop='.$op.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABProtectedDelete&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;sip='.$tempsip.'&amp;xop='.$op.'"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a></td>'."\n";
      echo '</tr>'."\n";
      $x++;
    }
    echo '</table>'."\n";
    CloseTable();
  }
  //IP 2 COUNTRY SEARCH
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip'"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    OpenTable();
    echo '<center class="title"><strong>'._AB_IP2CSEARCH.'</strong></center><br />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="2%"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="25%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
    echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
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
      $getIPs['flag_img'] = flag_img($getIPs['c2c']);
      echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_lo_ip'].'" target="_blank">'.$getIPs['ip_lo_ip'].'</a></td>'."\n";
      echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_hi_ip'].'" target="_blank">'.$getIPs['ip_hi_ip'].'</a></td>'."\n";
      echo '<td align="center"'.$valign.'>'.$getIPs['flag_img'].'</td>'."\n";
      echo '<td align="center"'.$valign.'>'.date("Y-m-d", $getIPs['date']).'</td>'."\n";
      echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
      echo '<td align="center"'.$valign.' nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABBlockedRangeAdd&amp;ip_lo='.$getIPs['ip_lo_ip'].'&amp;ip_hi='.$getIPs['ip_hi_ip'].'&amp;tc2c='.strtolower($getIPs['c2c']).'" target="_blank"><img src="images/nukesentinel/block.png" border="0" alt="'._AB_BLOCK.'" title="'._AB_BLOCK.'" height="16" width="16" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABIP2CountryEdit&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;sip='.$tempsip.'&amp;xop='.$op.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABIP2CountryDelete&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;sip='.$tempsip.'&amp;xop='.$op.'"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a></td>'."\n";
      echo '</tr>'."\n";
      $x++;
    }
    echo '</table>'."\n";
    CloseTable();
  }
  //TRACKED IP SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT `username`, `ip_addr`, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` WHERE `ip_addr` LIKE '$sip' GROUP BY 1,2"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    OpenTable();
    echo '<center class="title"><strong>'._AB_SEARCHTRACKEDIPS.'</strong></center><br />'."\n";
    echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td><strong>'._AB_IPADDRESS.'</strong></td>'."\n";
    echo '<td align="center" width="2%"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="center"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
    echo '<td align="center"><strong>'._AB_HITS.'</strong></td>'."\n";
    echo '<td align="center"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
    $result = $db->sql_query("SELECT `user_id`, `username`, `ip_addr`, MAX(`date`), COUNT(*), MIN(`tid`), `c2c` FROM `".$prefix."_nsnst_tracked_ips` WHERE `ip_addr` LIKE '$sip' GROUP BY 2,3");
    while(list($userid,$username,$ipaddr,$lastview,$hits,$tid, $c2c) = $db->sql_fetchrow($result)){
      echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      echo '<td>';
      if($userid != 1) {
        echo '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$username.'" target="_blank"><img src="images/nukesentinel/usericon.png" height="16" width="16" alt="'.$username.'" title="'.$username.'" border="0" /></a>';
      } else {
        echo '<img src="images/nukesentinel/anonicon.png" height="16" width="16" alt="'.$anonymous.'" title="'.$anonymous.'" border="0" />';
      }
      echo ' <a href="'.$ab_config['lookup_link'].$ipaddr.'" target="_blank">'.$ipaddr.'</a></td>'."\n";
      $countrytitle = abget_countrytitle($c2c);
      $getIPs['country'] = $countrytitle['country'];
      $flagimg = flag_img($countrytitle['c2c']);
      echo '<td align="center">'.$flagimg.'</td>'."\n";
      echo '<td align="center">'.date("Y-m-d \@ H:i:s",$lastview).'</td>'."\n";
      echo '<td align="center">'.$hits.'</td>'."\n";
      echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABTrackedPagesPrint&amp;user_id='.$userid.'&amp;ip_addr='.$ipaddr.'" target="_blank"><img src="images/nukesentinel/print.png" height="16" width="16" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" border="0" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABTrackedPages&amp;user_id='.$userid.'&amp;ip_addr='.$ipaddr.'" target="_blank"><img src="images/nukesentinel/view.png" height="16" width="16" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" border="0" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABTrackedAdd&amp;tid='.$tid.'&amp;xop='.$op.'&amp;sip='.$tempsip.'" target="_blank"><img src="images/nukesentinel/block.png" height="16" width="16" alt="'._AB_BLOCK.'" title="'._AB_BLOCK.'" border="0" /></a>'."\n";
      echo '<a href="'.$admin_file.'.php?op=ABTrackedDelete&amp;tid='.$tid.'&amp;xop='.$op.'&amp;sip='.$tempsip.'"><img src="images/nukesentinel/delete.png" height="16" width="16" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" border="0" /></a></td>'."\n";
      echo '</tr>'."\n";
    }
    echo '</table>'."\n";
    CloseTable();
  }
  //USER IP SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$user_prefix."_users` WHERE `last_ip` LIKE '$sip'"));
  if($totalselected > 0) {
    echo '<br />'."\n";
    OpenTable();
    echo '<center class="title"><strong>'._AB_USERSDB.'</strong></center><br />'."\n";
    echo '<table summary="" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0" width="100%">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td width="20%"><strong>'._AB_USERNAME.'</strong></td>'."\n";
    echo '<td width="35%"><strong>'._AB_USEREMAIL.'</strong></td>'."\n";
    echo '<td align="center" width="10%"><strong>'._AB_USERID.'</strong></td>'."\n";
    echo '<td align="center" width="20%"><strong>'._AB_LASTIP.'</strong></td>'."\n";
    echo '<td width="2%"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="right" width="15%"><strong>'._AB_REGDATE.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $result = $db->sql_query("SELECT * FROM `".$user_prefix."_users` WHERE `last_ip` LIKE '$sip'");
    while($chnginfo = $db->sql_fetchrow($result)) {
      echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      echo '<td><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$chnginfo['username'].'" target="_blank">'.$chnginfo['username'].'</a></td>'."\n";
      echo '<td><a href="mailto:'.$chnginfo['user_email'].'">'.$chnginfo['user_email'].'</a></td>'."\n";
      echo '<td align="center">'.$chnginfo['user_id'].'</td>'."\n";
      echo '<td align="center"><a href="'.$ab_config['lookup_link'].$chnginfo['last_ip'].'" target="_blank">'.$chnginfo['last_ip'].'</a></td>'."\n";
      $countryinfo = abget_country($chnginfo['last_ip']);
      $flagimg = flag_img($countryinfo['c2c']);
      echo '<td align="center">'.$flagimg.'</td>'."\n";
      echo '<td align="right">'.$chnginfo['user_regdate'].'</td>'."\n";
      echo '</tr>'."\n";
    }
    echo '</table>'."\n";
    CloseTable();
  }
}
include_once(NUKE_BASE_DIR.'footer.php');

?>