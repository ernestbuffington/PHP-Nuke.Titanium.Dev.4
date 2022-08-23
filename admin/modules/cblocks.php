<?php

/********************************************************/
/* NSN Center Blocks                                    */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/* Ported for Nuke-Evolution by Quake                   */
/* http://www.evo-mods.com                              */
/* Additional Porting by co0kz & Rodmar                 */
/* http://www.cookie-creations.net                      */
/* http://www.evolved-Systems.net                       */
/********************************************************/
/* Original by: Richard Benfield                        */
/* http://www.benfield.ws                               */
/********************************************************/

if(!defined('ADMIN_FILE')) {
    exit('Access Denied');
}

if (!defined("NSNCBLOCKS_IS_LOADED")) $op = 'CenterBlocksLoadError';
$textrowcol = "rows='15' cols='60'";
global $prefix, $db, $admin_file, $admdata;
if (is_mod_admin()) {
  switch($op) {
    case "CenterBlocksAdmin":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksAdmin.php');break;
    case "CenterBlocksLoadError":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksLoadError.php');break;
    case "CenterBlocksSave1":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksSave1.php');break;
    case "CenterBlocksSave2":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksSave2.php');break;
    case "CenterBlocksSave3":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksSave3.php');break;
    case "CenterBlocksSave4":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksSave4.php');break;
    case "CenterBlocksSet1":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksSet1.php');break;
    case "CenterBlocksSet2":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksSet2.php');break;
    case "CenterBlocksSet3":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksSet3.php');break;
    case "CenterBlocksSet4":include(NUKE_ADMIN_MODULE_DIR.'cblocks/CenterBlocksSet4.php');break;
  }
} else {
    echo "Access Denied";
}

?>