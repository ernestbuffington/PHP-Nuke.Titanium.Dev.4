<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://nukescripts.86it.us)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

if(is_god($admin)) {
  $aidrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_admins` WHERE `aid`='$a_aid' LIMIT 0,1"));
  $subject = _AB_ACCESSFOR.' '.$nuke_config['sitename'];
  $message  = _AB_HTTPONLY."\n";
  $message .= _AB_LOGIN.': '.$aidrow['login']."\n";
  $message .= _AB_PASSWORD.': '.$aidrow['password']."\n";
  $message .= _AB_PROTECTED.': ';
  if($aidrow['protected']==0) { $message .= _AB_NO."\n"; } else { $message .= _AB_YES."\n"; }
  list($amail) = $db->sql_fetchrow($db->sql_query("SELECT `email` FROM `".$prefix."_authors` WHERE `aid`='$a_aid' LIMIT 0,1"));
  @evo_mail($amail, $subject, $message, 'From: '.$nuke_config['adminmail']."\r\nX-Mailer: "._AB_NUKESENTINEL."\r\n");
  header("Location: ".$admin_file.".php?op=ABAuthList");
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>