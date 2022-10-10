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
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$comment_description = htmlentities($comment_description, ENT_QUOTES);
$commenter_name = htmlentities($commenter_name, ENT_QUOTES);
$db2->sql_query("UPDATE `".$network_prefix."_requests_comments` SET `commenter_name`='$commenter_name', `commenter_email`='$commenter_email', `comment_description`='$comment_description' WHERE `comment_id`='$comment_id'");
$db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_requests_comments`");
header("Location: modules.php?name=$module_name&op=Request&request_id=$request_id");

?>