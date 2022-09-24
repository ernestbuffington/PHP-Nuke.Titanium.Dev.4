<?php
if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

$titanium_module_name = basename(dirname(dirname(__FILE__)));
include_once(NUKE_MODULES_DIR.$titanium_module_name.'/language/lang-'.$currentlang.'.php');

switch($op) {
	case "ecalendar":
    case "ecalendar_del":
	case "ecalendar_edit":
    case "ecalendar_add":
	case "ecalendar_update":
        include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/index.php');
    break;

}

?>