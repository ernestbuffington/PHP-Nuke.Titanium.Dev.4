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

$getIPs = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_strings` WHERE `sid`='".$sid."' LIMIT 0,1"));
$titanium_db->sql_query("DELETE FROM `".$titanium_prefix."_nsnst_strings` WHERE `sid`='".$sid."'");
$titanium_db->sql_query("ALTER TABLE `".$titanium_prefix."_nsnst_strings` ORDER BY `string`");
$titanium_db->sql_query("OPTIMIZE TABLE `".$titanium_prefix."_nsnst_strings`");
$list_string = explode("\r\n", $ab_config['list_string']);
$list_string = str_replace($getIPs['string'], "", $list_string);
rsort($list_string);
$phpbb2_endlist = count($list_string)-1;
if(empty($list_string[$phpbb2_endlist])) { array_pop($list_string); }
sort($list_string);
$list_string = implode("\r\n", $list_string);
absave_config("list_string", $list_string);
header("Location: ".$admin_file.".php?op=$xop&min=$min&direction=$direction");

?>