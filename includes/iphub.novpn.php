<?PHP
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
	exit('Access Denied');

global $identify;

if (get_evo_option('iphub_status', 'int') == 1):

	require_once(NUKE_CLASSES_DIR.'iphub.class.php');
	$ip = $identify->get_ip();

	# (string) $ip, (string) $key, (boolean) $strict
	if (!isset($_COOKIE['failedcheck']) && !isset($_COOKIE['passedcheck'])): 
	
		if (Lookup::isBadIP($ip, get_evo_option('iphub_key'), false)):

			get_header();
			setcookie("failedcheck", true, time() + (60 * get_evo_option('iphub_cookietime')), "/" );
			header('location: vpn-access-denied.html');
			get_footer();

		else:		
			setcookie("passedcheck", true, time() + (60 * get_evo_option('iphub_cookietime')), "/" );
		endif;

	elseif (isset($_COOKIE['failedcheck'])):

		get_header();
		header('location: vpn-access-denied.html');
		get_footer();

	endif;

endif;
?>