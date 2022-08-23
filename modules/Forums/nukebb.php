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

global $db, $prefix, $phpbb_root_path, $nuke_root_path, $nuke_file_path, $phpbb_root_dir, $module_name, $name, $file;
$module_name = basename(dirname(__FILE__));
$phpbb_root_path = NUKE_FORUMS_DIR;
get_lang($module_name);
include_once(NUKE_BASE_DIR.'header.php');
?>