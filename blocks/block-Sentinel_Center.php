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

global $db, $prefix, $ab_config, $currentlang, $cache;

if(($total_ips = $cache->load('total_ips', 'titanium_sentienel_center_block')) === false) 
{
  $result = $db->sql_query('SELECT `reason` FROM `'.$prefix.'_nsnst_blocked_ips`');
  $total_ips = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  $cache->save('total_ips', 'titanium_sentienel_center_block', $total_ips);
}

$content = '';

$content .= '<div align="center">'._AB_HAVECAUGHT.'<strong> '.intval($total_ips).'</strong> '._AB_SHAMEFULHACKERS.'<br /><img style="border-radius: 12px;" src="modules/NukeSentinel/images/nukesentinel_large.png" height="60" width="468" alt="'._AB_WARNED.'" 
title="'._AB_WARNED.'" /></div>'."\n";
$content .= '<div align="center"><a href="http://nukescripts.86it.us" target="_blank">Copyright © 2000-2021 by NukeScripts&trade;</a></div>'."\n";

?>