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
OpenTable();
OpenMenu(_AB_TRACKEDIPS);
mastermenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();

OpenTable();
$tbcol = 6;
$perpage = $ab_config['track_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($showmodule)) $showmodule="All_Modules";
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
if(!isset($column) or !$column or $column=="") $column = $ab_config['track_sort_column'];
if(!isset($direction) or !$direction or $direction=="") $direction = $ab_config['track_sort_direction'];
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
$totalselected = $db->sql_numrows($db->sql_query("SELECT `username`, `ip_addr`, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` $modfilter GROUP BY 1,2"));
if($totalselected > 0) {
  $selcolumn1 = $selcolumn2 = $selcolumn3 = $selcolumn4 = $selcolumn5 = $selcolumn6 = $seldirection1 = $seldirection2 = "";
  echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" border="0">'."\n";
  echo '<tr>'."\n";
  // START Modules
  $handle=opendir('modules');
  $moduleslist = '';
  while($file = readdir($handle)) {
    if( (!preg_match("/^[\.]/",$file)) && !preg_match("/(html)$/", $file) ) { $moduleslist .= "$file "; }
  }
  closedir($handle);
  $moduleslist .= "All_Modules &nbsp;Index &nbsp;Admin &nbsp;Backend";
  $moduleslist = explode(" ", $moduleslist);
  sort($moduleslist);
  echo '<td width="60%" nowrap="nowrap">'."\n";
  echo '<form action="'.$admin_file.'.php?op=ABTrackedList" method="post" style="padding: 0px; margin: 0px;">'."\n";
  echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
  echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
  echo '<strong>'._AB_MODULE.':</strong> <select name="showmodule">'."\n";
  for($i=0; $i < sizeof($moduleslist); $i++) {
    if($moduleslist[$i]!="") {
      $moduleslist[$i] = str_replace("&nbsp;", " ", $moduleslist[$i]);
      echo '<option value="'.$moduleslist[$i].'" ';
      if (!isset($showmodule)) $showmodule = '';
      if($showmodule==$moduleslist[$i] OR ((!$showmodule OR $showmodule=="") AND $moduleslist[$i]=="All_Modules")) { echo ' selected="selected"'; }
      echo '>'.str_replace("_", " ", $moduleslist[$i]).'</option>'."\n";
    }
  }
  echo '</select> <input type="submit" value="'._AB_GO.'" /></form></td>'."\n";
  // END Modules
  // Page Sorting
  if($column == "date") { $selcolumn3 = ' selected="selected"'; }
  elseif($column == "username") { $selcolumn4 = ' selected="selected"'; }
  elseif($column == 5) { $selcolumn5 = ' selected="selected"'; }
  elseif($column == "c2c") { $selcolumn6 = ' selected="selected"'; }
  else { $selcolumn1 = ' selected="selected"'; }
  if($direction == "desc") { $seldirection2 = ' selected="selected"'; }
  else { $seldirection1 = ' selected="selected"'; }
  echo '<td align="right" width="40%" nowrap="nowrap">'."\n";
  echo '<form action="'.$admin_file.'.php?op=ABTrackedList" method="post" style="padding: 0px; margin: 0px;">'."\n";
  echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
  echo '<input type="hidden" name="showmodule" value="'.$showmodule.'" />'."\n";
  echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
  echo '<option value="ip_long"'.$selcolumn1.'>'._AB_IPTRACKED.'</option>'."\n";
  echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
  echo '<option value="username"'.$selcolumn4.'>'._AB_USERNAME.'</option>'."\n";
  echo '<option value="5"'.$selcolumn5.'>'._AB_HITS.'</option>'."\n";
  echo '<option value="c2c"'.$selcolumn6.'>'._AB_C2CODE.'</option>'."\n";
  echo '</select> <select name="direction">'."\n";
  echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
  echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
  echo '</select> <input type="submit" value="'._AB_SORT.'" />'."\n";
  echo '</form>'."\n";
  echo '</td>'."\n";
  // Page Sorting
  echo '</tr>'."\n";
  echo '</table>'."\n";
  echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td><strong>'._AB_IPADDRESS.'</strong></td>'."\n";
  echo '<td width="2%"><strong>&nbsp;</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_HITS.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT `user_id`, `username`, `ip_addr`, MAX(`date`), COUNT(*), MIN(`tid`), `c2c` FROM `".$prefix."_nsnst_tracked_ips` $modfilter GROUP BY 2,3 ORDER BY $column $direction LIMIT $min, $perpage");
  while(list($userid,$username,$ipaddr,$lastview,$hits,$tid,$c2c) = $db->sql_fetchrow($result)){
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td>';
    if($userid != 1) {
      echo '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$username.'" target="_blank"><img src="modules/NukeSentinel/images/usericon.png" height="16" width="16" alt="'.$username.'" title="'.$username.'" border="0" /></a>';
    } else {
      echo '<img src="modules/NukeSentinel/images/anonicon.png" height="16" width="16" alt="'.$anonymous.'" title="'.$anonymous.'" border="0" />';
    }
    echo ' <a href="'.$ab_config['lookup_link'].$ipaddr.'" target="_blank">'.$ipaddr.'</a></td>'."\n";
    $getIPs['flag_img'] = strtolower($c2c);
    # <span class="countries af"></span>
    echo '<td width="2%"><span class="countries '.$getIPs['flag_img'].'"></span></td>'."\n";
    echo '<td align="center">'.date("Y-m-d \@ H:i:s",$lastview).'</td>'."\n";
    echo '<td align="center">'.$hits.'</td>'."\n";
    echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABTrackedPagesPrint&amp;user_id='.$userid.'&amp;ip_addr='.$ipaddr.'" target="_blank"><img src="images/print.png" height="16" width="16" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" border="0" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABTrackedPages&amp;user_id='.$userid.'&amp;ip_addr='.$ipaddr.'" target="_blank"><img src="images/magnify.png" height="16" width="16" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" border="0" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABTrackedAdd&amp;tid='.$tid.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;showmodule='.$showmodule.'" target="_blank"><img src="images/shield_red.png" height="16" width="16" alt="'._AB_BLOCK.'" title="'._AB_BLOCK.'" border="0" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABTrackedDelete&amp;tid='.$tid.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;showmodule='.$showmodule.'&amp;xop='.$op.'"><img src="images/delete.png" height="16" width="16" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" border="0" /></a></td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction, "", $showmodule);
} else {
  echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>