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

include_once(NUKE_BASE_DIR.'header.php');
title(_CB_ADMIN);
CBMenu();
include_once(NUKE_BASE_DIR.'footer.php');

?>