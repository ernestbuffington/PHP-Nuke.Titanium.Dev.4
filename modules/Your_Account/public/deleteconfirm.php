<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/
/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Evolution Functions                      v1.5.0       12/20/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
     echo "CNBYA protection";
     exit;
}

    include_once(NUKE_BASE_DIR.'header.php');
    setcookie("user");
    $result = $db->sql_query("SELECT user_email, user_website, username, user_password FROM ".$user_prefix."_users WHERE user_id='$uid'");
    list($email, $url, $uname, $pass) = $db->sql_fetchrow($result);
    if ($code == $pass) {
        if ($ya_config["senddeletemail"] == 1 && $ya_config["servermail"] < 1) {
            
            $subject = "$sitename - "._MEMDEL;
            $message = "$uname has been deleted from $sitename.<br />";
            $message .= "-----------------------------------------------------------<br />";
            $message .= _YA_NOREPLY;
            $headers = array(
                'Content-Type: text/html; charset=UTF-8',
                'From: '.$email,                    
                'Reply-To: '.$email,
                'Return-Path: '.$email
            );
            phpmailer( $adminmail, $subject, $message, $headers );
            
        }
        $db->sql_query("UPDATE ".$user_prefix."_users SET name='"._MEMDEL."', user_email='', user_password='', user_website='', user_sig='', user_regdate='Non 0, 0000', user_level='-1', user_active='0', user_allow_pm='0' WHERE user_id='$uid'");
        global $cookie;
        $r_uid = $cookie[0];
        $r_uname = $cookie[1];
        setcookie("user");
        $result = $db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$r_uname'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_session");
        $result = $db->sql_query("DELETE FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_bbsessions");
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=$nukeurl\">";
        title(_ACCTDELETE);
    } else {
        title(_YOUBAD);
    }
    include_once(NUKE_BASE_DIR.'footer.php');

?>