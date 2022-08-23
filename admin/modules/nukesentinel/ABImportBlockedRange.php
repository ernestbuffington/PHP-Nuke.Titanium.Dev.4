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

@set_time_limit(600);
$pagetitle = _AB_NUKESENTINEL.": "._AB_ADMINISTRATION.": "._AB_IMPORTRANGE;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_IMPORTRANGE);
ipbanmenu();
CarryMenu();
importmenu();
CloseMenu();
CloseTable();
echo "<br />\n";
OpenTable();
if (!isset($importer)) $importer = '';
if (!isset($importmess)) $importmess = '';
ABLoadDataMenu($importer, "ABImportBlockedRange");
if(isset($importer) AND $importer > "") {
  echo "<hr />\n";
  // Read and import Country Data
  $import_data = @file(NUKE_INCLUDE_DIR."nukesentinel/import/".$importer.".data");
  $import_data = (is_array($import_data)) ? implode($import_data) : '';
  if(!$import_data OR $import_data == "") {
    echo "<center><strong>"._AB_UNAVAILABLE."</strong></center>\n";
  } else {
    $import_data - str_replace("\r", "", $import_data);
    $import_data = explode("\n", $import_data);
    $import_count = count($import_data);
    $importmess = _AB_EVERYTHINGSUCCESSFULLY."<br />\n";
    for($i=0; $i<$import_count; $i++) {
      $import_data[$i] = trim($import_data[$i]);
      if($import_data[$i] > "") {
        $grabline = explode("||", $import_data[$i]);
        if($grabline[0] == "--") {
          $db->sql_query("DELETE FROM `".$prefix."_nsnst_blocked_ranges` WHERE `c2c`='".$grabline[3]."'");
          $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_blocked_ranges`");
        } else {
          $datainserted = False;
          $importby = _AB_IMPORTBY." "._AB_NUKESENTINEL;
          $datetime = time();
          $datainserted = $db->sql_query("INSERT INTO `".$prefix."_nsnst_blocked_ranges` VALUES('$grabline[0]', '$grabline[1]', '$datetime', '$importby', 0, 0, '$grabline[3]')");
          if(!$datainserted) {
            echo '<strong>'.long2ip($grabline[0]).' - '.long2ip($grabline[1])._AB_NOTINSERTED.$prefix.'_nsnst_blocked_ranges</strong><br />'."\n";
            $importmess = "";
          }
        }
      }
    }
  }
}
echo "$importmess<br />\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>