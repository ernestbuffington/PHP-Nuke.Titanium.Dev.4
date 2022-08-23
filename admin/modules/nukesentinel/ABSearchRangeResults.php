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
$sip = str_replace("X", "%", $sip);
OpenTable();
OpenMenu(_AB_SEARCHRANGES);
mastermenu();
CarryMenu();
searchmenu();
CloseMenu();
CloseTable();
if(isset($sip_lo[0]) && isset($sip_lo[1]) && isset($sip_lo[2]) && isset($sip_lo[3])) {
  if(($sip_lo[0] < 0 OR $sip_lo[0] > 255 OR !is_numeric($sip_lo[0])) OR ($sip_lo[1] < 0 OR $sip_lo[1] > 255 OR !is_numeric($sip_lo[1])) OR ($sip_lo[2] < 0 OR $sip_lo[2] > 255 OR !is_numeric($sip_lo[2])) OR ($sip_lo[3] < 0 OR $sip_lo[3] > 255 OR !is_numeric($sip_lo[3]))) {
    echo '<br />'."\n";
    OpenTable();
    echo '<br />'."\n";
    echo '<center><strong>'._AB_LOERROR.' </strong></center><br />'."\n";
    echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    die();
  }
}
if(isset($sip_hi[0]) && isset($sip_hi[1]) && isset($sip_hi[2]) && isset($sip_hi[3])) {
  if(($sip_hi[0] < 0 OR $sip_hi[0] > 255 OR !is_numeric($sip_hi[0])) OR ($sip_hi[1] < 0 OR $sip_hi[1] > 255 OR !is_numeric($sip_hi[1])) OR ($sip_hi[2] < 0 OR $sip_hi[2] > 255 OR !is_numeric($sip_hi[2])) OR ($sip_hi[3] < 0 OR $sip_hi[3] > 255 OR !is_numeric($sip_hi[3]))) {
    echo '<br />'."\n";
    OpenTable();
    echo '<br />'."\n";
    echo '<center><strong>'._AB_HIERROR.' </strong></center><br />'."\n";
    echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    die();
  }
}
echo '<br />'."\n";
if(!isset($sip_lo[0])) { $sip_lo[0] = NULL; $torun = 0;} else { $torun = 1; }
if(!isset($sip_lo[1])) { $sip_lo[1] = 0; }
if(!isset($sip_lo[2])) { $sip_lo[2] = 0; }
if(!isset($sip_lo[3])) { $sip_lo[3] = 0; }
if(!isset($sip_hi[0])) { $sip_hi[0] = NULL; $torun = 0;} else { $torun = 1; }
if(!isset($sip_hi[1])) { $sip_hi[1] = 255; }
if(!isset($sip_hi[2])) { $sip_hi[2] = 255; }
if(!isset($sip_hi[3])) { $sip_hi[3] = 255; }
OpenTable();
echo '<form action="'.$admin_file.'.php?op=ABSearchRangeResults" method="post">'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" colspan="2"><strong>'._AB_SEARCHIN.':</strong></td></tr>'."\n";
echo '<tr><td align="right"><strong>'._AB_IPLO.':</strong></td>'."\n";
echo '<td><input type="text" name="sip_lo[0]" size="4" value="'.$sip_lo[0].'" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="sip_lo[1]" size="4" value="'.$sip_lo[1].'" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="sip_lo[2]" size="4" value="'.$sip_lo[2].'" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="sip_lo[3]" size="4" value="'.$sip_lo[3].'" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
echo ''."\n";
echo '<tr><td align="right"><strong>'._AB_IPHI.':</strong></td>'."\n";
echo '<td><input type="text" name="sip_hi[0]" size="4" value="'.$sip_hi[0].'" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="sip_hi[1]" size="4" value="'.$sip_hi[1].'" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="sip_hi[2]" size="4" value="'.$sip_hi[2].'" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="sip_hi[3]" size="4" value="'.$sip_hi[3].'" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
echo ''."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_GO.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
echo '<form action="'.$admin_file.'.php?op=ABSearchRangePrint" method="post" target="_blank">'."\n";
echo '<input type="hidden" name="sip_lo" value="'.$sip_lo[0].'.'.$sip_lo[1].'.'.$sip_lo[2].'.'.$sip_lo[3].'" />'."\n";
echo '<input type="hidden" name="sip_hi" value="'.$sip_hi[0].'.'.$sip_hi[1].'.'.$sip_hi[2].'.'.$sip_hi[3].'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center"><input type="submit" value="'._AB_PRINTERFRIENDLY.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
if(!isset($sip_lo[0])) { $sip_lo[0] = 0; }
if(!isset($sip_hi[0])) { $sip_hi[0] = 255; }
$sip_lo = implode(".", $sip_lo);
$longip_lo = sprintf("%u", ip2long($sip_lo)); // 0
$sip_hi = implode(".", $sip_hi);
$longip_hi = sprintf("%u", ip2long($sip_hi)); // 4294967295
if($torun > 0) {
//BLOCKED IP SEARCH RESULTS
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_long` >='$longip_lo' AND `ip_long`<='$longip_hi'"));
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
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_long` >='$longip_lo' AND `ip_long`<='$longip_hi'");
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
    echo '<a href="'.$admin_file.'.php?op=ABBlockedIPEdit&amp;xIPs='.$getIPs['ip_addr'].'&amp;xop='.$op.'&amp;sip='.$tempsip.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABBlockedIPDelete&amp;xIPs='.$getIPs['ip_addr'].'&amp;xop='.$op.'&amp;sip='.$tempsip.'"><img src="images/nukesentinel/unblock.png" border="0" alt="'._AB_UNBLOCK.'" title="'._AB_UNBLOCK.'" height="16" width="16" /></a></td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  CloseTable();
}

//BLOCKED RANGES SEARCH RESULTS
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`"));
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
    $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
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
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`"));
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
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
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
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`"));
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
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
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
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`"));
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
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo') OR (`ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi') OR (`ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi') OR (`ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi') ORDER BY `ip_lo`");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
    $masscidr = str_replace("||", ",<br />", $masscidr);
    if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
    $getIPs['c2c'] = strtoupper($getIPs['c2c']);
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
}
include_once(NUKE_BASE_DIR.'footer.php');

?>