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
$comment_description = htmlentities($comment_description, ENT_QUOTES);
$commenter_name = htmlentities($commenter_name, ENT_QUOTES);
$pnt_db2->sql_query("UPDATE `".$network_prefix."_reports_comments` SET `commenter_email`='$commenter_email', `commenter_name`='$commenter_name', `comment_description`='$comment_description' WHERE `comment_id`='$comment_id'");
$pnt_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_reports_comments`");
header("Location: modules.php?name=$pnt_module&op=Report&report_id=$report_id");

?>