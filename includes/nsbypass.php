<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright © 2000-2007 by NukeScripts Network         */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

error_reporting(E_ALL^E_NOTICE);
@ini_set('display_errors', 0);
chdir("../");
@require_once("mainfile.php");
$tid = intval($tid);
$tum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnst_tracked_ips WHERE `tid`='$tid'"));
if(is_admin() AND $tum > 0) {
  $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnst_tracked_ips WHERE `tid`='$tid'"));
  $row['refered_from'] = html_entity_decode($row['refered_from'], ENT_QUOTES);
  header("Location: ".$row['refered_from']);
} else {
  header("Location: ".$nuke_config['nukeurl']);
}

?>