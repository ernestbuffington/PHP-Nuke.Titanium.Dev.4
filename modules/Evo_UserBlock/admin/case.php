<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

$titanium_module_name = basename(dirname(dirname(__FILE__)));
include_once(NUKE_MODULES_DIR.$titanium_module_name.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case "evo-userinfo":
        include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/index.php');
    break;

}

?>