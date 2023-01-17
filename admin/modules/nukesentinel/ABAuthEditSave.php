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
  $subject = _AB_ACCESSCHANGEDON.' '.$nuke_config['sitename'];
  $message  = _AB_HTTPONLY."\n";
  $message .= _AB_LOGIN.': '.$xlogin."\n";
  $message .= _AB_PASSWORD.': '.$xpassword."\n";
  $message .= _AB_PROTECTED.': ';

  if($xprotected==0) { $message .= _AB_NO."\n"; } else { $message .= _AB_YES."\n"; }

  $bytes = openssl_random_pseudo_bytes(8);
  $xpassword = bin2hex($bytes);

  $xpassword_md5 = md5($xpassword);
  $xpassword_crypt = $xpassword;

  $xlogin = addslashes($xlogin);
  $xpassword = addslashes($xpassword);
  $db->sql_query("UPDATE `".$prefix."_nsnst_admins` SET `login`='$xlogin', 
                                                     `password`='$xpassword', 
												 `password_md5`='$xpassword_md5', 
											   `password_crypt`='$xpassword_crypt', 
											        `protected`='$xprotected' 
													
  WHERE `aid`='$a_aid'");
  
  list($amail) = $db->sql_fetchrow($db->sql_query("SELECT `email` FROM `".$prefix."_authors` WHERE `aid`='$a_aid' LIMIT 0,1"));
  @evo_mail($amail, $subject, $message,"From: ".$nuke_config['adminmail']."\r\nX-Mailer: "._AB_NUKESENTINEL."\r\n");
  if($ab_config['staccess_path'] > "" AND is_writable($ab_config['staccess_path'])) {
    $stwrite = "";
    $adminresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_admins` WHERE `password_crypt`>'' ORDER BY `aid`");
    while($adminrow = $db->sql_fetchrow($adminresult)) {
      $stwrite .= $adminrow['login'].":".$adminrow['password_crypt']."\n";
      $doit = fopen($ab_config['staccess_path'], "w");
      fwrite($doit, $stwrite);
      fclose($doit);
    }
  }
  header("Location: ".$admin_file.".php?op=ABAuthList");
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>