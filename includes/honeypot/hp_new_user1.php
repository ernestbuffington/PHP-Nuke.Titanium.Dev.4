<?php 
/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2013 - 2014 coRpSE	                                    */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
exit('Access Denied');
}
global $prefix, $db, $admin_file, $currentlang;
if (file_exists(NUKE_ADMIN_DIR.'language/Honeypot/lang-'.$currentlang.'.php')) {
include_once(NUKE_ADMIN_DIR.'language/Honeypot/lang-'.$currentlang.'.php');
} else {
include_once(NUKE_ADMIN_DIR.'language/Honeypot/lang-english.php');
}
$result1 = $db->sql_query("SELECT usehp, check1, check2, check3, check4, check3time, check4question, check4answer FROM ".$prefix."_honeypot_config");
list($usehp, $check1, $check2, $check3, $check4, $check3time, $check4question, $check4answer) = $db->sql_fetchrow($result1);

if ($usehp == 1){
if ($check3 == 1){
echo "<input type='hidden' name='loadtime' value=".time().">\n" , PHP_EOL;
}
if ($check1 == 1){
echo "<tr id=\"noninfo\"><td bgcolor='$bgcolor2'><div class=\"textbold\"><font color=\"FF0000\">("._HONEYPOT_DONTANSWER.")</font><br>"._HONEYPOT_WHATIS." 2 + 2?:</td><td bgcolor='$bgcolor1'><input name=\"addition\" type=\"text\" size=\"23\"> <span class='tiny'>"._REQUIRED."</span></td></tr>" , PHP_EOL;
}
if ($check2 == 1){
echo"<script> 
var e = document.getElementById('noninfo'); 
e.parentNode.removeChild(e); 
</script>" , PHP_EOL;
if (file_exists('./includes/honeypot/flash.js')) {
echo "<script type=\"text/javascript\" src=\"./includes/honeypot/flash.js\"></script>" , PHP_EOL;
}
echo"<style type=\"text/css\">
.blink {
display: inline;
}
</style>" , PHP_EOL;
echo "<body onload=\"blink();\">" , PHP_EOL
, "<tr><td bgcolor='$bgcolor2' width=\"250px\"><font color=\"FF0000\"><strong><span class=\"blink\">"._HONEYPOT_ANTIBOT."</span></strong></font></td><td bgcolor='$bgcolor1'><input name=\"company\" type=\"text\" size=\"23\" value=\""._HONEYPOT_DELETEALLTEXT."\"> <span class='tiny'>"._REQUIRED."</span>
	</td></tr>" , PHP_EOL;
}
if ($check4 == 1){

   echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">". $check4question ."</td><td bgcolor='$bgcolor1'><input name=\"check4question\" type=\"text\" size=\"23\"> <span class='tiny'>"._REQUIRED."</span></td></tr>" , PHP_EOL;
   }
   
 }
?>