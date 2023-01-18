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

@set_time_limit(600);
if(!$ab_config['page_delay'] OR $ab_config['page_delay'] < 1) { $pagedelay = 5; } else { $pagedelay = $ab_config['page_delay']; }
$perpage = 100;
$totalselected = $db->sql_numrows($db->sql_query("SELECT `ip_lo` FROM `".$prefix."_nsnst_ip2country`"));
if(!isset($min)) {
  $min=0;
  $pagesint = ($totalselected / $perpage);
  $pages = ceil($pagesint);
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_IP2COVERLAPCHECK);
  mastermenu();
  CarryMenu();
  ip2cmenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  echo _AB_IP2COVERLAPCHECK01.'<br />'."\n";
  echo _AB_IP2COVERLAPCHECK02.'<br />'."\n";
  echo _AB_INSECTIONS.'<br />'."\n";
  echo _AB_YOUHAVE.$pages._AB_SECTIONSTOGO.'<br />'."\n";
  echo '<br />'."\n";
  echo '<form method="post" action="'.$admin_file.'.php?op=ABIP2CountryOverlapCheck">'."\n";
  echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
  echo '<input type="submit" value="'._AB_LETSGETSTART.'" />'."\n";
  echo '</form>'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else if($min < $totalselected) {
  $max=$min+$perpage;
  $pagesint = ($totalselected / $perpage);
  $pages = ceil($pagesint);
  $currentpage = ($max / $perpage);
  $pagetitle = _AB_NUKESENTINEL.": "._AB_IP2COVERLAPCHECK;
  include_once(NUKE_BASE_DIR.'header.php');
  title($pagetitle);
  OpenTable();
  $testmessage = "";
  $result = $db->sql_query("SELECT `ip_lo`, `ip_hi` FROM `".$prefix."_nsnst_ip2country` ORDER BY ip_lo LIMIT $min, $perpage");
  while(list($xip_lo, $xip_hi) = $db->sql_fetchrow($result)) {
    $test1 = $db->sql_query("SELECT * FROM ".$prefix."_nsnst_ip2country WHERE (ip_lo<='$xip_lo' AND ip_hi>='$xip_lo') AND (`ip_lo`!='$xip_lo' AND `ip_hi`!='$xip_hi') ORDER BY `ip_lo`");
    $test2 = $db->sql_query("SELECT * FROM ".$prefix."_nsnst_ip2country WHERE (ip_lo<='$xip_hi' AND ip_hi>='$xip_hi') AND (`ip_lo`!='$xip_lo' AND `ip_hi`!='$xip_hi') ORDER BY `ip_lo`");
    $test3 = $db->sql_query("SELECT * FROM ".$prefix."_nsnst_ip2country WHERE (ip_lo>='$xip_lo' AND ip_hi<='$xip_hi') AND (`ip_lo`!='$xip_lo' AND `ip_hi`!='$xip_hi') ORDER BY `ip_lo`");
    $test4 = $db->sql_query("SELECT * FROM ".$prefix."_nsnst_ip2country WHERE (ip_lo<='$xip_lo' AND ip_hi>='$xip_hi') AND (`ip_lo`!='$xip_lo' AND `ip_hi`!='$xip_hi') ORDER BY `ip_lo`");
    $testnum1 = $db->sql_numrows($test1);
    $testnum2 = $db->sql_numrows($test2);
    $testnum3 = $db->sql_numrows($test3);
    $testnum4 = $db->sql_numrows($test4);
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
        $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABIP2CountryEdit&amp;ip_lo='.$testrow1['ip_lo'].'&amp;ip_hi='.$testrow1['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
        $testmessage .= '<a href="'.$admin_file.'.php?op=ABIP2CountryDelete&amp;ip_lo='.$testrow1['ip_lo'].'&amp;ip_hi='.$testrow1['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
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
        $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABIP2CountryEdit&amp;ip_lo='.$testrow2['ip_lo'].'&amp;ip_hi='.$testrow2['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
        $testmessage .= '<a href="'.$admin_file.'.php?op=ABIP2CountryDelete&amp;ip_lo='.$testrow2['ip_lo'].'&amp;ip_hi='.$testrow2['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
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
        $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABIP2CountryEdit&amp;ip_lo='.$testrow3['ip_lo'].'&amp;ip_hi='.$testrow3['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
        $testmessage .= '<a href="'.$admin_file.'.php?op=ABIP2CountryDelete&amp;ip_lo='.$testrow3['ip_lo'].'&amp;ip_hi='.$testrow3['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
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
        $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABIP2CountryEdit&amp;ip_lo='.$testrow4['ip_lo'].'&amp;ip_hi='.$testrow4['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
        $testmessage .= '<a href="'.$admin_file.'.php?op=ABIP2CountryDelete&amp;ip_lo='.$testrow4['ip_lo'].'&amp;ip_hi='.$testrow4['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
        $testmessage .= '</tr>'."\n";
      }
      $testmessage .= '</table>'."\n";
      $testmessage .= '<br />'."\n";
    }
  }
  $pdone = round(($currentpage / $pages) * 100, 2);
  if($testmessage != "") {
    echo '<strong>'._AB_SECTION.' '.$currentpage.' '._AB_OF.' '.$pages.' ('.$pdone.'%)</strong><br />'."\n";
    echo $testmessage;
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
    echo '<tr>'."\n";
    echo '<td>'."\n";
    echo '<form action="'.$admin_file.'.php?op=ABIP2CountryOverlapCheck" method="post" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
    echo '<input type="submit" value="'._AB_RECHECKSECTION.' '.$currentpage.'" />'."\n";
    echo '</form>'."\n";
    echo '</td>'."\n";
    if($currentpage < $pages) {
      echo '<td>'."\n";
      echo '<form action="'.$admin_file.'.php?op=ABIP2CountryOverlapCheck" method="post" style="padding: 0px; margin: 0px;">'."\n";
      echo '<input type="hidden" name="min" value="'.$max.'" />'."\n";
      echo '<input type="submit" value="'._AB_CHECKSECTION.' '.($currentpage+1).'" />'."\n";
      echo '</form>'."\n";
      echo '</td>'."\n";
    } else {
    echo '<td>'."\n";
      echo '<form action="'.$admin_file.'.php?op=ABBlockedRangeOverlapCheck" method="post" style="padding: 0px; margin: 0px;">'."\n";
      echo '<input type="hidden" name="min" value="'.$max.'" />'."\n";
      echo '<input type="submit" value="'._AB_FINISHCHECK.'" />'."\n";
      echo '</form>'."\n";
      echo '</td>'."\n";
    }
    echo '</tr>'."\n";
    echo '</table>'."\n";
  } else {
    echo '<script><!--'."\n";
    echo 'setTimeout(\'Redirect()\','.($pagedelay*1000).');'."\n";
    echo 'function Redirect()'."\n";
    echo '{'."\n";
    echo ' location.href = \''.$admin_file.'.php?op=ABIP2CountryOverlapCheck&min='.$max.'\';'."\n";
    echo '}'."\n";
    echo '// --></script>'."\n";
    echo '<strong>'._AB_SECTION.' '.$currentpage.' '._AB_OF.' '.$pages.' ('.$pdone.'%) '._AB_COMPLETED.'</strong><br />'."\n";
    echo '<strong>'._AB_NOCONFLICTS.'</strong><br />'."\n";
    if($currentpage < $pages) {
      echo '<strong>'._AB_SECTION.' '.($currentpage+1).' '._AB_OF.' '.$pages.' '._AB_WILLSTART.'</strong><br />'."\n";
    }
  }
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_IP2COVERLAPCHECK);
  mastermenu();
  CarryMenu();
  ip2cmenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  echo '<center><strong>'._AB_IP2COVERLAPCHECK.' '._AB_COMPLETED.'</strong>'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
}

?>