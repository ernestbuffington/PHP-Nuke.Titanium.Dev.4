<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       10/01/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ('Illegal File Access');
}

global $admin_file, $currentlang;

if ( $radminsuper == 1 ):

	include_once('admin/language/Sommaire/lang-'.$currentlang.'.php');
	adminmenu($admin_file.'.php?op=sommaire', _SOMMAIRE, 'sommaire.png');

endif;

?>