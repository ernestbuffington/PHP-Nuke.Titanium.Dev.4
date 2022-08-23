<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
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

$module_name = basename(dirname(dirname(__FILE__)));
include_once(NUKE_MODULES_DIR.$module_name.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case "BannersAdmin":
    case "BannersAdd":
    case "BannerAddClient":
    case "BannerDelete":
    case "BannerEdit":
    case "BannerChange":
    case "BannerClientDelete":
    case "BannerClientEdit":
    case "BannerClientChange":
    case "BannerStatus":
    case "add_banner":
    case "add_client":
    case "ad_positions":
    case "position_add":
    case "position_save":
    case "position_edit":
    case "position_delete":
    case "ad_terms":
    case "ad_plans":
    case "ad_plans_add":
    case "ad_plans_edit":
    case "ad_plans_save":
    case "ad_plans_delete":
    case "ad_plans_status":
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

?>