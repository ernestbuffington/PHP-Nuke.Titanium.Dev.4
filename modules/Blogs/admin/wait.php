<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
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
/* Titanium Blog                                                        */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
	  Titanium Patched                         v3.0.0       08/26/2019
 ************************************************************************/
if(!defined('NUKE_EVO')) exit;

global $admin_file, $db, $prefix, $cache;

if(is_active('Submit_Blog')) 
{
    $content .= "<div align=\"left\"><strong><u><span class=\"content\">"._STORIES."</span>:</u></strong></div>";

    if(($numwaits = $cache->load('numwaits', 'submissions')) === false) 
	{
        list($numwaits) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM ".$prefix."_blogs_queue"), SQL_NUM);
        $cache->save('numwaits', 'submissions', $numwaits);
    }
    
	if (is_array($numwaits)) 
    $numwaits = $numwaits['numrows'];
    
	$content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=submissions\">"._BLOG_SUBMISSIONS."</a>:&nbsp;<strong>".$numwaits."</strong><br />";
}
?>
