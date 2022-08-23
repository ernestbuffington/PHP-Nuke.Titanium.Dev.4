<?php

/************************************************************************/
/* NukeJMap [Site_Map]    4.0 by z3rb                                        */
/* =================================                                    */
/*                                                                      */
/* Copyright (c) 2006 by Techgen                                        */
/* http://www.techg3n.net                                               */
/*                                                                      */
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
    die ("Access Denied");
}

switch ($op) {
    case 'site_map':
        include(NUKE_ADMIN_MODULE_DIR.'site_map.php');
    break;

}

?>