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

if (!defined('NUKESENTINEL_PUBLIC')) {
   die ('You can\'t access this file directly...');
}

function stmain_menu($subtitle = "") {
  global $db, $prefix, $module_name;
  if($subtitle > "") { $subtitle = ": ".$subtitle; }
  OpenTable();
  $checkrow = $db->sql_numrows($db->sql_query("SELECT `ip_lo` FROM `".$prefix."_nsnst_ip2country`"));
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
  echo '<tr><td align="center" colspan="3" class="title">'._AB_NUKESENTINEL.$subtitle.'</td></tr>'."\n";
  echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STIPS">'._AB_BLOCKEDIPS.'</a></td></tr>'."\n";
  echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STRanges">'._AB_BLOCKEDRANGES.'</a></td></tr>'."\n";
  echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STReferers">'._AB_BLOCKEDREFERERS.'</a></td></tr>'."\n";
  if($checkrow > 0) { echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STIP2C">'._AB_IP2COUNTRY.'</a></td></tr>'."\n"; }
  echo '</table>'."\n";
  CloseTable();
}

function stpagenumspub($op, $totalselected, $perpage, $max, $column, $direction) {
  global $module_name;
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
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
    echo '<tr>'."\n";
    echo '<td width="33%">'."\n";
    echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="min" value="'.(($max - $perpage) - $perpage).'" />'."\n";
    echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
    echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
    if($currentpage <= 1) {
      echo '&nbsp;';
    } else {
      echo '<input type="submit" value="'._AB_PREVPAGE.'" />';
    }
    echo '</form>'."\n";
    echo '</td>'."\n";
    echo '<td align="center" width="34%" nowrap="nowrap">'."\n";
    echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
    echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
    echo '<b>'._AB_PAGE.':</b> <select name="min">'."\n";
    while ($counter <= $pages ) {
      $cpage = $counter;
      $mintemp = ($perpage * $counter) - $perpage;
      echo '<option value="'.$mintemp.'"';
      if($counter == $currentpage) { echo ' selected="selected"'; }
      echo '>'.$counter.'</option>'."\n";
      $counter++;
    }
    echo '</select><b> '._AB_OF.' '.$pages.' '._AB_PAGES.'</b> <input type="submit" value="'._AB_GO.'" />'."\n";
    echo '</form>'."\n";
    echo '</td>'."\n";
    echo '<td align="right" width="33%">';
    echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="min" value="'.$max.'" />'."\n";
    echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
    echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
    if($currentpage >= $pages) {
      echo '&nbsp;';
    } else {
      echo '<input type="submit" value="'._AB_NEXTPAGE.'" />';
    }
    echo '</form>'."\n";
    echo '</td>'."\n";
    echo '</tr>'."\n";
    echo '</table>'."\n";
  }
}

?>