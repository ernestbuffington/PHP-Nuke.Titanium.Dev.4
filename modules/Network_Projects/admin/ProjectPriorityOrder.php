<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
global $db2;
get_lang('Network_Projects');
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$pidrep = intval($pidrep);
$pid = intval($pid);
$result = $db2->sql_query("UPDATE `".$network_prefix."_projects_priorities` SET `priority_weight`='$weight' WHERE `priority_id`='$pidrep'");
$result2 = $db2->sql_query("UPDATE `".$network_prefix."_projects_priorities` SET `priority_weight`='$weightrep' WHERE `priority_id`='$pid'");
header("Location: ".$admin_file.".php?op=ProjectPriorityList");

?>