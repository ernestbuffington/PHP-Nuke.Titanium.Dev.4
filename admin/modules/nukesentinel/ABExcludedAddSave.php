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

if(($xip_lo[0] < 0 OR $xip_lo[0] > 255 OR !is_numeric($xip_lo[0])) OR ($xip_lo[1] < 0 OR $xip_lo[1] > 255 OR !is_numeric($xip_lo[1])) OR ($xip_lo[2] < 0 OR $xip_lo[2] > 255 OR !is_numeric($xip_lo[2])) OR ($xip_lo[3] < 0 OR $xip_lo[3] > 255 OR !is_numeric($xip_lo[3]))) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDRANGEERROR;
  include_once(NUKE_BASE_DIR.'header.php');
  title($pagetitle);
  OpenTable();
  echo '<br />'."\n";
  echo '<center><strong>'._AB_LOERROR.' </strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
  die();
}
$xip_lo = implode(".", $xip_lo);
$longip_lo = sprintf("%u", ip2long($xip_lo));
if(($xip_hi[0] < 0 OR $xip_hi[0] > 255 OR !is_numeric($xip_hi[0])) OR ($xip_hi[1] < 0 OR $xip_hi[1] > 255 OR !is_numeric($xip_hi[1])) OR ($xip_hi[2] < 0 OR $xip_hi[2] > 255 OR !is_numeric($xip_hi[2])) OR ($xip_hi[3] < 0 OR $xip_hi[3] > 255 OR !is_numeric($xip_hi[3]))) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDRANGEERROR;
  include_once(NUKE_BASE_DIR.'header.php');
  title($pagetitle);
  OpenTable();
  echo '<br />'."\n";
  echo '<center><strong>'._AB_HIERROR.' </strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
  die();
}
$xip_hi = implode(".", $xip_hi);
$longip_hi = sprintf("%u", ip2long($xip_hi));
if($longip_hi < $longip_lo) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDRANGEERROR;
  include_once(NUKE_BASE_DIR.'header.php');
  title($pagetitle);
  OpenTable();
  echo '<br />'."\n";
  echo '<center><strong>'._AB_HILOERROR.' </strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
  die();
}
$test1 = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_lo'");
$test2 = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`<='$longip_hi' AND `ip_hi`>='$longip_hi'");
$test3 = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`>='$longip_lo' AND `ip_hi`<='$longip_hi'");
$test4 = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`<='$longip_lo' AND `ip_hi`>='$longip_hi'");
$testnum1 = $db->sql_numrows($test1);
$testnum2 = $db->sql_numrows($test2);
$testnum3 = $db->sql_numrows($test3);
$testnum4 = $db->sql_numrows($test4);
if($testnum1 > 0 OR $testnum2 >0 OR $testnum3 >0 OR $testnum4 >0) {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_ADDEXCLUDEDERROR);
  mastermenu();
  CarryMenu();
  excludedmenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  if($testnum1 > 0) {
    $testmessage .= '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    $testmessage .= '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="6"><strong>'.long2ip($xip_lo).' '._AB_IN.':</strong></td></tr>'."\n";
    $testmessage .= '<tr bgcolor="'.$bgcolor2.'">'."\n";
    $testmessage .= '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    $testmessage .= '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="15%"><strong>'._AB_FLAG.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="15%"><strong>'._AB_CODE.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="20%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
    $testmessage .= '</tr>'."\n";
    while($testrow1 = $db->sql_fetchrow($test1)) {
      $testrow1['ip_lo_ip'] = long2ip($testrow1['ip_lo']);
      $testrow1['ip_hi_ip'] = long2ip($testrow1['ip_hi']);
      $testrow1['c2c'] = strtoupper($testrow1['c2c']);
      $testrow1['flag_img'] = flag_img($testrow1['c2c']);
      $testmessage .= '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow1['ip_lo_ip'].'" target="_blank">'.$testrow1['ip_lo_ip'].'</a></td>'."\n";
      $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow1['ip_hi_ip'].'" target="_blank">'.$testrow1['ip_hi_ip'].'</a></td>'."\n";
      $testmessage .= '<td align="center">'.$testrow1['flag_img'].'</td>'."\n";
      $testmessage .= '<td align="center">'.$testrow1['c2c'].'</td>'."\n";
      $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$testrow1['ip_lo'].'&amp;ip_hi='.$testrow1['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      $testmessage .= '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$testrow1['ip_lo'].'&amp;ip_hi='.$testrow1['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
      $testmessage .= '</tr>'."\n";
    }
    $testmessage .= '</table>'."\n";
    $testmessage .= '<br />'."\n";
  }
  if($testnum2 > 0) {
    $testmessage .= '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    $testmessage .= '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="6"><strong>'.long2ip($xip_hi).' '._AB_IN.':</strong></td></tr>'."\n";
    $testmessage .= '<tr bgcolor="'.$bgcolor2.'">'."\n";
    $testmessage .= '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    $testmessage .= '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="15%"><strong>'._AB_FLAG.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="15%"><strong>'._AB_CODE.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="20%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
    $testmessage .= '</tr>'."\n";
    while($testrow2 = $db->sql_fetchrow($test2)) {
      $testrow2['ip_lo_ip'] = long2ip($testrow2['ip_lo']);
      $testrow2['ip_hi_ip'] = long2ip($testrow2['ip_hi']);
      $testrow2['c2c'] = strtoupper($testrow2['c2c']);
      $testrow2['flag_img'] = flag_img($testrow2['c2c']);
      $testmessage .= '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow2['ip_lo_ip'].'" target="_blank">'.$testrow2['ip_lo_ip'].'</a></td>'."\n";
      $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow2['ip_hi_ip'].'" target="_blank">'.$testrow2['ip_hi_ip'].'</a></td>'."\n";
      $testmessage .= '<td align="center">'.$testrow2['flag_img'].'</td>'."\n";
      $testmessage .= '<td align="center">'.$testrow2['c2c'].'</td>'."\n";
      $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$testrow2['ip_lo'].'&amp;ip_hi='.$testrow2['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      $testmessage .= '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$testrow2['ip_lo'].'&amp;ip_hi='.$testrow2['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
      $testmessage .= '</tr>'."\n";
    }
    $testmessage .= '</table>'."\n";
    $testmessage .= '<br />'."\n";
  }
  if($testnum3 > 0) {
    $testmessage .= '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    $testmessage .= '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="6"><strong>'.long2ip($xip_lo).' - '.long2ip($xip_hi).' '._AB_COVERS.':</strong></td></tr>'."\n";
    $testmessage .= '<tr bgcolor="'.$bgcolor2.'">'."\n";
    $testmessage .= '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    $testmessage .= '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="15%"><strong>'._AB_FLAG.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="15%"><strong>'._AB_CODE.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="20%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
    $testmessage .= '</tr>'."\n";
    while($testrow3 = $db->sql_fetchrow($test3)) {
      $testrow3['ip_lo_ip'] = long2ip($testrow3['ip_lo']);
      $testrow3['ip_hi_ip'] = long2ip($testrow3['ip_hi']);
      $testrow3['c2c'] = strtoupper($testrow3['c2c']);
      $testrow3['flag_img'] = flag_img($testrow3['c2c']);
      $testmessage .= '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow3['ip_lo_ip'].'" target="_blank">'.$testrow3['ip_lo_ip'].'</a></td>'."\n";
      $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow3['ip_hi_ip'].'" target="_blank">'.$testrow3['ip_hi_ip'].'</a></td>'."\n";
      $testmessage .= '<td align="center">'.$testrow3['flag_img'].'</td>'."\n";
      $testmessage .= '<td align="center">'.$testrow3['c2c'].'</td>'."\n";
      $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$testrow3['ip_lo'].'&amp;ip_hi='.$testrow3['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      $testmessage .= '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$testrow3['ip_lo'].'&amp;ip_hi='.$testrow3['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
      $testmessage .= '</tr>'."\n";
    }
    $testmessage .= '</table>'."\n";
    $testmessage .= '<br />'."\n";
  }
  if($testnum4 > 0) {
    $testmessage .= '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    $testmessage .= '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="6"><strong>'.long2ip($xip_lo).' - '.long2ip($xip_hi).' '._AB_ISCOVERED.':</strong></td></tr>'."\n";
    $testmessage .= '<tr bgcolor="'.$bgcolor2.'">'."\n";
    $testmessage .= '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    $testmessage .= '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="15%"><strong>'._AB_FLAG.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="15%"><strong>'._AB_CODE.'</strong></td>'."\n";
    $testmessage .= '<td align="center" width="20%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
    $testmessage .= '</tr>'."\n";
    while($testrow4 = $db->sql_fetchrow($test4)) {
      $testrow4['ip_lo_ip'] = long2ip($testrow4['ip_lo']);
      $testrow4['ip_hi_ip'] = long2ip($testrow4['ip_hi']);
      $testrow4['c2c'] = strtoupper($testrow4['c2c']);
      $testrow4['flag_img'] = flag_img($testrow4['c2c']);
      $testmessage .= '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow4['ip_lo_ip'].'" target="_blank">'.$testrow4['ip_lo_ip'].'</a></td>'."\n";
      $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow4['ip_hi_ip'].'" target="_blank">'.$testrow4['ip_hi_ip'].'</a></td>'."\n";
      $testmessage .= '<td align="center">'.$testrow4['flag_img'].'</td>'."\n";
      $testmessage .= '<td align="center">'.$testrow4['c2c'].'</td>'."\n";
      $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$testrow4['ip_lo'].'&amp;ip_hi='.$testrow4['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
      $testmessage .= '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$testrow4['ip_lo'].'&amp;ip_hi='.$testrow4['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
      $testmessage .= '</tr>'."\n";
    }
    $testmessage .= '</table>'."\n";
    $testmessage .= '<br />'."\n";
  }
  echo $testmessage;
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  $xnotes = str_replace("<br>", "\r\n", $xnotes);
  $xnotes = str_replace("<br />", "\r\n", $xnotes);
  $xnotes = htmlentities($xnotes, ENT_QUOTES);
  $xnotes = addslashes($xnotes);
  $xtime = time();
  $db->sql_query("INSERT INTO `".$prefix."_nsnst_excluded_ranges` VALUES ('$longip_lo', '$longip_hi', '$xtime', '$xnotes', '$xc2c')");
  if($another == 1) {
    header("Location: ".$admin_file.".php?op=ABExcludedAdd");
  }else {
    header("Location: ".$admin_file.".php?op=ABExcludedList");
  }
}

?>