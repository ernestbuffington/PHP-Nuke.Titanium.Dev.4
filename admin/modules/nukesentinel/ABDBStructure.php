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

if(is_god($admin)) {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  OpenMenu(_AB_DBSTRUCTURE." - ".$dbname);
  mastermenu();
  CarryMenu();
  databasemenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  echo '<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" align="center" bgcolor="'.$bgcolor2.'">'."\n";
  echo '<tr>'."\n";
  echo '<td width="40%"><strong>'._AB_TABLE.'</strong></td>'."\n";
  echo '<td align="center" width="10%"><strong>'._AB_TYPE.'</strong></td>'."\n";
  echo '<td align="center" width="10%"><strong>'._AB_STATUS.'</strong></td>'."\n";
  echo '<td align="right" width="10%"><strong>'._AB_RECORDS.'</strong></td>'."\n";
  echo '<td align="right" width="15%"><strong>'._AB_SIZE.'</strong></td>'."\n";
  echo '<td align="right" width="15%"><strong>'._AB_OVERHEAD.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $tot_data = $tot_idx = $tot_all = $tot_records = 0;
  $result = $db->sql_query("SHOW TABLE STATUS FROM `".$dbname."`");
  $tables = $db ->sql_numrows($result);
  if($tables > 0) {
    $total_total = $total_gain = 0;
    while($row = $db->sql_fetchrow($result)) {
      $checkrow = $db->sql_fetchrow($db->sql_query("CHECK TABLE $row[0]"));
      $status = $checkrow['Msg_text'];
      $records = $row['Rows'];
      $tot_records += $records;
      $total = $row['Data_length'] + $row['Index_length'];
      $total_total += $total;
      $gain= $row['Data_free'];
      $total_gain += $gain;
      $total = ABCoolSize($total);
      if($gain < 1) { $gain = '--'; } else { $gain = ABCoolSize($gain); }
      if(!$row['Engine']) { $etype = $row['Type']; } else { $etype = $row['Engine']; }
      echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
      echo '<td>'.$row['Name'].'</td>'."\n";
      echo '<td align="center">'.$etype.'</td>'."\n";
      echo '<td align="center">'.$status.'</td>'."\n";
      echo '<td align="right">'.number_format($records).'</td>'."\n";
      echo '<td align="right">'.$total.'</td>'."\n";
      echo '<td align="right">'.$gain.'</td>'."\n";
      echo '</tr>'."\n";
    }
    $total_total = ABCoolSize($total_total);
    $total_gain = ABCoolSize($total_gain);
    echo '<tr>'."\n";
    echo '<td><strong>'.$tables.' '._AB_TABLES.'</strong></td>'."\n";
    echo '<td align="center"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="center"><strong>&nbsp;</strong></td>'."\n";
    echo '<td align="right"><strong>'.number_format($tot_records).'</strong></td>'."\n";
    echo '<td align="right"><strong>'.$total_total.'</strong></td>'."\n";
    echo '<td align="right"><strong>'.$total_gain.'</strong></td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>