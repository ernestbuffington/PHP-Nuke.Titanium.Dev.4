<?php
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
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

global $prefix, $db;
if (is_mod_admin()) {

    include_once(NUKE_ADMIN_MODULE_DIR.'settings/functions.php');

    switch($op) {
    
        case "Configure":
        $sub = intval($_REQUEST['sub'] = $_REQUEST['sub'] ?? '');
        show_settings($sub);
        break;
    
        case "ConfigSave":
        if(isset($_REQUEST['sub'])) {
            $sub = intval($_REQUEST['sub']);
            save_settings($sub);
        } else {
            exit('Illegal Operation');
        }
        break;
    
    }

} else {
    echo "Access Denied";
}

?>