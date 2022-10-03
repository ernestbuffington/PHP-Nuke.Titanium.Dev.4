<?php 
/*=======================================================================
  86it Network Config File
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if(realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');
global $portaladmin, $titanium_dbhost2, $titanium_dbname2, $titanium_dbuname2, $titanium_db2, $network_prefix;
# Your ADMIN user id number goes here!
$portaladmin = '3'; # used to set the Google Page Author Name - for the crawlers!!!
$titanium_dbhost2 = 'localhost';
$titanium_dbname2 = 'hub_db';
$titanium_dbuname2 = 'hub_user';
$titanium_dbpass2 = 'askforapassword'; # You will be added when you finish setting your website up! Talk to TheGhost
$network_prefix = 'network';
?>
