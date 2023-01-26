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
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
	  Titanium Patched                         v3.0.0       08/26/2019
 ************************************************************************/
 
if (!defined('ADMIN_FILE')) die('Access Denied');

global $admin_file;

$module_name = basename(dirname(dirname(__FILE__)));

get_lang($module_name);

adminmenu($admin_file.'.php?op=adminBlog', _BLOGS, 'logo_red.png');
adminmenu($admin_file.'.php?op=submissions', _BLOG_SUBMISSIONS, 'logo_blue2.png');
adminmenu($admin_file.'.php?op=BlogsConfig', _BLOGS_CONFIG, 'logo_green.png');
adminmenu($admin_file.'.php?op=LastTwentyBlogs', _LAST_BLOG_POSTS, 'logo_purple.png');
adminmenu($admin_file.'.php?op=ProgrammedBlogs', _PROGRAMMEDBLOGS, 'logo_red_purp.png');
?>