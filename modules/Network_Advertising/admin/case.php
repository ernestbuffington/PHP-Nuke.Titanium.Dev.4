<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       08/06/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die('Access Denied');
}

$titanium_module_name = basename(dirname(dirname(__FILE__)));
include_once(NUKE_MODULES_DIR.$titanium_module_name.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case "NetworkBannersAdmin":
    case "NetworkBannersAdd":
    case "NetworkBannerAddClient":
    case "NetworkBannerDelete":
    case "NetworkBannerEdit":
    case "NetworkBannerChange":
    case "NetworkBannerClientDelete":
    case "NetworkBannerClientEdit":
    case "NetworkBannerClientChange":
    case "NetworkBannerStatus":
    case "add_network_banner":
    case "add_network_client":
    case "ad_network_positions":
    case "position_network_add":
    case "position_network_save":
    case "position_network_edit":
    case "position_delete":
    case "ad_network_terms":
    case "ad_network_plans":
    case "ad_network_plans_add":
    case "ad_network_plans_edit":
    case "ad_network_plans_save":
    case "ad_network_plans_delete":
    case "ad_network_plans_status":
        include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/index.php');
    break;

}

?>