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
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    list($username, $realname, $email, $check_num) = $db->sql_fetchrow($db->sql_query("SELECT username, realname, user_email, check_num FROM ".$user_prefix."_users_temp WHERE user_id='$act_uid'"));

    $pagetitle = ": "._USERADMIN." - "._YA_APPROVEUSER;
    
    title(_USERADMIN." - "._YA_APPROVEUSER);
    amain();
    echo "<br />\n";

    OpenTable();

        echo "<center>"._SURE2ACTIVATE.":</center><br />\n";

    OpenTable();
        echo "<table align='center' border='0' align=\"center\">";
        echo "<tr><td width=\"50%\"><strong>"._USERNAME.":</strong></td><td align=\"left\">$username<br /></td></tr>";
        echo "<tr><td width=\"50%\"><strong>"._UREALNAME.":</strong></td><td align=\"left\">$realname<br /></td></tr>";
        echo "<tr><td width=\"50%\"><strong>"._EMAIL.":</strong></td><td align=\"left\">$email</td></tr>";
        echo "</table>";
    CloseTable();

    echo "<center><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
    echo "<input type='hidden' name='op' value='approveUserConf'>\n";
    echo "<input type='hidden' name='apr_uid' value='$apr_uid'>\n";
    echo "<tr><td align=center><input type='submit' value='"._YA_APPROVEUSER."'></td><tr>\n";
    echo "</form>\n";
    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    if (isset($query)) { echo "<input type='hidden' name='query' value='$query'>\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop'>\n"; }
    echo "<tr><td align='center'><input type='submit' value='"._CANCEL."'></td></tr>\n";
    echo "</form>\n";
    echo "</table></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

}

?>