<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : case.adminlog.php
   Author        : Technocrat (www.nuke-evolution.com)
   Version       : 1.0.1
   Date          : 06/08/2005 (dd-mm-yyyy)

   Notes         : Admin Tracker stores failed admin logins.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Admin Tracker                            v1.0.1       06/08/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ('Illegal File Access');
}

switch($op) {

    case "viewadminlog":
    case "adminlog_ack":
    case "adminlog_clear":
        include(NUKE_ADMIN_MODULE_DIR.'adminlog.php');
    break;

}

?>