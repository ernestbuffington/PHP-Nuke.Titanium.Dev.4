<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
  
   Filename      : info.php
   Author(s)     : Quake (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 12.19.2005 (mm.dd.yyyy)
                                                                        
   Notes         : Server Info Administration Panel
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
    adminmenu($admin_file.'.php?op=info', 'System Info', 'info.png');
}

?>