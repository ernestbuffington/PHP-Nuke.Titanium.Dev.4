<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/

global $titanium_db2;

if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_GENCONFIG;

include_once(NUKE_BASE_DIR.'header.php');

pjadmin_menu(_NETWORK_GENCONFIG);

OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='ConfigUpdate'>\n";

$modlocation = basename(str_replace("/admin", "", dirname(__FILE__)));

echo "<tr><td bgcolor='$bgcolor2' valign='top'><strong>"._NETWORK_MODLOCATION.":</strong></td><td><select name='location'>\n";

$handle=opendir('modules');

while($file = readdir($handle)) 
{
  if( (!preg_match("/[.]/",$file) AND file_exists("modules/$file/index.php")) ) 
  { 
    $titanium_modulelist .= "$file "; 
  }
}
closedir($handle);

$titanium_modulelist = explode(" ", $titanium_modulelist);

sort($titanium_modulelist);

for($i=0; $i < sizeof($titanium_modulelist); $i++) 
{
  if($titanium_modulelist[$i]!="") {
    echo "<option value=\"$titanium_modulelist[$i]\" ";
    if($titanium_modulelist[$i] == $pj_config['location']) echo "selected";
    echo ">$titanium_modulelist[$i]\n";
  }
}

echo "</select><br />"._NETWORK_MODLOCATIONNOTE." $modlocation<br />"._NETWORK_MODLOCATIONNOTE2."</td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._NETWORK_CONFIGUPDATE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";

CloseTable();

pj_copy();

include_once(NUKE_BASE_DIR.'footer.php');

?>
