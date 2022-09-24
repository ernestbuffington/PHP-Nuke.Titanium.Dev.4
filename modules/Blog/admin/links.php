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
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
	  Titanium Patched                         v3.0.0       08/26/2019
 ************************************************************************/
if (!defined('ADMIN_FILE')) die('Access Denied');

global $admin_file;

$titanium_module_name = basename(dirname(dirname(__FILE__)));

get_lang($titanium_module_name);

adminmenu($admin_file.'.php?op=adminStory', _NEWS, 'logo_red.png');
adminmenu($admin_file.'.php?op=submissions', _SUBMISSIONS, 'logo_blue2.png');
adminmenu($admin_file.'.php?op=NENewsConfig', _NE_NEWSCONFIG, 'logo_green.png');
adminmenu($admin_file.'.php?op=LastTwenty', _LASTTWENTY, 'logo_purple.png');
adminmenu($admin_file.'.php?op=ProgrammedBlogs', _PROGRAMMEDBLOGS, 'logo_red_purp.png');
?>