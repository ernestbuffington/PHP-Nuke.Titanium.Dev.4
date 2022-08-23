<?php

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ('Illegal File Access');
}

switch($op) {

    case "Meta":
    case "MetaSave":
    case "MetaDelete":
        include_once(NUKE_ADMIN_MODULE_DIR.'meta.php');
    break;

}

?>