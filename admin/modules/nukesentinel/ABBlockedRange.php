<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2008 by NukeScripts Network       */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

$pagetitle = _AB_NUKESENTINEL.": "._AB_BLOCKEDRANGES;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_BLOCKEDRANGES);
ipbanmenu();
CarryMenu();
blockedrangemenu();
CloseMenu();
CloseTable();
echo "<br />\n";
OpenTable();
$perpage = 50;
if($perpage == 0) { $perpage = 25; }
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
if(!isset($column) or !$column or $column=="") $column = "ip_lo";
if(!isset($direction) or !$direction or $direction=="") $direction = "asc";
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges`"));
if($totalselected > 0) {
  echo "<table summary='' align='center' border='0' cellpadding='2' cellspacing='2' bgcolor='$bgcolor2' width='100%'>\n";
  // Page Sorting
  echo "<tr>\n";
  echo "<td align='right' bgcolor='$bgcolor2' colspan='7'>\n";
  echo "<form method='post' action='".$admin_file.".php?op=ABBlockedRange'><strong>"._AB_SORT.":</strong> ";
  echo "<select name='column'>\n";
  if($column == "ip_lo") $selcolumn1 = "selected='selected'";
  echo "<option value='ip_lo' $selcolumn1>"._AB_IP2CRANGE."</option>\n";
  if($column == "c2c") $selcolumn2 = "selected='selected'";
  echo "<option value='c2c' $selcolumn2>"._AB_C2CODE."</option>\n";
  if($column == "date") $selcolumn3 = "selected='selected'";
  echo "<option value='date' $selcolumn3>"._AB_DATE."</option>\n";
  if($column == "expires") $selcolumn4 = "selected='selected'";
  echo "<option value='expires' $selcolumn4>"._AB_EXPIRES."</option>\n";
  if($column == "reason") $selcolumn5 = "selected='selected'";
  echo "<option value='reason' $selcolumn5>"._AB_REASON."</option>\n";
  echo "</select> ";
  echo "<select name='direction'>\n";
  if($direction == "asc") $seldirection1 = "selected='selected'";
  echo "<option value='asc' $seldirection1>"._AB_ASC."</option>\n";
  if($direction == "desc") $seldirection2 = "selected='selected'";
  echo "<option value='desc' $seldirection2>"._AB_DESC."</option>\n";
  echo "</select> ";
  echo "<input type='hidden' name='min' value='$min' /><input type='submit' value='"._AB_SORT."' />\n";
  echo "</form></td></tr>";
  // Page Sorting
  echo "<tr bgcolor='$bgcolor1'><td colspan='7'><img src='images/pix.gif' height='2' width='2' alt='' title='' /></td></tr>\n";
  echo "<tr bgcolor='$bgcolor2'>\n";
  echo "<td width='15%'><strong>"._AB_IPLO."</strong></td>\n";
  echo "<td width='15%'><strong>"._AB_IPHI."</strong></td>\n";
  echo "<td align='center' width='10%'><strong>"._AB_FLAG."</strong></td>\n";
  echo "<td align='center' width='20%'><strong>"._AB_NOTES."</strong></td>\n";
  echo "<td align='center' width='10%'><strong>"._AB_DATE."</strong></td>\n";
  echo "<td align='center' width='10%'><strong>"._AB_CIDRS."</strong></td>\n";
  echo "<td align='center' width='10%'><strong>"._AB_FUNCTIONS."</strong></td>\n";
  echo "</tr>\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` ORDER BY $column $direction LIMIT $min,$perpage");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
    $masscidr = str_replace("||", ",<br />", $masscidr);
    if(stristr($masscidr, "<br />")) { $valign = " valign='top'"; } else { $valign = ""; }
    $getIPs['c2c'] = strtoupper($getIPs['c2c']);
    $getIPs['flag_img'] = flag_img($getIPs['c2c']);
    echo "<tr onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\" bgcolor='$bgcolor1'>\n";
    echo "<td$valign><a href='".$ab_config['lookup_link'].$getIPs['ip_lo_ip']."' target='_blank'>".$getIPs['ip_lo_ip']."</a></td>\n";
    echo "<td$valign><a href='".$ab_config['lookup_link'].$getIPs['ip_hi_ip']."' target='_blank'>".$getIPs['ip_hi_ip']."</a></td>\n";
    echo "<td align='center'$valign>".$getIPs['flag_img']."</td>\n";
    echo "<td align='center'$valign>".$getIPs['notes']."</td>\n";
    echo "<td align='center'$valign>".date("Y-m-d",$getIPs['date'])."</td>\n";
    echo "<td align='center'$valign>$masscidr</td>\n";
    echo "<td align='center'$valign>&nbsp;<a href='".$admin_file.".php?op=ABPrintBlockedRangeView&amp;ip_lo=".$getIPs['ip_lo']."&amp;ip_hi=".$getIPs['ip_hi']."' target='_blank'><img src='images/nukesentinel/print.png' border='0' alt='"._AB_PRINT."' title='"._AB_PRINT."' height='16' width='16' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABBlockedRangeView&amp;ip_lo=".$getIPs['ip_lo']."&amp;ip_hi=".$getIPs['ip_hi']."' target='_blank'><img src='images/nukesentinel/view.png' border='0' alt='"._AB_VIEW."' title='"._AB_VIEW."' height='16' width='16' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABBlockedRangeEdit&amp;ip_lo=".$getIPs['ip_lo']."&amp;ip_hi=".$getIPs['ip_hi']."&amp;min=$min&amp;column=$column&amp;direction=$direction&amp;xop=$op'><img src='images/nukesentinel/edit.png' border='0' alt='"._AB_EDIT."' title='"._AB_EDIT."' height='16' width='16' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABBlockedRangeDelete&amp;ip_lo=".$getIPs['ip_lo']."&amp;ip_hi=".$getIPs['ip_hi']."&amp;min=$min&amp;column=$column&amp;direction=$direction&amp;xop=$op'><img src='images/nukesentinel/unblock.png' border='0' alt='"._AB_UNBLOCK."' title='"._AB_UNBLOCK."' height='16' width='16' /></a>&nbsp;</td>\n";
    echo "</tr>\n";
  }
  // Page Numbering
  $pagesint = ($totalselected / $perpage);
  $pageremainder = ($totalselected % $perpage);
  if($pageremainder != 0) {
    $pages = ceil($pagesint);
    if($totalselected < $perpage) { $pageremainder = 0; }
  } else {
    $pages = $pagesint;
  }
  if($pages != 1 && $pages != 0) {
    $counter = 1;
    $currentpage = ($max / $perpage);
    echo "<tr bgcolor='$bgcolor1'><td colspan='7'><img src='images/pix.gif' height='2' width='2' alt='' title='' /></td></tr>\n";
    echo "<tr>\n<td colspan='7'>\n<table summary='' border='0' cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";


    echo "<td width='33%'>";
    echo "<form action='".$admin_file.".php?op=ABBlockedRange' method='post'>\n";
    echo "<input type='hidden' name='column' value='$column' />\n";
    echo "<input type='hidden' name='direction' value='$direction' />\n";
    echo "<input type='hidden' name='min' value='".($min - $perpage)."' />\n";
    if($currentpage <= 1) {
      echo "&nbsp;";
    } else {
      echo "<input type='submit' value='"._AB_PREVPAGE."' />";
    }
    echo "</form>\n";
    echo "</td>\n";


    echo "<td align='center' width='34%'>";
    echo "<form action='".$admin_file.".php?op=ABBlockedRange' method='post'>\n";
    echo "<input type='hidden' name='column' value='$column' />\n";
    echo "<input type='hidden' name='direction' value='$direction' />\n";
    echo "<strong>"._AB_PAGE."</strong> <select name='min'>\n";
    while($counter <= $pages ) {
      $cpage = $counter;
      $mintemp = ($perpage * $counter) - $perpage;
      if($counter == $currentpage) {
        echo "<option selected='selected'>$counter</option>";
      } else {
        echo "<option value='$mintemp'>$counter</option>";
      }
      $counter++;
    }
    echo "</select> <strong>"._AB_OF." $pages</strong> <input type='submit' value='"._AB_GO."' />\n";
    echo "</form></td>\n";

    echo "<td align='right' width='33%'>";
    echo "<form action='".$admin_file.".php?op=ABBlockedRange' method='post'>\n";
    echo "<input type='hidden' name='column' value='$column' />\n";
    echo "<input type='hidden' name='direction' value='$direction' />\n";
    echo "<input type='hidden' name='min' value='".($min + $perpage)."' />\n";
    if($currentpage >= $pages) {
      echo "&nbsp;";
    } else {
      echo "<input type='submit' value='"._AB_NEXTPAGE."' />";
    }
    echo "</form>\n";
    echo "</td>\n";

    echo "</tr>\n</table>\n</td>\n</tr>\n";
  }
  // Page Numbering
  echo "</table>\n";
} else {
  echo "<center><strong>"._AB_NORANGES."</strong></center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>