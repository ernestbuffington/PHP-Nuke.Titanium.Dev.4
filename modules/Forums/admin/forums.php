<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


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
/* Forum admin files for PHP-Nuke 7.5 by chatserv                       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Access Denied");
}

global $prefix, $db, $admdata;
$module_name = basename(dirname(dirname(__FILE__)));
if(is_mod_admin($module_name)) {

    switch($op) {
    
        case "forums":
        redirect("modules/$module_name/admin/index.php");
    }

} else {
    DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"");
}

?>