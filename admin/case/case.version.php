<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : case.version.php
   Author        : Technocrat (www.nuke-evolution.com)
   Version       : 1.0.0
   Date          : 06/16/2005 (dd-mm-yyyy)

   Notes         : Verifies if latest Nuke-Evolution Basic Release is
                   installed and a recent changelog.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Evolution Version Checker                v1.0.0       06/16/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ('Illegal File Access');
}

switch($op) {

    case "version":
        include(NUKE_ADMIN_MODULE_DIR.'version.php');
    break;

}

?>