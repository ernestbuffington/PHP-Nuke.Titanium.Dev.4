<?php
/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2013 coRpSE			                                */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $titanium_db, $titanium_prefix, $admin_file, $blockslang;

function block_Honeypot_cache($block_cachetime) {
    global $titanium_db, $cache;
    if ((($blockcache = $cache->load('honeypot', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $titanium_db->sql_ufetchrow('SELECT COUNT(id) AS `count` FROM `'._HONEYPOT_TABLE.'`');
        $blockcache[1]['count'] = $result['count'];
        $titanium_db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('honeypot', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_Honeypot_cache($titanium_config['block_cachetime']);

$content .= '<div class="center">';

if ( $side == 'c' || $side == 'd' ):
	$content .= '  <img src="'.get_evo_image('hp_banner.png', 'honeypot').'" style="height: 110px; width: 369px" alt="'.$blockslang['honeypot']['bots_in_pot'].'" title="'.$blockslang['honeypot']['bots_in_pot'].'" />';
else:
	$content .= '  <img src="'.get_evo_image('honey_pot.png', 'honeypot').'" style="height: 109px; opacity: 0.4; width: 120px" alt="'.$blockslang['honeypot']['bots_in_pot'].'" title="'.$blockslang['honeypot']['bots_in_pot'].'" />';
endif;

if ( $blocksession[1]['count'] > 0 && is_admin() ):
	$content .= '<br />'.sprintf($blockslang['honeypot']['bots_stopped'],'<span class="textbold">', '<a class="gold" href="'.get_admin_filename().'.php?op=honeypot">'.$blocksession[1]['count'].'</a>', '</span>');
else:
	$content .= '<br />'.sprintf($blockslang['honeypot']['bots_stopped'],'<span class="textbold">', $blocksession[1]['count'], '</span>');
endif;

$content .= '<br /><br /><div align="center"><a class="tooltip-html copyright tooltipstered" title="Nuke Honey Pot v2.2 By CoRpSE<br /><center>CLICK TO VISIT HIS WEBSITE</center>" href="https://www.headshotdomain.net" target="_blank"><i class="far fa-copyright"></i> Nuke HoneyPot v2.2</a></div>';
$content .= '</div>';

?>