<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
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
/* Titanium Blog                                                        */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       10/31/2005
-=[Other]=-
      Blogs Fix                                 v1.0.0      06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
      Custom Text Area                         v1.0.0       11/23/2005
	  Titanium Patched                         v3.0.0       08/26/2019
	  New Blogs Last 100 Admin Mod             v3.0.0       08/27/2019
	  New Blogs Programmed Admin Mod           v3.0.0       08/27/2019
 ************************************************************************/
if (!defined('ADMIN_FILE')) die('Access Denied');

$modname = "Blog";

include_once(NUKE_MODULES_DIR.$modname.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {
    case "LastTwenty":
	case "ProgrammedBlogs":
    case "NENewsConfig":
    case "NENewsConfigSave":
    case "YesDelCategory":
    case "subdelete":
    case "DelCategory":
    case "NoMoveCategory":
    case "EditCategory":
    case "SaveEditCategory":
    case "AddCategory":
    case "SaveCategory":
    case "DisplayStory":
    case "PreviewAgain":
    case "PostStory":
    case "EditStory":
    case "RemoveStory":
    case "ChangeStory":
    case "DeleteStory":
    case "adminStory":
    case "PreviewAdminStory": 
    case "PostAdminStory":
    case "autoDelete":
    case "autoEdit":
    case "autoSaveEdit":
    case "submissions":
        include(NUKE_MODULES_DIR.$modname.'/admin/index.php');
    break;
}
?>
