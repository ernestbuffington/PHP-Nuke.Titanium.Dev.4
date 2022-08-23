<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: SQL Control System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : case.backup.php
   Author(s)     : Quake (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 12.03.2005 (mm.dd.yyyy)

   Notes         : Database Backup Manager
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       10/01/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ('Illegal File Access');
}

switch($op) {

    case "database":
    case "backup":
    case "optimize":
    case "BackupDB":
    case "OptimizeDB":
    case "CheckDB":
    case "AnalyzeDB":
    case "RepairDB":
    case "StatusDB":
    case "RestoreDB":
        include(NUKE_ADMIN_MODULE_DIR.'backup.php');
    break;

}

?>