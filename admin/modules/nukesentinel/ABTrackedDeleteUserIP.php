<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2008 by NukeScripts Network       */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

$db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_id`='$user_id' AND `ip_addr`='$ip_addr'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_tracked_ips`");
Header("Location: ".$admin_file.".php?op=$xop&user_id=$user_id&min=$min&showmodule=$showmodule");

?>