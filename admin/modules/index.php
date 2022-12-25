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
-=[Other]=-
      Need To Delete                           v1.0.0       06/03/2005
      Date Fix                                 v1.0.0       06/20/2005
      Security Status                          v1.0.0       11/18/2005
-=[Mod]=-
      Admin Icon/Link Pos                      v1.0.0       06/02/2005
      Admin Tracker                            v1.0.1       06/08/2005
      Evolution Version Checker                v1.1.0       08/21/2005
 ************************************************************************/

/*********************************************************/
/* [ External ] Administration Main Function             */
/*********************************************************/

function adminMain() {
    global $language, $admin, $aid, $prefix, $file, $db, $sitename, $user_prefix, $admin_file, $bgcolor1, $evoconfig, $admdata, $dbtype, $cache, $json, $admincookie, $radminsuper;
/*****[BEGIN]******************************************
 [ Mod:     Admin Icon/Link Pos                 v1.0.0 ]
 ******************************************************/
    define('ADMIN_POS', true);
/*****[END]********************************************
 [ Mod:     Admin Icon/Link Pos                 v1.0.0 ]
 ******************************************************/
    include_once(NUKE_BASE_DIR.'header.php');
    $dummy = 0;
/*****[BEGIN]******************************************
 [ Other:   Date Fix                           v1.0.0 ]
 ******************************************************/
    //$month = date('M');
    //$curDate2 = "%".$month[0].$month[1].$month[2]."%".date('d')."%".date('Y')."%";
    //$ty = time() - 86400;
    //$preday = strftime('%d', $ty);
    //$premonth = strftime('%B', $ty);
    //$preyear = strftime('%Y', $ty);
    //$curDateP = "%".$premonth[0].$premonth[1].$premonth[2]."%".$preday."%".$preyear."%";
/*****[END]********************************************
 [ Other:   Date Fix                           v1.0.0 ]
 ******************************************************/
    if ( defined('BOOTSTRAP') ):
      administration_panel();
    else:
      GraphicAdmin();
    endif;
/*****[END]********************************************
 [ Mod:    Evolution Version Checker           v1.1.0 ]
 ******************************************************/
	include(NUKE_BASE_DIR.'footer.php');
}

?>