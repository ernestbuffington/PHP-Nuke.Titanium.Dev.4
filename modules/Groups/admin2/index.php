<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Enhanced Forum Block
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : index.php
   Author        : Quake (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 06.26.2005 (mm.dd.yyyy)

   Description   : Created module out of modules/Forums/groupcp.php.
************************************************************************/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Link to the phpBB2 forum admin menu                                  */
/*                                                                      */
/* Copyright (c) 2002 by Tom Nitzschner (tom@toms-home.com)             */
/* http://bbtonuke.sourceforge.net                                      */
/* http://www.toms-home.com                                             */
/*                                    */
/*   As always, make a backup before messing with anything. All code    */
/*   release by me is considered sample code only. It may be fully      */
/*   functual, but you use it at your own risk, if you break it,        */
/*   you get to fix it too. No waranty is given or implied.             */
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
   die('Access Denied');
}

global $prefix, $db, $admdata;
$module_name = basename(dirname(dirname(__FILE__)));
if(is_mod_admin('Forums')) {

    switch($op) {
        case "Groups":
        redirect('modules/Forums/admin/index.php?op=Groups');
        break;
    }

} else {
    DisplayError("<center><strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"</center>");
}

?>