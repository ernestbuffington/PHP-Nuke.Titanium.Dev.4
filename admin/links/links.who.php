<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: 4nWhoIsOnline
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team - Nuke-Evolution.com

   Filename      : links.who.php
   Author        : See below
   Improved by   : LombudXa (Rodmar) (www.evolved-Systems.net)
   Version       : 1.0.5 (Based on 4nWhoIsOnline Version 0.91)
   Date          : 12.18.2005 (mm.dd.yyyy)

   Description   : 4nWhoIsOnline shows the current visitors online with
                   their resolved DNS name and country.
*************************************************************************/
/* Based on 4nWhoIsOnline Version 0.91 (german & english)               */
/* for phpNUKE Version 6.5 - 6.7 (www.phpnuke.org)                      */
/* ==================================================================== */
/* By WarpSpeed (Marco Wiesler) (warpspeed@4thDimension.de) @ Jun/2oo3  */
/* http://www.warp-speed.de @ 4thDimension.de Networking                */
/* ==================================================================== */
/* Based on:                                                            */
/* Admin AddOn v3.0                                                     */
/* ================                                                     */
/* Author: Jack Kozbial                                                 */
/* Web: http://www.internetintl.com                                     */
/* ==================================================================== */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ('Illegal File Access');
}

global $admin_file;

if ($radminsuper==1) {
    adminmenu($admin_file.'.php?op=who', _4nwho0a, '4nwho.png');
}

?>