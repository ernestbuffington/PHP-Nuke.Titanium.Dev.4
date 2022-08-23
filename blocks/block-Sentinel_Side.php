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

if(!defined('NUKE_EVO')) exit;

global $db, $prefix, $ab_config, $currentlang;

$content = '';
$result = $db->sql_query('SELECT `reason` FROM `'.$prefix.'_nsnst_blocked_ips`');
$total_ips = $db->sql_numrows($result);
$db->sql_freeresult($result);
if(!$total_ips) { $total_ips = 0; }
$content .= '<center><img src="modules/NukeSentinel/images/nukesentinel_small.png" height="31" width="88" alt="'._AB_WARNED.'" title="'._AB_WARNED.'" /><br />'._AB_HAVECAUGHT.' '.intval($total_ips).' '._AB_SHAMEFULHACKERS.'</center>'."\n";
$content .= '<hr /><center><a href="http://nukescripts.86it.us" target="_blank">'._AB_NUKESENTINEL.'</a></center>'."\n";

?>