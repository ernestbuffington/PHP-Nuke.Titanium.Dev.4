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
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

$sid = intval($sid);

$query = $titanium_db->sql_query("SELECT associated FROM ".$titanium_prefix."_stories WHERE sid='$sid'");

list($associated) = $titanium_db->sql_fetchrow($query);

$titanium_db->sql_freeresult($query);

if (!empty($associated)) 
{
    OpenTable();
    echo "<div align=\"center\"><strong>"._ASSOTOPIC."</strong><br /><br />";
    
	$asso_t = explode("-",$associated);
    
	for ($i=0; $i<count($asso_t); $i++) 
	{
      if (!empty($asso_t[$i])) 
	  {
        $query = $titanium_db->sql_query("SELECT topicimage, topictext from ".$titanium_prefix."_topics WHERE topicid='".$asso_t[$i]."'");
	    list($topicimage, $topictext) = $titanium_db->sql_fetchrow($query);
	    $titanium_db->sql_freeresult($query);
	    echo "<a href=\"modules.php?name=$titanium_module_name&new_topic=$asso_t[$i]\"><img src=\"".$tipath.$topicimage."\" border=\"0\" hspace=\"10\" alt=\"".$topictext."\" title=\"".$topictext."\"></a>";
      }
    }
    echo "</div>";
    CloseTable();
    //echo "<br />";
}
?>
