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
global $pnt_db2;
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$pidrep = intval($pidrep);
$pid = intval($pid);
$result = $pnt_db2->sql_query("UPDATE `".$network_prefix."_requests_types` SET `type_weight`='$weight' WHERE `type_id`='$pidrep'");
$result2 = $pnt_db2->sql_query("UPDATE `".$network_prefix."_requests_types` SET `type_weight`='$weightrep' WHERE `type_id`='$pid'");
header("Location: ".$admin_file.".php?op=RequestTypeList");

?>