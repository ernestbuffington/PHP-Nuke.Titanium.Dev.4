<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                        lang_adv_time.php [English]
 *                            -------------------
 *   begin                : Sat July 09 2005
 *   copyright            : (C) 2005 -=ET=- http://www.golfexpert.net/phpbb
 *   email                : n/a
 *   Credit               : cipher_nemo < johnsuit@hotmail.com> (John Suit) n/a
 *
 *   $Id: lang_adv_time.php, 1.0.0, 2005/07/09 00:00:00, -=ET=- Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

$lang['time_mode'] = 'Time management';
$lang['time_mode_text'] = 'Forum settings ignored when set to an automatic mode (JavaScript is required for the first two).<br />For the manual mode, the DST difference is the difference between Daylight Saving Time and normal time for your country (from 0 to 120 minutes, typically 60).<br /><br />* The mode marked by the asterisk is used by default on this board and is recommended by its administrator.';
$lang['time_mode_auto'] = 'Automatic modes...';
$lang['time_mode_full_pc'] = 'Your computer time';
$lang['time_mode_server_pc'] = 'Server universal time, Timezone/DST<br /><span STYLE="margin-left: 25">from your computer</span>';
$lang['time_mode_full_server'] = 'Server local time';
$lang['time_mode_manual'] = 'Manual mode...';
$lang['time_mode_dst'] = 'DST enable';
$lang['time_mode_dst_server'] = 'By the server';
$lang['time_mode_dst_time_lag'] = 'DST difference';
$lang['time_mode_dst_mn'] = 'min';
$lang['time_mode_timezone'] = 'Timezone';

$lang['dst_time_lag_error'] = 'DST difference value error. You must type a number of minutes between 0 and 120.';

$lang['dst_enabled_mode'] = ' [DST enabled]';
$lang['full_server_mode'] = 'Time synchronized with the forum server time';
$lang['server_pc_mode'] = 'Time synchro. with the server - Timezone/DST with your computer';
$lang['full_pc_mode'] = 'Time synchronized with your computer time';

?>