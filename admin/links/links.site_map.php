<?php

/************************************************************************/
/* NukeJMap [Site_Map]    4.0 by z3rb                                   */
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
global $admin_file;
if ($radminsuper==1) {
    adminmenu("".$admin_file.".php?op=site_map", "Google Site Map", "sitemap.png");
}

?>