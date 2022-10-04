<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


$pnt_module = basename(dirname(dirname(__FILE__)));
include_once(NUKE_MODULES_DIR.$pnt_module.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case "Donations":
        include(NUKE_MODULES_DIR.$pnt_module.'/admin/index.php');
    break;

}

?>