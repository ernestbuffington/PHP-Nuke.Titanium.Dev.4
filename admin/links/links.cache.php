<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Cache Admin Panel
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
  
   Filename      : links.cache.php
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

global $admin_file;

if ($radminsuper==1) {
    adminmenu($admin_file.'.php?op=cache', "Cache", 'cache.png');
}

?>