<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: SQL Control System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
  
   Filename      : backup.php
   Author(s)     : Quake (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 12.03.2005 (mm.dd.yyyy)
                                                                        
   Notes         : Database Backup Manager
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

global $prefix, $db, $admdata, $dbname, $cache;

function ABCoolSize($size) {
  $kb = 1024;
  $mb = 1024*1024;
  $gb = 1024*1024*1024;
  if( $size > $gb ) {
    $mysize = sprintf ("%01.2f",$size/$gb)." "._AB_GB;
  } elseif( $size > $mb ) {
    $mysize = sprintf ("%01.2f",$size/$mb)." "._AB_MB;
  } elseif( $size >= $kb ) {
    $mysize = sprintf ("%01.2f",$size/$kb)." "._AB_KB;
  } else {
    $mysize = $size." "._AB_BYTES;
  }
  return $mysize;
}

if (is_mod_admin()) 
{
  
$crlf = "\n";
$filename = $dbname.'_'.date('d-m-Y').'.sql';
$tablelist = $_POST['tablelist'] ?? $db->sql_fetchtables($dbname);
@set_time_limit(0);

global $dbname, $tablelist, $filename;
switch ($op) {
    case 'BackupDB':
        if (empty($tablelist)) { echo('No tables found'); }
        require_once(NUKE_CLASSES_DIR.'class.database.php');
        (new DB)->backup($dbname, $tablelist, $filename, $_POST['dbstruct'], $_POST['dbdata'], $_POST['drop'], $_POST['gzip']);
        break;
    
	case 'OptimizeDB':
    case 'optimize':
	  include_once(NUKE_BASE_DIR.'header.php');

      OpenTable();
      echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
      echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
      CloseTable();

	  OpenTable();
	  echo '<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" align="center" bgcolor="'.$bgcolor2.'">'."\n";
      echo '<tr>'."\n";
      echo '<td width="40%"><strong>'._AB_TABLE.'</strong></td>'."\n";
      echo '<td align="center" width="10%"><strong>'._AB_TYPE.'</strong></td>'."\n";
      echo '<td align="center" width="10%"><strong>'._AB_STATUS.'</strong></td>'."\n";
      echo '<td align="right" width="10%"><strong>'._AB_RECORDS.'</strong></td>'."\n";
      echo '<td align="right" width="15%"><strong>'._AB_SIZE.'</strong></td>'."\n";
      echo '<td align="right" width="15%"><strong>'._AB_GAINED.'</strong></td>'."\n";
      echo '</tr>'."\n";
     $tot_data = $tot_idx = $tot_all = $tot_records = 0;
     $result = $db->sql_query("SHOW TABLE STATUS FROM `".$dbname."`");
     $tables = $db ->sql_numrows($result);
     if($tables > 0) {
       $total_total = $total_gain = 0;
       while($row = $db->sql_fetchrow($result)) {
         $checkrow = $db->sql_fetchrow($db->sql_query("CHECK TABLE $row[0]"));
         $records = $row['Rows'];
         $tot_records += $records;
         $total = ($row['Data_length'] + $row['Index_length']) - $row['Data_free'];
         $total_total += $total;
         $gain = $row['Data_free'];
         if($gain>0) {
           $optimizerow = $db->sql_fetchrow($db->sql_query("OPTIMIZE TABLE $row[0]"));
           $status = _AB_OPTIMIZED;
         } else {
           $status = $checkrow['Msg_text'];
         }
         $total_gain += $gain;
         $total = ABCoolSize($total);
         if($gain < 1) { $gain = "--"; } else { $gain = ABCoolSize($gain); }
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
       echo '<td align="right"><strong>&nbsp;</strong></td>'."\n";
       echo '<td align="right"><strong>'.number_format($tot_records).'</strong></td>'."\n";
       echo '<td align="right"><strong>'.$total_total.'</strong></td>'."\n";
       echo '<td align="right"><strong>'.$total_gain.'</strong></td>'."\n";
       echo '</tr>'."\n";
     }
     echo '</table>'."\n";
	 CloseTable();

      OpenTable();
      echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
      echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
      CloseTable();

     include_once(NUKE_BASE_DIR.'footer.php');
     break;
    case 'CheckDB':
    case 'AnalyzeDB':
    case 'RepairDB':
	include_once(NUKE_BASE_DIR.'header.php');

    OpenTable();
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();

    OpenTable();
    echo '<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" align="center" bgcolor="'.$bgcolor2.'">'."\n";
    echo '<tr>'."\n";
    echo '<td width="40%"><strong>'._AB_TABLE.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_TYPE.'</strong></td>'."\n";
    echo '<td align="center" width="15%"><strong>'._AB_STATUS.'</strong></td>'."\n";
    echo '<td align="right" width="15%"><strong>'._AB_RECORDS.'</strong></td>'."\n";
    echo '<td align="right" width="15%"><strong>'._AB_SIZE.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $tot_data = $tot_idx = $tot_all = $tot_records = 0;
    $result = $db->sql_query("SHOW TABLE STATUS FROM `".$dbname."`");
    $tables = $db ->sql_numrows($result);
    if($tables > 0) {
      $total_total = 0;
      while($row = $db->sql_fetchrow($result)) {
        $checkrow = $db->sql_fetchrow($db->sql_query("CHECK TABLE $row[0]"));
        if($checkrow['Msg_text'] != "OK") {
          $repairrow = $db->sql_fetchrow($db->sql_query("REPAIR TABLE $row[Table] EXTENDED"));
          $status = $repairrow['Msg_text'];
        } else {
          $status = $checkrow['Msg_text'];
        }
        $records = $row['Rows'];
        $tot_records += $records;
        $total = $row['Data_length'] + $row['Index_length'];
        $total_total += $total;
        $total = ABCoolSize($total);
        if(!$row['Engine']) { $etype = $row['Type']; } else { $etype = $row['Engine']; }
        echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
        echo '<td>'.$row['Name'].'</td>'."\n";
        echo '<td align="center">'.$etype.'</td>'."\n";
        echo '<td align="center">'.$status.'</td>'."\n";
        echo '<td align="right">'.number_format($records).'</td>'."\n";
        echo '<td align="right">'.$total.'</td>'."\n";
        echo '</tr>'."\n";
      }
      $total_total = ABCoolSize($total_total);
      echo '<tr>'."\n";
      echo '<td><strong>'.$tables.' '._AB_TABLES.'</strong></td>'."\n";
      echo '<td align="center"><strong>&nbsp;</strong></td>'."\n";
      echo '<td align="right"><strong>&nbsp;</strong></td>'."\n";
      echo '<td align="right"><strong>'.number_format($tot_records).'</strong></td>'."\n";
      echo '<td align="right"><strong>'.$total_total.'</strong></td>'."\n";
      echo '</tr>'."\n";
    }
    echo '</table>'."\n";
    CloseTable();	

    OpenTable();
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();

    include_once(NUKE_BASE_DIR.'footer.php');
    break;
    case 'StatusDB':
	    include_once(NUKE_BASE_DIR.'header.php');

        OpenTable();
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
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

    OpenTable();
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();

    include_once(NUKE_BASE_DIR.'footer.php');
    break;
    case 'RestoreDB':
        include_once(NUKE_BASE_DIR.'header.php');

        OpenTable();
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();

        require_once(NUKE_CLASSES_DIR.'class.database.php');

        if (!DB::query_file($_FILES['sqlfile'], $error)) { echo($error); }
        $cache->clear();
        OpenTable();
        echo '<span><strong>'._DATABASE.': '.$dbname.'</strong></span><br /><br />'.sprintf(_IMPORTSUCCESS, $_FILES['sqlfile']['name']);
        CloseTable();
        
        OpenTable();
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
		
		include_once(NUKE_BASE_DIR.'footer.php');
        break;

    case 'backup':
    case 'database':
        include_once(NUKE_BASE_DIR.'header.php');

        OpenTable();
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();

        OpenTable();
        echo '<br />';
		echo '<form method="post" name="backup" action="'.$admin_file.'.php" enctype="multipart/form-data">';
        echo "<script>
        <!--
        function setSelectOptions(the_form, the_select, do_check)
        {
        var selectObject = document.forms[the_form].elements[the_select];
        var selectCount  = selectObject.length;

        for (var i = 0; i < selectCount; i++) {
        selectObject.options[i].selected = do_check;
        } // end for

        return true;
        } // end of the 'setSelectOptions()' function
        //  End -->
        </script>";
        echo '<table><tr><td>
        <select name="tablelist[]" size="20" multiple="multiple">';
        if (is_array($tablelist)) {
            foreach($tablelist as $table) {
                echo '<option value="'.$table.'">'.$table.'</option>';
            }
        }
        echo '</select><br /><br /><center>';
        echo "<a href=\"javascript:void(0);\" onclick=\"setSelectOptions('backup', 'tablelist[]', true); return false;\">";
        echo "<strong>"._CHECKALL."</strong></a>&nbsp;|&nbsp;";
        echo "<a href=\"javascript:void(0);\" onclick=\"setSelectOptions('backup', 'tablelist[]', false); return false;\"><strong>"._UNCHECKALL."</strong></a></center></td>";
        echo '<td valign="middle">
        <label for="op"><span><strong>'._DBACTION.'</strong></span></label><br /><select name="op" id="op"
        onchange="dbback=document.getElementById(\'backuptasks\');dbback.style.display=(this.options[this.selectedIndex].value==\'BackupDB\') ? \'\' : \'none\';">
        <option value="AnalyzeDB">'._ANALYZEDATABASE.'</option>
        <option value="BackupDB" selected="selected">'._SAVEDATABASE.'</option>
        <option value="CheckDB">'._CHECKDATABASE.'</option>
        <option value="OptimizeDB">'._OPTIMIZEDATABASE.'</option>
        <option value="RepairDB">'._REPAIRDATABASE.'</option>
        <option value="StatusDB">'._STATUSDATABASE.'</option>
        </select>&nbsp;<input type="submit" value="'.$admlang['global']['go'].'" /><br /><br /><div id="backuptasks" style="float: center;">'._BACKUPTASKS.':<br />
        <input type="checkbox" value="1" name="dbdata" checked="checked" style="margin-left: 10px;" />'._SAVEDATA.'<br />
        <input type="checkbox" value="1" name="dbstruct" checked="checked" style="margin-left: 10px;" />'.sprintf(_INCLUDESTATEMENT, 'CREATE').'<br />
        <input type="checkbox" value="1" name="drop" checked="checked" style="margin-left: 10px;" />'.sprintf(_INCLUDESTATEMENT, 'DROP').'<br />';

        if (GZIPSUPPORT) {
            echo '<input type="checkbox" value="1" name="gzip" checked="checked" style="margin-left: 10px;" />'._GZIPCOMPRESS;
        }
        echo '</div></td><td valign="top" width="50%">';

        //OpenTable();
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">';
echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="green">OPTIMIZE INFORMATION</font></strong></legend>';
echo '<br />';
        echo '<div align="center">'._OPTIMIZETEXT;
        echo '</fieldset>';
		//CloseTable();

        echo '</td></tr></table></form><br /><br />
        <span><strong>'._IMPORTFILE.'</strong></span><br /><br />
        <form method="post" action="'.$admin_file.'.php" name="restore" enctype="multipart/form-data">
        <input type="file" name="sqlfile" size="100" /> <input type="hidden" name="op" value="RestoreDB" /><input type="submit" value="'._IMPORTSQL.'" />
        </form>';
        CloseTable();
       
        OpenTable();
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a> ]</div>\n";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
				
		include_once(NUKE_BASE_DIR.'footer.php');
        break;
  }

} 
else 
{
    echo "Access Denied";
}

?>
