<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

$pnt_module = basename(dirname(dirname(__FILE__)));
include_once(NUKE_MODULES_DIR.$pnt_module.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case "evo-userinfo":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/index.php');
    break;

}

?>