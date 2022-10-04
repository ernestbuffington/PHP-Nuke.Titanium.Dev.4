<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/
if (!defined('MODULE_FILE')) { 
   die ("You can't access this file directly...");
}

global $pnt_db, $pnt_prefix, $phpbb2_root_path, $nuke_root_path, $nuke_file_path, $phpbb2_root_dir, $pnt_module, $name, $file;
$pnt_module = basename(dirname(__FILE__));
$phpbb2_root_path = NUKE_FORUMS_DIR;
get_lang($pnt_module);
include_once(NUKE_BASE_DIR.'header.php');
?>