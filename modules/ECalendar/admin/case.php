<?php
if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

$module_name = basename(dirname(dirname(__FILE__)));
include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$currentlang.'.php');

switch($op) {
	case "ecalendar":
    case "ecalendar_del":
	case "ecalendar_edit":
    case "ecalendar_add":
	case "ecalendar_update":
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

?>