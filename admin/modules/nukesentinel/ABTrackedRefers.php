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

$pagetitle = _AB_NUKESENTINEL.": "._AB_TRACKEDREFERS;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_TRACKEDREFERS);
ipbanmenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();
echo "<br />\n";
OpenTable();
$tbcol = 5;
$perpage = $ab_config['track_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
if(!isset($column) or !$column or $column=="") $column = "refered_from";
if(!isset($direction) or !$direction or $direction=="") $direction = "asc";
$totalselected = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`refered_from`) FROM `".$prefix."_nsnst_tracked_ips` GROUP BY 1"));
if($totalselected > 0) {
  $selcolumn3=$selcolumn4=$selcolumn5='';
  $seldirection1=$seldirection2='';
  echo "<table summary='' width='100%' cellpadding='2' cellspacing='2' bgcolor='$bgcolor2' border='0'>\n";
  echo "<tr><td colspan='$tbcol'><table summary='' width='100%' cellpadding='0' cellspacing='0' border='0'>\n";
  echo "<tr>\n";
  // Page Sorting
  echo "<td align='left' bgcolor='$bgcolor2' width='50%'>";
  echo "<form method='post' action='".$admin_file.".php?op=ABTrackedRefers'>\n";
  echo "<input type='hidden' name='min' value='$min' />\n";
  echo "<strong>"._AB_SORT.":</strong> <select name='column'>\n";
  if($column == 6) $column = 4;
  if($column == "date") $selcolumn3 = "selected='selected'";
  echo "<option value='date' $selcolumn3>"._AB_DATE."</option>\n";
  if($column == "refered_from") $selcolumn4 = "selected='selected'";
  echo "<option value='refered_from' $selcolumn4>"._AB_USERREFER."</option>\n";
  if($column == 4) $selcolumn5 = "selected='selected'";
  echo "<option value=4 $selcolumn5>"._AB_HITS."</option>\n";
  echo "</select> ";
  echo "<select name='direction'>\n";
  if($direction == "asc") $seldirection1 = "selected='selected'";
  echo "<option value='asc' $seldirection1>"._AB_ASC."</option>\n";
  if($direction == "desc") $seldirection2 = "selected='selected'";
  echo "<option value='desc' $seldirection2>"._AB_DESC."</option>\n";
  echo "</select> <input type='submit' value='"._AB_SORT."' />\n";
  echo "</form></td>";
  // Page Sorting
  // START Modules
  echo "<td align='right' bgcolor='$bgcolor2' width='50%'>&nbsp;</td>\n";
  // END Modules
  echo "</tr>";
  echo "</table>\n";
  echo "<tr bgcolor='$bgcolor1'><td colspan='$tbcol'><img src='images/pix.gif' height='2' width='2' alt='' title='' /></td></tr>\n";
  echo "<tr bgcolor='$bgcolor2'>\n";
  echo "<td><strong>"._AB_USERREFER."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_IPSTRACKED."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_LASTVIEWED."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_HITS."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_FUNCTIONS."</strong></td>\n</tr>\n";
  $result = $db->sql_query("SELECT DISTINCT(`refered_from`), tid, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` GROUP BY 1 ORDER BY $column $direction LIMIT $min, $perpage");
  while(list($refered_from, $tid, $lastview, $hits) = $db->sql_fetchrow($result)){
    echo "<tr onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\" bgcolor='$bgcolor1'>";
    if(strlen($refered_from) > 50) {
      $rfrom = substr($refered_from, 0, 50)."...";
    } else {
      $rfrom = $refered_from;
    }
    if($rfrom != "on site" AND $rfrom != "none" AND $rfrom !="local") {
      $rfrom = "<a href=\"includes/nsbypass.php?tid=".$tid."\" target=\"_blank\" title=\"$refered_from\">".html_entity_decode($rfrom, ENT_QUOTES)."</a>";
    } else {
      $rfrom = $rfrom;
    }
    echo "<td>$rfrom</td>";
    $trackedips = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips` WHERE `refered_from`='$refered_from'"));
    echo "<td align='center'><a href='".$admin_file.".php?op=ABTrackedRefersIPs&amp;tid=$tid' target='_blank'>$trackedips</a></td>\n";
    echo "<td align='center'>".date("Y-m-d \@ H:i:s",$lastview)."</td>";
    echo "<td align='center'>$hits</td>";
    echo "<td align='center'>&nbsp;<a href='".$admin_file.".php?op=ABPrintTrackedRefersPages&amp;tid=$tid' target='_blank'><img src='images/nukesentinel/print.png' height='16' width='16' alt='"._AB_PRINT."' title='"._AB_PRINT."' border='0' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABTrackedRefersPages&amp;tid=$tid' target='_blank'><img src='images/nukesentinel/view.png' height='16' width='16' alt='"._AB_VIEW."' title='"._AB_VIEW."' border='0' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABTrackedRefersListAdd&amp;tid=$tid&amp;min=$min&amp;column=$column&amp;direction=$direction'><img src='images/nukesentinel/lock.png' height='16' width='16' alt='"._AB_BLOCK."' title='"._AB_BLOCK."' border='0' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABTrackedRefersDelete&amp;tid=$tid&amp;min=$min&amp;column=$column&amp;direction=$direction'><img src='images/nukesentinel/delete.png' height='16' width='16' alt='"._AB_DELETE."' title='"._AB_DELETE."' border='0' /></a>&nbsp;</td>";
    echo "</tr>";
  }
  // End IP Stats
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
    echo "<tr bgcolor='$bgcolor1'><td colspan='5'><img src='images/pix.gif' height='2' width='2' alt='' title='' /></td></tr>\n";
    echo "<tr>\n<td colspan='5'>\n<table summary='' border='0' cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";

    echo "<td width='25%'>";
    echo "<form action='".$admin_file.".php?op=ABTrackedRefers' method='post'>\n";
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

    echo "<td align='center' width='50%'>";
    echo "<form action='".$admin_file.".php?op=ABTrackedRefers' method='post'>\n";
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

    echo "<td align='right' width='25%'>";
    echo "<form action='".$admin_file.".php?op=ABTrackedRefers' method='post'>\n";
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
  echo "</table>";
} else {
  echo "<center><strong>"._AB_NOIPS."</strong></center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>