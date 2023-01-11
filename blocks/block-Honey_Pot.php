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

global $db, $prefix, $admin_file, $blockslang, $evoconfig;

function block_Honeypot_cache() 
{
    global $db, $cache;
    
	if(!($blockcache = $cache->load('honeypot', 'titanium_honey_pot_block'))):
      $result = $db->sql_ufetchrow('SELECT COUNT(id) AS `count` FROM `'._HONEYPOT_TABLE.'`');
	  $blockcache = $result['count'];
      $db->sql_freeresult($result);
      $cache->save('honeypot', 'titanium_honey_pot_block', $blockcache);
      return $blockcache;
	else:
      return $blockcache;
	endif;
	
}

if(!isset($content))
$content = '';

$bot_count = block_Honeypot_cache();

$content .= '<div align="center">';

if ( $side == 'c' || $side == 'd' ):
	$content .= '  <img src="'.img('hp_banner.png', 'honeypot').'" style="height: 110px; width: 369px" alt="'.$blockslang['honeypot']['bots_in_pot'].'" title="'.$blockslang['honeypot']['bots_in_pot'].'" />';
else:
	$content .= '  <img src="'.img('honey_pot.png', 'honeypot').'" style="height: 109px; opacity: 0.4; width: 120px" alt="'.$blockslang['honeypot']['bots_in_pot'].'" title="'.$blockslang['honeypot']['bots_in_pot'].'" />';
endif;

if ( $bot_count > 0 && is_admin() ):
	$content .= '<br />'.sprintf($blockslang['honeypot']['bots_stopped'],'<span class="textbold">', '<a class="gold" href="'.get_admin_filename().'.php?op=honeypot">'.$bot_count.'</a>', '</span>');
else:
	$content .= '<br />'.sprintf($blockslang['honeypot']['bots_stopped'],'<span class="textbold">', $bot_count, '</span>');
endif;

$content .= '<br /><br /><div align="center"><a class="tooltip-html copyright tooltipstered" title="Nuke Honey Pot v2.2 By CoRpSE<br /><center>CLICK TO VISIT HIS WEBSITE</center>" href="https://www.headshotdomain.net" target="_blank"><i class="far fa-copyright"></i> Nuke HoneyPot v2.2</a></div>';
$content .= '</div>';

?>