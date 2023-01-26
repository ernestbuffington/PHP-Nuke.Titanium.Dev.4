<?php
/*=======================================================================
 PHP-Nuke Titanium v4.0.3 : Enhanced PHP-Nuke Web Portal System
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
      Caching System                           v1.0.0       10/31/2005
	  Titanium Patched                         v4.0.3       01/25/2023
-=[Mod]=-
      Blogs BBCodes                            v1.0.0       10/05/2005
      Custom Text Area                         v1.0.0       11/23/2005
-=[Applied Rules]=-
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Access Denied");
}

$module_name = 'Blog_Topics';
include_once(NUKE_MODULES_DIR.$module_name.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case "relatedsave":
    case "relatededit":
    case "relateddelete":
    case "topicsmanager":
    case "topicedit":
    case "topicmake":
    case "topicdelete":
    case "topicchange":
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

