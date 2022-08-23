<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Theme Management
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : case.themes.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.2
   Date          : 11.27.2005 (mm.dd.yyyy)

   Notes         : Allows admin to easily manage themes.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ('Illegal File Access');
}

switch($op) {
	case "InstallTheme":
    case "themes":
    case "theme_edit":
    case "theme_edit_save":
    case "theme_deactivate":
    case "theme_activate":
    case "theme_uninstall":
    case "theme_install":
    case "theme_install_save":
    case "theme_makedefault":
    case "theme_quickinstall":
    case "theme_options":
    case "theme_transfer":
    case "theme_users":
    case "theme_users_reset":
    case "theme_users_modify":
	case "downloadTheme":
        include(NUKE_ADMIN_MODULE_DIR.'themes.php');
    break;

}

?>