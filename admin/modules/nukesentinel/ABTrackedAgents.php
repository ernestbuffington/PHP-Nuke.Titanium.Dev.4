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

$pagetitle = _AB_NUKESENTINEL.": "._AB_TRACKEDAGENTS;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_TRACKEDAGENTS);
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
if(!isset($showmodule)) $showmodule="All_Modules";
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
if(!isset($column) or !$column or $column=="") $column = "user_agent";
if(!isset($direction) or !$direction or $direction=="") $direction = "asc";
if(preg_match("#All(.*)Modules#", $showmodule) || !$showmodule ) {
  $modfilter="";
} elseif(preg_match("#Admin#", $showmodule)) {
  $modfilter="WHERE page LIKE '%".$admin_file.".php%'";
} elseif(preg_match("#Index#", $showmodule)) {
  $modfilter="WHERE page LIKE '%index.php%'";
} elseif(preg_match("#Backend#", $showmodule)) {
  $modfilter="WHERE page LIKE '%backend.php%'";
} else {
  $modfilter="WHERE page LIKE '%name=$showmodule%'";
}
$totalselected = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`user_agent`) FROM `".$prefix."_nsnst_tracked_ips` $modfilter GROUP BY 1"));
if($totalselected > 0) {
  $selcolumn3=$selcolumn4=$selcolumn5='';
  $seldirection1=$seldirection2='';
  echo "<table summary='' width='100%' cellpadding='2' cellspacing='2' bgcolor='$bgcolor2' border='0'>\n";
  echo "<tr><td colspan='$tbcol'><table summary='' width='100%' cellpadding='0' cellspacing='0' border='0'>\n";
  echo "<tr>\n";
  // Page Sorting
  echo "<td align='left' bgcolor='$bgcolor2' width='50%'>";
  echo "<form method='post' action='".$admin_file.".php?op=ABTrackedAgents'>\n";
  echo "<input type='hidden' name='min' value='$min' />\n";
  echo "<input type='hidden' name='showmodule' value='$showmodule' />\n";
  echo "<strong>"._AB_SORT.":</strong> <select name='column'>\n";
  if($column == 6) $column = 4;
  if($column == "ip_long") $column = 4;
  if($column == "c2c") $column = 4;
  if($column == "date") $selcolumn3 = "selected='selected'";
  echo "<option value='date' $selcolumn3>"._AB_DATE."</option>\n";
  if($column == "user_agent") $selcolumn4 = "selected='selected'";
  echo "<option value='user_agent' $selcolumn4>"._AB_USERAGENT."</option>\n";
  if($column == 4) $selcolumn5 = "selected='selected'";
  echo "<option value=4 $selcolumn5>"._AB_HITS."</option>\n";
  echo "</select> ";
  echo "<select name='direction'>\n";
  if($direction == "asc") $seldirection1 = "selected='selected'";
  echo "<option value='asc' $seldirection1>"._AB_ASC."</option>\n";
  if($direction == "desc") $seldirection2 = "selected='selected'";
  echo "<option value='desc' $seldirection2>"._AB_DESC."</option>\n";
  echo "</select> ";
  echo "<input type='submit' value='"._AB_SORT."' />\n";
  echo "</form></td>";
  // Page Sorting
  // START Modules
  $handle=opendir('modules');
  $moduleslist = '';
  while($file = readdir($handle)) {
    if( (!preg_match("/^[\.]/",$file)) && !preg_match("/(html)$/", $file) ) {
      $moduleslist .= "$file ";
    }
  }
  closedir($handle);
  $moduleslist .= "&nbsp;All&nbsp;Modules &nbsp;Index &nbsp;Admin &nbsp;Backend";
  $moduleslist = explode(" ", $moduleslist);
  sort($moduleslist);

  echo "<td align='right' bgcolor='$bgcolor2' width='50%'>\n";
  echo "<form action=\"".$admin_file.".php?op=ABTrackedAgents\" method=\"post\">\n";
  echo "<input type='hidden' name='column' value='$column' />\n";
  echo "<input type='hidden' name='direction' value='$direction' />\n";
  echo "<strong>"._AB_MODULE.":</strong> <select name=\"showmodule\">\n";
  for($i=0; $i < sizeof($moduleslist); $i++) {
    if($moduleslist[$i]!="") {
      $moduleslist[$i] = str_replace("&nbsp;", " ", $moduleslist[$i]);
      echo "<option value=\"$moduleslist[$i]\" ";
      if($showmodule==$moduleslist[$i] OR ((!$showmodule OR $showmodule=="") AND $moduleslist[$i]==" All Modules")) { echo " selected='selected'"; }
      echo ">".$moduleslist[$i]."</option>\n";
    }
  }
  echo "</select><input type='submit' value='"._AB_GO."' /></form></td>\n";
  // END Modules
  echo "</tr>";
  echo "</table>\n";
  echo "<tr bgcolor='$bgcolor1'><td colspan='$tbcol'><img src='images/pix.gif' height='2' width='2' alt='' title='' /></td></tr>\n";
  echo "<tr bgcolor='$bgcolor2'>\n";
  echo "<td><strong>"._AB_USERAGENT."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_IPSTRACKED."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_LASTVIEWED."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_HITS."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_FUNCTIONS."</strong></td>\n</tr>\n";
  $result = $db->sql_query("SELECT DISTINCT(`user_agent`), tid, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` $modfilter GROUP BY 1 ORDER BY $column $direction LIMIT $min, $perpage");
  while(list($user_agent, $tid, $lastview, $hits) = $db->sql_fetchrow($result)){
    echo "<tr onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\" bgcolor='$bgcolor1'>";
    echo "<td>$user_agent</td>";
    $trackedips = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='$user_agent'"));
    echo "<td align='center'><a href='".$admin_file.".php?op=ABTrackedAgentsIPs&amp;tid=$tid' target='_blank'>$trackedips</a></td>\n";
    echo "<td align='center'>".date("Y-m-d \@ H:i:s",$lastview)."</td>";
    echo "<td align='center'>$hits</td>";
    echo "<td align='center'>&nbsp;<a href='".$admin_file.".php?op=ABPrintTrackedAgentsPages&amp;tid=$tid' target='_blank'><img src='images/nukesentinel/print.png' height='16' width='16' alt='"._AB_PRINT."' title='"._AB_PRINT."' border='0' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABTrackedAgentsPages&amp;tid=$tid' target='_blank'><img src='images/nukesentinel/view.png' height='16' width='16' alt='"._AB_VIEW."' title='"._AB_VIEW."' border='0' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABTrackedAgentsListAdd&amp;tid=$tid&amp;min=$min&amp;column=$column&amp;direction=$direction'><img src='images/nukesentinel/lock.png' height='16' width='16' alt='"._AB_BLOCK."' title='"._AB_BLOCK."' border='0' /></a>&nbsp;<a ";
    echo "href='".$admin_file.".php?op=ABTrackedAgentsDelete&amp;tid=$tid&amp;min=$min&amp;column=$column&amp;direction=$direction'><img src='images/nukesentinel/delete.png' height='16' width='16' alt='"._AB_DELETE."' title='"._AB_DELETE."' border='0' /></a>&nbsp;</td>";
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

    echo "<td width='33%'>";
    echo "<form action='".$admin_file.".php?op=ABTrackedAgents' method='post'>\n";
    echo "<input type='hidden' name='column' value='$column' />\n";
    echo "<input type='hidden' name='direction' value='$direction' />\n";
    echo "<input type='hidden' name='min' value='".($min - $perpage)."' />\n";
    echo "<input type='hidden' name='showmodule' value='$showmodule' />\n";
    if($currentpage <= 1) {
      echo "&nbsp;";
    } else {
      echo "<input type='submit' value='"._AB_PREVPAGE."' />";
    }
    echo "</form>\n";
    echo "</td>\n";

    echo "<td align='center' width='34%'>";
    echo "<form action='".$admin_file.".php?op=ABTrackedAgents' method='post'>\n";
    echo "<input type='hidden' name='column' value='$column' />\n";
    echo "<input type='hidden' name='direction' value='$direction' />\n";
    echo "<input type='hidden' name='showmodule' value='$showmodule' />\n";
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
    echo "<form action='".$admin_file.".php?op=ABTrackedAgents' method='post'>\n";
    echo "<input type='hidden' name='column' value='$column' />\n";
    echo "<input type='hidden' name='direction' value='$direction' />\n";
    echo "<input type='hidden' name='min' value='".($min + $perpage)."' />\n";
    echo "<input type='hidden' name='showmodule' value='$showmodule' />\n";
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