<?php

/********************************************************/
/* NSN Center Blocks                                    */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/* Ported for Nuke-Evolution by Quake                   */
/* http://www.evo-mods.com                              */
/* Additional Porting by co0kz & Rodmar                 */
/* http://www.cookie-creations.net                      */
/* http://www.evolved-Systems.net                       */
/********************************************************/
/* Original by: Richard Benfield                        */
/* http://www.benfield.ws                               */
/********************************************************/

if(!defined('ADMIN_FILE')) {
    exit('Access Denied');
}
global $prefix, $db;
include_once(NUKE_BASE_DIR.'header.php');
title(_CB_ADMIN2);
CBMenu();
echo"<br />\n";
CBSample(2);
OpenTable();
title(_CB_CONFIG2);
$cbinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsncb_config` WHERE `cgid`='2'"));
echo "<center><table border='0'><tr><form action='".$admin_file.".php' method='post'>\n";
echo "<td>"._CB_ACTIVE.": <select name='xenabled'>\n";
if($cbinfo['enabled'] == 0) { $se0 = " selected"; } else { $se1 = " selected"; }
echo "<option value='0'".$se0.">"._NO."</option>\n";
echo "<option value='1'".$se1.">"._YES."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td>"._CB_NUMBER.": <select name='xcount'>\n";
if($cbinfo['count'] == 1) { $sc1 = " selected";} elseif($cbinfo['count'] == 2) { $sc2 = " selected";} elseif($cbinfo['count'] == 3) { $sc3 = " selected";} elseif($cbinfo['count'] == 4) { $sc4 = " selected";}
echo "<option value='1'".$sc1.">1</option>\n<option value='2'".$sc2.">2</option>\n";
echo "<option value='3'".$sc3.">3</option>\n<option value='4'".$sc4.">4</option>\n</select></td></tr>\n";
echo "<tr><td>"._CB_HEIGHT.": <input size='4' type='text' name='xheight' value='".$cbinfo['height']."' /></td>";
echo "</tr></table></center><br /><br /><br />\n";
title(_CB_LIST2);
$cblocksdir = dir(NUKE_BLOCKS_DIR);
while($func=$cblocksdir->read()) { if(substr($func, 0, 6) == "block-") { $cblockslist .= "$func "; } }
closedir($cblocksdir->handle);
$cblockslist = explode(" ", $cblockslist);
sort($cblockslist);
$result2 = $db->sql_query("SELECT * FROM `".$prefix."_nsncb_blocks` WHERE `cgid`='2' ORDER BY `cbid`");
while($cbidinfo = $db->sql_fetchrow($result2)) {
  if($cbidinfo['cbid'] > 1) { echo "<br />\n"; }
  echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<tr><td align='center' colspan='2'><span>"._CB_BLOCK." "._CB_ID.": ".$cbidinfo['cbid']."</span></td></tr>\n";
  echo "<tr><td valign='top'><span>"._CB_TITLE."</span>:</td><td><input type='text' name='x".$cbidinfo['cbid']."title' value='".$cbidinfo['title']."' /></td></tr>\n";
  echo "<tr><td valign='top'><span>"._CB_FILENAME."</span>:</td><td><select name='x".$cbidinfo['cbid']."name'>";
  echo "<option ";
  if($cbidinfo['filename']=="") { echo "selected "; }
  echo "value=''>"._CB_NONE."</option>\n";
  for($i=0; $i < sizeof($cblockslist); $i++) {
    if($cblockslist[$i]!="") {
      $bl = str_replace("block-","",$cblockslist[$i]);
      $bl = str_replace(".php","",$bl);
      $bl = str_replace("_"," ",$bl);
      echo "<option ";
      if($cblockslist[$i]==$cbidinfo['filename']) { echo "selected "; }
      echo "value='$cblockslist[$i]'>$bl</option>\n";
    }
  }
  echo "</select></td></tr>\n";
  echo "<tr><td valign='top'><span>"._CB_SPEC."</span>:</td><td><select name='x".$cbidinfo['cbid']."wtype'>";
  if($cbidinfo['wtype'] == 0) { $w1t0 = " selected"; } else { $w1t1 = " selected"; }
  echo "<option value='0'".$w1t0.">"._CB_PIX."</option>\n";
  echo "<option value='1'".$w1t1.">"._CB_PER."</option>\n";
  echo "</select></td></tr>\n";
  echo "<tr><td><span>"._CB_WID."</span>:</td><td><input size='4' type='text' name='x".$cbidinfo['cbid']."width' value='".$cbidinfo['width']."' /></td></tr>\n";
  echo "<tr><td valign='top'><span>"._CB_CONTENT."</span>:</td><td><textarea name='x".$cbidinfo['cbid']."content' $textrowcol wrap='virtual'>".$cbidinfo['content']."</textarea></td></tr>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._CB_SAVE."' /></td></tr>\n";
  echo "</table>\n";
}
echo "<input type='hidden' name='op' value='CenterBlocksSave2' /></form>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>