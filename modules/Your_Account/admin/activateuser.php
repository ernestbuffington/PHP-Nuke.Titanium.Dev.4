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

if (is_mod_admin($module_name)) {
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    list($username, $realname, $email, $check_num) = $db->sql_fetchrow($db->sql_query("SELECT username, realname, user_email, check_num FROM ".$user_prefix."_users_temp WHERE user_id='$act_uid'"));
    $pagetitle = ": "._USERADMIN." - "._YA_ACTIVATEUSER;
    
    title(_USERADMIN." - "._YA_ACTIVATEUSER);
    amain();
    echo "<br />\n";
    OpenTable();
    echo "<center><table align='center' border='0' cellpadding='0' cellspacing='0'>\n";
    echo "<tr><td align=center><strong>"._SURE2ACTIVATE.":</strong></td></tr><td><br />\n";

    OpenTable();
        echo "<table align='center' border='0' align=\"center\">";
        echo "<tr><td width=\"50%\"><strong>"._USERNAME.":</strong></td><td align=\"left\">$username<br /></td></tr>";
        echo "<tr><td width=\"50%\"><strong>"._UREALNAME.":</strong></td><td align=\"left\">$realname<br /></td></tr>";
        echo "<tr><td width=\"50%\"><strong>"._EMAIL.":</strong></td><td align=\"left\">$email</td></tr>";
        echo "</table>";
    CloseTable();

    echo "<br /></td></tr>";

    echo "<tr><td colspan=\"2\" align=\"center\">\n";

        echo "<table cellspacing=\"0\" cellpadding=\"0\" border='0' align=\"center\"><tr>\n";
        echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'><td width=\"49%\" align=\"right\">\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
        echo "<input type='hidden' name='op' value='activateUserConf'>\n";
        echo "<input type='hidden' name='act_uid' value='$act_uid'>\n";
        echo "<input type='submit' value='"._YES."'></td></form>\n";
        echo "<td width=\"10\"></td>\n";
        echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'><td width=\"49%\" align=\"left\">\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop'>\n"; }
        echo "<input type='submit' value='"._NO."'></td></form>\n";
        echo "</tr><tr><td colspan=\"3\" align=\"center\">\n";
        echo "<br /><strong>"._YA_ACTIVATEWARN1."</strong>\n";
        echo "<br /><strong>"._YA_ACTIVATEWARN2."</strong>\n";
        echo "</td></tr><tr>\n";
        echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'><td colspan=\"3\" align=\"center\">\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
        echo "<input type='hidden' name='op' value='approveUserConf'>\n";
        echo "<input type='hidden' name='apr_uid' value='$act_uid'>\n";
        echo "<input type='submit' value='"._YA_APPROVEUSER."'></td></form>\n";
        echo "</tr></table>\n";

    echo "</td></tr></table></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

}

?>