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
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

$module_name = basename(dirname(dirname(__FILE__)));
include_once(NUKE_MODULES_DIR.$module_name.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case "Links":
    case "LinksDelNew":
    case "LinksAddCat":
    case "LinksAddSubCat":
    case "LinksAddLink":
    case "LinksAddEditorial":
    case "LinksModEditorial":
    case "LinksLinkCheck":
    case "LinksValidate":
    case "LinksDelEditorial":
    case "LinksCleanVotes":
    case "LinksListBrokenLinks":
    case "LinksEditBrokenLinks":
    case "LinksDelBrokenLinks":
    case "LinksIgnoreBrokenLinks":
    case "LinksListModRequests":
    case "LinksChangeModRequests":
    case "LinksChangeIgnoreRequests":
    case "LinksDelCat":
    case "LinksModCat":
    case "LinksModCatS":
    case "LinksModLink":
    case "LinksModLinkS":
    case "LinksDelLink":
    case "LinksDelVote":
    case "LinksDelComment":
    case "LinksTransfer":
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

?>