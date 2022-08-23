<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Enhanced Forum Block
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : profile.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 06.26.2005 (mm.dd.yyyy)

   Description   : Created module out of modules/Forums/profile.php.
************************************************************************/

/***************************************************************************
 This file has been changed and moved to modules/Profile/index.php
 Please see that file to make edits or changes.
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

$pos = strpos($_SERVER['QUERY_STRING'],"=profile");
if($pos !== false && $pos != strlen($_SERVER['QUERY_STRING'])) {
    $redirector = "modules.php?name=Profile" . substr($_SERVER['QUERY_STRING'],$pos+8);
} else {
    $redirector = "modules.php?name=Profile";
}
redirect($redirector);

?>