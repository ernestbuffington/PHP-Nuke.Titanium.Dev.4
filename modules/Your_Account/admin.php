<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}


require_once("modules/Your_Account/includes/constants.php");

if (!defined('CNBYA')) {
    die('CNBYA protection');
}
define('IN_ADMIN', true);

/*****[BEGIN]******************************************
 [ Mod:    Admin IP Lock                       v2.1.0 ]
 ******************************************************/
/*=====
  For more information on how to use this please see the help file in the help/features folder
  =====*/
include(NUKE_BASE_DIR.'ips.php');
global $identify;
if(isset($ips) && is_array($ips)) {
    $ip_check = implode('|^',$ips);
    if (!preg_match("/^".$ip_check."/",$identify->get_ip())) {
        unset($aid);
        unset($admin);
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        global $cookie;
        $name = (isset($cookie[1]) && !empty($cookie[1])) ? $cookie[1] : _ANONYMOUS;
        log_write('admin', $name.' used invalid IP address attempted to access the YA admin area', 'Security Breach');
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        die('Invalid IP<br />Access denied');
    }
    define('ADMIN_IP_LOCK',true);
}
/*****[END]********************************************
 [ Mod:    Admin IP Lock                       v2.1.0 ]
 ******************************************************/

define('YA_ADMIN', true);
$pnt_module = basename(dirname(__FILE__));
include_once(NUKE_MODULES_DIR.$pnt_module.'/includes/functions.php');
get_lang($pnt_module);

if (is_mod_admin($pnt_module)) {

// removed because it is already called in /modules/Your_Account/includes/mainfileend.php
$ya_config = ya_get_configs();

switch($op) {

    default:
        $pagetitle = ": "._USERADMIN;
        include_once(NUKE_BASE_DIR.'header.php');
		OpenTable();
	    echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&amp;file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        title(_USERADMIN);
        amain();
        include_once(NUKE_BASE_DIR.'footer.php');
    break;

    case "addUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/adduser.php');
    break;

    case "addUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/adduserconf.php');
    break;

    case "approveUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/approveuser.php');
    break;

    case "approveUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/approveuserconf.php');
    break;

    case "activateUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/activateuser.php');
    break;

    case "activateUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/activateuserconf.php');
    break;

    case "autoSuspend":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/autosuspend.php');
    break;

    case "credits":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/credits.php');
    break;

    case "CookieConfig":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/menucookies.php');
    break;

    case "CookieConfigSave":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/menucookiessave.php');
    break;

    case "deleteUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/deleteuser.php');
    break;

    case "deleteUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/deleteuserconf.php');
    break;

    case "denyUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/denyuser.php');
    break;

    case "denyUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/denyuserconf.php');
    break;

    case "detailsTemp":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/detailstemp.php');
    break;

    case "detailsUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/detailsuser.php');
    break;

    case "findTemp":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/findtemp.php');
    break;

    case "findUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/finduser.php');
    break;

    case "listnormal":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/listnormal.php');
    break;

    case "listpending":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/listpending.php');
    break;

    case "listresults":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/listresults.php');
    break;

    case "modifyTemp":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/modifytemp.php');
    break;

    case "modifyTempConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/modifytempconf.php');
    break;

    case "modifyUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/modifyuser.php');
    break;

    case "modifyUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/modifyuserconf.php');
    break;
    
    case "promoteUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/promoteuser.php');
    break;

    case "promoteUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/promoteuserconf.php');
    break;

    case "removeUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/removeuser.php');
    break;

    case "removeUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/removeuserconf.php');
    break;

    case "resendMail":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/resendmail.php');
    break;

    case "resendMailConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/resendmailconf.php');
    break;

    case "restoreUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/restoreuser.php');
    break;

    case "restoreUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/restoreuserconf.php');
    break;

    case "searchUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/searchuser.php');
    break;

    case "suspendUser":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/suspenduser.php');
    break;

    case "suspendUserConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/suspenduserconf.php');
    break;

    case "UsersConfig":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/userconfig.php');
    break;

    case "UsersConfigSave":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/userconfigsave.php');
    break;

    case "addField":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/addfield.php');
    break;

    case "saveaddField":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/saveaddfield.php');
    break;

    case "delField":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/delfield.php');
    break;

    case "delFieldConf":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/delfieldconf.php');
    break;
    case "editTOS":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/tos.php');
    break;
}

} else {
    echo "Access Denied";
}

?>