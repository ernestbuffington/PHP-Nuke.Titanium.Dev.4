<?php
/*=======================================================================
 PHP-Nuke Titanium v4.0.3 : Enhanced PHP-Nuke Web Portal System
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
	  Titanium Patched                         v3.0.0       08/26/2019
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
-=[Applied Rules]=-
 * DirNameFileConstantToDirConstantRector
 * LongArrayToShortArrayRector
 * ListToArrayDestructRector (https://wiki.php.net/rfc/short_list_syntax https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.symmetric-array-destructuring)
 * NullToStrictStringFuncCallArgRector	  
 ************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

$module_name = basename(__DIR__);

get_lang($module_name);

$sid = intval($sid);

$query = $db->sql_query("SELECT associated FROM ".$prefix."_blogs WHERE sid='$sid'");

[$associated] = $db->sql_fetchrow($query);

$db->sql_freeresult($query);

if (!empty($associated)) 
{
    OpenTable();
    echo "<div align=\"center\"><strong>"._ASSOCIATED_BLOG_TOPICS."</strong><br /><br />";
    
	$asso_t = explode("-",(string) $associated);
    
	for ($i=0; $i<count($asso_t); $i++) 
	{
      if (!empty($asso_t[$i])) 
	  {
        $query = $db->sql_query("SELECT topicimage, topictext from ".$prefix."_blogs_topics WHERE topicid='".$asso_t[$i]."'");
	    [$topicimage, $topictext] = $db->sql_fetchrow($query);
	    $db->sql_freeresult($query);
	    echo "<a href=\"modules.php?name=$module_name&new_topic=$asso_t[$i]\"><img src=\"".$tipath.$topicimage."\" border=\"0\" hspace=\"10\" alt=\"".$topictext."\" title=\"".$topictext."\"></a>";
      }
    }
    echo "</div>";
    CloseTable();
}

