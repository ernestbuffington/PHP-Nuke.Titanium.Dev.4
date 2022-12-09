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
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die ('Access Denied');
}

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(is_mod_admin($module_name)) {

    list($email) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users_temp WHERE user_id='$dny_uid'"));
    if ($ya_config['servermail'] == 0) {
        $message = _SORRYTO." $sitename "._HASDENY;
        if ($denyreason > "") {
            $denyreason = stripslashes($denyreason);
            $message .= "<br /><br />"._DENYREASON."<br />$denyreason";
        }
        $subject = _ACCTDENY;

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: '.$adminmail,                    
            'Reply-To: '.$adminmail,
            'Return-Path: '.$adminmail
        );
        phpmailer( $email, $subject, $message, $headers );
    }
    $db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE user_id='$dny_uid'");
    $db->sql_query("DELETE FROM ".$user_prefix."_cnbya_value_temp WHERE uid='$dny_uid'");
    $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_users_temp");
    $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_cnbya_value_temp");
    $pagetitle = ": "._USERADMIN." - "._ACCTDENY;
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    amain();
    echo "<br />\n";
    OpenTable();
    echo "<center><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    if (isset($query)) { echo "<input type='hidden' name='query' value='$query'>\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop'>\n"; }
    echo "<tr><td align='center'><strong>"._ACCTDENY."</strong></td></tr>\n";
    echo "<tr><td align='center'><input type='submit' value='"._RETURN2."'></td></tr>\n";
    echo "</form>\n";
    echo "</table></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

}

?>