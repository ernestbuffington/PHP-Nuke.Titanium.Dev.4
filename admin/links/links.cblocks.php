<?php

/********************************************************/
/* NSN Center Blocks                                    */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/* Ported for Nuke-Evolution by Quake                   */
/* http://www.evo-mods.com                              */
/********************************************************/
/* Original by: Richard Benfield                        */
/* http://www.benfield.ws                               */
/********************************************************/

if(!defined('ADMIN_FILE')) {
    exit('Access Denied');
}

if($radminsuper==1) { 
  adminmenu("".$admin_file.".php?op=CenterBlocksAdmin", _CB_BLOCKS, "cblocks.png");
}

?>