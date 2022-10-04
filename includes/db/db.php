<?php
/* -- -----------------------------------------------------------
 * // Nuke-Evolution Xtreme: Enhanced PHP-Nuke Web Portal System
 * -- -----------------------------------------------------------
 *
 * >> Database
 *
 * @filename    db.php
 * @author      The phpBB Group
 * @version     1.11
 * @date        Nov 24, 2011
 * @notes       n/a
 *
 * -- -----------------------------------------------------------
 * // Legal Stuff
 * -- -----------------------------------------------------------
 *
 * (c) Copyright 2001 The phpBB Group
 * support@phpbb.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 */
if (!defined('NUKE_EVO') || isset($_REQUEST['dbtype'])) 
die('Quit trying to hack my website!');
$pnt_dbtype = 'mysqli';
$pnt_dbtype = strtolower($pnt_dbtype);

if (file_exists(NUKE_DB_DIR . $pnt_dbtype . '.php')) {
    require_once(NUKE_DB_DIR . $pnt_dbtype . '.php');
} else {
    die('Invalid Database Type Specified!');
}

$pnt_db = new sql_db($pnt_dbhost, $pnt_dbuname, $pnt_dbpass, $pnt_dbname, false);

# Enable 86it Network Support START
if ( defined('network') ):
$pnt_db2 = new sql_db($pnt_dbhost2, $pnt_dbuname2, $pnt_dbpass2, $pnt_dbname2, false);
endif;
# Enable 86it Network Support END 

if (!$pnt_db->db_connect_id) 
{
exit("<br /><br /><div align='center'><img src='images/logo.gif'><br /><br /><strong>There seems to be a problem with the MySQL server, sorry for the inconvenience.<br /><br />We should be back shortly.</strong></div>");
}

# Enable 86it Network Support START
if ( defined('network') ):
if (!$pnt_db2->db_connect_id) 
{
exit("<br /><br /><div align='center'><img src='images/logo.gif'><br /><br /><strong>There seems to be a problem with the MySQL server, sorry for the inconvenience.<br /><br />We should be back shortly.</strong></div>");
}
endif;
# Enable 86it Network Support END