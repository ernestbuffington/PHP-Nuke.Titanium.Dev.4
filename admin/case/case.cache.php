<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Cache Admin Panel
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : case.cache.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.2
   Date          : 11.11.2005 (mm.dd.yyyy)

   Notes         : Allows admin to easily manage the built-in cache.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ('Illegal File Access');
}

switch($op) {

    case "cache_delete":
    case "cache_view":
    case "cache_clear":
    case "usrclearcache":
    case "howto_enable_cache":
    case "cache":
        include(NUKE_ADMIN_MODULE_DIR.'cache.php');
    break;

}

?>