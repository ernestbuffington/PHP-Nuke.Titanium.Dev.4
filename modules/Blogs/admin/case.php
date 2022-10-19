<?php
/*=======================================================================
 PHP-Nuke Titanium | Nuke-Evolution Basic : Enhanced and Advanced
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

/********************************************************/
/* NSN Blogs                                            */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* Contributer(s): Ernest Buffington aka TheGhost       */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/

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

$modname = "Blogs";

include_once(NUKE_MODULES_DIR.$modname.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {
    case "LastTwentyBlogs":
	case "ProgrammedBlogs":
    case "BlogsConfig":
    case "BlogsConfigSave":
    case "YesDelBlogCategory":
    case "subdelete":
    case "DelCategory":
    case "NoMoveBlogCategory":
    case "EditBlogCategory":
    case "SaveEditBlogCategory":
    case "AddBlogCategory":
    case "SaveBlogCategory":
    case "DisplayBlog":
    case "PreviewBlogAgain":
    case "PostBlog":
    case "EditBlog":
    case "RemoveBlog":
    case "ChangeBlog":
    case "DeleteBlog":
    case "adminBlog":
    case "PreviewAdminBlog": 
    case "PostAdminBlog":
    case "autoDeleteBlog":
    case "autoEditBlog":
    case "autoSaveEditBlog":
    case "submissions":
        include(NUKE_MODULES_DIR.$modname.'/admin/index.php');
    break;
}
?>
