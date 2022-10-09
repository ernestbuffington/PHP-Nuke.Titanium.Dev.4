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

$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_harvesters` WHERE `hid`='".$hid."' LIMIT 0,1"));
$db->sql_query("DELETE FROM `".$prefix."_nsnst_harvesters` WHERE `hid`='".$hid."'");
$db->sql_query("ALTER TABLE `".$prefix."_nsnst_harvesters` ORDER BY `harvester`");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_harvesters`");
$list_harvester = explode("\r\n", $ab_config['list_harvester']);
$list_harvester = str_replace($getIPs['harvester'], "", $list_harvester);
rsort($list_harvester);
$endlist = count($list_harvester)-1;
if(empty($list_harvester[$endlist])) { array_pop($list_harvester); }
sort($list_harvester);
$list_harvester = implode("\r\n", $list_harvester);
absave_config("list_harvester", $list_harvester);
header("Location: ".$admin_file.".php?op=$xop&min=$min&direction=$direction");

?>