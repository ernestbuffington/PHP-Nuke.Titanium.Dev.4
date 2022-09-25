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

global $titanium_db, $titanium_prefix, $ab_config, $currentlang;

function block_Sentinel_Center_cache($block_cachetime) 
{
    global $titanium_db, $titanium_prefix, $cache;
    if ((($blockcache = titanium_cache_load('sentinel_center', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = dburow('SELECT COUNT(ip_addr) AS `count` FROM `'.$titanium_prefix.'_nsnst_blocked_ips`');
        $blockcache[1]['count'] = $result['count'];
        dbfree($result);
        $blockcache[0]['stat_created'] = time();
        titanium_cache_set('sentinel_center', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_Sentinel_Center_cache( get_evo_option('block_cachetime') );

$content = '';
$total_phpbb2_ips = $blocksession[1]['count'];
if( empty($blocksession[1]['count']) ):
	$total_phpbb2_ips = 0;
endif;

$content .= '<div align="center">'._AB_HAVECAUGHT.'<strong> '.intval($total_phpbb2_ips).'</strong> '._AB_SHAMEFULHACKERS.'<br /><img src="modules/NukeSentinel/images/nukesentinel_large.png" height="60" width="468" alt="'._AB_WARNED.'" 
title="'._AB_WARNED.'" /></div>'."\n";
$content .= '<div align="center"><a href="http://nukescripts.86it.us" target="_blank">Copyright © 2000-2021 by NukeScripts&trade;</a></div>'."\n";

?>