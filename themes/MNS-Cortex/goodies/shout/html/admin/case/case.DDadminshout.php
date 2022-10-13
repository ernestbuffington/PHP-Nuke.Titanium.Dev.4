<?php

/************************************************************************/
/* PHP-NUKE: DD Shout Admin for PHP-Nuke                                */
/* ============================================                         */
/* Copyright (c) 2004 by ZoNE&Vision                                      */
/* http://www.DestineDesigns.com                                        */
/* Made for PHP-NUKE Advanced Content Management System                 */
/************************************************************************/

if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }

switch($op) {

    case DD_install:
	case DD_uninstall:
    case DD_clearShouts:
    case post_install:
    case post_uninstall:
    case post_clear:
    
    case DDshout:
    	include("admin/modules/DDadminshout.php");
}






?>